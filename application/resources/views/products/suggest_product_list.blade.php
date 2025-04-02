@php

use App\Helpers\Helper;

$auth_user  = Auth::user();

@endphp
@extends('admin.layouts.app')
@section('title','Sugget Product List')
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
         <a class="badge bg-success" href="{{route('product_list')}}">Suggest Product</a>
      </h5>
    
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table" style="margin-top:60px;">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Date</th>
                     <th>User Name</th>
                     <th>Product Name</th>
                     <th>Price Range</th>
                     <th>Brand Name</th>
                     <th>Monthly Requirement</th>
                     <th>Status Comment</th>
                     <th>Status</th>
                     <th>Suggest Product Image</th>
                     <th>Action</th>
					 
               </tr>
               </thead>
               <tbody>
                
                  @php  $i=1; @endphp
				  
                  @foreach($suggestProduct as $suggest)
				  
				 @php
				
                 $getUserNameData = Helper::getUserDataByID($suggest->created_by);
				 
                 $userName    = $getUserNameData->first_name.' '.$getUserNameData->last_name;
				 
                 @endphp
                  <tr>
                     <td>{{ $i++ }}</td>
                     <td>{{ $suggest->created_at->format('d-M-Y') }}</td>
                     <td>{{ $userName}}</td>
                     <td>{{ $suggest->suggest_product_name }}</td>
                     <td>{{ $suggest->suggest_price_range }}</td>
                     <td>{{ $suggest->suggest_brand_name }}</td>
                     <td>{{ $suggest->monthly_requirement }}</td>
                     <td>{{ $suggest->comment }}</td>
					 
					 @if($suggest->status=='Product Listed')
					 	 
                      <td style="color:Blue">{{ $suggest->status }}</td>
				 
					 @elseif($suggest->status=='Already Available')
						 
					  <td style="color:green">{{ $suggest->status }}</td> 
					 
					 @else
						 
					   <td style="color:red">{{ $suggest->status }}</td>
                     
					 @endif
				
				  <td>
					 
					<?php /*  @if(!empty($suggest->suggest_product_img))
					  <a href="{{asset('public/uploads/suggetproduct/suggest_product_img/'.$suggest->suggest_product_img)}}" download="{{$suggest->suggest_product_img}}">
                        <button type="button" class="btn btn-success gap-2" style="padding: 1px 5px 1px 3px;margin-left:63px; margin-top: -4px;">
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
                     @endif */?>
                     <a href="{{asset('public/uploads/suggetproduct/suggest_product_img/'.$suggest->suggest_product_img)}}" target="_blank">
                        <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -5px;margin-left:8px;">
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
					 
					 <td>
					 
						<div x-data="modal">
						<div class="flex items-center">
						  <a href="#">
						  <button class="badge bg-success inline-flex" href="#" @click="toggle">Update Suggest Status</button>
						  </a>
						</div>
						<div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
						  <div class="flex items-start justify-center min-h-screen px-4">
							 <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
							   
								<div class="p-5">
									<form method="POST" enctype="multipart/form-data" action="{{route('update_exclusive_status',$suggest->id)}}">
									 @csrf
									  <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
										 <div>
											<div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
											   <h5 class="text-lg font-bold">Update Suggest Status</h5>
											   <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
												  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
													 <line x1="18" y1="6" x2="6" y2="18"></line>
													 <line x1="6" y1="6" x2="18" y2="18"></line>
												  </svg>
											   </button>
											</div>
											<label for="">Update Suggest Status</label>
											<select class="form-select text-white-dark" id="OperationType" name="status" onChange="check(this);">
											   <option value="">Suggest Status</option>
											   <option value="Product Listed">Product Listed</option>
											   <option value="Already Available">Already Available</option>
											   
											</select>
										 </div>
										 
										 <div>
                                           <label for="comment">Comment</label>
                                            <textarea id="comment" rows="3" class="form-textarea" placeholder="Enter Comment" style="height: 100px;" name="comment"></textarea>
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
					 
                  </tr>
				  
				  @endforeach
                
               </tbody>
            </table>
         </div>
        {{ $suggestProduct->links('admin.partials.pagination')}}
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