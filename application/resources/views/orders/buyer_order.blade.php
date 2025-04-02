@extends('admin.layouts.app')
@section('title','Order')
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
                  <a href="#" class="text-primary hover:underline">Manage Orders</a>
               </li>
               <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                  <span>Order</span>
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
                        <th>Date</th>
                        <th>Order ID</th>
                        <th>Party Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Show Data</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td>12/22/23</td>
                        <td>OD202312223029550401</td>
                        <td>Bsn</td>
                        <td>10000</td>
                        <td>Pending</td>
                        <td>
                           <div x-data="modal" class="">
                              <div class="flex items-center">
                                 <a href="#">
                                 <button class="btn btn-primary" href="#" @click="toggle" style="padding: 3px 5px 3px 5px;">Dispatched Data</button>
                                 </a>
                              </div>
                              <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                                 <div class="flex items-start justify-center min-h-screen px-4">
                                    <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                       <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                          <h5 class="text-lg font-bold"> Status Edit Data</h5>
                                          <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                             </svg>
                                          </button>
                                       </div>
                                       <form action="" method="POST">
                                          @csrf
                                          <div class="p-5">
                                             <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                <div>
                                                   <label for="Buyer Name">
                                                   <strong>Date:</strong>
                                                   <strong>26-12-23</strong>
                                                   </label>
                                                </div>
                                                <div>
                                                   <label for="private_marka">
                                                   <strong>LR Number:</strong>
                                                   <strong>43645765876</strong>
                                                   </label>
                                                </div>
                                                <div>
                                                   <strong>LR Copy:</strong>
                                                </div>
                                                <div>
                                                   <a href="" download="">
                                                      <button type="button" class="btn btn-info gap-2" style="padding: 1px 5px 1px 3px;">
                                                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                                            <path
                                                               opacity="0.5"
                                                               d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                                                               stroke="currentColor"
                                                               stroke-width="1.5"
                                                               stroke-linecap="round"
                                                               ></path>
                                                            <path
                                                               d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5"
                                                               stroke="currentColor"
                                                               stroke-width="1.5"
                                                               stroke-linecap="round"
                                                               stroke-linejoin="round"
                                                               ></path>
                                                         </svg>
                                                         Download
                                                      </button>
                                                   </a>
                                                   <a href="" target="_blank">
                                                      <button type="button" class="btn btn-primary gap-2" style="padding: 1px 32px 1px 20px;margin-top: -23px;margin-left:130px;">
                                                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="margin-left: -13px;">
                                                            <path
                                                               opacity="0.5"
                                                               d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                                               stroke="currentColor"
                                                               stroke-width="1.5"
                                                               ></path>
                                                            <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                                                         </svg>
                                                         View 
                                                      </button>
                                                   </a>
                                                </div>
												<div>
												<label for="Buyer Name">
                                                   <strong>Comment:</strong>
                                                   <strong>Hello</strong>
                                                   </label>
                                                </div>
												
                                             </div>
                                           
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </td>
                        <td>
                           <a class="badge bg-info" href="{{route('view_order')}}">View</a>
                           <a class="badge bg-primary" href="{{route('edit_order')}}">Edit</a>
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