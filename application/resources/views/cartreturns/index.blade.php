@php

use App\Helpers\Helper;

$auth_user  = Auth::user();

@endphp
@extends('admin.layouts.app')
@section('title','Cart Return List')
@section('content')

<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
      <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0">              
         <a class="badge bg-success" href="{{route('my_product_order')}}">My Product Order</a>
         <a class="badge bg-success" href="{{route('product_review_list')}}">Product Review List</a>
          <a href="{{route('cartreturns.index')}}"  class="btn btn-primary" style="margin-left: 775px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

       <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:262px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
      </h5>
    
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <br>
          <form method="GET" action="{{route('cartreturns.index')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('cartreturns.index',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                         <select class="form-input" name="seller_buyer_data" id="seller_buyer_data" value="{{Request::input('next_action_to')}}">
                           <option value="">Select Seller Name</option>
                           @foreach($buyerSellerData as $buyerseller)
                            <option value="{{ $buyerseller->id }}" @if(Request::input('seller_buyer_data')  == $buyerseller->id) selected @endif >{{ ucwords($buyerseller->first_name.' '.$buyerseller->last_name)}}({{ ucwords($buyerseller->for) }})</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                </div>
            
                   <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-3">
                
                   <div>
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="today_applied_status" id="order_status">
                           <option value="">Select Seller Status</option>
                           <option value="Received" @if(Request::input('today_applied_status') == 'Received') selected @endif >Received</option>
                           <option value="Completed" @if(Request::input('today_applied_status') == 'Completed') selected @endif >Completed</option>
                           <option value="Pending" @if(Request::input('today_applied_status') == 'Pending') selected @endif >Pending</option>
                           
                           
                        </select>
                     </div>
                  </div>
               
                 <div>
                     <button type="submit" class="btn btn-outline-success" style="padding-right: 64px;padding-left:64px;" >Submit</button>
                  </div>
                   </div>
                 
            </div>

         </form>
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table" style="margin-top:60px;">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Date</th>
                     <th>Return ID</th>
                     <th>Party Name</th>
					 <th>Status</th>
					 <th>LR Data</th>
                     <th>Update Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                
                  @php  $i=1; @endphp
				  
                  @foreach($cartReturnOrder as $return)
				  @php
				
					$getSellerNameData = Helper::getBuyerSellerData($return->buyer_seller_id);
							 
					$partyName        = $getSellerNameData->first_name.' '.$getSellerNameData->last_name;
							 
					@endphp
				  
                  <tr>
                     <td>{{ $i++ }}</td>
                     <td>{{ $return->return_date }}</td>
                     <td>{{ $return->cart_return_id }}</td>
                     <td>{{$partyName}}</td>
                    
                     
                     @if($return->cartreturn_status == "Dispatched")
						 
                     <td class="btn btn-outline-info" style="margin-top: 15px;">Dispatched</td>
                    
				     @elseif($return->cartreturn_status == "Received")
						 
					 <td class="btn btn-outline-success" style="margin-top: 15px;">Received</td>
					 
					 @elseif($return->cartreturn_status == "Not Received")
						 
					 <td class="btn btn-outline-success" style="margin-top: 15px;">Not Received</td>
					 @elseif($return->cartreturn_status == "Completed")
						 
					 <td class="btn btn-outline-success" style="margin-top: 15px;">Completed</td>
					 
					 @elseif($return->cartreturn_status == "Returned")
						 
					 <td class="btn btn-outline-info" style="margin-top: 15px;">Returned</td>
					 @else
						 
                     <td class="btn btn-outline-danger" style="margin-top: 15px;">Pending</td>
                    
					@endif
				  	 
	<!-- Date 19-12-2024 start --> 
	                 @if($return->cartreturn_status == "Dispatched" || $return->cartreturn_status == "Returned")
	                  <td>
                        <div x-data="modal" class="">
                           <div class="flex items-center">
                              <a href="#">
                              <button class="btn btn-success" href="#" @click="toggle" style="padding: 3px 5px 3px 5px;">Dispatched LR Copy</button>
                              </a>
                           </div>
                           <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                              <div class="flex items-start justify-center min-h-screen px-4">
                                 <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                       <h5 class="text-lg font-bold">Dispatched LR Data</h5>
                                       <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                             <line x1="18" y1="6" x2="6" y2="18"></line>
                                             <line x1="6" y1="6" x2="18" y2="18"></line>
                                          </svg>
                                       </button>
                                    </div>
                                   
                                       <div class="p-5">
                                          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                             <div>
                                                <label for="Buyer Name">
                                                <strong>Date :</strong>
                                                <strong>{{$return->dispatched_lr_date}}</strong>
                                                </label>
                                             </div>
                                             <div>
                                                <label for="private_marka">
                                                <strong>LR Number :</strong>
                                                <strong>{{$return->dispatched_lr_no}}</strong>
                                                </label>
                                             </div>
                                             <div>
                                                <strong>LR Copy :</strong>
                                             </div>
                                             <div>
                                                @if(!empty($return->dispatched_lr_copy))
                                                <a href="{{asset('public/uploads/order/dispatched_lr_copy/'.$return->dispatched_lr_copy)}}" download="{{$return->dispatched_lr_copy}}">
                                                   <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;">
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
                                                <a href="{{asset('public/uploads/order/dispatched_lr_copy/'.$return->dispatched_lr_copy)}}" target="_blank">
                                                   <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:130px;">
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
                                             </div>
                                             <div>
                                                <label for="Buyer Name">
                                                <strong>Comment :</strong>
                                                <strong>{{$return->return_lr_comment}}</strong>
                                                </label>
                                             </div>
                                          </div>
                                       </div>
                                   
                                 </div>
                              </div>
                           </div>
                        </div>
						
						<!-- Date 21-12-2024 -->
						
                        <div x-data="modal" class="">
                           <div class="flex items-center">
                              <a href="#">
                              <button class="btn btn-info" href="#" @click="toggle" style="padding: 3px 5px 3px 5px;">Returned LR Copy</button>
                              </a>
                           </div>
                           <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                              <div class="flex items-start justify-center min-h-screen px-4">
                                 <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                       <h5 class="text-lg font-bold">Returned LR Data</h5>
                                       <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                             <line x1="18" y1="6" x2="6" y2="18"></line>
                                             <line x1="6" y1="6" x2="18" y2="18"></line>
                                          </svg>
                                       </button>
                                    </div>
                                   
                                       <div class="p-5">
                                          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                             <div>
                                                <label for="Buyer Name">
                                                <strong>Date :</strong>
                                                <strong>{{$return->return_lr_date}}</strong>
                                                </label>
                                             </div>
                                             <div>
                                                <label for="private_marka">
                                                <strong>LR Number :</strong>
                                                <strong>{{$return->return_lr_no}}</strong>
                                                </label>
                                             </div>
                                             <div>
                                                <strong>LR Copy :</strong>
                                             </div>
                                             <div>
                                                @if(!empty($return->return_lr_copy))
                                                <a href="{{asset('public/uploads/order/return_lr_copy/'.$return->return_lr_copy)}}" download="{{$return->return_lr_copy}}">
                                                   <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;">
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
                                                <a href="{{asset('public/uploads/order/return_lr_copy/'.$return->return_lr_copy)}}" target="_blank">
                                                   <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:130px;">
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
                                             </div>
											 @if(!empty($return->return_lr_comment))
                                             <div>
                                                <label for="Buyer Name">
                                                <strong>Comment :</strong>
                                                <strong>{{$return->return_lr_comment}}</strong>
                                                </label>
                                             </div>
											 @endif
                                          </div>
                                       </div>
                                   
                                 </div>
                              </div>
                           </div>
                        </div>
					
                     </td>
					 @else
					<td>
                        <div x-data="modal" class="">
                           <div class="flex items-center">
                              <a href="#">
                              <button class="btn btn-danger" href="#" @click="toggle" style="padding: 3px 5px 3px 5px;">Pending LR Copy</button>
                              </a>
                           </div>
                           <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                              <div class="flex items-start justify-center min-h-screen px-4">
                                 <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                       <h5 class="text-lg font-bold">Pending LR Data</h5>
                                       <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                             <line x1="18" y1="6" x2="6" y2="18"></line>
                                             <line x1="6" y1="6" x2="18" y2="18"></line>
                                          </svg>
                                       </button>
                                    </div>
                                   
                                       <div class="p-5">
                                          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                             <div>
                                                <label for="Buyer Name">
                                                <strong></strong>
                                                <strong></strong>
                                                </label>
                                             </div>
                                             <div>
                                                <label for="private_marka">
                                               
                                                <strong></strong>
                                                </label>
                                             </div>
                                             <div>
                                                <strong></strong>
                                             </div>
                                             <div>
                                                
                                                <a href="#" download="">
                                                   
                                                </a>
                                                <a href="#">
                                                  
                                                </a>
                                               
                                             </div>
                                             <div>
                                                <label for="Buyer Name">
                                                <strong>Comment :</strong>
                                                <strong style="color:red">{{$return->return_lr_comment}}</strong>
                                                </label>
                                             </div>
                                          </div>
                                       </div>
                                   
                                 </div>
                              </div>
                           </div>
                        </div>
					
                     </td>
					 @endif
	
	<!-- Date 19-12-2024 End -->

	<!-- Date 19-12-2024 start --> 
		<td>
		<div x-data="modal" class="">
               <div class="flex items-center">
                  <a href="#">
                  <button class="badge bg-success inline-flex" href="#" @click="toggle">Update Return Status</button>
                  </a>
               </div>
               <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                  <div class="flex items-start justify-center min-h-screen px-4">
                     <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                       
                        <div class="p-5">
                           <form method="POST" enctype="multipart/form-data" action="{{route('update_lr_status', $return->id)}}">
                              @csrf
                              <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                                 <div>
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                       <h5 class="text-lg font-bold">Update Return Cart Status</h5>
                                       <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                             <line x1="18" y1="6" x2="6" y2="18"></line>
                                             <line x1="6" y1="6" x2="18" y2="18"></line>
                                          </svg>
                                       </button>
                                    </div>
                                   
									 <label for="">Select Return Cart Status</label>
									  <select class="form-select text-white-dark" id="OperationType" name="cartreturn_status" onChange="check(this);">
                                       <option value="">Select Return Cart Status</option>
									   <option value="Dispatched">Dispatched</option>
									   <option value="Received">Received</option>
									   <option value="Not Received">Not Received</option>
									    <option value="Completed">Completed</option>
									   <option value="Returned">Returned</option>
									   </select>
									  
                                 </div>
                                 <br>
								 
								 <!-- Dispatched Data 20-12-2024  Start -->
								 
                                 <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" id="OperationNos" style="display:none">
                                    <div>
                                       <label for="dispatched_lr_date">Dispatched LR Date</label>
                                       {!! Form::date('dispatched_lr_date', null, array('placeholder' => 'Date','class' => 'form-input','id'=>'dispatched_lr_date')) !!}
                                    </div>
                                    <div>
                                       <label for="dispatched_lr_no">Dispatched LR Number</label>
                                       {!! Form::text('dispatched_lr_no', null, array('placeholder' => 'Enter LR Number','class' => 'form-input','id'=>'dispatched_lr_no')) !!}
                                    </div>
                                    <div>
                                       <label for="dispatched_lr_copy">Dispatched LR Copy</label>
                                       {!! Form::file('dispatched_lr_copy', null, array('placeholder' => 'Upload LR Copy','class' => 'form-input','id'=>'dispatched_lr_copy')) !!}
                                    </div>
                                 </div>
								 
								 <!-- Dispatched Data 20-12-2024  End -->
								 
								 
								 <!-- Returned Data 20-12-2024 Start  -->
								 <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" id="OperationNos2" style="display:none">
                                    <div>
                                       <label for="return_lr_date">Returned LR Date</label>
                                       {!! Form::date('return_lr_date', null, array('placeholder' => 'Date','class' => 'form-input','id'=>'return_lr_date')) !!}
                                    </div>
                                    <div>
                                       <label for="return_lr_no">Returned LR Number</label>
                                       {!! Form::text('return_lr_no', null, array('placeholder' => 'Enter Returned LR Number','class' => 'form-input','id'=>'return_lr_no')) !!}
                                    </div>
                                    <div>
                                       <label for="return_lr_copy">Returned LR Copy</label>
                                       {!! Form::file('return_lr_copy', null, array('placeholder' => 'Returned LR Copy','class' => 'form-input','id'=>'return_lr_copy')) !!}
                                    </div>
                                 </div>
								
								<!-- Returned Data 20-12-2024 End  -->
								 
                                 <div>
                                    <label for="return_lr_comment">Comment</label>
                                    <textarea id="return_lr_comment" rows="3" class="form-textarea" placeholder="Enter Comment" style="height: 100px;" name="return_lr_comment" required></textarea>
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
			</td>
						 <!-- Date 19-12-2024 end -->
                     
                     <td>

                        <a class="badge bg-info" href="{{ route('cartreturns.show',$return->id) }}">View</a>
						
                        <a class="badge bg-primary" href="{{ route('cartreturns.edit',$return->id) }}">Edit</a>
						
                     </td>
                  </tr>
				  
				  @endforeach
                
               </tbody>
            </table>
         </div>
        {{ $cartReturnOrder->links('admin.partials.pagination')}}
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

<!-- date 19-12-2024-->
<script>
   function check() {
       var dropdown      = document.getElementById("OperationType");
       var current_value = dropdown.options[dropdown.selectedIndex].value;

       if (current_value == "Dispatched") {
           document.getElementById("OperationNos").style.display = "block";
        
       }else {
           document.getElementById("OperationNos").style.display = "none";
       }
	   
	    if (current_value == "Returned") {
           document.getElementById("OperationNos2").style.display = "block";
        
       }else {
           document.getElementById("OperationNos2").style.display = "none";
       } 
	   
	   document.addEventListener("alpine:init", () => {
       Alpine.data("modal", (initialOpenState = false) => ({
           open: initialOpenState,
   
           toggle() {
               this.open = !this.open;
           },
       }));
   });  
	   
   }

</script>


@endpush
