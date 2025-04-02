.@php
 
use App\Helpers\Helper;

@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Product</title>
	<link rel="icon" type="image/x-icon" href="{{asset('public/admin/assets/images/favicon.png')}}" />
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        ul {
            list-style: none;
            padding: 5px;
        }

        li a {
            color: darkgray;
            text-decoration: none;
        }

        li a:hover {
            text-decoration: none;
            color: darksalmon;
        }

        .footer-content h2 {
            color: #fff;
        }
        .footer-content h5,
        .footer-content p,
        .footer-links a {
            color: #fff;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .footer hr {
            background-color: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
           <!-- <a class="navbar-brand" href="#">Logo</a>-->
		   @if($sellerData->seller_brand_logo)
           <img  class= "img-responsive" src="{{asset('public/uploads/seller/seller_brand_logo/'.$sellerData->seller_brand_logo)}}" alt="" style="height: 100px;">
	       @else
		   <img  class= "img-responsive" src="{{asset('public/admin/assets/brand_default.png')}}" alt="" style="height: 100px;">
		   
	       @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   
                </ul>
                <ul>
                   
                    <li class="nav-item">Business Name : {{ ucwords($sellerData->business_name)}}</li>
                    <li class="nav-item">Email : {{ $sellerData->email }} </li>
                    <li class="nav-item">Mobile Number : +91-{{$sellerData->mobile }}</li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid ">
	
	@if(count($myProduct) >0)
        <div class="row align-items-start mt-5 mb-5">
            <div class="col-4 col-lg-2 col-md-3">
                <div id="mobile-filter">
                    <div>
                        <h6 class="p-1 border-bottom">Produt Type</h6>
                        <ul>
                           
                            @foreach($productTypeArr as $productType)
                            <input class="get_product_data" type="checkbox" id="vehicle1" name="" value="product_type_{{$productType}}">
                            <label for="vehicle1">{{$productType}}</label><br>
                            @endforeach
                        
                        </ul>
                    </div>
                    <div>
                        <h6 class="p-1 border-bottom">Category</h6>
                        <ul>
                        
                            @foreach($productCategoryArr as $productCategory)
                            
                            @php 

				            $getcategoryName = Helper::getProductCategoryName($productCategory);
				            
				            $categoryName = $getcategoryName->category_name;
				            @endphp
                            
                            <input class="get_product_data" type="checkbox" id="vehicle1" name="vehicle1" value="product_category_{{$productCategory}}">
                            <label for="vehicle1">{{$categoryName}}</label><br>
                            @endforeach
                           
                        </ul>
                    </div>
                    <div>
                        <h6 class="p-1 border-bottom">Sub Category</h6>
                        <ul>
                               
                        @foreach($productSubCategoryArr as $productSubCategory)    
                       
                        @php 

				        $getSubCategoryName = Helper::getProductSubCategoryName($productSubCategory);
				        if(!empty($getSubCategoryName->sub_category_name)){
				        $subCategoryName  =  $getSubCategoryName->sub_category_name;
				        }
				 
				         @endphp
                            <input class="get_product_data" type="checkbox" id="vehicle1" name="vehicle1" value="product_subcategory_{{$productSubCategory}}">
                            <label for="vehicle1">{{$subCategoryName}}</label><br>
                            @endforeach
                           
                        </ul>
                      </div>
					  <div>
                        <h6 class="p-1 border-bottom">Product Status</h6>
						 <ul>
						 
						    @foreach($productStatusArr as $productStatus)    
                       
							@php 

							$productStatusNameData = Helper::getSellerProductActive($productStatus);
						
							$productStatusName  =  $productStatusNameData->product_status;
							
							 @endphp
						    <input class="get_product_data" type="checkbox" id="vehicle1" name="vehicle1" value="product_status_{{$productStatus}}">
                            <label for="vehicle1">{{ $productStatusName }}</label><br>
							
							<div>
                             <h6 class="p-1 ">Total Active({{$productCountActive}})</h6>
                        
                            </div>
							
							@endforeach
						   </ul>	
							
						<ul>
							@foreach($productStatusInactiveArr as $productInactive)    
                       
							@php 

							 $productInactiveData = Helper::getSellerProductInctive($productInactive);
							
							 $productInactiveName  =  $productInactiveData->product_status;
							 
							 @endphp
							<input class="get_product_data" type="checkbox" id="vehicle1" name="vehicle1" value="out_of_stock_data{{$productInactive}}">
                            <label for="vehicle1">{{$productInactiveName}}</label><br>
							
							<div>
							<h6 class="p-1 ">Total Out Of Stock({{$productCountInactive}})</h6>
                            </div>
							@endforeach
							</ul>
							
							<ul>
							@foreach($productStatusOnHoldArr as $productOnHold)    
                       
							 @php 

							 $productOnHoldData = Helper::getSellerProductOnHold($productOnHold);
							
							 $productOnHoldName = $productOnHoldData->product_status;
							
							 @endphp
							
							 <input class="get_product_data" type="checkbox" id="vehicle1" name="vehicle1" value="on_hold_data_{{$productOnHold}}">
                             <label for="vehicle1">{{$productOnHoldName}}</label><br>
						   
						     <div>
                               <h6 class="p-1 ">Total On Hold({{$productCountOnhold}})</h6>
                        
                             </div>
							 @endforeach
							</ul>
							
						
                      </div>
					<div>
					
                       <h6 class="p-1"><a href="{{ route('myproduct',Crypt::encrypt($sellerData->id)) }}" style="text-decoration:none;">Clear Filter</a></h6>
                        
                    </div>
					
					<!--<div>
                        <h6 class="p-1 ">Total Products({{$productCountActive}})</h6>
                        
                    </div>-->

                </div>
            </div>
            
           
           
            <div class="col-8 col-lg-10 col-md-9 text-center">
                <div class="row mt-3" id="my_product_data">
                    
                    @foreach($myProduct as $product)
                    
                        <div class="col col-lg-3">
                           <div class="card mb-3">
                               <img  class= "img-responsive" src="{{asset('public/uploads/product/product_photo/'.$product->product_photo)}}" alt="" style="width: 100%;height: 300px;">
                                <div class="card-body">
                                    
                                    <h5 class="card-title"> {{ ucwords($product->product_name) }}</h5>
                                   
									<p class="card-text">Product ID : PID00{{ $product->id }}</p>
                                    <!--<p class="card-text">{!! ucwords(nl2br(e(Str::words($product->product_description, '10')))) !!}</p>-->
                                   
                                  
									 
                                     @if($product->dont_show_price =='No')
										 
                                     <p class="card-text">Seller Price : <b>₹</b>{{ $product->seller_price }}</p>
									
									 @endif
									 
                                    <p class="card-text">Model No : {{ $product->model_number }}</p>
									
                                    <p class="card-text">Master Packing : {{ $product->master_packing }}</p>
                                    
									@if(!empty($product->carton_packing))
										
									<p class="card-text">Carton Packing : {{ $product->carton_packing }}</p>
									@endif
									
									
									@if(!empty($product->warranty_period))	
									
									<p class="card-text"> {{ $product->warranty_period }} Month /{{ $product->product_guarantee_type }}/{{ $product->only_spare_parts }}/{{ $product->product_warranty_type }} </p>
								    @else
										
                                    <p class="card-text">No Guarantee</p>
								    
									@endif          										
                                   
                                    <!-- <p class="card-text"> {{-- $product->product_warranty_type --}}</p>  -->
                                    <p class="card-text"> {{ $product->product_type }}</p>
									
									<p class="card-text">About Product : {{ $product->product_description }}</p>
									
                                </div>
                            </div>
                        </div>
                        <br>
                         @endforeach
                          
                         {{$myProduct->links()}}
        		
        	 	        
                </div>
               
            </div>
        
            @else
				
        	 <h4 style="color:red; text-align:center">YOUR ID IS DEACTIVATED KINDLY CONTACT YOUR ACCOUNT MANAGER!!</h4>
			 
        	@endif
        </div>
    </div>
    	
    <footer class="footer p-5 bg-light">
        <div class="container">
            <div class="row">
              
                <!-- <p>© Copyright 2024 BSN MART (A Unit of BSN Employment Limited).</p> -->
                
                <p style="text-align:center"><a href="https://bsnmart.com/" target="blank" style="text-decoration:none;">CATALOGUE CREATED BY BSN MART</a></p>
				
            </div>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

<script> 


$('.get_product_data').on('change', function() {
if($(this).is(':checked')){
    var values = [];
    $.each($('input:checked'),function(index,input){
        values.push(input.value);
    });
    
    
        var product_filter = values;
         
	    var token = "{{ csrf_token() }}";
      
	    var url = "{{ route('myproduct',Crypt::encrypt($sellerData->id)) }}";
         $.ajax({
         url:url,
         type: 'POST',
         data: { _token :token,product_filter:product_filter },
         success:function(result){
		
		$('#my_product_data').html('');
		$('#my_product_data').html(result);
          console.log(result);	  		 
           
         }
		 
       });
       
     }  
  
});

</script>

</html>
