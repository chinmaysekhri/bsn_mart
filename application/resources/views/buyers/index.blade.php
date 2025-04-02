@php
 
use App\Helpers\Helper;

use App\Models\Fund;

use App\Models\Withdrawal;

use App\Models\User;

@endphp

@extends('admin.layouts.app')
@section('title','Buyer List')
@section('content')
<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
   
     
	  
	    <h5 class="mb-50 text-lg font-semibold dark:text-white-light md:absolute md:top-[30px] md:mb-0">              
	        @can('buyer-create')
            <a class="badge bg-success" href="{{route('buyers.create')}}">Create New Buyer</a>
		  @endcan
		    <a href="{{route('buyers.index')}}"  class="btn btn-primary" style="margin-left: 775px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

           <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:150px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
	
	    </h5> 
	  <br>
	  <br>
	  <br>
	  
    
@if(count($data) > 0)
		  
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <?php /*<div class="dataTable-top">
            @include('admin.partials.search')
         </div> */ ?>
		  <form method="GET" action="{{route('buyers.index')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
			
			
			    <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('buyers.index',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="today_applied_status" id="seller_status">
                            <option value="">Select Status Type</option>
                           <option value="Active" @if(Request::input('today_applied_status') == 'Active') selected @endif >Active</option>
                             <option value="Deactive" @if(Request::input('today_applied_status') == 'Deactive') selected @endif >Deactive</option>
                            
                        </select>
                     </div>
                  </div>
                </div>
			
                <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-3">
                
                <div class="flex flex-wrap items-center justify-center gap-2" style="margin-left: 99px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <input  type="text" class="form-input" name="q" id="search" value="@if(isset($reqData['q'])) {{$reqData['q'] }} @endif" placeholder="Search Seller Name,Email,Mobile....." style="width:300px;margin-right:63px;" >
						
                     </div>
                </div>
               
                <div>
                     <button type="submit" class="btn btn-outline-success" style="padding-right: 64px;padding-left:64px;" >Submit</button>
                </div>
				  
                </div>
                 
            </div>

         </form>
		 
		 
          <div class="dataTable-container">

            <table id="myTable1" class="whitespace-nowrap dataTable-table">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Buyer ID</th>
                     <th>Date Of Enrollment</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Mobile No</th>
                     <th>Buyers Wallet Balance</th>
                     <th>Status</th>
                     <th width="280px">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($data as $key => $buyer)

                  @php
				  
                  $sellerBuyerID  = User::where('for','=', 'buyer')->where('buyer_id','=', $buyer->id)->first();
                    
                  if(!empty($sellerBuyerID)){
                  
                   $getSellerNameData = Helper::getWalletData($sellerBuyerID->id);
                  
				  }else{
                   
				   $getSellerNameData = Helper::getWalletData(0);
                  
				  }
                 
				  @endphp

                  <tr>
                      <td>{{ ++$i }}</td>
                     <td>JBNB000{{ $buyer->id }}</td>
                     <td>{{ $buyer->date_of_enrollment }}</td>
                     <td>{{ $buyer->first_name.' '.$buyer->last_name}}</td>
                     <td>{{ $buyer->email }}</td>
                     <td>{{ $buyer->mobile }}</td>
                      <td>{{ $getSellerNameData['total_wallet_amount'] }}</td>
                     @if($buyer->status==1)
                     <td class="text-success">Active</td>
                     @else 
                     <td class="text-danger">Deactive</td>
                     @endif
                     <td>
                        <a class="badge bg-info" href="{{ route('buyers.show',$buyer->id) }}">Show</a>
                        @can('buyer-edit')
                        
                        <!--11-03-2025 for hold value after search next action date -->
						
                        <a class="badge bg-primary" href="{{ route('buyers.edit',array_merge([$buyer->id],$requested_input)) }}">Edit</a>
                        
                        @endcan
                        @can('buyer-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['buyers.destroy', $buyer->id],'style'=>'display:inline', 'id'=>"form".$buyer->id]) !!}
                        {!! Form::button('Delete', ['class' => 'badge bg-danger', 'onclick'=>"confirmDelete($buyer->id)"]) !!}
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
	  @else
		<h1 style="color:red; text-align:center">No Record Found!!</h1>
	  @endif
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
@endpush