<?php include('includes/header.php'); ?>

<main class="product-stock">
    <div class="head">
        <h1>Stock</h1>
        
        <div class="search-box form-group text-center">
            <input  placeholder="Search" type="text" id="big_search">
        </div>

        <form action="" class="form-inline">

        <div class="form-group">
                <input  placeholder="Item Id" type="number" id="id">
            </div>
            <div class="form-group">
                <input  placeholder="Item name" type="text" id="name">
            </div>
            <div class="form-group">
                <input  placeholder="Brand" type="text" id="brand">
            </div>
            <div class="form-group">
                <input placeholder="Category" type="text" id="cat">
            </div>
            <div class="form-group">
                <input id="status" placeholder="Status" type="text">
            </div>
            <div class="form-group">
                <button class="btn g" id="refresh">Refresh</button>
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
                            Name
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
<script src="js/stock.js"></script>
<?php include('includes/footer.php'); ?>