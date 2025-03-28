<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['product_id', 'user_id', 'qty'];
    protected $table = 'cart';
}
