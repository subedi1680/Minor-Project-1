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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $candidate_id = $_POST['candidate_id'];

    $update_query = "UPDATE candidates SET vote_count = vote_count + 1 WHERE candidate_id = $candidate_id";
    if ($conn->query($update_query) === TRUE) {
        echo "Vote submitted successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}