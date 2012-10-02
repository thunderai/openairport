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
//	Name of Document	:	Access Vehicles Main Browse.php
//
//	Purpose of Page		:	Used to list all leases
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
		$tbldatesort 				= 0;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbltextsort 				= 0;												// 1: Allow User to Sort Records by Text; 		0: Prevent User from sorting records by Text.
		$tblheadersort				= 1;												// 1: Allow User to Sort Records by Header; 	0: Prevent User from sorting records by Header.
		$tbldisplaytotal			= 1;												// 1: Add the value of given columns together;	0: Do not add given columns together.
		$tblduplicatesort			= 0;												// 1: Default to Show DUPLICATE Records;	0: Default to NOT show DUPLICATE Recrords. 
		$tblarchivedsort			= 0;												// 1: Default to Show ARCHIVED Records; 		0: Default to NOT show ARCHIVED Recrords.
		$tblclosedsort				= 0;												// 1: Default to Show CLOSED Records; 		0: Default to NOT show CLOSED Recrords
		$runpreflights				= 0;												// 1: Run Preflight Information; 			0: Do not run preflight information.
		$function_duplicatesort		= '';												// The Name of the function to call to sort out DUPLICATE Records.
		$function_archivedsort		= '';												// The Name of the function to call to sort out ARCHIEVED Records.
		$function_closedsort		= '';												// The Name of the function to call to sort out CLOSED Records.
		$tblfrmoptions_calendar		= 0;												// Allows the User to Display the Records in a calendar format.
		$tblfrmoptions_printout		= 1;												// Allows the User to create a report showing all of the records in a printer friendly format.
		$tblfrmoptions_distribution	= 0;												// Allows the User to Display a chart showing the distribution of results over a period of time.
		$tblfrmoptions_linechart	= 0;												// Allows the User to Display a chart showing the information in a line chart format over time.
		$function_calendar			= 'general_calendar.php';							// The URL of the webpage to load to display the Calendar.
		$function_printout			= 'general_printout_report.php';					// The URL of the webpage to load to display the Printout.
		$function_distribution		= '';												// The URL of the webpage to load to display the Distribition Chart.
		$function_linechart			= '';												// The URL of the webpage to load to display the Line Chart.		
		$functioneditpage 			= "edit_record_general.php";						// Name of page used to edit the record
		$functionsummarypage 		= "summary_report_general.php";						// Name of page used to display a summary of the record
		$functionprinterpage 		= "printer_report_general.php";						// Name of page used to display a printer friendly report
	
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "access_v_id";												// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "access_v_date";												// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_access_sub_a_v";											// What table  is that field part of ?
		$tbltextsortfield		= "";															// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_access_sub_a_v";											// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "access_v_archived_yn";										// What is the name of the field used to mark the record archived ?
		$tblname				= "Access Vehicles Summary Log";								// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "here is the information you selected";						// What is the subname of the table ? (used on edit/summary/printer report pages)
	
	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "access_v_date";
		$adatafield[1]			= "access_v_time";
		$adatafield[2]			= "access_v_by_cb_int";
		$adatafield[3]			= "access_v_towhom_cb_int";
		$adatafield[4]			= "access_v_make_txt";
		$adatafield[5]			= "access_v_model_txt";
		$adatafield[6]			= "access_v_year_txt";
		$adatafield[7]			= "access_v_color_txt";
		$adatafield[8]			= "access_v_plate_txt";
		$adatafield[9]			= "access_v_archived_yn";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_access_sub_a_v";
		$adatafieldtable[1]		= "tbl_access_sub_a_v";
		$adatafieldtable[2]		= "tbl_access_sub_a_v";
		$adatafieldtable[3]		= "tbl_access_sub_a_v";
		$adatafieldtable[4]		= "tbl_access_sub_a_v";
		$adatafieldtable[5]		= "tbl_access_sub_a_v";
		$adatafieldtable[6]		= "tbl_access_sub_a_v";
		$adatafieldtable[7]		= "tbl_access_sub_a_v";
		$adatafieldtable[8]		= "tbl_access_sub_a_v";	
		$adatafieldtable[9]		= "tbl_access_sub_a_v";			
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "notjoined";
		$adatafieldid[1]		= "notjoined";
		$adatafieldid[2]		= "access_v_by_cb_int";
		$adatafieldid[3]		= "access_v_towhom_cb_int";
		$adatafieldid[4]		= "notjoined";
		$adatafieldid[5]		= "notjoined";
		$adatafieldid[6]		= "notjoined";
		$adatafieldid[7]		= "notjoined";
		$adatafieldid[8]		= "notjoined";
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
		$adataspecial[7]		= 0;
		$adataspecial[8]		= 0;
		$adataspecial[9]		= 0;
	// should this column be added to create a totals column at the end of the recods
		$adataputarray[0]		= 0;
		$adataputarray[1]		= 0;
		$adataputarray[2]		= 0;
		$adataputarray[3]		= 0;
		$adataputarray[4]		= 0;
		$adataputarray[5]		= 0;
		$adataputarray[6]		= 0;
		$adataputarray[7]		= 0;
		$adataputarray[8]		= 0;
		$adataputarray[9]		= 0;
	// what do you want to name the columns
		$aheadername[0]			= "Date";
		$aheadername[1]			= "Time";
		$aheadername[2]			= "Entry by";
		$aheadername[3]			= "To Whom";
		$aheadername[4]			= "Make";
		$aheadername[5]			= "Model";
		$aheadername[6]			= "Year";
		$aheadername[7]			= "Color";
		$aheadername[8]			= "Plate";
		$aheadername[9]			= "Archieved";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "(Please enter the date of this tranaction in (mm/dd/yyyy) format";
		$ainputcomment[1]		= "Please enter the time of this transaction in 24 hour format";
		$ainputcomment[2]		= "Please select from the list to the right who completed this transaction";
		$ainputcomment[3]		= "Please select from the list to the right who these pc were given to";
		$ainputcomment[4]		= "Please select from the list to the right who these pc were received from";
		$ainputcomment[5]		= "Please enter the number of pc provided to the person selected";
		$ainputcomment[6]		= "Please enter the number of pc received from the person selected";
		$ainputcomment[7]		= "Please select from the list to the right, the type of pc in the transaction";
		$ainputcomment[8]		= "Please select from the list to the right, the type of pc in the transaction";
		$ainputcomment[9]		= "If this tranaction is to be archived, click the checkbox";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "TEXT";
		$ainputtype[1]			= "TEXT";
		$ainputtype[2]			= "SELECT";
		$ainputtype[3]			= "SELECT";
		$ainputtype[4]			= "TEXT";
		$ainputtype[5]			= "TEXT";
		$ainputtype[6]			= "TEXT";
		$ainputtype[7]			= "TEXT";
		$ainputtype[8]			= "TEXT";
		$ainputtype[9]			= "CHECKBOX";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "";
		$adataselect[2]			= "systemusercombobox";
		$adataselect[3]			= "organizationcombobox";
		$adataselect[4]			= "";
		$adataselect[5]			= "";
		$adataselect[6]			= "";
		$adataselect[7]			= "";
		$adataselect[8]			= "";
		$adataselect[9]			= "";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";

// Build Standard Programming Blocks
	//conductautoleasework();
	include("includes/block_form.php");	
?>