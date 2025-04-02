@extends('admin.layouts.app')
@section('title','Customers  Profile')
@section('content')
<div>
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="javascript:;" class="text-primary hover:underline">Customer</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Account Settings</span>
      </li>
   </ul>
</div>
<div class="pt-5">
   <div class="mb-5 flex items-center justify-between">
      <h5 class="text-lg font-semibold dark:text-white-light">Settings</h5>
      <button type="submit" class="btn btn-primary"><a href="#">Edit Profile</a></button>
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
               <h6 class="mb-5 text-lg font-bold">General Information</h6>
               <div class="flex flex-col sm:flex-row">
                  <div class="mb-5 w-full sm:w-2/12 ltr:sm:mr-4 rtl:sm:ml-4">
                     <img
                        src="http://localhost/finley_portal/public/uploads/users/profile/1690004105.png"
                        alt="image"
                        class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32"
                        />
                  </div>
                  <div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2">
                      <div>
                        <label for="name:">Customer ID</label>
                        <input id="customer_id" type="text" name="customer_id"  value="" placeholder="Customer ID" class="form-input" readonly="readonly">
                     </div>
                      <div>
                        <label for="name:">Date of Enrollment</label>
                        <input id="customer_id" type="text" name="customer_id"  value="" placeholder=" Enter Date of Enrollment" class="form-input" readonly="readonly">
                     </div>
                      <div class="" >
                     <label for="managed_by">Managed By</label>
                     
                        <input id="managed_by" type="text" name="managed_by"  value="" placeholder="Show Managed By Name" class="form-input" readonly="readonly">
      
                    </div>
                     <div>
                        <label for="name:">Total Invested</label>
                        <input id="total_invested" type="text" name="total_invested"  value="" placeholder=" Enter Total Invested" class="form-input" readonly="readonly">
                     </div>
                    
                     <div>
                        <label for="name">First Name</label>
                        <input id="first_name" type="text" name="first_name" value=""  placeholder="Enter First Name" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="name">Last Name</label>
                        <input id="last_name" type="text" name="last_name" value="" placeholder="Enter Last Name" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="name">Contact</label>
                        <input id="mobile" name="mobile" value=""  type="text" placeholder="Enter Mobile No" class="form-input" readonly="readonly"/>
                     </div>
                     <div>
                        <label for="name">Email</label>
                        <input id="Email" type="text" name="email" value="" placeholder="Enter Email Address" class="form-input" readonly="readonly"/>
                     </div>
                     <div class="flex justify-around pt-5">
                        <label for="name">Gender :</label>
                        <label class="inline-flex cursor-pointer">Male</label>
                        <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" value="Male" />
                        <label class="inline-flex cursor-pointer">Female</label>
                        <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" value="Female" />
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
                     <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                          
                           <div>
                              <label for="aadhar_no">Aadhar No</label>
                              <input id="aadhar_no" type="file" name="aadhar_no"
                           class="form-input" />
                           </div>
                           <div>
                              <label for="pan_no">Pan No</label>
                              <input id="pan_no" type="file" name="pan_no"
                           class="form-input" />
                           </div>
                           <div>
                              <label for="gst_no">GST No</label>
                               <input id="gst_no" type="file" name="gst_no"
                           class="form-input" />
                           </div>
                           <div>
                              <label for="gst_no">Present Address</label>
                              <input id="gst_no" type="text" name="present_address" value="" placeholder="Enter Present Address" class="form-input" readonly="readonly"/>
                           </div>
                           <div>
                              <label for="gst_no">Permanent Address</label>
                              <input id="gst_no" type="text" name="permanent_address" value="" placeholder="Enter Permanent Address" class="form-input" readonly="readonly"/>
                           </div>
<div>
                           <label for="name">Upload Cheque Copy</label>
                           <input id="cheque_copy" type="file" name="cheque_copy"
                           class="form-input" />
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