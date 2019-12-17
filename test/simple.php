<?php
include('common/common.php');

$userName = $_POST['my_username'];
$password = $_POST['my_password'];

if (checkUserNamePassword($conn,$userName, $password)) {
    $version = $_POST['app_version'];
    
    if ($version != $app_version) {
        $response["status"] = "VERSION";
    } else {
        if ($forcePush_data) {
            $response["status"] = "PUSH";
        } else {
            if ($update_data) {
                $response["status"] = "UPDATE";
            } else {
                $response["success"] = true;
            }
        }
    }
    
    
} else {
    $response["status"] = "USER";
}

echo json_encode($response);
?>