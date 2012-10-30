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

function toggle2(showHideDiv,maxcounter) {
	
	var ele = document.getElementById(showHideDiv);
	var maxdiv = maxcounter;
	
	//alert(maxcounter);
	
	maxdiv = maxdiv * 1;
	
	//alert(maxdiv);
	// Force all known DIVs hidden
	
	for (i=1;i<maxdiv;i++) { 
			
			//alert(i);
			
			var divtohide_name = "divform_" + i;
			
			//alert(divtohide);
			
			//divtohide = document.getElementById(divtohide);
			
			var element =  document.getElementById(divtohide_name);
			
			if (typeof(element) != 'undefined' && element != null)
			{
			  if(divtohide_name == showHideDiv) {
					// Do nothing
			  } else {
					document.getElementById(divtohide_name).style.display = "none";
			  }
			}
			
			
			
			var currentvalueof_systemtext = parent.document.getElementById('SystemText').innerHTML;
			var newmessage = "Hidding Div Layer " + i + " << ";
			var completed_message = (newmessage) + " << " + (currentvalueof_systemtext);
			parent.document.getElementById('SystemText').innerHTML = completed_message;	
		}
	
	
	
	
	if(ele.style.display == "block") {
			ele.style.display = "none";
			var message = "Overlay " + showHideDiv + " Closed";
		}
		else {
			ele.style.display = "block";
			var message = "Overlay " + showHideDiv + " Opened";
		}
	
	
		var currentvalueof_systemtext = parent.document.getElementById('SystemText').innerHTML;
		var newmessage = "Showing Row Controls " + message + " << ";
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