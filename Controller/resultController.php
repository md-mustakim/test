<?php
require "../../model/Student.php";
require "../../model/Class_list.php";
require "../../model/Config.php";
require "../../model/Subject.php";


class resultController{

    public $con;
    public $subject;
    public $connect;
    public $student;
    public $class;
    public $student_id;
    public function __construct()
    {
        $this->con = new config();
        $this->connect = $this->con->dbconnect();
        $this->student =new student($this->con->dbconnect());
        $this->class = new Class_list($this->con->dbconnect());
        $this->subject = new Subject($this->con->dbconnect());
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

    public function subject_teacher_class_list($class_id)
    {
        $q = "SELECT * FROM stc_info where cid=".$class_id;
        $stmt = $this->connect->prepare($q);
        $stmt->execute();
        $count = $stmt->rowCount();
        $data = $stmt->fetchAll();
        return array(
            'count' =>$count,
            'data' => $data
        );
    }
    public function get_marks($subjid,$unid,$type)
    {
        $q ="SELECT * FROM marksheed_2019 where subject_id=$subjid and regid=$unid and type=$type";
        $stmt = $this->con->dbconnect()->prepare($q);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $count = $stmt->rowCount();
        return array(
            'count' => $count,
            'data' => $data
        );
    }

    public function mark_view($student_id, $type){

        $student_information = (object)$this->student->show($student_id);


        $stc_data = $this->subject_teacher_class_list($student_information->class);
        $mark = 0;
        $total=0;
        foreach ($stc_data['data'] as $item => $key)
        {
            $subject_id = $key['subjid'];
            $get_marks = $this->get_marks($subject_id, $student_information->uniqueid, $type);

            foreach ($get_marks['data'] as $mark => $m)
            {
                $mark = $m['marks'];
            }

            $result[] = array(
                'subject_name' => $this->subject->subject_name($subject_id)->subject_name,
                'marks' => $mark,


            );
            $total += $mark;
        }


        $student_info_real = array(
            'name' => $student_information->name,
            'class' => $this->class->classAndShiftName($student_information->class),
            'roll' => $student_information->class_roll,
            'total' => $total

        );




        return array(
            'student_info' => $student_info_real,
            'result' => $result,
            'total' => $total
        );
    }







}
