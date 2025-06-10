<?php
session_start();
include("db.php");

date_default_timezone_set("Asia/Kolkata"); // Ensure correct timezone

$sql = "SELECT * FROM chat ORDER BY id ASC"; // ASC for chronological order
$result = mysqli_query($conn, $sql);

$lastDate = "";

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $name = htmlspecialchars($row['name']);
    $message = htmlspecialchars($row['message']);
    $timestamp = htmlspecialchars($row['timestamp']);
    $file = htmlspecialchars($row['file']);

    // Extract only the date
    $msgDate = date('Y-m-d', strtotime($timestamp));
    $today = date('Y-m-d');
    $yesterday = date('Y-m-d', strtotime("-1 day"));

    // Show "Today", "Yesterday", or actual date separator if date changes
    if ($msgDate !== $lastDate) {
        $label = ($msgDate === $today) ? "Today" : (($msgDate === $yesterday) ? "Yesterday" : date('d M Y', strtotime($msgDate)));
        echo "<div class='date-divider'><strong>📅 $label</strong></div>";
        $lastDate = $msgDate;
    }

    // Optionally apply different style for current user
    $ownMsg = ($_SESSION['username'] === $row['name']) ? "my-message" : "other-message";

    echo "<p id='msg_$id' class='$ownMsg'>
            <strong>$name:</strong> 
            <span class='msg-text'>$message</span>";

    // Display file (image or download link)
    if (!empty($file)) {
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            echo "<br><img src='$file' width='150' style='margin-top:5px;border-radius:8px;'/>";
        } else {
            echo "<br><a href='$file' target='_blank'>📄 Download File</a>";
        }
    }

    // Buttons: delete/edit/like
    echo "<br>
          <a href='delete.php?id=$id' onclick='return confirm(\"Delete this message?\")'>🗑️</a>
          <button onclick='editMessage($id)'>✏️</button>
          <button onclick='likeMessage($id)'>👍 <span id='like_$id'>0</span></button>
          <small style='color:gray;'>($timestamp)</small>
        </p>";
}
?>
