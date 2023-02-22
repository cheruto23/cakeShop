<?php
   //Check if value is passed on url or not
   if(isset($_GET['id']) && isset($_GET['image_name']))
   {
    //Process the delete
    echo "Process to delete";
   }
   else
   {
    //redirect to manage cake page
    $_SESSION['delete'] = "<div></div>"
    header('location:'.SITEURL.'admin/delete-cake.php');
   }

 ?>