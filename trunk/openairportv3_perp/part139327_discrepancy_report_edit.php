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
//	Name of Document		:	part139327_discrepancy_report_edit.php
//
//	Purpose of Page			:	Edit Existing Part139.327 Discrepancies
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

		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// Define Variables	
		
		$tblname		= "Additional Options";
		$tblsubname		= "These additional options are avilable while editing this discrepancy";

// Collect POST Information

		$discrepancyid 	= $_POST['recordid'];
		$disid 			= $_POST['recordid'];

// Define Variables	
		
		$navigation_page 			= 16;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 1;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures	

		
// Start the Page; Check to see if $_POST['recordid'] has been set, ie. used

if (!isset($_POST['recordid'])) {
		// No Record ID Supplied, Crash Out
	}
	else {
		if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		// There is a Record ID Supplied, Do work
		
		// Connect to Database
		$sql 		= "SELECT * FROM tbl_139_327_sub_d WHERE Discrepancy_id = '".$_POST['recordid']."' ";
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
			<td colspan="3" class="item_name_inactive">
				<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
					<tr>
						<?php
						// Hijack Template Functions for our own purposes
						$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_archived.php");
						$functionpage	= "part139327_discrepancy_report_archieved.php";														
						_tp_control_archived($objarray['Discrepancy_id'], $settingsarray, $functionpage);
						$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_duplicate.php");
						$functionpage	= "part139327_discrepancy_report_duplicate.php";														
						_tp_control_duplicate($objarray['Discrepancy_id'], $settingsarray, $functionpage);
						$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_e WHERE discrepancy_error_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_error.php");
						$functionpage	= "part139327_discrepancy_report_error.php";														
						_tp_control_error($objarray['Discrepancy_id'], $settingsarray, $functionpage);	
						// We might normally want to display the Closed function, but Closed has a special meaning for 327 discrepancies. 
						//	We only want it displayed if the discrepancy has really earned closed status..
						//
						//$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_c WHERE discrepancy_closed_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_closed.php");
						//$functionpage	= "part139327_discrepancy_report_closed.php";														
						//_tp_control_closed($objarray['Discrepancy_id'], $settingsarray, $functionpage);															
						
						// That was fun, love modules.  No need to do that for the rest as it's not so simple here.
						// Need to figure out what the current status of this discrepancy is!
						// Status:
						//				0 - Work Order
						//				1 - Repaired
						//				2 - Bounced	
						$status 				= part139327discrepancy_getstage($disid,0,0,0,0);
						// Lie to the blockform
						$imclearlyahijacker		= 1;
						$functionworkorderpage 	= 1;
						$functionworkorderpage	= 'part139327_discrepancy_report_display_workorder.php';
						$functionrepairpage		= 'part139327_discrepancy_report_repair.php';
						$functionbouncepage		= 'part139327_discrepancy_report_bounce.php';
						$functionclosedpage		= 'part139327_discrepancy_report_closed.php';
						$array_repairedcontrol	= array(0,0,'part139327_discrepancy_report_display_repaired.php');
						$array_bouncedcontrol	= array(0,0,'part139327_discrepancy_report_display_bounced.php');
						$array_closedcontrol	= array(0,0,'part139327_discrepancy_report_display_closed.php');
						$has_been_bounced 		= preflights_tbl_139_327_main_sub_d_b_yn($disid,1);
						$has_been_closed 		= preflights_tbl_139_327_main_sub_d_c_yn($disid,1);
						$has_been_repaired 		= preflights_tbl_139_327_main_sub_d_r_yn($disid,1);
						
						//echo "Been Bounced 	: ".$has_been_bounced." 	<br>";
						//echo "Been Closed 	: ".$has_been_closed." 		<br>";
						//echo "Been Repaired 	: ".$has_been_repaired." 	<br>";
						// Utilize our lies
						include("includes/_template/_tp_blockform_workorder_browser.binc.php");	
						?>
						</tr>
					</table>
				</td>
			</tr>
		<tr>
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
								$form_menu			= "Edit Discrepancy";											// Name of the FORM, shown to the user
								$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
								$subtitle 			= "Use this form to edit a discrepancy";							// Subt title of the FORM, shown to the user

						// FORM SUMMARY information
						//------------------------------------------------------------------------------------------\\
								$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
									$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
									$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
									$detailtodisplay		= 0;													// See Summary Function for how to use this number
									$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
										
							include("includes/_template/_tp_blockform_form_header.binc.php");			
							?>
			<input type="hidden" name="recordid"	ID="recordid" 	value="<?php echo $objarray['Discrepancy_id'];?>">
							<?php
							form_new_table_b($formname);
							form_new_control("disdate"			,"Date"				, "Enter the date this discrepancy was found"															,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"				,1		,7		,0		,$objarray['Discrepancy_date']		,0);
							form_new_control("distime"			,"Time"				, "Enter the time this discrepancy was found"															,"The current time has automatically been provided!"	,"(hh:mm:ss) - 24 hours"	,1		,7		,0		,$objarray['Discrepancy_time']		,0);
							form_new_control("disauthor"		,"Entry By"			, "Who found and reported this discrepancy"																,"Your name has automatically been provided!"			,"(cannot be changed)"		,3		,40		,0		,$objarray['Discrepancy_by_cb_int']	,"systemusercombobox");
							form_new_control("disname"			,"Discrepancy Name"	, "Enter a short and concise name for this discrepancy"													,"Do not use any special characters!"					,""							,1		,38		,0		,$objarray['Discrepancy_name']		,0);
							form_new_control("discomments"		,"Comments"			, "Enter additional information for maintenance"														,"Do not use any special characters!"					,""							,2		,30		,4		,$objarray['discrepancy_remarks']	,0);
							form_new_control("dispri"			,"Priority"			, "What is the priority of this discrepancy"															,""														,"(1-NOW, 5-When possible!)",3		,10		,0		,$objarray['discrepancy_priority']	,"gs_conditions");
							form_new_control("Mouse"			,"Location"			, "Where is this discrepancy located"																	,"Click the Map It button"								,"(open in new window)"		,4		,4		,''		,$objarray['Discrepancy_location_x'].','.$objarray['Discrepancy_location_y']			,'');
							
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
			</tr>
		</table>
					<?php
					}
				} else {
		
		//$sqldate		= AmerDate2SqlDateTime($_POST['disdate']);
		$sqldate		= ($_POST['disdate']);
		//echo 'POST DATE: ['.$_POST['disdate'].']';
		
		
		// Make Changes to the Discrepancy Record

		$sql = "UPDATE tbl_139_327_sub_d SET Discrepancy_by_cb_int='".$_POST['disauthor']."', Discrepancy_name='".$_POST['disname']."', discrepancy_remarks='".$_POST['discomments']."', Discrepancy_date='".$sqldate."', Discrepancy_time='".$_POST['distime']."', Discrepancy_location_x='".$_POST['MouseX']."', Discrepancy_location_y='".$_POST['MouseY']."', discrepancy_priority='".$_POST['dispri']."' WHERE Discrepancy_id = ".$_POST['recordid']." ";
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

		// Be slick and Place a record into the ERROR table of this discrepancy!
		
		$sql = "INSERT INTO tbl_139_327_sub_d_e (discrepancy_error_inspection_id, discrepancy_error_by_cb_int, discrepancy_error_reason, discrepancy_error_date, discrepancy_error_time, discrepancy_error_yn)
		VALUES ( '".$_POST['recordid']."', '".$_POST['disauthor']."', '".$_POST['diseditwhy']."', '".$sqldate."', '".$_POST['distime']."', '1' )";
		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs 			= mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$last_main_id 	= mysqli_insert_id($mysqli);
						}							
	
			// FORM HEADER
			// -----------------------------------------------------------------------------------------\\
					$formname			= "edittable";													// HTML Name for Form
					$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
					$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
						$formtarget		= "";															// HTML Name for the window
						$location		= $formtarget;													// Leave the same as $formtarget
			
			// FORM NAME and Sub Title
			//------------------------------------------------------------------------------------------\\
					$form_menu			= "Discrepancy Edit Completed";									// Name of the FORM, shown to the user
					$form_subh			= "The discrepancy has been successfully edited";				// Sub Name of the FORM, shown to the user
					$subtitle 			= $warning;														// Subt title of the FORM, shown to the user

			// FORM SUMMARY information
			//------------------------------------------------------------------------------------------\\
					$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
						$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
						$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
						$detailtodisplay		= 0;													// See Summary Function for how to use this number
						$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
							
				include("includes/_template/_tp_blockform_form_header.binc.php");		
			
			form_new_table_b($formname);
			form_new_control("disdate"			,"Date"				, "Enter the date this discrepancy was found"															,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"				,1		,0		,0		,'post'					,0);
			form_new_control("distime"			,"Time"				, "Enter the time this discrepancy was found"															,"The current time has automatically been provided!"	,"(hh:mm:ss) - 24 hours"	,1		,0		,0		,'post'					,0);
			form_new_control("disauthor"		,"Entry By"			, "Who found and reported this discrepancy"																,"Your name has automatically been provided!"			,"(cannot be changed)"		,3		,0		,0		,$_SESSION['user_id']	,"systemusercombobox");
			form_new_control("disname"			,"Discrepancy Name"	, "Enter a short and concise name for this discrepancy"													,"Do not use any special characters!"					,""							,1		,0		,0		,'post'					,0);
			form_new_control("discomments"		,"Comments"			, "Enter additional information for maintenance"														,"Do not use any special characters!"					,""							,2		,0		,4		,'post'					,0);
			form_new_control("dispri"			,"Priority"			, "What is the priority of this discrepancy"															,""														,"(1-NOW, 5-When possible!)",3		,0		,0		,'post'					,"gs_conditions");
			form_new_control("Mouse"			,"Location"			, "Where is this discrepancy located"																	,"Click the Map It button"								,"(open in new window)"		,4		,0		,''		,'post'					,'');
			
			//
			// FORM FOOTER
			//------------------------------------------------------------------------------------------\\
					$display_submit 		= 0;														// 1: Display Submit Button,	0: No
						$submitbuttonname	= '';														// Name of the Submit Button
					$display_close			= 0;														// 1: Display Close Button, 	0: No
					$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
						$pushdown_script	= '';
						$pushdown_frmname	= '';
						$pushdown_otherid	= '';
					$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
					
				include("includes/_template/_tp_blockform_form_footer.binc.php");				

		}
	}

// Establish Page Variables

		$auto_array					= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>