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
//	Name of Document	:	FuelFlow Sub V Browse.php
//
//	Purpose of Page		:	Used to list all fueling operations of vehicles
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
		$displayrow					= 1;												// NO NEED TO CHANGE THIS VALUE.
		$tbldatesort 				= 1;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbltextsort 				= 0;												// 1: Allow User to Sort Records by Text; 		0: Prevent User from sorting records by Text.
		$tblheadersort				= 1;												// 1: Allow User to Sort Records by Header; 	0: Prevent User from sorting records by Header.
		$tbldisplaytotal			= 1;												// 1: Add the value of given columns together;	0: Do not add given columns together.
		$tblduplicatesort			= 0;												// 1: Default to Show DUPLICATE Records;		0: Default to NOT show DUPLICATE Recrords. 
		$tblarchivedsort			= 0;												// 1: Default to Show ARCHIVED Records; 		0: Default to NOT show ARCHIVED Recrords.
		$tblclosedsort				= 0;												// 1: Default to Show CLOSED Records; 			0: Default to NOT show CLOSED Recrords
		$runpreflights				= 0;												// 1: Run Preflight Information; 				0: Do not run preflight information.
		$function_duplicatesort		= '';												// The Name of the function to call to sort out DUPLICATE Records.
		$function_archivedsort		= '';												// The Name of the function to call to sort out ARCHIEVED Records.
		$function_closedsort		= '';												// The Name of the function to call to sort out CLOSED Records.
		$tblfrmoptions_calendar		= 0;												// Allows the User to Display the Records in a calendar format.
		$tblfrmoptions_printout		= 1;												// Allows the User to create a report showing all of the records in a printer friendly format.
		$tblfrmoptions_distribution	= 1;												// Allows the User to Display a chart showing the distribution of results over a period of time.
		$tblfrmoptions_linechart	= 1;												// Allows the User to Display a chart showing the information in a line chart format over time.
		$function_calendar			= 'general_calendar.php';							// The URL of the webpage to load to display the Calendar.
		$function_printout			= 'general_printout_report.php';					// The URL of the webpage to load to display the Printout.
		$function_distribution		= 'fuelflow_sub_v_distribution.php';				// The URL of the webpage to load to display the Distribition Chart.
		$function_linechart			= 'fuelflow_sub_v_linechart.php';					// The URL of the webpage to load to display the Line Chart.		
		$functioneditpage 			= "edit_record_general.php";						// Name of page used to edit the record
		$functionsummarypage 		= "summary_report_general.php";						// Name of page used to display a summary of the record
		$functionprinterpage 		= "printer_report_general.php";						// Name of page used to display a printer friendly report
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//	^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	//	THE CONTAIN CONTENTS IS THE SAME FORMAT FOR ALL BROWSE DOCUMENTS, ALTHOUGH THE DATA MAY BE DIFFERENT
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
				
		
	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "fuelflow_v_id";												// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "fuelflow_v_date";											// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_fuelflow_sub_v";											// What table  is that field part of ?
		$tbltextsortfield		= "";															// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_fuelflow_sub_v";											// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "fuelflow_v_archived_yn";										// What is the name of the field used to mark the record archived ?
		$tblname				= "Vehicle Fuel Flow Summary Report";							// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "here is the information you selected";						// What is the subname of the table ? (used on edit/summary/printer report pages)

	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 			= "edit_record_general.php";
		// $functionsummarypage 		= "summary_report_general.php";
		// $functionprinterpage 		= "printer_report_general.php";
		$functioneditpage 		= "edit_record_general.php";									// Name of page used to edit the record
		$functionsummarypage 	= "summary_report_general.php";									// Name of page used to display a summary of the record
		$functionprinterpage 	= "printer_report_general.php";									// Name of page used to display a printer friendly report

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "fuelflow_v_date";
		$adatafield[1]			= "fuelflow_v_time";
		$adatafield[2]			= "fuelflow_v_by_cb_int";
		$adatafield[3]			= "fuelflow_vv_cb_int";
		$adatafield[4]			= "fuelflow_v_fuel_cb_int";
		$adatafield[5]			= "fuelflow_v_fuel_miles";
		$adatafield[6]			= "fuelflow_v_fuel_hours";
		$adatafield[7]			= "fuelflow_v_fuel_gallons";
		$adatafield[8]			= "fuelflow_v_fuel_costg";
		$adatafield[9]			= "fuelflow_v_archived_yn";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_fuelflow_sub_v";
		$adatafieldtable[1]		= "tbl_fuelflow_sub_v";
		$adatafieldtable[2]		= "tbl_fuelflow_sub_v";
		$adatafieldtable[3]		= "tbl_fuelflow_sub_v";
		$adatafieldtable[4]		= "tbl_fuelflow_sub_v";
		$adatafieldtable[5]		= "tbl_fuelflow_sub_v";
		$adatafieldtable[6]		= "tbl_fuelflow_sub_v";
		$adatafieldtable[7]		= "tbl_fuelflow_sub_v";
		$adatafieldtable[8]		= "tbl_fuelflow_sub_v";	
		$adatafieldtable[9]		= "tbl_fuelflow_sub_v";			
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "justsort";
		$adatafieldid[1]		= "justsort";
		$adatafieldid[2]		= "fuelflow_v_by_cb_int";
		$adatafieldid[3]		= "fuelflow_vv_cb_int";
		$adatafieldid[4]		= "fuelflow_v_fuel_cb_int";
		$adatafieldid[5]		= "justsort";
		$adatafieldid[6]		= "justsort";
		$adatafieldid[7]		= "justsort";
		$adatafieldid[8]		= "justsort";
		$adatafieldid[9]		= "justsort";
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		= 0;
		$adataspecial[1]		= 0;
		$adataspecial[2]		= 0;
		$adataspecial[3]		= 0;
		$adataspecial[4]		= 0;
		$adataspecial[5]		= 0;
		$adataspecial[6]		= 0;
		$adataspecial[7]		= 4;
		$adataspecial[8]		= 4;
		$adataspecial[9]		= 4;
	// should this column be added to create a totals column at the end of the recods
		$adataputarray[0]		= 0;
		$adataputarray[1]		= 0;
		$adataputarray[2]		= 0;
		$adataputarray[3]		= 0;
		$adataputarray[4]		= 0;
		$adataputarray[5]		= 1;
		$adataputarray[6]		= 1;
		$adataputarray[7]		= 1;
		$adataputarray[8]		= 1;
		$adataputarray[9]		= 0;
	// should this column be averaged by the total number of records found for that column?
	// 1: yes, 0:no.
		$adataavgarray[0]		= 0;
		$adataavgarray[1]		= 0;
		$adataavgarray[2]		= 0;
		$adataavgarray[3]		= 0;
		$adataavgarray[4]		= 0;
		$adataavgarray[5]		= 1;
		$adataavgarray[6]		= 1;
		$adataavgarray[7]		= 1;
		$adataavgarray[8]		= 1;
		$adataavgarray[9]		= 0;
	// what do you want to name the columns
		$aheadername[0]			= "Date";
		$aheadername[1]			= "Time";
		$aheadername[2]			= "Entry by";
		$aheadername[3]			= "Vehicle";
		$aheadername[4]			= "Tank";
		$aheadername[5]			= "Miles";
		$aheadername[6]			= "Hours";
		$aheadername[7]			= "Gallons";
		$aheadername[8]			= "Price (/g)";
		$aheadername[9]			= "Archived";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "( mm/dd/yyyy )";
		$ainputcomment[1]		= "( 24 hour )";
		$ainputcomment[2]		= "( select from the list )";
		$ainputcomment[3]		= "( select from the list )";
		$ainputcomment[4]		= "( select from the list )";
		$ainputcomment[5]		= "( no special charactors )";
		$ainputcomment[6]		= "( no special charactors )";
		$ainputcomment[7]		= "( no special charactors )";
		$ainputcomment[8]		= "( no special charactors )";
		$ainputcomment[9]		= "( Checked = Archived )";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "TEXT";
		$ainputtype[1]			= "TEXT";
		$ainputtype[2]			= "SELECT";
		$ainputtype[3]			= "SELECT";
		$ainputtype[4]			= "SELECT";
		$ainputtype[5]			= "TEXT";
		$ainputtype[6]			= "TEXT";
		$ainputtype[7]			= "TEXT";
		$ainputtype[8]			= "TEXT";
		$ainputtype[9]			= "CHECKBOX";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "";
		$adataselect[2]			= "systemusercombobox";
		$adataselect[3]			= "inventoryvehiclescombobox";
		$adataselect[4]			= "inventoryfueltankcombobox";
		$adataselect[5]			= "";
		$adataselect[6]			= "";
		$adataselect[7]			= "";
		$adataselect[8]			= "";
		$adataselect[9]			= "";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";

// Build Standard Programming Blocks
	include("includes/block_form.php");	