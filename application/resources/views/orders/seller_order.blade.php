@extends('admin.layouts.app')
@section('title','Manage Seller Order')
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
          <a class="badge bg-success" href="#">Manage Orders / Seller</a>
          <a href="{{route('seller_order')}}"  class="btn btn-primary" style="margin-left: 875px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

          <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:155px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
      </h5>
    
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <div class="">
		 <br>
		    <form method="GET" action="{{route('seller_order')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('seller_order',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                          <select class="form-input" name="seller_buyer_data" id="seller_buyer_data">
                           <option value="">Select Seller Name</option>
                           @foreach($buyerSellerData as $buyerseller)
                            <option value="{{ $buyerseller->id }}" @if(Request::input('seller_buyer_data')  == $buyerseller->id) selected @endif >{{ ucwords($buyerseller->first_name.' '.$buyerseller->last_name)}}({{ ucwords($buyerseller->for) }})</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                </div>
            
                 <div>
                     <button type="submit" class="btn btn-outline-success" style="padding-right: 64px;padding-left:64px;margin-left: 451px;" >Submit</button>
                  </div>
                 
                   <hr>
            </div>
        </form>
         
        </div>
         <div class="dataTable-container">
                 @if(count($productOrderData) >0)
            <table id="myTable1" class="whitespace-nowrap dataTable-table" style="margin-top:60px;">
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
                  @php 
                        
                        $i=1;
                        
                        @endphp
                        
                        @foreach($productOrderData as $row)
                        <tr>
						<td>{{$i++}}</td>
						<td><img src="{{asset('public/uploads/product/product_photo/'.$row['product_img'])}}" alt="" class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2"></td>
						<td>PID00{{$row['product_id']}}</td>
						<td>{{$row['product_name']}}</td>
						<td><button onclick="todaySingleProductOrder('{{$row['product_id']}}')">{{$row['total_order']}}</button></td>
						<td><button onclick="total_delivered('{{$row['product_id']}}')">{{$row['total_delivered']}}</button></td>
						<td>{{ (($row['total_order'])-($row['total_delivered']))}}</td>
						<td><button onclick="returned_orders('{{$row['product_id']}}')">{{$row['total_returned']}}</button></td>
						<td>{{ (($row['total_delivered'])-($row['total_returned']))}}</td>

					    <?php /* <td><button onclick="total_delivered()">{{$row['total_delivered']}}</button></td>
						<td>{{$row['pending_order']}}</td>
						<td><button onclick="returned_orders()">{{$row['total_returned']}}</button></td>
						<td>{{$row['final_sales']}}</td> */?>
					    </tr>
                        @endforeach
                
               </tbody>
            </table>
            @else
                  <h1 style="color:red; text-align:center">Product Order Not Found!!</h1>
               @endif
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
                        <tbody id="dateWiseOrder">
                       
                            <tr>
                                <td></td>
                                <td id="today_date"></td>
                                <td id="singleProductCount"></td>
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
                        
                        <tbody id="purchaseWiseOrder">
                            <tr>
                                <td></td>
                                <!--<td id="">28/11/23</td>
                                <td id="">25(total no of delivered in a date)</td>-->
								<td id="purchase_date"></td>
                                <td id="purchaseProductCount"></td>
								
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
                        <tbody id="purchaseReturnWiseOrder">
                            <tr>
                                <td></td>
						    <!-- <td id="purchase_return_date">28/11/23</td>
                                 <td id="purchaseReturnProductCount">10( no order)</td>-->
                                <td id="purchase_return_date"></td>
                                <td id="purchaseReturnProductCount"></td>
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

function todaySingleProductOrder(product_id) {
    
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
        
    }
    
// Ajax for get seller single product order Start   

$('#today_date').text(''); 
$('#singleProductCount').text('');
    
var token = "{{ csrf_token() }}";
var url = "{{ route('get_today_single_product_order') }}";

 $.ajax({
 url:url,
 type: 'POST',
 data: { _token :token,product_id:product_id },
 success:function(result){

 console.log(result);
 
      $('#dateWiseOrder').html('');
        
      var sn = 1;
      
      $.each(result.order_data, function(key, value) {
        
      $('#dateWiseOrder').append('<tr><td>'+sn+'</td><td>'+value.order_date+'</td><td>'+value.product_quienty+'</td></tr>');
      
      sn = sn+1;
      
    });  
  }
});

// Ajax for get seller single product order End 
            
}

  function total_delivered(product_id) {
    var x = document.getElementById("myDIV2");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
	
// Ajax for get seller purchase add product order Start   

$('#purchase_date').text(''); 
$('#purchaseProductCount').text('');
    
var token = "{{ csrf_token() }}";
var url = "{{ route('get_purchase_product_order') }}";

 $.ajax({
 url:url,
 type: 'POST',
 data: { _token :token,product_id:product_id },
 success:function(result){

// console.log(result);
 
      $('#purchaseWiseOrder').html('');
        
      var sn = 1;
      
      $.each(result.purchase_data, function(key, value) {
        
      $('#purchaseWiseOrder').append('<tr><td>'+sn+'</td><td>'+value.created_date+'</td><td>'+value.product_qty+'</td></tr>');
      
      sn = sn+1;
      
    });  
  }
});

// Ajax for get seller purchase add product order End 
	
	
}

  function returned_orders(product_id) {
    var x = document.getElementById("myDIV3");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
	
// Ajax for get Seller Purchase Return Add product order Start   

$('#purchase_return_date').text(''); 
$('#purchaseReturnProductCount').text('');
    
var token = "{{ csrf_token() }}";
var url = "{{ route('get_purchase_return_product_order') }}";

 $.ajax({
 url:url,
 type: 'POST',
 data: { _token :token,product_id:product_id },
 success:function(result){

 console.log(result);
 
      $('#purchaseReturnWiseOrder').html('');
        
      var sn = 1;
      
      $.each(result.purchase_return_data, function(key, value) {
        
      $('#purchaseReturnWiseOrder').append('<tr><td>'+sn+'</td><td>'+value.created_date+'</td><td>'+value.product_qty+'</td></tr>');
      
      sn = sn+1;
      
    });  
  }
});

// Ajax for get seller Purchase Return product order End 
	
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