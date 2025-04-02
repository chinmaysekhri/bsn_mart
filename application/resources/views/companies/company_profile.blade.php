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
@section('title',' Edit Company Profile')
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
					<form class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" action="{{route('update_company_profile', Auth::user()->company_id)}}" method="post" enctype="multipart/form-data">
					@csrf
						<h6 class="mb-5 text-lg font-bold">Company General Information</h6>
						<div class="flex flex-col sm:flex-row">
						
					<div class="mb-5 w-full sm:w-2/12 ltr:sm:mr-4 rtl:sm:ml-4">
								
                       <img src="{{$profile_img}}" alt="profile-default-image"
                       class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32" />
                        
					</div>
							
				
							
							<div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2">
								<div>
									<label for="name:">Date of Incorporation</label>
									<input id="Incorporation" type="text" name="date_of_incorporation"  value="{{$company->date_of_incorporation}}"  class="form-input" />
								</div>
								
								<div>
									<label for="name">Company Name</label>
									<input id="company_name" type="text" name="company_name" value="{{$company->company_name}}"  placeholder="Enter Company Name" class="form-input" />
								</div>
								
								
								<div>
									<label for="name">Contact</label>
									<input id="mobile" name="mobile" value="{{$company->mobile}}"  type="text" placeholder="Enter Mobile No" class="form-input" />
								</div>
								<div>
									<label for="name">Email</label>
									<input id="Email" type="email" name="company_email" value="{{$company->company_email}}" placeholder="Enter Company Email" class="form-input" />
								</div>

								
								<div>
									<label for="name">Profile Image</label>
									<input id="profile_img" type="file" name="profile_img"
									class="form-input" readonly="readonly"/>
								</div>
								
								
								
								
							<!--	<div>
									<label class="inline-flex cursor-pointer">
										<input type="checkbox" class="form-checkbox" />
										<span class="relative text-white-dark checked:bg-none">Make this my default address</span>
									</label>
								</div>-->
								
								<div class="mt-3 sm:col-span-2">
									<button type="submit" class="btn btn-success">Update</button>
									
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
								<h5 class="mb-4 text-lg font-semibold">Company Document</h5>
								
							</div>
							<div class="mb-5">
							<form class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" action="{{route('update_company_profile', Auth::user()->company_id)}}" method="post" enctype="multipart/form-data">
					        @csrf
									<div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
										<div>
											<label for="COI">COI</label>
											<input id="COI" name="coi" value="{{$company->coi}}" type="file" placeholder="" class="form-input" />
											@if(!empty($company->coi))
											<a href="{{asset('public/uploads/company/'.$company->id.'/coi/'.$company->coi)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/coi/'.$company->coi)}}"></a>
                  @endif
										</div>
										
										<div>
											<label for="MCA_LLP">MCA LLP</label>
											<input id="MCA_LLP" type="file" name="mca_llp" value="{{$company->mca_llp}}" placeholder="" class="form-input" />
											@if(!empty($company->mca_llp))
											<a href="{{asset('public/uploads/company/'.$company->id.'/mca_llp/'.$company->mca_llp)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/mca_llp/'.$company->mca_llp)}}">
               
               </a>@endif
										</div>
										
										<div>
											<label for="pan_card">Pan Card</label>
											<input id="pan_card" type="file" name="pan_card" value="{{$company->pan_card}}" placeholder="Enter Company Pan Card" class="form-input" />
											@if(!empty($company->pan_card))
											<a href="{{asset('public/uploads/company/'.$company->id.'/pan_card/'.$company->pan_card)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/pan_card/'.$company->pan_card)}}">
               
               </a>@endif
										</div>
										
										<div>
											<label for="gst_certificate">GST Certificate</label>
											<input id="gst_certificate" type="file" name="gst_certificate" value="{{$company->gst_certificate}}" placeholder="Enter GST No" class="form-input" />
											@if(!empty($company->gst_certificate))
											<a href="{{asset('public/uploads/company/'.$company->id.'/gst_certificate/'.$company->gst_certificate)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/gst_certificate/'.$company->gst_certificate)}}">
               
               </a>@endif
										</div>
									</div>
									
								<div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
									<div class="mb-5">
										<label for="rent_agrement">Rent Agrement</label>
										<input id="rent_agrement" type="file" name="rent_agrement" value="$company->rent_agrement"  class="form-input" />
										@if(!empty($company->rent_agrement))
										<a href="{{asset('public/uploads/company/'.$company->id.'/rent_agrement/'.$company->rent_agrement)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/rent_agrement/'.$company->rent_agrement)}}">
               
               </a>@endif
									</div>
									
									<div class="mb-5">
										<label for="MOA">MOA</label>
										<input id="MOA" type="file" name="moa" value="$company->moa"  class="form-input" />
										@if(!empty($company->moa))
										<a href="{{asset('public/uploads/company/'.$company->id.'/moa/'.$company->moa)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/moa/'.$company->moa)}}">
               
               </a>@endif
									</div>
									
									<div class="mb-5">
										<label for="msme_certificate">MSME Certificate  </label>
										<input id="msme_certificate" type="file" name="msme_certificate" value="{{$company->msme_certificate}}"  class="form-input" />
										@if(!empty($company->msme_certificate))
										<a href="{{asset('public/uploads/company/'.$company->id.'/msme_certificate/'.$company->msme_certificate)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/msme_certificate/'.$company->msme_certificate)}}">
              </a>@endif
									</div>
									
									<div class="mb-5">
										<label for="aoa">AOA</label>
										<input id="aoa" type="file" name="aoa" value="$company->aoa"  class="form-input" />
										@if(!empty($company->aoa))
										<a href="{{asset('public/uploads/company/'.$company->id.'/aoa/'.$company->aoa)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/aoa/'.$company->aoa)}}">
               
               </a>@endif
									</div>
									
									<div class="mb-5">
										<label for="tan_no">TAN No</label>
										<input id="tan_no" type="file" name="tan_no" value="$company->tan_no"  class="form-input" />
										@if(!empty($company->tan_no))
										<a href="{{asset('public/uploads/company/'.$company->id.'/tan_no/'.$company->tan_no)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/tan_no/'.$company->tan_no)}}">
               
               </a>@endif
									</div>
									
									<div class="mb-5">
										<label for="pf_no">PF No</label>
										<input id="pf_no" type="file" name="pf_no" value="$company->pf_no"  class="form-input" />
										@if(!empty($company->pf_no))
										<a href="{{asset('public/uploads/company/'.$company->id.'/pf_no/'.$company->pf_no)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/pf_no/'.$company->pf_no)}}">
               
               </a>@endif
									</div>
									
									<div class="mb-5">
										<label for="esi_no">ESI No</label>
										<input id="esi_no" type="file" name="esi_no" value="$company->esi_no"  class="form-input" />
										@if(!empty($company->esi_no))
										<a href="{{asset('public/uploads/company/'.$company->id.'/esi_no/'.$company->esi_no)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/esi_no/'.$company->esi_no)}}">
               
               </a>@endif
									</div>
									<div class="mb-5">
										<label for="ngo_darpan">NGO Darpan</label>
										<input id="ngo_darpan" type="file" name="ngo_darpan" value="$company->ngo_darpan"  class="form-input" />
										@if(!empty($company->ngo_darpan))
										<a href="{{asset('public/uploads/company/'.$company->id.'/ngo_darpan/'.$company->ngo_darpan)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/ngo_darpan/'.$company->ngo_darpan)}}">
               
               </a>@endif
									</div>
						            <div class="mb-5">
										<label for="iso_certificate">ISO Certificate</label>
										<input id="iso_certificate" type="file" name="iso_certificate" value="$company->iso_certificate"  class="form-input" />
										@if(!empty($company->iso_certificate))
										<a href="{{asset('public/uploads/company/'.$company->id.'/iso_certificate/'.$company->iso_certificate)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/iso_certificate/'.$company->iso_certificate)}}">
               
               </a>@endif
									</div>
									
									<div class="mb-5">
										<label for="dipp">DIPP</label>
										<input id="dipp" type="file" name="dipp" value="$company->dipp"  class="form-input" />
										@if(!empty($company->dipp))

										<a href="{{asset('public/uploads/company/'.$company->id.'/dipp/'.$company->dipp)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/dipp/'.$company->dipp)}}">
               
               </a>@endif
									</div>
									</div>
									
									
									<button type="submit" class="btn btn-success">Update</button>
									
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
							 <form class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" action="{{route('update_company_profile', Auth::user()->company_id)}}" method="post" enctype="multipart/form-data">
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
											<input id="cheque_copy" type="file" name="cheque_copy" placeholder="Select Cheque Copy" class="form-input" />
											<a href="{{asset('public/uploads/company/'.$company->id.'/cheque_copy/'.$company->cheque_copy)}}" target="_blank" >
               
                 <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/company/'.$company->id.'/cheque_copy/'.$company->cheque_copy)}}">
               
               </a> 
											
											
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
								
								
									<button type="submit" class="btn btn-success">Update</button>
									
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