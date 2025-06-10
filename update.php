<?php
include("db.php");

if (isset($_POST['id']) && isset($_POST['message'])) {
    $id = intval($_POST['id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "UPDATE chat SET message='$message' WHERE id=$id";
    mysqli_query($conn, $sql);
}
?>
