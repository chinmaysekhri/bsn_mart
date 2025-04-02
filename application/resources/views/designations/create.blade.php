@extends('admin.layouts.app')
@section('title','Add  Designation')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('designations.index')}}" class="text-primary hover:underline"> Designation</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Add  Designation</span>
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
         {!! Form::open(array('route' => 'designations.store','method'=>'POST','class'=>'space-y-5', 'enctype'=>'multipart/form-data')) !!}
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            
             <div>
               <label for="designation_name"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Designation Name</label>
               {!! Form::text('designation_name', null, array('placeholder' => 'Enter Designation  Name','class' => 'form-input','id'=>'designation_name','required' => 'required')) !!}
            </div>
          </div>
           
         </div>
         <button type="submit" class="btn btn-primary !mt-6">Submit</button>
        
            </div>
         {!! Form::close() !!}
      </div>
  
@endsection
