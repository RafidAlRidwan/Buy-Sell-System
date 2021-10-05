<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Category;
use URL;
use Session;
use Redirect;
use validate;

class ProductSettingsController extends Controller
{
    public function __construct(){
    $this->middleware('auth');
  }
    public function index(){

    	$data ['brand'] = Brand::all();

    	return view('admin/productSettings.index', $data);
    }


    public function brand_datatable(Request $request){

        $searchString = $request->search['value'];
        $brand_data = Brand::where('id', '>', 0);

        if ($searchString != "") {
            $brand_data->where('name', 'LIKE', '%' . $searchString . '%');
        }   
            $data['recordsTotal'] = $brand_data->count();
            $data['recordsFiltered'] = $brand_data->count();
            $brand_data->limit($request->length)->offset($request->start);
            $brand_data_list = $brand_data->get();
            $data['draw'] = $request->draw;
            $data['data'] = array();
            $sl=0;
           
            $serial = 1;
           foreach($brand_data_list as $brand){

            if($brand['status'] == 1){
                    $class = 'badge badge-success';
                    $status = 'Active';
                }else{
                   $class = 'badge badge-danger';
                   $status = 'Inactive';
              }

            $data['data'][$sl]['sl'] = $serial++;
            $data['data'][$sl]['name'] = $brand->name;
            $data['data'][$sl]['status'] = "<span class='$class'>$status</span>";
           
            
            if($brand['deleted'] == 0){

                


              $data['data'][$sl]['action'] = "<a class='brand_edit' href='$brand->id' data-toggle='modal' data-target='#brand_edit_modal' brand_status='$brand->status' brand_name=' $brand->name '
                ><button class='btn_edit'style='background:none; border: none;'><i class='fa fa-edit'></i></button> </a> |
                
                <a class='brand_delete' href=' $brand->id ' data-toggle='modal' data-target='#user_delete_modal'><button class='btn_delete' style= 'background:none; border:none;' ><i class='fa fa-trash'></i></button> </a>";
            }
            else{
              $data['data'][$sl]['action'] = "<a class='brand_restore' href=' $brand->id ' data-toggle='modal' data-target='#brand_restore_modal'><button class='delete btn_delete'  type='submit' value='submit' style='border: none; background: none;' ><b class='badge badge-danger'><i class='fa fa-undo'></i></b></button> </a>";
            }
             $sl++;
           }


           echo json_encode($data);
           die();

    }

    public function store_brand(Request $request){

            $this->validate($request, [
            'name' => ['required', 'string', 'max:50', 'unique:inventory_brands,name']

          ]);

            $brand = new Brand;
            $brand->name = $request->name;
            $brand->status = 1;
            $brand->deleted = 0;
            
            if($brand->save()){
             Session::flash('success', 'Data Saved!');
             return Redirect::route('product');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product');
         }
    }

    public function edit_brand(Request $request){
        
            $id = $request->brand_id;
            $this->validate($request, [
            'brand_name' => 'required|string|max:20|unique:inventory_brands,name,' . $id,
            'brand_status' =>'required'
          ]);

            $brand = Brand::findOrFail($id);
            $brand->name = $request->brand_name;
            $brand->status = $request->brand_status;
            
            if($brand->save()){
             Session::flash('success', 'Data Updated!');
             return Redirect::route('product');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product');
         }
    }

    public function delete_brand(Request $request){
    
      $id = $request->id;
      $input = Brand::find($id);
      $input->status = 0;
      $input->deleted = 1;
      if($input->save()){
             Session::flash('success', 'Data Deleted Successfully!');
             return Redirect::route('product');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product');
         }
}

    public function restore_brand(Request $request){
    
      $id = $request->id;
      $input = Brand::find($id);
      $input->status = 1;
      $input->deleted = 0;
      if($input->save()){
             Session::flash('success', 'Data Restored Successfully!');
             return Redirect::route('product');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product');
         }
}

    public function unit_datatable(Request $request){

        $searchString = $request->search['value'];
        $Unit_data = Unit::where('id', '>', 0);

        if ($searchString != "") {
            $Unit_data->where('unit_name', 'LIKE', '%' . $searchString . '%');
        }
           
            $data['recordsTotal'] = $Unit_data->count();
            $data['recordsFiltered'] = $Unit_data->count();
            $Unit_data->limit($request->length)->offset($request->start);
            $unit_data_list = $Unit_data->get();
            $data['draw'] = $request->draw;
            $data['data'] = array();
            $sl=0;
           
            $serial = 1;
           foreach($unit_data_list as $unit){

            if($unit['status'] == 1){
                    $class = 'badge badge-success';
                    $status = 'Active';
                }else{
                   $class = 'badge badge-danger';
                   $status = 'Inactive';
              }

            $data['data'][$sl]['sl'] = $serial++;
            $data['data'][$sl]['name'] = $unit->unit_name;
            $data['data'][$sl]['status'] = "<span class='$class'>$status</span>";
           
            
            if($unit['deleted'] == 0){

                


              $data['data'][$sl]['action'] = "<a class='unit_edit' href='$unit->id' data-toggle='modal' data-target='#unit_edit_modal' unit_status='$unit->status' unit_name=' $unit->unit_name '
                ><button class='btn_edit'style='background:none; border: none;'><i class='fa fa-edit'></i></button> </a> |
                
                <a class='unit_delete' href=' $unit->id ' data-toggle='modal' data-target='#unit_delete_modal'><button class='btn_delete' style= 'background:none; border:none;' ><i class='fa fa-trash'></i></button> </a>";
            }
            else{
              $data['data'][$sl]['action'] = "<a class='unit_restore' href=' $unit->id ' data-toggle='modal' data-target='#unit_restore_modal'><button class='delete btn_delete'  type='submit' value='submit' style='border: none; background: none;' ><b class='badge badge-danger'><i class='fa fa-undo'></i></b></button> </a>";
            }
             $sl++;
           }


           echo json_encode($data);
           die();

    }

    public function store_unit(Request $request){

            $this->validate($request, [
            'unit_name' => ['required', 'string', 'max:50', 'unique:inventory_units,unit_name']

          ]);

            $unit = new Unit;
            $unit->unit_name = $request->unit_name;
            $unit->status = 1;
            $unit->deleted = 0;
            
            if($unit->save()){
             Session::flash('success', 'Data Saved!');
             return Redirect::route('product');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product');
         }
    }

    public function edit_unit(Request $request){
        
            $id = $request->unit_id;
            $this->validate($request, [
            'unit_name' => 'required|string|max:20|unique:inventory_units,unit_name,' . $id,
            'unit_status' =>'required'
          ]);

            $unit = Unit::findOrFail($id);
            $unit->unit_name = $request->unit_name;
            $unit->status = $request->unit_status;
            
            if($unit->save()){
             Session::flash('success', 'Data Updated!');
             return Redirect::route('product');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product');
         }
    }

    public function delete_unit(Request $request){
    
      $id = $request->id;
      $input = Unit::find($id);
      $input->status = 0;
      $input->deleted = 1;
      if($input->save()){
             Session::flash('success', 'Data Deleted Successfully!');
             return Redirect::route('product');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product');
         }
}

    public function restore_unit(Request $request){
    
      $id = $request->id;
      $input = Unit::find($id);
      $input->status = 1;
      $input->deleted = 0;
      if($input->save()){
             Session::flash('success', 'Data Restored Successfully!');
             return Redirect::route('product');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product');
         }
}

    
    public function category_datatable(Request $request){

        $searchString = $request->search['value'];
        $category_data = Category::where('id', '>', 0);

           if ($searchString != "") {
            $category_data->where('name', 'LIKE', '%' . $searchString . '%');
            
          }
            $data['recordsTotal'] = $category_data->count();
            $data['recordsFiltered'] = $category_data->count();
            $category_data->limit($request->length)->offset($request->start);
            $category_data_list = $category_data->get();
            $data['draw'] = $request->draw;
            $data['data'] = array();
            $sl=0;
           
            $serial = 1;
           foreach($category_data_list as $category){

            if($category['status'] == 1){
                    $class = 'badge badge-success';
                    $status = 'Active';
                }else{
                   $class = 'badge badge-danger';
                   $status = 'Inactive';
              }



            $data['data'][$sl]['sl'] = $serial++;
            $data['data'][$sl]['name'] = $category->name;

            if($category->is_countable == 1){                      
                                            
            $data['data'][$sl]['countable'] = "<span class='badge badge-success'>Yes</span>"; 
                    }
            else{
                $data['data'][$sl]['countable'] = "<span class='badge badge-warning'>No</span>";
            }
            $data['data'][$sl]['status'] = "<span class='$class'>$status</span>";
           
            
            if($category['deleted'] == 0){

                


              $data['data'][$sl]['action'] = "<a class='category_edit' href='$category->id' data-toggle='modal' data-target='#category_edit_modal' category_status='$category->status' category_name=' $category->name '
              countable ='$category->is_countable'
                ><button class='btn_edit'style='background:none; border: none;'><i class='fa fa-edit'></i></button> </a> |
                
                <a class='category_delete' href=' $category->id ' data-toggle='modal' data-target='#category_delete_modal'><button class='btn_delete' style= 'background:none; border:none;' ><i class='fa fa-trash'></i></button> </a>";
            }
            else{
              $data['data'][$sl]['action'] = "<a class='category_restore' href=' $category->id ' data-toggle='modal' data-target='#category_restore_modal'><button class='delete btn_delete'  type='submit' value='submit' style='border: none; background: none;' ><b class='badge badge-danger'><i class='fa fa-undo'></i></b></button> </a>";
            }
             $sl++;
           }


           echo json_encode($data);
           die();

    }

        public function store_category(Request $request){
            
            $this->validate($request, [
            'category_name' => ['required', 'string', 'max:50', 'unique:inventory_categories,name']

          ]);

            $category = new Category;
            $category->name = $request->category_name;
            $category->status = 1;
            $category->deleted = 0;
            if($request->is_countable != NULL){
                $category->is_countable = 1;
            }
            else{
                $category->is_countable = 0;
            }
            
            if($category->save()){
             Session::flash('success', 'Data Saved!');
             return Redirect::route('product');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product');
         }
    }

    public function edit_category(Request $request){
      
            $id = $request->category_id;
            $this->validate($request, [
            'category_name' => 'required|string|max:20|unique:inventory_categories,name,' . $id,
            'category_status' =>'required',
            'is_countable' =>'required'
          ]);

            $category = Category::findOrFail($id);
            $category->name = $request->category_name;
            $category->status = $request->category_status;
            $category->is_countable = $request->is_countable;
            
            
            if($category->save()){
             Session::flash('success', 'Data Updated!');
             return Redirect::route('product');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product');
         }
    }

    public function delete_category(Request $request){
    
      $id = $request->id;
      $input = Category::find($id);
      $input->status = 0;
      $input->deleted = 1;
      if($input->save()){
             Session::flash('success', 'Data Deleted Successfully!');
             return Redirect::route('product');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product');
         }
}

    public function restore_category(Request $request){
    
      $id = $request->id;
      $input = Category::find($id);
      $input->status = 1;
      $input->deleted = 0;
      if($input->save()){
             Session::flash('success', 'Data Restored Successfully!');
             return Redirect::route('product');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('product');
         }
}
}
