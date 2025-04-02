@php
 
use App\Helpers\Helper;

use App\Models\ExclusiveProduct;

use App\Models\ProductOrder;

use App\Models\DeliveredProduct;

use Carbon\Carbon;

$auth_user  = Auth::user();
	
$email = $auth_user->email;
  
@endphp

@extends('admin.layouts.app')
@section('title','Product List')
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
       @can('product-create')            
         <a class="badge bg-success" href="{{route('products.create')}}">Add Product</a>
          @endcan
         <a href="{{route('products.index')}}"  class="btn btn-primary" style="margin-left: 775px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

       <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:111px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
      </h5>
    
         
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
          <form method="GET" action="{{route('products.index')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('products.index',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                       

                            <select class="form-input" name="seller_buyer_data" id="seller_id" value="{{Request::input('next_action_to')}}">
                           <option value="">Select Seller Name</option>
                           @foreach($buyerSellerData as $buyerseller)
                            <option value="{{ $buyerseller->id }}" @if(Request::input('seller_buyer_data')  == $buyerseller->id) selected @endif >{{ $buyerseller->first_name.' '.$buyerseller->last_name}}({{ ucwords($buyerseller->for) }})</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                </div>
            
                <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-3">
                
                <div>
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="today_applied_status" id="product_type">
                            <option value="">Select Product Type</option>
                   
                            <option value="Spare Parts" @if(Request::input('today_applied_status') == 'Spare Parts') selected @endif >Spare Parts</option>
                            <option value="Finished Good" @if(Request::input('today_applied_status') == 'Finished Good') selected @endif >Finished Good</option>
                           
                        </select>
                     </div>
                  </div>
                <!-- Search By Product Id 12-03-2025 -->
				      
				   <div class="search-date-group ms-5 d-flex align-items-center">
					
					<input  type="text" class="form-input" name="q" id="search" value="@if(isset($reqData['q'])) {{$reqData['q'] }} @endif" placeholder="Search By Product Id..">
					
				   </div>
				 
			   <!-- Search By Product Id 12-03-2025 --> 
                  
                  
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
                     <th>S No.</th>
                     <th>Product ID</th>
                     <th>Product Name</th>
                     <th>Model Number</th>
                     <th>Brand Name</th>
                     <th>Launch Date</th>
                     <th>Product Type</th>
                     <th>Product Used In</th>
                     <th>Price</th>
                     <th>Product Status</th>
                      @if($auth_user->for=='super_admin')
						 <th>Exclusive Product</th>
					  @endif 
					  
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
			   
			   @php $sn=1; @endphp
			  
			   @foreach($data as $product)
                  <tr>
                     <th>{{$sn++}}</th> 
					 <td>BSNPID000{{$product->id}}</td>
                     <td>{{ucwords($product->product_name)}}</td>
                     <td>{{$product->model_number}}</td>
                     <td>{{ucwords($product->brand_name)}}</td>
                     <td>{{$product->launch_date }}</td>
                     <td>{{ucwords($product->product_type)}}</td>
                     <td>{{ucwords($product->used_in)}}</td>
                     <td>{{$product->price}}</td>
                     <td>{{$product->product_status}}</td>
                     
                <!-- Execlusive Product User List 21-01-2025 Start -->
					@php

					$exclusiveData = ExclusiveProduct::where('product_id','=',$product->id)->orderBy('id','DESC')->get();
				  
					$i=1;
					
					@endphp

				   @if($auth_user->for=='super_admin')
                    <td>
                        <div x-data="modal" class="">
                           <div class="flex items-center">
						     <a href="#">
                              <button class="badge bg-success inline-flex" href="#" @click="toggle">Execlusive Product List</button>
                              </a>
                           </div>
                           <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                              <div class="flex items-start justify-center min-h-screen px-4">
                                 <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                       <h5 class="text-lg font-bold">Execlusive Product List</h5>
                                       <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                             <line x1="18" y1="6" x2="6" y2="18"></line>
                                             <line x1="6" y1="6" x2="18" y2="18"></line>
                                          </svg>
                                       </button>
                                    </div>
                                    <form action="#" method="POST">
                                       @csrf
                                       <div class="p-5">
										 <div class="dataTable-wrapper">
											<table class=" table">
												<div class="d-flex">
													
												</div>
                                          @if(count($exclusiveData) >0)
												<thead>
													<tr>
														<th scope="col">S.No</th>
														<th scope="col">Date</th>
														<th scope="col">S/B Name</th>
														<th scope="col">District</th>
														
													</tr>
												</thead>
												
												<tbody>

                                                @foreach($exclusiveData as $exclusive)
                                                
                                                 @php
				
												 $getUserNameData = Helper::getBuyerSellerData($exclusive->buyer_seller_id);
												 
												 $userName    = $getUserNameData->first_name.' '.$getUserNameData->last_name;
												 
												 @endphp
                                                 
                                                    <tr>
													    <td scope="row">{{$i++}}</td>
														<td>{{$exclusive->created_at->format('d-m-Y')}}</td>
														<td>{{$userName}}</td>
														<td>{{$exclusive->district}}</td>
													</tr>

                                          @endforeach

                                          @else

                                          <h1 style="color:red; text-align:center">No Record Found!!</h1>

                                           @endif
													
												</tbody>
											</table>
										</div>
                                        <!--  <div class="flex justify-end items-center mt-8">
                                             <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                                             <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Save</button>
                                          </div>-->
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                    </td>
                  @endif
                   <!-- Execlusive Product User List 21-01-2025 End -->
				   
				  
                
                    
                     <td>
                        <a class="badge bg-info" href="{{ route('products.show',$product->id) }}">Show</a>
						   @can('product-edit')
                        <a class="badge bg-primary" href="{{ route('products.edit',array_merge([$product->id],$requested_input)) }}">Edit</a>
                       
                        @endcan
						  @can('product-delete')
						 {!! Form::open(['method' => 'DELETE','route' => ['products.destroy', $product->id],'style'=>'display:inline', 'id'=>"form".$product->id]) !!}
                           {!! Form::button('Delete', ['class' => 'badge bg-danger', 'onclick'=>"confirmDelete($product->id)"]) !!}
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
<script> 
   $(function(){
    $('#alertMessageHide').delay(5000).fadeOut();
   });
</script>
<script>
   function confirmDelete( varForm ) {
           var r = confirm("Are you sure want to delete this product entry?");
   
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