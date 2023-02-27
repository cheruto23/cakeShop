<?php include('config/constants.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Shop</title>
    <!--Link css file-->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!--Navbar section starts here-->
    <section class="navbar">
        <div class="container">
          <!--<div class="logo">
          </div>-->
          <div class="menu text-right">
            <ul>
              <li>
                <a href="<?php echo SITEURL; ?>">Home</a>
              </li>
              <li>
                <a href="<?php echo SITEURL; ?>categories.php">categories</a>
              </li>
              <li>
                <a href="<?php echo SITEURL; ?>cakes.php">Cakes</a>
              </li>
              <li>
                <a href="<?php echo SITEURL; ?>logout.php">Logout</a>
              </li>
              
                
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
    </section>
    <!--Navbar section ends here-->