<?php
    namespace Model;
    use PDO;
    use PDOException;
    class Student{
        private PDO $connect;
        public int $id;
        public string $unique_id;
        public string $student_name;
        public string $father_name;
        public string $mother_name;
        public string $father_number;
        public string $mother_number;
        public string $birth_date;
        public string $class;
        public string $class_roll;
        public string $address;
        public string $image_path;
        public string $amount;
        public function __construct()
        {
            $config = new Config();
            $this->connect = $config->connection;
        }

        public function allStudent(): array
        {
            try {
                $q = "select * from student_info where status = 1";
                $stm = $this->connect->prepare($q);
                $stm->execute();
                return array(
                    'status' => true,
                    'count' => $stm->rowCount(),
                    'data' => $stm->fetchAll()

                );
            }catch (PDOException $PDOException)
            {
                return array(
                    'status' => false,
                   'error' => $PDOException
                );
            }
        }
        public function showStudentByClass($class_id): array
        {
            try {
                $q = "select * from student_info where status=1 and class = ".$class_id;
                $stm = $this->connect->prepare($q);
                $stm->execute();
                return array(
                    'status' => true,
                    'count' => $stm->rowCount(),
                    'data' => $stm->fetchAll()
                );
            }catch (PDOException $PDOException)
            {
                return array(
                    'status' => false,
                    'error' => $PDOException
                );
            }
        }
        public function show($id): array
        {
            try {
                $q = "select * from student_info where id=$id";
                $stmt = $this->connect->prepare($q);
                $stmt->execute();
                return array(
                    'status' => true,
                    'data' => $stmt->fetch()
                );
            }catch (PDOException $PDOException)
            {
                return array(
                    'status' => false,
                    'error' => $PDOException
                );
            }
        }

        public function makeUniqueId(int $class): string
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
        public function perClassStudent(int $class_id): int // count
        {
            $q = "select * from student_info where status=1 and class =".$class_id;
            $stmt = $this->connect->prepare($q);
            $stmt->execute();
            return $stmt->rowCount();
        }
        public function perClassStudentShow(int $class_id): array // show all student in individual class
        {
            try {
                $q = "select * from student_info where status=1 and class =".$class_id;
                $stmt = $this->connect->prepare($q);
                $stmt->execute();
                return array(
                    'status' => true,
                    'count' => $stmt->rowCount(),
                    'data' => $stmt->fetchAll()
                );
            }catch (PDOException $PDOException)
            {
                return array(
                    'status' => false,
                    'error' => $PDOException
                );
            }
        }


        public function create(): array
        {
            try {
                $q= "INSERT INTO `student_info`(`class`, `name`, `fname`, `fnumber`, `mname`, `mnumber`, `birth`, `address`, `amount`, `pic`,`uniqueid`)
		    VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                $data = array(
                    $this->class,
                    $this->student_name,
                    $this->father_name,
                    $this->father_number,
                    $this->mother_name,
                    $this->mother_number,
                    $this->birth_date,
                    $this->address,
                    $this->amount,
                    $this->image_path,
                    $this->unique_id
                );

                $result = $this->connect->prepare($q)->execute($data);

                if ($result){
                    return array(
                        'status' => true
                    );
                }else
                    return array(
                        'status' => $result
                    );
            }catch (PDOException $PDOException){
                return array(
                    'status' => false,
                    'error' => $PDOException
                );
            }
        }
    }
