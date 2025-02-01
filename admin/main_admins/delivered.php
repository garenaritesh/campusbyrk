<?php

include("main_adminpanel.php");

// Delete Order They Are Pending
// $del_pending_query = "delete from orders where status"

$users = "select * from users";
$res = mysqli_query($db, $users);

// Fetch Orders 
$order_query = "select * from orders where track_status = 'Delivered'";
$res_orders = mysqli_query($db, $order_query);
$count_orders = mysqli_num_rows($res_orders);
$fetch_order_id = mysqli_fetch_assoc(mysqli_query($db, $order_query));
@$order_id = $fetch_order_id['order_id'];

// Offers Combo Data Fetch 
$offer_query = "select * from offers";
$res_offers = mysqli_query($db, $offer_query);
$count_offers = mysqli_num_rows($res_offers);


// Update Track Status

// Update Track Status
if (isset($_REQUEST['update_track'])) {

    $track_change_value = $_REQUEST['track_status'];

    if ($track_change_value == 'Order Placed') {
        $update_track_query = "update orders set track_status='Order Placed' where order_id = '$order_id'";
        mysqli_query($db, $update_track_query);
        header("location: delivered.php");
    } else {
        echo "<script>
        alert('Please Select Further Proccess');</script>
        ";
    }
}



?>

<!DOCTYPE html>
<html lang="en" oncontextmenu="return true">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Orders </title>
    <!-- <meta http-equiv="refresh" content="5"> -->


</head>

<body>



    <!-- Orders Tabs To Manage -->
    <div class="orders_tab">
        <button onclick="location.href='orders.php'">New Orders</button>
        <button onclick="location.href='shipped_orders.php'">Shipped Orders</button>
        <button onclick="location.href='outdelivery.php'">Out Of Delivers</button>
        <button class="co_tab" onclick="location.href='delivered.php'">Delivered Orders</button>
        <button onclick="location.href='cancelorders.php'">Cancel Orders</button>
    </div>



    <h4>Orders</h4>

    <?php
    if ($count_orders > 0) {
        ?>
        <!-- Shipped Orders -->
        <div class="orders">
            <?php
            while ($row = mysqli_fetch_assoc($res_orders)) {

                // Order Data
                $order_id = $row['order_id'];

                // Combo Data Fetch For Details
                $combo_id = $row['combo_id'];
                $offer_name_query = "select * from offers where offer_id = $combo_id";
                $offer_name_fetch = mysqli_fetch_assoc(mysqli_query($db, $offer_name_query));
                $offer_name = $offer_name_fetch['offer_name'];

                // Fetch User Details Who Order 
                $user_id = $row['user_id'];
                $user_query = "select * from users where user_id = $user_id";
                $user_fetch = mysqli_fetch_assoc(mysqli_query($db, $user_query));
                $user_name = $user_fetch['name'];
                $user_email = $user_fetch['email'];

                // Fetch Product Details From Orders
        
                // Check Payment Status
        
                // Track Status 
                $track_status = ['Packing', 'Shipped', 'Out of Delivery', 'Delivered', 'Order Placed'];


                ?>
                <div class="order_card">
                    <div class="order_col col1">
                        <h2>📦</h2>
                    </div>
                    <div class="order_col col2">
                        <p class="product_name"><?php echo $offer_name; ?></p>
                        <div class="user_order_dtl">
                            <?php
                            if ($user_fetch['name'] == '') {
                                echo "<h3>$user_email</h3>";
                            } else {
                                echo "<h3>$user_name</h3>";
                            }
                            ?>
                            <p><?php echo $user_fetch['phone'] ?></p>
                            <p><?php echo $row['street']; ?></p>
                            <p><?php echo $row['city'] ?> , Gujrat - <?php echo $row['pincode']; ?> </p>
                        </div>
                    </div>
                    <div class="order_col col3">
                        <p class="product_q">Quentity: <?php echo $row['quantity'] ?> </p>
                        <div class="product_dtl">
                            <span>Price: <i class='bx bx-rupee'></i> <?php echo $row['amount']; ?></span>
                            <span>Method:
                                <?php if ($row['status'] == 'completed') {
                                    echo 'Online';
                                } else if ($row['status'] == 'pending') {
                                    echo 'Order Not Confirm';
                                } else {
                                    echo 'COD';
                                } ?>
                            </span>
                            <span>Payment: <?php echo $row['status']; ?></span>
                            <span>Date: <?php echo date("M d, Y - h:i A", strtotime($row['created_at'])) ?> </span>
                        </div>
                    </div>
                    <div class="order_col col4">
                        <form action="#">
                            <select name="track_status">
                                <!-- <option value="">Select Category</option> -->
                                <?php
                                $status = $row['track_status'];
                                // Loop through predefined casts
                                foreach ($track_status as $track) {
                                    $selected = ($track == $status) ? 'selected' : '';
                                    echo "<option value='$track' $selected>$track</option>";
                                }
                                ?>

                            </select>

                            <button name="update_track">Save</button>

                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
    } else { ?>
        <div class="no_orders">
            <h2>No Delivered Orders Found</h2>
        </div>
    <?php } ?>




    <!-- Javascript Content Here -->
    <!-- <script>
        document.addEventListener("contextmenu", function (event) {
            event.preventDefault(); // Disable right-click
            alert("Right-click is disabled on this website.");
        });
    </script> -->


</body>

</html>