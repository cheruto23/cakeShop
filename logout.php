<?php
   //include constants.php for SITEURL
   include('./config/constants.php');
   //1.destroy the session
   session_destroy(); //unset $_SESSION['user]


   //2.Page redirect to login page
   header('location:'.SITEURL.'login.php');
?>