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
//	Name of Document		:	part139337_report_browse.php
//
//	Purpose of Page			:	Browse Part 139.337 Wildlife Hazard Management Records
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

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 21;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 15;							// Page is Type ID, see function for notes!
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
		$tbldisplaytotal			= 1;												// 1: Add the value of given columns together;	0: Do not add given columns together.
		
		
	// Show Controls (Interface)
		$tbl_show_datesort 			= 1;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbl_show_textsort			= 1;												// 1: Allow User to Show Records by Text; 		0: Prevent User from sorting records by Text.
		$tbl_show_headersort		= 1;												// 1: Allow User to Show Records by Header; 	0: Prevent User from sorting records by Header.
		$tbl_show_duplicatesort		= 1;												// 1: Default to Show DUPLICATE Records;		0: Default to NOT show DUPLICATE Recrords. 
		$tbl_show_archivedsort		= 1;												// 1: Default to Show ARCHIVED Records; 		0: Default to NOT show ARCHIVED Recrords.
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
		$tblpagationgroup			= 18;												// Number of records to search for per page.
		
	// Preflight Settings	
		//	Proivides the recordset with additional controls not part of the database record
		//	Each preflight is run before the recordset is displayed and controls if the record set is displayed. 
		
		$runpreflights				= 1;												// Tells the Program if it should run the preflight settings
		$function_duplicatesort		= '';												// The Name of the function to call to sort out DUPLICATE Records.
		$function_archivedsort		= 'preflights_tbl_139_337_main_a_yn';				// The Name of the function to call to sort out ARCHIEVED Records.
		$function_closedsort		= '';												// The Name of the function to call to sort out CLOSED Records.

	// Aditional Commands Settings
		//		Notes:  For this form I have disabled the Archived, Duplicate, and Error controls because you can quickly access them from the EDIT Function.
		//				For this form, what is important here is the work order information.
		
		$runpostflights				= 1;
		
		$array_archivedcontrol		= array("SELECT * FROM tbl_139_337_main_a WHERE 139337_a_inspection_id = ",	"139337",	"part139337_report_display_archived.php");
		//$array_duplicatecontrol		= array("SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_duplicate.php");
		$array_errorcontrol			= array("SELECT * FROM tbl_139_337_main_e WHERE 139337_e_inspection_id = ",	"139337",	"part139337_report_display_error.php");

		//$array_bouncedcontrol		= array("SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = ",		"discrepancy",	"part139327_discrepancy_report_display_bounced.php");
		//$array_repairedcontrol		= array("SELECT * FROM tbl_139_327_sub_d_r WHERE discrepancy_repaired_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_repaired.php");

		$functionworkorderpage		= "";
		$functionbouncepage			= "";
		$functionrepairpage			= "";
		$functionduplicatepage		= "";
		$functionarchievedepage		= "part139337_report_archieved.php";
		$functionerrorpage			= "part139337_report_error.php";
		
	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 		= "edit_record_general.php";
		// $functionsummarypage 	= "summary_report_general.php";
		// $functionprinterpage 	= "printer_report_general.php";		
		$functioneditpage 			= "part139337_report_edit.php";									// Name of page used to edit the record
		$functionsummarypage 		= "part139337_report_summary.php";								// Name of page used to display a summary of the record
		$functionprinterpage 		= "part139337_report_display.php";								// Name of page used to display a printer friendly report		
		$function_calendar			= 'part139337_report_calendar.php';								// The URL of the webpage to load to display the Calendar.
		$function_printout			= '_general_printouts_get.php';									// The URL of the webpage to load to display the Printout.
		$function_yearendreport		= 'part139337_report_display_yearend_loader.php';
		$function_distribution		= 'part139337_report_display_distribution_loader.php';			// The URL of the webpage to load to display the Distribition Chart.
		$function_linechart			= '';															// The URL of the webpage to load to display the Line Chart.
		$function_mapit				= 'part139337_report_display_mapit_loader.php';					// The URL of the webpage to load to display the Mapit.		
		$function_googleearthit		= 'part139337_report_export_makekml_loader.php';				// The URL of he webpage used to generate this information.	
		$function_mapit_push		= 'call_server_MapIt_337M_t';
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//	^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	//	THE CONTAIN CONTENTS IS THE SAME FORMAT FOR ALL BROWSE DOCUMENTS, ALTHOUGH THE DATA MAY BE DIFFERENT
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "139337_id";														// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "139337_date";													// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_139_337_main";												// What table  is that field part of ?
		$tbltextsortfield		= "139337_resultsofaction";											// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_139_337_main";												// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "";																// What is the name of the field used to mark the record archived ?
		$tblname				= "Wildlife Monitor Report";										// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "Wildlife Information";											// What is the subname of the table ? (used on edit/summary/printer report pages)

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "139337_date";
		$adatafield[1]			= "139337_time";
		$adatafield[2]			= "139337_author_by_cb_int";
		$adatafield[3]			= "139337_species_cb_int";
		$adatafield[4]			= "139337_activity_cb_int";
		$adatafield[5]			= "139337_action_cb_int";
		$adatafield[6]			= "139337_numberofspecies";
		
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_139_337_main";
		$adatafieldtable[1]		= $adatafieldtable[0];
		$adatafieldtable[2]		= $adatafieldtable[0];
		$adatafieldtable[3]		= $adatafieldtable[0];		
		$adatafieldtable[4]		= $adatafieldtable[0];	
		$adatafieldtable[5]		= $adatafieldtable[0];
		$adatafieldtable[6]		= $adatafieldtable[0];		

	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "notjoined";
		$adatafieldid[1]		= "notjoined";
		$adatafieldid[2]		= $adatafield[2];
		$adatafieldid[3]		= $adatafield[3];
		$adatafieldid[4]		= $adatafield[4];
		$adatafieldid[5]		= $adatafield[5];
		$adatafieldid[6]		= "notjoined";
		
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		= 0;
		$adataspecial[1]		= 0;
		$adataspecial[2]		= 0;
		$adataspecial[3]		= 0;
		$adataspecial[4]		= 0;	
		$adataspecial[5]		= 0;
		$adataspecial[6]		= 0;
		
	// what do you want to name the columns
		$aheadername[0]			= "Date";
		$aheadername[1]			= "Time";
		$aheadername[2]			= "Entry By";
		$aheadername[3]			= "Species";
		$aheadername[4]			= "Activity";
		$aheadername[5]			= "Action";
		$aheadername[6]			= "# of Species";	
				
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "( mm/dd/yyyy )";
		$ainputcomment[1]		= "( 24 hour )";
		$ainputcomment[2]		= "(select from the list)";
		$ainputcomment[3]		= "(no special charactors)";
		$ainputcomment[4]		= "(select from the list)";
		$ainputcomment[5]		= "( 24 hour )";
		$ainputcomment[6]		= "(select from the list)";
		
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "TEXT";
		$ainputtype[1]			= "TEXT";
		$ainputtype[2]			= "SELECT";
		$ainputtype[3]			= "SELECT";
		$ainputtype[4]			= "SELECT";
		$ainputtype[5]			= "SELECT";
		$ainputtype[6]			= "TEXT";
	
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "";
		$adataselect[2]			= "systemusercombobox";
		$adataselect[3]			= "part139337_combobox_animalspecies";
		$adataselect[4]			= "part139337_combobox_animalactivity";
		$adataselect[5]			= "part139337_combobox_actiontaken";
		$adataselect[6]			= "";

	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$acalculatet[0]			= 0;
		$acalculatet[1]			= 0;
		$acalculatet[2]			= 0;
		$acalculatet[3]			= 0;
		$acalculatet[4]			= 0;
		$acalculatet[5]			= 0;
		$acalculatet[6]			= 1;
		
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";

	include("includes/_template_browse.php");	
	
// Define Variables...
//						for Auto Entry Function {End of Page}

		$last_main_id	= "-";	// No Valid ID to use
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>