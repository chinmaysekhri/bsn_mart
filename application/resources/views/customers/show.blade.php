@extends('admin.layouts.app')
@section('title','Customer Lead Show')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{ route('customers.index') }}" class="text-primary hover:underline">Customer</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span> Customer Detail</span>
      </li>
   </ul>
</div>
<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1" >
   <!-- Grid -->
   <div class="panel" style="border-style: ridge;" >
      <div class="mb-5 flex items-center justify-between" >
         <h5 class="text-lg font-semibold dark:text-white-light text-align:center" >Customer Detail</h5>
      </div>
      <div class="mb-5">
         @if (count($errors) > 0)
         <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
            <span class="ltr:pr-2 rtl:pl-2">
               <strong class="ltr:mr-1 rtl:ml-1">Whoops!</strong>There were some problems with your input.
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
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" >
            <div>
               <label for="gridName">
               <strong>Customer ID:</strong>
               FAC00{{ $customer->id }}
               </label>
            </div>
            <div>
               <label for="gridEmail">
               <strong>Name:</strong>
               {{ $customer->first_name.' '.$customer->last_name }} 
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="gridPinCode">
               <strong>Contact Number:</strong>
               {{ $customer->mobile }}
               </label>
            </div>
            <div>
               <label for="gridMobile">
               <strong>Email:</strong>
               {{ $customer->email }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="gridCountry">
               <strong>Address:</strong>
               {{ $customer->present_address }}
               </label>
            </div>
            <div>
               <label for="gridState">
               <strong>Pin Code:</strong>
               {{ $customer->pin_code }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="gridCity">
               <strong>Country:</strong>
               {{ $customer->country }}
               </label>
            </div>
            <div>
               <label for="gridCity">
               <strong>State:</strong>
               {{ $customer->state }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="city">
               <strong>City:</strong>
               {{ $customer->city }}
               </label>
            </div>
         </div>
         <hr>
         <br>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="product_type">
               <strong>Products Type:</strong>
               {{ $customer->product_type }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="product_photo">
                  <strong>Product Photo:</strong>
                  @if(!empty($customer->product_photo))
                  <a href="{{asset('public/uploads/customer/product_photo/'.$customer->product_photo)}}" download="{{$customer->product_photo}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:119px; margin-top: -24px;">
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
                        Download
                     </button>
                  </a>
                  <a href="{{asset('public/uploads/customer/product_photo/'.$customer->product_photo)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:235px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="margin-left: -13px;">
                           <path
                              opacity="0.5"
                              d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                              stroke="currentColor"
                              stroke-width="1.5"
                              ></path>
                           <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                        View 
                     </button>
                  </a>
                  @endif
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="investment">
               <strong>Investment:</strong>
               {{ $customer->investment }}
               </label>
            </div>
            <div>
               <label for="product_name">
               <strong>Product Name:</strong>
               {{ $customer->product_name }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="guaranteed_profit">
               <strong>Gurranted Profit:</strong>
               {{ $customer->guaranteed_profit }}
               </label>
            </div>
            <div>
               <label for="gst_no">
               <strong>GST:</strong>
               {{ $customer->gst_no }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="gridCity">
               <strong>Total:</strong>
               {{ $customer->total }}
               </label>
            </div>
            <div>
               <label for="Discount">
               <strong>Discount:</strong>
               {{ $customer->discount }}%
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="final_cost_of_product">
               <strong>Final Cost Of Product :</strong>
               {{ $customer->final_cost_of_product }}
               </label>
            </div>
            <div>
               <label for="feedback">
               <strong>Feedback:</strong>
               {{ $customer->feedback }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="status">
               <strong>Final Status:</strong>
               {{ $customer->status }}
               </label>
            </div>
            <div>
               <label for="follow_up_date">
               <strong>Follow Up Date:</strong>
               {{ $customer->follow_up_date }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="amount_paid">
               <strong>Amount Paid:</strong>
               {{ $customer->amount_paid }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="payment_receipt_no">
               <strong> Payment Recipt No:</strong>
               {{ $customer->payment_receipt_no }}
               </label>
            </div>
            <div>
               <label for="payment_receipt">
                  <strong>Payment Recipt:</strong>
                  @if(!empty($customer->payment_receipt))
                  <a href="{{asset('public/uploads/customer/payment_receipt/'.$customer->payment_receipt)}}" download="{{$customer->payment_receipt}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:119px; margin-top: -24px;">
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
                        Download
                     </button>
                  </a>
                  <a href="{{asset('public/uploads/customer/payment_receipt/'.$customer->payment_receipt)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:235px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="margin-left: -13px;">
                           <path
                              opacity="0.5"
                              d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                              stroke="currentColor"
                              stroke-width="1.5"
                              ></path>
                           <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                        View 
                     </button>
                  </a>
                  @endif
               </label>
            </div>
         </div>
      </div>
   </div>
</div>
<br>
<!-- Customer Logs -->
<div x-data="form" >
   <button onclick="myFunction()" class="badge bg-info" style="padding: 10px 42px 10px 42px;font-size: 17px">Customer Logs</button>

   
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
      <div class="panel" style="display: none;" id="myDIV">
         <div class="mb-5 flex" style="text-align: center" >
            <h4 class="text-lg font-semibold dark:text-white-light" style="margin-left: 400px;">Customer Payment Logs</h4>
         </div>
         <div class="mb-5">
            <div class="dataTable-container">
               <table id="myTable1" class="whitespace-nowrap dataTable-table">
                  <thead>
                     <tr style="background: radial-gradient(#7fd9a7f7, transparent);">
                        <th>S.No</th>
                        <th>Log Date</th>
						<th>Updated By</th>
						<th>Final Status</th>
						<th>Follow Up Date</th>
                        <th>Comment</th>
						<th>Product</th>
						<th>Amount Paid</th>
						<th>Payment Status</th>
                        
                     </tr>
                  </thead>
                  <tbody>
                     @php
                     $i =0;
                     @endphp
                     @foreach($customer_payment as $payment )
                     <tr>
                        <td>{{++$i}}</td>
                        <td>{{$payment->created_at}}</td>
						<td>{{$payment->user_firstname.' '.$payment->user_lastname}}</td>
						<td>{{$payment->status}}</td>
						<td>{{$payment->follow_up_date}}</td>
                        <td>{{$payment->feedback}}</td>
                        <td>{{$payment->productName}}</td>
						<td>{{$payment->amount_paid}}</td>
						@if($payment->payment_status=='Confirm')
					    <td><button type="button" class="btn btn-outline-success">Confirm</button></td> 
						@elseif ($payment->payment_status=='Rejected')
						<td><button type="button" class="btn btn-outline-danger">Rejected</button></td> 
						@else   
						<td><button type="button" class="btn btn-outline-warning">Pending</button></td> 
						@endif
						
                     </tr>
                     @endforeach 
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

</div>
<!--Applid On Button hidden and show Script  -->
<script>
   function myFunction() {
     var x = document.getElementById("myDIV");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script>
<script>
   function myComment() {
     var x = document.getElementById("myCommentDIV");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script>
<!--Applid On  button hidden and show Script End  -->                                            
@endsection