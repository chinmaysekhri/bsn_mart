@extends('admin.layouts.app')
@section('title','Edit Order')
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
                  <span>Edit Order</span>
               </li>
            </ul>
         </div>
         <br>
         <div class="dataTable-wrapper">
            <table class=" table table-hover ">
               <div class=" d-flex">
                  <h5 class="text-lg font-semibold dark:text-white-light w-50 pl-3">Edit Details</h5>
               </div>
               <thead>
                  <tr>
                     <th scope="col">S.No</th>
                     <th scope="col" class="w-15">Product Image</th>
                     <th scope="col">Product Id</th>
                     <th scope="col">Product Name</th>
                     <th scope="col">Quantity</th>
                     <th scope="col">Price</th>
                     <th scope="col">Total Amount</th>
                     <th scope="col">Total Delivered </th>
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
                     <td>
                        <div x-data="modal" class="">
                           <div class="flex items-center">
                              <a href="#">
                              <button class="badge bg-info inline-flex" href="#" @click="toggle">Delivered Quantity</button>
                              </a>
                           </div>
                           <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                              <div class="flex items-start justify-center min-h-screen px-4">
                                 <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                       <h5 class="text-lg font-bold">Delivered Quantity</h5>
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
                                          <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                                             <div> <label for="ctnTextarea">Quantity</label>
                                                <input id="quantity" name="quantity" value=""  type="text" placeholder="Enter Quantity" class="form-input" readonly="readonly"/>
                                             </div>
                                          </div>
                                          <div class="flex justify-end items-center mt-8">
                                             <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                                             <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Save</button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td scope="row">2</td>
                     <td><img src={{"public/admin/assets/images/profile-9.jpeg"}} alt="" class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2"></td>
                     <td>13</td>
                     <td>sahni</td>
                     <td>20</td>
                     <td>20</td>
                     <td>20</td>
                     <td>
                        <div x-data="modal" class="">
                           <div class="flex items-center">
                              <a href="#">
                              <button class="badge bg-info inline-flex" href="#" @click="toggle">Delivered Quantity</button>
                              </a>
                           </div>
                           <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                              <div class="flex items-start justify-center min-h-screen px-4">
                                 <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                       <h5 class="text-lg font-bold">Delivered Quantity</h5>
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
                                          <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                                             <div> <label for="ctnTextarea">Quantity</label>
                                                <input id="quantity" name="quantity" value=""  type="text" placeholder="Enter Quantity" class="form-input" readonly="readonly"/>
                                             </div>
                                          </div>
                                          <div class="flex justify-end items-center mt-8">
                                             <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                                             <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Save</button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
            <div class="flex justify-end px-4">
               <div class="w-full md:w-80 font-semibold p-5">
                  <div class="flex items-center justify-between py-2">
                     <span>Sub Total :</span>
                     <span> ₹ 989.94</span>
                  </div>
                  <div class="flex items-center justify-between py-2">
                     <span>Portal Fees :</span>
                     <span>₹ 44.99</span>
                  </div>
                  <div class="flex items-center justify-between font-bold py-4 border-t dark:border-t-dark border-dashed">
                     <span>Final Amount :</span>
                     <span id="total"> ₹ 1,049.94</span>
                  </div>
               </div>
            </div>
            <div x-data="modal" class="">
               <div class="flex items-center">
                  <a href="#">
                  <button class="btn btn-primary inline-flex" href="#" @click="toggle">Update Status</button>
                  </a>
               </div>
               <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                  <div class="flex items-start justify-center min-h-screen px-4">
                     <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                        <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                           <h5 class="text-lg font-bold">Delivered Quantity</h5>
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
                              <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                                 <div>
                                    <label for="ctnTextarea">Update Fund Status</label>
                                    <select id="OperationType" class="form-input" onChange="check(this);">
                                       <option value="" default>Update Status</option>
                                       <option value="Packed">Packed</option>
                                       <option value="Dispatched">Dispatched</option>
                                       <option value="Delivered">Delivered</option>
                                    </select>
                                 </div>
                                 <br>
                                 <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 " id=OperationNos style="display: none;">
                                    <div class="">
                                       <label for="date"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Date
                                       </label>
                                       <input id="date" type="date" class="form-input" required="">
                                    </div>
                                    <div class="">
                                       <label for="lr_number"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>LR Number.
                                       </label>
                                       <input id="lr_number" type="text" placeholder="LR Number." class="form-input" required="">
                                    </div>
                                    <div class="">
                                       <label for="lr_receipt_number"><i class="fa fa-asterisk" style="font-size:6px;color:red"></i>Upload Recipt
                                       </label>
                                       <input id="lr_receipt_number" type="file" class="form-input" required="">
                                    </div>
                                 </div>
                                 <div>
                                    <label for="comment">Comment</label>
                                    <textarea id="comment" rows="3" class="form-textarea" placeholder="Enter Comment" style="height: 100px;" required></textarea>
                                 </div>
                              </div>
                              <div class="flex justify-end items-center mt-8">
                                 <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                                 <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Save</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('script')
<script>
   function check() {
       var dropdown = document.getElementById("OperationType");
       var current_value = dropdown.options[dropdown.selectedIndex].value;
   
       if (current_value == "Dispatched") {
           document.getElementById("OperationNos").style.display = "block";
       } else {
           document.getElementById("OperationNos").style.display = "none";
       }
   }
   document.addEventListener("alpine:init", () => {
       Alpine.data("modal", (initialOpenState = false) => ({
           open: initialOpenState,
   
           toggle() {
               this.open = !this.open;
           },
       }));
   });
</script>
@endpush