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

<div class="grid-container">
    <div class="container" id="f1">
        <div class="big-text">Total Users</div>
        <div class="very-big-text">100</div>
    </div>
    <div class="container" id="f2">
    <div class="big-text">Good Mental Health</div>
    <div class="very-big-text">70</div>
    </div>
    <div class="container" id="f3">
    <div class="big-text">Bad Mental Health</div>
    <div class="very-big-text">30</div>
    </div>
    <div class="container" id="f4">
        <canvas id="barChart" style="width:100%; height:100%;"></canvas>
    </div>
    <div class="container" id="f5">
        <img src="./assets/img/hello.png" alt="A beautiful scenery" style="width:100%; height:100%; border-radius: 20px;">
    </div>
</div>

<script>
    window.addEventListener("load", function() {
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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
