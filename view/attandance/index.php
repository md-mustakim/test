<?php
	session_start();
	include('../../db.php');
	include('../../function_list.php');
	date_default_timezone_set('Asia/Dhaka');
	$get_date="";
	$out2="";
	$persents_day_persent="";
	$msg="";
	if(!isset($_SESSION['admin']))
	{
		header('location:../auth/login.php');
	}
	else 
	{
		$date= date('d-m-y');
	//	$date= date('17-9-18');
	$tssm= mysqli_num_rows(mysqli_query($new,"SELECT * FROM `student_info` WHERE status=1"));
	$tssd= mysqli_num_rows(mysqli_query($new,"SELECT * FROM `student_info` WHERE status=1"));
		//------------------attendance persent----------------
			$total_c= mysqli_num_rows(mysqli_query($new,"SELECT * FROM student_info where status=1"));
			$ap= mysqli_num_rows(mysqli_query($new,"SELECT * FROM attendance where date like '%".$date."%'"));
			$persen= ($ap / $total_c) * 100;
			$persent= number_format((float)$persen, 2, '.', '');
				$pure_persent= explode('.',$persent);
					if($pure_persent['0']>=100)
					{
					//	$valid_sms_link= "<a href='absent_sms.php'><div class='index'>Absent SMS</div></a>";
					}
					else {
						//$valid_sms_link= "<div class='index' title='Please Complete Attandance'>Absent SMS</div>";
						}
			
			if($pure_persent['0']==0){$msg .="Please Take Attandance...Today";}
			else{
				//$msg .="Today Attandance Count: $persent %"; 
				}
			
// get attand status- per class----------------------

		
			
		// get attendance list-----------		 ORDER BY `sms_history`.`send_date`  DESC
		$list = mysqli_query($new,"SELECT DISTINCT date FROM attendance ORDER BY `id` DESC");
		$out_valit= mysqli_num_rows($list);
	//	echo $out_valit;
		if($out_valit==0) {$out1="No attendance Found";}
		else {
		while($rlist= mysqli_fetch_assoc($list))
		{	$get_date = $rlist['date'];				
					
				$pcs= mysqli_num_rows(mysqli_query($new,"SELECT * FROM `attendance` LEFT JOIN student_info ON attendance.unid=student_info.uniqueid WHERE date like '%".$get_date."%' and attand=1 AND STATUS=1"));
				$persents_day_persent = ($pcs * 100) / $tssm;	
					$persent_day= explode('.',$persents_day_persent);
						$rr=$persent_day['0'];
			
			
			//if($get_date)
			 $smssd=mysqli_num_rows(mysqli_query($new,"SELECT * FROM sms_history where send_date like '%".$get_date."%' and shift like 'Day'"));
			 $smssm=mysqli_num_rows(mysqli_query($new,"SELECT * FROM sms_history where send_date like '%".$get_date."%' and shift like 'Morning'"));
			
			
				if($smssd==1) {$smsstatusd="<i class='fa fa-check-circle' style='color:green;font-size:20px'></i>";}else{$smsstatusd="<i class='fa fa-warning' style='color:black;font-size:18px''></i>";}
				if($smssm==1) {$smsstatusm="<i class='fa fa-check-circle' style='color:green;font-size:20px'></i>";}else{$smsstatusm="<i class='fa fa-warning' style='color:black;font-size:18px''></i>";}
				//if($==1) {$='Success';}else{$smsstatusm='No yet';}
			$aa= graph($rr);
			$out2 .= "<tr>
				<td> <a href='view_attandance.php?date=$get_date' title='View details'>$get_date</a></td>				
				<td align='center'>$smsstatusm </td>
				<td align='center'>$smsstatusd </td>
				<td  align='left'> $aa </td>
			</tr>";
		}
		
		$out1= "<table class='table'>
		<tr>
			<th>Date</th>			
			<th>SMS (Morning)</th>
			<th>SMS (Day)</th>
			<th>Presentence</th>
		</tr>
		$out2</table>";
		}
	}
	
	
	
	$ca= 0;
	
	
		$c1= attand_validity('1',$date); if($c1>=1)		{$ca=$ca+1;}
		$c2= attand_validity('2',$date); if($c2>=1)		{$ca=$ca+1;}
		$c3= attand_validity('3',$date); if($c3>=1)		{$ca=$ca+1;}
		$c4= attand_validity('4',$date); if($c4>=1)		{$ca=$ca+1;}
		$c5= attand_validity('5',$date); if($c5>=1)		{$ca=$ca+1;}
		$c6= attand_validity('6',$date); if($c6>=1)		{$ca=$ca+1;}
		$c7= attand_validity('7',$date); if($c7>=1)		{$ca=$ca+1;}
		$c8= attand_validity('8',$date); if($c8>=1)		{$ca=$ca+1;}
		$valid_sms_link1="";
	 $ca;
	$valid_sms_link="";
	$valid_sms_link1="";
	
			if($ca >= 5) 
			{
				$valid_sms_link .= "<a href='absent_sms.php?shift=Morning'><div class='index'>Absent SMS Morning Shift</div></a>";
			}
			if($ca>5 && $ca==!8) 
			{
				$valid_sms_link .="<p>Please Complete Day Shift Attandance</p>";
			}
			if($ca==8)
			{
					$valid_sms_link1 .= "<a href='absent_sms.php?shift=day'><div class='index'>Absent SMS Day Shift</div></a>";
			}
			else {$valid_sms_link .= "<div class='index' title='Please Complete Attandance'>Absent SMS </div>
			<p class='alert'>Please Complete <span class='blink'>Attandance</span> First</p>
			";}
						
		
		function ok($a)
		{
			if($a==1) 
			{$cc1="Done";} 
		else if($a==0) {$cc1="Take";} 
		else {$cc1="<p title='No Student So no need attendance'>(Done)*</p>";}
			return $cc1;
		}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<link rel="icon" href="../../img/icon.ico" />
<link rel="stylesheet" href="../../src/bootstrap/css/bootstrap.min.css" />

<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />	
<link rel="stylesheet" href="../../src/fa/css/all.css">
	<meta charset="UTF-8">
	<title>Attandance</title>
</head>
<body>
<?php include"../header.php";?>
	<div class="row m-0 p-0">
	<div class="col-2">
        <div class="m-1">

        <button
                class="btn btn-info w-100 mt-2 font-weight-bold text-light"
                onclick="window.location.href = '../index.php';">
            Return Home
        </button>


		<p>Important: Do not take attendance while edit Student Information.</p>

	
	</div>
    </div>
	<div align="center" class="col-8" >
			<?php echo "$msg";?>

	
	<a href="attand.php?class=1"><div class="index">Take Attandance</div></a>	
	<?php echo $valid_sms_link;?>
	<?php echo $valid_sms_link1;?>
	<br />
	<?php echo $out1;?>
	</div>
	<div class="col-2">
	<?php echo date('l d-M-y');?>
	<br />
	<?php echo"Your Ip is:"; echo getip();?>




        <table class="table table-secondary">

            <tr>
                <th>Class</th>
                <th>Status</th>
            </tr>
            <tr><td>Class Junior</td><td>	<?php echo ok($c1);?></td></tr>
            <tr><td>Class Play</td><td>		<?php echo ok($c2);?></td></tr>
            <tr><td>Class Nursery</td><td> 	<?php echo ok($c3);?></td></tr>
            <tr><td>Class One</td><td>		<?php echo ok($c4);?></td></tr>
            <tr><td>Class Two</td><td>		<?php echo ok($c5);?></td></tr>
            <tr><td>Class Three</td><td>	<?php echo ok($c6);?></td></tr>
            <tr><td>Class Four</td><td>		<?php echo ok($c7);?></td></tr>
            <tr><td>Class Five</td><td>		<?php echo ok($c8);?></td></tr>

        </table>








	</div>



</body>
</html>