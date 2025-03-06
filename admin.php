<?php session_start(); ?>
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
        <form method="POST" id="loginForm" class="login-form">
                <input type="email" name="email" placeholder="Enter Your Email" required>
                <input type="password" name="password" placeholder="Enter Your Password" required>
                <button type="submit">Login</button>
        </form>
        </div>
        </div>
    </div>

    <script src="dist/js/vendors.min.js" defer></script>
    <script src="dist/js/script.min.js" defer></script>

</body>
</html>
