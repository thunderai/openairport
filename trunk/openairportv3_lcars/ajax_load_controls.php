<?php
include("includes/_template_header.php");	
//include("includes/quickaccessFunctions.php");	

		$string 	= $_GET['start'];			// ID if Selected Menu Item
		$userid		= $_GET['userid'];				// Who are you
		
		$tblkeyvalue = $objarray[$tblkeyfield];
		//_tp_control_duplicate($tblkeyvalue, $array_duplicatecontrol, $functionduplicatepage);
		//_tp_control_archived($tblkeyvalue, $array_archivedcontrol, $functionarchievedepage);
		//_tp_control_error($tblkeyvalue, $array_errorcontrol, $functionerrorpage);
			
		//include("includes/_template/_tp_blockform_workorder.binc.php");
		
		//echo "<font size='1'>".$string;
		echo "Controls are shown to the right for the record you selected.=>";
?>