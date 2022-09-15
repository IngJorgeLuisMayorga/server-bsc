<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'method',
        'reference',
        'amount',
        'wompi_amount_in_cents',
        'wompi_currency',
        'wompi_method',
        'wompi_id',
        'user_id',
    ];

}
