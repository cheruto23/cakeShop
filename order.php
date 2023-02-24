<?php
include('partials-frontend/menu.php') ;
    //Check whether cake id isset or not
    if(isset($_GET['cake_id']))
    {
        //Get the id and details of selected cake
        $cake_id=$_GET['cake_id'];

        //Get details of selected food
        $sql="SELECT * FROM tbl_cake WHERE id=$cake_id";
        //Execute the query
        $res=mysqli_query($conn, $sql);
        //Count the rows
        $count = mysqli_num_rows($res);
        //Check whether data is available or not
        if($count==1)
        {
            //We have data
            //Get data from database
            $row = mysqli_fetch_assoc($res);

            $title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];
        }
        else
        {
            //Cake not available
            //Redirect to homepage
            header('location;'.SITEURL);
        }
    }
    else
    {
        //Redirect to homepage
        header('location:'.SITEURL);
    }
?>

    <!--search section starts here-->
    <section class="cake-search text-center">
        <div class="container">

            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order" >
                <fieldset >
                    <legend>Selected Cake</legend>

                    <div class="cake-menu-img">
                        <?php

                            //Check whether the image is availble or not
                            if($image_name=="")
                            {
                                 //Image is not available
                                 echo "<div class='error'>Image not available</div>";
                                
                            }
                            else
                            {
                                //Image is available
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/cake/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="cake-menu-description">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="cake" value="<?php echo $title; ?>">

                        <p class="cake-price">ksh.<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                    

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <br>
                    <input type="text" name="full-name" placeholder="E.g. Joy Cheruto" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <br>
                    <input type="tel" name="contact" placeholder="E.g. +254729820967" class="input-responsive" required>
                   

                    <div class="order-label">Email</div>
                    <br>
                    <input type="email" name="email" placeholder="E.g. joycheruto213@gmail.com" class="input-responsive" required>
                    

                    <div class="order-label">Address</div>
                    <br>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <br><br>
                    

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                //Check if submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //Get all the details from the form
                    $cake=$_POST['cake'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];

                    $total=$price * $qty;//total= price * quantity

                    $order_date = date("Y-m-d h:i:sa");//Order data
                    
                    $status = ["ordered"]; //ordered,on delivery,delivered,cancelled

                    $customer_name =$_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    //Save the order in database
                    //sql to save the data
                    $sql2 = "INSERT INTO tbl_order SET

                    cake='$cake',
                    price=$price,
                    qty = $qty,
                    total=$total,
                    order_date='$order_date',
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
        
                    ";

                    //echo $sql2; die();

                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);
                    //Check whether query executed successfully or not
                    if($res2)
                    {
                        //query executed and order saved
                        $_SESSION['order'] = "<div class='success'>Cake ordered successfully</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Failed to save order
                        $_SESSION['order'] = "<div class='error'>Failed to order cake</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>
     
          </div>
    </section>
    <!--Search section ends here-->

    <?php include('partials-frontend/footer.php') ?>