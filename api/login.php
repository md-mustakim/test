<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method,Access-Control-Allow-Origin");


     require "../model/user.php";
    $con = new config();
    $user = new user($con->dbconnect());


$data = json_decode(file_get_contents("php://input"));
if(isset($data))
{
	
	if (property_exists($data, 'user') && property_exists($data,'pass'))
	{
		$user->user = $data->user;
		$user->pass = $data->pass;
		
		if($user->login() === true)
		{
		echo json_encode(array('status' => 1));	
		}
		else
		{
			echo json_encode(array('status' => 2));
		}
	}else{
		echo json_encode(array('status' => 0));
	}
	
	
}


