<?php include('includes/header.php'); ?>

 
<main class="user-ptofiles">
    <div class="head">
        <h1>Booking History</h1>

        <form action="" class="form-inline">

            <div class="form-group">
                <input placeholder="User Name" type="text" id="username">
            </div>
            <div class="form-group">
                <input placeholder="Phone" type="text" id="phone">
            </div>
            <div class="form-group">
                <input type="datetime-local" id="dat1">
            </div> &&

             <div class="form-group">
                <input type="datetime-local" id="dat2">
            </div>
           
        </form>
         <div class="form-group">
                <button class="btn g" id="refresh">Refresh</button>
            </div>
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
                        <th class='grid-status'>
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody id="grid-data">
                
                </tbody>
            </table>
        </div>
    </div>

</main>
<script src="js/history.js"></script>
<?php include('includes/footer.php'); ?>