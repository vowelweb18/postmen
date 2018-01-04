<?php
//DB Credential
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "postmen";

// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

//Receive the RAW post data via the php://input IO stream.
	$content = file_get_contents("php://input");
	$datas = json_decode($content, true);

//Fetch Tracking ID
	$tracking_id = $datas['data']['tracking_numbers'][0];

//Check For canpar
	$is_canpar = $datas['data']['rate']['shipper_account']['slug'];

//Reference Id
	$ref = $datas['data']['references'][0];

//Current Time
	$now = date('Y-m-d H:i:s');


	$sql = "INSERT INTO order_data set tracking_id = '".$tracking_id."',shipper = '".$is_canpar."',order_id = '".$ref."',created_at = '".$now."'";
	
		if ($conn->query($sql)) {
		    echo '{"code":200,"message":"success"}';
		    exit;
		} else {
		    echo '{"code":202,"message":"fail"}';
		    exit;
		}
	
	


?>