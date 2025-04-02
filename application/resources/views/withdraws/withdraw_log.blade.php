@extends('admin.layouts.app')
@section('title','View Withdraw Comment')
@section('content')
<div x-data="form">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{route('withdraws.index')}}" class="text-primary hover:underline">Withdraw</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>View Comment</span>
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
                    <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80">
                        <svg> ... </svg>
                    </button>
                </div>
                @endif
                <!-- <div class="mb-5 flex items-center justify-between
				
                    <h5 class="text-lg font-semibold dark:text-white-light">Client Detail</h5>
                </div> -->
                <div class="mb-5">

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <div>
                            <label for="Address">
                                <strong>Date:</strong>
                                12/12/23
                            </label>
                        </div>
                        <div>
                            <label for="Contact">
                                <strong>Amount:</strong>
                                5000
                            </label>
                        </div>
                        <div>
                            <label for="Address">
                                <strong>Recipt Number:</strong>
                                1234567890
                            </label>
                        </div>
                        <div>
                            <label for="Contact">
                                <strong>Recipt:</strong>
                                <a href="#" download="#">
                                    <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;margin-left:150px; margin-top: -24px;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                            <path opacity="0.5" d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        Download
                                    </button>
                                </a>
                                <a href="#" target="_blank">
                                    <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -24px;margin-left:260px;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="margin-left: -13px;">
                                            <path opacity="0.5" d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z" stroke="currentColor" stroke-width="1.5"></path>
                                            <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                                        </svg>
                                        View
                                    </button>
                                </a>
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- <div class="mb-5 flex items-center justify-between">
                    <h5 class="text-lg font-semibold dark:text-white-light">Client Detail</h5>
                </div> -->
                <div class="mb-5 mt-5">

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <div>
                            <label for="Address">
                                <strong>Account Holder Name:</strong>
                                Sahil
                            </label>
                        </div>
                        <div>
                            <label for="Contact">
                                <strong>Bank Name:</strong>
                                Sbi
                            </label>
                        </div>
                        <div>
                            <label for="Address">
                                <strong>Bank Account Number:</strong>
                                1234567890
                            </label>
                        </div>
                        <div>
                            <label for="Contact">
                                <strong>IFSC Code:</strong>
                                SBIN122156
                            </label>
                        </div>
                    </div>
                </div>
                <div class="dataTable-container">
                    <table id="myTable1" class="whitespace-nowrap dataTable-table">
                        <thead>
                            <tr style="background: radial-gradient(#7fd9a7f7, transparent);">
                                <th>S.No</th>
                                <th>Logs Date</th>
                                <th>Commented By</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
					
							 @php $i=1; @endphp
							 
							 @foreach($withdrawalComments as $comment)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$comment->created_at}}</td>
                                    <td>{{$comment->first_name.' '. $comment->last_name}}</td>
                                    <td>{{$comment->withdrawal_comment}}</td>
                                    
                                </tr>
								@endforeach
							
							
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>





@endsection