<?php
session_start();
include('../connection.php');

date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

// Ensure connection is established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mood'])) {
    $mood = $_POST['mood'];
    $username = $_SESSION['username'];

    // Retrieve user ID based on the session username
    $query = "SELECT user_id FROM tbl_user WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $user_id = $user['user_id'];

    // Check if user_id is valid
    if ($user_id) {
        // Insert the mood record
        $insert_query = "INSERT INTO daily_mood (user_id, mood, time) VALUES (?, ?, NOW())";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("is", $user_id, $mood);

        if ($insert_stmt->execute()) {
            // Redirect back to interface.php after successful insertion
            header('Location: interface.php');
            exit();
        } else {
            echo "Error: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    } else {
        echo "Error: Unable to find user ID.";
    }

    $stmt->close();
}

$conn->close();
?>