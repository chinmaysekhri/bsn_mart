<!DOCTYPE html>
<html>
<head>
    <title>Welcome to BSN Mart B2B Seller Portal - Expanding Your Reach Across India!</title>
</head>
<body>
		   <p>Welcome to BSN Mart B2B Seller Portal - Expanding Your Reach Across India!</p>
		
		   <p><b>Dear</b> {{ ucfirst($mailData['first_name'])}} {{ucfirst($mailData['last_name'])}} ,</p>
			
		   <p>Greetings from BSN Mart! We are delighted to welcome you to our B2B Seller Portal, where we empower sellers like you to reach new heights in business. Your account has been successfully created, and we are excited to collaborate with you as you expand your sales across India through our platform.</p>
		   
		   <p>Here are your account details to get started:</p>
		   
			   <p><b>Username :</b> {{ $mailData['user_id'] }}</p>
			   <p><b>Password : </b>{{ $mailData['password'] }}</p>
			   
			   <p><b>Temporary Password:</b> {{ $mailData['password'] }} - You may prompt them to change it upon first login for security reasons</p>
			   
			   
		   <p>To access your account, please visit https://bsnmart.com/application/login  and log in using the provided credentials. Once logged in, you'll gain access to a range of tools and services designed to optimize your sales and payment management.</p>
		   
		   <p><b>Order Management:</b> Effortlessly manage and fulfill orders received through the platform, ensuring a smooth and efficient sales process.</p>
		   
		   <p><b>Payment Management:</b> Our integrated payment management system simplifies financial transactions. View invoices, track payments, and manage your financial transactions seamlessly.</p>
		   
		   <p><b>Nationwide Sales:</b> Expand your market presence across India without the need for individual coordination with buyers. We act as the buyer, streamlining the sales process for your convenience.</p>
		   
		   <p><b>Analytics and Reporting:</b> Access detailed reports on your sales performance, track trends, and gain valuable insights to optimize your strategy.</p>
		   
		   <p>At <b>BSN Mart,</b> we understand the significance of efficient payment management in your business operations. Our secure and user-friendly payment features are designed to streamline financial transactions and ensure a hassle-free experience for our valued sellers.</p>
		   
		   <p>Should you have any questions, need assistance, or wish to explore specific features in detail, please feel free to reach out to our dedicated support team at <b>{{ $mailData['manager_mobile'] }}</b>. We are here to assist you in maximizing the benefits of our B2B Seller Portal.</p>
		   
		   <p>Thank you for choosing BSN Mart as your B2B partner. We look forward to a successful and collaborative partnership.</p>
		   
		   
		  
			<p><b>Best Regards,</b></p>
		    <?php 
		   // <p><b>{{ ucfirst($mailData['manager_first_name'])}} {{ucfirst($mailData['manager_last_name'])}}</b></p>  
		//	<p><b>{{ $mailData['manager_mobile'] }}</b></p>--?>
		   <p><b>9988793307</b></p>
		   <p><b>Team Onboading</b></p>
			


</body>
</html>