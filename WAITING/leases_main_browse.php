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
//	Name of Document	:	Leases_Main_Browse.php
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
		$tbldatesort 				= 1;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbltextsort 				= 0;												// 1: Allow User to Sort Records by Text; 		0: Prevent User from sorting records by Text.
		$tblheadersort				= 1;												// 1: Allow User to Sort Records by Header; 	0: Prevent User from sorting records by Header.
		$tbldisplaytotal			= 0;												// 1: Add the value of given columns together;	0: Do not add given columns together.
		$tblduplicatesort			= 0;												// 1: Default to Show DUPLICATE Records;		0: Default to NOT show DUPLICATE Recrords. 
		$tblarchivedsort			= 0;												// 1: Default to Show ARCHIVED Records; 		0: Default to NOT show ARCHIVED Recrords.
		$tblclosedsort				= 0;												// 1: Default to Show CLOSED Records; 			0: Default to NOT show CLOSED Recrords
		$runpreflights				= 1;												// 1: Run Preflight Information; 				0: Do not run preflight information.
		$function_duplicatesort		= 'preflight_tbl_leases_main_a_yn';					// The Name of the function to call to sort out DUPLICATE Records.
		$function_archivedsort		= 'preflight_tbl_leases_main_a_yn';					// The Name of the function to call to sort out ARCHIEVED Records.
		$function_closedsort		= 'preflight_tbl_leases_main_c_yn';					// The Name of the function to call to sort out CLOSED Records.
		$tblfrmoptions_calendar		= 1;												// Allows the User to Display the Records in a calendar format.
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
	//	^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	//	THE CONTAIN CONTENTS IS THE SAME FORMAT FOR ALL BROWSE DOCUMENTS, ALTHOUGH THE DATA MAY BE DIFFERENT
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
				
		
		
	// this information is needed to program the datafields AND sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield				= "leases_id";										// What is the Auto Increment Field for this table ?
		$tbldatesortfield			= "lease_beganon";									// What is the name of field use in date sorting ?
		$tbldatesorttable			= "tbl_leases_main";								// What table  is that field part of ?
		$tbltextsortfield			= "lease_treason";									// What is the name of the field used in text sorting ?
		$tbltextsorttable			= "tbl_leases_main";								// What is the name of the table used for text sorting ?
		$tblarchivedfield			= "lease_archived_yn";								// What is the name of the field used to mark the record archived ?
		$tblname					= "Lease Summary Report";							// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname					= "Here is the information you selected";			// What is the subname of the table ? (used on edit/summary/printer report pages)

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield				= array('lease_beganon','leases_lessee_cb_int','leases_lease_type_cb_int','leases_type_id','lease_terms_cb_int','lease_expectedend','lease_terminatedon','lease_treason','lease_doclocation','lease_archived_yn');
	// in each array specified above, what table does that field come from?
		$adatafieldtable		= array('tbl_leases_main','tbl_leases_main','tbl_leases_main','tbl_leases_main','tbl_leases_main','tbl_leases_main','tbl_leases_main','tbl_leases_main','tbl_leases_main','tbl_leases_main');
	// do you want the user ot be able to click on the information AND have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid			= array('justsort','leases_lessee_cb_int','leases_lease_type_cb_int','leases_type_id','lease_terms_cb_int','justsort','justsort','justsort','makebutton','justsort');
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial			= array(0,0,0,0,0,0,0,0,0,0);
	// should this column be added to create a totals column at the end of the recods
		$adataputarray			= array(0,0,0,0,0,0,0,0,0,0);
	// should this column be averaged by the total number of records found for that column?
	// 1: yes, 0:no.
		$adataavgarray			= array(0,0,0,0,0,0,0,0,0,0);
	// what do you want to name the columns
		$aheadername			= array('Date (began on)','Lessee','Type of Lease','Item Leased','Terms','Date (expected end)','Date (Terminated)','Termination Reason','Document Location','Archived');
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "( mm/dd/yyyy )";
		$ainputcomment[1]		= "( 24 hour )";
		$ainputcomment[2]		= "( select from the list )";
		$ainputcomment[3]		= "( select from the list )";
		$ainputcomment[4]		= "( select from the list )";
		$ainputcomment[5]		= "( no special charactors )";
		$ainputcomment[6]		= "( Checked = Archived )";
		$ainputcomment[7]		= "( no special charactors )";
		$ainputcomment[8]		= "( Checked = Archived )";
		$ainputcomment[9]		= "( Checked = Archived )";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype				= array('TEXT','SELECT','SELECT','SELECT','SELECT','TEXT','TEXT','TEXTAREA','TEXT','CHECKBOX');
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect			= array('','organizationcombobox','leasetypescomboboxnoajax','leaseitemtypecombobox','leasetermscombobox','','','','','');
		//$adataselectsqlfields		= array
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";

// Build Standard Programming Blocks
	//fixleasework();
	conductautoleasework();
	include("includes/block_form.php");	