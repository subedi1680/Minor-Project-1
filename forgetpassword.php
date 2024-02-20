<?php
$email = $_POST['email'];
$otp = rand(10000, 99999);
$to = $email;
$from = "sandeshlamsal9@gmail.com";
$fromName = "eMATADAN";
$subject = "OTP verification";
$message = "Your OTP is " . $otp;
$header = 'From: ' . $fromName . ' <' . $from . '>';
if (mail($to, $subject, $message, $header)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email. Please check your server configuration or try again later.";
}
?>
