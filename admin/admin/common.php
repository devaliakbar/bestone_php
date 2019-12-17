<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
    $conn = mysqli_connect("localhost", "bestones_bestone", "bestone$$2019", "bestones_bestone");
    //$conn = mysqli_connect("localhost", "root", "", "bestone");
if (!$conn) {
    mysqli_error();
    die();
}

$response            = array();
$response["success"] = false;
$response["status"]  = "INVALID";
?>