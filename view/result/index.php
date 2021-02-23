<?php 
	session_start();
	if(!isset($_SESSION['admin']))
	{
		header("location:../login.php");
	}
	else
	{
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Select semester</title>
	<link rel="stylesheet" href="../style.css" />
	<link rel="stylesheet" href="../style_1.css" />
	
</head>
<body>
<?php include"../header.php";?>
	<div class="column1">
		<div align='left' style='background:green;padding:3px;'>
		<a style='color:white' href="../index.php">Home</a>
			<div id="i" class="right_change"></div> 
		<a href="index.php" style='color:white'>Result</a>
			
		</div>
	</div>
	<div class="column2" align="center">
	<h2>Select Semester</h2><br /><br /><br />
		<a href="second_index.php?semester=1" class="index">1st semester</a> <br /><br /><br />
		<a href="second_index.php?semester=2" class="index">2nd semester</a> <br /><br /><br />
		<a href="second_index.php?semester=3" class="index">3rd semester</a> <br /><br /><br />
	</div>
	<div class="column3"></div>
</body>
</html>