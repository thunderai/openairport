<?php 
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o		o	ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		oo		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		o o		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o 	o	o	ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  	 o	o	o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	  o	o	o	o	  o		o	o	o		o	o	o   o	  o
//	00000	0		ooooo	o		o	o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document		:	part139327_discrepancy_report_display_mapit_loader.php
//
//	Purpose of Page			:	View Part 139.327 Discrepancy Location(s)
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page

// Load Page Specific Includes

		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// This is a FUNCTION LOADED FROM THE TEMPLATE BROWSER
//		Anytime a window is openned from the template browser the following should be loaded into the FORM
//----------------------------------------------------------------------------------------------\\
			$bstart_date 	= $_GET['startdate'];												// The 'TB' Start Date 	(nonSQL)
			$bend_date 		= $_GET['enddate'];													// The 'TB' End Date 	(nonSQL)

//	Start Form Set Variables
	
	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "edittable";													// HTML Name for Form
			$formaction			= "part139339_c_report_export_makekml.php";		// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 1;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= "Mapit_DiscrepancyLocationChart";								// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget
	
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= "Visual Mu Location Loader";									// Name of the FORM, shown to the user
			$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
			$subtitle 			= "Use this form to view Mu Values in Google Earth";				// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= 0;													// See Summary Function for how to use this number
				$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
					
		include("includes/_template/_tp_blockform_form_header.binc.php");
	// FORM ELEMENTS
	//-----------------------------------------------------------------------------------------\\	
	//
	//				Field Name			Field Text Name				Field Comment						Field Notes												Field Format		Field Type	Field Width		Field Height	Default Value			Field Function		
	form_new_control("frmstartdate"		,"Date"						, "Enter the the date to start from","The current date has automatically been provided!"	,"(mm/dd/yyyy)"		,1			,10				,0				,"current"				,0);
	form_new_control("frmenddate"		,"Date"						, "Enter the the date to end at"	,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"		,1			,10				,0				,"current"				,0);
	form_new_control("discondition"		,"Time Period"				, "Select a Time Period"			,"Select a Time Period from the list provided!"			,""					,3			,50				,0				,"all"					,"part139339typescomboboxwall");
	form_new_control("disfacility"		,"Specific FiCON"			, "Enter Report ID"					,"Enter the record ID of a FiCON!"						,"ID #"				,1			,5				,0				,""						,0);
	//form_new_control("disinspection"	,"From Inspection of Type"	, "Select an Inspection Type"		,"Select an inspection from the list provided!"			,""					,3			,35				,4				,"all"					,"part139327typescomboboxwall");
	form_new_control("disusedates"		,"Average Results"			, "Average Mu Values"				,"Checking this box will use dates and average Mu results per surface for that period. Not checking this box will result in some extreme situations"		,""					,5			,50				,0				,"all"					,0);
	form_new_control("disuse40"			,"Include 40 and more"		, "Include Mu 40 and over?"			,"checking this box will include Mu values of 40 or more, unchecking the box is only include Mus lower than 40."		,""					,5			,50				,0				,"all"					,0);
	form_new_control("disuseblank"		,"Include null"				, "Include Null Mu Values??"		,"checking this box will include Mu values that have no value, unchecking the box is will include Null Mu values in calculations."		,""					,5			,50				,0				,"all"					,0);
		
	form_new_control("disusebrowser"	,"Use Above Settings"		, "Use Broser Settings or override"	,"Checking this box will use the dates above, unchecked will use the dates from the browser form"		,""					,5			,50				,0				,"all"					,0);
	
	//
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 1;														// 1: Display Submit Button,	0: No
				$submitbuttonname	= 'Generate Chart';											// Name of the Submit Button
			$display_close			= 1;														// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
			$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");

include("includes/_userinterface/_ui_footer.inc.php");		// include file that gets information from form POSTs for navigational purposes
?>	