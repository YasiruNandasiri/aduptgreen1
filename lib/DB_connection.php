<?php
function OpenCon() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "raheyanaleen";
    $db = "user-registration";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
 
function CloseCon($conn) {
  $conn->close();
}
   
?>