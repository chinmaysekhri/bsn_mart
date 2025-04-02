@extends('admin.layouts.app')
@section('title','Edit Buyer')
@section('content')
@push('head')

<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('buyers.index')}}" class="text-primary hover:underline">Buyer</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Edit Buyer</span>
      </li>
   </ul>
</div>
<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
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
           {!! Form::model($buyer, ['method' => 'PATCH','route' => ['buyers.update', $buyer->id],'class'=>'space-y-5', 'enctype'=>'multipart/form-data']) !!}
      
           <!--11-03-2025 for hold value after search data -->
	  
			@if(!empty($requested_input))

			@foreach($requested_input as $requested_input_key => $requested_input_val)
				<input type="hidden" name="req_{{$requested_input_key}}" value="{{$requested_input_val}}">
			@endforeach
			
			@endif
			
		<!--11-03-2025 for hold value after search data End -->
      
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            {{--  
            <div>
               <label for="buyer_id">Buyer Id</label>
               {!! Form::text('buyer_id', null, array('placeholder' => 'Customer Id','class' => 'form-input','id'=>'buyer_id')) !!}
            </div>
            --}}
            <div>
               <label for="date_of_enrollment"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i> Date Of Enrollment</label>
               {!! Form::date('date_of_enrollment', date('Y-m-d'), array('placeholder' => 'Date Of Enrollment','class' => 'form-input','id'=>'inputdate')) !!}
            </div>

                @php
      
      $cat_data=json_decode($buyer->category_id ,true);
      
        if(empty($cat_data)){
        
        $cat_data=[];
      }
      @endphp
              <div>
               <label for="category ">Category</label>
                 <select class="form-select" id="choices-multiple-remove-button"  placeholder="Select Category" multiple name="category_id[]" />
                    @foreach($categoryData as $category)
                    <option value="{{$category->id}}"  @if(in_array(''.$category->id, $cat_data)) selected @endif >{{$category->category_name}}</option>
                    @endforeach
                    </select>
            </div>
            <div>
               <label for="business_name">Business Name</label>
               {!! Form::text('business_name', null, array('placeholder' => 'Business Name','class' => 'form-input','id'=>'business_name')) !!}
            </div>
            <div>
               <label for="Name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>First Name</label>
               {!! Form::text('first_name', null, array('placeholder' => 'Enter First Name','class' => 'form-input','id'=>'Name')) !!}
            </div>
            <div>
               <label for="last_name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Last Name</label>
               {!! Form::text('last_name', null, array('placeholder' => 'Enter Last Name','class' => 'form-input','id'=>'last_name')) !!}
            </div>
            <div>
               <label for="Mobile"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Contact</label>
               {!! Form::text('mobile', null, array('placeholder' => 'Enter Mobile No','class' => 'form-input','id'=>'Mobile')) !!}
            </div>
            <div>
               <label for="Email"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Email:</label>
               {!! Form::text('email', null, array('placeholder' => 'Enter Email','class' => 'form-input','id'=>'Email','required' => 'required')) !!}
            </div>
			
          <div class="">
               <label for="managed_by"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Managed By</label>             
               <select class="form-select" name="managed_by" id="managed_by">
                       <option value="">--Select Managed--</option>
                       <option value="1">Self</option>
					  <?php /* <option value="{{Auth::user()->id}}" @if($buyer->managed_by == Auth::user()->id) selected @endif >Self</option>*/ ?>
					   
					   @foreach($employeeData as $emp_row)
					   <option value="{{ $emp_row->id }}" @if($buyer->managed_by == $emp_row->id) selected @endif >{{ $emp_row->first_name.' '.$emp_row->last_name }} </option>
					   @endforeach
               </select>   
            </div> 
			
			
            <div class="flex justify-around pt-5">
               <label for="name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Gender :</label>
               <label class="inline-flex cursor-pointer">Male</label>
               <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" value="Male" checked>
               <label class="inline-flex cursor-pointer">Female</label>
               <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" value="Female"/>
            </div>
           <div>
               <label for="present_address">Present Address</label>
               {!! Form::text('present_address', null, array('placeholder' => 'Enter Address','class' => 'form-input','id'=>'present_address')) !!}
            </div>
            <div>
               <label for="pin_code">Pin Code</label>
                {!! Form::number('pin_code', null, array('placeholder' => 'Enter Pin Code','class' => 'form-input','id'=>'pin_code', 'onkeyup'=>'getStateCity(this);', 'maxlength'=>'6')) !!}
            </div>
           <!-- <div>
               <label for="Country">Country</label>
              {!! Form::text('country', null, array('placeholder' => 'Country','class' => 'form-input','id'=>'Country')) !!}
            </div>-->
			
            <div>
               <label for="state">State</label>
               {!! Form::select('state',[$buyer->state=>$buyer->state],[], array('class' => 'form-select text-white-dark','id'=>'state')) !!}
            </div>
			
			<div>
               <label for="name_district ">District </label>
               {!! Form::select('district', [$buyer->district=>$buyer->district],[], array('class' => 'form-select text-white-dark','id'=>'district')) !!}
            </div>
			
            <div>
               <label for="city">City</label>
                {!! Form::select('city', [$buyer->city=>$buyer->city],[], array('class' => 'form-select text-white-dark','id'=>'city')) !!}
            </div>
            
            <div>
               <label for="aadhar_no"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Aadhar No</label>
               {!! Form::text('aadhar_no', null, array('placeholder' => 'Enter Aadhar Number','class' => 'form-input','id'=>'aadhar_no')) !!}
            </div>
            <div>
               <label for="upload_aadhar_no">Upload Aadhar Card</label>
              {!! Form::file('upload_aadhar_no', array('placeholder' => 'Upload Aadhar No','class' => 'form-input','id'=>'upload_aadhar_no')) !!}
              @if(!empty($buyer->upload_aadhar_no))
          <a href="{{asset('public/uploads/buyer/upload_aadhar_no/'.$buyer->upload_aadhar_no)}}" target="_blank">
        <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/buyer/upload_aadhar_no/'.$buyer->upload_aadhar_no)}}" >
                </a>
         @endif
            </div>
			
            <div>
               <label for="pan_no">Pan No</label>
               {!! Form::text('pan_no', null, array('placeholder' => 'Enter Pan No','class' => 'form-input','id'=>'pan_no')) !!}
            </div>
			
            <div>
               <label for="upload_pan_no">Upload Pan Card</label>
               {!! Form::file('upload_pan_no', array('placeholder' => 'Upload Pan No','class' => 'form-input','id'=>'upload_pan_no')) !!}
              @if(!empty($buyer->upload_pan_no))
          <a href="{{asset('public/uploads/buyer/upload_pan_no/'.$buyer->upload_pan_no)}}" target="_blank">
        <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/buyer/upload_pan_no/'.$buyer->upload_pan_no)}}" >
                </a>
         @endif
            </div>
            <div>
               <label for="gst_no">GST</label>
               {!! Form::text('gst_no', null, array('placeholder' => 'Enter GST','class' => 'form-input','id'=>'gst_no')) !!}
            </div>
            <div>
               <label for="upload_gst_no">Upload GST</label>
               {!! Form::file('upload_gst_no', array('placeholder' => 'Upload GST No','class' => 'form-input','id'=>'upload_gst_no')) !!}
              @if(!empty($buyer->upload_gst_no))
          <a href="{{asset('public/uploads/buyer/upload_gst_no/'.$buyer->upload_gst_no)}}" target="_blank">
        <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/buyer/upload_gst_no/'.$buyer->upload_gst_no)}}" >
                </a>
         @endif
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
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
               {!! Form::file('cheque_copy', array('placeholder' => 'Upload Cheque','class' => 'form-input','id'=>'cheque_copy')) !!}
              @if(!empty($buyer->cheque_copy))
          <a href="{{asset('public/uploads/buyer/cheque_copy/'.$buyer->cheque_copy)}}" target="_blank">
        <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/buyer/cheque_copy/'.$buyer->cheque_copy)}}" >
                </a>
         @endif
            </div>
            <div>
               <label for="contract_img">Upload Contract File</label>
             {!! Form::file('contract_img', array('placeholder' => 'Upload Contract','class' => 'form-input','id'=>'contract_img')) !!}
              @if(!empty($buyer->contract_img))
            <a href="{{asset('public/uploads/buyer/contract_img/'.$buyer->contract_img)}}" target="_blank">
            <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/buyer/contract_img/'.$buyer->contract_img)}}" >
                </a>
         @endif
            </div>
			
		   <div>
		   <label for="Status">Status</label>
		 
		   {!! Form::select('status', array_merge([''=>'Select status'],$status),$buyer->status, array('class' => 'form-select text-white-dark','id'=>'Status')) !!}
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

<!-- Multiple dropdown Select and search Start28-11-2023
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script> -->

<script>
   $(document).ready(function(){
      
       var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
          removeItemButton: true,
          maxItemCount:50,
          searchResultLimit:50,
          renderChoiceLimit:50
        }); 
       
       
   });
   
</script>
<!-- search bar and district data -->
<!-- get state district city script-->
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
          $('#district').html('');
          const district = result.state_city_data[0].district;
		 
          $.each(result.state_city_data, function(key, value) {
          
          $('#state').append('<option value="'+value.state+'">'+value.state+'</option>');
          
          $('#city').append('<option value="'+value.post_office+'">'+value.post_office+'</option>');
		  
          }); 
		
         $('#district').append('<option value="'+district+'">'+district+'</option>');
       }
   
      }
     });
    
   }
 
</script>

<script>
   $(function(){
       var dtToday = new Date();
       var month = dtToday.getMonth() + 1;
       var day = dtToday.getDate();
       var year = dtToday.getFullYear();
       if(month < 10)
           month = '0' + month.toString();
       if(day < 10)
           day = '0' + day.toString();
       
       var maxDate = year + '-' + month + '-' + day;
      $('#inputdate').attr('min', maxDate);
   });
</script>
<!-- Date Picker End-->

@endpush