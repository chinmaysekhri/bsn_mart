@php
 
use App\Helpers\Helper;

use App\Models\Review;

@endphp

@extends('admin.layouts.app')
@section('title',$productDetail->product_name)
@section('content')
<style>
   /* Slideshow container */
   .slideshow-container {
   max-width: 1000px;
   position: relative;
   margin: auto;
   }
   /* Next & previous buttons */
   .prev, .next {
   cursor: pointer;
   position: absolute;
   top: 50%;
   width: auto;
   padding: 16px;
   margin-top: -22px;
   color: #1d459f;
   font-weight: bold;
   font-size: 18px;
   transition: 0.6s ease;
   border-radius: 0 3px 3px 0;
   user-select: none;
   }
   /* Position the "next button" to the right */
   .next {
   right:0px;
   border-radius: 3px 0 0 3px;
   }
   /* On hover, add a black background color with a little bit see-through */
   .prev:hover, .next:hover {
   background-color: rgba(0,0,0,0.8);
   }
   /* Caption text */
   .text {
   color: #f2f2f2;
   font-size: 15px;
   padding: 8px 12px;
   position: absolute;
   bottom: 8px;
   width: 100%;
   text-align: center;
   }
   /* Number text (1/3 etc) */
   .numbertext {
   color: #f2f2f2;
   font-size: 12px;
   padding: 8px 12px;
   position: absolute;
   top: 0;
   }
   /* The dots/bullets/indicators */
   .dot {
   cursor: pointer;
   height: 15px;
   width: 15px;
   margin: 0 2px;
   background-color: #bbb;
   border-radius: 50%;
   display: inline-block;
   transition: background-color 0.6s ease;
   }
   .actives, .dot:hover {
   background-color: #717171;
   }
   /* Fading animation */
   .fade {
   animation-name: fade;
   animation-duration: 1.5s;
   }
   @keyframes fade {
   from {opacity: .4} 
   to {opacity: 1}
   }
   /* On smaller screens, decrease text size */
   @media only screen and (max-width: 300px) {
   .prev, .next,.text {font-size: 11px}
   }
</style>

<div x-data="form">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{route('product_list')}}" class="text-primary hover:underline">Product List</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Product Detail</span>
        </li>
    </ul>
</div>
<br>

<!-- Review code Date 21-12-2024 -->

@php

 $productReview = Review::where('product_id','=',$productDetail->id)->where('status','=','Accept')->get();
 
 $productReviewAvg = Review::where('product_id','=',$productDetail->id)->where('status','=','Accept')->avg('review_rating');
	       
 $productReviewStar = number_format($productReviewAvg,1);
  

@endphp

<!-- Review code Date 21-12-2024 -->

<div x-data="form">
   <div class="panel">
   
      <div class="animate__animated p-6" :class="[$store.app.animation]">
         <!-- start main content section -->
         <div>
            <div class="gap-10 lg:flex">
			       @php
					$productImg = json_decode($productDetail->product_image ,true);
					
					$totalImg=0;
					
					if(!empty($productImg)){
						
					$totalImg=count($productImg);
					}
					$img_i=1;
					
				    @endphp
					
               <div class="mx-auto sm:w-1/2 lg:w-1/3">
                  <div class="slideshow-container">
				     @foreach($productImg as $image)
                     <div class="mySlides fade">
                        <div class="numbertext">{{$img_i++}} / {{$totalImg}}</div>
                        <img src="{{asset('public/uploads/product/product_image/'.$image)}}" alt="" style="width: 100%;height: 300px;">
					 </div>
                      @endforeach
                     <a class="prev" onclick="plusSlides(-1)">❮</a>
                     <a class="next" onclick="plusSlides(1)">❯</a>
                  </div>
                  <br>
                  <div style="text-align:center">
				  @for($slide_i=1; $slide_i<=$totalImg; $slide_i++)
                     <span class="dot" onclick="currentSlide({{$slide_i}})"></span> 
				 @endfor
                     
                  </div>
               </div>
			   
			   
               <div class="mt-10 lg:mt-0 lg:w-2/3">
                  <h2 class="mb-3 text-lg font-bold text-dark dark:text-white md:text-xl">{{$productDetail->product_name}}</h2>
                  <div class="flex flex-wrap gap-4">
                     @if(empty($productDetail->other_brand))
                     <div class="">Brand : <b>{{$productDetail->brand_name}}</b></div>
                     @elseif($productDetail->other_brand =="Brand")
                     <div class="">Brand : <b>{{$productDetail->brand_name}}</b></div>
                     @else
                     <div class="">Brand : <b>{{$productDetail->other_brand}}</b></div>
                     @endif
                     <div>|</div>
                     <div class="">Model No. : <b>{{$productDetail->model_number}}</b></div>
                     <div>|</div>
                     <div class="">Published : <b>{{ date('d M y', strtotime($productDetail->launch_date)) }}</b></div>
                  </div>
                  <div class="mt-6 flex gap-0.5">
                      
                    @for($i=1; $i < $productReviewStar; $i++)
                  
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffc107" class="h-4 w-4">
                        <path
                           stroke-linecap="round"
                           stroke-linejoin="round"
                           fill="#ffc107"
                           d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                           />
                     </svg>
                     
					 @endfor
                    
                     <div class="ltr:ml-2 rtl:mr-2">( <strong>{{$productReviewStar}}</strong> Customer Review )</div>
                  
                  </div>
                
                    <div class="my-4">
                     <!--<div class="mb-1 font-bold text-success">Price</div>-->
                     <span class="text-xl"><b>₹ {{$productDetail->price}} /- {{$productDetail->packaging_charges}}</b></span>
                    </div>
                  
                   <div class="flex flex-wrap gap-4">
                       
                    @if(!empty($productDetail->warranty_period))
				
					<div class="">Warranty : <b>{{ $productDetail->warranty_period }} Month /{{ $productDetail->product_guarantee_type }}/{{ $productDetail->only_spare_parts }}/{{ $productDetail->product_warranty_type }}</b></div>
					  
			     	@else
				  
				   <div class="">Warranty  : <b>No Guarantee</b></div>
				   
				  
			     	@endif
                         
                   </div>
                
                  <div class="grid gap-5 xl:grid-cols-2">
                     <div>
                        <h5 class="">
                          Master Packing  : <b>{{$productDetail->master_packing}}</b>
                          
                        </h5>
                        
                        <h5 class="">
                          Carton Packing  : <b>{{$productDetail->carton_packing}}</b>
                          
                        </h5>
                     </div>
                  </div>
				 
				  
				@if(!empty($productDetail->oem_description))
                 
                  <div class="mt-8">
                     <h5 class="mb-3 font-bold">OEM Description :</h5>
                     <p>
                        <p> {!! ucwords(nl2br(e(Str::words($productDetail->oem_description, '25')))) !!}</p>
                     </p>
                  </div>  
              
              <br>
            
                  <div class="grid gap-5 xl:grid-cols-2">
                     <div>
                        <h5 class="mb-3 font-bold">
                         Minimum Order For OEM  : {{$productDetail->minimum_order_quantity}}
                          
                        </h5>
                     </div>
                  </div>

                  @endif
                
                  <div class="mt-8">
                     <h5 class="mb-3 font-bold">Description :</h5>
                     <p>
                        {{$productDetail->product_description}}
                     </p>
                  </div>
				  <br>
				  <a href=""><button class="btn btn-primary"> <i class = "fas fa-shopping-cart"></i>Buy Now</button></a>
               </div>
			    
            </div>
            <div class="mt-8 grid gap-5 md:grid-cols-1">
               <div>
                  <h5 class="mb-3 font-bold">Warranty :{{$productDetail->warranty_period}}</h5>
                  <!-- <ul class="list-inside list-disc space-y-2">
                     <li><b>Product Guarantee Type</b> : Guarantee Warranty Period</li>
                     <li><b>Warranty Period</b> : 12Month</li>
                     <li><b>Product Warranty Type</b> : Home Service</li>
                     
                     </ul>-->
               </div>
            </div>
            <div class="mt-8">
               <h5 class="mb-3 font-bold">Product Description :</h5>
               <div class="mb-5" x-data="{ tab: 'specification'}">
                  <div>
                     <ul class="mt-3 mb-5 flex flex-wrap border-b border-white-light dark:border-[#191e3a]">
                        <li>
                           <a
                              href="javascript:"
                              class="relative -mb-[1px] flex items-center p-5 py-3 font-bold before:absolute before:bottom-0 before:left-0 before:right-0 before:m-auto before:h-[1px] before:w-0 before:bg-primary before:transition-all before:duration-700 hover:text-primary hover:before:w-full"
                              :class="{'before:w-full text-primary bg-primary/10' : tab === 'specification'}"
                              @click="tab='specification'"
                              >Full Description</a>
                        </li>
						
						<li>
                           <a
                              href="javascript:"
                              class="relative -mb-[1px] flex items-center p-5 py-3 font-bold before:absolute before:bottom-0 before:left-0 before:right-0 before:m-auto before:h-[1px] before:w-0 before:bg-primary before:transition-all before:duration-700 hover:text-primary hover:before:w-full"
                              :class="{'before:w-full text-primary bg-primary/10' : tab === 'oem'}"
                              @click="tab='oem'"
                              >OEM Description</a>
                        </li>
                        <li>
                           <a
                              href="javascript:"
                              class="relative -mb-[1px] flex items-center p-5 py-3 font-bold before:absolute before:bottom-0 before:left-0 before:right-0 before:m-auto before:h-[1px] before:w-0 before:bg-primary before:transition-all before:duration-700 hover:text-primary hover:before:w-full"
                              :class="{'before:w-full text-primary bg-primary/10' : tab === 'details'}"
                              @click="tab='details'"
                              >Review</a
                              >
                        </li>
                        <li>
                           <a
                              href="javascript:"
                              class="relative -mb-[1px] flex items-center p-5 py-3 font-bold before:absolute before:bottom-0 before:left-0 before:right-0 before:m-auto before:h-[1px] before:w-0 before:bg-primary before:transition-all before:duration-700 hover:text-primary hover:before:w-full"
                              :class="{'before:w-full text-primary bg-primary/10' : tab === 'video'}"
                              @click="tab='video'"
                              >Product Video</a
                              >
                        </li>
                     </ul>
                  </div>
                  <div class="flex-1 text-sm">
                     <template x-if="tab === 'specification'">
                        <div class="table-responsive mt-5 overflow-x-auto">
                           <h3 class="mb-3 text-lg font-bold md:text-xl">{{$productDetail->product_name}}</h3>
                           <p>
                              {{$productDetail->product_description}}
                           </p>
                           <br>
                           <table class="table table-dark mt-5" style="text-align:justify">
                              <tbody>
                                 <h4 class="font-semibold text-2xl mb-4">Gernal Info</h4>
                                 <!-- <tr>
                                    <th scope="row">Seller Name
                                    </th>
                                    <td>Mark</td>
                                    
                                    </tr>
                                    <tr>
                                    <th scope="row">Brand Name</th>
                                    <td>Jacob</td>
                                    
                                    </tr> -->
                                 <tr>
                                    <th scope="row">Product Name</th>
                                    <td>{{$productDetail->product_name}}</td>
                                 </tr>
                                	@php
				
									    $getCategoryName = Helper::getCategoryName($productDetail->category_id);
										 
									   if(!empty($getCategoryName->category_name)){
									    $categoryName = $getCategoryName->category_name;
										 }
										 else{
											 $categoryName =''; 
										 }
									@endphp
								
                                    <tr>
                                    <th scope="row">Category</th>
										<td>@if(!empty($categoryName))
											{{ ucwords($categoryName) }}
											@endif
												
										</td>
                                    </tr>
                                    
                                    @php 
									 
									 $getsubCategoryData = Helper::getSubcategoryName($productDetail->subcat_id);
								     if(!empty($getsubCategoryData->sub_category_name)){
									 $subCategoryName    = $getsubCategoryData->sub_category_name;
									 }else{
										 $subCategoryName ="";
										 
									 }
								     @endphp


									<tr>
										<th scope="row">Sub Category</th>
										    <td>
											   @if(!empty($subCategoryName))
											     {{ ucwords($subCategoryName) }}
											   @endif
											</td>
									</tr>
                                    
                                 <tr>
                                    <th scope="row">Model Number</th>
                                    <td>{{$productDetail->model_number}}</td>
                                 </tr>
                                 <tr>
                                    <th scope="row">Product Size</th>
                                    <td>{{$productDetail->product_size}}</td>
                                 </tr>
                                 
                                 @if(!empty($productDetail->oem_description))
                                 <tr>
                                    <th scope="row">Minimum Order Quantity
                                    </th>
                                    <td>{{$productDetail->minimum_order_quantity}}</td>
                                 </tr>
                                  @endif
                              </tbody>
                           </table>
                        </div>
                     </template>
					 
					<template x-if="tab === 'oem'">
                        <div>
                            <p>
                              {{ $productDetail->oem_description }}
                           </p>
                           
                        </div>
                     </template>
                    
					<template x-if="tab === 'details'">
					    
					 					   <div>
					   
					<!--    <div>
                           <div class="stars">
                              <p>Rating</p>
                              <i class="fa-solid fa-star active"></i>
                              <i class="fa-solid fa-star active"></i>
                              <i class="fa-solid fa-star "></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                           </div>
                           <br>
                           <form class="space-y-5">
                              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                 <div>
                                    <label for="gridPassword">Name</label>
                                    <input id="gridPassword" type="text" placeholder="Enter Name" class="form-input" />
                                 </div>
                                 <div>
                                    <label for="gridEmail">Email</label>
                                    <input id="gridEmail" type="email" placeholder="Enter Email" class="form-input" />
                                 </div>
                              </div>
                              <div>
                                 <label for="gridAddress1">Review Title</label>
                                 <input id="gridAddress1" type="text" placeholder="Review Title" class="form-input" />
                              </div>
                              <div>
                                 <label for="feedback">Feedback</label>
                                 <textarea id="feedback" class="form-input" placeholder="Your Feedback........." style="width: 100%;height: 104px;"></textarea>
                              </div>
                              <button type=" submit" class="btn btn-primary !mt-6">Submit</button>
                           </form>
                        </div>-->
					     <div class="flex items-center gap-4">
							 <img src="{{asset('public/uploads/product/product_photo/'.$productDetail->product_photo)}}" alt="" class="h-8 w-8 rounded-full" />
							 
					</div>	
			  	@foreach($productReview as $product_review)
				
				     @php
					 
					 $getSellerNameData  = Helper::getBuyerSellerData($product_review->buyer_seller_id);

                     $getSellerBuyerName = $getSellerNameData->first_name.' '.$getSellerNameData->last_name;
                     
                     $firstName = substr($getSellerNameData->first_name, 0, 2);
					 
                     $lastName = substr($getSellerNameData->last_name, 0, 2);
					 
					 $userName = ($firstName.'xxxxxx'.$lastName);
					 
					 @endphp
						<div class="mt-5 pt-5">
						  <div class="flex items-center gap-4">
							 <h6>{{$userName}}</h6>
						  </div>
						  <div class="my-4 flex items-center gap-4">
							 <div class="flex items-center gap-1 rounded bg-success py-1 px-2 text-white">
								<svg
								   xmlns="http://www.w3.org/2000/svg"
								   fill="none"
								   viewBox="0 0 24 24"
								   stroke-width="1.5"
								   stroke="#ffc107"
								   class="h-4 w-4"
								   >
								   <path
									  stroke-linecap="round"
									  stroke-linejoin="round"
									  fill="#ffc107"
									  d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
									  />
								</svg>
								<span>{{ $product_review->review_rating }}</span>
							 </div>
							
							{{-- <h6 class="text-base font-semibold">{{ $product_review->review_comment }}</h6> --}}
							 
							 <span class="text-base font-semibold">{{ $product_review->created_at->format('d M Y') }}</span>
						  </div>
						  <p class="text-base font-semibold">
                              {{ $product_review->review_comment }}
						  </p>
					   </div>
					   
					   @endforeach
					   
					  </div>   

					</template>

                     <template x-if="tab === 'video'">
                        <div>
                           <video
                              id="my-video"
                              class="video-js"
                              controls
                              preload="auto"
                              width="620"
                              height="364"
                              >
                              <source src="{{ asset('uploads/product/product_video/'.$productDetail->product_video) }}" />
                              <source src="MY_VIDEO.webm" type="video/webm" />
                              </p>
                           </video>
                        </div>
                     </template>
                  </div>
               </div>
            </div>
         </div>
         <!-- end main content section -->
      </div>
   </div>
</div>
@endsection
@push('script')
<script>
   let slideIndex = 1;
   showSlides(slideIndex);
   
   function plusSlides(n) {
     showSlides(slideIndex += n);
   }
   
   function currentSlide(n) {
     showSlides(slideIndex = n);
   }
   
   function showSlides(n) {
     let i;
     let slides = document.getElementsByClassName("mySlides");
     let dots = document.getElementsByClassName("dot");
     if (n > slides.length) {slideIndex = 1}    
     if (n < 1) {slideIndex = slides.length}
     for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
     }
     for (i = 0; i < dots.length; i++) {
       dots[i].className = dots[i].className.replace(" actives", "");
     }
     slides[slideIndex-1].style.display = "block";  
     dots[slideIndex-1].className += " actives";
   }
</script>
@endpush