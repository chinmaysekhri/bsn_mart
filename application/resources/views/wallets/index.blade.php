@php
 
use App\Helpers\Helper;

$auth_user  = Auth::user();

@endphp

@php 
	
	$i=1;
	
	$total_order_sum = 0;
	$total_delivered_sum = 0;
	$total_pending_sum = 0;
	
	@endphp
	
	@foreach($productOrderData as $row)
	
	@php
	
	$total_order_sum += ($row['total_order'] * $row['product_price']);
	$total_delivered_sum += ($row['total_delivered'] * $row['product_price']);
	$total_pending_sum += ((($row['total_order'])-($row['total_delivered'])) * $row['product_price']);
	 
	@endphp

	@endforeach


@extends('admin.layouts.app')
@section('title','Wallet')
@section('content')

@if (count($errors) > 0)
	
	<div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
		   <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Whoops!</strong>There were some problems with your input.
		 <ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		  </ul>
		 </span>
	</div>
	
@endif
	
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <!-- start main content section -->
    <div class="panel h-full overflow-hidden border-0 p-0">
        <div class="min-h-[190px] bg-gradient-to-r from-[#4361ee] to-[#160f6b] p-6">
            <div class="mb-6 flex items-center justify-between">
			
			<form action="{{route('wallets.index')}}" method="get" id="walletForm">
			
			<input type="hidden" name="getwalletdata" value="wallet_data">
			 
               <div class="flex items-center  bg-black/50  font-semibold text-white">    
				   <select class="form-input flex items-center  bg-black/50  font-semibold text-white" name="buyer_seller_id" id="category_id" onchange="getWalletdata();" required="">
					  <option value="">--Select Buyer/Seller--</option>
					  @foreach($getEmployeeData as $empuser)
					 
					  <option value="{{$empuser->id}}" @if(Request::input('buyer_seller_id') == $empuser->id) selected @endif > {{$empuser->email}} ({{ucfirst($empuser->for)}})</option>
					 
					 @endforeach
				   </select>
			
			   </div> 
			  </form>
            </div>
            <div class="flex items-center justify-between text-white">
                <p class="text-xl">Wallet Balance</p>
                <h5 class="text-2xl ltr:ml-auto rtl:mr-auto"><span class="text-white-light">₹ {{round($totalWalletAmount)}}.00
                    </span></h5>
            </div>
        </div>
        <div class="-mt-12 grid grid-cols-2 gap-2 px-8">
            <div class="rounded-md bg-white px-4 py-2.5 shadow dark:bg-[#060818]">
                <span class="mb-4 flex items-center justify-between dark:text-white"> Total Add Fund
                    <svg class="h-4 w-4 text-success" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 15L12 9L5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
				
				@if(!empty($totalAddFund))	
                <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                        ₹ {{round($totalAddFund)}}.00
                </div> 
				@else
				<div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                        ₹ 00.00
                </div>
				@endif
				
            </div>
            <div class="rounded-md bg-white px-4 py-2.5 shadow dark:bg-[#060818]">
                <span class="mb-4 flex items-center justify-between dark:text-white">Total Withdraw
                    <svg class="h-4 w-4 text-danger" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
				
				@if(!empty($totalWithdrawal))
                <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                    ₹ {{ round($totalWithdrawal) }}.00
                </div>
				@else
			    <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                    ₹ 00.00
                </div>
				@endif
					
            </div>
        </div>
        <div class="p-5">
            <div class="flex justify-around px-2 text-center">
                <a href="{{route('funds.create')}}?buyer_seller_id={{Request::input('buyer_seller_id')}}"><button type="button" class="btn btn-info ltr:mr-2 rtl:ml-2">Add Funds</button></a>
                <a href="{{route('withdraws.create')}}?buyer_seller_id={{Request::input('buyer_seller_id')}}"><button type="button" class="btn btn-success">Withdraw</button></a>
				<a href="{{route('view_wallet_history')}}?buyer_seller_id={{Request::input('buyer_seller_id')}}"<button type="button" class="btn btn-secondary ltr:mr-2 rtl:ml-2">View Details</button></a>
            </div>
        </div>
		<br><br><br> 
		<!-- Only Admin shown this amount date 17-09-2024 -->
		@if($auth_user->for == 'super_admin')
		 <div class="-mt-12 grid grid-cols-2 gap-2 px-8">
            <div class="rounded-md bg-white px-4 py-2.5 shadow dark:bg-[#060818]">
                <span class="mb-4 flex items-center justify-between dark:text-white"><b>Total Add Fund Amount</b>
                   
                </span>
				
				@if(!empty($adminTotalAddFund))	
                <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                        ₹ {{round($adminTotalAddFund)}}.00
                </div> 
				@else
				<div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                        ₹ 00.00
                </div>
				@endif
				
            </div>
            <div class="rounded-md bg-white px-4 py-2.5 shadow dark:bg-[#060818]">
                <span class="mb-4 flex items-center justify-between dark:text-white"><b>Total Withdrawal Amount</b>
                   
                </span>
				
				@if(!empty($adminTotalWithdrawal))
                <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                    ₹ {{ round($adminTotalWithdrawal) }}.00
                </div>
				@else
			    <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                    ₹ 00.00
                </div>
				@endif
					
            </div>
        </div>
		@endif
        <!-- Only Admin shown this amount date 17-09-2024  End-->		
		<br><br><br><br>
		
		<!-- Only Admin shown this amount date 23-12-2024 -->
		@if($auth_user->for == 'super_admin')
		 <div class="-mt-12 grid grid-cols-2 gap-2 px-8">
            <div class="rounded-md bg-white px-4 py-2.5 shadow dark:bg-[#060818]">
                <span class="mb-4 flex items-center justify-between dark:text-white"><b>Total Available Fund </b>
                   
                </span>
				
				@if(!empty($totalAvailabeFund))	
                <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                        ₹ {{round($totalAvailabeFund)}}.00
                </div> 
				@else
				<div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                        ₹ 00.00
                </div>
				@endif
				
            </div>
            <div class="rounded-md bg-white px-4 py-2.5 shadow dark:bg-[#060818]">
                <span class="mb-4 flex items-center justify-between dark:text-white"><b>Total Pending Purchase</b>
                   
                </span>
				
				@if(!empty($total_pending_sum))
                <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                    ₹ {{ round($total_pending_sum) }}.00
                </div>
				@else
			    <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                    ₹ 00.00
                </div>
				@endif
					
            </div>
        </div>
		@endif
        <!-- Only Admin shown this amount date 23-12-2024  End-->
		
		<br><br>
		
			
			
    </div>
</div>

@endsection

@push('script')
<script>

function getWalletdata(){
	
	$('#walletForm').submit(); 
}
</script>

<!--Applid On Button hidden and show Script  -->
<!-- <script>
   function myFunction() {
     var x = document.getElementById("myDIV");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script> -->

<!--Applid On  button hidden and show Script End  -->  
@endpush