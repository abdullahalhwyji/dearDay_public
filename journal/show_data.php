<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Function to fetch journal entries
function getJournalEntries($user_id) {
    $entries = [];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dearDay";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT title, content, timestamp FROM tbl_journal WHERE user_id = $user_id ORDER BY timestamp DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $entries[] = $row;
        }
    }

    $conn->close();
    return $entries;
}

// Fetch journal entries for the current user
$user_id = $_SESSION['user_id'];
$entries = getJournalEntries($user_id);
?>