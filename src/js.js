<script>
function countDown(secs,elem,msge) {
	var element = document.getElementById(elem);
	var msg = msge;
	element.innerHTML = "<p align='center' style='font-weight:bold;background: green; color:white;padding:5'>"+msg+" close in "+secs+" </p>";
	if(secs < 1) {
		clearTimeout(timer);
		element.innerHTML = '';
		
		
	}
	secs--;
	var timer = setTimeout('countDown('+secs+',"'+elem+'","'+msg+'")',800);
}
</script>