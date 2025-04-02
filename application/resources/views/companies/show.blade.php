@extends('admin.layouts.app')
@section('title','Company Show Detail')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{ route('companies.index') }}" class="text-primary hover:underline">Company</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span> Company Detail</span>
      </li>
   </ul>
</div>



<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
   <!-- Grid -->
   <div class="panel" style="border-style: ridge;">
      <div class="mb-5 flex items-center justify-between" >
         <h5 class="text-lg font-semibold dark:text-white-light text-align:center" style="    margin-left: 274px;font-size: 23px;">View Company Detail</h5>
      </div>
	  
	 <!-- Flash  Message  start -->

	   <center id="alertMessageHide">@if ($message = Session::get('success'))
	     <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
	   @endif
	    </center>
	
     <!-- Flash  Message  End  -->
	  
      <br>
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
               <label for="gridName">
               <strong>Date of Incorporation:</strong>
               {{ $company->date_of_incorporation}}
               </label>
            </div>
            <div>
               <label for="gridName">
               <strong>Company Name:</strong>
               {{ $company->company_name}}
               </label>
            </div>
         </div>
        
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="gridEmail">
               <strong>Email:</strong>
               {{ $company->company_email }}
               </label>
            </div>
            <div>
               <label for="gridMobile">
               <strong>Mobile:</strong>
               {{ $company->mobile }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="gridCity">
               <strong>Created Date:</strong>
               {{ $company->created_at }}
               </label>
            </div>
            <div>
               <label for="gridMobile">
               <strong>Bank Name:</strong>
               {{ $company->bank_name }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="gridMobile">
               <strong>IFSC Code:</strong>
               {{ $company->ifsc_code }}
               </label>
            </div>
            <div>
               <label for="gridMobile">
               <strong>Account No:</strong>
               {{ $company->account_no }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="gridMobile">
               <strong>Account Login URL:</strong>
               {{ $company->account_login_url }}
               </label>
            </div>
            <div>
               <label for="gridMobile">
               <strong>User Id:</strong>
               {{ $company->user_id }}
               </label>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="gridMobile">
               <strong>Company Password:</strong>
               {{ $company->company_password }}
               </label>
            </div>
         </div>
         <br><br>	
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="gridPinCode">
                  <strong>COI:</strong>
                   @if(!empty($company->coi))
                  <!-- <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/coi/'.$company->coi)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/coi/'.$company->coi)}}" download="{{$company->coi}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/coi/'.$company->coi)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                
                     <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'coi', 'img_val'=>'public/uploads/company/'.$company->id.'/coi/'.$company->coi]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>MCA LLP:</strong>
                   @if(!empty($company->mca_llp))
                 <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/mca_llp/'.$company->mca_llp)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/mca_llp/'.$company->mca_llp)}}" download="{{$company->mca_llp}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/mca_llp/'.$company->mca_llp)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                 
                      <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'mca_llp', 'img_val'=>'public/uploads/company/'.$company->id.'/mca_llp/'.$company->mca_llp]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>Pan Card:</strong>
                   @if(!empty($company->pan_card))
                 <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/pan_card/'.$company->pan_card)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/pan_card/'.$company->pan_card)}}" download="{{$company->pan_card}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/pan_card/'.$company->pan_card)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                  
                     <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'pan_card', 'img_val'=>'public/uploads/company/'.$company->id.'/pan_card/'.$company->pan_card]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong >GST Certificate:</strong>
                   @if(!empty($company->gst_certificate))
                 <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/gst_certificate/'.$company->gst_certificate)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/gst_certificate/'.$company->gst_certificate)}}" download="{{$company->gst_certificate}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/gst_certificate/'.$company->gst_certificate)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'gst_certificate', 'img_val'=>'public/uploads/company/'.$company->id.'/gst_certificate/'.$company->gst_certificate]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>Rent Agrement:</strong>
                   @if(!empty($company->rent_agrement))
                 <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/rent_agrement/'.$company->rent_agrement)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/rent_agrement/'.$company->rent_agrement)}}" download="{{$company->rent_agrement}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/rent_agrement/'.$company->rent_agrement)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                   <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'rent_agrement', 'img_val'=>'public/uploads/company/'.$company->id.'/rent_agrement/'.$company->rent_agrement]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>MOA:</strong>
                  @if(!empty($company->moa))
                  <!-- <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/moa/'.$company->moa)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/moa/'.$company->moa)}}" download="{{$company->moa}}" target="_blank">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/moa/'.$company->moa)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                   <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'moa', 'img_val'=>'public/uploads/company/'.$company->id.'/moa/'.$company->moa]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>MSME Certificate:</strong>
                   @if(!empty($company->msme_certificate))
                 <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/msme_certificate/'.$company->msme_certificate)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/msme_certificate/'.$company->msme_certificate)}}" download="{{$company->msme_certificate}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/msme_certificate/'.$company->msme_certificate)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                 <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'msme_certificate', 'img_val'=>'public/uploads/company/'.$company->id.'/msme_certificate/'.$company->msme_certificate]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>AOA:</strong>
                  @if(!empty($company->aoa))
                 <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/aoa/'.$company->aoa)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/aoa/'.$company->aoa)}}" download="{{$company->aoa}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/aoa/'.$company->aoa)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                  <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'aoa', 'img_val'=>'public/uploads/company/'.$company->id.'/aoa/'.$company->aoa]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>TAN No:</strong>
                  @if(!empty($company->tan_no))
                 <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/tan_no/'.$company->tan_no)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/tan_no/'.$company->tan_no)}}" download="{{$company->tan_no}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/tan_no/'.$company->tan_no)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                  <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'tan_no', 'img_val'=>'public/uploads/company/'.$company->id.'/tan_no/'.$company->tan_no]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>PF No:</strong>
                  @if(!empty($company->pf_no))
                 <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/pf_no/'.$company->pf_no)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/pf_no/'.$company->pf_no)}}" download="{{$company->pf_no}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/pf_no/'.$company->pf_no)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                 <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'pf_no', 'img_val'=>'public/uploads/company/'.$company->id.'/pf_no/'.$company->pf_no]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>ESI No:</strong>
                  @if(!empty($company->esi_no))
                  <!-- <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/esi_no/'.$company->esi_no)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/esi_no/'.$company->esi_no)}}" download="{{$company->esi_no}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/esi_no/'.$company->esi_no)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                  <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'esi_no', 'img_val'=>'public/uploads/company/'.$company->id.'/esi_no/'.$company->esi_no]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>NGO Darpan:</strong>
                  @if(!empty($company->ngo_darpan))
                 <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/ngo_darpan/'.$company->ngo_darpan)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/ngo_darpan/'.$company->ngo_darpan)}}" download="{{$company->ngo_darpan}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/ngo_darpan/'.$company->ngo_darpan)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                 <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'ngo_darpan', 'img_val'=>'public/uploads/company/'.$company->id.'/ngo_darpan/'.$company->ngo_darpan]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>ISO Certificate:</strong>
                   @if(!empty($company->iso_certificate))
                <!--   <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/iso_certificate/'.$company->iso_certificate)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/iso_certificate/'.$company->iso_certificate)}}" download="{{$company->iso_certificate}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/iso_certificate/'.$company->iso_certificate)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                  <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'iso_certificate', 'img_val'=>'public/uploads/company/'.$company->id.'/iso_certificate/'.$company->iso_certificate]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>DIPP:</strong>
                  @if(!empty($company->dipp))
                 <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/dipp/'.$company->dipp)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/dipp/'.$company->dipp)}}" download="{{$company->dipp}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/dipp/'.$company->dipp)}}" target="_blank
                     ">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                  <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'dipp', 'img_val'=>'public/uploads/company/'.$company->id.'/dipp/'.$company->dipp]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
               <label for="gridPinCode">
                  <strong>Cheque Copy:</strong>
                  @if(!empty($company->cheque_copy))
                 <!--  <img class="" style="height:50px; width:100px" src="{{asset('public/uploads/company/'.$company->id.'/cheque_copy/'.$company->cheque_copy)}}" ><br> -->
                  <a href="{{asset('public/uploads/company/'.$company->id.'/cheque_copy/'.$company->cheque_copy)}}" download="{{$company->cheque_copy}}">
                     <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:128px; margin-top: -21px;">
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
                  <a href="{{asset('public/uploads/company/'.$company->id.'/cheque_copy/'.$company->cheque_copy)}}" target="_blank">
                     <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:239px;">
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
                 <a href="{{ route('companies.show',[$company->id, 'action'=>'delete_img', 'column'=>'cheque_copy', 'img_val'=>'public/uploads/company/'.$company->id.'/cheque_copy/'.$company->cheque_copy]) }}" >
                     <button type="button" class="btn btn-danger gap-2" style="padding: 1px 20px 1px 9px;margin-top:-23px;margin-left:348px;">
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
      </div>
   </div>
</div>

<!-- Company Logs -->

<!--<div x-data="form">
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
      <div class="panel">
         <div class="mb-5 flex" style="text-align: center" >
            <h4 class="text-lg font-semibold dark:text-white-light" style="margin-left: 400px;">Company Logs</h4>
         </div>
         <div class="mb-5">
            <div class="dataTable-container">
               <table id="myTable1" class="whitespace-nowrap dataTable-table">
                  <thead>
                     <tr style="background: radial-gradient(#7fd9a7f7, transparent);">
                        <th>Logs</th>
                        <th>Log Date</th>
                        <th>Comment</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td>02-08-2023</td>
                        <td>First Comment here!!</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>-->
@endsection

@push('script')

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    
<script type="text/javascript"> 
  $(function(){
   $('#alertMessageHide').delay(5000).fadeOut();
  });
</script>

@endpush