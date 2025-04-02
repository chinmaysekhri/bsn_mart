@extends('admin.layouts.app')
@section('title','Cart')
@section('content')

@push('head')
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
            <a href="{{route('product_list')}}" class="text-primary hover:underline">Product List</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Cart</span>
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
                     <th>Quantity</th>
                     <th>Pack Quantity </th>
                     <th>Unit Price</th>
                     <th>Subtotal</th>
                  </tr>
               </thead>
               <tbody>
        
          @if(session('cart'))
          
         @php
         
          $all_product_sub_total = 0;
         
         @endphp
        
        <form action="{{route('checkout')}}" method="post" id="checkout_form">
          @csrf
          @foreach(session('cart') as $id => $details)
        
        
                  <tr data-id="{{ $id }}">
                     <td class="remove-from-cart">
                        <a href="" class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                           <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                        </svg></a>
                     </td>
                     <td>
                        <a href="{{ asset('uploads/product/product_photo/'.$details['product_photo']) }}" target="_blank"><img src="{{ asset('uploads/product/product_photo/'.$details['product_photo']) }}" class="img-responsive" alt="" style="width: 100px;" /></a>
                     </td>
                     <td>
                        <h4><a href="single-product.html"></a></h4>
                        <p>{{ $details['product_name'] }}</p>

                     </td>
           
                     <td>
                        <div class="qty-container">
                           <button class="qty-btn-minus btn-light" onclick="PlusMinus('minus', 'prod_id_{{$id}}')" type="button"><i class="fa fa-minus"></i></button>
                           <input type="text" name="prod_id_{{$id}}_qty" value="1" id="prod_id_{{$id}}_qty" class="input-qty qty-btn-minus update-cart"/>
                           <button class="qty-btn-plus btn-light" onclick="PlusMinus('plus', 'prod_id_{{$id}}')" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                     </td>
           
                     <td>
              <input type="hidden" value="{{ $details['master_packing'] }}" id="prod_id_{{$id}}_master_packing_val">
                        <div class="item-price unit-price-text" id="prod_id_{{$id}}_master_packing_text" >{{ $details['master_packing'] }}</div>
                     </td>
           
           <td>
              <input type="hidden" value="{{ $details['price'] }}" id="prod_id_{{$id}}_price_val">
                        <div class="item-price unit-price-text" id="prod_id_{{$id}}_price_text">₹ {{ $details['price'] }}</div>
                     </td>
                     <td>
               <input type="hidden" class="single_product_subtotal" id="prod_id_{{$id}}_subtotal_price_val" value="{{ ($details['price']*$details['master_packing']) }}">
              
                        <div class="item-price subtotal-price-text" id="prod_id_{{$id}}_subtotal_price_text">₹ {{ ($details['price']*$details['master_packing']) }}</div>
                     </td>
                  </tr>
 
          @php
          
          
          $all_product_sub_total += ($details['price']*$details['master_packing']);
          
          @endphp
          
         @endforeach
         </form>
         
             @endif 
         </tbody>
            </table>
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
                  <th>Subtotal</th>
          @if(!empty($details['price']))
           
                   <th class="subtotal-price-text" id="all_product_sub_price_text">₹ {{ $subtotal_price }}</th>
            @endif
            
               </tr>
            </thead>
            <hr>
            <br>
            <tbody>
        @if(!empty($details['price']))
               <tr>
                  <td scope="row">Shpping Estimate(1.5% of total amount)</td>
          <input type="hidden" id="shipping-charge-val" value="{{ ($subtotal_price*1.5/100) }}">
                  <td id="shipping-charge-text">₹ {{ ($subtotal_price*1.5/100) }}</td>
               </tr>
         @endif
              <!-- <tr>
                  <td scope="row">Discount</td>
                  <td>₹5.00</td>
               </tr>-->

               <tr>
                  <td scope="row">Total</td>
           @if(!empty($details['price']))
                     <td colspan="2" id="total-price-text">₹ {{ ($subtotal_price +($subtotal_price*1.5/100)) }}</td>
             @endif
               </tr>
            </tbody>
         </table>
         <br><br>
         <a href="{{route('product_list')}}"><button type="button" class="btn btn-outline-primary rounded-full">Continue Shopping</button></a>
     
         <a onclick="submitCheckout();" href="#"><button type="button" class="btn btn-outline-primary rounded-full" style="margin-left:850px;margin-top: -43px;">Buy Now</button></a>
      </div>
   </div>
</div>


@endsection

@push('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script> 
 function submitCheckout(){
  $('#checkout_form').submit(); 
 }
 
   $(function(){
    $('#alertMessageHide').delay(2000).fadeOut();
   });
</script>

<!-- Start order quantity add and minus-->

<script type="text/javascript"> 
 
 function PlusMinus(plus_minus,product_id){
  
  var product_qty = parseFloat($('#'+product_id+'_qty').val());
  
  if(plus_minus == 'plus'){
     
   $('#'+product_id+'_qty').val(Number(product_qty+1));
   
   var qty = Number($('#'+product_id+'_qty').val());
   var unitPriceVal = parseFloat($('#'+product_id+'_price_val').val());
   

     
 
   
     var masterPackingVal= parseFloat($('#'+product_id+'_master_packing_val').val());
   
     var masterPackingTotal = (qty * masterPackingVal);
   
   $('#'+product_id+'_master_packing_text').text(masterPackingTotal);
   
   var subTotal = (masterPackingTotal * unitPriceVal);
   
   $('#'+product_id+'_subtotal_price_text').text('₹ '+subTotal);
   
   $('#'+product_id+'_subtotal_price_val').val(subTotal);
   
  var all_product_sub_total = 0;
  $('.single_product_subtotal').each(function(){
    all_product_sub_total += parseFloat(this.value);
  });
   
   $('#all_product_sub_price_text').text('₹ '+all_product_sub_total);
   
   var shippingCharge = (all_product_sub_total * 1.5/100);
   $('#shipping-charge-text').text('₹ '+shippingCharge);
  
   var TotalPrice = (all_product_sub_total + shippingCharge);
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
   
     var masterPackingTotal = (qty * masterPackingVal);
   
   $('#'+product_id+'_master_packing_text').text(masterPackingTotal);
   
   var subTotal = (masterPackingTotal * unitPriceVal);
   $('#'+product_id+'_subtotal_price_text').text('₹ '+subTotal);
   
   $('#'+product_id+'_subtotal_price_val').val(subTotal);
   
  var all_product_sub_total = 0;
  $('.single_product_subtotal').each(function(){
    all_product_sub_total += parseFloat(this.value);
  });
   
   
   $('#all_product_sub_price_text').text('₹ '+all_product_sub_total);
   
   var shippingCharge =(all_product_sub_total * 1.5/100);
   $('#shipping-charge-text').text('₹ '+shippingCharge);
  
   var TotalPrice = (all_product_sub_total + shippingCharge);
   $('#total-price-text').text('₹ '+TotalPrice); 
     
   }
   
   
 }
 
 
/*  
   var buttonPlus  = $(".qty-btn-plus");
   var buttonMinus = $(".qty-btn-minus");
   
   var incrementPlus = buttonPlus.click(function() {
     var $n = $(this)
     .parent(".qty-container")
     .find(".input-qty");
     $n.val(Number($n.val())+1 );
   
   var qty = Number($n.val());
   var unitPriceVal = parseFloat($('#unit-price-val').val());
   
   var subTotal = (qty * unitPriceVal);
   $('.subtotal-price-text').text('₹ '+subTotal+'.00');

   var shippingCharge = Math.round(subTotal * 1.5/100);
   $('#shipping-charge-text').text('₹ '+shippingCharge+'.00');
  
   var TotalPrice = (subTotal + shippingCharge);
   $('#total-price-text').text('₹ '+TotalPrice+'.00');
   
   });
   
   var incrementMinus = buttonMinus.click(function() {
     var $n = $(this)
     .parent(".qty-container")
     .find(".input-qty");
     var amount = Number($n.val());
     if (amount > 0) {
       $n.val(amount-1);
     }
   
   var qty = Number($n.val());
   var unitPriceVal = parseFloat($('#unit-price-val').val());
   
   var subTotal = (qty * unitPriceVal);
   $('.subtotal-price-text').text('₹ '+subTotal+'.00');
   
   var shippingCharge = Math.round(subTotal * 1.5/100);
   $('#shipping-charge-text').text('₹ '+shippingCharge+'.00');
   
   var TotalPrice = (subTotal + shippingCharge);
   $('#total-price-text').text('₹ '+TotalPrice+'.00'); */
   
   
   //});
   
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