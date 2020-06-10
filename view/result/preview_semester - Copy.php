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
				$countgpa= 0;
				
				$tr="";
				
					//------------ get semester_postion-------------------------
						$si= mysqli_fetch_assoc(mysqli_query($new,"select * from fm19 where semester=$type and uniid=$unid"));
					//------------
					//------------
							
						$si= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM student_info where uniqueid=$unid"));
						$student_name= $si['name'];
						$student_clas= $si['class'];
						$student_class= change_class($student_clas);
						$student_roll= $si['class_roll'];
				
					//------------
				
				$semester_postion=serial($student_clas,$student_roll);
				
				
				if($type==1){$semester=100; $pre_semester=101; $weekly=111; $wm='1st semester weekly'; $sm='1st Semester'; $p_sm='1st Pre Semester';}
				if($type==2){$semester=200; $pre_semester=201; $weekly=211; $wm='2nd semester weekly'; $sm='2nd Semester'; $p_sm='2nd Pre Semester';}
				if($type==3){$semester=300; $pre_semester=301; $weekly=311; $wm='3rd semester weekly'; $sm='3rd Semester'; $p_sm='3rd Pre Semester';}
				$si= mysqli_fetch_array(mysqli_query($new,"SELECT * FROM student_info where uniqueid=$unid"));
				$student_name= $si['name'];$student_class= $si['class'];$s_class= $si['class'];$student_roll= $si['class_roll'];
				$student_class= change_class($student_class);
				$get_stc= mysqli_query($new,"SELECT * FROM stc_info where cid=$s_class");
				$scount= mysqli_num_rows($get_stc);
				$grand_total_marks="0";
				$grand_total_gpa="0";
				while($stc= mysqli_fetch_assoc($get_stc))
				{
					$pre_status= $stc['pre_status'];
					$marks= $stc['mark'];					
					$subjid= $stc['subjid'];
					$subject_name= change_subject($subjid);
					$p_w= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where subject_id=$subjid and regid=$unid and type=$weekly"));
					$p_m= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where subject_id=$subjid and regid=$unid and type=$pre_semester"));
					$s_m= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where subject_id=$subjid and regid=$unid and type=$semester"));
					$weekly_semester_marks= $p_w['marks'];
					$pre_semester_marks= $p_m['marks'];
					$semester_marks= $s_m['marks'];
					if($pre_status==1){
						$weekly_persent= scale_d($weekly_semester_marks,30,5,0);
						$pre_persent= scale_d($pre_semester_marks,50,25,0);
						$sem_persent= scale_d($semester_marks,100,70,0);
						$totala=$weekly_persent+$pre_persent+$sem_persent;
						$total = plusone($totala);
					
					
					}else {
						$total= $semester_marks;
					}
					if($marks==50){$gpa=grade_f($total);$point= gpa_f($total);}
					else{$gpa=grade($total);$point= gpa($total);}
						if($point==0){$failed=1;} 
						else if($point==5){$failed=0; $countgpa += 1;}
						else{$failed=0;}
						
						
						
					//	if($gpa==5) {$countgpa += 1; echo " $gpa a <br />"; } else {$countgpa += 0;}

						
					$tr.= "<tr>
					<td>$subject_name</td>
					<td align='center'>$weekly_semester_marks </td>
					<td align='center'>$pre_semester_marks </td>
					<td align='center'>$semester_marks</td>					
					<td align='center'> $total</td>
					<td align='center'>$point </td>               
					<td align='center'>$gpa</td> 					
					</tr>";
					
					$grand_total_marks += $total;
					$grand_total_gpa += $point;
					
				}
				
				$grandtotal_gpa = ( $grand_total_gpa / $scount);
				$ppp = gpa_grade($grandtotal_gpa);
				if($failed==0){$ppp=$ppp;} else{$ppp="<b style='color:red;'>F</b>";}
				$grandtotal_gpa = number_format($grandtotal_gpa,1);
				$grandtotal= "$grand_total_marks";
				
				
					$table="<h2 align='center'><b><u>$sm Result Sheet- 2019</u></b></h2><br />
				 <table id='tablea'>
				 <tr>
					<td class='w-25' style='border-right:1px solid #0000003d;'>Name </td>
					<td class='w-25' colspan='3'>$student_name</td>
				</tr>
				<tr>
					<td class='w-25' style='border-right:1px solid #0000003d;'>Class </td>
					<td class='w-25' style='border-right:1px solid #0000003d;'>$student_class</td>
					<td class='w-25' style='border-right:1px solid #0000003d;'>Roll </td>
					<td class='w-25' style='border-right:1px solid #0000003d;'>$student_roll</td>
				</tr>				
				<tr>
					<td style='border-right:1px solid #0000003d;'>Grade</td>
					<td style='border-right:1px solid #0000003d;'>$ppp</td>
					<td style='border-right:1px solid #0000003d;'>GPA</td>
					<td style='border-right:1px solid #0000003d;'>$grandtotal_gpa</td>
				</tr>
				<tr>
					<td style='border-right:1px solid #0000003d;'>Position</td>
					<td style='border-right:1px solid #0000003d;'>$semester_postion</td>
					<td style='border-right:1px solid #0000003d;'>Total Marks</td>
					<td style='border-right:1px solid #0000003d;'>$grandtotal</td>
					
				</tr>				
				
				 </table> <br />
				 
					
					
					<table>
						<tr>
						<th>Subject</th>
						<th>$wm</th>
						<th>$p_sm</th>
						<th>$sm</th>
						<th>Total</th>
						<th>GPA</th>						
						<th>Grade</th>						
						$tr
						<tr>
						<td>Grand Total</td>
						<td colspan='3'></td>
						<td align='center'>$grand_total_marks</td>
						<td align='center'></td>
						<td></td>
						</tr>
					</tr>
					</table>";
			
			
					$testdata = mysqli_num_rows(mysqli_query($new, "select * from fm19 where semester=$type and uniid=$unid"));
					if($testdata==0){
						$outputd= "<div align='center'><b><span style='font-size:20px;'><form action='preview_semester.php?regid=$unid&sem=$type' method='POST'><input type='submit' name='final' value='final submit' title='this action cannot be undo so carefull' /></form></span></b></div>";
						}else {$outputd='';}
						
						
					// insert final marks(fm19)---------------------------------------------
					if(isset($_POST['final']))
					{		
						if($testdata==0) {
							$cca= $new->query("INSERT INTO `fm19`(`uniid`, `semester`, `gpa`, `tgpa`, `marks`, `count_gpa5`, `status`) VALUES ('$unid','$type','$gpa','$grandtotal_gpa','$grandtotal', '$countgpa','$failed')");
							if(!$cca)
							{
								echo "Error";
							}
							else{echo"success"; echo"<script type='text/javascript'>
								if (window.confirm('Successfully confermed!! wait 2s;'))
													{
														 window.location.href = 'preview_semester.php?regid=$unid&sem=$type';
													}
													else
													{
														window.location.href = 'preview_semester.php?regid=$unid&sem=$type';
													}
								</script>";}
						
							}
							else 
							{
									echo"<script type='text/javascript'>
										if (window.confirm('Data already submited!!'))
															{
																 window.location.href = 'preview_semester.php?regid=$unid&sem=$type';
															}
															else
															{
																window.location.href = 'preview_semester.php?regid=$unid&sem=$type';
															}
									</script>";
							}
					}
					
			
			
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
	<style type="text/css">
	w-25{width:25%;}
	body{padding:0;margin:0;}
	pm-0{padding:0;margin:0;}
	
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
		.pp:after {
			content: "";
			clear: both;
			display: table;}
		.pp{
			margin:0;padding-top:15px;outline:0;width:60vw;height:100px;
		}
		.lc1{float:left;overflow:auto;width:20%;}
		.lc2{float:left;overflow:hidden;width:60%;}
		.lc22{font-size:1vw;color:#964b35;font-weight:bold;font-family:arial;padding:0;margin:0;outline:0;padding-right:17px;text-align:right;}
		.rightt{text-align:right;
				font-size: 2.1vw;
				
				
		}
	@media print{	
		.pp{width:100%;}
		.lc2{width:75%;}
		.rightt{font-size:50px;text-align:right;}
		.lc22{font-size:16px;text-align:right;}
		#tablea td{border:0;}
		#tablea tr{border:1px solid #0000003d;}
		a{color: black;}
		th{color:black;}	
		table{border:0;width:100%;}				
		td{border:1px solid #0000003d;}
		th{border:1px solid #0000003d;}
		table{border:1px solid #0000003d;}		
		@page{size: auto;  margin: 4mm 10mm; }	
		.print{	width: 100%;		
				
		}
		
		
	}

		
	</style>
</head>

	<div align='center' >
	
		<div class='pp'>
			
				<div  class='lc1 pm-0'>
					<img src="../img/logo.png" alt="" width="90px" heigth="90px" />
				</div>
				<div class='lc2 pm-0' ><div class='header1 rightt'>Holy Care School</div>
					<br />
					<div class='lc22'>Shantibug, Demra, Dhaka-1362</div>
				</div>
			
		</div>
	</div>


	<div align="center">
	<div class="print">
		<br />
		<br />
		<?php echo $msg;?>
		<?php echo $table;?>
	</div>
	
	
<br />
<div class='print' ><br />
<div  align='left' style='width:30%;float:left;margin:0;padding:0;outline:0;'>
	<h3 align='center'>Instruction</h3><br />
	<table>
	<tr>
		<th>Weekly</th>
		<th>Pre</th>
		<th>Semester</th>
		<th>Total</th>
	</tr>
	<tr>
		<td align='center'>5%</td>
		<td align='center'>25%</td>
		<td align='center'>70%</td>
		<td align='center'>100%</td>
	</tr>
	</table>
	<br />
</div>
	<div  align='right' style='float:left;width:70%;margin:0;padding:0;outline:0;'>
		<div style='width:35%' align='right'>
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
			<?php echo $outputd;?>
			<div align='center'><b><span style='font-size:20px;'>Principal</span></b></div>
			<div align='center'><span style='font-size:18px;'>Holy Care School</span></div>
		</div>
		
	</div>
</div>
</div>	
		

</html>