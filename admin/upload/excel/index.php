<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
	// If you need to parse XLS files, include php-excel-reader
	require('php-excel-reader/excel_reader2.php');

	require('SpreadsheetReader.php');

	
	$Reader = new SpreadsheetReader('file/.xlsx');
	$Reader -> ChangeSheet(0);
	
		$a = 0;
	 echo "<html><body>";
	 
	foreach ($Reader as $Row)
	{
		if($a == 0){
			$a = 1;
		}else{

			$name = trim($Row[0]);
			$cat = trim($Row[8]);
			$brand = trim($Row[7]);
			$price = trim($Row[2]);

			if($name != "" && $price != ""){
				if($brand == ""){
					$brand = "BESTONE";
				}
				if($cat == ""){
					$cat = "OTHER";
				}
				//insert(strtoupper($name),strtoupper($cat),strtoupper($brand),strtoupper($price));
			}
		}
		
	}
 echo "</body></html>";
	function insert($name,$cat,$brand,$price){
    $conn = mysqli_connect("localhost", "bestones_bestone", "bestone$$2019", "bestones_bestone");
    //$conn = mysqli_connect("localhost", "root", "", "bestone");
if (!$conn) {
    mysqli_error();
    die();
}
	$insertQuery = "INSERT INTO item( name, catagory, brand, price, status,img_url) VALUES ('$name','$cat','$brand','$price','1','market_item.jpg');";
    if (mysqli_query($conn, $insertQuery)) {
        echo "<br>$name Inserted Successfully";
    }

	}
?>