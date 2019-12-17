<?php
include('common.php');

$type     = $_POST["type"];
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
    
    if ($type == "order") {
        $selectOrder = "SELECT id, date_time , status , no_items , total FROM orders WHERE user_id = '$userId' AND status = 'ORDER' ORDER BY id desc";
    } else {
        $selectOrder = "SELECT id, date_time , status , no_items , total FROM orders WHERE user_id = '$userId' AND status NOT IN ('ORDER','CART') ORDER BY id desc";
    }
    $selectOrderResult = mysqli_query($conn, $selectOrder);
    if (mysqli_num_rows($selectOrderResult) > 0) {
        $cursorArray = array();
        $temp        = array();
        while ($row = mysqli_fetch_assoc($selectOrderResult)) {
            $dates = date("D, d M Y - h:i A", strtotime($row['date_time']));
            
            $temp['dates']    = $dates;
            $temp['status']   = $row['status'];
            $temp['price']    = $row['total'];
            $temp['no_items'] = $row['no_items'];
            $temp['id']       = $row['id'];
            
            $orderId                     = $row['id'];
            $selectItemCorrespondingToId = "SELECT item.id,item.name,item.brand,item.catagory,cart.qty,cart.total,item.img_url
		FROM item INNER JOIN cart ON item.id = cart.item_id
		WHERE cart.order_id = '$orderId'";
            $itemResult                  = mysqli_query($conn, $selectItemCorrespondingToId);
            if (mysqli_num_rows($itemResult) > 0) {
                $response["success"] = true;
                $itemCursorArray     = array();
                $tempItem            = array();
                
                while ($itemRow = mysqli_fetch_assoc($itemResult)) {
                    $tempItem['pId']    = $itemRow['id'];
                    $tempItem['pCat']   = $itemRow['catagory'];
                    $tempItem['pName']  = $itemRow['name'];
                    $tempItem['pBrand'] = $itemRow['brand'];
                    $tempItem['pPrice'] = $itemRow['total'];
                    $tempItem['pQty']   = $itemRow['qty'];
                    $tempItem['url']   = $itemRow['img_url'];
                    array_push($itemCursorArray, $tempItem);
                }
                $temp['itemsCursor'] = $itemCursorArray;
            }
            array_push($cursorArray, $temp);
            $response["cursor"] = $cursorArray;
        }
    } else {
        $response["status"] = "EMPTYDATABASE";
    }
}
echo json_encode($response);