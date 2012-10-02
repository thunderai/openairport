<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	ajax_part139339_data_entry.php		The purpose of this page is to provide the inspection data entry page the checklist needed to complete the form.
	
								Usage:
								Dont unless you know what you want with it.
								
								
						
						
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		//include("includes/header.php");																	// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		//include("includes/POSTs.php");																	// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		include("includes/FormFunctions.php");														// already included in header.php
		
		
		// 0 Mu
		// 1 Checkbox
		// 2 Condition
		
	$aInspection		= "";
	$i				= 1;
	$current_facility	= "";
	$previous_facility	= "";
	$tmpfieldname		= "";

	$InspCheckList 		= $_GET["InspCheckList"];
	$IntInspector 		= $_GET["Employee"];
	
	
	if ($InspCheckList==0) {
			?>
			...Please select a type of anomalie
			<?
		}
		else {	
			if ($InspCheckList==1) {
					?>
					X: &nbsp;<input class="Commonfieldbox" type="text" name="MouseX" value="0" size="4">, Y: &nbsp;<input class="Commonfieldbox" type="text" name="MouseY" value="0" size="4">&nbsp;<INPUT class="formsubmit" TYPE="button" VALUE="Map Discrepancy" onClick="openChild2('mapit.php','Win2')">
					<?
				}
				else {
					?>
					X Points: &nbsp;<input class="Commonfieldbox" type="text" name="xpoints" value="0" size="25"><br>
					Y Points: &nbsp;<input class="Commonfieldbox" type="text" name="ypoints" value="0" size="25"><br>
					<INPUT class="formsubmit" TYPE="button" VALUE="Map Surface Anomalie Location" onClick="openChild2('mapdrawit_small.php?xpoints=xpoints&ypoints=ypoints','Win2')">
					<?
				}
		}
?>