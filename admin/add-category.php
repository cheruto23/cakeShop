<?php include('partials/menu.php') ?>;

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

    <br><br>

    <?php
     
       if(isset($_SESSION['add']))
       {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
       }

       if(isset($_SESSION['upload']))
       {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
       }

    ?>

    <br><br>

    <!--Add Category form starts here-->
    <form action="" method="POST" enctype="multipart/form-data">

    <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td>
                <input type="text" name="title" placeholder= "category title">
            </td>
        </tr>

        <tr>
            <td>Select Image</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>featured</td>
            <td>
                <input type="radio" name="featured" value="Yes"> Yes
                <input type="radio" name="featured" value="No"> No
            </td>
        </tr>

        <tr>
            <td>Active</td>
            <td>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
            </td>
        </tr>

    </table>

    </form>
    <!--Add Category form ends here-->

    <?php
      
      //check whether the submit button is clicked or not
      if(isset($_POST['submit']))
      {
        //echo "clicked";

        //1.get value from form
        $title=$_POST['title'];

        //For radio input type, we need to check whether the button is selected or not
        if(isset($_POST['featured']))
        {
            //Get value from form
            $featured=$_POST['featured'];
        }
        else
        {
            //Set the default value
            $featured="No";
        }

        if(isset($_POST['active']))
        {
            //Get value from form
            $active=$_POST['active'];
        }
        else
        {
            //Set the default value
            $active="No";
        }

        //check whether the image is selected or not and set the value for image name accordingly
        //print_r($_FILES['image']);
        
        //die();//break the code here

        if(isset($_FILES['image'] ['name']))
        {
            //upload the image
            //To upload image we need image name, source path and destination path
            $image_name = $_FILES['image']['name'];

            //Renaming image
            //Get extension of image(jpg,png)
            $ext = end(explode('.',$image_name));
            
            //rename image
            $image_name = "".rand(000,999).'.'.$ext;

            $source_path =$_FILES['image']['tmp_name'];

            $destination_path= "../images/category/"."$image_name";

            //Finally uload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check whether image is uploaded or not
            //And if image is not uploaded, then we will stop the process and redirect with error message
            if($upload==false)

            {
                //set message
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                //Redirect 
                header('location:'.SITEURL.'admin/add-category.php');
                //stop the process
                die();
            }
        }
        else
        {
            //dont upload image and set image name value as blank
            $image_name="";
        }




                   /* /// Get reference to uploaded image
                    $image_file = $_FILES["image"];

                    // Exit if no file uploaded
                    if (!isset($image_file)) {
                        die('No file uploaded.');
                    }

                    // Exit if is not a valid image file
                    $image_type = exif_imagetype($image_file["tmp_name"]);
                    if (!$image_type) {
                        die('Uploaded file is not an image.');
                    }

                    // Move the temp image file to the images/ directory
                    move_uploaded_file(
                        // Temp image location
                        $image_file["tmp_name"],

                        // New image location
                        __DIR__ . "/images/category" . $image_file["name"]
                    );*/

                


        //Create sql query to insert category into database
        $sql="INSERT INTO tbl_category SET 
        title='$title',
        image_name = '$image_name',
        featured='$featured',
        active='$active'
        
        ";
        //Execute the query and save in database
        $res=mysqli_query($conn, $sql);

        //cgheck whether query is executed or not
        if($res==true)
        {
            //Query executed and category added
            $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
            //Redirect to manage Category page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            //failed to add category
            $_SESSION['add'] = "<div class='error'>Failed To Add category</div>";
            //Redirect to manage Category page
            header('location:'.SITEURL.'admin/add-category.php');

        }
      }
    
    ?>

    </div>
</div>


<?php include('partials/footer.php') ?>;