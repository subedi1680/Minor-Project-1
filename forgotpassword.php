<?php
include('smtp/PHPMailerAutoload.php');
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ematadan";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['sendotp'])) {
    $email = $_POST['email'];
    $otp = rand(10000, 99999);
    $_SESSION['otp'] = $otp;
    echo smtp_mailer($email, 'One Time Password:', $otp);
} elseif(isset($_POST['verifyotp'])) {
    $enteredOTP = $_POST['otp'];
    if ($enteredOTP == $_SESSION['otp']) {
        $email = $_POST['email'];
        $newPassword = $_POST['new-password'];
        
        $sql = "UPDATE register_login SET pass = '$newPassword' WHERE email = '$email'";
        if(mysqli_query($conn, $sql)){
            echo "Password updated successfully!";
        } else {
            echo "Error updating password: " . mysqli_error($conn);
        }
    } else {
        echo "Entered OTP: " . $enteredOTP . "<br>";
        echo "Session OTP: " . $_SESSION['otp'] . "<br>";
        echo "Incorrect OTP! Please try again.";
    }
}

if(isset($_POST['updatepassword'])) {
    $email = $_POST['email'];
    $newPassword = $_POST['new-password'];
    
    $sql = "UPDATE register_login SET pass = '$newPassword' WHERE email = '$email'";
    if(mysqli_query($conn, $sql)){
        header("Location:index.html");
    } else {
        echo "Error updating password: " . mysqli_error($conn);
    }
}

function smtp_mailer($to, $subject, $msg){
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
 
    $mail->Username = "subedi1680@gmail.com";
    $mail->Password = "etta lkyv jwfo jbdi";
    $mail->SetFrom("subedi1680@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false
    ));
    if(!$mail->Send()){
        return $mail->ErrorInfo;
    } else {
        return 'Sent';
    }
}
?>
