@extends('admin.layouts.app')
@section('title','Product Checkout')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('cart')}}" class="text-primary hover:underline">Cart</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Product Checkout</span>
      </li>
   </ul>
</div>
<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
			@if (count($errors) > 0)
	        <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
                   <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Whoops!</strong>There were some problems with your input.
		         <ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
			      </ul>
	
	
	             </span>

			</div>
		    @endif


<form action="{{route('buynow')}}" method="POST">
@csrf
<div class="panel">
   <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0" style=" margin-left: 470px;">Checkout </h5>
   <br>
   <br>
   

   
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-2">
   
    <div>
    <label for="state">Select Buyers/Seller</label>
        <select class="form-select" name="buyer_seller_emp_id" id="buyer_seller_emp_id" onchange="getBuyerSellerEmpData(this);" required="">
		  <option value="">Select Buyer/Seller</option>
			@foreach($employeeBuyerSellerData as $buyers_seller)
			 
			  <option value="{{$buyers_seller->id}}">{{$buyers_seller->email}} ({{ucfirst($buyers_seller->for)}})</option>
			 
			 @endforeach
        </select>
      </div>
	 <div>
		<label for="name">First Name</label>
		<input id="first_name" type="text" name="first_name" value=""  placeholder="Enter First Name" class="form-input" readonly="readonly"/>
	 </div>
	 <div>
		<label for="name">Last Name</label>
		<input id="last_name" type="text" name="last_name" value="" placeholder="Enter Last Name" class="form-input" readonly="readonly"/>
	 </div>
	 <div>
		<label for="name">Contact</label>
		<input id="mobile" name="mobile" value=""  type="text" placeholder="Enter Mobile No" class="form-input" readonly="readonly"/>
	 </div>
	 <div>
		<label for="name">Email</label>
		<input id="email" type="text" name="email" value="" placeholder="Enter Email Address" class="form-input" readonly="readonly"/>
	 </div>
	 
	  <div>
		<label for="present_address">Present Address</label>
		<input id="present_address" type="text" name="present_address" value="" placeholder="Enter Present Address" class="form-input" readonly="readonly"/>
	 </div>
	  
     </div>
	 
	 <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-2">
       
	  <!--<div>
	  <label for="state">Select Buyers</label>
		   <select class="form-select" name="buyer_id" id="buyer_id" onchange="getBuyerAddress(this);" required="">
			  <option value="">--Select Buyer--</option>
			  <option value="">--Select Buyer--</option>
			  <option value="">--Select Buyer--</option>
			 
			  
			  
		   </select>
      </div>-->
	  
	  <div>
	  <label for="state">Select Shipping Address</label>
               <select  class="form-select text-white-dark"  id="transport_address"  name="transport_address" style="width:354px;" placeholder="Select Shipping Address" onchange="chooseBuyerAddress(this);">
                 <option value="">--Select Shipping Address--</option>     
               </select>
      </div>
	  
      </div>
	  
      <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-2">
	  
	  <div>
         <label for="private_marka">Private Marka:</label>
         {!! Form::text('private_marka', null, array('placeholder' => 'Enter Private Marka','class' => 'form-input','id'=>'private_marka','required' => 'required')) !!}
      </div>
	  
      <div>
         <label for="transport_name">Transport Name:</label>
         {!! Form::text('transport_name', null, array('placeholder' => 'Enter Transport Name','class' => 'form-input','id'=>'transport_name','required' => 'required')) !!}
      </div>
	  
      <div>
         <label for="transport_address_name">Transport Address:</label>
         {!! Form::text('transport_address_name', null, array('placeholder' => 'Enter Transport Address','class' => 'form-input','id'=>'transport_address_name','required' => 'required')) !!}
      </div>
	  
      <div>
         <label for="transport_contact_number">Transport Contact Number:</label>
         {!! Form::text('transport_contact_number', null, array('placeholder' => 'Enter Transport Contact Number','class' => 'form-input','id'=>'transport_contact_number','required' => 'required')) !!}
      </div>
	  
      <div>
         <label for="delivery_place">Delivery Place/District:</label>
         {!! Form::text('delivery_place', null, array('placeholder' => 'Enter Delivery Place','class' => 'form-input','id'=>'delivery_place','required' => 'required')) !!}
      </div>
	  
      <div>
         <label for="lr_copy_upload">Upload LR Copy/Visiting  Card:</label>
       <?php /* {!! Form::file('lr_copy_upload', array('placeholder' => 'Upload LR Copy/Visiting Card ','class' => 'form-input','id'=>'lr_copy_upload')) !!} */ ?>
		
		 <a  id="lr_copy" href="{{ asset('uploads/transport_address/lr_copy_upload/demo.png') }}" target="_blank"><img src="{{ asset('uploads/transport_address/lr_copy_upload/demo.png') }}" class="img-responsive" alt="" id="lr_copy_img" style="width: 100px;" /></a>
      </div>
	  <input type="hidden" name="order_price" value="25">
   </div>	
   <br>
   <br>
   <hr>
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-2">
      <div>
         <h1 style="text-align: center;font-size: x-large;"><b>Payment Option</b></h1>
         <br>
         <div class="flex justify-around pt-5">
          
	     <?php /*   <label class="inline-flex cursor-pointer" style="color:green">Wallet Amount: ₹  {{$wallet_data['total_wallet_amount']}}</label> */ ?>
			
			<label class="inline-flex cursor-pointer" id="wallet_data_text" style="color:green">Wallet Amount: ₹  00.00</label>
		   
            <label class="inline-flex cursor-pointer" style="color:green">Wallet</label>
			
            <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="wallet" value="Wallet" checked>
         </div>
      </div>
      <div>
         <table>
            <thead>
               <tr>
                  <th>Total</th>
                  <th>₹ {{$cart_buy_data['total_buy_price']}}.00</th>
               </tr>
            </thead>
           <!-- <tbody>
               <tr>
                  <td>Shpping estimate</td>
                  <td>₹5.00</td>
               </tr>
               <tr>
                  <td>Total</td>
                  <td colspan="2">₹276.00</td>
               </tr>
            </tbody>-->
         </table>
      </div>
   </div>
   <br>
   
   @foreach($cart_buy_data['cart_product_detail_arr'] as $cart_product_detail_row)
   
   <input type="hidden" name="prod_id_{{$cart_product_detail_row['product_id']}}_qty" value="{{$cart_product_detail_row['prod_qty']}}" id="prod_id_{{$cart_product_detail_row['product_id']}}_qty" class="input-qty qty-btn-minus update-cart"/>
   
  @endforeach
  
   <a href=""><button type="submit" class="btn btn-outline-primary rounded-full" style="margin-left:850px;">Place Order</button></a>
  
  
 </div>
 </form>
</div>
@endsection

@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

<script>

// get buyer Seller employee data-29-12-2023

function getBuyerSellerEmpData(element){
	
	   var buyer_seller_emp_id = element.value;
	   
        //alert(buyer_seller_emp_id);
	  
	   var token = "{{ csrf_token() }}";
	   var url = "{{ route('get_buyer_seller_emp_data') }}";
       $.ajax({
         url:url,
         type: 'POST',
         data: { _token :token,buyer_seller_emp_id:buyer_seller_emp_id },
         success:function(result){
		
         console.log(result);	  
		 
	    // var brand_name = result.category_data.brand_name;
	     $('#first_name').val(result.buyer_seller_data.first_name);
	     $('#last_name').val(result.buyer_seller_data.last_name);
	     $('#mobile').val(result.buyer_seller_data.mobile);
	     $('#email').val(result.buyer_seller_data.email);
	     $('#present_address').val(result.buyer_seller_data.present_address);
	    $('#wallet_data_text').text('Wallet Amount: ₹ '+result.wallet_data.total_wallet_amount);
		 
		 
		$('#transport_address').html(''); 
		
	
		$('#transport_address').append('<option value="">--Select Buyer Seller Address--</option>');
          
          $.each(result.buyer_seller_address_data, function(key, value) {
          
          $('#transport_address').append('<option value="'+key+'">'+value+'</option>');
          
        }); 
	   
           
         }
       });
}

//get buyer Seller employee data-29-12-2023//

function getBuyerAddress(element){
	
	   var buyer_id = element.value;
      // alert(buyer_id);	   
	   var token = "{{ csrf_token() }}";
	   var url = "{{ route('get_buyer_address') }}";
       $.ajax({
         url:url,
         type: 'POST',
         data: { _token :token,buyer_id:buyer_id },
         success:function(result){
		
         console.log(result);	  
		 
	    // var brand_name = result.category_data.brand_name;
	   //  $('#brand_name').val(brand_name);
		 
		 
		$('#transport_address').html(''); 
		
	
		$('#transport_address').append('<option value="">--Select Buyer Address--</option>');
          
          $.each(result.buyer_address, function(key, value) {
          
          $('#transport_address').append('<option value="'+key+'">'+value+'</option>');
          
        }); 
	   
           
         }
       });
}

//choose buyer address.

function chooseBuyerAddress(element){
	
	   var transport_address = element.value;
	  
	    var buyer_seller_emp_id = $('#buyer_seller_emp_id').val();
	   //var transport_address = $('#transport_address').val(); 
	   
      // alert(transport_address);	 
	   
	   var token = "{{ csrf_token() }}";
       var url = "{{ route('choose_buyer_address') }}";
       $.ajax({
         url:url,
         type: 'POST',
         data: { _token :token,transport_address:transport_address, buyer_seller_emp_id:buyer_seller_emp_id },
         success:function(result){
		//alert(result);
          console.log(result);	  
		 
	     var private_marka = result.buyer_address_data.private_marka;
	     $('#private_marka').val(private_marka); 
		 
		 var transport_name = result.buyer_address_data.transport_name;
	     $('#transport_name').val(transport_name); 
		 
		 var transport_address_name = result.buyer_address_data.transport_address;
	     $('#transport_address_name').val(transport_address_name);
		 
		 var transport_contact_number = result.buyer_address_data.transport_contact_number;
	     $('#transport_contact_number').val(transport_contact_number);
		 
		 var delivery_place = result.buyer_address_data.delivery_place;
	     $('#delivery_place').val(delivery_place); 
		 
		// var lr_copy_upload = result.buyer_address_data.lr_copy_upload;
	    // $('#lr_copy_upload').val(lr_copy_upload);
		 
		 $("#lr_copy").attr("href","{{ asset('uploads/transport_address/lr_copy_upload/') }}/"+result.buyer_address_data.lr_copy_upload);
		 
		 $("#lr_copy_img").attr("src","{{ asset('uploads/transport_address/lr_copy_upload/') }}/"+result.buyer_address_data.lr_copy_upload);
 
         }
       });
} 

</script>

@endpush