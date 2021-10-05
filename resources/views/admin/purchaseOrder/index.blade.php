@extends('layouts.admin')

@section('styles')

@endsection
@section('content')

<section>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header mb-2">
            <div class="row">
                <div class="col-lg-6 col-md-3 col-sm-12">
                    <h2>Purchase Order List</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    
                        <button style="background: #4ed2c5; border: none;" data-toggle="modal" data-target="#product_add_modal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Create New Purchase</button>
                    
                </div>
                
                
            </div>
        </div>
      <div class="row clearfix">
        <div class="col-lg-12">
        <div class="card p-3">
        <div class="table-responsive">
          <table id="purchase_data_table" class="table table-bordered table-striped">
          <thead style="color:#fff; background: #4ed2c5;">
            <tr>
                <th>Order ID</th>
                <th>Vendor</th>
                <th>Total Amount</th>
                <th>Purchase Date</th>
                <th style="width: 90px;">Action</th>
            </tr>
          </thead>
        
          <tfoot>
            <tr>
                <th>Order ID</th>
                <th>Vendor</th>
                <th>Total Amount</th>
                <th>Purchase Date</th>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Create Purchase</h5>
        
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'pass_data','autocomplete'=>'off', 'method' =>'POST'))}}

                  <div class="form-group col-md-6">
                    <label for="unit_type">Vendor</label>
                    <div>
                      {!! Form::select('vendor_id', $vendor, null, ['class' => 'form-control rl' , 'placeholder'=>'Select Vendor' , 'required' ]) !!}
                    </div>
                    

             
                  </div>
                  
                  
                  
                <div class="form-group col-md-6">
                  <label for="">Purchase Date</label>
                  <input type="text" id="datepicker" class="form-control rl  date"
                    data-provide="datepicker" name="purchase_date" data-date-today-highlight="true" required data-date-format="yyyy-mm-dd">
                </div>
                  
      
       </article>
     </div> 

     <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
        <button type="submit" class="btn btn-primary _next" >Next</button>
        
    </div>
     {{ Form::close() }}
    </div>
   </div>
  </div>
</div>
</section> 






 
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function (){
    $('#datepicker').datepicker();


        // Purchase DataTable
         window.csrfToken = '<?php echo csrf_token(); ?>';
         var postData = {};
         postData._token = window.csrfToken;
         var table = $('#purchase_data_table').DataTable({
        "processing":true,
        "serverSide":true,
        "lengthMenu":[5,10,25,50,100],
        "pagelength":25,
        "ajax":{
        "url": "{{URL::to('purchase_datatable')}}",
        "type":"POST",
        "data": function(d){
        $.extend(d, postData);
        var dt_params = $('#purchase_data_table').data('dt_params');
        if(dt_params){
         $.extend(d, dt_params);
        }
       }
      },
   "destroy":true,
   "columns": [
                
                {"data": "sl"},
                {"data": "vendor"},
                {"data": "price"},
                {"data": "date"},
                {"data": "action"},
            ]
       });
  });
</script>
@endsection