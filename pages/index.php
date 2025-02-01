<?php

include('../admin/db.php');

session_start();

// if (!$_SESSION['logins']) {
//     header("location:../users/login.php");
// }

@$user = $_SESSION['logins'];
$sql = "select * from users where email = '$user'";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_array($query);

// Collection Come From Offers Table
$getoffer = "select * from offers";
$getres = mysqli_query($db, $getoffer);
$offer = mysqli_fetch_assoc($getres);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PassMate </title>
    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <link rel="stylesheet" href="../css/index_media.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_media.css">
    <!-- <link rel="stylesheet" href="../pages/form.css"> -->
    <!-- <link rel="stylesheet" href="../pages/style.css"> -->
    <link rel="stylesheet" href="index.css">
    <!-- <link rel="stylesheet" href="../users/style.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <nav>
        <div class="logo">
            <a href="../pages/index.php"><span>C</span>ampus<span>C</span>orner</a>
        </div>
        <div class="menu">
            <a href="#"><i class='bx bx-menu-alt-right'></i></a>
        </div>
        <ul class="navlist">
            <li id="forms"><a href="#">Forms</a></li>
            <li><a href="../pages/about.php">About</a></li>
            <li><a href="../pages/contact.php">ContactUs</a></li>
        </ul>
        <?php
        if (isset($_SESSION['logins'])) {

            $user = $_SESSION['logins'];

            // Notification Data Read
            $sql = "SELECT * FROM notification WHERE user = '$user' ORDER BY date DESC";
            $res = mysqli_query($db, $sql);

            // Count unread notifications
            $sql_unread = "SELECT COUNT(*) as unread_count FROM notification WHERE user = '$user' AND is_read = 0";
            $unread_count_result = mysqli_query($db, $sql_unread);
            $unread_count = mysqli_fetch_assoc($unread_count_result)['unread_count'];
            ?>
            <ul class="user_list">
                <a href="../users/notification.php"><i class='bx bx-bell'></i>
                    <span id="count_notifi"
                        class="count <?php echo $unread_count > 0 ? 'show' : ''; ?>"><?php echo $unread_count; ?></span>
                </a>
                <li id="user_icon"><a href="../pages/user_account.php"><i class='bx bx-user'></i></a></li>
            </ul>
        <?php } else {
            ?>
            <a href="../users/login.php" id="sign_btn">SIGN IN</a>
        <?php } ?>

    </nav>

    <!-- Extra Nav To Select To User Where they are going.. -->
    <div id="extra_nav" class="extra_nav">
        <a href="../pages/trainform.php"><i class='bx bx-train'></i> Train Application </a>
        <a href="../pages/busform.php"><i class='bx bxs-bus'></i> Bus Application </a>
    </div>

    <!-- Intro Section -->
    <section class="intro">

        <div class="right">
            <div class="slogan">
                <p>Simplify Your Journey</p>
                <p>Get Your Bonafide Certificate in Minutes!</p>
                <!-- <button class="see"><span>Ultimate</span> Application</button> -->
            </div>
        </div>
        <div class="left">
            <div class="image">
                <img src="../admin/assets/land_image.webp" alt="">
            </div>
        </div>

    </section>

    <!-- From TO Get Form Container-->
    <div class="start_form">
        <div class="start_nav">
            <div class="train_li">
                <h3><i class='bx bxs-train'></i> Train Pass</h3>
            </div>
            <div class="bus_li" id="bus_li">
                <h3><i class='bx bxs-bus'></i> Bus Pass</h3>
            </div>
        </div>
        <!-- Train application -->
        <div class="train_app">
            <form action="trainform.php" method="post">
                <div class="form_app">
                    <input type="text" name="departure" required>
                    <div class="labelline">From</div>
                </div>
                <div class="form_app" id="trans">
                    <i class='bx bx-transfer-alt'></i>
                </div>
                <div class="form_app">
                    <input type="text" name="destination" required>
                    <div class="labelline">To</div>
                </div>

                <div class="form_app">
                    <select id="months" name="months" required>
                        <option value="">Select duration</option>
                        <!-- <option value="1">1 Month</option> -->
                        <option value="3">3 Months</option>
                        <option value="6">6 Months</option>
                        <option value="12">12 Months</option>
                    </select>
                </div>
                <button id="apply_btn">Apply</button>
            </form>
        </div>

        <!-- Bus application -->

        <div class="train_app" id="bus_app">
            <form action="busform.php" method="post">
                <div class="form_app">
                    <input type="text" name="departure" required>
                    <div class="labelline">From</div>
                </div>
                <div class="form_app" id="trans">
                    <i class='bx bx-transfer-alt'></i>
                </div>
                <div class="form_app">
                    <input type="text" name="destination" required>
                    <div class="labelline">To</div>
                </div>

                <div class="form_app">
                    <select id="months" name="months" required>
                        <option value="">Select duration</option>
                        <!-- <option value="1">1 Month</option> -->
                        <option value="3">3 Months</option>
                        <option value="6">6 Months</option>
                        <option value="12">12 Months</option>
                    </select>
                </div>
                <button id="apply_btn">Apply</button>
            </form>
        </div>
    </div>


    <!-- Offers Section -->
    <section class="offers" id="offers">
        <div class="head_tit">
            <h3>Pick Student Combo Offers – Ultimate Academic Essentials Kits </h3>
            <p>Get started with combo offers with comfindence and save your pocket money.</p>
        </div>
        <!-- offfers Cards -->
        <div class="offers_container">
            <!-- Basics Plan -->
            <div class="offers_card">
                <div class="offers_header">
                    <h3>Basic</h3>
                    <p>A great to solution for beginners</p>
                </div>
                <div class="offers_price">
                    <p class="real_price"><i class='bx bx-rupee'></i>399</p>
                    <h2><i class='bx bx-rupee'></i> 199 </h2>
                    <div class="price_btn">
                        <a href="offerlanding.php?offer=1"><button>Get Now</button></a>
                    </div>
                    <p class="instru">Perfect for students who need just the basics!</p>
                    <!-- Dicount Stamp -->
                    <div class="offers_stamp">
                        <p>50% Off</p>
                    </div>
                    <svg width="21" height="39" viewBox="0 0 21 39" fill="none" xmlns="http://www.w3.org/2000/svg"
                        data-v-93502b43="">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M18.0808 0C16.5161 0 15.0277 0.67567 13.9977 1.8535L1.34101 16.3268C-0.480869 18.4102 -0.442043 21.5311 1.4311 23.5685L14.0068 37.247C15.034 38.3642 16.4822 39 17.9998 39H20.2725V0L18.0808 0ZM11.361 23.4843C13.5614 23.2888 15.1868 21.3465 14.9912 19.146C14.7957 16.9455 12.8534 15.3202 10.6529 15.5157C8.45245 15.7113 6.82711 17.6536 7.02263 19.8541C7.21815 22.0545 9.16049 23.6799 11.361 23.4843Z"
                            fill="#e2dbfc" data-v-93502b43=""></path>
                    </svg>
                </div>
                <div class="offers_desc">
                    <p><i class='bx bx-check'></i> Cardboard + Plastic ( Spring File ) 5x </p>
                    <p><i class='bx bx-check'></i> File Pages Bundle 2x </p>
                    <p class="not_avl"><i class='bx bx-minus'></i> Semester All Books </p>
                    <p class="not_avl"><i class='bx bx-minus'></i> Notebooks 1x </p>
                    <p class="not_avl"><i class='bx bx-minus'></i> Pen Box 1x </p>
                    <p class="not_avl"><i class='bx bx-minus'></i> Geomatry Box 1x </p>
                    <p class="not_avl"><i class='bx bx-minus'></i> Free Fetures </p>
                </div>
            </div>

            <!-- Basics Plan -->
            <div class="offers_card">
                <div class="offers_header">
                    <h3>Plus</h3>
                    <p>Everything you need to complete your bags.</p>
                </div>
                <div class="offers_price">
                    <p class="real_price"><i class='bx bx-rupee'></i>899</p>
                    <h2><i class='bx bx-rupee'></i> 599 </h2>
                    <div class="price_btn">
                        <a href="offerlanding.php?offer=2"><button>Get Now</button></a>
                    </div>
                    <p class="instru">For students who need a little extra for regular studies!</p>
                    <!-- Dicount Stamp -->
                    <div class="offers_stamp">
                        <p>35% Off</p>
                    </div>
                    <svg width="21" height="39" viewBox="0 0 21 39" fill="none" xmlns="http://www.w3.org/2000/svg"
                        data-v-93502b43="">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M18.0808 0C16.5161 0 15.0277 0.67567 13.9977 1.8535L1.34101 16.3268C-0.480869 18.4102 -0.442043 21.5311 1.4311 23.5685L14.0068 37.247C15.034 38.3642 16.4822 39 17.9998 39H20.2725V0L18.0808 0ZM11.361 23.4843C13.5614 23.2888 15.1868 21.3465 14.9912 19.146C14.7957 16.9455 12.8534 15.3202 10.6529 15.5157C8.45245 15.7113 6.82711 17.6536 7.02263 19.8541C7.21815 22.0545 9.16049 23.6799 11.361 23.4843Z"
                            fill="#e2dbfc" data-v-93502b43=""></path>
                    </svg>
                </div>
                <div class="offers_desc">
                    <p><i class='bx bx-check'></i> Cardboard + Plastic ( Spring File ) 5x </p>
                    <p><i class='bx bx-check'></i> File Pages Bundle 5x </p>
                    <p class="not_avl"><i class='bx bx-minus'></i> Semester All Books </p>
                    <p><i class='bx bx-check'></i> Notebooks 3x </p>
                    <p><i class='bx bx-check'></i> Pen Box 1x + Highlighter</p>
                    <p><i class='bx bx-check'></i> Geomatry Box 1x </p>
                    <p><i class='bx bx-check'></i> Free Fetures </p>
                </div>
            </div>
            <!-- Basics Plan -->
            <div class="offers_card">
                <div class="offers_header">
                    <h3>Premium</h3>
                    <p>Level up with more power and extra items.</p>
                </div>
                <div class="offers_price">
                    <p class="real_price"><i class='bx bx-rupee'></i>1599</p>
                    <h2><i class='bx bx-rupee'></i> 999 </h2>
                    <div class="price_btn">
                        <a href="offerlanding.php?offer=3"><button>Get Now</button></a>
                    </div>
                    <p class="instru">The ultimate kit for students who want everything !</p>
                    <!-- Dicount Stamp -->
                    <div class="offers_stamp">
                        <p>40% Off</p>
                    </div>
                    <svg width="21" height="39" viewBox="0 0 21 39" fill="none" xmlns="http://www.w3.org/2000/svg"
                        data-v-93502b43="">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M18.0808 0C16.5161 0 15.0277 0.67567 13.9977 1.8535L1.34101 16.3268C-0.480869 18.4102 -0.442043 21.5311 1.4311 23.5685L14.0068 37.247C15.034 38.3642 16.4822 39 17.9998 39H20.2725V0L18.0808 0ZM11.361 23.4843C13.5614 23.2888 15.1868 21.3465 14.9912 19.146C14.7957 16.9455 12.8534 15.3202 10.6529 15.5157C8.45245 15.7113 6.82711 17.6536 7.02263 19.8541C7.21815 22.0545 9.16049 23.6799 11.361 23.4843Z"
                            fill="#e2dbfc" data-v-93502b43=""></path>
                    </svg>
                </div>
                <div class="offers_desc">
                    <p><i class='bx bx-check'></i> Cardboard + Plastic ( Spring File ) 5x </p>
                    <p><i class='bx bx-check'></i> (Premium) File Pages Bundle 5x </p>
                    <p><i class='bx bx-check'></i> Semester All Books </p>
                    <p><i class='bx bx-check'></i> Notebooks 5x</p>
                    <p><i class='bx bx-check'></i> Pen Box 1x + Highlighter 2x + Per. Marker</p>
                    <p><i class='bx bx-check'></i> Geomatry Box/Scientific Calculator 1x </p>
                    <p><i class='bx bx-check'></i> Free Fetures </p>
                </div>
            </div>
        </div>

        <button id="pay_term">Payment Terms</button>

    </section>


    <!-- Payment Terms Instructions -->
    <div class="payment_terms_instruction" id="pay_instrunction">
        <p>The price displayed is the rate excluding applicable taxes. The total price for the plan to be paid
            upfront at checkout , along with any applicable taxes.</p>
    </div>


    <!-- Shopping Sections -->
    <section class="shop" id="cl">
        <div class="head_tit">
            <h3>College LifeStyle</h3>
        </div>
        <div class="shop_grid">
            <div class="shop_grid_box">
                <img src="../admin/assets/academic.jpg" alt="">
                <p class="banner_tit">Academic Essentials</p>
            </div>
            <div class="shop_grid_box">
                <img src="../admin/assets/fashions.jpg" alt="">
                <p class="banner_tit">Fashion and Accessories</p>
            </div>
            <div class="shop_grid_box">
                <img src="../admin/assets/electronics.jpg" alt="">
                <p class="banner_tit">Electronics</p>
            </div>
        </div>
    </section>





    <section class="shop" id="shop_sports">
        <div class="head_tit">
            <h3>Build To Be Different</h3>
            <p>Get Favorite Sports Gear</p>
        </div>
        <div class="swiper shop_grid_sports">
            <div class="swiper-wrapper">
                <div class="swiper-slide shop_grid_box_sports">
                    <img src="../admin/assets/running.jpg" alt="Sports Product 1">
                    <p>Running</p>
                </div>
                <div class="swiper-slide shop_grid_box_sports">
                    <img src="../admin/assets/cricket.jpg" alt="Sports Product 2">
                    <p>Cricket</p>
                </div>
                <div class="swiper-slide shop_grid_box_sports">
                    <img src="../admin/assets/vollyball.jpg" alt="Sports Product 3">
                    <p>Vollyball</p>
                </div>
                <div class="swiper-slide shop_grid_box_sports">
                    <img src="../admin/assets/table_tennis.jpg" alt="Sports Product 3">
                    <p>Table Tennis</p>
                </div>
                <div class="swiper-slide shop_grid_box_sports">
                    <img src="../admin/assets/badminton.jpg" alt="Sports Product 3">
                    <p>Bad Minton</p>
                </div>
            </div>

        </div>
    </section>

    <!-- Testomonials -->
    <section class="testimonials">
        <div class="head_tit">
            <h3>Testimonials</h3>
            <p>Hear from our learners as they share their journeys of transformation, success, and how our</p>
            <p>platform has made a difference in their lives.</p>
        </div>

        <!-- Slider -->
        <div class="testimonial_slider">
            <!-- Main Testomonials Cards -->
            <div class="test_card">
                <div class="top">
                    <!-- <img src="../admin/assets/user_img.jpg" alt=""> -->
                    <div class="user_dtl">
                        <p class="name">Sahani Piyush</p>
                        <p>Since 2023</p>
                    </div>
                </div>
                <div class="bottom">
                    <div class="rate">
                        <i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i
                            class='bx bxs-star'></i><i class='bx bxs-star-half'></i>
                    </div>
                    <p class="content">I've been using Imagify for nearly two years, primarily for Instagram, and it has
                        been incredibly user-friendly, making my work much easier.</p>
                    <p class="content">From Goverment Polytechnic , Valsad</p>
                    <a href="#">read more</a>
                </div>
            </div>


            <div class="test_card">
                <div class="top">
                    <!-- <img src="../admin/assets/user_img.jpg" alt=""> -->
                    <div class="user_dtl">
                        <p class="name">Hidden Atak</p>
                        <p>Since 0001</p>
                    </div>
                </div>
                <div class="bottom">
                    <div class="rate">
                        <i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i
                            class='bx bxs-star'></i><i class='bx bxs-star-half'></i>
                    </div>
                    <p class="content">I've been using Imagify for nearly two years, primarily for Instagram, and it has
                        been incredibly user-friendly, making my work much easier.</p>
                    <p class="content">From Goverment Polytechnic , Valsad</p>
                    <a href="#">read more</a>
                </div>
            </div>

            <div class="test_card">
                <div class="top">
                    <!-- <img src="../admin/assets/user_img.jpg" alt=""> -->
                    <div class="user_dtl">
                        <p class="name">Kana Kopara</p>
                        <p>Since 2001</p>
                    </div>
                </div>
                <div class="bottom">
                    <div class="rate">
                        <i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i
                            class='bx bxs-star'></i><i class='bx bxs-star-half'></i>
                    </div>
                    <p class="content">I've been using Imagify for nearly two years, primarily for Instagram, and it has
                        been incredibly user-friendly, making my work much easier.</p>
                    <p class="content">From Goverment Polytechnic , Valsad</p>
                    <a href="#">read more</a>
                </div>
            </div>

        </div>

    </section>



    <!-- Mission Container Section -->
    <section class="mission">
        <div class="paragraph-container">
            <div class="paragraph active" style="background: transparent;">"Your Journey Starts Here – Hassle-Free
                Bonafide Solutions!"</div>
            <div class="paragraph">"Less Paperwork, More Travel – Get Certified Instantly!"</div>
            <div class="paragraph">"One Click Away from Simplifying Your Commute!"</div>
            <div class="paragraph">College Life Made Easier – Your Bonafide Certificate Awaits!</div>
            <div class="paragraph">"Where Convenience Meets Your Travel Needs – Apply Now!"</div>
            <div class="paragraph">"From Campus to Commute – Get Your Bonafide in No Time!"</div>
            <div class="paragraph">"Your Ticket to Smooth Travel Begins with Us!"</div>
            <div class="paragraph">"Say Goodbye to Stress, and Hello to Easy Travel Pass Applications!"</div>
            <div class="paragraph">"Travel Smarter, Not Harder – Bonafide Certificates Made Simple!"</div>
            <div class="paragraph">"Empowering Students, One Certificate at a Time!"</div>
        </div>
        <div class="mission-container">
            <img src="../admin/assets/mission_img.webp" alt="">
        </div>
    </section>

    <!-- Get Started Section -->
    <?php
    if (isset($_SESSION['logins'])) {
        ?>
        <section class="get_started">
            <h1>Hey <?php if ($data['name'] == '') {
                echo "Student";
            } else { ?>         <?php echo $data['name']; ?>     <?php }
            ; ?> ,
                Welcome to our Campus</h1>
            <p>Let's start with quick explore our offers for you to make college life easy and Enjoyble.</p>
            <div class="action_btns">
                <a href="#"><button>Explore Offers</button></a>
                <a href="#"><button>Learn More <i class='bx bx-right-arrow-alt'></i></button></a>
            </div>
        </section>
    <?php } else { ?>
        <section class="get_started">
            <h1>"From Campus to Commute – Get Your Bonafide in No Time!"</h1>
            <p>"Seamlessly transition from campus to commute with a hassle-free, fast, and reliable bonafide certificate
                process, getting you what you need in no time!"</p>
            <div class="action_btns">
                <a href="../users/signup.php"><button>Get Started</button></a>
                <a href="#"><button>Learn More <i class='bx bx-right-arrow-alt'></i></button></a>
            </div>
        </section>
    <?php } ?>



    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <!-- Swiper For Curosel Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new Swiper(".shop_grid_sports", {
                slidesPerView: 3, // Show 3 slides at a time
                spaceBetween: 20, // Gap between slides
                loop: true, // Infinite scrolling

                autoplay: {
                    delay: 3000, // Auto slide every 3 sec
                    disableOnInteraction: false,
                },
                breakpoints: {
                    1024: { slidesPerView: 3 }, // Large screens: 3 items
                    768: { slidesPerView: 2 },  // Tablets: 2 items
                    480: { slidesPerView: 1 },  // Mobile: 1 item
                }
            });
        });


    </script>

    <!-- Payment Terms Script -->
    <script>
        const PayTermCallBTN = document.getElementById("pay_term");
        const PayTerms = document.getElementById("pay_instrunction");

        PayTermCallBTN.addEventListener("click", () => {
            PayTerms.style.display = "block";
            setTimeout(() => {
                PayTerms.style.display = "none";
            }, 5000);

        })


    </script>

    <!-- Automatically Change Texts -->
    <script>
        // Array of text to cycle through
        const texts = [
            "TrainPass - Bonfide Certificate!",
            "BussPass - Bonfide Certificate!",
            "Simplify your Certificate!",
            "Happy Journey!"
        ];

        let index = 0; // Start at the first text
        const textElement = document.getElementById("text");

        // Function to display text letter by letter
        function typeText(text, callback) {
            let i = 0;
            textElement.textContent = ""; // Clear previous text
            const interval = setInterval(() => {
                textElement.textContent += text[i];
                i++;
                if (i === text.length) {
                    clearInterval(interval);
                    setTimeout(() => callback(), 1000); // Pause before removing text
                }
            }, 100); // Type each letter every 100ms
        }

        // Function to remove text letter by letter
        function deleteText(callback) {
            let text = textElement.textContent;
            const interval = setInterval(() => {
                text = text.slice(0, -1); // Remove one letter at a time
                textElement.textContent = text;
                if (text.length === 0) {
                    clearInterval(interval);
                    callback();
                }
            }, 100); // Remove each letter every 100ms
        }

        // Function to cycle through the texts
        function cycleTexts() {
            typeText(texts[index], () => {
                deleteText(() => {
                    index = (index + 1) % texts.length; // Go to the next text
                    cycleTexts(); // Repeat the process
                });
            });
        }

        // Start the cycle
        cycleTexts();
    </script>

    <!-- Train APP and Bus App -->
    <script>



        const TrainLi = document.querySelector(".train_li"),
            BusLi = document.querySelector(".bus_li"),
            TrainApp = document.querySelector(".train_app"),
            BusApp = document.getElementById("bus_app");

        BusLi.addEventListener("click", () => {

            BusLi.classList.add("active_bar");
            TrainLi.classList.remove("active_bar");
            BusApp.style.display = "flex";
            TrainApp.style.display = "none";

        })

        TrainLi.addEventListener("click", () => {

            BusLi.classList.remove("active_bar");
            TrainLi.classList.add("active_bar");
            BusApp.style.display = "none";
            TrainApp.style.display = "flex";

        })


    </script>

    <script>

        const paragraphs = document.querySelectorAll('.paragraph');
        let currentIndex = 0;

        function showNextParagraph() {
            paragraphs[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % paragraphs.length;
            paragraphs[currentIndex].classList.add('active');
        }

        // Change paragraph every 3 seconds
        setInterval(showNextParagraph, 3000);

    </script>


    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
                this.classList.toggle("active");
                this.parentElement.classList.toggle("active");

                var pannel = this.nextElementSibling;

                if (pannel.style.display === "block") {
                    pannel.style.display = "none";
                } else {
                    pannel.style.display = "block";
                }
            });
        }
    </script>




    <?php

    include("../hf/footer.php");

    ?>