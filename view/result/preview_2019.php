<?php
	session_start();
	if(!isset($_SESSION['uname']))
	{
		header("location:../login.php");
	}
	else
	{
		if(!isset($_GET['regid']))
		{
			header("locaton:index.php?msg=Select_Student_First");
		}
		else
		{
				include"../db.php";
				include"../function_list.php";
				$unid= $_GET['regid'];
				$final_result="";
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
				
				$queryss= mysqli_query($new,"SELECT * FROM position where reg=$unid");
				$countss= mysqli_num_rows($queryss);
				if($countss>0)
				{
				    $sdf =mysqli_fetch_assoc($queryss);
				    $roll_position= $sdf['3rd'];
				}else{
				    $roll_position="";
				}
				
				
			
			$si= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM student_info where uniqueid=$unid"));
			$student_name= $si['name'];
			$student_class= $si['class'];
			$student_class= change_class($student_class);
			$student_roll= $si['class_roll'];
			$previewcheck= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid"));
			if($previewcheck==!0){
				$getdata= mysqli_query($new,"SELECT * FROM student_info LEFT JOIN stc_info ON student_info.class=stc_info.cid WHERE student_info.uniqueid=$unid  ORDER BY `stc_info`.`subjid` ASC");
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
								$first_semester= $pre+$first_semester;
							
							}else{$pre='';}
							
					$subj1_1= persent($first_semester,'25',1);			
					
					$querymark2= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=200 and subject_id=$subjectid"));
					$second_semester= $querymark2['marks'];
					$second_r= $querymark2['marks'];
							if($pre_status==1)
							{	$pre_s= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=201 and subject_id=$subjectid"));
								$pre_second= $pre_s['marks'];
								$second_semester= $second_semester+$pre_second;
							}else{$pre_second='';}
					$subj2_2= persent($second_semester,'25',1);
					$querymark3= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=300 and subject_id=$subjectid"));
					$third_semester= $querymark3['marks'];
					$third_r=$querymark3['marks'];
							if($pre_status==1)
							{	$pre_t= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=301 and subject_id=$subjectid"));
								$pre_third= $pre_t['marks'];
								$third_semester= $third_semester+$pre_third;
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
						$grandtotal = plusone($grandtotal);
							if($gpa==0){$failed=1;}
						$grandtotal_gpa +=$gpa;
					$final_result .="<tr><td>$subject_name</td><td>$new_subj</td></tr>";
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
					
					</tr>";
				}
				$grandtotal_gpa= $grandtotal_gpa / $total_subject;
				$grandtotal_gpa= number_format($grandtotal_gpa,2);
				$ppp= gpa_grade($grandtotal_gpa);
				if($failed==0){$ppp=$ppp;} else{$ppp="<b style='color:red;'>F</b>";}
				 $output_final="<h2 align='center'><u>Annual Result Sheet- 2019</u></h2><br />
				 <table id='tablea'><tr>
				 <td>Name </td><td>$student_name</td>
				 <tr><td style='width:30%'>Class </td><td style='width:70%'>$student_class</td></tr>
				<tr> <td> Roll </td><td>$student_roll</td></tr>
				<tr><td>Total Marks</td><td>$grandtotal</td></tr>				
				<tr><td>Position</td><td>$roll_position</td></tr>
				
				 </table> <br />
				 <table id='tableb'>
				 <tr>
				 <th  rowspan='2'>Subject</th>
				 <th class='result bottom' colspan='3'><a class='white' title='Semester View' href='preview_semester.php?regid=$unid&sem=1' target='_blank'>First Semester</a></th>
				 <th class='result bottom' colspan='3'><a class='white' title='Semester View' href='preview_semester.php?regid=$unid&sem=2' target='_blank'>Second Semester</a></th>
				 <th class='result bottom' colspan='3'><a class='white' title='Semester View' href='preview_semester.php?regid=$unid&sem=3' target='_blank'>Third Semester</a></th>
				 <th class='result' rowspan='2'>Total</th> 
				 </tr>
				 <tr>
					<th>Pre </th>
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
				
				 
				</tr>				 
				 </table>";
			}else {$output_final="No Result Found of <b> $student_name</b>";}	 
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>Result of <?php echo $student_name;?></title>
	<link rel="stylesheet" href="../style.css" />
	<link rel="stylesheet" href="../style_1.css" />
	<link rel="shortcut icon" href="../img/icon.ico">
	<style type="text/css">
	.result{
			border-left: 1px solid #0000003d;
		}
		.bottom{
			border-bottom: 1px solid #0000003d;
		}
		.print{
		width: 70%;
		}
		a{
			color: white;
		}
		.pp{
			margin:0;padding:5px;outline:0;width:30vw;height:100px;
		}
	@media print{
		.logo{width:80%;}
		#tablea td{border:0;}
		#tablea tr{border:1px solid #0000003d;}
		a{color: black;}
		th{color:black;}	
		table{border:0;}				
		td{border:1px solid #0000003d;}
		th{border:1px solid #0000003d;}
		table{border:1px solid #0000003d;}		
		@page{size: auto;  margin: 4mm 10mm; }	
		.print{	width: 100%;		
				
		}
		.pp{margin:0;padding:5px;outline:0;width:80vw;height:100px;}
		
	}

		
	</style>
</head>
<body>
	<div align='center' class="headercolumn">
	
		<div class='pp'><div  style='margin:0;padding:0;outline:0;'>
			<div  style='float:left;'><img src="../img/logo.png" alt="" width="100px" heigth="100px" />
			</div>
			<div style='padding-right: 8px; width:auto;padding-top:18px;'><a class='header1' style='font-size:55px;padding-bottom:0;' href="./">Holy Care School</a>
			<br /><div align='right' style='font-size:18px;color:#964b35;font-weight:bold;font-family:arial;line-height: 1.2;padding:0;margin:0;outline:0;padding-right:17px'>Shantibug, Demra, Dhaka-1362</div></div>
			
		
			</div>
		</div>
	</div>
<div align="center">
	
<div class="print">

		<?php echo $output_final;?>
</div>
<br />
<div class='print' >
<div  align='left' style='width:30%;float:left;margin:0;padding:0;outline:0;'>
	<h3 align='center'><u>Instruction</u></h3> 
	

	<table>
	<tr>
		<th>1st Semester</th>
		<th>2nd Semester</th>
		<th>3rd Semester</th>
		<th> Total</th>
	</tr>
	<tr>
		<td align='center'>25%</td>
		<td align='center'>25%</td>
		<td align='center'>50%</td>
		<td align='center'>100%</td>
	</tr>
	</table>
	<br>
	<table>
	  <tr>
	        <td style="width:100%; height:35px;"></td>
	    </tr>
	    <tr>
	        <th>Comment</th>
	    </tr>
	  
	</table>
	<br />
	<div>
		<small style='font-size:18px;'><b>Result will be available at</b> <u>https://holycareschool.com</u></small>
		<b>Note:</b> There is no need to return this Result Card
		
	</div>
	
</div>
	<div  align='right' style='float:left;width:70%;margin:0;padding:0;outline:0;'>
		<div style='width:35%' align='right'>
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
			<div align='center'><b><span style='font-size:20px;'>Principal</span></b></div>
			<div align='center'><span style='font-size:18px;'>Holy Care School</span></div>
		</div>
		
	</div>
</div>



</div>
</body>
</html>