<?php
    namespace Model;
    use PDO;
    class user{
        public string $user;
        public string $pass;
        public PDO $conn;
        public string $connect_id;

        public function __construct($con)
        {
            $this->conn = $con;
            $this->connect_id = "aiMzVfKgS5ZIdLLDhN9CaGHsIy8TX2sXXlCTGg6d";

        }

        public function login(): bool|string
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
        public function login_api()
        {
            $q = "select * from teacher_info where `number` = '".$this->user."'";
            $stmt = $this->conn->prepare($q);
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count <1)
            {
                return false;
            }else
            {
                $result = $stmt->fetch();
                $pass = $result['pass'];
                if(md5($this->pass) !== $pass)
                {
                    return false;
                }else if(md5($this->pass) == $pass)
                {
                    return $result;
                }else
                {
                    return false;
                }
            }

        }



        public function get_permission(int $user_id){
            $q = "select * from teacher_info where id= ?";
            $stmt = $this->conn->prepare($q);
            $stmt->execute([$user_id]);
            if($stmt->rowCount() >0){
                $data = $stmt->fetch();
                return $data['admin'];

            }else{
                return null;
            }

        }









    }
