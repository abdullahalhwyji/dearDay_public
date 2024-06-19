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

            <a href="#" class="active">
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
      <!-- --------------
        end asid
      -------------------- -->

      <!-- --------------
        start main part
      --------------- -->

      <main>
           <h1>Dashbord</h1>

           <div class="date">
             <input type="date" >
           </div>

        <div class="insights">

           <!-- start seling -->
            <div class="sales">
               <span class="material-symbols-sharp">trending_up</span>
               <div class="middle">

                 <div class="left">
                   <h3>Total Sales</h3>
                   <h1>$25,024</h1>
                 </div>
                  <div class="progress">
                      <svg>
                         <circle  r="30" cy="40" cx="40"></circle>
                      </svg>
                      <div class="number"><p>80%</p></div>
                  </div>

               </div>
               <small>Last 24 Hours</small>
            </div>
           <!-- end seling -->
              <!-- start expenses -->
              <div class="expenses">
                <span class="material-symbols-sharp">local_mall</span>
                <div class="middle">
 
                  <div class="left">
                    <h3>Total Sales</h3>
                    <h1>$25,024</h1>
                  </div>
                   <div class="progress">
                       <svg>
                          <circle  r="30" cy="40" cx="40"></circle>
                       </svg>
                       <div class="number"><p>80%</p></div>
                   </div>
 
                </div>
                <small>Last 24 Hours</small>
             </div>
            <!-- end seling -->
               <!-- start seling -->
               <div class="income">
                <span class="material-symbols-sharp">stacked_line_chart</span>
                <div class="middle">
 
                  <div class="left">
                    <h3>Total Sales</h3>
                    <h1>$25,024</h1>
                  </div>
                   <div class="progress">
                       <svg>
                          <circle  r="30" cy="40" cx="40"></circle>
                       </svg>
                       <div class="number"><p>80%</p></div>
                   </div>
 
                </div>
                <small>Last 24 Hours</small>
             </div>
            <!-- end seling -->

        </div>
       <!-- end insights -->
      <div class="recent_order">
         <h2>Recent Orders</h2>
         <table> 
             <thead>
              <tr>
                <th>Product Name</th>
                <th>Product Number</th>
                <th>Payments</th>
                <th>Status</th>
              </tr>
             </thead>
              <tbody>
                 <tr>
                   <td>Mini USB</td>
                   <td>4563</td>
                   <td>Due</td>
                   <td class="warning">Pending</td>
                   <td class="primary">Details</td>
                 </tr>
                 <tr>
                  <td>Mini USB</td>
                  <td>4563</td>
                  <td>Due</td>
                  <td class="warning">Pending</td>
                  <td class="primary">Details</td>
                </tr>
                <tr>
                  <td>Mini USB</td>
                  <td>4563</td>
                  <td>Due</td>
                  <td class="warning">Pending</td>
                  <td class="primary">Details</td>
                </tr>
                <tr>
                  <td>Mini USB</td>
                  <td>4563</td>
                  <td>Due</td>
                  <td class="warning">Pending</td>
                  <td class="primary">Details</td>
                </tr>
              </tbody>
         </table>
         <a href="#">Show All</a>
      </div>

      </main>
      <!------------------
         end main
        ------------------->

      <!----------------
        start right main 
      ---------------------->
    


   </div>



   <script src="script.js"></script>
</body>
</html>