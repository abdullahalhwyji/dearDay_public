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

// Fetch distinct dates from the face_results table
$query = "SELECT DISTINCT DATE(time_stamp) as date FROM face_results WHERE user_id = ? ORDER BY date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$dates = [];
while ($row = $result->fetch_assoc()) {
    $dates[] = $row['date'];
}
$stmt->close();

$date = isset($_POST['date']) ? $_POST['date'] : (count($dates) > 0 ? $dates[0] : date('Y-m-d'));

// Fetch data for the specified date
$sql = "SELECT * FROM face_results WHERE user_id = $user_id AND DATE(time_stamp) = '$date'";
$result = $conn->query($sql);

$face_data = array();

while($row = $result->fetch_assoc()) {
    $face_data[] = $row;
}

// Prepare data for charts
$moods = ['angry', 'disgusted', 'fearful', 'happy', 'neutral', 'sad', 'surprised'];
$mood_counts = array_fill_keys($moods, 0);
$data_count = count($face_data);

foreach ($face_data as $data) {
    foreach ($moods as $mood) {
        $mood_counts[$mood] += $data[$mood];
    }
}

if ($data_count > 0) {
    foreach ($moods as $mood) {
        $mood_counts[$mood] /= $data_count;
    }
}

$total_count = array_sum($mood_counts);

// Find the predominant mood
$query = "SELECT mood FROM daily_mood WHERE user_id = ? AND DATE(time) = ? ORDER BY time DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $user_id, $date);
$stmt->execute();
$result = $stmt->get_result();
$mood1 = $result->fetch_assoc();
$stmt->close();
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
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        

        
    }

    table, th, td {
        border: 1px solid #ddd;
        text-align: center;
        font-weight: bold;
       
    }
    th, td {
        padding: 15px;
        
        text-align: center;
    }
    th {
        background-color: rgba(75, 192, 192, 1);
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #ddd;
    }
    /* Ensure the last row also has border */
    tr:last-child td {
        border-bottom: 1px solid #ddd;
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
             <a href="../dashboard/expression_tracker.php" class="active">
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
                <h3>Main Menu</h3>
             </a>
           </div>
        </aside>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <main>
            <h1>Expression Tracker</h1>
            <form method="POST" action="">
                <div class="date">
                    <label for="date">Select Date: </label>
                    <select id="date" class="updt" name="date">
                        <?php foreach ($dates as $available_date): ?>
                            <option value="<?php echo $available_date; ?>" <?php if ($available_date == $date) echo 'selected'; ?>>
                                <?php echo $available_date; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="updt">Update</button>
                </div>
            </form>
            <div class="moodday">
                <?php if ($mood1 && $mood1['mood'] != null): ?>
                    <h3>My mood on <?php echo $date; ?> was:  <?php echo htmlspecialchars($mood1['mood']); ?></h3>
                <?php else: ?>
                    <h3>My mood on <?php echo $date; ?> was: None</h3>
                <?php endif; ?>
            </div>
            <div class="chart">
                <div>
                    <h2 style="text-align: center;">Donut Chart</h2>
                    <canvas class="middle" id="donutChart"></canvas>
                </div>
                <div>
                    <h2 style="text-align: center;">Bar Chart</h2>
                    <canvas class="middle" style="width:150px; height: 150px;" id="barChart"></canvas>
                </div>
            </div>
            <div>
                <h2>Data Table</h2>
                <table>
                    <thead>
                        <tr>
                            
                            <?php foreach ($moods as $mood): ?>
                                <th><?php echo ucfirst($mood); ?></th>
                            <?php endforeach; ?>
                            <th>Time Stamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($face_data as $data): ?>
                            <tr>
                               
                                <?php foreach ($moods as $mood): ?>
                                    <td><?php echo $data[$mood]; ?></td>
                                <?php endforeach; ?>
                                <td><?php echo $data['time_stamp']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
        <script>
            var moodCounts = <?php echo json_encode(array_values($mood_counts)); ?>;
            var moods = <?php echo json_encode($moods); ?>;
            var total = <?php echo $total_count; ?>;
            function displayNoData(ctx, message) {
                ctx.font = "20px Arial";
                ctx.textAlign = "center";
                ctx.textBaseline = "middle";
                ctx.fillText(message, ctx.canvas.width / 2, ctx.canvas.height / 2);
            }

            if (!moodCounts || moodCounts.length === 0|| total === 0) {
                var ctxBar = document.getElementById('barChart').getContext('2d');
                displayNoData(ctxBar, "No data");

                var ctxDonut = document.getElementById('donutChart').getContext('2d');
                displayNoData(ctxDonut, "No data");
            } else {
                // Bar Chart
                var ctxBar = document.getElementById('barChart').getContext('2d');
                var barChart = new Chart(ctxBar, {
                    type: 'bar',
                    data: {
                        labels: moods,
                        datasets: [{
                            label: 'Mood Counts',
                            data: moodCounts,
                            backgroundColor: 'rgba(75, 192, 192, 1)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Donut Chart
                var ctxDonut = document.getElementById('donutChart').getContext('2d');
                var donutChart = new Chart(ctxDonut, {
                    type: 'doughnut',
                    data: {
                        labels: moods,
                        datasets: [{
                            label: 'Mood Distribution',
                            data: moodCounts,
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(199, 199, 199, 1)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(199, 199, 199, 1)'
                            ],
                            borderWidth: 1
                        }]
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
