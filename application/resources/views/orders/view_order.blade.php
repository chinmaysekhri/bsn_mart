@extends('admin.layouts.app')
@section('title','View Order')
@section('content')
<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <div x-data="form">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li>
                    <a href="{{route('buyer_order')}}" class="text-primary hover:underline">Orders</a>
                </li>
                <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                    <span>Show Order</span>
                </li>
            </ul>
        </div><br>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 p-5">
        <div>
            <label for="">
                <strong>Date:</strong><br>
                13-12-23
            </label>
        </div>
        <div>
            <label for="">
                <strong>Part Name:</strong><br>
                Sahil Sahni
            </label>
        </div>
        <div>
            <label for="">
                <strong>Order Id:</strong><br>
                132456
            </label>
        </div>

        <div>
            <button type="button" class="btn btn-outline-primary flex" :class="{ 'text-white bg-primary': selectedTab === 'personal' }" @click="tabChanged('personal')" onClick="window.print()">
                Print
            </button>
        </div>

    </div>
    <div>
        <div class="dataTable-wrapper">
            <table class=" table table-hover ">
                <div class=" d-flex">
                    <h5 class="text-lg font-semibold dark:text-white-light w-50 pl-3">Order Details</h5>
                </div>
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col" class="w-15">Product Image</th>
                        <th scope="col">Product Id</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total Delivered</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td><img src={{"public/admin/assets/images/profile-9.jpeg"}} alt="" class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2"></td>
                        <td>12</td>
                        <td>sahil</td>
                        <td>10</td>
                        <td>10</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td scope="row">2</td>
                        <td><img src={{"public/admin/assets/images/profile-9.jpeg"}} alt="" class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2"></td>
                        <td>13</td>
                        <td>sahni</td>
                        <td>20</td>
                        <td>20</td>
                        <td>20</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-end px-4">
            <div class="w-full md:w-80 font-semibold p-5">
                <div class="flex items-center justify-between py-2">
                    <span>Sub Total :</span>
                    <span> ₹989.94</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <span>Portal Fees :</span>
                    <span>- ₹44.99</span>
                </div>
                <div class="flex items-center justify-between font-bold py-4 border-t dark:border-t-dark border-dashed">
                    <span>Final Amount :</span>
                    <span id="total"> ₹1,049.94</span>
                </div>
               
            </div>
        </div>
        <hr>
        <div class="dataTable-wrapper">
            <table class=" table">
                <div class="d-flex">
                    <h5 class="text-lg font-semibold dark:text-white-light w-50 pl-3">Transport Details</h5>
                </div>
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Transport Name</th>
                        <th scope="col">Private Marca</th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact Number</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td>Dart</td>
                        <td>sahil</td>
                        <td>E-29</td>
                        <td>1324567890</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="d-flex">
            <h5 class="text-lg font-semibold dark:text-white-light w-50 pl-3">Transport Copy</h5>
        </div>
        <div class="text-cntr p-5 ">
            <!-- Transport Copy -->
            <img src={{"public/admin/assets/images/profile-9.jpeg"}} alt="" class="save_button" style="border-radius: 5%;">
        </div>
    </div>
</div>
</div>
</div>
 @endsection