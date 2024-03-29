<?php
namespace Model;
use PDO;
use PDOException;
class Attendance{
    private $table = "attandance";
    private PDO $connect;
    public $id;
    public $unique_id;
    public $student_name;
    public $father_name;
    public $mother_name;
    public $father_number;
    public $mother_number;
    public $birth_date;
    public $class;
    public $class_roll;
    public $allStudentCount;
    public $address;
    public $send_sms_status;
    public $image_path;
    public $amount;
    public function __construct()
    {

        $this->connect = (new Config())->connection;
    }

    public function show_attendance_by_date($date,$month,$year,$class)
    {
     //   $q = "select * from ".$this->table." where date=$date and month=$month and year=$year";
        $q = "SELECT * FROM student_info LEFT JOIN attandance ON student_info.id=attandance.unid
														WHERE attandance.date= $date 
														  and attandance.month=$month 
														  and attandance.year=$year and student_info.class = $class
														ORDER BY `student_info`.`class_roll` ASC";
        $stm = $this->connect->prepare($q);
        $stm->execute();
        $this->allStudentCount = $stm->rowCount();
        return $stm->fetchAll();
    }
    public function absent($date,$month,$year,$class)
    {
        $q = "SELECT * FROM student_info LEFT JOIN attandance ON student_info.id=attandance.unid
														WHERE attandance.date= $date 
														  and attandance.month=$month 
														  and attandance.year=$year 
														  and student_info.class = $class 
														  and attandance.attand = 0
														ORDER BY `student_info`.`class` ASC";
        $stm = $this->connect->prepare($q);
        $stm->execute();
        return $stm->rowCount();
    }
    public function present($date,$month,$year,$class)
    {
        $q = "SELECT * FROM student_info LEFT JOIN attandance ON student_info.id=attandance.unid
														WHERE attandance.date= $date 
														  and attandance.month=$month 
														  and attandance.year=$year 
														  and student_info.class = $class 
														  and attandance.attand = 1
														ORDER BY `student_info`.`class` ASC";
        $stm = $this->connect->prepare($q);
        $stm->execute();
        return $stm->rowCount();
    }
    public function status($date,$month,$year,$class)
    {
        $q = "SELECT * FROM student_info LEFT JOIN attandance ON student_info.id=attandance.unid
														WHERE attandance.date= $date 
														  and attandance.month=$month 
														  and attandance.year=$year 
														  and student_info.class = $class														  
														ORDER BY `student_info`.`class` ASC";
        $stm = $this->connect->prepare($q);
        $stm->execute();
        return $stm->rowCount() === 0;
    }






    public function show_studentByclass($class_id)
    {
        $q = "select * from ".$this->table." where status=1 and class = ".$class_id." ORDER BY class_roll ASC";
        $stm = $this->connect->prepare($q);
        $stm->execute();
        $this->allStudentCount = $stm->rowCount();
        return $stm->fetchAll();
    }
    public function show($id)
    {
        $q = "select * from ".$this->table." where id=$id";
        $stmt = $this->connect->prepare($q);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function makeUniqueId($class)
    {
        $select_id_sql="SELECT * FROM `student_info` ORDER BY `student_info`.`id`  DESC";
        $stmt = $this->connect->prepare($select_id_sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count >0){
            $row= $stmt->fetch();
            $last_id= $row['id'];
        }
        else {
            $last_id = 0;
        }
        $new_id =  $last_id + 1;
        $build_class_id     = str_pad($class, 3, '0', STR_PAD_LEFT);
        $build_id           = str_pad($new_id, 5,'0', STR_PAD_LEFT);
        return date('y').$build_class_id.$build_id;
    }
    public function perClassStudent($class_id) // count
    {
        $q = "select * from ".$this->table." where status=1 and class =".$class_id;
        $stmt = $this->connect->prepare($q);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public function perClassStudentShow($class_id) // show all student in individual class
    {
        $q = "select * from ".$this->table." where status=1 and class =".$class_id;
        $stmt = $this->connect->prepare($q);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function create()
    {
        $q= "INSERT INTO `student_info`(`class`, `name`, `fname`, `fnumber`, `mname`, `mnumber`, `birth`, `address`, `amount`, `pic`,`uniqueid`)
		    VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $data = array($this->class,$this->student_name,$this->father_name,$this->father_number,$this->mother_name,$this->mother_number,$this->birth_date,$this->address,$this->amount,$this->image_path,$this->unique_id);

        $result = $this->connect->prepare($q)->execute($data);

        return($result);











        /*   $message="Congratulations!!!
           Dear $nm,
           Your Registration is successfully completed.
           Thanks
           Holy Care School";

           $number="$fnum,$mnum";
           $campagine="Registration";*/
    }



}
