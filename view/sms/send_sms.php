<?php
	session_start();	
	if(!isset($_SESSION['admin'])){
	header("Location: ../login.php");
	}

    include '../../model/app.php';
	$app = new app();
	
	$admin= $_SESSION['admin'];

	date_default_timezone_set('Asia/Dhaka');
	$ttime= date('g:i a, d/m/y');


	$get_all_group_query = "select * from shift";
	$shift_datas = $app->view($get_all_group_query);
	$get_all_class_query = "select * from class_list";
	$class_datas = $app->view($get_all_class_query);



?>

<DOCTYPE HTML>
<html lang="en-US">
<head>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta charset="UTF-8">
	<title>Send SMS || HCS App</title>
	<link rel="stylesheet" href="../../src/bootstrap.min.css" />
	<link rel="icon" href="../../img/icon.ico" />
    <link rel="stylesheet" href="../../src/jquery-1.12.0.min.js">

</head>
<body>
	<?php include '../header.php';?>



	<div class="row m-0 p-0">
	<div class="col-md-2 m-1">
	    <div class="p-1 m-1 bg-light">
            <button
                    class="btn btn-info w-100 mb-2 font-weight-bold text-light"
                    onclick="window.location.href = '../index.php';">
                Return Home
            </button>
            <button
                    class="btn btn-info w-100 mb-2 font-weight-bold text-light"
                    onclick="window.location.href = 'sms_history.php';">
                SMS History
            </button>

	    </div>
	</div>

	<div class="col-md-8">
	<div class="m-2 p-3 p-md-5 border rounded">

			<div class="h5 bg-light p-3">Send SMS</div>
            <span id="result"></span>
        <form onsubmit="event.preventDefault(); validator();" id="sms_form">
            <div class="mt-4">
                <select name="numberlist" id="numberlist" class="form-check">
                    <option value="">Select Number List</option>
                    <option value="100">All Shift (student)</option>
                    <?php
                        foreach ($shift_datas as $item => $value)
                        {
                            $shift_id = $value['shift_id'];
                            $shift_name = $value['shift_name'];
                            echo "<option value=".$shift_id.">".$shift_name."</option>";
                        }
                    ?>
                    <option value="200">Staff /Teacher</option>
                    <option value="300">Admin</option>

                </select>
                <small id="group_msg"></small>
            </div>
			<br>

			<textarea type="m" name="m" id="m" class="form-control" rows="7" placeholder="Write a message" required></textarea><br />
            <small id="m_msg"></small>
			<span class="font-weight-bold">Cost: </span>
			<span id="perSmsCost">0.00</span>  &nbsp;||
			
			<span class="font-weight-bold">Font: </span>
			<span id="lenth">0</span> &nbsp;|| <span class="font-weight-bold">Type: </span><sapn id="msgType">English</sapn><br />
			<label class="h6 mt-2" for="cata">Why send SMS: </label><input class="form-control" id="why" type="text" name='cata' required/> <br>
            <small id="why_msg"></small>

            <input type="button" name="submit" id="submit" class="btn btn-success" value="SEND" onclick="validator()"/>

            <input type="button" name="preview" id="preview" class="btn btn-info" value="PREVIEW" onclick="preview()"/>

        </form>

	
	</div></div>
	<div class="col-md-2">
	</div>
	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
           function oss(str) {
                for (var i = 0, n = str.length; i < n; i++) {
                    if (str.charCodeAt( i ) > 0980) { return true; }
                }
                return false;
            }

           function calculate() {
                var messageData = document.getElementById("m");
                var l = messageData.value.length;
                var v = messageData.value;
                var f = this.oss(v);

                if(f === true)
                {
                    var msgLength = 70;
                    msgType.innerHTML = "Bangla";

                }else
                {
                    var msgLength = 160;
                    msgType.innerHTML = "English";
                }

                var msgC = l / msgLength;

                var msgCount = Math.ceil(msgC);
                var baseCost = 0.40;
                var perSmsCost = baseCost * msgCount;
                var perSmsCost = perSmsCost.toFixed(2);
                //var perSmsCost = Math.round(perSmsCost);
                return perSmsCost;
            }


    </script>

        <script>


           function preview()
           {
                var group_id = document.getElementById("numberlist");
                var msgValue = document.getElementById("m").value;
                var perSmsCost = this.calculate();
             if(group_id.value >0)
                         {
                             $.ajax({
                                 url: "sms_background.php",
                                 method: "POST",
                                 data:{group_id: group_id.value,pre_preview:1},
                                 success: function (data)
                                 {
                                     console.log("id: "+group_id.value+"Content: "+msgValue+"PerSmsCost: "+perSmsCost);
                                     var r = data.split(",");
                                     var countNumber = r[0];
                                     var receiverName = r[1];
                                     var totalCost = countNumber * perSmsCost;
                                     var totalCosts = totalCost.toFixed(2);
                                     alert("Receiver: "+ receiverName +" ("+countNumber+"  PERSON)"+ "\r\n"+"Message: \r\n"+msgValue+"\r\nCost: "+perSmsCost+"\r\n"+"\r\nTotal Cost : "+totalCosts+"Tk");
                                 }
                             });
                         }
                            else
                         {
                             alert("Please Select NumberList");
                         }

           }
        </script>

        <script>
                function os(str) {
                    for (var i = 0, n = str.length; i < n; i++) {
                        if (str.charCodeAt( i ) > 0980) { return true; }
                    }
                    return false;
                }

                    $("textarea").keyup(function(){


                    $("#lenth").text($(this).val().length);
                    var l = this.value.length;
                    var v = this.value;
                    var f = os(v);
                    var msgType = document.getElementById("msgType");
                    if(f === true)
                    {
                        var msgLength = 70;
                        msgType.innerHTML = "Bangla";

                    }else
                    {
                        var msgLength = 160;
                        msgType.innerHTML = "English";
                    }

                    var msgC = l / msgLength;

                     var msgCount = Math.ceil(msgC);
                     var baseCost = 0.40;
                     var perSmsCost = baseCost * msgCount;
                     var perSmsCost = perSmsCost.toFixed(2);
                     //var perSmsCost = Math.round(perSmsCost);
                    document.getElementById("perSmsCost").innerHTML = perSmsCost;

                    });

                function send_message() {
                    var submit = document.getElementById("submit");
                        submit.disabled = true;
                    var  msgId = document.getElementById("m");
                    var  grId = document.getElementById("numberlist");
                    var  whyId = document.getElementById("why");
                    var admin = "<?php echo $_SESSION['id'];?>";
                    var cost = this.calculate();
                    var r = document.getElementById("result");


                    $.ajax({
                            url: "sms_background.php",
                            method: "post",
                            data:{
                                send:1,
                                msg_value: msgId.value,
                                group: grId.value,
                                why: whyId.value,
                                admin_id: admin,
                                cost: cost,
                            },
                            success: function (priva) {
                                console.log(priva);
                                if(priva == 1900)
                                {
                                    document.getElementById('sms_form').reset();

                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Your work has been saved',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });


                                }
                                else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Error!! Message Not sent',
                                        showConfirmButton: false,
                                        showCancelButton: true,
                                    });

                                }

                            }
                    });
                    setTimeout(function () {
                        submit.disabled= false;

                    },3000);


                }
                function validator()
                {
                    var group= document.getElementById("numberlist");
                    var group_msg= document.getElementById("group_msg");
                    var group_status;
                    var why_status;
                    var m_status;
                    if(group.value <1)
                    {
                        console.log("group not selected");
                        group_msg.innerHTML = "Please Select a valid group";
                        group_msg.classList.add("text-danger");
                        group.classList.add("border");
                        group.classList.add("border-danger");
                        group_status = 0;

                    }else {
                        group_status = 1;
                    }


                    var messageValue = document.getElementById("m");
                    var m_msg = document.getElementById("m_msg");
                    if(messageValue.value <10)
                    {
                        console.log("msg not selected");
                        m_msg.innerHTML = "Please Write a message (10+) <br>";
                        m_msg.classList.add("text-danger");
                        messageValue.classList.add("border");
                        messageValue.classList.add("border-danger");
                         m_status = 0;
                    }else {
                         m_status = 1;
                    }

                    var whyvalue = document.getElementById("why");
                    var why_msg = document.getElementById("why_msg");
                    if(whyvalue.value <1)
                    {
                        console.log("why not selected");
                        why_msg.innerHTML = "Please Complete this field <br>";
                        why_msg.classList.add("text-danger");
                        whyvalue.classList.add("border");
                        whyvalue.classList.add("border-danger");
                         why_status = 0;
                    }else {
                        why_status = 1;
                    }

                    if(m_status+group_status+why_status === 3)
                    {
                        console.log("ok message system");
                        send_message();


                    }


                }
        </script>


	
	
</body>
</html> 

