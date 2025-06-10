<?php
session_start();
include("db.php");

// Only allow logged-in users to delete
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if message ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // sanitizing input

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM chat WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Success
        header("Location: index.php?deleted=true");
    } else {
        // Error in deletion
        header("Location: index.php?error=delete_failed");
    }

    $stmt->close();
} else {
    // ID not provided
    header("Location: index.php?error=no_id");
}

$conn->close();
?>
