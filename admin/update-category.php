<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update category</h1>

        <br><br>
        <?php
        
        //Check whether id is set or not
        if(isset($_GET['id']))
        {
            //get id and all other details
            //echo "Getting data";
            $id =$_GET['id'];

            //Create sql query to get all other details
            $sql="SELECT * FROM tbl_category WHERE id=$id";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //Get all data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else
            {
                //redirect to manage category with session message
                $_SESSION['no-category-found'] = "<div class='error'>Category not found. </div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php 
                            if($current_image !="")
                            {
                                //Display image
                                ?>

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" width="150px">;

                                <?php
                            }
                            else
                            {
                                //display message
                                echo "<div class='error'>Image not added</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}  ?> type="radio" name="featured" value="Yes">Yes

                        <input <?php if($featured=="No"){echo "checked";}  ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                    <input <?php if($active=="Yes"){echo "checked";}  ?> type="radio" name="active" value="Yes">Yes

                    <input <?php if($active=="No"){echo "checked";}  ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
            
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //Get all the values from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //updating new image if selected
               //Check whether image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get image details
                    $image_name=$_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($image_name !="")
                    {
                        //image available
                        //Upload new image

                        //Renaming image
                        //Get extension of image(jpg,png)
                       // $ext = end(explode('.',$image_name));
                        $ext=pathinfo($image_name, PATHINFO_EXTENSION);
                        
                        //rename image
                        $image_name = "Category-Name-".rand(0000,9999).'.'.$ext; //Gets extension of the image

                        $source_path =$_FILES['image']['tmp_name'];

                        $destination_path= "../images/category/"."$image_name";

                        //Finally upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check whether image is uploaded or not
                        //And if image is not uploaded, then we will stop the process and redirect with error message
                        if(!$upload)

                        {
                            //set message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            //Redirect 
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop the process
                            die();
                        }
                    }

                    $get_current_image="SELECT image_name FROM tbl_category WHERE id=$id LIMIT 1";
                       //Execute the query
                     

                       $result =  mysqli_query($conn, $get_current_image);

                       if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);
                        $imagename= $row["image_name"];
                        echo "Image Name: " .  $imagename;
                    } else {
                        echo "No results found";
                    }

                        //Remove current image, if available
                        if($current_image != "")
                        {

                            $remove_path = "../images/category/".$imagename;
                            $remove = unlink($remove_path);

                        }
                        

                       //Check whether image is removed or not. 
                        //If failed to remove display message and stop the process
                        if(!$remove)
                        {
                            //failed to remove the image
                            $_SESSION['failed-remove'] = "<div class= 'error'>Failed to remove current image</div>  $imagename";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }
                        else
                        {
                            //$image_name = $current_image;

                            //update the database
                                    $sql2 = "UPDATE tbl_category SET
                                    title = '$title',
                                    image_name = '$image_name',
                                    featured = '$featured',
                                    active = '$active'
                                    WHERE id=$id
                                
                                
                                ";
                                //Execute the query
                                $res2 = mysqli_query($conn, $sql2);                                           

                                   //category updated
                    $_SESSION['update'] = "<div class='success'>Category updated successfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');



                            
                        }
                        
                    }            
                         
              
            }

            
            
        
        ?>


    </div>
</div>


<?php include('partials/footer.php') ?>;