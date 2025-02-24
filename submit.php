<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? "";
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $company = $_POST['company'];
    $country = $_POST['country'];

    if (empty($id)) {
        $sql = "INSERT INTO form_data (name, age, phone, company, country) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisss", $name, $age, $phone, $company, $country);
        $msg = "Data inserted successfully!";
    } else {
        $sql = "UPDATE form_data SET name=?, age=?, phone=?, company=?, country=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisssi", $name, $age, $phone, $company, $country, $id);
        $msg = "Data updated successfully!";
    }

    if ($stmt->execute()) {
        echo $msg;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
