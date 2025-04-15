<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['product_id', 'model', 'p_desc', 'company_id','p_img','p_category','p_price'];
    protected $table = 'products';
    protected $primaryKey = 'product_id';

    // In App\Models\Cart


}
