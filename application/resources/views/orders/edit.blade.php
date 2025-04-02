@php

use App\Helpers\Helper;

@endphp

@extends('admin.layouts.app')
@section('title','Edit Order')
@section('content')
<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">
         @if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
	  
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
		  
		</div>
		@endif
		
      <!-- Flash  Message  End  -->
      <div class="animate__animated p-6" :class="[$store.app.animation]">
         <div x-data="form">
            <ul class="flex space-x-2 rtl:space-x-reverse">
               <li>
                  <a href="{{route('orders.index')}}" class="text-primary hover:underline">Orders</a>
               </li>
               <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                  <span>Edit Order</span>
               </li>
            </ul>
         </div>
         <br>
         <div class="dataTable-wrapper">
            <table class=" table table-hover ">
               <div class=" d-flex">
                  <h5 class="text-lg font-semibold dark:text-white-light w-50 pl-3">Edit Order Detail</h5>
               </div>
               <br>
               <thead>
                  <tr>
                     <th scope="col">S.No</th>
                     <th scope="col" class="w-15">Product Image</th>
                     <th scope="col">Product Id</th>
                     <th scope="col">Product Name</th>
                     <th scope="col">Quantity</th>
					 <th scope="col">Packing Qty</th>
                     <th scope="col">Unit Price</th>
                     <th scope="col">Total Amount</th>
                     <th scope="col">Delivered Qty</th>
                     <th scope="col">Remaining Qty</th>
                     <th scope="col">Action </th>
                  </tr>
               </thead>
               <tbody>
                  @php  $i=1; 
                  $cartProductDetail = json_decode($order->cart_product_detail , true); 
                  @endphp
                  @foreach($cartProductDetail as  $ProductData)
                 
				 @php
				 
                  $getProductDetail = Helper::productDetail($ProductData['product_id']);
				  
                  $deliveredProductQty = Helper::deliveredProductQty($order->id,$ProductData['product_id']);
				 
				  $packTotalQty = ($ProductData['master_packing']*$ProductData['prod_qty']);
				  
				  $remaingQty = ($packTotalQty - $deliveredProductQty);
				  
                  @endphp 
                  <tr>
                     <td scope="row">{{$i++}}</td>
                     <td>
                        @if(!empty($getProductDetail->product_photo))
                        <a href=	"{{asset('public/uploads/product/product_photo/'.$getProductDetail->product_photo)}}" target="_blank" >
                        <img class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2" src="{{asset('public/uploads/product/product_photo/'.$getProductDetail->product_photo)}}"></a>
                        @endif
                     </td>
                     <td>PID00{{$ProductData['product_id']}}</td>
                     <td>{{$getProductDetail->product_name}}</td>
                     <td>{{$ProductData['prod_qty']}}</td>
					 <td>{{$packTotalQty}}</td>
                     <td>{{$ProductData['unit_price']}}</td>
                     <td>{{($ProductData['single_prod_sub_total'])}}</td>
                     <td>{{$deliveredProductQty}}</td>
                     <td>{{$remaingQty}}</td>
                     <td>
                        <div x-data="modal" class="">
                           <div class="flex items-center">
						      @if($remaingQty > 0)
                              <a href="#">
                              <button class="badge bg-info inline-flex" href="#" @click="toggle">Delivered Quantity</button>
                              </a>
							  @endif
                           </div>
                           <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                              <div class="flex items-start justify-center min-h-screen px-4">
                                 <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                       <h5 class="text-lg font-bold">Delivered Quantity</h5>
                                       <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                             <line x1="18" y1="6" x2="6" y2="18"></line>
                                             <line x1="6" y1="6" x2="18" y2="18"></line>
                                          </svg>
                                       </button>
                                    </div>
                                    <form action="{{route('delivered_product',['order_id'=>$order->id, 'product_id'=>$ProductData['product_id']])}}" method="POST">
                                       @csrf
                                       <div class="p-5">
                                          <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                                             <div> <label for="ctnTextarea">Quantity</label>
                                                <input id="delivered_product_qty" name="delivered_product_qty" value=""  type="number" placeholder="Enter Quantity" class="form-input" />
                                             </div>
                                          </div>
                                          <div class="flex justify-end items-center mt-8">
                                             <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                                             <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Save</button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            <div class="flex justify-end px-4">
               <div class="w-full md:w-80 font-semibold p-5">
                  <div class="flex items-center justify-between py-2">
                     <span>Sub Total :</span>
                     <span>₹ {{$order->subtotal_price}}</span>
                  </div>
                  <div class="flex items-center justify-between py-2">
                     <span>Portal Fees :</span>
                     <span>₹ {{$order->shipping_estimate}}</span>
                  </div>
                  <div class="flex items-center justify-between font-bold py-4 border-t dark:border-t-dark border-dashed">
                     <span>Final Amount :</span>
                     <span id="total">₹ {{$order->total_buy_price}}</span>
                  </div>
               </div>
            </div>
            <!-- --> 
            <div x-data="modal" class="">
               <div class="flex items-center">
                  <a href="#">
                  <button class="badge bg-success inline-flex" href="#" @click="toggle">Update Status</button>
                  </a>
               </div>
               <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                  <div class="flex items-start justify-center min-h-screen px-4">
                     <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                       
                        <div class="p-5">
                           <form method="POST" enctype="multipart/form-data" action="{{route('update_order_status', $order->id)}}">
                              @csrf
                              <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                                 <div>
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                       <h5 class="text-lg font-bold">Update Status</h5>
                                       <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                             <line x1="18" y1="6" x2="6" y2="18"></line>
                                             <line x1="6" y1="6" x2="18" y2="18"></line>
                                          </svg>
                                       </button>
                                    </div>
                                    <label for="">Update Order Status</label>
                                    <select class="form-select text-white-dark" id="OperationType" name="order_status" onChange="check(this);">
                                       <option value="">Update Status</option>
                                       <option value="Packed">Packed</option>
                                       <option value="Dispatched">Dispatched</option>
                                       <option value="Delivered">Delivered</option>
                                    </select>
                                 </div>
                                 <br>
                                 <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" id="OperationNos" style="display:none">
                                    <div>
                                       <label for="order_update_date">Date</label>
                                       {!! Form::date('order_update_date', null, array('placeholder' => 'Date','class' => 'form-input','id'=>'order_update_date')) !!}
                                    </div>
                                    <div>
                                       <label for="lr_number">LR Number</label>
                                       {!! Form::text('lr_number', null, array('placeholder' => 'Enter LR Number','class' => 'form-input','id'=>'lr_number')) !!}
                                    </div>
                                    <div>
                                       <label for="upload_lr_receipt">Receipt No.</label>
                                       {!! Form::file('upload_lr_receipt', null, array('placeholder' => 'Enter Upload Recipt','class' => 'form-input','id'=>'upload_lr_receipt')) !!}
                                    </div>
                                 </div>
                                 <div>
                                    <label for="order_status_comment">Comment</label>
                                    <textarea id="order_status_comment" rows="3" class="form-textarea" placeholder="Enter Comment" style="height: 100px;" name="order_status_comment" required></textarea>
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
   function check() {
       var dropdown = document.getElementById("OperationType");
       var current_value = dropdown.options[dropdown.selectedIndex].value;
   
       if (current_value == "Dispatched") {
           document.getElementById("OperationNos").style.display = "block";
       } else {
           document.getElementById("OperationNos").style.display = "none";
       }
   }
   document.addEventListener("alpine:init", () => {
       Alpine.data("modal", (initialOpenState = false) => ({
           open: initialOpenState,
   
           toggle() {
               this.open = !this.open;
           },
       }));
   });
</script>

@endpush