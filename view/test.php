<?php
    require "../model/Student.php";
    require "../model/Class_list.php";
    require "../model/Config.php";
    $config = new config();
    $student= new student($config->dbconnect());
    $class= new Class_list($config->dbconnect());

    var_dump(__DIR__);
    $a = 15;
    $b = 26;

    for ($i=0;$i<10;$i++)
    {
        $data[] = array(
            'ids' => $i
        );
    }
    for ($i=0;$i<10;$i++)
    {
        $data[] = array(
            'id' => $i
        );
    }
    foreach ($data as $d => $is)
    {
        var_dump($is);
    }

echo date('l', strtotime('11/21/2017'));
    ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>


