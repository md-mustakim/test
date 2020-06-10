<?php
	include '../../db.php';
	include '../../function_list.php';
	if(!empty($_POST['payid1']))
	{
		if($_POST['payid1']==11) { //monthly fee
			$unid=$_POST['unid'];		
			$data="";
			$type=$_POST['payid1'];
			for($i=1;$i<=12;$i++)
			{
				$q= mysqli_num_rows(mysqli_query($new,"SELECT * FROM payment where unid=$unid and type=$type and payment_cause=$i"));
				$mo= change_month($i);
				if($q>=1){$data1 ="<option value='$i' disabled>$mo</option>";}
				else if($q==0){$data1="<option value='$i'>$mo</option>";}
			
				$data .= "$data1";
				
			}
			echo "<select name='month' id='month'>
			<option value=''>Select</option>
				$data			
			</select>
			<input type='number' name='amount' id='amount' placeholder='Amount'/>";
			
		
		}
		
		else if($_POST['payid1']==22){ //Exam fee
			$unid=$_POST['unid'];		
			$data="";
			$type=$_POST['payid1'];
			
			function ex($i,$unid,$type)
			{
				include '../../db.php';
				$q= mysqli_num_rows(mysqli_query($new,"SELECT * FROM payment where unid=$unid and type=$type and payment_cause=$i"));
			//	if($q==1){$data1 ="<option value='$i' disabled></option>";}
			//	else if($q==0){$data1="<option value='$i'></option>";}	
				return $q;
			}
			$data1="";
			$data2="";
			$data3="";
			$data4="";
			$data5="";
			$data6="";
			$c= ex(111,$unid,$type);if($c==1){$data1="<option value='111' disabled>1st Pre-Semester</option>";}else if($c==0){$data1="<option value='111'>1st Pre-Semester</option>";}
			$cc= ex(112,$unid,$type);if($cc==1){$data2="<option value='112' disabled>1st Semester</option>";}else  if($cc==0){$data2="<option value='112'>1st Semester</option>";}
			$ccc= ex(121,$unid,$type);if($ccc==1){$data3="<option value='121' disabled>2nd Pre-Semester</option>";}else  if($ccc==0){$data3="<option value='121'>2nd Pre-Semester</option>";}
			$cccc= ex(122,$unid,$type);if($cccc==1){$data4="<option value='122' disabled>2nd Semester</option>";}else  if($cccc==0){$data4="<option value='122'>2nd Semester</option>";}
			$ccccc= ex(131,$unid,$type);if($ccccc==1){$data5="<option value='131' disabled>3rd Pre-Semester</option>";}else  if($ccccc==0){$data5="<option value='131'>3rd Pre-Semester</option>";}
			$cccccc= ex(132,$unid,$type);if($cccccc==1){$data6="<option value='132' disabled>3rd Semester</option>";}else  if($cccccc==0){$data6="<option value='132'>3rd Semester</option>";}
			
			echo"<select name='month' id='month'>
			<option value=''>Select</option>
			$data1
			$data2
			$data3
			$data4
			$data5
			$data6
			
			</select>
			<input type='number' name='amount' id='amount' placeholder='Amount'/>
			";
		/*	echo '<select name="month" id="month">			
			<option value="111">1st Pre-Semester</option>
			<option value="112">1st Semester</option>
			<option value="121">2nd Pre-Semester</option>
			<option value="122">2nd Semester</option>
			<option value="131">3rd Pre-Semester</option>
			<option value="132">3rd Semester</option></select>
			<input type="number" name="amount" id="amount" placeholder="Amount"/>';*/
		}
		
		if($_POST['payid1']==33) { // weekly fee
			$unid=$_POST['unid'];		
			$data="";
			$type=$_POST['payid1'];
			
			for($i=1;$i<=12;$i++)
			{
				$q= mysqli_num_rows(mysqli_query($new,"SELECT * FROM payment where unid=$unid and type=$type and payment_cause=$i"));
				$mo= change_month($i);
				if($q>=1){$data1 ="<option value='$i' disabled>$mo</option>";}
				else if($q==0){$data1="<option value='$i'>$mo</option>";}
			
				$data .= "$data1";
				
			}
			echo "<select name='month' id='month'>
			<option value=''>Select</option>
				$data			
			</select>
			<input type='number' name='amount' id='amount' placeholder='Amount'/>";
			
			
	
		}
		if($_POST['payid1']==44) // coaching fee
		{
			$unid=$_POST['unid'];		
			$data="";
			$type=$_POST['payid1'];
			
			for($i=1;$i<=12;$i++)
			{
				$q= mysqli_num_rows(mysqli_query($new,"SELECT * FROM payment where unid=$unid and type=$type and payment_cause=$i"));
				$mo= change_month($i);
				if($q>=1){$data1 ="<option value='$i' disabled>$mo</option>";}
				else if($q==0){$data1="<option value='$i'>$mo</option>";}
			
				$data .= "$data1";
				
			}
			echo "<select name='month' id='month'>
			<option value=''>Select</option>
				$data			
			</select>
			<input type='number' name='amount' id='amount' placeholder='Amount'/>";
			
		}
		
		
		
		
		
		if($_POST['payid1']==55){ // other fee
			

			
			echo '<label for="cause">Why pay?</label><input type="text" name="month" placeholder="Answer Here"/><input type="number" name="amount" id="amount" placeholder="Amount"/>';
		}
		
				
		
		}
?>	