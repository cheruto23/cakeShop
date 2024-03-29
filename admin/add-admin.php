<?php include('partials/menu.php'); ?> 
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>
        <?php
         if (isset($_SESSION['add'])) //checking whether session is set or not
         {
            echo $_SESSION ['add']; //display session message if set
            unset($_SESSION['add']); //remove session message
         }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter your full name"></td>
                </tr>
                <br>

                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Your username">
                    </td>
                </tr>
                <br>

                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="your password">
                    </td>
                </tr>
                <br>

                <tr>
                    <td>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
   //process the value from form and save it database
   //check whether the button is clicked or not
   if(isset($_POST['submit']))
   {
       //button clicked
       //echo "Button Clicked";

       //1.Get data from form
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
       $password = md5($_POST['password']); //password encryption with md5

       //2.SQL query to save data to database
       $sql = "INSERT INTO tbl_admin SET
          full_name = '$full_name',
          username = '$username',
          password = '$password'

       ";

       //3.Executing query and saving data into database
       $res = mysqli_query($conn, $sql) or die(mysql_error());


       //4. Check whether the(Query is executed)data is inserted or not and display appropriate message
       if($res == TRUE)
       {
        //Data inserted]
        //echo "Data inserted";
        //create a session variable to display message
        $_SESSION['add'] = "Admin Added Successfully";

        //Redirect page to manage admin
        header("location:" .SITEURL .'admin/manage-admin.php');
       }
       else{
        //Data not inserted
        //echo"failed to insert data";
         //create a session variable to display message
         $_SESSION['add'] = "Failed to add admin";

         //Redirect page to add admin
         header("location:" .SITEURL .'admin/add-admin.php');
       }

   }

?>