<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $primaryKey = 'company_id';

    public $timestamps = false;

    protected $fillable = [
        'company_name',
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'company_id', 'company_id');
    }
}
