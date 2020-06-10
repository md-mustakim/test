<?php
	session_start();	
	if(!isset($_SESSION['admin'])){
	header("Location: ../auth/login.php");
	}
	$admin= $_SESSION['admin'];
	include ("../../db.php");

	include '../../model/app.php';
	$app = new app();
	$view_sms_datas = $app->view("SELECT * FROM `sms_data` ORDER BY `sms_data`.`sms_id` DESC ");

?>

<DOCTYPE HTML>
<html lang="en-US">
<head>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta charset="UTF-8">
	<title>Send SMS || HCS App</title>
	
	<link rel="stylesheet" href="../../src/bootstrap.min.css" />
	<link rel="icon" href="img/icon.ico" />
	<style type="text/css">
	textarea{padding:10px; font-size:24px;font-width:bolder;}
	</style>
	
</head>
<body>
	<?php include '../header.php';?>

    <div class="row m-0 p-0">
        <div class="col-md-2">
            <button
                    class="btn btn-info w-100 mb-3 mt-3 font-weight-bold text-light"
                    onclick="window.location.href = '../index.php';">
              Return Home
            </button>

            <button
                    class="btn btn-info w-100 mb-3 font-weight-bold text-light"
                    onclick="window.location.href = 'send_sms.php';">
              Return SMS
            </button>

        </div>
        <div class="col-md-10">
            <div class="m-2 p-2">

                <table class="table table-md table-hover table-responsive-md">
                    <thead class="thead-light">
                    <tr>
                        <th>Receiver</th>
                        <th>Cost</th>
                        <th>TEXT</th>
                        <th>Time</th>
                        <th>Title</th>
                        <th>Admin</th>

                    </tr>
                    </thead>

                    <?php
                        foreach ($view_sms_datas as $data => $item)
                        {   $message = $item['message'];
                            $some = substr($message,0,300)."...";
                            $admin = $item['admin'];
                            $admin = $app->view_single("select * from teacher_info where id=$admin");
                            $time = $item['time'];
                            $time =  date('d-M-Y h:i a', $time);
                            echo "<tbody> <tr>
                                      <td>". $item['receiver_name'] ."</td>
                                      <td>". $item['cost'] ."</td>
                                      <td>". $some ."</td>
                                      <td>". $time."</td>
                                      <td>". $item['msg_title'] ."</td>
                                      <td>". $admin['name'] ."</td>
                              
                                      
                                  </tr></tbody>";
                        }
                    ?>
                </table>
            </div>
        </div>


	</div>
	
</body>
</html> 

