<?php

  //include constants.php file here
  include('../config/constants.php');
  // 1.Get the ID of admin to be deleted
  $ID = $_GET['id'];

  //2. Create sql query to delete admin
  $sql = "DELETE FROM tbl_admin WHERE id=$ID";

  //Execute the query
  $res = mysqli_query($conn, $sql);

  //check whether the query executed successfully or not
  if($res==TRUE)
  {
    //query executed successfully and admin deleted
    //echo "Admin Deleted";
    //create session variable to display message
    $_SESSION['delete'] = "<div class='success'>Admin successfully Deleted.</div>";
    //Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
  }
  else
  {
    //failed to delete admin
    //echo "failed to delete admin";
    $_SESSION['delete'] = "<div class='error'>failed to delete admin. Try again later.<?div>";
    header('location:'.SITEURL.'admin/manage-admin');
  }


?>