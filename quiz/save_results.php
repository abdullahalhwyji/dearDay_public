<?php
session_start();

date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data === null) {
        echo "No data received.";
        exit();
    }

    $quiz_id = uniqid(); 
    $user_id = $_SESSION['user_id'];
    $depression = $data['depression'];
    $generalized_anxiety = $data['generalized_anxiety'];
    $social_anxiety = $data['social_anxiety'];
    $adhd = $data['adhd'];
    $gender_dysphoria = $data['gender_dysphoria'];
    $ptsd = $data['ptsd'];
    $timestamp = date('Y-m-d H:i:s');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dearDay";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO quiz_results (quiz_id, user_id, depression, generalized_anxiety, social_anxiety, adhd, gender_dysphoria, ptsd, timestamp)
            VALUES ('$quiz_id', '$user_id', '$depression', '$generalized_anxiety', '$social_anxiety', '$adhd', '$gender_dysphoria', '$ptsd', '$timestamp')";

    if ($conn->query($sql) === TRUE) {
        echo "Results saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
