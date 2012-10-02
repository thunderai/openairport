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
	<table border="0" cellpadding="1" cellspacing="1" width="100%" class="formheaders">
		<tr>
			<td colspan="2" class="tableheadercenter">
				Runway Condition Report - Data Collection Sheet
				</td>
			</tr>
		<tr>
			<td colspan="2">
				<table border="0" cellpadding="1" cellspacing="1" width="100%">
					<tr>
						<td class="formheaders">
							Airport
							</td>
						<td class="formresults">
							KATY
							</td>
						<td rowspan="2" class="formheaders">

							</td>
						<td class="formheaders">
							Time
							</td>
						<td class="formresults">
							<?php echo date('H:m:s');?>
							</td>
						</tr>
					<tr>
						<td class="formheaders">
							Surface
							</td>
						<td class="formresults">
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
						<td class="formheaders">
							Date
							</td>
						<td class="formresults">
							<?php echo date('Y/M/d');?>
							</td>
						</tr>
							
					</table>
				</td>
			</tr>
		<tr>
			<td>
				<table border="0" cellpadding="1" cellspacing="1" width="100%">
					<tr>
						<td colspan="3" class="formanswers" />
							Select a Form from the Menu buttons below
							</td>
						</tr>
					
					<tr>				
						<td align="center" class="formresults" width="80">
							<table border="0" cellspacing="0" cellpadding="0" width="100%" id="table1" class="formsubmit">
								<tr>
									<td class="formoptionsubmit" onMouseover="ddrivetip('Click to Show Required Items')"; onMouseout="hideddrivetip()" onclick="javascript:toggle_339c('ri');" />
										Required Items
										</td>
									</tr>
								</table>
							</td>
						<td align="center" class="formresults" width="80">
							<table border="0" cellspacing="0" cellpadding="0" width="100%" id="table1" class="formsubmit">
								<tr>
									<td class="formoptionsubmit" onMouseover="ddrivetip('Click to  Show Additional Items')"; onMouseout="hideddrivetip()" onclick="javascript:toggle_339c('ai');" />
										Additional Items
										</td>
									</tr>
								</table>
							</td>				
						<td align="center" class="formresults" width="80">
							<table border="0" cellspacing="0" cellpadding="0" width="100%" id="table1" class="formsubmit">
								<tr>
									<td class="formoptionsubmit" onMouseover="ddrivetip('Click to  Show Surface Properties')"; onMouseout="hideddrivetip()" onclick="javascript:toggle_339c('si');" />
										Surface Properties
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
<div name="ri" id="ri" width="100%" style="position: absolute;
							  left: 0px;
							  top: 150px;
							  width: 100%;"
							 />
	<table border="0" cellpadding="1" cellspacing="1" width="100%" class="formheaders"/>
		<tr>
			<td align="left" valign="top">
				<table border="0" cellpadding="1" cellspacing="1" width="100%">
					<tr>
						<td colspan="4" class="formheaders">
							% Coverage
							</td>
						</tr>
					<tr>
						<td colspan="5" class="formresults">
							Required: Step One <br>
							Click Cover %
							</td>
						</tr>									
					<tr>
						<td class="formoptions">
							%
							</td>
						<td class="formoptions">
							1/3
							</td>	
						<td class="formoptions">
							2/3
							</td>
						<td class="formoptions">
							3/3
							</td>										
						</tr>
					<tr>
						<td class="formoptions">
							10%
							</td>
						<td class="formresults">
							<input type="radio" name="c_group1" id="c_group1"	value="10" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="formresults">
							<input type="radio" name="c_group2" id="c_group2"	value="10" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="formresults">
							<input type="radio" name="c_group3" id="c_group3"	value="10" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>									
						</tr>
					<tr>
						<td class="formoptions">
							25%
							</td>
						<td class="formresults">
							<input type="radio" name="c_group1" id="c_group1"	value="25" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="formresults">
							<input type="radio" name="c_group2" id="c_group2"	value="25" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="formresults">
							<input type="radio" name="c_group3" id="c_group3"	value="25" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							50%
							</td>
						<td class="formresults">
							<input type="radio" name="c_group1" id="c_group1"	value="50" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="formresults">
							<input type="radio" name="c_group2" id="c_group2"	value="50" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="formresults">
							<input type="radio" name="c_group3" id="c_group3"	value="50" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>									
						</tr>
					<tr>
						<td class="formoptions">
							75%
							</td>
						<td class="formresults">
							<input type="radio" name="c_group1" id="c_group1"	value="75" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="formresults">
							<input type="radio" name="c_group2" id="c_group2"	value="75" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="formresults">
							<input type="radio" name="c_group3" id="c_group3"	value="75" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>								
						</tr>
					<tr>
						<td class="formoptions">
							100%
							</td>
						<td class="formresults">
							<input type="radio" name="c_group1" id="c_group1"	value="100" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="formresults">
							<input type="radio" name="c_group2" id="c_group2"	value="100" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>
						<td class="formresults">
							<input type="radio" name="c_group3" id="c_group3"	value="100" maxlength="2"  onchange="javascript:updatemaxcover();" />
							</td>									
						</tr>
					<tr>
						<td class="formoptions">
							Max
							</td>
						<td class="formresults" colspan="3">
							<INPUT type="text" name="maxcover" id="maxcover" value="0" size="2" disabled="disabled">
							</td>
						</tr>
					<tr>
						<td colspan="4" class="formheaders">
							Temperatures
							</td>
						</tr>	
					<tr>
						<td class="formoptions">
							Temp
							</td>
						<td class="formoptions" colspan="3">
							O.A.T.
							</td>										
						</tr>									
					<tr>
						<td class="formoptions">
							C 
							</td>
						<td class="formresults" colspan="3">
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
				<table border="0" cellpadding="1" cellspacing="1" width="100%">
					<tr>
						<td colspan="4" class="formheaders">
							Contaminant Depth
							</td>
						</tr>
					<tr>
						<td colspan="5" class="formresults">
							Required: Step Two <br>
							Click the Depth
							</td>
						</tr>									
					<tr>
						<td class="formoptions">
							Inches
							</td>
						<td class="formoptions">
							1/3
							</td>	
						<td class="formoptions">
							2/3
							</td>
						<td class="formoptions">
							3/3
							</td>										
						</tr>
					<tr>
						<td class="formoptions">
							1/8"
							</td>
						<td class="formresults">
							<input type="radio" name="d_group1" id="d_group1"	value=".125" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group2" id="d_group2"	value=".125" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group3" id="d_group3"	value=".125" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							1/4"
							</td>
						<td class="formresults">
							<input type="radio" name="d_group1" id="d_group1"	value=".250" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group2" id="d_group2"	value=".250" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group3" id="d_group3"	value=".250" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							1/2"
							</td>
						<td class="formresults">
							<input type="radio" name="d_group1" id="d_group1"	value=".500" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group2" id="d_group2"	value=".500" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group3" id="d_group3"	value=".500" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							3/4"
							</td>
						<td class="formresults">
							<input type="radio" name="d_group1" id="d_group1"	value=".750" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group2" id="d_group2"	value=".750" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group3" id="d_group3"	value=".750" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							1"
							</td>
						<td class="formresults">
							<input type="radio" name="d_group1" id="d_group1"	value="1" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group2" id="d_group2"	value="1" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group3" id="d_group3"	value="1" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							2"
							</td>
						<td class="formresults">
							<input type="radio" name="d_group1" id="d_group1"	value="2" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group2" id="d_group2"	value="2" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group3" id="d_group3"	value="2" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							3"
							</td>
						<td class="formresults">
							<input type="radio" name="d_group1" id="d_group1"	value="3" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group2" id="d_group2"	value="3" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group3" id="d_group3"	value="3" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							4" +
							</td>
						<td class="formresults">
							<input type="radio" name="d_group1" id="d_group1"	value="4" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group2" id="d_group2"	value="4" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>
						<td class="formresults">
							<input type="radio" name="d_group3" id="d_group3"	value="4" maxlength="2"  onchange="javascript:updatemaxdepth();" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							Max
							</td>
						<td class="formresults" colspan="3">
							<INPUT type="text" name="maxdepth" id="maxdepth" value="0" size="4" disabled="disabled">
							</td>
						</tr>									
					</table>
				</td>
			<td align="left" valign="top" rowspan="2">
				<table border="0" cellpadding="1" cellspacing="1" width="100%">
					<tr>
						<td colspan="4" class="formheaders">
							Contaminant Type
							</td>
						</tr>
					<tr>
						<td colspan="5" class="formresults">
							Required: Step Three <br>
							Click the Contaiment Type
							</td>
						</tr>									
					<tr>
						<td class="formoptions">
							Type
							</td>
						<td class="formoptions">
							1/3
							</td>	
						<td class="formoptions">
							2/3
							</td>
						<td class="formoptions">
							3/3
							</td>										
						</tr>
					<tr>
						<td class="formoptions">
							Dry
							</td>
						<td class="formresults">
							<input type="radio" name="t_group1" id="t_group1"	value="0" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group2" id="t_group2"	value="0" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group3" id="t_group3"	value="0" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							Wet
							</td>
						<td class="formresults">
							<input type="radio" name="t_group1" id="t_group1"	value="1" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group2" id="t_group2"	value="1" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group3" id="t_group3"	value="1" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							Wet (slip)
							</td>
						<td class="formresults">
							<input type="radio" name="t_group1" id="t_group1"	value="2" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group2" id="t_group2"	value="2" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group3" id="t_group3"	value="2" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>
					<tr name="slipwhere2" id="slipwhere2" style="display:none;">
						<td class="formoptions">
							Slip Where
							</td>
						<td class="formoptions">
							F
							</td>
						<td class="formoptions">
							E
							</td>
						<td class="formoptions">
							L
							</td>
						</tr>
					<tr name="slipwhere3" id="slipwhere3" style="display:none;">
						<td class="formoptions" align="right">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Frt/Lst/Etr ?
							</td>
						<td class="formresults">
							<input type="radio" name="sl_group1" id="sl_group1"	value="FIRST" maxlength="10"  onchange="javascript:updateslippery('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="sl_group1" id="sl_group1"	value="ENTIRE" maxlength="10"  onchange="javascript:updateslippery('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="sl_group1" id="sl_group1"	value="LAST" maxlength="10"  onchange="javascript:updateslippery('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>
					<tr name="slipwhere1" id="slipwhere1" style="display:none;">
						<td class="formoptions" align="right">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dist in Ft
								</td>
						<td class="formresults" colspan="3">
							<input type="text" name="sl_long" id="sl_long"	value="0" maxlength="10"  size="10" onchange="javascript:updateslippery('<?php echo $surfacetype;?>');" style="background-color: #FFFF66;" />
							</td>									
						</tr>
					<tr>
						<td class="formoptions">
							Water
							</td>
						<td class="formresults">
							<input type="radio" name="t_group1" id="t_group1"	value="3" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group2" id="t_group2"	value="3" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group3" id="t_group3"	value="3" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							Slush
							</td>
						<td class="formresults">
							<input type="radio" name="t_group1" id="t_group1"	value="4" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group2" id="t_group2"	value="4" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group3" id="t_group3"	value="4" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							Dry Snow
							</td>
						<td class="formresults">
							<input type="radio" name="t_group1" id="t_group1"	value="5" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group2" id="t_group2"	value="5" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group3" id="t_group3"	value="5" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							Wet Snow
							</td>
						<td class="formresults">
							<input type="radio" name="t_group1" id="t_group1"	value="6" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group2" id="t_group2"	value="6" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group3" id="t_group3"	value="6" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>									
					<tr>
						<td class="formoptions">
							Compact Snow
							</td>
						<td class="formresults">
							<input type="radio" name="t_group1" id="t_group1"	value="7" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group2" id="t_group2"	value="7" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group3" id="t_group3"	value="7" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>
					<tr>
						<td class="formoptions">
							Frost
							</td>
						<td class="formresults">
							<input type="radio" name="t_group1" id="t_group1"	value="8" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group2" id="t_group2"	value="8" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group3" id="t_group3"	value="8" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>
					<tr>
						<td class="formoptions">
							Ice
							</td>
						<td class="formresults">
							<input type="radio" name="t_group1" id="t_group1"	value="9" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group2" id="t_group2"	value="9" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group3" id="t_group3"	value="9" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>
					<tr>
						<td class="formoptions">
							Wet Ice Overlay
							</td>
						<td class="formresults">
							<input type="radio" name="t_group1" id="t_group1"	value="10" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group2" id="t_group2"	value="10" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>
						<td class="formresults">
							<input type="radio" name="t_group3" id="t_group3"	value="10" maxlength="2"  onchange="javascript:updatemaxtype('<?php echo $surfacetype;?>');" />
							</td>									
						</tr>
					<tr>
						<td class="formoptions">
							Max
							</td>
						<td class="formresults" colspan="3">
							<INPUT type="text" name="maxtype" id="maxtype" value="0" size="13" disabled="disabled">
							</td>
						</tr>									
					</table>
				</td>
			</tr>
		</table>
	<table width="100%" cellpadding="1" cellspacing="1" class="formheaders"/>
		<tr>
			<td align="left" valign="top"/>
				<table border="0" cellpadding="1" cellspacing="1" width="100%">
					<tr>
						<td class="formheaders">
							REMARKS
							</td>
						</tr>
					<tr>
						<td class="formoptions">
							<TEXTAREA rows="5" COLS="60" name="remarks" id="remarks"  onblur="javascript:forceupdate();" style="color: #FFFFFF;background-color: #666666;" /></TEXTAREA>
							</td>
						</tr>
					</table>
				</td>
			</tr>			
		<tr>
			<td colspan="2">
				<table border="0" cellpadding="1" cellspacing="1" width="100%">
					<tr>
						<td>
							<table border="0" cellpadding="1" cellspacing="1" width="100%">
								<tr>
									<td colspan="4" class="formheaders">
										Runway Condition Code
										</td>
									</tr>
								<tr>
									<td class="formoptions">
										1/3
										</td>
									<td class="formoptions">
										2/3
										</td>
									<td class="formoptions">
										3/3
										</td>
									</tr>
								<tr>
									<td class="formresults">
										<INPUT type="text" name="rcc_1" id="rcc_1" value="0" size="1" maxlength="1"  disabled="disabled"/>
										</td>
									<td class="formresults">
										<INPUT type="text" name="rcc_2" id="rcc_2" value="0" size="1" maxlength="1"  disabled="disabled"/>
										</td>
									<td class="formresults">
										<INPUT type="text" name="rcc_3" id="rcc_3" value="0" size="1" maxlength="1"  disabled="disabled"/>
										</td>
									</tr>									
								</table>
							</td>
						<td>
							<table border="0" cellpadding="1" cellspacing="1" width="100%">
								<tr>
									<td colspan="4" class="formheaders">
										Mu Values
										</td>
									</tr>
								<tr>
									<td class="formoptions">
										1/3
										</td>
									<td class="formoptions">
										2/3
										</td>
									<td class="formoptions">
										3/3
										</td>
									</tr>
								<tr>
									<td class="formresults">
										<INPUT type="text" name="mu_1" id="mu_1" value="40" size="1" maxlength="2"  onblur="javascript:forceupdate();" style="background-color: #FFFF66;"/>
										</td>
									<td class="formresults">
										<INPUT type="text" name="mu_2" id="mu_2" value="40" size="1" maxlength="2"  onblur="javascript:forceupdate();" style="background-color: #FFFF66;"/>
										</td>
									<td class="formresults">
										<INPUT type="text" name="mu_3" id="mu_3" value="40" size="1" maxlength="2"  onblur="javascript:forceupdate();" style="background-color: #FFFF66;"/>
										</td>
									</tr>
								</table>
							</td>
						<td>
							<table border="0" cellpadding="1" cellspacing="1" width="100%">
								<tr>
									<td colspan="4" class="formheaders">
										Downgraded Runway Code
										</td>
									</tr>
								<tr>
									<td class="formoptions">
										1/3
										</td>
									<td class="formoptions">
										2/3
										</td>
									<td class="formoptions">
										3/3
										</td>
									</tr>
								<tr>
									<td class="formresults">
										<INPUT type="text" name="dgc_1" id="dgc_1" value="0" size="1" maxlength="1" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="formresults">
										<INPUT type="text" name="dgc_2" id="dgc_2" value="0" size="1" maxlength="1" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="formresults">
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
			<td colspan="2" align="left" valign="top" class="formheaders">
				Matrix Report
				</td>
			</tr>
		<tr>
			<td colspan="2" align="left" valign="top">
				<INPUT type="text" name="report" id="report" size="125" value="Maxtrix Report Text" disabled="disabled"/>
				</td>
			</tr>
		<tr>
			<td colspan="2" align="left" valign="top">
				&nbsp;<br><br>
				</td>
			</tr>			
		</table>
	</div>

<div name="ai" id="ai" width="100%" style="position: absolute;
							  left: 0px;
							  top: 150px;
							  width: 100%;
							  display:none;"
							 />
	<table border="0" cellpadding="1" cellspacing="1" width="100%" class="formheaders"/>
		<tr>
			<td align="left" valign="top">
				<table border="0" cellpadding="1" cellspacing="1" width="100%">
								<tr>
									<td colspan="5" class="formheaders">
										Contaminated Surface Width and Lengths
										</td>
									</tr>
								<tr>
									<td colspan="5" class="formresults">
										Extra: Step Four <br>
										Used to add more indepth detail.  See the end of the form for some examples on how to use this feature.
										</td>
									</tr>
								<tr>
									<td class="formheaders" onMouseover="ddrivetip('Select an Area to use in building this additional information.')"; onMouseout="hideddrivetip()" />
										Area
										</td>
									<td class="formheaders">
										Distance (Width or Length)
										</td>
									<td class="formheaders">
										% of Contaminate Cover
										</td>
									<td class="formheaders">
										Depth of Contaminate
										</td>
									<td class="formheaders">
										Treatment
										</td>	
									</tr>
								<tr>
									<td class="formresults">
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
									<td class="formresults">
										<input type="text" name="swl_1_feet" id="swl_1_feet" size="2" maxlength="4" value="<?php echo $surfacewidth;?>" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="formresults">
										<select name="swl_1_cover" id="swl_1_cover" style="color: #FFFFFF;background-color: #666666;" />
											<option value="10"	>10%</option>
											<option value="25"	>25%</option>
											<option value="50"	>50%</option>
											<option value="75"	>75%</option>
											<option value="100"	>100%</option>
											</select>
										</td>		
									<td class="formresults">
										<input type="text" name="swl_1_depth" id="swl_1_depth" size="2" maxlength="2" value="0" style="color: #FFFFFF;background-color: #666666;" />
										</td>										
									<td class="formresults">
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
									<td class="formresults">
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
									<td class="formresults">
										<input type="text" name="swl_2_feet" id="swl_2_feet" size="2" maxlength="4" value="<?php echo $surfacewidth;?>" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="formresults">
										<select name="swl_2_cover" id="swl_2_cover" style="color: #FFFFFF;background-color: #666666;" />
											<option value="10"	>10%</option>
											<option value="25"	>25%</option>
											<option value="50"	>50%</option>
											<option value="75"	>75%</option>
											<option value="100"	>100%</option>
											</select>
										</td>		
									<td class="formresults">
										<input type="text" name="swl_2_depth" id="swl_2_depth" size="2" maxlength="2" value="0" style="color: #FFFFFF;background-color: #666666;" />
										</td>										
									<td class="formresults">
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
									<td class="formresults">
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
									<td class="formresults">
										<input type="text" name="swl_3_feet" id="swl_3_feet" size="2" maxlength="4" value="<?php echo $surfacewidth;?>" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="formresults">
										<select name="swl_3_cover" id="swl_3_cover" style="color: #FFFFFF;background-color: #666666;" />
											<option value="10"	>10%</option>
											<option value="25"	>25%</option>
											<option value="50"	>50%</option>
											<option value="75"	>75%</option>
											<option value="100"	>100%</option>
											</select>
										</td>
									<td class="formresults">
										<input type="text" name="swl_3_depth" id="swl_3_depth" size="2" maxlength="2" value="0" style="color: #FFFFFF;background-color: #666666;" />
										</td>										
									<td class="formresults">
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
									<td class="formresults">
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
									<td class="formresults">
										<input type="text" name="swl_4_feet" id="swl_4_feet" size="2" maxlength="4" value="<?php echo $surfacewidth;?>" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="formresults">
										<select name="swl_4_cover" id="swl_4_cover" style="color: #FFFFFF;background-color: #666666;" />
											<option value="10"	>10%</option>
											<option value="25"	>25%</option>
											<option value="50"	>50%</option>
											<option value="75"	>75%</option>
											<option value="100"	>100%</option>
											</select>
										</td>	
									<td class="formresults">
										<input type="text" name="swl_4_depth" id="swl_4_depth" size="2" maxlength="2" value="0" style="color: #FFFFFF;background-color: #666666;" />
										</td>
									<td class="formresults">
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
									<td class="formheaders" onMouseover="ddrivetip('Clicking this button will <b>ONLY</b> update the Max field below. No other pages will be affected. \n Any Lines with an Area of <i>SELECT</i> will not be used.')"; onMouseout="hideddrivetip()" />
										Update
										</td>
									<td class="formresults" colspan="4">
										<button name="updateadded" id="updateadded">Update Values</button>
										</td>
									</tr>									
								<tr>
									<td class="formheaders">
										Max
										</td>
									<td class="formresults" colspan="4">
										<input type="text" name="swl_text" id="swl_text" value="" size="50" disabled="disabled"/>
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
									<td class="formresults" colspan="4">
										Center xxxx feet Cleared
										</td>
									</tr>	
								<tr>
									<td class="formheaders">
										02
										</td>
									<td class="formresults" colspan="4">
										Edges xxxx feet 1" 25% Compact Snow
										</td>
									</tr>									
								<tr>
									<td class="formheaders">
										03
										</td>
									<td class="formresults" colspan="4">
										1" Dry Snow Over 50% Compacted Snow
										</td>
									</tr>									
								<tr>
									<td class="formheaders">
										04
										</td>
									<td class="formresults" colspan="4">
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
			//opener.document.getElementById(fieldname).value = fieldvalue;
			if (opener.document.getElementById(fieldname).value == "") {
					opener.document.getElementById(fieldname).value = fieldvalue;
				}
				else {
					opener.document.getElementById(fieldname).value = opener.document.getElementById(fieldname).value + " " + fieldvalue;
			
				}
			}
		
		function buildparentform(fieldname,fieldvalue) {
				// Reset Field to nothing
				opener.document.getElementById(fieldname).value = '';
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
	
	<div style="position:fixed;bottom:-3px;left:0px;width:100%;z-index:2;">		
		<table width="100%">
			<tr>
				<td id="footernavigation" colspan="4" valign="top" align="center" height="1">
					<table border="0" cellpadding="0" cellspacing="0" class="formresults" width="100%">
						<tr>
							<td colspan="4" align="right" valign="top" height="1">
								<?php
								_tp_control_footbuttons(1,0,0,0);
								?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
<?php
// Load End of page includes

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>	