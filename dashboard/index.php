<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['username'])) {
  header("Location: ../login.php");
  exit();
}

if (!isset($_SESSION['user_id'])) {
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

<?php

if (!isset($_SESSION['username'])) {
  header("Location: ../login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT mood, DATE_FORMAT(time, '%m-%d') as time FROM daily_mood WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
$veryHappyCount = 0; // Initialize counter for "Very Happy" mood
$happyCount = 0; // Initialize counter for "Very Happy" mood
$normalCount = 0; // Initialize counter for "Very Happy" mood
$sadCount = 0; // Initialize counter for "Very Happy" mood
$verySadCount = 0; // Initialize counter for "Very Happy" mood

while ($row = $result->fetch_assoc()) {
  $data[] = $row;
  if ($row['mood'] == 'very good') {
    $veryHappyCount++;
  }
  if ($row['mood'] == 'good') {
    $happyCount++;
  }
  if ($row['mood'] == 'pretty normal') {
    $normalCount++;
  }
  if ($row['mood'] == 'bad') {
    $sadCount++;
  }
  if ($row['mood'] == 'very bad') {
    $verySadCount++;
  }
}

$query = "SELECT entry_id, title, content, timestamp FROM tbl_journal WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$journals = $result->fetch_all(MYSQLI_ASSOC);

// Debugging: Check if data is fetched
if (empty($journals)) {
  echo "No journal entries found.";
  $conn->close();
  exit();
}

// Get the last two journal entries
$last_two_journals = array_slice($journals, -2, 2);


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

while ($row = $result->fetch_assoc()) {
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
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UI/UX</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

  <style>
    /* expression tracker css */
    .parent {
      height: 99%;
      width: 100%;
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      grid-template-rows: repeat(5, 1fr);
      grid-column-gap: 5px;
      grid-row-gap: 5px;
    }

    .div1,
    .div2,
    .div3,
    .div4,
    .div5,
    .div6,
    .div7,
    .div8,
    .div9 {
      background-color: red;
      display: flex;
      justify-content: center;
      align-items: center;
      border: 1px solid white;
      border-radius: 15px;
    }

    .div1,
    .div2,
    .div3,
    .div4,
    .div5 {
      height: 120px;
      color: #fff;
      font-weight: bold;
      font-size: 20px;
    }



    .div1 {
      grid-area: 1 / 1 / 2 / 2;
    }

    .div2 {
      grid-area: 1 / 2 / 2 / 3;
    }

    .div3 {
      grid-area: 1 / 3 / 2 / 4;
    }

    .div4 {
      grid-area: 1 / 4 / 2 / 5;
    }

    .div5 {
      grid-area: 1 / 5 / 2 / 6;
    }

    .div6 {
      grid-area: 2 / 1 / 4 / 4;
    }

    .div7 {
      grid-area: 4 / 1 / 6 / 4;
    }

    .div8 {
      grid-area: 2 / 4 / 4 / 6;
    }

    .div9 {
      grid-area: 4 / 4 / 6 / 6;
    }



    .div1 {
      background: #004d00;
    }

    .div2 {
      background: #006600;
    }

    .div3 {
      background: #808000;
    }

    .div4 {
      background: #993d00;
    }

    .div5 {
      background: #800000;
    }

    .div7,
    .div8,
    .div6,
    .div9 {
      background-color: white;
    }

    .express {
      display: grid;
      width: 96%;
      gap: 1.8rem;
      grid-template-columns: 14rem auto;
      margin: 0 auto;
    }

    #myBarChart {
      width: 100%;
    }

    /* Table styling */
    .table {
      width: 100%;
      height: 100%;
      border-collapse: collapse;
      margin: 5px 0;
      font-size: 14px;
      text-align: center;
    }

    table th,
    table td {
      padding: 5px;
      border-bottom: 1px solid #ddd;
    }

    table th {
      background-color: #808000;
      color: white;
      font-weight: bold;
    }

    table tr:hover {
      background-color: #f5f5f5;
    }

    .table-title {
      font-size: 18px;
      font-weight: bold;
      margin: 5px 0;
      text-align: center;
    }

    .read-more {
      background-color: #808000;
      color: white;
      padding: 10px 20px;
      text-align: center;
      display: block;
      margin: 20px auto;
      width: 150px;
      text-decoration: none;
      border-radius: 5px;
    }

    .read-more:hover {
      background-color: #45a049;
    }

    .div1,
    .div2,
    .div3,
    .div4,
    .div5 {
      display: flex;
      flex-direction: column;
      color: white;

      padding: 10px;
      margin: 5px;
      font-size: 18px;
      align-items: center;
    }

    .div1 span,
    .div2 span,
    .div3 span,
    .div4 span,
    .div5 span {

      font-size: 40px;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="express">
    <aside>
      <div class="top">
        <div class="logo">
          <h2><img src="../img/colored.png" alt=""> <span class="danger">DearDay</span></h2>
        </div>
        <div class="close" id="close_btn">
          <span class="material-symbols-sharp">close</span>
        </div>
      </div>

      <div class="sidebar">
        <a href="../dashboard/index.php" class="active">
          <span class="material-symbols-sharp">grid_view</span>
          <h3>Your Activity</h3>
        </a>
        <a href="../dashboard/journal_history.php">
          <span class="material-symbols-sharp">library_books</span>
          <h3>Journal History</h3>
        </a>
        <a href="../dashboard/mood_tracker.php">
          <span class="material-symbols-sharp">sentiment_satisfied</span>
          <h3>Mood Tracker</h3>
        </a>
        <a href="../dashboard/expression_tracker.php">
          <span class="material-symbols-sharp">ar_on_you</span>
          <h3>Expression Tracker</h3>
        </a>
        <a href="../dashboard/quiz_history.php">
          <span class="material-symbols-sharp">abc</span>
          <h3>Quiz History</h3>
        </a>
        <a href="../dashboard/quiz_summary.php">
          <span class="material-symbols-sharp">assignment</span>
          <h3>Quiz Summary</h3>
        </a>
        <a href="../dashboard/profile.php">
          <span class="material-symbols-sharp">person_outline</span>
          <h3>Profile</h3>
        </a>
        <a href="../interface/interface.php">
          <span class="material-symbols-sharp">logout</span>
          <h3>Go Back</h3>
        </a>
      </div>
    </aside>

    <main>
      <div class="parent">
        <div class="div1"><span><?php echo $veryHappyCount; ?><span style="font-size:10px;">days</span></span>
          <div>Very Good Mood</div>
        </div>
        <div class="div2"><span><?php echo $happyCount; ?><span style="font-size:10px;">days</span></span>
          <div>Good Mood</div>
        </div>
        <div class="div3"><span><?php echo $normalCount; ?><span style="font-size:10px;">days</span></span>
          <div>Normal Mood</div>
        </div>
        <div class="div4"><span><?php echo $sadCount; ?><span style="font-size:10px;">days</span></span>
          <div>Bad Mood</div>
        </div>
        <div class="div5"><span><?php echo $verySadCount; ?><span style="font-size:10px;">days</span></span>
          <div>Very Bad Mood</div>
        </div>

        <div class="div6">
          <div style="width: 100%;">
            <div class="table-title">Journal Entries</div>
            <table class="table">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Title</th>
                  <th>Content</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($last_two_journals as $journal): ?>
                  <tr>
                    <td><?php echo date('Y-m-d', strtotime($journal['timestamp'])); ?></td>
                    <td><?php echo htmlspecialchars($journal['title']); ?></td>
                    <td><?php echo htmlspecialchars($journal['content']); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <a href="journal_history.php" class="read-more">Read more</a>
          </div>
        </div>
        <div class="div7">
          <canvas id="myBarChart"></canvas>
        </div>
        <div class="div8">
          <canvas id="donutChart"></canvas>
        </div>
        <div class="div9">
          <canvas id="myPieChart"></canvas>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Bar Chart
    const barCtx = document.getElementById('myBarChart').getContext('2d');
    const myBarChart = new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: ['Depression', 'Generalized Anxiety', 'Social Anxiety', 'ADHD', 'Gender Dysphoria', 'PTSD'],
        datasets: [{
          label: 'Percentage',
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: '#993d00',
          borderColor: '#993d00',
          borderWidth: 1
        }]
      },
      options: {
        plugins: {
          title: {
            display: true,
            text: 'Average Data from the Quizzes',
            color: '#000',
            font: {
              size: 15
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function (value) {
                return value + '%';
              }
            }
          }
        }
      }
    });

    // // Doughnut Chart
    // const doughnutCtx = document.getElementById('myDoughnutChart').getContext('2d');
    // const myDoughnutChart = new Chart(doughnutCtx, {
    //   type: 'doughnut',
    //   data: {
    //     labels: ['Label1', 'Label2', 'Label3', 'Label4', 'Label5', 'Label6', 'Label7'],
    //     datasets: [{
    //       label: 'Percentage',
    //       data: [15, 10, 25, 20, 10, 10, 10],
    //       backgroundColor: [
    //         'rgba(153, 0, 0, 1)',       // Dark red
    //         'rgba(0, 102, 153, 1)',     // Dark blue
    //         'rgba(204, 163, 0, 1)',     // Dark yellow
    //         'rgba(0, 102, 102, 1)',     // Dark teal
    //         'rgba(102, 0, 204, 1)',     // Dark purple
    //         'rgba(204, 102, 0, 1)',     // Dark orange
    //         'rgba(153, 51, 0, 1)'       // Darker orange
    //       ],
    //       borderColor: [
    //         'rgba(153, 0, 0, 1)',       // Dark red
    //         'rgba(0, 102, 153, 1)',     // Dark blue
    //         'rgba(204, 163, 0, 1)',     // Dark yellow
    //         'rgba(0, 102, 102, 1)',     // Dark teal
    //         'rgba(102, 0, 204, 1)',     // Dark purple
    //         'rgba(204, 102, 0, 1)',     // Dark orange
    //         'rgba(153, 51, 0, 1)'  
    //       ],
    //       borderWidth: 1
    //     }]
    //   },
    //   options: {
    //     plugins: {
    //       legend: {
    //         display: false
    //       },
    //       tooltip: {
    //         enabled: true
    //       },
    //       title: {
    //         display: true,
    //         text: 'Expression Distribution (From Camera)',
    //         color: '#000',
    //         font: {
    //           size: 15
    //         }
    //       }
    //     }
    //   }
    // });


    // Pie chart data and configuration
    const pieChartData = {
      labels: ['Very Happy', 'Happy', 'Normal', 'Sad', 'Very Sad'],
      datasets: [{
        data: [5, 5, 5, 5, 5],
        backgroundColor: ['#004d00', '#006600', '#808000', '#993d00', '#800000'],
        hoverBackgroundColor: ['#004d00', '#006600', '#808000', '#993d00', '#800000']
      }]
    };

    const pieChartConfig = {
      type: 'pie',
      data: pieChartData,
      options: {
        responsive: true,
        plugins: {
          tooltip: {
            callbacks: {
              label: function (context) {
                return `${context.raw}`;
              }
            }
          },
          legend: {
            display: false
          },
          title: {
            display: true,
            text: 'Mood Distribution',
            color: '#000',
            font: {
              size: 18
            }
          }
        }
      }
    };

    window.onload = function () {
      const ctxPie = document.getElementById('myPieChart').getContext('2d');
      new Chart(ctxPie, pieChartConfig);
    };


    var moodCounts = <?php echo json_encode(array_values($mood_counts)); ?>;
var moods = <?php echo json_encode($moods); ?>;
var total = <?php echo $total_count; ?>;

function displayNoData(ctx, message) {
  ctx.font = "20px Arial";
  ctx.textAlign = "center";
  ctx.textBaseline = "middle";
  ctx.fillText(message, ctx.canvas.width / 2, ctx.canvas.height / 2);
}

if (!moodCounts || moodCounts.length === 0 || total === 0) {
  var ctxDonut = document.getElementById('donutChart').getContext('2d');
  displayNoData(ctxDonut, "No data");
} else {
  // Donut Chart
  var ctxDonut = document.getElementById('donutChart').getContext('2d');
  var donutChart = new Chart(ctxDonut, {
    type: 'doughnut',
    data: {
      labels: moods,
      datasets: [{
        label: 'Expression Distribution (From Camera)',
        data: moodCounts,
        backgroundColor: [
          'rgba(153, 0, 0, 1)',       // Dark red
          'rgba(0, 102, 153, 1)',     // Dark blue
          'rgba(204, 163, 0, 1)',     // Dark yellow
          'rgba(0, 102, 102, 1)',     // Dark teal
          'rgba(102, 0, 204, 1)',     // Dark purple
          'rgba(204, 102, 0, 1)',     // Dark orange
          'rgba(153, 51, 0, 1)'
        ],
        borderColor: [
          'rgba(153, 0, 0, 1)',       // Dark red
          'rgba(0, 102, 153, 1)',     // Dark blue
          'rgba(204, 163, 0, 1)',     // Dark yellow
          'rgba(0, 102, 102, 1)',     // Dark teal
          'rgba(102, 0, 204, 1)',     // Dark purple
          'rgba(204, 102, 0, 1)',     // Dark orange
          'rgba(153, 51, 0, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            enabled: true
          },
          title: {
            display: true,
            text: 'Expression Distribution (From Camera)',
            color: '#000',
            font: {
              size: 15
            }
          }
        }
      }
    
  });
}

  </script>
</body>

</html>