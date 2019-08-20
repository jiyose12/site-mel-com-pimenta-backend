<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = [
    'category'
    ];

    public function products()
    {
        return $this->hasMany('App\Product', 'products');
    }
    public function subcategories()
    {
        return $this->hasMany('App\Subcategory', 'subcategories');
    }
}
