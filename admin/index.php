<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dearday";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get data
$sql = "SELECT gender, COUNT(*) as count FROM tbl_user GROUP BY gender";
$result = $conn->query($sql);

// Initialize arrays to store data
$genders = [];
$counts = [];
$genderCount = ['male' => 0, 'female' => 0];

// Fetch data and store in arrays
$totalCount = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $gender = strtolower($row['gender']);  // Ensure gender is in lowercase
        $genders[] = $gender;
        $counts[] = $row['count'];
        $totalCount += $row['count'];
        $genderCount[$gender] = $row['count'];
    }
}

// Calculate percentages
$percentages = [];
foreach ($counts as $count) {
    $percentages[] = round(($count / $totalCount) * 100, 2);
}

$sql = "SELECT birth_date FROM tbl_user";
$result2 = $conn->query($sql);

$users = [];
if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $users[] = $row;
    }
}

// Function to calculate age
function calculateAge($birthDate) {
    $birthDate = new DateTime($birthDate);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate)->y;
    return $age;
}

// Initialize age groups
$ageGroups = [
    'Children (0-12)' => 0,
    'Teenagers (13-19)' => 0,
    'Young Adults (20-34)' => 0,
    'Adults (35-49)' => 0,
    'Middle-Aged (50-64)' => 0,
    'Seniors (65+)' => 0
];

// Group users by age
foreach ($users as $user) {
    $age = calculateAge($user['birth_date']);
    if ($age >= 0 && $age <= 12) {
        $ageGroups['Children (0-12)']++;
    } elseif ($age >= 13 && $age <= 19) {
        $ageGroups['Teenagers (13-19)']++;
    } elseif ($age >= 20 && $age <= 34) {
        $ageGroups['Young Adults (20-34)']++;
    } elseif ($age >= 35 && $age <= 49) {
        $ageGroups['Adults (35-49)']++;
    } elseif ($age >= 50 && $age <= 64) {
        $ageGroups['Middle-Aged (50-64)']++;
    } else {
        $ageGroups['Seniors (65+)']++;
    }
}


$query = "SELECT city, COUNT(*) as user_count FROM tbl_user GROUP BY city";
$result3 = $conn->query($query);

// Check if query execution was successful
if (!$result3) {
    die("Query failed: " . $conn->error);
}

// Prepare arrays for Chart.js labels and data
$labels = [];
$data = [];
$backgroundColors = [];

while ($row = $result3->fetch_assoc()) {
    $labels[] = $row['city'];
    $data[] = $row['user_count'];
    // Generate random colors for each city
    $backgroundColors[] = 'rgba(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ', 1)';
}

// Query to get user count by month
$query = "SELECT DATE_FORMAT(timestamp, '%Y-%m') as month, COUNT(*) as user_count
          FROM tbl_user
          GROUP BY month
          ORDER BY month";
$result4 = $conn->query($query);

$months = [];
$monthlyUserCounts = [];

while ($row = $result4->fetch_assoc()) {
    $dateObj = DateTime::createFromFormat('Y-m', $row['month']);
    $formattedMonth = $dateObj->format('F Y');
    $months[] = $formattedMonth;
    $monthlyUserCounts[] = $row['user_count'];
}

$query = "SELECT mood, COUNT(*) as mood_count FROM daily_mood GROUP BY mood";
$result5 = $conn->query($query);

$goodMoodCount = 0;
$badMoodCount = 0;

if ($result5->num_rows > 0) {
    while ($row = $result5->fetch_assoc()) {
        $mood = strtolower($row['mood']);
        if (in_array($mood, ['very good', 'good', 'pretty normal'])) {
            $goodMoodCount += $row['mood_count'];
        } elseif (in_array($mood, ['bad', 'very bad'])) {
            $badMoodCount += $row['mood_count'];
        }
    }
}


// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dearadmin</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

        :root{
            --nav-width: 92px;
            --first-color: #86469C;
            --bg-color: #12192C;
            --sub-color: #B6CEFC;
            --white-color: #FFF;
            --body-font: 'Poppins', sans-serif;
            --normal-font-size: 1rem;
            --small-font-size: .875rem;
            --z-fixed: 100;
        }

        *,::before,::after{
            box-sizing: border-box;
        }
        html, body {
            height: 100%;
            margin: 0;
        }
        body{
            position: relative;
            padding: 2rem 0 0 6.75rem;
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            transition: .5s;
            display: flex;
            flex-direction: column;
        }
        #content-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        h1{
            margin: 0;
        }
        ul{
            margin: 0;
            padding: 0;
            list-style: none;
        }
        a{
            text-decoration: none;
        }

        .l-navbar{
            position: fixed;
            top: 0;
            left: 0;
            width: var(--nav-width);
            height: 100vh;
            background-color: var(--bg-color);
            color: var(--white-color);
            padding: 1.5rem 1.5rem 2rem;
            transition: .5s;
            z-index: var(--z-fixed);
        }

        .nav{
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }
        .nav__brand{
            display: grid;
            grid-template-columns: max-content max-content;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .nav__toggle{
            font-size: 1.25rem;
            padding: .75rem;
            cursor: pointer;
        }
        .nav__logo{
            color: var(--white-color);
            font-weight: 600;
        }
        .nav__link{
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: .75rem;
            padding: .75rem;
            color: var(--white-color);
            border-radius: .5rem;
            margin-bottom: 1rem;
            transition: .3s;
            cursor: pointer;
        }
        .nav__link:hover{
            background-color: var(--first-color);
        }
        .nav__icon{
            font-size: 1.25rem;
        }
        .nav__name{
            font-size: var(--small-font-size);
        }

        .expander{
            width: calc(var(--nav-width) + 9.25rem);
        }

        .body-pd{
            padding: 2rem 0 0 16rem;
        }

        .active{
            background-color: var(--first-color);
        }

        .collapse{
            grid-template-columns: 20px max-content 1fr;
        }
        .collapse__link{
            justify-self: flex-end;
            transition: .5s;
        }
        .collapse__menu{
            display: none;
            padding: .75rem 2.25rem;
        }
        .collapse__sublink{
            color: var(--sub-color);
            font-size: var(--small-font-size);
        }
        .collapse__sublink:hover{
            color: var(--white-color);
        }

        .showCollapse{
            display: block;
        }

        .rotate{
            transform: rotate(180deg);
        }

        .parent {
            margin: 0 20px 20px 0;
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            grid-template-rows: repeat(5, 1fr);
            grid-column-gap: 10px;
            grid-row-gap: 10px;
            flex: 1;
        }

        .div1, .div2, .div3, .div4, .div5, .div6, .div7 {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid white;
            border-radius: 20px;
        }

        .div1 { grid-area: 1 / 1 / 2 / 3; background-color: green; }
        .div2 { grid-area: 1 / 3 / 2 / 5; background-color: yellow; }
        .div3 { grid-area: 1 / 5 / 2 / 7; background-color: red;}
        .div4 { grid-area: 2 / 5 / 4 / 7;  }
        .div5 { grid-area: 4 / 5 / 6 / 7;  }
        .div6 { grid-area: 2 / 1 / 4 / 5;}
        .div7 { grid-area: 4 / 1 / 6 / 5;}


        .div6 {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .div6:hover::after {
        content: attr(title);
        position: absolute;
        bottom: 70%;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        white-space: nowrap;
        z-index: 10;
        opacity: 1;
        visibility: visible;
    }

    .div6::after {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s;
    }

    .div1 , .div2 , .div3{
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    color: white;
    text-align: center;
    font-family: 'Arial', sans-serif;
}

.div1 {
    background: linear-gradient(135deg, #ffcc33 0%, #ff9900 100%);
}

.div2 {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
}

.div3 {
    background: linear-gradient(135deg, #ff4b2b 0%, #ff416c 100%);
}

.info {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.text {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 10px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.value {
    font-size: 44px;
    font-weight: bold;
    margin-top: 10px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}


    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body id="body-pd">
    <div id="navbar-container"></div>
    <div id="content-container">
        <div class="parent">
        <div class="div1">
    <div class="info">
                <?php
                // Calculate total number of users
                $totalUsers = array_sum($ageGroups);
                ?>
        <span class="text">Total Users</span>
        <span class="value"><?php echo $totalUsers; ?></span>
    </div>
</div>
        <div class="div2">
    <div class="info">
        <span class="text">Users with Good Mood Today</span>
        <span class="value"><?php echo $goodMoodCount; ?></span>
    </div>
</div>
        <div class="div3">
    <div class="info">
        <span class="text">Users with Bad Mood Today</span>
        <span class="value"><?php echo $badMoodCount; ?></span>
    </div>
</div>
            
            <div class="div4">
                <canvas id="ageChart" width="200" height="200"></canvas>
            </div>
            <div class="div5">
                <canvas id="genderChart" width="200" height="200"></canvas>
            </div>
            <div class="div6">
    <canvas id="monthlyUsersChart" width="400" height="200"></canvas>
</div>
            <div class="div7">
                <canvas id="cityUsersChart" width="200" height="200"></canvas>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.js"></script>

    <script>


        function loadHTML(url, containerId, callback) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    document.getElementById(containerId).innerHTML = data;
                    if (callback) callback();
                })
                .catch(error => console.error('Error loading HTML:', error));
        }

        loadHTML('navbar.php', 'navbar-container', function() {
            showMenu('nav-toggle', 'navbar', 'body-pd');
            initializeMenuFunctions();
        });

        function loadPage(page) {
            loadHTML(page, 'content-container');
        }

        function showMenu(toggleId, navbarId, bodyId) {
            const toggle = document.getElementById(toggleId),
                  navbar = document.getElementById(navbarId),
                  bodyPadding = document.getElementById(bodyId);

            if (toggle && navbar) {
                toggle.addEventListener('click', () => {
                    navbar.classList.toggle('expander');
                    bodyPadding.classList.toggle('body-pd');
                });
            }
        }

        function initializeMenuFunctions() {
            const linkColor = document.querySelectorAll('.nav__link');
            function colorLink() {
                linkColor.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink));

            const linkCollapse = document.getElementsByClassName('collapse__link');
            for (let i = 0; i < linkCollapse.length; i++) {
                linkCollapse[i].addEventListener('click', function() {
                    const collapseMenu = this.nextElementSibling;
                    collapseMenu.classList.toggle('showCollapse');

                    const rotate = collapseMenu.previousElementSibling;
                    rotate.classList.toggle('rotate');
                });
            }
        }


        function createChart() {
            const ctx = document.getElementById('genderChart').getContext('2d');
            const genderChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($genders); ?>,
                    datasets: [{
                        label: 'Gender Distribution',
                        data: <?php echo json_encode($counts); ?>,
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var index = context.dataIndex;
                                var label = context.label || '';
                                var value = context.raw;
                                var percentage = <?php echo json_encode($percentages); ?>[index];
                                return label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                }}
            });
        }

        function createAgeChart() {
            const ctx = document.getElementById('ageChart').getContext('2d');
            const ageChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Children (0-12)', 'Teenagers (13-19)', 'Young Adults (20-34)', 'Adults (35-49)', 'Middle-Aged (50-64)', 'Seniors (65+)'],
                    datasets: [{
                        label: 'Age Distribution',
                        data: [                        <?php
                        echo $ageGroups['Children (0-12)'] . ', ';
                        echo $ageGroups['Teenagers (13-19)'] . ', ';
                        echo $ageGroups['Young Adults (20-34)'] . ', ';
                        echo $ageGroups['Adults (35-49)'] . ', ';
                        echo $ageGroups['Middle-Aged (50-64)'] . ', ';
                        echo $ageGroups['Seniors (65+)'];
                        ?>],
                        backgroundColor: 'rgba(75, 192, 192, 1)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        }


        function createMonthlyUsersChart() {
        const ctx = document.getElementById('monthlyUsersChart').getContext('2d');
        const monthlyUsersChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Number of Users',
                    data: <?php echo json_encode($monthlyUserCounts); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1,
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Months'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Users'
                        }
                    }
                },
                legend: {
                    position: 'bottom'
                }
            }
        });
    }

    function createCityUsersChart() {
        const ctx = document.getElementById('cityUsersChart').getContext('2d');
        const cityUsersChart = new Chart(ctx, {
            type: 'bar',
data: {
    labels: <?php echo json_encode($labels); ?>,
    datasets: [{
        label: 'Number of Users by City',
        data: <?php echo json_encode($data); ?>,
        backgroundColor: <?php echo json_encode($backgroundColors); ?>,
        borderColor: <?php echo json_encode($backgroundColors); ?>,
        borderWidth: 1
    }]
},
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom'
                }
            }
        });
    }

        document.addEventListener('DOMContentLoaded', function() {
            createChart();
            createAgeChart();
            createMonthlyUsersChart();
            createCityUsersChart();
        });
    </script>
</body>
</html>
