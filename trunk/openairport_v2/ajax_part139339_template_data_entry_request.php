<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	ajax_part139339_template_data_entry.php	The purpose of this page is to provide the inspection data entry page the checklist needed to complete the form.
	
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
?>
			<center>
				<table cellspacing="3" cellpadding="5" width="100%">
					<tr>
				<?
				if ($InspCheckList=="NO") {
						//Display Nothing
						?>
						<td colspan="2" align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Enter the Name of this Template')"; onMouseout="hideddrivetip()">
							FiCON will not be saved as a template
							</td>
						<?
					}
					else {
						?>				
				<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Enter the Name of this Template')"; onMouseout="hideddrivetip()">
							Name of Template
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" type="text" name="frmtemplatename" size="30">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
							Purpose of Template
							</td>
						<td class="formanswers">
							<textarea name="frmtemplatepurpose" rows="5" cols="60"></textarea>
							</td>
						</tr>
						<?
					}
					?>
					</table>
				</center>