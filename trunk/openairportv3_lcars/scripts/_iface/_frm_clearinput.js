function clearcellvalue(fieldname_to_clear,currentvalue) {
		//what os the current value of the field?
		var default_fieldname 	= fieldname_to_clear + "o";
		
		var default_value		= document.getElementById(default_fieldname).value;
		
		var active_value		= document.getElementById(fieldname_to_clear).value;
		
		if(active_value == "") {
				// No cell value, load default value
				document.getElementById(fieldname_to_clear).value = default_value;
		}
		else {
				// There is a default value, set to negative
				document.getElementById(fieldname_to_clear).value = "";
		}
	
}