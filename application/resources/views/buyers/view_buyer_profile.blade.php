@php
 use App\Helpers\Helper;
  
  $profile_data = Helper::getProfile();
	 if($profile_data['auth_user']->for == 'buyer')
		{
			$profile_route = route('buyer_profile');
			
			if(!empty($profile_data['profile']->profile_img)){
				
				$profile_img = asset('public/uploads/buyer/profile_img/'.$profile_data['profile']->profile_img);
			}elseif(empty($profile_data['profile']->profile_img) && empty($profile_data['profile']->gender) ){
            $profile_img = asset('public/uploads/users/profile/profile.png');
         }elseif(!empty($profile_data['profile']->gender) && $profile_data['profile']->gender == 'Male'){
            
            $profile_img = asset('public/uploads/users/profile/profile_male.png');
         }elseif(!empty($profile_data['profile']->gender) && $profile_data['profile']->gender == 'Female'){
				
				$profile_img = asset('public/uploads/users/profile/profile.png');
			}
			
		}
	  
@endphp

@extends('admin.layouts.app')
@section('title','Buyer Profile')
@section('content')
<div>
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('buyer_profile')}}" class="text-primary hover:underline">Buyer</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Account Settings</span>
      </li>
   </ul>
</div>
<div class="pt-5">
   <div class="mb-5 flex items-center justify-between">
      <h5 class="text-lg font-semibold dark:text-white-light">Settings</h5>
      <button type="submit" class="btn btn-primary"><a href="{{route('edit_buyer_profile')}}">Edit Buyer Profile</a></button>
   </div>
   <div x-data="{tab: 'home'}">
      <ul class="mb-5 overflow-y-auto whitespace-nowrap border-b border-[#ebedf2] font-semibold dark:border-[#191e3a] sm:flex">
         <li class="inline-block">
            <a
               href="javascript:;"
               class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
               :class="{'!border-primary text-primary' : tab == 'home'}"
               @click="tab='home'"
               >
               <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                  <path
                     opacity="0.5"
                     d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                     stroke="currentColor"
                     stroke-width="1.5"
                     />
                  <path d="M12 15L12 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
               </svg>
               Basic Info
            </a>
         </li>
         <li class="inline-block">
            <a
               href="javascript:;"
               class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
               :class="{'!border-primary text-primary' : tab == 'payment-details'}"
               @click="tab='payment-details'"
               >
               <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                  <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                  <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5" />
               </svg>
               KYC
            </a>
         </li>
          <li class="inline-block">
            <a
               href="javascript:;"
               class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
               :class="{'!border-primary text-primary' : tab == 'bank-details'}"
               @click="tab='bank-details'"
               >
               <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                  <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                  <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5" />
               </svg>
               Bank Details
            </a>
         </li>
            <li class="inline-block">
            <a
               href="javascript:;"
               class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
               :class="{'!border-primary text-primary' : tab == 'contract-details'}"
               @click="tab='contract-details'"
               >
               <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                  <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                  <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5" />
               </svg>
               Contract
            </a>
         </li>
      </ul>
    <template x-if="tab === 'home'">
            <div>
              <!-- Flash  Message  start  -->
               <center id="alertMessageHide">@if ($message = Session::get('success'))
                  <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
               @endif
               </center>
               <!-- Flash  Message  End  -->
               <form class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" action="{{route('update_buyer_profile', Auth::user()->buyer_id)}}" method="post" enctype="multipart/form-data">
               @csrf
			   
			  
                  <h6 class="mb-5 text-lg font-bold">Buyer General Information</h6>
                  <div class="flex flex-col sm:flex-row">
                  
					<div class="mb-5 w-full sm:w-2/12 ltr:sm:mr-4 rtl:sm:ml-4">
						 <img
							src="{{$profile_img}}" alt="profile-default-image"
							class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32"
						/>
						
					</div>
                     
                     <div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2">
                         <div>
                        <label for="date_of_enrollment">Date Of Enrollment</label>
                        <input id="date_of_enrollment" type="text" name="date_of_enrollment"  value="{{$buyer->date_of_enrollment}}" placeholder="Customer ID" class="form-input" readonly="readonly">
                     </div>
                     
                 <!--
					 <div>
                        <label for="category_name">Category</label>
                        <input id="category_name" type="text" name="category_name"  value="" placeholder=" Enter Category" class="form-input" readonly="readonly">
                     </div>
                     <div>
                       <label for="managed_by">Managed By</label>
                     
                        <input id="managed_by" type="text" name="managed_by"  value="" placeholder="Show Managed By Name" class="form-input" readonly="readonly">
      
                    </div>-->
					
                     <div>
                        <label for="business_name">Business Name</label>
                        <input id="business_name" type="text" name="business_name"  value="{{$buyer->business_name}}" placeholder=" Enter Business Name" class="form-input" readonly="readonly">
                     </div>
                    
                     <div>
                        <label for="name">First Name</label>
                        <input id="first_name" type="text" name="first_name" value="{{$buyer->first_name}}"  placeholder="Enter First Name" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="name">Last Name</label>
                        <input id="last_name" type="text" name="last_name" value="{{$buyer->last_name}}" placeholder="Enter Last Name" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="name">Contact</label>
                        <input id="mobile" name="mobile" value="{{$buyer->mobile}}"  type="text" placeholder="Enter Mobile No" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="name">Email</label>
                        <input id="Email" type="text" name="email" value="{{$buyer->email }}" placeholder="Enter Email Address" class="form-input" readonly="readonly"/>
                     </div>
					 
					 <div class="flex justify-around pt-5">
                        <label for="name">Gender :</label>
                        <label class="inline-flex cursor-pointer">Male</label>
                        <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" value="Male" @if($buyer->gender == 'Male') checked="" @endif  />
                        <label class="inline-flex cursor-pointer">Female</label>
                        <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" value="Female" @if($buyer->gender == 'Female') checked="" @endif />
                     </div>
					
					 
                    <div>
                        <label for="present_address">Present Address</label>
                        <input id="present_address" type="text" name="present_address" value="{{$buyer->present_address }}" placeholder="Enter Present Address" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="pin_code">Pin Code</label>
                        <input id="pin_code" type="text" name="pin_code" value="{{$buyer->pin_code }}" placeholder="Enter Pin Code" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="state">State</label>
                        <input id="state" type="text" name="state" value="{{$buyer->state }}" placeholder="Enter State" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="country">Country</label>
                        <input id="country" type="text" name="country" value="{{$buyer->country }}" placeholder="Enter Country" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="city">City</label>
                        <input id="city" type="text" name="city" value="{{$buyer->city}}" placeholder="Enter City" class="form-input" readonly="readonly"/>
                     </div>

                        
                     <!--   <div>
                           <label for="name">Profile Image</label>
                           <input id="profile_img" type="file" name="profile_img"
                           class="form-input" readonly="readonly"/>
                        </div>-->
                   
                        
                      <!--   <div class="mt-3 sm:col-span-2">
                           <button type="submit" class="btn btn-success">Update</button>
                           
                        </div>
                      -->
                     </div>
                  </div>
               </form>
               
            </div>
         </template>
		 
		<template x-if="tab === 'payment-details'">
         <div>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-6">
               <div class="panel">
                  <div class="mb-5">
                     <h5 class="mb-4 text-lg font-semibold">Aadhar & Pan Deatails</h5>
                  </div>
                  <div class="mb-5">
                     <form action="{{route('update_buyer_profile', Auth::user()->buyer_id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                          
                     <div>
                        <label for="aadhar_no">Aadhar No</label>
                     
                           <input id="aadhar_no" name="aadhar_no" value="{{$buyer->aadhar_no}}" type="text" placeholder="Enter Aaadhar No" class="form-input" readonly="readonly"/>
                           @if(!empty($buyer->upload_aadhar_no))
                              <a href="{{asset('public/uploads/buyer/upload_aadhar_no/'.$buyer->upload_aadhar_no)}}" download="{{$buyer->upload_aadhar_no}}">
                                 <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-top:6px;">
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
                              <a href="{{asset('public/uploads/buyer/upload_aadhar_no/'.$buyer->upload_aadhar_no)}}" target="_blank">
                                 <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:133px;">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="margin-left: -13px;">
                                       <path
                                          opacity="0.5"
                                          d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                          stroke="currentColor"
                                          stroke-width="1.5"></path>
                                       <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                                    </svg>
                                    View 
                                 </button>
                              </a>
                              @endif
                     
                   
                    </div>
                  <div>
                        <label for="pan_no">Pan No</label>
                         <input id="pan_no" type="text" name="pan_no" value="{{$buyer->pan_no}}" placeholder="Enter Pan No" class="form-input" readonly="readonly"/>
                             @if(!empty($buyer->upload_pan_no))
                              <a href="{{asset('public/uploads/buyer/upload_pan_no/'.$buyer->upload_pan_no)}}" download="{{$buyer->upload_pan_no}}">
                                 <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-top:6px;">
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
                              <a href="{{asset('public/uploads/buyer/upload_pan_no/'.$buyer->upload_pan_no)}}" target="_blank">
                                 <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:133px;">
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
                        <label for="gst_no">GST No</label>
                     
                           <input id="gst_no" name="gst_no" value="{{$buyer->gst_no}}" type="text" placeholder="Enter Aaadhar No" class="form-input" readonly="readonly"/>
                           @if(!empty($buyer->upload_gst_no))
                              <a href="{{asset('public/uploads/buyer/upload_gst_no/'.$buyer->upload_gst_no)}}" download="{{$buyer->upload_gst_no}}">
                                 <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-top:6px;">
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
                              <a href="{{asset('public/uploads/buyer/upload_gst_no/'.$buyer->upload_gst_no)}}" target="_blank">
                                 <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:133px;">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="margin-left: -13px;">
                                       <path
                                          opacity="0.5"
                                          d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                          stroke="currentColor"
                                          stroke-width="1.5"></path>
                                       <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                                    </svg>
                                    View 
                                 </button>
                              </a>
                              @endif
                     
                   
                    </div>
                         
                          
                        </div>
                        <!--<button type="submit" class="btn btn-success">Update Profile</button>-->
                     </form>
                  </div>
               </div>
            </div>
         </div>
       </template> 
	   
	   
	    <template x-if="tab === 'bank-details'">
         <div>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-6">
               <div class="panel">
                  <div class="mb-5">
                     <h5 class="mb-4 text-lg font-semibold">Bank Deatails</h5>
                  </div>
                  <div class="mb-5">
                     <form action="{{route('update_buyer_profile', Auth::user()->buyer_id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                          
                           <div>
                              <label for="bank_name">Bank Name</label>
                             <input id="bank_name" type="text" name="bank_name" value="{{$buyer->bank_name}}" placeholder="Enter Bank Name" class="form-input" readonly="readonly"/>
                           </div>
                           <div>
                              <label for="ifsc_code">IFSC Code</label>
                              <input id="ifsc_code" type="text" name="ifsc_code" value="{{$buyer->ifsc_code}}" placeholder="Enter IFSC Code" class="form-input" readonly="readonly"/>
                           </div>
                           <div>
                              <label for="account_no">Bank Account No</label>
                              <input id="account_no" type="text" name="account_no" value="{{$buyer->account_no}}" placeholder="Enter Bank Account No" class="form-input" readonly="readonly"/>
                           </div>
                         
                           <div>
                        <label for="gst_no">Cheque Copy</label>
                           @if(!empty($buyer->cheque_copy))
                              <a href="{{asset('public/uploads/buyer/cheque_copy/'.$buyer->cheque_copy)}}" download="{{$buyer->cheque_copy}}">
                                 <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-top:6px;">
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
                              <a href="{{asset('public/uploads/buyer/cheque_copy/'.$buyer->cheque_copy)}}" target="_blank">
                                 <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:133px;">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="margin-left: -13px;">
                                       <path
                                          opacity="0.5"
                                          d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                          stroke="currentColor"
                                          stroke-width="1.5"></path>
                                       <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                                    </svg>
                                    View 
                                 </button>
                              </a>
                              @endif
                     
                   
                    </div>
                        </div>
                        <!--<button type="submit" class="btn btn-success">Update Profile</button>-->
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </template>
	  
      <template x-if="tab === 'contract-details'">
         <div>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-6">
               <div class="panel">
                  <div class="mb-5">
                     <h5 class="mb-4 text-lg font-semibold">Contract</h5>
                  </div>
                  <div class="mb-5">
                     <form action="{{route('update_buyer_profile', Auth::user()->buyer_id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                          
                         <div>
                           <label for="contract_img">View Contract File</label>
                            @if(!empty($buyer->contract_img))
                              <a href="{{asset('public/uploads/buyer/contract_img/'.$buyer->contract_img)}}" download="{{$buyer->contract_img}}">
                                 <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-top:6px;">
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
                              <a href="{{asset('public/uploads/buyer/contract_img/'.$buyer->contract_img)}}" target="_blank">
                                 <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:133px;">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="margin-left: -13px;">
                                       <path
                                          opacity="0.5"
                                          d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                          stroke="currentColor"
                                          stroke-width="1.5"></path>
                                       <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                                    </svg>
                                    View 
                                 </button>
                              </a>
                              @endif
                        </div>
                        </div>
                        <!--<button type="submit" class="btn btn-success">Update Profile</button>-->
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </template>
   
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
@endpush