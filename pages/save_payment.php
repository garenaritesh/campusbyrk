<?php
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
$pincode = $_POST['pincode'];
$street = $_POST['street'];
$city = $_POST['city'];

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

    // Update the order details with payment information
    $sql = "UPDATE orders 
            SET payment_id = ?, pincode = ?, street = ?, city = ?, amount = ?, status = 'completed', track_status = 'shipped' 
            WHERE order_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssssds', $payment_id, $pincode, $street, $city, $amount, $order_id);

    // Execute the statement and check if it's successful
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        throw new Exception('Error updating order: ' . $stmt->error);
    }

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
