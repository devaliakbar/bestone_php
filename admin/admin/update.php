<?php
include('common.php');
    $q = json_decode($_REQUEST["q"], true);
    $id = $q['id'];
    $name = $q['name'];
    $cat = $q['cat'];
    $brand = $q['brand'];
    $price = $q['price'];
    $status = $q['status'];
    $urls = $q['url'];

$updateQ = "UPDATE item SET name='$name',catagory='$cat',brand='$brand',price='$price',status='$status',img_url = '$urls' 
WHERE id = '$id'";
if (mysqli_query($conn, $updateQ)) {
  $response["success"] = true;
    }
    echo json_encode($response);
?>