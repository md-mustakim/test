<?php
	session_start();
	if(!isset($_SESSION['uname']))
	{
		header("location: ../login.php");
	}
	else
	{
		if(!isset($_GET['regid']))
		{
			header("location: index.php");
		}
		else
		{	
			if(!isset($_GET['sem']))
			{
				header("location: index.php");
			}
			else
			{
				
				
				include"../db.php";
				include"../function_list.php";
				$unid=$_GET['regid'];
				$type=$_GET['sem'];
				$msg="";
				$tr="";
				if($type==1){$semester=100; $pre_semester=101; $sm='1st Semester'; $p_sm='1st Pre Semester';}
				if($type==2){$semester=200; $pre_semester=201; $sm='2nd Semester'; $p_sm='2nd Pre Semester';}
				if($type==3){$semester=300; $pre_semester=301; $sm='3rd Semester'; $p_sm='3rd Pre Semester';}
				$si= mysqli_fetch_array(mysqli_query($new,"SELECT * FROM student_info where uniqueid=$unid"));
				$student_name= $si['name'];$student_class= $si['class'];$s_class= $si['class'];$student_roll= $si['class_roll'];
				$student_class= change_class($student_class);
				$get_stc= mysqli_query($new,"SELECT * FROM stc_info where cid=$s_class");
				while($stc= mysqli_fetch_assoc($get_stc))
				{
					$pre_status= $stc['pre_status'];
					$marks= $stc['mark'];					
					$subjid= $stc['subjid'];
					$subject_name= change_subject($subjid);
					$p_m= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where subject_id=$subjid and regid=$unid and type=$pre_semester"));
					$s_m= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where subject_id=$subjid and regid=$unid and type=$semester"));
					$pre_semester_marks= $p_m['marks'];
					$semester_marks= $s_m['marks'];
					if($pre_status==1){
						$pre_persent= scale_d($pre_semester_marks,50,30,0);
						$sem_persent= scale_d($semester_marks,100,70,0);
						$totala=$pre_persent+$sem_persent;
						$total = plusone($totala);
					
					
					}else {
						$total= $semester_marks;
					}
					if($marks==50){$gpa=grade_f($total);$point= gpa_f($total);}else{$gpa=grade($total);$point= gpa($total);}
					
					$tr.= "<tr>
					<td>$subject_name</td>
					<td align='center'>$pre_semester_marks </td>
					<td align='center'>$semester_marks</td>					
					<td align='center'> $total</td>
					<td align='center'>$point</td>
					<td align='center'>$gpa</td>
					</tr>";
					
				}
					$table="<table>
						<tr>
						<th>Name</th>
						<th>$p_sm(30%)</th>
						<th>$sm (70%)</th>
						<th>Total (100%)</th>
						<th>GPA</th>						
						<th>Grade</th>						
						$tr
					</tr>
					</table>";
			}	
		}
		
	}
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Marksheet of <?php echo $student_name;?></title>
	<link rel="stylesheet" href="../style.css" />
	<link rel="stylesheet" href="../style_1.css" />
	<link rel="x-icon" href="../" />
</head>
<?php include"header.php";?>
	<div class="column1"></div>
	<div class="column2">
		
		<?php echo $msg;?>
		<?php echo $table;?>
		
	</div>
	<div class="column2"></div>
<body>
	
</body>
</html>