<?php
    require "../model/Student.php";
    require "../model/Class_list.php";
    require "../model/Config.php";
    $config = new config();
    $student= new student($config->dbconnect());
    $class= new Class_list($config->dbconnect());

    var_dump(__DIR__);

