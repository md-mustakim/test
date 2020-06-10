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

    <title>Reset Password | Holy Care School</title>
    <link rel="icon" href="../img/icon.ico" />

    <script src="../src/jquery_2_1_3.min.js"></script>
    <link rel="stylesheet" href="../src/bootstrap.min.css" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>


<?php include "../header.php"; ?>
<div class="row m-0 p-0">
    <div class="col-sm-2 bg-light">
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = '../index.php';">
            Return Home
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'class.php';">
            Class Setting
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'shift.php';">
            Shift Setting
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'reset_pass.php';">
            Reset password
        </button>

    </div>
    <div class="col-sm-10">
        <div class="w-75 border p-3 mt-2 mx-auto">
            <span id="msg"></span>

            <div class="h5 p-2 mb-3 bg-light">Password Reset</div>

            <label for="old_pass">Enter Current Password: </label>
            <input class="form-control" type="password" name="old_pass" id="old_pass">


            <label for="old_pass">Type New Password: </label>
            <input class="form-control" type="password" name="new_pass" id="new_pass">

            <label for="old_pass">Retype New Password: </label>
            <input class="form-control" type="password" name="new_pass_re" id="new_pass_re">

            <input type="submit" class="btn btn-success mt-3" name="submit" onclick="update()">
        </div>
    </div>

</div>


</body>
<script>


    function update() {
        var old_pass = document.getElementById("old_pass").value;
        var new_pass = document.getElementById("new_pass").value;
        var msg = document.getElementById("msg");

        var cooke = document.cookie;
        var c = cooke.split(";");
        var userid = c[1];


        $.ajax({
           url: 'ajax.php',
            method: 'post',
            data:{reset_pass:1,old_pass: old_pass,new_pass:new_pass,userid:userid},
            success:function(data){
               msg.innerHTML =data;

                },

        });


    }
</script>
</html>