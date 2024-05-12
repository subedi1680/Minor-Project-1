<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ematadan";
 $phone= $_SESSION['phone']; 

$conn = new mysqli($servername, $username, $password, $dbname);

$query69 = "SELECT status FROM register_login where phone = '$phone'";
$result = mysqli_query($conn, $query69);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $status = $row['status'];
     if ($status ==1){
        echo "<script>alert('You cannot vote more than once.');</script>";
        session_abort();
        exit();
     }
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vote'])) {
    $serialNumber = $_POST['serialNumber'];
    $query = "UPDATE candidates SET vote_count = vote_count + 1 WHERE id = $serialNumber";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Vote cast successfully');</script>";
    } else {
        echo "Error casting the vote: " . mysqli_error($conn);
    }
    $query1 = "UPDATE register_login SET status = 1   WHERE phone = $phone";
    if (mysqli_query($conn, $query1)) {
        echo "<script>alert('Thank you for your vote');</script>";
    }

}
