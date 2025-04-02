@extends('admin.layouts.app')
@section('title','Edit Seller Transport Address')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('sellertransportaddresses.index')}}" class="text-primary hover:underline"> Transport Address</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Edit</span>
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
            
         </div>
         @endif
         
        {!! Form::model($seller_transport_address, ['method' => 'PATCH','route' => ['sellertransportaddresses.update', $seller_transport_address->id],'class'=>'space-y-5', 'enctype'=>'multipart/form-data']) !!}
           
        <!--11-03-2025 for hold value after search data -->
	  
			@if(!empty($requested_input))

			@foreach($requested_input as $requested_input_key => $requested_input_val)
				<input type="hidden" name="req_{{$requested_input_key}}" value="{{$requested_input_val}}">
			@endforeach
			
			@endif
			
		<!--11-03-2025 for hold value after search data End -->
         
        <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-2">
        <div>
         <label for="first_name">Select Buyer Name</label>
         <select class="form-input form-select" name="seller_id" id="seller_id" required="">
                  <option value="">--Select Category--</option>
                   @foreach($sellerData as $seller_trans_address)
                  <option value="{{ $seller_trans_address->id }}" @if($seller_transport_address->seller_id == $seller_trans_address->id) selected @endif>{{ ucwords($seller_trans_address->first_name.' '.$seller_trans_address->last_name) }}</option>
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
         <label for="Visiting">Upload LR Copy/Visiting  Card:</label>
        {!! Form::file('lr_copy_upload', array('placeholder' => 'Upload Aadhar Card Certificate','class' => 'form-input','id'=>'lr_copy_upload')) !!}
		    <a href="{{asset('public/uploads/transport_address/lr_copy_upload/'.$seller_transport_address->lr_copy_upload)}}" target="_blank" >
									
                <img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="{{asset('public/uploads/transport_address/lr_copy_upload/'.$seller_transport_address->lr_copy_upload)}}">
          
          </a>
		
      </div>	
   </div>		
           
            
          
         </div>
         <button type="submit" class="btn btn-primary !mt-6">Submit</button>
        
            </div>
         {!! Form::close() !!}
      </div>
  
@endsection
