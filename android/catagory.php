<?php
include('common.php');

$filter = $_POST['filter'];
$cat    = $_POST['cat'];


$page = $_POST["page"];

$limit = 10;




if ($filter == "no") {
    
     $total = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM item WHERE catagory = '$cat' AND status = '1'"));
        
        $end = $page * $limit;
        $start = $end - $limit;
  
        if ($start < $total) {
            
    
    
    
    $selectItemCorrespondingToCatagory = "SELECT id,name,brand,price,img_url FROM item WHERE catagory = '$cat' AND status = '1' ORDER BY name limit $start, $end";
}
} else {
    $selection = $_POST['selection'];
    $selectArg = $_POST['selectArg'];
    
     $total = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM item WHERE catagory = '$cat' AND status = '1' AND $selection LIKE'%$selectArg%'"));
        
         $end = $page * $limit;
        $start = $end - $limit;
  
        if ($start < $total) {
            
        
    
    
    $selectItemCorrespondingToCatagory = "SELECT id,name,brand,price,img_url FROM item WHERE catagory = '$cat' AND $selection LIKE'%$selectArg%' AND status = '1' ORDER BY name limit $start, $end";
}
}

if ($start < $total) {
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
}else{
     if($total == 0){
                $response["status"] = "EMPTYDATABASE";
            }else{
                 $response["status"] = "finish";
            }
}
echo json_encode($response);

?>