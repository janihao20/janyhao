<?php

session_start();

header("Content-type: application/json");

// Check if user is logged in
if(!isset($_SESSION["status"]) || $_SESSION["status"] != "active"){
    echo json_encode([
        "status" => "error",
        "message" => "Unauthorized access"
    ]);
    exit;
}

// Check if ID is provided
if(!isset($_POST["id"]) || empty($_POST["id"])){
    echo json_encode([
        "status" => "error",
        "message" => "Message ID is required"
    ]);
    exit;
}

require_once "../backend/db-config.php";

$message_id = intval($_POST["id"]);

// Delete the message
$stmt = $conn->prepare("DELETE FROM contact_messages WHERE id = ?");
$stmt->bind_param("i", $message_id);

if($stmt->execute()){
    echo json_encode([
        "status" => "success",
        "message" => "Message deleted successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to delete message: " . $stmt->error
    ]);
}

$stmt->close();
$conn->close();

?>
