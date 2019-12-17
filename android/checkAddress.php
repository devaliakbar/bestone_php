<?php
include('common.php');

$username = $_POST['username'];

$userId       = null;
$getUserId    = "SELECT id FROM users WHERE username = '$username'";
$userIdResult = mysqli_query($conn, $getUserId);
if (mysqli_num_rows($userIdResult) > 0) {
    while ($userRow = mysqli_fetch_assoc($userIdResult)) {
        $userId = $userRow['id'];
    }
}

if ($userId != null) {
    $address = "SELECT name,phone,house,landmark,extra FROM address WHERE user_id = '$userId'";
    $result  = mysqli_query($conn, $address);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            
            if ($row['name'] == "NA" && $row['phone'] == "NA" && $row['house'] == "NA") {
                $response["status"] = "NO";
            } else {
                
                $response["success"]  = true;
                $response["name"]     = $row['name'];
                $response["phone"]    = $row['phone'];
                $response["house"]    = $row['house'];
                $response["landmark"] = $row['landmark'];
                $response["extra"]    = $row['extra'];
            }
        }
    }
}
echo json_encode($response);
?>