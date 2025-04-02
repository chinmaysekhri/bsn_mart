@extends('admin.layouts.app')
@section('title','Edit Customer')
@section('content')

<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('users.index')}}" class="text-primary hover:underline">Customer</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Edit Customer</span>
      </li>
   </ul>
</div>

<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
   <!-- Leads Model Popup Start --> 
   <!-- <div x-data="modal"> -->
   <!-- button -->  
   <!-- 	<div class="mb-5 flex items-center justify-between" >
      <button type="button" class="btn btn-primary" @click="toggle">Bulk Import Leads</button>
      
      <button type="button" class="btn btn-dark"><a href="{{route('export')}}">Export Lead</a>
      </button>
      </div> -->
   <!-- modal -->
   <!-- <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
      <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
      	
      	<div class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8 animate__animated" :class="$store.app.rtlClass === 'rtl' ? 'animate__fadeInLeft' : 'animate__fadeInRight'">
      	
      		<div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
      			<h5 class="font-bold text-lg">Upload Bulk Leads</h5>
      			<button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
      			     <line x1="18" y1="6" x2="6" y2="18"></line>
      			     <line x1="6" y1="6" x2="18" y2="18"></line>
      				</svg>
      			</button>
      		</div>
      		<div class="p-5">
      			<div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
      			
      			<form class="space-y-5" action="{{route('import')}}" method="post" enctype="multipart/form-data">
      			@csrf
      			
      			<div>
      				<label for="groupFname">Select Excel File</label>
      				<input id="groupFname" type="file" name="file"  placeholder="Select Excel File" class="form-input" required/>
      			</div>
      			</div>
      			
      			<div class="flex justify-end items-center mt-8">
      				<button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
      				<button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Save</button>
      			</div>
      			</form>
      		</div>
      	</div>
      </div>
      </div>
      </div> -->	
   <!-- Leads Model Popup End --> 
   <div class="panel">
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
		
		
		{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id],'class'=>'space-y-5', 'enctype'=>'multipart/form-data']) !!}
		 
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
		 
		 {{--  <div>
               <label for="customer_id">Customer Id</label>
               {!! Form::text('customer_id', null, array('placeholder' => 'Customer Id','class' => 'form-input','id'=>'customer_id', 'readonly'=>'')) !!}
		 </div>--}}
            <div>
               <label for="date_of_enrollment">Date Of Enrollment</label>
               {!! Form::date('date_of_enrollment', null, array('placeholder' => 'Date Of Enrollment','class' => 'form-input','id'=>'date_of_enrollment')) !!}
            </div>
			

			
			{{-- <div>
               <label for="total_invested">Total Invested</label>
               {!! Form::text('total_invested', null, array('placeholder' => 'Total Invested','class' => 'form-input','id'=>'total_invested')) !!}
            </div>--}}
			
            <div>
               <label for="first_name">First Name</label>
               {!! Form::text('first_name', null, array('placeholder' => 'Enter First Name','class' => 'form-input','id'=>'first_name')) !!}
            </div>
            <div>
               <label for="last_name">Last Name</label>
               {!! Form::text('last_name', null, array('placeholder' => 'Enter Last Name','class' => 'form-input','id'=>'last_name')) !!}
            </div>
			
			<div>
               <label for="Mobile">Contact</label>
               {!! Form::text('mobile', null, array('placeholder' => 'Enter Mobile No','class' => 'form-input','id'=>'Mobile')) !!}
            </div>
			
            <div>
			<label for="Email">Email:</label>
			{!! Form::text('email', null, array('placeholder' => 'Enter Email','class' => 'form-input','id'=>'Email','required' => 'required')) !!}
			</div>
			
		    <div class="" >
				<label for="managed_by">Managed By</label>					
				<select class="form-input" name="managed_by" id="managed_by" required="" >
			      <option value="">--Select Managed--</option>
			      <option value="{{Auth::user()->id}}" @if($user->managed_by == Auth::user()->id) selected @endif >Self</option>
				    @foreach($employeeData as $emp_row)
					<option value="{{ $emp_row->id }}" @if($user->managed_by == $emp_row->id) selected @endif >{{ $emp_row->first_name.' '.$emp_row->last_name }} ({{$emp_row->email}})</option>
					@endforeach
		       </select>		
		    </div>
			
         
		    <div class="flex justify-around pt-5">
				<label for="name">Gender :</label>
				<label class="inline-flex cursor-pointer">Male</label>
				<input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" @if($user->gender == "Male") checked @endif  value="Male"/>
					
				<label class="inline-flex cursor-pointer">Female</label>
				<input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" @if($user->gender == "Female") checked @endif value="Female"/>
				
		    </div>
		 
            <div>
               <label for="present_address">Present Address</label>
               {!! Form::text('present_address', null, array('placeholder' => 'Present Address','class' => 'form-input','id'=>'present_address')) !!}
            </div>
			
            <div>
               <label for="permanent_address">Permanent Address</label>
               {!! Form::text('permanent_address', null, array('placeholder' => 'Permanent Address','class' => 'form-input','id'=>'permanent_address')) !!}
            </div>
			
			 <div>
               <label for="pan_no">Aadhar No</label>
               {!! Form::text('pan_no', null, array('placeholder' => 'Enter PAN Number','class' => 'form-input','id'=>'pan_no')) !!}
            </div>
			
			<div>
			
               <label for="upload_aadhar_no">Upload Aaadhar No</label>
			   {!! Form::file('upload_aadhar_no', array('placeholder' => 'Selecet Aadhar No','class' => 'form-input','id'=>'upload_aadhar_no')) !!}
			
			   @if(!empty($user->upload_aadhar_no))
			    <a href="{{asset('public/uploads/users/upload_aadhar_no/'.$user->upload_aadhar_no)}}" target="_blank">
				<img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/users/upload_aadhar_no/'.$user->upload_aadhar_no)}}" >
                </a>
			   @endif
            </div>
			
			
		    <div>
               <label for="pan_no">PAN Number</label>
               {!! Form::text('pan_no', null, array('placeholder' => 'Enter PAN Number','class' => 'form-input','id'=>'pan_no')) !!}
            </div>
			
		   <div>
               <label for="upload_pan_no">Upload Pan No</label>
			   
			   
			   {!! Form::file('upload_pan_no', array('placeholder' => 'Selecet Cheque Copy','class' => 'form-input','id'=>'upload_pan_no')) !!}
			
			   @if(!empty($user->upload_pan_no))
			    <a href="{{asset('public/uploads/users/upload_pan_no/'.$user->upload_pan_no)}}" target="_blank">
				<img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/users/upload_pan_no/'.$user->upload_pan_no)}}" >
                </a>
			   @endif
            </div>
			
            <div>
               <label for="gst_no">GST</label>
               {!! Form::text('gst_no', null, array('placeholder' => 'Enter GST','class' => 'form-input','id'=>'gst_no')) !!}
            </div>
			
			<div>
               <label for="upload_gst_no">Upload GST No</label>

			   {!! Form::file('upload_gst_no', array('placeholder' => 'Selecet GST No','class' => 'form-input','id'=>'upload_gst_no')) !!}
			
			   @if(!empty($user->upload_gst_no))
			    <a href="{{asset('public/uploads/users/upload_gst_no/'.$user->upload_gst_no)}}" target="_blank">
				<img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/users/upload_gst_no/'.$user->upload_gst_no)}}" >
                </a>
			   @endif
            </div>
			
			
		    <div>
               <label for="bank_name">Bank Name</label>
			   
               {!! Form::text('bank_name', null, array('placeholder' => 'Enter Bank Name','class' => 'form-input','id'=>'bank_name')) !!}
            </div>
			
			<div>
               <label for="ifsc_code">IFSC Code</label>
			   
               {!! Form::text('ifsc_code' , null, array('placeholder' => 'Enter IFSC Code','class' => 'form-input','id'=>'ifsc_code')) !!}
            </div>
			
			<div>
               <label for="account_no">Bank Account No</label>
			   
               {!! Form::text('account_no', null , array('placeholder' => 'Enter Bank Account No','class' => 'form-input','id'=>'account_no')) !!}
            </div>
			
            <div>
               <label for="cheque_copy">Upload Cheque Copy</label>
			   
			   
			   {!! Form::file('cheque_copy', array('placeholder' => 'Selecet Cheque Copy','class' => 'form-input','id'=>'cheque_copy')) !!}
			
			   @if(!empty($user->cheque_copy))
			    <a href="{{asset('public/uploads/users/cheque/'.$user->cheque_copy)}}" target="_blank">
				<img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/users/cheque/'.$user->cheque_copy)}}" >
                </a>
			   @endif
            </div>
			
			
			<div>
               <label for="contract_img">Upload Contract File</label>
			  
			   {!! Form::file('contract_img', array('placeholder' => 'Selecet Cheque Copy','class' => 'form-input','id'=>'contract_img')) !!}
			
			   @if(!empty($user->contract_img))
			    <a href="{{asset('public/uploads/users/contract_img/'.$user->contract_img)}}" target="_blank">
				<img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/users/contract_img/'.$user->contract_img)}}" >
                </a>
			   @endif
            </div>
			
          
			
			{{--	<div>
					<label for="Role"> Role</label>
					{!! Form::select('roles[]', array_merge([''=>'Select Role'],$roles),[], array('class' => 'form-select text-white-dark','id'=>'Role')) !!}
				
				</div>   --}}
			<div>
				<label for="Status">Status</label>
					
				{!! Form::select('status', array_merge([''=>'Select status'],$status),$user->status, array('class' => 'form-select text-white-dark','id'=>'Status')) !!}
						
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