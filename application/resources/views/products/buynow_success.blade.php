@extends('admin.layouts.app')
@section('title','Order')
@section('content')
<div x-data="form">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{route('product_list')}}" class="text-primary hover:underline">Home</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Order</span>
        </li>
    </ul>
</div>

<br>
<div class="mb-5 flex items-center justify-between">
    <h5 class="text-lg font-semibold dark:text-white-light"></h5>
</div>
<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
    <div class="panel">
      <br>
      <br>
   
     <!-- Flash  Message  start -->
     <!--  <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center> -->
      <!-- Flash  Message  End  -->
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
                    <svg>...</svg>
                </button>
            </div>
            @endif
      
         <div class="vh-100 d-flex justify-content-center align-items-center">
            <div>
                <div class="mb-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                        fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16" style="margin-left: 460px;">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                </div>
                <div class="text-center">
                    <h1>Thank You !</h1>
                    <p style="font-size: x-large;color:green;">Your order has been placed successful!!</p>
                   <!--  <a href="{{route('products.index')}}"><button class="btn btn-primary">Back Home</button></a> -->
                </div>
            </div>
         
       
         
     
        
         
        
            
      </div>
   </div>
</div>
                  
      
@endsection
@push('script')


<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script> 
   $(function(){
    $('#alertMessageHide').delay(1000).fadeOut();
   });
</script>

@endpush