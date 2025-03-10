<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="dist/css/vendors.min.css">
    <link rel="stylesheet" href="dist/css/style.css">
</head>
<body>
<h1 class="mt-4">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
<p class="mb-1">Fill out the form to register a new user or review the existing data below.</p>
 <div class="wrapper-registration-page">
    <div class="content-container">
        <div>
            <h2>Registration Form</h2>
            <form class="users-registration-form">
                <input type="hidden" name="id">
                <input type="text" name="name" placeholder="Enter Name" required>
                <input type="number" name="age" placeholder="Enter Age" required>
                <input type="number" name="phone" placeholder="Enter Phone Number" required>
                <input type="text" name="company" placeholder="Enter Company Name" required>
                <input type="text" name="country" placeholder="Enter Country" required>
                <div class="submit-button">
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>
        </div>

        <div>
            <h2>Registered Records</h2>
            <table class="user-records-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Country</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="user-records-body">
                    <tr>
                        <td colspan="6">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<a href="includes/logout.php" class="logout-btn">Logout</a>

<script src="dist/js/vendors.min.js" defer></script>
<script src="dist/js/script.min.js" defer></script>

</body>
</html>
