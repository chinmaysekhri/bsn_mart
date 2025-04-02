@php

use App\Helpers\Helper;
use App\Models\PurchaseProduct;
use App\Models\DeliveredProduct;
$auth_user  = Auth::user();

@endphp
@extends('admin.layouts.app')
@section('title','Stock Product List')
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
         <a class="badge bg-success" href="{{route('product_list')}}">Stock Product</a>
      </h5>
    
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table" style="margin-top:60px;">
               <thead>
                  <tr>
                     <th>S.No</th> 
                     <th>Product Image</th>
                     <th>Product Id</th>
                     <th>Product Name</th>
                     <th>Total Purchase Qty</th>
                     <th>Total Delivered Qty</th>
                     <th>Total Remaining Qty</th>
                     
                  	 
                  </tr>
               </thead>
               <tbody>
                
                 @php  $i=1; @endphp
				  
                  @foreach($stockProduct as $stock)
				  
				 @php
				
                 $getProductData = Helper::productDetail($stock->product_id);
                 
			     $totalPurchaseProduct  = PurchaseProduct::where('product_id', '=', $stock->product_id)
                                                        ->sum('purchase_product_qty');
						
		         $totalDeliveredProduct = DeliveredProduct::where('product_id', '=', $stock->product_id)
                                                          ->sum('delivered_product_qty');
	  
		         $totalStockProduct     = ($totalPurchaseProduct-$totalDeliveredProduct);
                
				 
                 @endphp
                  <tr>
                     <td>{{ $i++ }}</td>
                     <td>
				         <div class="flex items-center gap-4">
							 <img src="{{asset('public/uploads/product/product_photo/'.$getProductData->product_photo)}}" alt="" class="h-8 w-8 rounded-full" />
							 
						 </div>	
				     </td>
                     <td>{{ $stock->product_id }}</td>
                     <td>{{ $getProductData->product_name }}</td>
                     <td>{{ $totalPurchaseProduct}}</td>
                     <td>{{ $totalDeliveredProduct }}</td>
                     <td>{{ $totalStockProduct }}</td>
					  
                  </tr>
				  
				  @endforeach
                
               </tbody>
            </table>
         </div>
        {{ $stockProduct->links('admin.partials.pagination')}}
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
@endpush