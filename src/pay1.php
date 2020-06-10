<?php
	include '../db.php';
	if(!empty($_POST['payid1']))
	{
		if($_POST['payid1']==11) {
		echo '<select name="month" id="">
			<option>Select</option>
			<option value="1">January</option>
			<option value="2">February</option>
			<option value="3">March</option>
			<option value="4">April</option>
			<option value="5">May</option>
			<option value="6">June</option>
			<option value="7">July</option>
			<option value="8">August</option>
			<option value="9">Spetember</option>
			<option value="10">Octobor</option>
			<option value="11">Nobember</option>
			<option value="12">December</option>
			</select>
			<input type="number" name="amount" id="amount" placeholder="Amount"/>
			';		
		}
		else if($_POST['payid1']==22){
			echo '<select name="cause" id="cause"><option value="111">1st Pre-Semester</option>
			<option value="112">1st Semester</option>
			<option value="121">2nd Pre-Semester</option>
			<option value="122">2nd Semester</option>
			<option value="131">3rd Pre-Semester</option>
			<option value="132">3rd Semester</option></select><input type="number" name="amount" id="amount" placeholder="Amount"/>';
		}
		
		if($_POST['payid1']==33) {
		echo '<select name="month" id="month">
			<option value="1">January</option>
			<option value="2">February</option>
			<option value="3">March</option>
			<option value="4">April</option>
			<option value="5">May</option>
			<option value="6">June</option>
			<option value="7">July</option>
			<option value="8">August</option>
			<option value="9">Spetember</option>
			<option value="10">Octobor</option>
			<option value="11">Nobember</option>
			<option value="12">December</option>
			</select><input type="number" name="amount" id="amount" placeholder="Amount"/>';		
		}
		if($_POST['payid1']==44){
			
			echo '<label for="cause">Why pay?</label><input type="text" name="cause" placeholder="Answer Here"/><input type="number" name="amount" id="amount" placeholder="Amount"/>';
		}
		
		
		
		
		
		
		
		
		
		
		}
?>	