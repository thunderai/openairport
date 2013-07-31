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
//	Name of Document		:	part139333_report_browse.php
//
//	Purpose of Page			:	Browse Part 139.333 NavAid Inspection Records
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes

		include("includes/_modules/part139327/part139327.list.php");

// Now the tricky part. We need to take the facility / Condition and display
//	a select option box that lists all of the equipment types for that category.
//	to do this we will need to convert certain facilities/conditions to their equipment counterpart
//	This can be done easier by associating conditions to equipment types
//	
//

$array_condition_id = array();

// | Condition ID   | Condition Name 				| Facility Name 		| Equipment Type IDs
// | -------------- | ----------------------------- | --------------------- |
//
$array_condition_id[0] = 0;
// 	1				| Pavement Lip Over 3"			| Pavement Areas
$array_condition_id[1] = 0;
//	2				| Hole 5" Diameter 3" Deep		| Pavement Areas
$array_condition_id[2] = 0;
//	3				| Cracks / Spalling / Bumps		| Pavement Areas
$array_condition_id[3] = 0;
//	4				| FOD : Gravel / Debris / Etc.	| Pavement Areas
$array_condition_id[4] = 0;
//	5				| Rubber Deposits				| Pavement Areas
$array_condition_id[5] = 0;
//	6				| Ponding / Edge Dams			| Pavement Areas
$array_condition_id[6] = 0;
//	7				| Ruts / Humps / Erosion		| Safety Areas
$array_condition_id[7] = 0;
//	8				| Drainage / Construction		| Safety Areas
$array_condition_id[8] = 0;
//	9				| Objects / Frangible Bases		| Safety Areas
$array_condition_id[9] = 0;
//	10				| Visible / Standard			| Markings
$array_condition_id[10] = 0;
//	11				| Hold Lines					| Markings
$array_condition_id[11] = 0;
//	12				| Reflectivity					| Markings
$array_condition_id[12] = 0;
//	13				| Obscured / Dirty / Faded		| Lighting				| 13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30
$array_condition_id[13] = array(13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
//	14				| Damaged / Missing				| Lighting				| 13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30
$array_condition_id[14] = array(13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
//	15				| Inoperative					| Lighting				| 13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30
$array_condition_id[15] = array(13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
//	16				| Faulty Aim / Adjustment		| Lighting				| 13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30
$array_condition_id[16] = array(13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
//	17				| Rotating Beacon				| Navigational Aids		| 36
$array_condition_id[17] = array(36);
//	18				| Wind Indicators				| Navigational Aids		| 31
$array_condition_id[18] = array(31);
//	19				| REIL / PAPI Systems			| Navigational Aids		| 37,28,20,21
$array_condition_id[19] = array(20,21,37,38);
//	39				| Approach Lighting				| Navigational Aids		| 33,34,35
$array_condition_id[39] = array(33,34,35);
//	40				| Malfunctioning				| Navigational Aids		| 2,20,21,28,31,36,33,34,35
$array_condition_id[40] = array(20,21,31,33,34,35,36);
//	20				| Obstruction Lights			| Obstructions			| 32
$array_condition_id[20] = array(32);
//	21				| Construction					| Obstructions			| 32
$array_condition_id[21] = array(32);
//	22				| Surface Conditions			| Snow and Ice
$array_condition_id[22] = 0;
//	23				| Snowbank Clearance			| Snow and Ice
$array_condition_id[23] = 0;
//	24				| Lights and Signs Obscured		| Snow and Ice
$array_condition_id[24] = array(13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,4);
//	25				| NAVAIDS						| Snow and Ice
$array_condition_id[25] = array(20,21,28,31,36,33,34,35);
//	26				| Barricades / Lights			| Construction
$array_condition_id[26] = 0;
//	27				| Stockpiles / Equipment		| Construction
$array_condition_id[27] = 0;
//	43				| Safety						| Construction
$array_condition_id[43] = 0;
//	28				| Fencing / Gates				| Public Protection
$array_condition_id[28] = 0;
//	29				| Signs							| Public Protection
$array_condition_id[29] = 0;
//	30				| Dead Birds					| Wildlife Hazards
$array_condition_id[30] = 0;
//	31				| Flocks of Birds / Animals		| Wildlife Hazards
$array_condition_id[31] = 0;
//	32				| Equipment / Crew Avilable		| ARFF
$array_condition_id[32] = 0;
//	33				| Communications / Alarm		| ARFF
$array_condition_id[33] = 0;
//	34				| Obscured						| Signs					| 40,41
$array_condition_id[34] = array(40,41);
//	35				| Frangibility					| Signs					| 40,41
$array_condition_id[35] = array(40,41);
//	36				| Damaged / Missing				| Signs					| 40,41
$array_condition_id[36] = array(40,41);
//	37				| Standards						| Signs					| 40,41
$array_condition_id[37] = array(40,41);
//	38				| Illumination					| Signs					| 40,41
$array_condition_id[38] = array(40,41);
//	41				| Safety						| Fueling Operations
$array_condition_id[41] = 0;
//	42				| Signs / Gates					| Fueling Operations
$array_condition_id[42] = 0;


// Sort through the array_condition_id array and insert relationships
for($i=0;$i<count($array_condition_id);$i++) {
		echo "For LOOP i : ".$i." <br>";
		
		if($array_condition_id[$i] == 0) {
				echo "No values set for this array, skep entry <br>";
			} else {
				for($j=0;$j<count($array_condition_id[$i]);$j++) {
						echo "For LOOP j : ".$j. "<br>";
						
						$condition_name = 'Condition ID:'.$i.' / Equipment Type ID:'.$array_condition_id[$i][$j].'';
						
						$sql3 			= "INSERT INTO tbl_139_327_sub_c_link_e_t (139327_link_ef_name,139327_link_ef_c_id,139327_link_ef_e_t_id,139327_link_ef_hidden_yn) 
										VALUES ( '".$condition_name."', '".$i."', '".$array_condition_id[$i][$j]."', '0')";
						$objcon3 		= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

						echo $sql3."<br><br>";
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}		
							else {
								//mysql_insert_id();
								$objrs3 	= mysqli_query($objcon3, $sql3) or die(mysqli_error($objcon3));
								$lastchkid 	= mysqli_insert_id($objcon3);
							}
				
					}
			}
	
	}
?>