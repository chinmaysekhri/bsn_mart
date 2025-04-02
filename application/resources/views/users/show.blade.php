@extends('admin.layouts.app')
@section('title','Show Customer Detail')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{ route('users.index') }}" class="text-primary hover:underline">Customer</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Customer Details</span>
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
            <h5 class="text-lg font-semibold dark:text-white-light">Show Customer Detail</h5>
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
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="UserID">
                  <strong>Customer Id:</strong>
				           FA000{{ $user->id }}
                  </label>
               </div>
             </div>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
          <label for="Address">
            <strong>Managed By:</strong>
            @if(!empty($user_emp_manage))
               {{ $user_emp_manage->first_name .' '. $user_emp_manage->last_name }}
            @endif
          </label>
        </div>
               <div>
                  <label for="Created">
                  <strong>Created By:</strong>
                  @if(!empty($user_emp))
                  {{ $user_emp->first_name .' '. $user_emp->last_name }}
                  @endif
                  </label>
               </div>
            </div>
             <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                 <div>
                  <label for="Enrollment">
                  <strong>Date Of Enrollment:</strong>
                     {{ $user->date_of_enrollment }}
                  </label>
               </div>
                <div>
                  <label for="Enrollment">
                  <strong>Total Invested:</strong>
                     <strong>12383</strong>
                  </label>
               </div>
            </div>
            
           <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="First">
                  <strong>First Name:</strong>
                     {{ $user->first_name }}
                  </label>
               </div>
			   
			         <div>
                  <label for="Last">
                  <strong>Last Name:</strong>
                     {{ $user->last_name }}
                  </label>
               </div>
			   </div>
           <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
			         <div>
                  <label for="Mobile">
                  <strong>Contact:</strong>
                    {{ $user->mobile }}
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
                  <label for="Gender">
                  <strong>Gender:</strong>
                   {{ $user->gender }}
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
                  <strong>Permanent Address:</strong>
                    {{ $user->permanent_address }}
                  </label>
               </div>
              </div><hr><br>

           <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
             <div>
                  <label for="GST">
                  <strong>Aadhar No:</strong>
                 {{ $user->aadhar_no }}
                  @if(!empty($user->upload_aadhar_no))
                  <a href="{{asset('public/uploads/users/upload_aadhar_no/'.$user->upload_aadhar_no)}}" download="{{$user->upload_aadhar_no}}">
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
                  <a href="{{asset('public/uploads/users/upload_aadhar_no/'.$user->upload_aadhar_no)}}" target="_blank">
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
                  <a href="{{ route('users.show',[$user->id, 'action'=>'delete_img', 'column'=>'upload_aadhar_no', 'img_val'=>'public/uploads/users/upload_aadhar_no/'.$user->upload_aadhar_no]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:404px;">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                              <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path
                                 d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 stroke-linecap="round"
                                 ></path>
                              <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path
                                 opacity="0.5"
                                 d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 ></path>
                           </svg>
                           Delete
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
                  <a href="{{asset('public/uploads/users/upload_pan_no/'.$user->upload_pan_no)}}" download="{{$user->upload_pan_no}}">
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
                 <a href="{{asset('public/uploads/users/upload_pan_no/'.$user->upload_pan_no)}}" target="_blank">
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
                  <a href="{{ route('users.show',[$user->id, 'action'=>'delete_img', 'column'=>'upload_aadhar_no', 'img_val'=>'public/uploads/users/upload_aadhar_no/'.$user->upload_aadhar_no]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:393px;">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                              <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path
                                 d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 stroke-linecap="round"
                                 ></path>
                              <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path
                                 opacity="0.5"
                                 d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 ></path>
                           </svg>
                           Delete
                        </button>
                     </a>
                  @endif
                  </label>
               </div>
             </div><br>
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                 <div>
                  <label for="GST">
                  <strong>GST:</strong>
                  {{ $user->gst_no }}
                @if(!empty($user->upload_gst_no))
                   <a href="{{asset('public/uploads/users/upload_gst_no/'.$user->upload_gst_no)}}" download="{{$user->upload_gst_no}}">
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
                  <a href="{{asset('public/uploads/users/upload_gst_no/'.$user->upload_gst_no)}}" target="_blank">
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
                  <a href="{{ route('users.show',[$user->id, 'action'=>'delete_img', 'column'=>'upload_aadhar_no', 'img_val'=>'public/uploads/users/upload_aadhar_no/'.$user->upload_aadhar_no]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:404px;">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                              <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path
                                 d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 stroke-linecap="round"
                                 ></path>
                              <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path
                                 opacity="0.5"
                                 d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 ></path>
                           </svg>
                           Delete
                        </button>
                     </a>
                  @endif
                  </label>
               </div>
              </div><hr><br>

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
                  <label for="Cheque">
                  <strong> Cheque Copy:</strong>
                 @if(!empty($user->cheque_copy))
                   <a href="{{asset('public/uploads/users/cheque/'.$user->cheque_copy)}}" download="{{$user->cheque_copy}}">
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
                   <a href="{{asset('public/uploads/users/cheque/'.$user->cheque_copy)}}" target="_blank">
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
                  <a href="{{ route('users.show',[$user->id, 'action'=>'delete_img', 'column'=>'upload_aadhar_no', 'img_val'=>'public/uploads/users/upload_aadhar_no/'.$user->upload_aadhar_no]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:341px;">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                              <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path
                                 d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 stroke-linecap="round"
                                 ></path>
                              <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path
                                 opacity="0.5"
                                 d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 ></path>
                           </svg>
                           Delete
                        </button>
                     </a>
                  @endif
                  </label>
               </div>
			   
			 <div>
                  <label for="Cheque">
                  <strong>Select Contract File :</strong>
                 @if(!empty($user->contract_img))
                   <a href="{{asset('public/uploads/users/contract_img/'.$user->contract_img)}}" download="{{$user->contract_img}}">
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
                   <a href="{{asset('public/uploads/users/contract_img/'.$user->contract_img)}}" target="_blank">
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
                  <a href="{{ route('users.show',[$user->id, 'action'=>'delete_img', 'column'=>'contract_img', 'img_val'=>'public/uploads/users/contract_img/'.$user->contract_img]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:341px;">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                              <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path
                                 d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 stroke-linecap="round"
                                 ></path>
                              <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                              <path
                                 opacity="0.5"
                                 d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 ></path>
                           </svg>
                           Delete
                        </button>
                     </a>
                  @endif
                  </label>
               </div>
			   
			   
             </div>
				
				<hr><br>
           
               
			   
			   {{--<div>
                  <label for="Role">
                  <strong>Role Name:</strong> &nbsp;
                  @if(!empty($user->roles()))
                  @foreach($user->getRoleNames() as $v)
                  <span class="badge bg-info">{{ $v }} </span> &nbsp;&nbsp;
                  @endforeach
                  @endif
                  </label>
               </div>--}}
            
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
</div>
<br>
<!-- User Logs -->
<div x-data="form">

<button onclick="myFunction()" class="badge bg-info" style="padding: 10px 42px 10px 42px;font-size: 17px">Customer Logs</button>



<button onclick="myComment()" class="badge bg-primary" style="padding: 10px 42px 10px 42px;font-size: 17px">Add Customer Comment</button>

<div class="grid grid-cols-1 gap-4 sm:grid-cols-1"> 
<div class="panel" style="display: none;" id="myCommentDIV">
   <form action="{{route('add_users_comment', $user->id)}}" method="POST">
   @csrf
	<div>
		<label for="Comment">Customer Comment</label>
		
		{!! Form::text('comment', null , array('placeholder' => ' ','class' => 'form-input','id'=>'Comment')) !!}
	</div>
	
	 <div>
		<button type="submit" class="btn btn-primary !mt-6">Submit Comment</button>
	 </div>
   </form>
</div>	
</div>	

<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
   
       <div class="panel" style="display: none;" id="myDIV">
	   
         <div class="mb-5 flex" style="text-align: center" >
            <h4 class="text-lg font-semibold dark:text-white-light" style="margin-left: 400px;">Customer Logs</h4>
         </div>
         <div class="mb-5">
            <div class="dataTable-container">
               <table id="myTable1" class="whitespace-nowrap dataTable-table">
                  <thead>
                     <tr style="background: radial-gradient(#7fd9a7f7, transparent);">
                        <th>S.No</th>
                        <th>Logs Date</th>
                        <th>Created By</th>
                        <th>Comment</th>
                     </tr>
                  </thead>
                  <tbody>
				    @php
				      $i =0;
					@endphp
					
				    @foreach($user_comments as $comment)
                     <tr>
                        <td>{{++$i}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td>{{$comment->first_name.' '.$comment->last_name}}</td>
                        <td>{{$comment->comment}}</td>
                     </tr>
					@endforeach 
					
                  </tbody>
                 
               </table>
            </div>
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