<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
    'name',
    'gross_price',
    'net_price',
    'discount',
    'amount',
    'description',
    'color',
    'size',
    'flavor',
    'image_product',
    'category_id',
    'subcategory_id'
];

    public function category()
    {
        return $this->belongsTo('App\Category', 'categories');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory', 'subcategories');
    }
}
