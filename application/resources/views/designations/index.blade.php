@extends('admin.layouts.app')
@section('title',' Designation List')
@section('content')
<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
     @can('designation-create')
      <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0">              
         <a class="badge bg-success" href="{{route('designations.create')}}">Create Designation</a>
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
                     <th>Designation Name</th>
                     <th width="280px">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @php
                  $i=1;
                  @endphp
                   @foreach ($data as $key => $designation)
                  <tr>

                     <td>{{ $i++ }}</td>
                     <td>{{ $designation->designation_name }}</td>
                    
                     <td>
                        <a class="badge bg-info" href="{{ route('designations.show',$designation->id) }}">Show</a>
                         @can('designation-edit') 
                        <a class="badge bg-primary" href="{{route('designations.edit',$designation->id) }}">Edit</a>
                      
                       @endcan
                        @can('designation-delete')
                    
                        {!! Form::open(['method' => 'DELETE','route' => ['designations.destroy', $designation->id],'style'=>'display:inline', 'id'=>"form".$designation->id]) !!}
                           {!! Form::button('Delete', ['class' => 'badge bg-danger', 'onclick'=>"confirmDelete($designation->id)"]) !!}
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