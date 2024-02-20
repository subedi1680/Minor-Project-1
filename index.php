<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ematadan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$phone = $_POST['phone'];
$pass = $_POST['pass'];

$sql_admin = "SELECT * FROM admin WHERE phone='$phone' AND pass='$pass'";
$result_admin = $conn->query($sql_admin);

$sql_user = "SELECT * FROM register_login WHERE phone='$phone' AND pass='$pass'";
$result_user = $conn->query($sql_user);

if ($result_admin->num_rows > 0) {
    $_SESSION['phone'] = $phone;
    $_SESSION['loggedin'] = true;
    header('Location: admin_dashboard.html');
    exit;
} elseif ($result_user->num_rows > 0) {
    $_SESSION['phone'] = $phone;
    $_SESSION['loggedin'] = true;
    header('Location: voter.html');
    exit;
} else {
    echo "Invalid username or password";
}

$conn->close();
?>
