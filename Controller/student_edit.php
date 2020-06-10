<?php
require "../model/Config.php";
require "../model/Student.php";
require "../model/Class_list.php";



class student_edit{
    private $connect;
    private $class_list;
    private $student_id;


    public $name;
    public $class;
    public $father_name;
    public $father_number;
    public $mother_name;
    public $mother_number;
    public $birth_day;
    public $amount;
    public $image_path;
    public $address;
    public $class_roll;
    public $status;
    /**
     * @var student
     */
    private $student;


    public function __construct($student_id)
    {
        $this->student_id = $student_id;
        $connect = new config();
        $this->connect = $connect->dbconnect();
        $this->class_list = new Class_list($this->connect);
        $this->student = new student($this->connect);


    }
    public function show_student()
    {
        return $this->student->show($this->student_id);
    }

    public function update(){
        $q = "UPDATE student_info SET name=?, class=?, fname=?, fnumber=?, mname=?, mnumber=?, birth=?, address=?, amount=?, status=?, class_roll=? WHERE id=?";
        $stmt =$this->connect->prepare($q);
        $value = [$this->name,$this->class,$this->father_name,$this->father_number,$this->mother_name,$this->mother_number,$this->birth_day,$this->address,$this->amount,$this->status,$this->class_roll,$this->student_id];
        return $stmt->execute($value);
    }

    public function all_class_shift()
    {
        return $this->class_list->class_shift();

    }


}