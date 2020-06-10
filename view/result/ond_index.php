<?php 
	session_start();
	if(!isset($_SESSION['uname']))
	{
		header("location:../login.php");
	}
	else
	{
		include"../db.php";
		include"../function_list.php";
		
		if(isset($_GET['class']))
		{
			$class= $_GET['class'];
			$q= "and class=$class  ORDER BY `student_info`.`class_roll` ASC";
		}
		else{$q='';}
		$tr="";
		
		$result_check_list= mysqli_query($new,"SELECT * FROM student_info where status=1 $q");
		while($r=mysqli_fetch_assoc($result_check_list))
		{
			$unid= $r['uniqueid'];
			$name= $r['name'];
			$roll= $r['class_roll'];
			$class= $r['class'];
			$class= change_class($class);
			//$unid= $r[''];
			$first_sm= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=100"));
			$first_sm_p= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=101"));
			$secnond_sm= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=200"));
			$secnond_sm_p= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=201"));
			$third_sm= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=300"));
			$third_sm_p= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=301"));
			if($first_sm>0){$fs="<a href='preview_semester.php?regid=$unid&sem=1' target='_blank'>View </a>";}else{$fs="<a style='background:#7af0ff;color:red;' href='add.php?unid=$unid&sem=100'>Add </a>";}
			if($first_sm_p>0){$fs_p="<a href='preview_semester.php?regid=$unid&sem=1' target='_blank'>View </a>";}else{$fs_p="<a style='background:#7af0ff;color:red;' color='red' href='add.php?unid=$unid&sem=101'>Add </a>";}
			if($secnond_sm_p>0){$ss="<a href='preview_semester.php?regid=$unid&sem=2' target='_blank'>View </a>";}else{$ss="<a style='background:#7af0ff;color:red;' color='red' href='add.php?unid=$unid&sem=200'>Add </a>";}
			if($secnond_sm>0){$ss_p="<a href='preview_semester.php?regid=$unid&sem=2' target='_blank'>View </a>";}else{$ss_p="<a style='background:#7af0ff;color:red;' color='red' href='add.php?unid=$unid&sem=201'>Add </a>";}
			if($third_sm>0){$ts="<a href='preview_semester.php?regid=$unid&sem=3' target='_blank'>View </a>";}else{$ts="<a style='background:#7af0ff;color:red;' color='red' href='add.php?unid=$unid&sem=300'>Add </a>";}
			if($third_sm_p>0){$ts_p="<a href='preview_semester.php?regid=$unid&sem=3' target='_blank'>View </a>";}else{$ts_p="<a style='background:#7af0ff;color:red;' color='red' href='add.php?unid=$unid&sem=301'>Add </a>";}
			if($first_sm>0 && $first_sm_p>0 && $secnond_sm>0 && $secnond_sm_p>0 && $third_sm>0 && $third_sm_p>0){$final="<a href='preview.php?regid=$unid' target='_blank'><b style='background:white;color:green;font-family:arial;'>VIEW</b> </a>";}else{$final='Not Ready';}
			$tr .="<tr>
			<td>$name</td>
			<td>$class</td>
			<td align='center'>$roll</td>
			<td align='center'>$fs_p</td>
			<td align='center'>$fs</td>
			<td align='center'>$ss_p</td>
			<td align='center'>$ss</td>
			<td align='center'>$ts_p</td>
			<td align='center'>$ts</td>
			<td align='center'>$final</td>
			</tr>";
		}
		$output= "<table><tr>
			<th rowspan='2'>Name</th>
			<th rowspan='2' >Class</th>
			<th rowspan='2'>Roll</th>
			<th colspan='2'>First Semester</th>
			<th colspan='2'>Second Semester</th>
			<th colspan='2'>Third Semester</th>
			<th rowspan='2'>Final</th>
			<tr>
				<th>Pre</th>
				<th>Semester</th>
				<th>Pre</th>
				<th>Semester</th>
				<th>Pre</th>
				<th>Semester</th>

			</tr>
		</tr>
		
		$tr</table>";
		
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Result Panel</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<link rel="stylesheet" href="../style.css" />
	<link rel="stylesheet" href="../style_1.css" />
	<link rel="icon" href="../img/icon.ico" />
</head>
<body>

	<?php include"../header.php";?>
	<div align='center' class="column1">
			<div align='left' style='background:green;padding:3px;'>
		<a style='color:white' href="../index.php">Home</a>
			<div id="i" class="right_change"></div> 
		<a href="index.php" style='color:white'>Result</a>
			
		</div>	
		<?php
		
		
			for($i=1;$i<=8;$i++)
			{
				$temp= change_class($i);
				echo "<a align='left' class='bttn'  href='index.php?class=$i'> $temp</a>";
			}
		?>
	</div>
	<div class="column2">
		
		<?php echo $output;?>
	</div>
	<div align='center' class="column3">
		<a align='left' class="bttn" href="setsubj.php">Costomize Subject</a>
		<a align='left' class="bttn" href="2018">2018 Result</a>
		
	</div>
</body>
</html>