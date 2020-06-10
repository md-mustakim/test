<?php
    require "../model/Class_list.php";
    require "../model/Config.php";
    require "../model/Student.php";
    $con = new config();
    $class = new Class_list($con->dbconnect());
    $student = new student($con->dbconnect());
    $connect = $con->dbconnect();


    $classes = array();
    //var_dump($class->all_class());
    foreach ($class->all_class() as $item => $value)
    {
		$shift_name = $class->shift_name($value['shift']);
		$student_count = $student->perClassStudent($value['class_id']);
        $classes[] = array(
            'key' => $value['class_id'],
            'id' => $value['class_id'],
            'name' => $value['class_name'],
            'shift' => $shift_name['shift_name'],
			'student_count' => $student_count,

        );

    }



    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");

    header("Access-Control-Allow-Headers: Content-Type, origin");

    echo json_encode($classes);