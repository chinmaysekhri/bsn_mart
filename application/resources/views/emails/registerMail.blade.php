<!DOCTYPE html>
<html>
<head>
    <title>Welcome to BSN Mart - Your Employee Portal Access</title>
</head>
<body>
	    <p>Welcome to BSN Mart - Your Employee Portal Access</p>
		
		  <p> <b>Dear</b>  {{ ucfirst($mailData['first_name'])}} {{ucfirst($mailData['last_name'])}} ,</p>
			
		   <p>We are delighted to welcome you to <b>BSN Mart </b> We're excited to have you on board and look forward to working together to achieve great things. To get started, we have set up your Employee Portal account. This portal will serve as your centralized hub for managing your credentials and securely uploading all the necessary documents for your employment with us..</p>
		   <p>Your Employee Portal Credentials:</p>
			   <p>Username : {{ $mailData['user_id'] }}</p>
			   <p>Password : {{ $mailData['password'] }}</p>
		   <p>Please keep this information secure, as it will be required to access your portal.</p>
		   <p> Access Your Employee Portal:</p>
		   <p>To access your Employee Portal, please follow these steps:</p>
			<p>Step 1: Visit the BSN Mart Employee Portal at  https://bsnmart.com/application/</p>
			<p>Step 2: Log in using the credentials provided above. You will be prompted to change your temporary password upon your first login for security reasons.</p>
			<p>Step 3: Click on Edit Employee Profile in the My Detail section under the My Profile tab & update Your Credentials and Documents as below:-</p>
			<p><b>1.Basic Info:</b> Update all your basic information mentioned in the form.</p>
			<p><b>2.KYC:</b>Update all your KYC information mentioned in the form.
				   Such as Aadhar card, PAN card etc.  Along with documents Uploaded.</p>
			<p><b>3.Qualification:</b>Update all your Qualifications mentioned in your CV along with the documents uploaded.</p>
			<p><b>4.Employment Detail:</b>Update all your Employment details mentioned in your CV along with the documents uploaded.</p>
			<p><b>5.Company Document:</b> After Uploading all the necessary details and documents view and download all the documents at any time such as the offer letter provided by <b>BSN Mart</b>.</p>
			<p><b>Security and Privacy:</b></p>
			<p>Please rest assured that we take the security and privacy of your personal information and documents very seriously. All data uploaded to the Employee Portal is encrypted and securely stored on our servers. Only authorised HR personnel will have access to your documents for verification purposes. Need Assistance?</p>
			<p>If you encounter any issues while logging in, uploading documents, or have questions about the Employee Portal, please do not hesitate to contact the HR Department at hr@bsnmart.com. We are here to assist you and ensure a smooth onboarding experience. Once again, welcome to BSN Mart! We are confident that you will make valuable contributions to our team, and we are excited to have you as part of our company.</p>
		  
			<p><b>Best Regards,</b></p>
			<p><b>HR TEAM</b></p>
			<p><b>BSN Mart</b></p>


</body>
</html>