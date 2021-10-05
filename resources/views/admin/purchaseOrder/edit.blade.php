@extends('layouts.admin')

@section('content')
 
<div class="main-content">
      <div class="row">
        <div class="col-12">
  <div class="card">
    <h4 class="card-title m-4">Purchase Order</h4>

    {{ Form::open(array('url' => 'update_purchase' , 'method' => 'POST')) }}
          <div class="card-body">
        <div class="form-row">
          

        </div>
        <input type="hidden" name="vendor_id" value="{{$order->vendor_id}}">
        <input type="hidden" name="purchase_date" value="{{$order->purchase_date}}">
        <input type="hidden" name="total_amount" id="total_amount">
        <input type="hidden" name="total_item" id="total_item">
        
        <!-- <div class="form-row">
          <div class="form-group col-md-6">
            <label for="Product">Product</label>
            <input type="text" id="changeProduct" class="form-control rl" placeholder="Write product">
          </div>
          <ul class="list-group" id="result"></ul>
          <br>
      </div> -->
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="Product">Product</label>
            
            {!! Form::select('', $product, null, ['class' => 'form-control rl' , 'id' =>'changeProduct' , 'placeholder' => 'Select Product' ]) !!}
          </div>
          

          
      </div>
      <button style="background: #4ed2c5; border: none;" prod_id="" id="_add" type="button" class="btn btn-primary mx-auto">Add</button>
      <hr>

      <div class="row">
        <table class="table table-bordered">
          <thead>
            <tr style="background: #4ed2c5; color: #fff;">
              <th>Product</th>
              <th>Rate</th>
              <th>Qyt</th>
              <th>Sub Total</th>
              <th style="width:50px">
                <i class="fa fa-trash"></i>
              </th>
            </tr>
          </thead>

          <tbody id="table_body">
            @foreach($order->purchase_order_product as $pod)
            <tr>
                                    
                                    <td>
                                        {{$pod->product->name}}
                                        <input type="hidden" value="{{$pod->product_id}}" name="product[]"
                                               class="product">
                                        <input type="hidden" value="{{$pod->product_id}}" name="purchase_item_id[]">
                                    </td>
                                    <td style="width:150px">
                                        <input type="text" value="{{$pod->price / $pod->qty}}" class="form-control rate"
                                               name="rate[]">
                                    </td>
                                    <td style="width:150px">
                                        <input type="number" value="{{$pod->qty}}" class="form-control sale_qyt"
                                               name="qyt[]">
                                    </td>
                                    <td>
                                        <strong><span class="sub_total"></span>{{$pod->price}} Tk</strong>
                                        <input type="hidden" name="subtotal_input[]" class="subtotal_input"
                                               value="{{$pod->price}}">
                                    </td>
                                    <td>
                                        <a href="#" class="remove"><i
                                                class="fa fa-undo"></i></a>
                                    </td>
                                </tr>
                       
                @endforeach
          </tbody>

          <tfoot class="bg-light">
            <tr>
              <td colspan="1"></td>
              <td>
                <span>Total Items: </span> <span id="total_items">0</span>
              </td>
              <td>
                <span>Total Qyt: </span> <span id="total_qyt">0</span>
              </td>
              <td colspan="2">
                <strong>Grand Total: <span id="total">{{$order->total_price}}</span> Tk</strong>
              </td>
            </tr>
          </tfoot>

        </table>

      </div>

      <div class="form-row">
        <div class="form-group col-md-12 mt-4">
          <button style="background: #4ed2c5; border: none;" type="submit" class="btn btn-primary mx-auto">
            Update
          </button>
        </div>
      </div>
  </div>


{{ Form::close() }}
</div>
</div>
</div>
</div>




    



@endsection

@section('scripts')


<script type="text/javascript">
  $(document).ready(function (){
    $('#datepicker').datepicker();

    $('#changeProduct').on('change', function(){
      var id = $(this).val();
      $('#_add').attr('prod_id', id);
      return false;
    });

    // $('#changeProduct').on('keyup',function(){
    //   var value =$(this).val();
    //   var expression = new RegExp(value, 'i')
    //   $.ajax({
    //   type : 'post',
    //   url : '{{URL::to('search')}}',
    //   data:{'search':value, 
    //         '_token': '{{ csrf_token() }}',},
    //   success:function(data){
    //   $.each(data, function(key, value){
    //     if(value.name.search(expression) != -1)
    //     {
    //       $('#result').append('<li class="list-group-item">'+value.name+'</li>')
    //     }
    //     else{
    //       $('#result').append('<li class="list-group-item">'+value.name+'</li>')
    //     }
    //   })
    //   }
    //   });
    //   });
 
  $('#_add').click(function() {

            
            var pId = $('#changeProduct').val();
            if(pId == 0){
              toastr.warning('Please Select a Product');
            }
            else{

            $.ajax({
                url: "{{ URL::to('get-product-info') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'pId': pId,
                    '_token': '{{ csrf_token() }}',
                },
                success: function (res) {
                    
                    if (res['product'] != 0) {

                      var product = res['product'];

                       var html = `<tr>
                                    
                                    <td>
                                    ${product.name}
                                    <input type="hidden" value="${product.id}" name="v_product[]" class="product">
                                    <input type="hidden" value="${product.name}" name="update_purchase[]">
                                    
                                    </td>
                                    <td style="width:150px">
                                      <input type="text" value="0" class="form-control rate" name="v_rate[]">
                                    </td>
                                    <td style="width:150px">
                                      <input type="number" value="1" class="form-control sale_qyt" name="v_qyt[]">
                                    </td>
                                    <td>
                                      <strong><span class="sub_total">0</span> Tk</strong>
                                      <input type="hidden" name="v_subtotal_input[]" class="subtotal_input" value="">
                                    </td>
                                    <td>
                                      <a href="#" class="remove">
                                        <i class="fa fa-trash"></i>
                                      </a>
                                    </td>
                                  </tr>`;
                                  

                    // Duplicate check
                    let tableBody = document.querySelector('#table_body');
                    let products = tableBody.querySelectorAll('.product');
                    let isDuplicate = false;
                    products.forEach(function (term) {
                      console.log(term);
                      console.log(pId);
                        if (pId == term.value) {
                            isDuplicate = true;
                        }
                       });


                    if (isDuplicate == true){
                        toastr.warning('Please Increase the quantity');
                    } else {
                       $('#table_body').append(html);
                    }



                       

                       updateTotal();
                       updateTotalQyt();
                       itemUpdate();
                       
            
                       
                    }

                }

            });
        }});



  // Remove ROW
    $(document).on('click', '.remove', function () {
        $(this).parents('tr').remove();
        toastr.success('Deleted');
        updateTotal();
        updateTotalQyt();
        itemUpdate();
    });

    // change rate
    $(document).on('change', '.rate', function () {
        let subTotal = $(this).val() * $(this).parents('tr').find('.sale_qyt').val();
        $(this).parents('tr').children('td').find('.sub_total').text(subTotal);
        $(this).parents('tr').children('td').find('.subtotal_input').val(subTotal);
        updateTotalQyt();
        updateTotal();
    });

    // change qyt
    $(document).on('change', '.sale_qyt', function () {
        // let rate = $(this).parents('tr').find('.rate').val();
        let subTotal = $(this).val() * $(this).parents('tr').find('.rate').val();
        $(this).parents('tr').children('td').find('.sub_total').text(subTotal);
        $(this).parents('tr').children('td').find('.subtotal_input').val(subTotal);
        updateTotalQyt();
        updateTotal();

    });


    //  Update item function
    function itemUpdate() {
        let totalItems = 0
        $(".sale_qyt").each((i, obj) => {
            totalItems += 1;
        });
        $("#total_items").text(totalItems);
        $("#total_item").val(totalItems);

    }

    // update total qyt function
    function updateTotalQyt() {
        let totalQyt = 0;
        $(".sale_qyt").each((i, obj) => {
            let qyt_val = parseInt(obj.value);
            totalQyt += qyt_val;
        });
        $("#total_qyt").text(totalQyt);
    }

    

    // update total amount
    function updateTotal() {
        let totalAmount = 0;
        $(".sub_total").each((i, obj) => {
            let subtotal = obj.innerHTML;
            totalAmount += parseFloat(subtotal);
        });
        $("#total").text(totalAmount)
        $("#total_amount").val(totalAmount)
    }

    });

  

</script>
@endsection