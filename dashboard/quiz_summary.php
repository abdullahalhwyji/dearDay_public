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

// Fetch all quiz results for the user
$query = "SELECT * FROM quiz_results WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$quiz_data = [];
while ($row = $result->fetch_assoc()) {
    $quiz_data[] = $row;
}
$stmt->close();
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
  <style>
    /* Add these styles to your style.css file */

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
}

table th, table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
}

table tbody tr {
    border-bottom: 1px solid #dddddd;
}

table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

table tbody tr:hover {
    background-color: #f1f1f1;
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
             <a href="../dashboard/quiz_summary.php" class="active">
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
           <h1>Quiz Summary</h1>
           
        
            <div class="chartfull">
            <!-- start line chart -->
            <div>
            <h2 style="text-align: center;">Line Chart</h2>
                <canvas class="middle" id="lineChart"></canvas>
            </div>
            <!-- end line chart -->
            </div>

            <!-- start data table -->
            <div>
                <h2 style="text-align: center;">Quiz Data</h2>
                <table border="1" cellpadding="10" cellspacing="0" style="margin: 0 auto; text-align: center;">
                    <thead>
                        <tr>
                            <?php
                            if (!empty($quiz_data)) {
                                // Print table headers
                                foreach (array_keys($quiz_data[0]) as $header) {
                                    echo "<th>" . htmlspecialchars($header) . "</th>";
                                }
                            } else {
                                echo "<th>No data available</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Print table rows
                        foreach ($quiz_data as $row) {
                            echo "<tr>";
                            foreach ($row as $cell) {
                                echo "<td>" . htmlspecialchars($cell) . "</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- end data table -->
        </main>

        <script>
            var quizData = <?php echo json_encode($quiz_data); ?>;
            var labels = quizData.map(item => item.timestamp);
            var datasets = [];

            if (quizData.length > 0) {
                var keys = Object.keys(quizData[0]).filter(key => key !== 'user_id' && key !== 'timestamp' && key !== 'quiz_id' && key !== 'id');
                keys.forEach(key => {
                    var data = quizData.map(item => item[key]);
                    datasets.push({
                        label: key,
                        data: data,
                        borderColor: getRandomColor(),
                        fill: false
                    });
                });
            }

            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            if (datasets.length === 0) {
                var ctxLine = document.getElementById('lineChart').getContext('2d');
                displayNoData(ctxLine, "No data");
            } else {
                var ctxLine = document.getElementById('lineChart').getContext('2d');
                var lineChart = new Chart(ctxLine, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'chartArea', // Position the legend inside the chart area
                                align: 'end', // Align the legend to the start (left side) of the chart area
                                labels: {
                                    boxWidth: 20
                                }
                            }
                        },
                        layout: {
                            padding: {
                                top: 10,
                                right: 10,
                                bottom: 30, // Adjusted for more space at the bottom
                                left: 10  // Adjust these values to control the space around the chart
                            }
                        }
                    }
                });
            }

            function displayNoData(ctx, message) {
                ctx.font = "20px Arial";
                ctx.textAlign = "center";
                ctx.textBaseline = "middle";
                ctx.fillText(message, ctx.canvas.width / 2, ctx.canvas.height / 2);
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
