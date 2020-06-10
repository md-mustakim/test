<?php
    require '../../model/app.php';
    $app = new app();
    $view_shift_query = "SELECT * FROM `class_list` ORDER BY `class_id`  ASC";
    $shift_data = $app->view($view_shift_query);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shift Management-Holy Care School</title>
    <script src="../../src/jquery_2_1_3.min.js"></script>
    <link rel="stylesheet" href="../../src/bootstrap.min.css">
</head>
<body>

<?php include "../header.php"; ?>
<div class="row m-0 p-0">
    <!-------------------------col - 1 ----------------------------------------->
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

    </div>


    <!----------------------------------col - 2 ------------------------------------->



    <div class="col-sm-10">
        <div class="row">
            <div class="col-md-6">
                <div class="border m-2 mt-3 p-3">
                    <div class="h6 bg-light p-2">Create a New Class</div>
                    <div class="h6" id="result"></div>
                    <label for="name">Enter Class Name</label>
                    <input type="text" name="name" id="name" class="form-control" autofocus>
                    <br>
                    <select class="form-control" name="shift" id="shift" required>
                        <option value="">Select</option>
                        <?php
                        $shift_view = $app->view("SELECT * FROM `shift`");

                        var_dump($shift_view);

                        foreach ($shift_view as $sdatas => $value)
                        {

                            echo "<option value=".$value['shift_id'].">".$value['shift_name']."</option>";
                        }
                        ?>
                    </select>
                    <small id="msg" class="text-danger"></small>
                    <input type="submit" value="Create" onclick="create()" class="btn btn-info form-control mt-2">
                </div>
            </div>


            <div class="col-md-5">
                <div class="p-3">
                    <table class="table">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Shift</th>
                        </tr>
                        <?php
                        foreach ($shift_data as $key => $values)
                        {
                            echo "<tr><td>".$values['class_id']."</td>";
                            echo "<td>".$values['class_name']."</td>";
                            $shift = $values['shift'];
                            $q = "SELECT * FROM `shift` where shift_id=$shift";
                            $data = $app->view_single($q);
                            echo "<td>".$data['shift_name']."</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="application/javascript">
        function create() {

            var name = document.getElementById("name");
            var msg = document.getElementById("msg");
            var shift_id = document.getElementById("shift").value;
            console.log(name.value.length);
            if(name.value.length === 0 )
            {
                var result = "Name cannot be empty";
                msg.innerHTML = result;
                console.log(result);
                console.log("error");
            }else
            {
                console.log("success");
                var name = document.getElementById("name").value;
                var shift_id = document.getElementById("shift").value;

                $.ajax({
                    url:"ajax.php",
                    method:"POST",
                    data:{name:name,shift:shift_id,class:0},
                    success:function(data)
                    {
                        if(data === 'Successfully created')
                        {

                            setTimeout(function () {
                                window.location.href = 'class.php';
                            },2000);

                        }
                        $('#result').html(data);


                    }
                });



            }




        }
    </script>
</body>


</html>
