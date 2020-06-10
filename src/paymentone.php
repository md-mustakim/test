
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>  
	<title>Hostory of Payment</title>
</head>
<body>
	<?php include "header.php";?>
<div class="column1"></div>
<div class="column2">
	<form action="paymentone.php" method="POST">
	<select name="type" id="type" onChange="month(this.value)">
		<option >Select Fee Type</option>
		<option value="11">Monthly Fee</option>
		<option value="22">Exam Fee</option>
		<option value="33">Choaching Fee</option>
		<option value="44">Other Fee</option>
	</select>
		<div id="mon"></div>
		
		<input type="submit" value="Submit" name="submit" />
	</form>
</div>
<div class="column3"></div>
</body>
</html>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>  
<script>
	function month(month)
	{
		$.post('pay1.php',{payid1:month},
		function(data){
			$("#mon").html(data);
		}
		);
		
		
	}
	alert("This page is not complete, trial only");

</script>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>  