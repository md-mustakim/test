<?php
	session_start();
	date_default_timezone_set('Asia/Dhaka');	
	if(isset($_SESSION['uname']))
	{
		$admin= $_SESSION['uname'];
	}
	else
	{
		header("location:index.php");
	}
	if(isset($_GET['shift']))
	{
		$sift= $_GET['shift'];
		}
		else
		{
			header('location:index.php');
		}
	include "../db.php";
	include "../function_list.php";
	$msg= "";
	$message= "";
	$sned_button= "";
	$out= "";
	$numberlist= "";
	//$sdate= date('d-m-y');
	$date= date('d-m-y');
	$date = "$date";
//	$date= "06-09-18";
$refresh= "<script type='text/javascript'>
			setTimeout(function () {
			window.location.href= 'absent_sms.php'; },6050);
			countDown(5,'status');
		</script>";	
		
	
	
	
	$select_absent_student= mysqli_query($new,"SELECT * FROM `student_info`
												LEFT JOIN attendanceController ON student_info.uniqueid=attendanceController.unid
												WHERE `date` LIKE '%".$date."%' and `shift` LIKE '%".$sift."%' and attand=0");
	$count=mysqli_num_rows($select_absent_student);
			if($count>0)
			{
				while($rr=mysqli_fetch_assoc($select_absent_student))
				{
					$number = $rr['mnumber'];
					$class = $rr['class'];
					$name = $rr['name'];
					
					$out .="<tr>
						<td>$class</td>
						<td>$name</td>
						<td>$number</td>
					</tr>";
					$numberlist .="$number, ";		
				}
				$numberlist = rtrim($numberlist, ', ' );
				$message = "Dear parent,\nYour child is absent Today ($date).\nPrincipal\nHoly Care School";
	
		}	else {$msg .= "Congratulation!!! No Absent student Found Today $date<br />";}

		$datetime= date('g:i a, d/m/y');
		$campaign = "$admin=>Absent=>$datetime";
		
	///------------send sms-------------
		if(isset($_POST['submit']))
		{
			include "../sms.php";
			$campaignName= "Absent SMS $date";
			echo pay_sms_cam($message,$numberlist,$campaign);
			$insert_sms_history = $new->query("INSERT INTO `sms_history`(`send_date`, `shift`, `numberlist`,`s_time`) VALUES ('$date','$sift', '$numberlist','$datetime')");
			if(!$insert_sms_history){$msg .="Error Contact Admin <br />";} else {$msg .="Success Wait 5 Second <br />"; echo $refresh;}
		}
		
		
		
		
	$check = mysqli_num_rows(mysqli_query($new,"SELECT * FROM `sms_history` WHERE `send_date` LIKE '%".$date."%' and shift like '%".$sift."%'"));
	if($check>0) {$msg .="SMS Already Send <br />"; $sned_button="<input disabled type='submit' value='send' title='Sms Already Send' />";}
	else if($count==0) {$sned_button= "<input disabled type='submit' value='No need Absent SMS' title='No need Absent SMS' />";}
	else {$sned_button= "<input type='submit' value='send' name='submit' />";}

		
		
		
		
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<link rel="stylesheet" href="../style.css" />
<link rel="stylesheet" href="../style_1.css" />
<link rel="x-icon" href="../icon.ico" />
	<meta charset="UTF-8">
	<title>Absent SMS</title>
</head>
<body>
<?php include"../header.php";?>
<div class="column1">
	<div style='background:green;padding:3px;'>
	<a style='color:white' href="../">Home</a>
		<div id="i" class="right_change"></div> 
	<a href="index.php" style='color:white'>Attandance</a>
		<div id="i" class="right_change"></div> 	
	</div> <br />
</div>
<div align='center' class="column2">	

	<?php echo $msg;?>
	<?php echo "Absent Student: $count";?>
	<table>
	<tr>
		<th>Numbers</th>
		<th>Message</th>
	</tr>
		<tr>
			<td><?php echo $numberlist;?></td>
			<td><?php echo $message;?></td>
		</tr>
	</table>
	<form action="absent_sms.php?shift=<?php echo $sift;?>" method="POST">
	<?php echo $sned_button;?>
	</form>
	
</div>
<div class="column3"></div>
</body>
</html>