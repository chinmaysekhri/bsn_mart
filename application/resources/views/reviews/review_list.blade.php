@php

use App\Helpers\Helper;

$auth_user  = Auth::user();

@endphp
@extends('admin.layouts.app')
@section('title','Product Review List')
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
      </h5>
    
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table" style="margin-top:60px;">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Review Date</th>
                     <th>Seller/Buyer Name</th>
                     <th>Product ID</th>
                     <th>Product Name</th>
                     <th>Review Rating</th>
                     <th>Review Comment</th>
                     <th>Status</th>
					 <th>Review Approval</th>
                  </tr>
               </thead>
               <tbody>
                
                  @php  $i=1; @endphp
				  
                  @foreach($reviewProduct as $review)
				  
				    @php
					
				    $getProductName = Helper::productDetail($review->product_id);
							 
					$productName    = $getProductName->product_name;
							 
					@endphp
				  
                  <tr>
                     <td>{{ $i++ }}</td>
                     <td>{{ $review->created_at }}</td>
					 
					 @php
				
		             $getSellerNameData = Helper::getBuyerSellerData($review->buyer_seller_id);
				 
		             $partyName        = $getSellerNameData->first_name.' '.$getSellerNameData->last_name;
				 
		             @endphp

                     <td>{{ $partyName }}</td>
                     <td>PID00{{ $review->product_id }}</td>
                     <td>{{ ucwords($productName) }}</td>
                     <td>{{ $review->review_rating }}</td>
                     <td><textarea>{{ $review->review_comment}}</textarea></td>
					 
				     @if($review->status == "Accept")
						 
					 <td class="btn btn-outline-success" style="margin-top: 15px;">Accept</td>
					 
					 @else
						 
                     <td class="btn btn-outline-danger" style="margin-top: 15px;">Reject</td>
                    
					 @endif
					
			            <!-- Date 16-12-2024  --> 
						    <td>
                                <div x-data="modal" class="">
                                    <div class="flex items-center justify-center">
                                        <a href="#">
                                            <button class="badge bg-success inline-flex" href="#" @click="toggle"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mr-2" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                </svg>Update Review Approval </button>
                                        </a>
                                    </div>
                                    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                                        <div class="flex items-start justify-center min-h-screen px-4">
                                            <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
											
											 <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                                    <h5 class="text-lg font-bold">Update Review Status</h5>
                                                    <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                </div>
												
                                                <form action="{{route('review_rating_status', $review->id)}}" method="POST">
											    @csrf
                                                <div class="p-5">
                                                    <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                                                        <div>
														<label for="">Update Review  Status</label>
														<select class="form-select text-white-dark" id="OperationType" name="status" onChange="check(this);">
														  <option value="">Select Review Status</option>
														  <option value="Reject">Reject</option>
														  <option value="Accept">Accept</option>
														  
														</select>
                                                        </div>
                                                        <br>
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
						 <!-- Date 16-12-2024  -->
                     
                  </tr>
				  
				  @endforeach
                
               </tbody>
            </table>
         </div>
        {{ $reviewProduct->links('admin.partials.pagination')}}
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
@endpush