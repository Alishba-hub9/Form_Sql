<?php
session_start();
require "../includes/db.php";

header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
    exit;
}

$username = trim($_POST['username']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];

if (empty($username) || empty($email) || empty($password)) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $db_username, $hashed_password);
    $stmt->fetch();

    if ($db_username === $username && password_verify($password, $hashed_password)) {
        $_SESSION['user'] = $id;
        $_SESSION['username'] = $db_username;
        echo json_encode(["success" => true]);
        exit;
    }
}

echo json_encode(["success" => false, "message" => "Invalid credentials."]);
exit;
?>
