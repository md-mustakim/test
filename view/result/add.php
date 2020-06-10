<?php
	session_start();
	include'../../db.php';
	include'../../function_list.php';
	include'../../Controller/resultController.php';
	$resultObj = new resultController();
	$resultObj->student_id = $_GET['student_id'];
	$student_id = $_GET['student_id'];

	$ttd="";

	$ac="";

	$msg="";

	$max="";

	if(!isset($_SESSION['admin']))

	{

		header("location:../login.php");

	}

	if(isset($_GET['unid']) && $_GET['sem'])

	{

	

	$unid= $_GET['unid'];	

	$seme=  $_GET['sem'];

	$semester= change_semester($seme);

	

	}

	else{

		header("location:index.php");

	}

	$fe=mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM student_info where uniqueid=$unid order by class_roll ASC"));

	$class= $fe['class'];

	$name= $fe['name'];

	$roll= $fe['class_roll'];

	if($roll==0){$roll='Not Set';}else{$roll=$roll;}

	$stat= $fe['status'];

	if($stat==0){$stat='Irregular';} else{$stat='Regular';}

	$cclass= change_class($class);

	

//------------------------------------------------

		$pre1w= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=111"));			

		if($pre1w==0){ $p1w="<a class='bttn' href='add.php?unid=$unid&sem=111'>1st Semester Weekly</a>"; $datashow1w=1;}

		else{$p1w="<a class='bttn' style='background:green;' href='result_edit.php?unid=$unid&sem=111' target='_blank' title='Edit Result'>1st Semester Weekly</a>";$datashow1w=0;}

		

		$pre1= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=101"));			

		if($pre1==0){ $p1="<a class='bttn' href='add.php?unid=$unid&sem=101'>1st Pre Semester</a>"; $datashow1=1;}

		else{$p1="<a class='bttn' style='background:green;' href='result_edit.php?unid=$unid&sem=101' target='_blank' title='Edit Result'>1st Pre Semester</a>";$datashow1=0;}

		

		$pre2= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=100"));

		if($pre2==0){ $p2="<a class='bttn' href='add.php?unid=$unid&sem=100'>1st Semester</a>";$datashow2=1;}

		else{$p2="<a class='bttn' style='background:green;' href='result_edit.php?unid=$unid&sem=100' target='_blank' title='Edit Result'>1st Semester</a>";$datashow2=0;}

		

		$pre3w= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=211"));

		if($pre3w==0){ $p3ww="<a class='bttn' href='add.php?unid=$unid&sem=211'>2nd Semester Weekly</a>";$datashow3w=1;}

		else{$p3ww="<a class='bttn' style='background:green;' href='result_edit.php?unid=$unid&sem=211' target='_blank' title='Edit Result'>2nd Semester Weekly</a>";$datashow3w=0;}

		

		$pre3= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=201"));

		if($pre3==0){ $p3="<a class='bttn' href='add.php?unid=$unid&sem=201'>2nd Pre Semester</a>";$datashow3=1;}

		else{$p3="<a class='bttn' style='background:green;' href='result_edit.php?unid=$unid&sem=201' target='_blank' title='Edit Result'>2nd Pre Semester</a>";$datashow3=0;}

		

		$pre4= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=200"));

		if($pre4==0){ $p4="<a class='bttn' href='add.php?unid=$unid&sem=200'>2nd Semester</a>";$datashow4=1;}

		else{$p4="<a class='bttn' style='background:green;' href='result_edit.php?unid=$unid&sem=200' target='_blank' title='Edit Result'>2nd Semester</a>";$datashow4=0;}

		

		$pre5w= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=311"));

		if($pre5w==0){ $p5w="<a class='bttn' href='add.php?unid=$unid&sem=311'>3rd Semester Weekly</a>";$datashow5w=1;}

		else{$p5w="<a class='bttn' style='background:green;' href='result_edit.php?unid=$unid&sem=311' target='_blank' title='Edit Result'>3rd Semester Weekly</a>";$datashow5w=0;}

		

		$pre6= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=301"));

		if($pre6==0){ $p6="<a class='bttn' href='add.php?unid=$unid&sem=301'>3rd Pre Semester</a>";$datashow6=1;}

		else{$p6="<a class='bttn' style='background:green;' href='result_edit.php?unid=$unid&sem=301' target='_blank' title='Edit Result'>3rd Pre Semester</a>";$datashow6=0;}



		$pre5= mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=300"));

		if($pre5==0){ $p5="<a class='bttn' href='add.php?unid=$unid&sem=300'>3rd Semester</a>";$datashow5=1;}

		else{$p5="<a class='bttn' style='background:green;' href='result_edit.php?unid=$unid&sem=300' target='_blank' title='Edit Result'>3rd Semester</a>";$datashow5=0;}

		

		

		

	

		//------------------------------------------------	

	$datacheck=  mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$unid and type=$seme"));

	if($datacheck==0 ){

	$subjectlist= mysqli_query($new,"SELECT * FROM stc_info where cid=$class ORDER BY `stc_info`.`subjid` ASC");

	if(mysqli_num_rows($subjectlist)==0)

	{

		$ac="<br /><div class='msg'>No Subject Added in Subject Customization</div>";

	}

	else

	{

		while($rmark=mysqli_fetch_assoc($subjectlist))

		{

			$subid= $rmark['subjid'];

			$mark= $rmark['mark'];

			$subjectid= $rmark['subjid'];

			$subject_status= $rmark['pre_status'];

			$subid= change_subject($subid);

		

			

			if($seme==200 OR $seme==100 OR $seme==300){			

					$ac .="<tr>

				<td>$subid</td>					

				<td align='center'><input type='number' name='ssmarks[$subjectid]' min='0' max='$mark' required/></td>	

			</tr>";

			}

			else{

				if($subject_status==0){

				

				$ac.="<tr>
					<td>$subid : </td><td align='center'>Disable for Pre Semester</td>
					</tr>";

				}else

				{

					$ac .="<tr>

				<td>$subid : $subjectid</td>					

				<td align='center'><input type='number' name='ssmarks[$subjectid]' min='0' max='50' required/></td>	

			</tr>";

				}

			}

		}

		$ac= "<table class='table table-bordered table-sm table-hover'>

		<thead class='thead-light'><tr>
			<th>Subject Name</th>

			<th>$semester</th>
</tr>
</thead>
		
<tbody>
$ac
</tbody>
			

		</table>

		<input type='submit' name='submitr' value='Add' />

		";

	}

	

	}else{$ac="<br /><div class='msg'>Reasult Already Added</div>";}

	if(isset($_POST['submitr']))

	{

		

		$ada =$_POST['ssmarks'];

		foreach($ada as $key=> $result)

		{ 	$sqlll="INSERT INTO `marksheed_2019`(`regid`, `subject_id`, `type`, `marks`) VALUES('$unid','$key','$seme','$result')";

		

			$tt=$new->query($sqlll);

			if(!$tt){

				$msg= "<script type='text/javascript'>

						alert('Error try Correctly!!');

						window.location.href = 'add.php?unid=$unid&sem=$seme';

							

				</script>";

			}

			else{

				$msg= "<script type='text/javascript'>

						alert('Successfully Added!!');

						window.location.href = 'add.php?unid=$unid&sem=$seme';

							

				</script>";

			}

			//echo "$key == $result <br />";

		}

		

		$adaa =$_POST['ssmarks'];

	/*	foreach($adaa as $keys=> $results)

		{

			echo "$keys == $results <br />";

		}*/

		

		

		

	

		

		

		

		

	//	echo "p->";echo print_r($ada); echo "<br />";

	//	$adaa =$_POST['ssmarks']; 

	//	echo "w->";echo print_r($adaa);echo "<br />";

	

		

	}

	//---------------get-----

		$sssq=mysqli_query($new,"SELECT * FROM student_info where class=$class and status=1  order by class_roll ASC");

		while($scs= mysqli_fetch_assoc($sssq))

		{$cc='0';

			$sn= $scs['name'];
            $class_roll = $scs['class_roll'];
			$su= $scs['uniqueid'];

			$v1=mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$su and type=100"));		

			$v1w=mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$su and type=111"));		

			$v2=mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$su and type=101"));		

			$v3=mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$su and type=200"));		

			$v3w=mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$su and type=211"));		

			$v4=mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$su and type=201"));		

			$v5=mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$su and type=300"));		

			$v5w=mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$su and type=3111"));		

			$v6=mysqli_num_rows(mysqli_query($new,"SELECT * FROM marksheed_2019 where regid=$su and type=301"));		

			if($v1>0)	{$cc +=1;}

			if($v1w>0)	{$cc +=1;}

			if($v2>0)	{$cc +=1;}

			if($v3>0)	{$cc +=1;}

			if($v3w>0)	{$cc +=1;}

			if($v4>0)	{$cc +=1;}

			if($v5>0)	{$cc +=1;}

			if($v5w>0)	{$cc +=1;}

			if($v6>0)	{$cc +=1;}

			if($cc==9)

			{

				$ttd.= "<a class='btn btn-info' title='View Update' style='background:green;' href='preview.php?regid=$su' target='_blank'>$sn</a>";

			}else {

			$ttd.= "<a class='btn btn-info w-100 m-1 text-left' href='add.php?unid=$su&sem=$seme'>$class_roll- $sn </a>";

			}

			

		}

		$tablea= "<div class='bg-light w-100 p-2 font-weight-bold '>Same Class of $name</div><br />
    $ttd";

		echo"<script type='text/javascript'>

			function openWin() {

			myWindow = window.open('index.php', '_blank', 'width=200, height=100');}

		</script>";

	

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo "Add-$name";?></title>
	<link rel="stylesheet" href="../../src/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../../src/fa/css/all.css" />
	<link rel="shortcut icon" href="../../img/icon.ico">

	<style type="text/css">
		input[type=number]{
			width: 120px;
		}
	</style>
</head>

<body>
	<?php include"../header.php";?>
    <div class="row m-0 p-0">
        <div class="col-md-2">
            <div class="mt-2">
                <a class="btn btn-info w-100" href="../index.php">Home</a>
                <a href="index.php" class="btn btn-info w-100 mt-2">Result</a>
            </div>

            <br />

            <?php echo $tablea;?>

        </div>

        <div class="col-md-10">

                 <?php echo $msg;?>

                <table class='table table-sm table-bordered mt-2'><tr>
                <td><b>Name:</b> <?php echo $resultObj->student_view()->name;?>

            </td>

                <td><b>Class:</b>
                    <?php echo $resultObj->classAndShiftName($resultObj->student_view()->class)['class_name'];?>
                    (<?php echo $resultObj->classAndShiftName($resultObj->student_view()->class)['shift'];?>)
                </td>

                <td><b>Roll:</b> <?php echo $resultObj->student_view()->class_roll;?></td>

                <td><b>Status:</b> <?php echo $resultObj->student_view()->status;?></td>
            </tr></table>



            <form action="add.php?unid=<?php echo "$unid&sem=$seme";?>" method="POST">
                <?php echo $ac;?>
            </form>









        </div>

        <div class="col-md-2">
        <?php
                echo $p1;
                echo $p2;
                echo $p3;
                echo $p4;
                echo $p6;
                echo $p5;
        ?>
        </div>
    </div>
</body>

</html>