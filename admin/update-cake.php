<?php include('partials/menu.php');?>

<div class="main-content">
        <div class="wrapper">
            <h1>Update Cake</h1>
            <br>

<?php
    //Check whether id is set or not
    if(isset($_GET['id']))
    {
        //get all the details
        $id=$_GET['id'];

        //sql query for selected cake
        $sql2="SELECT * FROM tbl_cake WHERE id=$id";
        //Execute the query
        $res2=mysqli_query($conn, $sql2);

        //Count number of rows
        $count=mysqli_num_rows($res2);
        
        if($count==1)
        {

        //Get the value based on query executed
        $row2=mysqli_fetch_assoc($res2);

        //Get individual value of selected cakes
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else
    {
        //Redirect to manage cake
        $_SESSION['no-category-found'] = "<div class='error'>Cake not found. </div>";
        header('location'.SITEURL.'admin/manage-cake.php');
    }
?>

    

            <form action="" method="POST" enctype="multipart/form-data">
                <table tbl-30>
                    <tr>
                    <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>

                <tr>
                   <td>Description:</td>
                   <td>
                        <textarea name="description"  cols="30" rows="5"> <?php echo $description; ?></textarea>
                   </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value=<?php echo $price ?>>
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                       <?php
                            if($current_image !=="")
                            {
                                //Image available
                                 ?>
                                <img src="<?php echo SITEURL; ?>images/cake/<?php echo $current_image; ?>" width="100px" >
             
                                <?php
                                
                            }
                            else
                            {
                                //image not available
                                echo "<div class='error'>Image not available</div>";
                   
                            }
                       
                       ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" >
                            <?php
                                //Query to get active data categories
                                $sql="SELECT *FROM tbl_category WHERE active='Yes'";
                                //Execute the query
                                $res=mysqli_query($conn, $sql);
                                //Count rows
                                $count=mysqli_num_rows($res);

                                //Check whether categories are available or not
                                if($count>0)
                                {
                                    //Categories available
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $category_title=$row['title'];
                                        $category_id=$row['id'];

                                        //echo "<option value='$category_id'>$category_title</option>";
                                        ?>
                                        <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //Category is not available
                                    echo "<option value='0'>Category not available</option>";
                                }
                            
                            ?>

                            
                        </select>
                    </td>

                    </tr>

                    <tr>

                        <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}  ?>  type="radio" name="featured" value="Yes">Yes

                        <input <?php if($featured=="No"){echo "checked";}  ?>  type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>

                    <input <?php if($active=="Yes"){echo "checked";}  ?>  type="radio" name="active" value="Yes">Yes

                    <input <?php if($active=="No"){echo "checked";}  ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                            
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="Update Cake" class="btn-secondary">
                    </td>

                </tr>

                </table>

            </form>

            <?php

                //Check whether button is clicked
                if(isset($_POST['submit']))
                {
                    //echo "Clicked";

                    //1.Get all the details from the form
                    $id=$_POST['id'];
                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];
                    $current_image=$_POST['current_image'];
                    $current_category=$_POST['category'];
                    $featured=$_POST['featured'];
                    $active=$_POST['active'];
                

                    //2.Upload the image if selected

                    //Check whether upload button is clicked or not
                    if(isset($_FILES['image']['name']))
                    {
                        //Upload button clicked
                        $image_name = $_FILES['image']['name']; //New image name

                        //Check if file is available or not
                        if($image_name !="")
                        {
                            //Image is available
                            //A.Uploading new image
                            $ext=pathinfo($image_name, PATHINFO_EXTENSION); //Get extension of the image

                            //rename the image
                            $image_name= "Cake-Name-".rand(0000,9999).'.'.$ext; 

                            //Get the source path and destination path
                            $source_path = $_FILES['image']['tmp_name']; //source path
                            $dst_path = "../images/cake/"."$image_name"; //destination path

                            //Upload the image
                            $upload = move_uploaded_file($source_path, $dst_path);

                            //Check whether image is uploaded or not
                            if(!$upload)
                            {
                                //Failed to upload
                                $_SESSION['upload'] = "<div class='error'>Failed to upload new image</div>";
                                //redirect to manage cake page
                                header('location:'.SITEURL.'admin/manage-cake.php');
                                //stop the process
                                die();
                            }

                            $get_current_image="SELECT image_name FROM tbl_cake WHERE id=$id LIMIT 1";
                            //Execute the query
                          
     
                            $result =  mysqli_query($conn, $get_current_image);
     
                            if (mysqli_num_rows($result) > 0) {
                             $row = mysqli_fetch_array($result);
                             $imagename= $row["image_name"];
                             echo "Image Name: " .  $imagename;
                         } else {
                             echo "No results found";
                         }

                            //3.Remove the image if new image is uploaded and current image exists
                            //B.remove current image if available
                            if($current_image!="")
                            {
                                //Current image is available
                                //Remove the image
                                $remove_path = "..images/cake".$imagename;

                                $remove = unlink($remove_path);

                                //Check whether the image is removed or not
                                if(!$remove){
                                    //failed to remove current image
                                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image</div>";
                                    //redirect to ,anage cakes
                                    header('location:'.SITEURL.'admin/manage-cake.php');
                                    //stop the process
                                    die();
                                }
                            }
                            
                        }
                        else
                        {
                            //$image_name = $current_image; //Default image when image is not selected
                        }
                    }
                    else
                    {
                        //$image_name = $current_image; //Default image when button is not clicked
                    }

                   
                    //4.Update the cake in database
                    $sql3 = "UPDATE tbl_cake SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = 'category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id

                    ";

                    //Execute the sql query
                    $res3 = mysqli_query($conn, $sql3);

                    //category updated
                    $_SESSION['update'] = "<div class='success'>Cake updated successfully</div>";
                    header('location:'.SITEURL.'admin/manage-cake.php');

                   


                }
            }

            ?>

        </div>
    </div>

<?php include('partials/footer.php') ?>;