@extends('admin.layouts.app')
@section('title','Cart')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('product_list')}}" class="text-primary hover:underline">product</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>cart</span>
      </li>
   </ul>
</div>
<br><br>
<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
    
      
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table">
               <thead>
                  <tr>
                            <th>Action</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Subtotal</th>
                  </tr>

               </thead>
               <tbody>
                  <tr>
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </td>
                            <td>
                                <a href=""> <img src="{{ asset('admin/assets/images/drag-4.jpg') }}" class="img-responsive" alt="" style="width: 100px;" /></a>
                            </td>
							
                            <td>
                                <h4><a href="single-product.html">Product fashion</a></h4>
                                <p>Size: M</p>
                                <p>Color: White</p>
                            </td>

                            <td>
                                <select>
                                    <option>10</option>
                                    <option>02</option>
                                    <option>03</option>
                                </select>
                            </td>
                            <td>
                                <div class="item-price">₹ 99.00</div>
                            </td>
                            <td>
                                <div class="item-price">₹ 99.00</div>
                            </td>
                  </tr>
                  <tr>
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </td>
                            <td>
                                <a href=""> <img src="{{ asset('admin/assets/images/drag-4.jpg') }}" class="img-responsive" alt="" style="width: 100px;" /></a>
                            </td>
                            <td>
                                <h4><a href="single-product.html">Product fashion</a></h4>
                                <p>Size: M</p>
                                <p>Color: White</p>
                            </td>

                            <td>
                                <select>
                                    <option>10</option>
                                    <option>02</option>
                                    <option>03</option>
                                </select>
                            </td>
                            <td>
                                <div class="item-price">₹ 99.00</div>
                            </td>
                            <td>
                                <div class="item-price">₹ 99.00</div>
                            </td>
                  </tr>
                  <tr>
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </td>
                            <td>
                                <a href=""> <img src="{{ asset('admin/assets/images/drag-4.jpg') }}" class="img-responsive" alt="" style="width: 100px;" /></a>
                            </td>
                            <td>
                                <h4><a href="single-product.html">Product fashion</a></h4>
                                <p>Size: M</p>
                                <p>Color: White</p>
                            </td>

                            <td>
                                <select>
                                    <option>10</option>
                                    <option>02</option>
                                    <option>03</option>
                                </select>
                            </td>
                            <td>
                                <div class="item-price">₹ 99.00</div>
                            </td>
                            <td>
                                <div class="item-price">₹ 99.00</div>
                            </td>

                  </tr>

               </tbody>
            </table>
         </div>
       
      </div>

        <div>
            <table style="margin-left:250px;">
                <thead>
                    <tr>
                        <th scope="col">Subtotal</th>
                        <th scope="col">₹249.00</th>

                    </tr>
                </thead>
                <hr>
                <br>
                <tbody>
                    <tr>
                        <td scope="row">Shpping estimate</td>
                        <td>₹5.00</td>

                    </tr>
                    <tr>
                        <td scope="row">Discount</td>
                        <td>₹5.00</td>

                    </tr>
                    <tr>
                        <td scope="row">Total</td>
                        <td colspan="2">₹276.00</td>

                    </tr>
                   

                </tbody>
            </table>
			<br>
           <a href="{{route('product_list')}}"><button type="button" class="btn btn-outline-primary rounded-full">Continue Shopping</button></a>
            <a href="#"><button type="button" class="btn btn-outline-primary rounded-full" style="margin-left:850px;margin-top: -43px;">Buy Now</button></a>
        </div>
   </div>

</div>

@endsection