<?php
include('common.php');
$q = $_REQUEST["q"];

$checkForItemIsUsed = "SELECT id FROM cart WHERE item_id = '$q'";
$result = mysqli_query($conn, $checkForItemIsUsed);
if (mysqli_num_rows($result) > 0) {
	$response["status"] = "USED";
}else{

$delete = "DELETE FROM item WHERE id = '$q'";
if (mysqli_query($conn, $delete)) {
    
    $target_file = $_SERVER['DOCUMENT_ROOT'] . "/img/$q" . "." . "png";
    if (file_exists($target_file)) {
        unlink($target_file);
    }
        
         $target_file = $_SERVER['DOCUMENT_ROOT'] . "/img/$q" . "." . "jpg";
    if (file_exists($target_file)) {
        unlink($target_file);
    }
        
         $target_file = $_SERVER['DOCUMENT_ROOT'] . "/img/$q" . "." . "jpeg";
   if (file_exists($target_file)) {
        unlink($target_file);
    }
        
          $target_file = $_SERVER['DOCUMENT_ROOT'] . "/img/$q" . "." . "gif";
    if (file_exists($target_file)) {
        unlink($target_file);
    }
        
        
  $response["success"] = true;
    }
}
    echo json_encode($response);
?>