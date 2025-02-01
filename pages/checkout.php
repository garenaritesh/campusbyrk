<?php
require('../vendor/autoload.php');
use Razorpay\Api\Api;

// Razorpay API credentials
$keyId = "rzp_test_bwPWZCZLu6BTH4";
$keySecret = "sVXOA4jOeqjFrFp0vlEyuim8";
$api = new Api($keyId, $keySecret);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'] * 100; // Convert to paise (smallest unit in INR)
    $user_id = $_POST['user_id'];
    $combo_id = $_POST['combo_id'];
    if ($combo_id == 3) {
        $branch = $_POST['branch'];
    }
    else{
        $branch = "default";
    }
    $quantity = $_POST['quantity'];
    $total_price = $amount * $quantity;

    // Create order in Razorpay
    $order = $api->order->create([
        'receipt' => uniqid(),
        'amount' => $amount,
        'currency' => 'INR',
        'payment_capture' => 1
    ]);

    // Store order details in `orders` table
    $db = new mysqli("localhost", "root", "", "dbpass");
    $order_id = $order['id'];
    $sql = "INSERT INTO orders (order_id, user_id, combo_id, branch, quantity, amount, status, track_status) 
            VALUES ('$order_id', '$user_id', '$combo_id', '$branch', '$quantity', '$total_price', 'pending', 'packing')";
    $db->query($sql);

    echo json_encode(['order_id' => $order_id, 'key' => $keyId]);
}
?>