@extends('admin.layouts.app')
@section('title','Show Sub Category Detail')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{ route('subcategories.index') }}" class="text-primary hover:underline">Sub Category</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Sub Category Details</span>
      </li>
   </ul>
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
      <!-- Grid -->
      <div class="panel">
         <!-- Flash  Message  start -->
         <center id="alertMessageHide">@if ($message = Session::get('success'))
            <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
            @endif
         </center>
         <!-- Flash  Message  End  -->
         <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">Show Sub Category Detail</h5>
         </div>
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
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="UserID">
                  <strong>Category:</strong>
                 {{ $cate->category_name }}
                  </label>
               </div>
               <div>
                  <label for="UserID">
                  <strong>Sub Category Name:</strong>
                   {{ $cate->sub_category_name }}
                  </label>
               </div>
              
            </div>
   
         </div>
      </div>
   </div>
</div>

@endsection
@push('script')
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript"> 
   $(function(){
    $('#alertMessageHide').delay(5000).fadeOut();
   });
</script>
  
@endpush