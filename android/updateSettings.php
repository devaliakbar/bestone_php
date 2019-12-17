<?php
include('common.php');

$UPDATE_USERNAME = $_POST['usernam'];

$updateQueryHelper = "";

$letUpdate = false;
if(isset($_POST['username'])){
	$fromPost = $_POST['username'];
$usernameCheck       = "SELECT id FROM users WHERE username = '$fromPost'";
$usernameCheckResult = mysqli_query($conn, $usernameCheck);
if (mysqli_num_rows($usernameCheckResult) == 0) {
	$letUpdate = true;
	$updateQueryHelper .= " username = '$fromPost'";
}
}else{
	$letUpdate = true;
}

if($letUpdate){

if(isset($_POST['name'])){
	if($updateQueryHelper != ""){
		$updateQueryHelper .=" ,"; 
	}
	$fromPost = $_POST['name'];
	$updateQueryHelper .= " name = '$fromPost'";
}	 

if(isset($_POST['phone'])){
	if($updateQueryHelper != ""){
		$updateQueryHelper .=" ,"; 
	}
	$fromPost = $_POST['phone'];
	$updateQueryHelper .= " phone = '$fromPost'";
}	

if(isset($_POST['email'])){
	if($updateQueryHelper != ""){
		$updateQueryHelper .=" ,"; 
	}
	$fromPost = $_POST['email'];
	$updateQueryHelper .= " email = '$fromPost'";
}	

if(isset($_POST['pass'])){
	if($updateQueryHelper != ""){
		$updateQueryHelper .=" ,"; 
	}
	$fromPost = $_POST['pass'];
	$updateQueryHelper .= " password = '$fromPost'";
}

$updateQuery = "UPDATE users SET" . $updateQueryHelper . " WHERE username = '$UPDATE_USERNAME'";

if (mysqli_query($conn, $updateQuery)) {
            $response["success"] = true;
    } else {
        $response["status"] = "UPDATE ERROR";
    }
}else{
	$response["status"] = "ALREADY";
}	

echo json_encode($response);
?>