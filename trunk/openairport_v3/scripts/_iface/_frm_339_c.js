function closesurface(fieldtext,status) {
	
		var surface_status = document.getElementById(status).value;
		
		//alert(surface_status);
		// Assemble surface inputbox fieldnames
		
		var surfacemu_name = fieldtext + "Mu";
		var surfacemu_cond = fieldtext + "Condition";
		
		var surface_cond	= document.getElementById(surfacemu_cond).value;
		
		if(surface_cond == "CLOSED") {
			// Surface is closed already, reset input fields
			document.getElementById(surfacemu_name).value = "";
			document.getElementById(surfacemu_cond).value = "";
		}
		else {
			// Surface is open close it
			document.getElementById(surfacemu_name).value = "";
			document.getElementById(surfacemu_cond).value = "CLOSED";		
			
		}
}

function closesurface_rwy(fieldtext,status) {
	
		var surface_status = document.getElementById(status).value;
		
		//alert(surface_status);
		// Assemble surface inputbox fieldnames
		
		//var surfacemu_name = fieldtext + "Mu";
		var surfacemu_cond = fieldtext + "Condition";
		
		var surface_cond	= document.getElementById(surfacemu_cond).value;
		
		if(surface_cond == "CLOSED") {
			// Surface is closed already, reset input fields
			//document.getElementById(surfacemu_name).value = "";
			document.getElementById(surfacemu_cond).value = "";
		}
		else {
			// Surface is open close it
			//document.getElementById(surfacemu_name).value = "";
			document.getElementById(surfacemu_cond).value = "CLOSED";		
			
		}
}
		
function closesurface_junk(fieldtext,status) {
	
}