<?php
	session_start();
$msg= "";
include "../../db.php";
	date_default_timezone_set('Asia/Dhaka');
	if(isset($_POST['u']))
	{
		
		$uname = $_POST['u'];
		$pass = $_POST['p'];
		$re = $_POST['r'];
		

		$uname = strip_tags($_POST['u']);
		$pass = strip_tags($_POST['p']);
		$uname = stripcslashes($_POST['u']);
		$pass = stripcslashes($_POST['p']);			
		$uname = mysqli_real_escape_string($new,$uname);
		$pass = mysqli_real_escape_string($new,$pass);		
		$passs = md5($pass);	
		if($_POST['r']==null){
			$re="0";
		} else {$re= $_POST['r'];}	
		//	$sql = "SELECT * FROM teacher_info WHERE name LIKE '%".$uname."%' OR email LIKE '%".$uname."%' OR number LIKE '%".$uname."%' LIMIT 1";		
			$sql = "SELECT * FROM teacher_info WHERE name='$uname' OR email='$uname' OR number='$uname' LIMIT 1";
			$query = mysqli_query($new,$sql);
			$row = mysqli_fetch_array($query);	
			$id = $row['id'];
			$nam = $row['name'];	
			$db_pass = $row['pass'];		
			$admin = $row['admin'];		
		if($passs == $db_pass && $admin == 1)
		{		
			$_SESSION['admin'] = $nam;
			$_SESSION['id'] = $id;						
			//cookies-----------
			if($re==0){
				$cookie = setcookie('uname',$uname, time()+60*60*6);

			}
			else {
			$cookie = setcookie('uname',$uname, time()+60*60*60);		
			}	setcookie('id',$id, time()+60*60*6);
				
			
			$msg .="<div class='loading'>Loading&#8230;</div><script type='text/javascript'> setTimeout(function(){ window.location.href = '../index.php';} , 500);</script>";
		}
		else if($admin == null)
		{
			$msg .="<p class='form-text bg-danger text-light p-2'>You are not Authorized Contact: Admin</p>";
		}
		else
			{
				$msg .="<p class='form-text bg-danger text-light p-2'>Invalite name or password</p>";
			}	
	}
	echo $msg;
?>