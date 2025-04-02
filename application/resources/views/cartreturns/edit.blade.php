@extends('admin.layouts.app')
@section('title','Edit Return Cart')
@section('content')

@push('head')

<!-- Start Received Qty Modelpopup Written By Vinay 04-02-2025-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>.vit *{box-sizing:border-box}.vit .mod{position:fixed;margin:auto;inset:0;transition:.5s;transform:translateY(-100%);opacity:0;top:1vh;z-index:9999}.vit .mod.modal-active{transform:translateY(0%);opacity:1}.vit .mod .main-modal{position:relative;width:500px;margin:auto;margin-top:30px;border-radius:10px;background:rgba(0,0,0,.7);padding:30px;padding-bottom:50px}.vit .mod .main-modal h4{font-size:40px;text-align:center;color:#fff;margin-bottom:30px}.vit .mod .main-modal .close-box-model{position:absolute;right:-10px;top:-10px;display:inline-block;cursor:pointer}.vit .mod .main-modal .close-box-model i{font-size:20px;color:#f78d1b}.vit .mod .main-modal .close-box-model:hover{filter:invert(3);transform:scale(1.3)}.vit .mod .main-modal form .form-group{margin-bottom:30px}.vit .mod .main-modal form .form-group .form-control{display:block;width:100%;padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;height:45px}.vit .mod .main-modal form .submit-box input[type=submit]{height:45px;margin:auto;width:100%;background:#f78d1b;color:#fff;border:0;font-size:20px;font-weight:600;text-transform:uppercase}.vit .mod .main-modal form .submit-box input[type=submit]:hover{filter:invert(1)}</style>

<!-- Start order quantity add and minus-->
<style type="text/css">
   .qty-container{
   display: flex;
   align-items: center;
   justify-content: left;
   }
   .qty-container .input-qty{
   text-align: center;
   padding: 6px 10px;
   border: 1px solid #d4d4d4;
   max-width: 80px;
   }
   .qty-container .qty-btn-minus,
   .qty-container .qty-btn-plus{
   border: 1px solid #d4d4d4;
   padding: 10px 13px;
   transition: 0.3s;
   }
</style>
<!-- End order quantity add and minus-->
@endpush

<div x-data="form">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{route('cartreturns.index')}}" class="text-primary hover:underline">Return Cart Order</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Return Cart</span>
        </li>
    </ul>
  
    @if (count($errors) > 0)
          <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
          <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Whoops!</strong>There were some problems with your input.
          <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
          </ul>
          </span>
      </div>
     @endif
  
    <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
    <!-- Flash  Message  End  -->
  
</div>
<br><br>
<div x-data="form">
   <div class="panel">
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table">
               <thead>
                  <tr>
                     <th>Action</th>
                     <th>Product Image</th>
                     <th>Product Name</th>
					 <th>Product Guarantee</th>
                     <th>Product Warranty</th>
                     <th>Quantity</th>
                     <th style="display:none;">Pack Quantity </th>
                     <th>Unit Price</th>
                     <th>Subtotal</th>
                     <th>Received Qty</th>
                     <th>Quantity</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
        
         @if($session_cart)
          
         @php
         
          $all_product_sub_total = 0;
         
         @endphp
        
        <form action="{{route('cartreturns.update',$cartReturnOrder->id)}}" method="post" id="checkout_form">
          @csrf
          @method('PUT')
		  
		  <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-2">
		   <div>
		   <label for="state">Select Buyers/Seller</label>
			<select class="form-select" name="buyer_seller_id" id="buyer_seller_id" required="">
			  <option value="">Select Buyer/Seller</option>
			 
			  @foreach($buyerSellerData as $buyers_seller)
			
				 <option value="{{$buyers_seller->id}}" @if($cartReturnOrder->buyer_seller_id == $buyers_seller->id) selected @endif >{{$buyers_seller->email}} ({{ucfirst($buyers_seller->for)}})</option>
					
			  @endforeach 
			</select>
		  </div>
		  </div>
		  <br><br>
		  @foreach($session_cart as $id => $details)
     
                <input type="hidden" name="product_name[]" value="{{ $details['product_name'] }}">
		        <input type="hidden" name="product_photo[]" value="{{ $details['product_photo'] }}">
		        <input type="hidden" name="unit_price[]" value="{{ $details['price'] }}">
		        <input type="hidden" name="product_guarantee_type[]" value="{{ $details['product_guarantee_type'] }}">
		        <input type="hidden" name="product_warranty_type[]" value="{{ $details['product_warranty_type'] }}">
		        <input type="hidden" id="product_total_{{$id}}_qty" name="product_total_{{$id}}_qty" value="{{ $details['product_total_qty'] }}">
				
				
                  <tr data-id="{{ $id }}">
                     <td class="remove-from-cart-No">
                        <a href="{{route('cartreturns.edit',[$cartReturnOrder->id,'product_id'=>$id,'action_for'=>'delete-product'])}}" class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                           <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                        </svg></a>
                     </td>
                     <td>
                        <a href="{{ asset('uploads/product/product_photo/'.$details['product_photo']) }}" target="_blank"><img src="{{ asset('uploads/product/product_photo/'.$details['product_photo']) }}" class="img-responsive" alt="" style="width: 100px;" /></a>
                     </td>
                     <td>
                        <h4><a href="#"></a></h4>
                        <p>{{ $details['product_name'] }}</p>

                     </td>
                     <td>
                        <h4><a href="#"></a></h4>
                        <p>{{ $details['product_guarantee_type'] }}</p>

                     </td>
                     <td>
                        <h4><a href="#"></a></h4>
                        <p>{{ $details['product_warranty_type'] }}</p>

                     </td>
           
                     <td>
                        <div class="qty-container">
                           <button class="qty-btn-minus btn-light" onclick="PlusMinus('minus', 'prod_id_{{$id}}', '{{ $details['product_total_qty'] }}' )" type="button"><i class="fa fa-minus"></i></button>
                           <input type="text" name="prod_id_{{$id}}_qty" value="{{$details['prod_qty']}}" id="prod_id_{{$id}}_qty" class="input-qty qty-btn-minus update-cart"/>
                           <button class="qty-btn-plus btn-light" onclick="PlusMinus('plus', 'prod_id_{{$id}}', '{{ $details['product_total_qty'] }}')" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                     </td>
           
				    <td style="display:none;">
                      <input type="hidden" value="{{ $details['master_packing'] }}" id="prod_id_{{$id}}_master_packing_val">
                      <div class="item-price unit-price-text" id="prod_id_{{$id}}_master_packing_text" >{{ $details['master_packing']*$details['prod_qty'] }}</div>
                   </td> 
			
           
                  <td>
                     <input type="hidden" value="{{ $details['price'] }}" id="prod_id_{{$id}}_price_val">
                     <div class="item-price unit-price-text" id="prod_id_{{$id}}_price_text">₹ {{ $details['price'] }}</div>
                   </td>
                   <td>
                      <input type="hidden" class="single_product_subtotal" id="prod_id_{{$id}}_subtotal_price_val" value="{{ $details['prod_qty']*($details['price']) }}">
                      <div class="item-price subtotal-price-text" id="prod_id_{{$id}}_subtotal_price_text">₹ {{ $details['prod_qty']*($details['price']) }}</div>
                   </td>
				   
				   <td>0</td>
				   
					
				    <td>
					
					<a href="#" onclick="updateReceivedQuantity('{{route('received_product',['cart_return_id'=>$cartReturnOrder->id, 'product_id'=>$details['product_id']])}}')"><button class="badge bg-success inline-flex vit-modal-two"  type="button" >Received Quantity</button></a>
				      
					</td>
				   
				    <td>
                 
					<a href="#" onclick="updateReceivedQuantityStatus('{{route('update_received_quantity_status',['cart_return_id'=>$cartReturnOrder->id, 'product_id'=>$details['product_id']])}}')"><button class="badge bg-success inline-flex vit-modal-one"  type="button">Update Quantity Status</button></a>
				    
					</td>
				 
                  </tr>
 
          @php
          
          
          $all_product_sub_total += $details['prod_qty']*($details['price']);
          
          @endphp
          
         @endforeach
         </form>
         
             @endif 
         </tbody>
            </table>
         </div>
         </div>
      </div>
      <div>
    
         <table>
            <thead>
				  @if(!empty($details['price']))
				  @php
				  
				  $subtotal_price = $all_product_sub_total;
				  
				  @endphp
				  @endif
               <tr>
               <th>Total</th>
			   <br>
			   <br>
			   <br>
			   <br>
               @if(!empty($details['price']))
           
                <th class="subtotal-price-text" id="all_product_sub_price_text">₹ {{ round($subtotal_price)}}</th>
                @endif
            
               </tr>
            </thead>
            <hr>
            <br>
          <?php /*  <tbody>
        @if(!empty($details['price']))
               <tr>
                  <td scope="row">Platform Fee(2% of total amount)</td>
          <input type="hidden" id="shipping-charge-val" value="{{ ($subtotal_price*2/100) }}">
                  <td id="shipping-charge-text">₹ {{ ($subtotal_price*2/100) }}</td>
               </tr>
         @endif
             
               <tr>
                  <td scope="row">Total</td>
           @if(!empty($details['price']))
                     <td colspan="2" id="total-price-text">₹ {{ ($subtotal_price +($subtotal_price*2/100)) }}</td>
             @endif
               </tr>
            </tbody> */  ?>
         </table>
         <br><br>
         <a href="{{route('my_product_order')}}"><button type="button" class="btn btn-outline-primary rounded-full">Return My Product Order</button></a>
     
         <a onclick="submitCheckout();" href="#"><button type="button" class="btn btn-outline-primary rounded-full" style="margin-left:850px;margin-top: -43px;">Edit Return Now</button></a>
      </div>
   </div>
</div>

<!-- Model Popup Received Quantity 04-02-2025 code written by vinay -->

     <main class="vit">
        <div class="mod mod-two">
            <div class="main-modal">
                <div class="close-box-model"><i class="fa-solid fa-circle-xmark" aria-hidden="true"></i></div>
                <!--<form id="" name="" method="post">-->
                    <h4>Received Quantity</h4>
				    <form  id="receivedQuantityID" action="{{route('received_product',['cart_return_id'=>$cartReturnOrder->id, 'product_id'=>$details['product_id']])}}" method="POST">
                    @csrf
						<div class="form-group">
							<input type="name" id="received_product_qty" name="received_product_qty" class="form-control" placeholder="Enter Received Quantity">
						</div>
					   
						<div class="submit-box">
							<input type="submit" value="Submit" class="">
						</div>
                   </form>
            </div>
        </div>
    </main>
	
<!-- Model Popup Received Quantity 04-02-2025 End -->
     
	 
<!--  Model Popup Update Quantity Status 04-02-2025 code written by vinay -->	 
	 <main class="vit">
        <div class="mod-one mod">
            <div class="main-modal">
                <div class="close-box-model"><i class="fa-solid fa-circle-xmark" aria-hidden="true"></i></div>
				<h4>Update Quantity Status</h4>
               <!-- <form id="" name="" method="post">-->
				<form id="receivedQuantityStatusID" method="POST" enctype="multipart/form-data" action="{{route('update_received_quantity_status',['cart_return_id'=>$cartReturnOrder->id, 'product_id'=>$details['product_id']])}}">
                  @csrf
				  
                   <!-- <div class="form-group">
                        <input type="name" id="name" name="name" class="form-control" placeholder="Name">
                    </div>-->
					
                    <div class="form-group">
					<select class="form-control" name="return_status" id="OperationType" onChange="check(this);">
					   <option value="">Select Return Status</option>
					   <option value="Accept">Accept</option>
					   <option value="Reject">Reject</option>
					   <option value="Inrepair">Inrepair</option>
					   <option value="Repaired">Repaired</option>
					</select>
                     </div>
					 
					 <div class="form-group" id="OperationNos" style="display:none">
                        <input type="text" id="accept_price" name="accept_price" class="form-control" placeholder="Enter Accept Price">
                     </div>
					 
					 <div class="form-group" id="OperationNos2" style="display:none">
                        <input type="text" id="repaired_price" name="repaired_price" class="form-control" placeholder="Enter Repaired Price">
                     </div>
					 
					 <div class="form-group" id="OperationNos2" style="display:none">
                        <input type="text" id="repaired_price" name="repaired_price" class="form-control" placeholder="Enter Repaired Price">
                     </div>
					 
					 <div class="form-group">
                        <input type="text" id="comment" name="comment" class="form-control" placeholder="Write a comment here...">
                     </div>
					 
                    <div class="submit-box">
                        <input type="submit" value="Submit" class="">
                    </div>
                </form>
            </div>
        </div>
    </main>
	
<!-- Model Popup Update Quantity Status 04-02-2025  -->
	
@endsection

@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>


<!-- Model Popup Received Quantity 04-02-2025 code written by vinay -->
<script>
        $(document).ready(function () {
            // $('.mod').addClass('modal-active')
            $('.vit-modal-two').click(function () {
                $('.vit .mod-two').addClass('modal-active')
            })
            $('.vit .close-box-model').click(function () {
                $(this).parents(".mod").removeClass('modal-active')
            })
        });
</script>

<script>
        $(document).ready(function () {
            // $('.mod').addClass('modal-active')
            $('.vit-modal-one').click(function () {
                $('.vit .mod-one').addClass('modal-active')
            })
            $('.vit .close-box-model').click(function () {
                $(this).parents(".mod").removeClass('modal-active')
            })
        });
</script>
	
<!-- Model Popup Received Quantity 04-02-2025 code written by vinay -->	
	
<script> 
 function submitCheckout(){
  $('#checkout_form').submit(); 
 }
 
   $(function(){
    $('#alertMessageHide').delay(5000).fadeOut();
   });
</script>

<script>
//Uddate Received Quantity 7-02-2025


   function updateReceivedQuantity(action_url){
	   
      
   //  var updateReceivedQuantityUrl = '{{url("/")}}'+'/update-received-quantity/'+product_id;
	 
     $('#receivedQuantityID').attr('action',action_url);
   }


</script>

<script>
//Uddate Received Quantity  Status 7-02-2025


   function updateReceivedQuantityStatus(action_url){
	   
      
   //  var updateReceivedQuantityUrl = '{{url("/")}}'+'/update-received-quantity/'+product_id;
	 
     $('#receivedQuantityStatusID').attr('action',action_url);
   }


</script>

<script>
   function check() {
       var dropdown      = document.getElementById("OperationType");
	   
       var current_value = dropdown.options[dropdown.selectedIndex].value;

       if (current_value == "Accept") {
           document.getElementById("OperationNos").style.display = "block";
        
       }else {
           document.getElementById("OperationNos").style.display = "none";
       }
	   
	    if (current_value == "Repaired") {
           document.getElementById("OperationNos2").style.display = "block";
        
       }else {
           document.getElementById("OperationNos2").style.display = "none";
       } 
	   
   }

</script>

<!-- Start order quantity add and minus-->

<script type="text/javascript"> 
 
 function PlusMinus(plus_minus,product_id, total_qty){
  
  var product_qty = parseFloat($('#'+product_id+'_qty').val());
  total_qty = parseFloat(total_qty);
  

  
  if(plus_minus == 'plus'){
     
	 var qty_previous = Number($('#'+product_id+'_qty').val());
	 
	 if(qty_previous < total_qty){
		  $('#'+product_id+'_qty').val(Number(product_qty+1));
	  }else{
		  alert('total quentity should not be less than producrt return quentity');
	  }   
   
     var qty = Number($('#'+product_id+'_qty').val());
     var unitPriceVal = parseFloat($('#'+product_id+'_price_val').val());
   
   
     var masterPackingVal= parseFloat($('#'+product_id+'_master_packing_val').val());
   
     var masterPackingTotal = (qty);
   
   $('#'+product_id+'_master_packing_text').text(masterPackingTotal);
   
   var subTotal = Math.round(masterPackingTotal * unitPriceVal);
   
   $('#'+product_id+'_subtotal_price_text').text('₹ '+subTotal);
   
   $('#'+product_id+'_subtotal_price_val').val(subTotal);
   
  var all_product_sub_total = 0;
  $('.single_product_subtotal').each(function(){
    all_product_sub_total += parseFloat(this.value);
  });
   
   $('#all_product_sub_price_text').text('₹ '+all_product_sub_total);
   
   $('#all_product_sub_price_text2').val(+all_product_sub_total); // hidden value get
   
   var shippingCharge = (all_product_sub_total * 2/100);
   $('#shipping-charge-text').text('₹ '+shippingCharge);
  
   var TotalPrice = Math.round(all_product_sub_total + shippingCharge);
   $('#total-price-text').text('₹ '+TotalPrice);
   
   }
   
   if(plus_minus == 'minus'){
     
     var amount = Number(product_qty);
     if (amount > 0) {
       $('#'+product_id+'_qty').val(amount-1);
     }
   
   var qty = Number($('#'+product_id+'_qty').val());
     
   var unitPriceVal = parseFloat($('#'+product_id+'_price_val').val());
 
   var masterPackingVal= parseFloat($('#'+product_id+'_master_packing_val').val());
   
   var masterPackingTotal = (qty);
   
   $('#'+product_id+'_master_packing_text').text(masterPackingTotal);
   
   var subTotal = Math.round(masterPackingTotal * unitPriceVal);
   $('#'+product_id+'_subtotal_price_text').text('₹ '+subTotal);
   
   $('#'+product_id+'_subtotal_price_val').val(subTotal);
   
  var all_product_sub_total = 0;
  $('.single_product_subtotal').each(function(){
    all_product_sub_total += parseFloat(this.value);
  });
   
   
   $('#all_product_sub_price_text').text('₹ '+all_product_sub_total);
   
   $('#all_product_sub_price_text2').val(+all_product_sub_total);   // hidden value get
   
   var shippingCharge =(all_product_sub_total * 2/100);
   $('#shipping-charge-text').text('₹ '+shippingCharge);
  
   var TotalPrice = Math.round(all_product_sub_total + shippingCharge);
   $('#total-price-text').text('₹ '+TotalPrice); 
     
   }
   
   
 }
 
</script>

<!--End  order quantity add and minus-->

<script>
  
    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
  
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  
</script>

@endpush