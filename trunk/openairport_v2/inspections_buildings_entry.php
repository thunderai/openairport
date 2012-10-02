<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Inspection - Buildings - Entry.php		The purpose of this page is conduct Building Inspections
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		include("includes/header.php");															// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		
	// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);

	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "inspection_id";													// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "inspection_date";													// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_inspections_buildings_main";										// What table  is that field part of ?
		$tbltextsortfield		= "";																// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_inspections_buildings_main";										// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "inspection_archived_yn";												// What is the name of the field used to mark the record archived ?
		$tblname				= "Building Inspections Summary Report";									// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname			= "Here is the information you selected";									// What is the subname of the table ? (used on edit/summary/printer report pages)

	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 			= "edit_record_general.php";
		// $functionsummarypage 		= "summary_report_general.php";
		// $functionprinterpage 		= "printer_report_general.php";
		$functioneditpage 		= "edit_record_general.php";									// Name of page used to edit the record
		$functionsummarypage 		= "summary_report_general.php";									// Name of page used to display a summary of the record
		$functionprinterpage 		= "printer_report_general.php";									// Name of page used to display a printer friendly report

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "inspection_date";
		$adatafield[1]			= "inspection_time";
		$adatafield[2]			= "inspection_inspected_by_cb_int";
		$adatafield[3]			= "inspection_buildingid_cb_int";
		$adatafield[4]			= "inspection_chki_1";
		$adatafield[5]			= "inspection_chki_2";
		$adatafield[6]			= "inspection_chki_3";
		$adatafield[7]			= "inspection_chki_4";
		$adatafield[8]			= "inspection_chki_5";
		$adatafield[9]			= "inspection_chki_6";
		$adatafield[10]			= "inspection_chki_7";
		$adatafield[11]			= "inspection_chki_8";
		$adatafield[12]			= "inspection_chki_9";
		$adatafield[13]			= "inspection_chki_10";
		$adatafield[14]			= "inspection_chki_11";
		$adatafield[15]			= "inspection_chki_12";
		$adatafield[16]			= "inspection_chki_13";
		$adatafield[17]			= "inspection_chki_14";
		$adatafield[18]			= "inspection_chki_15";
		$adatafield[19]			= "inspection_chki_16";
		$adatafield[20]			= "inspection_chki_17";
		$adatafield[21]			= "inspection_chki_18";
		$adatafield[22]			= "inspection_chki_19";
		$adatafield[23]			= "inspection_chki_20";
		$adatafield[24]			= "inspection_chki_21";
		$adatafield[25]			= "inspection_chki_22";
		$adatafield[26]			= "inspection_chki_23";
		$adatafield[27]			= "inspection_chki_24";
		$adatafield[28]			= "inspection_chki_25";
		$adatafield[29]			= "inspection_chki_26";
		$adatafield[30]			= "inspection_chki_27";
		$adatafield[31]			= "inspection_chki_28";
		$adatafield[32]			= "inspection_chki_29";
		$adatafield[33]			= "inspection_chki_30";
		$adatafield[34]			= "inspection_chki_31";
		$adatafield[35]			= "inspection_chki_32";
		$adatafield[36]			= "inspection_chki_33";
		$adatafield[37]			= "inspection_chki_34";
		$adatafield[38]			= "inspection_chki_35";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_inspections_buildings_main";
		$adatafieldtable[1]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[2]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[3]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[4]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[5]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[6]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[7]		= "tbl_inspections_buildings_main";
		$adatafieldtable[8]		= "tbl_inspections_buildings_main";
		$adatafieldtable[9]		= "tbl_inspections_buildings_main";
		$adatafieldtable[10]		= "tbl_inspections_buildings_main";
		$adatafieldtable[11]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[12]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[13]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[14]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[15]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[16]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[17]		= "tbl_inspections_buildings_main";
		$adatafieldtable[18]		= "tbl_inspections_buildings_main";
		$adatafieldtable[19]		= "tbl_inspections_buildings_main";
		$adatafieldtable[20]		= "tbl_inspections_buildings_main";
		$adatafieldtable[21]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[22]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[23]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[24]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[25]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[26]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[27]		= "tbl_inspections_buildings_main";
		$adatafieldtable[28]		= "tbl_inspections_buildings_main";
		$adatafieldtable[29]		= "tbl_inspections_buildings_main";
		$adatafieldtable[30]		= "tbl_inspections_buildings_main";
		$adatafieldtable[31]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[32]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[33]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[34]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[35]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[36]		= "tbl_inspections_buildings_main";	
		$adatafieldtable[37]		= "tbl_inspections_buildings_main";
		$adatafieldtable[38]		= "tbl_inspections_buildings_main";
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "justsort";
		$adatafieldid[1]		= "justsort";
		$adatafieldid[2]		= "inspection_inspected_by_cb_int";
		$adatafieldid[3]		= "inspection_buildingid_cb_int";		
		$adatafieldid[4]		= "justsort";
		$adatafieldid[5]		= "justsort";
		$adatafieldid[6]		= "justsort";
		$adatafieldid[7]		= "justsort";
		$adatafieldid[8]		= "justsort";
		$adatafieldid[9]		= "justsort";
		$adatafieldid[10]		= "justsort";
		$adatafieldid[11]		= "justsort";
		$adatafieldid[12]		= "justsort";
		$adatafieldid[13]		= "justsort";		
		$adatafieldid[14]		= "justsort";
		$adatafieldid[15]		= "justsort";
		$adatafieldid[16]		= "justsort";
		$adatafieldid[17]		= "justsort";
		$adatafieldid[18]		= "justsort";
		$adatafieldid[19]		= "justsort";
		$adatafieldid[20]		= "justsort";
		$adatafieldid[21]		= "justsort";
		$adatafieldid[22]		= "justsort";
		$adatafieldid[23]		= "justsort";		
		$adatafieldid[24]		= "justsort";
		$adatafieldid[25]		= "justsort";
		$adatafieldid[26]		= "justsort";
		$adatafieldid[27]		= "justsort";
		$adatafieldid[28]		= "justsort";
		$adatafieldid[29]		= "justsort";
		$adatafieldid[30]		= "justsort";
		$adatafieldid[31]		= "justsort";
		$adatafieldid[32]		= "justsort";
		$adatafieldid[33]		= "justsort";		
		$adatafieldid[34]		= "justsort";
		$adatafieldid[35]		= "justsort";
		$adatafieldid[36]		= "justsort";
		$adatafieldid[37]		= "justsort";
		$adatafieldid[38]		= "justsort";
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
		$adataspecial[11]		= 0;
		$adataspecial[12]		= 0;
		$adataspecial[13]		= 0;
		$adataspecial[14]		= 0;
		$adataspecial[15]		= 0;
		$adataspecial[16]		= 0;
		$adataspecial[17]		= 0;
		$adataspecial[18]		= 0;
		$adataspecial[19]		= 0;
		$adataspecial[20]		= 0;
		$adataspecial[21]		= 0;
		$adataspecial[22]		= 0;
		$adataspecial[23]		= 0;
		$adataspecial[24]		= 0;
		$adataspecial[25]		= 0;
		$adataspecial[26]		= 0;
		$adataspecial[27]		= 0;
		$adataspecial[28]		= 0;
		$adataspecial[29]		= 0;
		$adataspecial[30]		= 0;
		$adataspecial[31]		= 0;
		$adataspecial[32]		= 0;
		$adataspecial[33]		= 0;
		$adataspecial[34]		= 0;
		$adataspecial[35]		= 0;
		$adataspecial[36]		= 0;
		$adataspecial[37]		= 0;
		$adataspecial[38]		= 0;
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
		$adataputarray[11]		= 0;
		$adataputarray[12]		= 0;
		$adataputarray[13]		= 0;
		$adataputarray[14]		= 0;
		$adataputarray[15]		= 0;
		$adataputarray[16]		= 0;
		$adataputarray[17]		= 0;
		$adataputarray[18]		= 0;
		$adataputarray[19]		= 0;
		$adataputarray[20]		= 0;
		$adataputarray[21]		= 0;
		$adataputarray[22]		= 0;
		$adataputarray[23]		= 0;
		$adataputarray[24]		= 0;
		$adataputarray[25]		= 0;
		$adataputarray[26]		= 0;
		$adataputarray[27]		= 0;
		$adataputarray[28]		= 0;
		$adataputarray[29]		= 0;
		$adataputarray[30]		= 0;
		$adataputarray[31]		= 0;
		$adataputarray[32]		= 0;
		$adataputarray[33]		= 0;
		$adataputarray[34]		= 0;
		$adataputarray[35]		= 0;
		$adataputarray[36]		= 0;
		$adataputarray[37]		= 0;
		$adataputarray[38]		= 0;
	// what do you want to name the columns
		$aheadername[0]				= "Date";
		$aheadername[1]				= "Time";
		$aheadername[2]				= "Entry by";
		$aheadername[3]				= "Building";		
		$aheadername[4]				= "Clean Work Area";
		$aheadername[5]				= "Exit Signs Posted and Unobstructed";
		$aheadername[6]				= "Guardrails and Stairways in Good Conditions";
		$aheadername[7]				= "First Aid Kits Available";
		$aheadername[8]				= "Check Emergency Lighting";
		$aheadername[9]				= "No Smoking Signs Posted";
		$aheadername[10]			= "Fire Extinguishers Inspected";
		$aheadername[11]			= "Fire Extinguishers Charged";
		$aheadername[12]			= "Metal Container for Oily Rags";
		$aheadername[13]			= "Approved Liguid Storage Checked";		
		$aheadername[14]			= "Hazardous Containers Labeled";
		$aheadername[15]			= "Extension Cords Checked for Condition";
		$aheadername[16]			= "Electrical Boxed Marked High Voltage";
		$aheadername[17]			= "LockOut Tage Out Avilable";
		$aheadername[18]			= "Department Safety manual on Hand";
		$aheadername[19]			= "MSDS Sheets Available";
		$aheadername[20]			= "Right to Know Posted";
		$aheadername[21]			= "First Report of Injury Sheets Available";
		$aheadername[22]			= "Confied Space Entry Forms Available";
		$aheadername[23]			= "Monthly Safety Meeting Conducted";		
		$aheadername[24]			= "Eye Protection Available";
		$aheadername[25]			= "Hearing Protection Available";
		$aheadername[26]			= "Protective Clothing Available";
		$aheadername[27]			= "Protective Equipment in Good Condition";
		$aheadername[28]			= "Barricades and Cones Available";
		$aheadername[29]			= "Barricades and Cones in Good Condition";
		$aheadername[30]			= "Hand Tools in Proper Operating Condition";
		$aheadername[31]			= "Power Tools in Proper Operating Condition";
		$aheadername[32]			= "Safety Guards in Place";
		$aheadername[33]			= "Ladders in Good Condition";		
		$aheadername[34]			= "Chains in Good Condition";
		$aheadername[35]			= "Air Hoses in Good Condition";
		$aheadername[36]			= "Grinder Wheel in Proper Operating Condition";
		$aheadername[37]			= "Chain Hoists in Proper Operating Condition";
		$aheadername[38]			= "Side Walks in Good Condition";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "Please enter the date of the inspection";
		$ainputcomment[1]		= "Please enter the time of the inspection";
		$ainputcomment[2]		= "Please select who entered the inspection";
		$ainputcomment[3]		= "Please select the building from the list to the right";
		$ainputcomment[4]		= "";
		$ainputcomment[5]		= "";
		$ainputcomment[6]		= "";
		$ainputcomment[7]		= "";
		$ainputcomment[8]		= "";
		$ainputcomment[9]		= "";
		$ainputcomment[10]		= "";
		$ainputcomment[11]		= "";
		$ainputcomment[12]		= "";
		$ainputcomment[13]		= "";
		$ainputcomment[14]		= "";
		$ainputcomment[15]		= "";
		$ainputcomment[16]		= "";
		$ainputcomment[17]		= "";
		$ainputcomment[18]		= "";
		$ainputcomment[19]		= "";
		$ainputcomment[20]		= "";
		$ainputcomment[21]		= "";
		$ainputcomment[22]		= "";
		$ainputcomment[23]		= "";
		$ainputcomment[24]		= "";
		$ainputcomment[25]		= "";
		$ainputcomment[26]		= "";
		$ainputcomment[27]		= "";
		$ainputcomment[28]		= "";
		$ainputcomment[29]		= "";
		$ainputcomment[30]		= "";
		$ainputcomment[31]		= "";
		$ainputcomment[32]		= "";
		$ainputcomment[33]		= "";
		$ainputcomment[34]		= "";
		$ainputcomment[35]		= "";
		$ainputcomment[36]		= "";
		$ainputcomment[37]		= "";
		$ainputcomment[38]		= "";
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
		$ainputtype[9]			= "TEXT";
		$ainputtype[10]			= "TEXT";
		$ainputtype[11]			= "TEXT";
		$ainputtype[12]			= "TEXT";
		$ainputtype[13]			= "TEXT";
		$ainputtype[14]			= "TEXT";
		$ainputtype[15]			= "TEXT";
		$ainputtype[16]			= "TEXT";
		$ainputtype[17]			= "TEXT";
		$ainputtype[18]			= "TEXT";
		$ainputtype[19]			= "TEXT";
		$ainputtype[20]			= "TEXT";
		$ainputtype[21]			= "TEXT";
		$ainputtype[22]			= "TEXT";
		$ainputtype[23]			= "TEXT";
		$ainputtype[24]			= "TEXT";
		$ainputtype[25]			= "TEXT";
		$ainputtype[26]			= "TEXT";
		$ainputtype[27]			= "TEXT";
		$ainputtype[28]			= "TEXT";
		$ainputtype[29]			= "TEXT";
		$ainputtype[30]			= "TEXT";
		$ainputtype[31]			= "TEXT";
		$ainputtype[32]			= "TEXT";
		$ainputtype[33]			= "TEXT";
		$ainputtype[34]			= "TEXT";
		$ainputtype[35]			= "TEXT";
		$ainputtype[36]			= "TEXT";
		$ainputtype[37]			= "TEXT";
		$ainputtype[38]			= "TEXT";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "";
		$adataselect[2]			= "systemusercombobox";
		$adataselect[3]			= "inventoryvuildingscombobox";
		$adataselect[4]			= "";
		$adataselect[5]			= "";
		$adataselect[6]			= "";
		$adataselect[7]			= "";
		$adataselect[8]			= "";
		$adataselect[9]			= "";
		$adataselect[10]			= "";
		$adataselect[11]			= "";
		$adataselect[12]			= "";
		$adataselect[13]			= "";
		$adataselect[14]			= "";
		$adataselect[15]			= "";
		$adataselect[16]			= "";
		$adataselect[17]			= "";
		$adataselect[18]			= "";
		$adataselect[19]			= "";
		$adataselect[20]			= "";
		$adataselect[21]			= "";
		$adataselect[22]			= "";
		$adataselect[23]			= "";
		$adataselect[24]			= "";
		$adataselect[25]			= "";
		$adataselect[26]			= "";
		$adataselect[27]			= "";
		$adataselect[28]			= "";
		$adataselect[29]			= "";
		$adataselect[30]			= "";
		$adataselect[31]			= "";
		$adataselect[32]			= "";
		$adataselect[33]			= "";
		$adataselect[34]			= "";
		$adataselect[35]			= "";
		$adataselect[36]			= "";
		$adataselect[37]			= "";
		$adataselect[38]			= "";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";
		
	// For debugging purposes print out the SQL Statement
		//echo $sql;																				// When dedugging you can uncomment this echo and see the sql statement

	// Start the Real Fun	

		$i 						= 0;															// just in case we want the i variable to be defined before we use it
		$uisize 				= "60";															//just in case we dont define it latter, set a default here.

//-------------------- [ THERE SHOULD BE NO NEED TO CHANGE ANY OF THE CODE BELOW THIS LINE ] ----------------------------------------------------------------------------------------------------------------------

	// store this array into a serialized array
		$stradatafield 			= urlencode(serialize($adatafield));			// dont touch
		$stradatafieldtable 		= urlencode(serialize($adatafieldtable));		// dont touch
		$stradatafieldid 		= urlencode(serialize($adatafieldid));			// dont touch	
		$stradataspecial			= urlencode(serialize($adataspecial));			// dont touch
		$straheadername			= urlencode(serialize($aheadername));			// dont touch
		$strainputtype			= urlencode(serialize($ainputtype));			// dont touch
		$strainputcomment		= urlencode(serialize($ainputcomment));			// dont touch
		$stradataselect			= urlencode(serialize($adataselect));			// dont touch
		
	// store this array into a serialized array
		$sadatafield 			= (serialize($adatafield));						// dont touch
		$sadatafieldtable 		= (serialize($adatafieldtable));				// dont touch
		$sadatafieldid 			= (serialize($adatafieldid));					// dont touch	
		$sadataspecial			= (serialize($adataspecial));					// dont touch
		$saheadername			= (serialize($aheadername));					// dont touch
		$sainputtype			= (serialize($ainputtype));						// dont touch
		$sainputcomment			= (serialize($ainputcomment));					// dont touch
		$sadataselect			= (serialize($adataselect));					// dont touch
		
		$sadatafield  			= str_replace("\"","|",$sadatafield);
		$sadatafieldtable 		= str_replace("\"","|",$sadatafieldtable);
		$sadatafieldid 			= str_replace("\"","|",$sadatafieldid);
		$sadataspecial 			= str_replace("\"","|",$sadataspecial);
		$saheadername 			= str_replace("\"","|",$saheadername);
		$sainputtype 			= str_replace("\"","|",$sainputtype);
		$sainputcomment			= str_replace("\"","|",$sainputcomment);
		$sadataselect 			= str_replace("\"","|",$sadataselect);

if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		?>
						<form action="<?=$_SERVER["PHP_SELF"];?>" method="post" name="edittable" id="edittable">
							<input class="commonfieldbox" type="hidden" name="formsubmit" size="1" value="1" >
							<input type="hidden" name="menuitemid" value="<?=$_POST['menuitemid'];?>">
							<input type="hidden" name="editpage" 			value="<?=$functioneditpage;?>">
							<input type="hidden" name="summarypage" 		value="<?=$functionsummarypage;?>">
							<input type="hidden" name="printerpage" 		value="<?=$functionprinterpage;?>">
							<input type="hidden" name="menuitemid" 			value="<?=$strmenuitemid?>">
							<input type="hidden" name="aheadername" 		value="<?=$saheadername;?>">
							<input type="hidden" name="adatafield" 			value="<?=$sadatafield;?>">
							<input type="hidden" name="adatafieldtable" 	value="<?=$sadatafieldtable;?>">
							<input type="hidden" name="adatafieldid" 		value="<?=$sadatafieldid;?>">
							<input type="hidden" name="adataspecial" 		value="<?=$sadataspecial;?>">
							<input type="hidden" name="ainputtype" 			value="<?=$sainputtype;?>">
							<input type="hidden" name="ainputcomment" 		value="<?=$sainputcomment;?>">
							<input type="hidden" name="adataselect" 		value="<?=$sadataselect;?>">
							<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
							<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
							<input type="hidden" name="tblkeyfield" 		value="<?=$tblkeyfield;?>">
							<input type="hidden" name="tblarchivedfield" 	value="<?=$tblarchivedfield;?>">
							<input type="hidden" name="tbldatesortfield" 	value="<?=$tbldatesortfield;?>">
							<input type="hidden" name="tbldatesorttable" 	value="<?=$tbldatesorttable;?>">
							<input type="hidden" name="tbltextsortfield" 	value="<?=$tbltextsortfield;?>">
							<input type="hidden" name="tbltextsorttable" 	value="<?=$tbltextsorttable;?>">
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									<?
									getnameofmenuitemid($strmenuitemid, "long", 4, "#FFFFFF",$_SESSION['user_id']);
									?>
									</td>
								<td class="tableheaderright">
									(
									<?
									getpurposeofmenuitemid($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
									?>
									)
									</td>
								</tr>
							<tr>
								<td colspan="3" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
										<tr>
											<td colspan="2" class="formoptionsavilabletop">
												Please complete the form below in as much detail as possible, and please pay close attention to syntax.
												</td>
											</tr>
		<? 
		for ($i=0; $i<count($aheadername); $i=$i+1) {
				?>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('<?=$ainputcomment[$i];?>')"; onMouseout="hideddrivetip()">
				<? 
				switch ($adataspecial[$i]) {
						case 2:
						?>
												@ <?=$aheadername[$i];?>
						<? 
								break;
						case 4:
						?>
												$ <?=$aheadername[$i];?>
						<? 
								break;
						case 5:
						?>
												<?=$aheadername[$i];?> %
						<? 
								break;
						default:
						?>
												<?=$aheadername[$i];?>
						<? 
								break;
					}
				?>
												</td>
											<td class="formanswers">
				<?
				switch ($ainputtype[$i]) {
				
						case "TEXT":	// if the user entered "TEXT' as the input type make a ttext area box
								switch ($aheadername[$i]) {						
										case "Date":
												$tmpvalue 	= date('m/d/Y');
												$uisize		= "10";
												break;								
										case "Time":
												$tmpvalue 	= date("H:i:s");
												$uisize		= "10";
												break;
										default:
												$tmpvalue		= "Inspected: Everything Checks OK";
												$uisize		= 60;
												break;
									}
						?>					
												<input class="Commonfieldbox" type="text" name="<?=$adatafield[$i];?>" size="<?=$uisize;?>" value="<?=$tmpvalue;?>">
						<?
								break;
							
						case "TEXTAREA":	// if the user entered "TEXTAREA" as the input type make a text area box
						?>
												<TEXTAREA class="Commonfieldbox" name="<?=$adatafield[$i];?>" rows="10" cols="60"></TEXTAREA>
						<?	
								break;
							
						case "SELECT":	// if user entered "SELECT" as the input type make a select box
								// Load the specified function
								switch ($aheadername[$i]) {	
										case "Entry by":
												$adataselect[$i]($_SESSION['user_id'], "all", $adatafield[$i], "show", "");
												break;								
										case "PAPI":
												$adataselect[$i](1, "all", $adatafield[$i], "show", "");
												break;
										default:
												$adataselect[$i]("all", "all", $adatafield[$i], "show", "");
												break;
									}
								break;
						case "CHECKBOX":	// if user entered "CHECKBOX" as the input type make a select box
								?>
												<input class="commonfieldbox" type="checkbox" name="<?=$adatafield[$i];?>" value="1">
								<?
								break;
							
						default:		// if there is an error with the user supplied input type use the 'text' type.
						?>
												<input class="Commonfieldbox" type="text" name="<?=$adatafield[$i];?>" size="10">
						<?
								break;
					}
				?>
												</td>
											</tr>
											
				<? 
				} 
				?>
										<tr>
											<td colspan="2" class="formoptionsavilablebottom">
												<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.edittable.submit()">
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
				<?
		}
	else {
	
	$tblkeyfield			= $_POST['tblkeyfield'];
	$adatafield 			= unserialize(str_replace("|","\"",$_POST['adatafield']));				// Dont Touch
	$adatafieldtable 		= unserialize(str_replace("|","\"",$_POST['adatafieldtable']));			// Dont Touch
	$adatafieldid 			= unserialize(str_replace("|","\"",$_POST['adatafieldid']));			// Dont Touch	
	$adataspecial			= unserialize(str_replace("|","\"",$_POST['adataspecial']));			// Dont Touch
	$aheadername			= unserialize(str_replace("|","\"",$_POST['aheadername']));				// Dont Touch
	$ainputtype				= unserialize(str_replace("|","\"",$_POST['ainputtype']));				// Dont Touch
	$ainputcomment			= unserialize(str_replace("|","\"",$_POST['ainputcomment']));			// Dont Touch
	$adataselect			= unserialize(str_replace("|","\"",$_POST['adataselect']));				// Dont Touch

	$sadatafield			= serialize($adatafield);
	$sadatafield			= str_replace("\"", "|",$sadatafield);
	$sadatafieldtable 		= serialize($adatafieldtable);											// Dont Touch
	$sadatafieldtable 		= str_replace("\"","|",$sadatafieldtable);								// Dont Touch
	$sadatafieldid 			= serialize($adatafieldid);												// Dont Touch	
	$sadatafieldid 			= str_replace("\"","|",$sadatafieldid);									// Dont Touch	
	$sadataspecial			= serialize($adataspecial);												// Dont Touch
	$sadataspecial			= str_replace("\"","|",$sadataspecial);									// Dont Touch
	$saheadername			= serialize($aheadername);												// Dont Touch
	$saheadername			= str_replace("\"","|",$saheadername);									// Dont Touch
	$sainputtype			= serialize($ainputtype);												// Dont Touch
	$sainputtype			= str_replace("\"","|",$sainputtype);									// Dont Touch
	$sainputcomment			= serialize($ainputcomment);											// Dont Touch
	$sainputcomment			= str_replace("\"","|",$sainputcomment);								// Dont Touch
	$sadataselect			= serialize($adataselect);												// Dont Touch
	$sadataselect			= str_replace("\"","|",$sadataselect);									// Dont Touch
				
		// there is something in the post querystring, so this must not be the first time this form is being shown
		
		// Step 1). Load into an array all of the values from the form

		for ($i=0; $i<count($adatafield); $i=$i+1) {
				switch ($aheadername[$i]) {
						case "Date":
								$asubmit[$i]		= AmerDate2SqlDateTime($_POST[$adatafield[$i]]);
								break;
						case "Archived":
								//echo "Archived";
								if (!isset($_POST[$adatafield[$i]])) {
										$asubmit[$i]			= 0;
									}
									else {
										$asubmit[$i]			= 1;
									}
								break;
						default:
								$asubmit[$i]			= $_POST[$adatafield[$i]];
								break;
					}	
		}
		
		// Start to build the Insert SQL Statement
		$sql = "INSERT INTO ".$tbltextsorttable." (";
		
		for ($i=0; $i<count($asubmit); $i=$i+1) {
				$nsql = " ".$adatafield[$i]."";
				$sql = $sql.$nsql;
				if ($i == count($asubmit)-1) {
						$nsql = ")";
						$sql = $sql.$nsql;
					}
					else {
						$nsql = ", ";
						$sql = $sql.$nsql;
					}			
		}
		$nsql = " VALUES (";
		$sql = $sql.$nsql;

		for ($i=0; $i<count($asubmit); $i=$i+1) {
				$nsql = " '".$asubmit[$i]."'";
				$sql = $sql.$nsql;
				if ($i == count($asubmit)-1) {
						$nsql = ")";
						$sql = $sql.$nsql;
					}
					else {
						$nsql = ", ";
						$sql = $sql.$nsql;
					}			
		}
		
		//echo $sql;

		$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid = mysqli_insert_id($mysqli);
						//echo $tmp;
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($mysqli);
						}					
		
		//echo $_POST["formsubmit"];
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor	= $_SESSION["user_id"];
		$dutylogevent	= "New Building Inspection ".$lastid." Was Created";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
		
		// Do email procedures
		$tmpbuilding	= inventoryvuildingscombobox($_POST[$adatafield[3]], "all", "NA", "hide", "");
		$tmpauthor		= systemusercombobox($_POST[$adatafield[2]], "all", "NA", "hide", "");
		
		//$tmp = "tmpbuilding ".inventoryvuildingscombobox($_POST[$adatafield[3]], "all", "NA", "hide", "")." ";
		
		//echo $tmp;
		//echo "tmpbuilding".$tmpbuilding;
		
		$subject	= "Watertown Regional Airport - Building Inspection Completed";
		$emailbody = "A New Building Safety Inspection was conducted on ".$_POST[$adatafield[0]]." at ".$_POST[$adatafield[1]]." \n 
		\n 		
		Building :";
		
		$emailbody = $emailbody.$tmpbuilding." ";
		$emailbody = $emailbody." 
		\n
		Inspection By : ";
		$emailbody = $emailbody.$tmpauthor." ";
		$emailbody = $emailbody." \n 
		\n";
		
		sendreportbyemail("moletzke@watertownsd.us",$subject,$emailbody);

		?>

			<form name="redirect" action="summary_report_general.php" method="POST">
				&nbsp;<input class="combobox" type="hidden" size="1" name="redirect2">
												<input type="hidden" name="editpage" 			value="<?=$functioneditpage;?>">
												<input type="hidden" name="summarypage" 		value="<?=$functionsummarypage;?>">
												<input type="hidden" name="printerpage" 		value="<?=$functionprinterpage;?>">
												<input type="hidden" name="recordid" 			value="<?=$lastid;?>">
												<input type="hidden" name="menuitemid" 			value="<?=$strmenuitemid?>">
												<input type="hidden" name="aheadername" 		value="<?=$saheadername;?>">
												<input type="hidden" name="adatafield" 			value="<?=$sadatafield;?>">
												<input type="hidden" name="adatafieldtable" 	value="<?=$sadatafieldtable;?>">
												<input type="hidden" name="adatafieldid" 		value="<?=$sadatafieldid;?>">
												<input type="hidden" name="adataspecial" 		value="<?=$sadataspecial;?>">
												<input type="hidden" name="ainputtype" 			value="<?=$sainputtype;?>">
												<input type="hidden" name="ainputcomment" 		value="<?=$sainputcomment;?>">
												<input type="hidden" name="adataselect" 		value="<?=$sadataselect;?>">
												<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
												<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
												<input type="hidden" name="tblkeyfield" 		value="<?=$tblkeyfield;?>">
												<input type="hidden" name="tblarchivedfield" 	value="<?=$tblarchivedfield;?>">
												<input type="hidden" name="tbldatesortfield" 	value="<?=$tbldatesortfield;?>">
												<input type="hidden" name="tbldatesorttable" 	value="<?=$tbldatesorttable;?>">
												<input type="hidden" name="tbltextsortfield" 	value="<?=$tbltextsortfield;?>">
												<input type="hidden" name="tbltextsorttable" 	value="<?=$tbltextsorttable;?>">
				</form>

				<script>
				<!--
					var targetURL="summary_report_general.php"
					var countdownfrom=1
					var currentsecond=document.redirect.redirect2.value=countdownfrom+1
					function countredirect(){
						if (currentsecond!=1){
							currentsecond-=1
							document.redirect.redirect2.value=currentsecond
							}
							else{
								document.redirect.submit();
						return
						}
						setTimeout("countredirect()",0)
						}
						countredirect()
				//-->
				</script>
				
							<?
		}
?>
<div id="dhtmltooltip"></div>

<script type="text/javascript">

/***********************************************
* Cool DHTML tooltip script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var offsetxpoint=-60 //Customize x offset of tooltip
var offsetypoint=20 //Customize y offset of tooltip
var ie=document.all
var ns6=document.getElementById && !document.all
var enabletip=false
if (ie||ns6)
var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function ddrivetip(thetext, thecolor, thewidth){
if (ns6||ie){
if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"
if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor
tipobj.innerHTML=thetext
enabletip=true
return false
}
}

function positiontip(e){
if (enabletip){
var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
//Find out how close the mouse is to the corner of the window
var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20
var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20

var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000

//if the horizontal distance isn't enough to accomodate the width of the context menu
if (rightedge<tipobj.offsetWidth)
//move the horizontal position of the menu to the left by it's width
tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"
else if (curX<leftedge)
tipobj.style.left="5px"
else
//position the horizontal position of the menu where the mouse is positioned
tipobj.style.left=curX+offsetxpoint+"px"

//same concept with the vertical position
if (bottomedge<tipobj.offsetHeight)
tipobj.style.top=ie? ietruebody().scrollTop+event.clientY-tipobj.offsetHeight-offsetypoint+"px" : window.pageYOffset+e.clientY-tipobj.offsetHeight-offsetypoint+"px"
else
tipobj.style.top=curY+offsetypoint+"px"
tipobj.style.visibility="visible"
}
}

function hideddrivetip(){
if (ns6||ie){
enabletip=false
tipobj.style.visibility="hidden"
tipobj.style.left="-1000px"
tipobj.style.backgroundColor=''
tipobj.style.width=''
}
}

document.onmousemove=positiontip

</script>
<?
//include("includes/footer.php");		// include file that gets information from form POSTs for navigational purposes
?>
