<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ematadan";

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT candidate_name, candidate_position FROM candidates";
$result = mysqli_query($connection, $query);

if ($result) {
    $serialNumber = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $serialNumber . "</td>";
        echo "<td>" . $row['candidate_name'] . "</td>";
        echo "<td>" . $row['candidate_position'] . "</td>";
        echo "<td>"."</td>";
        echo "</tr>";
        $serialNumber++;
    }
} else {
    echo "Error: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
