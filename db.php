<?php
$conn = mysqli_connect("localhost", "root", "", "chatt");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>