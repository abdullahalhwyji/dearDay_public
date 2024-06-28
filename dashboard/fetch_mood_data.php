<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Make sure you have session_start() if using sessions

include '../connection.php'; // Ensure you have the correct path to your connection script

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id']; 

$query = "SELECT mood, DATE_FORMAT(time, '%m-%d') as time FROM daily_mood WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($data);
?>
