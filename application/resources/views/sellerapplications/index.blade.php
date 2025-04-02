@php
use App\Helpers\Helper;
@endphp
@extends('admin.layouts.app')
@section('title','Seller Application List')
@section('content')
<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">
         @if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
      <h5 class="mb-50 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0">
         @can('sellerapplication-create') 
         <a class="badge bg-success" href="{{route('sellerapplications.create')}}" style="padding: 4px 11px 4px 11px;">Create Seller Application</a>
          @endcan
      </h5>
         <!-- Assign Leads for customer -->
      <div x-data="modal">
         <!-- button -->  
         <div class="mb-5 flex items-center justify-between" style="margin-left:173px;margin-bottom: -18px;
            margin-top: 8px;">
            <button type="button" class="btn btn-primary" @click="toggle" style="padding: 2px 19px 2px 19px;">Assign To</button>
         </div>

         <!-- modal -->
         <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
            <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
               <div class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8 animate__animated" :class="$store.app.rtlClass === 'rtl' ? 'animate__fadeInLeft' : 'animate__fadeInRight'">
                  <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                     <h5 class="font-bold text-lg">Assign To Employee</h5>
                     <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                           <line x1="18" y1="6" x2="6" y2="18"></line>
                           <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                     </button>
                  </div>
                  <div class="p-5">
                     <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                        <form class="space-y-5" action="{{route('applicationSeller_assign_employee')}}" method="post" enctype="multipart/form-data">
                       
                           @csrf
                           <div>
                              <label for="Select_machine_id">Select Employee:</label>
                              <select class="form-select text-white-dark" id="Status" name="emp_id">
                                 <option value="">Select Employee </option>
                                 <option value="{{Auth::user()->id}}">Self</option>
                 
                                 @foreach($employeeData as $employee) 
         
                                  <option value="{{$employee->id}}">{{$employee->first_name.' '.$employee->last_name}} ({{$employee->email}})</option>
        
                                 @endforeach
                              </select>
                           </div>
                           <input type="hidden" name="application_seller_data" value="" id="application_seller_data">
                           <!--    <div>
                              <label for="lead_title"> Lead Title:</label>
                              <input id="groupFname"  name="lead_title" value="Fresh Lead" placeholder=" Lead Titile" class="form-input" required/>
                              </div> -->
                     </div>
                     <div class="flex justify-end items-center mt-8">
                     <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                     <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Submit</button>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Assign Leads for customer -->
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <div class="dataTable-top">
            @include('admin.partials.search')
         </div>
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table">
               <thead>
                  <tr>
                     <th scope="col" >
                         <div class="form-check">
                           <input  type="checkbox" onclick="checkBoxHandle();" id="all-checkbox-handle" >
                        </div>
                     </th>
                     <th>S.No</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Mobile</th>
                     <th>Created By</th>
                    
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  
                 @foreach ($data as $key => $sellerapplication)
                  <tr>
                      <td scope="row">
                        <div class="form-check">
                           <input  type="checkbox"  name="appclient" class="appclient-input" value = "{{ $sellerapplication->id }}" onclick="getAppclient();">
                        </div>
                     </td>
                     <td>{{ ++$i }}</td>
                     <td>{{ $sellerapplication->first_name.' '.$sellerapplication->last_name}}</td>
                     <td>{{ $sellerapplication->email }}</td>
                     <td>{{ $sellerapplication->mobile }}</td>
                     <td>
               @if($sellerapplication->web_status =='website')
               
                {{ ucfirst($sellerapplication->web_status) }}
                @else
               {{ Helper::getUserDataByID($sellerapplication->created_by)->first_name.' '.Helper::getUserDataByID($sellerapplication->created_by)->last_name}} 
             
               @endif  
              </td>
                    
                     <td>
                         
                        <a class="badge bg-info" href="{{ route('sellerapplications.show',$sellerapplication->id) }}">Show</a>
                        @can('sellerapplication-edit')
                        <a class="badge bg-primary" href="{{ route('sellerapplications.edit',$sellerapplication->id) }}">Edit</a>
                         @endcan
                         @can('sellerapplication-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['sellerapplications.destroy', $sellerapplication->id],'style'=>'display:inline', 'id'=>"form".$sellerapplication->id]) !!}
                        {!! Form::button('Delete', ['class' => 'badge bg-danger', 'onclick'=>"confirmDelete($sellerapplication->id)"]) !!}
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
<script>
   function checkBoxHandle (){
       var allcheckbox = document.getElementById("all-checkbox-handle");
       if(allcheckbox.checked == true){
       var mycheckbox = document.getElementsByName("checkbox");
   
           for( var i = 0; i< mycheckbox.length; i++){
               mycheckbox[i].checked=true;
           }
       }
       else{
       var mycheckbox = document.getElementsByName("checkbox");
   
           for( var i = 0; i< mycheckbox.length; i++){
               mycheckbox[i].checked=false;
           }
       }
   
   }
   
</script>


 <!-- checkbox script Start Date: 20-04-2024 -->

<script>

function checkBoxHandle (){
    var allcheckbox = document.getElementById("all-checkbox-handle");
    if(allcheckbox.checked == true){
    var mycheckbox = document.getElementsByName("appclient");

        for( var i = 0; i< mycheckbox.length; i++){
            mycheckbox[i].checked=true;
        }
    }
    else{
    var mycheckbox = document.getElementsByName("appclient");

        for( var i = 0; i< mycheckbox.length; i++){
            mycheckbox[i].checked=false;
        }
    }
   
   var checkedVals = $('.appclient-input:checkbox:checked').map(function() {
    return this.value;
   }).get();
   
   $('#application_seller_data').val(checkedVals.join(","));
//alert(checkedVals.join(","));
}

function getAppclient(){
  
    var checkedVals = $('.appclient-input:checkbox:checked').map(function() {
    return this.value;
   }).get();
   
   $('#application_seller_data').val(checkedVals.join(","));
}

</script>
  
<!-- Checkbox Script End Date: 20-04-2024 -->
@endpush