@extends('admin.layouts.app')
@section('title','Create Purchase')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('purchases.index')}}" class="text-primary hover:underline">Purchase</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Create Purchase</span>
      </li>
   </ul>
</div>
      <div class="animate__animated p-6" :class="[$store.app.animation]">
         <!-- start main content section -->
         <div x-data="rangeSearch">
            <div class="panel">
               <!-- browser default -->
            
                <!--  <form class="space-y-5" @submit.prevent="submitForm5()">-->
				
				  <form class="space-y-5" action="{{route('purchases.store')}}" method="Post">
				  @csrf
                     <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-5">
                        <div>
                           <label for="browserZip">Date</label>
                           <input id="gridEmail" type="date" name="purchase_date" value="" class="form-input" required />
                           <!-- <input id="browserZip" type="text" placeholder="Enter Series" x-model="form5.zip" class="form-input" required /> -->
                        </div>
                        <div class="">
                           <label for="browserCity">Seller Name</label>
                           <select class="form-select text-white-dark" id="seller_id" name="seller_id[]" onchange="sellerProductData(this);" required="required" />
                              <option value="">Select Seller Name</option>
							  
                              @foreach($sellerData as $seller)
                              <option value="{{$seller->id}}">{{($seller->first_name.' '.$seller->last_name)}}</option>
							  @endforeach
							  
                           </select>
                        </div>
                        <div class="">
                           <label for="warehouseName">Warehouse</label>
						   
                           <input id="warehouseName" type="text" name="warehouse_name" placeholder="Enter Warehouse Name" class="form-input" required="required"/>
                        </div>
                        <!-- On click of this button new row will be added in the table -->
                        <div class="flex items-center justify-end mt-7">
                           <button type="button" class="btn btn-primary" onclick="InsertNewRow ();">Add More Product</button>
                        </div>
                     </div>
                  
           
               <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns p-5">
                 
				 <input id="current_position" type="hidden" name="" value="0">
				 <input id="purchase_subtotal" type="hidden" name="purchase_subtotal" value="">
				 <input id="purchase_service_fee" type="hidden" name="purchase_service_fee" value="">
				 <input id="purchase_final_total" type="hidden" name="purchase_final_total" value="">

				 <table class="table" id="table">
                     <thead>
                        <tr>
                           <!-- <th scope="col"> Action</th> -->
                           <th scope="col">Sr.No.</th>
                           <th scope="col">Product Id</th>
                           <th scope="col">Product Name</th>
                           <th scope="col">Quantity</th>
                           <th scope="col">Rate</th>
                           <!-- <th scope="col">Image</th> -->
                           <th scope="col">Total Amount</th>
                           <th scope="col">Product Image</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <!-- <td>
                              <input type="checkbox" class="form-checkbox mt-1" :id="'chk' + 1" :value="(1)" x-model.number="selectedRows" id="chk1" value="1">
                              </td> -->
                           <td scope="row">1</td>
                           <td>
                             <select class="form-select text-white-dark productID" id="productID_position_0" onchange="getProductData('get_product_name','0',this);" name="product_id[]" style="width: 124px;">
                                <option value="">Product Id</option>
                              </select>
                           </td>
                           <td>
                           <select class="form-select text-white-dark product_name" id="product_name_position_0" name="product_name[]" style="width: 140px;">
                          
						       <option value="">Product Name</option>
							   
								 {{--	
								 <option value="" class="product_nane" >Product Name</option>
								@foreach($productName as $pname)
								<option value="{{$pname->id}}">{{$pname->product_name}}</option>
								 @endforeach  
								 --}}
                                 
                              </select>
                           </td>
                           <td>
                              <input type="text" name="product_quantity[]" placeholder="Quantity" onkeyup="calculateProdTotal('0',this);"  id="product_quantity_position_0" class="form-input product_quantity" />
                           </td>
                           <td>
                              <input type="text" name="product_price[]" placeholder="Rate" id="product_price_position_0" class="form-input product_price" />
                           </td>
                           <td>
                              <!-- Total Amount Will Update Autoamatically -->
                              <input type="text"  class="form-input total_product_price" name="total_product_price[]" id="total_product_price_position_0"  placeholder="Total">
                              <!-- <input id="gridCity" type="text" class="form-input" placeholder="Enter Total" /> -->
                           </td>
                           <td>
                              <div class="flex items-center font-semibold">
                                 <div class="p-0.5 bg-white-dark/30 rounded-full w-max ltr:mr-2 rtl:ml-2">
                                    <img class="h-8 w-8 rounded-full object-cover" id="product_img_position_0" src="{{url('public/admin/assets/images/profile-9.jpeg')}}" />
                                 </div>
                              </div>
                           </td>
                        </tr>
                        
                     </tbody>
                  </table>
                  <div class="flex justify-end px-4">
                     <div class="w-full md:w-80 font-semibold p-5">
                        <div class="flex items-center justify-between py-2">
                           <span>Sub Total :</span>
                           <span id="sub_total"> ₹0.00</span>
                        </div>
                        <!--<div class="flex items-center justify-between py-2">
                           <span>Platform Fee :</span>
                           <span id="ser_fee">- ₹0.00</span>
                        </div>-->
                        <div class="flex items-center justify-between font-bold py-4 border-t dark:border-t-dark border-dashed">
                           <span>Total :</span>
                           <span id="total_pro_price"> ₹0.00</span>
                        </div>
                        <!-- <table>                                <tr>
                           <td><input type="number" id="input1"><br><br></td>
                           <td><input type="number" id="input2"><br><br></td>
                           </tr>
                           </table>
                           <label for="input1">Enter value 1:</label>
                           <label for="input2">Enter value 2:</label> -->
                     </div>
                  </div>
                  <div class="text-rt">
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
               </div>
			   </form>
			  
            </div>
         </div>
      </div>
  
@endsection
@push('script')

<!-- 16-02-2024  -->

<script>

  function sellerProductData(element){
  
     var seller_product_id = element.value;
	  
	 // alert(seller_product_id);
	  
	  // var product_id   = $('#seller_id').text('');  
	   
     var token = "{{ csrf_token() }}";

     var url = "{{ route('get_purchase_product_data') }}";
	 
       $.ajax({
         url:url,
         type: 'POST',
         data: { _token :token,seller_id:seller_product_id },
       
	     success:function(result){
    
         console.log(result);    
     
       //  var product_name  = result.product_name.product_name;
	
       //  $('#product_name ').val(product_name );
	   
	      if(result.purchaseProductData.length > 0){
   
          $('.productID').html('');
          
          
          $('.productID').append('<option value="">Product ID</option>');
		  
          $.each(result.purchaseProductData, function(key, value) {
          
		  
		  //console.log(key); 
		  //console.log(value); 
		  
          $('.productID').append('<option value="'+value.id+'">PID00'+value.id+'</option>');
		  
        }); 
   
        }
	   
      }
		 
    });
}


  function getProductData(action_for,position,element){
  
     var product_id = element.value;
	  
	  //alert(seller_product_id);
	  
	  // var product_id   = $('#seller_id').text('');  
	   
     var token = "{{ csrf_token() }}";

     var url = "{{ route('get_purchase_product_data') }}";
	 
       $.ajax({
         url:url,
         type: 'POST',
         data: { _token :token,product_id:product_id,action_for:action_for,position:position },
       
	     success:function(result){
    
         console.log(result);    
     
       //  var product_name  = result.product_name.product_name;
	
       //  $('#product_name ').val(product_name );
	   
	      if(result.purchaseProductData.length > 0){
   
          $('#product_name_position_'+result.position).html('');
          
          
        //  $('.productID').append('<option value="">Product ID</option>');
		  
          $.each(result.purchaseProductData, function(key, value) {
          
		  
		  //console.log(key); 
		  console.log(value); 
		  $('#product_name_position_'+result.position).append('<option value="'+value.id+'">'+value.product_name
+'</option>');

         
		  $('#product_price_position_'+result.position).val(value.seller_price);
		  $('#product_quantity_position_'+result.position).val('1');
		  $('#total_product_price_position_'+result.position).val(value.seller_price);
      //    $('.productID').append('<option value="'+value.id+'">PID00'+value.id+'</option>');
		  
          
           var product_photo = "{{asset('public/uploads/product/product_photo/')}}/"+value.product_photo;
		  
          $('#product_img_position_'+result.position).attr('src',product_photo);
         
       
          
        }); 
   
        }
	   
	   
	   
       
      }
		 
    });
}


</script>

<!-- 16-02-2024  -->

<script>
   var x = 2;
   
   function InsertNewRow() {
	   
	   var current_position = parseInt($('#current_position').val());
	   var next_position = 	(current_position+1); 
       $('#current_position').val(next_position);	
	   var get_prod = "onchange=getProductData('get_product_name','"+next_position+"',this);";
	   var change_qty = "onkeyup=calculateProdTotal('"+next_position+"',this);";
	   
       var table = document.getElementById("table");
       var row = table.insertRow(x);
       var cell1 = row.insertCell(0);
       var cell2 = row.insertCell(1);
       var cell3 = row.insertCell(2);
       var cell4 = row.insertCell(3);
       var cell5 = row.insertCell(4);
       var cell6 = row.insertCell(5);
       var cell7 = row.insertCell(6);
       cell1.innerHTML = '<p>' + x + '</p>';
       cell2.innerHTML = "<select  class='form-select text-white-dark productID' id='productID_position_"+next_position+"' name='product_id[]' "+get_prod+" > <option>Product ID</option> </select>";
       cell3.innerHTML = "<select  class='form-select text-white-dark product_name' id='product_name_position_"+next_position+"' name='product_name[]'> <option>Product Name</option> </select>";
       cell4.innerHTML = "<input type='text' placeholder='Quantity' class='form-input product_quantity' "+change_qty+" id='product_quantity_position_"+next_position+"' name='product_quantity[]' />";
       cell5.innerHTML = "<input type='text' placeholder='Rate' class='form-input product_price' id='product_price_position_"+next_position+"' name='product_price[]' />";
       cell6.innerHTML = "<input type='text' placeholder='Total' class='form-input total_product_price' id='total_product_price_position_"+next_position+"' name='total_product_price[]' />";
       cell7.innerHTML = "<img class='h-8 w-8 rounded-full object-cover' id='product_img_position_"+next_position+"' src={{asset('public/admin/assets/images/profile-9.jpeg')}}>";
       x++;
	   
	  var seller_product_id = $('#seller_id').val();

      var token = "{{ csrf_token() }}";

      var url = "{{ route('get_purchase_product_data') }}";
	 
       $.ajax({
         url:url,
         type: 'POST',
         data: { _token :token,seller_id:seller_product_id },
       
	     success:function(result){
	   
	      if(result.purchaseProductData.length > 0){
			  
		   var row_current_position = parseInt($('#current_position').val());
   
          $('#productID_position_'+row_current_position).html('');

          $('#productID_position_'+row_current_position).append('<option value="">Product ID</option>');
		  
          $.each(result.purchaseProductData, function(key, value) {

          $('#productID_position_'+row_current_position).append('<option value="'+value.id+'">PID00'+value.id+'</option>');
          
        }); 
   
        }

      }
		 
    });
	
   }
 
 function calculateProdTotal(position,element){
	
	var prod_qty = parseFloat(element.value);
	var rate = parseFloat($('#product_price_position_'+position).val());
	var totalPrice = prod_qty*rate;
	
	$('#total_product_price_position_'+position).val(totalPrice);
	
	var sum = 0;
	$('.total_product_price').each(function(){
		sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
	});
	
	var sub_total = Math.round(sum);
  //var ser_fee   = Math.round(sub_total*2/100);
	var total_pro_price = Math.round(sub_total);
	
	$('#sub_total').text('₹ '+sub_total);
  // $('#ser_fee').text('- ₹ '+ser_fee);
	$('#total_pro_price').text('₹ '+total_pro_price);
	
    $('#purchase_subtotal').val(sub_total);
   // $('#purchase_service_fee').val(ser_fee);
    $('#purchase_final_total').val(total_pro_price);
	 
	 
	           

}

</script>

@endpush