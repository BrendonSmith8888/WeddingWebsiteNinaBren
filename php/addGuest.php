<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
include("config.php");

$name = isset($_POST['name']) ? $_POST['name'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$song = isset($_POST['song']) ? $_POST['song'] : null;
$meal = isset($_POST['mealList']) ? $_POST['mealList'] : null;

if (!$name || !$email || !$song || !$meal) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

$insertQuery = "INSERT INTO guest (name, email, song,  meal) VALUES (?, ?, ?, ?)";

$conn = new mysqli($cd_host, $cd_user, $cd_password, $cd_dbname, $cd_port, $cd_socket);
$stmt = $conn->prepare($insertQuery);

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
    exit;
}

$stmt->bind_param("ssss", $name, $email, $song, $meal);

if (!$stmt->execute()) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
    exit;
}

echo json_encode(['status' => 'success', 'message' => 'Guest added successfully']);

$stmt->close();
$conn->close();
?>