<?php

include("../hf/users_h.php");


// Fetch user information
$sql_user = "SELECT * FROM users WHERE email = '$user'";
$user_info = mysqli_fetch_assoc(mysqli_query($db, $sql_user));

// User Data
$sql_user = "SELECT * FROM users WHERE email = '$user'";
$user_info = mysqli_fetch_assoc(mysqli_query($db, $sql_user));

// User ID
$user_id = $user_info['user_id'];


// Fetch All Orders Of User
$sql_order_query = "select * from orders where user_id = '$user_id' and track_status != 'Cancelled' order by id desc";
$orders = mysqli_query($db, $sql_order_query);
$count_orders = mysqli_num_rows($orders);


// Get Historu Of Order by User
$order_history_sql = "select * from orders where user_id='$user_id' and track_status in ('Order Placed', 'Cancelled')";
$res_order_history = mysqli_query($db, $order_history_sql);
$order_history_count = mysqli_num_rows($res_order_history);

// 

?>

<!-- User Notification -->
<div class="user_info">
    <div class="user_img">
        <?php if ($user_info['user_pic'] == ''): ?>
            <img src="../admin/assets/user_img.jpg" alt="">
        <?php else: ?>
            <img src="../admin/images/<?php echo $user_info['user_pic']; ?>" alt="">
        <?php endif; ?>
    </div>
    <div class="user_dtl">
        <h1><?php echo $user_info['name'] ?: 'Passmate User'; ?></h1>
        <p>Passmate Member Since <?php echo date("Y", strtotime($user_info['date'])); ?></p>
    </div>
</div>

<!-- User Tabs -->
<div class="user_tabs">
    <ul class="tab">
        <li class="c_tab"><a href="orders.php">Orders 📦 </a></li>
        <li><a href="../pages/user_account.php">Passes</a></li>
        <li><a href="user_info.php">Account</a></li>
        <li><a href="notification.php">Notification</a></li>
        <li><a href="setting.php">Setting</a></li>
    </ul>
</div>

<!-- Order Section Container -->

<section class="slider">
    <?php if ($count_orders > 0) { ?>
        <div class="order_container">
            <h3>Current Orders</h3>
            <?php
            while ($order_row = mysqli_fetch_assoc($orders)) {

                // Fetch Name 
                $product_id = $order_row['combo_id'];
                $order_product_name_query = "select * from offers where offer_id = '$product_id'";
                $order_name_fetch = mysqli_fetch_assoc(mysqli_query($db, $order_product_name_query));
                $order_product_name = $order_name_fetch['offer_name'];
                $order_banner = $order_name_fetch['offer_banner'];

                if ($order_row['track_status'] == 'Order Placed') {

                    ?>

                <?php } else { ?>
                    <div class="order_card">
                        <!-- Cancel Order -->
                        <?php if ($order_row['track_status'] == "Cancelled") { ?>
                        <?php } else if ($order_row['track_status'] == 'Out of Delivery') { ?>
                            <?php } else if ($order_row['track_status'] == 'Delivered'){ ?>
                        <?php } else { ?>
                                <a href="../pages/cancel_order.php?edt_order=<?php echo $order_row['order_id'] ?>"
                                    id="cancel_order"><button>Cancel
                                        Order</button></a>
                        <?php } ?>
                        <div class="order_dtl">
                            <div class="order_img">
                                <img src="../admin/assets/<?php echo $order_banner; ?>" alt="">
                            </div>
                            <div class="order_desc">
                                <h2><?php echo $order_product_name; ?></h2>
                                <div class="price_dtl">
                                    <p><?php echo "₹" . number_format($order_row['amount'], 2, '.', ',') ?> </p>
                                    <p>Quantity: <?php echo $order_row['quantity']; ?></p>
                                </div>
                                <p><span>Date :</span> <?php echo date("M d , Y", strtotime($order_row['created_at'])); ?></p>
                                <p><span>Payment :</span>
                                    <?php if ($order_row['status'] == "completed") {
                                        echo "Razorpay";
                                    } else {
                                        echo "COD";
                                    } ?>
                                </p>
                            </div>
                        </div>
                        <div class="order_track_status">
                            <div class="order_status">
                                <div class="steps">
                                    <?php if ($order_row['track_status'] == 'Packing') {
                                        ?>
                                        <span class="circle active"><i class='bx bxs-package'></i>
                                            <div class="steps_content">Packing</div>
                                        </span>
                                        <span class="circle">🚚<div class="steps_content">Shipped</div></span>
                                        <span class="circle">🚛 <div class="steps_content">Out Of Delivery</div></span>
                                        <span class="circle"><i class='bx bx-receipt'></i>
                                            <div class="steps_content">Delivered</div>
                                        </span>
                                        <div class="progress-bar">
                                            <span class="indicator" id="indi_progress"></span>
                                        </div>
                                    <?php } else if ($order_row['track_status'] == 'Shipped') {
                                        echo "<style>#pro_1{ width: 50%; transition: all ease 1s;};</style>"; ?>
                                            <span class="circle active"><i class='bx bxs-package'></i>
                                                <div class="steps_content">Packing</div>
                                            </span>
                                            <span class="circle active">🚚<div class="steps_content">Shipped</div></span>
                                            <span class="circle">🚛<div class="steps_content">Out Of Delivery</div></span>
                                            <span class="circle"><i class='bx bx-receipt'></i>
                                                <div class="steps_content">Delivered</div>
                                            </span>
                                            <div class="progress-bar">
                                                <span class="indicator" id="pro_1"></span>
                                            </div>
                                    <?php } else if ($order_row['track_status'] == 'Out of Delivery') {
                                        echo " <style>#pro_2{ width: 75%; } </style> "; ?>
                                                <span class="circle active"><i class='bx bxs-package'></i>
                                                    <div class="steps_content">Packing</div>
                                                </span>
                                                <span class="circle active">🚚<div class="steps_content">Shipped</div></span>
                                                <span class="circle active">🚛<div class="steps_content">Out Of Delivery</div></span>
                                                <span class="circle"><i class='bx bx-receipt'></i>
                                                    <div class="steps_content">Delivered</div>
                                                </span>
                                                <div class="progress-bar">
                                                    <span class="indicator" id="pro_2"></span>
                                                </div>
                                    <?php } else if ($order_row['track_status'] == 'Delivered') {
                                        echo "<style> #pro_3 {width: 100%;} </style>" ?>
                                                    <span class="circle active"><i class='bx bxs-package'></i>
                                                        <div class="steps_content">Packing</div>
                                                    </span>
                                                    <span class="circle active">🚚<div class="steps_content">Shipped</div></span>
                                                    <span class="circle active">🚛<div class="steps_content">Out Of Delivery</div></span>
                                                    <span class="circle active"><i class='bx bx-receipt'></i>
                                                        <div class="steps_content">Delivered</div>
                                                    </span>
                                                    <div class="progress-bar">
                                                        <span class="indicator" id="pro_3"></span>
                                                    </div>
                                    <?php } else if ($order_row['track_status'] == 'Order Placed') {
                                        echo "<style> #pro_4 {width: 100%;} </style>" ?>
                                                        <span class="circle active"><i class='bx bxs-package'></i>
                                                            <div class="steps_content">Packing</div>
                                                        </span>
                                                        <span class="circle active">🚚<div class="steps_content">Shipped</div></span>
                                                        <span class="circle active">🚛<div class="steps_content">Out Of Delivery</div></span>
                                                        <span class="circle active"><i class='bx bx-receipt'></i>
                                                            <div class="steps_content">Delivered</div>
                                                        </span>
                                                        <div class="progress-bar">
                                                            <span class="indicator" id="pro_4"></span>
                                                        </div>
                                    <?php } else if ($order_row['track_status'] == 'Cancelled') { ?>
                                                            <div class="cancel_step">
                                                                <img src="../admin/assets/cancel.png" alt="">
                                                                <p>Cancelled Order</p>
                                                            </div>
                                    <?php } else { ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php
    } else { ?>

    <?php } ?>

    <!-- Order Histiory -->
    <?php if ($order_history_count > 0) { ?>
        <div class="order_container">
            <h3>Order History</h3>
            <?php
            while ($order_row = mysqli_fetch_assoc($res_order_history)) {

                // Fetch Name 
                $product_id = $order_row['combo_id'];
                $order_product_name_query = "select * from offers where offer_id = '$product_id'";
                $order_name_fetch = mysqli_fetch_assoc(mysqli_query($db, $order_product_name_query));
                $order_product_name = $order_name_fetch['offer_name'];
                $order_banner = $order_name_fetch['offer_banner'];

                ?>
                <div class="order_card">
                    <div class="order_dtl">
                        <div class="order_img">
                            <img src="../admin/assets/<?php echo $order_banner; ?>" alt="">
                        </div>
                        <div class="order_desc">
                            <h2><?php echo $order_product_name; ?></h2>
                            <div class="price_dtl">
                                <p>₹ <?php echo $order_row['amount'] ?> </p>
                                <p>Quantity: <?php echo $order_row['quantity']; ?></p>
                            </div>
                            <p><span>Date :</span> <?php echo date("M d , Y", strtotime($order_row['created_at'])); ?></p>
                            <p><span>Payment :</span>
                                <?php if ($order_row['status'] == "completed") {
                                    echo "Razorpay";
                                } else {
                                    echo "COD";
                                } ?>
                            </p>
                            <!-- Refund Check -->
                            <?php
                            if ($order_row['status'] == 'completed') {
                                echo "<p><span>Refund :</span> Online</p>";
                            } else {
                                echo "<p><span>Refund :</span> COD</p>";
                            }

                            ?>
                        </div>
                    </div>
                    <div class="order_track_status">
                        <?php if ($order_row['track_status'] == 'Cancelled') { ?>
                            <img src="../admin/assets/cancel.png" alt="">
                            <p><span style="background: red;"></span> Order Cancel </p>
                        <?php } else { ?>
                            <img src="../admin/assets/success.png" alt="">
                            <p><span></span> Order Placed </p>
                        <?php } ?>
                    </div>

                </div>
            <?php } ?>
        </div>
        <?php
    } else { ?>
        <h1>Exlore Our Offers And Pick And Get Now With Extra Discount</h1>
        <button><a href="http://localhost/projects/pass/pages/offerlanding.php?offer=4">Explore offers</a></button>

    <?php } ?>

</section>




<?php include("../hf/footer.php"); ?>