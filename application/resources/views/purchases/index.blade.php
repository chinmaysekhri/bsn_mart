@php
 
use App\Helpers\Helper;

@endphp

@extends('admin.layouts.app')
@section('title','Purchase List')
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
         <a class="badge bg-success" href="{{route('purchases.create')}}">Add Purchase</a>
           <a href="{{route('purchases.index')}}"  class="btn btn-primary" style="margin-left:955px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

       <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:100px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
      </h5>
    
   
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
        <div class="">
            <form method="GET" action="{{route('purchases.index')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('purchases.index',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                          <select class="form-input" name="seller_buyer_data" id="seller_buyer_data" value="{{Request::input('next_action_to')}}">
                           <option value="">Select Seller Name</option>
                           @foreach($buyerSellerData as $buyerseller)
                            <option value="{{ $buyerseller->id }}" @if(Request::input('seller_buyer_data')  == $buyerseller->id) selected @endif >{{ ucwords($buyerseller->first_name.' '.$buyerseller->last_name)}}({{ ucwords($buyerseller->for) }})</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                </div>
            
                  
                
              
               
                 <div>
                     <button type="submit" class="btn btn-outline-success" style="padding-right: 64px;padding-left:64px;margin-left: 451px;" >Submit</button>
                  </div>
                 
                   <hr>
            </div>
        </form>
         </div>
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table" style="margin-top:60px;">
               <thead>
                  <tr>
                     <th>S No.</th>
                     <th>Purchas ID</th>
                     <th>Seller Name</th>
                     <th>Product Name</th>
                     <th>Warehouse Name</th>
                     <th>Total Amount</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                 			   
			     @php $i++; @endphp
			  
			     @foreach($data as $prchase)
				 
				 
				 
				 
				 
                  <tr>
                     <th>{{$i++}}</th>
					 
					 <td>PURCHASEID00{{$prchase->id }}</td>
					 
					 @php
			   
                     $getSellerData = json_decode($prchase->seller_id,true);
					
			         @endphp
					 
					 {{--	 @if($getSellerData !=null) --}}
				   
				    @if (is_array($getSellerData) || is_object($getSellerData))
						
					@foreach ($getSellerData as $seller)
					
					@php
							
					$getSellerNameData = Helper::getSellerName($seller);
					
							 
					$sellerName        = $getSellerNameData->first_name.' '.$getSellerNameData->last_name;
							 
					@endphp
					 
					 <td>{{ucwords($sellerName)}}</td>
					
				
					 @endforeach
					
					 @endif
					 
	                
					<td>
                 
			   	     @php
			   
               
                     $getProductName = (json_decode($prchase->product_id,true));
					
			         @endphp

					  @if($getProductName !=null)
                  
               @foreach ($getProductName as $productname)
               
                @php
                 
                $productData = Helper::productDetail($productname);
               
                $product_name = '';
               
                   if(!empty($productData)){
                   
                    $product_name   .= $productData->product_name;
                    
                   } else{
                      $product_name  .='';
                   }
               
                @endphp 

               {{$product_name.','}}

               
               @endforeach	
			   @endif 	
               </td>
			   
					
					
					
					 
                     <td>{{ ucwords($prchase->warehouse_name)}}</td>
                     <td>{{round($prchase->purchase_final_total)}}</td>
                     <td>
                        <a class="badge bg-info" href="{{ route('purchases.show',$prchase->id) }}">Show</a>
					     {{-- <a class="badge bg-primary" href="{{route('purchase_edit')}}">Edit</a>--}}
						
					      <a class="badge bg-primary" href="{{route('purchases.edit',array_merge([$prchase->id],$requested_input))  }}">Edit</a>
					  
                      
					    <!-- <a class="badge bg-danger" href="#">Delete</a>-->
						
						{!! Form::open(['method' => 'DELETE','route' => ['purchases.destroy', $prchase->id],'style'=>'display:inline', 'id'=>"form".$prchase->id]) !!}
                           {!! Form::button('Delete', ['class' => 'badge bg-danger', 'onclick'=>"confirmDelete($prchase->id)"]) !!}
                        {!! Form::close() !!}
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
<script> 
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