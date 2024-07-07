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

// Get current date
$current_date = date('Y-m-d');

// Fetch the latest mood for the current user based on the latest time
$query = "SELECT mood FROM daily_mood WHERE user_id = ? AND DATE(time) = ? ORDER BY time DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $user_id, $current_date);
$stmt->execute();
$result = $stmt->get_result();
$mood = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DearDay website</title>

    <script src="https://kit.fontawesome.com/c1df782baf.js"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-thin-rounded/css/uicons-thin-rounded.css'>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="../css/style_inter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../pop/pop.css?v=<?php echo time(); ?>">

   
</head>

<body>
    <header>
        <div class="logo"><img src="../img/colored.png" alt=""></div>

        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="#main-about">About</a>
            <a href="#team">Team</a>
            <a href="#service">Services</a>
            <a href="#feedback">Reviews</a>
            <a  href="http://127.0.0.1:5000/">ChatBot</a>
           
            <a href="../dashboard/index.php">Dashboard</a>
            <!-- DALLE= I add this in button for loging out in responsive mode -->
            <a href="../logout.php" class="out">Logout</a>
        </nav>

        <div class="right-icons">
            <div id="menu-bars" class="fas fa-bars"></div>
            <a href="../logout.php" class="btn" id="welcome-btn">Welcome, <span><?= $_SESSION['name']; ?></span></a>

        </div>

    </header>

       <!-- Pop-up container -->
   <div class="popup-container" id="popup-container">
    <!-- Pop-up box -->
    <div class="popup" id="popup">
        <p id="quote-text"></p>
        <button id="close-button" class="close-icon">
          <i class="fas fa-times"></i>
      </button>
    </div>
</div>

    <!-- header section ended -->

    <!-- Home section started -->
    <div class="main-home" id="home">

        <div class="home">
            <div class="home-left-content">
            <span>Welcome to DearDay</span>
<h2>We Care About Your<br> Mental Health</h2>
<p class="lorem">At DearDay, we offer a platform for journaling your daily thoughts and feelings, tracking your mood, and receiving personalized insights to enhance your emotional well-being.</p>


                <div class="home-btn">
                    <a href="">Read More</a>
                    <a <?php if ($mood && $mood['mood'] != null): ?>style="display: none;" <?php endif; ?>
                        class="homebtnsec" id="myBtn" href="#">How Was Your Mood Today?</a>
                    <?php if ($mood && $mood['mood'] != null): ?>
                        <button id="moodBtn">Your mood today: <?php echo htmlspecialchars($mood['mood']); ?></button>
                    <?php else: ?>
                        <button style="display: none;" id="moodBtn">Set Your Mood</button>
                    <?php endif; ?>
                </div>



                <!-- Modal content -->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div class="modal-inner-content">
                            <img src="../img/moodtracker1.png" alt="Image Description" class="modal-image">
                            <div class="modal-text">

                                <h2>Hey There,</h2>
                                <h2>How was your day?</h2>
                                <form action="mood.php" method="post">
                                    <div class="emoji-container">
                                        <div class="emoji">
                                            <button type="submit" name="mood" value="very good"><img
                                                    src="../img/VeryGood.png" alt="Very Good"></button>
                                            <p>Very Good</p>
                                        </div>
                                        <div class="emoji">
                                            <button type="submit" name="mood" value="good"><img
                                                    src="../img/SlightGood.png" alt="Slightly Good"></button>
                                            <p>Good</p>
                                        </div>
                                        <div class="emoji">
                                            <button type="submit" name="mood" value="pretty normal"><img
                                                    src="../img/Normal.png" alt="Pretty Normal"></button>
                                            <p>Pretty Normal</p>
                                        </div>
                                        <div class="emoji">
                                            <button type="submit" name="mood" value="bad"><img
                                                    src="../img/SlightSad.png" alt="Slightly Bad"></button>
                                            <p>Bad</p>
                                        </div>
                                        <div class="emoji">
                                            <button type="submit" name="mood" value="very bad"><img
                                                    src="../img/verysad.png" alt="Very Bad"></button>
                                            <p>Very Bad</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="home-right-content">
                <img src="../img/mainPage.png" alt="">
            </div>
        </div>
    </div>


    <div class="technology">
        <div class="main-technology">

            <div class="inner-technology" id="tech1">
                <span></span>
                <i class="fi fi-rr-journal"></i>
                <h2>Explore Your Inner Self</h2>
                <p>Express your fears, thoughts, and feelings to know yourself better. Use writing as personal
                    relaxation to destress and unwind</p>
            </div>

            <div class="inner-technology" id="tech2">
                <span></span>
                <i class="fi fi-rr-camera"></i>
                <h2>Real-Time Mood Tracker</h2>
                <p>Monitor your mood in real time with our camera-based feature. Get instant emotional feedback and
                    improve your well-being effortlessly.</p>
            </div>

            <div class="inner-technology" id="tech3">
                <span></span>
                <i class="fi fi-tr-quiz"></i>
                <h2>Mental Health Quiz</h2>
                <p>Take this quiz to understand your mental well-being and improve your happiness. Start now for
                    insights into your mental health.</p>
            </div>
        </div>
    </div>

    <!-- home section ends -->

    <!-- About us section started -->

    <div class="main-about" id="main-about">

        <div class="about-heading">About Us</div>

        <div class="inner-main-about">
            <div class="about-inner-content-left">

                <img src="../img/About5.png" alt="">
            </div>

            <div class="about-inner-content">
                <div class="about-right-content">
                    <h2>Leading the Way in Mental Health <br>Research and Care</h2>
                    <p>At DearDay, we believe that taking care of your mental health is just as vital as caring for your
                        physical health.</p>
                    <p class="aboutsec-content">
                        We are dedicated to providing a comprehensive platform that empowers individuals to prioritize
                        their mental well-being, access valuable resources, and find the support they need to lead
                        healthier, happier lives.
                    </p>

                    <button class="aboutbtn">Read More</button>
                </div>
            </div>
        </div>
    </div>

    <!-- About us section ends -->

    <!-- our doctors -->

    <div class="main-doctors" id="team">
        <div class="doctors-heading">
            <h2>Our Team</h2>
        </div>

        <div class="main-inner-doctor">

            <div class="doc-poster">
                <div class="doc-icons">
                    <i class="fa-solid fa-share"></i>
                    <i class="fa-solid fa-eye"></i>
                    <i class="fa-solid fa-heart"></i>
                </div>
                <img src="../img/jay.jpg" alt="">
                <div class="doc-details">
                    <h2>Fazile</h2>

                    <a href="https://www.linkedin.com/in/alhwyji" target="_blank">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                    <a href="https://www.instagram.com/jayydhn" target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
            </div>


            <div class="doc-poster">
                <div class="doc-icons">
                    <i class="fa-solid fa-share"></i>
                    <i class="fa-solid fa-eye"></i>
                    <i class="fa-solid fa-heart"></i>
                </div>
                <img src="../img/hwyji2.jpg" alt="">

                <div class="doc-details">
                    <h2>Alhwyji</h2>

                    <a href="https://www.linkedin.com/in/alhwyji" target="_blank">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                    <a href="https://www.instagram.com/tairan.id" target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>

            </div>



            <div class="doc-poster">
                <div class="doc-icons">
                    <i class="fa-solid fa-share"></i>
                    <i class="fa-solid fa-eye"></i>
                    <i class="fa-solid fa-heart"></i>
                </div>
                <img src="../img/dalle.jpg" alt="">
                <div class="doc-details">
                    <h2>Dalle</h2>

                    <a href="https://www.linkedin.com/in/alhwyji" target="_blank">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                    <a href="https://www.instagram.com/justmine174" target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
            </div>

            <div class="doc-poster">
                <div class="doc-icons">
                    <i class="fa-solid fa-share"></i>
                    <i class="fa-solid fa-eye"></i>
                    <i class="fa-solid fa-heart"></i>
                </div>
                <img src="../img/najwa.jpg" alt="">
                <div class="doc-details">
                    <h2>Najwa</h2>

                    <a href="https://www.linkedin.com/in/alhwyji" target="_blank">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                    <a href="https://www.instagram.com/njwa.sb" target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="doc-poster">
                <div class="doc-icons">
                    <i class="fa-solid fa-share"></i>
                    <i class="fa-solid fa-eye"></i>
                    <i class="fa-solid fa-heart"></i>

                </div>
                <img src="../img/team.jpg" alt="">

                <div class="doc-details">
                    <h2>Full Team</h2>

                    <i class="fa-brands fa-linkedin"></i>
                    <i class="fa-brands fa-instagram"></i>
                </div>

            </div>
            <div class="doc-poster">
                <div class="doc-icons">
                    <i class="fa-solid fa-share"></i>
                    <i class="fa-solid fa-eye"></i>
                    <i class="fa-solid fa-heart"></i>
                </div>
                <img src="../img/fatin.jpg" alt="">
                <div class="doc-details">
                    <h2>Fatin</h2>

                    <a href="https://www.linkedin.com/in/alhwyji" target="_blank">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                    <a href="https://www.instagram.com/fatin_tin2003" target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
            </div>


        </div>

    </div>

    <!-- our doctors ended -->

    <!-- our services -->

    <div class="our-service" id="service">
        <div class="service-heading">
            <h2>Our Services</h2>
        </div>

        <div class="main-services">
            <div class="inner-services">
                <div class="service-icon">
                    <i class="fa-solid fa-book"></i>
                </div>
                <h3>Daily Mood Journal</h3>
                <p>Allows users to write daily journal entries and track mood over time through sentiment analysis and
                    management features on the dashboard.</p>
            </div>

            <div class="inner-services">
                <div class="service-icon">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <h3>AI Facial Mood Detection</h3>
                <p>Utilizes AI to detect facial expressions and determine mood. Data is displayed in comprehensive
                    charts for easy visualization on the dashboard.</p>
            </div>

            <div class="inner-services">
    <div class="service-icon">
        <i class="fa-solid fa-comments"></i>
    </div>
    <h3>AI Chat Bot</h3>
    <p>This AI-powered bot offers emotional support, mental health resources, guidance, and language translation to assist individuals struggling with mental health issues efficiently.</p>
</div>

            <div class="inner-services">
                <div class="service-icon">
                    <i class="fa-solid fa-poll"></i>
                </div>
                <h3>Mental Health Quiz</h3>
                <p>Conducts quizzes to identify mental health conditions such as depression and anxiety. Results are
                    tracked and visualized in various chart formats on the user’s dashboard.</p>
            </div>

            <div class="inner-services">
    <div class="service-icon">
        <i class="fa-solid fa-chart-line"></i>
    </div>
    <h3>Daily Mood Tracker</h3>
    <p>Log daily mood entries and track emotional trends over time with interactive charts and tables, easily monitoring mood progress and identifying patterns.</p>
</div>




            <div class="inner-services">
                <div class="service-icon">
                    <i class="fa-solid fa-chart-area"></i>
                </div>
                <h3>Mood Trends and Analysis</h3>
                <p>Offers detailed analysis and visualization of mood trends, helping users understand emotional
                    patterns and make informed decisions for improvement.</p>
            </div>


        </div>
    </div>

    <!-- our services ended -->

    <!-- customer review -->

    <div class="main-review">
        <section>
            <div class="review-heading" id="feedback">
                <h1>Our Users Review</h1>
            </div>

            <div class="main-inner-review">

                <div class="review-inner-content">

                    <div class="review-box">
                        <img src="../img/mrBeni1.png" alt="">

                        <h2>Pak Beni</h2>
                        <div class="review-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <div class="review-text">
                            <p>Great experience! The options provided were just what I needed. The product is reliable, and the customer support is excellent. Highly recommend! </p>
                        </div>

                    </div>

                    <div class="review-box">
                        <img src="../img/simfoni.png" alt="">

                        <h2>Simfoni Sekar</h2>
                        <div class="review-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>

                        <div class="review-text">
                            <p>Fantastic service! Everything was handled efficiently and professionally. The quality exceeded my expectations, and I am extremely satisfied. Will definitely use again!</p>
                        </div>

                    </div>

                    <div class="review-box">
                        <img src="../img/Jundi.png" alt="">

                        <h2>Jundullah</h2>
                        <div class="review-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>

                        <div class="review-text">
                            <p>Absolutely delighted! The process was smooth, and the results were outstanding. The team went above and beyond to ensure my satisfaction.</p>
                        </div>

                    </div>

                </div>

            </div>
        </section>
    </div>

    <!-- customer review -->
    <div class="main-footer">
        <div class="footer-inner">
            <div class="footer-content">
                <h2>Quick Links</h2>
                <div class="link">
                    <a href="#home">Home</a>
                    <a href="#main-about">About Us</a>
                    <a href="#team">Team</a>
                    <a href="#service">Services</a>
                    <a href="#feedback">Review</a>
                </div>
            </div>

            <div class="footer-content">
                <h2>Resources</h2>
                <div class="link">
                    <a href="#blog">Blog</a>
                    <a href="#faq">FAQs</a>
                    <a href="#support">Support</a>
                    <a href="#privacy">Privacy Policy</a>
                    <a href="#terms">Terms of Service</a>
                </div>
            </div>

            <div class="footer-content">
                <h2>Contact Us</h2>
                <div class="link">
                    <a href="#contact">Contact Form</a>
                    <a href="mailto:info@dearday.com">Email Us</a>
                    <a href="#location">Our Location</a>
                    <a href="#support">Support</a>
                    <a href="#feedback">Feedback</a>
                </div>
            </div>

            <div class="footer-content">
                <h2>Follow Us</h2>
                <div class="link">
                    <a href="https://www.linkedin.com" target="_blank">LinkedIn</a>
                    <a href="https://www.instagram.com" target="_blank">Instagram</a>
                    <a href="https://www.twitter.com" target="_blank">Twitter</a>
                    <a href="https://www.facebook.com" target="_blank">Facebook</a>
                    <a href="https://www.youtube.com" target="_blank">YouTube</a>
                </div>
            </div>
        </div>
    </div>



    

    <!-- footer -->

  


    <!-- footer ended -->

    <script src="../js/interface.js"></script>

    <script src="../pop/pop.js"></script>






</body>

</html>