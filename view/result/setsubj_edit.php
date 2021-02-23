<?php
	include"../../db.php";
	include"../../function_list.php";
	
	if(!isset($_GET['classid']))
	{
		header("location: setsubj.php");
		
	}
	$condition= $_GET['classid'];
	
		
	
	$view = "";
	$msg= "";
	$refresh= "<script type='text/javascript'>
			setTimeout(function () {
			window.location.href= 'setsubj_edit.php?classid=$condition'; },6050);
			countDown(5,'status');
		</script>";	
	//-------------------------------------------
		$stcget= mysqli_query($new,"SELECT * FROM stc_info WHERE cid=$condition ORDER BY `stc_info`.`cid` ASC");
			while($stcrow= mysqli_fetch_assoc($stcget))
			{
				$gets= $stcrow['subjid'];
				$gett= $stcrow['tid'];
				$getc= $stcrow['cid'];
				$get_delete_id= $stcrow['stc_id'];
				$getm= $stcrow['mark'];
				$gets= change_subject($gets);
				$gett= change_teacher($gett);
				$getc= change_class($getc);
				$view .="<tr>
					<td align='center'>$getc</td><td align='center'>$gets</td> <td align='center'>$getm</td>	<td align='center'>$gett</td>	
					<td align='center'><form action='setsubj_edit.php?classid=$condition' method='POST'>
						<input type='hidden' value='$get_delete_id' name='delete_id' />
						Affect on hole Marksheed (CareFull) <input type='submit' name='delete_submit' value='DELETE'/> 
					</form></td>
				</tr>";
			}
			$view = "<table class='table table-sm table-hover table-bordered'><tr>
				<th>Class</th>
				<th>Subject</th>
				<th>Full Marks</th>
				<th>Teacher</th>
				<th>Action</th>
			</tr>$view</table>";
			
			
			
			
			if(isset($_POST['delete_submit']))
			{
				$deleteid= $_POST['delete_id'];
				$sql_delete="DELETE FROM `stc_info` WHERE stc_id=$deleteid";
				$new->query($sql_delete);
				if($new){$msg .="<div class='msg'>Successfully deleted Refreshing...3s</div>";}else{$msg .='Not Deleted';}
				echo $refresh;
			}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Edit Subject</title>
	<link rel="stylesheet" href="../../src/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../../src/bootstrap/css/bootstrap.min.css" />
</head>
<body>
<?php include"../header.php";?>
    <div class="row m-0 p-0">
	<div class="col-md-2">
		<div style='background:green;padding:3px;'>
	<a style='color:white' href="../index.php">Home</a>
		<div id="i" class="right_change"></div> 
	<a href="index.php" style='color:white'>Result</a>
		<div id="i" class="right_change"></div> 	
	</div>
	</div>
	<div class="col-md-8">
			<?php echo $msg;?>	
			<?php echo $view;?>	
	</div>
	<div class="col-md-2"></div>
    </div>
</body>
</html>