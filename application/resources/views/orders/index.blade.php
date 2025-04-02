@extends('admin.layouts.app')
@section('title','Order List')
@section('content')

<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
      <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0">              
         <a class="badge bg-success" href="#">Manage Orders</a>
          <a href="{{route('orders.index')}}"  class="btn btn-primary" style="margin-left: 775px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

       <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:111px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
      </h5>
    
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <br>
          <form method="GET" action="{{route('orders.index')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('orders.index',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="seller_buyer_data" id="seller_buyer_data" value="{{Request::input('next_action_to')}}">
                           <option value="">Select Buyer/Seller</option>
                           @foreach($buyerSellerData as $buyerseller)
                            <option value="{{ $buyerseller->id }}" @if(Request::input('seller_buyer_data')  == $buyerseller->id) selected @endif >{{ ucwords($buyerseller->first_name.' '.$buyerseller->last_name)}}({{ ucwords($buyerseller->for) }})</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                </div>
            
                   <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-3">
                
                <div>
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="today_applied_status" id="order_status">
                           <option value="">Select Seller Status</option>
                           <option value="Packed" @if(Request::input('today_applied_status') == 'Packed') selected @endif >Packed</option>
                           <option value="Dispatched" @if(Request::input('today_applied_status') == 'Dispatched') selected @endif >Dispatched</option>
                           <option value="Delivered" @if(Request::input('today_applied_status') == 'Delivered') selected @endif >Delivered</option>
                           <option value="Pending" @if(Request::input('today_applied_status') == 'Pending') selected @endif >Pending</option>
                           
                        </select>
                     </div>
                  </div>
               
                 <div>
                     <button type="submit" class="btn btn-outline-success" style="padding-right: 64px;padding-left:64px;" >Submit</button>
                  </div>
                   </div>
                 
            </div>

         </form>
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table" style="margin-top:60px;">
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
                  @php  $i=1; @endphp
                  @foreach($orders as $order)
                  <tr>
                     <td>{{$i++}}</td>
                     <td>{{$order->created_at->format('Y-m-d') }}</td>
                     <td>{{$order->order_id}}</td>
                     <td>{{$order->first_name.' '.$order->last_name}}</td>
                     <td>{{$order->total_buy_price}}</td>
                     @if($order->order_status == 'Delivered')
                     <td class="btn btn-outline-success" style="margin-top: 15px;">{{$order->order_status}}</td>
                     @elseif($order->order_status == 'Packed')
                     <td class="btn btn-outline-secondary" style="margin-top: 15px;">{{$order->order_status}}</td>
                     @elseif($order->order_status == 'Dispatched')
                     <td class="btn btn-outline-info" style="margin-top: 15px;">{{$order->order_status}}</td>
                     @else
                     <td class="btn btn-outline-danger" style="margin-top: 15px;">{{$order->order_status}}</td>
                     @endif
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
                                                <strong>Date :</strong>
                                                <strong>{{$order->order_update_date}}</strong>
                                                </label>
                                             </div>
                                             <div>
                                                <label for="private_marka">
                                                <strong>LR Number :</strong>
                                                <strong>{{$order->lr_number}}</strong>
                                                </label>
                                             </div>
                                             <div>
                                                <strong>LR Copy :</strong>
                                             </div>
                                             <div>
                                                @if(!empty($order->upload_lr_receipt))
                                                <a href="{{asset('public/uploads/order/upload_lr_receipt/'.$order->upload_lr_receipt)}}" download="{{$order->upload_lr_receipt}}">
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
                                                <a href="{{asset('public/uploads/order/upload_lr_receipt/'.$order->upload_lr_receipt)}}" target="_blank">
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
                                                @endif
                                             </div>
                                             <div>
                                                <label for="Buyer Name">
                                                <strong>Comment :</strong>
                                                <strong>{{$order->order_status_comment}}</strong>
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
                        <a class="badge bg-info" href="{{ route('orders.show',$order->id) }}">View</a>
                        <a class="badge bg-primary" href="{{ route('orders.edit',array_merge([$order->id],$requested_input)) }}">Edit</a>
                         <a class="badge bg-success" href="{{ route('modify_order',$order->id) }}">Modify</a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         {{ $orders->links('admin.partials.pagination')}}
      </div>
   </div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript"> 
   $(function(){
    $('#alertMessageHide').delay(5000).fadeOut();
   });
</script>
<script>
   function confirmDelete( varForm ) {
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