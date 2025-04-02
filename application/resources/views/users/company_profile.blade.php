@extends('admin.layouts.app')
@section('title','Company Profile')
@section('content')

<div>
	<ul class="flex space-x-2 rtl:space-x-reverse">
		<li>
			<a href="javascript:;" class="text-primary hover:underline">Company</a>
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
						<i class="fas fa-ad"></i>
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
									src="{{asset('public/uploads/users/profile/profile.png')}}" alt="profile-default-image"
									class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32"
								/>
							</div>
							
				
							
							<div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2">
								<div>
									<label for="name:">Date of Incorporation</label>
									<input id="Incorporation" type="text" name="date_of_incorporation"  value="10-AUG-2023"  class="form-input" readonly="readonly"/>
								</div>
								
								<div>
									<label for="name">Company Name</label>
									<input id="company_name" type="text" name="company_name" value="BSN Employment pvt.ltd"  placeholder="Enter Company Name" class="form-input" readonly="readonly"/>
								</div>
								
								
								<div>
									<label for="name">Contact</label>
									<input id="mobile" name="mobile" value="8383019093"  type="text" placeholder="Enter Mobile No" class="form-input" />
								</div>
								<div>
									<label for="name">Email</label>
									<input id="Email" type="email" name="company_email" value="info@bsnemployment.com" placeholder="Enter Company Email" class="form-input" />
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
								
								<div class="mt-3 sm:col-span-2">
									<button type="submit" class="btn btn-success">Save</button>
									
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
							<form action="" method="post" enctype="multipart/form-data">
					         @csrf
									<div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
										<div>
											<label for="COI">COI</label>
											<input id="COI" name="coi" value="" type="file" placeholder="" class="form-input" />
										</div>
										
										<div>
											<label for="MCA_LLP">MCA LLP Data</label>
											<input id="MCA_LLP" type="file" name="mca_llp" value="" placeholder="" class="form-input" />
										</div>
										
										<div>
											<label for="pan_card">Pan Card</label>
											<input id="pan_card" type="file" name="pan_card" value="" placeholder="Enter Company Pan Card" class="form-input" />
										</div>
										
										<div>
											<label for="gst_certificate">GST Certificate</label>
											<input id="gst_certificate" type="file" name="gst_certificate" value="" placeholder="Enter GST No" class="form-input" />
										</div>
									</div>
									
								<div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
									<div class="mb-5">
										<label for="rent_agrement">Rent Agrement</label>
										<input id="rent_agrement" type="file" name="rent_agrement" value=""  class="form-input" />
									</div>
									
									<div class="mb-5">
										<label for="MOA">MOA</label>
										<input id="MOA" type="file" name="moa" value=""  class="form-input" />
									</div>
									
									<div class="mb-5">
										<label for="msme_certificate">MSME Certificate  </label>
										<input id="msme_certificate" type="file" name="msme_certificate" value=""  class="form-input" />
									</div>
									
									<div class="mb-5">
										<label for="aoa">AOA</label>
										<input id="aoa" type="file" name="aoa" value=""  class="form-input" />
									</div>
									
									<div class="mb-5">
										<label for="tan_no">TAN No</label>
										<input id="tan_no" type="file" name="tan_no" value=""  class="form-input" />
									</div>
									
									<div class="mb-5">
										<label for="pf_no">PF No</label>
										<input id="pf_no" type="file" name="pf_no" value=""  class="form-input" />
									</div>
									
									<div class="mb-5">
										<label for="esi_no">ESI No</label>
										<input id="esi_no" type="file" name="esi_no" value=""  class="form-input" />
									</div>
									<div class="mb-5">
										<label for="ngo_darpan">NGO Darpan</label>
										<input id="ngo_darpan" type="file" name="ngo_darpan" value=""  class="form-input" />
									</div>
						            <div class="mb-5">
										<label for="iso_certificate">ISO Certificate</label>
										<input id="iso_certificate" type="file" name="iso_certificate" value=""  class="form-input" />
									</div>
									
									<div class="mb-5">
										<label for="dipp">DIPP</label>
										<input id="dipp" type="file" name="dipp" value=""  class="form-input" />
									</div>
									</div>
									
									
									<button type="submit" class="btn btn-success">Save</button>
									
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
											<input id="bank_name" name="bank_name" value="" type="text" placeholder="Enter Bank Name" class="form-input" />
										</div>
										<div>
											<label for="ifsc_code">IFSC Code</label>
											<input id="ifsc_code" type="text" name="ifsc_code" value="" placeholder="Enter IFSC Code" class="form-input" />
										</div>
										
										<div>
											<label for="account_no">Account No</label>
											<input id="account_no" type="text" name="account_no" value="" placeholder="Enter Company Account No" class="form-input" />
										</div>
										
										<div>
											<label for="cheque_copy">Upload Cheque Copy</label>
											<input id="cheque_copy" type="file" name="cheque_copy" placeholder="Select Cheque Copy" class="form-input" />
											
											<a href="{{asset('public/uploads/users/cheque')}}/" target="_blank">
											<img src="{{asset('public/uploads/users/cheque')}}/" alt="image"style="width:10rem" /></a> 
											
											
										</div>
										
										<div>
											<label for="account_login_url">Account Login URL</label>
											<input id="account_login_url" type="text" name="account_login_url" value="" placeholder="Login URL" class="form-input" />
										</div>
										
										<div>
											<label for="user_id">User Id</label>
											<input id="user_id" type="text" name="user_id" value="Enter User Id"  class="form-input" />
										</div>
										
										<div>
											<label for="company_password">Password</label>
											<input id="company_password" type="password" name="company_password" value=""  class="form-input" />
										</div>
										
										</div>
								
								
									<button type="submit" class="btn btn-success">Save</button>
									
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