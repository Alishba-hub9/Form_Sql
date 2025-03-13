<?php
 session_start();
if (isset($_SESSION['user'])) {
    header("Location: admin.php");
    exit;
}
require 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form |</title>
    <link rel="stylesheet" href="dist/css/vendors.min.css">
    <link rel="stylesheet" href="dist/css/style.css">
</head>
<body>
    <div class="wrapper-login-page">
    <div class="container">
      <div class="login-content">
        <h1>Welcome! Login To Continue</h1>
        <p>"Access your account to securely manage your records and stay organized. Log in to enjoy a seamless experience designed to keep your data safe and accessible at all times."</p>
        <form method="POST" class="login-form">
                <input type="text" name="username" placeholder="Enter Your Username" required>
                <input type="email" name="email" placeholder="Enter Your Email" required>
                <input type="password" name="password" placeholder="Enter Your Password" required>
                <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="./register-acc.html">Click here to register</a></p>
        </div>

<script src="dist/js/vendors.min.js"></script>
<script src="dist/js/script.min.js"></script>

</body>
</html>
