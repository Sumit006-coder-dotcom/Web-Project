<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assigning variables from form input
    $name = $_POST['name'];
    $message = $_POST['message']; // Make sure the name of the textarea/input in the form is 'message'

    // Insert into 'chat' table - use correct column names
    $sql = "INSERT INTO chat (name, message) VALUES ('$name', '$message')";
    mysqli_query($conn, $sql);

    // Redirect back to the chat page
    header("Location: index.php");
    exit();
}
?>
