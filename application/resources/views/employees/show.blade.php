@php
 
use App\Helpers\Helper;

@endphp

@extends('admin.layouts.app')
@section('title','Employee Show Detail')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{ route('employees.index') }}" class="text-primary hover:underline">Employee</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Employee Detail</span>
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
            <h5 class="text-lg font-semibold dark:text-white-light">Employee Detail</h5>
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
             
            </div>
            @endif
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                
               <div>
                  <label for="Address">
                  <strong>My Manager:</strong>
                  @if(!empty($user_emp_manage))
                  
                  {{ $user_emp_manage->first_name .' '. $user_emp_manage->last_name }}
                  
                  @else
                  
                   Self 
                   
                  @endif
                  </label>
               </div>
               <div>
                  <label for="Address">
                  <strong>Created By:</strong>
                  @if(!empty($user_emp))
                  {{ $user_emp->first_name .' '. $user_emp->last_name }}
                  @endif
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="Contact">
                  <strong>Date Of Joining:</strong>
                  {{ $emp->date_of_joining }}
                  </label>
               </div>
               <div>
                  @php 

               //  $i=1;

               //  $getDesignationName = Helper::getDesignationName($emp->designation);
                 
               //  $designationName    = $getDesignationName->designation_name;
             
                 @endphp
                
                  <label for="Contact">
                  <strong>Designation:</strong>
                  {{ $emp->designation }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="gridEmail">
                  <strong>Official Email:</strong>
                  @if(!empty($emp->official_email))
                  {{ $emp->official_email }}
                  @else
                  	Not Applicable
                  @endif
                  </label>
               </div>
               
               <div>
                  <label for="gridEmail">
                  <strong>Official Contact:</strong>
                   @if(!empty($emp->official_contact))
                      {{ $emp->official_contact }}
                   @else
                  	Not Applicable
                   @endif
                  </label>
               </div>
               
               <div>
                  <label for="gridEmail">
                  <strong>Name:</strong>
                  {{ $emp->first_name .' '. $emp->last_name }}
                  </label>
               </div>
               
               <div>
                  <label for="Contact">
                  <strong>Contact:</strong>
                  {{ $emp->mobile }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="gridEmail">
                  <strong>Email:</strong>
                  {{ $emp->email }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>Gender:</strong>
                  {{ $emp->gender }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="Contact">
                  <strong>Present Address:</strong>
                  {{ $emp->present_address }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>Permanent Address:</strong>
                  {{ $emp->permanent_address }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="Contact">
                  <strong>Salary:</strong>
                  {{ $emp->salary }}
                  </label>
               </div>
               <div>
                  <label for="gridPinCode">
                     <strong>Resume:</strong>
                     @if(!empty($emp->resume))
                     <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/ten_board_school_document/'.$emp->ten_board_school_document)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/resume/'.$emp->resume)}}" download="{{$emp->resume}}">
                        <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:63px; margin-top: -24px;">
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
                     @endif
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/resume/'.$emp->resume)}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'resume', 'img_val'=>'public/uploads/employee/'.$emp->id.'/resume/'.$emp->resume]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:292px;">
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
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="Contact">
                  <strong>ESI No:</strong>
                  {{ $emp->esi_no }}
                  </label>
               </div>
			    <div>
                  <label for="Contact">
                  <strong>UAN No:</strong>
                  {{ $emp->uan_no }}
                  </label>
                </div>
            </div>
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label for="Contact">
                  <strong>Aadhar No:</strong>
                  {{ $emp->aadhar_no }}
                  </label>
               </div>
               <div>
                   @if(!empty($emp->upload_aadhar_no))
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/upload_aadhar_no/'.$emp->upload_aadhar_no)}}" download="{{$emp->upload_aadhar_no}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/upload_aadhar_no/'.$emp->upload_aadhar_no)}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'upload_aadhar_no', 'img_val'=>'public/uploads/employee/'.$emp->id.'/upload_aadhar_no/'.$emp->upload_aadhar_no]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:258px;">
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
               </div>
            </div>
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label for="Contact">
                  <strong>Pan No:</strong>
                  {{ $emp->pan_no }}
                  </label>
               </div>
               <div>
                    @if(!empty($emp->upload_pan_no))
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/upload_pan_no/'.$emp->upload_pan_no)}}" download="{{$emp->upload_pan_no}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/upload_pan_no/'.$emp->upload_pan_no)}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'upload_pan_no', 'img_val'=>'public/uploads/employee/'.$emp->id.'/upload_pan_no/'.$emp->upload_pan_no]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:258px;">
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
               </div>
            </div>
           
            <hr>
            <br>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="Contact">
                  <strong style="font-size: 20px;">Qualification:</strong>
                  {{ $emp->qualification }}
                  </label>
               </div>
            </div>
			
			@if(!empty($emp->ten_passing_year))
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
               <div>
                  <label for="Contact">
                  <strong>10th Passing year:</strong>
                  {{ $emp->ten_passing_year }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>10th Mark percentage:</strong>
                  {{ $emp->ten_mark_percentage }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>10th Board School:</strong>
                  {{ $emp->ten_board_school }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Attached Board/School Document:</strong>
                     @if(!empty($emp->ten_board_school_document))
                     <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/ten_board_school_document/'.$emp->ten_board_school_document)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/ten_board_school_document/'.$emp->ten_board_school_document)}}" download="{{$emp->ten_board_school_document}}">
                        <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:241px; margin-top: -21px;">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/ten_board_school_document/'.$emp->ten_board_school_document)}}" target="_blank">
                        <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:359px;">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'ten_board_school_document', 'img_val'=>'public/uploads/employee/'.$emp->id.'/ten_board_school_document/'.$emp->ten_board_school_document]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:471px;">
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
            <hr>
            <br>
			@endif
           <!-- <strong style="font-size: 20px;">Qualification 12th</strong><br><br>-->
		   
		   @if(!empty($emp->twelve_passing_year))
			   
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
               <div>
                  <label for="Contact">
                  <strong>12th Passing year:</strong>
                  {{ $emp->twelve_passing_year }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>12th Mark percentage:</strong>
                  {{ $emp->twelve_mark_percentage }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>12th Board School:</strong>
                  {{ $emp->twelve_board_school }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Attached Board/School Document:</strong>
                     @if(!empty($emp->twelve_board_school_document))
                     <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/twelve_board_school_document/'.$emp->twelve_board_school_document)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/twelve_board_school_document/'.$emp->twelve_board_school_document)}}" download="{{$emp->twelve_board_school_document}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/twelve_board_school_document/'.$emp->twelve_board_school_document)}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'twelve_board_school_document', 'img_val'=>'public/uploads/employee/'.$emp->id.'/twelve_board_school_document/'.$emp->twelve_board_school_document]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:471px;">
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
            <hr>
            <br>
			@endif
            <!--<strong style="font-size: 20px;">Qualification Graduate</strong><br><br>-->
			
			@if(!empty($emp->graduate_passing_year))
				
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
               <div>
                  <label for="Contact">
                  <strong>Graduate Passing year:</strong>
                  {{ $emp->graduate_passing_year }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>Graduate Mark percentage:</strong>
                  {{ $emp->graduate_mark_percentage }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>Graduate Board School:</strong>
                  {{ $emp->graduate_board_school }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Attach Board/School Document:</strong>
                     @if(!empty($emp->graduate_board_school_document))
                     <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/graduate_board_school_document/'.$emp->graduate_board_school_document)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/graduate_board_school_document/'.$emp->graduate_board_school_document)}}" download="{{$emp->graduate_board_school_document}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/graduate_board_school_document/'.$emp->graduate_board_school_document)}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'graduate_board_school_document', 'img_val'=>'public/uploads/employee/'.$emp->id.'/graduate_board_school_document/'.$emp->graduate_board_school_document]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:471px;">
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
            <hr>
            <br>
			@endif
           <!-- <strong style="font-size: 20px;">Qualification  Post Graduate</strong><br><br>-->
           
           @if(!empty($emp->post_graduate_passing_year))
			   
		   <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
               <div>
                  <label for="Contact">
                  <strong>Post Graduate Passing year:</strong>
                  {{ $emp->post_graduate_passing_year }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>Post Graduate Mark percentage:</strong>
                  {{ $emp->post_graduate_mark_percentage }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong> Post Graduate Board School:</strong>
                  {{ $emp->post_graduate_board_school }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Attached Board/School Document:</strong>
                     @if(!empty($emp->post_graduate_board_school_document))
                     <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/post_graduate_board_school_document/'.$emp->post_graduate_board_school_document)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/post_graduate_board_school_document/'.$emp->post_graduate_board_school_document)}}" download="{{$emp->post_graduate_board_school_document}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/post_graduate_board_school_document/'.$emp->post_graduate_board_school_document)}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'post_graduate_board_school_document', 'img_val'=>'public/uploads/employee/'.$emp->id.'/post_graduate_board_school_document/'.$emp->post_graduate_board_school_document]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:471px;">
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
            <hr>
            <br>
			@endif
            <!--<strong style="font-size: 20px;">Qualification PHD</strong><br><br>-->
			
			@if(!empty($emp->phd_passing_year))
				
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
               <div>
                  <label for="Contact">
                  <strong>PHD Passing year:</strong>
                  {{ $emp->phd_passing_year }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>PHD Mark percentage:</strong>
                  {{ $emp->phd_mark_percentage }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>PHD Board School:</strong>
                  {{ $emp->phd_board_school }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Attached Board/School Document:</strong>
                     @if(!empty($emp->phd_board_school_document))
                     <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/phd_board_school_document/'.$emp->phd_board_school_document)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/phd_board_school_document/'.$emp->phd_board_school_document)}}" download="{{$emp->phd_board_school_document}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/phd_board_school_document/'.$emp->phd_board_school_document)}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'phd_board_school_document', 'img_val'=>'public/uploads/employee/'.$emp->id.'/phd_board_school_document/'.$emp->phd_board_school_document]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:471px;">
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
            <hr>
            <br>
		 @endif
            <strong style="font-size: 20px;">Employment Information</strong><br><br>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="Contact">
                  <strong>Company Name:</strong>
                  {{ $emp->company_name }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
               <div>
                  <label for="Contact">
                  <strong>From Duration:</strong>
                  {{ $emp->from_company_duration }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>To Duration:</strong>
                  {{ $emp->to_company_duration }}
                  </label>
               </div>
               <div>
                  <label for="Contact">
                  <strong>Company CTC:</strong>
                  {{ $emp->company_ctc }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Comapny Offer Letter:</strong>
                     @if(!empty($emp->company_offer_letter))
                     <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/company_offer_letter/'.$emp->company_offer_letter)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/company_offer_letter/'.$emp->company_offer_letter)}}" download="{{$emp->company_offer_letter}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/company_offer_letter/'.$emp->company_offer_letter)}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'company_offer_letter', 'img_val'=>'public/uploads/employee/'.$emp->id.'/company_offer_letter/'.$emp->company_offer_letter]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:456px;">
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
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Comapny Relieving Letter:</strong>
                     @if(!empty($emp->company_relieving_letter))
                     <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/company_relieving_letter/'.$emp->company_relieving_letter)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/company_relieving_letter/'.$emp->company_relieving_letter)}}" download="{{$emp->company_relieving_letter}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/company_relieving_letter/'.$emp->company_relieving_letter)}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'company_relieving_letter', 'img_val'=>'public/uploads/employee/'.$emp->id.'/company_relieving_letter/'.$emp->company_relieving_letter]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:456px;">
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
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="gridPinCode">
                     <strong>Comapny Salary Slip First:</strong>
                     @if(!empty($emp->salary_slip_first))
                     <!--   <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_first/'.$emp->salary_slip_first)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_first/'.$emp->salary_slip_first)}}" download="{{$emp->salary_slip_first}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_first/'.$emp->salary_slip_first)}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'salary_slip_first', 'img_val'=>'public/uploads/employee/'.$emp->id.'/salary_slip_first/'.$emp->salary_slip_first]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:456px;">
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
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="gridPinCode">
                     <strong>Comapny Salary Slip Second:</strong>
                     @if(!empty($emp->salary_slip_second))
                     <!--    <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_second/'.$emp->salary_slip_second)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_second/'.$emp->salary_slip_second)}}" download="{{$emp->salary_slip_second}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_second/'.$emp->salary_slip_second)}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'salary_slip_second', 'img_val'=>'public/uploads/employee/'.$emp->id.'/salary_slip_second/'.$emp->salary_slip_second]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:456px;">
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
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="gridPinCode">
                  <strong>Comapny Salary Slip Third:</strong>
                  @if(!empty($emp->salary_slip_third))
                  <!--   <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_third/'.$emp->salary_slip_third)}}" ><br> -->
                  <a href="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_third/'.$emp->salary_slip_third)}}" download="{{$emp->salary_slip_third}}">
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
                  <a href="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_third/'.$emp->salary_slip_third)}}" target="_blank">
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
                  <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'salary_slip_third', 'img_val'=>'public/uploads/employee/'.$emp->id.'/salary_slip_third/'.$emp->salary_slip_third]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:456px;">
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
            @php
            $other_company_name_arr = json_decode($emp->other_company_name, true);
            $other_from_duration_arr = json_decode($emp->other_from_duration, true);
            $other_to_duration_arr = json_decode($emp->other_to_duration, true);
            $other_company_ctc_arr = json_decode($emp->other_company_ctc, true);
            $other_offer_letter_arr = json_decode($emp->other_offer_letter, true);
            $other_relieving_letter_arr = json_decode($emp->other_relieving_letter, true);
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
                  <strong> Company Name:</strong>
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
                  <strong> Coampnay CTC:</strong>
                  {{$other_company_ctc_arr[$other_i-1]}}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong> Offer Letter:</strong>
                     @if(!empty($other_offer_letter_arr[$other_i-1]))
                     <!--   <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/other_offer_letter/'.$emp->other_offer_letter)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/other_offer_letter/'.$other_offer_letter_arr[$other_i-1])}}" download="{{$other_offer_letter_arr[$other_i-1]}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/other_offer_letter/'.$other_offer_letter_arr[$other_i-1])}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'other_offer_letter', 'img'=>$other_offer_letter_arr[$other_i-1], 'img_val'=>'public/uploads/employee/'.$emp->id.'/other_offer_letter/'.$other_offer_letter_arr[$other_i-1]]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:471px;">
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
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong> Relieving Letter:</strong>
                     @if(!empty($other_relieving_letter_arr[$other_i-1]))
                     <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/other_relieving_letter/'.$emp->other_relieving_letter)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/other_relieving_letter/'.$other_relieving_letter_arr[$other_i-1])}}" download="{{$other_relieving_letter_arr[$other_i-1]}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/other_relieving_letter/'.$other_relieving_letter_arr[$other_i-1])}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'other_relieving_letter', 'img'=>$other_relieving_letter_arr[$other_i-1], 'img_val'=>'public/uploads/employee/'.$emp->id.'/other_relieving_letter/'.$other_relieving_letter_arr[$other_i-1]]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-24px;margin-left:471px;">
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
            <hr>
            <br>
            @php
            $other_i = $other_i+1;
            @endphp
            @endforeach
			
			
            <strong style="font-size: 20px;">Company Document</strong><br><br>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
               <div>
                  <label for="gridPinCode">
                     <strong>Offer Letter:</strong>
                     @if(!empty($emp->other_company_offer_letter))
                    <a href="{{asset('public/uploads/employee/'.$emp->id.'/other_company_offer_letter/'.$emp->other_company_offer_letter)}}" download="{{$emp->other_company_offer_letter}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/other_company_offer_letter/'.$emp->other_company_offer_letter)}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'other_company_offer_letter', 'img_val'=>'public/uploads/employee/'.$emp->id.'/other_company_offer_letter/'.$emp->other_company_offer_letter]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:444px;">
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
			
            <hr>
            <br>
			
		  @php
            $other_document_name_arr = json_decode($emp->other_document_name, true);
            $other_upload_document_arr = json_decode($emp->other_upload_document, true);

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
					 
                     <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/employee/'.$emp->id.'/other_relieving_letter/'.$emp->other_relieving_letter)}}" ><br> -->
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/other_upload_document/'.$other_upload_document_arr[$other_i-1])}}" download="{{$other_upload_document_arr[$other_i-1]}}">
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
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/other_upload_document/'.$other_upload_document_arr[$other_i-1])}}" target="_blank">
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
                     <a href="{{ route('employees.show',[$emp->id, 'action'=>'delete_img', 'column'=>'other_upload_document', 'img_val'=>'public/uploads/employee/'.$emp->id.'/other_upload_document/'.$other_upload_document_arr[$other_i-1]]) }}" >
                        <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:444px;">
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
						
			<hr>
			<br>
			
	        @php
            $other_i = $other_i+1;
            @endphp

          @endforeach
			
         </div>
		 @if($emp->final_verified=='Not Verified')
			 
		  <a href="{{route('employee_verify',$emp->id)}}" class="badge bg-success" style="padding: 10px 42px 10px 42px;font-size: 17px; margin-left:785px">Verify Employee</a>
		  @endif
		
      </div>
   </div>
</div>
</div>
<!-- Employee Logs -->
<br>
<div x-data="form">
   <button onclick="myFunction()" class="badge bg-info" style="padding: 10px 42px 10px 42px;font-size: 17px">Logs</button>
   @if($emp->final_verified=='Not Verified' || Auth::user()->for=='super_admin')
   <button class="badge bg-success" style="padding: 10px 42px 10px 42px;font-size: 17px"><a href="{{ route('employees_detail',$emp->id) }}" > Employee Detail </a></button>
    @endif
   <button onclick="myComment()" class="badge bg-primary" style="padding: 10px 42px 10px 42px;font-size: 17px">Add Comment</button>
   <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
      <div class="panel" style="display: none;" id="myCommentDIV">
         <form action="{{route('add_employees_comment', $emp->id)}}" method="POST">
            @csrf
            <div>
               <label for="Comment">Comment</label>
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
            <h4 class="text-lg font-semibold dark:text-white-light" style="margin-left: 400px;">Employee Logs</h4>
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
                     @foreach($emp_comments as $comment)
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