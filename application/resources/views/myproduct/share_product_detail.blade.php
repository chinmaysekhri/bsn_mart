
@php
 
use App\Helpers\Helper;

@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="{{ $productDetail->product_name }} / Price ₹ {{$productDetail->price}}" />
<meta property="og:description" content="{{ $productDetail->product_description }}">
<meta property="og:image" content="{{asset('public/uploads/product/product_photo/'.$productDetail->product_photo)}}" />

<meta property="og:image:width" content="300">
<meta property="og:image:height" content="256">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="product" />


    <title>{{ $productDetail->product_name }}</title>
	<link rel="icon" type="image/x-icon" href="{{asset('public/admin/assets/images/favicon.png')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<style>

@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');

*{
    box-sizing: border-box;
    padding: 0;
    margin: 0;
    font-family: 'Open Sans', sans-serif;
}
body{
    line-height: 1.5;
}
.card-wrapper{
    max-width: 1100px;
    margin: 0 auto;
}
img{
    width: 100%;
    display: block;
}
.img-display{
    overflow: hidden;
}
.img-showcase{
    display: flex;
    width: 100%;
    transition: all 0.5s ease;
}
.img-showcase img{
    min-width: 100%;
}
.img-select{
    display: flex;
}
.img-item{
    margin: 0.3rem;
}
.img-item:nth-child(1),
.img-item:nth-child(2),
.img-item:nth-child(3){
    margin-right: 0;
}
.img-item:hover{
    opacity: 0.8;
}
.product-content{
    padding: 2rem 1rem;
}
.product-title{
    font-size: 3rem;
    text-transform: capitalize;
    font-weight: 700;
    position: relative;
    color: #12263a;
    margin: 1rem 0;
}
.product-title::after{
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    height: 4px;
    width: 80px;
    background: #12263a;
}
.product-link{
    text-decoration: none;
    text-transform: uppercase;
    font-weight: 400;
    font-size: 0.9rem;
    display: inline-block;
    margin-bottom: 0.5rem;
    background: #256eff;
    color: #fff;
    padding: 0 0.3rem;
    transition: all 0.5s ease;
}
.product-link:hover{
    opacity: 0.9;
}
.product-rating{
    color: #ffc107;
}
.product-rating span{
    font-weight: 600;
    color: #252525;
}
.product-price{
    margin: 1rem 0;
    font-size: 1rem;
    font-weight: 700;
}
.product-price span{
    font-weight: 400;
}
.last-price span{
    color: #f64749;
    text-decoration: line-through;
}
.new-price span{
    color: #256eff;
}
.product-detail h2{
    text-transform: capitalize;
    color: #12263a;
    padding-bottom: 0.6rem;
}
.product-detail p{
    font-size: 0.9rem;
    padding: 0.3rem;
    opacity: 0.8;
}
.product-detail ul{
    margin: 1rem 0;
    font-size: 0.9rem;
}
.product-detail ul li{
    margin: 0;
    list-style: none;
    background: url(https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/checked.png) left center no-repeat;
    background-size: 18px;
    padding-left: 1.7rem;
    margin: 0.4rem 0;
    font-weight: 600;
    opacity: 0.9;
}
.product-detail ul li span{
    font-weight: 400;
}
.purchase-info{
    margin: 1.5rem 0;
}
.purchase-info input,
.purchase-info .btn{
    border: 1.5px solid #ddd;
    border-radius: 25px;
    text-align: center;
    padding: 0.45rem 0.8rem;
    outline: 0;
    margin-right: 0.2rem;
    margin-bottom: 1rem;
}
.purchase-info input{
    width: 60px;
}
.purchase-info .btn{
    cursor: pointer;
    color: #fff;
}
.purchase-info .btn:first-of-type{
    background: #256eff;
}
.purchase-info .btn:last-of-type{
    background: #f64749;
}
.purchase-info .btn:hover{
    opacity: 0.9;
}
.social-links{
    display: flex;
    align-items: center;
}
.social-links a{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    color: #000;
    border: 1px solid #000;
    margin: 0 0.2rem;
    border-radius: 50%;
    text-decoration: none;
    font-size: 0.8rem;
    transition: all 0.5s ease;
}
.social-links a:hover{
    background: #000;
    border-color: transparent;
    color: #fff;
}

@media screen and (min-width: 992px){
    .card{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 1.5rem;
    }
    .card-wrapper{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .product-imgs{
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .product-content{
        padding-top: 0;
    }
}

</style>


<style>
body {
  font-size: 0.98rem;
}
</style>

 </head>
  <body>
        <nav class="navbar bg-body-tertiary">
		  <div class="container">
			<a class="navbar-brand" href="https://bsnmart.com/application/share-my-product/">
			  <img src="{{asset('public/admin/assets/bsn_logo.png')}}" alt="Bootstrap" width="106px" height="84px">
			</a>
			
		  </div>
		  
        </nav>
    <h3 style="text-align:center">Product Detail</h3>

<div class="container">
  <hr />
</div>

<div class="container">
  <div class="row">
  <!-- 11-10-2024 -->
  <div class = "card-wrapper d-flex">
  <div class = "card">
    <!-- card left -->
    <div class = "product-imgs">
      <div class = "img-display">
        <div class = "img-showcase d-flex">
          <img src = "{{asset('public/uploads/product/product_photo/'.$productDetail->product_photo)}}" alt = "shoe image">
         
        </div>
      </div>
      
                    @php
					$productImg = json_decode($productDetail->product_image ,true);
					
					$totalImg=0;
					
					if(!empty($productImg)){
						
					$totalImg=count($productImg);
					}
					$img_i=1;
					
				    @endphp
      <div class = "img-select d-flex">
          @foreach($productImg as $image)
        <div class = "img-item d-flex">
          <a href = "#" data-id = "1">
            <img src = "{{asset('public/uploads/product/product_image/'.$image)}}" alt = "{{asset('public/uploads/product/product_image/'.$image)}}">
          </a>
        </div>
        @endforeach
        
      </div>
    </div>
    <!-- card right -->
    <div class = "product-content">
      <h6 class = "product-title">{{$productDetail->product_name}}</h6>
      <!--<a href = "#" class = "product-link">visit nike store</a>-->
      <!--<div class = "product-rating">
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star-half-alt"></i>
        <span>4.7(21)</span>
      </div>-->
	  
      <div class = "product-price">
        <!--<p class = "last-price">Old Price: <span>$257.00</span></p>-->
        @if(empty($productDetail->other_brand))
        <p class = "new-price">Brand : <span>{{$productDetail->brand_name}}</span></p>
         @elseif($productDetail->other_brand =="Brand"))
         <p class = "new-price">Brand : <span>{{$productDetail->brand_name}}</span></p>
         @else
         <p class = "new-price">Brand : <span>{{$productDetail->other_brand}}</span></p>
         @endif
         
        <p class = "new-price">price : <b>₹</b>&nbsp;<span>{{$productDetail->price}} /- {{$productDetail->packaging_charges}}</span></p>
     
        <p class = "new-price">Model No : &nbsp;<span>{{$productDetail->model_number}}</span></p>
      
        <p class = "new-price">Master Packing : &nbsp;<span>{{$productDetail->master_packing}}</span></p>
		
		@if(!empty($productDetail->carton_packing))
        <p class = "new-price">Carton Packing : &nbsp;<span>{{$productDetail->carton_packing}}</span></p>
        @endif
     
      </div>
      
    <div class = "product-detail">
	  
	   @if(!empty($productDetail->warranty_period))	
									
		<p class="new-price"><b>Warranty :</b> {{ $productDetail->warranty_period }} Month /{{ $productDetail->product_guarantee_type }}/{{ $productDetail->only_spare_parts }}/{{ $productDetail->product_warranty_type }} </p>
		@else
			
		<p class="new-price">No Guarantee</p>
		
		@endif 
	  </div>

      <div class = "product-detail">
        <h2>about this item: </h2>
        <p> {{$productDetail->product_description}}</p>
		<!--<ul>
          <li>Color: <span>Black</span></li>
          <li>Available: <span>in stock</span></li>
          <li>Category: <span>Shoes</span></li>
          <li>Shipping Area: <span>All over the world</span></li>
          <li>Shipping Fee: <span>Free</span></li>
        </ul>-->
      </div>

    <!--  <div class = "purchase-info">
        <input type = "number" min = "0" value = "1">
        <button type = "button" class = "btn">
          Add to Cart <i class = "fas fa-shopping-cart"></i>
        </button>
        <button type = "button" class = "btn">Compare</button>
      </div>-->

     <!-- <div class = "social-links">
        <p>Share At: </p>
        <a href = "#">
          <i class = "fab fa-facebook-f"></i>
        </a>
        <a href = "#">
          <i class = "fab fa-twitter"></i>
        </a>
        <a href = "#">
          <i class = "fab fa-instagram"></i>
        </a>
        <a href = "#">
          <i class = "fab fa-whatsapp"></i>
        </a>
        <a href = "#">
          <i class = "fab fa-pinterest"></i>
        </a>
      </div>-->
    </div>
  </div>
</div>
  
  <!-- 11-10-2024 -->
  

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
	
	
	
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 <script> 

const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);

 </script> 
</body>
</html>