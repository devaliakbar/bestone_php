<?php include('includes/header.php'); ?>


<main class="user-ptofiles">
    <div class="head">
        <h1>Current Bookings</h1>
    </div>

    </div>


    <div class="content">
        <div class="table-wrapper">
            <table border="1">
                <thead>
                    <tr>
                        <th class='grid-slno'>
                            Sl No.
                        </th>

                        <th class='grid-order-id'>
                            Order Id
                        </th>

                        <th class='grid-username'>
                            User name
                        </th>
                        <th class='grid-date'>
                            Date
                        </th>
                        <th class='grid-items'>
                            No. Of Items
                        </th>
                        <th class='grid-total'>
                            Amount
                        </th>
                        <th class='grid-msg'>
                            Message
                        </th>
                    </tr>
                </thead>
                <tbody id="grid-data">
                
                </tbody>
            </table>
        </div>
    </div>

</main>
<audio id="audio" src="sound/zuck.wav" autoplay="false" style="visibility: hidden;"></audio>
<script src="../js/current_booking.js"></script>
<?php include('includes/footer.php'); ?>