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
//	Name of Document		:	part139303_c_discrepancy_report_ajax_push.php
//
//	Purpose of Page			:	Load Part 139.303 (c) discrepancies into the new Inspection Form
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_globals.inc.php");												// Need Global Variable Information
		include("includes/_template_enter.php");
		//include("includes/_template/template.list.php");
		
// Load Page Specific Includes

		include("includes/_modules/part139303/part139303.list.php");
		include("includes/_template/template.list.php");
	
// Define Variables	
	
		$aInspection	= "";
		$i				= 1;
		$tmp_inspectionid = $_GET["tmpinspectionid"];
		
// Start Procedures		
		?>
	<table cellspacing="0" cellpadding="0" width="100%">
		<tr>
			<td colspan="2" class="item_name_inactive" />
				Class Subject Notes Added for this Inspection
				</td>
			</tr>
		<tr>
			<td class="item_name_active" />
					Name
				</td>
			<td class="item_name_active" />
					Remarks
				</td>
			</tr>
		<?php
		// Define SQL
		$sql = "SELECT * FROM tbl_139_303_c_sub_d WHERE Discrepancy_inspection_id = '".$tmp_inspectionid."'";
		
		//echo $sql;
		
		// Establish a Conneciton with the Database
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$res = mysqli_query($objcon, $sql);
				if ($res) {
						$number_of_rows = mysqli_num_rows($res);
						//printf("result set has %d rows. \n", $number_of_rows);
						if($number_of_rows == 0) {
								// There are no records in this dataset
								?>
		<tr>
			<td colspan="4" class="item_name_active" />
				No Discrepancies Added
				</td>
			</tr>
								<?php
							}
							else {					
								while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
										?>
		<tr>
			<td class="item_name_inactive" />
					<?php echo $objfields['Discrepancy_name'];?>
				</td>
			<td class="item_name_inactive" />
					<?php echo $objfields['discrepancy_remarks'];?>
				</td>
			</tr>										
										<?php
									}
									mysqli_free_result($res);
									mysqli_close($objcon);
							}	// end of Res Record Object						
					}
			}
					?>
		</table>