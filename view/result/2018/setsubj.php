<?php
	session_start();
	if(!isset($_SESSION['uname']))
	{
		header("location:../../index.php");
	}
	else
	{
		include'../../db.php';
		include'../../function_list.php';
		$outv="";
		$msg="";
		$subject_row="";
		$soption="";
		$view="";
		$csoption="";
		$toption="";
		$setsss="";
		
		if(isset($_GET['classid']))
		{
			$classaccessid= $_GET['classid'];
			$clid= $_GET['classid'];
			$setsss="?classid=$clid";
			$classaccess= change_class($classaccessid);
			$selected = 1;
			$condition= "where cid=$clid";
		} else {$condition=""; $selected = 0; $classaccessid="Class Not Selected"; $classaccess="Class Not Selected"; $clid= 1; $setsss=""; }
			#------get subjectmanagement subjcet list-----------
		$subjectlist = mysqli_query($new,"SELECT * FROM subject_list");
		
		if(mysqli_num_rows($subjectlist)<0) {$msg .="No Subject Found";}
		else{
				while($rsl= mysqli_fetch_assoc($subjectlist))
					{
						$subject_id= $rsl['subject_list_id'];
						$subject_name= $rsl['subject_name'];
						
						$subject_row .="<tr>
							<td>$subject_id</td>
							<td>$subject_name</td>
						</tr>";
					}
					$subject_view= "<table width='45%'><tr><th>Id</th><th>Name</th></tr>$subject_row</table>";
			}
		
				$refresh= "<script type='text/javascript'>
			setTimeout(function () {
			window.location.href= 'setsubj.php$setsss'; },3000);
			countDown(5,'status');
		</script>";	
		
		
		if(isset($_POST['sub_submit']))
		{
			$sub_name= $_POST['sub_name'];
			$testinsert=$new->query("INSERT INTO `subject_list`(`subject_name`) VALUES('$sub_name')");
			if(!$testinsert){
				$msg .="Sorry Cannot Add";
			}
			else
			{
				$msg .="Subject Add Success.. Refreshing...3s";
			
			}	echo $refresh;
		}
// get teacher list----------------------------------
		$tlist= mysqli_query($new,"SELECT * FROM teacher_info");
		while($trow= mysqli_fetch_assoc($tlist))
		{	
			$tid= $trow['id'];
			$tname= $trow['name'];
			$toption .= "<option value='$tid'>$tname</option>";
		}
// get class list----------------------------------
		$clist= mysqli_query($new,"SELECT * FROM class_list");
		while($crow= mysqli_fetch_assoc($clist))
		{	
			$cid= $crow['class_id'];
			$cname= $crow['class_name'];
			$csoption .= "<option value='$cid'>$cname</option>";
		}	
		
		$coptionf="	<select name='class' id='class' required>
		<option value=''>Choose</option>
		 $csoption
		</select>";
		
		
		if($selected==1)
		{
			$coption = "<b><u>$classaccess </u></b><input type='hidden' name='class' value='$classaccessid' /> &nbsp; &nbsp;";
		}
		else{
			$coption = $coptionf;
		}
		
// get data stc list----------------------------------
			$stcget= mysqli_query($new,"SELECT * FROM stc_info $condition ORDER BY `stc_info`.`cid` ASC");
			while($stcrow= mysqli_fetch_assoc($stcget))
			{
				$gets= $stcrow['subjid'];
				$gett= $stcrow['tid'];
				$getc= $stcrow['cid'];
				$getm= $stcrow['mark'];
				$gets= change_subject($gets);
				$gett= change_teacher($gett);
				$getc= change_class($getc);
				$view .="<tr>
					<td>$getc</td><td>$gets</td> <td>OUT of:  $getm</td>	<td>$gett</td>		
				</tr>";
			}
		
		
		
		
// get subject list----------------------------------
		$slist= mysqli_query($new,"SELECT * FROM subject_list");
		while($srow= mysqli_fetch_assoc($slist))
		{	
			$sid= $srow['subject_list_id'];
			$sname= $srow['subject_name'];
			$soption .= "<option value='$sid'>$sname</option>";
		}	
// get class list----------------------------------		
		$classlist= mysqli_query($new,"SELECT * FROM class_list");
		while($crow= mysqli_fetch_assoc($classlist))
		{	
			$clid= $crow['class_id'];
			$cnam= $crow['class_name'];
			$outv .= "<tr>
				<td>$clid</td>
				<td><a href='setsubj.php?classid=$clid'>$cnam</a></td>
				<td><a href='setsubj_edit.php?classid=$clid'>Edit</a></td>
			</tr>";
		}
			$outclass= "<table><tr>
			<th>Id</th>
			<th colspan='2'>Class</th>
			$outv
				</tr></table>";	

	if(isset($_POST['add']))
	{
		 $getpre= $_POST['pre'];
		 $getmark= $_POST['mark'];
		 $getclass= $_POST['class'];
		 $getteacher= $_POST['teacher'];
		 $getsubj= $_POST['subject'];
		 
		 $checkdata= mysqli_num_rows(mysqli_query($new,"SELECT * FROM `stc_info` WHERE subjid=$getsubj AND cid=$getclass"));
		 if($checkdata==0)
		 {				 
			 $stcsql= "INSERT INTO `stc_info`(`subjid`, `tid`, `cid`, `mark`, `pre_status`) VALUES ('$getsubj','$getteacher','$getclass','$getmark','$getpre')";
			 $stcstatus= $new->query($stcsql);
			 if($stcstatus){$msg .="Success";} else {$msg .="Somthing is went to wrong :(";}		
		 }	else {
			 $msg .="This Subject Already Added";
		 }
		 $msg .= "Refreshing...4s";
	echo $refresh;
	}








		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Subject Costomize</title>
	<link rel="icon" href="../../img/icon.ico" />
	<link rel="stylesheet" href="../../style.css" />
	<link rel="stylesheet" href="../../style_1.css" />
</head>
<body>
	<?php include"../../header.php";?>
	<div class="column1">
	<div style='background:green;padding:3px;'>
	<a style='color:white' href="../index.php">Home</a>
		<div id="i" class="right_change"></div> 
	<a href="index.php" style='color:white'>Result</a>
		<div id="i" class="right_change"></div> 	
	</div>
	<?php echo $subject_view;?>
	<form action="setsubj.php" method="POST">
		<input style="width:90%;" type="text" name="sub_name"/>
		<input type="submit" name="sub_submit" value="Add Subject"/>
	</form></div>
	<div class="column2">
	<?php echo $msg;?>		
	<table><?php echo $view;?>		</table>
	<form action="setsubj.php<?php echo $setsss;?>" method="POST">
			Select class:			
			<?php echo $coption;?>
			
			
			Select Subject:		<select name="subject" id="subject" required>
				<option value="">Choose</option>
				<?php echo $soption;?>
				</select>			
			Select Teacher:
				<select name="teacher" id="teacher" required>
				<option value="">Choose</option>
				<?php echo $toption;?>
				</select>
			Pre Semester: 	
				<select name="pre" id="pre" required>
					<option value="0" selected>Disable</option>
					<option value="1" >Enable</option>
				</select>
			Marks: 	
				<input type="number" name="mark" style="width:50px;" required/>
			<input type="submit" value="add"  name="add" id="add"/>
	</form>
		
	
	</div>
	<div class="column3">
	Selected: <u><b><?php echo $classaccess;?></b></u>	
		<?php echo $outclass;?>
	</div>
</body>
</html>