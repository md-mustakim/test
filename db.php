<?php


	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "holycare_app";


    $new = mysqli_connect($host,$user,$pass,$db);
    if($new){
        $new = mysqli_connect($host,$user,$pass,$db);
    }else
    {
        $host = "localhost";
        $user = "holycare_info";
        $pass = "holycare_info_29";
        $db = "holycare_app";
        $new = mysqli_connect($host,$user,$pass,$db);

    }
	







?>
