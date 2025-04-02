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
	  
	  @if(count($withdrawalHistory) > 0 || count($fundHistory) > 0)
		  
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
			@foreach($withdrawalHistory as $withdrawal) 
			
			  @php
				
				$buyerSellerData= Helper::getBuyerSellerData($withdrawal->withdrawal_from);
				
				if(!empty($buyerSellerData)){
					
				 $buyerSellerName = $buyerSellerData->first_name.' '.$buyerSellerData->last_name;	
				
				}else{
					 
					 $buyerSellerName =  "";
				}
				
			  @endphp
			  
             <tr>
               <td>{{ $withdrawal->withdrawal_date}}</td>
               <td>{{ $withdrawal->payment_withdrawal_id}}</td>
               <td>{{ ucwords($withdrawal->withdrawal_for) }}</td>
               <td>{{ ucwords($withdrawal->withdrawal_type) }}</td>
               <td>{{ round($withdrawal->withdrawal_amount) }}</td>
               <td>{{ ucwords($buyerSellerName) }}</td>
            </tr>
			
			@endforeach
			
             @foreach($fundHistory as $fund) 
			 
			 @php
				
				$buyerSellerData= Helper::getBuyerSellerData($fund->fund_to);
				
				if(!empty($buyerSellerData)){
					
				 $buyerSellerName = $buyerSellerData->first_name.' '.$buyerSellerData->last_name;	
				
				}else{
					 
					 $buyerSellerName =  "";
				}
				
			  @endphp
			 
             <tr>
                  <td>{{ $fund->fund_date }}</td>
                  <td>{{ $fund->payment_fund_id }}</td>
                  <td>{{ ucwords($fund->fund_for) }}</td>
                  <td>{{ ucwords($fund->fund_type) }}</td>
                  <td>{{ round($fund->fund_amount)}}</td>
                  <td>{{ ucwords($buyerSellerName)}}</td>
            </tr>
			@endforeach
      <!--  <tr>
               <td>16-12-23</td>
                <td>00003</td>
                 <td>Payment</td>
               <td>Created</td>
               <td>50012.00</td>
               <td>Rajesh</td>
            </tr> -->
         </table>
      </div>
	   @else
		   
	   <h1 style="text-align:center;color:red">No Transaction Found!</h1>
	   
	   @endif
	  
   </div>
  
</div>
@endsection
