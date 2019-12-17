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
            
            $selectCartItem = "SELECT item.id,item.name,item.brand,item.catagory,cart.total,cart.qty,item.img_url
		FROM item INNER JOIN cart ON item.id = cart.item_id
		WHERE cart.order_id = '$orderId'";
            
            $itemResult = mysqli_query($conn, $selectCartItem);
            if (mysqli_num_rows($itemResult) > 0) {
                $response["success"] = true;
                $cursorArray         = array();
                $temp                = array();
                
                $totAmount = 0.0;
                $count     = 0;
                while ($itemRow = mysqli_fetch_assoc($itemResult)) {
                    $temp['pId']    = $itemRow['id'];
                    $temp['pName']  = $itemRow['name'];
                    $temp['pBrand'] = $itemRow['brand'];
                    $temp['pPrice'] = $itemRow['total'];
                    $temp['pCat']   = $itemRow['catagory'];
                    $temp['pQty']   = $itemRow['qty'];
                    $temp['url']   = $itemRow['img_url'];
                    
                    $count++;
                    $totAmount = (float) $totAmount + (float) $itemRow['total'];
                    array_push($cursorArray, $temp);
                }
                $response['cursor'] = $cursorArray;
                $response['total']  = $totAmount;
                $response['totno']  = $count;
            } else {
                $response["status"] = "EMPTYDATABASE";
            }
            
            
            
        }
    } else {
        $response["status"] = "EMPTYDATABASE";
    }
}
echo json_encode($response);
?>