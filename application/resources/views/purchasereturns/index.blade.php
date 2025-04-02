@php
 
use App\Helpers\Helper;

@endphp

@extends('admin.layouts.app')
@section('title','Purchas Return List')
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
         <a class="badge bg-success" href="{{route('purchasereturns.create')}}">Add Purchase Return</a>
          <a href="{{route('purchasereturns.index')}}"  class="btn btn-primary" style="margin-left:955px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

       <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:150px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
      </h5>
   
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
          <div class="">
            <form method="GET" action="{{route('purchasereturns.index')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('purchasereturns.index',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
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
			  
			     @foreach($data as $prchase_return)
				 
                  <tr>
                     <th>{{$i++}}</th>
					 
					 <td>PRETURNID00{{$prchase_return->id }}</td>
					 
					@php
			   
                    $getSellerData = json_decode($prchase_return->seller_id,true);
					
			        @endphp
					 
					
				   
				    @if (is_array($getSellerData) || is_object($getSellerData))
						
					@foreach ($getSellerData as $seller)
					@if($getSellerData !=null) 
					@php
							
					$getSellerNameData = Helper::getSellerName($seller);
							 
					$sellerName        = $getSellerNameData->first_name.' '.$getSellerNameData->last_name;
							 
					@endphp
					 
					 <td>{{ucwords($sellerName)}}</td>
					 
					 @endif
					  
					 @endforeach
					
					
					 @endif
			  
			
			         <td>
                 
			   	     @php
			   
               
                     $getProductName = (json_decode($prchase_return->product_id,true));
					
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
			    
			 
                     <td>{{ ucwords($prchase_return->warehouse_name)}}</td>
                     <td>{{round($prchase_return->purchase_final_total)}}</td>
                     <td>
                        <a class="badge bg-info" href="{{ route('purchasereturns.show',$prchase_return->id) }}">Show</a>
						
						  
                         <a class="badge bg-primary" href="{{route('purchasereturns.edit',array_merge([$prchase_return->id],$requested_input)) }}">Edit</a>
					  
						{!! Form::open(['method' => 'DELETE','route' => ['purchasereturns.destroy', $prchase_return->id],'style'=>'display:inline', 'id'=>"form".$prchase_return->id]) !!}
                           {!! Form::button('Delete', ['class' => 'badge bg-danger', 'onclick'=>"confirmDelete($prchase_return->id)"]) !!}
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