@extends('layouts.admin')

@section('content')
    
<section>
  <div class="row">
    <div class="col-lg-6 col-md-3 col-sm-12">
          <h2>Product Setting</h2>
    </div>
  </div>
    <div class="row"> 
              <div class="col-lg-6 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Brand List</h2>
                    <ul class="nav float-right">
                      <button style="background: #4ed2c5; border: none;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_brand_modal"><i class="fa fa-plus"></i> Add Brand</button>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="table-responsive">
                            
                        <table id="brand_data_table" class="table table-bordered table-striped" style="width:100%">
                      <thead style="color:#fff;  background: #4ed2c5;">
                        <tr>
                          
               
                          <th>SL</th>
                          <th>Brand</th>
                          <th>Status</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>

                    
                    </table>
                  
            </div>
          </div>
        </div>


              <div class="col-lg-6 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Unit List</h2>
                    <ul class="nav float-right">
                      <button style="background: #4ed2c5; border: none;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_unit_modal"><i class="fa fa-plus"></i> Add Unit</button>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  
                      <div class="table-responsive">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                        <table id="unit_data_table" class="table table-striped table-bordered bulk_action" style="width:100%">
                      <thead style="color:#fff;  background: #4ed2c5;">
                        <tr>
                          
               
                          <th>SL</th>
                          <th>Unit</th>
                          <th>Status</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                    </table>
                  </div>
                  
              </div>
            </div>
          </div>
        </div>

      </div>
</section>

<section>
    <div class="row"> 
              <div class="col-lg-6 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Category List</h2>
                    <ul class="nav float-right">
                      <button style="background: #4ed2c5; border: none;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_category_modal"><i class="fa fa-plus"></i> Add Category</button>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="table-responsive">
                            
                        <table id="category_data_table" class="table table-bordered table-striped" style="width:100%">
                      <thead style="color:#fff;  background: #4ed2c5;">
                        <tr>
                          
               
                          <th>SL</th>
                          <th>Category</th>
                          <th>Countable</th>
                          <th>Status</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>

                    
                    </table>
                  
            </div>
          </div>
        </div>


      </div>
</section>



<!-- BRAND ADD Modal -->
<section>

<div class="modal fade" id="add_brand_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
        
      </div>
      <div class="modal-body">
        {{ Form::open(array('url' => 'add_brand', 'id'=>'add_brand', 'autocomplete'=>'off', 'method' =>'POST'))}}
                    <label for="fullname">Brand Name</label>
                    <input type="text" id="name" class="form-control rl mb-2" name="name" required />
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Save</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
</section>

<!-- BRAND EDIT Modal -->
<section>

<div class="modal fade" id="brand_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'edit_brand',  'method' =>'POST'))}}
         

         <input type="hidden" name="brand_id" id="brand_id">
         
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="brand_name" class="form-control rl" name="brand_name" required />
                  </div>
                  
                  
    
             <div class="mb-3">
                <label for="status">Status</label>
  
                         <?php

                         $status =[
                         0=>'Inactive',
                         1=>'Active'
                       ]

                          ?>
                 {!! Form::select('brand_status', $status, null, ['class' => 'form-control rl', 'id' =>'brand_status' ]) !!}
             
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


<!-- BRAND_Delete Modal -->
<section>

<div class="modal fade" id="user_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
        
      </div>
      
{{ Form::open(array('url' => 'delete_brand', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="del_brand_id">
        
        <button type="submit" class="btn btn-primary" >Delete</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
    
      </div>

    </div>
    {{ Form::close() }}
  </div>
 </div> 
</div>

</section>

<!-- BRAND_Restore Modal -->
<section>

<div class="modal fade" id="brand_restore_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Restore</h5>
        
      </div>
      
{{ Form::open(array('url' => 'restore_brand', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="re_brand_id">
        
        <button type="submit" class="btn btn-primary" >Restore</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
    
      </div>

    </div>
    {{ Form::close() }}
  </div>
 </div> 
</div>

</section>

<section>

<!--Add Unit Modal-->
<div class="modal fade" id="add_unit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Unit</h5>
        
      </div>
      <div class="modal-body">
        {{ Form::open(array('url' => 'add_unit', 'autocomplete'=>'off', 'method' =>'POST'))}}
                    <label for="fullname">Unit Name</label>
                    <input type="text" class="form-control mb-2 rl" name="unit_name" required />
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Save</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
</section>

<!-- Unit EDIT Modal -->
<section>

<div class="modal fade" id="unit_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'edit_unit',  'method' =>'POST'))}}
         

         <input type="hidden" name="unit_id" id="unit_id">
         
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="unit_name" class="form-control rl" name="unit_name" required />
                  </div>
                  
                  
    
             <div class="mb-3">
                <label for="status">Status</label>
  
                         <?php

                         $status =[
                         0=>'Inactive',
                         1=>'Active'
                       ]

                          ?>
                 {!! Form::select('unit_status', $status, null, ['class' => 'form-control rl', 'id' =>'unit_status' ]) !!}
             
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


<!-- Unit_Delete Modal -->
<section>

<div class="modal fade" id="unit_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
        
      </div>
      
{{ Form::open(array('url' => 'delete_unit', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="del_unit_id">
        
        <button type="submit" class="btn btn-primary" >Delete</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
    
      </div>

    </div>
    {{ Form::close() }}
  </div>
 </div> 
</div>

</section>

<!-- Unit_Restore Modal -->
<section>

<div class="modal fade" id="unit_restore_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Restore</h5>
        
      </div>
      
{{ Form::open(array('url' => 'restore_unit', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="re_unit_id">
        
        <button type="submit" class="btn btn-primary" >Restore</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
    
      </div>

    </div>
    {{ Form::close() }}
  </div>
 </div> 
</div>

</section>

<!-- Category ADD Modal -->
<section>

<div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        
      </div>
      <div class="modal-body">
        {{ Form::open(array('url' => 'add_category', 'autocomplete'=>'off', 'method' =>'POST'))}}
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control mb-2 rl" name="category_name" required />
                    <div>
                    <label>Countable</label>
                    </div>
                      <input type="checkbox" class="rl" name="is_countable" data-toggle="toggle"checked />
                    </div>
                    
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Save</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
</section>

<!-- Category EDIT Modal -->
<section>

<div class="modal fade" id="category_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'edit_category',  'method' =>'POST'))}}
         

         <input type="hidden" name="category_id" id="category_id">
         
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="category_name" class="form-control rl" name="category_name" required />
                  </div>

                  
                <div class="mb-3">
                <label for="status">Countable</label>
  
                         <?php

                         $countable =[
                         0=>'No',
                         1=>'Yes'
                       ]

                          ?>
                 {!! Form::select('is_countable', $countable, null, ['class' => 'form-control rl', 'id' =>'countable' ]) !!}
             
              </div>

              <div class="mb-3">
                <label for="status">Status</label>
  
                         <?php

                         $status =[
                         0=>'Inactive',
                         1=>'Active'
                       ]

                          ?>
                 {!! Form::select('category_status', $status, null, ['class' => 'form-control rl', 'id' =>'category_status' ]) !!}
             
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


<!-- Category_Delete Modal -->
<section>

<div class="modal fade" id="category_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
        
      </div>
      
{{ Form::open(array('url' => 'delete_category', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="del_category_id">
        
        <button type="submit" class="btn btn-primary" >Delete</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
    
      </div>

    </div>
    {{ Form::close() }}
  </div>
 </div> 
</div>

</section>

<!-- Category_Restore Modal -->
<section>

<div class="modal fade" id="category_restore_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Restore</h5>
        
      </div>
      
{{ Form::open(array('url' => 'restore_category', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="re_category_id">
        
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


        // Brand DataTable
         window.csrfToken = '<?php echo csrf_token(); ?>';
         var postData = {};
         postData._token = window.csrfToken;
         var table = $('#brand_data_table').DataTable({
        "scrollX": true,
        "processing":true,
        "serverSide":true,
        "lengthMenu":[5,10,25,50,100],
        "pagelength":25,
        "ajax":{
        "url": "{{URL::to('brand_datatable')}}",
        "type":"POST",
        "data": function(d){
        $.extend(d, postData);
        var dt_params = $('#brand_data_table').data('dt_params');
        if(dt_params){
         $.extend(d, dt_params);
        }
       }
      },
   "destroy":true,
   "columns": [
                
                {"data": "sl"},
                {"data": "name"},
                {"data": "status"},
                {"data": "action"},
            ]
       });

  // Update Brand
    table.on('click' , '.brand_edit' , function(){
      var brand_name = $(this).attr('brand_name');
      var brand_status = $(this).attr('brand_status');
      var id = $(this).attr('href');
      $('#brand_name').val(brand_name);
      $('#brand_status').val(brand_status);
      $('#brand_id').val(id);

    });

    // Brand Delete
    table.on('click' , '.brand_delete' , function(){
      var id = $(this).attr('href');
            $('#del_brand_id').val(id);
          });

    // Brand Restore
    table.on('click' , '.brand_restore' , function(){
      var id = $(this).attr('href');
            $('#re_brand_id').val(id);
          });

    // Unit DataTable
    window.csrfToken = '<?php echo csrf_token(); ?>';
         var postData = {};
         postData._token = window.csrfToken;
         var table = $('#unit_data_table').DataTable({
        "scrollX": true,
        "processing":true,
        "serverSide":true,
        "lengthMenu":[5,10,25,50,100],
        "pagelength":25,
        "ajax":{
        "url": "{{URL::to('unit_datatable')}}",
        "type":"POST",
        "data": function(d){
        $.extend(d, postData);
        var dt_params = $('#unit_data_table').data('dt_params');
        if(dt_params){
         $.extend(d, dt_params);
        }
       }
      },
   "destroy":true,
   "columns": [
                
                {"data": "sl"},
                {"data": "name"},
                {"data": "status"},
                {"data": "action"},
            ]
       });

    // Update Unit
    table.on('click' , '.unit_edit' , function(){
      var unit_name = $(this).attr('unit_name');
      var unit_status = $(this).attr('unit_status');
      var id = $(this).attr('href');
      $('#unit_name').val(unit_name);
      $('#unit_status').val(unit_status);
      $('#unit_id').val(id);

    });

    // Unit Delete
    table.on('click' , '.unit_delete' , function(){
      var id = $(this).attr('href');
            $('#del_unit_id').val(id);
          });

    // Unit Restore
    table.on('click' , '.unit_restore' , function(){
      var id = $(this).attr('href');
            $('#re_unit_id').val(id);
          });

    // Category DataTable
         window.csrfToken = '<?php echo csrf_token(); ?>';
         var postData = {};
         postData._token = window.csrfToken;
         var table = $('#category_data_table').DataTable({
        "scrollX": true,
        "processing":true,
        "serverSide":true,
        "lengthMenu":[5,10,25,50,100],
        "pagelength":25,
        "ajax":{
        "url": "{{URL::to('category_datatable')}}",
        "type":"POST",
        "data": function(d){
        $.extend(d, postData);
        var dt_params = $('#category_data_table').data('dt_params');
        if(dt_params){
         $.extend(d, dt_params);
        }
       }
      },
   "destroy":true,
   "columns": [
                
                {"data": "sl"},
                {"data": "name"},
                {"data": "countable"},
                {"data": "status"},
                {"data": "action"},
            ]
       });

         // Update Category
    table.on('click' , '.category_edit' , function(){
      var category_name = $(this).attr('category_name');
      var category_status = $(this).attr('category_status');
      var countable = $(this).attr('countable');
      var id = $(this).attr('href');
      $('#category_name').val(category_name);
      $('#category_status').val(category_status);
      $('#countable').val(countable);
      $('#category_id').val(id);

    });

    // Unit Category
    table.on('click' , '.category_delete' , function(){
      var id = $(this).attr('href');
            $('#del_category_id').val(id);
          });

    // Unit Category
    table.on('click' , '.category_restore' , function(){
      var id = $(this).attr('href');
            $('#re_category_id').val(id);
          });
    
     });
     
    </script>


@endsection