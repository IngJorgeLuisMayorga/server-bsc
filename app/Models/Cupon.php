<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'enable',
        'from_date',
        'to_date',
        'type',
        'variable_give_product_A_id',
        'variable_give_product_B_id',
        'variable_give_product_C_id',
        'variable_give_discount',
        'variable_give_free_shipping',
        'variable_by_brand_equal',
        'variable_by_total_bigger_than',
        'variable_by_first_N_orders_today_by_N',
        'variable_by_first_N_orders_today_by_productId',
        'variable_by_2_products_same_brand_brand',
        'variable_by_2_products_same_brand_give_3rd_discount',
        'variable_give_discount_amount',
        'variable_give_free_shipping',
        'variable_give_discount_percentage'
    ];
}
