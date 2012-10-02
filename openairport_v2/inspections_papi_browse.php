<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Vehicle Types Browse.php			The purpose of this page is to list the different types of Vehicles
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load include files
	
		include("includes/header.php");															// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
	
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//	THE CONTAIN CONTENTS IS THE SAME FORMAT FOR ALL BROWSE DOCUMENTS, ALTHOUGH THE DATA MAY BE DIFFERENT
	// 	vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		$displayrow					= 1;												// NO NEED TO CHANGE THIS VALUE.
		$tbldatesort 				= 1;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbltextsort 				= 1;												// 1: Allow User to Sort Records by Text; 		0: Prevent User from sorting records by Text.
		$tblheadersort				= 1;												// 1: Allow User to Sort Records by Header; 	0: Prevent User from sorting records by Header.
		$tbldisplaytotal			= 0;												// 1: Add the value of given columns together;	0: Do not add given columns together.
		$tblduplicatesort			= 0;												// 1: Default to Show DUPLICATE Records;		0: Default to NOT show DUPLICATE Recrords. 
		$tblarchivedsort			= 0;												// 1: Default to Show ARCHIVED Records; 		0: Default to NOT show ARCHIVED Recrords.
		$tblclosedsort				= 0;												// 1: Default to Show CLOSED Records; 			0: Default to NOT show CLOSED Recrords
		$runpreflights				= 1;												// 1: Run Preflight Information; 				0: Do not run preflight information.
		$function_duplicatesort		= 'preflight_tbl_leases_main_a_yn';					// The Name of the function to call to sort out DUPLICATE Records.
		$function_archivedsort		= 'preflight_tbl_leases_main_a_yn';					// The Name of the function to call to sort out ARCHIEVED Records.
		$function_closedsort		= 'preflight_tbl_leases_main_c_yn';					// The Name of the function to call to sort out CLOSED Records.
		$tblfrmoptions_calendar		= 0;												// Allows the User to Display the Records in a calendar format.
		$tblfrmoptions_printout		= 0;												// Allows the User to create a report showing all of the records in a printer friendly format.
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
		$tblkeyfield			= "papi_id";														// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "papi_date";														// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_inspections_papi_main";										// What table  is that field part of ?
		$tbltextsortfield		= "papi_remarks";													// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_inspections_papi_main";										// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "papi_archived_yn";												// What is the name of the field used to mark the record archived ?
		$tblname				= "PAPI Inspections Summary Report";								// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "Here is the information you selected";							// What is the subname of the table ? (used on edit/summary/printer report pages)

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
		$adatafield[0]			= "papi_date";
		$adatafield[1]			= "papi_time";
		$adatafield[2]			= "papi_inspected_by_cb_int";
		$adatafield[3]			= "papi_papi_id_cb_int";
		$adatafield[4]			= "papi_paint_c_int";
		$adatafield[5]			= "papi_ground_c_int";
		$adatafield[6]			= "papi_initial_angle";
		$adatafield[7]			= "papi_proper_angle";
		$adatafield[8]			= "papi_corrected_angle";
		$adatafield[9]			= "papi_remarks";
		$adatafield[10]			= "papi_archived_yn";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_inspections_papi_main";
		$adatafieldtable[1]		= "tbl_inspections_papi_main";	
		$adatafieldtable[2]		= "tbl_inspections_papi_main";	
		$adatafieldtable[3]		= "tbl_inspections_papi_main";	
		$adatafieldtable[4]		= "tbl_inspections_papi_main";	
		$adatafieldtable[5]		= "tbl_inspections_papi_main";	
		$adatafieldtable[6]		= "tbl_inspections_papi_main";	
		$adatafieldtable[7]		= "tbl_inspections_papi_main";
		$adatafieldtable[8]		= "tbl_inspections_papi_main";
		$adatafieldtable[9]		= "tbl_inspections_papi_main";
		$adatafieldtable[10]		= "tbl_inspections_papi_main";	
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "justsort";
		$adatafieldid[1]		= "justsort";
		$adatafieldid[2]		= "papi_inspected_by_cb_int";
		$adatafieldid[3]		= "papi_papi_id_cb_int";		
		$adatafieldid[4]		= "papi_paint_c_int";
		$adatafieldid[5]		= "papi_ground_c_int";
		$adatafieldid[6]		= "justsort";
		$adatafieldid[7]		= "justsort";
		$adatafieldid[8]		= "justsort";
		$adatafieldid[9]		= "justsort";
		$adatafieldid[10]		= "justsort";
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
		$adataspecial[10]		= 0;
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
		$adataputarray[10]		= 0;
	// what do you want to name the columns
		$aheadername[0]			= "Date";
		$aheadername[1]			= "Time";
		$aheadername[2]			= "Entry by";
		$aheadername[3]			= "PAPI";		
		$aheadername[4]			= "Paint Condition";
		$aheadername[5]			= "Ground Condition";
		$aheadername[6]			= "Initial Angle";
		$aheadername[7]			= "Proper Angle";
		$aheadername[8]			= "Corrected Angle";
		$aheadername[9]			= "Remarks";
		$aheadername[10]		= "Archived";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "Please enter the date of the inspection";
		$ainputcomment[1]		= "Please enter the time of the inspection";
		$ainputcomment[2]		= "Please select who entered the inspection";
		$ainputcomment[3]		= "Please select the PAPI from the list to the right";
		$ainputcomment[4]		= "Please select a condition of the paint on the PAPI";
		$ainputcomment[5]		= "Please select a condition of the grounds around the PAPI";
		$ainputcomment[6]		= "Please enter the amount of degree the PAPI was found at";
		$ainputcomment[7]		= "Please enter the amount of degrees that the PAPI should be";
		$ainputcomment[8]		= "Please enter the amount of degrees that you had to correct the PAPI by";
		$ainputcomment[9]		= "Please enter any details about the inspection that are not provided above";
		$ainputcomment[10]		= "Please mark is this papi inspection should be archived.<br><br><br>If you want to archive this inspection, please check the checkbox";
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
		$ainputtype[7]			= "TEXT";
		$ainputtype[8]			= "TEXT";
		$ainputtype[9]			= "TEXTAREA";
		$ainputtype[10]			= "CHECKBOX";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "";
		$adataselect[2]			= "systemusercombobox";
		$adataselect[3]			= "equipment_combobox";
		$adataselect[4]			= "gs_conditions";
		$adataselect[5]			= "gs_conditions";
		$adataselect[6]			= "";
		$adataselect[7]			= "";
		$adataselect[8]			= "";
		$adataselect[9]			= "";
		$adataselect[10]		= "";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";
		
// Build Standard Programming Blocks
	//fixleasework();
	conductautoleasework();
	include("includes/block_form.php");