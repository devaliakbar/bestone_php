<?php
include('common.php');

$orderId = $_POST['orderId'];

$cancelOrder = "UPDATE orders SET status = 'CANCEL' WHERE id = '$orderId'";
if (mysqli_query($conn, $cancelOrder)) {
    $response["success"] = true;
} else {
    $response["status"] = "FAILED";
}


echo json_encode($response);

?>