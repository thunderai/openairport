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
//	Name of Document		:	part139339_c_report_help_icao.php
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
		include("includes/_template/template.list.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page

// Load Page Specific Includes

		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_template_enter.php");
		//include("includes/_template/template.list.php");
		
// LOAD GET Veriables

		$fieldname 	= $_GET['fieldname'];
		$cellvalue 	= $_GET['cellvalue'];
		$facilityid	= $_GET['facility'];
		
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

<script>
	function toggle_339c(showHideDiv) {
		// Hide all DIV LAyers Here
		// Show the selected one
		document.getElementById('ri').style.display = "none";
		document.getElementById('ai').style.display = "none";
		//document.getElementById('si').style.display = "none";
		
		document.getElementById(showHideDiv).style.display = "block";
		
	} 	
	
	</script>
	
	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="formheaders">
		<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="3" class="perp_menuheader" />
					Build ICAO Standard FiCON Syntax
					</td>			
				</tr>			
			<tr>
				<td colspan="3" class="perp_menusubheader" />
					(
					Basic Surface Information
					)
					</td>				
				</tr>
		<tr>
			<td colspan="3">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td class="item_name_inactive">
							Airport
							</td>
						<td class="item_name_inactive">
							KATY
							</td>
						<td rowspan="2" class="formheaders">

							</td>
						<td class="item_name_inactive">
							Time
							</td>
						<td class="item_name_inactive">
							<?php echo date('H:m:s');?>
							</td>
						</tr>
					<tr>
						<td class="item_name_inactive">
							Surface
							</td>
						<td class="item_name_inactive">
							<?php
							$facilityname = part139339_c_facilitycombobox($facilityid, 'all', 'notusedlikethis', 'hide', $facilityid);
							if($facilityid == 3 OR $facilityid == 4) {
									$surfacetype 	= "PFC";
									$surfacewidth 	= 150;
								}
								else {
									$surfacetype 	= "Smoth";
									$surfacewidth 	= 50;
								}
							
							?>
							<?php echo $facilityname;?>
							</td>
						<td class="item_name_inactive">
							Date
							</td>
						<td class="item_name_inactive">
							<?php echo date('Y/M/d');?>
							</td>
						</tr>
							
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="perp_menuheader" />
					Menu Options
					</td>			
				</tr>			
			<tr>
				<td colspan="3" class="perp_menusubheader" />
					(
					Select a Form from the Menu buttons below
					)
					</td>				
				</tr>
			<tr>
				<td>
					<?php
					$formname 	= '';
					$label 		= 'Required Items';
					$icon  		= 'icon_flag';
					$action		= 'toggle_339c';
					$target		= 'ri';
					_tp_control_function_button_toggle($formname,$label,$icon,$action,$target);
					
					$formname 	= '';
					$label 		= 'Additional Items';
					$icon  		= 'icon_flag';
					$action		= 'toggle_339c';
					$target		= 'ai';
					_tp_control_function_button_toggle($formname,$label,$icon,$action,$target);	

					$formname 	= '';
					$label 		= 'Surface Properties';
					$icon  		= 'icon_flag';
					$action		= 'toggle_339c';
					$target		= 'si';
					_tp_control_function_button_toggle($formname,$label,$icon,$action,$target);				
					?>
					</td>
				</tr>
<div name="ri" id="ri" width="100%" style="position: absolute;
							  left: 0px;
							  top: 150px;
							  width: 100%;"
							 />
	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="item_name_inactive"/>
		<tr>
			<td colspan="3" class="perp_menuheader" />
				Required Information
				</td>			
			</tr>			
		<tr>
			<td colspan="3" class="perp_menusubheader" />
				(
				Select the aplicable options/buttons
				)
				</td>				
			</tr>	 
		<tr>
			<td align="left" valign="top">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td colspan="4" class="item_name_active">
							% Coverage
							</td>
						</tr>
					<tr>
						<td colspan="5" class="item_name_inactive">
							Required: Step One <br>
							Click Cover %
							</td>
						</tr>									
					<tr>
						<td class="item_name_inactive">
							%
							</td>
						<td class="item_name_inactive">
							1/3
							</td>	
						<td class="item_name_inactive">
							2/3
							</td>
						<td class="item_name_inactive">
							3/3
							</td>										
						</tr>
					<tr>
						<td class="item_name_inactive">
							10%
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group1" id="c_group1"	value="10" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group2" id="c_group2"	value="10" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group3" id="c_group3"	value="10" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>									
						</tr>
					<tr>
						<td class="item_name_inactive">
							25%
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group1" id="c_group1"	value="25" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group2" id="c_group2"	value="25" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group3" id="c_group3"	value="25" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							50%
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group1" id="c_group1"	value="50" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group2" id="c_group2"	value="50" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group3" id="c_group3"	value="50" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>									
						</tr>
					<tr>
						<td class="item_name_inactive">
							75%
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group1" id="c_group1"	value="75" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group2" id="c_group2"	value="75" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group3" id="c_group3"	value="75" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>								
						</tr>
					<tr>
						<td class="item_name_inactive">
							100%
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group1" id="c_group1"	value="100" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group2" id="c_group2"	value="100" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="c_group3" id="c_group3"	value="100" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>									
						</tr>
					<tr>
						<td class="item_name_inactive">
							Max
							</td>
						<td class="item_name_inactive" colspan="3">
							<INPUT type="text" name="maxcover" id="maxcover" value="0" size="2" class="makebuttonlooklikelargetext" disabled="disabled">
							</td>
						</tr>
					<tr>
						<td colspan="4" class="item_name_active">
							Temperatures
							</td>
						</tr>	
					<tr>
						<td class="item_name_inactive">
							Temp
							</td>
						<td class="item_name_inactive" colspan="3">
							O.A.T.
							</td>										
						</tr>									
					<tr>
						<td class="item_name_inactive">
							C 
							</td>
						<td class="item_name_inactive" colspan="3">
							<?php 
							// Calculate current temperature
							// Get Current Weather Information string
							$tmpweather = readweathertxt("null");
							$aweather	= explode("\n",$tmpweather);
							$tmp_temp	= "".$aweather[0]."";
							$tmp_temp	= trim($tmp_temp);
							$tmp_temp	= substr($tmp_temp,3);
							$tmp_temp	= substr($tmp_temp,0,-2);
							// Convert temp to Celcius
							$tmp_temp_c	= ($tmp_temp - 32) * (5/9);
							$tmp_temp_c = round($tmp_temp_c,0);
							
							//echo $tmp_temp_c;
							?>
							<input type="text" name="temp" id="temp" value="<?php echo $tmp_temp_c;?>" size="4" maxlength="3" style="background-color: #FFFF66;"/>
							</td>									
						</tr>									
						
					</table>
				</td>
			<td align="left" valign="top">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td colspan="4" class="item_name_active">
							Contaminant Depth
							</td>
						</tr>
					<tr>
						<td colspan="5" class="item_name_inactive">
							Required: Step Two <br>
							Click the Depth
							</td>
						</tr>									
					<tr>
						<td class="item_name_inactive">
							Inches
							</td>
						<td class="item_name_inactive">
							1/3
							</td>	
						<td class="item_name_inactive">
							2/3
							</td>
						<td class="item_name_inactive">
							3/3
							</td>										
						</tr>
					<tr>
						<td class="item_name_inactive">
							1/8"
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group1" id="d_group1"	value=".125" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group2" id="d_group2"	value=".125" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group3" id="d_group3"	value=".125" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							1/4"
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group1" id="d_group1"	value=".250" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group2" id="d_group2"	value=".250" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group3" id="d_group3"	value=".250" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							1/2"
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group1" id="d_group1"	value=".500" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group2" id="d_group2"	value=".500" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group3" id="d_group3"	value=".500" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							3/4"
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group1" id="d_group1"	value=".750" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group2" id="d_group2"	value=".750" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group3" id="d_group3"	value=".750" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							1"
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group1" id="d_group1"	value="1" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group2" id="d_group2"	value="1" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group3" id="d_group3"	value="1" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							2"
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group1" id="d_group1"	value="2" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group2" id="d_group2"	value="2" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group3" id="d_group3"	value="2" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							3"
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group1" id="d_group1"	value="3" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group2" id="d_group2"	value="3" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group3" id="d_group3"	value="3" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							4" +
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group1" id="d_group1"	value="4" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group2" id="d_group2"	value="4" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="d_group3" id="d_group3"	value="4" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							Max
							</td>
						<td class="item_name_inactive" colspan="3">
							<INPUT type="text" name="maxdepth" id="maxdepth" value="0" size="4" class="makebuttonlooklikelargetext" disabled="disabled">
							</td>
						</tr>									
					</table>
				</td>
			<td align="left" valign="top" rowspan="2">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td colspan="4" class="item_name_active">
							Contaminant Type
							</td>
						</tr>
					<tr>
						<td colspan="5" class="item_name_inactive">
							Required: Step Three <br>
							Click the Contaiment Type
							</td>
						</tr>									
					<tr>
						<td class="item_name_inactive">
							Type
							</td>
						<td class="item_name_inactive">
							1/3
							</td>	
						<td class="item_name_inactive">
							2/3
							</td>
						<td class="item_name_inactive">
							3/3
							</td>										
						</tr>
					<tr>
						<td class="item_name_inactive">
							Dry
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group1" id="t_group1"	value="0" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group2" id="t_group2"	value="0" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group3" id="t_group3"	value="0" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							Wet
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group1" id="t_group1"	value="1" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group2" id="t_group2"	value="1" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group3" id="t_group3"	value="1" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							Wet (slip)
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group1" id="t_group1"	value="2" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group2" id="t_group2"	value="2" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group3" id="t_group3"	value="2" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>
					<tr name="slipwhere2" id="slipwhere2" style="display:none;">
						<td class="item_name_inactive">
							Slip Where
							</td>
						<td class="item_name_inactive">
							F
							</td>
						<td class="item_name_inactive">
							E
							</td>
						<td class="item_name_inactive">
							L
							</td>
						</tr>
					<tr name="slipwhere3" id="slipwhere3" style="display:none;">
						<td class="item_name_inactive" align="right">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Frt/Lst/Etr ?
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="sl_group1" id="sl_group1"	value="FIRST" maxlength="10"  onchange="javascript:updateslippery('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="sl_group1" id="sl_group1"	value="ENTIRE" maxlength="10"  onchange="javascript:updateslippery('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="sl_group1" id="sl_group1"	value="LAST" maxlength="10"  onchange="javascript:updateslippery('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>
					<tr name="slipwhere1" id="slipwhere1" style="display:none;">
						<td class="item_name_inactive" align="right">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dist in Ft
								</td>
						<td class="item_name_inactive" colspan="3">
							<input type="text" name="sl_long" id="sl_long"	value="0" maxlength="10"  size="10" onchange="javascript:updateslippery('<?php echo $surfacetype;?>');" style="background-color: #FFFF66;" />
							</td>									
						</tr>
					<tr>
						<td class="item_name_inactive">
							Water
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group1" id="t_group1"	value="3" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group2" id="t_group2"	value="3" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group3" id="t_group3"	value="3" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							Slush
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group1" id="t_group1"	value="4" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group2" id="t_group2"	value="4" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group3" id="t_group3"	value="4" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							Dry Snow
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group1" id="t_group1"	value="5" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group2" id="t_group2"	value="5" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group3" id="t_group3"	value="5" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							Wet Snow
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group1" id="t_group1"	value="6" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group2" id="t_group2"	value="6" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group3" id="t_group3"	value="6" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>									
					<tr>
						<td class="item_name_inactive">
							Compact Snow
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group1" id="t_group1"	value="7" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group2" id="t_group2"	value="7" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group3" id="t_group3"	value="7" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>
					<tr>
						<td class="item_name_inactive">
							Frost
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group1" id="t_group1"	value="8" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group2" id="t_group2"	value="8" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group3" id="t_group3"	value="8" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>
					<tr>
						<td class="item_name_inactive">
							Ice
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group1" id="t_group1"	value="9" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group2" id="t_group2"	value="9" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group3" id="t_group3"	value="9" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>
					<tr>
						<td class="item_name_inactive">
							Wet Ice Overlay
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group1" id="t_group1"	value="10" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group2" id="t_group2"	value="10" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="item_name_inactive">
							<input type="radio" name="t_group3" id="t_group3"	value="10" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>
					<tr>
						<td class="item_name_inactive">
							Max
							</td>
						<td class="item_name_inactive" colspan="3">
							<INPUT type="text" name="maxtype" id="maxtype" class="makebuttonlooklikelargetext" value="0" size="13" disabled="disabled">
							</td>
						</tr>									
					</table>
				</td>
			</tr>
		</table>
	<table width="100%" cellpadding="0" cellspacing="0" class="formheaders"/>
		<tr>
			<td align="left" valign="top"/>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td class="item_name_active">
							REMARKS
							</td>
						</tr>
					<tr>
						<td class="item_name_inactive">
							<TEXTAREA rows="4" COLS="60" name="remarks" id="remarks"  onblur="javascript:forceupdate();" style="color: #FFFFFF;background-color: #666666;" /></TEXTAREA>
							</td>
						</tr>
					</table>
				</td>
			</tr>			
		<tr>
			<td colspan="2">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td>
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td colspan="4" class="item_name_active">
										Runway Condition Code
										</td>
									</tr>
								<tr>
									<td class="item_name_inactive">
										1/3
										</td>
									<td class="item_name_inactive">
										2/3
										</td>
									<td class="item_name_inactive">
										3/3
										</td>
									</tr>
								<tr>
									<td class="item_name_inactive">
										<INPUT type="text" name="rcc_1" id="rcc_1" value="0" size="1" maxlength="1"  disabled="disabled"/>
										</td>
									<td class="item_name_inactive">
										<INPUT type="text" name="rcc_2" id="rcc_2" value="0" size="1" maxlength="1"  disabled="disabled"/>
										</td>
									<td class="item_name_inactive">
										<INPUT type="text" name="rcc_3" id="rcc_3" value="0" size="1" maxlength="1"  disabled="disabled"/>
										</td>
									</tr>									
								</table>
							</td>
						<td>
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td colspan="4" class="item_name_active">
										Mu Values
										</td>
									</tr>
								<tr>
									<td class="item_name_inactive">
										1/3
										</td>
									<td class="item_name_inactive">
										2/3
										</td>
									<td class="item_name_inactive">
										3/3
										</td>
									</tr>
								<tr>
									<td class="item_name_inactive">
										<INPUT type="text" name="mu_1" id="mu_1" value="40" size="1" maxlength="2"  onblur="javascript:forceupdate();" style="background-color: #FFFF66;"/>
										</td>
									<td class="item_name_inactive">
										<INPUT type="text" name="mu_2" id="mu_2" value="40" size="1" maxlength="2"  onblur="javascript:forceupdate();" style="background-color: #FFFF66;"/>
										</td>
									<td class="item_name_inactive">
										<INPUT type="text" name="mu_3" id="mu_3" value="40" size="1" maxlength="2"  onblur="javascript:forceupdate();" style="background-color: #FFFF66;"/>
										</td>
									</tr>
								</table>
							</td>
						<td>
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td colspan="4" class="item_name_active">
										Downgraded Runway Code
										</td>
									</tr>
								<tr>
									<td class="item_name_inactive">
										1/3
										</td>
									<td class="item_name_inactive">
										2/3
										</td>
									<td class="item_name_inactive">
										3/3
										</td>
									</tr>
								<tr>
									<td class="item_name_inactive">
										<INPUT type="text" name="dgc_1" id="dgc_1" value="0" size="1" maxlength="1" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="item_name_inactive">
										<INPUT type="text" name="dgc_2" id="dgc_2" value="0" size="1" maxlength="1" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="item_name_inactive">
										<INPUT type="text" name="dgc_3" id="dgc_3" value="0" size="1" maxlength="1" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<tr>
			<td colspan="2" align="left" valign="top" class="item_name_active">
				Matrix Report
				</td>
			</tr>
		<tr>
			<td colspan="2" align="left" valign="top" class="item_name_inactive" />
				<INPUT type="text" name="report" id="report" size="80" value="Maxtrix Report Text" disabled="disabled"/>
				</td>
			</tr>
		</table>
	</div>
<div name="ai" id="ai" width="100%" style="position: absolute;
							  left: 0px;
							  top: 145px;
							  width: 100%;
							  display:none;"
							 />
	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="item_name_inactive"/>
		<tr>
			<td colspan="3" class="perp_menuheader" />
				Additional Information
				</td>			
			</tr>			
		<tr>
			<td colspan="3" class="perp_menusubheader" />
				(
				Select the aplicable options/buttons
				)
				</td>				
			</tr>	
		<tr>
			<td align="left" valign="top">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td colspan="5" class="item_name_inactive">
										Extra: Step Four <br>
										Used to add more indepth detail.  See the end of the form for some examples on how to use this feature.
										</td>
									</tr>
								<tr>
									<td class="item_name_active" onMouseover="ddrivetip('Select an Area to use in building this additional information.')"; onMouseout="hideddrivetip()" />
										Area
										</td>
									<td class="item_name_active">
										Distance (Width or Length)
										</td>
									<td class="item_name_active">
										% of Contaminate Cover
										</td>
									<td class="item_name_active">
										Depth of Contaminate
										</td>
									<td class="item_name_active">
										Treatment
										</td>	
									</tr>
								<tr>
									<td class="item_name_inactive">
										<select name="swl_1_area" id="swl_1_area" style="color: #FFFFFF;background-color: #666666;" />
											<option value="select"		>Select</option>
											<option value="center"		>Center</option>
											<option value="remaining"	>Remaining</option>
											<option value="edges"		>Edges</option>
											<option value="first"		>First</option>
											<option value="last"		>Last</option>
											<option value="over"		>Over</option>
											</select>
										</td>
									<td class="item_name_inactive">
										<input type="text" name="swl_1_feet" id="swl_1_feet" size="2" maxlength="4" value="<?php echo $surfacewidth;?>" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="item_name_inactive">
										<select name="swl_1_cover" id="swl_1_cover" style="color: #FFFFFF;background-color: #666666;" />
											<option value="10"	>10%</option>
											<option value="25"	>25%</option>
											<option value="50"	>50%</option>
											<option value="75"	>75%</option>
											<option value="100"	>100%</option>
											</select>
										</td>		
									<td class="item_name_inactive">
										<input type="text" name="swl_1_depth" id="swl_1_depth" size="2" maxlength="2" value="0" style="color: #FFFFFF;background-color: #666666;" />
										</td>										
									<td class="item_name_inactive">
										<select name="swl_1_treatment" id="swl_1_treatment" style="color: #FFFFFF;background-color: #666666;" />
											<option value="select"		>Select</option>
											<option value="cleared"		>Cleared</option>
											<option value="type"		>Containment Type</option>
											<option value="sanded"		>Sanded</option>
											<option value="useable"		>Useable</option>
											<option value="select"		>---------</option>
											<option value="0"			>Dry</option>
											<option value="1"			>Wet (<?php echo$surfacetype;?>)</option>
											<option value="2"			>Wet (Slippery)</option>
											<option value="3"			>Standing Water</option>
											<option value="4"			>Slush</option>
											<option value="5"			>Dry Snow</option>
											<option value="6"			>Wet Snow</option>
											<option value="7"			>Compacted Snow</option>
											<option value="8"			>Frost</option>
											<option value="9"			>Ice</option>
											<option value="10"			>Wet Ice Overlay</option>
											</select>
										</td>	
									</tr>
								<tr>
									<td class="item_name_inactive">
										<select name="swl_2_area" id="swl_2_area" style="color: #FFFFFF;background-color: #666666;" />
											<option value="select"		>Select</option>
											<option value="center"		>Center</option>
											<option value="remaining"	>Remaining</option>
											<option value="edges"		>Edges</option>
											<option value="first"		>First</option>
											<option value="last"		>Last</option>
											<option value="over"		>Over</option>
											</select>
										</td>
									<td class="item_name_inactive">
										<input type="text" name="swl_2_feet" id="swl_2_feet" size="2" maxlength="4" value="<?php echo $surfacewidth;?>" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="item_name_inactive">
										<select name="swl_2_cover" id="swl_2_cover" style="color: #FFFFFF;background-color: #666666;" />
											<option value="10"	>10%</option>
											<option value="25"	>25%</option>
											<option value="50"	>50%</option>
											<option value="75"	>75%</option>
											<option value="100"	>100%</option>
											</select>
										</td>		
									<td class="item_name_inactive">
										<input type="text" name="swl_2_depth" id="swl_2_depth" size="2" maxlength="2" value="0" style="color: #FFFFFF;background-color: #666666;" />
										</td>										
									<td class="item_name_inactive">
										<select name="swl_2_treatment" id="swl_2_treatment" style="color: #FFFFFF;background-color: #666666;" />
											<option value="select"		>Select</option>
											<option value="cleared"		>Cleared</option>
											<option value="type"		>Containment Type</option>
											<option value="sanded"		>Sanded</option>
											<option value="useable"		>Useable</option>
											<option value="select"		>---------</option>
											<option value="0"			>Dry</option>
											<option value="1"			>Wet (<?php echo$surfacetype;?>)</option>
											<option value="2"			>Wet (Slippery)</option>
											<option value="3"			>Standing Water</option>
											<option value="4"			>Slush</option>
											<option value="5"			>Dry Snow</option>
											<option value="6"			>Wet Snow</option>
											<option value="7"			>Compacted Snow</option>
											<option value="8"			>Frost</option>
											<option value="9"			>Ice</option>
											<option value="10"			>Wet Ice Overlay</option>
											</select>
										</td>	
									</tr>									
								<tr>
									<td class="item_name_inactive">
										<select name="swl_3_area" id="swl_3_area" style="color: #FFFFFF;background-color: #666666;" />
											<option value="select"		>Select</option>
											<option value="center"		>Center</option>
											<option value="remaining"	>Remaining</option>
											<option value="swl_3_s"		>Edges</option>
											<option value="first"		>First</option>
											<option value="last"		>Last</option>
											<option value="over"		>Over</option>
											</select>
										</td>
									<td class="item_name_inactive">
										<input type="text" name="swl_3_feet" id="swl_3_feet" size="2" maxlength="4" value="<?php echo $surfacewidth;?>" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="item_name_inactive">
										<select name="swl_3_cover" id="swl_3_cover" style="color: #FFFFFF;background-color: #666666;" />
											<option value="10"	>10%</option>
											<option value="25"	>25%</option>
											<option value="50"	>50%</option>
											<option value="75"	>75%</option>
											<option value="100"	>100%</option>
											</select>
										</td>
									<td class="item_name_inactive">
										<input type="text" name="swl_3_depth" id="swl_3_depth" size="2" maxlength="2" value="0" style="color: #FFFFFF;background-color: #666666;" />
										</td>										
									<td class="item_name_inactive">
										<select name="swl_3_treatment" id="swl_3_treatment" style="color: #FFFFFF;background-color: #666666;" />
											<option value="select"		>Select</option>
											<option value="cleared"		>Cleared</option>
											<option value="type"		>Containment Type</option>
											<option value="sanded"		>Sanded</option>
											<option value="useable"		>Useable</option>
											<option value="select"		>---------</option>
											<option value="0"			>Dry</option>
											<option value="1"			>Wet (<?php echo$surfacetype;?>)</option>
											<option value="2"			>Wet (Slippery)</option>
											<option value="3"			>Standing Water</option>
											<option value="4"			>Slush</option>
											<option value="5"			>Dry Snow</option>
											<option value="6"			>Wet Snow</option>
											<option value="7"			>Compacted Snow</option>
											<option value="8"			>Frost</option>
											<option value="9"			>Ice</option>
											<option value="10"			>Wet Ice Overlay</option>
											</select>
										</td>	
									</tr>
								<tr>
									<td class="item_name_inactive">
										<select name="swl_4_area" id="swl_4_area" style="color: #FFFFFF;background-color: #666666;" />
											<option value="select"		>Select</option>
											<option value="center"		>Center</option>
											<option value="remaining"	>Remaining</option>
											<option value="swl_4_s"		>Edges</option>
											<option value="first"		>First</option>
											<option value="last"		>Last</option>
											<option value="over"		>Over</option>
											</select>
										</td>
									<td class="item_name_inactive">
										<input type="text" name="swl_4_feet" id="swl_4_feet" size="2" maxlength="4" value="<?php echo $surfacewidth;?>" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="item_name_inactive">
										<select name="swl_4_cover" id="swl_4_cover" style="color: #FFFFFF;background-color: #666666;" />
											<option value="10"	>10%</option>
											<option value="25"	>25%</option>
											<option value="50"	>50%</option>
											<option value="75"	>75%</option>
											<option value="100"	>100%</option>
											</select>
										</td>	
									<td class="item_name_inactive">
										<input type="text" name="swl_4_depth" id="swl_4_depth" size="2" maxlength="2" value="0" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="item_name_inactive">
										<select name="swl_4_treatment" id="swl_4_treatment" style="color: #FFFFFF;background-color: #666666;" />
											<option value="select"		>Select</option>
											<option value="cleared"		>Cleared</option>
											<option value="type"		>Containment Type</option>
											<option value="sanded"		>Sanded</option>
											<option value="useable"		>Useable</option>
											<option value="select"		>---------</option>
											<option value="0"			>Dry</option>
											<option value="1"			>Wet (<?php echo$surfacetype;?>)</option>
											<option value="2"			>Wet (Slippery)</option>
											<option value="3"			>Standing Water</option>
											<option value="4"			>Slush</option>
											<option value="5"			>Dry Snow</option>
											<option value="6"			>Wet Snow</option>
											<option value="7"			>Compacted Snow</option>
											<option value="8"			>Frost</option>
											<option value="9"			>Ice</option>
											<option value="10"			>Wet Ice Overlay</option>
											</select>
										</td>	
									</tr>	
								<tr>
									<td class="formheaders" />
										Update
										</td>
									<td class="item_name_inactive" colspan="4">
										<button name="updateadded" id="updateadded">Update Values</button>
										</td>
									</tr>									
								<tr>
									<td class="formheaders">
										Max
										</td>
									<td class="item_name_inactive" colspan="4">
										<input type="text" name="swl_text" id="swl_text" value="This Page Not Programmed to work yet" size="50" disabled="disabled"/>
										</td>
									</tr>
								<tr>
									<td colspan="5" class="formheaders">
										Examples
										</td>
									</tr>
								<tr>
									<td class="formheaders">
										01
										</td>
									<td class="item_name_inactive" colspan="4">
										Center xxxx feet Cleared
										</td>
									</tr>	
								<tr>
									<td class="formheaders">
										02
										</td>
									<td class="item_name_inactive" colspan="4">
										Edges xxxx feet 1" 25% Compact Snow
										</td>
									</tr>									
								<tr>
									<td class="formheaders">
										03
										</td>
									<td class="item_name_inactive" colspan="4">
										1" Dry Snow Over 50% Compacted Snow
										</td>
									</tr>									
								<tr>
									<td class="formheaders">
										04
										</td>
									<td class="item_name_inactive" colspan="4">
										130 Feet Wide Reaming Edges Compacted Snow
										</td>
									</tr>									
										
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	
<script type="text/javascript">

	function displayRow(status){
		
		if(status == 'on') {
				var row = document.getElementById("slipwhere1");
				row.style.display = '';
				var row = document.getElementById("slipwhere2");
				row.style.display = '';
				var row = document.getElementById("slipwhere3");
				row.style.display = '';
		}
		else {
				var row = document.getElementById("slipwhere1");
				row.style.display = 'none';
				var row = document.getElementById("slipwhere2");
				row.style.display = 'none';
				var row = document.getElementById("slipwhere3");
				row.style.display = 'none';
		}

	}
	</script>

		
	<script type="text/javascript">
	
		function updateparentfieldvalue(fieldname,fieldvalue) {
			//parent.document.getElementById(fieldname).value = fieldvalue;
			if (parent.document.getElementById(fieldname).value == "") {
					parent.document.getElementById(fieldname).value = fieldvalue;
				}
				else {
					parent.document.getElementById(fieldname).value = parent.document.getElementById(fieldname).value + " " + fieldvalue;
			
				}
			}
		
		function buildparentform(fieldname,fieldvalue) {
				// Reset Field to nothing
				parent.document.getElementById(fieldname).value = '';
				// Load New information
				var fieldvalue = document.getElementById('report').value;
				updateparentfieldvalue(fieldname,fieldvalue);
	
			}
	
		function buildmaxtrixreport() {
			
			// Skip Airport
			// Skip Surface
			// Condition Code
				var dgc_1 	= document.getElementById('dgc_1').value;
				var dgc_2 	= document.getElementById('dgc_2').value;
				var dgc_3 	= document.getElementById('dgc_3').value;
				
				var dgc_1n = dgc_1 * 1;
				var dgc_2n = dgc_2 * 1;
				var dgc_3n = dgc_3 * 1;
				
				var totaldgc = (dgc_1n + dgc_2n + dgc_3n);

				var max_d 	= document.getElementById('maxdepth').value;
				var max_c 	= document.getElementById('maxcover').value;
				var max_t 	= document.getElementById('maxtype').value;
				var rmk 	= document.getElementById('remarks').value;
				
				if(max_c == 10 || max_t == "Dry") {
						// This is NOT needed by ICAO, reject the maxtrix and subsidtue something else
						$report = "Clear and Dry";
				}
				else {
						
						if(max_t == "Dry" || max_t == "Frost" || max_t == "Compacted Snow" || max_t == "Ice" ) {
								// DO not place depth information in string
								max_d = "";
						}
						else {
								max_d = max_d + "(in)";
						}
								
						if(totaldgc == 18) {
							// All numbers are six, dont show the 6/6/6
							var rccode = "DRY";
						}
						else {
							var rccode = "" + escape(dgc_1) + "/" + escape(dgc_2) + "/" + escape(dgc_3) + "";
						}
						
						if(rmk == '') {
							// Nothing in the cell, default to *
							var rmk_txt = "*";
						}
						else {
							var rmk_txt = "rmk: " + rmk;
						}
							
							
					// Assemble Maxtrix Report
						$report		= "" + escape(rccode) + " " + escape(max_c) + "% " + (max_d) + "" + (max_t) + " (" + (rmk_txt) + ") ";
				
				}
				
			document.getElementById('report').value = $report;
			
		}
	
	
		function updatedowngradedcode(group) {
			
				var kockback 		= 1;
				var depthcharge 	= .3;
			
				if(group == '1') {
						var c_group = "c_group1";
						var d_group = "d_group1";
						var t_group = "t_group1";
						var mu		= "mu_1";
						var dwncode = "dgc_1";
						var upcode	= "rcc_1";
				}
				if(group == '2') {
						var c_group = "c_group2";
						var d_group = "d_group2";
						var t_group = "t_group2";
						var mu		= "mu_2";
						var dwncode = "dgc_2";
						var upcode	= "rcc_2";
				}
				if(group == '3') {
						var c_group = "c_group3";
						var d_group = "d_group3";
						var t_group = "t_group3";
						var mu		= "mu_3";
						var dwncode = "dgc_3";
						var upcode	= "rcc_3";
				}				
			
				// Now to determine if this surface needs to be downgraded
				// Setup Ranges....
				
				var g1_c = getRadioVal(c_group);
				var g1_d = getRadioVal(d_group);
				var g1_t = getRadioVal(t_group);
				
				g1_c = g1_c * 1;
				g1_d = g1_d * 1;
				g1_t = g1_t * 1;
				
				var rcc_code	= document.getElementById(upcode).value;
				var mucode		= document.getElementById(mu).value;
				
				rcc_code 			= rcc_code * 1;
				mucode				= mucode * 1;
				var downgraded_code = rcc_code ;
				
				if(rcc_code == 6 || rcc_code == 5) {
						// Runway Code is 6...
						// What is the Mu Value?
						if(mucode >= 40) {
								// Mu code is good.
								downgraded_code = rcc_code;
						}
						else {
								// Mu Code is bad... How far off is it?
								tp_mu 				= (40 - mucode);
								// This mu value os less than or equal to 40.  Take the difference times,
								//	the depthcharge times knockback;
								tmp_down 			= (tp_mu * depthcharge) * kockback;
								downgraded_code 	= (mucode - tmp_down);
								downgraded_code		= Math.round(downgraded_code);
						}
				}
				if(rcc_code == 4) {
						// Runway Code is 4
						var uprange 	= 39;
						var downrange	= 36;
						
						if(mucode >= uprange && mucode <= downrange) {
								// Mu Values is in range, do nothing
								downgraded_code = rcc_code;
						}
						if(mucode > uprange) {
								// Mu value is better than can be expected. 
								// Make adjustments as needed.
								tp_mu 				= (mucode - uprange);
								tmp_down 			= (tp_mu * depthcharge) * kockback;
								downgraded_code 	= (rcc_code + tmp_down);
								downgraded_code		= Math.round(downgraded_code);
						}
						if(mucode < downrange) {
								// Mu value is better than can be expected. 
								// Make adjustments as needed.
								tp_mu 				= (uprange - mucode);
								tmp_down 			= (tp_mu * depthcharge) * kockback;
								downgraded_code 	= (rcc_code - tmp_down);
								downgraded_code		= Math.round(downgraded_code);
						}
				}
				if(rcc_code == 3) {
						// Runway Code is 3
						var uprange 	= 35;
						var downrange	= 30;
						
						if(mucode >= uprange && mucode <= downrange) {
								// Mu Values is in range, do nothing
								downgraded_code = rcc_code;
						}
						if(mucode > uprange) {
								// Mu value is better than can be expected. 
								// Make adjustments as needed.
								tp_mu 				= (mucode - uprange);
								tmp_down 			= (tp_mu * depthcharge) * kockback;
								downgraded_code 	= (rcc_code + tmp_down);
								downgraded_code		= Math.round(downgraded_code);
						}
						if(mucode < downrange) {
								// Mu value is better than can be expected. 
								// Make adjustments as needed.
								tp_mu 				= (uprange - mucode);
								tmp_down 			= (tp_mu * depthcharge) * kockback;
								downgraded_code 	= (rcc_code - tmp_down);
								downgraded_code		= Math.round(downgraded_code);
						}
				}	
				if(rcc_code == 2) {
						// Runway Code is 2
						var uprange 	= 29;
						var downrange	= 26;
						
						if(mucode >= uprange && mucode <= downrange) {
								// Mu Values is in range, do nothing
								downgraded_code = rcc_code;
						}
						if(mucode > uprange) {
								// Mu value is better than can be expected. 
								// Make adjustments as needed.
								tp_mu 				= (mucode - uprange);
								tmp_down 			= (tp_mu * depthcharge) * kockback;
								downgraded_code 	= (rcc_code + tmp_down);
								downgraded_code		= Math.round(downgraded_code);
						}
						if(mucode < downrange) {
								// Mu value is better than can be expected. 
								// Make adjustments as needed.
								tp_mu 				= (uprange - mucode);
								tmp_down 			= (tp_mu * depthcharge) * kockback;
								downgraded_code 	= (rcc_code - tmp_down);
								downgraded_code		= Math.round(downgraded_code);
						}
				}	
				if(rcc_code == 1) {
						// Runway Code is 1
						var uprange 	= 26;
						var downrange	= 21;
						
						if(mucode >= uprange && mucode <= downrange) {
								// Mu Values is in range, do nothing
								downgraded_code = rcc_code;
						}
						if(mucode > uprange) {
								// Mu value is better than can be expected. 
								// Make adjustments as needed.
								tp_mu 				= (mucode - uprange);
								tmp_down 			= (tp_mu * depthcharge) * kockback;
								downgraded_code 	= (rcc_code + tmp_down);
								downgraded_code		= Math.round(downgraded_code);
						}
						if(mucode < downrange) {
								// Mu value is better than can be expected. 
								// Make adjustments as needed.
								tp_mu 				= (uprange - mucode);
								tmp_down 			= (tp_mu * depthcharge) * kockback;
								downgraded_code 	= (rcc_code - tmp_down);
								downgraded_code		= Math.round(downgraded_code);
						}
				}					
				if(rcc_code == 0) {
						// Runway Code is 0
						var uprange 	= 20;
						var downrange	= 0;
						
						if(mucode >= uprange && mucode <= downrange) {
								// Mu Values is in range, do nothing
								downgraded_code = rcc_code;
						}
						if(mucode > uprange) {
								// Mu value is better than can be expected. 
								// Make adjustments as needed.
								tp_mu 				= (mucode - uprange);
								tmp_down 			= (tp_mu * depthcharge) * kockback;
								downgraded_code 	= (rcc_code + tmp_down);
								downgraded_code		= Math.round(downgraded_code);
						}
						if(mucode < downrange) {
								// Mu value is better than can be expected. 
								// Make adjustments as needed.
								tp_mu 				= (uprange - mucode);
								tmp_down 			= (tp_mu * depthcharge) * kockback;
								downgraded_code 	= (rcc_code - tmp_down);
								downgraded_code		= Math.round(downgraded_code);
						}
				}	

				document.getElementById(dwncode).value = downgraded_code;
			
		}
	
	
	
		function updaterunwaycode(group) {
			// Update Runway Condition Code at the bottom of the form!!!!
			
			// What is the current temperature
			var temp_c = document.getElementById('temp').value;
			
			if(group == '1') {
					var c_group = "c_group1";
					var d_group = "d_group1";
					var t_group = "t_group1";
					var rcc_f 	= "rcc_1";
			}
			if(group == '2') {
					var c_group = "c_group2";
					var d_group = "d_group2";
					var t_group = "t_group2";
					var rcc_f 	= "rcc_2";
			}
			if(group == '3') {
					var c_group = "c_group3";
					var d_group = "d_group3";
					var t_group = "t_group3";
					var rcc_f 	= "rcc_3";
			}			
				
			// Do each 3rd
			
			// 1/3 
			var g1_c = getRadioVal(c_group);
			var g1_d = getRadioVal(d_group);
			var g1_t = getRadioVal(t_group);
			
			g1_c = g1_c * 1;
			g1_d = g1_d * 1;
			g1_t = g1_t * 1;			
			
			//alert(g1_c);
			//alert(g1_d);
			//alert(g1_t);
			
			if(g1_t == 0) {
					// Surface is Dry, nothing else matters
					var rcc_code = 6;
				}
			if(g1_t == 1) {
					// Surface is Wet, nothing else matters
					var rcc_code = 5;
				}	
			if(g1_t == 2) {
					// Surface is Slippery when Wet and its not Bon Jovi, nothing else matters
					var rcc_code = 3;
				}	
			if(g1_t == 3 || g1_t == 4) {
					// Surface has standing water or has slush
					if(g1_d > .125) {
							var rcc_code = 2;
						}
						else {
							var rcc_code = 5;
						}
				}
			if(g1_t == 5 || g1_t == 6) {
					// Surface is wet or Dry Snow
					if(g1_d <= .125) {
							var rcc_code = 5;
						}
						else {
							if(temp_c > -3) {
									var rcc_code = 2;
								}
								else {
									var rcc_code = 3;
								}
						}
				}
			if(g1_t == 7) {
					// Surface is compacted Snow
					// Depth isn't relevent only temp
					if(temp_c > -3) {
							var rcc_code = 2;
						}
						else {
							if(temp_c <= -13) {
									var rcc_code = 4;
								}
								else {
									var rcc_code = 3;
								}
						}
				}
			if(g1_t == 8) {
					// Surface is Frost, Nothing else matters
					var rcc_code = 5;
				}						
			if(g1_t == 9) {
					// Surface is Ice
					if(temp_c > -3) {
							var rcc_code = 0;
						}
						else {
							var rcc_code = 1;
						}
				}
			if(g1_t == 10) {
					// Surface is Frost, Nothing else matters
					var rcc_code = 0;
				}				

				
			document.getElementById(rcc_f).value = rcc_code;
			
			return false;
			
			}
			
			
			
			function forceupdate() {
			
					updaterunwaycode('1');
					updaterunwaycode('2');
					updaterunwaycode('3');
					
					updatedowngradedcode('1');
					updatedowngradedcode('2');
					updatedowngradedcode('3');
					
					buildmaxtrixreport();
					
					buildparentform('<?php echo $fieldname;?>','whocaresnotusedlikethis');
				}
			</script>


	<script type="text/javascript">

		function getRadioVal(radioName) {
			var rads = document.getElementsByName(radioName);

			for(var rad in rads) {
				if(rads[rad].checked)
					return rads[rad].value;
				}

			return null;
			
			}			

		function updateslippery(surfacetype) {
			// Surface is slippery, now to populate the maxtype field with the slippery information
			// Get Distance Type
			var g1 = getRadioVal("sl_group1");
			var gd = document.getElementById("sl_long").value;
			//alert(gd);
			
			if(g1 == "ENTIRE") {
					// Do nothing. The runway will be Wet (SLIPPERY) already anyway
					g1 = g1;
					document.getElementById("maxtype").value = "Wet (Slippery)";
			}
			else {
					// Assemble new language for maxcover fiel input box
					var maxtype = "Wet (" + escape(surfacetype) + "), " + escape(g1) + " " + escape(gd) + "' Wet (Slippery)";
					document.getElementById("maxtype").value = maxtype;
					//alert(maxtype);
					buildmaxtrixreport();
			}

		}
			
		function updatemaxcover() {
			// Update Max Cover Field
			var g1 = getRadioVal("c_group1");
			var g2 = getRadioVal("c_group2");
			var g3 = getRadioVal("c_group3");
			
			g1 = g1 * 1;
			g2 = g2 * 1;
			g3 = g3 * 1;
			
			var maxcover = Math.max(g1,g2,g3);
			
			document.getElementById('maxcover').value = maxcover;	
			
			forceupdate();
			
			}
			
		function updatemaxdepth() {
			// Update Max Cover Field
			var g1 = getRadioVal("d_group1");
			var g2 = getRadioVal("d_group2");
			var g3 = getRadioVal("d_group3");
			
			g1 = g1 * 1;
			g2 = g2 * 1;
			g3 = g3 * 1;
			
			var maxcover 	= Math.max(g1,g2,g3);
			var maxtype_txt = maxcover;
			
			
			if(maxcover == .125) {
				maxtype_txt = "1/8";
				}				
			if(maxcover == .250) {
				maxtype_txt = "1/4";
				}	
			if(maxcover == .500) {
				maxtype_txt = "1/2";
				}				
			if(maxcover == .750) {
				maxtype_txt = "3/4";
				}			
			
			document.getElementById('maxdepth').value = maxtype_txt;
			
			forceupdate();			
			
			}	
			
		function updatemaxtype(surfacetype) {
			// Update Max Cover Field
			var g1 = getRadioVal("t_group1");
			var g2 = getRadioVal("t_group2");
			var g3 = getRadioVal("t_group3");
			
			g1 = g1 * 1;
			g2 = g2 * 1;
			g3 = g3 * 1;
			
			var maxcover = Math.max(g1,g2,g3);
			
			if(maxcover == 2) {
					displayRow('on');
			}
			else {
					displayRow('off');
			}
			
			if(maxcover == 0) {
				var maxtype_txt = "Dry";
				}				
			if(maxcover == 1) {
				var maxtype_txt = "Wet (" + escape(surfacetype) + ") ";
				}		
			if(maxcover == 2) {
				var maxtype_txt = "Wet (Slippery)";
				}
			if(maxcover == 3) {
				var maxtype_txt = "Standing Water";
				}
			if(maxcover == 4) {
				var maxtype_txt = "Slush";
				}
			if(maxcover == 5) {
				var maxtype_txt = "Dry Snow";
				}
			if(maxcover == 6) {
				var maxtype_txt = "Wet Snow";
				}		
			if(maxcover == 7) {
				var maxtype_txt = "Compacted Snow";
				}	
			if(maxcover == 8) {
				var maxtype_txt = "Frost";
				}
			if(maxcover == 9) {
				var maxtype_txt = "Ice";
				}	
			if(maxcover == 10) {
				var maxtype_txt = "Wet Ice";
				}				
				
			document.getElementById('maxtype').value = maxtype_txt;	
			
			forceupdate();			
			
			}
		</script>
<?php
// Load End of page includes

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
	
		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>	