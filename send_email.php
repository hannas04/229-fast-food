<?php
// Email configuration
$to = 'digital04web@gmail.com';
$subject = 'New Booking Inquiry from 229 Fingerfoods';

// Get form data
$name = htmlspecialchars($_POST['name'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$phone = htmlspecialchars($_POST['phone'] ?? '');
$date = htmlspecialchars($_POST['date'] ?? '');
$eventType = htmlspecialchars($_POST['eventType'] ?? '');
$guests = htmlspecialchars($_POST['guests'] ?? '');
$location = htmlspecialchars($_POST['location'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');

// Get services
$services = $_POST['services'] ?? [];
$services_list = implode(', ', $services);

// Email message body
$body = "
<html>
<head>
<style>
body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
.container { background-color: #f4f4f4; padding: 20px; border-radius: 5px; }
.header { background-color: #C5A059; color: white; padding: 15px; border-radius: 5px 5px 0 0; text-align: center; }
.content { background-color: white; padding: 20px; }
.field { margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
.label { font-weight: bold; color: #C5A059; }
</style>
</head>
<body>
<div class=\"container\">
<div class=\"header\">
<h2>New Booking Inquiry - 229 Fingerfoods & Grills</h2>
</div>
<div class=\"content\">
<div class=\"field\">
<span class=\"label\">Full Name:</span> $name
</div>
<div class=\"field\">
<span class=\"label\">Email:</span> $email
</div>
<div class=\"field\">
<span class=\"label\">Phone Number:</span> $phone
</div>
<div class=\"field\">
<span class=\"label\">Event Date:</span> $date
</div>
<div class=\"field\">
<span class=\"label\">Event Type:</span> $eventType
</div>
<div class=\"field\">
<span class=\"label\">Expected Guests:</span> $guests
</div>
<div class=\"field\">
<span class=\"label\">Event Location:</span> $location
</div>
<div class=\"field\">
<span class=\"label\">Services Selected:</span> $services_list
</div>
<div class=\"field\">
<span class=\"label\">Additional Details:</span><br>$message
</div>
</div>
</div>
</body>
</html>
";

// Headers
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
$headers .= "From: $email" . "\r\n";

// Send email
if (mail($to, $subject, $body, $headers)) {
    // Also send confirmation to customer
    $customer_subject = 'Booking Inquiry Received - 229 Fingerfoods';
    $customer_body = "
    <html>
    <body>
    <p>Dear $name,</p>
    <p>Thank you for your booking inquiry with 229 Fingerfoods & Grills.</p>
    <p>We have received your details and will get back to you within 24 hours.</p>
    <p>Best regards,<br>229 Fingerfoods & Grills Team</p>
    </body>
    </html>
    ";
    $customer_headers = "MIME-Version: 1.0" . "\r\n";
    $customer_headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $customer_headers .= "From: $to" . "\r\n";
    
    mail($email, $customer_subject, $customer_body, $customer_headers);
    
    // Redirect with success message
    header('Location: index.html?success=1');
    exit;
} else {
    // Redirect with error
    header('Location: index.html?error=1');
    exit;
}
?>
