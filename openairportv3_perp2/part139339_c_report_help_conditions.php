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
//	Name of Document		:	part139339_c_report_help_connditions.php
//
//	Purpose of Page			:	Help User by displaying conditions that can be clicked on
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
		
// LOAD GET Veriables

		$fieldname = $_GET['fieldname'];
		$cellvalue = $_GET['cellvalue'];
		
if (!isset($_POST["targetname"])) {
		//echo 'No Record ID defined in POST, use GET record id <br>';
		$tmp_targetname		= $_GET['targetname'];
		$tmp_targetname		= $tmp_targetname.'_win';
		//echo 'GET VALUE IS ['.$tmp_targetname.'] <br>';
	}
	else {
		//echo 'No GET ID defined in POST, use POST record id <br>';
		$tmp_targetname		= $_POST['targetname'];
		$tmp_targetname		= $tmp_targetname.'_win';
		//echo 'POST VALUE IS ['.$tmp_targetname.'] <br>';
	}	

if (!isset($_POST["dhtmlname"])) {
		//echo 'No Record ID defined in POST, use GET record id <br>';
		// No Record ID defined in POST, use GET record id
		$tmp_dhtmlname		= $_GET['dhtmlname'];
		$tmp_dhtmlname		= $tmp_dhtmlname;
		$tmp_dhtmlname		= $tmp_dhtmlname;
		$dhtml_name			= $tmp_dhtmlname;
		//echo 'GET VALUE IS ['.$tmp_dhtmlname.'] <br>';
	}
	else {
		//echo 'No GET ID defined in POST, use POST record id <br>';
		$tmp_dhtmlname		= $_POST['dhtmlname'];
		$tmp_dhtmlname		= $tmp_dhtmlname;
		$tmp_dhtmlname		= $tmp_dhtmlname;
		$dhtml_name			= $tmp_dhtmlname;		
		//echo 'POST VALUE IS ['.$tmp_dhtmlname.'] <br>';
	}
?>
		
	<BODY>
		<form name="entryform">
			<input id="<?=$fieldname;?>" name="<?=$fieldname;?>" type="hidden">
			</form>
		<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="3" class="perp_menuheader" />
					Field Condition Cheet Sheet
					</td>			
				</tr>			
			<tr>
				<td colspan="3" class="perp_menusubheader" />
					(
					Click a picture!
					)
					</td>				
				</tr>
			<tr>
				<td colspan="3" class="item_name_inactive" align="center">
					<font size="3" color="#FFFFFF">
						Please use this form to add descriptions to the condition field of the FiCON. 
						Each image shows an example of a different type of surface contamination which 
						can be used to describe an airport surface. When you click on a picture the 
						associated text will be added to the condition desacription HELP field you clicked on.
						</font>
					</td>
				</tr>
			<tr>
				<td class="item_name_active" align="center">
					<font size="4">
						Type
						</font>
					</td>
				<td class="item_name_active" align="center">
					<font size="4">
						Coverage
						</font>
					</td>
				<td class="item_name_active" align="center">
					<font size="4">
						Depth
						</font>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','dry');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Dry
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','clear');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Clear
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over000.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','0-0.25');">
								</td>
							</tr>
						<tr>
							<td align="center">
								0.00" to 0.25"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_wet.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','Wet');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Wet
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_cover_10.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','isolated');">
								</td>
							</tr>
						<tr>
							<td align="center">
								0% to 5%
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over025.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','0.25-0.50');">
								</td>
							</tr>
						<tr>
							<td align="center">
								0.25" to 0.50"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_snow.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','snow');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Snow
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_cover_10.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','isolated');">
								</td>
							</tr>
						<tr>
							<td align="center">
								5% to 10%
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over050.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>',' 0.50-0.75');">
								</td>
							</tr>
						<tr>
							<td align="center">
								0.50" to 0.75"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_snow.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','drysnow');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Dry Snow
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_cover_20.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','isolated');">
								</td>
							</tr>
						<tr>
							<td align="center">
								10% to 15%
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over075.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','0.75-1');">
								</td>
							</tr>
						<tr>
							<td align="center">
								0.75" to 1.00"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','wetsnow');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Wet Snow
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_cover_20.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','isolated');">
								</td>
							</tr>
						<tr>
							<td align="center">
								15% to 20%
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over100.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','1-1.25');">
								</td>
							</tr>
						<tr>
							<td align="center">
								1.00" to 1.25"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','Compactsnow');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Compacted Snow
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_cover_30.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','isolated');">
								</td>
							</tr>
						<tr>
							<td align="center">
								20% to 30%
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over125.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','1.25-1.5');">
								</td>
							</tr>
						<tr>
							<td align="center">
								1.25" to 1.50"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','slush');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Slush
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_cover_40.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','patchy');">
								</td>
							</tr>
						<tr>
							<td align="center">
								30% to 40%
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over150.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','1.5-1.75');">
								</td>
							</tr>
						<tr>
							<td align="center">
								1.50" to 1.75"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_ice.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','Ice');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Ice
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_cover_50.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','patchy');">
								</td>
							</tr>
						<tr>
							<td align="center">
								40% to 50%
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over175.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','1.75-2');">
								</td>
							</tr>
						<tr>
							<td align="center">
								1.75" to 2.00"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_snowdrifts.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','drifts');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Snow Drifts
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_cover_60.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','patchy');">
								</td>
							</tr>
						<tr>
							<td align="center">
								50% to 60%
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over200.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','2-2.25');">
								</td>
							</tr>
						<tr>
							<td align="center">
								2.00" to 2.25"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_standingwater.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','stdwater');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Standing Water
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_cover_70.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','patchy');">
								</td>
							</tr>
						<tr>
							<td align="center">
								60% to 70%
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over225.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','2.25-2.5');">
								</td>
							</tr>
						<tr>
							<td align="center">
								2.25" to 2.50"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_plowed.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','PLW');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Plowed
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_cover_80.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','patchy');">
								</td>
							</tr>
						<tr>
							<td align="center">
								70% to 80%
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over250.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','2.5-2.75');">
								</td>
							</tr>
						<tr>
							<td align="center">
								2.50" to 2.75"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_sanded.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','SND');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Sanded
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_cover_90.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','totcover');">
								</td>
							</tr>
						<tr>
							<td align="center">
								80% to 90%
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over275.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','2.75-3');">
								</td>
							</tr>
						<tr>
							<td align="center">
								2.75" to 3.00"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					&nbsp;
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_cover_100.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','totcover');">
								</td>
							</tr>
						<tr>
							<td align="center">
								90% to 100%
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over300.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','3-3.25');">
								</td>
							</tr>
						<tr>
							<td align="center">
								3.00" to 3.25"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					&nbsp;
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','CNT 50');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Center 50 feet
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over325.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','3.25-3.5');">
								</td>
							</tr>
						<tr>
							<td align="center">
								3.25" to 3.50"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					&nbsp;
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','CNT 75');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Center 75 feet
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over350.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','3.5-3.75');">
								</td>
							</tr>
						<tr>
							<td align="center">
								3.50" to 3.75"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					&nbsp;
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','FW');">
								</td>
							</tr>
						<tr>
							<td align="center">
								Full Width
								</td>
							</tr>
						</table>
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over375.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','3.75-4');">
								</td>
							</tr>
						<tr>
							<td align="center">
								3.75" to 4.00"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td class="item_name_inactive">
					&nbsp;
					</td>
				<td class="item_name_inactive">
					&nbsp;
					</td>
				<td class="item_name_inactive">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td align="center">
								<img src="images/part_139_339/depth_over400.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','4plus');">
								</td>
							</tr>
						<tr>
							<td align="center">
								4.00" and up
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<?php
	// FORM UNIVERSAL CONTROL LOADING
	//------------------------------------------------------------------------------------------\\
	
	$targetname		= $tmp_targetname;				// From the Button Loader; Name of the window this form was loaded into.
	$dhtml_name		= $dhtml_name;					// From the Button Loader; Name of the DHTML window function to call to change this window.
	form_uni_control("targetname"		,$targetname);
	form_uni_control("dhtmlname"		,$dhtml_name);
	
	//
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 0;														// 1: Display Submit Button,	0: No
				$submitbuttonname	= '';														// Name of the Submit Button
			$display_close			= 1;														// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
			$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");			
			?>
			<script>
	function updateparentfieldvalue(fieldname,fieldvalue) {
		//opener.document.getElementById(fieldname).value = fieldvalue;
		if (parent.document.getElementById(fieldname).value == "") {
				parent.document.getElementById(fieldname).value = fieldvalue;
			}
			else {
				parent.document.getElementById(fieldname).value = parent.document.getElementById(fieldname).value + " " + fieldvalue;
			
			}
		}
	</script>
		</body>
	</html>
				