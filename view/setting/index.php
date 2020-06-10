<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
if(!isset($_SESSION['uname'])){
    header("Location: ../login.php");
}
require '../class/app.php';
$app = new app();

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Setting | Holy Care School</title>
    <link rel="icon" href="../img/icon.ico" />

    <link rel="stylesheet" href="../src/bootstrap.min.css" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


<?php include "../header.php"; ?>
<div class="row m-0 p-0">
    <div class="col-sm-2 bg-light">

        <button
            class="btn btn-info w-100 mt-2 font-weight-bold text-light"
            onclick="window.location.href = '../index.php';">
            Return Home
        </button>
        <button
            class="btn btn-info w-100 mt-2 font-weight-bold text-light"
            onclick="window.location.href = 'class.php';">
            Class Setting
        </button>
        <button
            class="btn btn-info w-100 mt-2 font-weight-bold text-light"
            onclick="window.location.href = 'shift.php';">
            Shift Setting
        </button>
        <button
            class="btn btn-info w-100 mt-2 font-weight-bold text-light"
            onclick="window.location.href = 'reset_pass.php';">
            Reset password
        </button>


    </div>
    <div class="col-sm-10">
        <div class="row">

        </div>
    </div>

</div>


</body>
</html>