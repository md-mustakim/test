<?php
require "../../model/Student.php";
require "../../model/Class_list.php";
require "../../model/Config.php";

class resultController{
    public $keyword;
    public $con;
    public $student;
    public $class;
    public $student_id;
    public function __construct()
    {
        $this->con = new config();
        $this->student =new student($this->con->dbconnect());
        $this->class = new Class_list($this->con->dbconnect());
    }



    public function all_class_shift(){
        return  $this->class->class_shift();

    }

    public function classAndShiftName($class_id){
        return  $this->class->classAndShiftName($class_id);

    }

    public function student_view(){
        return (object)$this->student->show($this->student_id);
    }





    public function search_by_class($class_id){
        $r = $this->student->show_studentByclass($class_id);
        $data = array();
        foreach ($r as $i => $k)
        {
            $data[] = [
                'student_id' => $k['id'],
                'uniqueid' => $k['uniqueid'],
                'class_roll' => $k['class_roll'],
                'student_name' => $k['name'],
                'father_number' => $k['fnumber'],
                'mother_number' => $k['mnumber'],             ];
        }
        return $data;

    }

}
