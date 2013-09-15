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
//	Name of Document		:	part139327_discrepancy_report_summary.php
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
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// Define Variables	
		
		$tblname		= "Hot Spot Discrepancy Summary Reports";
		$tblsubname		= "(summary of information)";
	
// Define Variables	
		
		$navigation_page 			= 16;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 2;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
		//	Do NOT Display Breadcrum report on this page...
	
// Start Procedures	
	
	
	
	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "summary_form";												// HTML Name for Form
			$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 1;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= "MapLocationWindow";											// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget

	
			// Unserialze the array
			//echo "Serialized Array is ".$_POST['idarray']." <br>";
			
			$aIDs 					= unserialize(($_POST['idarray']));
			
			// Loop through the array
			
			//echo "Count is ".count($aIDs)." <br>";

			for ($z=0; $z <count($aIDs); $z=$z+1) {
			
					// The ID value we want is the value in the array
					$t = $z + 1;
					$tmp_record_id = $aIDs[$z];
					
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= "Hot Spots Summary Report - Result # ".$t;					// Name of the FORM, shown to the user
			$form_subh			= "Here is the information you requested";						// Sub Name of the FORM, shown to the user
			$subtitle 			= "Discrepancy Report - Summary Actions";						// Subt title of the FORM, shown to the user

	// HiJack format to do special work for this page:
					
	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 1;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= 'display_discrepancy_summary';						// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= $tmp_record_id;										// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= 1;													// See Summary Function for how to use this number
				$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
					
		include("includes/_template/_tp_blockform_form_header_inline.binc.php");		
	//form_new_table_b($formname);
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
			$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer_inline.binc.php");	
		
				}
			
// Establish Page Variables

		$last_main_id	= $idtosearch;
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>