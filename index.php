<?php //
    header("location: view");
    $tstart = microtime(true);
    require "Controller/dashboard.php";
    $dc = new dashboard();

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title></title>
	<link rel="icon" href="img/icon.ico"/>
    <script src="src/jquery_2_1_3.min.js"></script>
    <script src="src/jquery-1.12.0.min.js"></script>
    <link rel="stylesheet" href="src/fa/css/all.css">
    <link rel="stylesheet" href="src/custom.css">
    <link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">

    <script src="src/bootstrap/js/bootstrap.min.js"></script>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
</head>
<body>

<?php include "header/header.php"; ?>
	<div class="row m-0 p-0">

		<div class="col-md-2 m-0 p-0">
            <div class="mt-1 mr-1">
                <div class="h-100 w-100 bg-info">


                            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" data-toggle="collapse" data-target="#drop"> Student
                                <i class="fas fa-angle-down float-right p-1"></i>
                            </div>

                            <div class="collapse text-light p-0 m-0 text-light" id="drop">
                                 <ul class="list-group list-group-flush p-0 m-0">
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="new_student.php" class="text-decoration-none text-light">Add Student</a> </li>
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="search.php" class="text-decoration-none text-light">Search Student</a> </li>
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="view_by_class.php" class="text-decoration-none text-light">Class list</a> </li>
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="attandance" class="text-decoration-none text-light">Student Attendance</a> </li>
                                </ul>
                            </div>


                            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" data-toggle="collapse" data-target="#result"> Result
                                <i class="fas fa-angle-down float-right p-1"></i>
                            </div>

                            <div class="collapse text-light p-0 m-0 text-light" id="result">
                                 <ul class="list-group list-group-flush p-0 m-0">
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="search.php" class="text-decoration-none text-light">1st Semester</a> </li>
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="attandance" class="text-decoration-none text-light">2nd Semester</a> </li>
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="attandance" class="text-decoration-none text-light">2nd Semester</a> </li>
                                </ul>
                            </div>


                            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" data-toggle="collapse" data-target="#teacher"> Teacher
                                <i class="fas fa-angle-down float-right p-1"></i>
                            </div>

                            <div class="collapse text-light p-0 m-0 text-light" id="teacher">
                                 <ul class="list-group list-group-flush p-0 m-0">
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="reg.php" class="text-decoration-none text-light">Add Teacher</a> </li>
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="teacher/teacher_list.php" class="text-decoration-none text-light">View All Teacher</a> </li>
                                </ul>
                            </div>



                            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" data-toggle="collapse" data-target="#sms"> Sms
                                <i class="fas fa-angle-down float-right p-1"></i>
                            </div>

                            <div class="collapse text-light p-0 m-0 text-light" id="sms">
                                 <ul class="list-group list-group-flush p-0 m-0">
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="search.php" class="text-decoration-none text-light">Send SMS</a> </li>
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="attandance" class="text-decoration-none text-light">View send SMS</a> </li>
                                </ul>
                            </div>




                            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" data-toggle="collapse" data-target="#setting"> Setting
                                <i class="fas fa-angle-down float-right p-1"></i>
                            </div>

                            <div class="collapse text-light p-0 m-0 text-light" id="setting">
                                 <ul class="list-group list-group-flush p-0 m-0">
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="setting/class.php" class="text-decoration-none text-light">Class</a> </li>
                                    <li class="list-group-item bg-secondary m-pointer"> <a href="setting/shift.php" class="text-decoration-none text-light">Shift</a> </li>
                                </ul>
                            </div>



                    <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" onclick="alert('Updating this section')">
                        <a class="text-decoration-none text-light">Payment</a>
                        <i class="fas fa-eye float-right p-1"></i>
                    </div>



                    <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" onclick="alert('sss')">
                        <a class="text-decoration-none text-light">Balance check</a>
                        <i class="fas fa-eye float-right p-1"></i>
                    </div>


                    <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold">
                        <a href="logout.php" class="text-decoration-none text-light">Logout</a>
                        <i class="fas fa-sign-out-alt float-right p-1"></i>
                    </div>
                </div>
            </div>
		</div>
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
                            <?php foreach ($dc->classView() as $item => $value){ ?>
                            <tr>
                                <td><?php echo $item;?></td>
                                <td><?php echo $value;?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 m-0 p-0">
                        <table class="table table-responsive-md">
                            <thead class="thead-light">
                            <tr>
                                <th>Class Name</th>
                                <th>Shift</th>
                                <th>Total Student</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

            </div>
        </div>
	</div>

				
	<!---script type="text/javascript" src="src/loader.js"></script-->
<script>
    function checkBalance() {
        var id = document.getElementById("balance");
        id.classList.add("balance");

        setTimeout(function () {
            id.innerText = "okk ";
        }, 1000);

        setTimeout(function () {
            id.classList.remove("balance");
        },5000);



        $.ajax({
            url: 'ajax/index.php',
            method: 'post',
            data: {
                balance: 1,
                check: 1,
            },
            success: function (data) {
                console.log(data);
            }
        });
    }
</script>
<?php $end = microtime(true);
    echo $result = round($end-$tstart,3)."s";
?>
<script src="src/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>