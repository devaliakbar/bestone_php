<?php
include('common.php');
$q = $_REQUEST["q"];

$query = "SELECT item.id, item.name, item.catagory, item.brand, item.price, cart.qty,cart.total FROM item INNER JOIN cart ON item.id = cart.item_id INNER JOIN orders ON orders.id = cart.order_id WHERE orders.id = '$q'";

$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    $cursorArray = array();
    $temp = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $temp['id'] = $row["id"];
        $temp['name'] = $row["name"];
        $temp['brand'] = $row["brand"];
        $temp['catagory'] = $row["catagory"];
        $temp['price'] = $row["price"];
        $temp['qty'] = $row["qty"];
        $temp['total'] = $row["total"];
        array_push($cursorArray, $temp);
    }
    $response["cursor"] = $cursorArray;
} else {
    $response["status"] = "EMPTY DATABASE";
}

echo json_encode($response);

?>