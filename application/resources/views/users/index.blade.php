@extends('admin.layouts.app')
@section('title','Customer List')
@section('content')

<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
      @can('user-create')
      <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0">              
         <a class="badge bg-success" href="{{route('users.create')}}">Create New Customer</a>
      </h5>
      @endcan
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <div class="dataTable-top">
            @include('admin.partials.search')
         </div>
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Customer Id</th>
                     <th>Date Of Enrollment</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Mobile No</th>
					 <th>Status</th>
                     <th width="280px">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($data as $key => $user)
                  <tr>
                     <td>{{ ++$i }}</td>
                     <td>FA000{{ $user->id }}</td>
                     <td>{{ $user->date_of_enrollment }}</td>
                     <td>{{ $user->first_name.' '.$user->last_name}}</td>
                     <td>{{ $user->email }}</td>
                     <td>{{ $user->mobile }}</td>
                   
					 @if($user->status==1)
					 <td class="text-success">Active</td>
					 @else 
					 <td class="text-danger">Deactive</td>
				     @endif
					
                     <td>
                        <a class="badge bg-info" href="{{ route('users.show',$user->id) }}">Show</a>
                        @can('user-edit')
                        <a class="badge bg-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                        @endcan
                        @can('user-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline', 'id'=>"form".$user->id]) !!}
                        {!! Form::button('Delete', ['class' => 'badge bg-danger', 'onclick'=>"confirmDelete($user->id)"]) !!}
                        {!! Form::close() !!}
                        @endcan
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
@endpush