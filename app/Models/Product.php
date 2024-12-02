<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    // protected $primaryKey = 'product_id';

    protected $table = 'products';

    protected $fillable = [
        'product_id',
        'item_name',
        'storage',
        'image',
        'cost_price',
        'sell_price',
        'quantity',
        'description',
        'status',
        'brand_id',
        'admin_id',
    ];

}
