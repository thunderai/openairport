<?php 
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o		o	ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		oo		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		o o		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o 	o	o	ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  	 o	o	o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	  o	o	o	o	  o		o	o	o		o	o	o   o	  o
//	00000	0		ooooo	o		o	o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document		:	part139337_report_edit.php
//
//	Purpose of Page			:	Edit Existing Part139.337 Wildlife Reports
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes

		include("includes/_modules/part139337/part139337.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");

// Collect POST Information

		$discrepancyid 	= $_POST['recordid'];
		$disid 			= $_POST['recordid'];



		
//	Start Form Set Variables
	
	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "edittable";													// HTML Name for Form
			$formaction			= '';															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= '';															// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget
	
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= "Wildlife Hazard Report - Edit Report";						// Name of the FORM, shown to the user
			$form_subh			= "please complete the form";									// Sub Name of the FORM, shown to the user
			$subtitle 			= "Here is the information about the selected Error Report";	// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= '';													// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= 4;													// See Summary Function for how to use this number
				$returnHTML				= 0;													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
					

if (!isset($_POST['recordid'])) {
		// No Record ID Supplied, Crash Out
	}
	else {
		if (!isset($_POST["formsubmit"])) {
				// there is nothing in the post querystring, so this must be the first time this form is being shown
				// display form doing all our trickery!
				// There is a Record ID Supplied, Do work
				
				$last_main_id	= $_POST['recordid'];
				
				// Connect to Database
				$sql 		= "SELECT * FROM tbl_139_337_main WHERE 139337_id = '".$_POST['recordid']."' ";
				$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
						
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}
					else {
						$objrs = mysqli_query($objconn, $sql);
								
						if ($objrs) {
								$number_of_rows = mysqli_num_rows($objrs);
								?>
	<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3" class="perp_menuheader" />
				<?php echo $tblname;?>
				</td>			
			</tr>			
		<tr>
			<td colspan="3" class="perp_menusubheader" />
				(
				<?php echo $tblsubname;?>
				)
				</td>				
			</tr>
								<?php
								while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										?>
					<tr>
						<td colspan="2" class="item_name_inactive">
							<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
								<tr>
										<?php
										// Hijack Template Functions for our own purposes
										$settingsarray 	= array("SELECT * FROM tbl_139_337_main_a WHERE 139337_a_inspection_id = ",	"139337",	"part139337_report_display_archived.php");
										$functionpage	= "part139337_report_archieved.php";														
										_tp_control_archived($discrepancyid, $settingsarray, $functionpage);
										//$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_duplicate.php");
										//$functionpage	= "part139327_discrepancy_report_duplicate.php";														
										//_tp_control_duplicate($objarray['Discrepancy_id'], $settingsarray, $functionpage);
										$settingsarray 	= array("SELECT * FROM tbl_139_337_main_e WHERE 139337_e_inspection_id = ",	"139337",	"part139337_report_display_error.php");
										$functionpage	= "part139337_report_error.php";														
										_tp_control_error($discrepancyid, $settingsarray, $functionpage);	
										// That was fun, love modules.  No need to do that for the rest as it's not so simple here.
										// Need to figure out what the current status of this discrepancy is!
										// Status:
										//				0 - Work Order
										//				1 - Repaired
										//				2 - Bounced	
										//$status 				= part139327discrepancy_getstage($disid,0,0,0,0);
										// Lie to the blockform
										//$imclearlyahijacker		= 1;
										//$functionworkorderpage 	= 1;
										//$functionworkorderpage	= 'part139327_discrepancy_report_display_workorder.php';
										//$functionrepairpage		= 'part139327_discrepancy_report_repaired.php';
										//$functionbouncepage		= 'part139327_discrepancy_report_bounce.php';
										//$array_repairedcontrol	= array(0,0,'part139327_discrepancy_report_display_repaired.php');
										//$array_bouncedcontrol	= array(0,0,'part139327_discrepancy_report_display_bounced.php');
										// Utilize our lies
										//include("includes/_template/_tp_blockform_workorder.binc.php");	
										?>
									</tr>
								</table>
							</td>
						</tr>
						<?php
						// FORM HEADER
						// -----------------------------------------------------------------------------------------\\
								$formname			= "edittable";													// HTML Name for Form
								$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
								$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
									$formtarget		= "";															// HTML Name for the window
									$location		= $formtarget;													// Leave the same as $formtarget
						
						// FORM NAME and Sub Title
						//------------------------------------------------------------------------------------------\\
								$form_menu			= "Edit 337 Inspection";										// Name of the FORM, shown to the user
								$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
								$subtitle 			= "Use this form to edit the inspection";						// Subt title of the FORM, shown to the user

						// FORM SUMMARY information
						//------------------------------------------------------------------------------------------\\
								$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
									$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
									$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
									$detailtodisplay		= 0;													// See Summary Function for how to use this number
									$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
										
							include("includes/_template/_tp_blockform_form_header.binc.php");			
							?>
						
						<input type="hidden" name="formsubmit"	ID="formsubmit"	value="1">
						<input type="hidden" name="recordid"	ID="recordid" 	value="<?php echo $objarray['139337_id'];?>">
										<?php
										form_new_table_b($formname);
										form_new_control("wlhmdate"		,"Date"				, "Enter the date of this report"					,"The current date has automatically been provided!"															,"(mm/dd/yyyy)"				,1				,10				,0				,$objarray['139337_date']				,0);
										form_new_control("wlhmtime"		,"Time"				, "Enter the time of this report"					,"The current time has automatically been provided!"															,"(hh:mm:ss) - 24 hours"	,1				,10				,0				,$objarray['139337_time']				,0);
										form_new_control("wlhmauthor"	,"Entry By"			, "Who found and reported this discrepancy"			,"Your name has automatically been provided!"																	,"(cannot be changed)"		,3				,55				,0				,$objarray['139337_author_by_cb_int']	,"systemusercombobox");
										form_new_control("wlhmspecies"	,"Species"			, "Select the Species contained for this report"	,"Select from the list provided!"																				,""							,3				,55				,4				,$objarray['139337_species_cb_int']		,"part139337_combobox_animalspecies");
										form_new_control("wlhmactivity"	,"Activity"			, "Select the activity the species was doing"		,"Select from the list provided!"																				,""							,3				,55				,4				,$objarray['139337_activity_cb_int']	,"part139337_combobox_animalactivity");
										form_new_control("wlhmaction"	,"Action"			, "Select the action you took for this report"		,"Select from the list provided!"																				,""							,3				,55				,4				,$objarray['139337_action_cb_int']		,"part139337_combobox_actiontaken");
										form_new_control("wlhmnumber"	,"Number Acted On"	, "Enter the number acted on"						,"This number should only contain the amount acted on, not the total spoted.Do not use any special characters!"	,""							,1				,5				,0				,$objarray['139337_numberofspecies']	,0);
										form_new_control("wlhmresults"	,"Results of Action", "Enter the results of the action"					,"This description should explain what you did with animal and where it went.Do not use any special characters!",""							,2				,55				,4				,$objarray['139337_resultsofaction']	,0);
										form_new_control("wlhmweather"	,"Current Weather"	, "Enter a description of the weather"				,"Describe the weather at the time the action /report was taken.Do not use any special characters!"				,""							,2				,55				,4				,$objarray['139337_weather']			,0);
										form_new_control("Mouse"		,"Location"			, "Where was the action located"					,"Click the Map It button"																						,"(open in new window)"		,4				,0				,""				,$objarray['139337_location_x'].",".$objarray['139337_location_y'],"");
										form_new_control("wlhmreason"	,"Edit Reason"		, "Where is the reason for editing the record"		,"Provide a reason"																								,""							,2				,55				,4				,'I am editing this record because...'	,"");
	//
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 1;														// 1: Display Submit Button,	0: No
				$submitbuttonname	= 'Submit Changes';											// Name of the Submit Button
			$display_close			= 0;														// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
			$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");
									} 
							}
						?>

					</table>
				</td>
			</tr>
		</table>
		</form>
						<?php
					}
		}	
		else {

						// FORM HEADER
						// -----------------------------------------------------------------------------------------\\
								$formname			= "edittable";													// HTML Name for Form
								$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
								$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
									$formtarget		= "";															// HTML Name for the window
									$location		= $formtarget;													// Leave the same as $formtarget
						
						// FORM NAME and Sub Title
						//------------------------------------------------------------------------------------------\\
								$form_menu			= "Edit 337 Inspection";										// Name of the FORM, shown to the user
								$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
								$subtitle 			= "Summary of information you provided";						// Subt title of the FORM, shown to the user

						// FORM SUMMARY information
						//------------------------------------------------------------------------------------------\\
								$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
									$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
									$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
									$detailtodisplay		= 0;													// See Summary Function for how to use this number
									$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
										
							include("includes/_template/_tp_blockform_form_header.binc.php");			

		
			// Load Form Elements	
			// Place Default values from the POST Here or enter 'post'---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\
			//																																																																										|
			//		Put a '0' here if you do not want to display the form field and only the result-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------\									|
			//
			form_new_table_b($formname);
			form_new_control("wlhmdate"		,"Date"				, "Enter the date of this report"					,"The current date has automatically been provided!"															,"(mm/dd/yyyy)"				,1				,0				,0				,'post'									,0);
			form_new_control("wlhmtime"		,"Time"				, "Enter the time of this report"					,"The current time has automatically been provided!"															,"(hh:mm:ss) - 24 hours"	,1				,0				,0				,'post'									,0);
			form_new_control("wlhmauthor"	,"Entry By"			, "Who found and reported this discrepancy"			,"Your name has automatically been provided!"																	,"(cannot be changed)"		,3				,0				,0				,'post'									,"systemusercombobox");
			form_new_control("wlhmspecies"	,"Species"			, "Select the Species contained for this report"	,"Select from the list provided!"																				,""							,3				,0				,4				,'post'									,"part139337_combobox_animalspecies");
			form_new_control("wlhmactivity"	,"Activity"			, "Select the activity the species was doing"		,"Select from the list provided!"																				,""							,3				,0				,4				,'post'									,"part139337_combobox_animalactivity");
			form_new_control("wlhmaction"	,"Action"			, "Select the action you took for this report"		,"Select from the list provided!"																				,""							,3				,0				,4				,'post'									,"part139337_combobox_actiontaken");
			form_new_control("wlhmnumber"	,"Number Acted On"	, "Enter the number acted on"						,"This number should only contain the amount acted on, not the total spoted.Do not use any special characters!"	,""							,1				,0				,0				,'post'									,0);
			form_new_control("wlhmresults"	,"Results of Action", "Enter the results of the action"					,"This description should explain what you did with animal and where it went.Do not use any special characters!",""							,2				,0				,4				,'post'									,0);
			form_new_control("wlhmweather"	,"Current Weather"	, "Enter a description of the weather"				,"Describe the weather at the time the action /report was taken.Do not use any special characters!"				,""							,2				,0				,4				,'post'									,0);
			form_new_control("Mouse"		,"Location"			, "Where was the action located"					,"Click the Map It button"																						,"(open in new window)"		,4				,0				,""				,'post'									,"");
			form_new_control("wlhmreason"	,"Edit Reason"		, "Where is the reason for editing the record"		,"Provide a reason"																								,""							,2				,0				,4				,'post'									,"");
	
									$formname = 'edittable';
							//
							// FORM FOOTER
							//------------------------------------------------------------------------------------------\\
									$display_submit 		= 0;														// 1: Display Submit Button,	0: No
										$submitbuttonname	= 'Start Edit of 327 Record';								// Name of the Submit Button
									$display_close			= 0;														// 1: Display Close Button, 	0: No
									$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
									$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
									$display_quickaccess	= 0;
									$display_printout		= 1;
										$printout_page		= 'part139337_report_display.php';
										$printout_id		= $_POST['recordid'];
										$printout_passed	= 'recordid';
									
								include("includes/_template/_tp_blockform_form_footer.binc.php");

		// NOW UPDATE THE RECORDS
		
		//$sqldate		= AmerDate2SqlDateTime($_POST['wlhmdate']);
		$sqldate		= ($_POST['wlhmdate']);
		
		$sql = "UPDATE tbl_139_337_main SET 139337_date='".$_POST['wlhmdate']."', 139337_time='".$_POST['wlhmtime']."', 139337_author_by_cb_int='".$_POST['wlhmauthor']."', ";
		$sql = $sql."139337_species_cb_int='".$_POST['wlhmspecies']."', 139337_activity_cb_int='".$_POST['wlhmactivity']."', 139337_action_cb_int='".$_POST['wlhmaction']."', ";
		$sql = $sql."139337_numberofspecies='".$_POST['wlhmnumber']."', 139337_resultsofaction='".$_POST['wlhmresults']."', 139337_weather='".$_POST['wlhmweather']."', ";
		$sql = $sql."139337_location_x='".$_POST['MouseX']."', 139337_location_y='".$_POST['MouseY']."' WHERE 139337_id = '".$_POST['recordid']."' ";
		
		//echo $sql;
		
		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid = mysqli_insert_id($mysqli);
						}

		// NOW INSERT A RECORD into the Error Table
		
		$sql = "INSERT INTO tbl_139_337_main_e (139337_e_inspection_id, 139337_e_by_cb_int, 139337_e_reason, 139337_e_date, 139337_e_time, 139337_e_yn)
		VALUES ( '".$_POST['recordid']."', '".$_POST['wlhmauthor']."', '".$_POST['wlhmreason']."', '".$_POST['wlhmdate']."', '".$_POST['wlhmtime']."', '1' )";
		
		//echo $sql;
		
		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid = mysqli_insert_id($mysqli);
						}							
						
		}
	}
	
// Define Variables...
//						for Auto Entry Function {End of Page}

		//$last_main_id	= $lastid;
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>