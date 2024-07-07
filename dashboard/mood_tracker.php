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
  
 
.date-range {
  width: 100%;
  display: flex;
  justify-content: start;
  margin-bottom: 20px;
  gap: 10px;
}


.date-range button {
  width: 20%;
  background-color: #86469C;
  color: #fff;
  border: none;
  padding: 10px 15px;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s;
  font-size: 1em;
}


.date-range button:hover {
  background-color: #ff7782;
}

/* Input Styles */
.date-range input {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 1em;
  outline: none;
  transition: border-color 0.3s;
}

.date-range input:focus {
  border-color: #007bff;
}

/* Canvas Styles */
canvas {
  display: block;
  width: 100%;
  height: 400px;
  margin-bottom: 20px;
  background-color: white;
  border-radius: 15px;
}

#startDate, #endDate {
  width: 20%;
}


  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
             <a href="../dashboard/mood_tracker.php" class="active">
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

      

        <main>
    <h1>Expression Tracker</h1>
  
    <!-- <div class="date-range">
      <input type="date" id="startDate" placeholder="Start Date">
      <input type="date" id="endDate" placeholder="End Date">
      <button onclick="applyDateRange()">Apply Date Range</button>
    </div>
     -->
  
    <div style="background-color: white; border-radius: 8px;">
      <div class="chart"></div>
    <h2 style="text-align: center;">Your Mood History</h2>
    <canvas id="moodChart"></canvas>
    </div>
   
  
   
    <!-- <canvas id="moodBarChart"></canvas> -->
   
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
              borderColor: '#86469C',
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
