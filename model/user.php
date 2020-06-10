<?php
    require "Config.php";
    $con = new config();
    class user{
        public $user;
        public $pass;
        public $conn;

        public function __construct($con)
        {
            $this->conn = $con;

        }

        public function login()
        {
            $q = "select * from teacher_info where `number` = '".$this->user."'";
            $stmt = $this->conn->prepare($q);
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count <1)
            {
                return "No user found";
            }else
            {
                $result = $stmt->fetch();
                $pass = $result['pass'];
                if(md5($this->pass) !== $pass)
                {
                    return "Password Not matched";
                }else if(md5($this->pass) == $pass)
                {
                    return true;
                }else
                {
                    return "You can not login";
                }
            }

        }



        public function teacher_list(){
            $q = "select * from teacher_info";
            $stmt
        }





    }
