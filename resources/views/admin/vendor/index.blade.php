@extends('layouts.admin')

@section('content')
 
  <div id="main-content">
    <div class="container-fluid">
        <div class="block-header mb-2">
            <div class="row">
                <div class="col-lg-6 col-md-3 col-sm-12">
                    <h2>Vendor Lists</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    
                        <button data-toggle="modal" data-target="#vendor_add_modal" class="btn btn-primary pull-right"><i class="icon-plus"></i> Add New Vendor</button>
                    
                </div>
                
                
            </div>
        </div>
      <div class="row clearfix">
        <div class="col-lg-12">
        <div class="card p-3">
        <div class="table-responsive">
          <table id="vendor_data_table" class="table table-bordered table-striped">
          <thead style="color:#fff; background: linear-gradient(to left, #6190e8, #a7bfe8);">
            <tr>
                <th>SL</th>
                <th>Vendor Name</th>
                <th>Address</th>
                <th>Contact Person</th>
                <th>Phone</th>
                <th>Purchase Amount</th>
                <th>Status</th>
                <th style="width: 90px;">Action</th>
            </tr>
          </thead>
        
          <tfoot>
            <tr>
                <th>SL</th>
                <th>Vendor Name</th>
                <th>Address</th>
                <th>Contact Person</th>
                <th>Phone</th>
                <th>Purchase Amount</th>
                <th>Status</th>
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

<!--Vendor_Add  Modal -->
<section>

<div class="modal fade" id="vendor_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Vendor</h5>
        
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'store_vendor','autocomplete'=>'off', 'method' =>'POST'))}}

                  <div class="mb-3">
                    <label for="name">Vendor Name</label>
                    <input type="text" class="form-control" name="name" required />
                  </div>
                  <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text"  class="form-control" name="address" required />
                  </div>
                  <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="number"  class="form-control" name="phone" required />
                  </div>
                  <div class="mb-3">
                    <label for="contact_person">Contact Person</label>
                    <input type="text" class="form-control" name="contact_person" required />
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

<!-- Vendor_Edit Modal -->
<section>

<div class="modal fade" id="vendor_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'edit_vendor',  'method' =>'POST'))}}
         

         <input type="hidden" name="id" id="vendor_id">
         
                <div class="mb-3">
                    <label for="name">Vendor Name</label>
                    <input type="text" class="form-control" name="name" id="name" required />
                  </div>
                  <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text"  class="form-control" name="address" id="address" required />
                  </div>
                  <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="number"  class="form-control" name="phone" id="phone" required />
                  </div>
                  <div class="mb-3">
                    <label for="contact_person">Contact Person</label>
                    <input type="text" class="form-control" name="contact_person" id="contact_person" required />
                  </div>
                  
                  
    
             <div class="mb-3">
                <label for="status">Status</label>
  
                         <?php

                         $status =[
                         0=>'Inactive',
                         1=>'Active'
                       ]

                          ?>
                 {!! Form::select('status', $status, null, ['class' => 'form-control', 'id' =>'status_data' ]) !!}
             
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

<!-- Vendor_Delete Modal -->
<section>

<div class="modal fade" id="vendor_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
        
      </div>
      
{{ Form::open(array('url' => 'delete_vendor', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="del_vendor_id">
        
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

<div class="modal fade" id="vendor_restore_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Restore</h5>
        
      </div>
      
{{ Form::open(array('url' => 'restore_vendor', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="re_vendor_id">
        
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

        window.csrfToken = '<?php echo csrf_token(); ?>';

        var postData = {};
        postData._token = window.csrfToken;

        var table = $('#vendor_data_table').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [5, 10, 25, 50],
            "pageLength": 25,
            "ajax": {

                "url": "{{URL::to('vendor_datatable')}}",
                "type": "POST",
                "data": function (d) {
                    $.extend(d, postData);
                    var dt_params = $('#vendor_data_table').data('dt_params');
                    if (dt_params) {
                        $.extend(d, dt_params);
                    }
                }
            },
            "destroy": true,
            "columns": [
                {"data": "sl"},
                {"data": "name"},
                {"data": "address"},
                {"data": "contact_person"},
                {"data": "phone"},
                {"data": "purchase_amount"},
                {"data": "status"},
                {"data": "action"}
            ]
        });

   // Update Vendor
    table.on('click' , '.vendor_edit' , function(){
      var name = $(this).attr('name');
      var address = $(this).attr('address');
      var phone = $(this).attr('phone');
      var contact_person = $(this).attr('contact_person');
      var statuss = $(this).attr('status');
      var id = $(this).attr('href');
      $('#name').val(name);
      $('#address').val(address);
      $('#phone').val(phone);
      $('#contact_person').val(contact_person);
      $('#status_data').val(statuss);
      $('#vendor_id').val(id);

    });

    // Vendor Delete
    table.on('click' , '.vendor_delete' , function(){
      var id = $(this).attr('href');
            $('#del_vendor_id').val(id);
          });

    // User Restore
    table.on('click' , '.vendor_restore' , function(){
      var id = $(this).attr('href');
            $('#re_vendor_id').val(id);
          });
        });
</script>
@endsection