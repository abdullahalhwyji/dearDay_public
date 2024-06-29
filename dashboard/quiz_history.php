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
    $query = "SELECT id FROM tbl_user WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['id'];
    $stmt->close();
}

$user_id = $_SESSION['user_id'];

// Fetch distinct quiz IDs and timestamps from the quiz_results table
$query = "SELECT quiz_id, timestamp FROM quiz_results WHERE user_id = ? ORDER BY timestamp DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$quizzes = [];
while ($row = $result->fetch_assoc()) {
    $quizzes[] = $row;
}
$stmt->close();

// Fetch quiz results for the selected quiz_id
$quiz_id = $_POST['quiz_id'] ?? $quizzes[0]['quiz_id'];
$query = "SELECT * FROM quiz_results WHERE user_id = ? AND quiz_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $quiz_id);
$stmt->execute();
$result = $stmt->get_result();
$quiz_data = [];
while ($row = $result->fetch_assoc()) {
    $quiz_data[] = $row;
}
$stmt->close();

// Get the timestamp for the selected quiz_id
$selected_quiz_timestamp = '';
foreach ($quizzes as $quiz) {
    if ($quiz['quiz_id'] == $quiz_id) {
        $selected_quiz_timestamp = $quiz['timestamp'];
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz History</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<style>


.date label {
   width: 2;
    margin-right: 10px;
    font-weight: bold;
}

.date select{
   width: 300px;
   background-color: gray;
}
.date select:hover{
   width: 300px;
   
}

.updt {
    padding: 5px 10px;
    margin-left: 10px;
    cursor: pointer;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
}




</style>
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
             <a href="../dashboard/quiz_history.php" class="active">
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
                <h3>Main Menu</h3>
             </a>
               
  
  
            </div>
  
        </aside>

      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <main>
           <h1>Quiz History</h1>
           
            <form method="POST" action="">
            <div class="date">
               <label for="quiz_id">Choose the Quiz ID: </label>
                  <select id="quiz_id" class="updt" name="quiz_id">
                        <?php foreach ($quizzes as $quiz): ?>
                            <option value="<?php echo $quiz['quiz_id']; ?>" <?php if ($quiz['quiz_id'] == $quiz_id) echo 'selected'; ?>>
                                <?php echo $quiz['quiz_id']; ?>
                            </option>
                        <?php endforeach; ?>
                  </select>
                <button type="submit" class="updt">Update</button>
            </div>
            <div class="moodday">
                    <h3>Quiz Taken At: <?php echo $selected_quiz_timestamp; ?></h3>
            </div>
            </form>
        
            <div class="chart">
            <!-- start bar chart -->
            <div>
                <h2 style="text-align: center;">Bar Chart</h2>
                <canvas class="middle" id="barChart" style="width:150px; height:150px;"></canvas>
            </div>
            <!-- end bar chart -->
            <!-- start radar chart -->
            <div>
                <h2 style="text-align: center;">Spider Chart</h2>
                <canvas class="middle" id="radarChart"></canvas>
            </div>
            <!-- end radar chart -->
            </div>
        </main>

        <script>
            var quizData = <?php echo json_encode($quiz_data); ?>;
            var selectedQuizId = <?php echo json_encode($quiz_id); ?>;
            var labels = quizData.length > 0 ? Object.keys(quizData[0]).filter(key => key !== 'user_id' && key !== 'timestamp' && key !== 'quiz_id' && key !== 'id') : [];
            
            var data = quizData.find(item => item.quiz_id == selectedQuizId) || {};

            function displayNoData(ctx, message) {
               ctx.font = "20px Arial";
               ctx.textAlign = "center";
               ctx.textBaseline = "middle";
               ctx.fillText(message, ctx.canvas.width / 2, ctx.canvas.height / 2);
            }

            // Radar chart data preparation
            if (!Object.keys(data).length) {
               var ctxRadar = document.getElementById('radarChart').getContext('2d');
               displayNoData(ctxRadar, "No data");
            } else {
               var radarData = data; // Use the data of the selected quiz
               var maxValue = Math.max(...labels.map(label => radarData[label])) || 100;
               var ctxRadar = document.getElementById('radarChart').getContext('2d');
               var radarChart = new Chart(ctxRadar, {
                     type: 'radar',
                     data: {
                        labels: labels,
                        datasets: [{
                           label: 'Quiz Results',
                           data: labels.map(label => radarData[label]),
                           backgroundColor: 'rgba(75, 192, 192, 0.5)',
                           borderColor: 'rgba(75, 192, 192, 1)',
                           borderWidth: 1
                        }]
                     },
                     options: {
                        scales: {
                           r: {
                                 beginAtZero: true,
                                 min: 0,
                                 max: maxValue+5,
                                 ticks: {
                                    stepSize: maxValue / 10
                                 }
                           }
                        }
                     }
               });
            }

            // Bar chart data preparation
            if (!Object.keys(data).length) {
               var ctxBar = document.getElementById('barChart').getContext('2d');
               displayNoData(ctxBar, "No data");
            } else {
               var barData = data; // Use the data of the selected quiz
               var ctxBar = document.getElementById('barChart').getContext('2d');
               var barChart = new Chart(ctxBar, {
                     type: 'bar',
                     data: {
                        labels: labels,
                        datasets: [{
                           label: 'Quiz Results',
                           data: labels.map(label => barData[label]),
                           backgroundColor: 'rgba(153, 102, 255, 1)',
                           borderColor: 'rgba(153, 102, 255, 1)',
                           borderWidth: 1
                        }]
                     },
                     options: {
                        scales: {
                           y: {
                                 beginAtZero: true
                           }
                        }
                     }
               });
            }
         </script>

         <div class="right">
             <div class="top">
             <button id="menu_bar">
                 <span class="material-symbols-sharp">menu</span>
             </button>
             </div>
         </div> 
   </div>
      <script src="script.js"></script>
</body>
</html>
