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
//	Name of Document		:	part139327_discrepancy_report_browse.php
//
//	Purpose of Page			:	Enter New Part139.327 Inspection
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include_ONCE("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include_ONCE("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes

		include_ONCE("includes/_modules/part139339/part139339.list.php");

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		// Navigation Page ID
		//		Enter the ID of the Navigation Module this page belongs to.
		//		Check the AutoEntry function for more details...
		$navigation_page 			= 40;
		// Page Type ID
		//		Enter the ID of the Event type for this page.
		//		Check the AutoEntry function for more details...
		$type_page 					= 15;							// Page is Type ID, see function for notes!
		// Other Settings for AutoEntry
		//		You should not need to change these values.
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions		
		
		
		
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//	THE CONTAIN CONTENTS IS THE SAME FORMAT FOR ALL BROWSE DOCUMENTS, ALTHOUGH THE DATA MAY BE DIFFERENT
	// 	vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		
	// Set Variables for general use (No need to change)
		$displayrow					= 1;												// NO NEED TO CHANGE THIS VALUE.
		$tbldisplaytotal			= 0;												// 1: Add the value of given columns together;	0: Do not add given columns together.
		
		
	// Show Controls (Interface)
		$tbl_show_datesort 			= 1;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbl_show_textsort			= 1;												// 1: Allow User to Show Records by Text; 		0: Prevent User from sorting records by Text.
		$tbl_show_headersort		= 1;												// 1: Allow User to Show Records by Header; 	0: Prevent User from sorting records by Header.
		$tbl_show_duplicatesort		= 0;												// 1: Default to Show DUPLICATE Records;		0: Default to NOT show DUPLICATE Recrords. 
		$tbl_show_archivedsort		= 0;												// 1: Default to Show ARCHIVED Records; 		0: Default to NOT show ARCHIVED Recrords.
		$tbl_show_closedsort		= 0;												// 1: Default to Show CLOSED Records; 			0: Default to NOT show CLOSED Recrords
		$tbl_show_joinedsort		= 1;												// 1: Allow User to Show Records by Text; 		0: Prevent User from sorting records by Text.
		$tbl_show_pagation			= 1;
		
	// Sorting Controls (Interface / Saved Settings)
		// These are only used on the inital display of the report (then by user control)
		$tbldatesort 				= 1;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbltextsort 				= 1;												// 1: Allow User to Sort Records by Text; 		0: Prevent User from sorting records by Text.
		$tblheadersort				= 1;												// 1: Allow User to Sort Records by Header; 	0: Prevent User from sorting records by Header.
		$tblduplicatesort			= 0;												// 1: Default to Use DUPLICATE Records;			0: Default to NOT show DUPLICATE Recrords. 
		$tblarchivedsort			= 0;												// 1: Default to Use ARCHIVED Records; 			0: Default to NOT show ARCHIVED Recrords.
		$tblclosedsort				= 0;												// 1: Default to Use CLOSED Records; 			0: Default to NOT show CLOSED Recrords
		$tbljoinedsort				= 0;												// 1: Default to Use JOINED Records; 			0: Default to NOT show JOINED Recrords		
		
		$tblpagation				= 1;
		$tblpagationgroup			= 7;
		
	// Preflight Settings	
		//	Proivides the recordset with additional controls not part of the database record
		//	Each preflight is run before the recordset is displayed and controls if the record set is displayed. 
		
		$runpreflights				= 1;												// Tells the Program if it should run the preflight settings
		$function_duplicatesort		= "";			// The Name of the function to call to sort out DUPLICATE Records.
		$function_archivedsort		= "";			// The Name of the function to call to sort out ARCHIEVED Records.
		$function_closedsort		= "";			// The Name of the function to call to sort out CLOSED Records.

	// Aditional Commands Settings
		//		Notes:  For this form I have disabled the Archived, Duplicate, and Error controls because you can quickly access them from the EDIT Function.
		//				For this form, what is important here is the work order information.
		
		$runpostflights				= 1;
		
		//$array_archivedcontrol		= array("SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_archived.php");
		//$array_duplicatecontrol		= array("SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_duplicate.php");
		//$array_errorcontrol			= array("SELECT * FROM tbl_139_327_sub_d_e WHERE discrepancy_error_inspection_id = ",		"discrepancy",	"part139327_discrepancy_report_display_error.php");

		//$array_bouncedcontrol		= array("SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = ",		"discrepancy",	"part139327_discrepancy_report_display_bounced.php");
		//$array_repairedcontrol		= array("SELECT * FROM tbl_139_327_sub_d_r WHERE discrepancy_repaired_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_repaired.php");
		//$array_closedcontrol		= array("SELECT * FROM tbl_139_327_sub_d_c WHERE discrepancy_closed_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_closed.php");

		
		$functionworkorderpage		= "";
		$functionbouncepage			= "";
		$functionrepairpage			= "";
		$functionclosedpage			= "";
		
		$functionduplicatepage		= "";
		$functionarchievedepage		= "";
		$functionerrorpage			= "";
		
	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 		= "edit_record_general.php";
		// $functionsummarypage 	= "summary_report_general.php";
		// $functionprinterpage 	= "printer_report_general.php";		
		$functioneditpage 			= "";						// Name of page used to edit the record
		$functionsummarypage 		= "part139339_c_discrepancy_report_summary.php";					// Name of page used to display a summary of the record
		$functionprinterpage 		= "part139339_c_discrepancy_report_display.php";					// Name of page used to display a printer friendly report		
		$function_calendar			= '';					// The URL of the webpage to load to display the Calendar.
		$function_printout			= '_general_printouts_get.php';									// The URL of the webpage to load to display the Printout.
		$function_distribution		= 'part139339_c_discrepancy_display_distribution_loader.php';		// The URL of the webpage to load to display the Distribition Chart.
		$function_linechart			= '';															// The URL of the webpage to load to display the Line Chart.
		$function_mapit				= 'part139339_c_discrepancy_report_display_mapit_loader.php';		// The URL of the webpage to load to display the Mapit.		
		$function_googleearthit		= 'part139339_c_discrepancy_report_export_makekml.php';			// The URL of he webpage used to generate this information.	
		
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//	^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	//	THE CONTAIN CONTENTS IS THE SAME FORMAT FOR ALL BROWSE DOCUMENTS, ALTHOUGH THE DATA MAY BE DIFFERENT
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "Discrepancy_id";													// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "Discrepancy_date";												// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_139_339_sub_d";												// What table  is that field part of ?
		$tbltextsortfield		= "Discrepancy_name";												// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_139_339_sub_d";												// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "";																// What is the name of the field used to mark the record archived ?
		$tblname				= "Anomalies Monitor Report";										// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "Anomalies Information";										// What is the subname of the table ? (used on edit/summary/printer report pages)

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "Discrepancy_date";
		$adatafield[1]			= "Discrepancy_time";
		$adatafield[2]			= "discrepancy_priority";
		$adatafield[3]			= "discrepancy_name";
		$adatafield[4]			= "discrepancy_by_cb_int";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_139_339_sub_d";
		$adatafieldtable[1]		= $adatafieldtable[0];
		$adatafieldtable[2]		= $adatafieldtable[0];
		$adatafieldtable[3]		= $adatafieldtable[0];		
		$adatafieldtable[4]		= $adatafieldtable[0];	
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "notjoined";
		$adatafieldid[1]		= "notjoined";
		$adatafieldid[2]		= "discrepancy_priority";
		$adatafieldid[3]		= "justsort";
		$adatafieldid[4]		= "discrepancy_by_cb_int";
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		= 0;
		$adataspecial[1]		= 0;
		$adataspecial[2]		= 0;
		$adataspecial[3]		= 0;
		$adataspecial[4]		= 0;	
	// what do you want to name the columns
		$aheadername[0]			= "Date";
		$aheadername[1]			= "Time";
		$aheadername[2]			= "Priority";
		$aheadername[3]			= "Name";
		$aheadername[4]			= "Author";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "( mm/dd/yyyy )";
		$ainputcomment[1]		= "( 24 hour )";
		$ainputcomment[2]		= "(select from the list)";
		$ainputcomment[3]		= "(no special charactors)";
		$ainputcomment[4]		= "(select from the list)";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "TEXT";
		$ainputtype[1]			= "TEXT";
		$ainputtype[2]			= "SELECT";
		$ainputtype[3]			= "TEXT";
		$ainputtype[4]			= "SELECT";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "";
		$adataselect[2]			= "part139339_c_prioritycombobox";
		$adataselect[3]			= "";
		$adataselect[4]			= "systemusercombobox";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";

	include("includes/_template_browse.php");	
	
// Define Variables...
//						for Auto Entry Function {End of Page}

		// Last Main ID
		//		This is the ID of the main record of this page, not a sub routine.
		//		If no ID is used or possible to obtain such a browse page or a form loader enter '-'
		$last_main_id	= "-";
		
		//	AutoEntry Function Array
		//		This array controls the values sent to the auto entry function.
		//		No changes should be needed to it.
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>	