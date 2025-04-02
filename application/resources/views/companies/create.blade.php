@extends('admin.layouts.app')
@section('title','Add Company')
@section('content')

<div x-data="form">
	<ul class="flex space-x-2 rtl:space-x-reverse">
		<li>
			<a href="{{route('companies.index')}}" class="text-primary hover:underline">Company</a>
		</li>
		<li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
			<span>Add Company</span>
		</li>
	</ul>
	
</div>
					
<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
	
<div class="panel">	
	<div class="mb-5">
			@if (count($errors) > 0)
	        <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
                <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Whoops!</strong>There were some problems with your input.
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
	
	
		
		{!! Form::open(array('route' => 'companies.store','method'=>'POST','class'=>'space-y-5', 'enctype'=>'multipart/form-data')) !!}
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
			
				<div>
					<label for="Name">Date of Incorporation</label>
					
					{!! Form::date('date_of_incorporation', date('Y-m-d'), array('placeholder' => 'Enter Date of Incorporation','class' => 'form-input','id'=>'date_of_incorporation')) !!}
				</div>
				
				<div>
					<label for="Name">Company Name</label>
					
					{!! Form::text('company_name', null, array('placeholder' => 'Enter Company Name','class' => 'form-input','id'=>'company_name')) !!}
				</div>
				
				<div>
					<label for="Mobile"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Mobile No</label>
					{!! Form::text('mobile', null, array('placeholder' => 'Enter Mobile No','class' => 'form-input','id'=>'Mobile')) !!}
				</div>
				
				<div>
					<label for="company_email"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Company Email:</label>
					{!! Form::text('company_email', null, array('placeholder' => 'Enter Company Email','class' => 'form-input','id'=>'company_email')) !!}
				</div>
				
				<div>
					<label for="coi">COI:</label>
					{!! Form::file('coi', array('placeholder' => 'Enter COI','class' => 'form-input','id'=>'coi')) !!}
				</div>
				
				
				<div>
					<label for="mca_llp">MCA LLP:</label>
					{!! Form::file('mca_llp', array('placeholder' => 'Enter Company Email','class' => 'form-input','id'=>'mca_llp')) !!}
				</div>
				
				<div>
					<label for="pan_card">Pan Card:</label>
					{!! Form::file('pan_card', array('placeholder' => 'Enter Pan Card','class' => 'form-input','id'=>'pan_card')) !!}
				</div>
				
				<div>
					<label for="gst_certificate">GST Certificate:</label>
					{!! Form::file('gst_certificate', array('placeholder' => 'Enter GST Certificate','class' => 'form-input','id'=>'gst_certificate')) !!}
				</div>
				
				<div>
					<label for="rent_agrement">Rent Agrement :</label>
					{!! Form::file('rent_agrement', array('placeholder' => 'Enter Rent Agrement ','class' => 'form-input','id'=>'rent_agrement ')) !!}
				</div>
				
				<div>
					<label for="moa">MOA:</label>
					{!! Form::file('moa', array('placeholder' => 'Enter MOA','class' => 'form-input','id'=>'moa')) !!}
				</div>
				
				<div>
					<label for="msme_certificate">MSME Certificate:</label>
					{!! Form::file('msme_certificate', array('placeholder' => 'Enter MSME Certificate','class' => 'form-input','id'=>'msme_certificate')) !!}
				</div>
				
				<div>
					<label for="aoa">AOA:</label>
					{!! Form::file('aoa', array('placeholder' => 'Enter AOA','class' => 'form-input','id'=>'aoa')) !!}
				</div>
				
				<div>
					<label for="tan_no">TAN No:</label>
					{!! Form::file('tan_no', array('placeholder' => 'Enter TAN No','class' => 'form-input','id'=>'tan_no')) !!}
				</div>
				
				<div>
					<label for="pf_no">PF No:</label>
					{!! Form::file('pf_no', array('placeholder' => 'Enter PF No','class' => 'form-input','id'=>'pf_no')) !!}
				</div>
				
				<div>
					<label for="esi_no">ESI No:</label>
					{!! Form::file('esi_no', array('placeholder' => 'Enter ESI No','class' => 'form-input','id'=>'esi_no')) !!}
				</div>
				
				<div>
					<label for="ngo_darpan">NGO Darpan:</label>
					{!! Form::file('ngo_darpan', array('placeholder' => 'Enter NGO Darpan','class' => 'form-input','id'=>'ngo_darpan')) !!}
				</div>
				
				<div>
					<label for="iso_certificate">ISO Certificate:</label>
					{!! Form::file('iso_certificate', array('placeholder' => 'Enter ISO Certificate','class' => 'form-input','id'=>'iso_certificate')) !!}
				</div>
				
				<div>
					<label for="dipp">DIPP:</label>
					{!! Form::file('dipp', array('placeholder' => 'Enter DIPP','class' => 'form-input','id'=>'dipp')) !!}
				</div>
				
				<div>
					<label for="bank_name">Bank Name:</label>
					{!! Form::text('bank_name', null, array('placeholder' => 'Enter Bank Name','class' => 'form-input','id'=>'bank_name')) !!}
				</div>
				
				<div>
					<label for="ifsc_code">IFSC Code:</label>
					{!! Form::text('ifsc_code', null, array('placeholder' => 'Enter ifsc Code','class' => 'form-input','id'=>'ifsc_code')) !!}
				</div>
				
				<div>
					<label for="account_no">Account No:</label>
					{!! Form::text('account_no', null, array('placeholder' => 'Enter Account No','class' => 'form-input','id'=>'account_no')) !!}
				</div>
				
				<div>
					<label for="cheque_copy">Cheque Copy:</label>
					{!! Form::file('cheque_copy', array('placeholder' => 'Enter Cheque Copy','class' => 'form-input','id'=>'cheque_copy')) !!}
					
				</div>
				
				
				<div>
					<label for="account_login_url">Account Login URL:</label>
					{!! Form::text('account_login_url', null, array('placeholder' => 'Enter User Id','class' => 'form-input','id'=>'account_login_url')) !!}
				</div>
				
				<div>
					<label for="user_id">User ID:</label>
					{!! Form::text('user_id', null, array('placeholder' => 'Enter User Id','class' => 'form-input','id'=>'user_id')) !!}
				</div>
				
				<div>
					<label for="company_password">Company Password:</label>
					{!! Form::text('company_password', null, array('placeholder' => 'Enter Company Password','class' => 'form-input','id'=>'company_password')) !!}
				</div>
				
				
			</div>
			
			<button type="submit" class="btn btn-primary !mt-6">Submit</button>
			<!--<div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
			
			<button type="submit" class="btn btn-primary">Submit</button>
			<button type="submit" class="btn btn-danger">Clear</button>
			</div>-->
		{!! Form::close() !!}
	</div>
  </div>
</div>

@endsection

@push('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
function getStateCity(element){
	
	var pincode = element.value;
	
    var token = "{{ csrf_token() }}";
    var url = "{{ route('get_state_city') }}";

	 $.ajax({
		url:url,
		type: 'POST',
		data: { _token :token,pincode:pincode },
		success:function(result){
	
			if(result.state_city_data.length > 0){

				$('#state').html('');
				$('#city').html('');
				
		    $.each(result.state_city_data, function(key, value) {
				
			  $('#state').append('<option value="'+value.state+'">'+value.state+'</option>');
			  
			  $('#city').append('<option value="'+value.post_office+'">'+value.post_office+'</option>');
			  
			}); 

			}

		}
	 });
 
}

<!--Model  Script Start -->
                
document.addEventListener("alpine:init", () => {
	Alpine.data("modal", (initialOpenState = false) => ({
		open: initialOpenState,

		toggle() {
			this.open = !this.open;
		},
	}));
});
                
<!--Model  Script End -->

</script>

@endpush