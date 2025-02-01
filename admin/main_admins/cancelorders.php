<?php

include("main_adminpanel.php");

// if (isset($_REQUEST['delC'])) {
//     $id = $_REQUEST['delC'];
//     $sql = "delete from train_forms where train_form_id = '$id'";
//     mysqli_query($db, $sql);
//     header("location:train_form.php");
// }

// Fetch Cancel Order Request
$cancel_sql_query = "select * from cancel_orders where upi != 'cod'";
$res_cancel = mysqli_query($db, $cancel_sql_query);


// Delete From The Cancel And Refund Requests Work
if (isset($_REQUEST['refund_del'])) {
    $id = $_REQUEST['refund_del'];

    $sql = "delete from cancel_orders where cancel_id = '$id'";

    mysqli_query($db, $sql);
    header("location:cancelorders.php");
}

?>



<style>
    table {
        width: 100%;
        margin: 20px auto;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }



    th {
        background-color: #f4f4f4;
    }


    #or_dtl {
        text-align: start;
    }

    #qr .qrcode {
        margin-left: 20%;
    }
</style>


<!-- Admin Panel Structure Here -->

<!-- Panel Structure -->

<!-- Orders Tabs To Manage -->
<div class="orders_tab">
    <button onclick="location.href='orders.php'">New Orders</button>
    <button onclick="location.href='shipped_orders.php'">Shipped Orders</button>
    <button onclick="location.href='outdelivery.php'">Out Of Delivers</button>
    <button onclick="location.href='delivered.php'">Delivered Orders</button>
    <button class="co_tab" onclick="location.href='cancelorders.php'">Cancel Orders</button>
</div>


<h4>Cancel Orders</h4>

<!-- Form Tables -->
<?php
if (mysqli_num_rows($res_cancel) > 0) {
    ?>
    <table>
        <tr>
            <th>No</th>
            <th>Order Detail</th>
            <th>Reason</th>
            <th>UPI</th>
            <th>QR</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($res_cancel)) {

            // Fetch Amount 
            $upiID = $row['upi'];  // UPI ID from database
            $amount = $row['amount'];  // Amount from canceled order
            $reason = $row['reason'];  // Reason (used as transaction note)
            $orderID = $row['order_id']; // Order ID for reference
    
            // Find Combo Name Of Product
            $combo_id_check = "select * from orders where order_id = '$orderID'";
            $combo_id_result = mysqli_query($db, $combo_id_check);
            $combo_id_row = mysqli_fetch_assoc($combo_id_result);

            // Conbo ID
            $comboID = $combo_id_row['combo_id'];


            $find_combo_name_query = "select * from offers where offer_id = '$comboID'";
            $find_combo_name_result = mysqli_query($db, $find_combo_name_query);
            $find_combo_name_row = mysqli_fetch_assoc($find_combo_name_result);
            $combo_name = $find_combo_name_row['offer_name'];

            ?>
            <tr>
                <td><?php echo $row['cancel_id']; ?></td>
                <td id="or_dtl">
                    Order Id : <?php echo $row['order_id']; ?><br>
                    Payment Id : <?php echo $row['payment_id']; ?><br>
                    User Id : <?php echo $row['user_id']; ?>
                </td>
                <td><?php echo $row['reason']; ?></td>
                <td class="upi"><?php echo $row['upi']; ?></td>
                <td id="qr">
                    <div class="qrcode" id="qrcode_<?php echo $row['cancel_id']; ?>" data-upi="<?php echo $upiID; ?>"
                        data-amount="<?php echo $amount; ?>"
                        data-note="Refund Amount of <?php echo $combo_name; ?> Combo Offer">
                    </div>
                </td>
                <td><a href="cancelorders.php?refund_del=<?php echo $row['cancel_id']; ?>"><i class='bx bx-trash'></i></a></td>
            </tr>
        <?php } ?>
    </table>
    <?php
} else { ?>

    <div class="no_orders">
        <h2>No Cancel Orders Found !</h2>
    </div>

<?php } ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".qrcode").forEach(function (element) {
            let upiID = element.getAttribute("data-upi");
            let amount = element.getAttribute("data-amount");
            let note = element.getAttribute("data-note");

            // Create UPI QR Code URL
            let upiURL = `upi://pay?pa=${upiID}&pn=CampusCornert&am=${amount}&cu=INR&tn=${encodeURIComponent(note)}`;

            // Generate QR Code
            new QRCode(element, {
                text: upiURL,
                width: 100,
                height: 100
            });
        });
    });
</script>



</div>
</div>






<!-- Javascript file link here -->



</body>

</html>