@php

use App\Helpers\Helper;
 
@endphp
@extends('admin.layouts.app')
@section('title','Prospective Seller List')
@section('content')
<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
      @can('prospective-seller-create') 
      <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0">              
         <a class="badge bg-success" href="{{route('prospectivesellers.create')}}">Create Prospective Seller</a>
      @endcan
       <a href="{{route('prospectivesellers.index')}}"  class="btn btn-primary" style="margin-left: 775px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

       <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:400px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
    </h5>
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
  
          <form method="GET" action="{{route('prospectivesellers.index')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('prospectivesellers.index',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="today_applied_status" id="status_name">
                           <option value="">Select Status</option>
						   <option value="Fresh" @if(Request::input('today_applied_status') == 'Fresh') selected @endif >Fresh</option>
                           <option value="Pending" @if(Request::input('today_applied_status') == 'Pending') selected @endif >Pending</option>
                           <option value="Interested" @if(Request::input('today_applied_status') == 'Interested') selected @endif >Interested</option>
                           <option value="Not Interested" @if(Request::input('today_applied_status') == 'Not Interested') selected @endif >Not Interested</option>
                           <option value="Onboarded"@if(Request::input('today_applied_status') == 'Onboarded') selected @endif >Onboarded</option>
                           <option value="Not Connected"@if(Request::input('today_applied_status') == 'Not Connected') selected @endif >Not Connected</option>
                           <option value="Docs Pending"@if(Request::input('today_applied_status') == 'Docs PendingDocs Pending') selected @endif >Docs Pending</option>
                           <option value="Meeting Confirmed"@if(Request::input('today_applied_status') == 'Meeting Confirmed') selected @endif >Meeting Confirmed</option>
                        </select>
                     </div>
                  </div>
                </div>
                <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                    <label style="margin-top: 36px;">Updated On:</label>
                    <div style="margin-top:35px;">
                  <a href="{{route('prospectivesellers.index',['today_updated_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;">Today</a></div>
                  <div class="" style="margin-top: 7px;">
                     
                     <input class="search-input form-input" type="date" name="today_updated_from" value="{{Request::input('today_updated_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top: 7px;">
                     
                     <input class="search-input form-input" type="date" name="today_updated_to" value="{{Request::input('today_updated_to')}}" style="margin-top:29px;"/>
                  </div>
                   <div style="margin-top: 31px;">
                     <div class="flex flex-wrap items-center justify-center gap-2" style="margin-left: 76px;">
                        <div class="search-date-group ms-5 d-flex align-items-center">
                           <input  type="text" class="search-input form-input" name="updated_q" value="{{Request::input('updated_q')}}" placeholder="Search Name Email Number....." style="width:191px;margin-right:77px;">
                        </div>
                     </div>
                  </div>
                </div>
                   <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top: 38px;">Next Action Date:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('prospectivesellers.index',['today_next_action'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top: 7px;">
                     
                     <input class="search-input form-input" type="date" name="next_action_from" value="{{Request::input('next_action_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top: 7px;">
                     
                     <input class="search-input form-input" type="date" name="next_action_to" value="{{Request::input('next_action_to')}}" style="margin-top:29px;"/>
                  </div>
               
                 <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="team_member_data" id="team_member_data" value="{{Request::input('next_action_to')}}">
                           <option value="">Select Team Member</option>
                           @foreach($teamData as $emp)
                            <option value="{{ $emp->id }}" @if(Request::input('team_member_data')  == $emp->id) selected @endif >{{ $emp->first_name.' '.$emp->last_name}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                 <div style="margin-left: 453px;">
                     <button type="submit" class="btn btn-outline-success" style="padding-right: 64px;padding-left:64px;" >Submit</button>
                  </div>
                   </div>
                   <hr>
            </div>

         </form>
		 
		 <!-- Assign prospective Seller to employee 10-02-2025 start -->
	  
         <div x-data="modal">
		 
         <!-- button -->  
         <div class="mb-5 flex items-center justify-between" style="margin-left:173px;margin-bottom: -18px;
            margin-top: 8px;">
            <button type="button" class="btn btn-primary" @click="toggle" style="padding: 2px 19px 2px 19px; margin-top: 0px;">Assign To</button>
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
                       
					     <form class="space-y-5" action="{{route('prospective_seller_assign_employee')}}" method="post" enctype="multipart/form-data">
                           @csrf
                           
						   <div>
                              <label for="Select_machine_id">Select Assign To Employee:</label>
                              <select class="form-select text-white-dark" id="Status" name="emp_id">
                                 <option value="">Select Assign To Employee </option>
                                 <!--<option value="{{Auth::user()->id}}">Self</option>-->
                 
                                 @foreach($assignEmployeeData as $employee) 
         
                                  <option value="{{$employee->id}}">{{$employee->first_name.' '.$employee->last_name}} ({{$employee->email}})</option>
        
                                 @endforeach
                              </select>
                           </div>
                           <input type="hidden" name="prospective_seller_data" value="" id="prospective_seller_data">
                           
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
      <!-- Assign prospective Seller to employee 10-02-2025 End -->
		 
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table" style="margin-top:60px;">
               <thead> 
                  <tr>
				     <th scope="col" >
                       <div class="form-check">
                         <input  type="checkbox" onclick="checkBoxHandle();" id="all-checkbox-handle" >
                       </div>
                     </th>
                     <th>S.No</th>
                     <th>Seller Id</th>
                     <th>Next Action Date</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Mobile No</th>
                     <th>Status</th>
                      <th>Assign To</th>
                      <th>Seller Type</th>
                      <th>Comment</th>
                     <th width="280px">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @php
                  $i=1;
                  @endphp
                 @foreach ($prosSellerData as $key => $pros_seller)
                  <tr>
				     <td scope="row">
                        <div class="form-check">
                           <input  type="checkbox"  name="appclient" class="appclient-input" value="{{ $pros_seller->id }}" onclick="getAppclient();">
                        </div>
                     </td>
                     <td>{{ $i++ }}</td>
                     <td>JBNS000{{ $pros_seller->id }}</td>
                     <td>{{ $pros_seller->next_action_date }}</td>
                     <td>{{ $pros_seller->first_name.' '.$pros_seller->last_name}}</td>
                     <td>{{ $pros_seller->email }}</td>
                     <td>{{ $pros_seller->contact }}</td>
                
                      <td>{{ $pros_seller->status_name }}</td>
                       @php 
                     if(!empty($pros_seller->assign_to)){
         
           $getAssignUserName = Helper::getAssignUserNameData($pros_seller->assign_to);
     
           $assignUserName = $getAssignUserName->first_name.' '.$getAssignUserName->last_name; 
            
          }else{
            
           $assignUserName = '';  
          
          }
            @endphp

                      <td>{{ $assignUserName }}</td>
                      
                      <td>{{ $pros_seller->seller_type }}</td>
                      <td>{{ ucwords($pros_seller->comment) }}</td>
                     <td>
                        <a class="badge bg-info" href="{{ route('prospectivesellers.show',$pros_seller->id) }}">Show</a>
                        @can('prospective-seller-edit')
						{{-- <a class="badge bg-primary" href="{{ route('prospectivesellers.edit',$pros_seller->id) }}">Edit</a>--}}
						 <!--29-05-2024 for hold value after serch next action date -->
						<a  class="badge bg-primary" href="{{ route('prospectivesellers.edit',array_merge([$pros_seller->id],$requested_input)) }}">Edit</a>
                       
					   @endcan


                        @can('prospective-seller-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['prospectivesellers.destroy', $pros_seller->id],'style'=>'display:inline', 'id'=>"form".$pros_seller->id]) !!}
                        {!! Form::button('Delete', ['class' => 'badge bg-danger', 'onclick'=>"confirmDelete($pros_seller->id)"]) !!}
                        {!! Form::close() !!}
                        @endcan
                     </td>
                  </tr>
                  @endforeach
                
               </tbody>
            </table>
         </div>
           {{ $prosSellerData->links('admin.partials.pagination')}}
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
   function mystatusFunction() {
     var x = document.getElementById("mystatusDIV");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script>

<!-- checkbox script Start Date:08-02-2025 -->

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
   
   $('#prospective_seller_data').val(checkedVals.join(","));
//alert(checkedVals.join(","));
}

function getAppclient(){
  
    var checkedVals = $('.appclient-input:checkbox:checked').map(function() {
    return this.value;
   }).get();
   
   $('#prospective_seller_data').val(checkedVals.join(","));
}

</script>
  
<!-- Checkbox Script End Date: 08-02-2025 -->
@endpush