@extends('admin.layouts.app')
@section('title','Manage Buyer Order')
@section('content')

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
                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Buyer/Seller Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Update Status</th>
                            <th>View Order</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>12/3/23</td>
                            <td>Bsn</td>
                            <td>10000</td>
                            <td>Pending</td>
                            <td>

                                <div class="">

                                    <!-- button -->
                                    <div class="flex items-center ">
                                        <!-- <button type="button" class="btn btn-secondary">Update Status</button> -->
                                        <a href="#">
                                            <button class="badge bg-success inline-flex" href="#" @click="toggle"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mr-2" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                </svg>Update</button>
                                        </a>
                                    </div>
                                    <!-- modal -->

                                </div>
                            </td>
                            <td>
                                <a href="view_order.php">
                                    <button class="badge bg-primary inline-flex" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill mr-2" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg>View Comments</button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
 @push('script')
<script>
    function check() {
        var dropdown = document.getElementById("OperationType");
        var current_value = dropdown.options[dropdown.selectedIndex].value;

        if (current_value == "dispatch") {
            document.getElementById("OperationNos").style.display = "block";
        } else {
            document.getElementById("OperationNos").style.display = "none";
        }
    }
</script>
@endpush