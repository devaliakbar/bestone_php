<?php
include('common.php');

$VERSION = $_POST["version"];

$page = $_POST["pageNo"];

$limit = 6;

if ($VERSION == $app_version) {
    
    $filter = $_POST["filter"];
    if ($filter == "no") {
        $total = mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT catagory FROM item WHERE status = '1'"));
        $end   = $page * $limit;
        $start = $end - $limit;
        if ($start < $total) {
            $selectCatagory       = "SELECT DISTINCT catagory FROM item WHERE status = '1' ORDER BY catagory limit $start, $end";
            $selectCatagoryResult = mysqli_query($conn, $selectCatagory);
            if (mysqli_num_rows($selectCatagoryResult) > 0) {
                $response["success"] = true;
                $cursorArray         = array();
                $temp                = array();
                while ($row = mysqli_fetch_assoc($selectCatagoryResult)) {
                    $temp['catagoryName'] = $row['catagory'];
                    
                    $catagoryName                      = $row['catagory'];
                    $selectItemCorrespondingToCatagory = "SELECT id,name,brand,price,img_url FROM item WHERE catagory = '$catagoryName' AND status = '1' ORDER BY name limit 0, 5";
                    $itemResult                        = mysqli_query($conn, $selectItemCorrespondingToCatagory);
                    if (mysqli_num_rows($itemResult) > 0) {
                        $itemCursorArray = array();
                        $tempItem        = array();
                        
                        while ($itemRow = mysqli_fetch_assoc($itemResult)) {
                            $tempItem['pId']    = $itemRow['id'];
                            $tempItem['pName']  = $itemRow['name'];
                            $tempItem['pBrand'] = $itemRow['brand'];
                            $tempItem['pPrice'] = $itemRow['price'];
                            $tempItem['url']    = $itemRow['img_url'];
                            array_push($itemCursorArray, $tempItem);
                        }
                        $temp['itemsCursor'] = $itemCursorArray;
                    }
                    
                    array_push($cursorArray, $temp);
                    $response["cursor"] = $cursorArray;
                }
            } else {
                $response["status"] = "EMPTYDATABASE";
            }
        } else {
            if ($total == 0) {
                $response["status"] = "EMPTYDATABASE";
            } else {
                $response["status"] = "finish";
            }
        }
    } else {
        $selection = $_POST["selection"];
        $selectArg = $_POST["selectArg"];
        
        $selArg = "";
        if ($selection == "cat") {
            $selArg = "catagory";
        } elseif ($selection == "brand") {
            $selArg = "brand";
        } elseif ($selection == "name") {
            $selArg = "name";
        }
        
        
        $total = mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT catagory FROM item WHERE $selArg LIKE '%$selectArg%' AND status = '1'"));
        
        
        
        $end   = $page * $limit;
        $start = $end - $limit;
        
        if ($start < $total) {
            $selectCatagory = "SELECT DISTINCT catagory FROM item WHERE $selArg LIKE '%$selectArg%' AND status = '1' ORDER BY catagory  limit $start, $end;";
            
            $selectCatagoryResult = mysqli_query($conn, $selectCatagory);
            if (mysqli_num_rows($selectCatagoryResult) > 0) {
                $response["success"] = true;
                $cursorArray         = array();
                $temp                = array();
                while ($row = mysqli_fetch_assoc($selectCatagoryResult)) {
                    $temp['catagoryName'] = $row['catagory'];
                    
                    $catagoryName                      = $row['catagory'];
                    $selectItemCorrespondingToCatagory = "SELECT id,name,brand,price,img_url FROM item WHERE catagory = '$catagoryName' AND $selArg LIKE '%$selectArg%' AND status = '1' ORDER BY name limit 0, 5;";
                    $itemResult                        = mysqli_query($conn, $selectItemCorrespondingToCatagory);
                    if (mysqli_num_rows($itemResult) > 0) {
                        $itemCursorArray = array();
                        $tempItem        = array();
                        
                        while ($itemRow = mysqli_fetch_assoc($itemResult)) {
                            $tempItem['pId']    = $itemRow['id'];
                            $tempItem['pName']  = $itemRow['name'];
                            $tempItem['pBrand'] = $itemRow['brand'];
                            $tempItem['pPrice'] = $itemRow['price'];
                            $tempItem['url']    = $itemRow['img_url'];
                            array_push($itemCursorArray, $tempItem);
                        }
                        $temp['itemsCursor'] = $itemCursorArray;
                    }
                    
                    array_push($cursorArray, $temp);
                    $response["cursor"] = $cursorArray;
                }
            } else {
                $response["status"] = "EMPTYDATABASE";
            }
        } else {
            if ($total == 0) {
                $response["status"] = "EMPTYDATABASE";
            } else {
                $response["status"] = "finish";
            }
        }
    }
    
} else {
    $response["status"] = "VERSION";
    
}
echo json_encode($response);

?>