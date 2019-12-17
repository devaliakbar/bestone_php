<?php
   include('common.php');

    $query = "SELECT orders.id, users.username, orders.date_time, orders.no_items, orders.total, orders.msg FROM orders INNER JOIN users ON users.id = orders.user_id WHERE orders.status = 'ORDER'  ORDER BY orders.id ASC";
     $result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    $cursorArray = array();
    $temp = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $temp['id'] = $row["id"];
        $temp['username'] = $row["username"];
        $dates = date("D, d M Y - h:i A", strtotime($row['date_time']));
        $temp['date'] = $dates;
        $temp['items'] = $row["no_items"];
        $temp['total'] = $row["total"];
        $temp['msg'] = $row["msg"];
        array_push($cursorArray, $temp);
    }
    $response["cursor"] = $cursorArray;
} else {
    $response["status"] = "EMPTY DATABASE";
}

echo json_encode($response);

?>