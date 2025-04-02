@php
 use App\Helpers\Helper;
  
  $profile_data = Helper::getProfile();
	  if($profile_data['auth_user']->for == 'employee')
	   {
			$profile_route = route('employee_profile');
			
			if(!empty($profile_data['profile']->profile_img)){
				
			$profile_img = asset('public/uploads/employee/'.$profile_data['profile']->id.'/profile_img/'.$profile_data['profile']->profile_img);
			
			}elseif(empty($profile_data['profile']->profile_img) && empty($profile_data['profile']->gender) ){
				
				$profile_img = asset('public/uploads/users/profile/profile.png');
			}elseif(!empty($profile_data['profile']->gender) && $profile_data['profile']->gender == 'Male'){
				
				$profile_img = asset('public/uploads/users/profile/profile_male.png');
			}elseif(!empty($profile_data['profile']->gender) && $profile_data['profile']->gender == 'Female'){
				$profile_img = asset('public/uploads/users/profile/profile_female.png');
			}
	  }
	  
@endphp

@extends('admin.layouts.app')
@section('title',' View Employee Profile')
@section('content')
<div>
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('employee_profile')}}" class="text-primary hover:underline">Employee</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Employee Settings</span>
      </li>
   </ul>
</div>
<div class="pt-5">
<div class="mb-5 flex items-center justify-between">
   <h5 class="text-lg font-semibold dark:text-white-light">Settings</h5>
   @if($employee->final_verified=='Not Verified')
   <button type="submit" class="btn btn-primary"><a href="{{route('edit_employee_profile')}}">Edit Employee Profile</a></button>
   @endif
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
 <i class="fa fa-info-circle"></i>
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
        <i class="fa fa-check-circle" aria-hidden="true"></i>
         KYC
      </a>
   </li>
   <li class="inline-block">
      <a
         href="javascript:;"
         class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
         :class="{'!border-primary text-primary' : tab == 'qualification'}"
         @click="tab='qualification'"
         >
        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
         Qualification
      </a>
   </li>
   <li class="inline-block">
      <a
         href="javascript:;"
         class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
         :class="{'!border-primary text-primary' : tab == 'employe'}"
         @click="tab='employe'"
         >
        <i class="fa fa-file" aria-hidden="true"></i>
      Employment Details
      </a>
   </li>
  <!--  <li class="inline-block">
      <a
         href="javascript:;"
         class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
         :class="{'!border-primary text-primary' : tab == 'preferences'}"
         @click="tab='preferences'"
         >
         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
            <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5" />
         </svg>
         Bank Detail
      </a>
   </li> -->
   
  <?php /* @if($employee->designation=='Admin' || $employee->designation=='HR')
	@endif */?>


   <li class="inline-block">
      <a
         href="javascript:;"
         class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
         :class="{'!border-primary text-primary' : tab == 'company'}"
         @click="tab='company'"
         >
       <i class="fa fa-file-text" aria-hidden="true"></i>
         Company Document
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
      <form class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" action="#" method="post" enctype="multipart/form-data">
         @csrf
         <h6 class="mb-5 text-lg font-bold">General Information</h6>
         <div class="flex flex-col sm:flex-row">
            <div class="mb-5 w-full sm:w-2/12 ltr:sm:mr-4 rtl:sm:ml-4">
               <img
                  src="{{$profile_img}}" alt="profile-default-image"
                  class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32"
                  />
                   
            </div>
            <div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2">
               <div>
                  <label for="name:">Employee ID</label>
                  <input id="customer_id" type="text" name="id"  value="EMP000{{$employee->id}}" placeholder="Customer ID" class="form-input" readonly="readonly">
               </div>
               
              
               @if(!empty($user_emp_manage->first_name))
               
               <div>
                  <label for="name">My Manager</label>
                  
                  <input id="managedBy:" type="text" name="managed_by"  value="{{$user_emp_manage->first_name.' '.$user_emp_manage->last_name}}" class="form-input" readonly="readonly"/>
               </div>
               @else
               <div>
                  <label for="name">My Manager</label>
                  
                  <input id="managedBy:" type="text" name="managed_by"  value="Self" class="form-input" readonly="readonly"/>
               </div>
               @endif
               
                <div>
                  <label for="name">Date Of Joining</label>
                  <input id="date_of_joining:" type="text" name="date_of_joining"  value="{{$employee->date_of_joining}}" class="form-input" readonly="readonly"/>
               </div>
                <div>
                  <label for="name">Designation</label>
                  <input id="designation:" type="text" name="designation"  value="{{$employee->designation}}" class="form-input" readonly="readonly"/>
               </div>
               
                <div>
                  <label for="name">Salary</label>
                  <input id="designation:" type="text" name="salary"  value="{{$employee->salary}}" class="form-input" readonly="readonly"/>
               </div>
               
               <div>
                  <label for="name">First Name</label>
                  <input id="first_name" type="text" name="first_name" value="{{$employee->first_name}}"  placeholder="Enter First Name" class="form-input" readonly="readonly"/>
               </div>
               <div>
                  <label for="name">Last Name</label>
                  <input id="last_name" type="text" name="last_name" value="{{$employee->last_name}}" placeholder="Enter Last Name" class="form-input" readonly="readonly"/>
               </div>
               <div>
                  <label for="name">Contact</label>
                  <input id="mobile" name="mobile" value="{{$employee->mobile}}"  type="text" placeholder="Enter Mobile No" class="form-input" readonly="readonly"/>
               </div>
               <div>
                  <label for="Email">Email</label>
                  <input id="email" type="text" name="email" value="{{$employee->email}}" placeholder="Enter Email Address" class="form-input" readonly="readonly"/>
               </div>
              @if(!empty($employee))
               <div>
                  <label for="officialEmail">Official Email</label>
                  <input id="official_email" type="text" name="official_email" value="{{$employee->official_email}}" placeholder="Enter Official Email" class="form-input" readonly="readonly"/>
               </div>
               @else
               <div>
                  <label for="officialEmail">Official Email</label>
                  <input id="official_email" type="text" name="official_email" value="Not Applicable" placeholder="Enter Official Email" class="form-input" readonly="readonly"/>
               </div>
               @endif
               
               @if(!empty($employee))
                <div>
                  <label for="officialContact">Official Contact</label>
                  <input id="Email" type="text" name="official_contact" value="{{$employee->official_contact}}" placeholder="Enter Official Contact" class="form-input" readonly="readonly"/>
                </div>
                @else
                
                 <div>
                  <label for="officialContact">Official Contact</label>
                  <input id="Email" type="text" name="official_contact" value="Not Applicable" placeholder="Enter Official Contact" class="form-input" readonly="readonly"/>
                </div>
                
                @endif
               
               <!--<div>
                  <label for="name">Prfile Image</label>
                  <input id="profile_img" type="file" name="profile_img"
                  class="form-input" readonly="readonly"/>
                  </div>-->
               <div class="flex justify-around pt-5">
                  <label for="name">Gender :</label>
                  <label class="inline-flex cursor-pointer">Male</label>
                  <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" @if($employee->gender == 'Male') checked @endif type="radio" name="gender" value="Male"   />
                  <label class="inline-flex cursor-pointer">Female</label>
                  <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" @if($employee->gender == 'Female') checked @endif type="radio" name="gender" value="Female"  />
               </div>
               <!--	<div>
                  <label class="inline-flex cursor-pointer">
                  	<input type="checkbox" class="form-checkbox" />
                  	<span class="relative text-white-dark checked:bg-none">Make this my default address</span>
                  </label>
                  </div>
                  
                  <div class="mt-3 sm:col-span-2">
                  <button type="submit" class="btn btn-primary">Update Profile</button>
                  
                  </div>-->
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
               <form action="#" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-4">
                   <div>
                        <label for="aadhar_no">Aadhar No</label>
                     
                           <input id="aadhar_no" name="aadhar_no" value="{{$employee->aadhar_no}}" type="text" placeholder="Enter Aaadhar No" class="form-input" readonly="readonly"/>
                           @if(!empty($employee->upload_aadhar_no))
                              <a href="{{asset('public/uploads/employee/'.$employee->id.'/upload_aadhar_no/'.$employee->upload_aadhar_no)}}" download="{{$employee->upload_aadhar_no}}">
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
                              <a href="{{asset('public/uploads/employee/'.$employee->id.'/upload_aadhar_no/'.$employee->upload_aadhar_no)}}" target="_blank">
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
                         <input id="pan_no" type="text" name="pan_no" value="{{$employee->pan_no}}" placeholder="Enter Pan No" class="form-input" readonly="readonly"/>
					              @if(!empty($employee->upload_pan_no))
                              <a href="{{asset('public/uploads/employee/'.$employee->id.'/upload_pan_no/'.$employee->upload_pan_no)}}" download="{{$employee->upload_pan_no}}">
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
                              <a href="{{asset('public/uploads/employee/'.$employee->id.'/upload_pan_no/'.$employee->upload_pan_no)}}" target="_blank">
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
                        <label for="gst_no">UAN No</label>
                        <input id="uan_no" type="text" name="uan_no" value="{{$employee->uan_no}}" placeholder="Enter UAN No" class="form-input" readonly="readonly"/>
                     </div>

                      <div>
                        <label for="gst_no">ESI No</label>
                        <input id="esi_no" type="text" name="esi_no" value="{{$employee->esi_no}}" placeholder="Enter UAN No" class="form-input" readonly="readonly"/>
                     </div>
                  </div>
                   <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                     <div class="mb-5">
                        <label for="address">Present Address</label>
                         <input id="address" type="text" name="present_address" value="{{$employee->present_address}}" placeholder="Enter Present Address" class="form-input" readonly="readonly"/>
                     </div>
                     <div class="mb-5">
                        <label for="address1">Permanent Address</label>
                       <input id="address1" type="text" name="permanent_address" value="{{$employee->permanent_address}}" placeholder="Enter Permanent Address" class="form-input" readonly="readonly"/>
                     </div>
                    
                  </div>
                  <!--<button type="submit" class="btn btn-success">Update Profile</button>-->
               </form>
            </div>
         </div>
      </div>
   </div>
</template>
 <template x-if="tab === 'preferences'">
   <div class="grid grid-cols-1 gap-5 lg:grid-cols-5">
     <!--  <div class="panel">
         <div class="mb-5">
            <h5 class="mb-4 text-lg font-semibold">Bank Details</h5>
         </div>
         <div class="mb-5">
            <form action="" method="post" enctype="multipart/form-data">
               @csrf
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                  <div>
                     <label for="bank_name">Bank Name</label>
                    
                     <input id="bank_name" name="bank_name" value="{{$employee->bank_name}}" type="text" placeholder="Enter Bank Name" class="form-input" readonly="readonly"/>
                  </div>
                  <div>
                     <label for="ifsc_code">IFSC Code</label>
                    <input id="ifsc_code" type="text" name="ifsc_code" value="{{$employee->ifsc_code}}" placeholder="Enter IFSC Code" class="form-input" readonly="readonly"/>
                  </div>
                  <div>
                     <label for="account_no">Account No</label>
                    <input id="account_no" type="text" name="account_no" value="{{$employee->account_no}}" placeholder="Enter GST No" class="form-input" readonly="readonly"/>
                  </div>
                  <div>
                     <label for="cheque_copy">Upload Cheque Copy</label>
                     @if(!empty($employee->cheque_copy))
                           <a href="{{asset('public/uploads/employee/')}}/{{$employee->cheque_copy}}" download="{{$employee->cheque_copy}}">
                              <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:40px; margin-top:6px;">
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
                           <a href="{{asset('public/uploads/employee/')}}/{{$employee->cheque_copy}}" target="_blank">
                              <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:180px;">
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
               </div>-->
               <!--<button type="submit" class="btn btn-success">Update Profile</button>-->
            </form>
        <!-- </div>
      </div> -->
   </div>
</template> 
<template x-if="tab === 'qualification'">
   <div>
      <div class="grid grid-cols-1 gap-5 lg:grid-cols-6">
         <div class="panel">
            <div class="mb-5">
               <h5 class="mb-4 text-lg font-semibold">Qualification</h5>
            </div>
            <div class="mb-5">
               <form>
			   @if(!empty($employee->ten_passing_year))
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
                     <div>
                        <hr class="new4">
                        <br>
                        <h3> <label><b> 10th Detail </b> </label></h3>
                     </div>
                  </div>
				 
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                     <div id="ten_passing_year">
                        <label for="ten_passing_year">Passing Year</label>
                       <input id="bank_name" name="bank_name" value="{{$employee->ten_passing_year}}" type="text" placeholder="Enter Passing Year" class="form-input" readonly="readonly"/>

                     </div>
                     <div id="ten_mark_percentage">
                        <label for="ten_mark_percentage">Marks (%)</label>
                       <input id="bank_name" name="bank_name" value="{{$employee->ten_mark_percentage}}" type="text" placeholder="Enter Marks (%)" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="ten_board_school">
                        <label for="ten_board_school">Board/School</label>
                        <input id="bank_name" name="bank_name" value="{{$employee->ten_board_school}}" type="text" placeholder="Enter Board/School" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="ten_board_school_document">
                        <label for="ten_board_school_document">Attach Board/School Document</label>
                       @if(!empty($employee->ten_board_school_document))
                           <a href="{{asset('public/uploads/employee/'.$employee->id.'/ten_board_school_document/'.$employee->ten_board_school_document)}}" download="{{$employee->ten_board_school_document}}" download="{{$employee->ten_board_school_document}}">
                              <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:15px; margin-top:6px;">
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
                           <a href="{{asset('public/uploads/employee/'.$employee->id.'/ten_board_school_document/'.$employee->ten_board_school_document)}}" target="_blank">
                              <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:140px;">
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
				  @endif
				  
				@if(!empty($employee->twelve_passing_year))
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
                     <div>
                        <hr class="new4">
                        <br>
                        <h3> <label><b> 12th Detail </b> </label></h3>
                     </div>
                  </div>
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                     <div id="twelve_passing_year">
                        <label for="twelve_passing_year">Passing Year</label>
                      
                         <input id="bank_name" name="bank_name" value="{{$employee->twelve_passing_year}}" type="text" placeholder="Enter Passing Year" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="twelve_mark_percentage">
                        <label for="twelve_mark_percentage">Marks (%)</label>
                       
                         <input id="bank_name" name="bank_name" value="{{$employee->twelve_mark_percentage}}" type="text" placeholder="Enter Marks (%)" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="twelve_board_school">
                        <label for="twelve_board_school">Board/School</label>
                       
                         <input id="bank_name" name="bank_name" value="{{$employee->twelve_board_school}}" type="text" placeholder="Enter Board/School" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="twelve_board_school_document">
                        <label for="twelve_board_school_document">Attach Board/School Document</label>
                       
                          @if(!empty($employee->twelve_board_school_document))
                           <a href="{{asset('public/uploads/employee/'.$employee->id.'/twelve_board_school_document/'.$employee->twelve_board_school_document)}}" download="{{$employee->ten_board_school_document}}">
                              <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:15px; margin-top:6px;">
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
                           <a href="{{asset('public/uploads/employee/'.$employee->id.'/twelve_board_school_document/'.$employee->twelve_board_school_document)}}" target="_blank">
                              <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:140px;">
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
				  @endif
				  
				  @if(!empty($employee->graduate_passing_year))
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
                     <div>
                        <hr class="new4">
                        <br>
                        <h3> <label><b> Graduate Detail </b> </label></h3>
                     </div>
                  </div>
				  
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                     <div id="graduate_passing_year">
                        <label for="graduate_passing_year">Passing Year</label>
                       
                         <input id="bank_name" name="bank_name" value="{{$employee->graduate_passing_year}}" type="text" placeholder="Enter Passing Year" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="graduate_mark_percentage">
                        <label for="graduate_mark_percentage">Marks (%)</label>
                       
                         <input id="bank_name" name="bank_name" value="{{$employee->graduate_mark_percentage}}" type="text" placeholder="Enter Marks (%)" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="graduate_board_school">
                        <label for="graduate_board_school">Board/School</label>
                       
                         <input id="bank_name" name="bank_name" value="{{$employee->graduate_board_school}}" type="text" placeholder="Enter Board/School" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="graduate_board_school_document">
                        <label for="graduate_board_school_document">Attach Board/School Document</label>
                      
					             @if(!empty($employee->graduate_board_school_document))
                           <a href="{{asset('public/uploads/employee/'.$employee->id.'/graduate_board_school_document/'.$employee->graduate_board_school_document)}}" download="{{$employee->ten_board_school_document}}">
                              <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:15px; margin-top:6px;">
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
                           <a href="{{asset('public/uploads/employee/'.$employee->id.'/graduate_board_school_document/'.$employee->graduate_board_school_document)}}" target="_blank">
                              <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:140px;">
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
				  @endif
				  
				 @if(!empty($employee->post_graduate_passing_year))
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
                     <div>
                        <hr class="new4">
                        <br>
                        <h3> <label><b> Post Graduate Detail </b> </label></h3>
                     </div>
                  </div>
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                     <div id="post_graduate_passing_year">
                        <label for="post_graduate_passing_year">Passing Year</label>
                       
                         <input id="bank_name" name="bank_name" value="{{$employee->post_graduate_passing_year}}" type="text" placeholder="Enter Passing Year" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="post_graduate_mark_percentage">
                        <label for="post_graduate_mark_percentage">Marks (%)</label>
                       <!--  {!! Form::text('post_graduate_mark_percentage', null, array('placeholder' => 'Marks (%)','class' => 'form-input')) !!} -->
                         <input id="bank_name" name="bank_name" value="{{$employee->post_graduate_mark_percentage}}" type="text" placeholder="Enter Marks (%)" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="post_graduate_board_school">
                        <label for="post_graduate_board_school">Board/School</label>
                      
                         <input id="bank_name" name="bank_name" value="{{$employee->post_graduate_board_school}}" type="text" placeholder="Enter Board/School" class="form-input" readonly="readonly"/> 
                     </div>
                     <div id="post_graduate_board_school_document">
                        <label for="post_graduate_board_school_document">Attach Board/School Document</label>
                        
                         @if(!empty($employee->post_graduate_board_school_document))
                           <a href="{{asset('public/uploads/employee/'.$employee->id.'/post_graduate_board_school_document/'.$employee->post_graduate_board_school_document)}}" download="{{$employee->ten_board_school_document}}">
                              <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:15px; margin-top:6px;">
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
                           <a href="{{asset('public/uploads/employee/'.$employee->id.'/post_graduate_board_school_document/'.$employee->post_graduate_board_school_document)}}" target="_blank">
                              <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:140px;">
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
				  
				  @endif
				  
				@if(!empty($employee->phd_passing_year))
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
                     <div>
                        <hr class="new4">
                        <br>
                        <h3> <label><b>PHD Detail </b> </label></h3>
                     </div>
                  </div>
				  
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                     <div id="phd_passing_year">
                        <label for="phd_passing_year">Passing Year</label>
                       
                         <input id="bank_name" name="bank_name" value="{{$employee->phd_passing_year}}" type="text" placeholder="Enter Passing Year" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="phd_mark_percentage">
                        <label for="phd_mark_percentage">Marks (%)</label>
                       
                          <input id="bank_name" name="bank_name" value="{{$employee->phd_mark_percentage}}" type="text" placeholder="Enter Marks (%)" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="phd_board_school">
                        <label for="phd_board_school">Board/School</label>
                       
                         <input id="bank_name" name="bank_name" value="{{$employee->phd_board_school}}" type="text" placeholder="Enter Board/School" class="form-input" readonly="readonly"/>
                     </div>
                     <div id="phd_board_school_document">
                        <label for="phd_board_school_document">Attach Board/School Document</label>
                        
                         @if(!empty($employee->phd_board_school_document))
                           <a href="{{asset('public/uploads/employee/'.$employee->id.'/phd_board_school_document/'.$employee->phd_board_school_document)}}" download="{{$employee->ten_board_school_document}}">
                              <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:15px; margin-top:6px;">
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
                           <a href="{{asset('public/uploads/employee/'.$employee->id.'/phd_board_school_document/'.$employee->phd_board_school_document)}}" target="_blank">
                              <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:140px;">
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
				 @endif
               </form>
            </div>
         </div>
      </div>
   </div>
</template>
<template x-if="tab === 'employe'">
   <div class="grid grid-cols-1 gap-5 lg:grid-cols-5">
      <div class="panel">
        <strong style="font-size: 20px;">Employment Information</strong><br><br>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="Contact">
                  <strong>Company Name:</strong>
                  {{ $employee->company_name }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
               <div>
                  <label for="Contact">
                  <strong>From Duration:</strong>
                  {{ $employee->from_company_duration }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>To Duration:</strong>
                  {{ $employee->to_company_duration }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>Company CTC:</strong>
                  {{ $employee->company_ctc }}
                  </label>
               </div>
            </div>
               <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Comapny Offer Letter:</strong>
                     @if(!empty($employee->company_offer_letter))
                    
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/company_offer_letter/'.$employee->company_offer_letter)}}" download="{{$employee->company_offer_letter}}">
                        <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:230px; margin-top: -24px;">
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
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/company_offer_letter/'.$employee->company_offer_letter)}}" target="_blank">
                        <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:345px;">
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
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Comapny Relieving Letter:</strong>
                     @if(!empty($employee->company_relieving_letter))
                    
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/company_relieving_letter/'.$employee->company_relieving_letter)}}" download="{{$employee->company_relieving_letter}}">
                        <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:230px; margin-top: -24px;">
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
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/company_relieving_letter/'.$employee->company_relieving_letter)}}" target="_blank">
                        <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:345px;">
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
                  <label for="gridPinCode">
                     <strong>Comapny Salary Slip First:</strong>
                     @if(!empty($employee->salary_slip_first))
                    
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/salary_slip_first/'.$employee->salary_slip_first)}}" download="{{$employee->salary_slip_first}}">
                        <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:230px; margin-top: -24px;">
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
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/salary_slip_first/'.$employee->salary_slip_first)}}" target="_blank">
                        <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:345px;">
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
                  <label for="gridPinCode">
                     <strong>Comapny Salary Slip Second:</strong>
                     @if(!empty($employee->salary_slip_second))
                    
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/salary_slip_second/'.$employee->salary_slip_second)}}" download="{{$employee->salary_slip_second}}">
                        <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:230px; margin-top: -24px;">
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
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/salary_slip_second/'.$employee->salary_slip_second)}}" target="_blank">
                        <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:345px;">
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
               <label for="gridPinCode">
                  <strong>Comapny Salary Slip Third:</strong>
                  @if(!empty($employee->salary_slip_third))
               
                  <a href="{{asset('public/uploads/employee/'.$employee->id.'/salary_slip_third/'.$employee->salary_slip_third)}}" download="{{$employee->salary_slip_third}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:230px; margin-top: -24px;">
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
                  <a href="{{asset('public/uploads/employee/'.$employee->id.'/salary_slip_third/'.$employee->salary_slip_third)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:345px;">
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
            @php
            $other_company_name_arr = json_decode($employee->other_company_name, true);
            $other_from_duration_arr = json_decode($employee->other_from_duration, true);
            $other_to_duration_arr = json_decode($employee->other_to_duration, true);
            $other_company_ctc_arr = json_decode($employee->other_company_ctc, true);
            $other_offer_letter_arr = json_decode($employee->other_offer_letter, true);
            $other_relieving_letter_arr = json_decode($employee->other_relieving_letter, true);
            $other_i = 1;
            if(!is_array($other_company_name_arr)){
            $other_company_name_arr = [""];
            }
            if(!is_array($other_from_duration_arr)){
            $other_from_duration_arr = [""];
            }
            if(!is_array($other_to_duration_arr)){
            $other_to_duration_arr = [""];
            }
            if(!is_array($other_company_ctc_arr)){
            $other_company_ctc_arr = [""];
            }
            if(!is_array($other_offer_letter_arr)){
            $other_offer_letter_arr = [""];
            }
            if(!is_array($other_relieving_letter_arr)){
            $other_relieving_letter_arr = [""];
            }
            @endphp
            <hr>
            <br>
          
            <strong style="font-size: 20px;">More Employment</strong><br><br>
            @foreach($other_company_name_arr as $other_company_name_row)
		    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="Contact">
                  <strong>Company Name:</strong>
                  {{$other_company_name_arr[$other_i-1]}}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
               <div>
                  <label for="Contact">
                  <strong>From Duration:</strong>
                  {{$other_from_duration_arr[$other_i-1]}}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>To Duration:</strong>
                  {{$other_to_duration_arr[$other_i-1]}}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>Coampnay CTC:</strong>
                  {{$other_company_ctc_arr[$other_i-1]}}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Offer Letter:</strong>
                     @if(!empty($other_offer_letter_arr[$other_i-1]))
                   
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/other_offer_letter/'.$other_offer_letter_arr[$other_i-1])}}" download="{{$other_offer_letter_arr[$other_i-1]}}">
                        <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:241px; margin-top: -24px;">
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
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/other_offer_letter/'.$other_offer_letter_arr[$other_i-1])}}" target="_blank">
                        <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:359px;">
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
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Relieving Letter:</strong>
                     @if(!empty($other_relieving_letter_arr[$other_i-1]))
                    
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/other_relieving_letter/'.$other_relieving_letter_arr[$other_i-1])}}" download="{{$other_relieving_letter_arr[$other_i-1]}}">
                        <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:241px; margin-top: -24px;">
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
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/other_relieving_letter/'.$other_relieving_letter_arr[$other_i-1])}}" target="_blank">
                        <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:359px;">
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
            @php
            $other_i = $other_i+1;
            @endphp
            @endforeach


            
           
         </div>
      </div>
   </div>
    </template>
    <template x-if="tab === 'company'">
   <!-- Other Documents -->
   <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
      <div class="grid grid-cols-1 gap-5 lg:grid-cols-5">
         <div class="panel">
            <div class="mb-5">
            @php
            $other_document_name_arr = json_decode($employee->other_document_name, true);
            $other_upload_document_arr = json_decode($employee->other_upload_document, true);

            $other_i = 1;
            if(!is_array($other_document_name_arr)){
            $other_document_name_arr = [""];
            }
            if(!is_array($other_upload_document_arr)){
            $other_upload_document_arr = [""];
            }

            @endphp
            <hr>
            <br>
		<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
		 <strong style="font-size: 20px;">Company Document</strong>
               <div>
                  <label for="gridPinCode">
                     <strong>Offer Letter:</strong>
                     @if(!empty($employee->other_company_offer_letter))
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/other_company_offer_letter/'.$employee->other_company_offer_letter)}}" download="{{$employee->other_company_offer_letter}}">
                        <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:230px; margin-top: -21px;">
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
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/other_company_offer_letter/'.$employee->other_company_offer_letter)}}" target="_blank">
                        <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:338px;">
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
           
         
            <strong style="font-size: 20px;">Other Document</strong><br><br>
			@foreach($other_document_name_arr as $other_document_name_row)
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

               <div>
                  <label for="Contact">
                  <strong> Company Document  :</strong>
                        {{$other_document_name_arr[$other_i-1]}}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

               <div>
                  <label for="gridPinCode">
                     <strong>Document  :</strong>
             
                     @if(!empty($other_upload_document_arr[$other_i-1]))
                
                     
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/other_upload_document/'.$other_upload_document_arr[$other_i-1])}}" download="{{$other_upload_document_arr[$other_i-1]}}">
                        <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:230px; margin-top: -21px;">
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
                     <a href="{{asset('public/uploads/employee/'.$employee->id.'/other_upload_document/'.$other_upload_document_arr[$other_i-1])}}" target="_blank">
                        <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:338px;">
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
         
           @php
            $other_i = $other_i+1;
            @endphp

          @endforeach
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



       <script>

 $(document).ready(function(){
   
    var i = 1;
   var length;
   //var addamount = 0;
    var addamount = 700;

  $("#add").click(function(){
   
    addamount += 700;
    console.log('amount: ' + addamount);
   i++;
      $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="other_company_name[]" placeholder="Name" class="form-input"/></td><td><input type="date" name="other_from_duration[]" placeholder="Duration" class="form-input"/></td><td><input type="date" name="other_to_duration[]" placeholder="Duration" class="form-input"/></td><td><input type="text" name="other_company_ctc[]" placeholder="CTC" class="form-input"/></td><td><input type="file" name="other_offer_letter[]" class="form-input"/></td><td><input type="file" name="other_relieving_letter[]" class="form-input"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
    });


  $(document).on('click', '.btn_remove', function(){  
   addamount -= 700;
   console.log('amount: ' + addamount);
   
    <!-- var rowIndex = $('#dynamic_field').find('tr').length;  -->
    <!-- addamount -= (700 * rowIndex); -->
    <!-- console.log(addamount); -->
    
     var button_id = $(this).attr("id");     
      $('#row'+button_id+'').remove();  
    });
  });

</script>
@endpush