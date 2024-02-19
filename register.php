<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "ematadan"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$citizenship_no = $_POST['citizenship_no'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$pass = $_POST['pass'];

$stmt = $conn->prepare("INSERT INTO register_login (fname, lname, email, citizenship_no, phone, gender, dob, pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $fname, $lname, $email, $citizenship_no, $phone, $gender, $dob, $pass);

if ($stmt->execute() === TRUE) {
    header("location:voter.html");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
