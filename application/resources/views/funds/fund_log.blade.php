@extends('admin.layouts.app')
@section('title','Add Fund Logs')
@section('content')
<div x-data="form">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{route('funds.index')}}" class="text-primary hover:underline">Add Fund Recipt</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Logs</span>
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
                <div class="mb-5">
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
							
							@foreach($fundComments as $comment)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$comment->created_at}}</td>
                                    <td>{{$comment->first_name.' '. $comment->last_name}}</td>
                                    <td>{{$comment->comment}}</td>
                                    
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