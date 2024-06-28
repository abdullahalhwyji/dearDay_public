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
  
 
.filter-buttons {
  margin-bottom: 20px;
}

.filter-buttons button {
  background-color: #2e3b4e;
  color: white;
  border: none;
  padding: 10px 20px;
  margin-right: 10px;
  border-radius: 5px;
  cursor: pointer;
}

.filter-buttons button:hover {
  background-color: #1e2a38;
}

canvas {
  background-color: white;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

#moodChart {
  max-width: 100%;
  margin: 20px 0;
}


#moodBarChart {
    margin-top: 20px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 80%;
    max-width: 100%;
    margin-bottom: 20px;
  }




  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
   <div class="container">
      <aside>
         <div class="top">
           <div class="logo">
             <h2><img src="../img/colored.png" alt=""> <span class="danger">DearDay</span> </h2>
           </div>
           <div class="close" id="close_btn">
            <span class="material-symbols-sharp">close</span>
           </div>
         </div>
         <!-- end top -->
         <div class="sidebar">
            <a href="../dashboard/index.php">
              <span class="material-symbols-sharp">grid_view</span>
              <h3>Your Activity</h3>
           </a>
           <a href="../dashboard/journal_history.php">
              <span class="material-symbols-sharp">library_books</span>
              <h3>Journal History</h3>
           </a>
           <a href="#" class="active">
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
           <a href="../dashboard/profile.php">
              <span class="material-symbols-sharp">person_outline</span>
              <h3>Profile</h3>
           </a>
           <a href="../interface/interface.php">
              <span class="material-symbols-sharp">logout</span>
              <h3>Main Menu</h3>
           </a>
         </div>
      </aside>

      

      <main>
      <h1>Expression Tracker</h1>
      <div class="filter-buttons">
        <button onclick="filterChart(1)">1 Month</button>
        <button onclick="filterChart(2)">2 Months</button>
        <button onclick="filterChart(3)">3 Months</button>
      </div>
      <canvas id="moodChart"></canvas>
      <canvas id="moodBarChart"></canvas> <!-- New canvas for the bar chart -->
    </main>

    <script>
      

      async function fetchData() {
        const response = await fetch('fetch_mood_data.php');
        const data = await response.json();
        return data;
      }

      function prepareChartData(data) {
        const labels = [];
        const moodData = [];

        data.forEach(entry => {
          labels.push(entry.time);
          switch (entry.mood) {
            case 'very good':
              moodData.push(5);
              break;
            case 'good':
              moodData.push(4);
              break;
            case 'pretty normal':
              moodData.push(3);
              break;
            case 'bad':
              moodData.push(2);
              break;
            case 'very bad':
              moodData.push(1);
              break;
          }
        });

        return { labels, moodData };
      }

      async function renderChart() {
        const rawData = await fetchData();
        const { labels, moodData } = prepareChartData(rawData);

        const ctx = document.getElementById('moodChart').getContext('2d');
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [{
              label: 'Mood Over Time',
              data: moodData,
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 2
            }]
          },
          options: {
  scales: {
    y: {
      ticks: {
        callback: function(value) {
          const emojis = ['😢', '😟', '😐', '😊', '😁'];
          return emojis[value - 1];
        },
        font: {
          size: 40 // Adjust the font size as needed
        }
      },
      min: 1,
      max: 5,
      offset: true, // Ensures that the chart includes the top and bottom margins
      grace: 0.2 // Increase the margin ratio (e.g., 0.2 means 20% margin)
    }
  }
}

        });
      }

      function filterChart(months) {
        // Implement filtering logic based on the selected months
        // This function should filter the raw data and then call renderChart again with the filtered data
      }

      renderChart();
    </script>
   </div>
   <script src="script.js"></script>
</body>
</html>
