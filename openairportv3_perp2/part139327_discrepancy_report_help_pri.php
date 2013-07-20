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
//	Name of Document		:	part139337_report_help_species.php
//
//	Purpose of Page			:	Help User by displaying species that can be clicked on
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

		include("includes/_modules/part139337/part139337.list.php");
		include("includes/_template_enter.php");
		//include("includes/_template/template.list.php");
		
// LOAD GET Veriables

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
		<form name="entryform">
		<input id="<?=$fieldname;?>" name="<?=$fieldname;?>" type="hidden" />
			</form>
	<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
		<tr>
			<td class="perp_menuheader" />
				Priority Help Chart
				</td>			
			</tr>			
		<tr>
			<td class="perp_menusubheader" />
				(
				Explination of Priority
				)
				</td>				
			</tr>	
		<tr>
			<td class="item_name_small_inactive" />
				<table width="100%" height="75" cellpadding="0" cellspacing="3" border="1" class="formheaders" style="float:left;" />
					<tr>
						<td class="formresults" width="100" align="center" valign="middle" />
							<center><b>Priority</b></center>
							</td>
						<td class="formresults" width="150" align="center" valign="middle" />
							<center><b>Name</b></center>
							</td>								
						<td class="formresults" align="center" valign="middle" />
							<center><b>Use</b></center>
							</td>								
						</tr>
					<tr>
					<?php
					$pri = 1;
					?>
						<td class="formresults" width="100" align="center" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')" />
							<font size="4" color="#FFFFFF">
								<center><b>01</b></center>
								</font>
							</td>
						<td class="formresults" align="left" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')"/>
							<font size="4" color="#FFFFFF">
								<b>NOTAM</b>
								</font>
							</td>								
						<td class="formresults" align="left" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')"/>
							<b>Guidance:</b>
							<p>
								1: Use for Discrepancies that must be fixed NOW<br>
								2: Use for Discrepancies that require a NOTAM until fixed<br>
								</p>
							</td>								
						</tr>
					<tr>
					<?php
					$pri = 2;
					?>
						<td class="formresults" width="100" align="center" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')" />
							<font size="4" color="#FFFFFF">
								<center><b>02</b></center>
								</font>
							</td>
						<td class="formresults" align="left" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')"/>
							<font size="4" color="#FFFFFF">
								<b>Fix As Soon As Possible</b>
								</font>
							</td>								
						<td class="formresults" align="left" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')"/>
							<b>Guidance:</b>
							<p>
								1: Use for Discrepancies that need to be fixed NOW, but dont require a NOTAM.<br>
								2: Use for Discrepancies that should be fixed as soon as possible<br>
								</p>
							</td>								
						</tr>	
					<tr>
					<?php
					$pri = 3;
					?>
						<td class="formresults" width="100" align="center" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')" />
							<font size="4" color="#FFFFFF">
								<center><b>03</b></center>
								</font>
							</td>
						<td class="formresults" align="left" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')"/>
							<font size="4" color="#FFFFFF">
								<b>Fix From 1 to 2 days</b>
								</font>
							</td>								
						<td class="formresults" align="left" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')"/>
							<b>Guidance:</b>
							<p>
								1: Use for Discrepancies that do not require a NOTAM<br>
								2: Use for Discrepancies that are not an immediate need<br>
								3: Use for Discrepancies that should be fixed within 2 days<br>
								</p>
							</td>								
						</tr>	
					<tr>
					<?php
					$pri = 4;
					?>
						<td class="formresults" width="100" align="center" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')" />
							<font size="4" color="#FFFFFF">
								<center><b>04</b></center>
								</font>
							</td>
						<td class="formresults" align="left" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')"/>
							<font size="4" color="#FFFFFF">
								<b>Fix From 3 to 10 days</b>
								</font>
							</td>								
						<td class="formresults" align="left" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')"/>
							<b>Guidance:</b>
							<p>
								1: Use for Discrepancies that do not require a NOTAM<br>
								2: Use for Discrepancies that are not an immediate need<br>
								3: Use for Discrepancies that should be fixed within 10 days<br>
								</p>
							</td>								
						</tr>	
					<tr>
					<?php
					$pri = 5;
					?>
						<td class="formresults" width="100" align="center" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')" />
							<font size="4" color="#FFFFFF">
								<center><b>05</b></center>
								</font>
							</td>
						<td class="formresults" align="left" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')"/>
							<font size="4" color="#FFFFFF">
								<b>Fix From 11 to Scheduled</b>
								</font>
							</td>								
						<td class="formresults" align="left" valign="middle" onclick="updateparentfieldvalue('dispri','<?php echo $pri;?>')"/>
							<b>Guidance:</b>
							<p>
								1: Use for Discrepancies that do not require a NOTAM<br>
								2: Use for Discrepancies that are not an immediate need<br>
								3: Use for Discrepancies that require additional time to replace and need to be scheduled<br>
								</p>
							</td>								
						</tr>							
					</table>
				</td>
			</tr>
		</table>	
	<script>
	function updateparentfieldvalue(fieldname,fieldvalue) {
		//opener.document.getElementById(fieldname).value = fieldvalue;
		var fieldtochange = escape(fieldname);
		opener.document.getElementById('dispri').value = fieldvalue;
		}
	</script>
			<?php
include("includes/_userinterface/_ui_footer.inc.php");		// include file that gets information from form POSTs for navigational purposes
?>