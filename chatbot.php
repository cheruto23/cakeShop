<?php include('partials-frontend/menu.php'); ?>
<div class="chatbot">

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

// Retrieve messages and responses from the database
$sql = "SELECT * FROM chatbot_messages";
$result = mysqli_query($conn, $sql);
$responses = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $message = $row["message"];
        $response = $row["response"];
        $responses[$message] = $response;
        $user_input=$row["user_input"];
    }
}

// Define default bot response
$bot_response = "Welcome to our bakery! How can I assist you today?";

// Handle user input
if (isset($_POST["user_input"])){
    $user_input = $_POST["user_input"];
    if (!empty($user_input)) {
        // Check if the user input matches any of the messages in the database
        if (array_key_exists($user_input, $responses)) {
            $bot_response = $responses[$user_input];
        } else {
            // If the user input doesn't match any of the messages in the database, provide a default response
            $bot_response = "I'm sorry, I didn't understand your request. Please try again.";
            
            // Check if the user input contains a specific keyword
            if (strpos($user_input, 'cake') !== false) {
                // Insert a message into the database
                $insert_query = "INSERT INTO chatbot_messages (message, response) VALUES ('$user_input', 'Which type of cake do you need.')";
                mysqli_query($conn, $insert_query);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Bakery Chatbot</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="chat">
    <h1>Bakery Chatbot</h1>
    <?php
    // Display user input
    if (!empty($user_input)) {
        echo "<div class='user-message'>$user_input</div>";
    }
    // Display bot response
    echo "<div class='bot-message'>$bot_response</div>";
    ?>
    <form method="post" action="">
        <input type="text" name="user_input" placeholder="Type your message here...">
        <button type="submit">Send</button>
    </form>
</div>

</div>

</body>
</html>




