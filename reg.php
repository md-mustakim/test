<?php
	$msg= "";
	$opt= "";
	include "db.php";
	
	if(isset($_POST['submit'])){
		$name= $_POST['name'];
		$email= $_POST['email'];
		$number= $_POST['number'];
		$pas= $_POST['pass'];
		$pass= md5($pas);
		$insert = "INSERT INTO `teacher_info`(`name`, `email`, `number`, `pass`,`admin`) VALUES ('$name','$email','$number','$pass','0') ";
		$result = $new->query($insert);
		
		if(!$result){
			$msg .="Registration failed try to contact Admin";
		}
		else {
		
			$msg .="<h2>Welcome Registration Success. Please <a href='login.php'>Login</a></h2>";
		}
	}

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta charset="UTF-8">
	<title>New Registration</title>
	
	<link rel="stylesheet" href="style.css" />
</head>
<body><h1 align="center">New Registration</h1>
	<div class="bdy">
	
	<div align="center" class="">
		
	<?php echo $msg;?>
	<form action="reg.php" method="POST"><table><br>
		<p>*** Every Thing Requred and To be Unique</p><p align="center">Name and Password need to login</p>
		<tr>
			<td>
		<label for="name">Enter Name:</label>
		</td>	<td>
		<input type="text" name="name" placeholder="Name" required/><br>

		</td>
		</tr>
		<tr>
			<td>
		<label for="email">Enter Email:</label>
		</td><td>
		<input type="mail" name="email" placeholder="@" required/><br>
		</td>
		</tr>
		
		<tr>
			<td>
		<label for="number">Enter Number:</label>
		</td><td>
		<input type="number" name="number" placeholder="01"  required/><br>
		
		</td>
		</tr>
		<tr>
			<td>
		<label for="pass">Enter Password:</label>
		</td><td>
		<input type="password" name="pass" placeholder="Remember this Password" required/><br>
		</td>
		</tr>
		<tr>
			<td>
		
	
		
		</td>
		</tr>
	</table><input type="submit" name="submit" value="submit" /></form>
	
	</div></div>
</body>
</html>