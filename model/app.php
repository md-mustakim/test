<?php


    class app
    {
        public $app_name = " | Holy Care School";

        private function db()
        {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "holycare_app";

            $con = mysqli_connect($host, $user, $pass, $db);
                    mysqli_set_charset($con,"utf8");
            return $con;

        }

        //     =======================================================================================================================
        function count($query)
        {
            return mysqli_num_rows(mysqli_query($this->db(), $query));
        }

        //=======================================================================================================================
        function view($query)
        {
            $this->db()->query($query);

            $c = mysqli_query($this->db(), $query);
            $rows = array();
            while ($row = mysqli_fetch_assoc($c)) {
                array_push($rows, $row);
            }
            return $rows;

        }    //=======================================================================================================================

        function view_single($query)
        {
            $this->db()->query($query);
            $c = mysqli_query($this->db(), $query);
            return mysqli_fetch_assoc($c);
        }

        //=======================================================================================================================
        public function insert($query) // insert data
        {
            $result = $this->db()->query($query);
            if (!$result) {
                return false;
            } else {
                return true;
            }
        }
        public function filterNumber($numbers)
        {
            $arre = explode(",",$numbers);


            foreach ($arre as $item => $value) {
                $filterd_number = "";
                $re = array();
                if(strlen($value) === 11)
                {
                    $r = preg_match("/01/",$value);
                    if($r === 1)
                    {
                        $filterd_number .= $value.",";
                    }
                }



            }
            return $numbers;
        }

        //=======================================================================================================================
            public function classConverter($class_id)
            {
                $class_datas = $this->view_single("SELECT * FROM `class_list` WHERE class_id =  '$class_id'");
                return $class_datas['class_name'];
            }
        //=======================================================================================================================
        function findClassByGroup($group_id)
        {
            $class_data= $this->view("select * from class_list where shift=$group_id");
            $classes = "";
            foreach ($class_data as $item => $value)
            {
                    $classid = $value['class_id'];
                    $classname = $value['class_name'];
                    $shift = $value['shift'];
                    $classes .= "class=".$classid." or ";
            }

            $sub= rtrim($classes," or ");

             $query = "select * from student_info where $sub and status=1";

            $datas = $this->view($query);
            return $this->makeNumber($datas);

        }
        //=======================================================================================================================
        function makeNumber($datas)
        {
            $numbers = "";
            foreach ($datas as $data => $vale) {
                $number = $vale['mnumber'];
                $numbers .= $number.",";

            }
            return $numbers;
        }


        function getSmsNumberByGroup($groupid)
        {
            if($groupid == 100) // all student
            {
                $q = "select * from student_info where status = 1";
                $student_datas = $this->view($q);
                return $this->makeNumber($student_datas);
            }else if($groupid == 200)
            {
                $q = "select * from teacher_info where admin <3";
                $tedatas = $this->view($q);
               $numbers = "";
                foreach ($tedatas as $data => $ar)
                {
                    $numbers .= $ar['number'].",";
                }
                return $numbers;

            }else{
                return $this->findClassByGroup($groupid);
            }



        }
        // =======================================================================================================================

        function receiver_name($number_code)
        {
            if($number_code == 100) // all student
            {
                return "All Student";
            }
            else if($number_code == 200)
            {
                return "Staff / Teacher";
            }else
            {
                $group_datas =$this->view_single("select * from shift where shift_id=$number_code");
                return $group_datas['shift_name'];
            }

        }
        // =======================================================================================================================
        public function studentCountByShiftId($shift_id)
        {
            $count = 0;
            $class_datas = $this->view("select * from class_list where shift=".$shift_id);
            foreach ($class_datas as $data => $value)
            {
                $count += $this->count('SELECT * FROM `student_info` WHERE class='.$value['class_id']);
            }
            return $count;
            
        }
    }




?>