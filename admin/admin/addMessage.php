<?php
    include('common.php');
    $q = json_decode($_REQUEST["q"], true);
  
    $one = $q['one'];
    $two = $q['two'];
    $three = $q['three'];

    $update = "UPDATE banner SET one='$one',two='$two',three='$three';";
    if (mysqli_query($conn, $update)) {
        $response["success"] = true;
    }
echo json_encode($response);
?>