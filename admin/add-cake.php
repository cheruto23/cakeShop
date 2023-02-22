<?php echo include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">

        <h1>Add Cake</h1>

        <br><br>
        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the cake">
                    </td>
                </tr>

                <tr>
                   <td>Description:</td>
                   <td>
                        <textarea name="description"  cols="30" rows="5" placeholder="Description of the cake"></textarea>
                   </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" >

                        <?php
                        
                            //create php code to display categories from database
                            //1.create sql to get all active categories from database
                            //Display on dropdown
                            $sql = "SELECT *FROM tbl_category WHERE active='Yes'";

                            //executing query
                            $res = mysqli_query($conn, $sql);

                            //Count rows to check whether we have categies or not
                            $count = mysqli_num_rows($res);

                            //If count is greater than 0 we have categories else we do not have categories
                            if($count>0)
                            {
                                //we have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the details of category 
                                    $id = $row['id'];
                                    $title=$row['title'];
                                    ?>

                                    <option value="<?php echo $id?>"><?php echo $title; ?></option>

                                    <?php
                                }
                            }
                            else
                            {
                                //we do not have categories
                                ?>

                                    <option value="0">No categories found</option>

                                <?php
                            }
                        
                        ?>


                        </select>
                    </td>
                </tr>

                <tr>
                    <td>featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Cake" class="btn-secondary">
                    </td>
                </tr>

            </table>


        </form>

        <?php
            //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add cake to database
                //echo "clicked";
                //1.Get the data from form 
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category=$_POST['category'];

                //check whether radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //setting default value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //default value
                }

                //2.Upload the image if selected
                //Check whether the select image is clicked or not and upload the image only if the image is selected 
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image 
                    $image_name = $_FILES['image']['name'];

                    //check whether image is selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        //image is selected
                        //Rename the image
                        //get extension of selected image e.g jpeg
                        $ext = end(explode('.' , $image_name));

                        //Create new name for image
                        $image_name = "Cake-Name".rand(0000,9999).".".$ext; //new image name e.g Food-Name-657.jpg"

                        //Upload the image
                        //Get the source path and destination path

                        //Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];
                        
                        //Destination path for image to be uploaded
                        $dst = "../images/cake/".$image_name;

                        //finally upload cake image
                        $upload = move_uploaded_file($src, $dst);

                        //Check whether image is uploaded or not
                        if($upload==false)
                        {
                            //Fail to upload image
                            //Redirect to add cake page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header('location:'.SITEURL.'admin/add-cake.php');
                            //stop the process
                            die();
                        }
                    }

                }
                else
                {
                    $image_name=""; //Setting image value as blank
                }

                //3.Insert into database
                //create sql query to save or add cake
                $sql2 = "INSERT INTO tbl_cake SET
                    title = '$title',
                    description= '$description',
                    price =$price,
                    image_name='$image_name',
                    category_id=$category,
                    featured='$featured',
                    active='$active'
                
                ";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                //check whether is inserted or not
                //4.Redirect with message to manage cake page

                if($res2==true) {
                    //data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Cake added successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-cake.php');
                }
                else
                {
                    //failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to add cake.</div>";
                    header('location:'.SITEURL.'admin/manage-cake.php');
                }

       
            }
        
        ?>


    </div>
</div>


<?php echo include('partials/footer.php'); ?>