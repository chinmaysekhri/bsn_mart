@extends('admin.layouts.app')
@section('title','Edit Buyer Application')
@section('content')
<div x-data="form">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{route('buyerapplications.index')}}" class="text-primary hover:underline">Buyer Application</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit Buyer Application</span>
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
        {!! Form::model($buyerapplication, ['method' => 'PATCH','route' => ['buyerapplications.update', $buyerapplication->id],'class'=>'space-y-5', 'enctype'=>'multipart/form-data']) !!}
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <label for="first_name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>First Name</label>
               {!! Form::text('first_name', null, array('placeholder' => 'Enter First Name','class' => 'form-input','id'=>'first_name','required' => 'required')) !!}
            </div>
            <div>
               <label for="last_name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Last Name</label>
               {!! Form::text('last_name', null, array('placeholder' => 'Enter Last Name','class' => 'form-input','id'=>'last_name','required' => 'required')) !!}
            </div>
            <div>
               <label for="Mobile"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Contact</label>
               {!! Form::text('mobile', null, array('placeholder' => 'Enter Contact No','class' => 'form-input','id'=>'mobile','required' => 'required')) !!}
            </div>
            <div>
               <label for="Email"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Email:</label>
               {!! Form::text('email', null, array('placeholder' => 'Enter Email','class' => 'form-input','id'=>'email','required' => 'required')) !!}
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
            <div>
               <label for="country"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Country</label>
               {!! Form::text('country', null, array('placeholder' => 'Country','class' => 'form-input','id'=>'country')) !!}
            </div>
            <div>
               <label for="state">State</label>
               {!! Form::select('state',[$buyerapplication->state=>$buyerapplication->state],[], array('class' => 'form-select text-white-dark','id'=>'state')) !!}
            </div>
            <div>
               <label for="city">City</label>
               {!! Form::select('city', [$buyerapplication->city=>$buyerapplication->city],[], array('class' => 'form-select text-white-dark','id'=>'city')) !!}
            </div>
             <div>
               <label for="district ">District </label>
                {!! Form::select('district', [$buyerapplication->district=>$buyerapplication->district],[], array('class' => 'form-select text-white-dark','id'=>'district')) !!}
            </div>
         </div>
         <button type="submit" class="btn btn-primary !mt-6">Submit</button>
         {!! Form::close() !!}
      </div>
   </div>
</div>

@endsection

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
         $('#district').html('');
          const district = result.state_city_data[0].district;
     
          $.each(result.state_city_data, function(key, value) {
          
          $('#state').append('<option value="'+value.state+'">'+value.state+'</option>');
          
          $('#city').append('<option value="'+value.post_office+'">'+value.post_office+'</option>');
      
        });   
          $('#district').append('<option value="'+district+'">'+district+'</option>');
       }
   
      }
     });
    
   }
      
</script>