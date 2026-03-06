# Payment Gateway Setup Guide for Bangladesh

## Overview

This e-commerce platform supports three major payment methods in Bangladesh:
1. bKash (Mobile Financial Service)
2. Nagad (Mobile Financial Service)
3. SSLCOMMERZ (Credit/Debit Cards, Mobile Banking)

## 1. bKash Payment Gateway

### Registration Process

1. Visit: https://www.bka.sh/merchant
2. Click on "Merchant Registration"
3. Fill in business details
4. Submit required documents:
   - Trade License
   - TIN Certificate
   - Bank Account Details
   - NID/Passport

### Getting API Credentials

1. After approval, login to bKash Merchant Portal
2. Navigate to API Integration section
3. Get the following credentials:
   - App Key
   - App Secret
   - Username
   - Password

### Configuration

Add to `.env`:
```env
BKASH_SANDBOX=true  # false for production
BKASH_APP_KEY=your_app_key_here
BKASH_APP_SECRET=your_app_secret_here
BKASH_USERNAME=your_username_here
BKASH_PASSWORD=your_password_here
BKASH_CALLBACK_URL="${APP_URL}/payment/bkash/callback"
```

### Testing

- Sandbox URL: https://tokenized.sandbox.bka.sh
- Test Wallet: 01770618567
- Test OTP: 123456

## 2. Nagad Payment Gateway

### Registration Process

1. Visit: https://nagad.com.bd/merchant
2. Apply for merchant account
3. Submit documents:
   - Trade License
   - TIN Certificate
   - Bank Statement
   - NID

### Getting API Credentials

1. After approval, contact Nagad support
2. Request for API integration
3. Get credentials:
   - Merchant ID
   - Merchant Number
   - Public Key
   - Private Key

### Configuration

Add to `.env`:
```env
NAGAD_SANDBOX=true  # false for production
NAGAD_MERCHANT_ID=your_merchant_id
NAGAD_MERCHANT_NUMBER=your_merchant_number
NAGAD_PUBLIC_KEY=your_public_key_path
NAGAD_PRIVATE_KEY=your_private_key_path
NAGAD_CALLBACK_URL="${APP_URL}/payment/nagad/callback"
```

### Key Generation

Generate RSA keys for Nagad:
```bash
# Generate private key
openssl genrsa -out nagad_private.key 2048

# Generate public key
openssl rsa -in nagad_private.key -pubout -out nagad_public.key
```

### Testing

- Sandbox URL: http://sandbox.mynagad.com:10080
- Contact Nagad for test credentials

## 3. SSLCOMMERZ (Bank Cards)

### Registration Process

1. Visit: https://sslcommerz.com
2. Click "Merchant Registration"
3. Fill business information
4. Submit documents:
   - Trade License
   - TIN Certificate
   - Bank Account
   - Website URL

### Getting Credentials

1. After approval, login to merchant panel
2. Navigate to Settings > API Integration
3. Get credentials:
   - Store ID
   - Store Password

### Configuration

Add to `.env`:
```env
SSLCOMMERZ_SANDBOX=true  # false for production
SSLCOMMERZ_STORE_ID=your_store_id
SSLCOMMERZ_STORE_PASSWORD=your_store_password
```

### Supported Payment Methods

SSLCOMMERZ supports:
- Visa/Mastercard/Amex
- Mobile Banking (bKash, Nagad, Rocket)
- Internet Banking
- Mobile Wallets

### Testing

Sandbox credentials:
- Store ID: testbox
- Store Password: qwerty
- Test Card: 4111111111111111
- CVV: Any 3 digits
- Expiry: Any future date

## Transaction Fees

### bKash
- 1.85% per transaction
- Minimum: ৳5
- Settlement: T+1 days

### Nagad
- 1.49% - 1.99% per transaction
- Settlement: T+1 days

### SSLCOMMERZ
- 2.5% - 3.5% for cards
- 1.5% - 2% for mobile banking
- Setup fee: ৳10,000 - ৳20,000
- Settlement: T+2 to T+7 days

## Security Best Practices

1. **Use HTTPS**: Always use SSL certificate in production
2. **Validate Callbacks**: Verify payment callbacks from gateway
3. **Store Credentials Securely**: Never commit credentials to git
4. **Log Transactions**: Keep detailed logs of all transactions
5. **Handle Failures**: Implement proper error handling
6. **Test Thoroughly**: Test all payment scenarios before going live

## Webhook/Callback URLs

Ensure these URLs are accessible:

```
https://yourdomain.com/payment/bkash/callback
https://yourdomain.com/payment/nagad/callback
https://yourdomain.com/payment/sslcommerz/success
https://yourdomain.com/payment/sslcommerz/fail
https://yourdomain.com/payment/sslcommerz/cancel
```

## Support Contacts

### bKash
- Email: merchantcare@bka.sh
- Phone: 16247
- Website: https://www.bka.sh

### Nagad
- Email: merchant@nagad.com.bd
- Phone: 16167
- Website: https://nagad.com.bd

### SSLCOMMERZ
- Email: operation@sslcommerz.com
- Phone: +880 1847 130 130
- Website: https://sslcommerz.com

## Troubleshooting

### Common Issues

1. **Invalid Signature**: Check API credentials
2. **Callback Not Working**: Verify URL is publicly accessible
3. **Transaction Timeout**: Increase timeout in config
4. **SSL Certificate Error**: Install proper SSL certificate

### Debug Mode

Enable detailed logging in `.env`:
```env
APP_DEBUG=true
LOG_LEVEL=debug
```

Check logs in `storage/logs/laravel.log`
