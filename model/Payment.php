<?php
class Payment{
    private $connect;
    private $table = "payment";



    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function due_status($student_id)
    {
        $q = "SELECT * FROM due where studentid=$student_id";
        $stm = $this->connect->prepare($q);
        $stm->execute();
        return $stm->fetchAll();
    }


//---------------------get due amount----------------------






    public function shift_name($shfit_id)
    {
        if(empty($shfit_id))
        {
            return null;
        }else
        {
            $q = "select * from shift where shift_id = $shfit_id";
            $stm = $this->connect->prepare($q);
            $stm->execute();
            $result = $stm->fetch();
            return $result;
        }

    }

    public function class_shift()
    {
        $q = "select * from ".$this->table;
        $stm = $this->connect->prepare($q);
        $stm->execute();
        $this->allClassCount = $stm->rowCount();
        $r =$stm->fetchAll();
        $result = array();
        foreach ($r as $item => $value)
        {
            $shift = $this->shift_name($value['shift'])['shift_name'];
            $result[] = [
                'class_id' => $value['class_id'],
                'class_name' => $value['class_name'],
                'shift' => $shift
            ];
        }
        return $result;


    }
    public function classAndShiftName($class_id)
    {
        $q = "select * from ".$this->table." where class_id = '".$class_id."'";
        $stmt = $this->connect->prepare($q);
        $stmt->execute();
        $result = $stmt->fetch();
        $data = array();
        $shift_name = $this->shift_name($result['shift'])['shift_name'];
        $data = [
            'class_name' => $result['class_name'],
            'shift' => $shift_name
        ];
        return $data;
    }
}

