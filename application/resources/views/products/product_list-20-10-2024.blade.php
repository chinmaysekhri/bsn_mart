@php
 
use App\Helpers\Helper;

@endphp

@extends('admin.layouts.app')
@section('title','Product List')
@section('content')
@push('head')


<!-- for social link -->

      <!--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <style>
            .social-btn-sp #social-links {
                margin: 0 auto;
                max-width: 500px;
            }
            .social-btn-sp #social-links ul li {
                display: inline-block;
            }          
            .social-btn-sp #social-links ul li a {
                padding: 10px;
                border: 1px solid #ccc;
                margin: 1px;
                font-size: 15px;
            }
            table #social-links{
                display: inline-table;
            }
            table #social-links ul li{
                display: inline;
            }
            table #social-links ul li a{
                padding: 5px;
                border: 1px solid #ccc;
                margin: 1px;
                font-size: 15px;
                background: #e3e3ea;
            }
        </style>-->



<!-- for social link End 15-09-2024 -->


<style type="text/css">
   .slide-container {

   width: 600px;
   height: 450px;
   overflow: hidden;
   }
   img {
   width: 20%;
   }
   .image-container {
   display: inline-block;
   width: 3000px;

   position: relative;
   transition: left 1s;
   animation: slide 35s infinite;
   }
   .slider-image {
   float: left;
   }
   .button-container {
   position: relative;
   top: 10px;
   }
   .slider-button {
   height: 10px;
   width: 10px;
   margin: 4px;
   display: inline-block;
   border-radius: 5px;
   background-color: rgba(white, 0.5);
   }
   .slider-button:hover {
   background-color: rgba(white, 0.7);
   }
   #slider1:target ~ .image-container {
   left: 0px;
   }
   #slider2:target ~ .image-container {
   left: -600px;
   }
   #slider3:target ~ .image-container {
   left: -1200px;
   }
   #slider4:target ~ .image-container {
   left: -1800px;
   }
   #slider5:target ~ .image-container {
   left: -2400px;
   }
   .image-container:hover {
   // animation: slide 10s infinite;
   }
   @keyframes slide {
   0% {
   left: 0;
   }
   20% {
   left: -600px;
   }
   40% {
   left: -1200px;
   }
   60% {
   left: -1800px;
   }
   80% {
   left: -2400px;
   }
   100% {
   left: 0;
   }
   }
</style>

<style>
        .cart {
            position: relative;
            display: block;
			float: right;
            width: 28px;
            height: 28px;
            height: auto;
            overflow: hidden;
        }

        .count {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 2;
            font-size: 11px;
            border-radius: 50%;
            background: #d60b28;
            width: 16px;
            height: 16px;
            line-height: 16px;
            display: block;
            text-align: center;
            color: white;
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
        }
		@media only screen and (max-width: 750px) {
			.gap-10 {
			display: block;
			}
			.slide-container {
         width: 350px;
         height: 350px;
         overflow: hidden;
      }

   }
    </style>

@endpush

<div x-data="form">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{route('dashboard')}}" class="text-primary hover:underline">Home</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Product List</span>
        </li>
    </ul>
	
    <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
    <!-- Flash  Message  End  -->
	
</div>


<a href="{{route('cart')}}">
   
	<div class="cart">
        <span class="count">{{ count((array) session('cart')) }}</span>
      
        <i class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-cart-fill" viewBox="0 0 16 16">
                <path
                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
        </i>

    </div>
</a>




<br><br>
<div x-data="form">
   <div class="panel">   
    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
     <div class="dataTable-top">
     <!-- search Bar  -->
      <form method="post" action="">
      @csrf
         <div class="mb-5" >
            <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-3">
			
			   <div style="margin-top: 31px;">
                  <div class="flex flex-wrap items-center justify-center gap-2" style="margin-left: 99px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <input  type="text" class="typeahead form-input" name="q" id="search" value="@if(isset($reqData['q'])) {{$reqData['q'] }} @endif" placeholder="Search Product....." style="width:300px;margin-right:63px;" onchange="getProductSearchData(this);">
						
						{{--	<input class="typeahead form-input"  name="category_name" id="search" type="text"> --}}
                     </div>
                  </div>
               </div>
			
               <div style="margin-top: 31px;">
			   
                  <div class="search-date-group ms-5 d-flex align-items-center">
                     <select  class="form-select text-white-dark"  id="category_name"  name="cat_id" style="width:319px;" onchange="getSubcategoryData(this);">
                         <option value="">Select Category</option>
                         @foreach($categoryData as $category)
                           <option value="{{ $category->id}}" @if(isset($reqData['cat_id']) && $reqData['cat_id']==$category->id) selected @endif>{{ $category->category_name }}</option>
                         @endforeach
                     </select>
                  </div>
               </div>
			   
               <div style="margin-top: 31px;">
                  <div class="search-date-group ms-5 d-flex align-items-center">
                     <select  class="form-select text-white-dark"  id="subcategory_name"  name="subcat_id" style="width:320px;">
                        <option value="">Sub Category</option>
                        @foreach($subCategoryData as $subcategory)
                           <option value="{{ $subcategory->id}}" @if(isset($reqData['subcat_id']) && $reqData['subcat_id']==$subcategory->id) selected @endif>{{ $subcategory->sub_category_name }}</option>
                         @endforeach
                     </select>
                  </div>
               </div>
			   
               <div>
                  <div class="search-date-group ms-5 d-flex align-items-center" style="margin-left:30px;">
                     <select  class="form-select text-white-dark"  id="brand_name"  name="brand_name" style="width:300px;">
                        <option value="" >Brand Name</option>
                         @foreach($brandData as $brand)
                          
						    <option value="{{ $brand->brand_name }}" @if(isset($reqData['brand_name']) && $reqData['brand_name']==$brand->brand_name) selected @endif>{{ $brand->brand_name }}</option>
                         @endforeach
                     </select>
                  </div>
                </div>
			   
                <div>
                  <div class="search-date-group ms-5 d-flex align-items-center">
                     <select  class="form-select text-white-dark" id="price" name="price" style="width:321px;">
                        <option value="" >Price</option>
                        <option value="0-500" @if(isset($reqData['price']) && $reqData['price']=='0-500') selected @endif>Under-500</option>
                        <option value="501-1000" @if(isset($reqData['price']) && $reqData['price']=='501-1000') selected @endif>501-1000</option>
                        <option value="1001-2000" @if(isset($reqData['price']) && $reqData['price']=='1001-2000') selected @endif>1001-2000</option>
                        <option value="2001-3000" @if(isset($reqData['price']) && $reqData['price']=='2001-3000') selected @endif>2001-3000</option>
                        <option value="3001-4000" @if(isset($reqData['price']) && $reqData['price']=='3001-4000') selected @endif>3001-4000</option>
                        <option value="4001-5000" @if(isset($reqData['price']) && $reqData['price']=='4001-5000') selected @endif>4001-5000</option>
                        <option value="5001-6000" @if(isset($reqData['price']) && $reqData['price']=='5001-6000') selected @endif>5001-6000</option>
                        <option value="6001-7000" @if(isset($reqData['price']) && $reqData['price']=='6001-7000') selected @endif>6001-6000</option>
                        <option value="7001-8000" @if(isset($reqData['price']) && $reqData['price']=='7001-8000') selected @endif>7001-8000</option>
                        <option value="8001-9000" @if(isset($reqData['price']) && $reqData['price']=='8001-9000') selected @endif>8001-9000</option>
                        <option value="9001-10000" @if(isset($reqData['price']) && $reqData['price']=='9001-10000') selected @endif>9001-10000</option>
                        <option value="10001-1000000" @if(isset($reqData['price']) && $reqData['price']=='10001-1000000') selected @endif>10001-above</option>
                     </select>
                  </div>
               </div>
			   
			   
			   <div>
                 <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="today_applied_status" id="product_type">
                           <option value="">Select Product Type</option>
                   
                             <option value="Spare Parts" @if(Request::input('today_applied_status') == 'Spare Parts') selected @endif >Spare Parts</option>
                            <option value="Finished Good" @if(Request::input('today_applied_status') == 'Finished Good') selected @endif >Finished Good</option>
                           
                        </select>
                     </div>
               </div>

               <div>
                  <button type="submit" class="btn btn-outline-success" style="padding-right:50px;padding-left:50px;margin-left:25px;">Submit</button>
				  
                  <a href="{{route('product_list')}}" class="btn btn-outline-info" style="padding-right:11px;padding-left:10px;margin-left:185px;margin-top:-37px;">Reset</a>

			   </div>

            </div>
         </div>
      </form>
      <!-- Search Bar  End -->
     </div>
	 
		 <hr>
		 <br>
         <!-- start main content section -->
		 
		<!--Social link HelperData -->
		
		 
		 @if(count($productList) >0)
			 
          @foreach($productList as $product) 
		   @php
		 
			$productSocialLinks = Helper::shareButtons($product->id);
			

			
							 
		 @endphp

         <div class="gap-10 flex"> 
            <div class="mt-10 lg:mt-0 lg:w-2/3 slide-container">
			
			<a href="{{route('product_detail',$product->product_slug)}}">
            <img src="{{asset('public/uploads/product/product_photo/'.$product->product_photo)}}" alt="" class="slider-image" style="width: 90%; height: 300px;">        
            </a>

<?php   /*  @php
				  
					$productImg = json_decode($product->product_image ,true);
				
					$pro_i = 1;
					$pro_img = [1=>'one', 2=>'two', 3=>'three', 4=>'four', 5=>'five'];
				
					$pro_count = count($productImg);
				   @endphp
				  
				  	
				   @if(!empty($productImg))
					   
					   
					       @for($pro_span_i =1; $pro_span_i <=$pro_count; $pro_span_i++)
							 <span id="slider{{$pro_span_i}}"></span> 
						   @endfor

						    <a href="{{route('product_detail',$product->product_slug)}}"><div class="image-container">

							 @foreach($productImg as $image)
								<img src="{{asset('public/uploads/product/product_image/'.$image)}}" alt="" class="slider-image {{$pro_img[$pro_i]}}">
							  	@php
								  $pro_i = $pro_i+1;
								@endphp
							 @endforeach

							  </div>
							  
							  </a>
					   
				   
				     @endif */ ?>
            </div>

            <div class="mt-10 lg:mt-0 lg:w-2/3">
			
			<div class="social-btn-sp" style="text-align:right; margin:top">
				
				{{-- !! Share::page(url('/post/'. $product->product_slug))->facebook()->twitter()->whatsapp()!! --}}
			   
			   
               {!! $productSocialLinks !!}
            </div>
              
               <div class="">Product Name : <b>{{ ucwords($product->product_name) }}</b></div>
               <div class="">Model Number : <b>{{ $product->model_number}}</b></div>
			   
			   @if(!empty($product->other_brand =='Brand'))
               <div class="">Brand Name   : <b>{{ ucwords($product->brand_name) }}</b></div>
		       @else
			   <div class="">Brand Name   : <b>{{ ucwords($product->other_brand) }}</b></div>
		       @endif
               
               <div class="flex flex-wrap gap-4">
                  <div class="">Warranty  : <b>{{$product->warranty_period}}</b></div>
                  <div>|</div>
                  <div class="">Launch Date : <b>{{ date('d M y', strtotime($product->launch_date)) }}</b></div>
               </div>
             
               <div class="my-4">
                    
				<div class="mb-1 font-bold text-success">₹ <b>{{$product->price}}</b></div>
					
                <div class="mb-1 font-bold">Master Packing : <b>{{$product->master_packing}}</b></div>
		        @if(!empty($product->oem_description))
                <div class="mb-1"><b>OEM Description :</b><p> {!! (nl2br(e(Str::words($product->oem_description, '25')))) !!}</p></div>
				 
                <div class="mb-1 font-bold">Minimum Order For OEM : <b>{{$product->minimum_order_quantity}}</b></div>
				@endif
               </div>
			   
               <div class="mt-8">
                  <h5 class="mb-3 font-bold">About this item :</h5>
                  <p>
                      {{ Str::limit($product->product_description, 20) }}
                  </p>
               </div>
                 <div class="mt-6 flex gap-0.5">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffc107" class="h-4 w-4">
                     <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        fill="#ffc107"
                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                        />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffc107" class="h-4 w-4">
                     <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        fill="#ffc107"
                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                        />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffc107" class="h-4 w-4">
                     <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        fill="#ffc107"
                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                        />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffc107" class="h-4 w-4">
                     <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        fill="#ffc107"
                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                        />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#E0E6ED" class="h-4 w-4">
                     <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        fill="#E0E6ED"
                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                        />
                  </svg>
                  <div class="ltr:ml-2 rtl:mr-2">( <strong>5.50k</strong> Customer Review )</div>

               </div>
			   
				<div style="margin-top: 90px;">
				<a href="{{route('add.to.cart',$product->id)}}"><button class="btn btn-primary"> <i class = "fas fa-shopping-cart"></i>&nbsp;Add To Cart</button></a>
				<br>
				<a href="{{route('product_detail',$product->product_slug)}}" style="margin-left: 400px; color:darkcyan;"><b>More Details</b></a>
				</div>
            </div>
         </div>
		 <hr>
		 <br>
        @endforeach
		
		{{ $productList->links('admin.partials.pagination')}}
		
		@else
			<!--<h1 style="color:red; text-align:center">No results for 534563464 in Books.</h1>-->
			<h1 style="color:red; text-align:center">No Record Found!!</h1>
	    @endif
         <!-- end main content section -->

      </div>
   </div>
</div>

@endsection

@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

	
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
</script>


<script> 
   $(function(){
    $('#alertMessageHide').delay(2000).fadeOut();
   });
</script>

<script>

function getSubcategoryData(element){
	
	   var category_id = element.value;
       //alert(category_id);	   
	   var token = "{{ csrf_token() }}";
       //var url = "{{ route('get_seller_data') }}";
	    var url = "{{ route('get_subcategory_data') }}";
       $.ajax({
         url:url,
         type: 'POST',
         data: { _token :token,category_id:category_id },
         success:function(result){
		
          console.log(result);	  
		 
	    // var brand_name = result.category_data.brand_name;
	   //  $('#brand_name').val(brand_name);
		 
		 
		$('#subcategory_name').html(''); 
		
	
		$('#subcategory_name').append('<option value="">--Select Sub Category--</option>');
          
          $.each(result.subcat_data, function(key, value) {
          
          $('#subcategory_name').append('<option value="'+key+'">'+value+'</option>');
          
        }); 
	   
	     
           
         }
       });
}

</script>

<!-- Date 31-03-2024 for get product Search category ID and Subcategory Data-->
<!-- <script>

function getProductSearchData(element){
	
	   var product_name = element.value;
	   
       //alert(product_name);
	   
	    var token = "{{ csrf_token() }}";
	    var url = "{{ route('get_product_search_data') }}";
        $.ajax({
        url:url,
        type: 'POST',
        data: { _token :token,product_name:product_name },
        success:function(result){

         // selectElement('category_name', result.product_cate_data.category_id);
		  
		 $('#category_name').html(''); 
		
	
		$('#category_name').append('<option value="">--Select Category--</option>');
		  
		  $('#category_name').append('<option value="'+result.product_cate_data.category_id+'" selected>'+result.categorySearchData.category_name+'</option>');
		  
		
		 $('#subcategory_name').html(''); 
		$('#subcategory_name').append('<option value="">--Select Sub Category--</option>');
          
          $.each(result.product_subcategory_data, function(key, value) {
          
		  if(value.id == result.product_cate_data.subcat_id){
			 $('#subcategory_name').append('<option value="'+value.id+'" selected>'+value.sub_category_name+'</option>'); 
		  }else{
			$('#subcategory_name').append('<option value="'+value.id+'">'+value.sub_category_name+'</option>');  
		  }         
          
        }); 
		
		// selectElement('brand_name', result.product_cate_data.brand_name);
		
        $('#brand_name').html(''); 
		
	
		$('#brand_name').append('<option value="">--Select Brand--</option>');
		  
		  $('#brand_name').append('<option value="'+result.product_cate_data.brand_name+'" selected>'+result.product_cate_data.brand_name+'</option>');
        console.log(result);	  	    
         }
       });
}

function selectElement(id, valueToSelect) {    
    let element = document.getElementById(id);
    element.value = valueToSelect;
}



</script> -->



<!--Date 31-03-2024 for autoserch script -->

<!-- Date 26-06-2024 for get product Search category ID and Subcategory Data-->
<script>

function getProductSearchData(element){
  
     var product_name = element.value;
     
       //alert(product_name);
     
      var token = "{{ csrf_token() }}";
      var url = "{{ route('get_product_search_data') }}";
        $.ajax({
        url:url,
        type: 'POST',
        data: { _token :token,product_name:product_name },
        success:function(result){

         // selectElement('category_name', result.product_cate_data.category_id);
      
     $('#category_name').html(''); 
    
  
    $('#category_name').append('<option value="">--Select Category--</option>');
      
     // $('#category_name').append('<option value="'+result.product_cate_data.category_id+'" selected>'+result.categorySearchData.category_name+'</option>');
      
     $.each(result.all_categoryData, function(key, value) {
          
              $('#category_name').append('<option value="'+value.id+'">'+value.category_name+'</option>');          
          
        }); 
    
    $('#category_name').attr('onchange',''); 
    
     $('#subcategory_name').html(''); 
    $('#subcategory_name').append('<option value="">--Select Sub Category--</option>');
          
/*    $.each(result.product_subcategory_data, function(key, value) {
          
      if(value.id == result.product_cate_data.subcat_id){
       $('#subcategory_name').append('<option value="'+value.id+'" selected>'+value.sub_category_name+'</option>'); 
      }else{
      $('#subcategory_name').append('<option value="'+value.id+'">'+value.sub_category_name+'</option>');  
      }         
          
        });  */
    
    $.each(result.all_product_subcat_data, function(key, value) {
          
            $('#subcategory_name').append('<option value="'+value.id+'">'+value.sub_category_name+'</option>');         
          
        }); 
    
    // selectElement('brand_name', result.product_cate_data.brand_name);
    
        $('#brand_name').html(''); 
    
  
    $('#brand_name').append('<option value="">--Select Brand--</option>');
      
      //$('#brand_name').append('<option value="'+result.product_cate_data.brand_name+'" selected>'+result.product_cate_data.brand_name+'</option>');
      
     $.each(result.all_brandData, function(key, value) {
          
            $('#brand_name').append('<option value="'+value.brand_name+'">'+value.brand_name+'</option>');         
          
        }); 
    
        console.log(result);
    
         }
       });
}

function selectElement(id, valueToSelect) {    
    let element = document.getElementById(id)
;
    element.value = valueToSelect;
}



</script>


<script type="text/javascript">
    var path = "{{ route('product_autocomplete') }}";
  
    $('#search').typeahead({
            source: function (query, process) {
                return $.get(path, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
  
</script>
<!--Date 31-03-2024 for autoserch script End -->

@endpush

<!--Date 31-03-2024 for autoserch Head -->

@push('head')

<style>
.dropdown-menu {
    position: absolute;
    z-index: 1005;
    display: none;
    min-width: 19rem;
    padding: 0.5rem;
    margin: 0px;
    font-size: 1rem;
    color: rgb(14 23 38 / var(--tw-text-opacity));
    text-align: left;
    list-style: none;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .15);
    border-radius: 0.25rem;
  }
</style>


@endpush
<!--Date 31-03-2024 for autoserch Head End -->
