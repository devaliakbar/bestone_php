<?php
include('common.php');

$username = $_POST['username'];

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
            
            $name     = $_POST['name'];
            $phone    = $_POST['phone'];
            $house    = $_POST['house'];
            $landmark = $_POST['landmark'];
            $extra    = $_POST['extra'];
            
            $addressUpdate = "UPDATE address SET name='$name',phone='$phone',
			house='$house',landmark='$landmark',extra='$extra' WHERE user_id = '$userId'";
            
            if (mysqli_query($conn, $addressUpdate)) {
                $amount   = $_POST['total'];
                $totNum   = $_POST['totNum'];
                $extraMsg = $_POST['extraMsg'];
                
                date_default_timezone_set("Asia/Kolkata");
                $Currentdate = date("Y-m-d H:i:s");
                
                $updateOrder = "UPDATE orders SET date_time = '$Currentdate',status = 'ORDER', no_items = '$totNum',total= '$amount', msg = '$extraMsg'
				WHERE id = '$orderId'";
                if (mysqli_query($conn, $updateOrder)) {
                    $response["success"] = true;
                } else {
                    $response["status"] = "FAILED";
                }
                
            } else {
                $response["status"] = "address";
            }
            
        }
    } else {
        $response["status"] = "order";
    }
} else {
    $response["status"] = "user";
}
echo json_encode($response);
?>