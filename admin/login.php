<?php
 include('info.php');
?>
<html
<body>
<h1>Log In</h1>
<form action = "" method = "post">
    
    Username<input type="text" name="usr">
    Password<input type="password" name="pas">
    <input type="submit" name="submit" value="Log In">
    
</form>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $myusername = $_POST['usr'];
    $mypassword = $_POST['pas'];
    if($myusername == $usr && $mypassword == $pas){
    
    echo "Successfully LogedIn";
        setcookie("usr", $myusername, 0, "/");
        setcookie("pas", $mypassword, 0, "/");
        header("Location: http://bestonesupermarket.com/admin"); 
        exit;
    }
}

?>
</body>
</html>