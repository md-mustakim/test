<?php
	include "../db.php";
	if(isset($_POST['check']))
	{
		$search = $_POST['check'];
		$number_lenth = strlen($search);	
		if($number_lenth<10 || $number_lenth>12)
		{
			echo "complete the number";
		}else
		{
			
		
	
		$querys= mysqli_query($new,"SELECT *  FROM `student_info` WHERE `fnumber` LIKE '%".$search."%'  OR `mnumber` LIKE '%".$search."%'");
		$count = mysqli_num_rows($querys);
		if($count<1)
		{
			echo "<p class='bg-success text-light'>No data found</p>";
		}
		else{
			$name="";
			while($rows = mysqli_fetch_assoc($querys))
			{
				$name .= $rows['name'].",";				
			}
			echo "<p class='bg-danger text-light'>$count Student found ($name)</p>";
		}
		}
	}
?>