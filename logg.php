<?php
header('Access-Control-Allow-Origin: *'); 
    $q = $_REQUEST["q"];
    
    
    $conn = mysqli_connect("localhost", "bestones_bestone", "bestone$$2019", "bestones_bestone");
if (!$conn) {
    mysqli_error();
    die();
}

$response            = array();
$response["id"]  = $q;
$response["success"] = false;
$response["status"]  = "INVALID";

$selectItemCorrespondingToCatagory = "SELECT id,name,brand,price,img_url FROM item ORDER BY name";

$itemResult = mysqli_query($conn, $selectItemCorrespondingToCatagory);
if (mysqli_num_rows($itemResult) > 0) {
    $response["success"] = true;
    $cursorArray         = array();
    $temp                = array();
    
    while ($itemRow = mysqli_fetch_assoc($itemResult)) {
        $temp['pId']    = $itemRow['id'];
        $temp['pName']  = $itemRow['name'];
        $temp['pBrand'] = $itemRow['brand'];
        $temp['pPrice'] = $itemRow['price'];
        $temp['url'] = $itemRow['img_url'];
        array_push($cursorArray, $temp);
    }
    $response['cursor'] = $cursorArray;
} else {
    $response["status"] = "EMPTYDATABASE";
}

echo json_encode($response);

?>