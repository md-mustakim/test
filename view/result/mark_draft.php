<?php
	session_start();	

	if(!isset($_SESSION['uname']))
	{
		header("location:../login.php");
	}
	else
	{
		if(!isset($_GET['class']))
		{
			header("locaton:index.php?msg=Select_class_First");
		}
		else
		{
			$class=$_GET['class'];
			$class_query= "select * from stc_info where cid=$class"
			$stc_query = "";

		
		}
	}	

?>