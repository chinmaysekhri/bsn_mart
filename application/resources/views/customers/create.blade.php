@extends('admin.layouts.app')
@section('title','Create Customer Lead')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{ route('customers.index') }}" class="text-primary hover:underline">Customer</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Create Customer Lead</span>
      </li>
   </ul>
</div>
<div x-data="form">
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
      <div class="panel">
	  	  @if (count($errors) > 0)
	        <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
                <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Whoops!</strong>There were some problems with your input.
		         <ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
			      </ul>
	             </span>

				<button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80">
					<svg> ... </svg>
				</button>
			</div>
		    @endif
         <div class="mb-5 flex" style="text-align: center">
            <h4 class="text-lg font-semibold dark:text-white-light" style="margin-left: 400px;">Manage Lead By Sales Person</h4>
         </div>
         {!! Form::open(array('route' => 'customers.store','method'=>'POST','enctype'=>'multipart/form-data','class'=>'space-y-5')) !!}
         @csrf
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            {{--  
            <div>
               <label for="name">Customer ID</label>
               {!! Form::text('customer_id', null, array('placeholder' => 'Customer Id','class' => 'form-input','id'=>'Name')) !!}
            </div>
            --}}
            <div>
               <label for="Fisrt">Fisrt Name</label>
               {!! Form::text('first_name', null, array('placeholder' => 'Enter First Name','class' => 'form-input','id'=>'Name')) !!}
            </div>
            <div>
               <label for="Last">Last Name</label>
               {!! Form::text('last_name', null, array('placeholder' => 'Enter First Name','class' => 'form-input','id'=>'Name')) !!}
            </div>
            <div>
               <label for="Mobile"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Mobile Number</label>
               {!! Form::text('mobile', null, array('placeholder' => 'Enter Mobile No','class' => 'form-input','id'=>'Mobile')) !!}
            </div>
            <div>
               <label for="Email"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Email</label>
               {!! Form::text('email', null, array('placeholder' => 'Enter Email','class' => 'form-input','id'=>'Email')) !!}
            </div>
            <div>
               <label for="Present">Present Address</label>
               {!! Form::text('present_address', null, array('placeholder' => 'Present Address','class' => 'form-input','id'=>'Country')) !!}
            </div>
            <div>
               <label for="PinCode">Pin Code</label>
               {!! Form::number('pin_code', null, array('placeholder' => 'Enter Pin Code','class' => 'form-input','id'=>'pin_code', 'onkeyup'=>'getStateCity(this);', 'maxlength'=>'6')) !!}
            </div>
			
            <div>
               <label for="Country">Country</label>
               {!! Form::text('country', null, array('placeholder' => 'Country','class' => 'form-input','id'=>'Country')) !!}
            </div>
            <div>
               <label for="state">State</label>
               {!! Form::select('state', [''=>'Select State'],[], array('class' => 'form-select text-white-dark','id'=>'state')) !!}
            </div>
            <div>
               <label for="City">City</label>
               {!! Form::select('city', [''=>'Select City'],[], array('class' => 'form-select text-white-dark','id'=>'city')) !!}
            </div><br>
            <div>
               <label for="Name">Product Type </label>
               <select class="form-select text-white-dark" id="product_type" name="product_type"  onchange="myPhysicalFunction();">
                  <option value="">Product Type</option>
                  <option value="Virtual">Virtual</option>
                  <option value="Physical">Physical</option>
               </select>
            </div>
            
			
			<div>
               <label for="product_name">Product Name</label>
               <select class="form-select text-white-dark" id="product_name" name="product_name" onchange="getProductDetail(this);">
			   
                  <option value=""> Select Product Name</option>
                  
               </select>
            </div>
			
		    <div>
               <label for="investment">Investment</label>
               {!! Form::text('investment', null, array('placeholder' => 'investment','class' => 'form-input','id'=>'investment')) !!}
            </div>
           
<!--          <div>
               <label for="name">Investment</label>
               <select class="form-select text-white-dark" id="investment" name="investment">
                  <option value="">Investment</option>
                  @foreach($productData as $product) 
				  
					<option value="{{$product->id}}">{{ $product->investment }}</option>
					
					@endforeach
               </select>
            </div> -->
			
			<div  class="grid grid-cols-1 gap-4 sm:grid-cols-1" id="myVirtualDIV">
           
		    <div>
               <label for="slot">Slots</label>
               {!! Form::text('slot', null, array('placeholder' => 'Slots','class' => 'form-input','id'=>'slot')) !!}
            </div>
			
            </div>
			
            <div>
               <label for="product_video">Product Video & Photo</label>
               <a id="product_video"  href="" target="_blank">
                  <button type="button" class="btn btn-info gap-2" style="padding:1px 17px 1px 17px;margin-left:169px; margin-top: -24px;">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                        <path
                           opacity="0.5"
                           d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                           stroke="currentColor"
                           stroke-width="1.5"
                           stroke-linecap="round"
                           ></path>
                        <path
                           d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5"
                           stroke="currentColor"
                           stroke-width="1.5"
                           stroke-linecap="round"
                           stroke-linejoin="round"
                           ></path>
                     </svg>
                     Video
                  </button>
               </a>
               <a id="product_photo" href="" target="_blank">
                  <button type="button" class="btn btn-primary gap-2" style="padding:1px 17px 1px 17px;margin-top: -24px;margin-left:285px;">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="margin-left: -13px;">
                        <path
                           opacity="0.5"
                           d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                           stroke="currentColor"
                           stroke-width="1.5"
                           ></path>
                        <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                     </svg>
                     Photo 
                  </button>
               </a>
            </div>
           
			<div>
               <label for="guaranteed_profit">Guaranteed Profit</label>
               {!! Form::text('guaranteed_profit', null, array('placeholder' => 'Guaranteed Profit','class' => 'form-input','id'=>'guaranteed_profit')) !!}
            </div>
			
		    <div>
               <label for="gst_no">GST</label>
               <select class="form-select text-white-dark" id="gst_no" name="gst_no" onchange="getProductCostWithGst(this);" required/>
                  <option value="">Select GST </option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option> 
               </select>
            </div>
			
            <div>
               <label for="total">Total</label>
               {!! Form::text('total', null, array('placeholder' => 'Total','class' => 'form-input','id'=>'total')) !!}
            </div>
			
		
			<div>
               <label for="discount">Discount</label>
               {!! Form::text('discount', null, array('placeholder' => 'Enter Discount','class' => 'form-input','id'=>'discount')) !!}
            </div>
			
            <div>
               <label for="final_cost_of_product">Final Cost Of Product</label>
               {!! Form::text('final_cost_of_product', null, array('placeholder' => 'Final Cost','class' => 'form-input','id'=>'final_cost_of_product')) !!}
            </div>
			
            
            <div>
               <label for="name">Select Final Status</label>
               <select class="form-select text-white-dark" id="Status" name="status" onchange="change_status();" required/>
                 
				 <option value="">Select Final Status</option>
                  <option value="Fresh Lead">Fresh Lead</option>
                  <option value="Pending">Pending</option>
                  <option value="Intrested">Intrested</option>
                  <option value="Not Intrested">Not Intrested</option>
                  <option value="Virtual Meet">Virtual Meet</option>
                  <option value="Line Up">Line Up</option>
                  <option value="Turn Up">Turn Up</option>
                  <option value="Fake Lead">Fake Lead</option>
                  <option value="Loan Applied">Loan Applied</option>
                  <option value="Loan Approved">Loan Approved</option>
                  <option value="Loan Rejected">Loan Rejected</option>
                  <option value="In Follow Up">In Follow Up</option>
                  <option value="Payment Link">Payment Link</option>
                  <option value="Order Reserved">Order Reserved</option>
                  <option value="Order Made">Order Made</option>
                 
               </select>
            </div>

            <div id="payment_info_hide" id="myDIV" style="display: none;"> 
               <label for="follow_up_date" >Follow Up Date</label>
               {!! Form::date('follow_up_date', date('Y-m-d'), array('placeholder' => 'follow update','class' => 'form-input','id'=>'inputdate')) !!}
            </div>
            <div>
               <label for="Comment">Feedback</label>
               <textarea class="form-input" id="feedback" name="feedback" rows="2" cols="50" placeholder="Feedback......" required></textarea>
            </div>

         </div>
		 
		 <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" id="payment_info" id="myDIV" style="display: none;">
            <div>
               <label for="amount_paid">Amount Paid</label>
               {!! Form::text('amount_paid', null, array('placeholder' => 'Amount Paid','class' => 'form-input','id'=>'amount_paid' ,'required' => 'required')) !!}
            </div>
            <div>
               <label for="payment_receipt_no">Payment Recipt Number</label>
               {!! Form::text('payment_receipt_no', null, array('placeholder' => 'Enter Payment Receipt Number','class' => 'form-input','id'=>'payment_receipt_no' ,'required' => 'required')) !!}
            </div>
            <div>
               <label for="payment_receipt">Upload Payment Receipt</label>
               {!! Form::file('payment_receipt', array('placeholder' => 'Enter Payment Receipt Number','class' => 'form-input','id'=>'payment_receipt' ,'required' => 'required')) !!}
             </div>
          </div>
		 
         <button type="submit" class="btn btn-primary !mt-6">Submit</button>
         {!! Form::close() !!}
      </div>
   </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@push('script')
<!-- page load hide start 28.09.23 -->
<script>
   window.onload = function(){
  document.getElementById("myDIV").style.display='none';
   };
</script>
<!-- page load hide end 28.09.23 -->
<script>

   function getProductData(element){
   	
   	var productName = element.value;
    
   }

</script>

<!-- change_status start 26-09-2023  -->
<script>
   $('#payment_info').hide();
   $('#payment_info_hide').hide();

  function change_status(){
      
     var status = $('#Status').val();
     
     if(status=='Order Made' || status=='Order Reserved'){
     
        $('#payment_info').show();
     }
     else 
     { 
      $('#payment_info').hide();
     }

     if(status=='Not Intrested' || status=='Fake Lead' || status=='Loan Rejected' || status=='Revoked'){
     
        $('#payment_info_hide').hide();
     }
     else 
     { 
      $('#payment_info_hide').show();
     }
   }
</script>
<!-- change_status end -->

<!-- Product Type start -->

<script>
   $('#myVirtualDIV').hide();
   $('#myPhysicalDIV').hide();
   
   function myPhysicalFunction() 
   {
   
   $('#myVirtualDIV').hide();
   $('#myPhysicalDIV').hide();
   
   var product_type = $('#product_type').val();
   if(product_type=="Virtual")
   {
      $('#myVirtualDIV').show();
      $('#myPhysicalDIV').hide();
   }
   else if(product_type=="Physical")
   {
      $('#myVirtualDIV').hide();
      $('#myPhysicalDIV').show();
   
   }
   
   //get product data using product type24-09-23
   
      //var pi = element.value;
   	
       var token = "{{ csrf_token() }}";
       var url = "{{ route('get_product_type_data') }}";
   
   	 $.ajax({
   		url:url,
   		type: 'POST',
   		data: { _token :token,product_type:product_type },
   		success:function(result){
			console.log(result);
   
   			//if(result.product_data.length > 0){
   
   				$('#product_name').html('<option value="">Please Select Product</option>');
   				//$('#city').html('');
   				
   		    $.each(result.product_data, function(key, value) {
   				
   			  $('#product_name').append('<option value="'+key+'">'+value+'</option>');
   			  
   			  //$('#city').append('<option value="'+value.post_office+'">'+value.post_office+'</option>');
   			  
   			}); 
   
   			//} 
   
   		}
   	 });
	 
	 //get product with product id
	  
   }
   
      function getProductDetail(element){
   	
   	   var productId = element.value;
   	
       var token = "{{ csrf_token() }}";
       var url = "{{ route('get_product_detail') }}";
   
   	 $.ajax({
   		url:url,
   		type: 'POST',
   		data: { _token :token,productId:productId },
   		success:function(result){
			
			var productDetail =  result.product_detail;
			
			$('#product_photo').attr('href',"{{asset('public/uploads/product/product_img')}}/"+productDetail.product_img);
			
			$('#product_video').attr('href',"{{asset('public/uploads/product/product_video')}}/"+productDetail.product_video);
			
			$('#slot').val(productDetail.split_into);
			
			$('#investment').val(productDetail.product_cost);
			$('#guaranteed_profit').val(productDetail.guaranteed_incomes);
			
			$('#gst_no').val(productDetail.gst_no);
			$('#total').val(productDetail.total);
			$('#feedback').val(productDetail.feedback);
			$('#status').val(productDetail.status);
			//$('#inputdate').val(productDetail.follow_up_date);
			$('#amount_paid').val(productDetail.amount_paid);
			$('#payment_receipt_no').val(productDetail.payment_receipt_no);
			$('#payment_receipt').val(productDetail.payment_receipt);
			
			
			console.log(productDetail);
   	
 /*   			if(result.state_city_data.length > 0){
   
   				$('#state').html('');
   				$('#city').html('');
   				
   		    $.each(result.state_city_data, function(key, value) {
   				
   			  $('#state').append('<option value="'+value.state+'">'+value.state+'</option>');
   			  
   			  $('#city').append('<option value="'+value.post_office+'">'+value.post_office+'</option>');
   			  
   			}); 
   
   			} */
   
   		}
   	 });
    
   }
   
</script>
<script>
 
 
 function getProductCostWithGst(element){
   	
   	   var gst               = element.value;
	   
	   var investment        = parseFloat($('#investment').val());
	   
	   var guaranteed_profit = parseFloat($('#guaranteed_profit').val());
	   
	   if(gst=='Yes'){
		   
		//var total_price = investment+(guaranteed_profit*0.18);  
		var total_price = Math.round(investment+(investment*0.18));  
		   
	   }
	  if(gst=='No'){
		   
		 var total_price = investment;   
	   }
	  // alert(total_price);
	   $('#final_cost_of_product').val(total_price);
	   
	   $('#total').val(total_price);
	
 }
</script>

<script>
 
 
 function getDiscountProductFinalCost(element){
   	
   	   var productDiscount= element.value;

	   var total_price = parseFloat($('#total').val());
	   
	   var total_discount_price = Math.round(total_price - (total_price*productDiscount/100));
	  	    
	   $('#final_cost_of_product').val(total_discount_price);
	   
	  
	
 }
</script>


<!-- Product Type start end -->
<!-- Date Picker Start-->
<script>
   $(function(){
       var dtToday = new Date();
       var month = dtToday.getMonth() + 1;
       var day = dtToday.getDate();
       var year = dtToday.getFullYear();
       if(month < 10)
           month = '0' + month.toString();
       if(day < 10)
           day = '0' + day.toString();
       
       var maxDate = year + '-' + month + '-' + day;
      $('#inputdate').attr('min', maxDate);
   });
</script>
<!-- Date Picker End-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
   function getVirtualData(element){
      
     var virtualData = element.value;
     
     if(virtualData=='Virtual'){
        
        $('#virtualContent').show();
     }else{
        $('#virtualContent').hide();
     }
   }
</script>

<script>
   function getStateCity(element){
    
    var pincode = element.value;
    
       var token = "{{ csrf_token() }}";
       var url = "{{ route('get_state_city') }}";
   
     $.ajax({
      url:url,
      type: 'POST',
      data: { _token :token,pincode:pincode },
      success:function(result){
    
        if(result.state_city_data.length > 0){
   
          $('#state').html('');
          $('#city').html('');
          
          $.each(result.state_city_data, function(key, value) {
          
          $('#state').append('<option value="'+value.state+'">'+value.state+'</option>');
          
          $('#city').append('<option value="'+value.post_office+'">'+value.post_office+'</option>');
          
        }); 
   
        }
   
      }
     });
    
   }
   
   <!--Model  Script Start -->
                   
   document.addEventListener("alpine:init", () => {
    Alpine.data("modal", (initialOpenState = false) => ({
      open: initialOpenState,
   
      toggle() {
        this.open = !this.open;
      },
    }));
   });
                   
   <!--Model  Script End -->
   
</script>



@endpush