<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $user_id = $_SESSION['user_id'];
    $angry = $data['angry'];
    $disgusted = $data['disgusted'];
    $fearful = $data['fearful'];
    $happy = $data['happy'];
    $neutral = $data['neutral'];
    $sad = $data['sad'];
    $surprised = $data['surprised'];
    $timestamp = date('Y-m-d H:i:s');

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dearDay";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO face_results (user_id, angry, disgusted, fearful, happy, neutral, sad, surprised, time_stamp) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iddddddds", $user_id, $angry, $disgusted, $fearful, $happy, $neutral, $sad, $surprised, $timestamp);

    if ($stmt->execute()) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
