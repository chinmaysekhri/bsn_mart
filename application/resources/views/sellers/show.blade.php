@php 
use App\Helpers\Helper;

@endphp

@extends('admin.layouts.app')
@section('title','Show Seller Detail')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{ route('sellers.index') }}" class="text-primary hover:underline">Seller</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Seller Details</span>
      </li>
   </ul>
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
      <!-- Grid -->
      <div class="panel">
         <!-- Flash  Message  start -->
         <center id="alertMessageHide">@if ($message = Session::get('success'))
            <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
            @endif
         </center>
         <!-- Flash  Message  End  -->
         <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">Show Seller Detail</h5>
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
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="UserID">
                  <strong>Seller Id:</strong>
                    JBNS000{{ $user->id }}
                  </label>
               </div>
               <div>
                  <label for="Enrollment">
                  <strong>Date Of Enrollment:</strong>
                  {{ $user->date_of_enrollment }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
			@php
			
			$cat_data =json_decode($user->category_id,true);
			if(empty($cat_data)){
				
		     $cat_data=[];
			}
			
			@endphp
               <div>
                  <label for="Enrollment">
                  <strong>Category:</strong>
				   @if(!empty($user->category_id))
                   @foreach($cat_data as $category_id)
                  
				  {{ Helper::getcategoryeData($category_id)->category_name}},
				  
				  @endforeach
				  @endif
                  </label>
               </div>
               <div>
                  <label for="business_name">
                  <strong>Business Name:</strong>
                 {{ $user->business_name }}
                  </label>
               </div>
            </div>
			
			
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
			
               <div>
                  <label for="Address">
                  <strong>Created By:</strong>
                  @if(!empty($sellerCreatedBy))
                  {{ $sellerCreatedBy->first_name .' '. $sellerCreatedBy->last_name }}
                  @endif
                  </label>
               </div>

			   <div>
                  <label for="Address">
                  <strong>Managed By:</strong>
                  @if(!empty($user_emp_manage))
                  {{ $user_emp_manage->first_name .' '. $user_emp_manage->last_name }}
                  @endif
                  </label>
               </div>
			   
			<?php /* <div>
				 @php 

				 $i=1;

				 $getDesignationName = Helper::getDesignationName($user->designation);
				 
				 $designationName = $getDesignationName->designation_name;
			 
				 @endphp
                  <label for="Contact">
                  <strong>Designation:</strong>
				  @if(!empty($designationName))
                  {{ $designationName }}
			      @endif
                  </label>
               </div> */?>
			   
            </div>
			
			
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="brand_name">
                  <strong>Brand Name:</strong>
                 {{ $user->brand_name }}
                  </label>
               </div>
               <div>
                  <label for="brand_name"></label>
                  <strong>Upload Brand Registration:</strong>
                   @if(!empty($user->brand_registration_upload))
                     <a href="{{asset('public/uploads/seller/brand_registration_upload/'.$user->brand_registration_upload)}}" download="{{$user->brand_registration_upload}}">
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
                     <a href="{{asset('public/uploads/seller/brand_registration_upload/'.$user->brand_registration_upload)}}" target="_blank">
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

              
            </div>

             <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               
               <div>
                  <label for="brand_name"></label>
                  <strong>Upload Seller Brand Logo:</strong>
                   @if(!empty($user->seller_brand_logo))
                     <a href="{{asset('public/uploads/seller/seller_brand_logo/'.$user->seller_brand_logo)}}" download="{{$user->seller_brand_logo}}">
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
                     <a href="{{asset('public/uploads/seller/seller_brand_logo/'.$user->seller_brand_logo)}}" target="_blank">
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

            </div><hr><br>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="First">
                  <strong>Name:</strong>
                  {{ $user->first_name .' '. $user->last_name }}
                  </label>
               </div>
                <div>
                  <label for="Mobile">
                  <strong>Contact:</strong>
                  {{ $user->mobile }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label for="Gender">
                  <strong>Gender:</strong>
                 {{ $user->gender }}
                  </label>
               </div>
               <div>
                  <label for="Email">
                  <strong>Email:</strong>
                 {{ $user->email }}
                  </label>
               </div>
            </div>
           
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="Present">
                  <strong>Present Address:</strong>
                  {{ $user->present_address }}
                  </label>
               </div>
               <div>
                  <label for="Present">
                  <strong>Pin Code:</strong>
                  {{ $user->pin_code }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="Cuntry">
                  <strong>Cuntry:</strong>
                  {{ $user->country }}
                  </label>
               </div>
			   <div>
                  <label for="state">
                  <strong>State:</strong>
                 {{ $user->state }}
                  </label>
               </div>
			 
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label for="GST">
                  <strong>City:</strong>
                  {{ $user->city }}
                  </label>
               </div>
			   <div>
                  <label for="district">
                  <strong>District:</strong>
                 {{ $user->district }}
                  </label>
               </div>
            </div>
            <hr>
            <br>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
             <div>
                  <label for="Aadhar">
                  <strong>Aadhar No:</strong>
                 {{ $user->aadhar_no }}
                  @if(!empty($user->upload_aadhar_no))
                  <a href="{{asset('public/uploads/seller/upload_aadhar_no/'.$user->upload_aadhar_no)}}" download="{{$user->upload_aadhar_no}}">
                      <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:193px; margin-top: -24px;">
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
                  <a href="{{asset('public/uploads/seller/upload_aadhar_no/'.$user->upload_aadhar_no)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:300px;">
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
               
            
               <div>
                  <label for="PAN">
                  <strong>PAN No:</strong>
                 {{ $user->pan_no }}
                  @if(!empty($user->upload_pan_no))
                  <a href="{{asset('public/uploads/seller/upload_pan_no/'.$user->upload_pan_no)}}" download="{{$user->upload_pan_no}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:169px; margin-top: -24px;">
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
                 <a href="{{asset('public/uploads/seller/upload_pan_no/'.$user->upload_pan_no)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:283px;">
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
            <br>
           <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                 <div>
                  <label for="GST">
                  <strong>GST:</strong>
                  {{ $user->gst_no }}
                   @if(!empty($user->upload_gst_no))
                   <a href="{{asset('public/uploads/seller/upload_gst_no/'.$user->upload_gst_no)}}" download="{{$user->upload_gst_no}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:193px; margin-top: -24px;">
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
                  <a href="{{asset('public/uploads/seller/upload_gst_no/'.$user->upload_gst_no)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:300px;">
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
            <hr>
            <br>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="Present">
                  <strong>Bank Name:</strong>
                  {{ $user->bank_name }}
                  </label>
               </div>
               <div>
                  <label for="Present">
                  <strong>IFSC Code:</strong>
                 {{ $user->ifsc_code }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="Present">
                  <strong>Bank Account No:</strong>
                 {{ $user->account_no }}
                  </label>
               </div>
               <div>
                  <label for="Cheque"></label>
                  <strong> Cheque Copy:</strong>
                  @if(!empty($user->cheque_copy))
                   <a href="{{asset('public/uploads/seller/cheque_copy/'.$user->cheque_copy)}}" download="{{$user->cheque_copy}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:117px; margin-top: -24px;">
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
                   <a href="{{asset('public/uploads/seller/cheque_copy/'.$user->cheque_copy)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:230px;">
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
               </div>
               <div>
                  <label for="Cheque"></label>
                  <strong>Select Contract File :</strong>
                   @if(!empty($user->contract_img))
                   <a href="{{asset('public/uploads/seller/contract_img/'.$user->contract_img)}}" download="{{$user->contract_img}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:139px; margin-top: -24px;">
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
                   <a href="{{asset('public/uploads/seller/contract_img/'.$user->contract_img)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:248px;">
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
            </div>
            <hr>
            <br>
			<div>
			  <label for="Status">
				 <strong>Status:</strong>
				 @if($user->status==1)
				 <span class="text-success">Active</<span>
				 @else 
				 <span class="text-danger">Deactive</span>
				 @endif
			  </label>
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
@endpush