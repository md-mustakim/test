<?php
    require "../../vendor/autoload.php";
    use Controller\payment;
	date_default_timezone_set('Asia/Dhaka');
	session_start();
	$admin= $_SESSION['admin'];
	$time=  date('g:i a, d/m/y');
	if(isset($_GET['unique_id'])){
		$unique_id= $_GET['unique_id'];
	}
	else { header('location:../search.php');}


    $payment = new payment($_GET['unique_id']);

    $ttime= date('g:i a, d/m/y');
	$subitlink="";
	$aa="";
	$outtt="";
	$msg="";
	$outsum="0";
	$smsview="";
	$ar="";
	$oo="";
	$ql="";
	$reload= "<script>window.location='payment.php?unique_id=$unique_id&action=add'</script>";
	$refresh= "<script type='text/javascript'>
			setTimeout(function () {
			window.location.href= 'payment.php?unique_id=$unique_id&action=add'; },6050);
			countDown(5,'status');
		</script>";	
	
// --------------get studnet info-------------------------	

	    $student_information = $payment->show_student();
	    $student_information_obj = (object)$student_information;



		
		//$student_information= "Name: <u>$sinfo_name</u> &nbsp;&nbsp;&nbsp; Class: <i> $sinfo_clas </i> &nbsp;&nbsp;&nbsp;";
				

//---------------------get due amount----------------------
				/*$get_due_sql="SELECT * FROM due where studentid=$unique_id";
				$get_due_query= mysqli_query($new,$get_due_sql);
				$get_found= mysqli_num_rows($get_due_query);
				$got_result= mysqli_fetch_assoc($get_due_query);
				$last_time = $got_result['time'];
				if($get_found == 0){
					$due_got = 0;
					$last_time = "Not found";
				}
				else {
					$due_got= $got_result['dueamount'];
					$last_time = $got_result['time'];
				}
				
				$due_out= "<tr>
					
					<td>Month Fee: $sinfo_amo</td>
					<td>Due Fee: $due_got</td>
					<td >Last Update: $last_time</td>
			
				</tr>
				</table>
				";*/
			//	$due_out= "Number: <i>$sinfo_number2</i>&nbsp;&nbsp;&nbsp;MonthlyFee: <i><u>$sinfo_amo</u></i> Due: $due_got  Last Update: $last_time";

					
	
if(isset($_SESSION['bill']))
{
	foreach($_SESSION['bill'] as $key =>$value)
	{

		$s = $value['month'];
		$s= change_month($s);
		$ad = $value['amount'];
		$data_ta = $value['type'];
		$data_t = change_type($data_ta);
		$ii= $data_ta;		
		$oo .= "<tr>
			<td>$data_t</td>
			<td>$s</td>			
			<td align='center'>$ad</td>
			<td align='center'><a href='payment.php?unique_id=$unique_id&action=delete&id=$key'> <i class='fas fa-trash'></i> </a></td>
				</tr>";
				
		$smsview .="$data_t $s $ad\n";
	}
			$item_array_id = array_column($_SESSION['bill'], 'amount');
			$ar = array_sum($item_array_id);
	if($oo==null)
	{
		$aa= "";
	}
	else
	{
		$aa = "<table class='table table-sm table-bordered table-hover'>
			<tr>
			<th>Type</th>
			<th>Month/Exam</th>
			<th>Amount</th>
			<th>Action</th>
		</tr> $oo
		<tr>
		<td colspan='2' align='right'>Grand Total: </td>
		<td  align='center'>$ar</td>
		<td></td>		
		</tr>
		</table>
		<br />";
		$subitlink= "<input type='submit' name='inserte' value='Submit' />";	
	}
}
	$campaign= "$admin-> Payment ->";
if(isset($_POST['inserte']))
{
	foreach($_SESSION['bill'] as $key =>$value)
	{
		$typea= $value['type'];
		$payment_causeea= $value['month'];	
		$amounta= $value['amount'];			
		$ql .=" ('$unique_id','$typea','$payment_causeea','$amounta','$time','$admin'), ";
	}
	$qll= rtrim($ql,', ');
	$querry="INSERT INTO `payment`(`unid`, `type`, `payment_cause`, `amount`, `time`, `admin`) VALUES $qll";
	
	$insert_system= $new->query($querry);

	if($insert_system)
	{
			$msg ="Success wait 5s";
			unset($_SESSION['bill']);
			$ssms= "Payment of ". $student_information_obj->name .",\n$smsview Total: $ar tk\nThanks\nHCS";
			//echo pay_sms_cam($ssms,$sinfo_number2,$campaign);
			echo $refresh;
	}
	else 
	{
		$msg ="Error";
	}

}
	
	if(isset($_POST['submit']))
	{
		if(isset($_SESSION['bill']))
		{	
	
		$oky= $key;
			$count= $oky + 1;

	
	
				$item_array = array(
								'type' => $_POST['type'],
								'month' => $_POST['month'],
								'amount' => $_POST['amount']
				);
			$_SESSION['bill'][$count] = $item_array;
	
		}
		else
		{
			$item_array = array(
								'type' => $_POST['type'],
								'month' => $_POST['month'],
								'amount' => $_POST['amount']
				);
				$_SESSION['bill'][0]= $item_array;
		}
	
	echo $reload;
	}
	
	if(isset($_GET["id"]))
	{if($_GET['action']== "delete")
			{
				unset($_SESSION["bill"][$_GET['id']]);  				
			echo $reload;
			}
	
	}
	
	
// --------------get payment histyor-------------
function gdata($a,$b,$m,$s){
	$output1="";
	include ("../../db.php");
	$get_pay_sql="SELECT * FROM `payment` WHERE unid=$a && type=$b && payment_cause=$m
	ORDER BY `payment`.`payment_cause` ASC";
		$gquery=mysqli_query($new,$get_pay_sql);
		if(mysqli_num_rows($gquery)>0){
			while($res=mysqli_fetch_assoc($gquery))
			{
				
				$cause= $res['payment_cause'];
				$timee= $res['time'];
				$time = explode(',',$timee);
				$p_date = $time[1];
				$p_time = $time[0];
				
				$amo= $res['amount'];
				
				$cause = change_month($cause);
				$output1="<td align='center'>$amo</td>";
				
			}
			
		}
		
		else{
					if($b==33){$s=0;}else{$s=$s;}
				if($s==1){$output1 ="<td style='background: red;color:white;' align='center'>Due</td>";}else{$output1 ="<td align='center'>--</td>";}
				
			}	
			return $output1;
}
//------------------------ grand total------------
	$totalquery = "SELECT * FROM payment where unid=$unique_id";
	$myquery = mysqli_query($new,$totalquery);
	while($re = mysqli_fetch_assoc($myquery))
	{
		$gamo =$re['amount'];
		
		$outtt .=$gamo;
	
		$outsum +=$gamo;
	}	
	
	
	
//-------------------insert--due amount----------------------
		if(isset($_POST['due_submit']))
		{
			$operator = $_POST['sum'];
			$due_amount= $_POST['due_amount'];
			if($operator== 1)
			{
					$due_amount = $due_got + $due_amount;
			}
			else {
				$due_amount = $due_got - $due_amount;
			}
			
		
				if($get_found == 0)
				{
					$due_insert_sql="INSERT INTO `due`(`studentid`, `time`, `dueamount`) VALUES ('$unique_id', '$ttime', '$due_amount')";
					$insert_due= $new->query($due_insert_sql);
					if(!$insert_due){$msg .="Due INSERT Failed";}
					else {$msg .="Due INSERT Success";}
					
					$refresh= "
		<script type='text/javascript'>
			setTimeout(function () {
		window.location.href= 'payment.php?unique_id=$unique_id'; },5050);
		countDown(5,'status');
		</script>";
				}
				else if($get_found == 1){
					$due_update_sql="UPDATE `due` SET `dueamount` = '$due_amount', `time` = '$ttime' WHERE `due`.`studentid` = $unique_id;";
					$update_due= $new->query($due_update_sql);
					if(!$update_due){$msg .="Due UPDATE Failed";}
					else {$msg .="Due UPDATE Success";}
					
					$refresh= "
		<script type='text/javascript'>
			setTimeout(function () {
		window.location.href= 'payment.php?unique_id=$unique_id'; },5050);
		countDown(5,'status');
		</script> 
	";
				}
		}
		


?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<script src="../../src/jquery-1.12.0.min.js"></script>
    <link rel="icon" href="../../img/icon.ico" />
    <link rel="stylesheet" href="../../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../src/fa/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo "name";?>-Hostory of Payment</title>
</head>

<div>
	<?php include "../header.php";?>
    <div class="row m-0 p-0">
        <div class="col-2">
            <a href="../index.php" class="btn btn-info w-100 mt-2">Home</a>

        </div>
    <div class="col-md-8">
        <p class='bg-light h4 font-weight-bold p-3'>Payment Panel</p>
        <div>
            <table class="table table-hover table-sm table-bordered">
                <tr>
                    <td>Name</td>
                    <td><?php echo $student_information_obj->name;?></td>
                    <td>Class</td>
                    <td><?php echo $student_information_obj->class;?></td>
                </tr>
            </table>
        </div>
        <?php echo $msg;?>
        <hr />
        <div class="msg">Take Payment</div>
            <form action="payment.php?unique_id=<?php echo $unique_id;?>&action=add" method="POST">

                <select name="type" id="type" required>
                    <option value="">Select Fee Type</option>
                    <option value="11">Monthly Fee</option>
                    <option value="22">Exam Fee</option>
                    <option value="33">Choaching Fee</option>
                    <option value="55">Other Fee</option>
                </select>
                    <div id="mon"></div>

                <input type="submit" value="Add" name="submit" />
            </form>
            <?php echo $aa;?>
        <form action="payment.php?unique_id=<?php echo $unique_id?>&action=add" method="POST">
            <?php echo $subitlink;?>
        </form>
        <br />
        <?php
            $monthnam= date('n');
            $t="";
                for($i=1;$i<=12;$i++)
                {
                        $monthn= change_month($i);
                        $monthNum  = $i;
                        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                        $monthName = $dateObj->format('F');

                    if($monthnam>=$i){$s="1";}else{$s="0";}

                    $data = gdata($unique_id,'11',$i,$s);

                    $data2 = gdata($unique_id,'33',$i,$s);
                    $t .= "<tr>
                    <td>$monthName</td>
                    $data                    
                    $data2
                    </tr>";
                }
                ?>
                    <table class='table table-hover table-bordered table-sm'>
                       <thead class='thead-light'>
                            <tr>
                                <th>Month</th>
                                <th>Monthly Fee</th>
                                <th>Coaching Fee</th>
                            </tr>
                       </thead>
                       <tbody>
                            <?php echo $t;?>
                        </tbody>
                    </table>
        <?php

                $ss='0';
                $fa=gdata($unique_id,'22','112',$ss);
                $s=gdata($unique_id,'22','122',$ss);
                $th=gdata($unique_id,'22','132',$ss);
                echo"<br /><br /><table class='table table-hover'>
                    <tr>
                        <th colspan='3'>Semester Exam Fee</th>
                    </tr>
                    <tr>
                        <th>1st Semester</th>
                        <th>2nd Semester</th>
                        <th>3rd Semester</th>
                    </tr>
                    <tr>
                        $fa
                        $s 
                        $th 
                    </tr>
                </table>";
                $ss='0';
                $faa=gdata($unique_id,'22','111',$ss);
                $sa=gdata($unique_id,'22','121',$ss);
                $tha=gdata($unique_id,'22','131',$ss);
                echo"<br /><br /><table class='table table-hover table-bordered'>
                    <thead>
                    <tr>
                        <th colspan='3'>Pre Semester Exam Fee</th>
                    </tr> <tr>
                        <th>1st Pre Semester</th>
                        <th>2nd Pre Semester</th>
                        <th>3rd Pre Semester</th>
                    </tr>
                    
</thead>
                   
                    <tbody>
                    <tr>$faa$sa $tha 
                    </tr>
</tbody>
                </table>";


            ?>






    </div>

    <div class="col-md-2">
            <br />
            <p>SMS VIEW</p>
    <textarea name='' id='' cols='30' rows='10' disabled>Payment of <?php echo $student_information_obj->name."\n".$smsview." Total: ".$ar." tk\nThanks\nHCS";?> </textarea>
    </div>
</div>
    <script>
        $(document).ready(function()
        {
            $('#type').change(function()
            {
                var id=  $(this).val();
                var unid= "<?php echo $unique_id;?>";
                $.ajax({
                    url: "ajaxbg.php",
                    method: "POST",
                    data:{payid1:id,unid:unid},
                    success: function(data)
                    {
                        $('#mon').html(data);
                    }
                });
            });
        }
        );





    </script>
</body>
</html>