<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use URL;
use Session;
use Redirect;
use validate;

class UserController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
    public function index(){

    	return view('admin/user.index');
    }

    public function user_datatable(Request $request){

      $searchString = $request->search['value'];
    	$user_data = User::where('type' , 1);

      if ($searchString != "") {
            $user_data->where('username', 'LIKE', '%' . $searchString . '%');
            $user_data->orWhere('email', 'LIKE', '%' . $searchString . '%');
        }   
            $data['recordsTotal'] = $user_data->count();
            $data['recordsFiltered'] = $user_data->count();
            $user_data->limit($request->length)->offset($request->start);
            $user_data_list = $user_data->get();
            $data['draw'] = $request->draw;
            $data['data'] = array();
            $sl=0;
            $serial= 1;
           

           foreach($user_data_list as $user){

            if($user['status'] == 1){
                    $class = 'badge badge-success';
                    $status = 'Active';
                }else{
                   $class = 'badge badge-danger';
                   $status = 'Inactive';
              }
            $data['data'][$sl]['sl'] = $serial++;
            $data['data'][$sl]['username'] = $user->username;
            $data['data'][$sl]['email'] = $user->email;
            $data['data'][$sl]['type'] = "Admin Assistant";
            $data['data'][$sl]['status'] = "<span class='$class'>$status</span>";
           
            
            if($user['deleted'] == 0){

                


              $data['data'][$sl]['action'] = "<a class='user_edit' href='$user->id' data-toggle='modal' data-target='#user_edit_modal' email=' $user->email' user_status='$user->status' username=' $user->username '
                ><button class='btn_details' style=' style='font-size:8px;'type='button'>Edit</button> </a> 
                
                <a class='user_delete' href=' $user->id ' data-toggle='modal' data-target='#user_delete_modal'><button class='btn_details_danger'  type='button' style='style='font-size:8px; >Delete</button> </a>";
            }
            else{
              $data['data'][$sl]['action'] = "<a class='user_restore' href=' $user->id ' data-toggle='modal' data-target='#user_restore_modal'><button class='delete btn_delete'  type='submit' value='submit' style='border: none; background: none;' ><b class='badge badge-danger'><i class='fa fa-undo'></i></b></button> </a>";
            }
             $sl++;
           }


           echo json_encode($data);
           die();

    }

    public function store_user(Request $request){

    	$this->validate($request, [

    		    'username' => ['required', 'string', 'max:20', 'unique:users,username'],
            'email' => ['required', 'email', 'max:50', 'unique:users,email'],
            'password' => ['required', 'min:4'],

    	]);

    	$user = new User;
    	$user->username = $request->username;
    	$user->email = $request->email;
    	$user->password = Hash::make($request['password']);

    	if($user->save()){
             Session::flash('success', 'Data Saved!');
             return Redirect::route('user');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('user');
         }
    }

    public function edit_user(Request $request){
       // return $request->all();

      $id = $request->id;
       $this->validate($request, [

        'username' => 'required|string|max:20|unique:users,username,' . $id,
        'email' => 'required|email|max:50|unique:users,email,' . $id,
        'status' => 'required'
       ]);

       $user = User::findOrFail($id);
       $user->username = $request->username;
       $user->email = $request->email;
       $user->status = $request->status;

       if($user->save()){
             Session::flash('success', 'Data Updated!');
             return Redirect::route('user');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('user');
         }
    }

    public function delete_user(Request $request){
    
      $id = $request->id;
      $input = User::find($id);
      $input->status = 0;
      $input->deleted = 1;
      if($input->save()){
             Session::flash('success', 'Data Deleted Successfully!');
             return Redirect::route('user');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('user');
         }
}

    public function restore_user(Request $request){
    
      $id = $request->id;
      $input = User::find($id);
      $input->status = 1;
      $input->deleted = 0;
      if($input->save()){
             Session::flash('success', 'Data Restored Successfully!');
             return Redirect::route('user');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('user');
         }
}

    
}
