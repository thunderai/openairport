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
//	Name of Document		:	part139303_c_report_browse.php
//
//	Purpose of Page			:	Browse Part 139.303 (c) Personnel Records
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

		include("includes/_modules/part139303/part139303.list.php");
		
// Define Variables	
		
		$navigation_page 			= 37;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 15;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
		//	Do NOT Display Breadcrum report on this page...
	
// Start Procedures	

	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//	THE CONTAIN CONTENTS IS THE SAME FORMAT FOR ALL BROWSE DOCUMENTS, ALTHOUGH THE DATA MAY BE DIFFERENT
	// 	vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		
	// Set Variables for general use (No need to change)
		$displayrow					= 1;												// NO NEED TO CHANGE THIS VALUE.
		$tbldisplaytotal			= 0;												// 1: Add the value of given columns together;	0: Do not add given columns together.
		
		
	// Show Controls (Interface)
		$tbl_show_datesort 			= 1;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbl_show_textsort			= 0;												// 1: Allow User to Show Records by Text; 		0: Prevent User from sorting records by Text.
		$tbl_show_headersort		= 1;												// 1: Allow User to Show Records by Header; 	0: Prevent User from sorting records by Header.
		$tbl_show_duplicatesort		= 0;												// 1: Default to Show DUPLICATE Records;		0: Default to NOT show DUPLICATE Recrords. 
		$tbl_show_archivedsort		= 1;												// 1: Default to Show ARCHIVED Records; 		0: Default to NOT show ARCHIVED Recrords.
		$tbl_show_closedsort		= 0;												// 1: Default to Show CLOSED Records; 			0: Default to NOT show CLOSED Recrords
		$tbl_show_joinedsort		= 1;												// 1: Allow User to Show Records by Text; 		0: Prevent User from sorting records by Text.
		$tbl_show_pagation			= 1;
		
	// Sorting Controls (Interface / Saved Settings)
		// These are only used on the inital display of the report (then by user control)
		$tbldatesort 				= 1;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbltextsort 				= 0;												// 1: Allow User to Sort Records by Text; 		0: Prevent User from sorting records by Text.
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
		$function_duplicatesort		= '';												// The Name of the function to call to sort out DUPLICATE Records.
		$function_archivedsort		= 'preflights_tbl_139_303_c_main_a_yn';				// The Name of the function to call to sort out ARCHIEVED Records.
		$function_closedsort		= '';												// The Name of the function to call to sort out CLOSED Records.

	// Aditional Commands Settings
		//		Notes:  For this form I have disabled the Archived, Duplicate, and Error controls because you can quickly access them from the EDIT Function.
		//				For this form, what is important here is the work order information.
		
		$runpostflights				= 1;
		
		$array_archivedcontrol		= array("SELECT * FROM tbl_139_303_c_main_a WHERE 139303_c_a_inspection_id = ",	"139303_c",	"part139303_c_report_display_archived.php");
		//$array_duplicatecontrol		= array("SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_duplicate.php");
		$array_errorcontrol			= array("SELECT * FROM tbl_139_303_c_main_e WHERE 139303_c_e_inspection_id = ",	"139303_c",	"part139303_c_report_display_error.php");

		//$array_bouncedcontrol		= array("SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = ",		"discrepancy",	"part139327_discrepancy_report_display_bounced.php");
		//$array_repairedcontrol		= array("SELECT * FROM tbl_139_327_sub_d_r WHERE discrepancy_repaired_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_repaired.php");

		$functionworkorderpage		= "";
		$functionbouncepage			= "";
		$functionrepairpage			= "";
		$functionduplicatepage		= "";
		$functionarchievedepage		= "part139303_c_report_archieved.php";
		$functionerrorpage			= "part139303_c_report_error.php";
		
	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 		= "edit_record_general.php";
		// $functionsummarypage 	= "summary_report_general.php";
		// $functionprinterpage 	= "printer_report_general.php";		
		$functioneditpage 			= "part139303_c_report_edit.php";								// Name of page used to edit the record
		$functionsummarypage 		= "part139303_c_report_summary.php";							// Name of page used to display a summary of the record
		$functionprinterpage 		= "part139303_c_report_display.php";							// Name of page used to display a printer friendly report		
		$function_calendar			= '';															// The URL of the webpage to load to display the Calendar.
		$function_printout			= '_general_printouts_get.php';									// The URL of the webpage to load to display the Printout.
		$function_yearendreport		= 'part139303_c_report_display_yearendreport_loader.php';
		$function_distribution		= 'part139303_c_report_display_distribution_loader.php';															// The URL of the webpage to load to display the Distribition Chart.
		$function_linechart			= '';															// The URL of the webpage to load to display the Line Chart.
		$function_mapit				= '';															// The URL of the webpage to load to display the Mapit.		
		$function_googleearthit		= '';															// The URL of he webpage used to generate this information.			
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//	^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	//	THE CONTAIN CONTENTS IS THE SAME FORMAT FOR ALL BROWSE DOCUMENTS, ALTHOUGH THE DATA MAY BE DIFFERENT
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "139_303_id";													// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "139_303_date";																// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_139_303_c_main";												// What table  is that field part of ?
		$tbltextsortfield		= "";													// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_139_303_c_main";												// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "";																// What is the name of the field used to mark the record archived ?
		$tblname				= "Part 139.303 (c) Personnel Records";								// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "List of Training Sessions";												// What is the subname of the table ? (used on edit/summary/printer report pages)

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "139_303_date";
		$adatafield[1]			= "139_303_time";
		$adatafield[2]			= "139_303_type_cb_int";
		$adatafield[3]			= "139_303_by_cb_int";
		
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= $tbldatesorttable;
		$adatafieldtable[1]		= $adatafieldtable[0];
		$adatafieldtable[2]		= $adatafieldtable[0];
		$adatafieldtable[3]		= $adatafieldtable[0];

	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "notjoined";
		$adatafieldid[1]		= "notjoined";
		$adatafieldid[2]		= $adatafield[2];
		$adatafieldid[3]		= $adatafield[3];
		
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		= 0;
		$adataspecial[1]		= 0;
		$adataspecial[2]		= 0;
		$adataspecial[3]		= 0;
		
	// what do you want to name the columns
		$aheadername[0]			= "Date";
		$aheadername[1]			= "Time";
		$aheadername[2]			= "Type";
		$aheadername[3]			= "Teacher";	
				
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "(no special charactors)";
		$ainputcomment[1]		= "(no special charactors)";
		$ainputcomment[2]		= "(no special charactors)";
		$ainputcomment[3]		= "(no special charactors)";
		
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "TEXT";
		$ainputtype[1]			= "TEXT";
		$ainputtype[2]			= "SELECT";
		$ainputtype[3]			= "SELECT";
	
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "";
		$adataselect[2]			= "part139303_c_typescombobox";
		$adataselect[3]			= "systemusercombobox";

	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$acalculatet[0]			= 0;
		$acalculatet[1]			= 0;
		$acalculatet[2]			= 0;
		$acalculatet[3]			= 0;
		
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";

		$displayerrors = 0;
		
	include("includes/_template_browse.php");	
	
// Establish Page Variables

		if (!isset($_POST["formsubmit"])) {
				// Not defined, set to zero
				$submit = 0;
			} else {
				$submit = $_POST["formsubmit"];
			}
				
		$last_main_id	= "-";	// NO Useable ID
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $submit, $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);		
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>