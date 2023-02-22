<?php include('partials-frontend/menu.php'); ?>

    <!--search section starts here-->
    <section class="cake-search text-center">
        <div class="container">
            <form action="">
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

            //Getting cakes from database that are active and fetured
            $sql2 = "SELECT *FROM tbl_cake WHERE featured='Yes' AND active='Yes' LIMIT 6";
            //Execute the query
            $res2 = mysqli_query($conn, $sql2);

            //Count rows
            $count2 = mysqli_num_rows($res2);

            //Check if cake is available or not
            if($count2>2){
              //Cake available
              while($row=mysqli_fetch_assoc($res2))
              {
                //get all the values
                $id=$row['id'];
                $title=$row['title'];
                $price=$row[price];
                $description=$row['description'];
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
                         <img src="<?php echo SITEURL; ?>images/cake/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                        <?php
                      }
                    
                    ?>
                   
                    </div>

                    <div class="cake-menu-description">
                      <h4><?php echo $title; ?></h4>
                      <p class="cake-price"><?php echo $price; ?></p>
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
              echo "<div class='error'>Cake not available</div>";
            }

            ?>

          
            
            <div class="clearfix"></div>
          </div>
        
    </section>
    <!--cake menu section ends here-->
    
  <?php include('partials-frontend/footer.php') ?>