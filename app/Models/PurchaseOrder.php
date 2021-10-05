<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table = 'inventory_purchase_orders';
    public $timestamps = false;


    public function purchase_order_product(){
    	return $this->hasMany('App\Models\PurchaseOrderProduct' , 'purchase_order_id' , 'purchase_order_id');
    }

    public function vendor(){
    	return $this->hasOne('App\Models\Vendor' , 'id', 'vendor_id');
    }
}
