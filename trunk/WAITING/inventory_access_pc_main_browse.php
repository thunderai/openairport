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
//	Name of Document	:	Inventory Access Proxy Cards Main Browse.php
//
//	Purpose of Page		:	Used to list all leases
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//						In the event you wish to change this page, everything should be
//						rather stright forward in what it does and how to change it.
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
	//	^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	//	THE CONTAIN CONTENTS IS THE SAME FORMAT FOR ALL BROWSE DOCUMENTS, ALTHOUGH THE DATA MAY BE DIFFERENT
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "inventory_pc_id";											// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "";											// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_inventory_sub_a_pc";										// What table  is that field part of ?
		$tbltextsortfield		= "";															// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_inventory_sub_a_pc";										// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "inventory_pc_archived";									// What is the name of the field used to mark the record archived ?
		$tblname				= "Access pc in Inventory";							// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "Here is the information you selected";						// What is the subname of the table ? (used on edit/summary/printer report pages)


	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "inventory_pc_cb_int";
		$adatafield[1]			= "inventory_pc_cb_count";
		$adatafield[2]			= "inventory_pc_archived";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_inventory_sub_a_pc";
		$adatafieldtable[1]		= "tbl_inventory_sub_a_pc";
		$adatafieldtable[2]		= "tbl_inventory_sub_a_pc";		
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "inventory_pc_cb_int";
		$adatafieldid[1]		= "justsort";
		$adatafieldid[2]		= "justsort";
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		= 0;
		$adataspecial[1]		= 0;
		$adataspecial[2]		= 0;
	// should this column be added to create a totals column at the end of the recods
		$adataputarray[0]		= 0;
		$adataputarray[1]		= 1;
		$adataputarray[2]		= 0;
	// what do you want to name the columns
		// Depending on the Name of the field, certain things will happen.
		// Date or Time will cause the text box to have the default time or date entered and the textbox will be smaller
		// Entry By will default the select statement to the current user...  of cource that depends on what function is specidied in adataselect
		// F.B.O. will default the select statement to only those organizations which are FBO...  of cource that depends on what function is specidied in adataselect
		$aheadername[0]			= "Type of Key";
		$aheadername[1]			= "Number of pc";
		$aheadername[2]			= "Archived";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "Please select the type of key from the list to the right";
		$ainputcomment[1]		= "Please enter the number of pc currently in inventory";
		$ainputcomment[2]		= "If this type of key is to be archvied, please click the checkbox";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "SELECT";
		$ainputtype[1]			= "TEXT";
		$ainputtype[2]			= "CHECKBOX";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "inventoryaccesspctypescombobox";
		$adataselect[1]			= "";
		$adataselect[2]			= "";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";

// Build Standard Programming Blocks
	//conductautoleasework();
	include("includes/block_form.php");	
?>