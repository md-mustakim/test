<?php
//	$rols= $_GET['r'];
	$clss= $_GET['c'];
		function serial($classid,$rollnon)
		{
			include "../db.php";       
			$q = "SELECT * FROM `fm19` LEFT JOIN student_info ON fm19.uniid = student_info.uniqueid where class=$classid
			ORDER BY `fm19`.`marks` DESC";
			$qq = mysqli_query($new,$q);
			$i = 0;
			$rs = 0;
			$returnid = 0;
			
			
			while($r=mysqli_fetch_assoc($qq))
			{
				$i = $i+1;
				$rs++;
				$marks = $r['marks'];				     
				
				if($rollnon == $roll)
				{
				   
					$returnid = array($marks,$i);
				}
				
			
			}
		
      
			return $returnid;
	   }
     
	 include "../db.php";
	 $c = $clss;
	 $trr = "";
	// echo serial(1,9);
	 $qa = mysqli_query($new,"SELECT * FROM `fm19` LEFT JOIN student_info ON fm19.uniid = student_info.uniqueid where class=$clss ORDER BY `fm19`.`marks` DESC");
		while($a=mysqli_fetch_assoc($qa))
		{
			$idd=$a['uniqueid'];
			$rolls=$a['class_roll'];
			$n=$a['name'];
			$r=$a['class_roll'];
			$position = serial($c,$rolls);
			$trr .="<tr>
				<td>$n</td>
				<td>$r</td>
				<td>$position[0]</td>
				<td>$position[1]</td>				
			</tr>";
		}
		
		echo "<table>
		<tr>
		<th>Name</th>
		<th>Roll</th>
		<th>Marks</th>		
		<th>Position</th>
		</tr>
		$trr</table>"
  
?>