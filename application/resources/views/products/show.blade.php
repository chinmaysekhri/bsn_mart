@php
 
use App\Helpers\Helper;

@endphp

@extends('admin.layouts.app')
@section('title','Show Product Detail')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{ route('products.index') }}" class="text-primary hover:underline">Product</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Product Details</span>
      </li>
   </ul>
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
      <!-- Grid -->
      <div class="panel">
         <!-- Flash  Message  start -->
         <center id="alertMessageHide">@if ($message = Session::get('success'))
            <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
            @endif
         </center>
         <!-- Flash  Message  End  -->
         <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">Show Product Detail</h5>
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
                  <svg> ... </svg>
               </button>
            </div>
            @endif
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
                  <svg> ... </svg>
               </button>
            </div>
            @endif
           
         
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               
                <div>
                  <label for="business_name">
                  <strong>Product ID:</strong>
				  JBNPID{{$product->id}}
                  </label>
               </div> 
			   
			   <div>
                  <label for="business_name">
                  <strong>Created date:</strong>
				  {{$product->created_date}}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              	   
			     @php
				
                 $getSellerData = Helper::getSellerName($product->seller_id);
				 
                 $sellerName    = $getSellerData->first_name.' '.$getSellerData->last_name;
				 
                 @endphp
			   
                 <div>
                  <label for="Enrollment">
                  <strong>Seller Name:</strong>
                   {{$sellerName}}
                  </label>
                 </div>
               
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               
			   <div>

			    @if(!empty($product->other_brand =='Brand'))
                  <label for="First">
                  <strong> Brand Name:</strong>
				  {{$product->brand_name}}
                  </label>
				  @else
				  <label for="First">
                  <strong> Brand Name:</strong>
				  {{$product->other_brand}}
                  </label>
				  @endif
               </div>
			   
                 <div>
                  <label for="Mobile">
                  <strong>Product Name:</strong>
                  {{$product->product_name}}
                  </label>
               </div>
             
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label for="Gender">
                  <strong>Launch Date:</strong>
                  {{$product->launch_date}}
                  </label>
               </div>
			   
			     @php
				
                 $getCategoryName = Helper::getCategoryName($product->category_id);
				 	 
                 $categoryName = $getCategoryName->category_name;
			 
                 @endphp
			   
               <div>
                  <label for="Email">
                  <strong>Category:</strong>
				  @if(!empty($categoryName))
                    {{$categoryName}}
				  @endif
                  </label>
               </div>
            </div>
           
		         @php 
				 
                 $getsubCategoryData = Helper::getSubcategoryName($product->subcat_id);
                 
                 $subCategoryName    = $getsubCategoryData->sub_category_name;
            
                 @endphp

                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      
               <div>
                  <label for="Present">
                   <strong>Product Type:</strong>
                      {{$product->product_type}}
                  </label>
               </div>
               <div>
                  <label for="Present">
                  <strong>Used In:</strong>
                      {{$product->used_in}}
                  </label>
               </div>
            </div>
				 
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
			
               <div>
                  <label for="Present">
                  <strong>Sub Category:</strong>
				 @if(!empty($subCategoryName))
                     {{ $subCategoryName }}
				 @endif
                  </label>
               </div>
               <div>
                  <label for="Present">
                  <strong>Model Number:</strong>
                      {{$product->model_number}}
                  </label>
               </div>
            </div>
			
			
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="GST">
                  <strong>Master Packing:</strong>
                  {{$product->master_packing}}
                  </label>
               </div>
			   
			    <div>
                  <label for="GST">
                  <strong>Price:</strong>
                   {{$product->price}}
                  </label>
               </div>
			  
            </div>
			
			<div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
              <div>
                  <label for="Product">
                  <strong>Product Varient Image:</strong>
				   @php
			   
                    $productImg = json_decode($product->product_image,true);

			         @endphp
						
					@if($productImg !=null)
						
					@foreach ($productImg as $rows)
					
					<a href="{{URL::asset('uploads/product/product_image/')}}/{{$rows}}" target="_blank"><img class= "img-responsive" style=" height:50px;width:80px;margin-top: 20px; display: inline-flex" alt="" src="{{URL::asset('uploads/product/product_image/')}}/{{$rows}}"></a>
					
				
					@endforeach
					
					@endif
                  </label>
               </div>

            </div>
			
			
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
			
			  <div>
                  <label for="Photo">
                  <strong>Product Photo:</strong>
					<a href="{{URL::asset('uploads/product/product_photo/'.$product->product_photo)}}" target="_blank"><img class= "img-responsive" style=" height:50px;width:80px;margin-top: 20px; display: inline-flex" alt="" src="{{URL::asset('uploads/product/product_photo/'.$product->product_photo)}}">
					</a>
                  </label>
               </div>
              
			   <div>
                  <label for="GST">
                  <strong>Product video:</strong>
	                  <video
					  id="my-video"
					  class="video-js"
					  controls
					  preload="auto"
					  width="100"
					  height="100"
					  >
					  <source src="{{ asset('uploads/product/product_video/'.$product->product_video) }}" />
					  <source src="MY_VIDEO.webm" type="video/webm" />
					  </p>
				   </video>
				 
				   
                  </label>
               </div>
              
            </div>
			
           <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label for="Enrollment">
                  <strong>Discount:</strong>
                  {{$product->discount}}
                  </label>
               </div>
               <div>
                  <label for="Enrollment">
                  <strong>Minimum Order Quantity:</strong>
                 {{$product->minimum_order_quantity}}
                  </label>
               </div>
            </div>
			
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label for="Enrollment">
                  <strong>Stock Avilable:</strong>
                   {{$product->stock_available}}
                  </label>
               </div>
               <div>
                  <label for="Enrollment">
                  <strong>Select Black Listed District:</strong>
				  
				   @php
			   
                    $district = json_decode($product->black_listed_district,true);

			         @endphp
						
					@if($district !=null)
						
					@foreach ($district as $black_district)
					
					{{$black_district}}

					
					@endforeach
					
					@endif
				  
                  </label>
               </div>
            </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label for="Enrollment" style="text-align:justify">
                  <strong>Product Tag:</strong>
                  {{$product->product_tag}}
                  </label>
               </div>
               <div>
                  <label for="Enrollment">
                  <strong>Product Disription:</strong>
                 {{$product->product_description}}
                  </label>
               </div>
            </div>
               <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label for="Enrollment">
                  <strong>Product Status:</strong>
                   {{$product->product_status}}
                  </label>
               </div>
               <div>
                  <label for="Enrollment">
                  <strong>Product Size:</strong>
                {{$product->product_size}}
                  </label>
               </div>
            </div>
               <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label for="Enrollment">
                  <strong>Product Guarantee Type:</strong>
                   {{$product->product_guarantee_type}}
                  </label>
               </div>
               <div>
                  <label for="Enrollment">
                  <strong>Warranty Period:</strong>
                 {{$product->warranty_period}}
                  </label>
               </div>
            </div>
             <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label for="Enrollment">
                  <strong>Product Warranty Type:</strong>
                   {{$product->product_warranty_type}}
                  </label>
               </div>
              <!--  <div>
                  <label for="Enrollment">
                  <strong>Warranty Period:</strong>
                <strong>uijhnui</strong>
                  </label>
               </div> -->
            </div>
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