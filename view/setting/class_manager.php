<?php
    require "../class/app.php";
    $class_list_query = "";
    
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title><?php echo "$tt";?></title>
    <link rel="icon" href="../img/icon.ico" />

    <link rel="stylesheet" href="../src/bootstrap.min.css" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


<?php include "../header.php"; ?>
<div class="row">
    <div class="col-sm-2 bg-light">
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'admin';">
            Admin Panel
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'result';">
            Result Panel
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'new_student.php';">
            Student Registration
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'search.php';">
            Student Search
        </button>

        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'view_by_class.php';">
            Search by class
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'attandance';">
            Student Attandance
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'teacher_list.php';">
            Teacher Information
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'indexx.php?cls=1&month=<?php echo $months;?>';">
            Student Payment
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'sms/send_sms.php';">
            Send SMS
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'setting';">
            Setting
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'index.php?c=1';">
            Balance Check
        </button>
        <button
            class="btn btn-info w-100 m-2 font-weight-bold text-light"
            onclick="window.location.href = 'logout.php';">
            Logout
        </button>

    </div>
    <div class="col-sm-10">
        <div class="row">

        </div>
    </div>

</div>


</body>
</html>