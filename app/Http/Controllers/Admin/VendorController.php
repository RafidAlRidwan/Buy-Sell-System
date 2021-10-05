<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use URL;
use Session;
use Redirect;
use validate;

class VendorController extends Controller
{
	public function __construct(){
    $this->middleware('auth');
  }
    public function index(){

    	return view('admin/vendor.index');
    }

    public function store_vendor(Request $request){
    	// return $request->all();
    	$this->validate($request, [

    		'name' => ['required', 'string', 'max:20', 'unique:inventory_vendors,name'],
            'address' => ['required'],
            'phone' => ['required', 'max:11'],
            'contact_person' => ['required']


    	]);

    	$vendor = new Vendor;
    	$vendor->name = $request->name;
    	$vendor->address = $request->address;
    	$vendor->phone = $request->phone;
    	$vendor->contact_person = $request->contact_person;
    	$vendor->status = 1;

    	if($vendor->save()){
             Session::flash('success', 'Data Saved!');
             return Redirect::route('vendor');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('vendor');
         }
    }

    public function vendor_datatable(Request $request){

      $searchString = $request->search['value'];
    	$vendor_data = Vendor::where('id', '>', 0);

      if ($searchString != "") {
            $vendor_data->where('name', 'LIKE', '%' . $searchString . '%');
            $vendor_data->orWhere('contact_person', 'LIKE', '%' . $searchString . '%');
        }
           
            $data['recordsTotal'] = $vendor_data->count();
            $data['recordsFiltered'] = $vendor_data->count();
            $vendor_data->limit($request->length)->offset($request->start);
            $vendor_data_list = $vendor_data->get();
            $data['draw'] = $request->draw;
            $data['data'] = array();
            $sl=0;
           	$seriel=1;

           foreach($vendor_data_list as $vendor){

            if($vendor['status'] == 1){
                    $class = 'badge badge-success';
                    $status = 'Active';
                }else{
                   $class = 'badge badge-danger';
                   $status = 'Inactive';
              }
            $data['data'][$sl]['sl'] = $seriel++;
            $data['data'][$sl]['name'] ="<b class='text-primary'>$vendor->name</b>" ;
            $data['data'][$sl]['address'] = $vendor->address;
            $data['data'][$sl]['phone'] = $vendor->phone;
            $data['data'][$sl]['contact_person'] = $vendor->contact_person;
            $data['data'][$sl]['purchase_amount'] = $vendor->purchase_amount;
            $data['data'][$sl]['status'] = "<span class='$class'>$status</span>";
           
            
            if($vendor['deleted'] == 0){

                


              $data['data'][$sl]['action'] = "<a class='vendor_edit' href='$vendor->id' data-toggle='modal' data-target='#vendor_edit_modal' name=' $vendor->name' status='$vendor->status'  address = '$vendor->address' phone = '$vendor->phone' contact_person = '$vendor->contact_person'
                ><button class='btn_details' style=' style='font-size:8px;'type='button'>Edit</button> </a> 
                
                <a class='vendor_delete' href=' $vendor->id ' data-toggle='modal' data-target='#vendor_delete_modal'><button class='btn_details_danger'  type='button' style='style='font-size:8px; >Delete</button> </a>";
            }
            else{
              $data['data'][$sl]['action'] = "<a class='vendor_restore' href=' $vendor->id ' data-toggle='modal' data-target='#vendor_restore_modal'><button class='delete btn_delete'  type='submit' value='submit' style='border: none; background: none;' ><b class='badge badge-danger'><i class='fa fa-undo'></i></b></button> </a>";
            }
             $sl++;
           }


           echo json_encode($data);
           die();

    }

    public function edit_vendor(Request $request){
      

      $id = $request->id;
       $this->validate($request, [

        'name' => 'required|string|max:20|unique:inventory_vendors,name,' . $id,
        'address' => ['required'],
        'phone' => ['required', 'max:11'],
        'contact_person' => ['required'],
        'status' => ['required'],
       ]);

       $vendor = Vendor::findOrFail($id);
    	$vendor->name = $request->name;
    	$vendor->address = $request->address;
    	$vendor->phone = $request->phone;
    	$vendor->contact_person = $request->contact_person;
    	$vendor->status = $request->status;

       if($vendor->save()){
             Session::flash('success', 'Data Updated!');
             return Redirect::route('vendor');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('vendor');
         }
    }

    public function delete_vendor(Request $request){
    
      $id = $request->id;
      $input = Vendor::find($id);
      $input->status = 0;
      $input->deleted = 1;
      if($input->save()){
             Session::flash('success', 'Data Deleted Successfully!');
             return Redirect::route('vendor');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('vendor');
         }
}

    public function restore_vendor(Request $request){
    
      $id = $request->id;
      $input = Vendor::find($id);
      $input->status = 1;
      $input->deleted = 0;
      if($input->save()){
             Session::flash('success', 'Data Restored Successfully!');
             return Redirect::route('vendor');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('vendor');
         }
}
}
