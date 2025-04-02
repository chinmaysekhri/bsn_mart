@extends('admin.layouts.app')
@section('title','Manage Buyer Order')
@section('content')


    <div>
        <div class="animate__animated p-6" :class="[$store.app.animation]">
            <div x-data="form">
                <ul class="flex space-x-2 rtl:space-x-reverse">
                    <li>
                        <a href="#" onclick="history.back()" class="text-primary hover:underline">Manage Orders</a>
                    </li>
                    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                        <span>Seller</span>
                    </li>
                </ul>
            </div>
            <!-- start main content section -->
            <div x-data="invoiceList">
                <script src="assets/js/simple-datatables.js"></script>
                <div class="panel border-[#e0e6ed] px-0 dark:border-[#1b2e4b]">
                    <div class="px-5">
                        <div class="md:absolute md:top-5 ltr:md:left-5 rtl:md:right-5">
                            <div class="mb-5 flex items-center gap-2"></div>
                        </div>
                    </div>
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Product Image</th>
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <!-- Total Order Logs OnClick -->
                                <th>Total Orders</th>
                                <!-- Total Delivered Logs OnClick -->
                                <th>Total Delivered</th>
                                <th>Pending Order</th>
                                <!-- Total Returned Order Logs OnClick -->
                                <th>Total Returned</th>
                                <th>Final Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><img src={{"public/admin/assets/images/profile-9.jpeg"}} alt="" class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2"></td>
                                <td>12/3/23</td>
                                <td>Bsn</td>
                                <td><button onclick="total_orders()">1000</button></td>
                                <td><button onclick="total_delivered()">1000</button></td>
                                <td>10000</td>
                                <td><button onclick="returned_orders()">1000</button></td>
                                <td>10000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Total Order Logs OnClick -->
        <div id="myDIV" style="display: none;">
            <div class="mb-5">
                <div class="dataTable-container">
                    <table id="myTable1" class="whitespace-nowrap dataTable-table">
                        <thead>
                            <tr style="background: radial-gradient(#7fd9a7f7, transparent);">
                                <th>S.No</th>
                                <th>Date</th>
                                <th>Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>28/11/23</td>
                                <td>sahil</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Total Delivered Logs OnClick -->
        <div id="myDIV2" style="display: none;">
            <div class="mb-5">
                <div class="dataTable-container">
                    <table id="myTable1" class="whitespace-nowrap dataTable-table">
                        <thead>
                            <tr style="background: radial-gradient(#7fd9a7f7, transparent);">
                                <th>S.No</th>
                                <th>Date</th>
                                <th>Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>28/11/23</td>
                                <td>sahni</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Total Returned Order Logs OnClick -->
        <div id="myDIV3" style="display: none;">
            <div class="mb-5">
                <div class="dataTable-container">
                    <table id="myTable1" class="whitespace-nowrap dataTable-table">
                        <thead>
                            <tr style="background: radial-gradient(#7fd9a7f7, transparent);">
                                <th>S.No</th>
                                <th>Date</th>
                                <th>Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>28/11/23</td>
                                <td>sahil</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @push('script')
    <script>
        function total_orders() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function total_delivered() {
            var x = document.getElementById("myDIV2");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function returned_orders() {
            var x = document.getElementById("myDIV3");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
  @endpush