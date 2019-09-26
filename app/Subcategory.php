<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public $timestamps = false;
    protected $fillable = [
    'subcategory',
    'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'categories');
    }
    public function products()
    {
        return $this->hasMany('App\Product', 'products');
    }
}
