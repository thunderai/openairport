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
//	Name of Document	:	Inventory_Buildings_Browse.php
//
//	Purpose of Page		:	Used to list all buildings in inventory
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
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
	
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	// will the form use any of the following toggle switches	
		// should the form have the ability to sort the data by date ?
		// 1 : yes ; 0 : no;
		$tbldatesort 			= 0;																// Display Date Sorting Options Toggle Switch
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
		$runpreflights			= 0;
		$function_archivedsort	= 'preflight_tbl_139339_sub_n_a';
		$function_closedsort	= 'preflight_tbl_139339_sub_n_r';
		
	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "buildings_id";												// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "";															// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_inventory_sub_b";										// What table  is that field part of ?
		$tbltextsortfield		= "buildings_name";												// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_inventory_sub_b";										// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "buildings_archived_yn";										// What is the name of the field used to mark the record archived ?
		$tblname				= "Vehicles Summary Report";									// What is the name of the table ? (used on edit/summary/printer report pages)
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
		$adatafield[0]			= "buildings_modelyear";
		$adatafield[1]			= "buildings_name";
		$adatafield[2]			= "buildings_type_cb_int";
		$adatafield[3]			= "buildings_manufac_cb_int";
		$adatafield[4]			= "buildings_archived_yn";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_inventory_sub_b";
		$adatafieldtable[1]		= "tbl_inventory_sub_b";
		$adatafieldtable[2]		= "tbl_inventory_sub_b";
		$adatafieldtable[3]		= "tbl_inventory_sub_b";
		$adatafieldtable[4]		= "tbl_inventory_sub_b";		
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "justsort";
		$adatafieldid[1]		= "justsort";
		$adatafieldid[2]		= "buildings_type_cb_int";
		$adatafieldid[3]		= "buildings_manufac_cb_int";
		$adatafieldid[4]		= "justsort";
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		= 0;
		$adataspecial[1]		= 0;
		$adataspecial[2]		= 0;
		$adataspecial[3]		= 0;
		$adataspecial[4]		= 0;
	// should this column be added to create a totals column at the end of the recods
		$adataputarray[0]		= 0;
		$adataputarray[1]		= 0;
		$adataputarray[2]		= 0;
		$adataputarray[3]		= 0;
		$adataputarray[4]		= 0;
	// what do you want to name the columns
		$aheadername[0]			= "Model Year";
		$aheadername[1]			= "Name";
		$aheadername[2]			= "Type";
		$aheadername[3]			= "Manufacturer";
		$aheadername[4]			= "Archived";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "( mm/dd/yyyy )";
		$ainputcomment[1]		= "( no special charactors )";
		$ainputcomment[2]		= "( select from the list )";
		$ainputcomment[3]		= "( select from the list )";
		$ainputcomment[4]		= "Check if this building has been removed as part of the airport";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "TEXT";
		$ainputtype[1]			= "TEXT";
		$ainputtype[2]			= "SELECT";
		$ainputtype[3]			= "SELECT";
		$ainputtype[4]			= "CHECKBOX";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "";
		$adataselect[2]			= "Buildingtypescombobox";
		$adataselect[3]			= "organizationcombobox";
		$adataselect[4]			= "";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";
		
// Build Standard Programming Blocks
	include("includes/block_form.php");	