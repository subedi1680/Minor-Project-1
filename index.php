<?php
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

    $sql = "SELECT phone,pass FROM register_login WHERE phone='$phone' AND pass='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header('Location: voter.html');
        exit;
    } else {
        echo "Invalid username or password";
    }

    $conn->close();
?>
