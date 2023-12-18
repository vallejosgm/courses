function disableDropdown()
{
	var chkbox = document.getElementById('default');
	var dropdown = document.getElementById('pal-num-dd');
	if (chkbox.checked) dropdown.disabled = true;
	else dropdown.disabled = false;
} 