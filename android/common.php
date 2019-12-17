<?php
	$app_version = 6;
	$conn = mysqli_connect("localhost", "bestones_bestone", "bestone$$2019", "bestones_bestone");
if (!$conn) {
    mysqli_error();
    die();
}

$response            = array();
$response["success"] = false;
$response["status"]  = "INVALID";
?>