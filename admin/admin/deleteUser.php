<?php
	include('common.php');
	$q = $_REQUEST["q"];
	 $response["success"] = true;

	$selectCartAndDelete = "SELECT DISTINCT id FROM orders WHERE user_id = '$q'";
	$result = mysqli_query($conn, $selectCartAndDelete);
if (mysqli_num_rows($result) > 0) {
	$response["success"] = true;
    while ($row = mysqli_fetch_assoc($result)) {
    	$idCart = $row["id"];


    	$delete = "DELETE FROM cart WHERE order_id = '$idCart'";
if (mysqli_query($conn, $delete)) {
 
    }else{
    	 $response["success"] = false;
    }


    }
}

$delete = "DELETE FROM address WHERE user_id = '$q'";
if (mysqli_query($conn, $delete)) {
 
    }else{
    	 $response["success"] = false;
    }


    $delete = "DELETE FROM orders WHERE user_id = '$q'";
if (mysqli_query($conn, $delete)) {
 
    }else{
    	 $response["success"] = false;
    }

        $delete = "DELETE FROM users WHERE id = '$q'";
if (mysqli_query($conn, $delete)) {
 
    }else{
    	 $response["success"] = false;
    }

    echo json_encode($response);
?>