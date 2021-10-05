<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderProduct extends Model
{
    use HasFactory;
    protected $table = 'inventory_purchase_order_products';
    public $timestamps = false;

    public function product(){
    	return $this->hasOne('App\Models\Product' , 'id' , 'product_id');
    }
}
