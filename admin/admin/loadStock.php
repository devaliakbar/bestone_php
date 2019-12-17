<?php
    include('common.php');

if(isset($_REQUEST["q"])){
     $q = json_decode($_REQUEST["q"], true);
     
     if(isset($q["all"])){
         $keywordForSearch = $q["all"];
          $query = "SELECT id, name, catagory, brand, price, status FROM item WHERE name LIKE '$keywordForSearch%' OR catagory LIKE '$keywordForSearch%' OR brand LIKE '$keywordForSearch%'"; 
     }else{
     
     $id = $q['id'];
     $Sname = $q['name'];
     $Sman = $q['brand'];
     $Scat = $q['cat'];
     $status = $q['status'];
$selection = "";

     if($Sname != ""){
        $selection .= " AND name LIKE '$Sname%'";
     }
     if ($Sman != "") {
                $selection .= " AND brand LIKE '$Sman%'";
            }
            if ($Scat != "") {
                $selection .= " AND catagory LIKE '$Scat%'";
            }
             if ($status != "") {
                $selection .= " AND status LIKE '$status%'";
            }

if($id != ""){
  $selection = " AND id = '$id'";
}   

            

            $query = "SELECT id, name, catagory, brand, price, status FROM item WHERE id > 0$selection"; 
}
}else{
   $query = "SELECT id, name, catagory, brand, price, status FROM item"; 
}
    
    $query = $query . " ORDER BY catagory";
    $result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    $cursorArray = array();
    $temp = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $temp['itemid'] = $row["id"];
        $temp['itemname'] = $row["name"];
        $temp['itemmanufactor'] = $row["brand"];
        $temp['itemcatagory'] = $row["catagory"];
        $temp['price'] = $row["price"];
        $temp['status'] = $row["status"];
        array_push($cursorArray, $temp);
    }
    $response["cursor"] = $cursorArray;
} else {
    $response["status"] = "EMPTY DATABASE";
}

echo json_encode($response);
?>