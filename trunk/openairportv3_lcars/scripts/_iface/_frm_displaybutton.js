function displaybutton(fieldtext) {
	
	var valuetoget = escape(fieldtext);
	var valuetoset = escape(fieldtext) + '_d';
	
	//alert(valuetoget);
	var checkvalue = document.getElementById(valuetoget).value;
	var ele = document.getElementById(valuetoset);
	
	//alert(checkvalue);
	if(checkvalue == 1) {
			ele.style.display = "block";
		}
		else {
			ele.style.display = "none";
		}
	}