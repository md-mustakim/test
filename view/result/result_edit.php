<?php
	session_start();
	if(!isset($_SESSION['admin']))
	{
		header("location: ../login.php");
	}
	else
	{
		if(isset($_GET['unid']) && isset($_GET['sem']))
		{
		    $student_id = $_GET['student_id'];
			$unid = $_GET['unid'];
			$a = $_GET['unid'];
			$sem= $_GET['sem'];
			$b= $_GET['sem'];
			$output="";
			$msg="";
			
			$refresh= "<script type='text/javascript'>
			setTimeout(function () {
			window.location.href= 'result_edit.php?student_id=$student_id&sem=$sem&unid=$unid'; },500);
			countDown(5,'status');
		</script>";	
			
			
			include"../../db.php";
			include"../../function_list.php";
			$i= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM student_info where uniqueid=$a"));
			$n= $i['name'];
			$cl= $i['class'];
			$r= $i['class_roll'];
			$c= change_class($cl);
			if($b==100){$semester='First Semester';}
			if($b==101){$semester='First pre Semester';}
			if($b==200){$semester='Second Semester';}
			if($b==201){$semester='Second pre Semester';}
			if($b==300){$semester='Third Semester';}
			if($b==301){$semester='Third pre Semester';}
			if($b==111){$semester='First Semester Weekly';}
			if($b==211){$semester='Second Semester Weekly';}
			if($b==311){$semester='Third Semester Weekly';}
			$oo= "<table class='table table-sm'><tr>
				<td>$n</td>
				<td>$c</td>
				<td>Roll: $r</td>
			</tr></table>";
			
			$q= mysqli_query($new,"SELECT * FROM marksheed_2019 where type=$b AND regid=$a");
			while($r=mysqli_fetch_assoc($q))
			{
				
				$subj= $r['subject_id'];							
				$mark= $r['marks'];
				$id= $r['markid'];
				$type= $r['type'];
				$c_subj= change_subject($subj);
				 $output .= "<tr>
				 	<td>$c_subj <input type='hidden' value='$mark' name='subject[$subj]' /></td>
					
				 	<td align='right'><input type='number' name='mark[$id]' value='$mark'/></td>
				 </tr>
				 ";
				
			}
			$final_out="<br /><table class='table table-sm'><form action='result_edit.php?student_id=$student_id&unid=$unid&sem=$sem' method='POST'>
			$output <tr>
				<td align='center' colspan='2'><input type='submit' value='Update' name='update' /></td>
			</tr></form></table>";
			
			
			
			
			
			
			
			
			
			//-----------------------------UPDATE-----------------------------	
			if(isset($_POST['update']))
			{
				$sss= $_POST['mark'];
				foreach($sss as $key => $value)
				{
					$updateq= "UPDATE `marksheed_2019` SET `marks`='$value' WHERE markid=$key";
					$c=$new->query($updateq);
					if(!$c){$msg='UPDATE failed';}else{$msg='Update Success';}
					
				}
				echo $refresh;
				
			}
			//-----------------------------UPDATE---------end--------------------	
		
			
			
			
			
			
			
			
			
			
			
			
			
		}
		else{header("location: ./");}
	}

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../../src/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../../src/fa/css/all.css" />
	<link rel="icon" href="../../img/icon.ico" />
	<title>Edit</title>
</head>
<body>
	<?php include"../header.php"?>
	<div class="row m-0 p-0">
	<div class="col-md-2">
		<a class='btn btn-info w-100 mt-2' href="../">Home</a>
		<?php echo"<a class='btn btn-info w-100 mt-2' href='add.php?student_id=$student_id&unid=$unid&sem=$sem'>Return Back</a>";?>
	</div>
	<div class="col-md-8">
			
	<div class="msg"><?php echo $semester;?></div>
	<?php echo $msg;?>
	<?php echo $oo;?>
	<?php echo $final_out;?>

	</div>
	<div class="col-md-2"></div>
	</div>
	
</body>
</html>