<?php
  //start session
  session_start();

//create constant to store non repeating values
define('SITEURL', 'http://localhost/cake-shop/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'cake-order');


 //Execute query and save data in database
 $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(my_sqli_error()); //database connection
 $db_select = mysqli_select_db($conn, DB_NAME) or die(my_sqli_error()); //selecting database

?>