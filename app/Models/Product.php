<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'inventory_products';
    public $timestamps = false;

    public function unit(){
		return $this->hasOne('App\Models\Unit', 'id', 'unit_type');
    }

    public function category(){
    	return $this->hasOne('App\Models\Category', 'id' , 'category_id');
    }
}
