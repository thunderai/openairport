<?
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o	o		ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		o	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		oo	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o o	o		ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  oo		o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	o		o	o	  o		o	o	o		o	o	o	o     o
//	00000	0		ooooo	o	o		o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	Budget CIP RS Browse.php
//
//	Purpose of Page		:	Used to list all Replacement Schedule Objects
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

	// Load include files
	
		include("includes/header.php");													// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
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
		$tbl_show_archivedsort		= 0;												// 1: Default to Show ARCHIVED Records; 		0: Default to NOT show ARCHIVED Recrords.
		$tbl_show_closedsort		= 0;												// 1: Default to Show CLOSED Records; 			0: Default to NOT show CLOSED Recrords
		$tbl_show_joinedsort		= 1;												// 1: Allow User to Show Records by Text; 		0: Prevent User from sorting records by Text.
		$tbl_show_pagation			= 1;
		
		// Sorting Controls (Interface / Saved Settings)
		// These are only used on the inital display of the report (then by user control)
		$tbldatesort 				= 1;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbltextsort 				= 0;												// 1: Allow User to Sort Records by Text; 		0: Prevent User from sorting records by Text.
		$tblheadersort				= 1;												// 1: Allow User to Sort Records by Header; 	0: Prevent User from sorting records by Header.
		$tblduplicatesort			= 0;												// 1: Default to Use DUPLICATE Records;		0: Default to NOT show DUPLICATE Recrords. 
		$tblarchivedsort			= 0;												// 1: Default to Use ARCHIVED Records; 		0: Default to NOT show ARCHIVED Recrords.
		$tblclosedsort				= 0;												// 1: Default to Use CLOSED Records; 			0: Default to NOT show CLOSED Recrords
		$tblpagation				= 1;
		$tblpagationgroup			= 18;
		
		// Preflight Settings		
		$runpreflights				= 1;												// Tells the Program if it should run the 
																						// Preflight Functions. 1: Run 0: Skip
		$function_duplicatesort		= '';												// The Name of the function to call to sort out DUPLICATE Records.
		$function_archivedsort		= 'preflight_tbl_139_327_main_a_yn';				// The Name of the function to call to sort out ARCHIEVED Records.
		$function_closedsort		= '';												// The Name of the function to call to sort out CLOSED Records.
		
		$function_calendar			= 'part139327_main_Inspcalendar.php';				// The URL of the webpage to load to display the Calendar.
		$function_printout			= 'printouts_general_get.php';						// The URL of the webpage to load to display the Printout.
		$function_distribution		= '';												// The URL of the webpage to load to display the Distribition Chart.
		$function_linechart			= '';												// The URL of the webpage to load to display the Line Chart.		
		$functioneditpage 			= "edit_record_general.php";						// Name of page used to edit the record
		$functionsummarypage 		= "summary_report_general.php";						// Name of page used to display a summary of the record
		$functionprinterpage 		= "printer_report_general.php";						// Name of page used to display a printer friendly report
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//	^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	//	THE CONTAIN CONTENTS IS THE SAME FORMAT FOR ALL BROWSE DOCUMENTS, ALTHOUGH THE DATA MAY BE DIFFERENT
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
																			// Show discrepancies which are archived
		
	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "inspection_system_id";												// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "139327_date";														// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_139_327_main";													// What table  is that field part of ?
		$tbltextsortfield		= "";																// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_139_327_main";													// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "";																// What is the name of the field used to mark the record archived ?
		$tblname				= "Part 139.327 Inspection Summary Report";								// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "here is the information you selected";									// What is the subname of the table ? (used on edit/summary/printer report pages)
	
	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 			= "edit_record_general.php";
		// $functionsummarypage 		= "summary_report_general.php";
		// $functionprinterpage 		= "printer_report_general.php";
		$functioneditpage 		= "part139327_main_edit.php";											// Name of page used to edit the record
		$functionsummarypage 	= "summary_report_general.php";											// Name of page used to display a summary of the record
		$functionprinterpage 	= "part139327_main_report.php";											// Name of page used to display a printer friendly report

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "139327_date";
		$adatafield[1]			= "139327_time";
		$adatafield[2]			= "type_of_inspection_cb_int";
		$adatafield[3]			= "inspection_completed_by_cb_int";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_139_327_main";
		$adatafieldtable[1]		= "tbl_139_327_main";
		$adatafieldtable[2]		= "tbl_139_327_main";
		$adatafieldtable[3]		= "tbl_139_327_main";		
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "justsort";
		$adatafieldid[1]		= "justsort";
		$adatafieldid[2]		= "type_of_inspection_cb_int";
		$adatafieldid[3]		= "inspection_completed_by_cb_int";
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
		$aheadername[3]			= "Inspector";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "( mm/dd/yyyy )";
		$ainputcomment[1]		= "( 24 hour )";
		$ainputcomment[2]		= "(select from the list)";
		$ainputcomment[3]		= "(select from the list)";
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
		$adataselect[2]			= "part139327typescombobox";
		$adataselect[3]			= "systemusercombobox";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";

	include("includes/block_form.php");	

include("includes/footer.php");		// include file that gets information from form POSTs for navigational purposes
?>	
