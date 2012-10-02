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
//	Name of Document		:	part139327_discrepancy_report_new.php
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

		include("includes/_modules/part139303/part139303.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		//include("includes/_generalsettings/_gs_gis_settings.inc.php");
		
		
// Define Variables	
		
		$tmp_recordid	= 0;
		
		
//LOAD POSTS, and if no POSTS defined load GETS

if (!isset($_POST["recordid"])) {
		// No Record ID defined in POST, use GET record id
		if (!isset($_GET["recordid"])) {
				// Nothing already defined
			}
			else {
				$tmp_recordid			= $_GET['recordid'];
				$from_get				= 1;
			}
	}
	else {
		$tmp_recordid			= $_POST['recordid'];
		$from_get				= 0;
	}
	
if (!isset($_POST["golive"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_golive				= $_GET['golive'];
	}
	else {
		$tmp_golive				= $_POST['golive'];
	}
	
if (!isset($_POST["checklistid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_checklistid		= $_GET['checklist'];
	}
	else {
		$tmp_checklistid		= $_POST['checklistid'];
	}	

if (!isset($_POST["facilityid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_facilityid			= $_GET['facility'];
	}
	else {
		$tmp_facilityid			= $_POST['facilityid'];
	}
	
if (!isset($_POST["conditionid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_conditionid		= $_GET['condition'];
	}
	else {
		$tmp_conditionid		= $_POST['conditionid'];
	}
	
if (!isset($_POST["conditionname"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_conditionname		= $_GET['conditionname'];
	}
	else {
		$tmp_conditionname		= $_POST['conditionname'];
	}	
	
if (!isset($_POST["inspectiontypeid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_inspectiontypeid	= $_GET['inspectiontypeid'];
	}
	else {
		$tmp_inspectiontypeid	= $_POST['inspectiontypeid'];
	}	

if (!isset($_POST["madbynavaid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_madbynavaid	= $_GET['madbynavaid'];
	}
	else {
		$tmp_madbynavaid	= $_POST['madbynavaid'];
	}	
	
if (!isset($_GET["discrepancyname"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_discrepancyname = '';
	}
	else {
		$tmp_discrepancyname = $_GET["discrepancyname"];
	}	

if (!isset($_GET["discrepancycomm"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_discrepancycomm = '';
	}
	else {
		$tmp_discrepancycomm = $_GET["discrepancycomm"];
	}	

if (!isset($_GET["location"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_locationx = 0;
		$tmp_locationy = 0;
	}
	else {
		$location_s		= $_GET["location"];
		//$alocation_s	= explode('x',$location_s);
		//$tmp_locationx 	= $alocation_s[0];
		//$tmp_locationy 	= $alocation_s[1];	
	}
	

if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		
		// FORM HEADER
		// -----------------------------------------------------------------------------------------\\
				$formname			= "edittable";													// HTML Name for Form
				$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
				$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
					$formtarget		= "";															// HTML Name for the window
					$location		= $formtarget;													// Leave the same as $formtarget
		
		// FORM NAME and Sub Title
		//------------------------------------------------------------------------------------------\\
				$form_menu			= "Add Subject Note";											// Name of the FORM, shown to the user
				$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
				$subtitle 			= "Use this form to add a comment";								// Subt title of the FORM, shown to the user

		// FORM SUMMARY information
		//------------------------------------------------------------------------------------------\\
				$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
					$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
					$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
					$detailtodisplay		= 0;													// See Summary Function for how to use this number
					$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
						
			include("includes/_template/_tp_blockform_form_header.binc.php");			
		
					?>
					<input class="commonfieldbox" type="hidden" name="formsubmit" size="1" value="1" >
					<input type="hidden" name="from_get" 		value="<?php echo $from_get;?>">
					<input type="hidden" name="recordid" 		value="<?php echo $tmp_recordid;?>">
					<input type="hidden" name="golive" 			value="<?php echo $tmp_golive;?>">
					<input type="hidden" name="madbynavaid" 	value="<?php echo $tmp_madbynavaid;?>">
					<input type="hidden" name="conditionid" 	value="<?php echo $tmp_conditionid;?>">
					<input type="hidden" name="facilityid" 		value="<?php echo $tmp_facilityid;?>">
					<input type="hidden" name="checklistid" 	value="<?php echo $tmp_checklistid;?>">
					<?php
		
		form_new_control("disauthor"		,"Entry By"				, "Who entered this note"																,"Your name has automatically been provided!"			,"(cannot be changed)"		,3		,50		,0		,$_SESSION['user_id']	,"systemusercombobox");
		form_new_control("disname"			,"Subject Note Name"	, "Enter a short and concise name for this note"										,"Do not use any special characters!"					,""							,1		,47		,0		,''						,0);
		form_new_control("discomments"		,"Subject Comments"		, "Provide your remarks for this note"													,"Do not use any special characters!"					,""							,2		,35		,4		,''						,0);
		
										
	//
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 1;														// 1: Display Submit Button,	0: No
				$submitbuttonname	= 'Submit';														// Name of the Submit Button
			$display_close			= 1;														// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
			$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");											

		}
	else {
		
		// there is something in the post querystring, so this must not be the first time this form is being shown
		
		// Step 1). Load into an array all of the values from the form

		$sqldate		= AmerDate2SqlDateTime($_POST['disdate']);

		if($_POST['golive'] == 1) {
				//echo "Dicrepancy will be pushed to the live table <br>";
				$tablename_d	= "tbl_139_303_sub_d";
				$warning		= "The note has been pushed live!";
			}
			else {
				//echo "Dicrepancy will be pushed to the temporary table <br>";
				$tablename_d	= "tbl_139_303_sub_d_tmp";
				$warning		= "The following note has been temporarly added to the system and still needs to be linked to the Traing Record";				
			}
		
		// Start to build the Insert SQL Statement
		$sql = "INSERT INTO ".$tablename_d." (discrepancy_checklist_id, discrepancy_inspection_id, discrepancy_by_cb_int, discrepancy_name, discrepancy_remarks ) 
		VALUES ( '".$tmp_conditionid."', '".$_POST['recordid']."', '".$_POST['disauthor']."', '".$_POST['disname']."', '".$_POST['discomments']."' )";

		//echo $sql;

		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		//mysql_insert_id();
				
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			//mysql_insert_id();
				$objrs 		= mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
				$lastid 	= mysqli_insert_id($mysqli);
				$lastid1 	= mysqli_insert_id($mysqli);
				}
				
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor	= $_SESSION["user_id"];
		$dutylogevent	= "Added New Subject Note (Temporary) ID ".$lastid." for Training Record ID ".$tmp_recordid."";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);

		// FORM HEADER
		// -----------------------------------------------------------------------------------------\\
				$formname			= "edittable";													// HTML Name for Form
				$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
				$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
					$formtarget		= "";															// HTML Name for the window
					$location		= $formtarget;													// Leave the same as $formtarget
		
		// FORM NAME and Sub Title
		//------------------------------------------------------------------------------------------\\
				$form_menu			= "Added Subject Note";											// Name of the FORM, shown to the user
				$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
				$subtitle 			= $warning;														// Subt title of the FORM, shown to the user

		// FORM SUMMARY information
		//------------------------------------------------------------------------------------------\\
				$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
					$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
					$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
					$detailtodisplay		= 0;													// See Summary Function for how to use this number
					$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
						
			include("includes/_template/_tp_blockform_form_header.binc.php");			
		
		form_new_control("disauthor"		,"Entry By"				, "Who entered this note"																,"Your name has automatically been provided!"			,"(cannot be changed)"		,3		,0		,0		,$_SESSION['user_id']	,"systemusercombobox");
		form_new_control("disname"			,"Subject Note Name"	, "Enter a short and concise name for this note"										,"Do not use any special characters!"					,""							,1		,0		,0		,$_POST['disname']		,0);
		form_new_control("discomments"		,"Subject Comments"		, "Provide your remarks for this note"													,"Do not use any special characters!"					,""							,2		,0		,4		,$_POST['discomments']	,0);
		
	//
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 0;														// 1: Display Submit Button,	0: No
				$submitbuttonname	= '';														// Name of the Submit Button
			$display_close			= 1;														// 1: Display Close Button, 	0: No
			$display_pushdown		= 1;														// 1: Display Push Down Button, 0: No
				$pushdown_script	= 'call_server_pnsn';
				$pushdown_frmname	= "addeddis";
				$pushdown_otherid	= $_POST['recordid'];
			$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
			
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");											
			

		}

include("includes/_userinterface/_ui_footer.inc.php");		// include file that gets information from form POSTs for navigational purposes
?>	