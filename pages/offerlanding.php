<?php

include('../admin/db.php');

session_start();

if (!$_SESSION['logins']) {
    header("location:../users/login.php");
}


if (isset($_REQUEST['offer'])) {
    $id = $_REQUEST['offer'];
    $sql = "select * from offers where offer_id = '$id'";
    $a = mysqli_query($db, $sql);
    $vk = mysqli_fetch_array($a);
}

@$user = $_SESSION['logins'];
$sql = "select * from users where email = '$user'";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_array($query);


// COD Orders
if (isset($_REQUEST['cod'])) {
    $amount = $vk['offer_price'];
    $combo_id = $id;
    $user_id = $data['user_id'];
    $street = $_REQUEST['street'];
    $pincode = $_REQUEST['pincode'];
    $city = $_REQUEST['city'];

    // total price
    $quantity = $_REQUEST['quantity'];
    $total_price = $amount * $quantity;


    // Generate a unique order ID
    $order_id = 'ORD-' . date('YmdHis') . '-' . rand(1000, 9999);


    $sql = "INSERT INTO orders (order_id,user_id, combo_id, branch, quantity, amount, status, track_status, pincode, city, street) 
            VALUES ('$order_id','$user_id', '$combo_id', 'not branch', '$quantity', '$total_price', 'cod', 'Packing','$pincode','$city','$street')";
    $db->query($sql);
    header("location:success.php");


}


?>

<!DOCTYPE html>
<html lang="en">

<!-- oncontextmenu="return false" -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PassMate </title>
    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <link rel="stylesheet" href="../css/style.css">
    <!-- <link rel="stylesheet" href="../pages/form.css"> -->
    <!-- <link rel="stylesheet" href="../pages/style.css"> -->
    <link rel="stylesheet" href="index.css">
    <!-- <link rel="stylesheet" href="../users/style.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Payment Gateway -->
    <script async src="https://pay.google.com/gp/p/js/pay.js"></script>

</head>

<body>

    <nav>
        <div class="logo">
            <a href="../pages/index.php"><span>C</span>ampus<span>C</span>orner</a>
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

    <?php if ($id > 3) { ?>
        <h3 style="padding: 2rem;">Offer No : 4 This Combo Is Not available , please select combo offers between these 3
            combos in
            this below...</h3>
        <!-- Offers Section -->
        <section class="offers">
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


    <?php } else { ?>
        <!-- Offers Details With Checkout -->
        <section class="offer_details_container">
            <div class="left">
                <?php
                if ($id == 1) {
                    ?>
                    <div class="offer_details">
                        <div class="top">
                            <h1>🎓 BASIC COMBO – Essential Study Kit 📚</h1>
                            <p>Perfect for students who need essential supplies for daily studies.</p>
                            <p>Designed for students who need essential stationery for daily studies. This kit includes
                                must-have
                                items for smooth writing and organization.</p>
                            <p class="rating"><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i
                                    class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star-half'></i> <span>(4
                                    rating)</span> 150 students
                            </p>
                            <p>offer by <span>CampusCorner</span></p>
                        </div>

                        <div class="description">
                            <div class="tag_head">What's Included?</div>

                            <p><i class='bx bx-check'></i> Cardboard + Plastic ( Spring File ) 5x </p>
                            <p><i class='bx bx-check'></i> (Premium) File Pages Bundle 5x </p>
                            <p><i class='bx bx-check'></i> Semester All Books </p>
                            <p class="not_avl"><i class='bx bx-minus'></i> Notebooks 5x</p>
                            <p class="not_avl"><i class='bx bx-minus'></i> Pen Box 1x + Highlighter 2x + Per. Marker</p>
                            <p class="not_avl"><i class='bx bx-minus'></i> Geomatry Box/Scientific Calculator 1x </p>
                            <p class="not_avl"><i class='bx bx-minus'></i> Free Fetures </p>

                        </div>


                        <div class="description">
                            <div class="tag_head">🔹 Why Choose This?</div>
                            <p>✔️ Budget-friendly for students.</p>
                            <p>✔️ Compact and lightweight.</p>
                            <p>✔️ Perfect for assignments and daily notes.</p>
                        </div>

                        <div class="description">
                            <div class="tag_head"> Free Features </div>
                            <p>📦 Free Delivery </p>
                        </div>


                        <div class="description product_desc">
                            <div class="tag_head">Combo Offer Description</div>
                            <p>This combo is ideal for students who need a simple yet effective stationery kit to support their
                                daily studies. It includes all the fundamental supplies required for smooth writing,
                                note-taking,
                                and organizing important papers. If you are a school or college student looking for an
                                affordable
                                yet complete set of essentials, this combo is the perfect pick for you!</p>
                            <p>📢 Best For: Daily writing, assignments, and basic organization.</p>
                        </div>

                        <!-- Extra Offers -->
                        <div class="description">
                            <div class="tag_head">💰 Exclusive Student Discounts & Offers</div>
                            <p>📌 Buy 2 Premium Combos & Get an Extra 5% Off!</p>
                            <p>📌 Bulk orders available for schools & colleges.</p>
                            <p>📌 COD (Cash on Delivery) & Online Payment Options Available.</p>
                            <p>📢 Hurry! Limited Stock Available – Order Now & Upgrade Your Study Game! 🚀</p>
                        </div>

                        <div class="description">
                            <div class="tag_head">📍 Why Choose Our Student Combo Offers?</div>
                            <p>✅ High-Quality Stationery Products</p>
                            <p>✅ Affordable Pricing & Value for Money</p>
                            <p>✅ FREE Delivery & Bulk Order Discounts</p>
                            <p>✅ Perfect for Students, Competitive Exam Aspirants & Office Use</p>
                            <p>📦 Order Now & Get Ready to Ace Your Studies!</p>
                        </div>

                    </div>
                <?php } else if ($id == 2) { ?>
                        <div class="offer_details">
                            <div class="top">
                                <h1>🎓 Plus Combo – Smart Study Kit for Organized Learning 📚</h1>
                                <p>For students who need a little extra for regular studies!</p>
                                <p> Ideal for students handling multiple subjects. It provides additional writing tools and
                                    organization essentials to enhance productivity.</p>
                                <p class="rating"><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i
                                        class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star-half'></i> <span>(4
                                        rating)</span> 110 students
                                </p>
                                <p>offer by <span>CampusCorner</span></p>
                            </div>

                            <div class="description">
                                <div class="tag_head">What's Included?</div>

                                <p><i class='bx bx-check'></i> Cardboard + Plastic ( Spring File ) 5x </p>
                                <p><i class='bx bx-check'></i> File Pages Bundle 5x </p>
                                <p class="not_avl"><i class='bx bx-minus'></i> Semester All Books </p>
                                <p><i class='bx bx-check'></i> Notebooks 3x </p>
                                <p><i class='bx bx-check'></i> Pen Box 1x + Highlighter</p>
                                <p><i class='bx bx-check'></i> Geomatry Box 1x </p>
                                <p><i class='bx bx-check'></i> Free Fetures </p>

                            </div>


                            <div class="description">
                                <div class="tag_head">🔹 Why Choose This?</div>

                                <p>✔️ Ideal for students managing multiple subjects.</p>
                                <p>✔️ Includes 2 Files, 200 Writing Pages, 4 Pens, 1 Highlighter, 2 Notebooks, 1 Geometry Box.</p>
                                <p>✔️ Free Exam Pad with every purchase!</p>
                                <p>📢 Limited-Time Offer: Get a FREE Exam Pad with every purchase!</p>

                            </div>

                            <div class="description">
                                <div class="tag_head"> Free Features </div>
                                <p>📦 Free Delivery </p>
                            </div>


                            <div class="description product_desc">
                                <div class="tag_head">Combo Offer Description</div>
                                <p>Designed for students who manage multiple subjects, this combo offers a balanced selection of
                                    stationery items to improve productivity and organization. With extra writing tools and study
                                    essentials, it helps students stay prepared for assignments, exams, and regular coursework.</p>
                                <p>For students handling multiple subjects, the Plus Combo provides extra writing tools and
                                    organizational supplies to enhance efficiency. It’s designed to help students stay prepared for
                                    assignments, presentations, and exams without the hassle of missing stationery items.</p>
                                <p>📢 Limited-Time Offer: Get a FREE Exam Pad with every purchase!

                                </p>
                            </div>

                            <!-- Extra Offers -->
                            <div class="description">
                                <div class="tag_head">💰 Exclusive Student Discounts & Offers</div>
                                <p>📌 Buy 2 Premium Combos & Get an Extra 5% Off!</p>
                                <p>📌 Bulk orders available for schools & colleges.</p>
                                <p>📌 COD (Cash on Delivery) & Online Payment Options Available.</p>
                                <p>📢 Hurry! Limited Stock Available – Order Now & Upgrade Your Study Game! 🚀</p>
                            </div>

                            <div class="description">
                                <div class="tag_head">📍 Why Choose Our Student Combo Offers?</div>
                                <p>✅ High-Quality Stationery Products</p>
                                <p>✅ Affordable Pricing & Value for Money</p>
                                <p>✅ FREE Delivery & Bulk Order Discounts</p>
                                <p>✅ Perfect for Students, Competitive Exam Aspirants & Office Use</p>
                                <p>📦 Order Now & Get Ready to Ace Your Studies!</p>
                            </div>

                        </div>
                <?php } else if ($id == 3) { ?>
                            <div class="offer_details">
                                <div class="top">
                                    <h1>🎓 Premium Combo – The Ultimate Study Kit for Serious Learners📚</h1>
                                    <p>Perfect for students who need essential supplies for daily studies.</p>
                                    <p>Designed for students who need an all-in-one stationery solution, the Premium Combo is perfect
                                        for competitive exam aspirants, college students, and those who want to maximize their
                                        productivity. Packed with premium-quality stationery, this combo ensures you stay well-equipped
                                        for any academic challenge.</p>
                                    <p class="rating"><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i
                                            class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star-half'></i> <span>(4
                                            rating)</span> 400 students
                                    </p>
                                    <p>offer by <span>CampusCorner</span></p>
                                </div>

                                <div class="description">
                                    <div class="tag_head">What's Included?</div>

                                    <p><i class='bx bx-check'></i> Cardboard + Plastic ( Spring File ) 5x </p>
                                    <p><i class='bx bx-check'></i> (Premium) File Pages Bundle 5x </p>
                                    <p><i class='bx bx-check'></i> Semester All Books </p>
                                    <p><i class='bx bx-check'></i> Notebooks 5x</p>
                                    <p><i class='bx bx-check'></i> Pen Box 1x + Highlighter 2x + Per. Marker</p>
                                    <p><i class='bx bx-check'></i> Geomatry Box/Scientific Calculator 1x </p>
                                    <p><i class='bx bx-check'></i> Free Fetures </p>

                                </div>


                                <div class="description">
                                    <div class="tag_head">🔹 Why Choose This?</div>
                                    <p>✔️ Best for Serious Learners & Competitive Exams – Everything a student needs in one pack..</p>
                                    <p>✔️ High-Quality Materials for a Seamless Study Experience – Durable and premium stationery</p>
                                    <p>✔️ Comes with a Bonus Zipper File Folder! – Keep your important documents safe.</p>
                                    <p>📢 Ideal For: College students, exam aspirants, and those looking for the best study resources.
                                    </p>
                                </div>

                                <div class="description">
                                    <div class="tag_head"> Free Features </div>
                                    <p>📦 Free Delivery </p>
                                </div>


                                <div class="description product_desc">
                                    <div class="tag_head">Premium (Diamond) Combo Offer Description</div>
                                    <p>A complete academic kit tailored for dedicated students and competitive exam aspirants, this
                                        combo provides high-quality stationery for efficient studying and note organization. It ensures
                                        a hassle-free learning experience with premium materials, making it the ultimate choice for
                                        those who want to stay ahead in their academic journey.</p>
                                    <p>A complete academic kit for serious learners and competitive exam aspirants. Packed with
                                        high-quality stationery for a seamless study experience.</p>
                                    <p>📢 Ideal For: College students, exam aspirants, and those looking for the best study resources.
                                    </p>
                                </div>

                                <!-- Extra Offers -->
                                <div class="description">
                                    <div class="tag_head">💰 Exclusive Student Discounts & Offers</div>
                                    <p>📌 Buy 2 Premium Combos & Get an Extra 5% Off!</p>
                                    <p>📌 Bulk orders available for schools & colleges.</p>
                                    <p>📌 COD (Cash on Delivery) & Online Payment Options Available.</p>
                                    <p>📢 Hurry! Limited Stock Available – Order Now & Upgrade Your Study Game! 🚀</p>
                                </div>

                                <div class="description">
                                    <div class="tag_head">📍 Why Choose Our Student Combo Offers?</div>
                                    <p>✅ High-Quality Stationery Products</p>
                                    <p>✅ Affordable Pricing & Value for Money</p>
                                    <p>✅ FREE Delivery & Bulk Order Discounts</p>
                                    <p>✅ Perfect for Students, Competitive Exam Aspirants & Office Use</p>
                                    <p>📦 Order Now & Get Ready to Ace Your Studies!</p>
                                </div>

                            </div>
                <?php } else { ?>
                            <div class="offer_details">
                                <div class="top">
                                    <h1>This Combo Offer Not Available</h1>
                                </div>
                            </div>
                <?php } ?>

            </div>

            <?php if ($id > 3) { ?>

            <?php } else { ?>
                <div class="right">
                    <div class="combo_checkout">
                        <div class="banner">
                            <img src="../admin/assets/<?php echo $vk['offer_banner']; ?>" alt="">
                        </div>
                        <div class="price_dtl">
                            <div class="price_head">
                                <span class="current_price" id="current_price">₹ <?php echo $vk['offer_price']; ?></span>
                                <span class="real_price">₹ <?php echo $vk['real_price']; ?></span>
                                <span class="discount" id="discount"><?php echo $vk['disount']; ?>% off</span>
                            </div>
                            <div class="price_smal_desc">
                                <span class="rate"><i class='bx bxs-star'></i>4</span> |
                                <span><i class='bx bx-sushi'></i> 2 </span>
                                <span></span>
                            </div>

                            <div class="pay_btn">
                                <form method="post" id="paymentForm">
                                    <h3>Quentity</h3>
                                    <input type="number" name="quantity" id="quantity" value="1" autocomplete="off" required
                                        oninput="updatePrice()" min="1">
                                    <input type="hidden" id="basePrice" value="<?php echo $vk['offer_price']; ?>">
                                    <!-- Select Branch -->
                                    <?php if ($id == 3) { ?>
                                        <select name="branch" id="branch" required>
                                            <option value="" disabled selected>Select Department For Book</option>
                                            <option value="Civil">Civil Eng.</option>
                                            <option value="Mechanical">Mechanical Eng.</option>
                                            <option value="Plastic">Plastic Eng.</option>
                                            <option value="Chemical">Chemical Eng.</option>
                                            <option value="I.T">Information Technology</option>
                                        </select>
                                    <?php } else { ?>

                                    <?php } ?>
                                    <!-- PHP Price -->
                                    <h3>Delivery Information</h3>
                                    <input type="text" name="street" id="street" placeholder="Street Address" required>
                                    <input type="text" name="city" id="city" placeholder="City" required>
                                    <div class="pincode_group">
                                        <input type="text" name="state" placeholder="state" required>
                                        <input type="text" name="pincode" id="pincode" placeholder="pincode" required>
                                    </div>
                                    <h3>Payment Methods</h3>
                                    <div class="pay_methods">
                                        <div class="method" id="razorpay_method"> <span id="raz_check"></span> <img
                                                src="../admin/assets/razorpay.png" alt="">
                                        </div>
                                        <div class="method" id="cod_method"> <span id="cod_check"></span> COD </div>
                                    </div>
                                    <button name="cod" id="cod_btn">Place Order</button>
                                    <button type="button" class="buynow" id="payWithRazorpayBtn"
                                        data-price="<?php echo $vk['offer_price']; ?>" data-combo="<?php echo $id; ?>"
                                        data-user="<?php echo $data['user_id']; ?> ">
                                        Place via <img src="../admin/assets/razorpay.png" alt="">
                                    </button>
                                </form>
                            </div>


                        </div>

                        <div class="coupon_code">
                            <h3>Have a coupon code?</h3>
                            <form action="#">
                                <label for="#">Enter a coupon code</label>
                                <div class="form_group">
                                    <input type="text" placeholder="eg. CC2025" name="coupon">
                                    <button>Apply</button>
                                </div>
                            </form>
                        </div>

                        <!-- Checkout The Script -->
                    </div>
                </div>
            <?php } ?>


        </section>

    <?php } ?>

    <!-- Payment Gateway Scrpt -->

    <!-- For Quantity System -->
    <script>
        function updatePrice() {
            let quantity = document.getElementById("quantity").value || 1; // Get quantity (default 1)
            let basePrice = document.getElementById("basePrice").value; // Get base price
            let totalPrice = quantity * basePrice; // Calculate total price
            const extra_discount = document.getElementById("discount");

            // Apply 5% discount if quantity is 2 or more
            if (quantity >= 2) {
                let discount = totalPrice * 0.05; // 5% of total price
                totalPrice -= discount; // Subtract discount
                extra_discount.innerHTML = '30% + 5% Off';
            }
            else {
                extra_discount.innerHTML = ' 30% off';
            }

            let button = document.getElementById("payWithRazorpayBtn"); // Select button
            button.setAttribute("data-price", totalPrice.toFixed(2)); // Update data-price

            document.getElementById("current_price").innerHTML = totalPrice.toFixed(2); // Update displayed price
        }
    </script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <?php if ($id == 3) { ?>
        <script>
            document.getElementById('payWithRazorpayBtn').addEventListener('click', function () {
                const form = document.getElementById("paymentForm");

                // Check if form is valid
                if (!form.checkValidity()) {
                    form.reportValidity(); // Show validation messages
                    return; // Stop execution if form is invalid
                }

                // If form is valid, proceed with Razorpay payment
                let amount = this.getAttribute("data-price");
                let user_id = this.getAttribute("data-user");
                let combo_id = this.getAttribute("data-combo");

                // Collect address details from form
                let pincode = document.getElementById("pincode").value;
                let street = document.getElementById("street").value;
                let city = document.getElementById("city").value;
                let quantity = document.getElementById("quantity").value;
                let branch = document.getElementById("branch").value;

                // Create order in Razorpay via PHP
                fetch('checkout.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        amount,
                        user_id,
                        combo_id,
                        branch,
                        pincode,
                        street,
                        city,
                        quantity,
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        let options = {
                            "key": data.key,
                            "amount": parseInt(amount),
                            "currency": "INR",
                            "name": "Campus Corner",
                            "description": "Payment for Combo Offer",
                            "order_id": data.order_id,
                            "handler": function (response) {
                                savePayment(response, amount, user_id, combo_id, branch, pincode, street, city, quantity);
                            },
                            "theme": {
                                "color": "#000"
                            }
                        };

                        let rzp = new Razorpay(options);
                        rzp.open();
                    });
            });

            // Function to store payment details
            function savePayment(response, amount, user_id, combo_id, branch, pincode, street, city, quantity) {
                fetch('save_payment.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        payment_id: response.razorpay_payment_id,
                        order_id: response.razorpay_order_id,
                        amount: amount,
                        user_id: user_id,
                        combo_id: combo_id,
                        branch: branch,
                        pincode: pincode,
                        street: street,
                        city: city,
                        quantity: quantity
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Redirect to success page if payment details are saved successfully
                            window.location.href = "success.php";
                        } else {
                            // If an error occurs, show a message and redirect to the cancel page
                            alert(data.message || 'Payment failed, please try again.');
                            window.location.href = "cancel.php";
                        }
                    })
                    .catch(error => {
                        // Handle any other errors
                        alert('Error saving payment details: ' + error);
                        window.location.href = "cancel.php";
                    });
            }

        </script>

    <?php } else { ?>
        <script>
            document.getElementById('payWithRazorpayBtn').addEventListener('click', function () {
                const form = document.getElementById("paymentForm");

                // Check if form is valid
                if (!form.checkValidity()) {
                    form.reportValidity(); // Show validation messages
                    return; // Stop execution if form is invalid
                }

                // If form is valid, proceed with Razorpay payment
                let amount = this.getAttribute("data-price");
                let user_id = this.getAttribute("data-user");
                let combo_id = this.getAttribute("data-combo");

                // Collect address details from form
                let pincode = document.getElementById("pincode").value;
                let street = document.getElementById("street").value;
                let city = document.getElementById("city").value;
                let quantity = document.getElementById("quantity").value;

                // Create order in Razorpay via PHP
                fetch('checkout.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        amount,
                        user_id,
                        combo_id,
                        pincode,
                        street,
                        city,
                        quantity,
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        let options = {
                            "key": data.key,
                            "amount": parseInt(amount),
                            "currency": "INR",
                            "name": "Campus Corner",
                            "description": "Payment for Combo Offer",
                            "order_id": data.order_id,
                            "handler": function (response) {
                                savePayment(response, amount, user_id, combo_id, pincode, street, city, quantity);
                            },
                            "theme": {
                                "color": "#000"
                            }
                        };

                        let rzp = new Razorpay(options);
                        rzp.open();
                    });
            });

            // Function to store payment details
            function savePayment(response, amount, user_id, combo_id, pincode, street, city, quantity) {
                fetch('save_payment.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        payment_id: response.razorpay_payment_id,
                        order_id: response.razorpay_order_id,
                        amount: amount,
                        user_id: user_id,
                        combo_id: combo_id,
                        pincode: pincode,
                        street: street,
                        city: city,
                        quantity: quantity
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Redirect to success page if payment details are saved successfully
                            window.location.href = "success.php";
                        } else {
                            // If an error occurs, show a message and redirect to the cancel page
                            alert(data.message || 'Payment failed, please try again.');
                            window.location.href = "cancel.php";
                        }
                    })
                    .catch(error => {
                        // Handle any other errors
                        alert('Error saving payment details: ' + error);
                        window.location.href = "cancel.php";
                    });
            }

        </script>
    <?php } ?>

    <!-- Payment Methods Script -->

    <script>

        // Check Box
        const RazCheck = document.getElementById("raz_check");
        const CodCheck = document.getElementById("cod_check");

        RazCheck.classList.add("active_pay");

        // Function to handle payment methods
        const CODBTN = document.getElementById("cod_btn");
        const RazorpayBTN = document.getElementById("payWithRazorpayBtn");
        const CODMethod = document.getElementById("cod_method");
        const RazorpayMethod = document.getElementById("razorpay_method");



        RazorpayMethod.addEventListener("click", () => {

            RazorpayBTN.style.display = "flex";
            CODBTN.style.display = "none";
            RazCheck.classList.add("active_pay");
            CodCheck.classList.remove("active_pay");


        });

        CODMethod.addEventListener("click", () => {

            CODBTN.style.display = "flex";
            RazorpayBTN.style.display = "none";
            CodCheck.classList.add("active_pay");
            RazCheck.classList.remove("active_pay");

        })



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



    <?php

    include("../hf/footer.php");

    ?>