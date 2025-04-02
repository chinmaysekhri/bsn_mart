@extends('admin.layouts.app')
@section('title','Edit Product') 
@section('content')

<div x-data="form">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{route('products.index')}}" class="text-primary hover:underline">Product</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit Product</span>
        </li>
    </ul>
</div>

<br>
<div class="mb-5 flex items-center justify-between">
    <h5 class="text-lg font-semibold dark:text-white-light"></h5>
</div>
<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
    <div class="panel" x-data="modal">
	
	  <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
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
			
		    {!! Form::model($product, ['method' => 'PATCH','route' => ['products.update', $product->id],'class'=>'space-y-5', 'enctype'=>'multipart/form-data']) !!}
			
			@csrf
			
			<!--29-10-2024 for hold value after serch next action date -->
		  
			@if(!empty($requested_input))

			@foreach($requested_input as $requested_input_key => $requested_input_val)
				<input type="hidden" name="req_{{$requested_input_key}}" value="{{$requested_input_val}}">
			@endforeach
			
			@endif
			
			<!--29-10-2024 for hold value after serch next action date End-->

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
			
			<div>
                    <label for="seller_id">Business Name</label>
                    <select class="form-input" id="seller_id" name="seller_id" onchange="getSellerData(this);" />
                        <option value="">--Business Name--</option>
                        @foreach($sellerData as $seller)
                        <option value="{{$seller->id}}" @if($product->seller_id == $seller->id) selected @endif>{{$seller->business_name}}-{{($seller->first_name.' '.$seller->mobile)}}</option>
                        
                       @endforeach
                    </select>
                    
                </div>
                 <div>
                    <label for="category_name">Select Category</label>
                    <select class="form-input" name="category_id" id="category_id" value="{{$product->category_id}}" onchange ="getSubcategoryData(this);">
                        
                        <option value="">-Select Category-</option>
                         @foreach($categoryData as $category)
                        <option value="{{$category->id}}" @if($product->category_id == $category->id) selected @endif>{{$category->category_name}}</option>
                        
                       @endforeach
                    </select>
                </div>
                
                 <div style="margin-top: 31px;">
                  <div class="search-date-group ms-5 d-flex align-items-center">
                     <select  class="form-select text-white-dark"  id="subcategory_name"  name="subcat_id" style="width:354px;" value="{{$product->subcat_id}}" required/>
                        <option value="">Sub Category</option>
						
					   @foreach($subCategoryData as $subCategory)
                        <option value="{{$subCategory->id}}" @if($product->subcat_id == $subCategory->id) selected @endif>{{$subCategory->sub_category_name}}</option>
                        
                       @endforeach
                       
                     </select>
                  </div>
                  <button type="button" class="text-primary hover:underline" @click="toggle">Create a new sub category(if sub category not found)</button>
                 </div>
                <div>
                    <label for="created_date">Created Date</label>
					 {!! Form::date('created_date', date('Y-m-d'), array('placeholder' => 'Date Of Enrollment','class' => 'form-input','id'=>'inputdate')) !!}
                </div>
				
            <?php /*    <div>
                    <label for="seller_id">Business Name</label>
                    <select class="form-input" id="seller_id" name="seller_id" onchange="getSellerData(this);" />
                        <option value="">--Business Name--</option>
					    @foreach($sellerData as $seller)
                        <option value="{{$seller->id}}" @if($product->seller_id == $seller->id) selected @endif>{{$seller->business_name}}-{{($seller->first_name.' '.$seller->mobile)}}</option>
						
                       @endforeach
                    </select>
                    
                </div> */ ?>
                <div>
                    <label for="brand_name">Brand Name</label>
					
					 <input id="brand_name" type="text" name="brand_name" placeholder="Brand Name" class="form-input" value="{{$product->brand_name}}" readonly />
					 
					 <div class="flex justify-around pt-5">
						<!--<label for="name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Gender :</label>-->
						<label class="inline-flex cursor-pointer">Non Brand</label>
						<!--<input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="other_brand" @if($product->other_brand == "Non Brand") checked @endif value="Non Brand"/>-->
						<input class="toggles form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="other_brand" id="enabled_true" @if($product->other_brand == "Non Brand") checked @endif value="Non Brand"/>
							
						<label class="inline-flex cursor-pointer">Third Party Sourcing</label>
						<!--<input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="other_brand" @if($product->other_brand == "Third Party Manufacturer") checked @endif value="Third Party Manufacturer"/>-->
						<input class="toggles form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="other_brand" id="enabled_false" @if($product->other_brand == "Third Party Sourcing") checked @endif value="Third Party Sourcing"/>
						
					  </div>
                </div>
				
                <div>
                    <label for="product_name">Product Name</label>
                    <input id="product_name" type="text" name="product_name" placeholder="Enter Product Name" class="form-input" value="{{$product->product_name}}">
                </div>
                <div>
                    <label for="launch_date">Launch Date</label>
                    <input id="launch_date" type="date" name="launch_date" placeholder="Launch Date" class="form-input" value="{{$product->launch_date}}" />
                </div>
            </div>
			
       <?php   /*  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
		   
                <div>
                    <label for="category_name">Select Category</label>
					<select class="form-input" name="category_id" id="category_id" value="{{$product->category_id}}" onchange="getSubcategoryData(this);">
                        
						<option value="">-Select Category-</option>
						 @foreach($categoryData as $category)
                        <option value="{{$category->id}}" @if($product->category_id == $category->id) selected @endif>{{$category->category_name}}</option>
						
                       @endforeach
                    </select>
                </div>
				
				 <div style="margin-top: 31px;">
                  <div class="search-date-group ms-5 d-flex align-items-center">
                     <select  class="form-select text-white-dark"  id="subcategory_name"  name="subcat_id" style="width:354px;" value="{{$product->subcat_id}}" />
                        <option value="">Sub Category</option>
                       
                     </select>
                  </div>
				  <button type="button" class="text-primary hover:underline" @click="toggle">Create a new sub category(if sub category not found)</button>
                 </div>
			   
            </div> */ ?>
			
			<!--  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  
        <div>
                    <label for="product_status">Product Type</label>
                    <select class="form-input" name="product_type" id="product_type" required />
                        <option value="">-Select Product Type-</option>
            <option value="Spare Parts" @if($product->product_type == "Spare Parts") selected @endif >Spare Parts</option>
            <option value="Finished Good" @if($product->product_type == "Finished Good") selected @endif >Finished Good</option>
                       
                    </select>
                </div>
                <div>
                    <label for="used_in">Used In</label>
                    <input id="used_in" type="text" name="used_in" value="{{$product->used_in}}" placeholder="Enter Product Used In" class="form-input" required />
                </div>    
            </div> -->
             <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                 
         
                  <div>
                    <label for="product_status">Product Type</label>
                    <select class="form-input" name="product_type" id="product_type"  onchange="change_status_product_type();"required />
                        <option value="">-Select Product Type-</option>
            <option value="Spare Parts" @if($product->product_type == "Spare Parts") selected @endif >Spare Parts</option>
            <option value="Finished Good" @if($product->product_type == "Finished Good") selected @endif >Finished Good</option>
                        
                    </select>
                </div>
                <div class="" id="finished_good_hide" style="display: none;">
                    <label for="used_in">Used In</label>
                    <input id="used_in" type="text" name="used_in" value="{{$product->used_in}}" placeholder="Enter Product Used In" class="form-input"/>
                </div>  
        
        
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="model_number">Model Number</label>
                    <input id="model_number" type="text" name="model_number" value="{{$product->model_number}}" placeholder="Model Number" class="form-input"/>
                </div>
				
                <div>
                    <label for="master_packing">Master Packing</label>
                    <input id="master_packing" type="number" name="master_packing" value="{{$product->master_packing}}" placeholder="Master Packing" class="form-input" required/>
                </div>
                
               	<div>
                    <label for="carton_packing">Carton Packing</label>
					 <input id="carton_packing" type="number" name="carton_packing" value="{{$product->carton_packing}}" placeholder="Carton Packing" class="form-input" required/>
                </div> 
                
            </div>
			
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
           
		   	  <div>
                 <label for="product_photo">Update Product Photo</label>
                 {!! Form::file('product_photo', array('placeholder' => 'Update Product Photo','class' => 'form-input','id'=>'product_photo')) !!}
               
				<a href="{{URL::asset('uploads/product/product_photo/'.$product->product_photo)}}" target="_blank"><img class= "img-responsive" style=" height:50px;width:80px;margin-top: 20px; display: inline-flex" alt="" src="{{URL::asset('uploads/product/product_photo/'.$product->product_photo)}}"></a>
				
              </div>
		   
				@php

                 $productImg= json_decode($product->product_image, true);

                @endphp
			   <div>
				<label for="product_image">Product Variant Image(Select min four images)</label>
			
				
				<input type="file" id="product_image" class="form-input" name="product_image[]" value="{{$product->product_image}}" multiple >
				
				
				@foreach($productImg as $product_img)
				
				<a href="{{URL::asset('uploads/product/product_image/')}}/{{$product_img}}" target="_blank"><img class= "img-responsive" style=" height:50px;width:80px;margin-top: 20px; display: inline-flex" alt="" src="{{URL::asset('uploads/product/product_image/')}}/{{$product_img}}"></a>
				
				@endforeach
				
			   </div>
			   
              <div>
               <label for="product_video">Product Video</label>
               {!! Form::file('product_video', array('placeholder' => 'Select Product Video','class' => 'form-input','id'=>'product_video')) !!}
			  
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
              
              </div>
				
				
            </div>
			
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                                
                <div>
                    <label for="seller_price">Seller Price</label>
                    <input id="seller_price" type="number" name="seller_price" step="0.01" value="{{$product->seller_price}}" placeholder="Enter Seller Price" class="form-input"/>
                </div>
                
                <div>
                    <label for="price">Customer Price</label>
                    <input id="price" type="number" name="price" step="0.01" value="{{$product->price}}" placeholder="Enter Product Price" class="form-input" />
                </div>
                
                
                <div>
                    <label for="packaging_charges">Packaging Charges</label>
                    <select class="form-input" name="packaging_charges" id="packaging_charges" required />
                    <option value="">Select Packaging Charges</option>
                    <option value="Including Packaging" @if($product->packaging_charges == "Including Packaging") selected @endif >Including Packaging</option>
                    <option value="Exculding Packaging" @if($product->packaging_charges == "Exculding Packaging") selected @endif >Exculding Packaging</option>
                        
                    </select>
                </div>
				
			    <div>
                   <label for="subcategory_name">Select Product Dont Show Price</label>
                    <select  class="form-input" name="dont_show_price" id="dont_show_price" required>
                        <option value="">Select Product Dont Show Price</option>
                        <option value="Yes" @if($product->dont_show_price == "Yes") selected @endif >Yes</option>
                        <option value="No"  @if($product->dont_show_price == "No") selected @endif >No</option>
                    </select>
                </div>
				
				
                <div>
                    <label for="discount">Discount</label>
                    <input id="discount" type="number" name="discount" value="{{$product->discount}}" placeholder="Enter Product Discount" class="form-input"/>
                </div>
            </div>
			
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                    <label for="minimum_order_quantity">Minimum Order Quantity</label>
                    <input id="minimum_order_quantity" type="number" name="minimum_order_quantity" placeholder="Minimum Order Quantity" value="{{$product->minimum_order_quantity}}" class="form-input" />
                </div>
				
			<div>
			
              Available For OEM : <input type="checkbox" id="available_for_oem" name="available_for_oem" id="available_for_oem" value="@if($product->available_for_oem == "Yes") checked @endif"  onclick="availableForOem();" />
			  
              {{--Available For OEM : <input type="checkbox" id="available_for_oem" name="available_for_oem" id="available_for_oem" onclick="availableForOem();" value="@if($product->available_for_oem == "Yes") checked @endif">--}}
         
		       
		 
			</div>
			
			 <div id="hidden_field">
                    <label for="oem_description">OEM Description</label>
                    <input id="oem_description" type="text" name="oem_description" placeholder="OEM Description" value="{{$product->oem_description}}" class="form-input" />
              </div>
			
            <div id="hidden_fields">
              <label for="minimum_order_quantity">Minimum Order Quantity For OEM</label>
              <input id="minimum_order_quantity" type="number" name="minimum_order_quantity" value="{{$product->minimum_order_quantity}}" placeholder="Minimum Order Quantity For OEM" class="form-input" />
            </div>
				
                <div>
                    <label for="stock_available">Stock Avilable</label>
                    <input id="stock_available" type="number" name="stock_available" value="{{$product->stock_available}}" placeholder="Stock Avilable" class="form-input" />
                </div>
            </div>
        
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                
				<div class="label-position">
                    <label for="product_tag">Product Tag</label>
                    <input id="product_tag" type="text" name="product_tag" value="{{$product->product_tag}}" placeholder="Product Tag" class="form-input h-40 label-position"/>
                </div>
				
                <div>
                    <label for="product_description" class="text-start">Product Description</label>
                    <input id="product_description" type="text" name="product_description" value="{{$product->product_description}}" placeholder="Product Disription" class="form-input h-40 text-start" />
                </div>
                <div>
                    <label for="product_status">Product Status</label>
                    <select class="form-input" name="product_status" id="product_status" required />
                        <option value="">--Select Product Status--</option>
						<option value="Active" @if($product->product_status == "Active") selected @endif >Active</option>
						<option value="On Hold" @if($product->product_status == "On Hold") selected @endif >On Hold</option>
						<option value="Out Of Stock" @if($product->product_status == "Out Of Stock") selected @endif >Out Of Stock</option>
                    </select>
                </div>
                <div>
                    <label for="product_size">Product Size</label>
                    <input id="product_size" type="text" name="product_size" value="{{$product->product_size}}" placeholder="Enter Product Size" class="form-input" required />
                </div>
            </div>
			
			
						
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
               <div id="payment_info_hide" style="display: none;">
                    <label for="product_guarantee_type">Select Product Guarantee Type</label>
                    <select class="form-input" name="product_guarantee_type" id="Productguaranteetype" onchange="change_status_product();" required />
                    <option value="">Select Product Guarantee Type</option>
                    <option value="Guarantee" @if($product->product_guarantee_type == "Guarantee") selected @endif >Guarantee</option>
					<option value="Warranty" @if($product->product_guarantee_type == "Warranty") selected @endif >Warranty</option>
					<option value="No Guarantee & Warranty" @if($product->product_guarantee_type == "No Guarantee & Warranty") selected @endif >No Guarantee & Warranty</option>
                    <option value="Only Spare Parts" @if($product->product_guarantee_type == "Only Spare Parts") selected @endif >Only Spare Parts</option>
                    </select>
                </div>
        
                <div class="d-flex" id="payment_info" style="display: none;">
                    <div class="w-50">
                        <label for="warranty_period">Guarantee/Warranty Period</label>
                        <input id="warranty_period" type="number" name="warranty_period" value="{{$product->warranty_period}}" placeholder="Warranty Period" class="form-input" />
                    </div>
                </div>
                
                <div class="d-flex" id="spare_part_info" style="display: none;">
                    <div class="w-50">
                        <label for="only_spare_parts">Only Spare Parts</label>
                        <input id="only_spare_parts" type="text" name="only_spare_parts" value="{{$product->only_spare_parts}}" placeholder="Only Spare Parts" class="form-input" />
                    </div>
                </div>
                
            </div>
           
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
			
				<div>
				   <label for="gridPassword">Select Product Warranty Type</label>
				   <select class="form-input" name="product_warranty_type" required />
					  <option value="">Product Warranty Type</option>
						<option value="Home Service" @if($product->product_warranty_type == "Home Service") selected @endif >Home Service</option>					
						<option value="Full Replacement" @if($product->product_warranty_type == "Full Replacement") selected @endif >Full Replacement</option>					
						<option value="Repair & Return At NoCost" @if($product->product_warranty_type == "Repair & Return At NoCost") selected @endif >Repair & Return At NoCost</option>	
						
						<option value="Repair & Return At Repairing Cost" @if($product->product_warranty_type == "Repair & Return At Repairing Cost") selected @endif >Repair & Return At Repairing Cost</option>
						
						<option value="Spare Parts Available" @if($product->product_warranty_type == "Spare Parts Available") selected @endif >Spare Parts Available</option>	
						<option value="No Replacement" @if($product->product_warranty_type == "No Replacement") selected @endif >No Replacement</option>
						               
				   </select>
				  
				</div>
				
			@php
			
			$district_data=json_decode($product->black_listed_district ,true);
			
			  if(empty($district_data)){
				
				$district_data=[];
			}
			@endphp
                 <div>
                    <label for="gridPassword">Black Listed District</label>
                      <select class="form-input" id="choices-multiple-remove-button"  placeholder="Select Black Listed District" multiple name="black_listed_district[]" id="black_listed_district" />
                       <option value="ALLURI SITHARAMA RAJU" @if(in_array("ALLURI SITHARAMA RAJU", $district_data)) selected @endif>ALLURI SITHARAMA RAJU</option>
                        <option value="ANAKAPALLI" @if(in_array("ANAKAPALLI", $district_data)) selected @endif>ANAKAPALLI</option>
                        <option value="ANANTHAPURAMU" @if(in_array("ANANTHAPURAMU", $district_data)) selected @endif>ANANTHAPURAMU</option>
                        <option value="ANNAMAYYA" @if(in_array("ANNAMAYYA", $district_data)) selected @endif>ANNAMAYYA</option>
                        <option value="BAPATLA" @if(in_array("BAPATLA", $district_data)) selected @endif>BAPATLA</option>
                        <option value="CHITTOOR" @if(in_array("CHITTOOR", $district_data)) selected @endif>CHITTOOR</option>
                        <option value="Dr.B.R.AMBEDKAR KONASEEMA" @if(in_array("Dr.B.R.AMBEDKAR KONASEEMA", $district_data)) selected @endif>Dr.B.R.AMBEDKAR KONASEEMA</option>
                        <option value="EAST GODAVARI" @if(in_array("EAST GODAVARI", $district_data)) selected @endif>EAST GODAVARI</option>
                        <option value="ELURU" @if(in_array("ELURU", $district_data)) selected @endif>ELURU</option>
                        <option value="GUNTUR" @if(in_array("GUNTUR", $district_data)) selected @endif>GUNTUR</option>
                        <option value="KAKINADA" @if(in_array("KAKINADA", $district_data)) selected @endif>KAKINADA</option>
                        <option value="KRISHNA" @if(in_array("KRISHNA", $district_data)) selected @endif>KRISHNA</option>
                        <option value="KURNOOL" @if(in_array("KURNOOL", $district_data)) selected @endif>KURNOOL</option>
                        <option value="NANDYAL" @if(in_array("NANDYAL", $district_data)) selected @endif>NANDYAL</option>
                        <option value="NELLORE" @if(in_array("NELLORE", $district_data)) selected @endif>NELLORE</option>
                        <option value="NTR" @if(in_array("NTR", $district_data)) selected @endif>NTR</option>
                        <option value="PALNADU" @if(in_array("PALNADU", $district_data)) selected @endif>PALNADU</option>
                        <option value="PARVATHIPURAM MANYAM" @if(in_array("PARVATHIPURAM MANYAM", $district_data)) selected @endif>PARVATHIPURAM MANYAM</option>
                        <option value="PRAKASAM" @if(in_array("PRAKASAM", $district_data)) selected @endif>PRAKASAM</option>
                        <option value="SRIKAKULAM" @if(in_array("SRIKAKULAM", $district_data)) selected @endif>SRIKAKULAM</option>
                        <option value="SATHYA SAI" @if(in_array("SATHYA SAI", $district_data)) selected @endif>SATHYA SAI</option>
                        <option value="TIRUPATI" @if(in_array("TIRUPATI", $district_data)) selected @endif>TIRUPATI</option>
                        <option value="VISAKHAPATNAM" @if(in_array("VISAKHAPATNAM", $district_data)) selected @endif>VISAKHAPATNAM</option>
                        <option value="VIZIANAGARAM" @if(in_array("VIZIANAGARAM", $district_data)) selected @endif>VIZIANAGARAM</option>
                        <option value="WEST GODAVARI" @if(in_array("WEST GODAVARI", $district_data)) selected @endif>WEST GODAVARI</option>
                        <option value="YSR KADAPA" @if(in_array("YSR KADAPA", $district_data)) selected @endif>YSR KADAPA</option>
                        <option value="ANJAW" @if(in_array("ANJAW", $district_data)) selected @endif>ANJAW</option>
                        <option value="CHANGLANG" @if(in_array("CHANGLANG", $district_data)) selected @endif>CHANGLANG</option>
                        <option value="EAST KAMENG" @if(in_array("EAST KAMENG", $district_data)) selected @endif>EAST KAMENG</option>
                        <option value="EAST SIANG" @if(in_array("EAST SIANG", $district_data)) selected @endif>EAST SIANG</option>
                        <option value="ITANAGAR CAPITAL COMPLEX" @if(in_array("ITANAGAR CAPITAL COMPLEX", $district_data)) selected @endif>ITANAGAR CAPITAL COMPLEX</option>
                        <option value="KAMLE" @if(in_array("KAMLE", $district_data)) selected @endif>KAMLE</option>
                        <option value="KRA DAADI" @if(in_array("KRA DAADI", $district_data)) selected @endif>KRA DAADI</option>
                        <option value="KURUNG KUMEY KURUNG" @if(in_array("KURUNG KUMEY KURUNG", $district_data)) selected @endif>KURUNG KUMEY KURUNG</option>
                        <option value="LEPA RADA" @if(in_array("LEPA RADA", $district_data)) selected @endif>LEPA RADA</option>
                        <option value="LOHIT" @if(in_array("LOHIT", $district_data)) selected @endif>LOHIT</option>
                        <option value="LONGDING" @if(in_array("LONGDING", $district_data)) selected @endif>LONGDING</option>
                        <option value="LOWER DIBANG VALLEY" @if(in_array("LOWER DIBANG VALLEY", $district_data)) selected @endif>LOWER DIBANG VALLEY</option>
                        <option value="LOWER SIANG" @if(in_array("LOWER SIANG", $district_data)) selected @endif>LOWER SIANG</option>
                        <option value="LOWER SUBANSIRI" @if(in_array("LOWER SUBANSIRI", $district_data)) selected @endif>LOWER SUBANSIRI</option>
                        <option value="NAMSAI" @if(in_array("NAMSAI", $district_data)) selected @endif>NAMSAI</option>
                        <option value="PAKKE-KESSANG" @if(in_array("PAKKE-KESSANG", $district_data)) selected @endif>PAKKE-KESSANG</option>
                        <option value="PAPUM PARE" @if(in_array("PAPUM PARE", $district_data)) selected @endif>PAPUM PARE</option>
                        <option value="SHI YOMI" @if(in_array("SHI YOMI", $district_data)) selected @endif>SHI YOMI</option>
                        <option value="SIANG" @if(in_array("SIANG", $district_data)) selected @endif>SIANG</option>
                        <option value="TAWANG" @if(in_array("TAWANG", $district_data)) selected @endif>TAWANG</option>
                        <option value="TIRAP" @if(in_array("TIRAP", $district_data)) selected @endif>TIRAP</option>
                        <option value="UPPER DIBANG VALLEY" @if(in_array("UPPER DIBANG VALLEY", $district_data)) selected @endif>UPPER DIBANG VALLEY</option>
                        <option value="UPPER SIANG" @if(in_array("UPPER SIANG", $district_data)) selected @endif>UPPER SIANG</option>
                        <option value="UPPER SUBANSIRI" @if(in_array("UPPER SUBANSIRI", $district_data)) selected @endif>UPPER SUBANSIRI</option>
                        <option value="WEST KAMENG" @if(in_array("WEST KAMENG", $district_data)) selected @endif>WEST KAMENG</option>
                        <option value="WEST SIANG" @if(in_array("WEST SIANG", $district_data)) selected @endif>WEST SIANG</option>
                        <option value="BAKSA" @if(in_array("BAKSA", $district_data)) selected @endif>BAKSA</option>
                        <option value="BARPETA" @if(in_array("BARPETA", $district_data)) selected @endif>BARPETA</option>
                        <option value="BONGAIGAON" @if(in_array("BONGAIGAON", $district_data)) selected @endif>BONGAIGAON</option>
                        <option value="CACHAR" @if(in_array("CACHAR", $district_data)) selected @endif>CACHAR</option>
                        <option value="CHARAIDEO" @if(in_array("CHARAIDEO", $district_data)) selected @endif>CHARAIDEO</option>
                        <option value="CHIRANG" @if(in_array("CHIRANG", $district_data)) selected @endif>CHIRANG</option>
                        <option value="DARRANGA" @if(in_array("DARRANGA", $district_data)) selected @endif>DARRANGA</option>
                        <option value="DHEMAJI" @if(in_array("DHEMAJI", $district_data)) selected @endif>DHEMAJI</option>
                        <option value="DHUBRI" @if(in_array("DHUBRI", $district_data)) selected @endif>DHUBRI</option>
                        <option value="DIBRUGARH" @if(in_array("DIBRUGARH", $district_data)) selected @endif>DIBRUGARH</option>
                        <option value="DIMA HASAO" @if(in_array("DIMA HASAO", $district_data)) selected @endif>DIMA HASAO</option>
                        <option value="GOALPARA" @if(in_array("GOALPARA", $district_data)) selected @endif>GOALPARA</option>
                        <option value="GOLAGHAT" @if(in_array("GOLAGHAT", $district_data)) selected @endif>GOLAGHAT</option>
                        <option value="HAILAKANDI" @if(in_array("HAILAKANDI", $district_data)) selected @endif>HAILAKANDI</option>
                        <option value="JORHAT" @if(in_array("JORHAT", $district_data)) selected @endif>JORHAT</option>
                        <option value="KAMRUP" @if(in_array("KAMRUP", $district_data)) selected @endif>KAMRUP</option>
                        <option value="KAMRUP METROPOLITAN" @if(in_array("KAMRUP METROPOLITAN", $district_data)) selected @endif>KAMRUP METROPOLITAN</option>
                        <option value="KARBI ANGLONG" @if(in_array("KARBI ANGLONG", $district_data)) selected @endif>KARBI ANGLONG</option>
                        <option value="KARIMGANJ" @if(in_array("KARIMGANJ", $district_data)) selected @endif>KARIMGANJ</option>
                        <option value="KOKRAJHAR" @if(in_array("KOKRAJHAR", $district_data)) selected @endif>KOKRAJHAR</option>
                        <option value="LAKHIMPUR" @if(in_array("LAKHIMPUR", $district_data)) selected @endif>LAKHIMPUR</option>
                        <option value="MAJULI" @if(in_array("MAJULI", $district_data)) selected @endif>MAJULI</option>
                        <option value="MORIGAON" @if(in_array("MORIGAON", $district_data)) selected @endif>MORIGAON</option>
                        <option value="NAGAON" @if(in_array("NAGAON", $district_data)) selected @endif>NAGAON</option>
                        <option value="NALBARI" @if(in_array("NALBARI", $district_data)) selected @endif>NALBARI</option>
                        <option value="SIVASAGAR" @if(in_array("SIVASAGAR", $district_data)) selected @endif>SIVASAGAR</option>
                        <option value="SONITPUR" @if(in_array("SONITPUR", $district_data)) selected @endif>SONITPUR</option>
                        <option value="SOUTH SALMARA-MANKACHAR" @if(in_array("SOUTH SALMARA-MANKACHAR", $district_data)) selected @endif>SOUTH SALMARA-MANKACHAR</option>
                        <option value="TINSUKIA" @if(in_array("TINSUKIA", $district_data)) selected @endif>TINSUKIA</option>
                        <option value="UDALGURI" @if(in_array("UDALGURI", $district_data)) selected @endif>UDALGURI</option> 
                        <option value="WEST KARBI ANGLONG" @if(in_array("WEST KARBI ANGLONG", $district_data)) selected @endif>WEST KARBI ANGLONG</option>
                        <option value="ARARIA" @if(in_array("ARARIA", $district_data)) selected @endif>ARARIA</option>
                        <option value="ARWAL" @if(in_array("ARWAL", $district_data)) selected @endif>ARWAL</option> 
                        <option value="AURANGABAD" @if(in_array("AURANGABAD", $district_data)) selected @endif>AURANGABAD</option>
                        <option value="BANKA" @if(in_array("BANKA", $district_data)) selected @endif>BANKA</option>
                        <option value="BEGUSARAI" @if(in_array("BEGUSARAI", $district_data)) selected @endif>BEGUSARAI</option>
                        <option value="BHAGALPUR" @if(in_array("BHAGALPUR", $district_data)) selected @endif>BHAGALPUR</option>
                        <option value="BHOJPUR" @if(in_array("BHOJPUR", $district_data)) selected @endif>BHOJPUR</option>
                        <option value="BUXAR" @if(in_array("BUXAR", $district_data)) selected @endif>BUXAR</option>
                        <option value="DARBHANGA" @if(in_array("DARBHANGA", $district_data)) selected @endif>DARBHANGA</option>
                        <option value="GAYA" @if(in_array("GAYA", $district_data)) selected @endif>GAYA</option>
                        <option value="GOPALGANJ" @if(in_array("GOPALGANJ", $district_data)) selected @endif>GOPALGANJ</option>
                        <option value="JAMUI" @if(in_array("JAMUI", $district_data)) selected @endif>JAMUI</option>
                        <option value="JEHANABAD" @if(in_array("JEHANABAD", $district_data)) selected @endif>JEHANABAD</option>
                        <option value="KAIMUR (BHABUA)" @if(in_array("KAIMUR (BHABUA)", $district_data)) selected @endif>KAIMUR (BHABUA)</option>
                        <option value="KATIHAR" @if(in_array("KATIHAR", $district_data)) selected @endif>KATIHAR</option>
                        <option value="KHAGARIA" @if(in_array("KHAGARIA", $district_data)) selected @endif>KHAGARIA</option>
                        <option value="KISHANGANJ" @if(in_array("KISHANGANJ", $district_data)) selected @endif>KISHANGANJ</option>
                        <option value="LAKHISARAI" @if(in_array("LAKHISARAI", $district_data)) selected @endif>LAKHISARAI</option>
                        <option value="MADHEPURA" @if(in_array("MADHEPURA", $district_data)) selected @endif>MADHEPURA</option>
                        <option value="MADHUBANI" @if(in_array("MADHUBANI", $district_data)) selected @endif>MADHUBANI</option>
                        <option value="MUNGER" @if(in_array("MUNGER", $district_data)) selected @endif>MUNGER</option>
                        <option value="MUZAFFARPUR" @if(in_array("MUZAFFARPUR", $district_data)) selected @endif>MUZAFFARPUR</option>
                        <option value="NALANDA" @if(in_array("NALANDA", $district_data)) selected @endif>NALANDA</option>
                        <option value="NAWADA" @if(in_array("NAWADA", $district_data)) selected @endif>NAWADA</option>
                        <option value="PASHCHIM CHAMPARAN" @if(in_array("PASHCHIM CHAMPARAN", $district_data)) selected @endif>PASHCHIM CHAMPARAN</option>
                        <option value="PATNA" @if(in_array("PATNA", $district_data)) selected @endif>PATNA</option>
                        <option value="PURBI CHAMPARAN" @if(in_array("PURBI CHAMPARAN", $district_data)) selected @endif>PURBI CHAMPARAN</option>
                        <option value="PURNIA" @if(in_array("PURNIA", $district_data)) selected @endif>PURNIA</option>
                        <option value="ROHTAS" @if(in_array("ROHTAS", $district_data)) selected @endif>ROHTAS</option>
                        <option value="SAHARSA" @if(in_array("SAHARSA", $district_data)) selected @endif>SAHARSA</option>
                        <option value="SAMASTIPUR" @if(in_array("SAMASTIPUR", $district_data)) selected @endif>SAMASTIPUR</option>
                        <option value="SARAN" @if(in_array("SARAN", $district_data)) selected @endif>SARAN</option>
                        <option value="SHEIKHPURA" @if(in_array("SHEIKHPURA", $district_data)) selected @endif>SHEIKHPURA</option>
                        <option value="SHEOHAR" @if(in_array("SHEOHAR", $district_data)) selected @endif>SHEOHAR</option>
                        <option value="SITAMARHI" @if(in_array("SITAMARHI", $district_data)) selected @endif>SITAMARHI</option>
                        <option value="SIWAN" @if(in_array("SIWAN", $district_data)) selected @endif>SIWAN</option>
                        <option value="SUPAUL" @if(in_array("SUPAUL", $district_data)) selected @endif>SUPAUL</option>
                        <option value="VAISHALI" @if(in_array("VAISHALI", $district_data)) selected @endif>VAISHALI</option>
                        <option value="BALOD" @if(in_array("BALOD", $district_data)) selected @endif>BALOD</option>
                        <option value="BALODA BAZAR" @if(in_array("BALODA BAZAR", $district_data)) selected @endif>BALODA BAZAR</option>
                        <option value="BALRAMPUR" @if(in_array("BALRAMPUR", $district_data)) selected @endif>BALRAMPUR</option>
                        <option value="BASTAR" @if(in_array("BASTAR", $district_data)) selected @endif>BASTAR</option>
                        <option value="BEMETARA" @if(in_array("BEMETARA", $district_data)) selected @endif>BEMETARA</option>
                        <option value="BIJAPUR" @if(in_array("BIJAPUR", $district_data)) selected @endif>BIJAPUR</option>
                        <option value="BILASPUR" @if(in_array("BILASPUR", $district_data)) selected @endif>BILASPUR</option>
                        <option value="DANTEWADA" @if(in_array("DANTEWADA", $district_data)) selected @endif>DANTEWADA</option>
                        <option value="DHAMTARI" @if(in_array("DHAMTARI", $district_data)) selected @endif>DHAMTARI</option>
                        <option value="DURG" @if(in_array("DURG", $district_data)) selected @endif>DURG</option>
                        <option value="GARIYABAND" @if(in_array("GARIYABAND", $district_data)) selected @endif>GARIYABAND</option>
                        <option value="GAURELLA PENDRA MARWAHI" @if(in_array("GAURELLA PENDRA MARWAHI", $district_data)) selected @endif>GAURELLA PENDRA MARWAHI</option>
                        <option value="JANJGIR-CHAMPA" @if(in_array("JANJGIR-CHAMPA", $district_data)) selected @endif>JANJGIR-CHAMPA</option>
                        <option value="JASHPUR" @if(in_array("JASHPUR", $district_data)) selected @endif>JASHPUR</option>
                        <option value="KABIRDHAM" @if(in_array("KABIRDHAM", $district_data)) selected @endif>KABIRDHAM</option>
                        <option value="KANKER" @if(in_array("KANKER", $district_data)) selected @endif>KANKER</option>
                        <option value="KONDAGAON" @if(in_array("KONDAGAON", $district_data)) selected @endif>KONDAGAON</option>
                        <option value="KORBA" @if(in_array("KORBA", $district_data)) selected @endif>KORBA</option>
                        <option value="KOREA" @if(in_array("KOREA", $district_data)) selected @endif>KOREA</option>
                        <option value="MAHASAMUND" @if(in_array("MAHASAMUND", $district_data)) selected @endif>MAHASAMUND</option>
                        <option value="MUNGELI" @if(in_array("MUNGELI", $district_data)) selected @endif>MUNGELI</option>
                        <option value="NARAYANPUR" @if(in_array("NARAYANPUR", $district_data)) selected @endif>NARAYANPUR</option>
                        <option value="RAIGARH" @if(in_array("RAIGARH", $district_data)) selected @endif>RAIGARH</option>
                        <option value="RAIPUR" @if(in_array("RAIPUR", $district_data)) selected @endif>RAIPUR</option>
                        <option value="RAJNANDGAON" @if(in_array("RAJNANDGAON", $district_data)) selected @endif>RAJNANDGAON</option>
                        <option value="SUKMA" @if(in_array("SUKMA", $district_data)) selected @endif>SUKMA</option>
                        <option value="SURAJPUR" @if(in_array("SURAJPUR", $district_data)) selected @endif>SURAJPUR</option>
                        <option value="SURGUJA" @if(in_array("SURGUJA", $district_data)) selected @endif>SURGUJA</option>
                        <option value="NORTH GOA" @if(in_array("NORTH GOA", $district_data)) selected @endif>NORTH GOA</option>
                        <option value="SORTH GOA" @if(in_array("SORTH GOA", $district_data)) selected @endif>SORTH GOA</option>
                        <option value="AHMADABAD" @if(in_array("AHMADABAD", $district_data)) selected @endif>AHMADABAD</option>
                        <option value="AMRELI" @if(in_array("AMRELI", $district_data)) selected @endif>AMRELI</option>
                        <option value="ANAND" @if(in_array("ANAND", $district_data)) selected @endif>ANAND</option>
                        <option value="ARVALLI" @if(in_array("ARVALLI", $district_data)) selected @endif>ARVALLI</option>
                        <option value="BANAS KANTHA" @if(in_array("BANAS KANTHA", $district_data)) selected @endif>BANAS KANTHA</option>
                        <option value="BHARUCH" @if(in_array("BHARUCH", $district_data)) selected @endif>BHARUCH</option>
                        <option value="BHAVNAGAR" @if(in_array("BHAVNAGAR", $district_data)) selected @endif>BHAVNAGAR</option>
                        <option value="BOTAD" @if(in_array("BOTAD", $district_data)) selected @endif>BOTAD</option>
                        <option value="CHHOTAUDEPUR" @if(in_array("CHHOTAUDEPUR", $district_data)) selected @endif>CHHOTAUDEPUR</option>
                        <option value="DANG" @if(in_array("DANG", $district_data)) selected @endif>DANG</option>
                        <option value="DEVBHUMI DWARKA" @if(in_array("DEVBHUMI DWARKA", $district_data)) selected @endif>DEVBHUMI DWARKA</option>
                        <option value="DOHAD" @if(in_array("DOHAD", $district_data)) selected @endif>DOHAD</option>
                        <option value="GANDHINAGAR" @if(in_array("GANDHINAGAR", $district_data)) selected @endif>GANDHINAGAR</option>
                        <option value="GIR SOMNATH" @if(in_array("GIR SOMNATH", $district_data)) selected @endif>GIR SOMNATH</option>
                        <option value="JAMNAGAR" @if(in_array("JAMNAGAR", $district_data)) selected @endif>JAMNAGAR</option>
                        <option value="JUNAGADH" @if(in_array("JUNAGADH", $district_data)) selected @endif>JUNAGADH</option>
                        <option value="KACHCHH" @if(in_array("KACHCHH", $district_data)) selected @endif>KACHCHH</option>
                        <option value="KHEDA" @if(in_array("KHEDA", $district_data)) selected @endif>KHEDA</option>
                        <option value="MAHESANA" @if(in_array("MAHESANA", $district_data)) selected @endif>MAHESANA</option>
                        <option value="MAHISAGAR" @if(in_array("MAHISAGAR", $district_data)) selected @endif>MAHISAGAR</option>
                        <option value="MORBI" @if(in_array("MORBI", $district_data)) selected @endif>MORBI</option>
                        <option value="NARMADA" @if(in_array("NARMADA", $district_data)) selected @endif>NARMADA</option>
                        <option value="NAVSARI" @if(in_array("NAVSARI", $district_data)) selected @endif>NAVSARI</option>
                        <option value="PANCH MAHALS" @if(in_array("PANCH MAHALS", $district_data)) selected @endif>PANCH MAHALS</option>
                        <option value="PATAN" @if(in_array("PATAN", $district_data)) selected @endif>PATAN</option>
                        <option value="PORBANDAR" @if(in_array("PORBANDAR", $district_data)) selected @endif>PORBANDAR</option>
                        <option value="RAJKOT" @if(in_array("RAJKOT", $district_data)) selected @endif>RAJKOT</option>
                        <option value="SABAR KANTHA" @if(in_array("SABAR KANTHA", $district_data)) selected @endif>SABAR KANTHA</option>
                        <option value="SURAT" @if(in_array("SURAT", $district_data)) selected @endif>SURAT</option>
                        <option value="SURENDRANAGAR" @if(in_array("SURENDRANAGAR", $district_data)) selected @endif>SURENDRANAGAR</option>
                        <option value="TAPI" @if(in_array("TAPI", $district_data)) selected @endif>TAPI</option>
                        <option value="VADODARA" @if(in_array("VADODARA", $district_data)) selected @endif>VADODARA</option>
                        <option value="VALSAD" @if(in_array("VALSAD", $district_data)) selected @endif>VALSAD</option>
                        <option value="AMBALA" @if(in_array("AMBALA", $district_data)) selected @endif>AMBALA</option>
                        <option value="BHIWANI" @if(in_array("BHIWANI", $district_data)) selected @endif>BHIWANI</option>
                        <option value="CHARKI DADRI" @if(in_array("CHARKI DADRI", $district_data)) selected @endif>CHARKI DADRI</option>
                        <option value="FARIDABAD" @if(in_array("FARIDABAD", $district_data)) selected @endif>FARIDABAD</option>
                        <option value="FATEHABAD" @if(in_array("FATEHABAD", $district_data)) selected @endif>FATEHABAD</option>
                        <option value="GURUGRAM" @if(in_array("GURUGRAM", $district_data)) selected @endif>GURUGRAM</option> 
                        <option value="HISAR" @if(in_array("HISAR", $district_data)) selected @endif>HISAR</option>
                        <option value="JHAJJAR" @if(in_array("JHAJJAR", $district_data)) selected @endif>JHAJJAR</option>
                        <option value="JIND"@if(in_array("JIND", $district_data)) selected @endif>JIND</option>
                        <option value="KAITHAL" @if(in_array("KAITHAL", $district_data)) selected @endif>KAITHAL</option>
                        <option value="KARNAL" @if(in_array("KARNAL", $district_data)) selected @endif>KARNAL</option>
                        <option value="KURUKSHETRA" @if(in_array("KURUKSHETRA", $district_data)) selected @endif>KURUKSHETRA</option>
                        <option value="MAHENDRAGARH" @if(in_array("MAHENDRAGARH", $district_data)) selected @endif>MAHENDRAGARH</option>
                        <option value="NUH" @if(in_array("NUH", $district_data)) selected @endif>NUH</option>
                        <option value="PALWAL" @if(in_array("PALWAL", $district_data)) selected @endif>PALWAL</option>
                        <option value="PANCHKULA" @if(in_array("PANCHKULA", $district_data)) selected @endif>PANCHKULA</option>
                        <option value="PANIPAT" @if(in_array("PANIPAT", $district_data)) selected @endif>PANIPAT</option>
                        <option value="REWARI" @if(in_array("REWARI", $district_data)) selected @endif>REWARI</option>
                        <option value="ROHTAK" @if(in_array("ROHTAK", $district_data)) selected @endif>ROHTAK</option>
                        <option value="SIRSA" @if(in_array("SIRSA", $district_data)) selected @endif>SIRSA</option>
                        <option value="SONIPAT" @if(in_array("SONIPAT", $district_data)) selected @endif>SONIPAT</option>
                        <option value="YAMUNANAGAR" @if(in_array("YAMUNANAGAR", $district_data)) selected @endif>YAMUNANAGAR</option>
                        <option value="BILASPUR" @if(in_array("BILASPUR", $district_data)) selected @endif>BILASPUR</option>
                        <option value="CHAMBA" @if(in_array("CHAMBA", $district_data)) selected @endif>CHAMBA</option>
                        <option value="HAMIRPUR" @if(in_array("HAMIRPUR", $district_data)) selected @endif>HAMIRPUR</option>
                        <option value="KANGRA" @if(in_array("KANGRA", $district_data)) selected @endif>KANGRA</option>
                        <option value="KINNAUR" @if(in_array("KINNAUR", $district_data)) selected @endif>KINNAUR</option>
                        <option value="KULLU" @if(in_array("KULLU", $district_data)) selected @endif>KULLU</option>
                        <option value="LAHUL AND SPITI" @if(in_array("LAHUL AND SPITI", $district_data)) selected @endif>LAHUL AND SPITI</option>
                        <option value="MANDI" @if(in_array("MANDI", $district_data)) selected @endif>MANDI</option>
                        <option value="SHIMLA" @if(in_array("SHIMLA", $district_data)) selected @endif>SHIMLA</option>
                        <option value="SIRMAUR" @if(in_array("SIRMAUR", $district_data)) selected @endif>SIRMAUR</option>
                        <option value="SOLAN" @if(in_array("SOLAN", $district_data)) selected @endif>SOLAN</option>
                        <option value="UNA" @if(in_array("UNA", $district_data)) selected @endif>UNA</option>
                        <option value="BOKARO" @if(in_array("BOKARO", $district_data)) selected @endif>BOKARO</option>
                        <option value="CHATRA" @if(in_array("CHATRA", $district_data)) selected @endif>CHATRA</option>
                        <option value="DEOGHAR" @if(in_array("DEOGHAR", $district_data)) selected @endif>DEOGHAR</option>
                        <option value="DHANBAD" @if(in_array("DHANBAD", $district_data)) selected @endif>DHANBAD</option>
                        <option value="DUMKA" @if(in_array("DUMKA", $district_data)) selected @endif>DUMKA</option>
                        <option value="EAST SINGHBUM" @if(in_array("EAST SINGHBUM", $district_data)) selected @endif>EAST SINGHBUM</option>
                        <option value="GARHWA" @if(in_array("GARHWA", $district_data)) selected @endif>GARHWA</option>
                        <option value="GIRIDIH" @if(in_array("GIRIDIH", $district_data)) selected @endif>GIRIDIH</option>
                        <option value="GODDA" @if(in_array("GODDA", $district_data)) selected @endif>GODDA</option>
                        <option value="GUMLA" @if(in_array("GUMLA", $district_data)) selected @endif>GUMLA</option>
                        <option value="HAZARIBAGH" @if(in_array("HAZARIBAGH", $district_data)) selected @endif>HAZARIBAGH</option>
                        <option value="JAMTARA" @if(in_array("JAMTARA", $district_data)) selected @endif>JAMTARA</option>
                        <option value="KHUNTI" @if(in_array("KHUNTI", $district_data)) selected @endif>KHUNTI</option>
                        <option value="KODERMA" @if(in_array("KODERMA", $district_data)) selected @endif>KODERMA</option>
                        <option value="LATEHAR" @if(in_array("LATEHAR", $district_data)) selected @endif>LATEHAR</option>
                        <option value="LOHARDAGA" @if(in_array("LOHARDAGA", $district_data)) selected @endif>LOHARDAGA</option>
                        <option value="PAKUR" @if(in_array("PAKUR", $district_data)) selected @endif>PAKUR</option>
                        <option value="PALAMU" @if(in_array("PALAMU", $district_data)) selected @endif>PALAMU</option>
                        <option value="RAMGARH" @if(in_array("RAMGARH", $district_data)) selected @endif>RAMGARH</option>
                        <option value="RANCHI" @if(in_array("RANCHI", $district_data)) selected @endif>RANCHI</option>
                        <option value="SAHEBGANJ" @if(in_array("SAHEBGANJ", $district_data)) selected @endif>SAHEBGANJ</option>
                        <option value="SARAIKELA KHARSAWAN" @if(in_array("SARAIKELA KHARSAWAN", $district_data)) selected @endif>SARAIKELA KHARSAWAN</option>
                        <option value="SIMDEGA" @if(in_array("SIMDEGA", $district_data)) selected @endif>SIMDEGA</option>
                        <option value="WEST SINGHBHUM" @if(in_array("WEST SINGHBHUM", $district_data)) selected @endif>WEST SINGHBHUM</option>
                        <option value="BAGALKOTE" @if(in_array("BAGALKOTE", $district_data)) selected @endif>BAGALKOTE</option>
                        <option value="BALLARI" @if(in_array("BALLARI", $district_data)) selected @endif>BALLARI</option>
                        <option value="BELAGAVI" @if(in_array("BELAGAVI", $district_data)) selected @endif>BELAGAVI</option>
                        <option value="BENGALURU RURAL" @if(in_array("BENGALURU RURAL", $district_data)) selected @endif>BENGALURU RURAL</option>
                        <option value="BENGALURU URBAN" @if(in_array("BENGALURU URBAN", $district_data)) selected @endif>BENGALURU URBAN</option>
                        <option value="BIDAR" @if(in_array("BIDAR", $district_data)) selected @endif>BIDAR</option>
                        <option value="CHAMARAJANAGARA" @if(in_array("CHAMARAJANAGARA", $district_data)) selected @endif>CHAMARAJANAGARA</option>
                        <option value="CHIKKABALLAPURA" @if(in_array("CHIKKABALLAPURA", $district_data)) selected @endif>CHIKKABALLAPURA</option>
                        <option value="CHIKKAMAGALURU" @if(in_array("CHIKKAMAGALURU", $district_data)) selected @endif>CHIKKAMAGALURU</option>
                        <option value="CHITRADURGA" @if(in_array("CHITRADURGA", $district_data)) selected @endif>CHITRADURGA</option>
                        <option value="DAKSHINA KANNADA" @if(in_array("DAKSHINA KANNADA", $district_data)) selected @endif>DAKSHINA KANNADA</option>
                        <option value="DAVANGERE" @if(in_array("DAVANGERE", $district_data)) selected @endif>DAVANGERE</option>
                        <option value="DHARWAD" @if(in_array("DHARWAD", $district_data)) selected @endif>DHARWAD</option>
                        <option value="GADAG" @if(in_array("GADAG", $district_data)) selected @endif>GADAG</option>
                        <option value="HASSAN" @if(in_array("HASSAN", $district_data)) selected @endif>HASSAN</option>
                        <option value="HAVERI" @if(in_array("HAVERI", $district_data)) selected @endif>HAVERI</option>
                        <option value="KALABURAGI" @if(in_array("KALABURAGI", $district_data)) selected @endif>KALABURAGI</option>
                        <option value="KODAGU" @if(in_array("KODAGU", $district_data)) selected @endif>KODAGU</option>
                        <option value="KOLAR" @if(in_array("KOLAR", $district_data)) selected @endif>KOLAR</option>
                        <option value="KOPPAL" @if(in_array("KOPPAL", $district_data)) selected @endif>KOPPAL</option>
                        <option value="MANDYA" @if(in_array("MANDYA", $district_data)) selected @endif>MANDYA</option>
                        <option value="MYSURU" @if(in_array("MYSURU", $district_data)) selected @endif>MYSURU</option>
                        <option value="RAICHUR" @if(in_array("RAICHUR", $district_data)) selected @endif>RAICHUR</option>
                        <option value="RAMANAGARA" @if(in_array("RAMANAGARA", $district_data)) selected @endif>RAMANAGARA</option>
                        <option value="SHIVAMOGGA" @if(in_array("SHIVAMOGGA", $district_data)) selected @endif>SHIVAMOGGA</option> 
                        <option value="TUMAKURU" @if(in_array("TUMAKURU", $district_data)) selected @endif>TUMAKURU</option>
                        <option value="UDUPI" @if(in_array("UDUPI", $district_data)) selected @endif>UDUPI</option>
                        <option value="UTTARA KANNADA" @if(in_array("UTTARA KANNADA", $district_data)) selected @endif>UTTARA KANNADA</option>
                        <option value="VIJAYAPURA" @if(in_array("VIJAYAPURA", $district_data)) selected @endif>VIJAYAPURA</option>
                        <option value="YADGIR" @if(in_array("YADGIR", $district_data)) selected @endif>YADGIR</option>
                        <option value="ALAPPUZHA" @if(in_array("ALAPPUZHA", $district_data)) selected @endif>ALAPPUZHA</option>
                        <option value="ERNAKULAM" @if(in_array("ERNAKULAM", $district_data)) selected @endif>ERNAKULAM</option>
                        <option value="IDUKKI" @if(in_array("IDUKKI", $district_data)) selected @endif>IDUKKI</option>
                        <option value="KANNUR" @if(in_array("KANNUR", $district_data)) selected @endif>KANNUR</option>
                        <option value="KASARAGOD" @if(in_array("KASARAGOD", $district_data)) selected @endif>KASARAGOD</option>
                        <option value="KOLLAM" @if(in_array("KOLLAM", $district_data)) selected @endif>KOLLAM</option>
                        <option value="KOTTAYAM" @if(in_array("KOTTAYAM", $district_data)) selected @endif>KOTTAYAM</option>
                        <option value="KOZHIKODE" @if(in_array("KOZHIKODE", $district_data)) selected @endif>KOZHIKODE</option>
                        <option value="MALAPPURAM" @if(in_array("MALAPPURAM", $district_data)) selected @endif>MALAPPURAM</option>
                        <option value="PALAKKAD" @if(in_array("PALAKKAD", $district_data)) selected @endif>PALAKKAD</option>
                        <option value="PATHANAMTHITTA" @if(in_array("PATHANAMTHITTA", $district_data)) selected @endif>PATHANAMTHITTA</option>
                        <option value="THIRUVANANTHAPURAM" @if(in_array("THIRUVANANTHAPURAM", $district_data)) selected @endif>THIRUVANANTHAPURAM</option>
                        <option value="THRISSUR" @if(in_array("THRISSUR", $district_data)) selected @endif>THRISSUR</option>
                        <option value="WAYANAD" @if(in_array("WAYANAD", $district_data)) selected @endif>WAYANAD</option>
                        <option value="AGAR MALWA" @if(in_array("AGAR MALWA", $district_data)) selected @endif>AGAR MALWA</option>
                        <option value="ALIRAJPUR" @if(in_array("ALIRAJPUR", $district_data)) selected @endif>ALIRAJPUR</option>
                        <option value="ANUPPUR" @if(in_array("ANUPPUR", $district_data)) selected @endif>ANUPPUR</option>
                        <option value="ASHOKNAGAR" @if(in_array("ASHOKNAGAR", $district_data)) selected @endif>ASHOKNAGAR</option>
                        <option value="BALAGHAT" @if(in_array("BALAGHAT", $district_data)) selected @endif>BALAGHAT</option>
                        <option value="BARWANI" @if(in_array("BARWANI", $district_data)) selected @endif>BARWANI</option>
                        <option value="BETUL" @if(in_array("BETUL", $district_data)) selected @endif>BETUL</option>
                        <option value="BHIND" @if(in_array("BHIND", $district_data)) selected @endif>BHIND</option>
                        <option value="BHOPAL" @if(in_array("BHOPAL", $district_data)) selected @endif>BHOPAL</option>
                        <option value="BURHANPUR" @if(in_array("BURHANPUR", $district_data)) selected @endif>BURHANPUR</option>
                        <option value="CHHATARPUR" @if(in_array("CHHATARPUR", $district_data)) selected @endif>CHHATARPUR</option>
                        <option value="CHHINDWARA" @if(in_array("CHHINDWARA", $district_data)) selected @endif>CHHINDWARA</option>
                        <option value="DAMOH" @if(in_array("DAMOH", $district_data)) selected @endif>DAMOH</option>
                        <option value="DATIA" @if(in_array("DATIA", $district_data)) selected @endif>DATIA</option>
                        <option value="DEWAS" @if(in_array("DEWAS", $district_data)) selected @endif>DEWAS</option>
                        <option value="DHAR" @if(in_array("DHAR", $district_data)) selected @endif>DHAR</option>
                        <option value="DINDORI" @if(in_array("DINDORI", $district_data)) selected @endif>DINDORI</option>
                        <option value="EAST NIMAR" @if(in_array("EAST NIMAR", $district_data)) selected @endif>EAST NIMAR</option>
                        <option value="GUNA" @if(in_array("GUNA", $district_data)) selected @endif>GUNA</option>
                        <option value="GWALIOR" @if(in_array("GWALIOR", $district_data)) selected @endif>GWALIOR</option>
                        <option value="HARDA" @if(in_array("HARDA", $district_data)) selected @endif>HARDA</option>
                        <option value="HOSHANGABAD" @if(in_array("HOSHANGABAD", $district_data)) selected @endif>HOSHANGABAD</option>
                        <option value="INDORE" @if(in_array("INDORE", $district_data)) selected @endif>INDORE</option>
                        <option value="JABALPUR" @if(in_array("JABALPUR", $district_data)) selected @endif>JABALPUR</option>
                        <option value="JHABUA" @if(in_array("JHABUA", $district_data)) selected @endif>JHABUA</option>
                        <option value="KATNI" @if(in_array("KATNI", $district_data)) selected @endif>KATNI</option>
                        <option value="KHARGONE" @if(in_array("KHARGONE", $district_data)) selected @endif>KHARGONE</option>
                        <option value="MANDLA" @if(in_array("MANDLA", $district_data)) selected @endif>MANDLA</option>
                        <option value="MANDSAUR" @if(in_array("MANDSAUR", $district_data)) selected @endif>MANDSAUR</option>
                        <option value="MORENA" @if(in_array("MORENA", $district_data)) selected @endif>MORENA</option>
                        <option value="NARSINGHPUR" @if(in_array("NARSINGHPUR", $district_data)) selected @endif>NARSINGHPUR</option>
                        <option value="NEEMUCH"  @if(in_array("NEEMUCH", $district_data)) selected @endif>NEEMUCH</option>
                        <option value="NIWARI" @if(in_array("NIWARI", $district_data)) selected @endif>NIWARI</option>
                        <option value="PANNA" @if(in_array("PANNA", $district_data)) selected @endif>PANNA</option>
                        <option value="RAISEN" @if(in_array("RAISEN", $district_data)) selected @endif>RAISEN</option>
                        <option value="RAJGARH" @if(in_array("RAJGARH", $district_data)) selected @endif>RAJGARH</option>
                        <option value="RATLAM" @if(in_array("RATLAM", $district_data)) selected @endif>RATLAM</option>
                        <option value="REWA" @if(in_array("REWA", $district_data)) selected @endif>REWA</option>
                        <option value="SAGAR" @if(in_array("SAGAR", $district_data)) selected @endif>SAGAR</option>
                        <option value="SATNA" @if(in_array("SATNA", $district_data)) selected @endif>SATNA</option>
                        <option value="SEHORE" @if(in_array("SEHORE", $district_data)) selected @endif>SEHORE</option>
                        <option value="SEONI" @if(in_array("SEONI", $district_data)) selected @endif>SEONI</option>
                        <option value="SHAHDOL" @if(in_array("SHAHDOL", $district_data)) selected @endif>SHAHDOL</option>
                        <option value="SHAJAPUR" @if(in_array("SHAJAPUR", $district_data)) selected @endif>SHAJAPUR</option>
                        <option value="SHEOPUR" @if(in_array("SHEOPUR", $district_data)) selected @endif>SHEOPUR</option>
                        <option value="SHIVPURI" @if(in_array("SHIVPURI", $district_data)) selected @endif>SHIVPURI</option>
                        <option value="SIDHI" @if(in_array("SIDHI", $district_data)) selected @endif>SIDHI</option>
                        <option value="SINGRAULI" @if(in_array("SINGRAULI", $district_data)) selected @endif>SINGRAULI</option>
                        <option value="TIKAMGARH" @if(in_array("TIKAMGARH", $district_data)) selected @endif>TIKAMGARH</option>
                        <option value="UJJAIN" @if(in_array("UJJAIN", $district_data)) selected @endif>UJJAIN</option>
                        <option value="UMARIA" @if(in_array("UMARIA", $district_data)) selected @endif>UMARIA</option>
                        <option value="VIDISHA" @if(in_array("VIDISHA", $district_data)) selected @endif>VIDISHA</option>
                        <option value="AHMEDNAGAR" @if(in_array("AHMEDNAGAR", $district_data)) selected @endif>AHMEDNAGAR</option>
                        <option value="AKOLA" @if(in_array("AKOLA", $district_data)) selected @endif>AKOLA</option>
                        <option value="AMRAVATI" @if(in_array("AMRAVATI", $district_data)) selected @endif>AMRAVATI</option>
                        <option value="AURANGABAD" @if(in_array("AURANGABAD", $district_data)) selected @endif>AURANGABAD</option>
                        <option value="BEED" @if(in_array("BEED", $district_data)) selected @endif>BEED</option>
                        <option value="BHANDARA" @if(in_array("BHANDARA", $district_data)) selected @endif>BHANDARA</option>
                        <option value="BULDHANA" @if(in_array("BULDHANA", $district_data)) selected @endif>BULDHANA</option>
                        <option value="CHANDRAPUR" @if(in_array("CHANDRAPUR", $district_data)) selected @endif>CHANDRAPUR</option>
                        <option value="DHULE" @if(in_array("DHULE", $district_data)) selected @endif>DHULE</option>
                        <option value="GADCHIROLI" @if(in_array("GADCHIROLI", $district_data)) selected @endif>GADCHIROLI</option>
                        <option value="GONDIA" @if(in_array("GONDIA", $district_data)) selected @endif>GONDIA</option>
                        <option value="HINGOLI" @if(in_array("HINGOLI", $district_data)) selected @endif>HINGOLI</option>
                        <option value="JALGAON" @if(in_array("JALGAON", $district_data)) selected @endif>JALGAON</option>
                        <option value="JALNA" @if(in_array("JALNA", $district_data)) selected @endif>JALNA</option>
                        <option value="KOLHAPUR" @if(in_array("KOLHAPUR", $district_data)) selected @endif>KOLHAPUR</option>
                        <option value="LATUR" @if(in_array("LATUR", $district_data)) selected @endif>LATUR</option>
                        <option value="MUMBAI" @if(in_array("MUMBAI", $district_data)) selected @endif>MUMBAI</option>
                        <option value="SUBURBAN" @if(in_array("SUBURBAN", $district_data)) selected @endif>MUMBAI SUBURBAN</option>
                        <option value="NAGPUR" @if(in_array("NAGPUR", $district_data)) selected @endif>NAGPUR</option>
                        <option value="NANDED" @if(in_array("NANDED", $district_data)) selected @endif>NANDED</option>
                        <option value="NANDURBAR" @if(in_array("NANDURBAR", $district_data)) selected @endif>NANDURBAR</option>
                        <option value="NASHIK" @if(in_array("NASHIK", $district_data)) selected @endif>NASHIK</option>
                        <option value="OSMANABAD" @if(in_array("OSMANABAD", $district_data)) selected @endif>OSMANABAD</option>
                        <option value="PALGHAR" @if(in_array("PALGHAR", $district_data)) selected @endif>PALGHAR</option> 
                        <option value="PARBHANI" @if(in_array("PARBHANI", $district_data)) selected @endif>PARBHANI</option>
                        <option value="PUNE" @if(in_array("PUNE", $district_data)) selected @endif>PUNE</option>
                        <option value="RAIGAD" @if(in_array("RAIGAD", $district_data)) selected @endif>RAIGAD</option>
                        <option value="RATNAGIRI" @if(in_array("RATNAGIRI", $district_data)) selected @endif>RATNAGIRI</option>
                        <option value="SANGLI" @if(in_array("SANGLI", $district_data)) selected @endif>SANGLI</option>
                        <option value="SATARA" @if(in_array("SATARA", $district_data)) selected @endif>SATARA</option>
                        <option value="SINDHUDURG" @if(in_array("SINDHUDURG", $district_data)) selected @endif>SINDHUDURG</option>
                        <option value="SOLAPUR" @if(in_array("SOLAPUR", $district_data)) selected @endif>SOLAPUR</option>
                        <option value="THANE" @if(in_array("THANE", $district_data)) selected @endif>THANE</option>
                        <option value="WARDHA" @if(in_array("WARDHA", $district_data)) selected @endif>WARDHA</option>
                        <option value="WASHIM" @if(in_array("WASHIM", $district_data)) selected @endif>WASHIM</option>
                        <option value="YAVATMAL" @if(in_array("YAVATMAL", $district_data)) selected @endif>YAVATMAL</option>
                        <option value="BISHNUPUR" @if(in_array("BISHNUPUR", $district_data)) selected @endif>BISHNUPUR</option> 
                        <option value="CHANDEL" @if(in_array("CHANDEL", $district_data)) selected @endif>CHANDEL</option> 
                        <option value="CHURACHANDPUR" @if(in_array("CHURACHANDPUR", $district_data)) selected @endif>CHURACHANDPUR</option>
                        <option value="IMPHAL EAST" @if(in_array("IMPHAL EAST", $district_data)) selected @endif>IMPHAL EAST</option>
                        <option value="IMPHAL WEST" @if(in_array("IMPHAL WEST", $district_data)) selected @endif>IMPHAL WEST</option>
                        <option value="JIRIBAM" @if(in_array("JIRIBAM", $district_data)) selected @endif>JIRIBAM</option>
                        <option value="KAKCHING" @if(in_array("KAKCHING", $district_data)) selected @endif>KAKCHING</option>
                        <option value="KAMJONG" @if(in_array("KAMJONG", $district_data)) selected @endif>KAMJONG</option>
                        <option value="KANGPOKPI" @if(in_array("KANGPOKPI", $district_data)) selected @endif>KANGPOKPI</option>
                        <option value="NONEY" @if(in_array("NONEY", $district_data)) selected @endif>NONEY</option> 
                        <option value="PHERZAWL" @if(in_array("PHERZAWL", $district_data)) selected @endif>PHERZAWL</option>
                        <option value="SENAPATI" @if(in_array("SENAPATI", $district_data)) selected @endif>SENAPATI</option>
                        <option value="TAMENGLONG" @if(in_array("TAMENGLONG", $district_data)) selected @endif>TAMENGLONG</option>
                        <option value="TENGNOUPAL" @if(in_array("TENGNOUPAL", $district_data)) selected @endif>TENGNOUPAL</option>
                        <option value="THOUBAL" @if(in_array("THOUBAL", $district_data)) selected @endif>THOUBAL</option>
                        <option value="UKHRUL" @if(in_array("UKHRUL", $district_data)) selected @endif>UKHRUL</option>
                        <option value="EAST GARO HILLS" @if(in_array("EAST GARO HILLS", $district_data)) selected @endif>EAST GARO HILLS</option>
                        <option value="EAST JAINTIA HILLS" @if(in_array("EAST JAINTIA HILLS", $district_data)) selected @endif>EAST JAINTIA HILLS</option>
                        <option value="EAST KHASI HILLS" @if(in_array("EAST KHASI HILLS", $district_data)) selected @endif>EAST KHASI HILLS</option>
                        <option value="NORTH GARO HILLS" @if(in_array("NORTH GARO HILLS", $district_data)) selected @endif>NORTH GARO HILLS</option>
                        <option value="RI BHOI" @if(in_array("RI BHOI", $district_data)) selected @endif>RI BHOI</option>
                        <option value="SOUTH GARO HILLS" @if(in_array("SOUTH GARO HILLS", $district_data)) selected @endif>SOUTH GARO HILLS</option>
                        <option value="SOUTH WEST GARO HILLS" @if(in_array("SOUTH WEST GARO HILLS", $district_data)) selected @endif>SOUTH WEST GARO HILLS</option>
                        <option value="SOUTH WEST KHASI HILLS" @if(in_array("SOUTH WEST KHASI HILLS", $district_data)) selected @endif>SOUTH WEST KHASI HILLS</option>
                        <option value="WEST GARO HILLS" @if(in_array("WEST GARO HILLS", $district_data)) selected @endif>WEST GARO HILLS</option>
                        <option value="WEST JAINTIA HILLS" @if(in_array("WEST JAINTIA HILLS", $district_data)) selected @endif>WEST JAINTIA HILLS</option>
                        <option value="WEST KHASI HILLS" @if(in_array("WEST KHASI HILLS", $district_data)) selected @endif>WEST KHASI HILLS</option>
                        <option value="AIZAWL" @if(in_array("AIZAWL", $district_data)) selected @endif>AIZAWL</option>
                        <option value="CHAMPHAI" @if(in_array("CHAMPHAI", $district_data)) selected @endif>CHAMPHAI</option>
                        <option value="HNAHTHIAL" @if(in_array("HNAHTHIAL", $district_data)) selected @endif>HNAHTHIAL</option>
                        <option value="KHAWZAWL" @if(in_array("KHAWZAWL", $district_data)) selected @endif>KHAWZAWL</option>
                        <option value="KOLASIB" @if(in_array("KOLASIB", $district_data)) selected @endif>KOLASIB</option>
                        <option value="LAWNGTLAI" @if(in_array("LAWNGTLAI", $district_data)) selected @endif>LAWNGTLAI</option>
                        <option value="LUNGLEI" @if(in_array("LUNGLEI", $district_data)) selected @endif >LUNGLEI</option>
                        <option value="MAMIT" @if(in_array("MAMIT", $district_data)) selected @endif>MAMIT</option>
                        <option value="SAIHA" @if(in_array("SAIHA", $district_data)) selected @endif>SAIHA</option>
                        <option value="SAITUAL" @if(in_array("SAITUAL", $district_data)) selected @endif>SAITUAL</option>
                        <option value="SERCHHIP" @if(in_array("SERCHHIP", $district_data)) selected @endif>SERCHHIP</option>
                        <option value="DIMAPUR" @if(in_array("DIMAPUR", $district_data)) selected @endif>DIMAPUR</option>
                        <option value="KIPHIRE" @if(in_array("KIPHIRE", $district_data)) selected @endif>KIPHIRE</option>
                        <option value="KOHIMA" @if(in_array("KOHIMA", $district_data)) selected @endif>KOHIMA</option>
                        <option value="LONGLENG" @if(in_array("LONGLENG", $district_data)) selected @endif>LONGLENG</option>
                        <option value="MOKOKCHUNG" @if(in_array("MOKOKCHUNG", $district_data)) selected @endif>MOKOKCHUNG</option>
                        <option value="MON" @if(in_array("MON", $district_data)) selected @endif>MON</option>
                        <option value="PEREN" @if(in_array("PEREN", $district_data)) selected @endif>PEREN</option>
                        <option value="PHEK" @if(in_array("PHEK", $district_data)) selected @endif>PHEK</option>
                        <option value="TUENSANG" @if(in_array("TUENSANG", $district_data)) selected @endif>TUENSANG</option>
                        <option value="WOKHA" @if(in_array("WOKHA", $district_data)) selected @endif>WOKHA</option>
                        <option value="ZUNHEBOTO" @if(in_array("ZUNHEBOTO", $district_data)) selected @endif>ZUNHEBOTO</option>
                        <option value="ANUGUL" @if(in_array("ANUGUL", $district_data)) selected @endif>ANUGUL</option>
                        <option value="BALANGIR" @if(in_array("BALANGIR", $district_data)) selected @endif>BALANGIR</option>
                        <option value="BALESHWAR" @if(in_array("BALESHWAR", $district_data)) selected @endif>BALESHWAR</option>
                        <option value="BARGARH" @if(in_array("BARGARH", $district_data)) selected @endif>BARGARH</option>
                        <option value="BHADRAK" @if(in_array("BHADRAK", $district_data)) selected @endif>BHADRAK</option>
                        <option value="BOUDH" @if(in_array("BOUDH", $district_data)) selected @endif>BOUDH</option>
                        <option value="CUTTACK" @if(in_array("CUTTACK", $district_data)) selected @endif>CUTTACK</option>
                        <option value="DEOGARH" @if(in_array("DEOGARH", $district_data)) selected @endif>DEOGARH</option>
                        <option value="DHENKANAL" @if(in_array("DHENKANAL", $district_data)) selected @endif>DHENKANAL</option>
                        <option value="GAJAPATI" @if(in_array("GAJAPATI", $district_data)) selected @endif>GAJAPATI</option>
                        <option value="GANJAM" @if(in_array("GANJAM", $district_data)) selected @endif>GANJAM</option>
                        <option value="JAGATSINGHAPUR" @if(in_array("JAGATSINGHAPUR", $district_data)) selected @endif>JAGATSINGHAPUR</option>
                        <option value="JAJAPUR" @if(in_array("JAJAPUR", $district_data)) selected @endif>JAJAPUR</option>
                        <option value="JHARSUGUDA" @if(in_array("JHARSUGUDA", $district_data)) selected @endif>JHARSUGUDA</option>
                        <option value="KALAHANDI" @if(in_array("KALAHANDI", $district_data)) selected @endif>KALAHANDI</option>
                        <option value="KANDHAMAL" @if(in_array("KANDHAMAL", $district_data)) selected @endif>KANDHAMAL</option>
                        <option value="KENDRAPARA" @if(in_array("KENDRAPARA", $district_data)) selected @endif>KENDRAPARA</option>
                        <option value="KENDUJHAR" @if(in_array("KENDUJHAR", $district_data)) selected @endif>KENDUJHAR</option>
                        <option value="KHORDHA" @if(in_array("KHORDHA", $district_data)) selected @endif>KHORDHA</option>
                        <option value="KORAPUT" @if(in_array("KORAPUT", $district_data)) selected @endif>KORAPUT</option>
                        <option value="MALKANGIRI" @if(in_array("MALKANGIRI", $district_data)) selected @endif>MALKANGIRI</option>
                        <option value="MAYURBHANJ" @if(in_array("MAYURBHANJ", $district_data)) selected @endif>MAYURBHANJ</option>
                        <option value="NABARANGPUR" @if(in_array("NABARANGPUR", $district_data)) selected @endif>NABARANGPUR</option>
                        <option value="NAYAGARH" @if(in_array("NAYAGARH", $district_data)) selected @endif>NAYAGARH</option>
                        <option value="NUAPADA" @if(in_array("NUAPADA", $district_data)) selected @endif>NUAPADA</option>
                        <option value="PURI" @if(in_array("PURI", $district_data)) selected @endif>PURI</option>
                        <option value="RAYAGADA" @if(in_array("RAYAGADA", $district_data)) selected @endif>RAYAGADA</option>
                        <option value="SAMBALPUR" @if(in_array("SAMBALPUR", $district_data)) selected @endif>SAMBALPUR</option>
                        <option value="SONEPUR" @if(in_array("SONEPUR", $district_data)) selected @endif>SONEPUR</option>
                        <option value="SUNDARGARH" @if(in_array("SUNDARGARH", $district_data)) selected @endif>SUNDARGARH</option>
                        <option value="AMRITSAR" @if(in_array("AMRITSAR", $district_data)) selected @endif>AMRITSAR</option>
                        <option value="BARNALA" @if(in_array("BARNALA", $district_data)) selected @endif>BARNALA</option>
                        <option value="BATHINDA" @if(in_array("BATHINDA", $district_data)) selected @endif>BATHINDA</option>
                        <option value="FARIDKOT" @if(in_array("FARIDKOT", $district_data)) selected @endif>FARIDKOT</option>
                        <option value="FATEHGARH SAHIB" @if(in_array("FATEHGARH SAHIB", $district_data)) selected @endif>FATEHGARH SAHIB</option>
                        <option value="FAZILKA" @if(in_array("FAZILKA", $district_data)) selected @endif>FAZILKA</option>
                        <option value="FIROZEPUR" @if(in_array("FIROZEPUR", $district_data)) selected @endif>FIROZEPUR</option>
                        <option value="GURDASPUR" @if(in_array("GURDASPUR", $district_data)) selected @endif>GURDASPUR</option>
                        <option value="HOSHIARPUR" @if(in_array("HOSHIARPUR", $district_data)) selected @endif>HOSHIARPUR</option>
                        <option value="JALANDHAR" @if(in_array("JALANDHAR", $district_data)) selected @endif>JALANDHAR</option>
                        <option value="KAPURTHALA" @if(in_array("KAPURTHALA", $district_data)) selected @endif>KAPURTHALA</option>
                        <option value="LUDHIANA" @if(in_array("LUDHIANA", $district_data)) selected @endif>LUDHIANA</option>
                        <option value="MANSA" @if(in_array("MANSA", $district_data)) selected @endif>MANSA</option>
                        <option value="MOGA" @if(in_array("MOGA", $district_data)) selected @endif>MOGA</option>
                        <option value="PATHANKOT" @if(in_array("PATHANKOT", $district_data)) selected @endif>PATHANKOT</option>
                        <option value="PATIALA" @if(in_array("PATIALA", $district_data)) selected @endif>PATIALA</option>
                        <option value="RUPNAGAR" @if(in_array("RUPNAGAR", $district_data)) selected @endif>RUPNAGAR</option>
                        <option value="S.A.S NAGAR" @if(in_array("S.A.S NAGAR", $district_data)) selected @endif>S.A.S NAGAR</option>
                        <option value="SANGRUR" @if(in_array("SANGRUR", $district_data)) selected @endif>SANGRUR</option>
                        <option value="SHAHID BHAGAT SINGH NAGAR" @if(in_array("SHAHID BHAGAT SINGH NAGAR", $district_data)) selected @endif>SHAHID BHAGAT SINGH NAGAR</option>
                        <option value="SRI MUKTSAR SAHIB" @if(in_array("SRI MUKTSAR SAHIB", $district_data)) selected @endif>SRI MUKTSAR SAHIB</option>
                        <option value="TARN TARAN" @if(in_array("TARN TARAN", $district_data)) selected @endif>TARN TARAN</option>
                        <option value="AJMER" @if(in_array("AJMER", $district_data)) selected @endif>AJMER</option>
                        <option value="ALWAR" @if(in_array("ALWAR", $district_data)) selected @endif>ALWAR</option>
                        <option value="BANSWARA" @if(in_array("BANSWARA", $district_data)) selected @endif>BANSWARA</option>
                        <option value="BARAN" @if(in_array("BARAN", $district_data)) selected @endif>BARAN</option>
                        <option value="BARMER" @if(in_array("BARMER", $district_data)) selected @endif>BARMER</option>
                        <option value="BHARATPUR" @if(in_array("BHARATPUR", $district_data)) selected @endif>BHARATPUR</option>
                        <option value="BHILWARA" @if(in_array("BHILWARA", $district_data)) selected @endif>BHILWARA</option>
                        <option value="BIKANER" @if(in_array("BIKANER", $district_data)) selected @endif>BIKANER</option>
                        <option value="BUNDI" @if(in_array("BUNDI", $district_data)) selected @endif>BUNDI</option>
                        <option value="CHITTORGARH" @if(in_array("CHITTORGARH", $district_data)) selected @endif>CHITTORGARH</option>
                        <option value="CHURU" @if(in_array("CHURU", $district_data)) selected @endif>CHURU</option>
                        <option value="DAUSA" @if(in_array("DAUSA", $district_data)) selected @endif>DAUSA</option>
                        <option value="DHOLPUR" @if(in_array("DHOLPUR", $district_data)) selected @endif>DHOLPUR</option>
                        <option value="DUNGARPUR" @if(in_array("DUNGARPUR", $district_data)) selected @endif>DUNGARPUR</option>
                        <option value="GANGANAGAR" @if(in_array("GANGANAGAR", $district_data)) selected @endif>GANGANAGAR</option>
                        <option value="HANUMANGARH" @if(in_array("HANUMANGARH", $district_data)) selected @endif>HANUMANGARH</option>
                        <option value="JAIPUR" @if(in_array("JAIPUR", $district_data)) selected @endif>JAIPUR</option>
                        <option value="JAISALMER" @if(in_array("JAISALMER", $district_data)) selected @endif>JAISALMER</option>
                        <option value="JALORE" @if(in_array("JALORE", $district_data)) selected @endif>JALORE</option>
                        <option value="JHALAWAR" @if(in_array("JHALAWAR", $district_data)) selected @endif>JHALAWAR</option>
                        <option value="JHUNJHUNU" @if(in_array("JHUNJHUNU", $district_data)) selected @endif>JHUNJHUNU</option>
                        <option value="JODHPUR" @if(in_array("JODHPUR", $district_data)) selected @endif>JODHPUR</option>
                        <option value="KARAULI" @if(in_array("KARAULI", $district_data)) selected @endif>KARAULI</option>
                        <option value="KOTA" @if(in_array("KOTA", $district_data)) selected @endif>KOTA</option>
                        <option value="NAGAUR" @if(in_array("NAGAUR", $district_data)) selected @endif>NAGAUR</option>
                        <option value="PALI" @if(in_array("PALI", $district_data)) selected @endif>PALI</option>
                        <option value="PRATAPGARH" @if(in_array("PRATAPGARH", $district_data)) selected @endif>PRATAPGARH</option>
                        <option value="RAJSAMAND" @if(in_array("RAJSAMAND", $district_data)) selected @endif>RAJSAMAND</option> 
                        <option value="SAWAI MADHOPUR" @if(in_array("SAWAI MADHOPUR", $district_data)) selected @endif>SAWAI MADHOPUR</option>
                        <option value="SIKAR" @if(in_array("SIKAR", $district_data)) selected @endif>SIKAR</option>
                        <option value="SIROHI" @if(in_array("SIROHI", $district_data)) selected @endif>SIROHI</option>
                        <option value="TONK" @if(in_array("TONK", $district_data)) selected @endif>TONK</option>
                        <option value="UDAIPUR" @if(in_array("UDAIPUR", $district_data)) selected @endif>UDAIPUR</option>
                        <option value="DISTRICT" @if(in_array("DISTRICT", $district_data)) selected @endif>EAST DISTRICT</option>
                        <option value="NORTH DISTRICT" @if(in_array("NORTH DISTRICT", $district_data)) selected @endif>NORTH DISTRICT</option>
                        <option value="SOUTH DISTRICT" @if(in_array("SOUTH DISTRICT", $district_data)) selected @endif>SOUTH DISTRICT</option>
                        <option value="WEST DISTRICT" @if(in_array("WEST DISTRICT", $district_data)) selected @endif>WEST DISTRICT</option>
                        <option value="ARIYALUR" @if(in_array("ARIYALUR", $district_data)) selected @endif>ARIYALUR</option>
                        <option value="CHENGALPATTU" @if(in_array("CHENGALPATTU", $district_data)) selected @endif>CHENGALPATTU</option>
                        <option value="CHENNAI" @if(in_array("CHENNAI", $district_data)) selected @endif>CHENNAI</option>
                        <option value="COIMBATORE" @if(in_array("COIMBATORE", $district_data)) selected @endif>COIMBATORE</option>
                        <option value="CUDDALORE" @if(in_array("CUDDALORE", $district_data)) selected @endif>CUDDALORE</option>
                        <option value="DHARMAPURI" @if(in_array("DHARMAPURI", $district_data)) selected @endif>DHARMAPURI</option>
                        <option value="DINDIGUL" @if(in_array("DINDIGUL", $district_data)) selected @endif>DINDIGUL</option>
                        <option value="ERODE" @if(in_array("ERODE", $district_data)) selected @endif>ERODE</option>
                        <option value="KALLAKURICHI" @if(in_array("KALLAKURICHI", $district_data)) selected @endif>KALLAKURICHI</option>
                        <option value="KANCHIPURAM" @if(in_array("KANCHIPURAM", $district_data)) selected @endif>KANCHIPURAM</option>
                        <option value="KANNIYAKUMARI" @if(in_array("KANNIYAKUMARI", $district_data)) selected @endif>KANNIYAKUMARI</option>
                        <option value="KARUR" @if(in_array("KARUR", $district_data)) selected @endif>KARUR</option>
                        <option value="KRISHNAGIRI" @if(in_array("KRISHNAGIRI", $district_data)) selected @endif>KRISHNAGIRI</option>
                        <option value="MADURAI" @if(in_array("MADURAI", $district_data)) selected @endif>MADURAI</option>
                        <option value="NAGAPATTINAM" @if(in_array("NAGAPATTINAM", $district_data)) selected @endif>NAGAPATTINAM</option>
                        <option value="NAMAKKAL" @if(in_array("NAMAKKAL", $district_data)) selected @endif>NAMAKKAL</option>
                        <option value="PERAMBALUR" @if(in_array("PERAMBALUR", $district_data)) selected @endif>PERAMBALUR</option>
                        <option value="PUDUKKOTTAI" @if(in_array("PUDUKKOTTAI", $district_data)) selected @endif>PUDUKKOTTAI</option>
                        <option value="RAMANATHAPURAM" @if(in_array("RAMANATHAPURAM", $district_data)) selected @endif>RAMANATHAPURAM</option>
                        <option value="RANIPET" @if(in_array("RANIPET", $district_data)) selected @endif>RANIPET</option>
                        <option value="SALEM" @if(in_array("SALEM", $district_data)) selected @endif>SALEM</option>
                        <option value="SIVAGANGA" @if(in_array("SIVAGANGA", $district_data)) selected @endif>SIVAGANGA</option>
                        <option value="TENKASI" @if(in_array("TENKASI", $district_data)) selected @endif>TENKASI</option>
                        <option value="THANJAVUR" @if(in_array("THANJAVUR", $district_data)) selected @endif>THANJAVUR</option>
                        <option value="NILGIRIS" @if(in_array("NILGIRIS", $district_data)) selected @endif>THE NILGIRIS</option>
                        <option value="THENI" @if(in_array("THENI", $district_data)) selected @endif>THENI</option>
                        <option value="THIRUVALLUR" @if(in_array("THIRUVALLUR", $district_data)) selected @endif>THIRUVALLUR</option>
                        <option value="THIRUVARUR" @if(in_array("THIRUVARUR", $district_data)) selected @endif>THIRUVARUR</option>
                        <option value="TIRUCHIRAPPALLI" @if(in_array("TIRUCHIRAPPALLI", $district_data)) selected @endif>TIRUCHIRAPPALLI</option>
                        <option value="TIRUNELVELI" @if(in_array("TIRUNELVELI", $district_data)) selected @endif>TIRUNELVELI</option>
                        <option value="TIRUPATHUR" @if(in_array("TIRUPATHUR", $district_data)) selected @endif>TIRUPATHUR</option>
                        <option value="TIRUPPUR" @if(in_array("TIRUPPUR", $district_data)) selected @endif>TIRUPPUR</option>
                        <option value="TIRUVANNAMALAI" @if(in_array("TIRUVANNAMALAI", $district_data)) selected @endif>TIRUVANNAMALAI</option>
                        <option value="TUTICORIN" @if(in_array("TUTICORIN", $district_data)) selected @endif>TUTICORIN</option>
                        <option value="VELLORE" @if(in_array("VELLORE", $district_data)) selected @endif>VELLORE</option>
                        <option value="VILLUPURAM" @if(in_array("VILLUPURAM", $district_data)) selected @endif>VILLUPURAM</option>
                        <option value="VIRUDHUNAGAR" @if(in_array("VIRUDHUNAGAR", $district_data)) selected @endif>VIRUDHUNAGAR</option>
                        <option value="ADILABAD" @if(in_array("ADILABAD", $district_data)) selected @endif>ADILABAD</option>
                        <option value="BHADRADRI KOTHAGUDEM" @if(in_array("BHADRADRI KOTHAGUDEM", $district_data)) selected @endif>BHADRADRI KOTHAGUDEM</option>
                        <option value="HYDERABAD" @if(in_array("HYDERABAD", $district_data)) selected @endif>HYDERABAD</option>
                        <option value="JAGITIAL" @if(in_array("JAGITIAL", $district_data)) selected @endif>JAGITIAL</option>
                        <option value="JANGOAN" @if(in_array("JANGOAN", $district_data)) selected @endif>JANGOAN</option>
                        <option value="JAYASHANKAR BHUPALAPALLY" @if(in_array("JAYASHANKAR BHUPALAPALLY", $district_data)) selected @endif>JAYASHANKAR BHUPALAPALLY</option>
                        <option value="JOGULAMBA GADWAL" @if(in_array("JOGULAMBA GADWAL", $district_data)) selected @endif>JOGULAMBA GADWAL</option>
                        <option value="KAMAREDDY" @if(in_array("KAMAREDDY", $district_data)) selected @endif>KAMAREDDY</option>
                        <option value="KARIMNAGAR" @if(in_array("KARIMNAGAR", $district_data)) selected @endif>KARIMNAGAR</option>
                        <option value="KHAMMAM" @if(in_array("KHAMMAM", $district_data)) selected @endif>KHAMMAM</option>
                        <option value="KUMURAM BHEEM ASIFABAD" @if(in_array("KUMURAM BHEEM ASIFABAD", $district_data)) selected @endif>KUMURAM BHEEM ASIFABAD</option>
                        <option value="MAHABUBABAD" @if(in_array("MAHABUBABAD", $district_data)) selected @endif>MAHABUBABAD</option>
                        <option value="MAHABUBNAGAR" @if(in_array("MAHABUBNAGAR", $district_data)) selected @endif>MAHABUBNAGAR</option>
                        <option value="MANCHERIAL" @if(in_array("MANCHERIAL", $district_data)) selected @endif>MANCHERIAL</option>
                        <option value="MEDAK" @if(in_array("MEDAK", $district_data)) selected @endif>MEDAK</option>
                        <option value="MEDCHAL MALKAJGIRI" @if(in_array("MEDCHAL MALKAJGIRI", $district_data)) selected @endif>MEDCHAL MALKAJGIRI</option>
                        <option value="MULUGU" @if(in_array("MULUGU", $district_data)) selected @endif>MULUGU</option>
                        <option value="NAGARKURNOOL" @if(in_array("NAGARKURNOOL", $district_data)) selected @endif>NAGARKURNOOL</option>
                        <option value="NALGONDA" @if(in_array("NALGONDA", $district_data)) selected @endif>NALGONDA</option>
                        <option value="NARAYANPET" @if(in_array("NARAYANPET", $district_data)) selected @endif>NARAYANPET</option>
                        <option value="NIRMAL" @if(in_array("NIRMAL", $district_data)) selected @endif>NIRMAL</option>
                        <option value="NIZAMABAD" @if(in_array("NIZAMABAD", $district_data)) selected @endif>NIZAMABAD</option>
                        <option value="PEDDAPALLI" @if(in_array("PEDDAPALLI", $district_data)) selected @endif>PEDDAPALLI</option>
                        <option value="RAJANNA SIRCILLA" @if(in_array("RAJANNA SIRCILLA", $district_data)) selected @endif>RAJANNA SIRCILLA</option>
                        <option value="RANGA REDDY" @if(in_array("RANGA REDDY", $district_data)) selected @endif>RANGA REDDY</option>
                        <option value="SANGAREDDY" @if(in_array("SANGAREDDY", $district_data)) selected @endif>SANGAREDDY</option>
                        <option value="SIDDIPET" @if(in_array("SIDDIPET", $district_data)) selected @endif>SIDDIPET</option>
                        <option value="SURYAPET" @if(in_array("SURYAPET", $district_data)) selected @endif>SURYAPET</option>
                        <option value="VIKARABAD" @if(in_array("VIKARABAD", $district_data)) selected @endif>VIKARABAD</option>
                        <option value="WANAPARTHY" @if(in_array("WANAPARTHY", $district_data)) selected @endif>WANAPARTHY</option>
                        <option value="WARANGAL RURAL" @if(in_array("WARANGAL RURAL", $district_data)) selected @endif>WARANGAL RURAL</option>
                        <option value="WARANGAL URBAN" @if(in_array("WARANGAL URBAN", $district_data)) selected @endif>WARANGAL URBAN</option>
                        <option value="BHUVANAGIRI" @if(in_array("BHUVANAGIRI", $district_data)) selected @endif>YADADRI BHUVANAGIRI</option>
                        <option value="DHALAI" @if(in_array("DHALAI", $district_data)) selected @endif>DHALAI</option>
                        <option value="GOMATI" @if(in_array("GOMATI", $district_data)) selected @endif>GOMATI</option>
                        <option value="KHOWAI" @if(in_array("KHOWAI", $district_data)) selected @endif>KHOWAI</option>
                        <option value="NORTH TRIPURA" @if(in_array("NORTH TRIPURA", $district_data)) selected @endif>NORTH TRIPURA</option>
                        <option value="SEPAHIJALA" @if(in_array("SEPAHIJALA", $district_data)) selected @endif>SEPAHIJALA</option>
                        <option value="SOUTH TRIPURA" @if(in_array("SOUTH TRIPURA", $district_data)) selected @endif>SOUTH TRIPURA</option>
                        <option value="UNAKOTI" @if(in_array("UNAKOTI", $district_data)) selected @endif>UNAKOTI</option>
                        <option value="WEST TRIPURA" @if(in_array("WEST TRIPURA", $district_data)) selected @endif>WEST TRIPURA</option>
                        <option value="AGRA" @if(in_array("AGRA", $district_data)) selected @endif>AGRA</option>
                        <option value="ALIGARH" @if(in_array("ALIGARH", $district_data)) selected @endif>ALIGARH</option>
                        <option value="AMBEDKAR NAGAR" @if(in_array("AMBEDKAR NAGAR", $district_data)) selected @endif>AMBEDKAR NAGAR</option>
                        <option value="AMETHI" @if(in_array("AMETHI", $district_data)) selected @endif>AMETHI</option>
                        <option value="AMROHA" @if(in_array("AMROHA", $district_data)) selected @endif>AMROHA</option>
                        <option value="AURAIYA" @if(in_array("AURAIYA", $district_data)) selected @endif>AURAIYA</option>
                        <option value="AYODHYA" @if(in_array("AYODHYA", $district_data)) selected @endif>AYODHYA</option>
                        <option value="AZAMGARH" @if(in_array("AZAMGARH", $district_data)) selected @endif>AZAMGARH</option>
                        <option value="BAGHPAT" @if(in_array("BAGHPAT", $district_data)) selected @endif>BAGHPAT</option>
                        <option value="BAHRAICH" @if(in_array("BAHRAICH", $district_data)) selected @endif>BAHRAICH</option>
                        <option value="BALLIA" @if(in_array("BALLIA", $district_data)) selected @endif>BALLIA</option>
                        <option value="BALRAMPUR" @if(in_array("BALRAMPUR", $district_data)) selected @endif>BALRAMPUR</option>
                        <option value="BANDA" @if(in_array("BANDA", $district_data)) selected @endif>BANDA</option>
                        <option value="BARABANKI" @if(in_array("BARABANKI", $district_data)) selected @endif>BARABANKI</option>
                        <option value="BAREILLY" @if(in_array("BAREILLY", $district_data)) selected @endif>BAREILLY</option>
                        <option value="BASTI" @if(in_array("BASTI", $district_data)) selected @endif>BASTI</option>
                        <option value="BHADOHI" @if(in_array("BHADOHI", $district_data)) selected @endif>BHADOHI</option>
                        <option value="BIJNOR" @if(in_array("BIJNOR", $district_data)) selected @endif>BIJNOR</option>
                        <option value="BUDAUN" @if(in_array("BUDAUN", $district_data)) selected @endif>BUDAUN</option>
                        <option value="BULANDSHAHR" @if(in_array("BULANDSHAHR", $district_data)) selected @endif>BULANDSHAHR</option>
                        <option value="CHANDAULI" @if(in_array("CHANDAULI", $district_data)) selected @endif>CHANDAULI</option>
                        <option value="CHITRAKOOT" @if(in_array("CHITRAKOOT", $district_data)) selected @endif>CHITRAKOOT</option>
                        <option value="DEORIA" @if(in_array("DEORIA", $district_data)) selected @endif>DEORIA</option>
                        <option value="ETAH" @if(in_array("ETAH", $district_data)) selected @endif>ETAH</option>
                        <option value="ETAWAH" @if(in_array("ETAWAH", $district_data)) selected @endif>ETAWAH</option>
                        <option value="FARRUKHABAD" @if(in_array("FARRUKHABAD", $district_data)) selected @endif>FARRUKHABAD</option>
                        <option value="FATEHPUR" @if(in_array("FATEHPUR", $district_data)) selected @endif>FATEHPUR</option>
                        <option value="FIROZABAD" @if(in_array("FIROZABAD", $district_data)) selected @endif>FIROZABAD</option>
                        <option value="GAUTAM BUDDHA NAGAR" @if(in_array("GAUTAM BUDDHA NAGAR", $district_data)) selected @endif>GAUTAM BUDDHA NAGAR</option>
                        <option value="GHAZIABAD" @if(in_array("GHAZIABAD", $district_data)) selected @endif>GHAZIABAD</option>
                        <option value="GHAZIPUR" @if(in_array("GHAZIPUR", $district_data)) selected @endif>GHAZIPUR</option>
                        <option value="GONDA" @if(in_array("GONDA", $district_data)) selected @endif>GONDA</option>
                        <option value="GORAKHPUR" @if(in_array("GORAKHPUR", $district_data)) selected @endif>GORAKHPUR</option>
                        <option value="HAMIRPUR" @if(in_array("HAMIRPUR", $district_data)) selected @endif>HAMIRPUR</option>
                        <option value="HAPUR" @if(in_array("HAPUR", $district_data)) selected @endif>HAPUR</option>
                        <option value="HARDOI" @if(in_array("HARDOI", $district_data)) selected @endif>HARDOI</option>
                        <option value="HATHRAS" @if(in_array("HATHRAS", $district_data)) selected @endif>HATHRAS</option>
                        <option value="JALAUN" @if(in_array("JALAUN", $district_data)) selected @endif>JALAUN</option>
                        <option value="JAUNPUR" @if(in_array("JAUNPUR", $district_data)) selected @endif>JAUNPUR</option>
                        <option value="JHANSI" @if(in_array("JHANSI", $district_data)) selected @endif>JHANSI</option>
                        <option value="KANNAUJ" @if(in_array("KANNAUJ", $district_data)) selected @endif>KANNAUJ</option>
                        <option value="KANPUR DEHAT" @if(in_array("KANPUR DEHAT", $district_data)) selected @endif>KANPUR DEHAT</option>
                        <option value="KANPUR NAGAR" @if(in_array("KANPUR NAGAR", $district_data)) selected @endif>KANPUR NAGAR</option>
                        <option value="KASGANJ" @if(in_array("KASGANJ", $district_data)) selected @endif>KASGANJ</option>
                        <option value="KAUSHAMBI" @if(in_array("KAUSHAMBI", $district_data)) selected @endif>KAUSHAMBI</option>
                        <option value="KHERI" @if(in_array("KHERI", $district_data)) selected @endif>KHERI</option>
                        <option value="KUSHI NAGAR" @if(in_array("KUSHI NAGAR", $district_data)) selected @endif>KUSHI NAGAR</option>
                        <option value="LALITPUR" @if(in_array("LALITPUR", $district_data)) selected @endif>LALITPUR</option>
                        <option value="LUCKNOW" @if(in_array("LUCKNOW", $district_data)) selected @endif>LUCKNOW</option>
                        <option value="MAHARAJGANJ" @if(in_array("MAHARAJGANJ", $district_data)) selected @endif>MAHARAJGANJ</option>
                        <option value="MAHOBA" @if(in_array("MAHOBA", $district_data)) selected @endif>MAHOBA</option>
                        <option value="MAINPURI" @if(in_array("MAINPURI", $district_data)) selected @endif>MAINPURI</option>
                        <option value="MATHURA" @if(in_array("MATHURA", $district_data)) selected @endif>MATHURA</option>
                        <option value="MAU" @if(in_array("MAU", $district_data)) selected @endif>MAU</option>
                        <option value="MEERUT" @if(in_array("MEERUT", $district_data)) selected @endif>MEERUT</option>
                        <option value="MIRZAPUR" @if(in_array("MIRZAPUR", $district_data)) selected @endif>MIRZAPUR</option>
                        <option value="MORADABAD" @if(in_array("MORADABAD", $district_data)) selected @endif>MORADABAD</option>
                        <option value="MUZAFFARNAGAR" @if(in_array("MUZAFFARNAGAR", $district_data)) selected @endif>MUZAFFARNAGAR</option>
                        <option value="PILIBHIT" @if(in_array("PILIBHIT", $district_data)) selected @endif>PILIBHIT</option>
                        <option value="PRATAPGARH" @if(in_array("PRATAPGARH", $district_data)) selected @endif>PRATAPGARH</option>
                        <option value="PRAYAGRAJ" @if(in_array("PRAYAGRAJ", $district_data)) selected @endif>PRAYAGRAJ</option>
                        <option value="RAE BARELI" @if(in_array("RAE BARELI", $district_data)) selected @endif>RAE BARELI</option>
                        <option value="SAHARANPUR" @if(in_array("SAHARANPUR", $district_data)) selected @endif>SAHARANPUR</option>
                        <option value="SAMBHAL" @if(in_array("SAMBHAL", $district_data)) selected @endif>SAMBHAL</option>
                        <option value="SANT KABEER NAGAR" @if(in_array("SANT KABEER NAGAR", $district_data)) selected @endif>SANT KABEER NAGAR</option>
                        <option value="SHAHJAHANPUR" @if(in_array("SHAHJAHANPUR", $district_data)) selected @endif>SHAHJAHANPUR</option>
                        <option value="SHAMLI" @if(in_array("SHAMLI", $district_data)) selected @endif>SHAMLI</option>
                        <option value="SHRAVASTI" @if(in_array("SHRAVASTI", $district_data)) selected @endif>SHRAVASTI</option>
                        <option value="SIDDHARTH NAGAR" @if(in_array("SIDDHARTH NAGAR", $district_data)) selected @endif>SIDDHARTH NAGAR</option>
                        <option value="SITAPUR" @if(in_array("SITAPUR", $district_data)) selected @endif>SITAPUR</option>
                        <option value="SONBHADRA" @if(in_array("SONBHADRA", $district_data)) selected @endif>SONBHADRA</option>
                        <option value="SULTANPUR" @if(in_array("SULTANPUR", $district_data)) selected @endif>SULTANPUR</option>
                        <option value="UNNAO" @if(in_array("UNNAO", $district_data)) selected @endif>UNNAO</option>
                        <option value="VARANASI" @if(in_array("VARANASI", $district_data)) selected @endif>VARANASI</option>
                        <option value="CHANDIGARH" @if(in_array("CHANDIGARH", $district_data)) selected @endif>CHANDIGARH</option>
                        <option value="DADRA AND NAGAR HAVELI" @if(in_array("DADRA AND NAGAR HAVELI", $district_data)) selected @endif>DADRA AND NAGAR HAVELI</option>
                        <option value="DAMAN" @if(in_array("DAMAN", $district_data)) selected @endif>DAMAN</option>
                        <option value="DIU" @if(in_array("DIU", $district_data)) selected @endif>DIU</option>
                        <option value="ANANTNAG" @if(in_array("ANANTNAG", $district_data)) selected @endif>ANANTNAG</option>
                        <option value="BANDIPORA" @if(in_array("BANDIPORA", $district_data)) selected @endif>BANDIPORA</option>
                        <option value="BARAMULLA" @if(in_array("BARAMULLA", $district_data)) selected @endif>BARAMULLA</option>
                        <option value="BUDGAM" @if(in_array("BUDGAM", $district_data)) selected @endif>BUDGAM</option>
                        <option value="DODA" @if(in_array("DODA", $district_data)) selected @endif>DODA</option>
                        <option value="GANDERBAL" @if(in_array("GANDERBAL", $district_data)) selected @endif>GANDERBAL</option>
                        <option value="JAMMU" @if(in_array("JAMMU", $district_data)) selected @endif>JAMMU</option>
                        <option value="KATHUA" @if(in_array("KATHUA", $district_data)) selected @endif>KATHUA</option>
                        <option value="KISHTWAR" @if(in_array("KISHTWAR", $district_data)) selected @endif>KISHTWAR</option>
                        <option value="KULGAM" @if(in_array("KULGAM", $district_data)) selected @endif>KULGAM</option>
                        <option value="KUPWARA" @if(in_array("KUPWARA", $district_data)) selected @endif>KUPWARA</option>
                        <option value="POONCH" @if(in_array("POONCH", $district_data)) selected @endif>POONCH</option>
                        <option value="PULWAMA" @if(in_array("PULWAMA", $district_data)) selected @endif>PULWAMA</option>
                        <option value="RAJOURI" @if(in_array("RAJOURI", $district_data)) selected @endif >RAJOURI</option>
                        <option value="RAMBAN" @if(in_array("RAMBAN", $district_data)) selected @endif>RAMBAN</option>
                        <option value="REASI" @if(in_array("REASI", $district_data)) selected @endif>REASI</option>
                        <option value="SAMBA" @if(in_array("SAMBA", $district_data)) selected @endif>SAMBA</option>
                        <option value="SHOPIAN" @if(in_array("SHOPIAN", $district_data)) selected @endif>SHOPIAN</option>
                        <option value="SRINAGAR" @if(in_array("SRINAGAR", $district_data)) selected @endif>SRINAGAR</option>
                        <option value="UDHAMPUR" @if(in_array("UDHAMPUR", $district_data)) selected @endif>UDHAMPUR</option>
                        <option value="ALMORA" @if(in_array("ALMORA", $district_data)) selected @endif>ALMORA</option>
                        <option value="BAGESHWAR" @if(in_array("BAGESHWAR", $district_data)) selected @endif>BAGESHWAR</option>
                        <option value="CHAMOLI" @if(in_array("CHAMOLI", $district_data)) selected @endif>CHAMOLI</option>
                        <option value="CHAMPAWAT" @if(in_array("CHAMPAWAT", $district_data)) selected @endif>CHAMPAWAT</option>
                        <option value="DEHRADUN" @if(in_array("DEHRADUN", $district_data)) selected @endif>DEHRADUN</option>
                        <option value="HARIDWAR" @if(in_array("HARIDWAR", $district_data)) selected @endif>HARIDWAR</option>
                        <option value="NAINITAL" @if(in_array("NAINITAL", $district_data)) selected @endif>NAINITAL</option>
                        <option value="PAURI GARHWAL" @if(in_array("PAURI GARHWAL", $district_data)) selected @endif>PAURI GARHWAL</option>
                        <option value="PITHORAGARH" @if(in_array("PITHORAGARH", $district_data)) selected @endif>PITHORAGARH</option>
                        <option value="RUDRA PRAYAG" @if(in_array("RUDRA PRAYAG", $district_data)) selected @endif>RUDRA PRAYAG</option>
                        <option value="TEHRI GARHWAL" @if(in_array("TEHRI GARHWAL", $district_data)) selected @endif>TEHRI GARHWAL</option>
                        <option value="UDAM SINGH NAGAR" @if(in_array("UDAM SINGH NAGAR", $district_data)) selected @endif>UDAM SINGH NAGAR</option>
                        <option value="UTTAR KASHI" @if(in_array("UTTAR KASHI", $district_data)) selected @endif>UTTAR KASHI</option>
                        <option value="NORTH 24 PARGANAS" @if(in_array("NORTH 24 PARGANAS", $district_data)) selected @endif>NORTH 24 PARGANAS</option>
                        <option value="SOUTH 24 PARGANAS" @if(in_array("SOUTH 24 PARGANAS", $district_data)) selected @endif>SOUTH 24 PARGANAS</option>
                        <option value="ALIPURDUAR" @if(in_array("ALIPURDUAR", $district_data)) selected @endif>ALIPURDUAR</option>
                        <option value="BANKURA" @if(in_array("BANKURA", $district_data)) selected @endif>BANKURA</option>
                        <option value="BIRBHUM" @if(in_array("BIRBHUM", $district_data)) selected @endif>BIRBHUM</option>
                        <option value="COOCHBEHAR" @if(in_array("COOCHBEHAR", $district_data)) selected @endif>COOCHBEHAR</option>
                        <option value="DARJEELING" @if(in_array("DARJEELING", $district_data)) selected @endif>DARJEELING</option>
                        <option value="DINAJPUR DAKSHIN" @if(in_array("DINAJPUR DAKSHIN", $district_data)) selected @endif>DINAJPUR DAKSHIN</option>
                        <option value="DINAJPUR UTTAR" @if(in_array("DINAJPUR UTTAR", $district_data)) selected @endif>DINAJPUR UTTAR</option>
                        <option value="HOOGHLY" @if(in_array("HOOGHLY", $district_data)) selected @endif>HOOGHLY</option>
                        <option value="HOWRAH" @if(in_array("HOWRAH", $district_data)) selected @endif>HOWRAH</option>
                        <option value="JALPAIGURI" @if(in_array("JALPAIGURI", $district_data)) selected @endif>JALPAIGURI</option>
                        <option value="JHARGRAM" @if(in_array("JHARGRAM", $district_data)) selected @endif>JHARGRAM</option>
                        <option value="KALIMPONG" @if(in_array("KALIMPONG", $district_data)) selected @endif>KALIMPONG</option>
                        <option value="KOLKATA" @if(in_array("KOLKATA", $district_data)) selected @endif>KOLKATA</option>
                        <option value="MALDAH" @if(in_array("MALDAH", $district_data)) selected @endif>MALDAH</option>
                        <option value="MEDINIPUR EAST" @if(in_array("MEDINIPUR EAST", $district_data)) selected @endif>MEDINIPUR EAST</option>
                        <option value="MEDINIPUR WEST" @if(in_array("MEDINIPUR WEST", $district_data)) selected @endif>MEDINIPUR WEST</option>
                        <option value="MURSHIDABAD" @if(in_array("MURSHIDABAD", $district_data)) selected @endif>MURSHIDABAD</option>
                        <option value="NADIA" @if(in_array("NADIA", $district_data)) selected @endif>NADIA</option>
                        <option value="PASCHIM BARDHAMAN" @if(in_array("PASCHIM BARDHAMAN", $district_data)) selected @endif>PASCHIM BARDHAMAN</option>
                        <option value="PURBA BARDHAMAN" @if(in_array("PURBA BARDHAMAN", $district_data)) selected @endif>PURBA BARDHAMAN</option>
                        <option value="PURULIA" @if(in_array("PURULIA", $district_data)) selected @endif>PURULIA</option>
                        <option value="NICOBARS" @if(in_array("NICOBARS", $district_data)) selected @endif>NICOBARS</option>
                        <option value="NORTH AND MIDDLE ANDAMAN" @if(in_array("NORTH AND MIDDLE ANDAMAN", $district_data)) selected @endif>NORTH AND MIDDLE ANDAMAN</option>
                        <option value="SOUTH ANDAMANS" @if(in_array("SOUTH ANDAMANS", $district_data)) selected @endif>SOUTH ANDAMANS</option>
                        <option value="KARGIL" @if(in_array("KARGIL", $district_data)) selected @endif>KARGIL</option>
                        <option value="LEH" @if(in_array("LEH", $district_data)) selected @endif>LEH</option>
                        <option value="LAKSHADWEEP" @if(in_array("LAKSHADWEEP", $district_data)) selected @endif>LAKSHADWEEP</option>
                        <option value="CENTRAL" @if(in_array("CENTRAL", $district_data)) selected @endif>CENTRAL</option>
                        <option value="EAST" @if(in_array("EAST", $district_data)) selected @endif>EAST</option>
                        <option value="NEW DELHI" @if(in_array("NEW DELHI", $district_data)) selected @endif>NEW DELHI</option>
                        <option value="NORTH" @if(in_array("NORTH", $district_data)) selected @endif>NORTH</option>
                        <option value="NORTH EAST" @if(in_array("NORTH EAST", $district_data)) selected @endif>NORTH EAST</option>
                        <option value="NORTH WEST" @if(in_array("NORTH WEST", $district_data)) selected @endif>NORTH WEST</option>
                        <option value="SHAHDARA" @if(in_array("SHAHDARA", $district_data)) selected @endif>SHAHDARA</option>
                        <option value="SOUTH" @if(in_array("SOUTH", $district_data)) selected @endif>SOUTH</option>
                        <option value="SOUTH EAST" @if(in_array("SOUTH EAST", $district_data)) selected @endif>SOUTH EAST</option>
                        <option value="SOUTH WEST" @if(in_array("SOUTH WEST", $district_data)) selected @endif>SOUTH WEST</option>
                        <option value="WEST" @if(in_array("WEST", $district_data)) selected @endif>WEST</option>
                        <option value="KARAIKAL" @if(in_array("KARAIKAL", $district_data)) selected @endif>KARAIKAL</option>
                        <option value="PUDUCHERRY" @if(in_array("PUDUCHERRY", $district_data)) selected @endif>PUDUCHERRY</option>
                        <option value="MAHE" @if(in_array("MAHE", $district_data)) selected @endif>MAHE</option>
                        <option value="YANAM" @if(in_array("YANAM", $district_data)) selected @endif>YANAM</option>
                  </select>
            </div>
			
            </div>
			

			
            <button type="submit" class="btn btn-primary !mt-6">Submit</button>
            {!! Form::close() !!}
        </div>
		
		
<!--category  modal start--> 

<div class="fixed inset-0 bg-[black]/60 z-[999]  hidden" :class="open && '!block'">
   <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
	  <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden  w-full max-w-xl my-8">
		 <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
			<h5 class="font-bold text-lg">Create New Sub Category</h5>
			<button type="button" class="text-white-dark hover:text-dark" @click="toggle">
			   <svg
				  xmlns="http://www.w3.org/2000/svg"
				  width="24px"
				  height="24px"
				  viewBox="0 0 24 24"
				  fill="none"
				  stroke="currentColor"
				  stroke-width="1.5"
				  stroke-linecap="round"
				  stroke-linejoin="round"
				  class="h-6 w-6"
				  >
				  <line x1="18" y1="6" x2="6" y2="18"></line>
				  <line x1="6" y1="6" x2="18" y2="18"></line>
			   </svg>
			</button>
		 </div>
		 <div class="p-5">
         <form action="{{route('store_subcategory_data')}}" method="POST">
            @csrf
			 <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      
	     
			   <div>
				  <div class="">
					 <label for="category_id">Select Category</label>
						<select class="form-input" name="category_id" id="category_id" required="">
						<option value="">--Select Category--</option>
							@foreach($categoryData as $category)
							 <option value="{{$category->id}}">{{ $category->category_name }}</option>
							@endforeach
					    </select>
				  </div>
			   </div>
			   <div>
				  <label for="sub_category_name" >Sub Category Name</label>
				   <input type="text" class="form-input" name="sub_category_name" placeholder="Sub Category Name">
			   </div>
			 </div>
			 <div class="flex justify-end items-center mt-8">
			   <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Save</button>
			 </div>
         </form>
		 </div>
		
	  </div>
   </div>
</div>
<!--category  modal end--> 
		
 </div>
</div>

@endsection

@push('script')

<!-- Set Selle Price and Margin price equal to Price  14-02--2025 Start -->
<script>
	$(document).ready(function(){
		$("#seller_price, #margin_price").on("input", function(){
			let firstValue = parseFloat($("#seller_price").val()) || 0;
			//let secondValue = parseFloat($("#margin_price").val()) || 0;
			$("#price").val(Math.round(firstValue+firstValue * 2/100));
		});
	});
</script>
<!-- Set Selle Price and Margin price equal to Price  14-02--2025 End -->

 <script>
       $('#payment_info').show();
       $('#payment_info_hide').show();
  </script>
        @if(isset($product->product_guarantee_type))
        @if($product->product_guarantee_type=='No Guarantee & Warranty')
      <script>
        $('#payment_info').hide();
      </script>
    @else
      <script>
      
       $('#payment_info_hide').show();
      </script>
    @endif
  @endif 
    <script>

    $('#payment_info').show();
    $('#payment_info_hide').show();
    $('#spare_part_info').show();
    function change_status_product(){
        
       var product_guarantee_type = $('#Productguaranteetype').val();
      // alert('product_guarantee_type');
     
       if(product_guarantee_type=='No Guarantee & Warranty'){
        
		$('#payment_info').hide();
		
        $('#spare_part_info').hide(); 
        
       }
       else if(product_guarantee_type=='Guarantee' || product_guarantee_type=='Warranty')
       { 
       
        $('#payment_info').show();
        $('#spare_part_info').hide();
       }
	   else if(product_guarantee_type=='Only Spare Parts')
       { 
       
        $('#spare_part_info').show();
        $('#payment_info').show();
       }  
     }
</script>

<!-- Product Type 25-6-2024 -->
 <script>
     
       $('#finished_good_hide').show();
  </script>
        @if(isset($product->product_type))
        @if($product->product_type=='Finished Good')
      <script>
        $('#finished_good_hide').hide();
      </script>
    @else
      <script>
         
       $('#finished_good_hide').show();
      
      </script>
    @endif
  @endif
 <script>

    $('#finished_good_hide').show();

    function change_status_product_type(){
        
       var product_type = $('#product_type').val();
       
     
       if(product_type=='Finished Good'){
        $('#finished_good_hide').hide();
         
        
       }
       else if(product_type=='Spare Parts')
       { 
       
         $('#finished_good_hide').show();

       


       }
     }
</script>
<!-- Product Type -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

<script>
   $(document).ready(function(){
      
       var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
          removeItemButton: true,
          maxItemCount:745,
          searchResultLimit:745,
          renderChoiceLimit:745
        }); 
       
       
   });
   
</script>

<!-- search bar and district data -->

<script> 
   $(function(){
    $('#alertMessageHide').delay(5000).fadeOut();
   });
</script>

<script>

function getSubcategoryData(element){
	
	   var category_id = element.value;
       //alert(seller_id);	   
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
function brandDontShow(){
	
var brandcheck = $('#dont_show_brand').is(":checked");

  if(brandcheck == true){
	 $('#dont_show_brand').val("Yes");
  }else{
	  $('#dont_show_brand').val("No");
  }
console.log(brandcheck);
}
/* 

//script hide date 10-06-2024

function noWarrantyData(){
  
  var noWarranty = $('#no_warranty').is(":checked");

  if(noWarranty == true){
	 $('#no_warranty').val("Yes");
  }else{
	  $('#no_warranty').val("No");
  }

} */ 

function getSellerData(element){
	
	   var seller_id = element.value;
       //alert(seller_id);	   
	   var token = "{{ csrf_token() }}";
       var url = "{{ route('get_seller_data') }}";
       $.ajax({
         url:url,
         type: 'POST',
         data: { _token :token,seller_id:seller_id },
         success:function(result){
		
          console.log(result);	  
		 
	     var brand_name = result.seller_data.brand_name;
	     $('#brand_name').val(brand_name);
		 
		 
		$('#category_id').html(''); 
		
		$('#category_id').append('<option value="">--Select Category--</option>');
          
          $.each(result.cat_data, function(key, value) {
          
          $('#category_id').append('<option value="'+key+'">'+value+'</option>');
          
        }); 
	   
	     //var category_id = result.seller_data.category_id;	
	 
	    // $('#category_id').val(category_id);
            
           
         }
       });
}

</script>

<!-- Available for OEM checkbox-6-6-2024-->
<script>
    $(function() {
  
  // Get the form fields and hidden div
  var checkbox = $("#available_for_oem");
  var hidden = $("#hidden_fields");
  var hiddens = $("#hidden_field");
  hidden.hide();
  hiddens.hide();
  checkbox.change(function() {
    if (checkbox.is(':checked')) {
      // Show the hidden fields.
      hidden.show();
      hiddens.show();
    } else {
      hidden.hide();
      hiddens.hide();
      
    }
  });
});
</script>

<!-- Available for OEM checkbox-6-6-2024-->
<script>
function availableForOem(){
  
  var availableOem = $('#available_for_oem').is(":checked");

  if(availableOem == true){
	 $('#available_for_oem').val("Yes");
  }else{
	  $('#available_for_oem').val("No");
  }

}
</script>
<!-- Available for OEM checkbox-6-6-2024-->
<script>
// radio button delecet for non brand  thirdparty sourcing 06-10-2024
var val;
$('.toggles').mouseup(function(){
  val = this.checked
}).click(function(){
  this.checked = val == true ? false : true
})
</script>
@endpush