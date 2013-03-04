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
//	Name of Document		:	part139303_c__report_display_yearendreport_loader.php
//
//	Purpose of Page			:	View Part 139.303 c Year End Report Chart
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

		include("includes/_modules/part139303/part139303.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 36;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 18;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions		
		
		
// This is a FUNCTION LOADED FROM THE TEMPLATE BROWSER
//		Anytime a window is openned from the template browser the following should be loaded into the FORM
//----------------------------------------------------------------------------------------------\\
			$bstart_date 	= $_GET['frmstartdate'];												// The 'TB' Start Date 	(nonSQL)
			$bend_date 		= $_GET['frmenddate'];													// The 'TB' End Date 	(nonSQL)

			//echo "Start Date :".$bstart_date." / End Date :".$bend_date." ";
			
//	Start Form Set Variables
	
	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "dist_form";													// HTML Name for Form
			$formaction			= "part139303_c_report_display_yearendreport_chart.php";			// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 1;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= "HSLocationWindow";											// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget
	
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= "Topic Year End Report";									// Name of the FORM, shown to the user
			$form_subh			= "please complete the form";									// Sub Name of the FORM, shown to the user
			$subtitle 			= "Part 139.303 C Training Year End Report";				// Subt title of the FORM, shown to the user

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
	//
	//				Field Name			Field Text Name				Field Comment						Field Notes												Field Format		Field Type	Field Width		Field Height	Default Value			Field Function		
	form_new_table_b($formname);
	form_new_control("frmstartdate"		,'Start Date'				, "Enter the the date to start from","The current date has automatically been provided!"	,"(mm/dd/yyyy)"		,1			,10				,0				, $bstart_date			,0);
	form_new_control("frmenddate"		,'End Date'					, "Enter the the date to end at"	,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"		,1			,10				,0				, $bend_date			,0);
	form_new_control("frm_facility"		,"Facility"					, "Select a Facility"				,"Select a facility from the list provided!"			,""					,3			,50				,0				,"all"					,"part139303_c_facilitycomboboxwall");
	form_new_control("frm_condition"	,"Condition"				, "Select a Condition"				,"Select an condition from the list provided!"			,""					,3			,35				,4				,"all"					,"part139303_c_conditioncomboboxwall");
	form_new_control("frm_student"		,"Students"					, "Select a Student"				,"Select an student from the list provided!"			,""					,3			,35				,4				,"all"					,"systemusercomboboxwall");
	form_new_control("disusebrowser"	,"Use Above Settings"		, "Use Broser Settings or override"	,"Checking this box will use the dates above, unchecked will use the dates from the browser form"		,""				,5						,50				,0				,"all"					,0);

	// FORM UNIVERSAL CONTROL LOADING
	//------------------------------------------------------------------------------------------\\
	
	// Determine if this is from POST or GET
	
		if (!isset($_POST["targetname"])) {
			// There is not a menuitemid defined in the POST request
			// Test to see if there is one in the GET request
			if (!isset($_GET["targetname"])) {
					// There is one NOT defined in the get request as well.
					// Set a known default value			
					$targetname = "";
				}
				else {
					// If there is a value in the get request set it to the right value
					$targetname = $_GET["targetname"];
				}
		}
		else {
			// There is a value in the POST request
			$targetname = $_POST["targetname"];
		}
	
		if (!isset($_POST["dhtmlname"])) {
			// There is not a menuitemid defined in the POST request
			// Test to see if there is one in the GET request
			if (!isset($_GET["dhtmlname"])) {
					// There is one NOT defined in the get request as well.
					// Set a known default value			
					$dhtml_name = "";
				}
				else {
					// If there is a value in the get request set it to the right value
					$dhtml_name = $_GET["dhtmlname"];
				}
		}
		else {
			// There is a value in the POST request
			$dhtml_name = $_POST["dhtmlname"];
		}
		
	form_uni_control("targetname"		,$targetname);
	form_uni_control("dhtmlname"		,$dhtml_name);
	
	//
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 1;															// 1: Display Submit Button,	0: No
				$submitbuttonname	= 'Generate Chart';												// Name of the Submit Button
			$display_close			= 1;															// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;															// 1: Display Push Down Button, 0: No
			$display_refresh		= 0;															// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");
				
// Define Variables...
//						for Auto Entry Function {End of Page}

		$last_main_id	= "-";	// No Valid ID to use
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>