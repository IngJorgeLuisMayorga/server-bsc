<?php

namespace App\Models;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_extra_id',
        'category_main_ingredient_id',
        'category_skin_id',
        'category_solution_id',
        'category_step_id',
        'description',
        'discount',
        'ingredients',
        'isDuo',
        'name',
        'price',
        'productA_id',
        'productB_id',
        'quantity',
        'sku',
        'type',
        'updated_at',
        'image1_src',
        'image2_src',
        'image3_src',
        'image4_src',
    ];

    public function category_skin_id(){
        return $this->hasOne(Categories::class, 'id', 'category_skin_id');
    }
    public function category_main_ingredient_id(){
        return $this->hasOne(Categories::class, 'id', 'category_main_ingredient_id');
    }
    public function category_solution_id(){
        return $this->hasOne(Categories::class, 'id', 'category_solution_id');
    }
    public function category_step_id(){
        return $this->hasOne(Categories::class, 'id', 'category_step_id');
    }
    public function category_extra_id(){
        return $this->hasOne(Categories::class, 'id', 'category_extra_id');
    }
}
