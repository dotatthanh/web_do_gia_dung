<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Size extends AuthTmp
{
    protected $fillable = [
        'name', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}












