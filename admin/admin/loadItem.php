<?php
	include('common.php');
$q = $_REQUEST["q"];
    $query = "SELECT  name, catagory, brand, price, status,img_url FROM item WHERE id = '$q'";
     $result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
	$response["success"] = true;
    while ($row = mysqli_fetch_assoc($result)) {
   $response["name"] = $row["name"];
   $response["catagory"]  = $row["catagory"];
   $response["brand"] = $row["brand"];
    $response["price"]= $row["price"];
   $response["status"] = $row["status"];
    $response["url"] = $row["img_url"];
    }
}

echo json_encode($response);

?>