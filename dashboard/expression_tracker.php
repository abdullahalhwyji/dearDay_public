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

            <a href="../dashboard/index.php" >
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
           <a href="#" class="active">
              <span class="material-symbols-sharp">ar_on_you </span>
              <h3>Expression Tracker</h3>
           </a>
           <a href="../dashboard/quiz_history.php">
              <span class="material-symbols-sharp">abc </span>
              <h3>Quiz History</h3>
           </a>
           <a href="../dashboard/profile.php">
              <span class="material-symbols-sharp">person_outline </span>
              <h3>Profile</h3>
           </a>
           <a href="../interface/interface.php">
              <span class="material-symbols-sharp">logout </span>
              <h3>Main Menu</h3>
           </a>
             


          </div>

      </aside>

      <script src="script.js"></script>
</body>
</html>