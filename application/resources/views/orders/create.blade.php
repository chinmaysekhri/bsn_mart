@extends('admin.layouts.app')
@section('title','Create Order ')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{ route('orders.index') }}" class="text-primary hover:underline">Order</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Create Order </span>
      </li>
   </ul>
</div>

<div x-data="form">
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
      <div class="panel">
        
      
         {!! Form::open(array('route' => 'orders.store','method'=>'POST','enctype'=>'multipart/form-data','class'=>'space-y-5')) !!}
          @csrf
		  
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
				
				<div>
				   <label for="customer_id">Customer ID</label>
					 <select class="form-select text-white-dark" id="customer_id" name="customer_id">
					<option value="">Select Customer ID</option>
					<option value="1">CUSTID001</option>
					<option value="2">CUSTID002</option>
					<option value="3">CUSTID003</option>
					<option value="4">CUSTID004</option>
					<option value="5">CUSTID005</option>
				   </select>
				 </div>
		 
				  <div>
					 <label for="customer_name">Customer Name</label>
					   {!! Form::text('customer_name', null, array('placeholder' => 'Customer Name','class' => 'form-input','id'=>'Name')) !!}
				  </div>
				  
                  <div>
                     <label for="name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Customer Contact</label>
                     {!! Form::text('mobile', null, array('placeholder' => 'Enter Contact Number','class' => 'form-input','id'=>'Name')) !!}
                  </div>                 
				 
				  <div>
                     <label for="name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Email</label>
                     {!! Form::text('email', null, array('placeholder' => 'Enter Email','class' => 'form-input','id'=>'Email')) !!}
                  </div>
				  
                  <div>
                     <label for="present_address">Present Address</label>
                     {!! Form::text('present_address', null, array('placeholder' => 'Present Address','class' => 'form-input','id'=>'Country')) !!}
                  </div>
				  
				  
		         <div>
					<label for="pin_code">Pin Code</label>
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
					<label for="city">City</label>
					{!! Form::select('city', [''=>'Select City'],[], array('class' => 'form-select text-white-dark','id'=>'city')) !!}
				</div>
				  

			    
         
            </div><br>

             <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <div>
				   <label for="product_type">Product Type</label>
				   <select class="form-select text-white-dark" id="product_type" name="product_type" onchange="getVirtualData(this);">
					  <option value="">Product Type</option>
					  <option value="Virtual">Virtual</option>
					  <option value="Physical">Physical</option>
				   </select>
				</div>
				
                 <div>
				 
                 <label for="product_name">Product Name</label>
                 {!! Form::text('product_name', null, array('placeholder' => 'Enter Product Name','class' => 'form-input','id'=>'product_name')) !!}
            
                 </div> 
				 
				 <div>
                    <label for="investment">Investment</label>
                      {!! Form::text('investment', null, array('placeholder' => 'investment','class' => 'form-input','id'=>'investment')) !!}
                 </div>

          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" id="virtualContent" style="display:none">
			
				            <div>
                     <label for="slot">Slots</label>
                    {!! Form::number('slot', null, array('placeholder' => 'Enter Slots ','class' => 'form-input','id'=>'slot')) !!}
                  </div>
			       </div>
                 <div>
               <label for="guaranteed_profit">Guaranteed Profit</label>
               {!! Form::text('guaranteed_profit', null, array('placeholder' => 'Guaranteed Profit','class' => 'form-input','id'=>'guaranteed_profit')) !!}
            </div>
             <div>
               <label for="gst_no">GST</label>
               <select class="form-select text-white-dark" id="gst_no" name="gst_no" onchange="getProductCostWithGst(this);">
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
               <select class="form-select text-white-dark" id="discount" name="discount" onchange="getDiscountProductFinalCost(this);">
                  <option value="">Discount</option>
                  <option value="1">1%</option>
                  <option value="2">2%</option>
                  <option value="3">3%</option>
                  <option value="4">4%</option>
                  <option value="5">5%</option>
                  <option value="6">6%</option>
                  <option value="7">7%</option>
                  <option value="8">8%</option>
                  <option value="9">9%</option>
                  <option value="10">10%</option>
               </select>
            </div>
             <div>
               <label for="final_cost_of_product">Final Cost Of Product</label>
               {!! Form::text('final_cost_of_product', null, array('placeholder' => 'Final Cost','class' => 'form-input','id'=>'final_cost_of_product')) !!}
            </div>
            <div>
               <label for="name">Select Final Status</label>
               <select class="form-select text-white-dark" id="Status" name="status">
                 <option value="">Select Final Status</option>
                  <option value="Order Reserved">Order Reserved</option>
                  <option value="Order Made">Order Made</option>
                </select>
            </div>
            
            <div>
               <label for="amount_paid">Amount Paid</label>
               {!! Form::text('amount_paid', null, array('placeholder' => 'Amount Paid','class' => 'form-input','id'=>'amount_paid')) !!}
            </div>
            <div>
               <label for="payment_receipt_no">Payment Recipt Number</label>
               {!! Form::text('payment_receipt_no', null, array('placeholder' => 'Enter Payment Receipt Number','class' => 'form-input','id'=>'payment_receipt_no')) !!}
            </div>
            <div>
               <label for="payment_receipt">Upload Payment Receipt</label>
               {!! Form::file('payment_receipt', array('placeholder' => 'Enter Payment Receipt Number','class' => 'form-input','id'=>'payment_receipt')) !!}
             </div>
				
                 <div>
                 <label for="payment_received">Payment Received</label>
                 {!! Form::text('payment_received', null, array('placeholder' => 'Enter Payment Received','class' => 'form-input','id'=>'payment_received')) !!}
            
                 </div>
				 
                <div>
                 <label for="payment_mode">Payment Mode</label>
                <select class="form-select text-white-dark" id="payment_mode" name="payment_mode">
                 <option value="">Payment Mode</option>
                 <option value="Online">Online</option>
                 <option value="Offline">Offline</option>
                </select>
                </div>
				
                <div>
                 <label for="payment_date">Payment Date</label>
                 {!! Form::date('payment_date', date('Y-m-d'), array('placeholder' => 'Payment Date','class' => 'form-input','id'=>'payment_date')) !!}
            
                </div>
				
				
                 <div>
               <label for="Comment">Feedback</label>
               <textarea class="form-input" id="feedback" name="feedback" rows="2" cols="50" placeholder="Feedback......"></textarea>
            </div>

               </div>

         
         <button type="submit" class="btn btn-primary !mt-6">Submit</button>
         
         {!! Form::close() !!}
			
			
      </div>
   </div>
</div>

@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@push('script')
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

<script>
 
 function getDiscountProductFinalCost(element){
   	
   	   var productDiscount = element.value;

	   var total_price     = parseFloat($('#total').val());
	   
	   var total_discount_price = Math.round(total_price - (total_price*productDiscount/100));
	  	    
	   $('#final_cost_of_product').val(total_discount_price);
	   
	  
	
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


