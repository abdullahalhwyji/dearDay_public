<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Simple Div Design</title>
<style>
    .container {
        padding: 20px;
        margin: 5px;
        color: white;
        border-radius: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out;
    
    }
    .container:hover {
        transform: translateY(-10px);
    }
    #f1 {
        background: linear-gradient(135deg, #F9C80E, #F86624); /* Yellow */
        text-align: center;
    }
    #f2 {
        background: linear-gradient(135deg, #7BC043, #3AA17E); /* Green */
        text-align: center;
    }
    #f3 {
        background: linear-gradient(135deg, #EF4D5A, #E91E63); /* Red */
        text-align: center;
    }
    
    .grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: auto;
        border-radius: 20px;
        gap: 10px;
        padding: 20px;
    }
    #f4 { 
        grid-column: 1 / span 2; 
        grid-row: 2; 
        border-radius: 20px;
        background-color: white;
        height: 530px; /* Adjust the height as needed */
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    #f5 { 
        grid-column: 3; 
        grid-row: 2; 
        border-radius: 20px;
        height: 530px; /* Adjust the height as needed */
        background-color: white;
    }
    h1 {
        font-family: 'Arial', sans-serif;
        font-size: 24px;
        margin-bottom: 10px;
        color: black;
    }
    p {
        font-family: 'Arial', sans-serif;
        font-size: 16px;
    }
    .big-text {
        font-size: 26px; /* Adjust font size as needed */
        margin-bottom: 10px;
    }
    .very-big-text {
        font-size: 36px; /* Adjust font size as needed */
        margin-bottom: 10px;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php
$totalUsers = 100;
$goodMentalHealth = 70;
$badMentalHealth = 30;
$labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
$data = [65, 59, 80, 81, 56, 55, 40];
?>

<div class="grid-container">
    <div class="container" id="f1">
        <div class="big-text">Total Users</div>
        <div class="very-big-text"><?php echo $totalUsers; ?></div>
    </div>
    <div class="container" id="f2">
        <div class="big-text">Good Mental Health</div>
        <div class="very-big-text"><?php echo $goodMentalHealth; ?></div>
    </div>
    <div class="container" id="f3">
        <div class="big-text">Bad Mental Health</div>
        <div class="very-big-text"><?php echo $badMentalHealth; ?></div>
    </div>
    <div class="container" id="f4">
        <h1>Line chart for the users</h1>
        <canvas id="myLineChart" width="400" height="400"></canvas>
    </div>
    <div class="container" id="f5">
        <img src="./assets/img/hello.png" alt="A beautiful scenery" style="width:100%; height:100%; border-radius: 20px;">
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('myLineChart').getContext('2d');
    const myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Users Over Time',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
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
});
</script>

</body>
</html>
