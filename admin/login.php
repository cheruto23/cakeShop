<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>Login- Cake Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                   echo $_SESSION['login'];
                   unset($_SESSION['login']);
                }

                if(isset( $_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br>


            <!--login form starts here-->
            <form action="" method="POST" class="text-center">
                username: <br>
                <input type="text" name="username" placeholder="Enter Username"> <br><br>

                password: <br>
                <input type="password" name="password" placeholder="Enter Password"> <br><br>

                <input type="submit" name="submit" value="login" class="btn-primary"> <br><br>
            </form>
            <!--login form ends here-->

            <p class="text-center">Created by - <a href="www.joy.com">joy</a></p>
        </div>
    </body>
</html>

<?php

  //check whether the submit button is clicked or not
  if(isset($_POST['submit']))
  {
    //Process for login
    //1.get data from login form
    $username=$_POST['username'];
    $password= md5($_POST['password']);

    //2.sql to check whether the user with username and password exist or not
    $sql ="SELECT *FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3.execute the query
    $res =mysqli_query($conn, $sql);

    //4.count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    //check if the user exists or not
    if($count==1)
    {
        //user available and login success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; //to check whether the user is login or not and logout will unset it

        //redirect to homepage
        header('location:' .SITEURL .'admin/');

    }
    else{
        //user not available and login fail
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        header('location:' .SITEURL .'admin/login.php');
        
    }

  }

?>