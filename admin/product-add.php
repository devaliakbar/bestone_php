<?php include('includes/header.php'); ?>

<main class="product-booking">

    <div class="head">
        <h1>Add Item</h1>
    </div>

    <div class="content">

        <form action="" class="center">

            <div class="form-group">
                <label for="name">Item name</label>
                <input id="name" type="text">
            </div>
            <div class="form-group">
                <label for="brand">Brand</label>
                <input id="brand" type="text">
            </div>
            <div class="form-group">
                <label for="categ">Category</label>
                <select id="e1">
                  
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input id="price" type="number">
            </div>
            <input type="button" class="btn g" value="Add" id="add">
        </form>
    </div>
</main>
<h2>Add Category</h2>
<input type="text" id="ade">
<br>
<input type="button" id="adde" value="add">
<script src="js/add.js"></script>
<?php include('includes/footer.php'); ?>