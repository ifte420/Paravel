<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [ 
        'category_id', 'product_name', 'product_price','product_quantity', 'product_short_description', 'product_long_description', 'product_alert_quantity' , 'product_image'
    ];
}
