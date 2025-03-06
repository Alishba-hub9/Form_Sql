<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out |</title>
    <link rel="stylesheet" href="../dist/css/vendors.min.css">
    <link rel="stylesheet" href="../dist/css/style.css">

</head>
<body>

    <div class="wrapper-loggedout-page">
        <div class="container">
            <div class="loggedout-content">
        <h1>You have been logged out</h1>
            <p>Your session has ended successfully. For security reasons, always log out when leaving your account.</p>
            <p>If you need to continue, log in again.</p>
            <button class="login-again-btn">Login Again</buttun>
        </div>
        </div>
    </div>

    <script src="../dist/js/vendors.min.js" defer></script>
    <script src="../dist/js/script.min.js" defer></script>


</body>
</html>
