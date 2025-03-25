<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['product_id', 'model', 'p_desc', 'company_id','p_img'];
    protected $table = 'product';
    protected $primaryKey = 'product_id';
}
