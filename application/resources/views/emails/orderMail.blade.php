<!DOCTYPE html>
<html>
<head>
<title>Order Confirmation {{ $mailData['order_id']}}</title>
</head>
<body>
		  
		
		    <p><b>Dear </b> {{ ucfirst($mailData['first_name'])}} {{ucfirst($mailData['last_name'])}} ,</p>
			
		    <p><b>your order has been successfully placed.</b></p>
			
		    <p><b>Order ID : </b> {{ $mailData['order_id']}}</p>
			
		    <p><b>Date of Order: </b> {{ $mailData['order_date']}}</p>
			
		    <p><b>Total Amount: ₹ </b>{{ $mailData['total_buy_price']}}</p>
			
		    <p><b>Shipping Address: </b>{{ $mailData['shipping_address']}}</p>
			
		    <p><b>Estimated Delivery Date:</b> 7 Days</p>
			
		    <p><b>Payment Method: </b> {{ $mailData['payment_method']}}</p>
			
		    <p><b>Order Status: </b>In Process</p>
                  Your order is currently being processed, and we will keep you updated on its status. Once your order is shipped, you will receive a shipping confirmation email with tracking information.
            </p>
		
			<p><b>Best Regards,</b></p>
			
			<p><b>BSN Mart</b></p>


</body>
</html>