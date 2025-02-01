<?php

include("../hf/users_h.php");


if (isset($_REQUEST['edt_order'])) {
    $id = $_REQUEST['edt_order'];
    $sql = "select * from orders where order_id = '$id'";
    $a = mysqli_query($db, $sql);
    $order_row = mysqli_fetch_assoc($a);
}

// Fetch Order name 
$offer_id = $order_row['combo_id'];
$sql = "select * from offers where offer_id = '$offer_id'";
$fetch_item_name = mysqli_fetch_assoc(mysqli_query($db, $sql));
$order_product_name = $fetch_item_name['offer_name'];

// Fetch User 


// Payment ID Fetch

// // // Cancelled Order PHP Script Here
if (isset($_REQUEST['cancel_order'])) {

    $order_id = $_REQUEST['order_id'];
    $user_id = $_REQUEST['user_id'];
    $payment_id = $_REQUEST['payment_id'];
    $reason = $_REQUEST['reason'];
    $upi = $_REQUEST['upi'];
    $amount = $_REQUEST['amount'];

    $sql = "insert into cancel_orders(order_id,payment_id,user_id,reason,amount,upi) values('$order_id','$payment_id','$user_id','$reason','$amount','$upi')";
    
    // Cancelled from orders table
    $update_order_query = "update orders set track_status='Cancelled' where order_id ='$order_id'";

    mysqli_query($db, $sql);
    mysqli_query($db,$update_order_query);
    
    header("location:../users/orders.php");

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Cancel Order </title>
</head>

<style>
    .order_card {
        margin-top: 10%;
        width: 100%;
        padding: 2rem 1rem;
        border-top: 1px solid var(--epcl-border-color);
        display: flex;
        align-items: start;
        justify-content: space-between;
        position: relative;
        transition: all ease 0.5s;
        cursor: pointer;
    }

    .order_card:hover #cancel_order {
        display: flex;
    }

    .order_card .order_dtl {
        display: flex;
        /* flex-direction: column; */
        gap: 2rem;
        align-items: start;
        justify-content: start;
    }




    .order_card .order_dtl .order_img {
        width: 300px;
        overflow: hidden;
        object-fit: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }


    .order_card .order_dtl .order_img img {
        width: 100%;
        object-fit: cover;
        background-position: center;
    }

    .order_card .order_dtl .order_desc {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
        align-items: start;
        justify-content: start;
    }

    .order_card .order_dtl .order_desc h2 {
        font-size: 16px;
        font-weight: 600;
    }

    .order_card .order_dtl .order_desc .price_dtl {
        display: flex;
        gap: 1rem;
        color: var(--hover-text-color);
    }

    .order_card .order_dtl .order_desc .price_dtl p {
        font-weight: 400;
        font-size: 14px;
    }

    .order_card .order_dtl .order_desc p {
        color: var(--hover-text-color);
        font-size: 14px;
        font-weight: 400;
    }

    .order_card .order_dtl .order_desc p span {
        color: var(--text-color);
        font-size: 14px;
        font-weight: 400;
    }

    .order_card .order_track_status p {
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
    }

    .order_card .order_track_status p span {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #02ac70;
    }


    .order_card .track_status_btn {
        display: flex;
        align-items: start;
        justify-content: center;
    }

    .order_card .track_status_btn button {
        padding: 0.6rem 1rem;
        background: black;
        color: var(--white-color);
        cursor: pointer;
        outline: none;
        border: none;
        border-radius: 3px;
    }

    .order_card .order_track_status {
        width: 40%;
    }

    .order_card .order_track_status form {
        width: 70%;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .order_card .order_track_status form textarea {
        padding: 10px;
        resize: none;
    }

    .order_card .order_track_status form button {
        padding: 0.8rem 1rem;
        background: black;
        color: var(--white-color);
        border: none;
        outline: none;
    }

    .order_card .order_track_status form input {
        padding: 10px;

    }

    .order_card .order_track_status form p {
        font-size: 14px;
        font-weight: 400;
        color: var(--hover-text-color)
    }

</style>

<body>

    <div class="order_card">
        <!-- Cancel Order -->
        <!-- <a href="../pages/cancel_order.php" target="_blank" id="cancel_order"><button>Cancel Order</button></a> -->
        <div class="order_dtl">
            <div class="order_img">
                <img src="../admin/assets/basic.jpg" alt="">
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
            </div>
        </div>
        <div class="order_track_status">
            <form action="#" method="post">
                <!-- Hidden Data -->
                 <input type="hidden" name="order_id" value="<?php echo $order_row['order_id'];?>">
                 <input type="hidden" name="user_id" value="<?php echo $order_row['user_id'];?>">
                 <input type="hidden" name="payment_id" value="<?php echo $order_row['payment_id']; ?>">
                 <input type="hidden" name="amount" value="<?php echo $order_row['amount']?>">
                <textarea name="reason" required placeholder="Tell us ( reason )" cols="10" rows="3"></textarea>
                <?php
                if ($order_row['status'] == 'completed') { ?>
                    <input type="text" name="upi" placeholder="Enter UPI ID To Get Refund" required>
                <?php } else { ?>
                    <input type="text" name="upi" placeholder="Enter UPI ID To Get Refund" value="cod" readonly>
                <?php } ?>
                <button name="cancel_order">Cancel Order</button>
                <?php if ($order_row['status'] == 'completed') { ?>
                    <p>If your pay the amount of order via razorpay or online then enter the your upi account upi id to get
                        refund of cancel order , our team to give the refund 24 Hour working time...</p>
                <?php } else { ?>
                    <p>Your Order Payment Is Cash On Delivery...</p>
                <?php } ?>
            </form>
        </div>

    </div>

</body>

</html>