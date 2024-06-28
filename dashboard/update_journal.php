<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entry_id = $_POST['entry_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Update the journal entry
    $sql = "UPDATE tbl_journal SET title = ?, content = ? WHERE entry_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssii', $title, $content, $entry_id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
