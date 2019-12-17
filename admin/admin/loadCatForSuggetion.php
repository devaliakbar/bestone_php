<?php
    include('common.php');

   $query = "SELECT DISTINCT catagory FROM item"; 

    
    $query = $query . " ORDER BY catagory";
    $result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    $cursorArray = array();
    $temp = array();
    while ($row = mysqli_fetch_assoc($result)) {
      
        $temp['cat'] = $row["catagory"];
    
        array_push($cursorArray, $temp);
    }
    $response["cursor"] = $cursorArray;
} else {
    $response["status"] = "EMPTY DATABASE";
}

echo json_encode($response);
?>