@php

use App\Helpers\Helper;

$auth_user  = Auth::user();

@endphp

@extends('admin.layouts.app')
@section('title','Add Fund Recipts List')
@section('content')

<div x-data="form">
    <div class="panel">
	   <ul class="flex space-x-2 rtl:space-x-reverse">
         <li>
            <a href="{{route('wallets.index')}}" class="text-primary hover:underline">Wallet</a>
         </li>
         <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add Fund</span>
         </li>
      </ul>
        <a href="{{route('funds.index')}}"  class="btn btn-primary" style="margin-left:955px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

       <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:140px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
	  <br>
        <!-- Flash  Message  start -->
        <center id="alertMessageHide">
            @if ($message = Session::get('success'))
            <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
            @endif
        </center>
        <!-- Flash  Message  End  -->

      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
        <div class="">
        <form method="GET" action="{{route('funds.index')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('funds.index',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                       <select class="form-input" name="seller_buyer_data" id="seller_buyer_data" value="{{Request::input('seller_buyer_data')}}">
                           <option value="">Select Seller/Buyer Name</option>
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
                <table id="myTable1" class="whitespace-nowrap dataTable-table">
                    <thead>
                        
                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Payment ID</th>
                            <th>Amount</th>
                            <th>Refference No.</th>
                            <th>Buyer/seller Name</th>
                            <th>Status</th>
                            <th>Receipt</th>
							@if($auth_user->for == 'super_admin')
							<th>Update Status</th>
						    @endif
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
					
					
					@php 
					
					$i=1; 
					@endphp
					
					@foreach($fundData as $fund)
					
					
					@php
					
				
					$buyerSellerData = Helper::getBuyerSellerData($fund->fund_to);
					
					if(!empty($buyerSellerData)){
						
					 $buyerSellerName = $buyerSellerData->first_name.' '.$buyerSellerData->last_name;	
					
					}else{
						
						 $buyerSellerName =  "";
					}
					
					@endphp
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$fund->fund_date}}</td>
                            <td>{{$fund->payment_fund_id}}</td>
                            <td>{{$fund->fund_amount}}</td>
                            <td>#{{$fund->fund_receipt_no}}</td>
                            <td>{{ $buyerSellerName}}</td>
                            <td>{{$fund->fund_status}}</td>
                            <td>
							
							<a href="{{asset('public/uploads/funds/upload_fund_receipt/'.$fund->upload_fund_receipt)}}" target="_blank">
								<button type="button" class="btn btn-primary gap-2" style="padding: 1px 14px 1px 14px;">
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
					 
					       </td>
						   
                           @if($auth_user->for == 'super_admin')
                            <td>
                                <div x-data="modal" class="">
                                    <div class="flex items-center justify-center">
                                        <a href="#">
                                            <button class="badge bg-success inline-flex" href="#" @click="toggle"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mr-2" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                </svg>Update</button>
                                        </a>
                                    </div>
                                    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                                        <div class="flex items-start justify-center min-h-screen px-4">
                                            <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
											
											 <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                                    <h5 class="text-lg font-bold">Update Status</h5>
                                                    <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                </div>
												
                                                <form action="{{route('add_fund_comment',array_merge([$fund->id],$requested_input))}}" method="POST">
											    @csrf
                                                <div class="p-5">
                                                    <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                                                        <div> <label for="ctnTextarea">Update Fund Status</label>
                                                            <select class="form-input" name="fund_status" id="fund_status" required="">
															
                                                                <option value="">--Update Fund Status--</option>
                                                                <option value="Confirmed">Confirmed</option>
                                                                <option value="Rejected">Rejected</option>
                                                            </select>
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <label for="ctnTextarea">Comment</label>
                                                            <textarea id="ctnTextarea" rows="3" class="form-textarea" name="comment" placeholder="Enter Comment" style="height: 100px;" required></textarea>
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
                           @endif
                            <td>
                                <a href="{{route('funds.show',$fund->id)}}">
                                    <button class="badge bg-primary inline-flex" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill mr-2" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg>View Comments</button>
                                </a>
                            </td>
                        </tr>
                         @endforeach
                    </tbody>
                </table>
            </div>
		{{ $fundData->links('admin.partials.pagination')}}
          
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
   function mystatusFunction() {
     var x = document.getElementById("mystatusDIV");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script>

@endpush