@php 

use App\Helpers\Helper;

@endphp

@extends('admin.layouts.app')
@section('title','Seller Transport Address List')
@section('content')


<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
    
      <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0">  
         @can('sellertransportaddresse-create')            
         <a class="badge bg-success" href="{{route('sellertransportaddresses.create')}}">Create Seller Transport Address</a>
            @endcan
          <a href="{{route('sellertransportaddresses.index')}}"  class="btn btn-primary" style="margin-left: 775px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

       <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:206px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
      </h5>
    
	  
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
       <br>
		 <form method="GET" action="{{route('sellertransportaddresses.index')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                 
                  <div style="margin-top:35px;">
                  <a href="{{route('sellertransportaddresses.index',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
               
                    <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="seller_buyer_data" id="seller_buyer_data" value="{{Request::input('seller_buyer_data')}}">
                           <option value="">Select Seller Name</option>
                           @foreach($buyerSellerData as $buyerseller)
                            <option value="{{ $buyerseller->id }}" @if(Request::input('seller_buyer_data')  == $buyerseller->id) selected @endif >{{ ucwords($buyerseller->first_name.' '.$buyerseller->last_name)}}({{ ucwords($buyerseller->for) }})</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
             
            
                 <div style="margin-top: 36px;">
                     <button type="submit" class="btn btn-outline-success" style="padding-right: 64px;padding-left:64px;" >Submit</button>
                  </div>
                   </div>
                 </div>
                 
        

         </form>
  
		 
		 <!-- Date 20-06-2024 -->
		 
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table" style="margin-top:60px;">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Seller Name</th>
                     <th>Transport Address</th>
                     <th width="280px">Action</th>
                  </tr>
               </thead>
               <tbody>
                   @php
                  $i=1;
                  @endphp
                  @foreach ($data as $key => $seller_transport_address)
				  
				 @php

				  $getSellerName = Helper::getSellerDataByID($seller_transport_address->seller_id);
				 
				  if(!empty($getSellerName)){
						
					$sellerName    = $getSellerName->first_name.' '.$getSellerName->last_name;
					
					}else{
						 
				    $sellerName =  "";
					
					}
				 
				  @endphp
				  
                  <tr>
                     <td>{{ $i++ }}</td>
                     <td>{{ $sellerName }}</td>
                     <td>{{ $seller_transport_address->transport_address}}</td>
                     <td>
                        <a class="badge bg-info" href="{{route('sellertransportaddresses.show',$seller_transport_address->id) }}">Show</a>
                        
                        @can('sellertransportaddresse-edit')
                        <a class="badge bg-primary" href="{{route('sellertransportaddresses.edit',array_merge([$seller_transport_address->id],$requested_input))  }}">Edit</a>
                        @endcan
                        
                        @can('sellertransportaddresse-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['sellertransportaddresses.destroy', $seller_transport_address->id],'style'=>'display:inline', 'id'=>"form".$seller_transport_address->id]) !!}
                        {!! Form::button('Delete', ['class' => 'badge bg-danger', 'onclick'=>"confirmDelete($seller_transport_address->id)"]) !!}
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

 <!-- Date 20-06-2024 -->
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
 
 <!-- Date 20-06-2024 -->

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