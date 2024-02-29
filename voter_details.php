<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if(isset($_SESSION['user_data'])) {
        $user_data = $_SESSION['user_data'];
        echo "<div>VOTER NAME: {$user_data['fname']} {$user_data['lname']}</div>";
        echo "<div>DOB: {$user_data['dob']}</div>";
        echo "<div>PHONE NUMBER: {$user_data['phone']}</div>";
    }
} else {
    // Redirect if not logged in
    header("Location: index.html");
    exit;
}
?>
