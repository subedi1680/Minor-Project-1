<?php
$server ='localhost';
$username ='root';
$password ='';
$dbname ='eMATADAN-Login';
$con =mysqli_connect($server, $username, $password, $dbname);
if (!$con)
{
echo"ERROR CONNECTING";
}
?>    