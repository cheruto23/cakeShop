
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

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $message_id = $_POST["message_id"];
    $message = $_POST["message"];
    $response = $_POST["response"];

    // Update message and response in database
    $sql = "UPDATE chatbot_messages SET message='$message', response='$response' WHERE id=$message_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: view.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Get message id from query parameter
if (isset($_GET["id"])) {
    $message_id = $_GET["id"];

    // Retrieve message and response from database
    $sql = "SELECT * FROM chatbot_messages WHERE id=$message_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $message = $row["message"];
        $response = $row["response"];
    } else {
        echo "No message found with id $message_id";
        exit;
    }
} else {
    echo "Message id not specified";
    exit;
}

mysqli_close($conn);

?>
<div class="main-content">
    <div class="wrapper">


<!DOCTYPE html>
<html>
<head>
    <title>Edit Chatbot Message</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

    <h1>Edit Chatbot Message</h1>

    <form method="POST">
        <input type="hidden" name="message_id" value="<?php echo $message_id; ?>">
        <div>
            <label for="message">Message:</label>
            <input type="text" id="message" name="message" value="<?php echo $message; ?>">
        </div>
        <br>
        <div>
            <label for="response">Response:</label>
            <textarea id="response" name="response"><?php echo $response; ?></textarea>
        </div>
        <br>
        <button type="submit" class="btn-secondary">Update Message</button>
    </form>

    <br><br>
    <a href="view.php" class="btn-secondary">Back to Messages</a>

</body>
</html>
<br>
</div>
</div>



<?php include('partials/footer.php'); ?>
