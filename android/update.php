<?php
include('common.php');

$VERSION = $_POST['version'];
if ($VERSION == $app_version) {
	$response["success"] = true;
}
echo json_encode($response);
?>