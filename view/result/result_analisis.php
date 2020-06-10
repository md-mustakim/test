<?php
	function rank($regid,$sem)
	{
		
				include"../db.php";
				include"../function_list.php";
				$unid=$regid;
				$type=$sem;
				$msg="";
				$semester_postion="";
				$tr="";
				
					//------------
							
						$si= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM student_info where uniqueid=$unid"));
						$student_name= $si['name'];
						$student_class= $si['class'];
						$student_class= change_class($student_class);
						$student_roll= $si['class_roll'];
				
					//------------
				
				
				
				
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
					
					$tr.= "<tr>
					<td>$subject_name</td>
					<td align='center'>$weekly_semester_marks </td>
					<td align='center'>$pre_semester_marks </td>
					<td align='center'>$semester_marks</td>					
					<td align='center'> $total</td>
					<td align='center'>$point</td>
					<td align='center'>$gpa</td>
					</tr>";
					
					$grand_total_marks += $total;
					$grand_total_gpa += $point;
					
				}
				$grandtotal_gpa = ( $grand_total_gpa / $scount);
				$ppp = gpa_grade($grandtotal_gpa);
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
						<th>Name</th>
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
						<td align='center'>$grand_total_gpa</td>
						<td></td>
						</tr>
					</tr>
					</table>";
			}	
		}
		
	}
	
?>