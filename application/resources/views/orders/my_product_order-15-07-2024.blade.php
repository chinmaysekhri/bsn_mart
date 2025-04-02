@extends('admin.layouts.app')
@section('title','My Product Order')
@section('content')

<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
      <div x-data="form">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li>
                    <a href="#" class="text-primary hover:underline">My Product Order</a>
                </li>
                <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                    <span>My Order</span>
                </li>
            </ul>
             <a href="{{route('orders.index')}}"  class="btn btn-primary" style="margin-left:955px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

       <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:213px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
        </div>
     
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <div class="">
              <form method="GET" action="{{route('my_product_order')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('my_product_order',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="team_member_data" id="team_member_data" value="{{Request::input('next_action_to')}}">
                           <option value="">Select Seller/Buyer</option>
                           <option value="Seller" @if(Request::input('today_applied_status') == 'Seller') selected @endif >Seller</option>
                           <option value="Buyer" @if(Request::input('today_applied_status') == 'Buyer') selected @endif >Buyer</option>
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
          
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Product Image</th>
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Total Orders</th>
                            <th>Total Quantity</th>
                            <th>Total Return</th>
                            <th>Add To Return</th>
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
						  <td><button onclick="myProductOrder({{$row['product_id']}})">{{$row['total_order']}}</button></td>
						  <td>4800</td>
						  <td>0</td>
						  <td><a href="#"><button type="button" class="btn btn-primary">Add to Cart</button></a></td>
					   </tr>
                       @endforeach
                    </tbody>
                </table>
        
        @else
          <h1 style="color:red; text-align:center">My Product Order Not Found!!</h1>
               @endif
         </div>
        <div id="myDIV" style="display:none;">
            <div class="mb-5">
                <div class="dataTable-container">
                    <table id="myTable1" class="whitespace-nowrap dataTable-table">
                        <thead>
                            <tr style="background: radial-gradient(#7fd9a7f7, transparent);">
                                <th>S.No</th>
                                <th>OrderID</th>
                                <th>Date</th>
                                <th>Quantity</th>
                                 <th>Party Name</th>
                            </tr>
                        </thead>
                        <tbody id="dateWiseOrder">
                            <tr>
                              <!--  <td>1</td>
                                <td id="productOrderID">OD202312223029550401</td>
                                <td id="today_date">29-08-2024</td>
                                <td id="productPackQty">5</td>
                                <td id="today_date">Anil Seller</td> -->
                
                <td id="productOrderID"></td>
                                <td id="today_date"></td>
                                <td id="productPackQty"></td>
                                <td id="buyerSellerName"></td>
                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
<script>
  function myProductOrder(product_id) {
    
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
    
// Ajax for get my single product start 
   
 $('#productOrderID').text(''); 
 $('#today_date').text(''); 
 $('#productPackQty').text('');
 $('#buyerSellerName').text('');

var token = "{{ csrf_token() }}";
var url = "{{ route('get_today_my_product_order') }}";

 $.ajax({
 url:url,
 type: 'POST',
 data: { _token :token,product_id:product_id },
 success:function(result){

      console.log(result);
 
    $('#dateWiseOrder').html('');
    
    var sn = 1;
    
    $.each(result.order_data, function(key, value) {
    //alert(key);
    console.log(value);
    
    $('#dateWiseOrder').append('<tr><td>'+sn+'</td><td>'+value.order_id+'</td><td>'+value.order_date+'</td><td>'+value.product_quienty+'</td><td>'+value.buyer_or_seller_name+'</td></tr>');
    
    sn = sn+1;
    
  });  
  }
});

// Ajax for get my single product End 
      
}
  
 </script>
@endpush