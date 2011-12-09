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
		$displayrow					= 1;												// NO NEED TO CHANGE THIS VALUE.
		$tbldatesort 				= 0;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbltextsort 				= 0;												// 1: Allow User to Sort Records by Text; 		0: Prevent User from sorting records by Text.
		$tblheadersort				= 1;												// 1: Allow User to Sort Records by Header; 	0: Prevent User from sorting records by Header.
		$tbldisplaytotal			= 0;												// 1: Add the value of given columns together;	0: Do not add given columns together.
		$tblduplicatesort			= 0;												// 1: Default to Show DUPLICATE Records;		0: Default to NOT show DUPLICATE Recrords. 
		$tblarchivedsort			= 0;												// 1: Default to Show ARCHIVED Records; 		0: Default to NOT show ARCHIVED Recrords.
		$tblclosedsort				= 0;												// 1: Default to Show CLOSED Records; 			0: Default to NOT show CLOSED Recrords
		$runpreflights				= 0;												// 1: Run Preflight Information; 				0: Do not run preflight information.
		$function_duplicatesort		= '';												// The Name of the function to call to sort out DUPLICATE Records.
		$function_archivedsort		= '';												// The Name of the function to call to sort out ARCHIEVED Records.
		$function_closedsort		= '';												// The Name of the function to call to sort out CLOSED Records.
		$tblfrmoptions_calendar		= 0;												// Allows the User to Display the Records in a calendar format.
		$tblfrmoptions_printout		= 1;												// Allows the User to create a report showing all of the records in a printer friendly format.
		$tblfrmoptions_distribution	= 0;												// Allows the User to Display a chart showing the distribution of results over a period of time.
		$tblfrmoptions_linechart	= 0;												// Allows the User to Display a chart showing the information in a line chart format over time.
		$function_calendar			= '';												// The URL of the webpage to load to display the Calendar.
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
		$tblkeyfield				= "citycip_rs_id";									// What is the Auto Increment Field for this table ?
		$tbldatesortfield			= "";												// What is the name of field use in date sorting ?
		$tbldatesorttable			= "tbl_city_cip_rs";								// What table  is that field part of ?
		$tbltextsortfield			= "";												// What is the name of the field used in text sorting ?
		$tbltextsorttable			= "tbl_city_cip_rs";								// What is the name of the table used for text sorting ?
		$tblarchivedfield			= "citycip_archived_yn";							// What is the name of the field used to mark the record archived ?
		$tblname					= "Replacement Schedule Report";					// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname					= "Here is the information you selected";			// What is the subname of the table ? (used on edit/summary/printer report pages)

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]		= 'citycip_rs_type_id';
		$adatafield[1]		= 'citycip_rs_rs_type_cb_int';
		$adatafield[2]		= 'citycip_rs_sub_rs_cb_int';
		$adatafield[3]		= 'citycip_rs_archived_yn';
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]	= 'tbl_city_cip_rs';
		$adatafieldtable[1]	= 'tbl_city_cip_rs';
		$adatafieldtable[2]	= 'tbl_city_cip_rs';
		$adatafieldtable[3]	= 'tbl_city_cip_rs';
	// do you want the user ot be able to click on the information AND have something happen?
		// notjoined		= Do nothing special, do not allow sorting of this item
		// justsort			= Allows the sorting of a field without loading an external function
		// makebutton		= Creates a button that allows the user to open a new window pointing towards the object
		// "name of field" 	= Load a Procedure
	
		$adatafieldid[0]	= 'citycip_rs_type_id';
		$adatafieldid[1]	= 'citycip_rs_rs_type_cb_int';
		$adatafieldid[2]	= 'citycip_rs_sub_rs_cb_int';
		$adatafieldid[3]	= 'justsort';
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial		= array(0,0,0,0,0,0,0,0,0,0);
	// should this column be added to create a totals column at the end of the recods
		$adataputarray		= array(0,0,0,0,0,0,0,0,0,0);
	// should this column be averaged by the total number of records found for that column?
	// 1: yes, 0:no.
		$adataavgarray		= array(0,0,0,0,0,0,0,0,0,0);
	// what do you want to name the columns
		$aheadername[0]		= 'Type of Object';
		$aheadername[1]		= 'Object';
		$aheadername[2]		= 'Replacement Year';
		$aheadername[3]		= 'Archived?';
	// Any special comments to make after the input box?
		$ainputcomment[0]	= "This is the type of object";
		$ainputcomment[1]	= "This is the name of the object in the replacement schedule";
		$ainputcomment[2]	= "In this many years you will want to replace this item";
		$ainputcomment[3]	= "Is this objects record archived?";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]		= 'SELECT';
		$ainputtype[1]		= 'SELECT';
		$ainputtype[2]		= 'SELECT';
		$ainputtype[3]		= 'CHECKBOX';
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]		= 'leasetypescomboboxnoajax';
		$adataselect[1]		= 'leaseitemtypecombobox';
		$adataselect[2]		= 'calculatereplacementyear';
		$adataselect[3]		= '';
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";

// Build Standard Programming Blocks
	//fixleasework();
	conductautoleasework();
	include("includes/block_form.php");	