
@php
 
use App\Helpers\Helper;

@endphp
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Share My Product</title>
	<link rel="icon" type="image/x-icon" href="{{asset('public/admin/assets/images/favicon.png')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!--date 03-01-2025  -->
	

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	
	<!--date 03-01-2025  -->
    
	<!-- for social link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
	</style>
<!-- for social link End 15-09-2024 -->
<style>
body {
  font-size: 0.98rem;
}

</style>

 </head>
  <body>
        <nav class="navbar bg-body-tertiary">
		  <div class="container">
			<a class="navbar-brand" href="#">
			  <img src="{{asset('public/admin/assets/bsn_logo.png')}}" alt="Bootstrap" width="106px" height="84px">
			</a>
			
		  </div>
		  
        </nav>
    <h3 style="text-align:center">BSN Mart Product List</h3>

<div class="container">
  <hr />
</div>


     <!-- search Bar  -->

<div class="container">
<form method="get" action="">
    @csrf
  <div class="row">
    <div class="form-group col-md-4">
      <label for="inputEmail4"></label>
      <input type="text" class="typeahead form-control" name="q" id="search" value="@if(isset($reqData['q'])) {{$reqData['q'] }} @endif" placeholder="Search Product....." onchange="getProductSearchData(this);">
    </div>
	
	<div class="form-group col-md-4">
     <label for="inputEmail4"></label>
     <select class="form-control" id="category_name"  name="cat_id" onchange="getSubcategoryData(this);">
        <option value="">Select Category</option>
		@foreach($categoryData as $category)
	    <option value="{{ $category->id}}" @if(isset($reqData['cat_id']) && $reqData['cat_id']==$category->id) selected @endif>{{ ucwords($category->category_name) }}</option>
	    @endforeach
      </select>
    </div>
	
	<div class="form-group col-md-4">
	<label for="inputEmail4"></label>
      <select class="form-control" id="subcategory_name"  name="subcat_id" onchange="getBrandData(this);">
        <option value="">Select Sub Category</option>
		@foreach($subCategoryData as $subcategory)
	    <option value="{{ $subcategory->id}}" @if(isset($reqData['subcat_id']) && $reqData['subcat_id']==$subcategory->id) selected @endif>{{ ucwords($subcategory->sub_category_name) }}</option>
		
	    @endforeach
      </select>
    </div>
	
  </div>
  
  <div class="row">
  
  <div class="form-group col-md-4">
     <label for="inputEmail4"></label>
     <select class="form-control" id="brand_name"  name="brand_name">
        <option value="">Select Brand Name</option>
        @foreach($brandData as $brand)                 
	     <option value="{{ $brand->brand_name }}" @if(isset($reqData['brand_name']) && $reqData['brand_name']==$brand->brand_name) selected @endif>{{ ucwords($brand->brand_name) }}</option>
        @endforeach
        
      </select>
    </div>
	
	<div class="form-group col-md-4">
	<label for="inputEmail4"></label>
      <select class="form-control" id="price" name="price">
        <option value="">Select Price</option>
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
	<div class="form-group col-md-4">
	<label for="inputEmail4"></label>
      <select class="form-control" name="today_applied_status" id="product_type">
        <option value="">Select Product Type</option>
        <option value="Spare Parts" @if(Request::input('today_applied_status') == 'Spare Parts') selected @endif >Spare Parts</option>
        <option value="Finished Good" @if(Request::input('today_applied_status') == 'Finished Good') selected @endif >Finished Good</option>
        
      </select>
    </div>
  </div>
  
  
  <br>
 <div style="text-align:center">
  <button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="{{route('share_my_product')}}" type="submit" class="btn btn-success">Reset</a>
  </div>
</form>
</div>
<br>

      <!-- Search Bar  End -->
     
<div class="container">
  <hr />
</div>
<div class="container">
  <div class="row">

	@if(count($productList) >0)
		
    @foreach($productList as $product)
	
	@php
		 
	$productSocialLinks = Helper::shareProduct($product->id);
	
							 
	@endphp
				
	
    <div class="col-md-4 mb-3">
      <div class="card h-100">

		@if(!empty($product->product_photo) && file_exists("public/uploads/product/product_photo/$product->product_photo"))	
		
		{{-- dd($product->product_photo)--}}
		<a href="{{route('share_product_detail',$product->product_slug)}}">	
          <img src="{{asset('public/uploads/product/product_photo/'.$product->product_photo)}}" class="card-img-top" alt="Product">
        </a>
		@else
		<a href="#">
          <img src="{{asset('public/admin/assets/brand_default.png')}}" class="card-img-top" alt="Product">
        </a>
	   @endif
		
        <div class="card-body px-2 pb-2 pt-1">
          <div class="d-flex justify-content-between">
            <div>
              <p class="h6 text-info">{{ ucwords($product->product_name) }}</p>
            </div>
            <div>
              <a href="#" class="text-secondary lead" data-toggle="tooltip" data-placement="left" title="Compare">
                <i class="fa fa-line-chart" aria-hidden="true"></i>
              </a>
            </div>
          </div>
		  
          <div class="d-flex mb-3 justify-content-between">
            <div>
			@if($product->dont_show_price =='No')
           
	        <p class="mb-0 small"><b>₹</b>&nbsp;{{ $product->price }} /- {{$product->packaging_charges}}</p>
		    @else
		    
		    <p class="mb-0 small"></p>
		    
			@endif
		  
		  
		     <p class="mb-0 small"><b>Product ID : </b>PID00{{ $product->id }}</p>
		  
            <p class="mb-0 small"><b>Model No : </b>{{ $product->model_number }}</p>
			  
			  
			<p class="mb-0 small"><b>Master Packing : </b>{{ $product->master_packing }}</p>
			
			@if(!empty($product->carton_packing))
            <p class="mb-0 small"><b>Carton Packing : </b>{{ $product->carton_packing }}</p>
			@endif
			
			@if(!empty($product->warranty_period))
             
			<p class="mb-0 small"><b>Warranty :</b> {{ $product->warranty_period }} Month /{{ $product->product_guarantee_type }}/{{ $product->only_spare_parts }}/{{ $product->product_warranty_type }} </p>
			
			@else
              <p class="mb-0 small">No Guarantee</p>
			@endif  
			
              <p class="mb-0 small">{{ $product->product_type }}</p>
			
			<p class="mb-0 small"><b>About Product :</b> {{ $product->product_description }}</p>
			  
            </div>
			
          </div>

          
          <div class="social-btn-sp" style="text-align:right; margin:top;mt:1px" >
			{!! $productSocialLinks !!}
          
            </div>
        
        </div>
      </div>
    </div>
	
	
    @endforeach
	
	<div style="color:red; text-align:center">{{$productList->links()}}</div>
	@else
		<!--<h1 style="color:red; text-align:center">No results for 534563464 in Books.</h1>-->
		<h3 style="color:red; text-align:center">No Record Found!!</h3>
		
		<!--  Suggestion Modelpupop 02-01-2025 Start -->
			
			<div class="container mt-3" style="text-align: center;">
				  
				  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
				   Suggest Product
				  </button>
				</div>

			<!-- The Modal -->
				<div class="modal fade" id="myModal">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Suggest Product</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
						 <form action="{{route('suggest_product')}}" method="POST" enctype="multipart/form-data">
						  @csrf
						  
						  <div class="form-group">
							<label for="suggest_product_name" class="col-form-label">Product Name:</label>
							<input type="text" name="suggest_product_name" placeholder="Enter Product Name" class="form-control" id="suggest_product_name">
						  </div>
						  
						  <div class="form-group">
							<label for="suggest_price_range" class="col-form-label">Price Range:</label>
							<input type="text" class="form-control" name="suggest_price_range" placeholder="Enter Price Range" id="suggest_price_range">
						  </div>
						  
						  <div class="form-group">
							<label for="suggest_brand_name" class="col-form-label">Brand Name(if any):</label>
							<input type="text" class="form-control" name="suggest_brand_name" placeholder="Enter Brand Name" id="suggest_brand_name">
						  </div>
						  
						   <div class="form-group">
							<label for="monthly_requirement" class="col-form-label">Monthly Requirement:</label>
							<input type="text" class="form-control" name="monthly_requirement" placeholder="Enter Monthly Requirement" id="monthly_requirement">
						   </div>
						  
						  <div class="form-group">
							<label for="suggest_product_img" class="col-form-label">Product Image Upload:</label>
							<input type="file" class="form-control" name="suggest_product_img" placeholder="Select Product Image" id="suggest_product_img">
						  </div>
						  
						  <br>
						  <button type="submit" class="btn btn-primary" style="text-align: center;margin-left: 160px;">Save</button>
						 
						  </form>
					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					  </div>

					</div>
				  </div>
				</div>
			
                       
    <!--  Suggestion Modelpupop 02-01-2025  End--> 
		
	@endif
  		
  </div>
</div>


<div class="container">
  <hr />
</div>


<!--footer  section-->
<section class="">

  <footer class="text-center text-white" style="background-color: #0a4275;">
  
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2020 -2024 &nbsp;&nbsp;<a class="text-white" href="https://bsnmart.com/" target="blank">BSN Mart Pvt.Ltd</a>
    </div>
   
  </footer>

</section>
<!--footer  section-->
	
	

</body>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

	
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
</script>
 
 <script> 
 $(function(){
  
  $('[data-toggle=tooltip]').tooltip();
  
  $('.grid-view').click(function(){
    
  });
  
});
 </script> 
 <!-- Search Script Here --> 
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

<script>

//19-10-2024
function getBrandData(element){
	
	   var subcat_id = element.value;
       //alert(subcat_id);	   
	   var token = "{{ csrf_token() }}";
      
	   var url = "{{ route('get_brand_data') }}";
       $.ajax({
         url:url,
         type: 'POST',
         data: { _token :token,subcat_id:subcat_id },
         success:function(result){
		
          console.log(result);

        $('#brand_name').html(''); 
		
	
		$('#brand_name').append('<option value="">--Select Brand Name--</option>');
          
          $.each(result.brand_data, function(key, value) {
          
          $('#brand_name').append('<option value="'+value+'">'+value+'</option>');
          
        }); 

 
		 }
		 
        }); 
	   
       }

</script>


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

    $.each(result.all_product_subcat_data, function(key, value) {
          
            $('#subcategory_name').append('<option value="'+value.id+'">'+value.sub_category_name+'</option>');         
          
        }); 
    
    
    
        $('#brand_name').html(''); 
    
  
    $('#brand_name').append('<option value="">--Select Brand--</option>');
     
      
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
 <!-- Search Script Here --> 

</html>