<?php
    require "../model/Config.php";
    require "../model/Student.php";
    require "../model/Class_list.php";



    class dashboard{
        private $student;
        private $class_list;



        public function __construct()
        {
            $connect = new config();
            $con = $connect->dbconnect();

            $this->student = new student($con);
            $this->class_list = new Class_list($con);

        }


        public function classView()
        {

            foreach ($this->class_list->all_class() as $item => $value)
            {
                $classid = $value['class_id'];
                $class_name = $value['class_name'];
                $shift = $this->class_list->shift_name($value['shift']);
                $classperstudent = $this->student->perClassStudent($classid);
                $ap[] = array($class_name, $shift['shift_name'], $classperstudent);
                ;
            }
            return $ap;

        }

    }