<?php
	class persent{
		public function checks($subject,$class)
		{
			include"../db.php";
			$c = mysqli_query($new,"select * from stc_info where subjid=$subject");
			if($c['pre_status']==0)
			{
				$q = "";
				$cal = mysqli_query($new,$q);
			}
		}
	}
?>