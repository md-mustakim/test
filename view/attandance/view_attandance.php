<?php
    $starttime = microtime(true);
	session_start();
	date_default_timezone_set('Asia/Dhaka');
	include('../../db.php');
	include('../../function_list.php');
	include('../../Controller/attendanceController.php');
	$attendance_obj = new attendanceController();
	if(!isset($_GET['date']))
	{
		header('location: index.php');
	}
	else 
	{
		$date=$_GET['date'];
	
	}

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<link rel="stylesheet" href="../../src/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../../src/fa/css/all.css" />
	<meta charset="UTF-8">
	<title><?php echo $date;?> View Attendance </title>
	
</head>
<body>
<?php include "../header.php"; ?>

	<div class="row m-0 p-0">
        <div class="col-md-2">
            <a href="index.php" class="btn btn-info w-100 mt-2">Home</a>


            <?php
                foreach ($attendance_obj->show_classList() as $item => $value){
                    ?>
                    <a class="text-decoration-none" href="view_attandance.php?class=<?php echo $value['class_id']; ?>&date=<?php echo $_GET['date'];?>&month=<?php echo $_GET['month'];?>&year=<?php echo $_GET['year'];?>">
                    <div class="w-100 text-light p-2 mt-2 font-weight-bold <?php echo($_GET['class'] == $value['class_id'] ? "bg-success" : "bg-info"); ?>">
                        <?php echo $value['class_name']; ?>
                        <span class="float-right">
                        <?php echo $value['shift']; ?>
                        </span>

                    </div>
                    </a>
                    <?php
                }

            ?>
        </div>
        <div align='center' class="col-md-5">


            <br />
            <?php /*echo attand($date,'1');*/?>

            <?php
            $attendance_obj->date = $_GET['date'];
            $attendance_obj->month = $_GET['month'];
            $attendance_obj->year = $_GET['year'];
            $attendance_obj->class = $_GET['class'];
            if($attendance_obj->show_attendance_by_date()['status'] === false){

             ?>
            <?php $analizer= (object)$attendance_obj->show_attendance_by_date()['calculate_data']; ?>
            <table class='table table-sm table-hover table-bordered table-info'>
                <tr>
                    <th>Total Student: <?php echo $analizer->totalStudent; ?> </th>
                    <th>Today Present:  <?php echo $analizer->present; ?></th>
                    <th>Today Absent:  <?php echo $analizer->absent; ?></th>
                    <th>Presence:  <?php echo $analizer->presence; ?>%</th>
                </tr>
            </table>

            <table class="table table-sm table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Roll</th>
                    <th>Class</th>

                    <th>Presence</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($attendance_obj->show_attendance_by_date()['res'] as $item => $value){ $data = (object)$value;  ?>
                    <tr>
                        <td><a href="../edit_student.php?student_id=<?php echo $data->id;?>"> <?php echo $data->name;?> </a> </td>
                        <td> <?php echo $data->class_roll;?> </td>
                        <td> <?php echo $data->class['class_name']." (".$data->class['shift'].")";?> </td>

                        <td> <?php
                            echo ($data->attend === 1 ?  "<i class='fa fa-check text-success'></i>" :  "<i class='fa fa-times-circle text-danger'></i>");

                            ?>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <?php }else{ echo "NO DATA FOUND"; } ?>
        </div>
        <div class="col-md-5">
            <table class="table table-hover table-sm table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>class</th>
                        <th>shift</th>
                        <th>presence</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attendance_obj->show_classList() as $i => $v){
                        $class_data = (object)$v;

                        $alalizer = (object)$attendance_obj->attend_percent($_GET['date'],$_GET['month'],$_GET['year'],$class_data->class_id);

                        ?>
                        <tr>
                            <td><?php echo $class_data->class_name;?></td>
                            <td><?php echo $class_data->shift;?></td>
                            <td><?php
                                if($alalizer->status ==0) {
                                    echo graph($alalizer->presence);
                                }else if($alalizer->status ==1){
                                    echo "Attendance are not taken";
                                }else{
                                    echo "NO Student found";
                                }
                                ?>
                            </td>
                            <td>

                            </td>


                        </tr>

                    <?php }?>
                </tbody>
            </table>

        </div>
    </div>
</body>
</html>
<?php
    $endtime = microtime(true);
     echo number_format( $endtime-$starttime, 4)."s";
?>