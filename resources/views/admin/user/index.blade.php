@extends('layouts.admin')

@section('content')
 
 <section> 
 
    <div class="card">

      

      <div class="card-body">

       

      <div class="row x_title">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <h3>User</h3>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
          
            <button style="background: #4ed2c5; border: none;" class="btn btn-primary float-right" data-toggle="modal" data-target="#user_add_modal"><i class="fa fa-plus"></i> Create</button>
        </div>
        <div class="clearfix"></div>
      </div>

  <div class="table-responsive">
    <table id="data_table" class="table table-bordered table-striped">
        <thead style="color:#fff; background: #4ed2c5;">
            <tr>
              <th>SL</th>
                <th>Username</th>
                <th>Email</th>
                <th>Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        
        <tfoot>
            <tr>
              <th>SL</th>
                <th>Username</th>
                <th>Email</th>
                <th>Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
  </div>
  </div>
</div>
</section>

<!--User_Add  Modal -->
<section>

<div class="modal fade" id="user_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Add User</h5>
        
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'store_user','autocomplete'=>'off', 'method' =>'POST'))}}

                  <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control rl" name="username" required />
                  </div>
                  <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email"  class="form-control rl" name="email" data-parsley-trigger="change" required />
                  </div>
                  <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password"  class="form-control rl" name="password" data-parsley-trigger="change" required />
                  </div>
                                   
                
                                                                     
        
       </article>
     </div> 

     <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Save</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
    </div>
     {{ Form::close() }}
    </div>
   </div>
  </div>
</div>
</section>


<!-- User_Edit Modal -->
<section>

<div class="modal fade" id="user_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'edit_user', 'id'=>'user_edit_form',  'method' =>'POST'))}}
         

         <input type="hidden" name="id" id="user_id">
         
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control rl" name="username" required />
                  </div>

                  <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control rl" name="email" data-parsley-trigger="change" required />

                  </div>
                  
                  
    
             <div class="mb-3">
                <label for="status">Status</label>
  
                         <?php

                         $status =[
                         0=>'Inactive',
                         1=>'Active'
                       ]

                          ?>
                 {!! Form::select('status', $status, null, ['class' => 'form-control rl', 'id' =>'status_data' ]) !!}
             
              </div>
                                   
                                         
                 
                                                                     
         
       </article>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Update</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
    </div> 
    {{ Form::close() }}
    </div>
   </div>
  </div>
</div>
</section>


<!-- User_Delete Modal -->
<section>

<div class="modal fade" id="user_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        
      </div>
      
{{ Form::open(array('url' => 'delete_user', 'id'=>'user_delete_form', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="del_user_id">
        
        <button type="submit" class="btn btn-primary" >Delete</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
    
      </div>

    </div>
    {{ Form::close() }}
  </div>
 </div> 
</div>

</section>

<!-- User_Restore Modal -->
<section>

<div class="modal fade" id="user_restore_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Restore</h5>
        
      </div>
      
{{ Form::open(array('url' => 'restore_user', 'id'=>'user_restore_form', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="re_user_id">
        
        <button type="submit" class="btn btn-primary" >Restore</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
    
      </div>

    </div>
    {{ Form::close() }}
  </div>
 </div> 
</div>

</section>
@endsection

@section('scripts')


    <script type="text/javascript">

        $(document).ready(function (){

     window.csrfToken = '<?php echo csrf_token(); ?>';
     var postData = {};
     postData._token = window.csrfToken;
     var table = $('#data_table').DataTable({
         
        "processing":true,
        "serverSide":true,
        "lengthMenu":[5,10,25,50,100],
        "pagelength":25,
        "searching": true,
        "ajax":{
        "url": "{{URL::to('user_datatable')}}",
        "type":"POST",
        "data": function(d){
        $.extend(d, postData);
        var dt_params = $('#data_table').data('dt_params');
        if(dt_params){
         $.extend(d, dt_params);
        }
       }
      },
   "destroy":true,
   "columns": [
                {"data": "sl"},
                {"data": "username"},
                {"data": "email"},
                {"data": "type"},
                {"data": "status"},
                {"data": "action"},
            ]
       });

     // Update user
    table.on('click' , '.user_edit' , function(){
      var username = $(this).attr('username');
      var email = $(this).attr('email');
      var statuss = $(this).attr('user_status');
      var id = $(this).attr('href');
      $('#username').val(username);
      $('#status_data').val(statuss);
      $('#email').val(email);
      $('#user_id').val(id);

    });

    // User Delete
    table.on('click' , '.user_delete' , function(){
      var id = $(this).attr('href');
            $('#del_user_id').val(id);
          });

    // User Restore
    table.on('click' , '.user_restore' , function(){
      var id = $(this).attr('href');
            $('#re_user_id').val(id);
          });
     });


        
    </script>
@endsection
