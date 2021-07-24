<?php 
    include "../../vendor/autoload.php";
    include "../auth/session.php";
    include"../../db.php";
    include"../../function_list.php";
    include"../../Controller/resultController.php";

        $resultObj = new resultController();

		if(isset($_GET['class']))
		{
			$class= $_GET['class'];
			$q= "and class=$class  ORDER BY `student_info`.`class_roll` ASC";
		}
		else{$q='';}
		$tr="";
		$published="0";
		
		if(isset($_GET['semester']))
		{
			$semester= $_GET['semester'];
			$sr= $_GET['semester'];
			$u = "semester=$sr";
			
		}
		else{ header("location:../"); }
		$tr="";
		
			if($semester == 1) {$view_semester = "First Semester"; $se = 100;}
			if($semester == 2) {$view_semester = "Second Semester";}
			if($semester == 3) {$view_semester = "Third Semester";}
		
		$result_check_list= mysqli_query($new,"SELECT * FROM student_info where status=1 $q");
		while($r=mysqli_fetch_assoc($result_check_list))
		{
			$student_id= $r['id'];
			$unid= $r['uniqueid'];
			$name= $r['name'];
			$roll= $r['class_roll'];
            $class_id= $r['class'];
			$class = (object)$resultObj->classAndShiftName($class_id);
			
			
			
				$testdata = mysqli_num_rows(mysqli_query($new, "select * from fm19 where semester=$semester and uniid=$unid"));
					if($testdata==0){
						$published= "<i class='fas fa-times'></i>";
						}else {$published="<i class='fas fa-spell-check'></i> &nbsp; <i class='fa fa-eye'></i>";}
						
					
			
			
				
					
					$type_ss = '00'; 
					$type_s = "$semester$type_ss"; 
					$type_ps = '01';
					$type_p = "$semester$type_ps"; 
					$type_ws = '11';
					$type_w = "$semester$type_ws"; ;
				$semester_xm= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=$type_s"));
				$pre_xm= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=$type_p"));
				$weekly_xm= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=$type_w"));
								
				if($semester_xm>0)
				    {$fs="<a href='preview_semester.php?regid=$unid&sem=$semester' target='_blank' title='view result'>View <i class='fa fa-eye'></i> </a>";}
				        else
				            {$fs="<a style='color:red;' href='add.php?student_id=$student_id&unid=$unid&sem=$type_s'>Add  <i class='fas fa-plus'></i> </a>";}
				if($pre_xm>0)
				    {$fs_p="<a href='preview_semester.php?regid=$unid&sem=$semester' target='_blank'>View <i class='fa fa-eye'></i>  </a>";}
				        else{$fs_p="<a style='color:red;' color='red' href='add.php?student_id=$student_id&unid=$unid&sem=$type_p'>Add <i class='fas fa-plus'></i>  </a>";}
				if($weekly_xm>0)
				    {$fs_w="<a href='preview_semester.php?regid=$unid&sem=$semester' target='_blank'>View <i class='fa fa-eye'></i>  </a>";}
				        else{$fs_w="<a style='color:red;' color='red' href='add.php?student_id=$student_id&unid=$unid&sem=$type_w'> Add <i class='fas fa-plus'></i>  </a>";}
			
			
				$tr .="<tr>
			<td>$name</td>
			<td class='text-center'>".$class->class_name." (".$class->shift.")</td>
			<td class='text-center'>$roll</td>			
			<td class='text-center'>$fs_p</td>
			<td class='text-center'>$fs</td>			
			<td class='text-center'>$published</td>			
			</tr>";
		}
		$output= "";
		

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Result Panel</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<link rel="stylesheet" href="../../src/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../../src/fa/css/all.css" />
	<link rel="icon" href="../../img/icon.ico" />
</head>
<body>

	<?php include"../header.php";?>
    <div class="row m-0 p-0">
        <div class="col-md-2">
            <div class="mt-2">
                <a class="btn btn-info w-100" href="../index.php">Home</a>
                <a href="index.php" class="btn btn-info w-100 mt-2">Result</a>

            </div>
            <?php

                foreach ($resultObj->all_class_shift() as $item => $value)
                {
                    ?>
                    <a href="second_index.php?class=<?php echo $value['class_id'];?>&semester=<?php echo $_GET['semester'];?>" class="text-left btn btn-info w-100 mt-2">
                        <?php echo $value['class_name'];?>
                        <span class="float-right">
                            <?php echo $value['shift'];?>
                        </span>
                    </a>
                    <?php

                }

            ?>
        </div>
        <div class="col-md-8">
            <table class='table table-bordered table-hover table-sm mt-2'>
               <thead class="thead-light">
               <tr>
                   <th rowspan='2' class="text-center" >Name</th>
                   <th rowspan='2' >Class</th>
                   <th rowspan='2'>Roll</th>
                   <th colspan='4' class="text-center"><?php echo $view_semester;?></th>
               <tr>
                   <th>Pre</th>
                   <th>Semester</th>
                   <th>Published</th>
               </tr>

               </tr>

               </thead>
                    <tbody>
                        <?php echo $tr;?>
                    </tbody>
                </table>


        </div>
        <div align='center' class="col-md-2">
            <a align='left' class="bttn" href="setsubj.php">Costomize Subject</a>
            <a align='left' class="bttn" href="2018">2018 Result</a>

        </div>
    </div>
</body>
</html>