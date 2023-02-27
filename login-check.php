<?php
   //authorization/access control
   //check whether user is logged in or not
   if(!isset($_SESSION['user']))//if user session is not set
   {
       //user not logged in
       //redirect to login page with message
       $_SESSION['no-login-message'] = "<div class='error' text-center>Please Log in to access website<?div>";
       //redirect to login page
       header('location:'.SITEURL.'login.php');
   }


?>