@extends('admin.layouts.app')
@section('title','Show Fund Logs')
@section('content')
<div x-data="form">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{route('funds.index')}}" class="text-primary hover:underline">Add Fund List</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>View Fund Logs</span>
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
                <!-- <div class="mb-5 flex items-center justify-between
				
                    <h5 class="text-lg font-semibold dark:text-white-light">Client Detail</h5>
                </div> -->
                <div class="mb-5">

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                       @if(!empty($fund->payment_fund_id))
                        <div>
                            <label for="Payment">
                                <strong>Payment ID:</strong>
								{{$fund->payment_fund_id}}
                            </label>
                        </div>
						@endif
						
						@if(!empty($fund->updated_at))
                        <div>
                            <label for="Logs">
                                <strong>Logs Date:</strong>
								{{$fund->updated_at}}
                            </label>
                        </div>
						@endif
                        <div>
						@if(!empty($fundCommentBy->first_name))
                            <label for="Contact">
                                <strong>Commented By:</strong>
                                {{$fundCommentBy->first_name.' '.$fundCommentBy->last_name}}
								
                            </label>
						@endif
                        </div> 
						<div>
						@if(!empty($fund->comment))
                            <label for="comment">
                                <strong>Comment:</strong>
                                {{$fund->comment}}
                            </label>
						@endif
                        </div>
						<div>
						@if(!empty($fund->fund_status))
                            <label for="fund status">
                                <strong>Fund Updated Status:</strong>
                                {{$fund->fund_status}}
                            </label>
						@endif
                        </div>
						
                    </div>
                   </div>
                </div>

            </div>
        </div>
    </div>
@endsection