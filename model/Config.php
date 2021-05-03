<?php
namespace Model;
use PDO;
use PDOException;
    class Config{
        public PDO $connection;
        public PDOException $PDOException;

        public function __construct()
        {
            $this->connect();
        }
        public function connect()
        {
            try {

                 $host = "localhost";
                 $user = "root";
                 $pass = "";
                 $db = "holycare_app";


                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                $connect = new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,$pass,$options);
                $this->connection = $connect;

            }catch (PDOException $PDOException)
            {
                echo "Connection Failed".$PDOException;
                $this->PDOException = $PDOException;
            }
            

        }

    }
