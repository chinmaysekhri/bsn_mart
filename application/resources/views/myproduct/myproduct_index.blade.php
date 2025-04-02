@if(count($myProduct) >0)
@foreach($myProduct as $product)

	<div class="col col-lg-3">
	   <div class="card mb-3">
		  
	   <!-- <img class= "img-responsive"  alt="" src="{{ url('public/uploads/product/product_photo/'.$product->product_photo) }}">-->
			<img  class= "img-responsive" src="{{asset('public/uploads/product/product_photo/'.$product->product_photo)}}" alt="" style="width: 100%;height: 300px;">
			<div class="card-body">
				<h5 class="card-title"> {{ ucwords($product->product_name) }}</h5>
				
				<!--<p class="card-text">{!! ucwords(nl2br(e(Str::words($product->product_description, '10')))) !!}</p>-->
			   
				<p class="card-text">Seller Price : <b>₹</b>  {{ $product->seller_price }}</p>
				
				 <p class="card-text">Model No : {{ $product->model_number }}</p>
				 <p class="card-text">Master Packing : {{ $product->master_packing }}</p>
                
				@if(!empty($product->carton_packing))

				<p class="card-text">Carton packing : {{ $product->carton_packing }}</p>
				
				@endif
				
				 @if(!empty($product->warranty_period))
				
				<p class="card-text"> {{ $product->warranty_period }} Month / {{ $product->product_warranty_type }} / {{ $product->product_guarantee_type }} </p>
			  
				@else
					
				<p class="card-text">No Guarantee</p>
				 
				@endif 
				
				<!--<p class="card-text"> {{-- $product->product_warranty_type --}}</p> -->
				
				<p class="card-text"> {{ $product->product_type }}</p>
				
				<p class="card-text">About Product: {{ $product->product_description }}</p>
				
			</div>
		</div>
	</div>
	<br>
	 @endforeach
	  
	 {{$myProduct->links()}}

	 @else
	  <!--<h1 style="color:red; text-align:center">No results for 534563464 in Books.</h1>-->
	  <h1 style="color:red; text-align:center">No Record Found!!</h1>
	 @endif
