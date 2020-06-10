<?php
	session_start();	
	include"db.php";
	include"function_list.php";
	
	
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<meta charset="UTF-8">
	<title>Payment</title>
	<link rel="stylesheet" href="style_1.css" />
	<div id="result"></div>
	<form action="test.php" method="POST">
		<input type="text" name="text" id="text" />
		<input type="number" name="textn" id="textn" />
		<input type="submit" onclick="load_data()"/>
	</form>
</head>
<body>

	
</body>
</html>
<script type="text/javascript">
	 
	var query= document.getElementById('text');
	
	
 function load_data(query)
 {
	 document.getElementById('text').innerHTML = "Welcome";
  $.ajax({
   url:"test1.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
</script>