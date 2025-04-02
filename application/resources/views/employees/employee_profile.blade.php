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
@section('title','Edit Employee Profile')
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
  
</div>
<div x-data="{tab: 'home'}">
<ul class="mb-5 overflow-y-auto whitespace-nowrap border-b border-[#ebedf2] font-semibold dark:border-[#191e3a] sm:flex">
   <li class="inline-block">
      <a
         href="javascript:;"
         class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
         :class="{'!border-primary text-primary' : tab == 'home'}"
         @click="tab='home'" id="basicInfoID">
          <i class="fa fa-info-circle" aria-hidden="true"></i>
         Basic Info
      </a>
   </li>
   <li class="inline-block">
      <a
         href="javascript:;"
         class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
         :class="{'!border-primary text-primary' : tab == 'payment-details'}"
         @click="tab='payment-details'" id="kycID">
		<i class="fa fa-check-circle" aria-hidden="true"></i>
      
         KYC
      </a>
   </li>
   <li class="inline-block">
      <a
         href="javascript:;"
         class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
         :class="{'!border-primary text-primary' : tab == 'qualification'}"
         @click="tab='qualification'" id="qualificationID">
        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
         Qualification
      </a>
   </li>
   <li class="inline-block">
      <a
         href="javascript:;"
         class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
         :class="{'!border-primary text-primary' : tab == 'employe'}"
         @click="tab='employe'" id="employmentDetailsID">
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
 <!--  <li class="inline-block">
      <a
         href="javascript:;"
         class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
         :class="{'!border-primary text-primary' : tab == 'company'}"
         @click="tab='company'"
         >
         <i class="fa fa-file" aria-hidden="true"></i>
         Company Document
      </a>
   </li>-->
</ul>
<template x-if="tab === 'home'">
   <div>
      <!-- Flash  Message  start  -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
      <form class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" action="{{route('update_employee_profile', Auth::user()->emp_id)}}" method="post" enctype="multipart/form-data">
         @csrf
		  <input type="hidden" name="active_tab" value="basicInfoID">
		  
         <h6 class="mb-5 text-lg font-bold">General Information</h6>
         <div class="flex flex-col sm:flex-row">
            <div class="mb-5 w-full sm:w-2/12 ltr:sm:mr-4 rtl:sm:ml-4">
           
               <img
                  src="{{ $profile_img }}" alt="profile-default-image"
                  class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32"
                  />
                
            </div>
            <div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2">
               <div>
                  <label for="name:">Employee ID</label>
                  <input id="employee_id" type="text" name="id"  value="EMP000{{$employee->id}}" placeholder="Employee ID" class="form-input" readonly="readonly">
               </div>
               <div>
                  <label for="name">My Manager</label>
                  <input id="managedBy" type="text" name="managed_by"  value=" @if(!empty($user_emp_manage)) {{$user_emp_manage->first_name.' '.$user_emp_manage->last_name}} @else Self @endif" class="form-input" readonly="readonly"/>
               </div>
               
                <div>
                  <label for="name">Date Of Joining</label>
                  <input id="date_of_joining" type="text" name="date_of_joining"  value="{{$employee->date_of_joining}}" class="form-input" readonly="readonly"/>
               </div>
               
                <div>
                  <label for="name">Designation</label>
                  <input id="designation" type="text" name="designation"  value="{{$employee->designation}}" class="form-input" readonly="readonly"/>
               </div>
               
                <div>
                  <label for="name">Salary</label>
                  <input id="salary" type="text" name="salary"  value="{{$employee->salary}}" class="form-input" readonly="readonly"/>
               </div>
              
               <div>
                  <label for="name">First Name</label>
                  <input id="first_name" type="text" name="first_name" value="{{$employee->first_name}}"  placeholder="Enter First Name" class="form-input"/>
               </div>
               <div>
                  <label for="name">Last Name</label>
                  <input id="last_name" type="text" name="last_name" value="{{$employee->last_name}}" placeholder="Enter Last Name" class="form-input" readonly="readonly" readonly="readonly"/>
               </div>
               <div>
                  <label for="name">Contact</label>
                  <input id="mobile" name="mobile" value="{{$employee->mobile}}"  type="text" placeholder="Enter Mobile No" class="form-input"/>
               </div>
               <div>
                  <label for="name">Email</label>
                  <input id="Email" type="text" name="email" value="{{$employee->email}}" placeholder="Enter Email Address" class="form-input"/>
               </div>
               
              @if(!empty($employee->official_email))
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
               
               @if(!empty($employee->official_contact))
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
               <div>
                           <label for="name">Profile Image</label>
                           <input id="profile_img" type="file" name="profile_img"
                           class="form-input" />
                        </div>
               
                  <div class="mt-3 sm:col-span-2">
                  <button type="submit" class="btn btn-primary">Update Profile</button>
                  
                  </div>
            </div>
         </div>
      </form>
   </div>
</template>
<template x-if="tab === 'payment-details'">
  
       <form class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" action="{{route('update_employee_profile', Auth::user()->emp_id)}}" method="post" enctype="multipart/form-data">
         @csrf
		 <input type="hidden" name="active_tab" value="kycID">
       <div class="mb-5">
               <h5 class="mb-4 text-lg font-semibold">Aadhar & Pan Deatails</h5>
            </div>
         <div class="flex flex-col sm:flex-row">
           
             <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-4">
                   
					 <div>
                        <label for="aadhar_no">Aadhar No</label>
                     
                           <input id="aadhar_no" name="aadhar_no" value="{{$employee->aadhar_no}}" type="text" placeholder="Enter Aaadhar No" class="form-input">
                              <label for="upload_aadhar_no"></label>
                              <input id="upload_aadhar_no" type="file" name="upload_aadhar_no" value="{{$employee->upload_aadhar_no}}" placeholder="Upload Aadhar No" class="form-input">
                              @if(!empty($employee->upload_aadhar_no))
                              <a href="{{asset('public/uploads/employee/'.$employee->id.'/upload_aadhar_no/'.$employee->upload_aadhar_no)}}" target="_blank" >
                              <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/upload_aadhar_no/'.$employee->upload_aadhar_no)}}"></a>
                              @endif
                     </div>
					 
                     <div>
                        <label for="pan_no">Pan No</label>
                         <input id="pan_no" type="text" name="pan_no" value="{{$employee->pan_no}}" placeholder="Enter Pan No" class="form-input">
         
                               <label for="upload_pan_no"></label>
                              <input id="upload_pan_no" type="file" name="upload_pan_no" value="{{$employee->upload_pan_no}}" placeholder="Upload Pan No" class="form-input">
                              @if(!empty($employee->upload_pan_no))
                              <a href="{{asset('public/uploads/employee/'.$employee->id.'/upload_pan_no/'.$employee->upload_pan_no)}}" target="_blank" >
                              <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/upload_pan_no/'.$employee->upload_pan_no)}}"></a>
                              @endif
                     </div>
					 
                     <div>
                        <label for="gst_no">UAN No</label>
                        <input id="uan_no" type="text" name="uan_no" value="{{$employee->uan_no}}" placeholder="Enter UAN No" class="form-input">
                     </div>

                      <div>
                        <label for="gst_no">ESI No</label>
                        <input id="esi_no" type="text" name="esi_no" value="{{$employee->esi_no}}" placeholder="Enter UAN No" class="form-input">
                     </div>
                  </div>
                  </div>
                     <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                     <div class="mb-5">
                        <label for="address">Present Address</label>
                         <input id="address" type="text" name="present_address" value="{{$employee->present_address}}" placeholder="Enter Present Address" class="form-input">
                     </div>
                     <div class="mb-5">
                        <label for="address1">Permanent Address</label>
                       <input id="address1" type="text" name="permanent_address" value="{{$employee->permanent_address}}" placeholder="Enter Permanent Address" class="form-input">
                     </div>
                    
                  </div>
                     <div class="mt-3 sm:col-span-2">
                  <button type="submit" class="btn btn-primary">Update Profile</button>
                  
                  </div>
         </div>
      </form>
   </div>
</template>

<template x-if="tab === 'preferences'">
   <div class="grid grid-cols-1 gap-5 lg:grid-cols-5">
      <!-- <div class="panel">
         <div class="mb-5">
            <h5 class="mb-4 text-lg font-semibold">Bank Details</h5>
         </div>
         <div class="mb-5">
            <form action="" method="post" enctype="multipart/form-data">
               @csrf
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                  <div>
                     <label for="bank_name">Bank Name</label>
                     <input id="bank_name" name="bank_name" value="" type="text" placeholder="Enter Bank Name" class="form-input" readonly="readonly"/>
                  </div>
                  <div>
                     <label for="ifsc_code">IFSC Code</label>
                     <input id="ifsc_code" type="text" name="ifsc_code" value="" placeholder="Enter IFSC Code" class="form-input" readonly="readonly"/>
                  </div>
                  <div>
                     <label for="account_no">Account No</label>
                     <input id="account_no" type="text" name="account_no" value="" placeholder="Enter Account No" class="form-input" readonly="readonly"/>
                  </div>
                  <div>
                     <label for="cheque_copy">Upload Cheque Copy</label>
                     <input id="cheque_copy" type="file" name="cheque_copy" placeholder="Select Cheque Copy" class="form-input" />
                     <a href="{{asset('public/uploads/users/cheque/demo.png')}}" target="_blank"><img
                        src="{{asset('public/uploads/users/cheque/demo.png')}}" alt="image"style="width:10rem" /></a> 
                  </div>
               </div>
               <button type="submit" class="btn btn-success">Update Profile</button>
            </form>
         </div>
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
              <form class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" action="{{route('update_employee_profile', Auth::user()->emp_id)}}" method="post" enctype="multipart/form-data">
              @csrf
			  
			   <input type="hidden" name="active_tab" value="qualificationID">
			   
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
                       <input id="ten_passing_year:" type="text" name="ten_passing_year"  value="{{$employee->ten_passing_year}}" class="form-input" />
                     </div>
                     <div id="ten_mark_percentage">
                        <label for="ten_mark_percentage">Marks (%)</label>
                       <input id="ten_mark_percentage:" type="text" name="ten_mark_percentage"  value="{{$employee->ten_mark_percentage}}" class="form-input" />
                     </div>
                     <div id="ten_board_school">
                        <label for="ten_board_school">Board/School</label>
                        <input id="ten_board_school:" type="text" name="ten_board_school"  value="{{$employee->ten_board_school}}" class="form-input" />
                     </div>
                     <div id="ten_board_school_document">
                        <label for="ten_board_school_document">Attach Board/School Document</label>
                        {!! Form::file('ten_board_school_document', null, array('placeholder' => 'Attach Board/School Document','class' => 'form-input')) !!}
               
               <a href="{{asset('public/uploads/employee/'.$employee->id.'/ten_board_school_document/'.$employee->ten_board_school_document)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/ten_board_school_document/'.$employee->ten_board_school_document)}}">
               
               </a>
                  
                     </div>
                  </div>
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
                     <div>
                        <hr class="new4">
                        <br>
                        <h3> <label><b> 12th Detail </b> </label></h3>
                     </div>
                  </div>
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                     <div id="twelve_passing_year">
                      <input id="twelve_passing_year:" type="text" name="twelve_passing_year"  value="{{$employee->twelve_passing_year}}" class="form-input" />
                     </div>
                     <div id="twelve_mark_percentage">
                        <label for="twelve_mark_percentage">Marks (%)</label>
                     <input id="twelve_mark_percentage:" type="text" name="twelve_mark_percentage"  value="{{$employee->twelve_mark_percentage}}" class="form-input" />
                     </div>
                     <div id="twelve_board_school">
                        <label for="twelve_board_school">Board/School</label>
                      <input id="twelve_board_school:" type="text" name="twelve_board_school"  value="{{$employee->twelve_board_school}}" class="form-input" />
                     </div>
                     <div id="twelve_board_school_document">
                        <label for="twelve_board_school_document">Attach Board/School Document</label>
                       {!! Form::file('twelve_board_school_document', null, array('placeholder' => 'Attach Board/School Document','class' => 'form-input')) !!}
               <a href="{{asset('public/uploads/employee/'.$employee->id.'/twelve_board_school_document/'.$employee->twelve_board_school_document)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/twelve_board_school_document/'.$employee->twelve_board_school_document)}}">
               
               </a>
                     </div>
                  </div>
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
  <input id="graduate_passing_year:" type="text" name="graduate_passing_year"  value="{{$employee->graduate_passing_year}}" class="form-input" />
                     </div>
                     <div id="graduate_mark_percentage">
                        <label for="graduate_mark_percentage">Marks (%)</label>
                       <input id="graduate_mark_percentage:" type="text" name="graduate_mark_percentage"  value="{{$employee->graduate_mark_percentage}}" class="form-input" />
                     </div>
                     <div id="graduate_board_school">
                        <label for="graduate_board_school">Board/School</label>
                      <input id="graduate_board_school:" type="text" name="graduate_board_school"  value="{{$employee->graduate_board_school}}" class="form-input" />
                     </div>
                     <div id="graduate_board_school_document">
                        <label for="graduate_board_school_document">Attach Board/School Document</label>
                      
               {!! Form::file('graduate_board_school_document', null, array('placeholder' => 'Attach Board/School Document','class' => 'form-input')) !!}
               
               <a href="{{asset('public/uploads/employee/'.$employee->id.'/graduate_board_school_document/'.$employee->graduate_board_school_document)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/graduate_board_school_document/'.$employee->graduate_board_school_document)}}">
               
               </a>
						
                     </div>
                  </div>
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
                     <input id="post_graduate_passing_year:" type="text" name="post_graduate_passing_year"  value="{{$employee->post_graduate_passing_year}}" class="form-input" />
                     </div>
                     <div id="post_graduate_mark_percentage">
                        <label for="post_graduate_mark_percentage">Marks (%)</label>
                       <input id="post_graduate_mark_percentage:" type="text" name="post_graduate_mark_percentage"  value="{{$employee->post_graduate_mark_percentage}}" class="form-input" />
                     </div>
                     <div id="post_graduate_board_school">
                        <label for="post_graduate_board_school">Board/School</label>
                   <input id="post_graduate_board_school:" type="text" name="post_graduate_board_school"  value="{{$employee->post_graduate_board_school}}" class="form-input" />
                     </div>
                     <div id="post_graduate_board_school_document">
                        <label for="post_graduate_board_school_document">Attach Board/School Document</label>
                       {!! Form::file('post_graduate_board_school_document', null, array('placeholder' => 'Attach Board/School Document','class' => 'form-input')) !!}
               
               <a href="{{asset('public/uploads/employee/'.$employee->id.'/post_graduate_board_school_document/'.$employee->post_graduate_board_school_document)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/post_graduate_board_school_document/'.$employee->post_graduate_board_school_document)}}">
               
               </a>
                     </div>
                  </div>
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
                      <input id="phd_passing_year:" type="text" name="phd_passing_year"  value="{{$employee->phd_passing_year}}" class="form-input" />
                     </div>
                     <div id="phd_mark_percentage">
                        <label for="phd_mark_percentage">Marks (%)</label>
                     <input id="phd_mark_percentage:" type="text" name="phd_mark_percentage"  value="{{$employee->phd_mark_percentage}}" class="form-input" />
                     </div>
                     <div id="phd_board_school">
                        <label for="phd_board_school">Board/School</label>
                      <input id="phd_board_school:" type="text" name="phd_board_school"  value="{{$employee->phd_board_school}}" class="form-input" />
                     </div>
                     <div id="phd_board_school_document">
                        <label for="phd_board_school_document">Attach Board/School Document</label>
                        {!! Form::file('phd_board_school_document', null, array('placeholder' => 'Attach Board/School Document','class' => 'form-input')) !!}
               
               
               <a href="{{asset('public/uploads/employee/'.$employee->id.'/phd_board_school_document/'.$employee->phd_board_school_document)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/phd_board_school_document/'.$employee->phd_board_school_document)}}">
               
               </a>
						
                     </div>
                  </div>
				  
				   <button type="submit" class="btn btn-success">Update Profile</button>
               </form>
			  
            </div>
         </div>
      </div>
   </div>
</template>
<template x-if="tab === 'employe'">
   <div class="grid grid-cols-1 gap-5 lg:grid-cols-5">
      <div class="panel">
          <div class="mb-5">
             <form class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" action="{{route('update_employee_profile', Auth::user()->emp_id)}}" method="post" enctype="multipart/form-data">
         @csrf
		    <input type="hidden" name="active_tab" value="employmentDetailsID">
			
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
            <strong style="font-size: 20px;">Employment Information</strong><br><br>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="Contact">
                  <strong>Company Name:</strong>
                  <input id="bank_name" name="company_name" value="{{$employee->company_name}}" type="text" placeholder="Enter Company Name" class="form-input" />
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
               <div>
                  <label for="Contact">
                  <strong>From Duration:</strong>
               
                   <input id="bank_name" name="from_company_duration" value="{{$employee->from_company_duration}}" type="date" placeholder="Enter From Duration" class="form-input" />
                  </label>
               </div>
               <div>
                  <label for="to_company_duration">
                  <strong>To Duration:</strong>
               
                   <input id="bank_name" name="to_company_duration" value="{{$employee->to_company_duration}}" type="date" placeholder="Enter To Duration" class="form-input" />
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>Company CTC:</strong>
                
                   <input id="bank_name" name="company_ctc" value="{{$employee->company_ctc}}" type="text" placeholder="Enter Company CTC" class="form-input" />
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Comapny Offer Letter:</strong>
                    {!! Form::file('company_offer_letter', null, array('placeholder' => 'Comapny Offer Letter','class' => 'form-input')) !!}
               
               
               <a href="{{asset('public/uploads/employee/'.$employee->id.'/company_offer_letter/'.$employee->company_offer_letter)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/company_offer_letter/'.$employee->company_offer_letter)}}">
               
               </a>
              
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Comapny Relieving Letter:</strong>
                    
                    {!! Form::file('company_relieving_letter', null, array('placeholder' => 'Comapny Relieving Letter','class' => 'form-input')) !!}
               
               <a href="{{asset('public/uploads/employee/'.$employee->id.'/company_relieving_letter/'.$employee->company_relieving_letter)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/company_relieving_letter/'.$employee->company_relieving_letter)}}">
               
               </a>
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
               <div>
                  <label for="salary_slip_first">Salary Slip First</label>
               {!! Form::file('salary_slip_first', null, array('placeholder' => 'Salary Slip First','class' => 'form-input')) !!}
               
               
               <a href="{{asset('public/uploads/employee/'.$employee->id.'/salary_slip_first/'.$employee->salary_slip_first)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/salary_slip_first/'.$employee->salary_slip_first)}}">
               
               </a>
              
               </div>
               <div>
                  <label for="salary_slip_second"> Slary Slip Second</label>
                  {!! Form::file('salary_slip_second', array('placeholder' => ' Upload Slary Slip','class' => 'form-input','id'=>'salary_slip_second')) !!}
                    <a href="{{asset('public/uploads/employee/'.$employee->id.'/salary_slip_second/'.$employee->salary_slip_second)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/salary_slip_second/'.$employee->salary_slip_second)}}">
               
               </a>
               </div>
               <div>
                  <label for="salary_slip_third"> Slary Slip Third</label>
                  
                {!! Form::file('salary_slip_third' , array('placeholder' => ' Upload Slary Slip','class' => 'form-input','id'=>'salary_slip_third')) !!}

                 <a href="{{asset('public/uploads/employee/'.$employee->id.'/salary_slip_third/'.$employee->salary_slip_third)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/salary_slip_third/'.$employee->salary_slip_third)}}">
               
               </a>
               </div>
            </div><br>
        
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
            <div>
            <hr class="new4"><br>
            <h3> <label><b>More Employment</b> </label></h3>
            </div>
          </div>  
         
       <!--  Start Multiple Input Button  -->
   
                 <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
            
                    <table class="table table-hover" id="faqs">
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
                    
                    @foreach($other_company_name_arr as $other_company_name_row)
                    
                 
                    
                     <tr @if($other_i > 1) id="row{{$other_i}}" @endif>
                     
                       <td>
                       <label for="other_company_name">Company Name</label>
                       <input type="text" name="other_company_name[]" placeholder="Name" value="{{$other_company_name_arr[$other_i-1]}}" class="form-input" />
                       </td>
                       
                       <td>
                       <label for="from_duration">From Duration </label>
                       <input type="date" name="other_from_duration[]" placeholder=" From" value="{{$other_from_duration_arr[$other_i-1]}}" class="form-input" />
                       </td>
                       
                       <td>
                       <label for="to_duration">To Duration </label>
                       <input type="date" name="other_to_duration[]" placeholder="To" value="{{$other_to_duration_arr[$other_i-1]}}" class="form-input" />
                       </td>
                       
                      <td>
                       <label for="other_company_ctc">CTC</label>
                       <input type="text" name="other_company_ctc[]" placeholder="CTC" value="{{$other_company_ctc_arr[$other_i-1]}}" class="form-input" />
                       </td> 
                     
                     
                       <td>
                       <label for="CompanyName">Upload Offer Letter</label>
                       <input type="file" name="other_offer_letter[]"  class="form-input" />
                        @if(!empty($other_offer_letter_arr[$other_i-1]))
                         <a href="{{asset('public/uploads/employee/'.$employee->id.'/other_offer_letter/'.$other_offer_letter_arr[$other_i-1])}}" target="_blank">
               
                           <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/other_offer_letter/'.$other_offer_letter_arr[$other_i-1])}}">
                           
                           </a>
                        @endif

                      
                        
                       </td>

                       <td>
                       <label for="CompanyName">Upload Relieving Letter</label>
                       <input type="file" name="other_relieving_letter[]" class="form-input" />
                        @if(!empty($other_relieving_letter_arr[$other_i-1]))
                        <a href="{{asset('public/uploads/employee/'.$employee->id.'/other_relieving_letter/'.$other_relieving_letter_arr[$other_i-1])}}" target="_blank" >
               
                              <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employee->id.'/other_relieving_letter/'.$other_relieving_letter_arr[$other_i-1])}}">
                           
                           </a>                          
                        @endif 
                      
                        </td>
                    
                      @if($other_i == 1) 
                        <td><a href="javascript:;" onclick="addfaqs();" class="btn btn-info" style="    margin-right: -25px;">+</a></td>
                       @else
                        <td><a href="javascript:;" class="btn btn-danger">X</a></td>
                    
                       
                     @endif
                       
                       @php
                       
                       $other_i = $other_i+1;
                       @endphp
                       
                       
                     </tr>
                   @endforeach
                     
                    </table>
                 </div>
      <!--  end Multiple Input Button  -->
            </div>
            <button type="submit" class="btn btn-success !mt-6" style="display: inline-flex">Update Profile</button>
            <button type="submit" class="btn btn-info !mt-6" style="display: inline-flex;   float: inline-end;"><a href="{{route('employee_profile')}}" >Back To Profile</a></button>


         </form>
         </div>
      </div>
   </div>
</template>

@endsection


@push('head')

<style>

/* Dashed red border */
hr.new21 {
  border-top: 1px dashed blue;
  margin-top: 10px;
}

/* Thick red border */
hr.new41 {
  border: 1px solid blue;
}
</style>

@endpush


@push('script')
<!-- 13-10-23 -->
<script>
  var i = 0;
function addfaqs() {
html = '<tr id="faqs-row'+i+'">';
    html += '<td><input type="text" name="other_company_name[]" placeholder="Name" class="form-input"/></td>';
    html += '</td><td><input type="date" name="other_from_duration[]" placeholder="Duration" class="form-input"/>';
    html += '</td><td><input type="date" name="other_to_duration[]" placeholder="Duration" class="form-input"/>';
    html += '</td><td><input type="text" name="other_company_ctc[]" placeholder="CTC" class="form-input"/></td>';
    html += '<td><input type="file" name="other_offer_letter[]" class="form-input"/></td>';
    html += '<td><input type="file" name="other_relieving_letter[]" class="form-input"/></td>';
    html += '<td class="mt-10"><a class="btn btn-danger" onclick="$(\'#faqs-row' + i + '\').remove();"> X</a></td>';

    html += '</tr>';

$('#faqs tbody').append(html);

i++;
}
</script>
<!-- 13-10-23 -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript"> 
   $(function(){
    $('#alertMessageHide').delay(5000).fadeOut();
   });
</script>

<script>
@if(Request::has('active_tab'))
	
$(document).ready(function (){

	var activeTab ="{{Request::input('active_tab')}}";
	
	document.getElementById(activeTab).click();

});

@endif

</script>

@endpush



