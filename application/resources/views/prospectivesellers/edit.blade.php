@extends('admin.layouts.app')
@section('title','Edit Prospective Seller')
@section('content')


<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('prospectivesellers.index')}}" class="text-primary hover:underline">Prospective Seller</a>
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
            <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80">
               <svg> ... </svg>
            </button>
         </div>
         @endif
       {!! Form::model($pros_seller, ['method' => 'PATCH','route' => ['prospectivesellers.update', $pros_seller->id],'class'=>'space-y-5', 'enctype'=>'multipart/form-data']) !!} 
      
	    <!--29-05-2024 for hold value after serch next action date -->
	  
	    @if(!empty($requested_input))

		@foreach($requested_input as $requested_input_key => $requested_input_val)
			<input type="hidden" name="req_{{$requested_input_key}}" value="{{$requested_input_val}}">
		@endforeach
		
        @endif
		
	    <!--29-05-2024 for hold value after serch next action date End-->
	  
           <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
           
            <div>
               <label for="business_name "><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Business Name</label>
               {!! Form::text('business_name', null, array('placeholder' => 'Business Name','class' => 'form-input','id'=>'business_name','required' => 'required')) !!}
            </div>
            <div>
               <label for="brand_name "><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Brand Name</label>
               {!! Form::text('brand_name', null, array('placeholder' => 'Brand Name','class' => 'form-input','id'=>'brand_name','required' => 'required')) !!}
            </div>
            @php
      
      $cat_data=json_decode($pros_seller->category_id ,true);
      
        if(empty($cat_data)){
        
        $cat_data=[];
      }
      @endphp
             <div>
               <label for="category_id"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Category</label>
                 <select class="form-select" id="choices-multiple-remove-button"  placeholder="Select Category" multiple name="category_id[]" />
                  
                    <option value="">--Select Category--</option>
                    
           @foreach($categoryData as $category)
            <option value="{{ $category->id }}" @if(in_array(''.$category->id, $cat_data)) selected @endif >{{ $category->category_name }}</option> 
            @endforeach
                  
                    </select>
            </div>
            
            <div>
               <label for="Name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>First Name</label>
               {!! Form::text('first_name', null, array('placeholder' => 'Enter First Name','class' => 'form-input','id'=>'Name','required' => 'required')) !!}
            </div>
            <div>
               <label for="last_name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Last Name</label>
               {!! Form::text('last_name', null, array('placeholder' => 'Enter Last Name','class' => 'form-input','id'=>'last_name','required' => 'required')) !!}
            </div>
            <div>
               <label for="Mobile"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Contact</label>
               {!! Form::text('contact', null, array('placeholder' => 'Enter Mobile No','class' => 'form-input','id'=>'Mobile','required' => 'required')) !!}
            </div>
            <div>
               <label for="Email"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Email:</label>
               {!! Form::text('email', null, array('placeholder' => 'Enter Email','class' => 'form-input','id'=>'Email','required' => 'required')) !!}
            </div>
           
            <div class="flex justify-around pt-5">
               <label for="name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Gender :</label>
               <label class="inline-flex cursor-pointer">Male</label>
               <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" value="Male" checked>
               <label class="inline-flex cursor-pointer">Female</label>
               <input class="form-radio cursor-pointer ltr:mr-4 rtl:ml-4" type="radio" name="gender" value="Female"/>
            </div>
            <div>
               <label for="present_address"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Present Address</label>
               {!! Form::text('present_address', null, array('placeholder' => 'Enter Present Address','class' => 'form-input','id'=>'present_address','required' => 'required')) !!}
            </div>
            <div>
               <label for="pin_code"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Pin Code</label>
               {!! Form::number('pin_code', null, array('placeholder' => 'Enter Pin Code','class' => 'form-input','id'=>'pin_code', 'onkeyup'=>'getStateCity(this);', 'maxlength'=>'6')) !!}
            </div>
           <!-- <div>
               <label for="Country"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Country</label>
               {!! Form::text('country', null, array('placeholder' => 'Country','class' => 'form-input','id'=>'Country')) !!}
            </div>-->
             <div>
               <label for="state">State</label>
               {!! Form::select('state',[$pros_seller->state=>$pros_seller->state],[], array('class' => 'form-select text-white-dark','id'=>'state')) !!}
            </div>
            <div>
               <label for="city">City</label>
                {!! Form::select('city', [$pros_seller->city=>$pros_seller->city],[], array('class' => 'form-select text-white-dark','id'=>'city')) !!}
            </div>
             <div>
               <label for="city">Status</label>
               <select class="form-select text-white-dark" id="Status" name="status_name" onchange="change_status();" required/>
                    <option value="" >Select Status</option>
                    <option value="Fresh" @if($pros_seller->status_name == "Fresh") selected @endif >Fresh</option>
                    <option value="Pending" @if($pros_seller->status_name == "Pending") selected @endif >Pending</option>
                    <option value="Interested" @if($pros_seller->status_name == "Interested") selected @endif>Interested</option>
                    <option value="Not Interested" @if($pros_seller->status_name == "Not Interested") selected @endif>Not Interested</option>
                    <option value="Onboarded" @if($pros_seller->status_name == "Onboarded") selected @endif>Onboarded</option>
                     <option value="Not Connected" @if($pros_seller->status_name == "Not Connected") selected @endif>Not Connected</option>
                        <option value="Docs Pending" @if($pros_seller->status_name == "Docs Pending") selected @endif>Docs Pending</option>
                        <option value="Meeting Confirmed" @if($pros_seller->status_name == "Meeting Confirmed") selected @endif>Meeting Confirmed</option>
                  </select>
            </div>
            <!--date: 29-05-2024 Start -->
            <div>
               <label for="city">Seller Type</label>
               <select class="form-select" id="seller_type" name="seller_type"  required>
                    <option value="">Select Seller Type</option>
                    <option value="Manufacturer" @if($pros_seller->seller_type == "Manufacturer") selected @endif >Manufacturer</option>
                    <option value="Trader" @if($pros_seller->seller_type == "Trader") selected @endif >Trader</option>
                    <option value="Importer" @if($pros_seller->seller_type == "Importer") selected @endif >Importer</option>
                  </select>
            </div>
            <div>
               <label for="city">Deals In</label>
               <select class="form-select" id="deals_in" name="deals_in" required>
                 <option value="">Select Deals In</option>
                 <option value="Spare Parts" @if($pros_seller->deals_in == "Spare Parts") selected @endif >Spare Parts</option>
                 <option value="Finished Goods" @if($pros_seller->deals_in == "Finished Goods") selected @endif >Finished Goods</option>
                 <option value="Both" @if($pros_seller->deals_in == "Both") selected @endif >Both</option>
                
                  </select>
            </div>
            
           <!--  <div class="" id="payment_info_hide" style="display: none;">-->
           
                 	<div class="" id="payment_info_hide" style="display: @if($pros_seller->status_name=='Pending' || $pros_seller->status_name=='Interested' || $pros_seller->status_name=='Not Connected' || $pros_seller->status_name=='Docs Pending' || $pros_seller->status_name=='Meeting Confirmed' || $pros_seller->status_name=='Onboarded')block @else none  @endif;">
              
                        <label for="next_action_date"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Next Action Date
                       
                        </label>
                        <input type="date" id="" name="next_action_date" class="form-input" value="{{$pros_seller->next_action_date}}"> 

                    </div>
                     <div class="" id="payment_info" style="display: none;">
                       <label for="comment"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Comment
                        </label>
                     <input type="text" id="" name="comment" class="form-input" value="" required="">

                    </div>
          </div>
         <button type="submit" class="btn btn-primary !mt-6">Submit</button>
         <!--<div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="submit" class="btn btn-danger">Clear</button>
            </div>-->
         {!! Form::close() !!}
      </div>
   </div>
</div>
@endsection
@push('script')


<!--<script>
   //$('#payment_info').show();
   $('#payment_info_hide').hide();

  function change_status(){
      
     var status_name = $('#Status').val();
     
   
     if(status_name=='Not Interested' || status_name=='Fresh' || status_name=='Onboarded'){
     
        $('#payment_info_hide').hide();
         document.getElementById('next_action_date').value='';
     }
     else 
     { 
      $('#payment_info_hide').show();
      var current_date = new Date();
      var date = '';
      var month = current_date.getMonth();
      if(current_date.getMonth()<10)
      {
        month = month+1;
        month = "0"+month;
        
      }
      else
      {
        month = month+1;
        
      }

      if(current_date.getDate()<10)
      {
        
        date = "0"+current_date.getDate();
      }
      else
      {
        date = current_date.getDate();
      }

        current_date = current_date.getFullYear()+"-"+month+"-"+date;
      $('#next_action_date').val(current_date);
     }
   }
</script>-->
   <script>
      $('#payment_info').show();
      $('#payment_info_hide').hide();
  </script>
        @if(isset($pros_seller->status_name))
        @if($pros_seller->status_name=='Pending' || $pros_seller->status_name=='Interested' || $pros_seller->status_name=='Not Connected' || $pros_seller->status_name=='Docs Pending' || $pros_seller->status_name=='Meeting Confirmed')
      <script>
        $('#payment_info_hide').show();
      </script>
    @else
      <script>
       $('#payment_info').show();
       $('#payment_info_hide').hide();
      </script>
    @endif
  @endif

  <script>
    $('#payment_info').show();
    function change_status(){
        
       var status_name = $('#Status').val();
       
      //alert('status_name');
       if(status_name=='Fresh' || status_name=='Not Interested'){
       
          $('#payment_info_hide').hide();
          $('#payment_info_hide').html(`<label for="next_action_date"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Next Action Date
                        </label>
                        <input type="date" id="" name="next_action_date" class="form-input" value="" >`);
       }
        else if(status_name=='Pending' || status_name=='Interested' || status_name=='Not Connected' || status_name=='Docs Pending' || status_name=='Meeting Confirmed' || status_name=='Onboarded')
       { 
        $('#payment_info_hide').show();

        $('#payment_info_hide').html(`<label for="next_action_date"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Next Action Date
                        </label>
                        <input type="date" id="" name="next_action_date" class="form-input" value="" required>`);
       }
     }
</script>
<!-- change_status end -->
<script>
   $(document).ready(function(){
      
       var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
          removeItemButton: true,
          maxItemCount:50,
          searchResultLimit:50,
          renderChoiceLimit:50
        }); 
       
       
   });
   
</script>
<!-- search bar and district data -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
   $(function(){
       var dtToday = new Date();
       var month = dtToday.getMonth() + 1;
       var day = dtToday.getDate();
       var year = dtToday.getFullYear();
       if(month < 10)
           month = '0' + month.toString();
       if(day < 10)
           day = '0' + day.toString();
       
       var maxDate = year + '-' + month + '-' + day;
      $('#inputdate').attr('min', maxDate);
   });
</script>
<!-- Date Picker End-->
<script>
   function getStateCity(element){
      
      var pincode = element.value;
      
       var token = "{{ csrf_token() }}";
       var url = "{{ route('get_state_city') }}";
   
       $.ajax({
         url:url,
         type: 'POST',
         data: { _token :token,pincode:pincode },
         success:function(result){
      
            if(result.state_city_data.length > 0){
   
               $('#state').html('');
               $('#city').html('');
               
             $.each(result.state_city_data, function(key, value) {
               
              $('#state').append('<option value="'+value.state+'">'+value.state+'</option>');
              
              $('#city').append('<option value="'+value.post_office+'">'+value.post_office+'</option>');
              
            }); 
   
            }
   
         }
       });
    
   }
   

   
</script>


@endpush