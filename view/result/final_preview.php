<?php
	session_start();
	if(!isset($_SESSION['uname']))
	{
		header("location:../login.php");
	}
	else
	{
		if(!isset($_POST['results']))
		{
			$msg="Please Fill Up This Form correctly";
		}
		else
		{
			$_POST['sn'];
			$_POST['sn'];
			$unid
				include"../db.php";
				include"../function_list.php";
				//$unid= $_GET['regid'];
				$output="";
				$grandtotal="0";
				$grandtotal_gpa="0";
				$failed="0";
				$pre="0";
				$pre_second="0";
				$pre_third="0";
				$first_r="0";
				$second_r="0";
				$third_r="0";
			$si= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM student_info where uniqueid=$unid"));
			$student_name= $si['name'];
			$student_class= $si['class'];
			$student_class= change_class($student_class);
			$student_roll= $si['class_roll'];
			$previewcheck= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid"));
			if($previewcheck==!0){
				$getdata= mysqli_query($new,"SELECT * FROM student_info LEFT JOIN stc_info ON student_info.class=stc_info.cid WHERE student_info.uniqueid=$unid");
				$total_subject=mysqli_num_rows($getdata);
				while($rowss= mysqli_fetch_assoc($getdata))
				{
					$markss= $rowss['mark'];
					$pre_status= $rowss['pre_status'];
					$subjectid= $rowss['subjid'];
					$subject_name= change_subject($subjectid);				
					
					$querymark1= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=100 and subject_id=$subjectid"));
					$first_semester= $querymark1['marks'];	
					$first_r= $querymark1['marks'];	
							if($pre_status==1)
							{	$pre= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=101 and subject_id=$subjectid"));
								$pre= $pre['marks'];
								$first_pre= scale_d($pre,50,30,0);
								$first_sem= scale_d($first_semester,'100',70,0);
								$first_semester= $first_pre+$first_sem;
								$first_semester= plusone($first_semester);
							}else{$pre='';}
							
					$subj1_1= persent($first_semester,'25',1);			
					
					$querymark2= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=200 and subject_id=$subjectid"));
					$second_semester= $querymark2['marks'];
					$second_r= $querymark2['marks'];
							if($pre_status==1)
							{	$pre_s= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=201 and subject_id=$subjectid"));
								$pre_second= $pre_s['marks'];
								$second_pre= scale_d($pre_second,'50','30',0);
								$second_sem= scale_d($second_semester,100,'70',0);
								$second_semester= $second_sem+$second_pre;
								$second_semester= plusone($second_semester);
							}else{$pre_second='';}
					$subj2_2= persent($second_semester,'25',1);
					$querymark3= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=300 and subject_id=$subjectid"));
					$third_semester= $querymark3['marks'];
					$third_r=$querymark3['marks'];
							if($pre_status==1)
							{	$pre_t= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=301 and subject_id=$subjectid"));
								$pre_third= $pre_t['marks'];
								$third_pre= scale_d($pre_third,'50','30',0);
								$third_sem= scale_d($third_semester,'100','70',0);								
								$third_semester= $third_sem+$third_pre;
								$third_semester= plusone($third_semester);
							}else{$pre_third='';}
					
					$subj3_3= persent($third_semester,'50',1);
					
						
					$subj= $subj1_1+$subj2_2+$subj3_3;
					$new_subj= plusone($subj);
					$plus=explode('.',$subj);
					if(empty($plus[1])){
						$subj=$subj;
					}else
					{
						$ook=$plus[0]; $oook=$plus[1];
						if($oook>=50) {$subj=$ook+1;}
					}
					
						//$grandtotal=0;
						if($markss==50){$grade= grade_f($subj);$gpa= gpa_f($subj);}else{$grade= grade($subj);$gpa= gpa($subj);}
						
						$grandtotal +=$subj;
							if($gpa==0){$failed=1;}
						$grandtotal_gpa +=$gpa;
					$output .="<tr>
					<td>$subject_name</td>
							<td align='center'>$pre</td>
						<td align='center'>$first_r</td>
					<td align='center'>$first_semester</td>
							<td align='center'>$pre_second</td>
						<td align='center'>$second_r </td>
					<td align='center'>$second_semester </td>
							<td align='center'>$pre_third</td>
						<td align='center'>$third_r </td>
					<td align='center'>$third_semester </td>
						
					<td align='center'>$new_subj</td>
					<td align='center'>$gpa</td>
					<td align='center'>$grade</td>
					</tr>";
				}
				$grandtotal_gpa= $grandtotal_gpa / $total_subject;
				$grandtotal_gpa= number_format($grandtotal_gpa,2);
				$ppp= gpa_grade($grandtotal_gpa);
				if($failed==0){$ppp=$ppp;} else{$ppp="<b style='color:red;'>F</b>";}
				 $output_final=" <h1 align='center'>Result </h1>
				 <table><td>Name: $student_name,</td><td>Class: $student_class</td><td> Roll: $student_roll</td></table> <br /><br />
				 <table>
				 <tr>
				 <th  rowspan='2'>Subject</th>
				 <th class='result bottom' colspan='3'><a style='color:white;' title='Semester View' href='preview_semester.php?regid=$unid&sem=1' target='_blank'>First</a></th>
				 <th class='result bottom' colspan='3'><a style='color:white;' title='Semester View' href='preview_semester.php?regid=$unid&sem=2' target='_blank'>Second</a></th>
				 <th class='result bottom' colspan='3'><a style='color:white;' title='Semester View' href='preview_semester.php?regid=$unid&sem=3' target='_blank'>Third</a></th>
				 <th class='result' rowspan='2'>Total</th>
				 <th  rowspan='2'>GPA</th>
				 <th rowspan='2'>Grade</th>			 
				 </tr>
				 <tr>
					<th>Pre</th>
					<th>Semester</th>
					<th>Total</th>
				 <th class='result'>Pre</th>
					<th>Semester</th>
						<th>Total</th>
				 <th class='result'>Pre</th>
					<th>Semester</th>
						<th>Total</th>
				 </tr>
				 $output
				<tr>
					 <td align='right' colspan='10'>Grand Total:</td>
				 <td align='center'>$grandtotal</td>
				 <td align='center'>$grandtotal_gpa</td>
				 <td align='center'>$ppp</td>
				</tr>				 
				 </table>";
			}else {$output_final="No Result Found of <b> $student_name</b>";}	 
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="../style.css" />
	<link rel="stylesheet" href="../style_1.css" />
	<style type="text/css">
		.result{
			border-left: 1px solid #ffffff66;
		}
		.bottom{
			border-bottom: 1px solid #ffffff66;
		}
	</style>
</head>
<body>
<?php include"../header.php";?>
<div align="center">
	
<div class="print">
		<?php echo $output_final;?>
</div>

</div>
</body>
</html>