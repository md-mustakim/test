<?php
	session_start();
	if(isset($_SESSION['admin']))
    {
        header("location: ../index.php");
        echo 3;

    }
?>
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <script src="../../src/jquery-1.12.0.min.js"></script>
        <link rel="stylesheet" href="../../src/cost.css" />
        <link rel="stylesheet" href="../../src/bootstrap/css/bootstrap.min.css">
        <link rel="icon" href="../../img/icon.ico">
        <style type="text/css">
            body{
                background: url("../../img/wavep.png");
                background-size: cover;

            }
        </style>
        <meta charset="UTF-8">
        <title>Login | Admin Panel HCS</title>
    </head>
<body>
	<div class="">
            <div class="min-vh-100 min-vw-100 d-flex flex-row justify-content-center">
                <div class='shadow p-3 p-md-4 bg-light rounded align-self-center' style="min-width: 400px">
                    <form id="loginform" onsubmit="return login(event)">
                        <div class="h3 mb-4 p-2" style="background: #de85b01a"> User Login Form</div>
                      <div class="form-group">

                          <div id="mon"></div>
                            <label for="user" style="color: #ba599d; font-weight: bolder">User ID</label>
                            <input type="text" name="user" id="user" class="form-control" autocomplete="off" placeholder="Enter email or user id" required autofocus>
                      </div>
                      <div class="form-group">
                            <label for="pass" style="color: #ba599d; font-weight: bold">Password</label>
                            <input type="password" name="pass" id="pass" class="form-control" autocomplete="off" placeholder="Password" required>
                      </div>
                      <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="re" value="1">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                      </div>
                        <button class="btn w-100" onclick="login()" style="background: #ba599d; color: white; font-weight: bold">Login</button>
                    </form>

                </div>
            </div>

    </div>
</body>
</html>
    <script>
            function login(event){
                event.preventDefault();
                var u = document.getElementById("user").value;
                var p = document.getElementById("pass").value;
                var r = document.getElementById("re").value;
                $.ajax({
                    url: "bglogin.php",
                    method: "POST",
                    data:{u:u,p:p,r:r},
                    success: function(data)
                    {
                        $('#mon').html(data);
                    }
                });



            }



    //	alert("This page is not complete, trial only");

    </script>