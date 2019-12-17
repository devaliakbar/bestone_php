<?php
include('common.php');

$username = $_POST['username'];
$itemId   = $_POST['itemId'];

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
            $orderId     = $orderRow['id'];
            $deleteQuery = "DELETE FROM cart WHERE item_id = '$itemId' AND order_id = '$orderId'";
            if (mysqli_query($conn, $deleteQuery)) {
                $response["affectedRaw"] = mysqli_affected_rows($conn);
                $response["success"]     = true;
            } else {
                $response["status"] = "FAILED";
            }
        }
    }
}
echo json_encode($response);
?>