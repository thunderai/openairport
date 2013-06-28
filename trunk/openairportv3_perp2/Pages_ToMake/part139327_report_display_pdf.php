<?php
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
//	Name of Document	:	part139327_display_new_report.php
//
//	Purpose of Page		:	Display any Part 139.327 Inspection Report
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load global include files
	
		//include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes
		//include("includes/_dateandtime/dateandtime.list.php");
		include("includes/_dateandtime/_dt_amerdate2sqldatetime.inc.php");
		include("includes/_dateandtime/_dt_sqldate2amerdate.inc.php");
		//include("scripts/_scripts_header_iface.inc.php");
		include("includes/_systemusers/systemusers.list.php");
		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_navigation/navigation.list.php");
		include("includes/_template/template.list.php");
		include("includes/_generalsettings/generalsettings.list.php");					// Load GIS Functions

// Define Variables	
		
		$navigation_page 			= 16;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 3;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures	

require('thirdparty/fpdf/fpdf.php');

$pdf = new FPDF('P','pt','A4');
$pdf->AddPage();

if (!isset($_POST["recordid"])) {
		// There is no POST recordid. Did it get a GET instead?
		$recordid = $_GET['recordid'];
	}
	else {
		$recordid = $_POST['recordid'];
	}

	$sql1 = "SELECT * FROM tbl_139_327_main 
	INNER JOIN tbl_139_327_sub_t ON tbl_139_327_sub_t.inspection_type_id = tbl_139_327_main.type_of_inspection_cb_int 
	INNER JOIN tbl_139_327_sub_t_i ON tbl_139_327_sub_t_i.139327_sub_t_id_int = tbl_139_327_sub_t.inspection_type_id 
	WHERE inspection_system_id = '".$recordid."' ";

	$last_main_id	= $recordid;
	
	//make connection to database
	$objconn1 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			
	//echo "SQL Statement is :".$sql1." <br>";
			
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs1 = mysqli_query($objconn1, $sql1);
						
			if ($objrs1) {
					$number_of_rows = mysqli_num_rows($objrs1);
					while ($objarray1 = mysqli_fetch_array($objrs1, MYSQLI_ASSOC)) {	

							$name_of_image_background 	= $objarray1['139327_sub_t_image'];
							$tmpid 						= $objarray1['inspection_system_id'];
							
							//echo "image name".$name_of_image_background;

							//echo $maparray[1][1];
							
$pdf->Image("images/Part_139_327/".$maparray[1][0]."",0,84,0,$maparray[1][2]);
$pdf->Image("images/Part_139_327/".$maparray[2][0]."",0,30,0,$maparray[2][2]);

	// 	txtdisplay:  	Displays this text
	//	bsize:			Do I bold this yext? 					1: BOLD,	0: not bolded
	//	fsize:			What is the font size of this text?		given in HTML size units
	//	hsize:			What is the height of the table?		given in pixels
	//	jsize:			What is the justification of the text?	center,left,right
	//	wpost:			What is the width of the Div layer?		given in pixels
	//	xpost:			where is the div layer to the left?		given in pixels
	//	ypost:			Where is the div layer to the top?		given in pixels
	//	zpost:			Where is the div layer to the screen?	given in HTML units, 1 is LOWER 100 is higher.
	
	$tmp_type 		= part139327typestextfield($objarray1['type_of_inspection_cb_int'], "all", "hide", "hide", "");
	
	$tmpsqldate 	= $objarray1['139327_date'];
	$tmpsqltime		= $objarray1['139327_time'];
	$tmpdate 		= sqldate2amerdate($objarray1['139327_date']);
	
	$tmpstartdate 	= strtotime($tmpdate);
	$astartdate 	= getdate($tmpstartdate);
	$intstartday	= $astartdate ["weekday"];
	
	$tmptime 		= $objarray1['139327_time'];
	$insptimestamp	= $objarray1['139327_timestamp'];
	
	$tmpinspector	= systemusertextfield($objarray1['inspection_completed_by_cb_int'], "all", "all", "hide", "all");
	
	$pdf->SetFont('Arial','B',16);							
	$pdf->Cell(690,0,$objarray1['inspection_system_id']);
	
	$pdf->Output();
	
					}
					
			}
			
		}
	?>