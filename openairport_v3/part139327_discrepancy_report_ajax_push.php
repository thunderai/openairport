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
//	Name of Document		:	part139327_discrepancy_report_ajax_push.php
//
//	Purpose of Page			:	Load Part 139.327 discrepancies into the new Inspection Form
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_globals.inc.php");												// Need Global Variable Information
		
// Load Page Specific Includes

		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_template/template.list.php");
	
// Define Variables	
	
		$aInspection	= "";
		$i				= 1;
		$tmp_inspectionid = $_GET["tmpinspectionid"];
		
// Start Procedures		
		?>
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td colspan="4" align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #3b5998; text-align:center">
							Discrepancies Added for this Inspection
							</td>
						</tr>
					<tr>
      					<td class="formheaders" onMouseover="ddrivetip('Category of Inspection')"; onMouseout="hideddrivetip()">
      							Name
							</td>
      					<td class="formheaders" onMouseover="ddrivetip('Detail to Inspect')"; onMouseout="hideddrivetip()">
      							Remarks
							</td>
      					<td class="formheaders" onMouseover="ddrivetip('Is this area clear of discrepancies?')"; onMouseout="hideddrivetip()">
      							Expansion
							</td>
      					<td class="formheaders" onMouseover="ddrivetip('Click each area where a discrepancy exists')"; onMouseout="hideddrivetip()">
      							Other Commands
							</td>
						</tr>
		<?php
		// Define SQL
		$sql = "SELECT * FROM tbl_139_327_sub_d_tmp WHERE Discrepancy_inspection_id = '".$tmp_inspectionid."'";
		
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
						<td height="28" class="formresults" colspan="4">
						No Discrepancies Added
						</tr>
								<?php
							}
							else {					
								while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
										?>
					<tr>
      					<td class="formresults" onMouseover="ddrivetip('Category of Inspection')"; onMouseout="hideddrivetip()">
      							<?php echo $objfields['Discrepancy_name'];?>
							</td>
      					<td class="formresults" onMouseover="ddrivetip('Detail to Inspect')"; onMouseout="hideddrivetip()">
      							<?php echo $objfields['discrepancy_remarks'];?>
							</td>
      					<td class="formresults" onMouseover="ddrivetip('Is this area clear of discrepancies?')"; onMouseout="hideddrivetip()">
      							
							</td>
      					<td class="formresults" onMouseover="ddrivetip('Click each area where a discrepancy exists')"; onMouseout="hideddrivetip()">
      							<-Recently added Discrepancies
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