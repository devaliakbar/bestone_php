<?php
 include('info.php');
 $user = "";
 $pass = "";
 if(isset($_COOKIE['usr']) && isset($_COOKIE['pas'])){
     $user = $_COOKIE['usr'];
     $pass = $_COOKIE['pas'];
 }
  if($user != $usr || $pass != $pas){
   header("Location: http://bestonesupermarket.com/admin/del/login.php"); 
   exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin panel</title>
    <script src="../js/jquery.min.js"></script>  
</head>
<body>

