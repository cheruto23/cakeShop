<?php

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cake-order";

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the message ID from the URL parameter
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Delete the message from the database
    $sql = "DELETE FROM chatbot_messages WHERE id='$id'";
    mysqli_query($conn, $sql);

    // Redirect to the view page
    header("Location: view.php");
} else {
    // If no message ID is provided, redirect to the view page
    header("Location: view.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    
</body>
</html>
