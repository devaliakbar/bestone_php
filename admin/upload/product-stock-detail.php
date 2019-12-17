<?php include('includes/header.php'); ?>

<?php
    $q = $_REQUEST["q"];
?>

<main class="product-stock">
    <div class="head">
        <h1>Stock Item</h1>

    </div>


    <div class="content text-center">
        <form action="" class=" center">

 <div class="form-group">
                <label for="id">Item id</label>
                <input id="id" type="text" disabled value="<?php echo $q; ?>">
            </div>

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
                <input id="categ" type="text">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input id="price" type="text">
            </div>
            <div class="form-group">
                <label for="rurl">URL</label>
                <input id="rurl" type="text">
            </div>
            <div class="checkbox">
                <input type="checkbox" name="" id="avail">
                <label for="avail">Stock available</label>
            </div>
          
        </form>
          <div class="btn-group">
                <button class="btn d" id="del">Delete</button>
                <button class="btn g" id = "upd">Update</button>
            </div>
    </div>

<br>
Current Image<br>
<img id="img_cur" alt="Img">
<br>
<form action="fileupload.php" enctype="multipart/form-data" method="post">
Select image :
<input type="file" name="fileToUpload"><br/>
<input name="id-up" type="text" style="visibility: hidden;" value="<?php echo $q; ?>">
<input type="submit" value="Upload" name="Submit1">
</form>

</main>
<script src="js/loadStock.js"></script>
<?php include('includes/footer.php'); ?>    