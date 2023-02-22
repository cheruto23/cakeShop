<?php include('partials/menu.php'); ?>

<!--main content section starts here-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Cake</h1>

        <br>

            <!--Button to add cake-->
            <a href="<?php echo SITEURL; ?>admin/add-cake.php" class="btn-primary">Add Cake</a>

            <br> <br>

            <?php

                //isset- check whether variable is set
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            
            ?>


            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php

                    //create sql query to get all the food 
                    $sql = "SELECT *FROM tbl_cake";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    //Count row to check whether we have cakes or not
                    $count = mysqli_num_rows($res);

                    //Create serial number variable and set default value as 1
                    $sn=1;
                    
                    if($count>0)
                    {
                        //we have cakes in database
                        //get the cakes from database and display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get value from individual columns
                            $id =$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];
                            ?>

                            <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <?php
                                            //Check whether we have image name or not
                                            if($image_name =="")
                                            {
                                               // We do not have image, display the message
                                               echo "<div class='error'>Image not added</div>";
                                            }
                                            else
                                            {
                                                //we have image, display image
                                               
                                                ?>
    
                                                <img src="<?php echo SITEURL; ?>images/cake/<?php echo $image_name ?>" width='100px'>
    
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>

                                    <td>
                                    <a href="#" class="btn-secondary">Update Cake</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-cake.php?id= <?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Cake</a>
                                    </td>
                            </tr>


                            <?php

                        }

                    }
                    else
                    {
                        //Cake not added in database
                        echo "<tr><td colspan='7' class='error'>Cake not added yet</td></tr>";
                    }
                
                ?>

                
                           
            </table>
                            
                    </div>
                    </div>
                    <!--main content section ends here-->

<?php include('partials/footer.php'); ?>