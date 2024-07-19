<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddToCart extends Model
{
    protected $table = 'add_to_cart';

    protected $fillable = [
        'product_id',
        'quantity',
        'purchase_id', // Add this if not already present
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


}
