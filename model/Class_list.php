<?php
    namespace Model;
    use PDO;
    use PDOException;
    class Class_list{
        private PDO $connect;
        private string $table = "class_list";

        public int $allClassCount;


        public function __construct()
        {
            $config = new Config();
            $this->connect = $config->connection;
        }

        public function all_class(): array
        {
            try {
                $q = "select * from class_list";
                $stm = $this->connect->prepare($q);
                $stm->execute();
                $this->allClassCount = $stm->rowCount();
                return array(
                    'status' => true,
                    'data' => $stm->fetchAll(),
                    'count' => $stm->rowCount()
                );
            }catch (PDOException $PDOException){
                return array(
                    'status' => false,
                    'error' => $PDOException
                );
            }

        }


        public function shift_name(int $shift_id)
        {
            if(empty($shift_id))
            {
                return null;
            }else
            {
                $q = "select * from shift where shift_id = $shift_id";
                $stm = $this->connect->prepare($q);
                $stm->execute();
                return $stm->fetch();
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
        public function classAndShiftName($class_id): array // view single class and shift
        {
            $q = "select * from ".$this->table." where class_id = '".$class_id."'";
            $stmt = $this->connect->prepare($q);
            $stmt->execute();
            $result = $stmt->fetch();
            $data = array();
            $shift_name = $this->shift_name($result['shift']);
            if($shift_name == null)
            {
                return $data;
            }else
            {$shift_name['shift_name'] = $this->shift_name($result['shift'])['shift_name'];
                $data = [
                    'class_name' => $result['class_name'],
                    'shift' => $shift_name['shift_name']
                ];
                return $data;
            }

        }
    }

