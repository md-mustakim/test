<?php
require "../model/Student.php";
require "../model/Config.php";
$con = new config();
$student = new student($con->dbconnect());
$connect = $con->dbconnect();


$restudent = array();
//var_dump($class->all_class());
foreach ($student->all_student() as $item => $value)
{
    $classes[$value['id']] = array(
        'id' => $value['id'],
        'name' => $value['name'],
        'father_name' => $value['fname'],
        'father_phone' => $value['fnumber'],
        'mother_name' => $value['mname'],
        'mother_phone' => $value['mnumber']

    );

}



header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Headers: Content-Type, origin");

echo json_encode($student->all_student());