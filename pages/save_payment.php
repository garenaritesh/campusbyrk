<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
require('../vendor/autoload.php');
use Razorpay\Api\Api;

// Razorpay API credentials
$keyId = "rzp_test_bwPWZCZLu6BTH4";
$keySecret = "sVXOA4jOeqjFrFp0vlEyuim8";
$api = new Api($keyId, $keySecret);

// Get POST data
$payment_id = $_POST['payment_id'];
$order_id = $_POST['order_id'];
$amount = $_POST['amount'];
$user_id = $_POST['user_id'];
$combo_id = $_POST['combo_id'];
if($combo_id == 3) {
    $branch = $_POST['branch'];
}
else {
    $branch = '';
}
$pincode = $_POST['pincode'];
$street = $_POST['street'];
$city = $_POST['city'];
$quantity = $_POST['quantity'];
$total_price = $amount * $quantity; // Convert from paise to INR


// Debug: Check if data is being received correctly
if (empty($payment_id) || empty($order_id) || empty($amount)) {
    echo json_encode(['success' => false, 'message' => 'Required data missing']);
    exit();
}

try {
    // Connect to database
    $db = new mysqli("localhost", "root", "", "dbpass");

    if ($db->connect_error) {
        throw new Exception('Database connection failed: ' . $db->connect_error);
    }

    // Start a transaction to ensure both operations are successful
    $db->begin_transaction();

    // 1. Update the order details in `orders` table
    $sql = "UPDATE orders 
            SET payment_id = ?, pincode = ?, street = ?, branch= '$branch', city = ?, quantity = '$quantity', amount = ?, status = 'completed', track_status = 'Packing' 
            WHERE order_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssssds', $payment_id, $pincode, $street, $city, $total_price, $order_id);

    if (!$stmt->execute()) {
        throw new Exception('Error updating order: ' . $stmt->error);
    }

    // 2. Insert payment details into the `payments` table
    // Ensure the number of columns matches the number of values being inserted
    $sql_payment = "INSERT INTO payments (payment_id, order_id, user_id, combo_id, branch, quantity, amount, pincode, street, city, status)
                    VALUES (?, ?, ?, ?, '$branch', '$quantity', ?, ?, ?, ?, 'Paid')";
    $stmt_payment = $db->prepare($sql_payment);
    $stmt_payment->bind_param('sssdssss', $payment_id, $order_id, $user_id, $combo_id, $total_price, $pincode, $street, $city);

    if (!$stmt_payment->execute()) {
        throw new Exception('Error inserting payment details: ' . $stmt_payment->error);
    }

    // Commit the transaction if both queries succeed
    $db->commit();

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    // Rollback the transaction if any error occurs
    $db->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>