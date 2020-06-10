<?php
	include "../db.php";
	if(isset($_SESSION['uname']))
	{	
		if(isset($_GET['semster']))
		{
			$semster = $_GET['semster'];
			//$delete = "DELETE FROM `fm19` WHERE semster = $semster";
			$delete = "select * FROM `fm19` WHERE semster = $semster";
			$status = $new->query($delete);
			if($status){
				echo "successfully deleted";
			}
			else
			{
				echo "Failed to delete";
			}
		}
		else
		{
			echo "Select Seemster";
		}
	}	
	else
	{
		echo "login first";
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	
	<button onclick="window.close()">Close</button>
		
</body>
</html>