<?php
    require __DIR__."/../model/Student.php";
    require __DIR__."/../model/Class_list.php";
    require __DIR__."/../model/Config.php";
    class attendance{
        private $student;
        private $class_list;
        private $connect;
        public $date;
        public $count;
        public $class;

        public function __construct()
        {
            $co = new config();
            $this->connect =  $co->dbconnect();
            $this->student = new student($this->connect);
            $this->class_list = new Class_list($this->connect);

        }

        public function show_classList()
        {
            return $this->class_list->class_shift();
        }

        public function isAttent()
        {
            $q = "SELECT * FROM student_info 
            RIGHT JOIN attandance ON 
            student_info.uniqueid = attandance.unid
             WHERE attandance.cls=".$this->class."
              AND
              attandance.date LIKE '".$this->date."'";
            $stmt = $this->connect->prepare($q);
            $result = $stmt->execute();
             if($result->rowCount() > 0)
             {
                 return false;
             }else
             {
                 return true;
             }
        }
        public function attendList(){
            return $this->student->perClassStudentShow($this->class);
        }

    }