@extends('layouts.admin')

@section('content')

<section>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header mb-2">
            <div class="row">
                <div class="col-lg-6 col-md-3 col-sm-12">
                    <h2>Product Lists</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    
                        <button style="background: #4ed2c5; border: none;" data-toggle="modal" data-target="#product_add_modal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Item</button>
                    
                </div>
                
                
            </div>
        </div>
      <div class="row clearfix">
        <div class="col-lg-12">
        <div class="card p-3">
        <div class="table-responsive">
          <table id="product_data_table" class="table table-bordered table-striped">
          <thead style="color:#fff; background: #4ed2c5;">
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Purchase Quantity</th>
                <th>Quantity In Stock</th>
                <th>Unit Type</th>
                <th>Total Purchase Amount</th>
                <th>Category</th>
                <th>Tag</th>
                <th style="width: 90px;">Action</th>
            </tr>
          </thead>
        
          <tfoot>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Purchase Quantity</th>
                <th>Quantity In Stock</th>
                <th>Unit Type</th>
                <th>Total Purchase Amount</th>
                <th>Category</th>
                <th>Tag</th>
                <th>Action</th>
            </tr>
          </tfoot>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>

<!--Vendor_Add  Modal -->
<section>

<div class="modal fade" id="product_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
        
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'store_product','autocomplete'=>'off', 'method' =>'POST'))}}

                  <div class="mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" id="product_name" class="form-control rl" name="name" required />
                  </div>
                  
                  <div class="mb-3">
                    <label for="address">Category</label>
                    	
               		  {!! Form::select('category_id', $category, null, ['class' => 'form-control rl' , 'placeholder'=>'Select Category' ]) !!}

             
                  </div>
                  
                  <div class="mb-3">
                    <label for="tag">Product Tag</label>
                    <input type="text" readonly  class="form-control" name="tag" id="product_tag" required />
                  </div>
                  <div class="mb-3">
                    <label for="unit_type">Unit Type</label>
                    	
               		  {!! Form::select('unit_type', $unit, null, ['class' => 'form-control rl' , 'placeholder'=>'Select Unit' ]) !!}

             
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

<!-- Product_Edit Modal -->
<section>

<div class="modal fade" id="product_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'edit_product',  'method' =>'POST'))}}
         

         <input type="hidden" name="id" id="product_id">
         
                <div class="mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" id="product_name_edit" class="form-control rl" name="product_name" required />
                  </div>
                  
                  <div class="mb-3">
                    <label for="address">Category</label>
                    	
               		  {!! Form::select('category_id', $category, null, ['class' => 'form-control rl' , 'id'=>'category_id' ]) !!}

             
                  </div>
                  
                  <div class="mb-3">
                    <label for="tag">Product Tag</label>
                    <input type="text" readonly  class="form-control" name="tag" id="product_tag_edit" required />
                  </div>
                  <div class="mb-3">
                    <label for="unit_type">Unit Type</label>
                    	
               		  {!! Form::select('unit_type', $unit, null, ['class' => 'form-control rl' , 'id'=>'unit_id' ]) !!}

             
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

<!-- Product_Delete Modal -->
<section>

<div class="modal fade" id="product_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
        
      </div>
      
{{ Form::open(array('url' => 'delete_product', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="del_product_id">
        
        <button type="submit" class="btn btn-primary" >Delete</button>
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
    
      </div>

    </div>
    {{ Form::close() }}
  </div>
 </div> 
</div>

</section>

<!-- Vendor_Restore Modal -->
<section>

<div class="modal fade" id="product_restore_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Restore</h5>
        
      </div>
      
{{ Form::open(array('url' => 'restore_product', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="re_product_id">
        
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

$(document).ready(function () {
        $('input[name = name]').change(function () {
            var value = $(this).val();
            var strValue = String(value);
          $('#product_tag').val(strValue);
        });

 // Data Table

        window.csrfToken = '<?php echo csrf_token(); ?>';

        var postData = {};
        postData._token = window.csrfToken;

        var table = $('#product_data_table').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [5, 10, 25, 50],
            "pageLength": 25,
            "ajax": {

                "url": "{{URL::to('product_datatable')}}",
                "type": "POST",
                "data": function (d) {
                    $.extend(d, postData);
                    var dt_params = $('#product_data_table').data('dt_params');
                    if (dt_params) {
                        $.extend(d, dt_params);
                    }
                }
            },
            "destroy": true,
            "columns": [
                {"data": "sl"},
                {"data": "name"},
                {"data": "purchase_quantity"},
                {"data": "quantity_in_stock"},
                {"data": "unit_type"},
                {"data": "total_purchase_amount"},
                {"data": "category"},
                {"data": "tag"},
                {"data": "action"}

            ]
        });

    // Update Product
    table.on('click' , '.product_edit' , function(){
      var name = $(this).attr('name');
      var category = $(this).attr('category');
      var unit_type = $(this).attr('unit_type');
      var tag = $(this).attr('tag');
      var statuss = $(this).attr('status');
      var id = $(this).attr('href');
      $('#product_name_edit').val(name);
      $('#category_id').val(category);
      $('#unit_id').val(unit_type);
      $('#status_data').val(statuss);
      $('#product_id').val(id);
      $('#product_tag_edit').val(tag);

    });

    $('input[name = product_name]').change(function () {
            var value = $(this).val();
            var strValue = String(value);
          $('#product_tag_edit').val(strValue);
        });

    // Product Delete
    table.on('click' , '.product_delete' , function(){
      var id = $(this).attr('href');
            $('#del_product_id').val(id);
          });

    // Product Restore
    table.on('click' , '.product_restore' , function(){
      var id = $(this).attr('href');
            $('#re_product_id').val(id);
          });

    
    });

</script>
@endsection