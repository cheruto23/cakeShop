<?php include('partials-frontend/menu.php'); ?>
<div class="tracking text-center">
<?php
// Retrieve all order details from the database
$conn = mysqli_connect("localhost", "root", "", "cake-order");
$sql = "SELECT * FROM tbl_order ORDER BY id DESC";
$res = mysqli_query($conn, $sql);

// Check if there are any orders
if (mysqli_num_rows($res) > 0) {
    echo "<p>Here are your previous orders:</p>";
    echo "<table>";
    echo "<tr>
    <th>Order ID</th>
    <th>Cake type</th>
    <th>Quantity</th>
    <th>Total</th>
    <th>Order date</th>
    <th>Status</th>
    <th>Cancel</th>
    </tr>";
    
    while ($order = mysqli_fetch_assoc($res)) {
        $orderDetails = $order['id'];
        $cake = $order['cake'];
        $qty=$order['qty'];
        $total = $order['total'];
        $order_date = $order['order_date'];
        $orderStatus = $order['status'];
        
        // Display the order details in a table row
        echo "<tr>";
        echo "<td>".$orderDetails."</td>";
        echo "<td>".$cake."</td>";
        echo "<td>".$qty."</td>";
        echo "<td>".$total."</td>";
        echo "<td>".$order_date."</td>";
        echo "<td>".$orderStatus."</td>";
        
        // Add a "Cancel Order" button if the order status is "ordered"
        if ($orderStatus == 'ordered') {
            echo '<td>';
            echo '<form method="post" action="cancel_order.php">';
            echo '<input type="hidden" name="order_id" value="'.$orderDetails.'">';
            echo '<button type="submit" name="cancel_order">Cancel Order</button>';
            echo '</form>';
            echo '</td>';
        } else {
            echo '<td></td>';
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>You haven't placed any orders yet.</p>";
}
?>
</div>





