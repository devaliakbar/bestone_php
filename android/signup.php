<?php
include('common.php');

$name     = $_POST["name"];
$username = $_POST["username"];
$email    = $_POST["email"];
$phone    = $_POST["phone"];
$password = $_POST["password"];

$usernameCheck       = "SELECT id FROM users WHERE username = '$username'";
$usernameCheckResult = mysqli_query($conn, $usernameCheck);
if (mysqli_affected_rows($conn) > 0) {
    $response["status"] = "ALREADY";
} else {
    $insertQuery = "INSERT INTO users(name, username, phone, email, password) VALUES ('$name','$username','$phone','$email','$password');";   
    if (mysqli_query($conn, $insertQuery)) {
        $userId                          = mysqli_insert_id($conn);
        $response["idOfLastInsertedRaw"] = $userId;
        
        $insertAddress = "INSERT INTO address(user_id) VALUES ('$userId')";
        if (mysqli_query($conn, $insertAddress)) {
            $response["success"] = true;
        }
    } else {
        $response["status"] = "INSERT ERROR";
    }
}
echo json_encode($response);
?>