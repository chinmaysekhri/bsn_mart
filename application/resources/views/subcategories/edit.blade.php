@extends('admin.layouts.app')
@section('title','Edit Sub Category')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('subcategories.index')}}" class="text-primary hover:underline">Sub Category</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Edit Sub Category</span>
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
         {!! Form::model($subcategory, ['method' => 'PATCH','route' => ['subcategories.update', $subcategory->id],'class'=>'space-y-5', 'enctype'=>'multipart/form-data']) !!}
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
               <div class="">
               <label for="sub_category">Category</label> 
			   {{-- <input class="typeahead form-input"  name="category_name" value="{{ $cate->category_name }}" id="search" type="text">  --}}
               			   
                <select class="form-input" name="category_id" id="category_id" required="">
                  <option value="">--Select Category--</option>
                  @foreach($categoryData as $category)
                 <!--  <option value="{{ $subcategory->id }}">{{ $subcategory->category_name }}</option> -->
                  <option value="{{ $category->id }}" @if($subcategory->category_id == $category->id) selected @endif>{{ $category->category_name }}</option>
                  @endforeach
               </select>
			   --}}
            </div>

            </div>
             <div>
               <label for="sub_category_name">Sub Category Name</label>
               {!! Form::text('sub_category_name', null, array('placeholder' => 'Enter Sub Category Name','class' => 'form-input','id'=>'sub_category_name','required' => 'required')) !!}
            </div>
          </div>
           
            
           <input id="status" type="hidden" name="status" placeholder="" value="0" class="form-input" />
         </div>
         <button type="submit" class="btn btn-primary !mt-6">Submit</button>
        
            </div>
         {!! Form::close() !!}
      </div>
  
@endsection


@push('head')

    <style>
.dropdown-menu {
    position: absolute;
    z-index: 1005;
    display: none;
    min-width: 31.25rem;
    padding: 0.5rem;
    margin: 0px;
    font-size: 1rem;
    color: rgb(14 23 38 / var(--tw-text-opacity));
    text-align: left;
    list-style: none;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .15);
    border-radius: 0.25rem;
}
	</style>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

@endpush

@push('script')

<script type="text/javascript">
    var path = "{{ route('category_autocomplete') }}";
  
    $('#search').typeahead({
            source: function (query, process) {
                return $.get(path, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
  
</script>

@endpush