<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo 'You must be logged in to submit a journal entry.';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $timestamp = date('Y-m-d H:i:s');

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'dearDay');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $stmt = $conn->prepare('INSERT INTO tbl_journal (user_id, title, content, timestamp) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('isss', $user_id, $title, $content, $timestamp);

    if ($stmt->execute()) {
        echo 'Entry saved successfully';
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request method';
}
?>
