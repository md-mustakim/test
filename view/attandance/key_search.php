<?php
	session_start();
	include"../db.php";
	include"../function_list.php";
	$a="";
	if(isset($_POST['a']))
	{
		$value=$_POST['searchvalue'];
		$sep_value= explode(',' , $value);		
		foreach($sep_value as $key)
		{
			
			echo "<br />";
			$a.=" uniqueid=$key or";
			
		}

		$a= rtrim($a,'or');
				
		
		$q=mysqli_query($new,"SELECT * FROM `student_info` where $a");
	
		while($r=mysqli_fetch_assoc($q))
		{
			
			$n= $r['name'];
			echo "<br />$n <br />";	
		}
	}
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Attandance</title>
</head>
<body>
	<form action="key_search.php" method="POST">
		<input type="text" name='searchvalue'/>
		<input type="submit" value='Search' name='a'/>
	</form>
</body>
</html>