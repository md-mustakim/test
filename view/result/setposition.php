<?php
	include"../db.php";
	include"../function_list.php";
	include"preview_2019_serial.php";
	$class= $_GET['class'];
	
	function post_serial($reg,$new_roll)
	{
		include"../db.php";
		$check_serial = mysqli_num_rows(mysqli_query($new,"select * from position where reg=$reg"));
		if($check_serial > 0)
		{
			$query = "UPDATE `position` SET `3rd` = '$new_roll' WHERE `position`.`reg` = $reg";
		}
		else
		{
			$query= "INSERT INTO `position` (`reg`, `year`, `3rd`) VALUES ($reg, '2019', '$new_roll')";
		}
		$new->query($query);
		if(!$new->error)
		{
			return "success";
		}
		else
			return $query."error--<";
		
		
		
	}

	$all_student = "select * from student_info where class=$class and status=1 order by class_roll ASC";
	$all_student = mysqli_query($new,$all_student);
	if(isset($_POST['submit']))
	{
		$se = $_POST['serial'];
		foreach($se as $reg => $new_roll)
		{
			
			
			$insert  =  post_serial($reg,$new_roll);
			echo $insert;
				
		}
		
	}

	


?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title></title>
</head>
<body>
	<div class="container">
		<div class="h4">
		<?php echo change_class($class);?>
		</div> <small>3rd Semester postion</small>
		<hr />
		<form action="setposition.php?class=<?php echo $_GET['class'];?>" method="POST">
		<?php
				while($row = mysqli_fetch_assoc($all_student))
				{
					 $reg = $row['uniqueid'];
					 $roll = $row['class_roll'];
					 $check_serial = mysqli_num_rows(mysqli_query($new,"select * from position where reg=$reg"));
					 if($check_serial >0)
					 {
						 $got_serial = mysqli_fetch_assoc(mysqli_query($new,"select * from position where reg=$reg"));
						 $got_serial = $got_serial['3rd'];
					 }else
					 {
						 $got_serial= 0;
					 }
					?>
					<div class="row">
						<div class="col-4">
							<?php 
							echo "(".$row['class_roll'].")"; 
							echo $row['name'];?>
						</div>
						<div class="col-1">
						<label class="form-control" for="serial"><?php echo sss($reg);?></label>
						</div>
						<div class="col-3">
						<label class="form-control" for="serial">New Position</label>
						</div>
						<div class="col-4">
						<input class="form-control" type="number" name="serial['<?php echo $reg;?>']"  value="<?php echo $got_serial;?>"/>
						</div>
						
						
					
					</div>
					<?php
				
					
				}
		?>
		<input type="submit" name="submit" />
		</form>
	</div>
</body>
</html>