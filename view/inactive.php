<?php
session_start();
if(!isset($_SESSION['uname']))
{
	header("location:login.php");
}
else
{
	$view="";
	$class="";
	include"db.php";
	include"function_list.php";
	if(isset($_GET['class']))
	{
		$cls=$_GET['class'];
		$qu="and class=$cls";
	}
	else
	{
		$qu="";
	}
	$query= mysqli_query($new,"SELECT * from student_info where status=0 $qu");
	while($info=mysqli_fetch_assoc($query))
	{
		$name=$info['name'];
		$roll=$info['class_roll'];
		$class=$info['class'];
		$rid=$info['id'];
		$id=$info['uniqueid'];
		$fnumber=$info['fnumber'];
		$mnumber=$info['mnumber'];
		$fnumber= check_number($fnumber);
		$mnumber= check_number($mnumber);
		$birthday=$info['birth'];
		$class=change_class($class);
		$view .= "<tr>
			<td><a href='edit_student.php?student_id=$rid' title='Edit Info' target='_blank'>$name</a></td>
			<td align='center'>$class</td>
			<td align='center'>$roll</td>
			<td align='center'>$id</td>
			<td align='center'>$fnumber</td>
			<td align='center'>$mnumber</td>
			<td align='center'>$birthday</td>
			
		</tr>";
	}
	$final_view= "<table><tr>
		<th>Name</th>
		<th>Class</th>
		<th>Roll</th>
		<th>OnlineID</th>
		<th>Father</th>
		<th>Monther</th>
		<th>Birthday</th>
	</tr>$view</table>";
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="style_1.css" />
	<link rel="icon" href="img/icon.ico" />
	<title><?php echo $class;?> -View Student</title>
</head>
<body>
<?php include"header.php"; ?>
<div class="column1">
<p>Select Class</p>
<a class="bttn" href="inactive.php?class=1">Jounior</a>
<a class="bttn" href="inactive.php?class=2">Play</a>
<a class="bttn" href="inactive.php?class=3">Nursery</a>
<a class="bttn" href="inactive.php?class=4">One</a>
<a class="bttn" href="inactive.php?class=5">Two</a>
<a class="bttn" href="inactive.php?class=6">Three</a>
<a class="bttn" href="inactive.php?class=7">Four</a>
<a class="bttn" href="inactive.php?class=8">Five</a>

</div>
<div class="column2">

	<?php echo $final_view;?>
</div>
<div class="column3">
	<div class="msg"><div class="blink">Important</div></div>
	<p>Please correct invalid number. Sms will not send invalid number.</p>

</div>
</body>
</html>