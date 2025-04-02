@extends('admin.layouts.app')
@section('title','Cart Return')
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
            <a href="{{route('cartreturns.index')}}" class="text-primary hover:underline">Cart Return List</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Cart Return</span>
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
                   
                     <th>Product Image</th>
                     <th>Product Name</th>
                     <th>Quantity</th>
                     <th>Unit Price</th>
                     <th>Subtotal</th>
                  </tr>
               </thead>
               <tbody>
        
        <form action="{{route('cartreturns.store')}}" method="post" id="checkout_form">
		@csrf
                <input type="hidden" name="product_total_qty" value="{{$productQty}}">
                <input type="hidden" name="product_id" value="{{ $productDetail->id }}">
                <input type="hidden" name="product_name" value="{{ $productDetail->product_name }}">
		        <input type="hidden" name="seller_id" value="{{ $productDetail->seller_id }}">
		        <input type="hidden" name="brand_name" value="{{ $productDetail->brand_name }}">
		        <input type="hidden" name="product_photo" value="{{ $productDetail->product_photo }}">
		        <input type="hidden" name="unit_price" value="{{ $productDetail->price }}">
		        <input type="hidden" name="product_qty" value="prod_id_{{$productDetail->id}}_qty">
				<input type="hidden" name="product_total_price" id="all_product_sub_price_text2" value="">
                <tr data-id="">
                     
                     <td>
                       <a href="{{ asset('uploads/product/product_photo/'.$productDetail->product_photo) }}" target="_blank"><img src="{{ asset('uploads/product/product_photo/'.$productDetail->product_photo) }}" class="img-responsive" alt="" style="width: 100px;" /></a>
                     </td>
                     <td>
                        <h4><a href="#"></a></h4>
						
                        <p>{{$productDetail->product_name}}</p>

                     </td>
           
                     <td>
                         <div class="qty-container">
                           <button class="qty-btn-minus btn-light" onclick="PlusMinus('minus', 'prod_id_{{$productDetail->id}}')" type="button"><i class="fa fa-minus"></i></button>
                           <input type="text" name="prod_id_{{$productDetail->id}}_qty" value="1" id="prod_id_{{$productDetail->id}}_qty" class="input-qty qty-btn-minus update-cart"/>
                           <button class="qty-btn-plus btn-light" onclick="PlusMinus('plus', 'prod_id_{{$productDetail->id}}')" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                     </td>
                   
				   <!-- -->
		  
		            <td>
                        <input type="hidden" value="{{ $productDetail->price }}" id="prod_id_{{ $productDetail->id }}_price_val">
                        <div class="item-price unit-price-text" id="prod_id_{{$productDetail->id}}_price_text">₹ {{$productDetail->price}}</div>
                     </td>
                     <td>
                        <input type="hidden" class="single_product_subtotal" id="prod_id_{{$productDetail->id}}_subtotal_price_val" value="{{ ($productDetail->price ) }}">
              
                        <div class="item-price subtotal-price-text" id="prod_id_{{$productDetail->id}}_subtotal_price_text">₹ {{ ($productDetail->price) }}</div>
                     </td>
                    
				  <!-- -->
          
                  </tr>
 
          
         </form>
         
             
         </tbody>
            </table>
         </div>
      </div>
      <div>
    
         <table>
            <thead>
     
               <tr>
                  <th>Total Return Amount</th>
         
           
                   <th class="subtotal-price-text" id="all_product_sub_price_text">₹ 0</th>
         
            
               </tr>

            </thead>
            <hr>
            <br>
            <tbody>
         <br>
            <!--   <tr>
                  <td scope="row">Platform Fee(2% of total amount)</td>
          <input type="hidden" id="shipping-charge-val" value="8">
                  <td id="shipping-charge-text">₹ 4</td>
               </tr>-->
      
              <!-- <tr>
                  <td scope="row">Discount</td>
                  <td>₹5.00</td>
               </tr>-->

              <!-- <tr>
                  <td scope="row">Total</td>
           
                     <td colspan="2" id="total-price-text">₹ 100</td>
           
               </tr>-->
            </tbody>
         </table>
         <br><br>
         <a href="{{route('my_product_order')}}"><button type="button" class="btn btn-outline-primary rounded-full">Return Shopping</button></a>
     
         <a onclick="submitCheckout();" href="#"><button type="button" class="btn btn-outline-primary rounded-full" style="margin-left:850px;margin-top: -43px;">Return Now</button></a>
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
   
//alert(unitPriceVal);
     
 
   
    var masterPackingVal= parseFloat($('#'+product_id+'_master_packing_val').val());
   
    var masterPackingTotal = (qty * unitPriceVal);
   
   $('#'+product_id+'_master_packing_text').text(masterPackingTotal);
   
   var subTotal = masterPackingTotal;
   
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
   
   var masterPackingTotal = (qty * unitPriceVal);
   
   $('#'+product_id+'_master_packing_text').text(masterPackingTotal);
   
   var subTotal = masterPackingTotal;
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
  
   var TotalPrice = (all_product_sub_total + shippingCharge);
   $('#total-price-text').text('₹ '+TotalPrice); 
     
   }
   
   
 }
  
</script>
<!--End  order quantity add and minus-->

@endpush