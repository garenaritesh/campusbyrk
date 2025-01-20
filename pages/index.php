<?php


session_start();

include('../admin/db.php');

if (!$_SESSION['logins']) {
    header("location:../users/login.php");
}

$user = $_SESSION['logins'];

// Notification Data Read
$sql = "SELECT * FROM notification WHERE user = '$user' ORDER BY date DESC";
$res = mysqli_query($db, $sql);

// Count unread notifications
$sql_unread = "SELECT COUNT(*) as unread_count FROM notification WHERE user = '$user' AND is_read = 0";
$unread_count_result = mysqli_query($db, $sql_unread);
$unread_count = mysqli_fetch_assoc($unread_count_result)['unread_count'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PassMate </title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- <link rel="stylesheet" href="../pages/form.css"> -->
    <!-- <link rel="stylesheet" href="../pages/style.css"> -->
    <link rel="stylesheet" href="index.css">
    <!-- <link rel="stylesheet" href="../users/style.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <nav>
        <div class="logo">
            <a href="../pages/index.php"> P<span>Mate</span> </a>
        </div>
        <ul class="navlist">
            <li id="forms"><a href="#">Forms</a></li>
            <li><a href="../pages/about.php">About</a></li>
            <li><a href="../pages/contact.php">ContactUs</a></li>
        </ul>
        <ul class="user_list">
            <a href="../users/notification.php"><i class='bx bx-bell'></i>
                <span id="count_notifi"
                    class="count <?php echo $unread_count > 0 ? 'show' : ''; ?>"><?php echo $unread_count; ?></span>
            </a>
            <li id="user_icon"><a href="../pages/user_account.php"><i class='bx bx-user'></i></a></li>
        </ul>
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


    <!-- Shopping Sections -->
    <section class="shop">
        <div class="head_tit">
            <h3>Build To Be Different</h3>
            <p>Get Favorite Sport Gear for College Sports Week</p>
        </div>
        <div class="shop_grid_sports">
            <div class="shop_grid_box_sports">
                <img src="../admin/assets/running.jpg" alt="">
                <p class="banner_tit">Running</p>
            </div>
            <div class="shop_grid_box_sports">
                <img src="../admin/assets/cricket.jpg" alt="">
                <p class="banner_tit">Cricket</p>
            </div>
            <div class="shop_grid_box_sports">
                <img src="../admin/assets/badminton.jpg" alt="">
                <p class="banner_tit">Bad Minton</p>
            </div>
            <div class="shop_grid_box_sports">
                <img src="../admin/assets/vollyball.jpg" alt="">
                <p class="banner_tit">VollyBall</p>
            </div>
            <div class="shop_grid_box_sports">
                <img src="../admin/assets/table_tennis.jpg" alt="">
                <p class="banner_tit">Table Tennis</p>
            </div>
        </div>
    </section>


    <!-- FOQ -->
    <div class="wrapper">
        <h1>Frequently Asked Questions</h1>

        <div class="faq">
            <button class="accordion">
                What is Krushi?
                <i class='bx bx-chevron-down'></i>
            </button>
            <div class="pannel">
                <p>
                    Krushi is a Public Charitable Trust designed to carry out farming on
                    extensive scale Natural & Sustainable methods.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                How does it work?
                <i class='bx bx-chevron-down'></i>
            </button>
            <div class="pannel">
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                    saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                    ullam, iure eligendi harum eaque hic corporis debitis porro
                    consectetur voluptate rem officiis architecto.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                What are the major challanges of current agriculture?
                <i class='bx bx-chevron-down'></i>
            </button>
            <div class="pannel">
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                    saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                    ullam, iure eligendi harum eaque hic corporis debitis porro
                    consectetur voluptate rem officiis architecto.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                How does the Krushi address the above challanges?
                <i class='bx bx-chevron-down'></i>
            </button>
            <div class="pannel">
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                    saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                    ullam, iure eligendi harum eaque hic corporis debitis porro
                    consectetur voluptate rem officiis architecto.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                How can I be a part of Krushi?
                <i class='bx bx-chevron-down'></i>
            </button>
            <div class="pannel">
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                    saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                    ullam, iure eligendi harum eaque hic corporis debitis porro
                    consectetur voluptate rem officiis architecto.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                How does it work?
                <i class='bx bx-chevron-down'></i>
            </button>
            <div class="pannel">
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                    saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                    ullam, iure eligendi harum eaque hic corporis debitis porro
                    consectetur voluptate rem officiis architecto.
                </p>
            </div>
        </div>
    </div>






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