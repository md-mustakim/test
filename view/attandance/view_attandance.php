<?php 
	session_start();
	include('../db.php');
	include('../function_list.php');
	if(!isset($_GET['date']))
	{
		header('location: index.php');
	}
	else 
	{
		$date=$_GET['date'];			
		function attand($b,$c)
		{
						include "../db.php";
						$out="";
							$getvew= mysqli_query($new,"SELECT * FROM student_info
														LEFT JOIN attendance ON student_info.uniqueid=attendance.unid
														WHERE `date` LIKE '%".$b."%'
														ORDER BY `student_info`.`class` ASC");
							
							while($r=mysqli_fetch_assoc($getvew))
							{
								$classs= $r['cls'];
								$namee= $r['name'];
								$attandd= $r['attand'];
								$classs= change_class($classs);
								if($attandd==0)
								{$attandd= "<u id='absent'>Absent</u>";}
								else {$attandd= "<b id='present' >Present</b>";}
							$out .= "<tr><td>$classs </td>
									<td>$namee  </td>
									<td>$attandd  </td>	</tr>";
							$cover="<table>
									<tr>
										<th>Class</th>
										<th>Name</th>
										<th>Attandance</th>										
									</tr>
									$out
								</table>";
							} return $cover;
		}
		
		//------count absent------------------------------------------------------
		$total_c= mysqli_num_rows(mysqli_query($new,"SELECT * FROM student_info where status=1"));
		$absent_c= mysqli_num_rows(mysqli_query($new,"SELECT * FROM attendance where date like '%".$date."%' AND attand=0"));
		$present_c= mysqli_num_rows(mysqli_query($new,"SELECT * FROM attendance where date like '%".$date."%' AND attand=1"));
		$persen= ($present_c / $total_c) * 100;
		$persent= number_format((float)$persen, 2, '.', '');	

	$attandance_analisis= "<table>
		<tr>
			<th>Total Student: $total_c</th>
			<th>Today Present: $present_c</th>
			<th>Today Absent: $absent_c</th>
			<th>Persence: $persent %</th>
		</tr>
	</table>";
	
	}

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<link rel="stylesheet" href="../style_1.css" />
	<link rel="stylesheet" href="../style.css" />
	<meta charset="UTF-8">
	<title><?php echo $date;?> View Attandance </title>
	
</head>
<body>
<?php include "../header.php"; ?>
	<div class="column1"></div>
	<div align='center' class="column2">
		<?php echo $attandance_analisis;?>
	
		<br />
		<?php echo attand($date,'1');?>
	
	</div>
	<div class="column3"></div>
</body>
</html>