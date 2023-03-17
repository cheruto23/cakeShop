<?php include('partials/menu.php'); ?>

<!--main content section starts here-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>


        <br> <br>
        <?php

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }


        ?>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Cake</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php

        //Get all orders from database
        $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //Display from latest order at first
        //Execute query
        $res = mysqli_query($conn, $sql);
        //Count the rows
        $count=mysqli_num_rows($res);

        $sn=1; //Serial Number and set its initial values as one

        if($count>0)
        {
            //Order available
            while($row=mysqli_fetch_assoc($res))
            {
                //get all the order details
                $id=$row['id'];
                $cake=$row['cake'];
                $price=$row['price'];
                $qty=$row['qty'];
                $total=$row['total'];
                $order_date=$row['order_date'];
                $status=$row['status'];
                $customer_name=$row['customer_name'];
                $customer_contact=$row['customer_contact'];
                $customer_email=$row['customer_email'];
                $customer_address=$row['customer_address'];
               

                ?>

                    
                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $cake ?>;</td>
                                <td><?php echo $price ?>;</td>
                                <td><?php echo $qty ?>;</td>
                                <td><?php echo $total ?>;</td>
                                <td><?php echo $order_date ?>;</td>
                                <td>
                                    <?php 

                                    //Ordered, on delivery, Delivered, Cancelled
                                if($status=="Ordered")
                                {
                                    echo "<label>$status</label>";
                                }
                                elseif($status=="On Delivery")
                                {
                                    echo "<label style='color: Orange;' >$status</label>";
                                }
                                elseif($status=="Delivered")
                                {
                                    echo "<label style='color: green;' >$status</label>";
                                }
                                elseif($status=="Cancelled")
                                {
                                    echo "<label style='color: red;' >$status</label>";
                                }
                                    
                                    ?>
                                    </td>
                                <td><?php echo $customer_name ?>;</td>
                                <td><?php echo $customer_contact ?>;</td>
                                <td><?php echo $customer_email ?>;</td>
                                <td><?php echo $customer_address ?>;</td>
                               
                                
                        <td>
                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-primary">Update Order</a>
                        </td>
                    </tr>

                <?php
            }
        }
        else
        {
            //Order not available
            echo "<tr><td colspan='12' class='error'>Orders not available</td></tr>";
        }

    ?>
        
   
</table>
                
         </div>
        </div>
        <!--main content section ends here-->

<?php include('partials/footer.php'); ?>