@php
 
use App\Helpers\Helper;

@endphp

@extends('admin.layouts.app')
@section('title','Show Purchase')   
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{ route('purchases.index') }}" class="text-primary hover:underline">Purchase</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Show Details</span>
      </li>
   </ul>
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
      <!-- Grid -->
      <div class="panel">
         <!-- Flash  Message  start -->
         <center id="alertMessageHide">
            @if ($message = Session::get('success'))
            <font style="color: #f5f5f5; background-color: #011d9d; padding: 9px 52px; border-radius: 10px;">{{ $message }}</font>
            @endif
         </center>
         <!-- Flash  Message  End  -->
         <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">Show Purchase Detail</h5>
         </div>
         <div class="mb-5">
            @if (count($errors) > 0)
            <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
               <span class="ltr:pr-2 rtl:pl-2">
                  <strong class="ltr:mr-1 rtl:ml-1">Whoops!</strong>There were some problems with your input.
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </span>
               <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80">
                  <svg>...</svg>
               </button>
            </div>
            @endif
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
			
			
			
			    @php 
				 
                 if(!empty($purchase->created_by)){
					 
                 $getCreatedByName = Helper::getAssignUserNameData($purchase->created_by);
                 
                 $createdByName = $getCreatedByName->first_name.' '.$getCreatedByName->last_name;
				 
                 }else{
					 
			     $createdByName = ''; 
				 
				 }
		      @endphp
			   
               <div>
                  <label for="Address">
                  <strong>Created By :</strong>
				  {{$createdByName}}
                  </label>
               </div>
               <div>
                  <label for="Address">
                  <strong>Created Date :</strong>
                
				{{$purchase->created_at}}
                 
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="UserID">
                  <strong>Date :</strong>
                  {{$purchase->purchase_date}}
                  </label>
               </div>
			   
			   
			   
			   @php
			   
               $getSellerData = json_decode($purchase->seller_id,true);
					
			   @endphp
					 
			   @if($getSellerData !=null)
						
			   @foreach ($getSellerData as $seller)
              
			   @php
							
			   $getSellerNameData = Helper::getSellerName($seller);
							 
			   $sellerName        = $getSellerNameData->first_name.' '.$getSellerNameData->last_name;
							 
			   @endphp
			   
               <div>
                  <label for="business_name">
                  <strong>Seller Name :</strong>
				  
                {{ucwords($sellerName)}}
                  </label>
               </div>
			   
			    @endforeach
					
			    @endif
			   
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="UserID">
                  <strong>Product Id :</strong>
                 PID00{{$purchase->id}}
                  </label>
               </div>
			     <div>
                  <label for="Quantity"></label>
                  <strong>Product Name :</strong>
			   	     @php
			   
               
                     $getProductName = (json_decode($purchase->product_id,true));
					
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

               </div>
			     @endif 
			   
			   
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="brand_name">
                  <strong>Warehouse Name :</strong>
                 {{ucwords($purchase->warehouse_name)}}
                  </label>
               </div>
			   
              <div>
                  <label for="Quantity"></label>
                  <strong>Quantity :</strong>
              @php
            
                    $getQuantity = json_decode($purchase->product_quantity,true);

                  @endphp
                  
               @if($getQuantity !=null)
                  
               @foreach ($getQuantity as $getQuantityRate)
               
               {{$getQuantityRate.','}}

               
               @endforeach
               
               @endif
             
               </div>
			   
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
				    
                  <div>
                  <label for="Quantity"></label>
                  <strong>Rate :</strong>
                @php
            
                    $getRate = (json_decode($purchase->product_price,true));

                  @endphp
                  
               @if($getRate !=null)
                  
               @foreach ($getRate as $getRateName)
               
               {{$getRateName.','}}

               
               @endforeach
               
               @endif
             
               </div>
		
               <div>
                  <label for="contact">
                  <strong>Total Amount : </strong>
                    {{round($purchase->purchase_final_total)}}
                  </label>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection @push('script')
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
   $(function () {
       $("#alertMessageHide").delay(5000).fadeOut();
   });
</script>
@endpush