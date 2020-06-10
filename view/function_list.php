<?php

	//--------make serial-----------------
		function serial($classid,$rollnon,$semester)
		{
        include "../db.php";       
       
		$q="SELECT * FROM `fm19` LEFT JOIN student_info ON fm19.uniid = student_info.uniqueid where class=$classid AND fm19.semester=$semester
		ORDER BY `fm19`.`marks` DESC";
        $qq = mysqli_query($new,$q);
        $i = 0;
        $rs = 0;
        $returnid = 0;
		
		
        while($r=mysqli_fetch_assoc($qq))
        {
            $i = $i+1;
			$rs++;
            $marks = $r['marks'];
            $tgpa = $r['count_gpa5'];          
            $roll = $r['class_roll'];          
            
            if($rollnon == $roll)
            {
               // $returnid = $i;
				$returnid = $i;
            }
			
			
        }
		
      
		return $returnid;
	   }
     
	
	
	function change_class($input){
		if($input==1){return "Jounior Play";}
		if($input==2){return "Play";}
		if($input==3){return "Nursery";}
		if($input==4){return "One";}
		if($input==5){return "Two";}
		if($input==6){return "Three";}
		if($input==7){return "Four";}
		if($input==8){return "Five";}
	}
	
	
	//payment cause
	function change_month($input){
		if($input==1){return "Jan";}
		if($input==2){return "Feb";}
		if($input==3){return "Mar";}
		if($input==4){return "Apr";}
		if($input==5){return "May";}
		if($input==6){return "Jun";}
		if($input==7){return "Jul";}
		if($input==8){return "Aug";}
		if($input==9){return "Sep";}
		if($input==10){return "Oct";}
		if($input==11){return "Nov";}
		if($input==12){return "Dec";}	
		if($input==111){return "1st Pre-Sem";}	
		if($input==112){return "1st Sem";}	
		if($input==121){return "2nd Pre-Sem";}	
		if($input==122){return "2nd Sem";}
		if($input==131){return "3rd Pre-Sem";}	
		if($input==132){return "3rd Sem";}	
		
		else{return $input;}
	}
	function change_type($input){
			if($input==11){return "Monthly";}
			if($input==22){return "Exam";}
			if($input==33){return "Coaching";}
			if($input==44){return "Weekly";}
			if($input==55){return "Other";}
			
	}
	function change_semester($input)
	{
			if($input==100){return "1st Semester";}
			if($input==101){return "1st Pre Semester";}
			if($input==200){return "2nd Semester";}
			if($input==201){return "2nd Pre Semester";}
			if($input==300){return "3rd Semester";}
			if($input==301){return "3rd Pre Semester";}
			if($input==111){return "1st Semester Weekly";}
			if($input==211){return "2nd Semester Weekly ";}
			if($input==311){return "3rd Semester Weekly ";}
	}
	
	
	
	
	
//-------------attendance validity-----------------
		function attand_validity($a,$b) {
	include __DIR__."/../db.php";
		$class_attand= mysqli_num_rows(mysqli_query($new,"SELECT * FROM attendance where cls=$a and date like '%".$b."%'"));
		$class_total= mysqli_num_rows(mysqli_query($new,"SELECT * FROM student_info where class=$a and status=1"));

		if($class_total==0)
		{
			$result= "2";
		}
		else if ($class_total>=1)
		{
			if($class_attand>0)
			{
			$result= "1";
			}
			else if($class_attand==0) {
				$result= "0";
			}
			
		}
		
		
		return $result;
		}
	
	
	
function get_number($cls){
		include ("../db.php");
		$number_list="";
		//$cls="8";
	if($cls==0)
	{
			$get_number_sql="SELECT * FROM `student_info` where status=1";
	}
	else {
			$get_number_sql="SELECT * FROM `student_info` where class=$cls and status=1";
	}
		
	
		$qq= mysqli_query($new,$get_number_sql);
		while($r= mysqli_fetch_assoc($qq))
		{
				$monther_number= $r['mnumber'];
				
				$number_list .= "$monther_number, ";
		}
		$final = rtrim($number_list,', ');
		return $final;
	}

	//------------check valid phone number-------------
		
	function studentc($a)
	{	
		include ("../db.php");
		if($a>0){
		$line= "class=$a and";} else{$line="";}
		$c= mysqli_num_rows(mysqli_query($new,"SELECT * FROM student_info where $line status=1"));
		return $c;
	}
	function change_teacher($input)
	{
		include ("../db.php");
		$qr= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM teacher_info where id=$input"));
		return $qr['name'];
	
	
	}
	function change_subject($input)
	{
		include ("../db.php");
		$qr= mysqli_fetch_assoc(mysqli_query($new,"SELECT * FROM subject_list where subject_list_id=$input"));
		return $qr['subject_name'];
	
	
	}
	function check_number($input)
		{
			$inputt= strlen($input);if($inputt==11){return $input;}else{ return"<b style='color:red;' title='Invalid Number $input ($inputt digit)'><strike>$input</strike></b>";}
		}
	
	//----------------------------GRADE ----------------------------------------------------
		function grade_f($input)
		{
			if($input>=40){return "A+";}
			if($input>=35 && $input<40){return "A";}	
			if($input>=30 && $input<35){return "A-";}
			if($input>=25 && $input<30){return "B";}
			if($input>=20 && $input<25){return "C";}
			if($input>=16 && $input<20){return "D";}
			if($input>=0 && $input<16){return "F";}
		}
		function grade($input)
		{
			if($input>=80){return "A+";}
			if($input>=70 && $input<80){return "A";}	
			if($input>=60 && $input<70){return "A-";}
			if($input>=50 && $input<60){return "B";}
			if($input>=40 && $input<50){return "C";}
			if($input>=33 && $input<40){return "D";}
			if($input>=0 && $input<33){return "F";}
		}
		function gpa($input)
		{
			if($input>=80){return "5";}
			if($input>=70 && $input<80){return "4";}	
			if($input>=60 && $input<70){return "3.5";}
			if($input>=50 && $input<60){return "3";}
			if($input>=40 && $input<50){return "2";}
			if($input>=33 && $input<40){return "1";}
			if($input>=0 && $input<33){return "0";}
		}
		function gpa_f($input)
		{
			if($input>=40){return "5";}
			if($input>=35 && $input<40){return "4";}	
			if($input>=30 && $input<35){return "3.5";}
			if($input>=25 && $input<30){return "3";}
			if($input>=20 && $input<25){return "2";}
			if($input>=16 && $input<20){return "1";}
			if($input>=0 && $input<16){return "0";}
		}
		
		function gpa_grade($input)
		{
			if($input>=5){return "A+";}
			if($input>=4 && $input<5){return "A";}	
			if($input>=3.5 && $input<4){return "A-";}
			if($input>=3 && $input<3.5){return "B";}
			if($input>=2 && $input<3){return "C";}
			if($input>=1 && $input<2){return "D";}
			if($input>=0 && $input<1){return "F";}
		}

	
	//---------scale--------------
		function scale($a,$b,$c,$e)
		{	//a= obtain marks
			//b= full marks
			//c= scale
			$result= ($a * $c)/ $b;		
		
			$re= explode('.',$result);
			if(empty($re[1]))
			{
				return $result;
			}else
			{
				$a1=$re[0]; $a2=$re[1];
				if($a2>=5) 	{$a1=$a1+1;}
				return $a1;
			}			
		}
		function plusone($a)
		{
			$a = explode('.',$a);
			if(empty($a[1]))
			{
					return $a[0];
			}else
			{
				
				$b = $a[0]; $c= $a[1];
				$clen= strlen($c);
				if($clen==1){
					if($c>=5){$b=$b+1;}else{$b=$b;}
					return $b;
				}else{
					if($c>=50){$b=$b+1;}else{$b=$b;}
					return $b;
				}
				
			}
		}
		//---------scale-d-------------
		function scale_d($a,$b,$c,$e)
		{	//a= obtain marks
			//b= full marks
			//c= scale
			$result= ($a * $c)/ $b;		
		
			$re= explode('.',$result);
			if(empty($re[1]))
			{
				return $result;
			}else
			{
				return $result;
			}			
		}
	//---------persent--------------
		function persent($count, $total, $decimal)
		{
			$return = ($count * $total) /100;
			
			if($decimal==0)
			{
				$re= explode('.',$return);
				return $re['0'];
			}
			else
			{
				$t= number_format($return,2);
				return $t;
			}
		}	//---------persent--------------
		function persent_2($count, $total, $decimal)
		{
			$return = ($count *100) /$total;
			
			if($decimal==0)
			{
				$re= explode('.',$return);
				return $re['0'];
			}
			else
			{
				$t= number_format($return,2);
				return $t;
			}
		}
	//-------- chart graph--------------umber_format((float)$foo, 2, '.', '');
			function graph($input)	
	{	
		$color2= '#00805d1f';
		if($input<=20){$color= 'red';}
		if($input>20 && $input<=40){$color= '#e3a21a';} //orange
		if($input>40 && $input<=60){$color= '#fdd835';} //yellow
		if($input>60 && $input<=79){$color= '#0288d1';} //blue		
		if($input>=80){$color= '#0080008c';}
		$output = "<div style='background:$color2;border:0.5px solid #80808038;border-radius:7px;width:100%'><div style='border-radius:7px;background: $color; width: $input%;'><b style='padding:5px;color:white;  text-shadow: 0 0 3px #FF0000, 0 0 5px #0000FF;'>$input%</b></div></div>";
		return $output;
	}
//--------------------------------------------------from global varibale---------------------	

	function pcp($input)
	{	
		include"../db.php";
		$dat = date('d-m-y');	
		$date= "$dat-Morning";
		$total_student_active= mysqli_num_rows(mysqli_query($new,"SELECT * FROM student_info where status=1"));
		$today_present=mysqli_num_rows(mysqli_query($new,"SELECT * FROM attendance where attand=1 and cls=1 and date date like '%".$date."%'"));
		$today_absent=mysqli_num_rows(mysqli_query($new,"SELECT * FROM attendance where attand=0 and cls=$input and date like '.%".$date."%.'"));
		
			$return = ($today_present * 100) / $total_student_active;
			
				$re= explode('.',$return);
				//return $re['0'];
				return $date;
			
			
	}
	
	
	//-------ip ----------------------
			
	function getip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
	
?>