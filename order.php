<?php include('partials-frontend/menu.php'); ?>

    <!--search section starts here-->
    <section class="cake-search text-center">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Cake</legend>

                    <div class="cake-menu-img">
                        <img src="images/strawberry.jpeg" alt="strawberry cake" class="img-responsive img-curve">
                    </div>
    
                    <div class="cake-menu-description">
                        <h3>Strawberry cake</h3>
                        <p class="cake-price">ksh.1500</p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                    

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Joy Cheruto" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. +254729820967" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. joycheruto213@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                    

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
     
          </div>
    </section>
    <!--Search section ends here-->

    <?php include('partials-frontend/footer.php') ?>