<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Content-Type, origin");


$a = json_decode(file_get_contents("php://input"));
$user = $a->user;
$pass = $->pass;


?>