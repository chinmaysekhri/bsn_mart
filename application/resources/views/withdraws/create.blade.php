@extends('admin.layouts.app')
@section('title','Withdraw Funds')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('withdraws.index')}}" class="text-primary hover:underline">Withdraw</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Withdraw Fund</span>
      </li>
   </ul>
</div>
<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
   <div class="panel">
      <div class="mb-5">
         @if (count($errors) > 0)
         <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
            <span class="ltr:pr-2 rtl:pl-2">
               <strong class="ltr:mr-1 rtl:ml-1">Whoops!</strong>There were some problems with your input.
               <ul>
                  @foreach ($errors as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </span>
            <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80">
               <svg> ... </svg>
            </button>
         </div>
         @endif
         {!! Form::open(array('route' => 'withdraws.store','method'=>'POST','class'=>'space-y-5', 'enctype'=>'multipart/form-data')) !!}
         @csrf
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="date"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Date
               </label>
               {!! Form::date('withdrawal_date', date('Y-m-d'), array('placeholder' => 'Withdrawal Create Date','class' => 'form-input','id'=>'withdrawal_date')) !!}
            </div>
            <div>
               <label for="withdrawal_amount"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Amount
               </label>
               {!! Form::text('withdrawal_amount', null, array('placeholder' => 'Enter Amount ','class' => 'form-input','id'=>'withdrawal_amount' ,'required' => 'required')) !!}
            </div>
            <div>
               <label for="withdrawal_payment_type"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Withdrawal Payment Type</label>
              <select class="form-select text-white-dark" id="withdrawal_payment_type" name="withdrawal_payment_type" onchange="getCashData(this);">
              <option value="">Withdrawal Payment Type</option>
              <option value="Cash">Cash</option>
              <option value="In Account">In Account</option>
            </select>
            </div>
         </div>
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" id="cashContent" style="display:none">
          
         
               <div>
               <label for="acount_holder_name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Account Holder Name</label>
               {!! Form::text('acount_holder_name', null, array('placeholder' => 'Enter Account Holder Name','class' => 'form-input','id'=>'acount_holder_name', 'onkeyup'=>'calculateInvestment(this);')) !!}
            </div>
         
         
             <div>
               <label for="bank_name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Bank Name</label>
               {!! Form::text('bank_name', null, array('placeholder' => 'Enter Bank Name','class' => 'form-input','id'=>'bank_name')) !!}
            </div>
         
             <div>
               <label for="bank_account_no"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Bank Account Number</label>
               {!! Form::text('bank_account_no', null, array('placeholder' => 'Enter Bank Account Number','class' => 'form-input','id'=>'bank_account_no')) !!}
            </div>

             <div>
               <label for="bank_ifsc_code"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>IFSC Code</label>
               {!! Form::text('bank_ifsc_code', null, array('placeholder' => 'Enter IFSC Code','class' => 'form-input','id'=>'bank_ifsc_code')) !!}
            </div>
         
      </div>
	     <input type="hidden"  name="withdrawal_from" value="{{$buyerSellerID}}">
		 
         <button type="submit" class="btn btn-primary !mt-6">Submit</button>
         {!! Form::close() !!}
      </div>
   </div>
</div>
@endsection
@push('script')

<script>
 function getCashData(element){
    
   var cashData = element.value;
   
   if(cashData=='In Account'){
      
      $('#cashContent').show();
   }else{
      $('#cashContent').hide();
   }
 }
</script>
@endpush