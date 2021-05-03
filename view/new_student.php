<?php

	session_start();
	require "../vendor/autoload.php";
	require "../model/Student.php";
	require "../model/Class_list.php";
	require "../model/Config.php";
	use Model\Config;
	use Model\Student;
	use Model\Class_list;
	$config = new config();
	$student= new student();
	$class= new Class_list();


    if(isset($_POST['submit']))
    {
        $unique_id =        $student->makeUniqueId($_POST['class']);

        if(!empty($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];
            $dump = explode(".",$image_name);
            $file_format = end($dump);
            $file_dir = "../student_image/".$unique_id.".".$file_format;
            $file_name_temp= $_FILES['image']['tmp_name'];
            $upload_status = move_uploaded_file($file_name_temp,$file_dir);
        }else
        {
            $file_dir = "../student_image/default.png";

        }



        if(isset($_POST['send_sms']))
        {
            $student->send_sms_status = 1;
        }else
        {
            $student->send_sms_status = 0;
        }

        $student->class=   $_POST['class'];
        $student->student_name=   $_POST['student_name'];
        $student->father_name=   $_POST['father_name'];
        $student->father_number=   $_POST['father_number'];
        $student->mother_name=    $_POST['mother_name'];
        $student->mother_number=    $_POST['mother_number'];
        $student->birth_date=    $_POST['birth_date'];
        $student->address=   $_POST['address'];
        $student->amount=   $_POST['amount'];
        $student->unique_id=   $unique_id;
        $student->image_path=    $file_dir;

       if($student->create()){
           $page = $_SERVER['PHP_SELF'];
           $page= "$page?msg=success";
           $sec = "1";
           header("Refresh: $sec; url=$page");
       }



    }

?>

<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0' name='viewport' />
        <meta charset="UTF-8">
        <title>Add Student | Holy Care School</title>
        <link rel="icon" href="../img/icon.ico" />
        <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
<body>
	<?php include 'header.php';?>
    <div class="row m-0 p-0">
        <div class="col-md-2 bg-light">
            <button
                    class="btn btn-info w-100 mt-2 font-weight-bold text-light"
                    onclick="window.location.href = 'index.php';">
                Return Home
            </button>
            <button
                    class="btn btn-info w-100 mt-2 font-weight-bold text-light"
                    onclick="window.location.href = 'search.php';">
               Search Student
            </button>


        </div>
        <div class="col-md-8 mx-auto">
            <div class="">

                <div id="status"></div>

                <div class="border shadow p-4 mt-3">
                        <div class="h4 font-weight-bold bg-light p-3" style="font-family: 'Roboto Slab', serif;">New Student Registration</div>
                        <hr>
                    <?php if(isset($_GET['msg'])){echo $_GET['msg'];} ?>
                        <form action="new_student.php" method="POST" enctype="multipart/form-data">
                            <div class='row  p-3'>
                                    <div class='col-sm-2'>
                                        <label for="cls">Class</label>
                                    </div>
                                    <div class='col-sm-9'>
                                        <select id="cls" class="form-control" name="class" required>
                                            <option selected disabled>Select</option>
                                            <?php foreach ($class->class_shift() as $item => $value){ ?>
                                            <option value="<?php echo $value['class_id'];?>"><?php echo $value['class_name'];?> || <?php echo $value['shift'];?></option>


                                           <?php } ?>
                                        </select>
                                    </div>
                            </div>
                            <div class='row p-3'>
                                    <div class='col-sm-2'>
                                        <label for="cls">Student Name</label>
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type="text" class="form-control" name="student_name" required/>
                                    </div>
                            </div>
                            <div class='row p-3'>
                                    <div class='col-sm-2'>
                                        Father's Name:
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type="text"  class="form-control"  name="father_name" required/>
                                    </div>
                            </div>
                            <div class='row p-3'>
                                    <div class='col-sm-2'>
                                        Father's Phone Number:
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type="number" class="form-control"  name="father_number"   id="fnumber"  required/>
                                        <small id="fmsg"></small>
                                    </div>
                            </div>
                            <div class='row p-3'>
                                    <div class='col-sm-2'>
                                        Mother's Name:
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type="text"  class="form-control"  name="mother_name" required/>
                                    </div>
                            </div>
                            <div class='row p-3'>
                                    <div class='col-sm-2'>
                                        Mother's Phone Number:
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type="number"  class="form-control"  name="mother_number" id="mnumber"  required/>
                                        <small id="mmsg"></small>
                                    </div>
                            </div>
                            <div class='row p-3'>
                                    <div class='col-sm-2'>
                                        Date of Birth:
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type="date"  class="form-control"  name="birth_date"  required/>
                                    </div>
                            </div>
                            <div class='row p-3'>
                                    <div class='col-sm-2'>
                                        Address:
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type="text"  class="form-control"  name="address"  required/>
                                    </div>
                            </div>
                            <div class='row p-3'>
                                    <div class='col-sm-2'>
                                        Monthly Fee:
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type="number"  class="form-control"  name="amount" required/>
                                    </div>
                            </div>
                            <div class='row p-3'>
                                    <div class='col-sm-2'>
                                        Upload Image <small>(JPG)</small>
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type="file"  class="form-control"  name="image" accept="image/jpeg" />
                                    </div>
                            </div>
                            <div class='row p-3'>
                                    <div class='col-sm-2'>
                                        Send SMS
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type="checkbox"  class=""  name="send_sms" value="1" />
                                    </div>
                            </div>
                            <div class='row p-3'>
                                    <div align='center' class='col-sm-12 mt-3'>
                                        <input type="submit"  class="btn btn-info w-50"  name="submit" value="Register"/>
                                    </div>
                            </div>

                        </form>

                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</body>
	<script type="text/javascript">	
		
	$("#fnumber").keyup(function address(){
        var fnumber    = document.getElementById('fnumber');
        var msgid    = document.getElementById('fmsg');
		 checknumber(fnumber,msgid);
	});

	$("#mnumber").keyup(function addres(){
        var mnumber    = document.getElementById('mnumber');
        var msgidm    = document.getElementById('mmsg');
		 checknumber(mnumber,msgidm);
	});
	function checknumber(id,msgid)
	{
		var num = id.value;
		$.ajax({
               url: "../ajax/ajax.php",
               method: "POST",
               data:{ check: num },
               success: function (data)
               {
					msgid.innerHTML = data;

               }
           });
	}
	
	
		
		
		
		
		
		
		
		
		
	</script>
</html>
