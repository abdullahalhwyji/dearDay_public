<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Ensure user_id is set in session
if (!isset($_SESSION['user_id'])) {
    // Retrieve user ID based on the session username
    $username = $_SESSION['username'];
    $query = "SELECT user_id FROM tbl_user WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['user_id'];
    $stmt->close();
}

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UI/UX</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
   <div class="container">
      <aside>
           
         <div class="top">
           <div class="logo">
             <h2><img src="../img/colored.png" alt=""> <span class="danger">DearDay</span> </h2>
           </div>
           <div class="close" id="close_btn">
            <span class="material-symbols-sharp">
              close
              </span>
           </div>
         </div>
         <!-- end top -->
          <div class="sidebar">

            <a href="../dashboard/index.php" class="active">
              <span class="material-symbols-sharp">grid_view </span>
              <h3>Your Activity</h3>
           </a>
           <a href="../dashboard/journal_history.php" >
              <span class="material-symbols-sharp">library_books </span>
              <h3>Journal History</h3>
           </a>
           <a href="../dashboard/mood_tracker.php">
              <span class="material-symbols-sharp">sentiment_satisfied </span>
              <h3>Mood Tracker</h3>
           </a>
           <a href="../dashboard/expression_tracker.php">
              <span class="material-symbols-sharp">ar_on_you </span>
              <h3>Expression Tracker</h3>
           </a>
           <a href="../dashboard/quiz_history.php">
              <span class="material-symbols-sharp">abc </span>
              <h3>Quiz History</h3>
           </a>
           <a href="../dashboard/quiz_summary.php">
              <span class="material-symbols-sharp">assignment</span>
              <h3>Quiz Summary</h3>
           </a>
           <a href="../dashboard/profile.php">
              <span class="material-symbols-sharp">person_outline </span>
              <h3>Profile</h3>
           </a>
           <a href="../interface/interface.php">
              <span class="material-symbols-sharp">logout </span>
              <h3>Go Back</h3>
           </a>
             


          </div>

      </aside>
      <!-- --------------
        end asid
      -------------------- -->

      <!-- --------------
        start main part
      --------------- -->

      <main>
           <h1>Dashbord</h1>
          

          


   <script src="script.js"></script>
</body>
</html>