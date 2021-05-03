<?php
namespace Controller;
use Model\Student;
use Model\Class_list;
use Model\Config;
use PDO;
use PDOException;
 class search{
     public string $keyword;
     public PDO $con;
     public Student $student;
     public Class_list $class;
     public function __construct()
     {
         $this->con = (new config())->connection;
         $this->student =new student();
         $this->class = new Class_list();
     }
     public function classAndShift($classId){
         return $this->class->classAndShiftName($classId);
     }

     public function liveSearch()
     {
         if(empty($this->keyword))
         {
             $q= "SELECT * FROM student_info where status=1 order by student_info.id DESC LIMIT 10";
             $stmt = $this->con->prepare($q);
             $stmt->execute();
         }else
         {
             $q = "SELECT * FROM student_info where status=1 and name LIKE ? LIMIT 10";
             $stmt = $this->con->prepare($q);
             $parms = array("%$this->keyword%");
             $stmt->execute($parms);



         }
        if($stmt->rowCount() == 0)
        {
            return null;
        }else
        {
            $data = array();
            $r = $stmt->fetchAll();
            foreach ($r as $item => $value)
            {
                $classAndShift = $this->class->classAndShiftName($value['class']);
                $data[] = [
                    'id' => $value['id'],
                    'name' => $value['name'],
                    'class_roll' => $value['class_roll'],
                    'class' => $classAndShift['class_name'],
                    'shift' => $classAndShift['shift'],
                    'fname' => $value['fname'],
                    'mnumber' => $value['mnumber'],



                ];


            }
            return json_decode(json_encode($data));
        }


     }

     public function all_class_shift(){
         return  $this->class->class_shift();

     }
     public function search_by_class(int $class_id): array
     {
         $r = $this->student->showStudentByClass($class_id);
         $data = array();
         foreach ($r['data'] as $i => $k)
         {
             $data[] = [
               'student_id' => $k['id'],
               'uniqueid' => $k['uniqueid'],
               'class_roll' => $k['class_roll'],
               'student_name' => $k['name'],
               'father_number' => $k['fnumber'],
               'mother_number' => $k['mnumber'],
             ];
         }
         return $data;

     }

 }
