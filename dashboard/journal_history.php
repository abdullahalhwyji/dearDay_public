<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UI/UX</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
  <style>
   .container {
  display: flex;
  height: 100%;
}

  main {
  flex-grow: 1;
  padding: 20px;
}

.search-filter {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.search-filter input[type="text"] {
  width: 60%;
  padding: 10px;
  font-size: 16px;
}

.search-filter input[type="date"] {
  width: 20%;
  padding: 10px;
  font-size: 16px;
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

.grid-item {
  background: #f4f4f4;
  padding: 40px; /* You can increase this value if you want more padding */
  text-align: center;
  border: 1px solid #ddd;
  font-size: 18px; /* Increased font size */
  height: 200px; /* Fixed height */
  /* Alternatively, you can use min-height */
  /* min-height: 200px; */
}

  </style>
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
            <a href="../dashboard/index.php">
              <span class="material-symbols-sharp">grid_view </span>
              <h3>Your Activity</h3>
           </a>
           <a href="#" class="active">
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

      <main>
        <div class="search-filter">
          <input type="text" placeholder="Search...">
          <input type="date">
        </div>
        <div class="grid-container">
          <div class="grid-item">div1</div>
          <div class="grid-item">div2</div>
          <div class="grid-item">div3</div>
          <div class="grid-item">div4</div>
          <div class="grid-item">div5</div>
          <div class="grid-item">div6</div>
          <div class="grid-item">div7</div>
          <div class="grid-item">div8</div>
          <div class="grid-item">div9</div>
          <div class="grid-item">div7</div>
          <div class="grid-item">div8</div>
          <div class="grid-item">div9</div>
          <div class="grid-item">div7</div>
          <div class="grid-item">div8</div>
          <div class="grid-item">div9</div>
        </div>
      </main>

      <script src="script.js"></script>
</body>
</html>
