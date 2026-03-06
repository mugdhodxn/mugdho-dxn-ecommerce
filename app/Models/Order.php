<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'subtotal',
        'shipping_cost',
        'total',
        'payment_method',
        'payment_status',
        'transaction_id',
        'status',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'city',
        'postal_code',
        'notes'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber()
    {
        return 'MDN-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }
}
