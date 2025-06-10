<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if user already exists
    $checkUser = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $checkUser);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('⚠️ Username already exists');</script>";
    } else {
        // Insert user
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('✅ Registered successfully!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('❌ Registration failed');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register - Group Chat</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="login-bg">
  <div class="form-container">
    <h2>Register</h2>
    <form action="register.php" method="POST">
      <input type="text" name="username" placeholder="👤 Username" required>
      <input type="password" name="password" placeholder="🔐 Password" required>
      <button type="submit">Register</button>
      <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
  </div>
</body>
</html>
