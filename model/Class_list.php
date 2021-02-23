<?php
    class Class_list{
        private $connect;
        private $table = "class_list";

        public $allClassCount;


        public function __construct($connect)
        {
            $this->connect = $connect;
        }

        public function all_class()
        {
            $q = "select * from ".$this->table;
            $stm = $this->connect->prepare($q);
            $stm->execute();
            $this->allClassCount = $stm->rowCount();
            return $stm->fetchAll();

        }
        public function class_count()
        {
            $this->all_class();
            return $this->allClassCount;
        }

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

        public function class_shift() // view all class and shift
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
        public function classAndShiftName($class_id) // view single class and shift
        {
            $q = "select * from ".$this->table." where class_id = '".$class_id."'";
            $stmt = $this->connect->prepare($q);
            $stmt->execute();
            $result = $stmt->fetch();
            $data = array();
            $shift_name = $this->shift_name($result['shift'])['shift_name'];
            if($shift_name == null)
            {
                return $data;
            }else
            {$shift_name = $this->shift_name($result['shift'])['shift_name'];
                $data = [
                    'class_name' => $result['class_name'],
                    'shift' => $shift_name
                ];
                return $data;
            }

        }
    }

