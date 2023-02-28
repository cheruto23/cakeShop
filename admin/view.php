<?php include('partials/menu.php');?>
<?php

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cake-order";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Retrieve messages and responses from the database
$sql = "SELECT * FROM chatbot_messages";
$result = mysqli_query($conn, $sql);

?>
<div class="main-content">
    <div class="wrapper">

   
<div class="view" >

<!DOCTYPE html>
<html>
<head>
    <title>View Chatbot Messages</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

    <h1>Chatbot Messages</h1>
    <a href="add.php">Add New Message</a>

    <table>
        <tr>
            <th>Message</th>
            <th>Response</th>
            <th>Action</th>
        </tr>
        <?php
        // Display messages and responses from the database
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row["message"]."</td>";
                echo "<td>".$row["response"]."</td>";
                echo "<td><a href='edit.php?id=".$row["id"]."'>Edit</a>  <a href='delete.php?id=".$row["id"]."'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No messages found.</td></tr>";
        }
        ?>
    </table>

    <br><br>
  

</body>
</html>
</div>
</div>
</div>