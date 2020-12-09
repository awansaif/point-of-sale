<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    	'product_pic',
    	'name',
    	'type',
    	'brand',
    	'stock',
    	'cost_per_item',
    	'inentory_worth',
    	'revenue_generated',
    	'vendor',
    ];

    public function types()
    {
        return $this->belongsTo('App\Models\ProductType', 'type');
    }
    public function brands()
    {
        return $this->belongsTo('App\Models\ProductBrand', 'brand');
    }
    public function vendors()
    {
        return $this->belongsTo('App\Models\ProductVendor', 'vendor');
    }
}
