<?php include('partials-frontend/menu.php'); ?>

    <!--search section starts here-->
    <section class="cake-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>cake-search.php" method="POST">
              <input type="search" name="search" placeholder="search for cake">
              <input type="submit" name="submit" value="search" class="btn btn-primary">
            </form>
          </div>
    </section>
    <!--Search section ends here-->

    <!--Cake menu section starts here-->
    <section class="cake-menu">
        <div class="container">
            <h2 class="text-center">Cake Menu</h2>

            <?php

            //display food that are active
            $sql = "SELECT *FROM tbl_cake WHERE active='Yes' AND featured='Yes' ";

            //Execute the query
            $res=mysqli_query($conn, $sql);
            
            //Count rows
            $count=mysqli_num_rows($res);

            //Check whether the cakes are available or not
            if($count>0)
            {
              //Cake available
              while($row=mysqli_fetch_assoc($res))
              {
                //get the values
                $id=$row['id'];
                $title=$row['title'];
                $description=$row['description'];
                $price=$row['price'];
                $image_name=$row['image_name'];
                ?>

                <div class="cake-menu-box">
                    <div class="cake-menu-img">
                      <?php

                        //Check whether image is available or not
                        if($image_name=="") 
                      {
                        //Image not available
                        echo "<div class='error'>Image not available</div>";
                      }
                        else
                        {
                          //Image available
                          ?>
                            <img src="<?php echo SITEURL; ?>images/cake/<?php echo $image_name;?>"  class="img-responsive img-curve">
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
                      <a href="order.php" class="btn btn-primary">order now</a>
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
        </div>
    </section>
    <!--cake menu section ends here-->

    <?php include('partials-frontend/footer.php') ?>