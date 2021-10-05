<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vendor;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderProduct;
use Auth;

use URL;
use Session;
use Redirect;
use validate;
class PurchaseOrderController extends Controller
{
    public function index(){

    	$data['vendor'] = Vendor::pluck('name' , 'id');
    	return view('Admin/purchaseOrder.index' , $data);
    }

    public function get_product_info(Request $request){

    	$id = $request->pId;
        $data ['product'] = Product::findOrFail($id); 
  
        return $data;
    }

    

    public function pass_data(Request $request){

        $data['product'] = Product::pluck('name' , 'id');
        $data['vendor_id'] = $request->vendor_id;
        $data['purchase_date'] = $request->purchase_date;
        return view('Admin/purchaseOrder.purchase_order' , $data);
    }

    public function store_purchase(Request $request){


        $this->validate($request, [

            'vendor_id' => ['required'],
            'purchase_date' => ['required'],
            'total_amount' => ['required'],
            'v_product' => ['required']
        ]);

        $lastOrder =PurchaseOrder::latest('id')->first();

                    if ($lastOrder == !null) {
                        $currentPOID = "PO-000" . ($lastOrder->id + 1);
                    }
                    else {
                        $currentPOID = "PO-0001";
                    }

        $purchase_order = new PurchaseOrder;
        $purchase_order->purchase_order_id = $currentPOID;
        $purchase_order->total_price = $request->total_amount;
        $purchase_order->vendor_id = $request->vendor_id;
        $purchase_order->purchase_date = date('Y-m-d', strtotime($request->purchase_date));
        $purchase_order->purchased_by = Auth::user()->username;

        

         if($purchase_order->save()){
            $k = 0;
            foreach($request->v_product as $key => $item_loop){
                $purchase_order_product = new PurchaseOrderProduct;
                $purchase_order_product->purchase_order_id = $purchase_order->purchase_order_id;
                $purchase_order_product->product_id = $request->v_product[$k];
                $purchase_order_product->price = $request->v_subtotal_input[$k];
                $purchase_order_product->qty = $request->v_qyt[$k];
                $purchase_order_product->save();
                $k++;
            }
          }

          if($request->total_item > 0){
            $k = 0;
            foreach($request->v_product as $key => $item_loop){
                $purchase_product = Product::findOrFail($request->v_product[$k]);
                $purchase_product->purchase_qty += $request->v_qyt[$k];
                $purchase_product->total_price += $request->v_subtotal_input[$k];
                $purchase_product->stock_qty += $request->v_qyt[$k];
                $purchase_product->save();
                $k++;
            }
          }

             Session::flash('success', 'Purchase has been done!');
             return Redirect::route('purchase_order');

    }

    public function search(Request $request)
     {
            if($request->ajax())
            {
            $output = "";
            $products = Product::where('name','LIKE','%'.$request->search."%")->get();
            
            return Response($products);
               }
               
            }

    public function purchase_datatable(Request $request){

            // $searchString = $request->search['value'];
            $product_data = PurchaseOrder::where('vendor_id', '>', 0);

        //     if ($searchString != "") {
        //     $product_data->where('id', 'LIKE', '%' . $searchString . '%');
        // }

            $data['recordsTotal'] = $product_data->count();
            $data['recordsFiltered'] = $product_data->count();
            $product_data->limit($request->length)->offset($request->start);
            $product_data_list = $product_data->get();
            $data['draw'] = $request->draw;
            $data['data'] = array();
            $sl=0;
            

           foreach($product_data_list as $product){

            $vendor_name = $product->vendor['name'];
            
            $data['data'][$sl]['sl'] = "<b class='text-primary'>$product->purchase_order_id</b>";;
            $data['data'][$sl]['vendor'] = $vendor_name ;
            $data['data'][$sl]['price'] = $product->total_price;
            $data['data'][$sl]['date'] = date('M, Y', strtotime($product->purchase_date));
           
            $editURL = URL::to('purchase_order_edit'.'/'.$product->id);
            if($product['deleted'] == 0){

                


              $data['data'][$sl]['action'] = "<a class='product_edit' href='$editURL'
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

    public function purchase_order_edit($id){

        $data['order'] = PurchaseOrder::findOrFail($id);
        $data['product'] = Product::pluck('name' , 'id');
        return view('admin/purchaseOrder.edit' , $data);

    }


    public function update_purchase(Request $request){

        return $request->all();
    }

}
