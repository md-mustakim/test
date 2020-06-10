<?php $host = "209.236.118.251"; $user = "holycare_remotes"; $pass = "shaifulm.29"; $db = "holycare_app"; 
$new = mysqli_connect($host,$user,$pass,$db,3306); 
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>