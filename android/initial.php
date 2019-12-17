<?php
include('common.php');

$VERSION = $_POST["version"];
$username = $_POST["username"];
$password = $_POST["password"];

if ($VERSION == $app_version) {
	
	
	 $passwordCheck       = "SELECT name FROM users WHERE username = '$username' AND password = '$password';";
        $passwordCheckResult = mysqli_query($conn, $passwordCheck);
        if (mysqli_affected_rows($conn) > 0) {
            $response["success"] = true;
            $response["o"] = "Bestone";
			$response["t"] = "Quality";
			$response["th"] = "Economy";
			
			$bannerCheck       = "SELECT * FROM banner;";
			$bannerCheckResult = mysqli_query($conn, $bannerCheck);
        if (mysqli_affected_rows($conn) > 0) {
		while ($bRow = mysqli_fetch_assoc($bannerCheckResult)) {
			$response["o"] = $bRow['one'];
			$response["t"] = $bRow['two'];
			$response["th"] = $bRow['three'];
		}
		}
		} else {
            $response["status"] = "USER";
        }
	
	
	
	
	
}else {
    $response["status"] = "VERSION";
}
echo json_encode($response);
?>