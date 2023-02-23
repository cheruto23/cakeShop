<?php include('partials-frontend/menu.php'); ?>

<?php
    //Check whether id is passed or not
    if(isset($_GET['category_id']))
    {
      //Category id is set and get the id
      $category_id = $_GET['category_id'];
      //Get category title based on category id
      $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

      //Execute the query
      $res = mysqli_query($conn, $sql);

      //Get the value from database
      $row = mysqli_fetch_assoc($res);
      //Get the title
      $category_title = $row['title'];
    }
    else
    {
      //Category not passed 
      //Redirect to homepage
      header('location:'.SITEURL);
    }
?>

    <!--search section starts here-->
    <section class="cake-search text-center">
        <div class="container">

            <h2>Cakes on <a href="" class="text-white">"<?php echo $category_title; ?></a></h2>

          </div>
    </section>
    <!--Search section ends here-->

    <!--Cake menu section starts here-->
    <section class="cake-menu">
        <div class="container">
            <h2 class="text-center">Cake Menu</h2>

            <?php
                //Sql query to get cake based on selected category
                $sql2 = "SELECT *FROM tbl_cake WHERE category_id=$category_id";

                //Execute the query 
                $res2 = mysqli_query($conn, $sql2);

                //Count the rows
                $count2 = mysqli_num_rows($res2);

                //Check whether cake is available or not
                if($count2>0)
                {
                  //cake is available
                  while($row2=mysqli_fetch_assoc($res2))
                  {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price= $row2['price'];
                    $description= $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>

                      <div class="cake-menu-box">
                          <div class="cake-menu-img">
                            <?php
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
                  //cake not available
                  echo "<div class='error'>Cake not available</div>";
                }
            ?>

            
            <div class="clearfix"></div>
          </div>
        
    </section>
    <!--cake menu section ends here-->
    
  <?php include('partials-frontend/footer.php') ?>