<?php include('includes/header.php');?>


<main class="homepage">

    <header>
        <section class="logo"><img src="images/logo-w.png" alt=""></section>
    </header>

    <div class="btn-group text-center">
        <button class="btn w" onClick="window.open('product-add.php')">Add Item</button> 
        <button class="btn w" onClick="window.open('product-stock.php')">View Item</button> 
        <button class="btn w" onClick="window.open('user-current-bookings.php')">View Current Booking</button> 
        <button class="btn w" onClick="window.open('cancel_booking.php')">View Canceled Booking</button> 
        <button class="btn w" onClick="window.open('upload')">Upload Image</button> 
        <button class="btn w" onClick="window.open('user-bookings-history.php')">View Past Booking</button> 
         <button class="btn w" onClick="window.open('user-profiles.php')">View All Customer Profile</button> 
		 <button class="btn w" onClick="window.open('product-add-offer.php')">Add Banner Message</button> 
    </div>

</main>

<?php
include('includes/footer.php');
?>