<?php
include("db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$pass')");
        echo "Registered successfully <a href='login.php'>Login</a>";
    } else {
        echo "Email already exists!";
    }
}
?>
<form method="post">
    Name: <input name="name"><br>
    Email: <input name="email"><br>
    Password: <input type="password" name="password"><br>
    <button type="submit">Register</button>
</form>