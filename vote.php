<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ematadan";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vote'])) {
    $serialNumber = $_POST['serialNumber'];
    $query = "UPDATE candidates SET vote_count = vote_count + 1 WHERE id  = $serialNumber";

    if (mysqli_query($conn, $query)) {
        echo "Vote cast successfully";
    } else {
        echo "Error casting the vote: " . mysqli_error($conn);
    }
}
?>
