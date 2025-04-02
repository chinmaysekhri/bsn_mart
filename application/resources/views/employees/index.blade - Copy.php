@extends('admin.layouts.app')
@section('title','Employee List')
@section('content')

<!--<div x-data="multipleTable">-->
<div x-data="form">
   <div class="panel">
        <!-- Flash  Message  start -->
		<center id="alertMessageHide">@if ($message = Session::get('success'))
		   <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
		   @endif
		</center>
		<!-- Flash  Message  End  -->
		
      <h5 class="mb-50 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0">              
	        @can('employee-create')
            <a class="badge bg-success" href="{{route('employees.create')}}">Create New Employee</a>
		 @endcan
		    <a href="{{route('employees.index')}}"  class="btn btn-primary" style="margin-left: 775px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

       <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:150px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
	

		 
	   </h5>
	   
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns"><br>
	  
    <form method="GET" action="{{route('employees.index')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('employees.index',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                         <select class="form-input" name="team_member_data" id="team_member_data" value="{{Request::input('next_action_to')}}">
                           <option value="">Select Employee Name</option>
                           @foreach($employeeData as $employee)
                            <option value="{{ $employee->id }}" @if(Request::input('team_member_data')  == $employee->id) selected @endif >{{ $employee->first_name.' '.$employee->last_name}}({{ ucwords($employee->for) }})</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                </div>
            
                   <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-3">
                
                <div>
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="today_applied_status" id="employee_status">
                             <option value="">Select Status Type</option>
                             <option value="Active" @if(Request::input('today_applied_status') == 'Active') selected @endif >Active</option>
                             <option value="Deactive" @if(Request::input('today_applied_status') == 'Deactive') selected @endif >Deactive</option>
                        </select>
                     </div>
                  </div>
               
                 <div>
                     <button type="submit" class="btn btn-outline-success" style="padding-right: 64px;padding-left:64px;" >Submit</button>
                  </div>
                   </div>
                 
            </div>

         </form>
  		 

         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table" style="margin-top:60px;">
               <thead>
				  <tr>
					 <th>S.No</th>
					 <th>User Id</th>
					 <th>Emp Id</th>
					 <th>Name</th>
					 <th>Email</th>
					 <th>Mobile No</th>
					 <th>Status</th>
					 <th>Action</th>
				  </tr>
               </thead>
               <tbody>
					
				 @foreach ($data as $key => $user)
					<tr>
						<td>{{ ++$i }}</td>
						<td>FA000{{ $user->id }}</td>
						<td>{{ $user->emp_id }}</td>
						<td>{{ $user->first_name.' '.$user->last_name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->mobile }}</td> 
						@if($user->status==1)
                           <td class="text-success">Active</td>
                           @else 
                           <td class="text-danger">Deactive</td>
                         @endif
					
						<td>
							<a class="badge bg-info" href="{{ route('employees.show',$user->id) }}">Show</a>
							@can('employee-edit')
								<a class="badge bg-primary" href="{{ route('employees.edit',array_merge([$user->id],$requested_input)) }}">Edit</a>
							@endcan
							
							@can('employee-delete')
								{!! Form::open(['method' => 'DELETE','route' => ['employees.destroy', $user->id],'style'=>'display:inline', 'id'=>"form".$user->id]) !!}
									{!! Form::button('Delete', ['class' => 'badge bg-danger', 'onclick'=>"confirmDelete($user->id)"]) !!}
								{!! Form::close() !!}
							@endcan
                 @if(Auth::user()->for=='super_admin')
                        
                        <a  href="{{route('reset_password')}}" class="hover:text-primary">
                                     <i class="fa-solid fa-key"></i>
                                    
            </a>
                        @endif
						</td>
					</tr>
					@endforeach
               </tbody>
            </table>
         </div>
        {{ $data->links('admin.partials.pagination')}}
		 
      </div>
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
<!--Applid On Button hidden and show Script  -->

<script>
   function mystatusFunction() {
     var x = document.getElementById("mystatusDIV");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script>
@endpush