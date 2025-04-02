@extends('admin.layouts.app')
@section('title','Add Seller Transport Address')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('sellertransportaddresses.index')}}" class="text-primary hover:underline"> Transport Address</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Create</span>
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
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </span>
            <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80">
               <svg> ... </svg>
            </button>
         </div>
         @endif
         {!! Form::open(array('route' => 'sellertransportaddresses.store','method'=>'POST','class'=>'space-y-5', 'enctype'=>'multipart/form-data')) !!}
          <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-2">
      <div>
         <label for="seller_id">Select Seller Name</label>
                 <select class="form-input form-select" name="seller_id" id="seller_id" required="">
                  <option value="">--Select Seller Name--</option>
                  @foreach($sellerData as $seller_transport_address)
                  <option value="{{ $seller_transport_address->id }}">{{ucwords($seller_transport_address->first_name.' '.$seller_transport_address->last_name)}} ({{$seller_transport_address->email}})</option>
                  @endforeach
                
               </select>
      </div>

       <div>
         <label for="private_marka">Private Marka:</label>
         {!! Form::text('private_marka', null, array('placeholder' => 'Enter Private Marka','class' => 'form-input','id'=>'Private Marka','required' => 'required')) !!}
      </div>
       <div>
         <label for="transport_name">Transport Name:</label>
         {!! Form::text('transport_name', null, array('placeholder' => 'Enter Transport Name','class' => 'form-input','id'=>'Transport Name','required' => 'required')) !!}
      </div>
       <div>
         <label for="transport_address">Transport Address:</label>
         {!! Form::text('transport_address', null, array('placeholder' => 'Enter Transport Address','class' => 'form-input','id'=>'Transport Address','required' => 'required')) !!}
      </div>
        <div>
         <label for="transport_contact_number">Transport Contact Number:</label>
         {!! Form::text('transport_contact_number', null, array('placeholder' => 'Enter Transport Contact Number','class' => 'form-input','id'=>'Transport Contact Number','required' => 'required')) !!}
      </div>
       <div>
         <label for="delivery_place">Delivery Place:</label>
         {!! Form::text('delivery_place', null, array('placeholder' => 'Enter Delivery Place','class' => 'form-input','id'=>'Delivery Place','required' => 'required')) !!}
      </div>
       <div>
         <label for="lr_copy_upload">Upload LR Copy/Visiting  Card:</label>
        {!! Form::file('lr_copy_upload', array('placeholder' => 'Upload Aadhar Card Certificate','class' => 'form-input','id'=>'lr_copy_upload','required' => 'required')) !!}
      </div>
    </div>
           
            
          
         </div>
         <button type="submit" class="btn btn-primary !mt-6">Submit</button>
        
            </div>
         {!! Form::close() !!}
      </div>
  
@endsection
