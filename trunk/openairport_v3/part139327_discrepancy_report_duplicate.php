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
//	Name of Document		:	part139327_discrepancy_report_duplicate.php
//
//	Purpose of Page			:	Enter new Part 139.327 Discrepancy
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

		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
	
if (!isset($_POST["formsubmit"])) {

// This is a FUNCTION LOADED FROM THE TEMPLATE BROWSER
//		Anytime a window is openned from the template browser the following should be loaded into the FORM
//----------------------------------------------------------------------------------------------\\
			$bstart_date 	= $_GET['startdate'];												// The 'TB' Start Date 	(nonSQL)
			$bend_date 		= $_GET['enddate'];													// The 'TB' End Date 	(nonSQL)

//	Start Form Set Variables
	
	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "edittable";													// HTML Name for Form
			$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= "";															// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget
	
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= "Mark Discrepancy as Duplicate";								// Name of the FORM, shown to the user
			$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
			$subtitle 			= "Use this form to mark a discrepancy as a duplicate";			// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 1;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= 'display_discrepancy_summary';						// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= 0;													// See Summary Function for how to use this number
				$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
					
		include("includes/_template/_tp_blockform_form_header.binc.php");
		
	// FORM ELEMENTS
	//-----------------------------------------------------------------------------------------\\	
	//
	//				Field Name			Field Text Name				Field Comment						Field Notes												Field Format		Field Type	Field Width		Field Height	Default Value			Field Function		
	form_new_control("disdate"			,"Date"				, "Enter the date this discrepancy was marked as a duplicate"	,"The current date has automatically been provided!"			,"(mm/dd/yyyy)"								,1,10,0,"current",0);
	form_new_control("distime"			,"Time"				, "Enter the time this discrepancy was marked as a duplicate"	,"The current time has automatically been provided!"			,"(hh:mm:ss) - 24 hours"					,1,10,0,"current",0);
	form_new_control("disauthor"		,"Entry By"			, "Who found and reported this discrepancy"						,"Your name has automatically been provided!"					,"(cannot be changed)"						,3,50,0,$_SESSION['user_id'],"systemusercombobox");
	form_new_control("discomments"		,"Comments"			, "Enter how you KNOW this is a duplicate"						,"Do not use any special characters!"							,""											,2,35,4,"",0);
	form_new_control("disduplicateof"	,"Duplicate of"		, "Select the discrepancy this is a duplicate of"				,""																,"(select a discrepancy from the list)"		,3,50,0,"all","discrepancycombobox");
	form_new_control("disduplicate"		,"Mark Duplicate"	, "Checking this box will mark the discrepancy as a duplicate"	,"Only do this if you are sure the discrepancy is a duplicate"	,"(checked = duplicate)"					,5,35,4,"current",0);
	//
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 1;															// 1: Display Submit Button,	0: No
				$submitbuttonname	= 'Save Duplicate Report';										// Name of the Submit Button
			$display_close			= 1;															// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;															// 1: Display Push Down Button, 0: No
			$display_refresh		= 0;															// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");
	
	
		}
	else {
	
	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "edittable";													// HTML Name for Form
			$formaction			= '';															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= '';															// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget
	
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= "Mark Discrepancy as Duplicate - Summary Report";				// Name of the FORM, shown to the user
			$form_subh			= "Here is the information you entered";						// Sub Name of the FORM, shown to the user
			$subtitle 			= "Here is the information about the selected Duplicate Report";// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= '';													// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= 0;													// See Summary Function for how to use this number
				$returnHTML				= 0;													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
					
		include("includes/_template/_tp_blockform_form_header.binc.php");		
	
	// Load Form Elements	
	// Place Default values from the POST Here or enter 'post'-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\
	//																																																																												|
	//		Put a '0' here if you do not want to display the form field and only the result-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\								|
	//																																																																				 v								v		
	form_new_control("disdate"			,"Date"				, "Enter the date this discrepancy was marked as a duplicate"	,"The current date has automatically been provided!"			,"(mm/dd/yyyy)"								,1,0,0,'post',0);
	form_new_control("distime"			,"Time"				, "Enter the time this discrepancy was marked as a duplicate"	,"The current time has automatically been provided!"			,"(hh:mm:ss) - 24 hours"					,1,0,0,'post',0);
	form_new_control("disauthor"		,"Entry By"			, "Who found and reported this discrepancy"						,"Your name has automatically been provided!"					,"(cannot be changed)"						,3,0,0,'post',"systemusercombobox");
	form_new_control("discomments"		,"Comments"			, "Enter how you KNOW this is a duplicate"						,"Do not use any special characters!"							,""											,2,0,4,'post',0);
	form_new_control("disduplicateof"	,"Duplicate of"		, "Select the discrepancy this is a duplicate of"				,""																,"(select a discrepancy from the list)"		,3,0,0,'post',"discrepancycombobox");
	form_new_control("disduplicate"		,"Mark Duplicate"	, "Checking this box will mark the discrepancy as a duplicate"	,"Only do this if you are sure the discrepancy is a duplicate"	,"(checked = duplicate)"					,5,0,4,'post',0);
	//
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 0;														// 1: Display Submit Button,	0: No
				$submitbuttonname	= '';														// Name of the Submit Button
			$display_close			= 1;														// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
			$display_refresh		= 1;														// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");		
	
	// Do SQL Work
	
		$sqldate		= AmerDate2SqlDateTime($_POST['disdate']);
		
		$sql = "INSERT INTO tbl_139_327_sub_d_d (discrepancy_duplicate_inspection_id, discrepancy_duplicate_by_cb_int, discrepancy_duplicate_reason, discrepancy_duplicate_date, discrepancy_duplicate_time, discrepancy_duplicate_yn, discrepancy_duplicate_number)
		VALUES ( '".$_POST['recordid']."', '".$_POST['disauthor']."', '".$_POST['discomments']."', '".$sqldate."', '".$_POST['distime']."', '".$_POST['disduplicate']."', '".$_POST['disduplicateof']."' )";
		
		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
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
						}					

		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor	= $_SESSION["user_id"];
		$dutylogevent	= "Discrepancy ID ".$_POST['recordid']." was marked as duplicate.";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
		
	}
		
include("includes/_userinterface/_ui_footer.inc.php");		// include file that gets information from form POSTs for navigational purposes
?>	