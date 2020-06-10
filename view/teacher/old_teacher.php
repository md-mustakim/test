<?php
session_start();

if(!isset($_SESSION['admin'])){

    header("Location: ../login.php");

}
include_once("../../db.php");
$output="";
$output1="";
$msg="";
$user = $_SESSION['admin'];
if(isset($_POST['submit'])){
    $teacherid= $_POST['teacherid'];
    $status= $_POST['status'];
    $namea= $_POST['name'];
    $numberr= $_POST['number'];

    $make_admin="UPDATE `teacher_info` SET admin='$status', number='$numberr', name='$namea' WHERE id='$teacherid'";
    $result=$new->query($make_admin);
    if(!$result){
        $msg .="failed try to contact Admin";
    }
    else {

        $msg .="<h5>Update Success</h5>";
    }

}
$teacherlist= "SELECT * FROM `teacher_info` where admin=3";
$way = mysqli_query($new,$teacherlist);
while($list=mysqli_fetch_assoc($way)){
    $tid=$list['id'];
    $name=$list['name'];
    $mail=$list['email'];
    $phone=$list['number'];
    $add=$list['address'];
    $admin=$list['admin'];
    if($add==null){
        $add="Not Found";
    }
    else{$add=$add;}
    if($admin==1){
        $permission = "<select name='status' id='status'>
				<option value='1' selected>Admin</option><option value='2'>Just View</option><option value='3'>Irregular</option>
			</select>";
    }
    else if($admin==2)
        $permission = "<select name='status' id='status'>
				<option value='1'>Admin</option><option value='2' selected>Just View</option><option value='3'>Irregular</option>
			</select>";
    else{$permission= "<select name='status' id='status'><option value='1'>Admin</option><option value='2'>Just View</option>
				<option value='3' selected>Irregular</option>
			</select>";}



    $output= " <div class='mt-3 card'>
            <table class='table'><form action='old_teacher.php' method='POST'>
		<tr> <td>Name:</td><td><input type='text' class='form-control' name='name' value='$name' /></></td></tr>
		<tr> <td>Email:</td><td>$mail</td></tr>
		<tr> <td>Phone:</td><td><input type='text' class='form-control' name='number' value='$phone' /></td></tr>
		<tr> <td>Address:</td><td>$add</td></tr>
		<tr> <td>Permission: </td><td class='list'>
		
		$permission
		<input class='form-control' type='hidden' name='teacherid' value='$tid' />
		
		<input type='submit' value='UPDATE' name='submit' id='submit' />
		</form>
		</table>
		</div>
		
		";
    $output1 .=$output;
}










?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Teacher Information</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="icon" href="../img/icon.ico" />

    <link rel="stylesheet" href="../../src/bootstrap.min.css" />


</head>
<body>
<?php include '../header.php' ?>
<div class="row mt-1">
    <div class="col-sm-2">

        <button
            class="btn btn-info w-100 mt-2 font-weight-bold text-light"
            onclick="window.location.href = '../index.php';">
            Return Home
        </button>
        <button
            class="btn btn-info w-100 mt-2 font-weight-bold text-light"
            onclick="window.location.href = 'teacher_list.php';">
             Teachers
        </button>



    </div>
    <div align="center" class="col-sm-8">

        <div class='title' align= 'center'>Teacher's Information</div>
        <p class='note'>EveryThing need to be unique</p>
        <?php echo $msg;?>
        <br /><?php echo $output1;?>
    </div>
    <div class="col-sm-2"></div>
</div>
</body>
</html>