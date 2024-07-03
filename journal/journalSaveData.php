<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entry_title = $_POST['entry_title'];
    $entry_text = $_POST['entry_text'];
    $user_id = $_SESSION['user_id'];
    $timestamp = date('Y-m-d H:i:s');
    
    // Validate input
    if (!empty($entry_title) && !empty($entry_text)) {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dearDay";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO tbl_journal (user_id, title, content, timestamp) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $entry_title, $entry_text, $timestamp);

        if ($stmt->execute()) {
            // Close PHP tag to include JavaScript
            $stmt->close();
            $conn->close();
?>
            <script>
                // JavaScript alert
                alert("New entry created successfully");
                // Redirect back to ../interface/interface.php
                window.location.href = "../interface/interface.php";
            </script>
<?php
        } else {
            echo "Error: " . $stmt->error;
            $stmt->close();
            $conn->close();
        }

    } else {
        echo "Title and content are required.";
    }
}
?>
