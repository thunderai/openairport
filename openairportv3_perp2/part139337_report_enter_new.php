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
//	Name of Document		:	part139327_enter_new_report.php
//
//	Purpose of Page			:	Enter New Part139.327 Inspection
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

		include("includes/_modules/part139337/part139337.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 21;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 16;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions	

if (!isset($_POST["formsubmit"])) {
		// This FORM has not been submitted before

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
			$form_menu			= getnameofmenuitemid_return_nohtml($strmenuitemid		, "long"	, 4			, "#FFFFFF"	,$_SESSION['user_id']);							// Name of the FORM, shown to the user
			$form_subh			= getpurposeofmenuitemid_return_nohtml($strmenuitemid	, 1			, "#FFFFFF"	,$_SESSION['user_id']);									// Sub Name of the FORM, shown to the user
			$subtitle 			= "Enter New Wildlife Hazard Management Report";				// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= '';													// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= '';													// See Summary Function for how to use this number
				$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
					
		include("includes/_template/_tp_blockform_form_header.binc.php");
		
	// FORM ELEMENTS
	//-----------------------------------------------------------------------------------------\\	
	// Load Form Elements
	//				POST Name		,Form Text			,Description of Field								,More Information about the Field																				,Syntax Information			,Type			,Field Width	,Field Height	,Default Value			,Function Name
	//																																																													1	Text Box	,in pixels		,in pixels		,						,
	//																																																													2	Text Area	,				,				,						,
	//																																																													3	Combobox	,
	//																																																													4	Map Button	,
	//																																																													5	Check box	,									
	form_new_table_b($formname);
	form_new_control("wlhmdate"		,"Date"				, "Enter the date of this report"					,"The current date has automatically been provided!"															,"(mm/dd/yyyy)"				,1				,10				,0				,"current"				,0);
	form_new_control("wlhmtime"		,"Time"				, "Enter the time of this report"					,"The current time has automatically been provided!"															,"(hh:mm:ss) - 24 hours"	,1				,10				,0				,"current"				,0);
	form_new_control("wlhmauthor"	,"Entry By"			, "Who found and reported this discrepancy"			,"Your name has automatically been provided!"																	,"(cannot be changed)"		,3				,50				,0				,$_SESSION['user_id']	,"systemusercombobox");
	form_new_control("wlhmspecies"	,"Species"			, "Select the Species contained for this report"	,"Select from the list provided!"																				,""							,3				,50				,4				,"all"					,"part139337_combobox_animalspecies");
	form_new_control("wlhmactivity"	,"Activity"			, "Select the activity the species was doing"		,"Select from the list provided!"																				,""							,3				,50				,4				,"all"					,"part139337_combobox_animalactivity");
	form_new_control("wlhmaction"	,"Action"			, "Select the action you took for this report"		,"Select from the list provided!"																				,""							,3				,50				,4				,"all"					,"part139337_combobox_actiontaken");
	form_new_control("wlhmnumber"	,"Number Acted On"	, "Enter the number acted on"						,"This number should only contain the amount acted on, not the total spoted.Do not use any special characters!"	,""							,1				,5				,0				,""						,0);
	form_new_control("wlhmresults"	,"Results of Action", "Enter the results of the action"					,"This description should explain what you did with animal and where it went.Do not use any special characters!",""							,2				,30				,4				,""						,0);
	form_new_control("wlhmweather"	,"Current Weather"	, "Enter a description of the weather"				,"Describe the weather at the time the action /report was taken.Do not use any special characters!"				,""							,2				,30				,4				,""						,0);
	form_new_control("Mouse"		,"Location"			, "Where was the action located"					,"Click the Map It button"																						,"(open in new window)"		,4				,4				,""				,""						,"");
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 1;															// 1: Display Submit Button,	0: No
				$submitbuttonname	= 'Save Record';												// Name of the Submit Button
			$display_close			= 0;															// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;															// 1: Display Push Down Button, 0: No
			$display_refresh		= 0;															// 1: Display Refresh Button, 	0: No
			$display_quickaccess	= 1;
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");
	}
	else {
	
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
			$form_menu			= 'Summary Report of your WLHM Report';							// Name of the FORM, shown to the user
			$form_subh			= 'Here is the information you provided';						// Sub Name of the FORM, shown to the user
			$subtitle 			= "Wildlife Hazard Management Report - Summary";				// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= '';													// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= '';													// See Summary Function for how to use this number
				$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
					
		include("includes/_template/_tp_blockform_form_header.binc.php");
		
	// FORM ELEMENTS
	//-----------------------------------------------------------------------------------------\\		
	// Place Default values from the POST Here or enter 'post'---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\
	//																																																																										|
	//		Put a '0' here if you do not want to display the form field and only the result-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------\									|
	//																																																																	 v									v
	form_new_table_b($formname);
	form_new_control("wlhmdate"		,"Date"				, "Enter the date of this report"					,"The current date has automatically been provided!"															,"(mm/dd/yyyy)"				,1				,0				,0				,'post'					,0);
	form_new_control("wlhmtime"		,"Time"				, "Enter the time of this report"					,"The current time has automatically been provided!"															,"(hh:mm:ss) - 24 hours"	,1				,0				,0				,'post'					,0);
	form_new_control("wlhmauthor"	,"Entry By"			, "Who found and reported this discrepancy"			,"Your name has automatically been provided!"																	,"(cannot be changed)"		,3				,0				,0				,'post'					,"systemusercombobox");
	form_new_control("wlhmspecies"	,"Species"			, "Select the Species contained for this report"	,"Select from the list provided!"																				,""							,3				,0				,4				,'post'					,"part139337_combobox_animalspecies");
	form_new_control("wlhmactivity"	,"Activity"			, "Select the activity the species was doing"		,"Select from the list provided!"																				,""							,3				,0				,4				,'post'					,"part139337_combobox_animalactivity");
	form_new_control("wlhmaction"	,"Action"			, "Select the action you took for this report"		,"Select from the list provided!"																				,""							,3				,0				,4				,'post'					,"part139337_combobox_actiontaken");
	form_new_control("wlhmnumber"	,"Number Acted On"	, "Enter the number acted on"						,"This number should only contain the amount acted on, not the total spoted.Do not use any special characters!"	,""							,1				,0				,0				,'post'					,0);
	form_new_control("wlhmresults"	,"Results of Action", "Enter the results of the action"					,"This description should explain what you did with animal and where it went.Do not use any special characters!",""							,2				,0				,4				,'post'					,0);
	form_new_control("wlhmweather"	,"Current Weather"	, "Enter a description of the weather"				,"Describe the weather at the time the action /report was taken.Do not use any special characters!"				,""							,2				,0				,4				,'post'					,0);
	form_new_control("Mouse"		,"Location"			, "Where was the action located"					,"Click the Map It button"																						,"(open in new window)"		,4				,0				,""				,'post'					,"");
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 0;														// 1: Display Submit Button,	0: No
				$submitbuttonname	= '';														// Name of the Submit Button
			$display_close			= 0;														// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
			$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");					

			
		// Load METAR
			$currentweather = readweathertxt();
	
		//$sqldate	= AmerDate2SqlDateTime($_POST['wlhmdate']);
		$sql 		= "INSERT INTO tbl_139_337_main (139337_date, 139337_time,139337_author_by_cb_int,139337_species_cb_int, 139337_activity_cb_int, 139337_action_cb_int, 139337_numberofspecies, 139337_resultsofaction, 139337_weather,139337_location_x,139337_location_y,139337_metar) VALUES ( '".$_POST['wlhmdate']."','".$_POST['wlhmtime']."','".$_POST['wlhmauthor']."','".$_POST['wlhmspecies']."','".$_POST['wlhmactivity']."','".$_POST['wlhmaction']."','".$_POST['wlhmnumber']."','".$_POST['wlhmresults']."','".$_POST['wlhmweather']."','".$_POST['MouseX']."','".$_POST['MouseY']."','".$currentweather."')";
		//echo "SQL ".$sql;
		
		//mysql_insert_id();
		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
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

// Define Variables...
//						for Auto Entry Function {End of Page}

		if (!isset($last_main_id)) {
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