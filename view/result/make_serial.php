<?php
	function total_marks($regid,$class,$semester)
	{
		$stc_class= mysqli_query($new,"SELECT * FROM student_info LEFT JOIN stc_info ON student_info.class=stc_info.cid WHERE student_info.uniqueid=$unid  ORDER BY `stc_info`.`subjid` ASC");
		while($rowss = mysqli_fetch_assoc($stc_class))
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
								//$first_pre= scale_d($pre,50,30,0);
								//$first_sem= scale_d($first_semester,'100',70,0);
								$first_semester= $pre+$first_semester;
								$first_semester= plusone($first_semester);
							}else{$pre='';}
							
					$subj1_1= persent($first_semester,'25',1);			
					
					$querymark2= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=200 and subject_id=$subjectid"));
					$second_semester= $querymark2['marks'];
					$second_r= $querymark2['marks'];
							if($pre_status==1)
							{	$pre_s= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=201 and subject_id=$subjectid"));
								$pre_second= $pre_s['marks'];
								//$second_pre= scale_d($pre_second,'50','30',0);
								//$second_sem= scale_d($second_semester,100,'70',0);
								$second_semester= $second_semester+$pre_second;
								$second_semester= plusone($second_semester);
							}else{$pre_second='';}
					$subj2_2= persent($second_semester,'25',1);
					$querymark3= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=300 and subject_id=$subjectid"));
					$third_semester= $querymark3['marks'];
					$third_r=$querymark3['marks'];
							if($pre_status==1)
							{	$pre_t= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=301 and subject_id=$subjectid"));
								$pre_third= $pre_t['marks'];
								//$third_pre= scale_d($pre_third,'50','30',0);
								//$third_sem= scale_d($third_semester,'100','70',0);								
								$third_semester= $third_semester+$pre_third;
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
		
		
	}

?>