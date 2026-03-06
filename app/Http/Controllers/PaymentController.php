<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function process(Request $request, $order)
    {
        $order = Order::findOrFail($order);
        $method = $request->method;

        switch ($method) {
            case 'bkash':
                return $this->initiateBkash($order);
            case 'nagad':
                return $this->initiateNagad($order);
            case 'card':
                return $this->initiateSSLCommerz($order);
            default:
                return redirect()->route('checkout.index')->with('error', 'Invalid payment method');
        }
    }

    private function initiateBkash($order)
    {
        try {
            $token = $this->getBkashToken();

            if (!$token) {
                return redirect()->route('checkout.index')->with('error', 'bKash payment initialization failed');
            }

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'X-APP-Key' => config('services.bkash.app_key'),
            ])->post(config('services.bkash.base_url') . '/create', [
                'mode' => '0011',
                'payerReference' => $order->customer_phone,
                'callbackURL' => config('services.bkash.callback_url'),
                'amount' => $order->total,
                'currency' => 'BDT',
                'intent' => 'sale',
                'merchantInvoiceNumber' => $order->order_number,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return redirect($data['bkashURL']);
            }

            return redirect()->route('checkout.index')->with('error', 'bKash payment failed');

        } catch (\Exception $e) {
            Log::error('bKash Error: ' . $e->getMessage());
            return redirect()->route('checkout.index')->with('error', 'Payment processing error');
        }
    }

    private function getBkashToken()
    {
        try {
            $response = Http::withHeaders([
                'username' => config('services.bkash.username'),
                'password' => config('services.bkash.password'),
            ])->post(config('services.bkash.base_url') . '/token/grant', [
                'app_key' => config('services.bkash.app_key'),
                'app_secret' => config('services.bkash.app_secret'),
            ]);

            if ($response->successful()) {
                return $response->json()['id_token'];
            }

            return null;
        } catch (\Exception $e) {
            Log::error('bKash Token Error: ' . $e->getMessage());
            return null;
        }
    }

    public function bkashCallback(Request $request)
    {
        if ($request->status === 'success') {
            $paymentID = $request->paymentID;
            $token = $this->getBkashToken();

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'X-APP-Key' => config('services.bkash.app_key'),
            ])->post(config('services.bkash.base_url') . '/execute', [
                'paymentID' => $paymentID,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                $order = Order::where('order_number', $data['merchantInvoiceNumber'])->first();
                
                if ($order) {
                    $order->update([
                        'payment_status' => 'paid',
                        'transaction_id' => $data['trxID'],
                        'status' => 'processing',
                    ]);

                    return redirect()->route('order.success', $order->id);
                }
            }
        }

        return redirect()->route('checkout.index')->with('error', 'Payment failed');
    }

    private function initiateNagad($order)
    {
        try {
            $timestamp = now()->timestamp . '000';
            $orderId = $order->order_number;

            $sensitiveData = [
                'merchantId' => config('services.nagad.merchant_id'),
                'datetime' => $timestamp,
                'orderId' => $orderId,
                'challenge' => $this->generateRandomString(40),
            ];

            $postData = [
                'accountNumber' => config('services.nagad.merchant_number'),
                'dateTime' => $timestamp,
                'sensitiveData' => $this->encryptNagad(json_encode($sensitiveData)),
                'signature' => $this->signNagad(json_encode($sensitiveData)),
            ];

            $response = Http::withHeaders([
                'X-KM-Api-Version' => 'v-0.2.0',
                'X-KM-IP-V4' => request()->ip(),
                'X-KM-Client-Type' => 'PC_WEB',
            ])->post(config('services.nagad.base_url') . '/check-out/initialize/' . config('services.nagad.merchant_id') . '/' . $orderId, $postData);

            if ($response->successful()) {
                $data = $response->json();
                
                $paymentData = [
                    'merchantId' => config('services.nagad.merchant_id'),
                    'orderId' => $orderId,
                    'currencyCode' => '050',
                    'amount' => $order->total,
                    'challenge' => $sensitiveData['challenge'],
                ];

                $confirmData = [
                    'paymentRefId' => $data['paymentReferenceId'],
                    'sensitiveData' => $this->encryptNagad(json_encode($paymentData)),
                    'signature' => $this->signNagad(json_encode($paymentData)),
                    'merchantCallbackURL' => config('services.nagad.callback_url'),
                ];

                $confirmResponse = Http::post(config('services.nagad.base_url') . '/check-out/complete/' . $data['paymentReferenceId'], $confirmData);

                if ($confirmResponse->successful()) {
                    $confirmData = $confirmResponse->json();
                    return redirect($confirmData['callBackUrl']);
                }
            }

            return redirect()->route('checkout.index')->with('error', 'Nagad payment failed');

        } catch (\Exception $e) {
            Log::error('Nagad Error: ' . $e->getMessage());
            return redirect()->route('checkout.index')->with('error', 'Payment processing error');
        }
    }

    public function nagadCallback(Request $request)
    {
        // Verify payment status from Nagad
        if ($request->status === 'Success') {
            $order = Order::where('order_number', $request->order_id)->first();
            
            if ($order) {
                $order->update([
                    'payment_status' => 'paid',
                    'transaction_id' => $request->payment_ref_id,
                    'status' => 'processing',
                ]);

                return redirect()->route('order.success', $order->id);
            }
        }

        return redirect()->route('checkout.index')->with('error', 'Payment failed');
    }

    private function initiateSSLCommerz($order)
    {
        try {
            $postData = [
                'store_id' => config('services.sslcommerz.store_id'),
                'store_passwd' => config('services.sslcommerz.store_password'),
                'total_amount' => $order->total,
                'currency' => 'BDT',
                'tran_id' => $order->order_number,
                'success_url' => route('payment.sslcommerz.success'),
                'fail_url' => route('payment.sslcommerz.fail'),
                'cancel_url' => route('payment.sslcommerz.cancel'),
                'cus_name' => $order->customer_name,
                'cus_email' => $order->customer_email,
                'cus_phone' => $order->customer_phone,
                'cus_add1' => $order->shipping_address,
                'cus_city' => $order->city,
                'cus_country' => 'Bangladesh',
                'shipping_method' => 'YES',
                'product_name' => 'DXN Products',
                'product_category' => 'Health Products',
                'product_profile' => 'general',
            ];

            $url = config('services.sslcommerz.sandbox') 
                ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'
                : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

            $response = Http::asForm()->post($url, $postData);

            if ($response->successful()) {
                $data = $response->json();
                
                if ($data['status'] === 'SUCCESS') {
                    return redirect($data['GatewayPageURL']);
                }
            }

            return redirect()->route('checkout.index')->with('error', 'Payment gateway error');

        } catch (\Exception $e) {
            Log::error('SSLCommerz Error: ' . $e->getMessage());
            return redirect()->route('checkout.index')->with('error', 'Payment processing error');
        }
    }

    public function sslcommerzSuccess(Request $request)
    {
        $order = Order::where('order_number', $request->tran_id)->first();
        
        if ($order && $request->status === 'VALID') {
            $order->update([
                'payment_status' => 'paid',
                'transaction_id' => $request->bank_tran_id,
                'status' => 'processing',
            ]);

            return redirect()->route('order.success', $order->id);
        }

        return redirect()->route('checkout.index')->with('error', 'Payment verification failed');
    }

    public function sslcommerzFail(Request $request)
    {
        return redirect()->route('checkout.index')->with('error', 'Payment failed');
    }

    public function sslcommerzCancel(Request $request)
    {
        return redirect()->route('checkout.index')->with('info', 'Payment cancelled');
    }

    private function encryptNagad($data)
    {
        $publicKey = config('services.nagad.public_key');
        openssl_public_encrypt($data, $encrypted, $publicKey);
        return base64_encode($encrypted);
    }

    private function signNagad($data)
    {
        $privateKey = config('services.nagad.private_key');
        openssl_sign($data, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        return base64_encode($signature);
    }

    private function generateRandomString($length = 40)
    {
        return bin2hex(random_bytes($length / 2));
    }
}
