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
//	Name of Document		:	part139327_discrepancy_report_new.php
//
//	Purpose of Page			:	Enter new Part 139.327 Discrepancy
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page

// Load Page Specific Includes

		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		//include("includes/_generalsettings/generalsettings.list.php");
		
		
// Define Variables	
		
		$tblname		= "Add New Associated Discrepancy";
		$tblsubname		= "please complete the form";
		$tmp_recordid	= 0;
		
		
//LOAD POSTS, and if no POSTS defined load GETS

if (!isset($_POST["recordid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_recordid			= $_GET['recordid'];
		$from_get				= 1;
	}
	else {
		$tmp_recordid			= $_POST['recordid'];
		$from_get				= 0;
	}
	
if (!isset($_POST["golive"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_golive				= $_GET['golive'];
	}
	else {
		$tmp_golive				= $_POST['golive'];
	}
	
if (!isset($_POST["checklistid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_checklistid		= $_GET['checklist'];
	}
	else {
		$tmp_checklistid		= $_POST['checklistid'];
	}	

if (!isset($_POST["facilityid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_facilityid			= $_GET['facility'];
	}
	else {
		$tmp_facilityid			= $_POST['facilityid'];
	}
	
if (!isset($_POST["conditionid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_conditionid		= $_GET['condition'];
	}
	else {
		$tmp_conditionid		= $_POST['conditionid'];
	}
	
if (!isset($_POST["conditionname"])) {
		// No Record ID defined in POST, use GET record id
		if (!isset($_GET["conditionname"])) {
				// Get not set either...
				$tmp_conditionname = '';
			} else {		
				$tmp_conditionname		= $_GET['conditionname'];
			}
	}
	else {
		$tmp_conditionname		= $_POST['conditionname'];
	}	
	
if (!isset($_POST["inspectiontypeid"])) {
		// No Record ID defined in POST, use GET record id
		if (!isset($_GET["inspectiontypeid"])) {
				// Get not set either...
				$tmp_inspectiontypeid 		= '';
			} else {		
				$tmp_inspectiontypeid		= $_GET['inspectiontypeid'];
			}
	}
	else {
		$tmp_inspectiontypeid	= $_POST['inspectiontypeid'];
	}	

if (!isset($_POST["madbynavaid"])) {
		// No Record ID defined in POST, use GET record id
		if (!isset($_GET["madbynavaid"])) {
				// Get not set either...
				$tmp_madbynavaid 		= 0;
			} else {		
				$tmp_madbynavaid		= $_GET['madbynavaid'];
			}
	}
	else {
		$tmp_madbynavaid	= $_POST['madbynavaid'];
	}	
	
if (!isset($_GET["discrepancyname"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_discrepancyname = '';
	}
	else {
		$tmp_discrepancyname = $_GET["discrepancyname"];
	}	

if (!isset($_GET["discrepancycomm"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_discrepancycomm = '';
	}
	else {
		$tmp_discrepancycomm = $_GET["discrepancycomm"];
	}	

if (!isset($_GET["location"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_locationx 	= 0;
		$tmp_locationy 	= 0;
		$location_s		= '';
	}
	else {
		$location_s		= $_GET["location"];
		//$alocation_s	= explode('x',$location_s);
		//$tmp_locationx 	= $alocation_s[0];
		//$tmp_locationy 	= $alocation_s[1];	
	}

if (!isset($_POST["targetname"])) {
		//echo 'No Record ID defined in POST, use GET record id <br>';
		$tmp_targetname		= $_GET['targetname'];
		$tmp_targetname		= $tmp_targetname.'_win';
		//echo 'GET VALUE IS ['.$tmp_targetname.'] <br>';
	}
	else {
		//echo 'No GET ID defined in POST, use POST record id <br>';
		$tmp_targetname		= $_POST['targetname'];
		$tmp_targetname		= $tmp_targetname.'_win';
		//echo 'POST VALUE IS ['.$tmp_targetname.'] <br>';
	}	

if (!isset($_POST["dhtmlname"])) {
		//echo 'No Record ID defined in POST, use GET record id <br>';
		// No Record ID defined in POST, use GET record id
		$tmp_dhtmlname		= $_GET['dhtmlname'];
		$tmp_dhtmlname		= $tmp_dhtmlname;
		$tmp_dhtmlname		= $tmp_dhtmlname;
		$dhtml_name			= $tmp_dhtmlname;
		//echo 'GET VALUE IS ['.$tmp_dhtmlname.'] <br>';
	}
	else {
		//echo 'No GET ID defined in POST, use POST record id <br>';
		$tmp_dhtmlname		= $_POST['dhtmlname'];
		$tmp_dhtmlname		= $tmp_dhtmlname;
		$tmp_dhtmlname		= $tmp_dhtmlname;
		$dhtml_name			= $tmp_dhtmlname;		
		//echo 'POST VALUE IS ['.$tmp_dhtmlname.'] <br>';
	}		

// Define Variables	
		
		$navigation_page 			= 16;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 16;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures		
	
if (!isset($_POST["formsubmit"])) {

		// FORM CONTAINER
		// -----------------------------------------------------------------------------------------\\
				form_new_table_container('open');

		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		
		// FORM HEADER
		// -----------------------------------------------------------------------------------------\\
				$formname			= "edittable";													// HTML Name for Form
				$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
				$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
					$formtarget		= "";															// HTML Name for the window
					$location		= $formtarget;													// Leave the same as $formtarget
		
		// FORM NAME and Sub Title
		//------------------------------------------------------------------------------------------\\
				$form_menu			= "Associate Discrepancy";										// Name of the FORM, shown to the user
				$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
				$subtitle 			= "Use this form to Associate a discrepancy to the NOTAM";		// Subt title of the FORM, shown to the user

		// FORM SUMMARY information
		//------------------------------------------------------------------------------------------\\
				$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
					$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
					$idtosearch				= $tmp_recordid;									// ID to look for in the summary function, this is typically $_POST['recordid'].
					$detailtodisplay		= 0;													// See Summary Function for how to use this number
					$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
						
			include("includes/_template/_tp_blockform_form_header_inline.binc.php");			
		
			?>
			<input type="hidden" name="formsubmit" 		value="1" />
			<input type="hidden" name="from_get" 		value="<?php echo $from_get;?>">
			<input type="hidden" name="recordid" 		value="<?php echo $tmp_recordid;?>">
			<input type="hidden" name="golive" 			value="<?php echo $tmp_golive;?>">
			<input type="hidden" name="madbynavaid" 	value="<?php echo $tmp_madbynavaid;?>">
			<input type="hidden" name="conditionid" 	value="<?php echo $tmp_conditionid;?>">
			<input type="hidden" name="facilityid" 		value="<?php echo $tmp_facilityid;?>">
			<input type="hidden" name="checklistid" 	value="<?php echo $tmp_checklistid;?>">
			<?php
			form_new_table_b_inline($formname);
			//form_new_control("disdate"			,"Date"				, "Enter the date this discrepancy was found"															,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"				,1		,7		,0		,"current"				,0);
			//form_new_control("distime"			,"Time"				, "Enter the time this discrepancy was found"															,"The current time has automatically been provided!"	,"(hh:mm:ss) - 24 hours"	,1		,7		,0		,"current"				,0);
			//form_new_control("disauthor"		,"Entry By"			, "Who found and reported this discrepancy"																,"Your name has automatically been provided!"			,"(cannot be changed)"		,3		,40		,0		,$_SESSION['user_id']	,"systemusercombobox");
			//form_new_control("disname"			,"Discrepancy Name"	, "Enter a short and concise name for this discrepancy"													,"Do not use any special characters!"					,""							,1		,38		,0		,$tmp_discrepancyname	,0);
			//form_new_control("discomments"		,"Comments"			, "Enter additional information for maintenance"														,"Do not use any special characters!"					,""							,2		,30		,4		,$tmp_discrepancycomm	,0);
			form_new_control("dispri"			,"Associate Discrepancy"			, "Select Discrepancy to Associate with this NOTAM"															,""														,"(Select Discrepancy)",3		,10		,0		,"all"					,"discrepancycombobox_dlink");
			//form_new_control("Mouse"			,"Location"			, "Where is this discrepancy located"																	,"Click the Map It button"								,"(open in new window)"		,4		,4		,''		,$location_s			,'');
			//form_new_control("diskillorder"		,"Kill Order"		, "If discrepancy was repaired prior to reporting, issue the Kill Order and describe work completed."	,"Do not use any special characters!"					,""							,2		,30		,4		,''						,0);
			form_new_table_e($formname);
			
			// FORM UNIVERSAL CONTROL LOADING
			//------------------------------------------------------------------------------------------\\
			
			//$targetname		= $_GET['targetname'];			// From the Button Loader; Name of the window this form was loaded into.
			//$dhtml_name		= $_GET['dhtmlname'];			// From the Button Loader; Name of the DHTML window function to call to change this window.
			form_uni_control("targetname"		,$tmp_targetname);
			form_uni_control("dhtmlname"		,$tmp_dhtmlname);
													
			//
			// FORM FOOTER
			//------------------------------------------------------------------------------------------\\
					$display_submit 		= 1;														// 1: Display Submit Button,	0: No
						$submitbuttonname	= 'Submit';														// Name of the Submit Button
					$display_close			= 1;														// 1: Display Close Button, 	0: No
					$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
					$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
					$display_quickaccess	= 0;
					
				include("includes/_template/_tp_blockform_form_footer_inline.binc.php");
				
				form_new_table_container('close');
	} else {
		
		// there is something in the post querystring, so this must not be the first time this form is being shown
		
		// Step 1). Load into an array all of the values from the form

		//$sqldate		= AmerDate2SqlDateTime($_POST['disdate']);
		//$sqldate		=($_POST['disdate']);

		if($_POST['golive'] == 1) {
				//echo "Dicrepancy will be pushed to the live table <br>";
				$tablename_d	= "tbl_139_339_sub_n_dlink";
				$warning		= "The Discrepancy has been pushed live!";
			}
			else {
				//echo "Dicrepancy will be pushed to the temporary table <br>";
				$tablename_d	= "tbl_139_339_sub_n_dlink_tmp";
				$warning		= "The following discrepancy has been temporarly added to the system and still needs to be linked to the inspection";				
			}
		
		// Start to build the Insert SQL Statement
		$sql = "INSERT INTO ".$tablename_d." (139_339_n_dlink_notam_id, 139_339_n_dlink_discrepancy_id) 
		VALUES ( '".$facilityid."', '".$_POST['dispri']."')";

		//echo "<font size='3' color='#FFFFFF'> The INSERT SQL Statement is : <i>".$sql."</i></font><br><br>";

		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		//mysql_insert_id();
				
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			//mysql_insert_id();
				$objrs 		= mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
				$lastid 	= mysqli_insert_id($mysqli);
				$last_d		= $lastid;
				$lastid1 	= mysqli_insert_id($mysqli);
				}
				
		//
		// END OF PAGE EVENT FOR SAVING DISCREPANCY...
		//
			
			// FORM HEADER
			// -----------------------------------------------------------------------------------------\\
					$formname			= "edittable";													// HTML Name for Form
					$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
					$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
						$formtarget		= "";															// HTML Name for the window
						$location		= $formtarget;													// Leave the same as $formtarget
			
			// FORM NAME and Sub Title
			//------------------------------------------------------------------------------------------\\
					$form_menu			= "Added Subject Note";											// Name of the FORM, shown to the user
					$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
					$subtitle 			= $warning;														// Subt title of the FORM, shown to the user

			// FORM SUMMARY information
			//------------------------------------------------------------------------------------------\\
					$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
						$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
						$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
						$detailtodisplay		= 0;													// See Summary Function for how to use this number
						$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
							
				include("includes/_template/_tp_blockform_form_header.binc.php");		
			
			form_new_table_b_inline($formname);
			//form_new_control("disdate"			,"Date"				, "Enter the date this discrepancy was found"															,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"				,1		,0		,0		,'post'					,0);
			//form_new_control("distime"			,"Time"				, "Enter the time this discrepancy was found"															,"The current time has automatically been provided!"	,"(hh:mm:ss) - 24 hours"	,1		,0		,0		,'post'					,0);
			//form_new_control("disauthor"		,"Entry By"			, "Who found and reported this discrepancy"																,"Your name has automatically been provided!"			,"(cannot be changed)"		,3		,0		,0		,$_SESSION['user_id']	,"systemusercombobox");
			//form_new_control("disname"			,"Discrepancy Name"	, "Enter a short and concise name for this discrepancy"													,"Do not use any special characters!"					,""							,1		,0		,0		,'post'					,0);
			//form_new_control("discomments"		,"Comments"			, "Enter additional information for maintenance"														,"Do not use any special characters!"					,""							,2		,0		,4		,'post'					,0);
			form_new_control("dispri"			,"Associated Discrepancy"			, "What is the Associated Discrepancy"															,""														,"",3		,0		,0		,'post'					,"discrepancycombobox_dlink");
			//form_new_control("Mouse"			,"Location"			, "Where is this discrepancy located"																	,"Click the Map It button"								,"(open in new window)"		,4		,0		,''		,'post'					,'');
			//form_new_control("diskillorder"		,"Kill Order"		, "If discrepancy was repaired prior to reporting, issue the Kill Order and describe work completed."	,"Do not use any special characters!"					,""							,2		,0		,4		,'post'					,0);
			form_new_table_e($formname); 
		
			// FORM UNIVERSAL CONTROL LOADING
			//------------------------------------------------------------------------------------------\\
			
			$targetname		= $_POST['targetname'];			// From the Button Loader; Name of the window this form was loaded into.
			$dhtml_name		= $_POST['dhtmlname'];			// From the Button Loader; Name of the DHTML window function to call to change this window.
			form_uni_control("targetname"		,$targetname);
			form_uni_control("dhtmlname"		,$dhtml_name);
			
				
			//
			// FORM FOOTER
			//------------------------------------------------------------------------------------------\\
					$display_submit 		= 0;														// 1: Display Submit Button,	0: No
						$submitbuttonname	= '';														// Name of the Submit Button
					$display_close			= 1;														// 1: Display Close Button, 	0: No
					$display_pushdown		= 1;														// 1: Display Push Down Button, 0: No
						$pushdown_script	= 'call_server_pnd_339_b_dlink';
						$pushdown_frmname	= "addeddis";
						$pushdown_otherid	= $facilityid;
					$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
					$display_quickaccess	= 0;
					
				include("includes/_template/_tp_blockform_form_footer.binc.php");													

		}

// Establish Page Variables

		if (!isset($lastid)) {
				// Not defined, set to zero
				$last_main_id = 0;
			} else {
				$last_main_id = $lastid;
			}		
		if (!isset($_POST["formsubmit"])) {
				// Not defined, set to zero
				$submit = 0;
			} else {
				$submit = $_POST["formsubmit"];
			}

		$auto_array		= array($navigation_page, $_SESSION["user_id"], $submit, $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 
		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>