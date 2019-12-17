<?php
include('common.php');

$username = $_POST["username"];
$selectUser = "SELECT name,phone,email,password FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $selectUser);
if (mysqli_num_rows($result) > 0) {
	    $response["success"] = true;
		while ($itemRow = mysqli_fetch_assoc($result)) {
			$response["name"] = $itemRow['name'];
			$response["phone"] = $itemRow['phone'];
			$response["email"] = $itemRow['email'];
			$response["password"] = $itemRow['password'];
		}
}
echo json_encode($response);
?>