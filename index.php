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

    <?php

        if(isset($_SESSION['order']))
        {
          echo $_SESSION['order'];
          unset($_SESSION['order']);
      }

    ?>

    <!--Category section starts here-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Cakes</h2>

            <?php

              //Create sql query to display categories from database
              $sql = "SELECT *FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
              //Execute the query
              $res = mysqli_query($conn, $sql);

              //Count rows to check whether the category is available or not
              $count = mysqli_num_rows($res);

              if($count>0)
              {
                //Categories available
                while ($row=mysqli_fetch_assoc($res))
                {
                  //get values like title,image name and id
                  $id = $row['id'];
                  $title=$row['title'];
                  $image_name=$row['image_name'];
                  ?>

                    <a href="<?php echo SITEURL; ?>category-cakes.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">

                          <?php 

                            //Check whether image is available or not
                            if($image_name=="")
                            {
                              //Display message
                              echo "<div class='error'> Image not available</div>";
                            }
                            else
                            {
                              //Image available
                              ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                              <?php
                            }

                          ?>

                          <h3 class="float-text"><?php echo $title; ?></h3>

                        </div>
                     </a>

                  <?php
                }
              }
              else
              {
                //categories not available
                echo "<div class='error'>Category not added</div>";
              }

            ?>
            
          
            <div class="clearfix"></div>
          </div>
    </section>
    <!--Category section ends here-->

    <!--Cake menu section starts here-->
    <section class="cake-menu">
        <div class="container">
            <h2 class="text-center">Cake Menu</h2>

            <?php

            //Getting cakes from database that are active and featured
            $sql2 = "SELECT *FROM tbl_cake WHERE active='Yes' AND featured='Yes' LIMIT 3 ";
            //Execute the query
            $res2 = mysqli_query($conn, $sql2);

            //Count rows
            $count2 = mysqli_num_rows($res2);

            //Check if cake is available or not
            if($count2>0){
              //Cake available
              while($row=mysqli_fetch_assoc($res2))
              {
                //get all the values
                $id=$row['id'];
                $title=$row['title'];
                $price=$row['price'];
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
                      <p class="cake-price">ksh.<?php echo $price; ?></p>
                      <p class="cake-details">
                          <?php echo $description; ?>
                      </p>
                      <br>
                    <a href="<?php echo SITEURL; ?>order.php?cake_id=<?php echo $id; ?>" class="btn btn-primary">order now</a>
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

   