<?php include('partials-frontend/menu.php'); ?>

    <!--search section starts here-->
    <section class="cake-search text-center">
        <div class="container">
            <?php 
                 //Get the search keyword
                 //mysqli_real_escape_string protects data from sql injections
                 $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            <h2>cakes on your search <a href="#" class="text-white"><?php echo $search; ?></a></h2>
          </div>
    </section>
    <!--Search section ends here-->

     <!-- fOOD MEnu Section Starts Here -->
     <section class="cake-menu">
        <div class="container">
            <h2 class="text-center">Cake Menu</h2>

            <?php


                //sql query to get cake based on search keyword
                // "SELECT * FROM tbl_cake WHERE title LIKE '%%' OR description LIKE '%%'"
                $sql = "SELECT *FROM tbl_cake WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //Check whether cake is available or not
                if($count>0)
                {
                    //cake available
                    //get details from database in array format

                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                            <div class="cake-menu-box">
                                <div class="cake-menu-img">
                                    <?php
                                        //Check whether image name is available or not
                                        if($image_name=="")
                                        {
                                            //Image not available
                                            echo "<div class='error'>Image not available</div>";
                                        }
                                        else
                                        {
                                            //Image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/cake/<?php $image_name ?>"  class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>

                                    
                                </div>

                                <div class="cake-menu-description">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="cake-price">ksh.<?php echo $price; ?></p>
                                    <p class="cake-details">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="order.php" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php
                    }
                }
                else
                {
                    //Cake not available
                    echo "<div class='error'>Cake not found</div>";
                }

            ?>

            

          
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->



    <?php include('partials-frontend/footer.php') ?>