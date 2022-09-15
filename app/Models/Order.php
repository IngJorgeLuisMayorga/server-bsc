<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'user_id',
        'user_nid_type',
        'user_nid_number',
        'user_email',
        'user_name',
        'user_first_name',
        'user_last_name',

        'payment_id',
        'payment_method',
        'payment_approved_at',
        'payment_wompi_id',

        'coupon_id',
        'coupon_discount',
        
        'order_ref',
        'order_points',
        'order_subtotal',
        'order_taxes',
        'order_total',
        'order_products_json',
   
        'shipping_status',
        'shipping_guide_ref',
        'shipping_guide_company',
        'shipping_phone',
        'shipping_address',
        'shipping_country',
        'shipping_department',
        'shipping_city',
        
        'shipping_ordered_at',
        'shipping_shipped_at',
        'shipping_delivered_at',
        
    ];


}
