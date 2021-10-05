<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use URL;
use Session;
use Redirect;
use validate;

class ProductUnitController extends Controller
{
	public function __construct(){
    $this->middleware('auth');
  }
    public function index(){

    	$data['category'] = Category::where('status', 1)->pluck('name' , 'id');
    	$data['unit'] = Unit::where('status' , 1)->pluck('unit_name' , 'id');
    	return view('admin/productList.index' , $data);
    }

    public function product_datatable(Request $request){

    		$searchString = $request->search['value'];
    		$product_data = Product::where('id', '>', 0);

          	if ($searchString != "") {
            $product_data->where('name', 'LIKE', '%' . $searchString . '%');
        }

            $data['recordsTotal'] = $product_data->count();
            $data['recordsFiltered'] = $product_data->count();
            $product_data->limit($request->length)->offset($request->start);
            $product_data_list = $product_data->get();
            $data['draw'] = $request->draw;
            $data['data'] = array();
            $sl=0;
           	$seriel=1;

           foreach($product_data_list as $product){

 
            $data['data'][$sl]['sl'] = $seriel++;
            $data['data'][$sl]['name'] = "<b class='text-primary'>$product->name</b>" ;
            $data['data'][$sl]['purchase_quantity'] =$product->purchase_qty ;
            $data['data'][$sl]['quantity_in_stock'] = $product->stock_qty;
            $data['data'][$sl]['unit_type'] = $product->unit['unit_name'];
            $data['data'][$sl]['total_purchase_amount'] = $product->total_price;
            $data['data'][$sl]['category'] = $product->category['name'];
            $data['data'][$sl]['tag'] = $product->tag;
           
            
            if($product['deleted'] == 0){

                


              $data['data'][$sl]['action'] = "<a class='product_edit' href='$product->id' data-toggle='modal' data-target='#product_edit_modal' name=' $product->name' status='$product->status' tag = '$product->tag'  category = '$product->category_id' brand = '$product->brand_id' unit_type = '$product->unit_type'
                ><button class='btn_details' style=' style='font-size:8px;'type='button'>Edit</button> </a> 
                
                <a class='product_delete' href=' $product->id ' data-toggle='modal' data-target='#product_delete_modal'><button class='btn_details_danger'  type='button' style='style='font-size:8px; >Delete</button> </a>";
            }
            else{
              $data['data'][$sl]['action'] = "<a class='product_restore' href=' $product->id ' data-toggle='modal' data-target='#product_restore_modal'><button class='delete btn_delete'  type='submit' value='submit' style='border: none; background: none;' ><b class='badge badge-danger'><i class='fa fa-undo'></i></b></button> </a>";
            }
             $sl++;
           }


           echo json_encode($data);
           die();

    }

    public function store_product(Request $request){
    	// return $request->all();
    	$this->validate($request, [
    		'name' => ['required' , 'string' , 'unique:inventory_products,name'],
    		'category_id' => ['required'],
    		'tag' => ['required'],
    		'unit_type' => ['required']
    	]);

    	$product = new Product;
    	$product->name = $request->name;
    	$product->category_id = $request->category_id;
    	$product->tag = $request->tag;
    	$product->unit_type = $request->unit_type;

    	if($product->save()){
    		Session::flash('success' , 'Data Saved!');
    		return Redirect::route('product_list');
    	}
    	else{
    		Session::flash('error' , 'Failed');
    		return Redirect::route('product_list');
    	}
    }

    public function edit_product(Request $request){
      

      $id = $request->id;
       $this->validate($request, [

        'product_name' => 'required|string|max:20|unique:inventory_products,name,' . $id,
        'category_id' => ['required', 'max:11'],
        'tag' => ['required'],
        'unit_type' => ['required'],
        'status' => ['required'],
       ]);

       $product = Product::findOrFail($id);
    	$product->name = $request->product_name;
    	$product->category_id = $request->category_id;
    	$product->tag = $request->tag;
    	$product->unit_type = $request->unit_type;
    	$product->status = $request->status;


       if($product->save()){
             Session::flash('success', 'Data Updated!');
             return Redirect::route('product_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product_list');
         }
    }

    public function delete_product(Request $request){
    
      $id = $request->id;
      $input = Product::find($id);
      $input->status = 0;
      $input->deleted = 1;
      if($input->save()){
             Session::flash('success', 'Data Deleted Successfully!');
             return Redirect::route('product_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product_list');
         }
}

    public function restore_product(Request $request){
    
      $id = $request->id;
      $input = Product::find($id);
      $input->status = 1;
      $input->deleted = 0;
      if($input->save()){
             Session::flash('success', 'Data Restored Successfully!');
             return Redirect::route('product_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product_list');
         }
}
}
