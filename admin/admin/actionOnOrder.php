<?php
include('common.php');
$q = json_decode($_REQUEST["q"], true);

$action = $q['action'];
$orderId = $q['id'];


if($action == "delete"){
		$deleteItem = "DELETE FROM cart WHERE order_id ='$orderId'";
		if (mysqli_query($conn, $deleteItem)) {
 			$deleteOrdersQuery = "DELETE FROM orders WHERE id ='$orderId'";
			if (mysqli_query($conn, $deleteOrdersQuery)) {
 				 $response["success"] = true;
 	 		  }

  		  }
  

}else{

	$exeQuery = "";

	if($action == "cancel"){
	$exeQuery = "UPDATE orders SET status ='CANCEL' WHERE id ='$orderId'";
	}

	if($action == "delevery"){
	$exeQuery = "UPDATE orders SET status ='DONE' WHERE id ='$orderId'";
	}

if (mysqli_query($conn, $exeQuery)) {
  $response["success"] = true;
    }
  
}

  echo json_encode($response);

?>