<?php
		function sss($regid){
				include"../db.php";
				
				$unid= $regid;
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
				$output_final= $grandtotal;
				 $output_final_off="<h2 align='center'><u>Annual Result Sheet- 2019</u></h2><br />
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
			echo $grandtotal;
		}
		
	
?>