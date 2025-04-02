@php

date_default_timezone_set("Asia/Calcutta");  
date('d-m-Y H:i:s');

@endphp

@extends('admin.layouts.app')
@section('title','Add Fund')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('funds.index')}}" class="text-primary hover:underline">Fund</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Add Fund</span>
      </li>
   </ul>
</div>
<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
   <div class="panel">
      <div class="mb-5">
         {!! Form::open(array('route' => 'funds.store','method'=>'POST','class'=>'space-y-5', 'enctype'=>'multipart/form-data')) !!}
		 @csrf
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div class="">
                  <label for="date"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Date
                  </label>
                    {!! Form::date('fund_date', date('Y-m-d'), array('placeholder' => 'Fund Create Date','class' => 'form-input')) !!}
               </div>
               <div class="">
                  <label for="amount"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Amount
                  </label>
                  {!! Form::text('fund_amount', null, array('placeholder' => 'Enter Amount ','class' => 'form-input','id'=>'amount' ,'required' => 'required')) !!}
               </div>
               <div class="">
                  <label for="fund_receipt_no"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Receipt  Number
                  </label>
                  {!! Form::text('fund_receipt_no', null, array('placeholder' => 'Enter Receipt No. ','class' => 'form-input','id'=>'fund_receipt_no' ,'required' => 'required')) !!}
               </div>
               <div class="">
               <label for="upload_fund_receipt"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Upload Fund Receipt</label>
               {!! Form::file('upload_fund_receipt', array('placeholder' => 'Upload Receipt','class' => 'form-input','id'=>'upload_fund_receipt','required' => 'required')) !!}
               </div>
            </div>
         </div>
		 
		 <input type="hidden"  name="fund_to" value="{{$buyerSellerID}}">
		  
         <button type="submit" class="btn btn-primary !mt-6">Submit</button>
         {!! Form::close() !!}
      </div>
   </div>
</div>
@endsection