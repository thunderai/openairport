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
//	Name of Document	:	Part139339 Sub N Main Browse.php
//
//	Purpose of Page		:	This page allows the user to browse through the NOTAMs in the sysyem
//							and check if a NOTAM is closed, what the status is and when it is
//							suppose to be cancelled or closed.
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		

// Load include files
	
	include("includes/header.php");															// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.

// Set Initial Values for all of the fields	
	
	// will the form use any of the following toggle switches	
		// should the form have the ability to sort the data by date ?
		// 1 : yes ; 0 : no;
		$tbldatesort 			= 1;																// Display Date Sorting Options Toggle Switch
		$tbltextsort 			= 1;																// Display Text Sorting Options Toggle Switch
		$tblheadersort			= 1;																// Display Heading Sort Options Toggle Switch
		
		// Temporaryly set here to inital a value.  The user will be able to define these using the interface as well.
		$tblduplicatesort		= 0;																// Show discrepancies which are duplicates
		$tblarchivedsort		= 0;
		$tblclosedsort			= 0;
		$displayrow				= 1;
		
		// Pre Flight Information.
		// Do you want to run the preflight procedures?
		// 1 : yes ; 0 : no;
		$runpreflights			= 1;
		$function_archivedsort	= 'preflight_tbl_139339_sub_n_a';
		$function_closedsort	= 'preflight_tbl_139339_sub_n_r';
		
		
	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "139339_sub_n_id";													// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "139339_sub_n_date";													// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_139_339_sub_n";													// What table  is that field part of ?
		$tbltextsortfield		= "139339_sub_n_notes";												// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_139_339_sub_n";													// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "139339_sub_n_archived_yn";											// What is the name of the field used to mark the record archived ?
		$tblname				= "Part 139.339 NOTAM Report";											// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "Here is the information you selected";									// What is the subname of the table ? (used on edit/summary/printer report pages)
	
	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 			= "edit_record_general.php";
		// $functionsummarypage 		= "summary_report_general.php";
		// $functionprinterpage 		= "printer_report_general.php";
		$functioneditpage 		= "part139339_sub_n_main_edit.php";										// Name of page used to edit the record
		$functionsummarypage 	= "summary_report_general.php";											// Name of page used to display a summary of the record
		$functionprinterpage 	= "part139339_sub_n_main_report.php";									// Name of page used to display a printer friendly report
		$calendarpage			= "part139327_main_calendar.php";										// Name of page used to display a calendar printout of data
		$printerpage			= "browse_report_general.php";											// Name of page used to display a printer friendly page
		
	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "139339_sub_n_date";
		$adatafield[1]			= "139339_sub_n_time";
		$adatafield[2]			= "139339_sub_n_type_cb_int";
		$adatafield[3]			= "139339_sub_n_by_cb_int";
		$adatafield[4]			= "139339_sub_n_notes";
		$adatafield[5]			= "139339_sub_n_closed_yn";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_139_339_sub_n";
		$adatafieldtable[1]		= "tbl_139_339_sub_n";
		$adatafieldtable[2]		= "tbl_139_339_sub_n";
		$adatafieldtable[3]		= "tbl_139_339_sub_n";		
		$adatafieldtable[4]		= "tbl_139_339_sub_n";
		$adatafieldtable[5]		= "tbl_139_339_sub_n";
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "justsort";
		$adatafieldid[1]		= "justsort";
		$adatafieldid[2]		= "139339_sub_n_type_cb_int";
		$adatafieldid[3]		= "139339_sub_n_by_cb_int";
		$adatafieldid[4]		= "justsort";
		$adatafieldid[5]		= "139339_sub_n_id";
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		= 0;
		$adataspecial[1]		= 0;
		$adataspecial[2]		= 0;
		$adataspecial[3]		= 0;
		$adataspecial[4]		= 0;
		$adataspecial[5]		= 0;
	// what do you want to name the columns
		$aheadername[0]			= "Date";
		$aheadername[1]			= "Time";
		$aheadername[2]			= "Type";
		$aheadername[3]			= "Inspector";
		$aheadername[4]			= "Notes";
		$aheadername[5]			= "Closed";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "( mm/dd/yyyy )";
		$ainputcomment[1]		= "( 24 hour )";
		$ainputcomment[2]		= "(select from the list)";
		$ainputcomment[3]		= "(select from the list)";
		$ainputcomment[4]		= "(select from the list)";
		$ainputcomment[5]		= "(select from the list)";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "TEXT";
		$ainputtype[1]			= "TEXT";
		$ainputtype[2]			= "SELECT";
		$ainputtype[3]			= "SELECT";
		$ainputtype[4]			= "TEXT";
		$ainputtype[5]			= "SELECT";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "";
		$adataselect[2]			= "part139339typescombobox";
		$adataselect[3]			= "systemusercombobox";
		$adataselect[4]			= "";
		$adataselect[5]			= "part139339_is_notam_closed";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";
		
// Build Standard Programming Blocks
	include("includes/block_form.php");	