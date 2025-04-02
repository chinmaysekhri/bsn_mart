@extends('admin.layouts.app')
@section('title','Edit Task')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('tasks.index')}}" class="text-primary hover:underline">Task</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Edit Task</span>
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
		  
        {!! Form::model($task, ['method' => 'PATCH','route' => ['tasks.update', $task->id],'class'=>'space-y-5', 'enctype'=>'multipart/form-data']) !!}
         
         @csrf
         
         	<!--11-03-2025 for hold value after search data -->
	  
			@if(!empty($requested_input))

			@foreach($requested_input as $requested_input_key => $requested_input_val)
				<input type="hidden" name="req_{{$requested_input_key}}" value="{{$requested_input_val}}">
			@endforeach
			
			@endif
			
		<!--11-03-2025 for hold value after search data End -->
         
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div>
         <label for="groupFname">Task Assign To</label>
         <select class="form-input" name="task_assign_to" id="task_assign_to" required="" readonly="readonly" />
            <option value="">--Select Task Assign To--</option>
            @foreach($employeeData as $emp)
            <option value="{{ $emp->id }}" @if($task->task_assign_to == $emp->id) selected @endif >{{ $emp->first_name.' '.$emp->last_name }} ({{$emp->email}})</option>
            @endforeach
         </select>
            
       </div>
         <div>
         <label for="groupFname">Task Assign By</label>
         <input id="groupFname"  name="created_by"  placeholder="Task Title" class="form-input" value="{{Auth::user()->first_name.' '.Auth::user()->last_name }}" readonly />
       </div>
     
       <div>
         <label for="groupFname">Task Title</label>
         <input id="groupFname"  name="task_title"  placeholder="Task Title" class="form-input" value="{{$task->task_title}}" readonly/>
       </div>
	   
		<div class="">
			<label for="Name">Select Task Close Date</label>
			
			{!! Form::date('task_close_date',null, array('placeholder' => 'Enter Name','class' => 'form-input','id'=>'Name')) !!}
		</div>
   
       <div>
         <label for="taskDetail">Task Detail</label>
          <textarea class="form-input" id="task_detail" name="task_detail" rows="2" cols="50" placeholder="Task Details......" style="height:100px;" readonly>{{$task->task_detail}}</textarea>
       </div>
        <div>
         <label for="taskDetail">Task Comment</label>
          <textarea class="form-input" id="task_comment" name="task_comment" rows="2" cols="50" placeholder="Task Details......" style="height:100px;">{{$task->task_comment}}</textarea>
       </div>
	   
     <div>
		 <label for="Status">Task Status</label>
			
		 {!! Form::select('status', array_merge([''=>'Select status'],$status),$task->status, array('class' => 'form-select text-white-dark','id'=>'Status')) !!}
				
	  </div>   
	   <!--<div>
         <label for="groupFname">Task Status:</label>
         <select class="form-input" name="status" id="status" required="">
            <option value="">--Select Status--</option>
            <option value="0" @if($task->status == "0") selected @endif >Pending</option>
            <option value="1"  @if($task->status == "1") selected @endif>Close</option>
         </select>
       </div>-->
	  
      </div>
      <button type="submit" class="btn btn-primary !mt-6">Submit</button>
       {!! Form::close() !!}
      </div>
   </div>
</div>
	

@endsection