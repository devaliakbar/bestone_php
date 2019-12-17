<?php
include('common.php');

$VERSION = $_POST["version"];

if ($VERSION == $app_version) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $usernameCheck       = "SELECT id FROM users WHERE username = '$username'";
    $usernameCheckResult = mysqli_query($conn, $usernameCheck);
    if (mysqli_affected_rows($conn) > 0) {
        $passwordCheck       = "SELECT name FROM users WHERE username = '$username' AND password = '$password';";
        $passwordCheckResult = mysqli_query($conn, $passwordCheck);
        if (mysqli_affected_rows($conn) > 0) {
            $response["success"] = true;
        
		while ($nameRow = mysqli_fetch_assoc($passwordCheckResult)) {
			$response["name"] = $nameRow['name'];
		}
		
		} else {
            $response["status"] = "P";
        }
    } else {
        $response["status"] = "U";
    }
    
} else {
    $response["status"] = "VERSION";
}
echo json_encode($response);
?>