<?php
include('common.php');

$itemId   = $_POST['itemId'];
$username = $_POST['username'];
$qty      = $_POST['qty'];



$userId       = null;
$getUserId    = "SELECT id FROM users WHERE username = '$username'";
$userIdResult = mysqli_query($conn, $getUserId);
if (mysqli_num_rows($userIdResult) > 0) {
    while ($userRow = mysqli_fetch_assoc($userIdResult)) {
        $userId = $userRow['id'];
    }
}
if ($userId != null) {
    
    $orderId = "";
    
    $getOrderId    = "SELECT id FROM orders WHERE status='CART' AND user_id = '$userId'";
    $orderIdResult = mysqli_query($conn, $getOrderId);
    if (mysqli_num_rows($orderIdResult) > 0) {
        while ($orderRow = mysqli_fetch_assoc($orderIdResult)) {
            $orderId = $orderRow['id'];
        }
    } else {
        $insertOrder = "INSERT INTO orders(status,user_id) VALUES('CART','$userId')";
        if (mysqli_query($conn, $insertOrder)) {
            $orderId = mysqli_insert_id($conn);
        }
    }
    
    $checkForExist = "SELECT cart.id FROM cart INNER JOIN orders ON cart.order_id = orders.id WHERE cart.item_id = '$itemId' AND cart.order_id ='$orderId' AND orders.user_id = '$userId'";
    $existResult   = mysqli_query($conn, $checkForExist);
    if (mysqli_num_rows($existResult) > 0) {
        $response["status"] = "ALREADY";
    } else {
        
        
        $price       = "";
        $selectPrice = "SELECT price FROM item WHERE id = '$itemId'";
        $priceResult = mysqli_query($conn, $selectPrice);
        while ($priceRow = mysqli_fetch_assoc($priceResult)) {
            $price = $priceRow['price'];
        }
        
        $total = (float) $qty * (float) $price;
        
        $insertIntoCart = "INSERT INTO cart(item_id,order_id,qty,total) VALUES('$itemId','$orderId','$qty','$total');";
        if (mysqli_query($conn, $insertIntoCart)) {
            $response["success"] = true;
        }
    }
}
echo json_encode($response);

?>