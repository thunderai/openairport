function toggle(showHideDiv) {
	
	var ele = document.getElementById(showHideDiv);
	//alert("message");
	
	if(ele.style.display == "block") {
			ele.style.display = "none";
			var message = "Overlay Closed";
		}
		else {
			ele.style.display = "block";
			var message = "Overlay Opened";
		}
	
	
		var currentvalueof_systemtext = parent.document.getElementById('SystemText').innerHTML;
		var newmessage = "Sorting control has been moved to " + message + " << ";
		var completed_message = (newmessage) + " << " + (currentvalueof_systemtext);
		parent.document.getElementById('SystemText').innerHTML = completed_message;	
} 
	
function checkcalibration(fieldtext) {
	
	var cv = escape(fieldtext) + "c";
	var ev = escape(fieldtext) + "e";
	var sv = escape(fieldtext) + "s";
	var iv = escape(fieldtext) + "i";
	
	var initialvalue 			= document.getElementById(iv).value;
	var correctedvalue 			= document.getElementById(cv).value;
	var specificationvalue 		= document.getElementById(sv).value;
	var tollerancevalue 		= document.getElementById(ev).value;
	
	var initialvalueint 		= initialvalue * 1;	
	var correctedvalueint 		= correctedvalue * 1;
	var specificationvalueint 	= specificationvalue * 1;
	var tollerancevalueint 		= tollerancevalue * 1;
	
	var correctedup 	= (specificationvalueint + tollerancevalueint);
	var correcteddn 	= (specificationvalueint - tollerancevalueint);
	
	var errormessage 	= "WARNING: The corrected measurement is out of compliance.";
	var errormessageup 	= "\n\n The corrected measurement must be lower. It is currently too high";
	var errormessagedn 	= "\n\n The corrected measurement must be higher. It is currently too low";
	var errormessagend 	= "\n\n Specification is " + specificationvalueint + ", with a tollerance of + or - " + tollerancevalueint + ". Please adjust your measurement"; 
	
	if (correctedvalueint > correctedup) {
		
		var outoftollerance =  (correctedvalueint - (specificationvalueint + tollerancevalueint));
		var messageis = errormessage + errormessageup + errormessagend + "\n\n You are off by " + outoftollerance;
		alert(messageis);
		
		}
		
	if (correctedvalueint < correcteddn) {
		
		var outoftollerance =  (correctedvalueint - (specificationvalueint - tollerancevalueint));
		var messageis = errormessage + errormessagedn + errormessagend + "\n\n You are off by " + outoftollerance;
		alert(messageis);
		
		}		
		
	}