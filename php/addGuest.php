<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
include("config.php");

$conn = new mysqli($cd_host, $cd_user, $cd_password, $cd_dbname, $cd_port, $cd_socket);

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

$name = isset($_POST['name']) ? $_POST['name'] : null;
$attending = isset($_POST['attending']) ? $_POST['attending'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$song = isset($_POST['song']) ? $_POST['song'] : null;
$meal = isset($_POST['mealList']) ? $_POST['mealList'] : null;
$additionalguests = isset($_POST['additionalguests']) ? $_POST['additionalguests'] : 0;
$name1 = isset($_POST['name1']) ? $_POST['name1'] : null;
$attending1 = isset($_POST['attending1']) ? $_POST['attending1'] : null;
$song1 = isset($_POST['song1']) ? $_POST['song1'] : null;
$meal1 = isset($_POST['mealList1']) ? $_POST['mealList1'] : null;
$name2 = isset($_POST['name2']) ? $_POST['name2'] : null;
$attending2 = isset($_POST['attending2']) ? $_POST['attending2'] : null;
$song2 = isset($_POST['song2']) ? $_POST['song2'] : null;
$meal2 = isset($_POST['mealList2']) ? $_POST['mealList2'] : null;
$name3 = isset($_POST['name3']) ? $_POST['name3'] : null;
$attending3 = isset($_POST['attending3']) ? $_POST['attending3'] : null;
$song3 = isset($_POST['song3']) ? $_POST['song3'] : null;
$meal3 = isset($_POST['mealList3']) ? $_POST['mealList3'] : null;

if($additionalguests == 0){
    if (!$name || !$attending || !$email || !$song || !$meal) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit;
    }
    
    $insertQuery = "INSERT INTO guests (name, attending, email, song,  meal) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
        exit;
    }
    
    $stmt->bind_param("sssss", $name, $attending, $email, $song, $meal);

    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
        exit;
    }
    
    echo json_encode(['status' => 'success', 'message' => 'Guest added successfully']);
} elseif($additionalguests == 1){
    $sql1 = "INSERT INTO guests (name, attending, email, song, meal) VALUES ('$name', '$attending', '$email', '$song', '$meal')";
    $sql2 = "INSERT INTO guests (name, attending, email, song, meal) VALUES ('$name1', '$attending1', '$email', '$song1', '$meal1')";

    if (mysqli_query($conn, $sql1)) {
        if (mysqli_query($conn, $sql2)) {
            echo json_encode(['status' => 'success', 'message' => 'Both guests added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => "ERROR: Could not execute second query. " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => "ERROR: Could not execute first query. " . mysqli_error($conn)]);
    }
} elseif($additionalguests == 2){
    if (!$name2 || !$attending2 || !$song2 || !$meal2) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit;
    }
    $insertQuery = "INSERT INTO guests (name, attending, email, song,  meal) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sssss", $name, $attending, $email, $song, $meal);

    $insertQuery1 = "INSERT INTO guests (name, attending, email, song,  meal) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery1);
    $stmt->bind_param("sssss", $name1, $attending1, $email, $song1, $meal1);

    $insertQuery2 = "INSERT INTO guests (name, attending, email, song,  meal) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery2);
    
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
        exit;
    }
    
    $stmt->bind_param("sssss", $name2, $attending2, $email, $song2, $meal2);
    
    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
        exit;
    }
    
    echo json_encode(['status' => 'success', 'message' => 'Guest 2 added successfully']);
} elseif ($additionalguests == 3){
    if (!$name3 || $attending3 || !$song3 || !$meal3) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit;
    }

    $insertQuery = "INSERT INTO guests (name, attending, email, song,  meal) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sssss", $name, $attending, $email, $song, $meal);

    $insertQuery1 = "INSERT INTO guests (name, attending, email, song,  meal) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery1);
    $stmt->bind_param("sssss", $name1, $attending1, $email, $song1, $meal1);

    $insertQuery2 = "INSERT INTO guests (name, attending, email, song,  meal) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery2);
    $stmt->bind_param("sssss", $name2, $attending2, $email, $song2, $meal2);

    $insertQuery3 = "INSERT INTO guests (name3, attending3, email, song3,  meal3) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery3);
    
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
        exit;
    }
    
    $stmt->bind_param("sssss", $name3, $attending3, $email, $song3, $meal3);
    
    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
        exit;
    }
    
    echo json_encode(['status' => 'success', 'message' => 'Guest added successfully']);
}
// $stmt->close();
$conn->close();
?>