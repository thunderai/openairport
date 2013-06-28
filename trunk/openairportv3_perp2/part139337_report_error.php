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
//	Name of Document		:	part139327_discrepancy_report_archieved.php
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

		include("includes/_modules/part139337/part139337.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// Define Variables	
		
		$tblname		= "Mark Report with an Error";
		$tblsubname		= "please complete the form";

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 21;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 5;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions	

if (!isset($_POST["formsubmit"])) {

	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "edittable";													// HTML Name for Form
			$formaction			= '';															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= '';															// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget
	
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= "Wildlife Hazard Report - Mark with an Error";				// Name of the FORM, shown to the user
			$form_subh			= "please complete the form";									// Sub Name of the FORM, shown to the user
			$subtitle 			= "Here is the information about the selected Error Report";	// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 1;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= '_337_display_summary';								// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= 0;													// See Summary Function for how to use this number
				$returnHTML				= 0;													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
					
		include("includes/_template/_tp_blockform_form_header.binc.php");	
		
		// Load Form Elements
		//				POST Name		,Form Text			,Description of Field											,More Information about the Field																				,Syntax Information			,Type			,Field Width	,Field Height	,Default Value			,Function Name
		//																																																																1	Text Box	,in pixels		,in pixels		,						,
		//																																																																2	Text Area	,				,				,						,
		//																																																																3	Combobox	,
		//																																																																4	Map Button	,
		//																																																																5	Check box	,									
		form_new_table_b($formname);
		form_new_control("disdate"		,"Date"				, "Enter the date this WLHM Reord was archieved"				,"The current date has automatically been provided!"															,"(mm/dd/yyyy)"				,1				,10				,0				,"current"				,0);
		form_new_control("distime"		,"Time"				, "Enter the time this WLHM Reord was archieved"				,"The current time has automatically been provided!"															,"(hh:mm:ss) - 24 hours"	,1				,10				,0				,"current"				,0);
		form_new_control("disauthor"	,"Entry By"			, "Who found and reported this discrepancy"						,"Your name has automatically been provided!"																	,"(cannot be changed)"		,2				,35				,0				,$_SESSION['user_id']	,"systemusercombobox");
		form_new_control("discomments"	,"Comments"			, "Enter how you NEED to archieve it"							,"Do not use any special characters!"																			,""							,2				,35				,4				,""						,0);
		form_new_control("disarchive"	,"Mark Archieved"	, "Checking this box will mark the discrepancy as archieved"	,"Only do this if you are sure you need to archieve it"															,"(checked = archieved)"	,5				,35				,4				,"current"				,0);

	// FORM UNIVERSAL CONTROL LOADING
	//------------------------------------------------------------------------------------------\\
	
	$targetname		= $_POST['targetname'];			// From the Button Loader; Name of the window this form was loaded into.
	$dhtml_name		= $_POST['dhtmlname'];			// From the Button Loader; Name of the DHTML window function to call to change this window.
	form_uni_control("targetname"		,$targetname);
	form_uni_control("dhtmlname"		,$dhtml_name);
	
	//
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 1;														// 1: Display Submit Button,	0: No
				$submitbuttonname	= 'Submit Error Report';									// Name of the Submit Button
			$display_close			= 1;														// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
			$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");
			
		}
	else {
	
	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "edittable";													// HTML Name for Form
			$formaction			= '';															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= '';															// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget
	
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= "Wildlife Hazard Report - Error Summary";						// Name of the FORM, shown to the user
			$form_subh			= "please complete the form";									// Sub Name of the FORM, shown to the user
			$subtitle 			= "Here is the information about the selected Error Report";	// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= '';													// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= 0;													// See Summary Function for how to use this number
				$returnHTML				= 0;													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
					
		include("includes/_template/_tp_blockform_form_header.binc.php");		
			
		// Load Form Elements	
		// Place Default values from the POST Here or enter 'post'-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\
		//																																																																												|
		//		Put a '0' here if you do not want to display the form field and only the result-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\								|
		//																																																																				 v								v
		form_new_table_b($formname);
		form_new_control("disdate"		,"Date"				, "Enter the date this WLHM Reord was archieved"				,"The current date has automatically been provided!"															,"(mm/dd/yyyy)"				,1				,0				,0				,'post'					,0);
		form_new_control("distime"		,"Time"				, "Enter the time this WLHM Reord was archieved"				,"The current time has automatically been provided!"															,"(hh:mm:ss) - 24 hours"	,1				,0				,0				,'post'					,0);
		form_new_control("disauthor"	,"Entry By"			, "Who found and reported this discrepancy"						,"Your name has automatically been provided!"																	,"(cannot be changed)"		,3				,0				,0				,'post'					,"systemusercombobox");
		form_new_control("discomments"	,"Comments"			, "Enter how you NEED to archieve it"							,"Do not use any special characters!"																			,""							,2				,0				,4				,'post'					,0);
		form_new_control("disarchive"	,"Mark Archieved"	, "Checking this box will mark the discrepancy as archieved"	,"Only do this if you are sure you need to archieve it"															,"(checked = archieved)"	,5				,0				,4				,'post'					,0);

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
			$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
			$display_refresh		= 1;														// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");


		//$sqldate		= AmerDate2SqlDateTime($_POST['disdate']);
		$sqldate		= ($_POST['disdate']);
		
		$sql = "INSERT INTO tbl_139_337_main_e (139337_e_inspection_id, 139337_e_by_cb_int, 139337_e_reason, 139337_e_date, 139337_e_time, 139337_e_yn)
		VALUES ( '".$_POST['recordid']."', '".$_POST['disauthor']."', '".$_POST['discomments']."', '".$sqldate."', '".$_POST['distime']."', '".$_POST['disarchive']."' )";

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
		
// Define Variables...
//						for Auto Entry Function {End of Page}

		$last_main_id	= $lastid;
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>		