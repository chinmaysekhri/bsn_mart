@php

use App\Helpers\Helper;

use App\Models\Fund;

use App\Models\Withdrawal;

use App\Models\User;
use App\Models\Product;

$auth_user = Auth::user();

@endphp

@extends('admin.layouts.app')
@section('title','Seller List')
@section('content')
<div x-data="form">
    <div class="panel">
        <!-- Flash  Message  start -->
        <center id="alertMessageHide">@if ($message = Session::get('success'))
            <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
            @endif
        </center>
        <!-- Flash  Message  End  -->



        <h5 class="mb-50 text-lg font-semibold dark:text-white-light md:absolute md:top-[30px] md:mb-0">
            @can('seller-create')
            <a class="badge bg-success" href="{{route('sellers.create')}}">Create New Seller</a>
            @endcan
            <a href="{{route('sellers.index')}}" class="btn btn-primary" style="margin-left: 775px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

            <a href="#"><button class="btn btn-info" onclick="mystatusFunction()" style="margin-left:150px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>

        </h5>
        <br>
        <br>
        <br>


        @if(count($data) > 0)

        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
            <?php /*<div class="dataTable-top">
            @include('admin.partials.search')
         </div> */ ?>

            <form method="GET" action="{{route('sellers.index')}}">

                <div class="mb-5" id="mystatusDIV" style="display: none;">


                    <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                        <label style="margin-top:50px;">Applied On:</label>
                        <div style="margin-top:35px;">
                            <a href="{{route('sellers.index',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;">Today</a>
                        </div>
                        <div class="" style="margin-top:7px;">

                            <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;" />
                        </div>
                        <div class="" style="margin-top:7px;">

                            <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;" />
                        </div>
                        <div style="margin-top: 36px;">
                            <div class="search-date-group ms-5 d-flex align-items-center">
                                <select class="form-input" name="today_applied_status" id="seller_status">
                                    <option value="">Select Status Type</option>
                                    <option value="Active" @if(Request::input('today_applied_status')=='Active' ) selected @endif>Active</option>
                                    <option value="Deactive" @if(Request::input('today_applied_status')=='Deactive' ) selected @endif>Deactive</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-3">

                        <div class="flex flex-wrap items-center justify-center gap-2" style="margin-left: 99px;">
                            <div class="search-date-group ms-5 d-flex align-items-center">
                                <input type="text" class="form-input" name="q" id="search" value="@if(isset($reqData['q'])) {{$reqData['q'] }} @endif" placeholder="Search Seller Name,Email,Mobile....." style="width:300px;margin-right:63px;">

                            </div>
                        </div>
                        <div class="search-date-group ms-5 d-flex align-items-center">
                            <select class="form-input" name="employee_pincode" id="employee_pincode">
                                <option value="">Select Pincode</option>
                                <?php $uniquePincodes = []; ?>
                                @foreach ($pincodes as $pincode)
                                @if (!in_array($pincode, $uniquePincodes))
                                <?php $uniquePincodes[] = $pincode; ?>
                                <option value="{{ $pincode }}" @if(Request::input('employee_pincode')==$pincode) selected @endif>
                                    {{ $pincode }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            <select class="form-input" name="employee_users" id="employee_users">
                                <option value="">Select users</option>
                                @foreach ($managers as $users)
                                <option value="{{ $users->id }}" @if(Request::input('employee_users')==$users->id) selected @endif>
                                    {{ $users->first_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-outline-success" style="padding-right: 64px;padding-left:64px;">Submit</button>
                        </div>

                    </div>

                </div>

            </form>

            <div class="dataTable-container">

                <table id="myTable1" class="whitespace-nowrap dataTable-table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Seller Id</th>
                            <th>Date Of Enrollment</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Business Name</th>
                            <th>Mobile No</th>
                            <th>Wallet Balance</th>
                            <th>Total Product</th>
                            <th>Status</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $seller)

                        @php

                        $myProductCount = Product::where('seller_id','=', $seller->id)->whereNotIn('product_status',['On Hold','Out Of Stock'])
                        ->whereNotIn('user_product_status',['On Hold'])->orderBy('id','DESC')->count();

                        $sellerBuyerID = User::where('for','=', 'seller')->where('seller_id','=', $seller->id)->first();

                        if(!empty($sellerBuyerID)){

                        $getSellerNameData = Helper::getWalletData($sellerBuyerID->id);

                        }else{

                        $getSellerNameData = Helper::getWalletData(0);
                        }




                        @endphp

                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>JBNS000{{ $seller->id }}</td>
                            <td>{{ $seller->date_of_enrollment }}</td>
                            <td>{{ $seller->first_name.' '.$seller->last_name}}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->business_name }}</td>
                            <td>{{ $seller->mobile }}</td>
                            <td>{{ $getSellerNameData['total_wallet_amount'] }}</td>
                            <td>{{ $myProductCount}}</td>

                            @if($seller->status==1)
                            <td class="text-success">Active</td>
                            @else
                            <td class="text-danger">Deactive</td>
                            @endif



                            <td>
                                <a class="badge bg-success" href="{{ route('myproduct',Crypt::encrypt($seller->id)) }}" target="_blank">Catalogue</a>
                                <a class="badge bg-info" href="{{ route('sellers.show',$seller->id) }}">Show</a>
                                @can('seller-edit')
                                <!--11-03-2025 for hold value after serch data -->
                                <a class="badge bg-primary" href="{{ route('sellers.edit', array_merge([$seller->id],$requested_input)) }}">Edit</a>
                                @endcan
                                @can('seller-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['sellers.destroy', $seller->id],'style'=>'display:inline', 'id'=>"form".$seller->id]) !!}
                                {!! Form::button('Delete', ['class' => 'badge bg-danger', 'onclick'=>"confirmDelete($seller->id)"]) !!}
                                {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links('admin.partials.pagination')}}
        </div>
        @else
        <h1 style="color:red; text-align:center">No Record Found!!</h1>
        @endif
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
    $(function() {
        $('#alertMessageHide').delay(5000).fadeOut();
    });
</script>
<script>
    function confirmDelete(varForm) {
        var r = confirm("Are you sure you wish to delete this entry?");

        if (r == true) {
            document.getElementById("form" + varForm).submit();
        }
    }
</script>

<script>
    function mystatusFunction() {
        var x = document.getElementById("mystatusDIV");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
@endpush