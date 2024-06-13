<!DOCTYPE html>
<html>
    <?php
        session_start();
        if (!isset($_SESSION['user_id'])) {
         
            header("Location: ../login.php");
            exit();
        }
        ?>
<head>
    <title>Mental Health Awareness</title>
    <link rel="stylesheet" href="/css/style_quiz.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<a href="../logout.php" class="btn" id="welcome-btn">Welcome, <span><?=$_SESSION['name'];?></span></a> 
    <div id="banner-image">
        <main>
            <section id="quiz-box">
                <div id="quiz-box-text">
                    <h1>Mental Health Screening Quiz</h1>
                    <h2>Would you like to take the questionnaire?</h2>
                </div>
                <p class="button" id="yes">Start</p>
            </section>
        </main>
    </div>
    <main>
        <div class="home-cards">
            <h2>The Questionnaire</h2>
            <p class="long">The quiz is designed to quickly screen for the unknown presence of certain mental health conditions. 26% of the population is estimated to have a mental health condition, yet only 20% of the population has a mental health diagnosis. That difference suggests there is common prevalence of undiagnosed mental health conditions.</p>
        </div>
        <div id='zombo'>
            <a href="https://zombo.com/">Hi!</a>
        </div>
    </main>
    <script src="../js/quiz.js"></script>
    
    
</body>
</html>
