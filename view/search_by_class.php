<?php
include "auth/session.php";
include "../Controller/search.php";
$search = new search();

?>
<html>
<head>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Search | Holy Care School</title>
    <script src="../src/jquery_2_1_3.min.js"></script>

    <link rel="stylesheet" href="">
    <link rel="icon" href="../img/icon.ico" />

    <link rel="stylesheet" href="../src/bootstrap.min.css">
    <link rel="stylesheet" href="../src/fa/css/all.css">
</head>
<body>
<?php include 'header.php';?>
<div class="row m-0 p-0">
    <div class="col-md-2">


        <a href="index.php" class="btn btn-info w-100 mt-2">Home</a>
        <a class='btn btn-danger w-100 mt-2' href="inactive.php">Irregular Student</a>
        <?php
            foreach ($search->all_class_shift() as $i => $v) {
            $obj = (object)$v; ?>
                <a href="search_by_class.php?class_id=<?php echo $obj->class_id;?>" class="btn btn-info w-100 mt-2 text-left <?php if(isset($_GET['class_id'])){ if($_GET['class_id']==$obj->class_id){echo"active";}}?>"><?php echo $obj->class_name;  ?>  <span class="float-right"><?php echo $obj->shift;?></span> </a>


        <?php  }   ?>


    </div>
    <div class="col-md-10">
        <div class="bg-light mt-3 p-3">
            <div class="h3">
                Search Student by Class
                <hr>
            </div>

            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>RegID</th>
                        <th>Name</th>
                        <th>Roll</th>
                        <th>Father Number</th>
                        <th>Mother Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php if(isset($_GET['class_id'])){  foreach ($search->search_by_class($_GET['class_id']) as $value) { ?>
                    <tr>

                        <td> <?php echo $value['uniqueid'];?> </td>
                        <td> <?php echo $value['student_name'];?> </td>
                        <td> <?php echo $value['class_roll'];?> </td>
                        <td> <?php echo $value['father_number'];?> </td>
                        <td> <?php echo $value['mother_number'];?> </td>
                        <td class="text-center"><a href="edit_student.php?student_id=<?php echo $value['student_id'];?>"><i class="fas fa-user-edit"></i></a> </td>

                    </tr>


                <?php }}else{echo "No data found";} ?>
            </table>

        </div>
    </div>



</div>



</body>
</html>


<script>

</script>