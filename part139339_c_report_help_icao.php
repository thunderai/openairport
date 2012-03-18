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
//	Name of Document		:	part139339_c_report_help_conditions.php
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
							<?php echo $facilityid;?>
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
			<td colspan="2">
				<table border="0" cellpadding="1" cellspacing="1" width="100%">
					<tr>
						<td align="left" valign="top">
							<table border="0" cellpadding="1" cellspacing="1" width="100%">
								<tr>
									<td colspan="4" class="formheaders">
										% Coverage
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
										<input type="radio" name="c_group1" id="c_group1"	value="10" onchange="javascript:updatemaxcover();" />
										</td>
									<td class="formresults">
										<input type="radio" name="c_group2" id="c_group2"	value="10" onchange="javascript:updatemaxcover();" />
										</td>
									<td class="formresults">
										<input type="radio" name="c_group3" id="c_group3"	value="10" onchange="javascript:updatemaxcover();" />
										</td>									
									</tr>
								<tr>
									<td class="formoptions">
										25%
										</td>
									<td class="formresults">
										<input type="radio" name="c_group1" id="c_group1"	value="25" onchange="javascript:updatemaxcover();" />
										</td>
									<td class="formresults">
										<input type="radio" name="c_group2" id="c_group2"	value="25" onchange="javascript:updatemaxcover();" />
										</td>
									<td class="formresults">
										<input type="radio" name="c_group3" id="c_group3"	value="25" onchange="javascript:updatemaxcover();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										50%
										</td>
									<td class="formresults">
										<input type="radio" name="c_group1" id="c_group1"	value="50" onchange="javascript:updatemaxcover();" />
										</td>
									<td class="formresults">
										<input type="radio" name="c_group2" id="c_group2"	value="50" onchange="javascript:updatemaxcover();" />
										</td>
									<td class="formresults">
										<input type="radio" name="c_group3" id="c_group3"	value="50" onchange="javascript:updatemaxcover();" />
										</td>									
									</tr>
								<tr>
									<td class="formoptions">
										75%
										</td>
									<td class="formresults">
										<input type="radio" name="c_group1" id="c_group1"	value="75" onchange="javascript:updatemaxcover();" />
										</td>
									<td class="formresults">
										<input type="radio" name="c_group2" id="c_group2"	value="75" onchange="javascript:updatemaxcover();" />
										</td>
									<td class="formresults">
										<input type="radio" name="c_group3" id="c_group3"	value="75" onchange="javascript:updatemaxcover();" />
										</td>								
									</tr>
								<tr>
									<td class="formoptions">
										100%
										</td>
									<td class="formresults">
										<input type="radio" name="c_group1" id="c_group1"	value="100" onchange="javascript:updatemaxcover();" />
										</td>
									<td class="formresults">
										<input type="radio" name="c_group2" id="c_group2"	value="100" onchange="javascript:updatemaxcover();" />
										</td>
									<td class="formresults">
										<input type="radio" name="c_group3" id="c_group3"	value="100" onchange="javascript:updatemaxcover();" />
										</td>									
									</tr>
								<tr>
									<td class="formoptions">
										Max
										</td>
									<td class="formresults" colspan="3">
										<INPUT type="text" name="maxcover" id="maxcover" value="0" size="2">
										</td>
									</tr>
								<tr>
									<td colspan="4" class="formheaders">
										Temperatures
										</td>
									</tr>	
								<tr>
									<td class="formoptions">
										Deg C
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
										<input type="text" name="temp" id="temp" value="<?php echo $tmp_temp_c;?>" size="4" maxlength="3"/>
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
										<input type="radio" name="d_group1" id="d_group1"	value=".125" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group2" id="d_group2"	value=".125" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group3" id="d_group3"	value=".125" onchange="javascript:updatemaxdepth();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										1/4"
										</td>
									<td class="formresults">
										<input type="radio" name="d_group1" id="d_group1"	value=".250" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group2" id="d_group2"	value=".250" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group3" id="d_group3"	value=".250" onchange="javascript:updatemaxdepth();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										1/2"
										</td>
									<td class="formresults">
										<input type="radio" name="d_group1" id="d_group1"	value=".500" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group2" id="d_group2"	value=".500" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group3" id="d_group3"	value=".500" onchange="javascript:updatemaxdepth();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										3/4"
										</td>
									<td class="formresults">
										<input type="radio" name="d_group1" id="d_group1"	value=".750" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group2" id="d_group2"	value=".750" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group3" id="d_group3"	value=".750" onchange="javascript:updatemaxdepth();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										1"
										</td>
									<td class="formresults">
										<input type="radio" name="d_group1" id="d_group1"	value="1" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group2" id="d_group2"	value="1" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group3" id="d_group3"	value="1" onchange="javascript:updatemaxdepth();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										2"
										</td>
									<td class="formresults">
										<input type="radio" name="d_group1" id="d_group1"	value="2" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group2" id="d_group2"	value="2" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group3" id="d_group3"	value="2" onchange="javascript:updatemaxdepth();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										3"
										</td>
									<td class="formresults">
										<input type="radio" name="d_group1" id="d_group1"	value="3" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group2" id="d_group2"	value="3" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group3" id="d_group3"	value="3" onchange="javascript:updatemaxdepth();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										4" +
										</td>
									<td class="formresults">
										<input type="radio" name="d_group1" id="d_group1"	value="4" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group2" id="d_group2"	value="4" onchange="javascript:updatemaxdepth();" />
										</td>
									<td class="formresults">
										<input type="radio" name="d_group3" id="d_group3"	value="4" onchange="javascript:updatemaxdepth();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										Max
										</td>
									<td class="formresults" colspan="3">
										<INPUT type="text" name="maxdepth" id="maxdepth" value="0" size="4">
										</td>
									</tr>									
									
									
								</table>
							</td>
						<td align="left" valign="top">
							<table border="0" cellpadding="1" cellspacing="1" width="100%">
								<tr>
									<td colspan="4" class="formheaders">
										Contaminant Type
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
										<input type="radio" name="t_group1" id="t_group1"	value="0" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group2" id="t_group2"	value="0" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group3" id="t_group3"	value="0" onchange="javascript:updatemaxtype();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										Wet
										</td>
									<td class="formresults">
										<input type="radio" name="t_group1" id="t_group1"	value="1" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group2" id="t_group2"	value="1" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group3" id="t_group3"	value="1" onchange="javascript:updatemaxtype();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										Wet (slip)
										</td>
									<td class="formresults">
										<input type="radio" name="t_group1" id="t_group1"	value="2" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group2" id="t_group2"	value="2" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group3" id="t_group3"	value="2" onchange="javascript:updatemaxtype();" />
										</td>									
									</tr>										
								<tr>
									<td class="formoptions">
										Water
										</td>
									<td class="formresults">
										<input type="radio" name="t_group1" id="t_group1"	value="3" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group2" id="t_group2"	value="3" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group3" id="t_group3"	value="3" onchange="javascript:updatemaxtype();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										Slush
										</td>
									<td class="formresults">
										<input type="radio" name="t_group1" id="t_group1"	value="4" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group2" id="t_group2"	value="4" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group3" id="t_group3"	value="4" onchange="javascript:updatemaxtype();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										Dry Snow
										</td>
									<td class="formresults">
										<input type="radio" name="t_group1" id="t_group1"	value="5" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group2" id="t_group2"	value="5" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group3" id="t_group3"	value="5" onchange="javascript:updatemaxtype();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										Wet Snow
										</td>
									<td class="formresults">
										<input type="radio" name="t_group1" id="t_group1"	value="6" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group2" id="t_group2"	value="6" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group3" id="t_group3"	value="6" onchange="javascript:updatemaxtype();" />
										</td>									
									</tr>									
								<tr>
									<td class="formoptions">
										Compact Snow
										</td>
									<td class="formresults">
										<input type="radio" name="t_group1" id="t_group1"	value="7" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group2" id="t_group2"	value="7" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group3" id="t_group3"	value="7" onchange="javascript:updatemaxtype();" />
										</td>									
									</tr>
								<tr>
									<td class="formoptions">
										Frost
										</td>
									<td class="formresults">
										<input type="radio" name="t_group1" id="t_group1"	value="8" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group2" id="t_group2"	value="8" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group3" id="t_group3"	value="8" onchange="javascript:updatemaxtype();" />
										</td>									
									</tr>
								<tr>
									<td class="formoptions">
										Ice
										</td>
									<td class="formresults">
										<input type="radio" name="t_group1" id="t_group1"	value="9" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group2" id="t_group2"	value="9" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group3" id="t_group3"	value="9" onchange="javascript:updatemaxtype();" />
										</td>									
									</tr>
								<tr>
									<td class="formoptions">
										Wet Ice Overlay
										</td>
									<td class="formresults">
										<input type="radio" name="t_group1" id="t_group1"	value="10" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group2" id="t_group2"	value="10" onchange="javascript:updatemaxtype();" />
										</td>
									<td class="formresults">
										<input type="radio" name="t_group3" id="t_group3"	value="10" onchange="javascript:updatemaxtype();" />
										</td>									
									</tr>
								<tr>
									<td class="formoptions">
										Max
										</td>
									<td class="formresults" colspan="3">
										<INPUT type="text" name="maxtype" id="maxtype" value="0" size="13">
										</td>
									</tr>										
									
								</table>
							</td>
						<td align="left" valign="top">
							<table border="0" cellpadding="1" cellspacing="1" width="100%">
								<tr>
									<td colspan="4" class="formheaders">
										REMARKS
										</td>
									</tr>
								<tr>
									<td colspan="4" class="formoptions">
										<TEXTAREA rows="23" COLS="10" name="remarks" id="remarks"></TEXTAREA>
										</td>
									</tr>
								</table>
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
										<INPUT type="text" name="rcc_1" id="rcc_1" value="0" size="1" />
										</td>
									<td class="formresults">
										<INPUT type="text" name="rcc_2" id="rcc_2" value="0" size="1" />
										</td>
									<td class="formresults">
										<INPUT type="text" name="rcc_3" id="rcc_3" value="0" size="1" />
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
										<INPUT type="text" name="mu_1" id="mu_1" value="0" size="1" onblur="javascript:forceupdate();" />
										</td>
									<td class="formresults">
										<INPUT type="text" name="mu_2" id="mu_2" value="0" size="1" onblur="javascript:forceupdate();" />
										</td>
									<td class="formresults">
										<INPUT type="text" name="mu_3" id="mu_3" value="0" size="1" onblur="javascript:forceupdate();" />
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
										<INPUT type="text" name="dgc_1" id="dgc_1" value="0" size="1" />
										</td>
									<td class="formresults">
										<INPUT type="text" name="dgc_2" id="dgc_2" value="0" size="1" />
										</td>
									<td class="formresults">
										<INPUT type="text" name="dgc_3" id="dgc_3" value="0" size="1" />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<tr>
			<td colspan="2" align="left" valign="top">
				Matrix Report
				</td>
			</tr>
		<tr>
			<td colspan="2" align="left" valign="top">
				<INPUT type="text" name="report" id="report" size="60" value="0" />
				</td>
			</tr>	
										<tr>
											<td colspan="2" class="formoptionsavilablebottom">
												<?php
													_tp_control_footbuttons(1,0,0,0);
												?>
												</td>
											</tr>			
		</table>
		
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
			// Max Cover
				var max_c 	= document.getElementById('maxcover').value;
			// Max Depth
				var max_d 	= document.getElementById('maxdepth').value;
			// Max Type
				var max_t 	= document.getElementById('maxtype').value;
			// Remarks
				var rmk 	= document.getElementById('remarks').value;
			// Assemble Maxtrix Report
				$report		= "" + escape(dgc_1) + "/" + escape(dgc_2) + "/" + escape(dgc_3) + " " + escape(max_c) + "% " + escape(max_d) + " (in) " + escape(max_t) + " " + escape(rmk) + " ";
				
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
			
			var maxcover = Math.max(g1,g2,g3);
			
			document.getElementById('maxdepth').value = maxcover;
			
			forceupdate();			
			
			}	
			
		function updatemaxtype() {
			// Update Max Cover Field
			var g1 = getRadioVal("t_group1");
			var g2 = getRadioVal("t_group2");
			var g3 = getRadioVal("t_group3");
			
			g1 = g1 * 1;
			g2 = g2 * 1;
			g3 = g3 * 1;
			
			var maxcover = Math.max(g1,g2,g3);
			
			if(maxcover == 0) {
				var maxtype_txt = "Dry";
				}				
			if(maxcover == 1) {
				var maxtype_txt = "Wet";
				}		
			if(maxcover == 2) {
				var maxtype_txt = "Wet/Slippery";
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
		
		</body>
	</html>