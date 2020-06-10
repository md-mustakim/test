<?php	
	$a = mysqli_connect('209.236.118.251','holycare_remotes','shaifulm.29','holycare_app');
	
	if ($a->connect_error) {
    die("Connection failed: " . $a->connect_error);
		} echo "Connected successfully";
?>