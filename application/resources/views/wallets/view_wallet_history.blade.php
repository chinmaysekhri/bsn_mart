@php
 
use App\Helpers\Helper;

@endphp

@extends('admin.layouts.app')
@section('title','View Wallet History')
@section('content')

@push('head')
<style>
   caption { font-family: Arial;
   font-size: 1.2em;
   font-weight: bold; 
   padding-bottom: 5px;}
   tr:nth-of-type(even) { background-color:#eaeaea; } 
   tr:first-of-type { background-color: green; 
   font-size: 18px; }
</style>
@endpush

<div x-data="form">

  
	  
   <div class="panel">
      <ul class="flex space-x-2 rtl:space-x-reverse">
         <li>
            <a href="{{route('wallets.index')}}" class="text-primary hover:underline">Wallet</a>
         </li>
         <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>View Wallet History</span>
         </li>
      </ul>
	  <br>
	  
	  @if(count($ledgerHistory) > 0)
		  
      <div class="table-reponsive box">
         <table>
            <caption>Show Wallet Details</caption>
            <tr>
               <td>Date</td>
               <td>Transaction ID</td>
               <td>Transaction Type</td>
               <td>Created/Debit</td>
               <td>Amount</td>
               <td>S/B Name</td>
            </tr>
			@foreach($ledgerHistory as $ledger) 
			
			@php
				
				$buyerSellerData= Helper::getBuyerSellerData($ledger->buyer_seller_id);
				
				if(!empty($buyerSellerData)){
					
				 $buyerSellerName = $buyerSellerData->first_name.' '.$buyerSellerData->last_name;	
				
				}else{
					 
					 $buyerSellerName =  "";
				}
				
			@endphp
			  
             <tr>
               <td>{{ $ledger->ledger_date}}</td>
               <td>{{ $ledger->ledger_order_id}}</td>
               <td>{{ ucwords($ledger->ledger_for) }}</td>
               <td>{{ ucwords($ledger->ledger_type) }}</td>
               <td>{{ round($ledger->ledger_amount) }}</td>
               <td>{{ ucwords($buyerSellerName) }}</td>
            </tr>
			
			@endforeach
			
      
         </table>
      </div>
	   @else
		   
	   <h1 style="text-align:center;color:red">No Transaction Found!</h1>
	   
	   @endif
	  
   </div>
  
</div>
@endsection
