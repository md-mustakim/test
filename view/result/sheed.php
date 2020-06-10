<?php
	include"../db.php";
	include"../function_list.php";
	if(isset($_GET['s']))
	{
		$class = $_GET['c'];
		$sid= $_GET['s'];
		$tid = $_GET['t'];
		$tr="";
		$query = mysqli_query($new,"SELECT * from student_info where class=$class and status=1");
		while($r=mysqli_fetch_assoc($query))
		{
			$unique_id =$r['uniqueid'];
			$name =$r['name'];
			$roll = $r['class_roll'];
			$mquery = mysqli_query($new,"SELECT * FROM `marksheed_2019` where regid=$unique_id and subject_id=$sid and type=$tid");
			$rr= mysqli_fetch_assoc($mquery);
			$tr .= "<tr>
			<td>$name</td>
			<td align='center'>$roll</td>
			<td align='center'>".$rr['marks']." </td>
			</tr>";
		}
		$ccc = change_class($class);
		$sss = change_subject($sid);
		$ttt = change_semester($tid);
		
		
		echo"<h1 align='center'> Class: <u>$ccc</u>, Subject: <u>$sss</u>, <u>$ttt</u> </h1>
		<a href='sheed.php'>seach again</a>
		<table>
		<tr>
			<th>Name</th>
			<th>Roll</th>
			<th>Marks</th>
		</tr>
		$tr
		</table>
		<p><b>i confirm that all marks are correct -- subject teacher's signature(  ___________________  ) </b></p>
		";
	}
	else
	{
		$sq = mysqli_query($new,"SELECT * FROM `subject_list`");
		$o="";
		while($ss=mysqli_fetch_assoc($sq))
		{	$id = $ss['subject_list_id'];
			$n = $ss['subject_name'];
			$o .= "<option value='$id'>$n</option>";
		}
		echo "<form action='sheed.php'>
		
			<select name='c' id='c'>
				<option value='1'>Junior</option>
				<option value='2'>play</option>
				<option value='3'>Nussery</option>
				<option value='4'>One</option>
				<option value='5'>Two</option>
				<option value='6'>Three</option>
				<option value='7'>Four</option>
				<option value='8'>Five</option>
			</select>
			<select name='s' id='s'>
				$o
			</select>
			<select name='t' id='t'>
				<option value='101'>1st pre semster</option>
				<option value='100'>1st semster</option>
				<option value='201'>2nd pre semster</option>
				<option value='200'>2nd semster</option>
				<option value='301'>3rd pre semster</option>
				<option value='300'>3rd semster</option>
			</select>
		
			
			<input type='submit' />
			</form>";
	}
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<link rel="stylesheet" href="../style_1.css" />
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	
</body>
</html>