<?php include('partials-frontend/menu.php'); ?>
<div class="tracking text-center">
<?php
// Retrieve the order details and status from the database
$conn = mysqli_connect("localhost", "root", "", "cake-order");
 //Get all orders from database
 $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //Display from latest order at first
 //Execute query
 $res = mysqli_query($conn, $sql);
 //Count the rows
 $count=mysqli_num_rows($res);

 $sn=1; //Serial Number and set its initial values as one

$order = mysqli_fetch_assoc($res);
$orderDetails = $order['id'];
$cake = $order['cake'];
$qty=$order['qty'];
$total = $order['total'];
$order_date = $order['order_date'];
$orderStatus = $order['status'];
$customer_name=$order['customer_name'];
$customer_contact=$order['customer_contact'];
$customer_email=$order['customer_email'];
$customer_address=$order['customer_address'];

// Display a message to the user with the order details and status
echo "<p>Thank you for your order! Your order details are as follows:</p>";
echo "<p> Your id is:" .$orderDetails . "</p>";
echo "<p> Cake type:" . $cake . "</p>";
echo "<p> Quantity:" . $qty . "</p>";
echo "<p> Total:" . $total . "</p>";
echo "<p> Order date:" . $order_date . "</p>";
echo "<p> Name:" . $customer_name . "</p>";
echo "<p> Contact:" . $customer_contact . "</p>";
echo "<p> Email:" . $customer_email . "</p>";
echo "<p> address:" . $customer_address . "</p>";
echo "<p>Your order status is: " . $orderStatus . "</p>";
?>
</div>