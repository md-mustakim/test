<?php

    require '../../model/app.php';
    $app = new app();
    $view_shift_query = "SELECT * FROM `shift`";
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
    <link rel="stylesheet" href="../../src/fa/css/all.css">
</head>
<body>

<?php include "../header.php"; ?>
<div class="row m-0 p-0">
    <div class="col-md-2 bg-light">
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
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-6">

               <div class="border p-2 ">
                   <div class="h6" id="result"></div>
                   <label for="name">Enter Shift Name</label>
                   <input type="text" name="name" id="name" class="form-control" autofocus>
                   <small id="msg" class="text-danger"></small>
                   <input type="submit" value="Create" onclick="create()" class="btn btn-info form-control mt-2">
               </div>

            </div>
            <div class="col-md-6">
            <div class="p-2">
                <table class="table">
                      <tr>
                          <td>Id</td>
                          <td>Name</td>
                          <td>Action</td>
                      </tr>
                    <hr>
                <?php

                foreach ($shift_data as $key => $values)
                {
                    echo "<tr><td>".$values['shift_id']."</td>";
                    echo "<td>".$values['shift_name']."</td>";
                    $ids= $values['shift_id'];
                    $valid = $app->count("select * from class_list where shift=$ids");
                    if($valid<1)
                    {
                        echo "<td><button onclick='remove($ids)'> <i class=\"fas fa-trash-alt\"></i> </button></td></tr>";
                    }else
                    {
                        echo "<td><button class='btn btn-danger' title='This shift has some class. First delete class then try to delete shift' disabled> <i class=\"fas fa-ban \"></i> </button></td></tr>";
                    }
                }

                ?>
            </table>
            </div>


        </div>
    </div>

</div>
<script type="application/javascript">
    function create() {

        var name = document.getElementById("name");
        var msg = document.getElementById("msg");
        console.log(name.value.length);
        if(name.value.length === 0)
        {
            var result = "Name cannot be empty";
            msg.innerHTML = result;
            console.log(result);
        }else
        {
            var name = document.getElementById("name").value;

            $.ajax({
                url:"ajax.php",
                method:"POST",
                data:{name:name,create:0},
                success:function(data)
                {
                    $('#result').html(data);
                    setTimeout(function () {
                        window.location.href = 'shift.php';
                    },2000);
                }
            });


            
        }

    }
    function remove(id) {

        console.log(id);
            $.ajax({
                url:"ajax.php",
                method:"POST",
                data:{id:id,shift_id:1,class:0,delete:0},
                success:function(data)
                {
                    if(data === 'Successfully deleted')
                    {

                        setTimeout(function () {
                            window.location.href = 'shift.php';
                        },500);

                    }
                    $('#result').html(data);
                }
            });




    }
</script>
</body>


</html>
