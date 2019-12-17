<?php
	include('common.php');

	 $q = $_REQUEST["q"];

	 $query = "SELECT orders.total,orders.no_items,orders.status, address.name,users.username,address.phone,users.email,
	 address.house,address.landmark,address.extra
	 FROM orders INNER JOIN users ON users.id = orders.user_id 
	 INNER JOIN address ON users.id = address.user_id 
	 WHERE orders.id = '$q'";
     
     $result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $response['name'] = $row["name"];
        $response['username'] = $row["username"];
        $response['phone'] = $row["phone"];
        $response['email'] = $row["email"];
        $response['house'] = $row["house"];
        $response['extra'] = $row["extra"];
        $response['landmark'] = $row["landmark"];
		
		
		$response['no'] = $row["no_items"];
        $response['tot'] = $row["total"];
		
        $response['status'] = $row["status"];
     
    }
} else {
    $response["status"] = "EMPTY DATABASE";
}

echo json_encode($response);
?>