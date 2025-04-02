@php
 use App\Helpers\Helper;
  
  $profile_data = Helper::getProfile();
	 if($profile_data['auth_user']->for == 'company')
		{
			$profile_route = route('company_profile');
			
			if(!empty($profile_data['profile']->profile_img)){
				
				$profile_img = asset('public/uploads/company/'.$profile_data['profile']->id.'/profile_img/'.$profile_data['profile']->profile_img);
			}elseif(empty($profile_data['profile']->profile_img) && empty($profile_data['profile']->gender) ){
				
				$profile_img = asset('public/uploads/users/profile/profile.png');
			}
			
		}
	  
@endphp

@extends('admin.layouts.app')
@section('title',' View Company Profile')
@section('content')

<div>
	<ul class="flex space-x-2 rtl:space-x-reverse">
		<li>
			<a href="{{route('company_profile')}}" class="text-primary hover:underline">Company</a>
		</li>
		<li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
			<span>Company Settings</span>
		</li>
	</ul>
</div>
	<div class="pt-5">
		<div class="mb-5 flex items-center justify-between">
   <h5 class="text-lg font-semibold dark:text-white-light">Settings</h5>
   <button type="submit" class="btn btn-primary"><a href="{{route('edit_company_profile')}}">Edit Company Profile</a></button>
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
						<i class="fa fa-info-circle" aria-hidden="true"></i>
						Basic Company Info
					</a>
				</li>
				<li class="inline-block">
					<a
						href="javascript:;"
						class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
						:class="{'!border-primary text-primary' : tab == 'payment-details'}"
						@click="tab='payment-details'"
					>
						<i class="fa fa-file" aria-hidden="true"></i>
						Company Document
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
						Company Bank Details
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
						<h6 class="mb-5 text-lg font-bold">Company General Information</h6>
						<div class="flex flex-col sm:flex-row">

							<div class="mb-5 w-full sm:w-2/12 ltr:sm:mr-4 rtl:sm:ml-4">
								 <img
									src="{{$profile_img}}" alt="profile-default-image"
									class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32"
								/>
								
							</div>

							
						
								<!-- <div class="mb-5 w-full sm:w-2/12 ltr:sm:mr-4 rtl:sm:ml-4">
								<img
									src="{{asset('public/uploads/users/profile/profile.png')}}" alt="profile-default-image"
									class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32"
								/>
							</div>
							 -->
				
							
							<div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2">
								<div>
									<label for="name:">Date of Incorporation</label>
									<input id="Incorporation" type="text" name="date_of_incorporation"  value="{{$company->date_of_incorporation}}"  class="form-input" readonly="readonly"/>
								</div>
								
								<div>
									<label for="name">Company Name</label>
									<input id="company_name" type="text" name="company_name" value="{{$company->company_name}}"  placeholder="Enter Company Name" class="form-input" readonly="readonly"/>
								</div>
								
								
								<div>
									<label for="name">Contact</label>
									<input id="mobile" name="mobile" value="{{$company->mobile}}"  type="text" placeholder="Enter Mobile No" class="form-input" />
								</div>
								<div>
									<label for="name">Email</label>
									<input id="Email" type="email" name="company_email" value="{{$company->company_email}}" placeholder="Enter Company Email" class="form-input" />
								</div>
								
								<!--<div>
									<label for="name">Prfile Image</label>
									<input id="profile_img" type="file" name="profile_img"
									class="form-input" readonly="readonly"/>
								</div>
								-->
								
								
								
							<!--	<div>
									<label class="inline-flex cursor-pointer">
										<input type="checkbox" class="form-checkbox" />
										<span class="relative text-white-dark checked:bg-none">Make this my default address</span>
									</label>
								</div>-->
								
								<!-- <div class="mt-3 sm:col-span-2">
									<button type="submit" class="btn btn-success">Update</button>
									
								</div> -->
							
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
								<h5 class="mb-4 text-lg font-semibold">Company Document</h5>
								
							</div>
							<div class="mb-5">
							 <form action="#" method="post" enctype="multipart/form-data">
                                   @csrf
									<div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
										<div>
											<label for="COI">COI</label>
											 @if(!empty($company->coi))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/coi/'.$company->coi)}}" download="{{$company->coi}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/coi/'.$company->coi)}}" target="_blank">
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
										
										<div>
											<label for="MCA_LLP">MCA LLP Data</label>
											 @if(!empty($company->mca_llp))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/mca_llp/'.$company->mca_llp)}}" download="{{$company->mca_llp}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/mca_llp/'.$company->mca_llp)}}" target="_blank">
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
										
										<div>
											<label for="pan_card">Pan Card</label>
											 @if(!empty($company->pan_card))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/pan_card/'.$company->pan_card)}}" download="{{$company->pan_card}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/pan_card/'.$company->pan_card)}}" target="_blank">
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
										
										<div>
											<label for="gst_certificate">GST Certificate</label>
											 @if(!empty($company->gst_certificate))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/gst_certificate/'.$company->gst_certificate)}}" download="{{$company->gst_certificate}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/gst_certificate/'.$company->gst_certificate)}}" target="_blank">
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
									
								<div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
									<div class="mb-5">
										<label for="rent_agrement">Rent Agrement</label>
										 @if(!empty($company->rent_agrement))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/rent_agrement/'.$company->rent_agrement)}}" download="{{$company->rent_agrement}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/rent_agrement/'.$company->rent_agrement)}}" target="_blank">
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
									
									<div class="mb-5">
										<label for="MOA">MOA</label>
										 @if(!empty($company->moa))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/moa/'.$company->moa)}}" download="{{$company->moa}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/moa/'.$company->moa)}}" target="_blank">
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
									
									<div class="mb-5">
										<label for="msme_certificate">MSME Certificate  </label>
										 @if(!empty($company->msme_certificate))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/msme_certificate/'.$company->msme_certificate)}}" download="{{$company->msme_certificate}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/msme_certificate/'.$company->msme_certificate)}}" target="_blank">
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
									
									<div class="mb-5">
										<label for="aoa">AOA</label>
										 @if(!empty($company->aoa))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/aoa/'.$company->aoa)}}" download="{{$company->aoa}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/aoa/'.$company->aoa)}}" target="_blank">
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
									
									<div class="mb-5">
										<label for="tan_no">TAN No</label>
										 @if(!empty($company->tan_no))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/tan_no/'.$company->tan_no)}}" download="{{$company->tan_no}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/tan_no/'.$company->tan_no)}}" target="_blank">
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
									
									<div class="mb-5">
										<label for="pf_no">PF No</label>
										 @if(!empty($company->pf_no))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/pf_no/'.$company->pf_no)}}" download="{{$company->pf_no}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/pf_no/'.$company->pf_no)}}" target="_blank">
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
									
									<div class="mb-5">
										<label for="esi_no">ESI No</label>
										 @if(!empty($company->esi_no))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/esi_no/'.$company->esi_no)}}" download="{{$company->esi_no}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/esi_no/'.$company->esi_no)}}" target="_blank">
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
									<div class="mb-5">
										<label for="ngo_darpan">NGO Darpan</label>
										@if(!empty($company->ngo_darpan))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/ngo_darpan/'.$company->ngo_darpan)}}" download="{{$company->ngo_darpan}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/ngo_darpan/'.$company->ngo_darpan)}}" target="_blank">
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
						            <div class="mb-5">
										<label for="iso_certificate">ISO Certificate</label>
										@if(!empty($company->iso_certificate))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/iso_certificate/'.$company->iso_certificate)}}" download="{{$company->iso_certificate}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/iso_certificate/'.$company->iso_certificate)}}" target="_blank">
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
									
									<div class="mb-5">
										<label for="dipp">DIPP</label>
											@if(!empty($company->dipp))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/dipp/'.$company->dipp)}}" download="{{$company->dipp}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/dipp/'.$company->dipp)}}" target="_blank">
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
									
									
									<!-- <button type="submit" class="btn btn-success">Update</button> -->
									
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
							  <form action="" method="post" enctype="multipart/form-data">
					           @csrf
									<div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
										
										<div>
											<label for="bank_name">Bank Name</label>
											<input id="bank_name" name="bank_name" value="{{$company->bank_name}}" type="text" placeholder="Enter Bank Name" class="form-input" />
										</div>
										<div>
											<label for="ifsc_code">IFSC Code</label>
											<input id="ifsc_code" type="text" name="ifsc_code" value="{{$company->ifsc_code}}" placeholder="Enter IFSC Code" class="form-input" />
										</div>
										
										<div>
											<label for="account_no">Account No</label>
											<input id="account_no" type="text" name="account_no" value="{{$company->account_no}}" placeholder="Enter Company Account No" class="form-input" />
										</div>
										
										<div>
											<label for="cheque_copy">Upload Cheque Copy</label>
											@if(!empty($company->cheque_copy))
                           <a href="{{asset('public/uploads/company/'.$company->id.'/cheque_copy/'.$company->cheque_copy)}}" download="{{$company->cheque_copy}}">
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
                           <a href="{{asset('public/uploads/company/'.$company->id.'/cheque_copy/'.$company->cheque_copy)}}" target="_blank">
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
										
										<div>
											<label for="account_login_url">Account Login URL</label>
											<input id="account_login_url" type="text" name="account_login_url" value="{{$company->account_login_url}}" placeholder="Login URL" class="form-input" />
										</div>
										
										<div>
											<label for="user_id">User Id</label>
											<input id="user_id" type="text" name="user_id" value="{{$company->user_id}}"  class="form-input" />
										</div>
										
										<div>
											<label for="company_password">Password</label>
											<input id="company_password" type="text" name="company_password" value="{{$company->company_password}}"  class="form-input" />
										</div>
										
										</div>
								
								
									<!-- <button type="submit" class="btn btn-success">Update</button> -->
									
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