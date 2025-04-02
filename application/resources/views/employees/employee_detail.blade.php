@extends('admin.layouts.app')
@section('title','Show Employee Detail')
@section('content')

<div x-data="form">
	<ul class="flex space-x-2 rtl:space-x-reverse">
		<li>
			<a href="{{ route('employees.index') }}" class="text-primary hover:underline">Employee</a>
		</li>
		<li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
			<span>Show Employee</span>
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

		{!! Form::model($emp, ['method' => 'PATCH','route' => ['employees_detail_update', $emp->id],'class'=>'space-y-5','enctype'=>'multipart/form-data']) !!}
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
			
			 <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
			 
				<div class="">
					<label for="emp_id">EMP ID</label>
					
					{!! Form::text('emp_id', 'EMP00'.$emp->id, array('placeholder' => 'EMP ID','class' => 'form-input','id'=>'emp_id', 'readonly'=>'')) !!}
				</div>
				
				<div class="">
					<label for="Name">Date Of Joining</label>
					
					{!! Form::date('date_of_joining', null, array('placeholder' => 'Enter Name','class' => 'form-input','id'=>'Name', 'readonly'=>'')) !!}
				</div>
				
	             <div class="" >
					<label for="managed_by">Managed By</label>					
					<select class="form-input" name="managed_by" id="managed_by" required="" disabled>
					   <option value="">--Select Managed--</option>
					   <option value="{{Auth::user()->id}}" @if($emp->managed_by == Auth::user()->id) selected @endif >Self</option>
						@foreach($employeeData as $emp_row)
						<option value="{{ $emp_row->id }}" @if($emp->managed_by == $emp_row->id) selected @endif >{{ $emp_row->first_name.' '.$emp_row->last_name }}</option>
						@endforeach
				   </select>		
				</div>  
				
				
				
				{{--<div class="" >
					<label for="Designation">Designation</label>
					
					<select class="form-input" name="designation_id" id="designation_id" required>
					<option value="">--Select designation--</option>
					@foreach($designation as $role)
					<option value="{{ $role->name }}">{{ $role->name }}</option>
					@endforeach
					</select>
		
				</div>--}}
				
			 <div class="" >
				<label for="designation">Designation</label>	
				<select class="form-input" name="designation" id="designation" required="" disabled>
					<option value="">--Select designation--</option>
					<option value="Quality Executive" @if($emp->designation == "Quality Executive") selected @endif >Quality Executive</option>
					<option value="Key Account Mannager" @if($emp->designation == "Key Account Mannager") selected @endif >Key Account Mannager</option>
					<option value="Quality Manager" @if($emp->designation == "Quality Manager") selected @endif >Quality Manager</option>
					<option value="Sales Executive" @if($emp->designation == "Sales Executive") selected @endif >Sales Executive</option>
					<option value="HR Manager" @if($emp->designation == "HR Manager") selected @endif >HR Manager</option>
					<option value="Accountant" @if($emp->designation == "Accountant") selected @endif >Accountant</option>
					<option value="Manager" @if($emp->designation == "Manager") selected @endif >Manager</option>
					<option value="HR" @if($emp->designation == "HR") selected @endif >HR</option>
					<option value="Admin" @if($emp->designation == "Admin") selected @endif >Admin</option>
				</select>
				</div>
				
			</div>
			  
			  
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
				<div class="">
					<label for="Name">First Name</label>
					
					{!! Form::text('first_name', null, array('placeholder' => 'Enter Name','class' => 'form-input','id'=>'Name', 'readonly'=>'')) !!}
				</div>
				<div class="" >
					<label for="Name">Last Name</label>
					
					{!! Form::text('last_name', null, array('placeholder' => 'Enter Name','class' => 'form-input','id'=>'Name', 'readonly'=>'')) !!}
				</div>
			  </div>
			  
			  
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
				<div>
					<label for="Mobile">Mobile</label>
					{!! Form::text('mobile', null, array('placeholder' => 'Enter Mobile No','class' => 'form-input','id'=>'Mobile', 'readonly'=>'')) !!}
				</div>
				
				<div>
					<label for="Email">Email:</label>
					{!! Form::text('email', null, array('placeholder' => 'Enter Email','class' => 'form-input','id'=>'Email', 'readonly'=>'')) !!}
				</div>
			  </div>
			  
			  
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
			  
				  <div class="flex justify-around pt-5">
				    <label for="name">Gender :</label>
					<label class="inline-flex cursor-pointer">Male</label>
					<input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" disabled @if($emp->gender == "Male") checked @endif  value="Male"/>
						
					<label class="inline-flex cursor-pointer">Female</label>
					<input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" disabled @if($emp->gender == "Female") checked @endif value="Female"/>
					
				  </div>
				
				<div>
					<label for="ESINo">ESI No</label>
					{!! Form::text('esi_no', null, array('placeholder' => 'Enter ESI No','class' => 'form-input','id'=>'ESINo')) !!}
					
				</div>
			  </div>
			  
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
				<label for="PresentAddress">Present Address</label>
				{!! Form::text('present_address', null, array('placeholder' => 'Enter Present Address','class' => 'form-input','id'=>'PresentAddress')) !!}
			   </div>
			   
			   <div> 
				<label for="PermanentAddress">Permanent Address</label>
				{!! Form::text('permanent_address', null, array('placeholder' => 'Enter Permanent Address','class' => 'form-input','id'=>'PermanentAddress')) !!}
			   </div>
			  </div>
				
			    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
				<div>
					<label for="AadharNo">Aadhar No</label>
					{!! Form::text('aadhar_no', null, array('placeholder' => 'Enter Aadhar No','class' => 'form-input','id'=>'AadharNo')) !!}
					
				</div>
				<div>
                     {!! Form::file('upload_aadhar_no', array('placeholder' => 'Upload Aadhar No','class' => 'form-input','id'=>'upload_aadhar_no')) !!}
			
			         @if(!empty($emp->upload_aadhar_no))
			         <a href="{{asset('public/uploads/employee/'.$emp->id.'/upload_aadhar_no/'.$emp->upload_aadhar_no)}}" target="_blank">
				     <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/upload_aadhar_no/'.$emp->upload_aadhar_no)}}" >
                     </a>
			         @endif
				</div>
				<div>
					<label for="PanNo">PanNo</label>
					{!! Form::text('pan_no', null, array('placeholder' => 'Enter Pan No','class' => 'form-input','id'=>'PanNo')) !!}
					
				</div>
				
				<div>
					{!! Form::file('upload_pan_no', array('placeholder' => 'Upload pan Card','class' => 'form-input','id'=>'upload_pan_no')) !!}
			
			         @if(!empty($emp->upload_pan_no))
			         <a href="{{asset('public/uploads/employee/'.$emp->id.'/upload_pan_no/'.$emp->upload_pan_no)}}" target="_blank">
				     <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/upload_pan_no/'.$emp->upload_pan_no)}}" >
                     </a>
			         @endif
				</div>
			    </div>
				
				<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
				
				<div>
					<label for="Salary">Salary</label>
					{!! Form::text('salary', null, array('placeholder' => 'Enter Salary','class' => 'form-input','id'=>'Salary', 'readonly'=>'')) !!}
					
				</div>
				
				<div>
					<label for="UANNo">UAN No</label>
					{!! Form::text('uan_no', null, array('placeholder' => 'Enter UAN No','class' => 'form-input','id'=>'UANNo')) !!}
					
				</div>
				
				</div>
				
				<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

				<!--  Education Information   -->
				
				<div>
					<label for="Qualification">Select Qualification</label>
					
					{!! Form::select('qualification', array_merge([''=>'Select Qualification'],$qualification),[], array('class' => 'form-select text-white-dark','id'=>'Qualification','onchange'=>'change_qualification()')) !!}
						
				</div>
				
				</div>
				
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-1" id="mytenthDIV" id="myDIV" style="display: none;">	
				
				<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				    <div>
					<hr class="new4"><br>
					<h3> <label><b> 10th Detail </b> </label></h3>
					</div>
				</div>
				
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
				<div id="ten_passing_year">
					<label for="ten_passing_year">Passing Year</label>
					
					{!! Form::number('ten_passing_year', null, array('placeholder' => 'Enter Passing Year','class' => 'form-input')) !!}
				</div>
				
				<div id="ten_mark_percentage">
					<label for="ten_mark_percentage">Marks (%)</label>
					
					{!! Form::text('ten_mark_percentage', null, array('placeholder' => 'Marks (%)','class' => 'form-input')) !!}
				</div>
				
				<div id="ten_board_school">
					<label for="ten_board_school">Board/School</label>
					
					{!! Form::text('ten_board_school', null, array('placeholder' => 'Board/School','class' => 'form-input')) !!}
				</div>
				
				<div id="ten_board_school_document">
					<label for="ten_board_school_document">Attach Board/School Document</label>
					
					{!! Form::file('ten_board_school_document', null, array('placeholder' => 'Attach Board/School Document','class' => 'form-input')) !!}
					
					<a href="{{asset('public/uploads/employee/'.$emp->id.'/ten_board_school_document/'.$emp->ten_board_school_document)}}" target="_blank" >
					
					  <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/ten_board_school_document/'.$emp->ten_board_school_document)}}">
					
					</a>
				</div>
			  </div>
			  
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				    <div>
					<hr class="new2">
					</div>
				</div>
				
			</div>
			
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-1" id="mytwelveDIV" id="myDIV" style="display: none;">	
				<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				    <div>
					<hr class="new4"><br>
					<h3> <label><b> 12th Detail </b> </label></h3>
					</div>
				</div>
				
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
				<div id="twelve_passing_year">
					<label for="twelve_passing_year">Passing Year</label>
					
					{!! Form::number('twelve_passing_year', null, array('placeholder' => 'Enter Passing Year','class' => 'form-input')) !!}
				</div>
				
				<div id="twelve_mark_percentage">
					<label for="twelve_mark_percentage">Marks (%)</label>
					
					{!! Form::text('twelve_mark_percentage', null, array('placeholder' => 'Marks (%)','class' => 'form-input')) !!}
				</div>
				
				<div id="twelve_board_school">
					<label for="twelve_board_school">Board/School</label>
					
					{!! Form::text('twelve_board_school', null, array('placeholder' => 'Board/School','class' => 'form-input')) !!}
				</div>
				
				<div id="twelve_board_school_document">
					<label for="twelve_board_school_document">Attach Board/School Document</label>
					
					{!! Form::file('twelve_board_school_document', null, array('placeholder' => 'Attach Board/School Document','class' => 'form-input')) !!}
					<a href="{{asset('public/uploads/employee/'.$emp->id.'/twelve_board_school_document/'.$emp->twelve_board_school_document)}}" target="_blank" >
					
					  <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/twelve_board_school_document/'.$emp->twelve_board_school_document)}}">
					
					</a>
					
				</div>
			  </div>
			  
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				    <div>
					<hr class="new2">
					</div>
				</div>
				
			</div>
				
		    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1" id="mygraduateDIV" id="myDIV" style="display: none;">	
				<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				    <div>
					<hr class="new4"><br>
					<h3> <label><b> Graduate Detail </b> </label></h3>
					</div>
				</div>
				
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
				<div id="graduate_passing_year">
					<label for="graduate_passing_year">Passing Year</label>
					
					{!! Form::number('graduate_passing_year', null, array('placeholder' => 'Enter Passing Year','class' => 'form-input')) !!}
				</div>
				
				<div id="graduate_mark_percentage">
					<label for="graduate_mark_percentage">Marks (%)</label>
					
					{!! Form::text('graduate_mark_percentage', null, array('placeholder' => 'Marks (%)','class' => 'form-input')) !!}
				</div>
				
				<div id="graduate_board_school">
					<label for="graduate_board_school">Board/School</label>
					
					{!! Form::text('graduate_board_school', null, array('placeholder' => 'Board/School','class' => 'form-input')) !!}
				</div>
				
				<div id="graduate_board_school_document">
					<label for="graduate_board_school_document">Attach Board/School Document</label>
					
					{!! Form::file('graduate_board_school_document', null, array('placeholder' => 'Attach Board/School Document','class' => 'form-input')) !!}
					
					<a href="{{asset('public/uploads/employee/'.$emp->id.'/graduate_board_school_document/'.$emp->graduate_board_school_document)}}" target="_blank" >
					
					  <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/graduate_board_school_document/'.$emp->graduate_board_school_document)}}">
					
					</a>
				</div>
			  </div>
			  
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				    <div>
					<hr class="new2">
					</div>
				</div>
				
			</div>	
			
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-1" id="mypostgraduateDIV" id="myDIV" style="display: none;">	
				<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				    <div>
					<hr class="new4"><br>
					<h3> <label><b> Post Graduate Detail </b> </label></h3>
					</div>
				</div>
				
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
				<div id="post_graduate_passing_year">
					<label for="post_graduate_passing_year">Passing Year</label>
					
					{!! Form::number('post_graduate_passing_year', null, array('placeholder' => 'Enter Passing Year','class' => 'form-input')) !!}
				</div>
				
				<div id="post_graduate_mark_percentage">
					<label for="post_graduate_mark_percentage">Marks (%)</label>
					
					{!! Form::text('post_graduate_mark_percentage', null, array('placeholder' => 'Marks (%)','class' => 'form-input')) !!}
				</div>
				
				<div id="post_graduate_board_school">
					<label for="post_graduate_board_school">Board/School</label>
					
					{!! Form::text('post_graduate_board_school', null, array('placeholder' => 'Board/School','class' => 'form-input')) !!}
				</div>
				
				<div id="post_graduate_board_school_document">
					<label for="post_graduate_board_school_document">Attach Board/School Document</label>
					
					{!! Form::file('post_graduate_board_school_document', null, array('placeholder' => 'Attach Board/School Document','class' => 'form-input')) !!}
					
					<a href="{{asset('public/uploads/employee/'.$emp->id.'/post_graduate_board_school_document/'.$emp->post_graduate_board_school_document)}}" target="_blank" >
					
					  <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/post_graduate_board_school_document/'.$emp->post_graduate_board_school_document)}}">
					
					</a>
				</div>
			  </div>
			  
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				    <div>
					<hr class="new2">
					</div>
				</div>
				
			</div>	
			
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-1" id="myphdDIV" id="myDIV" style="display: none;">	
				<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				    <div>
					<hr class="new4"><br>
					<h3> <label><b>PHD Detail </b> </label></h3>
					</div>
				</div>
				
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
				<div id="phd_passing_year">
					<label for="phd_passing_year">Passing Year</label>
					
					{!! Form::number('phd_passing_year', null, array('placeholder' => 'Enter Passing Year','class' => 'form-input')) !!}
				</div>
				
				<div id="phd_mark_percentage">
					<label for="phd_mark_percentage">Marks (%)</label>
					
					{!! Form::text('phd_mark_percentage', null, array('placeholder' => 'Marks (%)','class' => 'form-input')) !!}
				</div>
				
				<div id="phd_board_school">
					<label for="phd_board_school">Board/School</label>
					
					{!! Form::text('phd_board_school', null, array('placeholder' => 'Board/School','class' => 'form-input')) !!}
				</div>
				
				<div id="phd_board_school_document">
					<label for="phd_board_school_document">Attach Board/School Document</label>
					
					{!! Form::file('phd_board_school_document', null, array('placeholder' => 'Attach Board/School Document','class' => 'form-input')) !!}
					
					
					<a href="{{asset('public/uploads/employee/'.$emp->id.'/phd_board_school_document/'.$emp->phd_board_school_document)}}" target="_blank" >
					
					  <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/phd_board_school_document/'.$emp->phd_board_school_document)}}">
					
					</a>
				</div>
			  </div>
			  
			  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				    <div>
					<hr class="new2">
					</div>
				</div>
				
			</div>

			
			<!--   Employment Information   -->
			<br>
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				    <div>
					<hr class="new4"><br>
					<h3> <label><b> Employment Information </b> </label></h3>
					</div>
		    </div>
			
			
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
				<div>
					<label for="CompanyName">Company Name</label>
					
					{!! Form::text('company_name', null , array('placeholder' => 'Enter Company Name ','class' => 'form-input','id'=>'CompanyName')) !!}
				</div>
				
				<div>
					<label for="from_company_duration">From Duration</label>
					
					 {!! Form::date('from_company_duration', null,  array('placeholder' => 'From Company Duration','class' => 'form-input','id'=>'from_company_duration')) !!}
					
				</div>
				
				<div>
					<label for="to_company_duration">To Duration</label>
					
					 {!! Form::date('to_company_duration', null,  array('placeholder' => 'To Company Duration','class' => 'form-input','id'=>'to_company_duration')) !!}
					
				</div>
			</div>
			
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
				<div>
					<label for="company_ctc">Company CTC</label>
					
					{!! Form::text('company_ctc', null , array('placeholder' => 'Enter Company CTC  ','class' => 'form-input','id'=>'company_ctc')) !!}
				</div>
				
				<div>
					<label for="company_offer_letter">Upload Offer Letter</label>
					
					 {!! Form::file('company_offer_letter' , array('placeholder' => 'Upload  Company Offer Letter','class' => 'form-input','id'=>'company_offer_letter')) !!}
                     <a href="{{asset('public/uploads/employee/'.$emp->id.'/company_offer_letter/'.$emp->company_offer_letter)}}" target="_blank" >
					
					  <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/company_offer_letter/'.$emp->company_offer_letter)}}">
					
					</a>
					
				</div>
				<div>
					<label for="company_relieving_letter">Upload Relieving Letter</label>
					
					{!! Form::file('company_relieving_letter' , array('placeholder' => 'Upload Company Relieving Letter  ','class' => 'form-input','id'=>'company_relieving_letter')) !!}
					<a href="{{asset('public/uploads/employee/'.$emp->id.'/company_relieving_letter/'.$emp->company_relieving_letter)}}" target="_blank" >
					
					  <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/company_relieving_letter/'.$emp->company_relieving_letter)}}">
					
					</a>
				</div>
			</div>
			<br>
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
				<div>
					<label for="salary_slip_first">Upload Salary Slip First</label>
					
					{!! Form::file('salary_slip_first', array('placeholder' => ' Upload Slary Slip First','class' => 'form-input','id'=>'salary_slip_first')) !!}
					<a href="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_first/'.$emp->salary_slip_first)}}" target="_blank" >
					
					  <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_first/'.$emp->salary_slip_first)}}">
					
					</a>
				</div>
				
				<div>
					<label for="salary_slip_second">Upload Slary Slip Second</label>
					
					{!! Form::file('salary_slip_second', array('placeholder' => ' Upload Slary Slip','class' => 'form-input','id'=>'salary_slip_second')) !!}
					<a href="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_second/'.$emp->salary_slip_second)}}" target="_blank" >
					
					  <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_second/'.$emp->salary_slip_second)}}">
					
					</a>
				</div>
				
				<div>
					<label for="salary_slip_third">Upload Slary Slip Third</label>
					
					{!! Form::file('salary_slip_third' , array('placeholder' => ' Upload Slary Slip','class' => 'form-input','id'=>'salary_slip_third')) !!}
					<a href="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_third/'.$emp->salary_slip_third)}}" target="_blank" >
					
					  <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/salary_slip_third/'.$emp->salary_slip_third)}}">
					
					</a>
				</div>
				
				
			</div>
			
			<!-- Other Documents -->
			
			
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				<div>
				<hr class="new4"><br>
				<h3> <label><b>More Employment</b> </label></h3>
				</div>
		    </div>	
			
	
			
			
	    <!--  Start Multiple Input Button  -->
	
			    <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
				
						  <table class="table table-hover" id="dynamic_field">
						  
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
						  
						  @foreach($other_company_name_arr as $other_company_name_row)
						  
							<tr @if($other_i > 1) id="row{{$other_i}}" @endif>
							
							  <td>
							  <label for="other_company_name">Company Name</label>
							  <input type="text" name="other_company_name[]" placeholder="Name" value="{{$other_company_name_arr[$other_i-1]}}" class="form-input" />
							  </td>
							  
							  <td>
							  <label for="from_duration">From Duration </label>
							  <input type="date" name="other_from_duration[]" placeholder=" From" value="{{$other_from_duration_arr[$other_i-1]}}" class="form-input" />
							  </td>
							  
							  <td>
							  <label for="to_duration">To Duration </label>
							  <input type="date" name="other_to_duration[]" placeholder="To" value="{{$other_to_duration_arr[$other_i-1]}}" class="form-input" />
							  </td>
							  
							 <td>
							  <label for="other_company_ctc">CTC</label>
							  <input type="text" name="other_company_ctc[]" placeholder="CTC" value="{{$other_company_ctc_arr[$other_i-1]}}" class="form-input" />
							  </td> 
							
							  <td>
							  <label for="CompanyName">Upload Offer Letter</label>
							  <input type="file" name="other_offer_letter[]"  class="form-input" />
							  
							   @if(!empty($other_offer_letter_arr[$other_i-1]))
							  	 <a href="{{asset('public/uploads/employee/'.$emp->id.'/other_offer_letter/'.$other_offer_letter_arr[$other_i-1])}}" target="_blank">
					
					            <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/other_offer_letter/'.$other_offer_letter_arr[$other_i-1])}}">
								   
								   </a>
								@endif
								
							  </td>

							  <td>
							  <label for="CompanyName">Upload Relieving Letter</label>
							  <input type="file" name="other_relieving_letter[]" class="form-input" />
							  
							  @if(!empty($other_relieving_letter_arr[$other_i-1]))
							  	<a href="{{asset('public/uploads/employee/'.$emp->id.'/other_relieving_letter/'.$other_relieving_letter_arr[$other_i-1])}}" target="_blank" >
					
					               <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/other_relieving_letter/'.$other_relieving_letter_arr[$other_i-1])}}">
								   
								   </a>								   
								@endif 
								
							  </td>
						  
							  @if($other_i == 1) 
								  
							  <td><button type="button" name="add" id="add" class="btn btn-primary !mt-6" >+</button></td>

                              @else
								  
							  <td><button type="button" name="remove" id="{{$other_i}}" class="btn btn-danger btn_remove">X</button></td>
							  
							  @endif
							  
							  @php
							  
							  $other_i = $other_i+1;
							  @endphp
							  
							  
							</tr>
						  @endforeach
							
						  </table>
						
			    </div>
			
	    <!--  End Multiple Input Button-->
			
			
		<!-- Company Document-->
			
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				<div>
				<hr class="new4"><br>
				<h3> <label><b>Company Document</b> </label></h3>
				</div>
		    </div>
			<br>
			
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				<div>
					<label for="other_company_offer_letter">Upload Offer Letter</label>
					 {!! Form::file('other_company_offer_letter',  array('placeholder' => 'Enter Company AddDocument','class' => 'form-input','id'=>'AddDocument')) !!}
					 
					  @if(!empty($emp->other_company_offer_letter))
						<a href="{{asset('public/uploads/employee/'.$emp->id.'/other_company_offer_letter/'.$emp->other_company_offer_letter)}}" target="_blank" >
			
						   <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/other_company_offer_letter/'.$emp->other_company_offer_letter)}}">
						   
						   </a>
					   @endif
					
				</div>
				
				
				
			</div>	
			<!--    -->
						<!-- Other Documents -->
			
			
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
				<div>
				<hr class="new4"><br>
				<h3> <label><b>Other Document</b> </label></h3>
				</div>
		    </div>	
			
	
			
			
	<!--  Start Other Employment Multiple Input Button  -->
	
			    <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
				
						  <table class="table table-hover" id="employment_field">
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
						  
						  @foreach($other_document_name_arr as $other_document_name_row)
						  
							<tr @if($other_i > 1) id="row{{$other_i}}" @endif>
							
							  <td>
							  <label for="other_document_name">Document Name</label>
							  <input type="text" name="other_document_name[]" placeholder="Name" value="{{$other_document_name_arr[$other_i-1]}}" class="form-input" />
							  </td>
							  
							  <td>
							  <label for="other_upload_document">Upload Document</label>
							  
							  <input type="file" name="other_upload_document[]" class="form-input" />
							  
							  @if(!empty($other_upload_document_arr[$other_i-1]))
							  	<a href="{{asset('public/uploads/employee/'.$emp->id.'/other_upload_document/'.$other_upload_document_arr[$other_i-1])}}" target="_blank" >
					
					               <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/employee/'.$emp->id.'/other_upload_document/'.$other_upload_document_arr[$other_i-1])}}">
								   
								   </a>
							   @endif
							   
							  </td>
						  
							  
			                 @if($other_i == 1) 
								  
							 <td><button type="button" name="add_employment" id="add_employment" class="btn btn-primary !mt-6" style="margin-top: 24px;">+</button></td>

                              @else
								  
							  <td><button type="button" name="remove" id="{{$other_i}}" class="btn btn-danger btn_remove">X</button></td>
							  
							  @endif
							  
							  @php
							  
							  $other_i = $other_i+1;
							  @endphp
							  
							  
							</tr>
						  @endforeach
						  
						  
						  </table>
						
			    </div>
			
	  
			</div>
			
			<br>
			
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
			
             
			
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

<script>

   $('#mytenthDIV').hide();
   $('#mytwelveDIV').hide();
   $('#mygraduateDIV').hide();
   $('#mypostgraduateDIV').hide();
   $('#myphdDIV').hide();
   
   function change_qualification(){
   $('#mytenthDIV').hide();
   $('#mytwelveDIV').hide();
   $('#mygraduateDIV').hide();
   $('#mypostgraduateDIV').hide();
   $('#myphdDIV').hide();
   
   var Qualification = $('#Qualification').val();
   
   if(Qualification=="10th")
   {
      $('#mytenthDIV').show();
      $('#mytwelveDIV').hide();
      $('#mygraduateDIV').hide();
      $('#mypostgraduateDIV').hide();
      $('#myphdDIV').hide();
   }
   if(Qualification=="12th")
   {
      $('#mytenthDIV').show();
      $('#mytwelveDIV').show();
      $('#mygraduateDIV').hide();
      $('#mypostgraduateDIV').hide();
      $('#myphdDIV').hide();
   }
   if(Qualification=="Graduate")
   {
      $('#mygraduateDIV').show();
      $('#mypostgraduateDIV').hide();
      $('#myphdDIV').hide();
      $('#mytenthDIV').show();
      $('#mytwelveDIV').show();
   }
   if(Qualification=="Post Graduate")
   {
      
      $('#mypostgraduateDIV').show();
      $('#mygraduateDIV').show();
      $('#myphdDIV').hide();
      $('#mytenthDIV').show();
      $('#mytwelveDIV').show();
   }
   if(Qualification=="PHD")
   {
      
      $('#mypostgraduateDIV').show();
      $('#mygraduateDIV').show();
      $('#myphdDIV').show();
      $('#mytenthDIV').show();
      $('#mytwelveDIV').show();
   }
   else if(Qualification=="Qualification")
   {
     
   $('#mytenthDIV').hide();
   $('#mytwelveDIV').hide();
   $('#mygraduateDIV').hide();
   $('#mypostgraduateDIV').hide();
   $('#myphdDIV').hide();
   
   }
}
</script>
<script>
   window.onload = function(){
  document.getElementById("myDIV").style.display='none';
   };
</script>

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

@endpush