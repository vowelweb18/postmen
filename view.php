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

// get All Data 
	$sql = "SELECT * from order_data";
	
	$all_datas = $conn->query($sql);
	if ($all_datas->num_rows > 0) {
	    // output data of each row
	    while($row = $all_datas->fetch_assoc()) {
	        echo "id: " . $row["id"]. " - Tracking Id: " . $row["tracking_id"]. " - Slug: " . $row["shipper"]." - Order Id: " . $row["order_id"]." - Created At: " . $row["created_at"]. "<br>";
	    }
	} else {
	    echo "0 results";
	}
$conn->close();


?>