@php

use App\Helpers\Helper;

	 
  $auth_user  = Auth::user();
	
  $partyName= $auth_user->first_name.' '.$auth_user->last_name;
  
@endphp
@extends('admin.layouts.app')
@section('title','View Return Cart')
@section('content')
<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <div x-data="form">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li>
                    <a href="{{route('cartreturns.index')}}" class="text-primary hover:underline">Return Cart List</a>
                </li>
                <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                    <span>Show Return Cart</span>
                </li>
            </ul>
        </div><br>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 p-5">
        <div>
            <label for="">
                <strong>Date:</strong><br>
				{{$cartReturnOrder->updated_at->format('d-m-Y') }}  
            </label>
        </div>
		
		@php
				
		$getSellerNameData = Helper::getBuyerSellerData($cartReturnOrder->buyer_seller_id);
				 
		$partyName        = $getSellerNameData->first_name.' '.$getSellerNameData->last_name;
				 
		@endphp
        <div>
            <label for="">
                <strong>Part Name:</strong><br>
               <td>{{$partyName}}</td>
            </label>
        </div>
        <div>
            <label for="">
                <strong>Cart Return Id:</strong><br>
               <td>{{$cartReturnOrder->cart_return_id}}</td>
            </label>
        </div>

        <div>
            <button type="button" class="btn btn-outline-primary flex" :class="{ 'text-white bg-primary': selectedTab === 'personal' }" @click="tabChanged('personal')" onClick="window.print()">
                Print
            </button>
        </div>

    </div>
    <div>
	
	@php
	
	$cartProductDetail = json_decode($cartReturnOrder->cart_product_detail , true); 
	
	@endphp
        <div class="dataTable-wrapper">
            <table class=" table table-hover ">
                <div class=" d-flex">
                    <h5 class="text-lg font-semibold dark:text-white-light w-50 pl-3">Order Details</h5>
                </div>
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col" class="w-15">Product Image</th>
                        <th scope="col">Product Id</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        
                    </tr>
                </thead>
                <tbody>
                 @php  $i=1; @endphp

                 @foreach($cartProductDetail as  $ProductData)
                
				 @php
				 
				 $getProductDetail    = Helper::productDetail($ProductData['product_id']);
				 
				 
				 @endphp
                    <tr>
                        <td scope="row">{{$i++}}</td>
                        <td>
						@if(!empty($getProductDetail->product_photo))
							  <a href=	"{{asset('public/uploads/product/product_photo/'.$getProductDetail->product_photo)}}" target="_blank" >
							  <img class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2" src="{{asset('public/uploads/product/product_photo/'.$getProductDetail->product_photo)}}"></a>
                        @endif
						</td>
                        <td>PID00{{$ProductData['product_id']}}</td>
                        <td>{{$getProductDetail->product_name}}</td>
                        <td>{{$ProductData['prod_qty']}}</td>
                        <td>{{$ProductData['unit_price']}} </td>
                        
                    </tr>
                   @endforeach
                   
                </tbody>
            </table>
        </div>
        <div class="flex justify-end px-4">
          
                <div class="flex items-center justify-between font-bold py-4 border-t dark:border-t-dark border-dashed">
                    <span>Total Amount :</span>
                    <span id="total">  ₹  {{$cartReturnOrder->total_buy_price}}</span>
                </div>
               
            </div>
        </div>
        
    </div>
</div>
</div>
</div>
@endsection