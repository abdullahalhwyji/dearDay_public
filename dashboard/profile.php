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
   

form {
  display: flex;
  flex-wrap: wrap; /* Allow wrapping if needed */
  width: 100%;
  background-color: #ffffff;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form h1 {
  font-size: 1.5rem;
  margin-bottom: 20px;
  width: 100%; /* Ensure the heading spans the full width */
}

form label {
  display: block;
  margin-bottom: 10px;
  flex: 1 1 100%; /* Take full width of the flex container */
}

form input[type="text"],
form input[type="email"],
form input[type="password"],
form select {
  width: calc(50% - 10px); /* Adjust width for two inputs in a row */
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
  flex: 1 1 50%; /* Equal width for both inputs */
}

form button {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 12px 20px;
  font-size: 1rem;
  cursor: pointer;
  border-radius: 4px;
  flex: 1 1 100%; /* Take full width of the flex container */
}

form button:hover {
  background-color: #0056b3;
}

  </style>
</head>
<body>
   <div class="express">
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
             <a href="../dashboard/profile.php" class="active">
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
   <h1>Profile Settings</h1>
   <form action="update_profile.php" method="POST">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br><br>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required><br><br>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>

      <label for="confirm_password">Repeat Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required><br><br>

      <label for="city">City:</label>
      <input type="text" id="city" name="city"><br><br>

      <label for="birthdate">Birthdate:</label>
      <input type="date" id="birthdate" name="birthdate"><br><br>

      <label for="gender">Gender:</label>
      <select id="gender" name="gender">
         <option value="male">Male</option>
         <option value="female">Female</option>
         <option value="other">Other</option>
      </select><br><br>

      <button type="submit">Update</button>
   </form>
</main>


      <script src="script.js"></script>
</body>
</html>