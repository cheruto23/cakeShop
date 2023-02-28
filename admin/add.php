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

// Handle form submission
if (isset($_POST['submit'])) {
    $message = $_POST['message'];
    $response = $_POST['response'];

    // Insert new message and response into database
    $sql = "INSERT INTO chatbot_messages (message, response) VALUES ('$message', '$response')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to view.php
        header("Location: view.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
<div class="main-content">
    <div class="wrapper">


<!DOCTYPE html>
<html>
<head>
    <title>Add New Chatbot Message</title>
    
</head>
<body>

    <h1>Add New Chatbot Message</h1>
    <link rel="stylesheet" href="../css/admin.css">

    <form method="post">
        <label for="message">Message:</label><br>
        <input type="text" name="message"><br><br>

        <label for="response">Response:</label><br>
        <input type="text" name="response"><br><br>

        <input type="submit" name="submit" value="Add Message" class="btn-secondary">
    </form>

</body>
</html>

</div>
</div>

<br>
<?php include('partials/footer.php'); ?>
