function countDown(secs,elem) {
	var element = document.getElementById(elem);
	element.innerHTML = "<p align='center' style='font-weight:bold;background: green; color:white;padding:5'>Success!!! Wait "+secs+" </p>";
	if(secs < 1) {
		clearTimeout(timer);
		element.innerHTML = '';
	}
	secs--;
	var timer = setTimeout('countDown('+secs+',"'+elem+'")',800);
}