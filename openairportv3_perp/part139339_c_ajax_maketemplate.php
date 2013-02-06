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
//	Name of Document		:	part139339_c_ajax_maketemplate.php
//
//	Purpose of Page			:	Load Part 139.339 (c) Inspection Checklist (AJAX)
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_globals.inc.php");												// Need Global Variable Information
		
// Load Page Specific Includes

		include("includes/_template/template.list.php");
		include("includes/_modules/part139339/part139339.list.php");
		
	
// Define Variables	
	
		$aInspection	= "";
		$i				= 1;
		$fullorshort	= 0;
		$InspCheckList 	= $_GET["InspCheckList"];
		$IntInspector 	= $_GET["Employee"];
		
?>
			<center>
				<table cellspacing="3" cellpadding="5" width="100%">
					<tr>
				<?php
				if ($InspCheckList=="NO") {
						//Display Nothing
						?>
						<td colspan="2" align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Enter the Name of this Template')"; onMouseout="hideddrivetip()">
							FiCON will not be saved as a template
							</td>
						<?php
					}
					else {
						?>				
				<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Enter the Name of this Template')"; onMouseout="hideddrivetip()">
							Name of Template
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" type="text" name="frmtemplatename" size="30">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
							Purpose of Template
							</td>
						<td class="formanswers">
							<textarea name="frmtemplatepurpose" rows="5" cols="60"></textarea>
							</td>
						</tr>
						<?php
					}
					?>
					</table>
				</center>