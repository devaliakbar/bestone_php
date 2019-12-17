<?php include('includes/header.php'); ?>

<?php
    $q = $_REQUEST["q"];
?>

<main class="user-manage-orders">
    <div class="head">
        <h1>User's Order</h1>

        <form action="" class="form-inline">

        <div class="form-group">
                <input placeholder="Order Id" type="text" id="order_id" value = "<?php echo $q;?>" disabled>
            </div>

        <div class="form-group">
                <input placeholder="User Name" type="text" id="username" disabled>
            </div>
            <div class="form-group">
                <input placeholder="Name" type="text" id="name" disabled>
            </div>
            <div class="form-group">
                <input placeholder="Phone" type="text" id="phone" disabled>
            </div>
            <div class="form-group">
                <input placeholder="email" type="email" id="email" disabled>
            </div>
                <div class="form-group">
                <input placeholder="status" type="text" id="status" disabled>
            </div>
        </form>
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
                        <th class='grid-id'>
                            Item Id
                        </th>
                        <th class='grid-name'>
                            Item Name
                        </th>
                        <th class='grid-cat'>
                            Category
                        </th>
                        <th class='grid-man'>
                            Brand
                        </th>
                        <th class='grid-price'>
                            Price
                        </th>
                        <th class='grid-qty'>
                            Qty
                        </th>
                        <th class='grid-total'>
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody id="grid-data">
                    
                </tbody>
            </table>
        </div>
        <div class="btn-group">
            <button class="btn d" id = "del">Delete Order</button>
            
        </div>
    </div>

</main>
<script src="js/manageOrder.js"></script>
<?php include('includes/footer.php'); ?>