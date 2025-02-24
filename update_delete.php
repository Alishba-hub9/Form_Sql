<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteId"])) {
    $id = $_POST["deleteId"];
    $sql = "DELETE FROM form_data WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    exit;
}


$sql = "SELECT * FROM form_data ORDER BY id DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $key => $value) {
        if ($key !== 'id') {
            echo "<td data-key='$key'>" . htmlspecialchars($value) . "</td>";
        }
    }    
    echo "<td>
        <button class='edit-btn' data-id='{$row['id']}'>Edit</button>
        <button class='delete-btn' data-id='{$row['id']}'>Delete</button>
    </td></tr>";
}

$conn->close();
?> 