<?php
error_reporting(E_ERROR | E_PARSE);
include('common.php');

$email   = $_POST['email'];
$username = $_POST['username'];

if($username != "NO"){
	$selectQuery = "SELECT username,password,email FROM users WHERE username = '$username'";
	 $result = mysqli_query($conn, $selectQuery);
	if (mysqli_num_rows($result) > 0) {
		$response["success"] = true;
        while ($orderRow = mysqli_fetch_assoc($result)) {
            $username = $orderRow['username'];
			$password = $orderRow['password'];
			$email = $orderRow['email'];
			sendMail($username,$password,$email);
        }
    }else{
		if($email != "NO"){
			
			
			$selectHelper = "";
	if(ctype_digit($email)){
		$selectHelper = " phone = '$email'";
	}else{
		$selectHelper = " email = '$email'";
	}
	$selectQuery = "SELECT username,password,email FROM users WHERE" . $selectHelper;
	 $result = mysqli_query($conn, $selectQuery);
	if (mysqli_num_rows($result) > 0) {
		$response["success"] = true;
        while ($orderRow = mysqli_fetch_assoc($result)) {
            $username = $orderRow['username'];
			$password = $orderRow['password'];
			$email = $orderRow['email'];
			sendMail($username,$password,$email);
        }
    }
			
			
			
			
		}
	}
}else{
	$selectHelper = "";
	if(ctype_digit($email)){
		$selectHelper = " phone = '$email'";
	}else{
		$selectHelper = " email = '$email'";
	}
	$selectQuery = "SELECT username,password,email FROM users WHERE" . $selectHelper;
	 $result = mysqli_query($conn, $selectQuery);
	if (mysqli_num_rows($result) > 0) {
		$response["success"] = true;
        while ($orderRow = mysqli_fetch_assoc($result)) {
            $username = $orderRow['username'];
			$password = $orderRow['password'];
			$email = $orderRow['email'];
			sendMail($username,$password,$email);
        }
    }
}

echo json_encode($response);

function sendMail($username,$password,$email){
	require "mail/PHPMailer/PHPMailerAutoload.php";

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
 
        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = 'mail.bestonesupermarket.com';
        $mail->Port = 465;  
        $mail->Username = 'info@bestonesupermarket.com';
        $mail->Password = 'pass@bestonesupermarket';   
   
   
        $mail->IsHTML(true);
        $mail->From="info@bestonesupermarket.com";
        $mail->FromName="Bestone Supermarket";
        $mail->Sender="info@bestonesupermarket.com";
      
        $mail->Subject = "Your Bestone Account Password";
        $mail->Body = "EMAIL :$username AND PASSWORD :$password";
        $mail->AddAddress($email);
        $mail->Send();
}
?>