@extends('admin.layouts.app')
@section('title','Manage Buyer Order')
@section('content')

<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
    <!--   @can('user-create')
      <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0">              
         <a class="badge bg-success" href="{{route('users.create')}}">Create New Customer</a>
      </h5>
      @endcan -->
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <div x-data="form">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li>
                    <a href="#" onclick="history.back()" class="text-primary hover:underline">Manage Orders</a>
                </li>
                <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                    <span>Buyer</span>
                </li>
            </ul>
        </div>
        <!-- start main content section -->
        <div x-data="invoiceList">
            <script src="assets/js/simple-datatables.js"></script>

            <div class=" border-[#e0e6ed] px-0 dark:border-[#1b2e4b]">
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
                            <th>Total Orders</th>
                            <th>Total Return</th>
                            <th>Add To Return</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src={{"public/admin/assets/images/profile-9.jpeg"}} alt="" class="h-8 w-8 rounded-full object-cover "></td>
                            <td>0001</td>
                            <td>Bsn</td>
                            <td>10000</td>
                            <td>10000</td>
                            <td>
                                <!-- on click item Added to Reverse Cart -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                </svg>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <img src={{"public/admin/assets/images/profile-9.jpeg"}} alt="" class="h-8 w-8 rounded-full object-cover">
                            </td>
                            <td>0002</td>
                            <td>Bsn</td>
                            <td>10000</td>
                            <td>10000</td>
                            <td>
                                <!-- on click item Added to Reverse Cart -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                </svg>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

 //order page dummy 18-12-23//

    public function manage_Buyer()
    {
       
        return view('wallets.manage_buyer');
    }
        public function manage_Seller()
    {
       
        return view('wallets.manage_seller');
    }
        public function manage_Order()
    {
       
        return view('wallets.manage_order');
    }


    //order page dummy 18-12-23//
    Route::get('manage-buyer',[WalletController::class, 'manage_Buyer'])->name('manage-buyer');
    Route::get('manage-seller',[WalletController::class, 'manage_Seller'])->name('manage-seller');
    Route::get('manage-order',[WalletController::class, 'manage_Order'])->name('manage-order');