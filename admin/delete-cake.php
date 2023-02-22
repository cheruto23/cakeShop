<?php
    //include costants page
    include('../config/constants.php');

    //Check if value is passed on url or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process the delete
        //echo "Process to delete";

        //1.Get id and image name
        $id = $_GET['id'];
        $image_name=$_GET['image_name'];

        //2.remove the image if available
        //check whether image is available or not and delete if only available
        if($image_name !="")
        {
            //It has image and need to remove from folder
            //Get the image path
            $path = "../images/cake/".$image_name;

            //Remove image file from folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                //failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to remove image file</div>";
                //redirect to manage cake
                header('location:'.SITEURL.'admin/manage-cake.php');
                //Stop the process of deleting cakes
                die();
            }
        }
        

        //3.Delete food from database
        $sql = "DELETE FROM tbl_cake WHERE id=$id";
        //execute the query
        $res=mysqli_query($conn, $sql);
        //check whether query is executed or not and set the session messag
         //4.Redirect to manage food with session messagee
        if($res==true)
        {
            //Cake deleted 
            $_SESSION['delete'] = "<div class='success'>Cake deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-cake.php');
        }
        else
        {
            //Failed to delete food
            $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
            header('location:'.SITEURL.'admin/manage-cake.php');
        }

       
    }
    else
    {
        //redirect to manage cake page
        $_SESSION['unauthorized'] = "<div class='error'>Unauthorized access</div>";
        header('location:'.SITEURL.'admin/manage-cake.php');
    }

 ?>