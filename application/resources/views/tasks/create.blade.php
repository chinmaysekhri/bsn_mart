@extends('admin.layouts.app')
@section('title','Create Task')
@section('content')
<div x-data="form">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
         <a href="{{route('tasks.index')}}" class="text-primary hover:underline">Task Listing</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Add Task</span>
        </li>
    </ul>
</div>

<div class="mb-5 flex items-center justify-between">
   <h5 class="text-lg font-semibold dark:text-white-light"></h5>
</div>

<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1"> 
    <div class="panel">
		<div class="mb-5">
		 {!! Form::open(array('route' => 'tasks.store','method'=>'POST','enctype'=>'multipart/form-data','class'=>'space-y-5')) !!}
         @csrf
			<div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
				<div>
				<label for="task_assign_to">Task Assign To</label>
				
				<select class="form-input" name="task_assign_to" id="task_assign_to" required="">
				   <option value="">Select Task Assign To</option>
					@foreach($employeeData as $emp)
					<option value="{{ $emp->id }}">{{ $emp->first_name.' '.$emp->last_name}} ({{$emp->email}})</option>
					@endforeach
				</select>
				
				</div>

				<div>
				 <label for="taskTiile">Task Title </label>
				 <input id="task_title"  name="task_title"  placeholder="Task Titile" class="form-input" required="" />
				</div>
			  
				<div>
				 <label for="taskDetail">Task Detail</label>
				  <textarea class="form-input" id="task_detail" name="task_detail" rows="2" cols="50" placeholder="Task Details......"  style="height: 100px;" required=""></textarea>
				</div>
		  
			</div>
		    <button type="submit" class="btn btn-primary !mt-6">Submit</button>
           
		    {!! Form::close() !!}
		  
        </div>
    </div>
</div>
@endsection
