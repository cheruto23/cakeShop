<?php
include('partials-frontend/menu.php') ;
// Retrieve the order ID from the form
$order_id = $_POST['order_id'];

// Update the order status to "Cancelled"
$conn = mysqli_connect("localhost", "root", "", "cake-order");
$sql = "UPDATE tbl_order SET status='Cancelled' WHERE id=$order_id";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Display a confirmation message to the user
    echo "Order cancelled successfully!";
} else {
    // Display an error message to the user
    echo "Error cancelling order. Please try again later.";
}
?>
