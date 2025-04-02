@extends('admin.layouts.app')
@section('title','Edit Employee')
@section('content')

<div x-data="form">
	<ul class="flex space-x-2 rtl:space-x-reverse">
		<li>
			<a href="{{route('employees.index')}}" class="text-primary hover:underline">Employee</a>
		</li>
		<li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
			<span>Edit Employee</span>
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
	
      {!! Form::model($employ, ['method' => 'PATCH','route' => ['employees.update', $employ->id],'class'=>'space-y-5', 'enctype'=>'multipart/form-data']) !!}
			
			
			<!--11-03-2025 for hold value after search data -->
	  
			@if(!empty($requested_input))

			@foreach($requested_input as $requested_input_key => $requested_input_val)
				<input type="hidden" name="req_{{$requested_input_key}}" value="{{$requested_input_val}}">
			@endforeach
			
			@endif
			
			<!--11-03-2025 for hold value after search data End-->
		
		
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
			
			 <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
				<div class="">
					<label for="emp_id">EMP ID</label>
					
					{!! Form::text('emp_id', null, array('placeholder' => 'EMP ID','class' => 'form-input','id'=>'emp_id' ,'readonly'=>'')) !!}
				</div>
				<div class="">
					<label for="Name">Date Of Joining</label>
					
					{!! Form::date('date_of_joining', null, array('placeholder' => 'Enter Name','class' => 'form-input','id'=>'Name', 'readonly'=>'')) !!}
				</div>
				
			    <div class="" >
					<label for="managed_by">Managed By</label>					
					<select class="form-input" name="managed_by" id="managed_by" required="" >
					    <option value="">--Select Managed--</option>
					    <option value="{{Auth::user()->id}}" @if($employ->managed_by == Auth::user()->id) selected @endif >Self</option>
					    <!--<option value="1">Self</option>-->
					
						@foreach($employeeData as $emp_row)
						<option value="{{ $emp_row->id }}" @if($employ->managed_by == $emp_row->id) selected @endif >{{ $emp_row->first_name.' '.$emp_row->last_name }} ({{$emp_row->email}}) </option>
						@endforeach
					
				   </select>		
				</div>
			
			<div class="">
				<label for="designation">Designation</label>	
                <select class="form-input" name="designation" id="designation" required="">
					
					<option value="">--Select Designation--</option>
					
					@foreach($designationData as $designation)
					
					<option value="{{$designation->designation_name}}" @if($employ->designation == $designation->designation_name) selected @endif >{{$designation->designation_name}}</option>
					
					@endforeach
					
				</select>
			</div>
				
			</div>
			  
			  
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
				<div class="">
					<label for="Name">First Name</label>
					
					{!! Form::text('first_name', null, array('placeholder' => 'Enter Name','class' => 'form-input','id'=>'Name')) !!}
				</div>
				<div class="" >
					<label for="Name">Last Name</label>
					
					{!! Form::text('last_name', null, array('placeholder' => 'Enter Name','class' => 'form-input','id'=>'Name')) !!}
				</div>
			  </div>
			  
			  
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
				<div>
					<label for="Mobile">Mobile</label>
					{!! Form::text('mobile', null, array('placeholder' => 'Enter Mobile No','class' => 'form-input','id'=>'Mobile')) !!}
				</div>
				
				<div>
					<label for="Email">Email:</label>
					{!! Form::text('email', null, array('placeholder' => 'Enter Email','class' => 'form-input','id'=>'Email')) !!}
				</div>
				
		     	<div>
					<label for="officialEmail"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Official Email:</label>
					{!! Form::text('official_email', null, array('placeholder' => 'Enter Official Email','class' => 'form-input','id'=>'Email')) !!}
				</div>
				
					
				<div>
					<label for="officialPassword"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Official Email Password:</label>
					{!! Form::text('official_password', null, array('placeholder' => 'Enter Email password','class' => 'form-input','id'=>'Password')) !!}
				</div>
					
				<div>
					<label for="officialContact"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Official Contact:</label>
					{!! Form::text('official_contact', null, array('placeholder' => 'Enter Official Contact','class' => 'form-input','id'=>'Contact')) !!}
				</div>
			  </div>
			  
			  
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
			  
				 <div class="flex justify-around pt-5">
				    <label for="name">Gender :</label>
					<label class="inline-flex cursor-pointer">Male</label>
					<input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" @if($employ->gender == "Male") checked @endif  value="Male"/>
						
					<label class="inline-flex cursor-pointer">Female</label>
					<input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" @if($employ->gender == "Female") checked @endif value="Female"/>
					
				  </div>
			  </div>

		<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
				
			<div>
               <label for="present_address"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Present Address</label>
               {!! Form::text('present_address', null, array('placeholder' => 'Enter Present Address','class' => 'form-input','id'=>'present_address')) !!}
            </div>
            <div>
               <label for="pin_code"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Pin Code</label>
               {!! Form::number('pin_code', null, array('placeholder' => 'Enter Pin Code','class' => 'form-input','id'=>'pin_code', 'onkeyup'=>'getStateCity(this);', 'maxlength'=>'6')) !!}
            </div>
            <?php  /*  <div>
               <label for="Country"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Country</label>
               {!! Form::text('country', null, array('placeholder' => 'Country','class' => 'form-input','id'=>'Country')) !!}
            </div>*/ ?>
			
			
			 <div>
               <label for="state">State</label>
               {!! Form::select('state',[$employ->state=>$employ->state],[], array('class' => 'form-select text-white-dark','id'=>'state')) !!}
            </div>
			
			
		    <div>
               <label for="name_district ">District </label>
               {!! Form::select('district', [$employ->district=>$employ->district],[], array('class' => 'form-select text-white-dark','id'=>'district')) !!}
            </div>
			
           
            <div>
               <label for="city">City</label>
                {!! Form::select('city', [$employ->city=>$employ->city],[], array('class' => 'form-select text-white-dark','id'=>'city')) !!}
            </div>
				
				
				<div>
					<label for="Salary">Salary</label>
					{!! Form::text('salary', null, array('placeholder' => 'Enter Salary','class' => 'form-input','id'=>'Salary')) !!}
					
				</div>
				
				<div>
					<label for="UploadResume">Upload Resume</label>
					{!! Form::file('resume', array('placeholder' => 'Selecet Resume','class' => 'form-input','id'=>'UploadResume')) !!}
					
					{{--	 <a href="{{asset('public/uploads/employee/'.$employ->id.'/resume/'.$employ->resume)}}" target="_blank" >
					
					  <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$employ->id.'/resume/'.$employ->resume)}}">
					
					</a> --}}
					   
				</div>
				
		</div>
		
			</div>
		
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
			 	
		     <div>
               <label for="Status">Status</label>
               {!! Form::select('status', array_merge([''=>'Select status'],$status),$employ->status, array('class' => 'form-select text-white-dark','id'=>'Status')) !!}
             </div>
				
			</div>
			
			<button type="submit" class="btn btn-primary !mt-6">Submit</button>
			
		{!! Form::close() !!}
	</div>
  </div>
</div>
@endsection

@push('head')

<style>

/* Dashed red border */
hr.new21 {
  border-top: 1px dashed blue;
  margin-top: 10px;
}

/* Thick red border */
hr.new41 {
  border: 1px solid blue;
}
</style>

@endpush

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>

 $(document).ready(function(){
   
    var i = 1;
	var length;
	//var addamount = 0;
    var addamount = 700;

  $("#add").click(function(){
   
	 addamount += 700;
	 console.log('amount: ' + addamount);
   i++;
      $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="other_company_name[]" placeholder="Name" class="form-input"/></td><td><input type="date" name="other_from_duration[]" placeholder="Duration" class="form-input"/></td><td><input type="date" name="other_to_duration[]" placeholder="Duration" class="form-input"/></td><td><input type="text" name="other_company_ctc[]" placeholder="CTC" class="form-input"/></td><td><input type="file" name="other_offer_letter[]" class="form-input"/></td><td><input type="file" name="other_relieving_letter[]" class="form-input"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
    });


  $(document).on('click', '.btn_remove', function(){  
	addamount -= 700;
	console.log('amount: ' + addamount);
	
	 <!-- var rowIndex = $('#dynamic_field').find('tr').length;	 -->
	 <!-- addamount -= (700 * rowIndex); -->
	 <!-- console.log(addamount); -->
	 
	  var button_id = $(this).attr("id");     
      $('#row'+button_id+'').remove();  
    });
  });

</script>


<script>

 $(document).ready(function(){
   
    var i = 1;
	var length;
	//var addamount = 0;
    var addamount = 700;

  $("#add_employment").click(function(){
	 addamount += 700;
	 console.log('amount: ' + addamount);
   i++;
      $('#employment_field').append('<tr id="row'+i+'"><td><input type="text" name="other_document_name[]" placeholder="Enter Document Name" class="form-input"/></td><td><input type="file" name="other_upload_document[]" placeholder="Duration" class="form-input"/><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
    });


  $(document).on('click', '.btn_remove', function(){  
	addamount -= 700;
	console.log('amount: ' + addamount);
	
	 <!-- var rowIndex = $('#dynamic_field').find('tr').length;	 -->
	 <!-- addamount -= (700 * rowIndex); -->
	 <!-- console.log(addamount); -->
	 
	  var button_id = $(this).attr("id");     
      $('#row'+button_id+'').remove();  
    });
  });

</script>

<script>

function getSchoolData(element){
	
	var qualification = element.value;
	  	  
	if(qualification == ''){
	  document.getElementById('tenth').style.display = 'none';
	  document.getElementById('twelve').style.display = 'none';
	  document.getElementById('graduate').style.display = 'none';
	  document.getElementById('post_graduate').style.display = 'none';
	  document.getElementById('phd').style.display = 'none';
	}
	
	if(qualification == '10th'){
		document.getElementById('tenth').style.display = 'block';
	}
	
	if(qualification == '12th'){
		document.getElementById('twelve').style.display = 'block';
	}
	
	if(qualification == 'Graduate'){
		document.getElementById('graduate').style.display = 'block';
	}
	
	if(qualification == 'Post Graduate'){
		document.getElementById('post_graduate').style.display = 'block';
	}
	
	if(qualification == 'PHD'){
		document.getElementById('phd').style.display = 'block';
	}

}

</script>

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

@endpush