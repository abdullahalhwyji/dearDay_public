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
    <link rel="stylesheet" href="../css/style_quiz.css">
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
   
    <script>
        function Question(question, questionCategory, responseOptions, responseOptionScores) {
            this.question = question;
            this.questionCategory = questionCategory;
            this.responseOptions = responseOptions;
            this.responseOptionScores = responseOptionScores;
            this.userResponse;
        }

        function askQuestion(questionObject) {
            let bannerEl = document.getElementById("banner-image");
            bannerEl.innerText = "";
            let mainEl = document.getElementsByTagName("main")[0];
            mainEl.innerText = "";

            let questionTitle = document.createElement("h1");
            for (let i = 0; i < questionObjects.length; i++) {
                if (questionObjects[i].question == questionObject.question) {
                    questionTitle.innerText = `Question ${i+1} of ${questionObjects.length}`;
                    break;
                }
            }
            mainEl.appendChild(questionTitle);

            let questionEl = document.createElement("p");
            questionEl.innerText = questionObject.question;
            questionEl.setAttribute("id", "question");
            mainEl.appendChild(questionEl);

            let answersEl = document.createElement("ul");
            for (let i = 0; i < questionObject.responseOptions.length; i++) {
                let answerEl = document.createElement("li");
                answerEl.innerText = questionObject.responseOptions[i];
                answersEl.appendChild(answerEl);
            }
            mainEl.appendChild(answersEl);

            document.getElementsByTagName("ul")[0].addEventListener("click", handleResponse);
        }

        function handleResponse(event) {
            let elementClicked = event.target;

            for (let i = 0; i < questionObjects.length; i++) {
                if (document.getElementsByTagName("p")[0].innerText == questionObjects[i].question) {
                    questionObjects[i].userResponse = Array.from(elementClicked.parentNode.children).indexOf(elementClicked);
                    break;
                }
            }

            if (questionsAlreadyAsked.length == questionObjects.length) {
                document.getElementsByTagName("ul")[0].removeEventListener("click", handleResponse);
                getResults();
            } else {
                askNextQuestion();
            }
        }

        function askNextQuestion() {
            for (let i = 0; i < questionObjects.length; i++) {
                if (questionsAlreadyAsked.includes(questionObjects[i])) {
                } else {
                    questionsAlreadyAsked.push(questionObjects[i]);
                    askQuestion(questionObjects[i]);
                    break;
                }
            }
        }

        function getResults() {
            let questionCategories = [];
            let sumOfEachCategory = [];
            let maxScores = {};

            for (let i = 0; i < questionObjects.length; i++) {
                if (!questionCategories.includes(questionObjects[i].questionCategory)) {
                    questionCategories.push(questionObjects[i].questionCategory);
                    sumOfEachCategory.push(0);
                    maxScores[questionObjects[i].questionCategory] = 0;
                }
                maxScores[questionObjects[i].questionCategory] += Math.max(...questionObjects[i].responseOptionScores);
            }

            for (let j = 0; j < questionObjects.length; j++) {
                for (let i = 0; i < questionCategories.length; i++) {
                    if (questionCategories[i] == questionObjects[j].questionCategory) {
                        sumOfEachCategory[i] += questionObjects[j].responseOptionScores[Number(questionObjects[j].userResponse)];
                    }
                }
            }

            // Convert scores to percentages
            for (let i = 0; i < sumOfEachCategory.length; i++) {
                sumOfEachCategory[i] = (sumOfEachCategory[i] / maxScores[questionCategories[i]]) * 100;
            }

            showResults(questionCategories, sumOfEachCategory);

            let resultsData = {
                user_id: <?php echo json_encode($_SESSION['user_id']); ?>,
                depression: sumOfEachCategory[questionCategories.indexOf('Depression')],
                generalized_anxiety: sumOfEachCategory[questionCategories.indexOf('Generalized Anxiety')],
                social_anxiety: sumOfEachCategory[questionCategories.indexOf('Social Anxiety')],
                adhd: sumOfEachCategory[questionCategories.indexOf('ADHD')],
                gender_dysphoria: sumOfEachCategory[questionCategories.indexOf('Gender Dysphoria')],
                ptsd: sumOfEachCategory[questionCategories.indexOf('PTSD')],
                timestamp: new Date().toISOString()
            };

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "save_results.php", true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log("Results saved successfully");
                }
            };
            xhr.send(JSON.stringify(resultsData));
        }

        function showResults(x, y) {
            let mainEl = document.getElementsByTagName("main")[0];
            mainEl.innerText = "";

            let titleEl = document.createElement("h1");
            titleEl.innerText = "Questionnaire Results";
            titleEl.setAttribute("id", "results-h1");
            mainEl.appendChild(titleEl);

            let canvasContainer = document.createElement("div");
            canvasContainer.setAttribute("class","chart-divs");
            mainEl.appendChild(canvasContainer);

            let canvasEl = document.createElement("canvas");
            canvasContainer.appendChild(canvasEl);
            let ctx = canvasEl.getContext("2d");
            
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: x,
                    datasets: [{
                        label: 'Score',
                        data: y,
                        backgroundColor: '#86469C'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            title: {
                                display: true,
                                text: '% of Maximum Possible Score'
                            }
                        }
                    },
                }
            });

            let creditEl = document.createElement("p");
            creditEl.setAttribute("id","credit-p");
            creditEl.innerText = ``;
            mainEl.appendChild(creditEl);

            let descriptionObjects = {
                conditions: ['Depression','Generalized Anxiety','Social Anxiety','ADHD','Gender Dysphoria','PTSD'],
                links: [
                    'https://www.nimh.nih.gov/health/topics/depression',
                    'https://www.nimh.nih.gov/health/publications/generalized-anxiety-disorder-gad',
                    'https://www.nimh.nih.gov/health/statistics/social-anxiety-disorder',
                    'https://www.nimh.nih.gov/health/topics/attention-deficit-hyperactivity-disorder-adhd',
                    'https://en.wikipedia.org/wiki/Gender_dysphoria',
                    'https://www.nimh.nih.gov/health/topics/post-traumatic-stress-disorder-ptsd'
                ],
                descriptions: [
                    `Depression (major depressive disorder or clinical depression) is a common but serious mood disorder. It causes severe symptoms that affect how you feel, think, and handle daily activities, such as sleeping, eating, or working.`,
                    `Occasional anxiety is a normal part of life. You might worry about things like health, money, or family problems. But people with generalized anxiety disorder (GAD) feel extremely worried or feel nervous about these and other things—even when there is little or no reason to worry about them. People with GAD find it difficult to control their anxiety and stay focused on daily tasks.`,
                    `Social anxiety disorder (formerly social phobia) is characterized by persistent fear of one or more social or performance situations in which the person is exposed to unfamiliar people or to possible scrutiny by others. The individual fears that he or she will act in a way (or show anxiety symptoms) that will be embarrassing and humiliating.`,
                    `Attention-deficit/hyperactivity disorder (ADHD) is marked by an ongoing pattern of inattention and/or hyperactivity-impulsivity that interferes with functioning or development.`,
                    `Gender dysphoria involves a conflict between a person's physical or assigned gender and the gender with which he/she/they identify.`,
                    `PTSD is a disorder that develops in some people who have experienced a shocking, scary, or dangerous event. It is natural to feel afraid during and after a traumatic situation.`
                ]
            };

            for (let i = 0; i < x.length; i++) {
                let descriptionEl = document.createElement("p");
                descriptionEl.setAttribute("class","description-p");
                descriptionEl.innerHTML = `<b>${descriptionObjects.conditions[i]}:</b> ${descriptionObjects.descriptions[i]} <a href=${descriptionObjects.links[i]}>Read More</a>`;
                mainEl.appendChild(descriptionEl);
            }
        }

        let questionObjects = [
        new Question('In the past two weeks, how often have you been bothered by feeling down, depressed, or hopeless?', 'Depression', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by feeling nervous, anxious, or on edge?', 'Generalized Anxiety', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by avoiding social interactions?', 'Social Anxiety', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by difficulty concentrating?', 'ADHD', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by discomfort with your gender identity?', 'Gender Dysphoria', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by intrusive memories of a traumatic event?', 'PTSD', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by a lack of interest or pleasure in doing things?', 'Depression', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by uncontrollable worry?', 'Generalized Anxiety', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by fear of being judged by others?', 'Social Anxiety', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by restlessness or feeling on edge?', 'ADHD', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by feeling disconnected from your body or identity?', 'Gender Dysphoria', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by nightmares related to a traumatic event?', 'PTSD', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by feeling worthless or guilty?', 'Depression', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by difficulty controlling your worries?', 'Generalized Anxiety', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by avoiding situations where you are the center of attention?', 'Social Anxiety', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by fidgeting or an inability to sit still?', 'ADHD', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by a strong desire to change your body to match your gender identity?', 'Gender Dysphoria', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by avoiding reminders of a traumatic event?', 'PTSD', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by fatigue or loss of energy?', 'Depression', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by feeling easily annoyed or irritable?', 'Generalized Anxiety', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by feeling self-conscious in social situations?', 'Social Anxiety', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by feeling overly active or "on the go"?', 'ADHD', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by a sense of mismatch between your gender identity and physical appearance?', 'Gender Dysphoria', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by feeling detached or estranged from others?', 'PTSD', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by difficulty falling or staying asleep?', 'Depression', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by muscle tension?', 'Generalized Anxiety', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by fear of interacting with strangers?', 'Social Anxiety', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by difficulty organizing tasks and activities?', 'ADHD', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by feeling a need to socially transition to your identified gender?', 'Gender Dysphoria', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100]),
        new Question('In the past two weeks, how often have you been bothered by feeling hypervigilant or constantly on guard?', 'PTSD', ['Not at all', 'Several days', 'More than half the days', 'Nearly every day'], [0, 25, 50, 100])
    ];

        let questionsAlreadyAsked = [];

        document.getElementById("yes").addEventListener("click", function(){
            askQuestion(questionObjects[0]);
            questionsAlreadyAsked.push(questionObjects[0]);
        });
    </script>
</body>
</html>
