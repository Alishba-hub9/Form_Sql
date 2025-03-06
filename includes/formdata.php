<?php
include '../includes/db.php';
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? null;

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
    $name = $_POST['name'] ?? null;
    $age = $_POST['age'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $company = $_POST['company'] ?? null;
    $country = $_POST['country'] ?? null;

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
