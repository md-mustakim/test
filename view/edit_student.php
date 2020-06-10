<?php
	require "auth/session.php";
	require "../Controller/student_edit.php";

	if(!isset($_GET['student_id'])){
		header("location: search.php");
	}
    $edit = new student_edit($_GET['student_id']);

	if(isset($_POST['update']))
    {
        $edit->name             = $_POST['name'];
        $edit->class            = $_POST['class'];
        $edit->class_roll       = $_POST['class_roll'];
        $edit->father_name      = $_POST['fname'];
        $edit->father_number    = $_POST['fnumber'];
        $edit->mother_name      = $_POST['mname'];
        $edit->mother_number    = $_POST['mnumber'];
        $edit->birth_day        = $_POST['birth'];
        $edit->amount           = $_POST['amount'];
        $edit->address          = $_POST['address'];
        $edit->status           = $_POST['status'];
        if($edit->update())
        {
            header("location: edit_student.php?message=1&student_id=".$_GET['student_id']);
        }else{
            header("location: edit_student.php?message=0&student_id=".$_GET['student_id']);
        }
    }















	?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0' name='viewport' />
	<title>Edit Student || HCS App</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	<?php include 'header.php'; ?>
    <div class="row m-0 p-0">
        <div class="col-md-2">
            <a href="index.php" class="btn btn-info w-100 mt-2">Home</a>
            <a href="search.php" class="btn btn-info w-100 mt-2">Return Search</a>
        </div>
         <div class="col-md-8 overflow-auto">
            <div class="h5 bg-light p-3 mt-2 mb-3 font-weight-bold"> Edit Student</div>
                <hr>
             <form action="edit_student.php?student_id=<?php echo $_GET['student_id'];?>" method="POST" enctype="multipart/form-data">
                 <div class='row  p-3'>
                     <div class='col-sm-2'>
                         <label for="cls">Class</label>
                     </div>
                     <div class='col-sm-9'>


                         <select id="cls" class="form-control" name="class" required>
                             <option disabled>Select</option>
                             <?php

                             foreach ($edit->all_class_shift() as $item => $value){

                                 if($edit->show_student()['class'] == $value['class_id'])
                                 {
                                     ?>
                                     <option value="<?php echo $value['class_id'];?>" selected><?php echo $value['class_name']." || ".$value['shift'] ?></option>
                                     <?php
                                 }else {
                                 ?>
                             <option value="<?php echo $value['class_id'];?>"><?php echo $value['class_name']." || ".$value['shift'] ?></option>
                             <?php }} ?>
                         </select>
                     </div>
                 </div>
                 <div class='row p-3'>
                     <div class='col-sm-2'>
                         <label for="cls">Student Name</label>
                     </div>
                     <div class='col-sm-9'>
                         <input type="text" class="form-control" name="name" required value="<?php echo $edit->show_student()['name']; ?>"/>
                     </div>
                 </div>
                 <div class='row p-3'>
                     <div class='col-sm-2'>
                         <label for="class_roll">Class Roll</label>
                     </div>
                     <div class='col-sm-9'>
                         <input type="text" class="form-control" name="class_roll" id="class_roll" required value="<?php echo $edit->show_student()['class_roll']; ?>"/>
                     </div>
                 </div>
                 <div class='row p-3'>
                     <div class='col-sm-2'>
                         Father's Name:
                     </div>
                     <div class='col-sm-9'>
                         <input type="text"  class="form-control"  name="fname" required value="<?php echo $edit->show_student()['fname']; ?>"/>
                     </div>
                 </div>
                 <div class='row p-3'>
                     <div class='col-sm-2'>
                         Father's Phone Number:
                     </div>
                     <div class='col-sm-9'>
                         <input type="number" class="form-control"  name="fnumber"   id="fnumber"  required value="<?php echo $edit->show_student()['fnumber']; ?>"/>
                         <small id="fmsg"></small>
                     </div>
                 </div>
                 <div class='row p-3'>
                     <div class='col-sm-2'>
                         Mother's Name:
                     </div>
                     <div class='col-sm-9'>
                         <input type="text"  class="form-control"  name="mname" required value="<?php echo $edit->show_student()['mname']; ?>"/>
                     </div>
                 </div>
                 <div class='row p-3'>
                     <div class='col-sm-2'>
                         Mother's Phone Number: <small class="text-secondary">(SMS will send this number)</small>
                     </div>
                     <div class='col-sm-9'>
                         <input type="number"  class="form-control"  name="mnumber" id="mnumber"  required value="<?php echo $edit->show_student()['mnumber']; ?>"/>
                         <small id="mmsg"></small>
                     </div>
                 </div>
                 <div class='row p-3'>
                     <div class='col-sm-2'>
                         Date of Birth:
                     </div>
                     <div class='col-sm-9'>
                         <input type="date"  class="form-control"  name="birth"  required value="<?php echo $edit->show_student()['birth']; ?>"/>
                     </div>
                 </div>
                 <div class='row p-3'>
                     <div class='col-sm-2'>
                         Address:
                     </div>
                     <div class='col-sm-9'>
                         <input type="text"  class="form-control"  name="address"  required value="<?php echo $edit->show_student()['address']; ?>"/>
                     </div>
                 </div>
                 <div class='row p-3'>
                     <div class='col-sm-2'>
                         Monthly Fee:
                     </div>
                     <div class='col-sm-9'>
                         <input type="number"  class="form-control"  name="amount" required value="<?php echo $edit->show_student()['amount']; ?>"/>
                     </div>
                 </div>
                 <div class='row p-3'>
                     <div class='col-sm-2'>
                         Status: <?php echo $edit->show_student()['status'];?>
                     </div>
                     <div class='col-sm-9'>
                         <select name="status" id="status" class="form-control">

                             <?php if($edit->show_student()['status']): ?>
                                 <option value="1" selected>Active</option>
                                 <option value="0" >Disabled</option>
                             <?php else: ?>
                                 <option value="1" >Active</option>
                                 <option value="0" selected>Disabled</option>
                             <?php endif; ?>

                         </select>
                     </div>
                 </div>

                 <div class='row p-3'>
                     <div align='center' class='col-sm-12 mt-3'>
                         <input type="submit"  class="btn btn-info w-50"  name="update" value="Update"/>
                     </div>
                 </div>

             </form>
         </div>

       </div>
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("message");
    if(c == 1){


        swal({
            title: "Update Success",
            text: "Click Exit to Finish Edit, Press Continue to Edit Again!",
            icon: "success",
            buttons: {
                catch: {
                    text: "Exit",
                    value: "catch",
                },
                abd: {
                    text: "Continue!",
                    value: "abd",
                }
            }
        }).then((willDelete) => {
              switch (willDelete) {
                  case "catch":
                      window.close();
                      break;
                  case "abd":
                      console.log(willDelete);
                      break;
              }

              }
            );








    }else if(c ==0){
        swal("Update Failed!");
    }
</script>
</html>