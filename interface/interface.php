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
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="../css/style_inter.css?v=<?php echo time(); ?>">
</head>
<body> 
    <header>
        
        <div class="logo"><img src="../img/colored.png" alt=""></div>

        <nav class="navbar">
            <a href="#Home">Home</a>
            <a href="#Home">About</a>
            <a href="#Home">Service</a>
            <a href="#Home">Gallery</a>
            <a href="#Home">Blog</a>
            <a href="../dashboard/index.php">Dashboard</a>
        </nav>

        <div class="right-icons">
            <div id="menu-bars" class="fas fa-bars"></div>
            <a href="../logout.php" class="btn" id="welcome-btn">Welcome, <span><?=$_SESSION['name'];?></span></a>
            
        </div>
        
    </header>

    <!-- header section ended -->
    
    <!-- Home section started -->
        <div class="main-home">

            <div class="home">
                <div class="home-left-content">
                    <span>welcome to DearDay</span>
                    <h2>We take care our<br> Patients Healths</h2>
                    <p class="lorem">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Possimus numquam veniam porro eius, fugiat vero ut ipsum libero</p>
                
                        <div class="home-btn">
    <a href="">Read More</a>
    <a <?php if ($mood && $mood['mood'] != null): ?>style="display: none;"<?php endif; ?> class="homebtnsec" id="myBtn" href="#">How Was Your Mood Today?</a>
    <?php if ($mood && $mood['mood'] != null): ?>
        <button  id="moodBtn">Your mood today: <?php echo htmlspecialchars($mood['mood']); ?></button>
    <?php else: ?>
        <button style="display: none;" id="moodBtn">Set Your Mood</button>
    <?php endif; ?>
</div>


                        
                    <!-- Modal content -->
                        <div id="myModal" class="modal" >
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <div class="modal-inner-content">
                                    <img src="../img/HeartMan.png" alt="Image Description" class="modal-image">
                                    <div class="modal-text">
                                        
                                        <h2>Hey There,</h2>
                                        <h2>How was your day?</h2>
                                        <form action="mood.php" method="post">
                                        <div class="emoji-container">
                                            <div class="emoji">
                                                <button type="submit" name="mood" value="Very Good" ><img src="../img/VeryGood.png" alt="Very Good"></button>
                                                <p>Very Good</p>
                                            </div>
                                            <div class="emoji">
                                                <button type="submit" name="mood" value="Good"><img src="../img/SlightGood.png" alt="Slightly Good"></button>
                                                <p>Good</p>
                                            </div>
                                            <div class="emoji">
                                                <button type="submit" name="mood" value="Pretty Normal"><img src="../img/Normal.png" alt="Pretty Normal"></button>
                                                <p>Pretty Normal</p>
                                            </div>
                                            <div class="emoji">
                                                <button type="submit" name="mood" value="Bad"><img src="../img/SlightSad.png" alt="Slightly Bad"></button>
                                                <p>Bad</p>
                                            </div>
                                            <div class="emoji">
                                                <button type="submit" name="mood" value="Very Bad"><img src="../img/verysad.png" alt="Very Bad"></button>
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
                    <img src="../img/welcome.png" alt="">
                </div>
            </div>
        </div>


        <div class="technology">
            <div class="main-technology">
                
                <div class="inner-technology" id="tech1">
                    <span></span>
                    <i class="fi fi-rr-journal"></i>
                    <h2>Explore Your Inner Self</h2>
                    <p>Express your fears, thoughts, and feelings to know yourself better. Use writing as personal relaxation to destress and unwind</p>
                </div>

                <div class="inner-technology" id="tech2">
                    <span></span>
                    <i class="fi fi-rr-camera"></i>
                    <h2>Real-Time Mood Tracker</h2>
                    <p>Monitor your mood in real time with our camera-based feature. Get instant emotional feedback and improve your well-being effortlessly.</p>
                </div>

                <div class="inner-technology" id="tech3">
                    <span></span>
                    <i class="fi fi-tr-quiz"></i>
                    <h2>Mental Health Quiz</h2>
                    <p>Take this quiz to understand your mental well-being and improve your happiness. Start now for insights into your mental health.</p>
                </div>
            </div>
        </div>

    <!-- home section ends -->

    <!-- About us section started -->

        <div class="main-about">

            <div class="about-heading">About Us</div>

            <div class="inner-main-about">
                <div class="about-inner-content-left">
                    <img src="../img/about5.png" alt="">
                </div>

                <div class="about-inner-content">
                    <div class="about-right-content">
                    <h2>Leading the Way in Mental Health <br>Research and Care</h2>
<p>At DearDay, we believe that taking care of your mental health is just as vital as caring for your physical health.</p>
<p class="aboutsec-content">
    We are dedicated to providing a comprehensive platform that empowers individuals to prioritize their mental well-being, access valuable resources, and find the support they need to lead healthier, happier lives.
</p>

                            <button class="aboutbtn">Read More</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- About us section ends -->

    <!-- our doctors -->

        <div class="main-doctors">
            <div class="doctors-heading">
                <h2>Our Doctors</h2>
            </div>

            <div class="main-inner-doctor">
                <div class="doc-poster">
                    <div class="doc-icons">
                        <i class="fa-solid fa-share"></i>
                        <i class="fa-solid fa-eye"></i>
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <img src="../img/team1.jpg" alt="">

                    <div class="doc-details">
                        <h2>Mr Joe</h2>
                        
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
                    <img src="../img/team2.jpg" alt="">
                    <div class="doc-details">
                        <h2>Mr Joe</h2>
                        
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
                    <img src="../img/team3.jpg" alt="">
                    <div class="doc-details">
                        <h2>Mr Joe</h2>
                        
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
                    <img src="../img/team4.jpg" alt="">
                    <div class="doc-details">
                        <h2>Mr Joe</h2>
                        
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
                    <img src="../img/team5.jpg" alt="">
                    <div class="doc-details">
                        <h2>Mr Joe</h2>
                        
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
                    <img src="../img/team6.jpg" alt="">

                    <div class="doc-details">
                        <h2>Mr Joe</h2>
                        
                        <i class="fa-brands fa-linkedin"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>
            </div>

        </div>

    <!-- our doctors ended -->

    <!-- our services -->

    <div class="our-service">
        <div class="service-heading">
            <h2>Our Services</h2>
        </div>

        <div class="main-services">
            <div class="inner-services">
                <div class="service-icon">
                    <i class="fa-solid fa-truck-medical"></i>
                </div>
                <h3>Health Check</h3>
                <p>We offer extensive medical procedures to outbound & inbound patients what it is and we are very proud achievement staff.</p>
            </div>

            <div class="inner-services">
                <div class="service-icon">
                    <i class="fa-regular fa-hospital"></i>
                </div>
                <h3>Health Check</h3>
                <p>We offer extensive medical procedures to outbound & inbound patients what it is and we are very proud achievement staff.</p>
            </div>

            <div class="inner-services">
                <div class="service-icon">
                    <i class="fa-regular fa-heart"></i>
                </div>
                <h3>Health Check</h3>
                <p>We offer extensive medical procedures to outbound & inbound patients what it is and we are very proud achievement staff.</p>
            </div>

            <div class="inner-services">
                <div class="service-icon">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
                <h3>Health Check</h3>
                <p>We offer extensive medical procedures to outbound & inbound patients what it is and we are very proud achievement staff.</p>
            </div>

            <div class="inner-services">
                <div class="service-icon">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <h3>Health Check</h3>
                <p>We offer extensive medical procedures to outbound & inbound patients what it is and we are very proud achievement staff.</p>
            </div>

            <div class="inner-services">
                <div class="service-icon">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
                <h3>Health Check</h3>
                <p>We offer extensive medical procedures to outbound & inbound patients what it is and we are very proud achievement staff.</p>
            </div>
        </div>
    </div>

    <!-- our services ended -->

    <!-- customer review -->
   
        <div class="main-review">
            <section>  
            <div class="review-heading">
                <h1>Our Customers Review</h1>
            </div>

            <div class="main-inner-review">

                <div class="review-inner-content">

                    <div class="review-box">
                        <img src="../img/pic1.png" alt="">

                        <h2>Lara John</h2>
                        <div class="review-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
    
                        <div class="review-text">
                            <p>Optio quod assumenda similique provident aliquid corrupti minima maxime tempore! Quas illo porro fuga consectetur repellat </p>
                        </div>

                    </div>

                    <div class="review-box">
                        <img src="../img/pic2.png" alt="">

                        <h2>Lara John</h2>
                        <div class="review-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
    
                        <div class="review-text">
                            <p>Optio quod assumenda similique provident aliquid corrupti minima maxime tempore! Quas illo porro fuga consectetur repellat</p>
                        </div>

                    </div>

                    <div class="review-box">
                        <img src="../img/pic3.png" alt="">

                        <h2>Lara John</h2>
                        <div class="review-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
    
                        <div class="review-text">
                            <p>Optio quod assumenda similique provident aliquid corrupti minima maxime tempore! Quas illo porro fuga consectetur repellat</p>
                        </div>

                    </div>

                </div>

            </div>
        </section>
        </div>
    
    <!-- customer review -->


    <!-- footer -->

    <div class="main-footer">
        <div class="footer-inner">
            <div class="footer-content">
                <h1>Dummy Links</h1>
                <div class="link">
                    <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                </div>
            </div>

            <div class="footer-content">
                <h1>Dummy Links</h1>
                <div class="link">
                    <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                </div>
            </div>

            <div class="footer-content">
                <h1>Dummy Links</h1>
                <div class="link">
                    <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                </div>
            </div>

            <div class="footer-content">
                <h1>Dummy Links</h1>
                <div class="link">
                    <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                </div>
            </div>

            <div class="footer-content">
                <h1>Dummy Links</h1>
                <div class="link">
                    <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                <a href="">Home</a>
                </div>
            </div>
        </div>
    </div>
        
    <!-- footer ended -->

    <script src="../js/interface.js"></script>
   



    
</body>
</html>