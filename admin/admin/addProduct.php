<?php
    include('common.php');
    $q = json_decode($_REQUEST["q"], true);
  
    $name = $q['name'];
    $cat = $q['cat'];
    $brand = $q['brand'];
    $price = $q['price'];

    $insertQuery = "INSERT INTO item( name, catagory, brand, price, status,img_url) VALUES ('$name','$cat','$brand','$price','1','https://i.postimg.cc/s2FK2GF9/market-item.jpg');";
    if (mysqli_query($conn, $insertQuery)) {
        $response["success"] = true;
    }
echo json_encode($response);
?>