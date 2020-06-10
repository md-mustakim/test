<?php 
	include "auth/session.php";

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
        </div>
        <div class="col-md-8">
            <div class="bg-light mt-3">
                <div class="p-2">

                    <div class="mb-3">
                        <div class="h5">Student Search</div>
                        <hr>
                        <input class="form-control w-50" type="text" name="search_text" id="search_text" placeholder="search any thing" autofocus />
                    </div>
                    <p class="text-info align-content-center">You can search any keyword like: number, name, father's name</p>

                    <div class="m-0 p-0" id="result"></div>


                </div>

            </div>
        </div>

        <div class="col-md-2">
            <div class="msg">
                <div class="blink">Important</div>
            </div>
            <p>Please correct invalid number. Sms will not send invalid number.</p>
        </div>

    </div>

   
   	
 </body>
</html>


<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>