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
   
   .profile-form {
    
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
   
    width: 100%;
}

.form-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 15px;
}

.form-group {
    flex: 0 0 48%;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    
}

select{
  width: 49%;

    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button {
    margin-top: 20px;
    width: 20%;
    background-color: #007BFF;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-left: 15%;
   
}

button:hover {
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
   <form action="update_profile.php" method="POST" class="profile-form">
    <div class="form-row">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Repeat Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" id="city" name="city">
        </div>
        <div class="form-group">
            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate">
        </div>
    </div>

    <div class="form-group">
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            
        </select>
        <button type="submit">Update</button>
    </div>

    
</form>

</main>


      <script src="script.js"></script>
</body>
</html>