@php
 
use App\Helpers\Helper;

use App\Models\Order;

$auth_user  = Auth::user();
	
$email = $auth_user->email;
  
@endphp

@extends('admin.layouts.app')
@section('title','My Product Order')
@section('content')

<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
      <div x-data="form">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li>
                    <a href="#" class="text-primary hover:underline">My Product Order</a>
                </li>
                <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                    <span>My Order</span>
                </li>
            </ul>
            <br>
            {{-- <a class="badge bg-success" href="{{route('product_review_list')}}">Product Review List</a>--}}
             <a href="{{route('my_product_order')}}"  class="btn btn-primary" style="margin-left: 875px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>
             <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:213px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
        </div>
     
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <div class="">
		 <br>
		    <form method="GET" action="{{route('my_product_order')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('my_product_order',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                          <select class="form-input" name="seller_buyer_data" id="seller_buyer_data">
                           <option value="">Select Seller Name</option>
                           @foreach($buyerSellerData as $buyerseller)
                            <option value="{{ $buyerseller->id }}" @if(Request::input('seller_buyer_data')  == $buyerseller->id) selected @endif >{{ ucwords($buyerseller->first_name.' '.$buyerseller->last_name)}}({{ ucwords($buyerseller->for) }})</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                </div>
            
                 <div>
                     <button type="submit" class="btn btn-outline-success" style="padding-right: 64px;padding-left:64px;margin-left: 451px;" >Submit</button>
                  </div>
                 
                   <hr>
            </div>
        </form>
         
          </div>
         <div class="dataTable-container">
           @if(count($productOrderData) >0)
          
			<table class="table mt-5">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Product Image</th>
						<th>Product Id</th>
						<th>Product Name</th>
						<th>Total Orders</th>
						<th>Total Received</th>
						<th>Total Return</th>
						<th>Add To Return</th>
						<th>Add Review</th>
						<th>Product Exclusive</th>
					</tr>
				</thead>
            <tbody>
            @php
            
            $i=1;
            
            @endphp
            
            @foreach($productOrderData as $row)
          
		    @php
		 
			$totalReceivedQty = Helper::productDeliveredQty($row['product_id']);
							 
		    @endphp
		  
              <tr>
              <td>{{$i++}}</td>
              <td><img src="{{asset('public/uploads/product/product_photo/'.$row['product_img'])}}" alt="" class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2"></td>
              <td>PID00{{$row['product_id']}}</td>
              <td>{{$row['product_name']}}</td>
             
		      <?php /*    <td><button onclick="myProductOrder({{$row['product_id']}})">{{$row['total_order']}}</button></td>  */ ?>
              <td><button onclick="myProductOrder({{$row['product_id']}})">{{$row['total_qty']}}</button></td>
				    
			  <td>{{$totalReceivedQty}}</td>
			  <!--<td>{{$row['total_qty']}}</td>-->
              <td>0</td>
              <td>   
               <a href="#"><button type="button" class="btn btn-primary">Add To Return Cart</button></a>
              </td>
              
             <td>   
              
	        <!-- add product review 16-12-2024 -->
			
           <div x-data="modal" class="">
               <div class="flex items-center">
                  <a href="#">
                  <button class="badge bg-success inline-flex" href="#" @click="toggle">Add Product Review</button>
                  </a>
               </div>
               <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                  <div class="flex items-start justify-center min-h-screen px-4">
                     <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                       
                        <div class="p-5">
                           <form method="POST" enctype="multipart/form-data" action="{{route('add_review',$row['product_id'])}}">
                              @csrf
                              <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                                 <div>
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                       <h5 class="text-lg font-bold">Add Product Review</h5>
                                       <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                             <line x1="18" y1="6" x2="6" y2="18"></line>
                                             <line x1="6" y1="6" x2="18" y2="18"></line>
                                          </svg>
                                       </button>
                                    </div>
                                   
                                 </div>

					          <!-- 21-12-2024  -->
					
								<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
								   <div>
								   <label for="state">Select Buyers/Seller</label>
									<select class="form-select" name="buyer_seller_id" id="buyer_seller_id" required="">
									  <option value="">Select Buyer/Seller</option>
									 
									  @foreach($employeeBuyerSellerData as $buyers_seller)
									
										 <option value="{{$buyers_seller->id}}">{{$buyers_seller->email}} ({{ucfirst($buyers_seller->for)}})</option>
											
									  @endforeach 
									</select>
								  </div>
								</div>
					
				               <!-- 21-12-2024  -->	
								 <br>
                                 <div>
                                    <label for="review_rating">Review Rating</label>
                                    <input type="number" id="review_rating" class="form-input" name="review_rating" placeholder="Enter Review Rating" required/>
                                 </div>
								 
                                 <br>
                                 <div>
                                    <label for="review_comment">Review Comment</label>
                                    <textarea id="review_comment" rows="3" class="form-textarea" placeholder="Enter Comment" style="height: 100px;" name="review_comment" required></textarea>
                                 </div>
                              </div>
                              <div class="flex justify-end items-center mt-8">
                                 <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                                 <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Save</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
			
			<!-- add product review 16-12-2024 -->
			  
			   </td>
			   
			   
			 <td>
			   
		 <!-- product exclusive 21-1-2025 Start -->
			  			
           <div x-data="modal" class="">
               <div class="flex items-center">
                  <a href="#">
                  <button class="badge bg-success inline-flex" href="#" @click="toggle">Product Exclusive</button>
                  </a>
               </div>
               <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                  <div class="flex items-start justify-center min-h-screen px-4">
                     <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                       
                        <div class="p-5">
                           <form method="POST" enctype="multipart/form-data" action="{{route('product_exclusive',$row['product_id'])}}">
                              @csrf
                              <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                                 <div>
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                       <h5 class="text-lg font-bold">Product Exclusive</h5>
                                       <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                             <line x1="18" y1="6" x2="6" y2="18"></line>
                                             <line x1="6" y1="6" x2="18" y2="18"></line>
                                          </svg>
                                       </button>
                                    </div>
                                   
                                 </div>

					          <!-- 21-12-2024  -->
					
								<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
								   <div>
								   <label for="state">Select Buyers/Seller</label>
									<select class="form-select" name="buyer_seller_id" id="buyer_seller_id" required="">
									  <option value="">Select Buyer/Seller</option>
									 
									  @foreach($employeeBuyerSellerData as $buyers_seller)
									
										 <option value="{{$buyers_seller->id}}">{{$buyers_seller->email}} ({{ucfirst($buyers_seller->for)}})</option>
											
									  @endforeach 
									</select>
								  </div>
								</div>
                              
                              </div>
                              <div class="flex justify-end items-center mt-8">
                                 <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                                 <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Save</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		   <!-- product exclusive 21-1-2025 End -->
			   
		  </td> 
			   
			   
              
               </tr>
               @endforeach
               </tbody>
              </table>
        
        @else
          <h1 style="color:red; text-align:center">My Product Order Not Found!!</h1>
               @endif
         </div>
        <div id="myDIV" style="display:none;">
            <div class="mb-5">
                <div class="dataTable-container">
                    <table id="myTable1" class="whitespace-nowrap dataTable-table">
                        <thead>
                            <tr style="background: radial-gradient(#7fd9a7f7, transparent);">
                                <th>S.No</th>
                                <th>OrderID</th>
                                <th>Date</th>
                                <th>Quantity</th>
                                 <th>Party Name</th>
                            </tr>
                        </thead>
                        <tbody id="dateWiseOrder">
                            <tr>
                              <!--  <td>1</td>
                                <td id="productOrderID">OD202312223029550401</td>
                                <td id="today_date">29-08-2024</td>
                                <td id="productPackQty">5</td>
                                <td id="today_date">Anil Seller</td> -->
                
                                <td id="productOrderID"></td>
                                <td id="today_date"></td>
                                <td id="productPackQty"></td>
                                <td id="buyerSellerName"></td>
                
                            </tr>
                        </tbody>
                    </table>
                </div>
				<!-- /<?php /* ?{{ $productOrderData->links('admin.partials.pagination')}}  */?> -->
            </div>
        </div>
      </div>
   </div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript"> 
   $(function(){
    $('#alertMessageHide').delay(5000).fadeOut();
   });
</script>
<script>
   function confirmDelete( varForm ) {
           var r = confirm("Are you sure you wish to delete this entry?");
   
           if (r == true) {
               document.getElementById("form" + varForm).submit();
           }
       }
</script>
<script>
   function mystatusFunction() {
     var x = document.getElementById("mystatusDIV");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script>
<script>
  function myProductOrder(product_id) {
    
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
    
// Ajax for get my single product start 
   
 $('#productOrderID').text(''); 
 $('#today_date').text(''); 
 $('#productPackQty').text('');
 $('#buyerSellerName').text('');

var token = "{{ csrf_token() }}";
var url = "{{ route('get_today_my_product_order') }}";

 $.ajax({
 url:url,
 type: 'POST',
 data: { _token :token,product_id:product_id },
 success:function(result){

      console.log(result);
 
    $('#dateWiseOrder').html('');
    
    var sn = 1;
    
    $.each(result.order_data, function(key, value) {
    //alert(key);
    console.log(value);
    
    $('#dateWiseOrder').append('<tr><td>'+sn+'</td><td>'+value.order_id+'</td><td>'+value.order_date+'</td><td>'+value.product_quienty+'</td><td>'+value.buyer_or_seller_name+'</td></tr>');
    
    sn = sn+1;
    
  });  
  }
});

// Ajax for get my single product End 
      
}
  
 </script>
@endpush