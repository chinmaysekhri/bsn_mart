@extends('admin.layouts.app')
@section('title','Add Prospective Buyer')
@section('content')


<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('prospectivebuyers.index')}}" class="text-primary hover:underline">Prospective Buyer</a>
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
         {!! Form::open(array('route' => 'prospectivebuyers.store','method'=>'POST','class'=>'space-y-5', 'enctype'=>'multipart/form-data')) !!}
           <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
           
            <div>
               <label for="business_name "><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Business Name</label>
               {!! Form::text('business_name', null, array('placeholder' => 'Business Name','class' => 'form-input','id'=>'business_name','required' => 'required')) !!}
            </div>
           
             <div>
               <label for="category_id"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Category</label>
                 <select class="form-select" id="choices-multiple-remove-button"  placeholder="Select Category" multiple name="category_id[]"  />
                  <option value="">--Select Category--</option>
                     @foreach($categoryData as $category)
                       <option value="{{$category->id}}">{{$category->category_name}}</option>  
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
               {!! Form::select('state', [''=>'Select State'],[], array('class' => 'form-select text-white-dark','id'=>'state')) !!}
            </div>
            <div>
               <label for="city">City</label>
               {!! Form::select('city', [''=>'Select City'],[], array('class' => 'form-select text-white-dark','id'=>'city')) !!}
            </div>
             <div>
               <label for="city">Status</label>
               
                <select class="form-select" id="Status" name="status_name" onchange="change_status();" required>
               
                 <option value="">Select Status</option>
                 <option value="Pending">Pending</option>
                 <option value="Interested">Interested</option>
                 <option value="Not Interested">Not Interested</option>
                 <option value="Onboarded">Onboarded</option>
                  </select>
            </div>
            
            <!-- <div>
               <label for="date_of_enrollment">Enrollment Date</label>
               {!! Form::date('date_of_enrollment', date('Y-m-d'), array('placeholder' => 'Date Of Enrollment','class' => 'form-input','id'=>'inputdate','required' => 'required')) !!}
            </div>-->
            
			 <div class="" id="payment_info_hide" style="display: none;">
                  <label for="date_of_enrollment"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Next Action Date
                  </label>
                  <input type="date" id="" name="date_of_enrollment" class="form-input" value=""> 

             </div>
            
            
             <div>
               <label for="city">Comment</label>
               {!! Form::text('comment', null, array('placeholder' => 'Enter Comment','class' => 'form-input','id'=>'comment','required' => 'required')) !!}
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Multiple dropdown Select and search Start28-11-2023 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script> -->

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

 <script>
// 30-01-2025 Start
    $('#payment_info').show();

    function change_status(){
        
       var status_name = $('#Status').val();
       
     
       if(status_name=='Not Interested'){
       
          $('#payment_info_hide').hide();
          $('#payment_info_hide').html(`<label for="date_of_enrollment"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Next Action Date
                        </label>
                        <input type="date" id="" name="date_of_enrollment" class="form-input" value="" >`);
       }
       else if(status_name=='Pending' || status_name=='Interested'  || status_name=='Onboarded')
       { 
        $('#payment_info_hide').show();

        $('#payment_info_hide').html(`<label for="date_of_enrollment"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Next Action Date
                        </label>
                        <input type="date" id="" name="date_of_enrollment" class="form-input" value="" required>`);


       }
     }
	 
// 30-01-2025 End
</script>

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