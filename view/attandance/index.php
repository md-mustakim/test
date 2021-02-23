<?php
    $s = microtime(true);
	session_start();
	include('../../db.php');
	include('../../function_list.php');
	require "../../Controller/attendanceController.php";
	$attendanceObj = new attendanceController();
	date_default_timezone_set('Asia/Dhaka');

	if(!isset($_SESSION['admin']))
	{
		header('location:../auth/login.php');
	}
	else 
	{
	    if(!isset($_GET['month']))
        {
            $thismonth = date('m');
            header('location: index.php?month='.$thismonth);
        }

	}
	
	
	

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <link rel="icon" href="../../img/icon.ico" />
    <link rel="stylesheet" href="../../src/bootstrap/css/bootstrap.min.css" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" href="../../src/fa/css/all.css">
	<meta charset="UTF-8">
	<title>Attendance || HCS</title>
</head>
<body>
<?php include"../header.php";?>
	<div class="row m-0 p-0">
        <div class="col-md-2">
            <div class="m-1">
                <button class="btn btn-info w-100 mt-2 font-weight-bold text-light"
                        onclick="window.location.href = '../index.php';">
                    Return Home
                </button>


                <p>Important: Do not take attendance while edit Student Information.</p>

                <?php
                //var_dump(cal_info(0)['months']);
                foreach (cal_info(0)['months'] as $item => $value)
                {
                    ?>
                    <a class="w-100 btn-info p-2 mt-2 text-left btn <?php echo ($_GET['month']==$item ? "active" : "");?>" href="index.php?month=<?php echo $item;?>"><?php echo $value; ?></a>
                    <?php
                }

                ?>


            </div>
        </div>
        <div class="col-md-8" >



            <a href="attand.php?class=1" class="btn btn-info m-3">Take Attendance</a>

            <br />

            <table class="table table-hover table-bordered table-sm">
                <thead class="thead-light">
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Class Count</th>
                    <th>Total Presence</th>
                </tr>
                </thead>
            <?php
                if(isset($_GET['month']))
                {
                    $months = $_GET['month'];
                }else
                {
                    $months = date('m');
                }
                if(isset($_GET['year']))
                {
                    $years = $_GET['year'];
                }else
                {
                    $years = date('Y');
                }
                $attendanceObj->month = $months;
                $attendanceObj->year = $years;

            //var_dump($attendanceObj->dashboard());
            $c = 1;
            foreach ($attendanceObj->dashboard() as $item => $value) {

                if($value['status'] === false)
                {
                    ?>
                    <tr>
                        <td><?php echo $value['full_date'];?></td>
                        <td><?php echo $value['day'];?></td>
                        <td colspan="2" class="text-info small"><?php echo $value['message'];?></td>
                    </tr>
                    <?php
                }else {


            ?>
            <tr>
                <td>
                    <a href="view_attandance.php?class=1&date=<?php echo $value['date'];?>&month=<?php echo $value['month'];?>&year=<?php echo $value['year'];?>">
                    <?php echo $value['full_date'];?>
                    </a>
                </td>
                <td><?php echo $value['day'];?></td>
                <td><?php echo $value['count_class'];?></td>
                <td> <?php echo graph($value['percent']);?> </td>
            </tr>
            <?php $c++; } } ?>

            </table>




        </div>
        <div class="col-2">
        <?php echo date('l d-M-y');?>

        <br />
        <?php echo"Your Ip is:"; echo getip();?>




            <table class="table table-secondary">

                <tr>
                    <th>Class</th>
                    <th>Shift</th>
                </tr>


                <?php foreach ($attendanceObj->getClassList() as $item => $value){ ?>
                    <tr>
                        <td>

                            <?php echo $value['class_name'];?>

                        </td>   <td>


                            <?php echo $value['shift'];?>
                        </td>
                    </tr>
                <?php } ?>

            </table>








	    </div>



</body>
</html>
<?php $e = microtime(true);
    echo number_format($e-$s,4)."s";