<?php

use Controller\dashboard;

$tStart = microtime(true);
    include "../vendor/autoload.php";
    include "auth/session.php";
    $dc = new dashboard();
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Home | Holy Care School</title>
	<link rel="icon" href="../img/icon.ico"/>
    <script src="../src/jquery_2_1_3.min.js"></script>
    <script src="../src/jquery-1.12.0.min.js"></script>
    <link rel="stylesheet" href="../src/fa/css/all.css">
    <link rel="stylesheet" href="../src/custom.css">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">

    <script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
</head>
<body>

<?php include "header.php"; ?>
	<div class="row m-0 p-0">

		<?php include "sidebar.php";?>
		<div class="col-md-10 border m-0 p-0">
            <div class="row m-0 p-0 mt-1 ml-1">

                    <div class="col-md-6 m-0 p-0">
                        <table class="table table-bordered table-responsive-md">
                           <thead class="thead-light">
                               <tr>
                                   <th>Class Name</th>
                                   <th>Shift</th>
                                   <th>Total Student</th>
                               </tr>
                           </thead>
                            <tbody>
                            <?php $total = 0;
                            $dashboard = new dashboard();
                            foreach ($dashboard->classView() as $item => $value){  ?>
                            <tr>
                                <td><?php echo $value['0'];?></td>
                                <td><?php echo $value['1'];?></td>
                                <td><?php echo $value['2'];?></td>
                            </tr>
                            <?php $total = $total + $value[2];
                            } ?>
                            <tr>

                                <td colspan="2">Total</td>
                                <td><?php echo $total;?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 m-0 p-0">
                       <!-- <table class="table table-responsive-md">
                            <thead class="thead-light">
                            <tr>
                                <th>Class Name</th>
                                <th>Shift</th>
                                <th>Total Student</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>-->
                    </div>

            </div>
        </div>
	</div>

				
	<!---script type="text/javascript" src="src/loader.js"></script-->
<script>
    function checkBalance() {
        $.ajax({
            url: '../ajax/index.php',
            method: 'post',
            data: {
                balance: 1,
                check: 1,
            },
            success: function (data) {
               alert(data);
            }
        });
    }
</script>
<?php $end = microtime(true);
    echo $result = round($end-$tStart,3)."s";
?>
<script src="../src/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>