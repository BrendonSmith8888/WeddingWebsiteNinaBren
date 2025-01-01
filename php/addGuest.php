<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
include("config.php");

$name = $_POST['name'];
$email = $_POST['email'];
$song = $_POST['song'];
$meal = $_POST['meal'];

$conn = new mysqli($cd_host, $cd_user, $cd_password, $cd_dbname, $cd_port, $cd_socket);

if (mysqli_connect_errno()) {
    $output['status']['code'] = "300";
    $output['status']['name'] = "failure";
    $output['status']['description'] = "database unavailable";
    $output['status']['returnedIn'] = (microtime(true) - $executionStartTime) / 1000 . " ms";
    $output['data'] = [];
    mysqli_close($conn);
    echo json_encode($output);
    exit;
}

$insertQuery = "INSERT INTO guest (name, email, song,  meal) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("ssss", $name, $email, $song, $meal);
$stmt->execute();

$stmt->close();
$conn->close();
?>