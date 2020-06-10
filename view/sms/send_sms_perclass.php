<?php
session_start();
if(!isset($_SESSION['uname'])){
    header("Location: ../login.php");
}

include '../class/app.php';
$app = new app();

$admin= $_SESSION['uname'];

date_default_timezone_set('Asia/Dhaka');
$ttime= date('g:i a, d/m/y');


$get_all_group_query = "select * from shift";
$shift_datas = $app->view($get_all_group_query);
$get_all_class_query = "select * from class_list";
$class_datas = $app->view($get_all_class_query);



?>

<DOCTYPE HTML>
    <html lang="en-US">
    <head>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta charset="UTF-8">
        <title>Send SMS <?php echo $app->app_name;?></title>
        <link rel="stylesheet" href="../src/bootstrap.min.css" />

        <link rel="icon" href="../img/icon.ico" />

    </head>
    <body>
    <?php include '../header.php';?>



    <div class="row m-0 p-0">
        <div class="col-md-2 m-1">
            <div class="p-1 m-1 bg-light">
                <button
                    class="btn btn-info w-100 mb-2 font-weight-bold text-light"
                    onclick="window.location.href = '../index.php';">
                    Return Home
                </button>
                <button
                    class="btn btn-info w-100 mb-2 font-weight-bold text-light"
                    onclick="window.location.href = 'sms_history.php';">
                    SMS History
                </button>
                <button
                    class="btn btn-info w-100 mb-2 font-weight-bold text-light"
                    onclick="window.location.href = 'sms_history.php';">
                    SMS History
                </button>
            </div>
        </div>

        <div class="col-md-8">
            <div class="m-2 p-5 border rounded">
                <form action="send_sms.php<?php echo $validd;?>" method="POST">
                    <div class="h5 bg-light p-3">Send SMS</div>
                    <hr>
                    <div class="border p-2">

                        <select name="numberlist" id="numberlist" class="form-check">
                            <option value="">Select Number List</option>
                            <option value="100">All Shift (student)</option>
                            <?php
                            foreach ($shift_datas as $item => $value)
                            {
                                $shift_id = $value['shift_id'];
                                $shift_name = $value['shift_name'];
                                echo "<option value=".$shift_id.">".$shift_name."</option>";
                            }
                            ?>
                            <option value="200">Staff /Teacher</option>

                        </select>
                    </div>
                    <br>

                    <textarea type="m" name="m" class="form-control" rows="12" placeholder="Write a message" required></textarea><br />
                    <span>SMS Cost: </span>
                    <span id="perSmsCost">0.00</span>  &nbsp;||

                    <span id="">Font: </span>
                    <span id="lenth">0</span> &nbsp;||<br />
                    <label class="h6 mt-2" for="cata">Why send SMS: </label><input class="form-control" type="text" name='cata' required/> <br>
                    <input type="submit" name="submit" class="btn btn-info" value="SEND"/>

                </form>

            </div></div>
        <div class="col-md-2">
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            function os(str) {
                for (var i = 0, n = str.length; i < n; i++) {
                    if (str.charCodeAt( i ) > 0980) { return true; }
                }
                return false;
            }

            //0980-09FF


            $("textarea").keyup(function(){
                $("#lenth").text($(this).val().length);
                var l = this.value.length;
                var v = this.value;
                var f = os(v);
                if(f === true)
                {
                    var msgLength = 70;
                }else
                {
                    var msgLength = 160;
                }

                var msgC = l / msgLength;

                var msgCount = Math.ceil(msgC);
                var baseCost = 0.40;
                var perSmsCost = baseCost * msgCount;
                var perSmsCost = perSmsCost.toFixed(2);
                //var perSmsCost = Math.round(perSmsCost);
                document.getElementById("perSmsCost").innerHTML = perSmsCost;


                console.log(perSmsCost);
            });

            // checkbox
            function checkbox() {
                var all_student = document.getElementById("all_student");

                if(all_student.checked == true)
                {

                }

            }

        </script>


    </body>
    </html>

