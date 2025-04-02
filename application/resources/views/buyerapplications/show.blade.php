@extends('admin.layouts.app')
@section('title','Show Buyer Application')
@section('content')
<div x-data="form">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{route('buyerapplications.index')}}" class="text-primary hover:underline">Buyer Application</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Show Buyer Application</span>
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
                <h5 class="text-lg font-semibold dark:text-white-light">Buyer Application Detail</h5>
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
                        <label for="Address">
                            <strong>Created By:</strong>
                            @if(!empty($user_emp))
                  {{ $user_emp->first_name .' '. $user_emp->last_name }}
                  @endif
                        </label>
                    </div>
                    <div>
                        <label for="Contact">
                            <strong>Created Date:</strong>
                            {{ $buyerapplication->created_at }}
                        </label>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="Address">
                            <strong>Name</strong>
                          {{ $buyerapplication->first_name.' '.$buyerapplication->last_name}}

                        </label>
                    </div>
                    <div>
                        <label for="Contact">
                            <strong>
                                Contact:</strong>
                           {{ $buyerapplication->mobile}}
                        </label>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <div>
                        <label for="Contact">
                            <strong>Email:</strong>
                           {{ $buyerapplication->email}}
                        </label>
                    </div>
                    <div>
                        <label for="gridEmail">
                            <strong>Gender:</strong>
                           {{ $buyerapplication->gender}}
                        </label>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <div>
                        <label for="Contact">
                            <strong>Present Address:</strong>
                          {{ $buyerapplication->present_address}}

                        </label>
                    </div>
                     <div>
                        <label for="gridEmail">
                            <strong>Pin Code:</strong>
                           {{ $buyerapplication->pin_code}}
                        </label>
                    </div>
                     
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="Contact">
                            <strong>State:</strong>
                           {{ $buyerapplication->state}}
                        </label>
                    </div>
                    <div>
                        <label for="Contact">
                            <strong>District:</strong>
                          {{ $buyerapplication->district}}
                        </label>
                    </div>
                </div>
               
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="Contact">
                            <strong>country:</strong>
                           {{ $buyerapplication->country}}
                        </label>
                    </div>
                   

                </div>
               
            </div>

        </div>
    </div>
</div>





@endsection