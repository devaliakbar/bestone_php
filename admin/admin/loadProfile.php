  <?php
   include('common.php');

   if(isset($_REQUEST["q"])){
 $q = json_decode($_REQUEST["q"], true);
 $selection = $q['a'];
 $sel = $q['b'];
$query = "SELECT id, name, username, phone, email FROM users WHERE $selection LIKE '$sel%' ORDER BY id ASC";	
   }else{
   	$query = "SELECT id, name, username, phone, email FROM users ORDER BY id ASC";
   }

		

	 $result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $response["success"] = true;
    $cursorArray = array();
    $temp = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $temp['id'] = $row["id"];
        $temp['name'] = $row["name"];
        $temp['username'] = $row["username"];
        $temp['phone'] = $row["phone"];
        $temp['email'] = $row["email"];
        array_push($cursorArray, $temp);
    }
    $response["cursor"] = $cursorArray;
} else {
    $response["status"] = "EMPTY DATABASE";
}

echo json_encode($response); 
 ?>