<?php
	session_start();	
	$viewtd="";
	if(!isset($_SESSION['uname']))
	{
		header("location:../index.php");
	}
	else
	{
		include'../db.php';
		include'../function_list.php';
		
		if(isset($_GET['class']))
		{
			$c= $_GET['class'];
			$previewsql= "SELECT * FROM student_info where class=$c and status=1";
		}
		else{
			$previewsql="SELECT * FROM student_info where status=1";
		}
		$whilerow= mysqli_query($new,$previewsql);
		while($tdd=mysqli_fetch_assoc($whilerow))
		{
			$student_name= $tdd['name'];
			$student_class= $tdd['class'];
			$student_roll= $tdd['class_roll'];
			$uniqueid= $tdd['uniqueid'];
			$student_class= change_class($student_class);
			
			$viewtd .="<tr>
			<td>$student_name</td>
			<td align='center'><a href='add.php?unid=$uniqueid&sem=100'>Add Result</a></td>
	
			<td align='center'>$student_class</td>
			<td align='center'>$student_roll</td>
			</tr>";
		}
		
		$viewtable="<table><tr>
			<th>Name</th>
			<th>Action</th>
	
			<th>Class</th>
			<th>Roll</th>
		</tr>$viewtd</table>";
	}	

	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Result-Make</title>
	<link rel="stylesheet" href="../style.css" />
	<link rel="stylesheet" href="../style_1.css" /><link rel="shortcut icon" href="../img/icon.ico">
</head>
<body>
	<?php include"../header.php";?>	
	<div class="column1">
	<div style='background:green;padding:3px;'>
	<a style='color:white' href="../index.php">Home</a>
		<div id="i" class="right_change"></div> 
	<a href="index.php" style='color:white'>Result</a>
		<div id="i" class="right_change"></div> 	
	</div>	
		<?php
		
		
			for($i=1;$i<=8;$i++)
			{
				$temp= change_class($i);
				echo "<a class='bttn'  href='index.php?class=$i'> $temp</a>";
			}
		?>

	</div>
	<div class="column2">
	
	
	<?php echo $viewtable;?>
	
	
	</div>
	<div class="column3"><a class="bttn" href="setsubj.php">Costomize Subject</a>	</div>
</body>
</html>