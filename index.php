<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Personal Data Form</title>
    <link rel="stylesheet" href="dist/css/vendors.min.css" />
    <link rel="stylesheet" href="dist/css/style.css" />
</head>
<body>

<h2>User Details</h2>
<form class="user-details-form">
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

<h2>User Records</h2>
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
    <tbody class="user-records-body"></tbody>
</table>

<script src="dist/js/vendors.min.js"></script>
<script src="dist/js/script.min.js"></script>

</body>
</html> 