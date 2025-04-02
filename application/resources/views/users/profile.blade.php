 @php
 
  use App\Helpers\Helper;
  
  $profile_data = Helper::getProfile();

	if($profile_data['auth_user']->for == 'normal_user' || empty($profile_data['auth_user']->for))
		{
	    $profile_route = route('view_profile');
			
		if(!empty($profile_data['profile']->profile_img)){
				
			$profile_img = asset('public/uploads/users/profile/'.$profile_data['auth_user']->profile_img);
			
			}elseif(empty($profile_data['profile']->profile_img) && empty($profile_data['profile']->gender) ){
				
				$profile_img = asset('public/uploads/users/profile/profile.png');
			}elseif(!empty($profile_data['profile']->gender) && $profile_data['profile']->gender == 'Male'){
				
				$profile_img = asset('public/uploads/users/profile/profile_male.png');
			}elseif(!empty($profile_data['profile']->gender) && $profile_data['profile']->gender == 'Female'){
				$profile_img = asset('public/uploads/users/profile/profile_female.png');
			}
			
		}  
			
	  else{
		$profile_route = route('view_profile');
		
		if(!empty($profile_data['profile']->profile_img)){
				
			$profile_img = asset('public/uploads/users/profile/'.$profile_data['auth_user']->profile_img);
			
			}elseif(empty($profile_data['profile']->profile_img) && empty($profile_data['profile']->gender) ){
				
				$profile_img = asset('public/uploads/users/profile/profile.png');
			}elseif(!empty($profile_data['profile']->gender) && $profile_data['profile']->gender == 'Male'){
				
				$profile_img = asset('public/uploads/users/profile/profile_male.png');
			}elseif(!empty($profile_data['profile']->gender) && $profile_data['profile']->gender == 'Female'){
				$profile_img = asset('public/uploads/users/profile/profile_female.png');
			}

	}
	
   $auth_user = Auth::user();
  
  if($auth_user->for=='super_admin'){
	    $profileTitle="Super Admin";
  }else{
	$profileTitle='Customer';  
	  
  }
 
 @endphp


@extends('admin.layouts.app')
@section('title',' Edit '.$profileTitle.' Profile')
@section('content')
<div>
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
        <a href="{{route('view_profile')}}" class="text-primary hover:underline">{{$profileTitle}}</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>{{$profileTitle}} Settings</span>
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
               <i class="fas fa-ad"></i>
              KYC
            </a>
         </li>
         <li class="inline-block">
            <a
               href="javascript:;"
               class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
               :class="{'!border-primary text-primary' : tab == 'preferences'}"
               @click="tab='preferences'"
               >
               <i class='fa fa-bank'></i>
               Bank Detail
            </a>
         </li>
		 <li class="inline-block">
            <a
               href="javascript:;"
               class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
               :class="{'!border-primary text-primary' : tab == 'Contract'}"
               @click="tab='Contract'"
               >
               <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                  <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                  <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5" />
               </svg>
                Contract Details
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
            <form class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" action="{{ route('update_profile',$user->id) }}" method="post" enctype="multipart/form-data">
               @csrf
               <h6 class="mb-5 text-lg font-bold">General Information</h6>
               <div class="flex flex-col sm:flex-row">
                  
                  <div class="mb-5 w-full sm:w-2/12 ltr:sm:mr-4 rtl:sm:ml-4">
                     <img
                        src="{{ $profile_img }}"
                        alt="image"
                        class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32"
                        />
                  </div>
                 
                  <div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2">
                     <div>
                        <label for="name:">Customer ID</label>
                        <input id="customer_id" type="text" name="id"  value="FA000{{$user->id}}" placeholder="Customer ID" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="name">Total Invested</label>
                        <input id="TotalInvested:" type="text" name="total_invested"  value="{{$user->total_invested}}" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="name">First Name</label>
                        <input id="first_name" type="text" name="first_name" value="{{$user->first_name}}"  placeholder="Enter First Name" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="name">Last Name</label>
                        <input id="last_name" type="text" name="last_name" value="{{$user->last_name}}" placeholder="Enter Last Name" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="name">Contact</label>
                        <input id="mobile" name="mobile" value="{{$user->mobile}}"  type="text" placeholder="Enter Mobile No" class="form-input" />
                     </div>
                     <div>
                        <label for="name">Email</label>
                        <input id="Email" type="text" name="email" value="{{$user->email}}" placeholder="Enter Email Address" class="form-input" />
                     </div>
                     <div>
                        <label for="name">Prfile Image</label>
                        <input id="profile_img" type="file" name="profile_img"
                           class="form-input" readonly="readonly"/>
                     </div>
                     <div class="flex justify-around pt-5">
                        <label for="name">Gender :</label>
                        <label class="inline-flex cursor-pointer">Male</label>
                        <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" value="Male" @if($user->gender == 'Male') checked="" @endif  />
                        <label class="inline-flex cursor-pointer">Female</label>
                        <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" value="Female" @if($user->gender == 'Female') checked="" @endif />
                     </div>
                     <!--	<div>
                        <label class="inline-flex cursor-pointer">
                        	<input type="checkbox" class="form-checkbox" />
                        	<span class="relative text-white-dark checked:bg-none">Make this my default address</span>
                        </label>
                        </div>-->
                     <div class="mt-3 sm:col-span-2">
                        <button type="submit" class="btn btn-success">Update Profile</button>
                     </div>
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
                     <form action="{{ route('update_profile',$user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                           <div>
                              <label for="aadhar_no">Aadhar No</label>
                              <input id="aadhar_no" name="aadhar_no" value="{{$user->aadhar_no}}" type="text" placeholder="Enter Aaadhar No" class="form-input" />
                           </div>
                           <div>
                              <label for="upload_aadhar_no">Upload Aadhar No</label>
                              <input id="upload_aadhar_no" type="file" name="upload_aadhar_no" value="{{$user->upload_aadhar_no}}" placeholder="Upload GST No" class="form-input" />
                              @if(!empty($user->upload_aadhar_no))
                              <a href="{{asset('public/uploads/users/upload_aadhar_no/'.$user->upload_aadhar_no)}}" target="_blank">
                              <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/users/upload_aadhar_no/'.$user->upload_aadhar_no)}}" >
                              </a>
                              @endif
                           </div>
                           <div>
                              <label for="pan_no">Pan No</label>
                              <input id="pan_no" type="text" name="pan_no" value="{{$user->pan_no}}" placeholder="Enter Pan No" class="form-input" />
                           </div>
                           <div>
                              <label for="upload_pan_no">Upload Pan No</label>
                              <input id="upload_pan_no" type="file" name="upload_pan_no" value="{{$user->upload_pan_no}}" placeholder="Upload GST No" class="form-input" />
                              @if(!empty($user->upload_pan_no))
                              <a href="{{asset('public/uploads/users/upload_pan_no/'.$user->upload_pan_no)}}" target="_blank">
                              <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/users/upload_pan_no/'.$user->upload_pan_no)}}" >
                              </a>
                              @endif
                           </div>
                           <div>
                              <label for="gst_no">GST No</label>
                              <input id="gst_no" type="text" name="gst_no" value="{{$user->gst_no}}" placeholder="Enter GST No" class="form-input" />
                           </div>
                            <div>
                              <label for="upload_gst_no">Upload GST No</label>
                              <input id="upload_gst_no" type="file" name="upload_gst_no" value="{{$user->upload_gst_no}}" placeholder="Upload GST No" class="form-input" />
                              @if(!empty($user->upload_gst_no))
                              <a href="{{asset('public/uploads/users/upload_gst_no/'.$user->upload_gst_no)}}" target="_blank">
                              <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/users/upload_gst_no/'.$user->upload_gst_no)}}" >
                              </a>
                              @endif
                           </div>
                        </div>
                        <div class="mb-5">
                           <label for="address">Present Address</label>
                           <input id="address" type="text" name="address" value="{{$user->address}}" placeholder="Enter Present Address" class="form-input" />
                        </div>
                        <div class="mb-5">
                           <label for="address1">Permanent Address</label>
                           <input id="address1" type="text" name="permanent_address" value="{{$user->permanent_address}}" placeholder="Enter Permanent Address" class="form-input" />
                        </div>
                        <button type="submit" class="btn btn-success">Update Profile</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </template>
	  
      <template x-if="tab === 'preferences'">
         <div class="grid grid-cols-1 gap-5 lg:grid-cols-5">
            <div class="panel">
               <div class="mb-5">
                  <h5 class="mb-4 text-lg font-semibold">Bank Details</h5>
               </div>
               <div class="mb-5">
                  <form action="{{ route('update_profile',$user->id) }}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                           <label for="bank_name">Bank Name</label>
                           <input id="bank_name" name="bank_name" value="{{$user->bank_name}}" type="text" placeholder="Enter Bank Name" class="form-input" />
                        </div>
                        <div>
                           <label for="ifsc_code">IFSC Code</label>
                           <input id="ifsc_code" type="text" name="ifsc_code" value="{{$user->ifsc_code}}" placeholder="Enter IFSC Code" class="form-input" />
                        </div>
                        <div>
                           <label for="account_no">Account No</label>
                           <input id="account_no" type="text" name="account_no" value="{{$user->account_no}}" placeholder="Enter GST No" class="form-input" />
                        </div>
                        <div>
                           <label for="cheque_copy">Upload Cheque Copy</label>
                           <input id="cheque_copy" type="file" name="cheque_copy" placeholder="Select Cheque Copy" class="form-input" />
                           <a href="{{asset('public/uploads/users/cheque/'.$user->cheque_copy)}}" target="_blank">
                              <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/users/cheque/'.$user->cheque_copy)}}" >
                              </a>
                           <!-- <a href="{{asset('public/uploads/users/cheque/'.$user->cheque_copy)}}" target="_blank"><img
                              src="{{asset('public/uploads/users/cheque/'.$user->cheque_copy)}}" alt="image"style="width:10rem" /></a>  -->
                        </div>
                     </div>
                     <button type="submit" class="btn btn-success">Update Profile</button>
                  </form>
               </div>
            </div>
         </div>
      </template>
	  
	  <template x-if="tab === 'Contract'">
         <div class="grid grid-cols-1 gap-5 lg:grid-cols-5">
            <div class="panel">
               <div class="mb-5">
                  <h5 class="mb-4 text-lg font-semibold">Contract Data</h5>
               </div>
               <div class="mb-5">
                  <form action="{{ route('update_profile',$user->id) }}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        
                        <div>
                           <label for="contract_img">Select Contract</label>
                           <input id="contract_img" type="file" name="contract_img" placeholder="Select Contract File" class="form-input" />
                           <a href="{{asset('public/uploads/users/contract_img/'.$user->contract_img)}}" target="_blank">
                              <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/users/contract_img/'.$user->contract_img)}}" >
                              </a>
                           <!-- <a href="{{asset('public/uploads/users/contract_img/'.$user->contract_img)}}" target="_blank"><img
                              src="{{asset('public/uploads/users/contract_img/'.$user->contract_img)}}" alt="image"style="width:10rem" /></a>  -->
                        </div>
                     </div>
                     <button type="submit" class="btn btn-success">Update Profile</button>
                  </form>
               </div>
            </div>
         </div>
      </template>
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