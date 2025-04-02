<!DOCTYPE html>
<html>
<head>
    <title>Welcome to BSN Mart B2B Portal - Empowering Your Business!</title>
</head>
<body>
		   <p>Welcome to BSN Mart B2B Portal - Empowering Your Business!</p>
		
		   <p><b>Dear</b> {{ ucfirst($mailData['first_name'])}} {{ucfirst($mailData['last_name'])}} ,</p>
			
		   <p>Congratulations and welcome to <b>BSN Mart B2B Portal!</b> We are excited to have you on board and look forward to supporting your business through our comprehensive web portal services. Your account has been successfully created, and you are now ready to experience the convenience and efficiency of managing your B2B transactions with us.</p>
		   
		   <p>Here are your account details to get you started:</p>
			   <p>Username : {{ $mailData['user_id'] }}</p>
			   <p>Password : {{ $mailData['password'] }}</p>
			   <p>Temporary Password - You may prompt them to change it upon first login for security reasons</p>
			   
		   <p>To access your account, please visit https://bsnmart.com/application/login and log in using the provided credentials. Once logged in, you'll gain access to a suite of tools and features tailored to enhance your B2B experience.</p>
		   
		   <p><b>Key Features of BSN Mart B2B Portal:</b></p>
		   
		   <p><b>Product Catalog:</b> Explore our extensive product catalog, complete with detailed specifications and pricing information.</p>
		   
		   <p><b>Payment Management:</b> Simplify your financial transactions with our integrated payment management system. You can view invoices, make payments, and keep track of your financial transactions seamlessly.</p>
			
			<p><b>Shipping and Logistics:</b> Stay informed about the status of your shipments and track their real-time location through our shipping and logistics module.</p>
			
			<p><b>Account Statements:</b> Access detailed account statements to gain insights into your transaction history and monitor your business expenditures.</p>
			
			<p>We understand the importance of efficient payment management in your business operations. Our portal's secure and user-friendly payment features are designed to streamline your financial transactions and ensure a smooth experience.</p>
			
			<p>If you have any questions, need assistance, or want to explore specific features in detail, please don't hesitate to contact our dedicated support team at <b>{{ $mailData['manager_mobile'] }}</b>. We are here to assist you in maximizing the benefits of our B2B portal.</p>
			
			<p>Thank you for choosing <b>BSN Mart</b> as your B2B partner. We are committed to providing you with a seamless and productive experience.</p>
			
			<p><b>Best Regards,</b></p>
			<p><b>{{ ucfirst($mailData['manager_first_name'])}} {{ucfirst($mailData['manager_last_name'])}}</b></p>
			<p><b>{{ $mailData['manager_mobile'] }}</b></p>


</body>
</html>