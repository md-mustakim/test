<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="../../src/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../src/fa/css/all.css" />
    <link rel="x-icon" href="../img/icon.ico" />
</head>
<body>
    <?php include "../header.php"?>
    <div class="row m-0 p-0">
        <div class="col-md-10 mx-auto">
            <?php
                $student_id = $_GET['student_id'];
                $type = $_GET['type'];
                require "../../Controller/resultController.php";
                $resultController = new resultController();
                foreach($resultController->mark_view($_GET['student_id'],$_GET['type'])['result'] as $i => $v){
               //     var_dump($v);
                    echo "<br>";
                }
               // var_dump($resultController->mark_view($_GET['student_id'],$_GET['type'])['total']);
                //var_dump($resultController->mark_view($_GET['student_id'],$_GET['type']));
            ?>


            <table class="table table-sm table-hover table-bordered">
                <?php $info = (object)$resultController->mark_view($student_id,$type)['student_info']; ?>
                <tr>
                    <th> Name: <?php echo $info->name;?> </th>
                    <th> Class: <?php echo $info->class['class_name'];?> </th>
                    <th> Shift: <?php echo $info->class['shift'];?> </th>
                    <th> Total Marks: <?php echo $info->total;?> </th>


                </tr>


            </table>

            <table class="table table-sm table-hover table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Subject</th>
                    <th>Marks</th>
                </tr>
                </thead>
                <?php foreach ($resultController->mark_view($student_id,$type)['result'] as $item => $value){ $mark = (object)$value; ?>
                    <tr>
                        <td><?php echo $mark->subject_name;?></td>
                        <td><?php echo $mark->marks;?></td>
                    </tr>

                <?php }  ?>
                <tr>
                    <td>Total</td>
                    <td><?php echo $info->total;?> </td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>