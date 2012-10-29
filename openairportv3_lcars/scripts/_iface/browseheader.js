var intOldCellvalue;
var intNewCellvalue;

function getvaluesortform(strCell)
	{
	var strCellName = escape(strCell)
	var intCellValue = document.getElementById(strCellName).value;
	intOldCellvalue = intCellValue;
	}
function updatesortform(strCell)
	{
	var strCellName = escape(strCell)
	var intCellValue = document.getElementById(strCellName).value;
	intOldCellvalue = intCellValue;

	if (intOldCellvalue == "Decending")
		{
		intNewCellvalue = "NotSorted";
		}
	else if (intOldCellvalue == "NotSorted")
		{
		intNewCellvalue = "Assending";
		}
	else if (intOldCellvalue == "Assending")
		{
		intNewCellvalue = "Decending";
		}

	var strCellName = escape(strCell);
	document.getElementById(strCellName).value = intNewCellvalue;
	
	var currentvalueof_systemtext = parent.document.getElementById('SystemText').innerHTML;
	var newmessage = "Sorting control has been moved to " + intNewCellvalue + " << ";
	var completed_message = (newmessage) + " << " + (currentvalueof_systemtext);
	parent.document.getElementById('SystemText').innerHTML = completed_message;	
	
	document.sorttable.submit();					
	}
function updatewhereform(strCell)
	{
	var SQLStringtoAdd = escape(strCell)
	var CurrentSQLAddString = document.getElementById("strsqlwhereaddon").value;
	var NumberofStringAddons = document.getElementById("intsqlwhereaddon").value;

	NumberofStringAddons = NumberofStringAddons * 1;
		
	if (NumberofStringAddons > 1) {
		document.getElementById("strsqlwhereaddon").value = CurrentSQLAddString + " AND " + SQLStringtoAdd;
		}
	if (NumberofStringAddons == 1) {
		document.getElementById("strsqlwhereaddon").value = CurrentSQLAddString + " AND " + SQLStringtoAdd;
		}
	if (NumberofStringAddons == 0) {
		document.getElementById("strsqlwhereaddon").value = " WHERE " + SQLStringtoAdd;
		}

	NumberofStringAddons = NumberofStringAddons + 1;
	document.getElementById("intsqlwhereaddon").value = NumberofStringAddons;
	document.getElementById("intfrmjoined").value = 1;
	document.sorttable.submit();		
	}
	
function updatecontrolform(strCell)
	{
	var fieldtocontrol 			= escape(strCell);
	var currentvalueinfield 	= document.getElementById(fieldtocontrol).value;
	var fieldtocontrol_show		= fieldtocontrol + "active";

	if (currentvalueinfield == 1) {
		
		var message = "NOT ACTIVE!";
		document.getElementById(fieldtocontrol).value		= 0;
		document.getElementById(fieldtocontrol_show).value	= message;
		
		}
	if (currentvalueinfield == 0) {
		
		var message = "ACTIVE!";
		document.getElementById(fieldtocontrol).value 		= 1;
		document.getElementById(fieldtocontrol_show).value	= message;
		}
		
		var currentvalueof_systemtext = parent.document.getElementById('SystemText').innerHTML;
		var newmessage = "Sorting control has been moved to " + message + " << ";
		var completed_message = (newmessage) + " << " + (currentvalueof_systemtext);
		parent.document.getElementById('SystemText').innerHTML = completed_message;	
	
	}