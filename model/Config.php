<?php
    class config{
        private $db;
        public function __construct()
        {
            $this->connect();
        }

        public function dbconnect()
        {
            return $this->db;
        }

        public function connect()
        {
            try {

                 $host = "localhost";
                 $user = "root";
                 $pass = "";
                 $db = "holycare_app";
				
               // $host = "localhost";
              //  $user = "holycare_info";
              //  $pass = "holycare_info_29";
              //  $db = "holycare_app";

                $options = [
                    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                $con = new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,$pass,$options);




                $this->db = $con;

            }catch (PDOException $exception)
            {
                echo "Connection Failed".$exception->getMessage();
                $this->db = null;
            }
            

        }

    }
