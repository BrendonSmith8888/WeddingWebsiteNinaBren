<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
$fridayevening = isset($_POST['fridayevening']) ? $_POST['fridayevening'] : null;
$allergies = isset($_POST['allergies']) ? $_POST['allergies'] : null;
$additionalguests = isset($_POST['additionalguests']) ? $_POST['additionalguests'] : 0;
$name1 = isset($_POST['name1']) ? $_POST['name1'] : null;
$attending1 = isset($_POST['attending1']) ? $_POST['attending1'] : null;
$song1 = isset($_POST['song1']) ? $_POST['song1'] : null;
$meal1 = isset($_POST['mealList1']) ? $_POST['mealList1'] : null;
$fridayevening1 = isset($_POST['fridayevening1']) ? $_POST['fridayevening1'] : null;
$allergies1 = isset($_POST['allergies1']) ? $_POST['allergies1'] : null;
$name2 = isset($_POST['name2']) ? $_POST['name2'] : null;
$attending2 = isset($_POST['attending2']) ? $_POST['attending2'] : null;
$song2 = isset($_POST['song2']) ? $_POST['song2'] : null;
$meal2 = isset($_POST['mealList2']) ? $_POST['mealList2'] : null;
$fridayevening2 = isset($_POST['fridayevening2']) ? $_POST['fridayevening2'] : null;
$allergies2 = isset($_POST['allergies2']) ? $_POST['allergies2'] : null;
$name3 = isset($_POST['name3']) ? $_POST['name3'] : null;
$attending3 = isset($_POST['attending3']) ? $_POST['attending3'] : null;
$song3 = isset($_POST['song3']) ? $_POST['song3'] : null;
$meal3 = isset($_POST['mealList3']) ? $_POST['mealList3'] : null;
$fridayevening3 = isset($_POST['fridayevening3']) ? $_POST['fridayevening3'] : null;
$allergies3 = isset($_POST['allergies3']) ? $_POST['allergies3'] : null;

if($additionalguests == 0){
    if (!$name || !$attending || !$email || !$song || !$meal || !$fridayevening || !$allergies) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit;
    }
    
    $insertQuery = "INSERT INTO guests (name, attending, email, song,  meal, friday, allergies) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
        exit;
    }
    
    $stmt->bind_param("sssssss", $name, $attending, $email, $song, $meal, $fridayevening, $allergies);

    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
        exit;
    }
    
    echo json_encode(['status' => 'success', 'message' => 'Guest added successfully']);
    $stmt->close();
} elseif($additionalguests == 1){
    $sql1 = "INSERT INTO guests (name, attending, email, song, meal, friday, allergies) VALUES ('$name', '$attending', '$email', '$song', '$meal', '$fridayevening', '$allergies')";
    $sql2 = "INSERT INTO guests (name, attending, email, song, meal, friday, allergies) VALUES ('$name1', '$attending1', '$email', '$song1', '$meal1', '$fridayevening1', '$allergies1')";

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
    $sql1 = "INSERT INTO guests (name, attending, email, song, meal, friday, allergies) VALUES ('$name', '$attending', '$email', '$song', '$meal', '$fridayevening', '$allergies')";
    $sql2 = "INSERT INTO guests (name, attending, email, song, meal, friday, allergies) VALUES ('$name1', '$attending1', '$email', '$song1', '$meal1', '$fridayevening1', '$allergies1')";
    $sql3 = "INSERT INTO guests (name, attending, email, song, meal, friday, allergies) VALUES ('$name2', '$attending2', '$email', '$song2', '$meal2', '$fridayevening2', '$allergies2')";
    if (mysqli_query($conn, $sql1)) {
        if (mysqli_query($conn, $sql2)) {
            if (mysqli_query($conn, $sql3)) {
                echo json_encode(['status' => 'success', 'message' => '3 guests added successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => "ERROR: Could not execute third query. " . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => "ERROR: Could not execute second query. " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => "ERROR: Could not execute first query. " . mysqli_error($conn)]);
    }
} elseif ($additionalguests == 3){
    $sql1 = "INSERT INTO guests (name, attending, email, song, meal, friday, allergies) VALUES ('$name', '$attending', '$email', '$song', '$meal', '$fridayevening', '$allergies')";
    $sql2 = "INSERT INTO guests (name, attending, email, song, meal, friday, allergies) VALUES ('$name1', '$attending1', '$email', '$song1', '$meal1', '$fridayevening1', '$allergies1')";
    $sql3 = "INSERT INTO guests (name, attending, email, song, meal, friday, allergies) VALUES ('$name2', '$attending2', '$email', '$song2', '$meal2', '$fridayevening2', '$allergies2')";
    $sql4 = "INSERT INTO guests (name, attending, email, song, meal, friday, allergies) VALUES ('$name3', '$attending3', '$email', '$song3', '$meal3', '$fridayevening3', '$allergies3')";
    
    if (mysqli_query($conn, $sql1)) {
        if (mysqli_query($conn, $sql2)) {
            if (mysqli_query($conn, $sql3)) {
                if(mysqli_query($conn, $sql4)){
                    echo json_encode(['status' => 'success', 'message' => '4 guests added successfully']);
                } else{
                    echo json_encode(['status' => 'error', 'message' => "ERROR: Could not execute fourth query. " . mysqli_error($conn)]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => "ERROR: Could not execute third query. " . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => "ERROR: Could not execute second query. " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => "ERROR: Could not execute first query. " . mysqli_error($conn)]);
    }
}
$conn->close();
?>