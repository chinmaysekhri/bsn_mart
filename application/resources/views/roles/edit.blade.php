@extends('admin.layouts.app')
@section('title','Edit Role')
@section('content')

<div x-data="form">
	<ul class="flex space-x-2 rtl:space-x-reverse">
		<li>
			<a href="{{ route('roles.index') }}" class="text-primary hover:underline">Roles</a>
		</li>
		<li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
			<span>Edit Role</span>
		</li>
	</ul>
	<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">

		
		<!-- Grid -->
		<div class="panel">
			<div class="mb-5 flex items-center justify-between">
				<h5 class="text-lg font-semibold dark:text-white-light">Edit Role</h5>
			</div>
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
				
				<form class="space-y-5" action="{{route('roles.update', $role->id)}}" method="post">
				@method('PATCH')
				@csrf
					<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
						<div>
							<label for="gridEmail">Name</label>
							<input id="gridEmail" type="text" name="name" value="{{ $role->name }}" placeholder="Enter Name" class="form-input" />
						</div>
						
					</div>
					
					
					<div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-1">
						<div class="md:col-span-2">
							<label for="gridCity">Permission</label>
							
								@foreach($permission as $value)
									<span style="margin:5px; display:inline-flex">
									
									{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-checkbox')) }}
									
									{{ $value->name }}
									
									</span>
							
								@endforeach
						</div>
					</div>
					<button type="submit" class="btn btn-primary !mt-6">Submit</button>
				</form>
			</div>

		</div>

		
	</div>
</div>
                                            
@endsection