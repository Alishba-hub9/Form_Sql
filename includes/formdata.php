<?php
include '../includes/db.php';
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? null;

function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

if ($method === "GET") {
    if ($action === "get_single") {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo json_encode(["status" => "error", "message" => "ID is required"]);
            exit;
        }
        $stmt = $conn->prepare("SELECT * FROM form_data WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        echo json_encode(["status" => "success", "data" => $result->fetch_assoc()]);
        exit;
    } 

    $result = $conn->query("SELECT * FROM form_data ORDER BY id DESC");
    echo json_encode(["status" => "success", "data" => $result->fetch_all(MYSQLI_ASSOC)]);
    exit;
}

if ($method === "POST") {
    $name = isset($_POST['name']) ? sanitize_input($_POST['name']) : null;
    $age = isset($_POST['age']) ? intval($_POST['age']) : null;
    $phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : null;
    $company = isset($_POST['company']) ? sanitize_input($_POST['company']) : null;
    $country = isset($_POST['country']) ? sanitize_input($_POST['country']) : null;
    

    if (empty($name) || empty($age) || empty($phone) || empty($company) || empty($country)) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO form_data (name, age, phone, company, country) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $name, $age, $phone, $company, $country);
    $result = $stmt->execute();

    echo json_encode([
        "status"  => $result ? "success" : "error",
        "message" => $result ? "Record inserted successfully!" : "Error: " . $stmt->error
    ]);
    exit;
}

if ($method === "PATCH") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (!is_array($inputData)) {
        echo json_encode(["status" => "error", "message" => "Invalid JSON data"]);
        exit;
    }

    $id = $inputData['id'] ?? null;
    if (!$id) {
        echo json_encode(["status" => "error", "message" => "ID is required for update"]);
        exit;
    }

    $name = $inputData['name'] ?? null;
    $age = $inputData['age'] ?? null;
    $phone = $inputData['phone'] ?? null;
    $company = $inputData['company'] ?? null;
    $country = $inputData['country'] ?? null;

    if (empty($name) || empty($age) || empty($phone) || empty($company) || empty($country)) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    $stmt = $conn->prepare("UPDATE form_data SET name=?, age=?, phone=?, company=?, country=? WHERE id=?");
    $stmt->bind_param("sisssi", $name, $age, $phone, $company, $country, $id);
    $result = $stmt->execute();

    echo json_encode([
        "status"  => $result ? "success" : "error",
        "message" => $result ? "Record updated successfully!" : "Error: " . $stmt->error
    ]);
    exit;
}

if ($method === "DELETE") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (!is_array($inputData)) {
        echo json_encode(["status" => "error", "message" => "Invalid JSON data"]);
        exit;
    }

    $id = $inputData["id"] ?? null;
    if (!$id) {
        echo json_encode(["status" => "error", "message" => "ID is required for deletion"]);
        exit;
    }


    $stmt = $conn->prepare("DELETE FROM form_data WHERE id=?");
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    echo json_encode([
        "status"  => $result ? "success" : "error",
        "message" => $result ? "Record deleted successfully!" : "Error deleting record: " . $stmt->error
    ]);
    exit;
}

echo json_encode(["status" => "error", "message" => "Invalid request"]);
exit;
