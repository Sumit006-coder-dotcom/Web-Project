<?php
session_start();
include("db.php"); // Make sure this connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the users table
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if ($user['password'] === $password) { // No hashing yet
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('❌ Incorrect password');</script>";
        }
    } else {
        echo "<script>alert('❌ User not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - Group Chat</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="login-bg">
  <div class="form-container">
    <h2>Login</h2>
    <form action="login.php" method="POST">
      <input type="text" name="username" placeholder="👤 Username" required>
      <input type="password" name="password" placeholder="🔐 Password" required>
      <button type="submit">Login</button>
      <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
  </div>
</body>
</html>
