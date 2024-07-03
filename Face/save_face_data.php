<?php
session_start();

date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from POST
    $user_id = $_SESSION['user_id'];
    $angry = isset($_POST['angry']) ? (float) $_POST['angry'] : 0;
    $disgusted = isset($_POST['disgusted']) ? (float) $_POST['disgusted'] : 0;
    $fearful = isset($_POST['fearful']) ? (float) $_POST['fearful'] : 0;
    $happy = isset($_POST['happy']) ? (float) $_POST['happy'] : 0;
    $neutral = isset($_POST['neutral']) ? (float) $_POST['neutral'] : 0;
    $sad = isset($_POST['sad']) ? (float) $_POST['sad'] : 0;
    $surprised = isset($_POST['surprised']) ? (float) $_POST['surprised'] : 0;
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

    // Prepare and execute SQL query
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
