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


    <!--Category section starts here-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Cakes</h2>
            <br><br>

            <?php

                //Display all the categories that are active
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check whether categories are available or not
                if($count>0)
                {
                  //Category is available
                  //get all data from database
                  while($row=mysqli_fetch_assoc($res))
                  {
                    //Get the values
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                       <a href="category-cakes.php">
                          <div class="box-3 float-container">
                            
                            <?php
                              if($image_name=="")
                              {
                                //Image not available
                                echo "<div class='error'>Image not found</div>";
                              }
                              else
                              {
                                //Image available
                                ?>
                                  <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"  class="img-responsive img-curve">
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
                  //category is not available
                  echo "<div class='error'>Category not found</div>";
                }

            ?>


           
            
            <div class="clearfix"></div>
          </div>
    </section>
    <!--Category section ends here-->

    <?php include('partials-frontend/footer.php') ?>