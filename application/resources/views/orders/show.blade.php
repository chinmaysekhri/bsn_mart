@php

use App\Helpers\Helper;

@endphp
@extends('admin.layouts.app')
@section('title','View Order')
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
                    <a href="{{route('orders.index')}}" class="text-primary hover:underline">Orders</a>
                </li>
                <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                    <span>Show Order</span>
                </li>
            </ul>
        </div><br>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 p-5">
        <div>
            <label for="">
                <strong>Date:</strong><br>
				{{$order->created_at->format('Y-m-d') }}  
            </label>
        </div>
        <div>
            <label for="">
                <strong>Part Name:</strong><br>
               <td>{{$order->first_name.' '.$order->last_name}}</td>
            </label>
        </div>
        <div>
            <label for="">
                <strong>Order Id:</strong><br>
               <td>{{$order->order_id}}</td>
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
	
	$cartProductDetail = json_decode($order->cart_product_detail , true); 
	
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
                        <th scope="col">Pack Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Total Delivered</th>
                    </tr>
                </thead>
                <tbody>
                 @php  $i=1; @endphp

                 @foreach($cartProductDetail as  $ProductData)
                
				 @php
				 
				 $getProductDetail    = Helper::productDetail($ProductData['product_id']);
				 
				 $deliveredProductQty = Helper::deliveredProductQty($order->id,$ProductData['product_id']);
				 
				 $packTotalQty = ($ProductData['master_packing']*$ProductData['prod_qty']);
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
                        <td>{{$packTotalQty}}</td>
                        <td>{{$ProductData['unit_price']}} </td>
                        <td>{{$deliveredProductQty}}</td>
                    </tr>
                   @endforeach
                   
                </tbody>
            </table>
        </div>
        <div class="flex justify-end px-4">
            <div class="w-full md:w-80 font-semibold p-5">
                <div class="flex items-center justify-between py-2">
                    <span>Sub Total :</span>
                    <span> ₹ {{$order->subtotal_price}}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <span>Portal Fees :</span>
                    <span> ₹ {{$order->shipping_estimate}}</span>
                </div>
                <div class="flex items-center justify-between font-bold py-4 border-t dark:border-t-dark border-dashed">
                    <span>Final Amount :</span>
                    <span id="total"> ₹ {{$order->total_buy_price}}</span>
                </div>
               
            </div>
        </div>
        <hr>
        <div class="dataTable-wrapper">
            <table class=" table">
                <div class="d-flex">
                    <h5 class="text-lg font-semibold dark:text-white-light w-50 pl-3">Transport Details</h5>
                </div>
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Transport Name</th>
                        <th scope="col">Private Marka</th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact Number</th>
                    </tr>
                </thead>
				 @php 

				 $i=1;

                 $transportAddressData = Helper::transportAddress($order->transport_address);
				 
				 @endphp
				 
                <tbody>
                    <tr>
					@if(!empty($transportAddressData))
                        <td scope="row">{{$i++}}</td>
                        <td>{{$transportAddressData->transport_name}}</td>
                        <td>{{$transportAddressData->private_marka}}</td>
                        <td>{{$transportAddressData->transport_address}}</td>
                        <td>{{$transportAddressData->transport_contact_number}}</td>
					@endif
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="d-flex">
            <h5 class="text-lg font-semibold dark:text-white-light w-50 pl-3">Transport Copy</h5>
        </div>
        <div class="text-cntr p-5 ">
            <!-- Transport Copy -->
			@if(!empty($transportAddressData))
            <img src="{{asset('public/uploads/transport_address/lr_copy_upload/'.$transportAddressData->lr_copy_upload)}}" alt="" style="border-radius: 5%;height: 100px;width: 150px;">
			@endif
        </div>
    </div>
</div>
</div>
</div>
@endsection