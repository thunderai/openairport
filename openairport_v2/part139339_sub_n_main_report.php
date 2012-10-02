<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139.339 Main Entry.php			The purpose of this page is to enter new Part 139.327 Airport Safety Self Inspections
	
								Usage:
								This is a complete custom form for the purposes of entering Part 139.327 inspections and should not be used as a template for another form
								unless that other form functions just like this one.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		//include("includes/header.php");																	// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/DateFunctions.php");													// already included in header.php
		include("includes/UserFunctions.php");													// already included in header.php
		include("includes/FormFunctions.php");													// already included in header.php
		include("includes/NavFunctions.php");													// already included in header.php
		
	// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.

?>
<HTML>
	<HEAD>
		<TITLE>
			Open Airport - Airport NOTAM (Printer Friendly)
			</TITLE>
		<script type="text/javascript" src="scripts/ajax.js"></script>
		<script type="text/javascript" src="scripts/AjaxRequest.js"></script>
		<script type="text/javascript" src="scripts/wz_jsgraphics.js"></script>
		<link href="reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<div style="position:absolute; z-index:1; left: 3; top: 74; width: 713; align="left">
		<img src="images/part_139_327/alp_inspection_new4_current.gif" width="701" height="840">
		</div>
	<div style="position:absolute; z-index:1; left: 0; top: 30; width: 713; align="left">
		<img src="images/part_139_339/139_339_overlaygrid2.gif" width="743" height="940">
		</div>
<?
		$discrepancybouncedid 	= "";
		$discrepancybounceddate 	= "";
		$discrepancybouncedtime 	= "";
		$discrepancyrepairid 		= "";
		$discrepancyrepairdate 	= "";
		$discrepancyrepairtime 	= "";
		$isduplicate			= "";
		$isarchived			= "";
		$displaydatarow			= "";
		$displaydiscrepancy 		= "";
		$rwy_loop_count			= 0;
		$tmp_rwy_mu			= 0;
		$previous_rwy_loop		= "";
		$current_rwy_loop		= "";
		
	$sql = "SELECT * FROM tbl_139_339_sub_n WHERE 139339_sub_n_id = '".$_POST['recordid']."' ";

	//make connection to database
	$objconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs = mysqli_query($objconn, $sql);
						
			if ($objrs) {
					$number_of_rows = mysqli_num_rows($objrs);
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {					

							// Initial Calculations
							$tmp_id_main	= $objarray['139339_sub_n_id'];
							$tmpdate 		= sqldate2amerdate($objarray['139339_sub_n_date']);
							$tmpstartdate 	= strtotime($tmpdate);
							$astartdate 	= getdate($tmpstartdate);
							$intstartday	= $astartdate ["weekday"];
							
							//Display Hard Text
							displaytxtonreport ("Watertown Regional Airport (KATY)"	, 1	, 2	, 13	, "Left"		, 300	, 10		,  85	,  3);
							displaytxtonreport($objarray['139339_sub_n_id']			, 1	, 1	, 13	, "Right"	,  30	, 690	,   0	,  3);
							displaytxtonreport("Notice to AirMen (NOTAM)"			, 1	, 5	, 13	, "Center"	, 713	,   0	,   3	,  3);
							displaytxtonreport("DATE"							, 1	, 2	, 13	, "Left"		, 190	,   5	,  32	,  3);
							displaytxtonreport($objarray['139339_sub_n_date']		, 1	, 2	, 13	, "Center"	, 190	,  95	,  32	,  3);
							displaytxtonreport("DAY"							, 1	, 2	, 13	, "Left"		, 190	, 290	,  32	,  3);
							displaytxtonreport("TIME"							, 1	, 2	, 13	, "Left"		, 190	,   5	,  52	,  3);
							displaytxtonreport($objarray['139339_sub_n_time']		, 1	, 2	, 13	, "Center"	, 190	,  95	,  52	,  3);
							displaytxtonreport("INSPECTED BY"					, 1	, 2	, 13	, "Left"		, 190	, 290	,  52	,  3);
							displaytxtonreport($objarray['139339_sub_n_notes']		, 1	, 2	, 13	, "Left"		, 415	,   5	,  865	,  3);
							displaytxtonreport($objarray['139339_sub_n_metar']		, 1	, 1	, 13	, "Center"	, 415	,   5	,  910	,  3	);			
							displaytxtonreport($intstartday						, 1	, 2	, 13	, "Center"	, 185	, 392	,  32	,  3	);
							
							?>
		<div style="position:absolute; z-index:12; left:385; top:52; width:190; align="center" />
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="185" id="AutoNumber1" height="13" />
				<tr align="center" />
					<td align="center" />
						<B>
						<?
						systemusercombobox($objarray['139339_sub_n_by_cb_int'], "all", "all", "hide", "all");
						?>
							</B>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:13; left:2; top:455; width:420; align="center" />
			<table border="1" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse" border="1" bordercolor="#000000">
				<tr>
					<td rowspan="1" align="center" valign="middle" width="60" style="border-style: solid; border-width: 1px" bordercolor="#000000" bgcolor="#808080">
							<font size="2"><B>Surface
						</td>
					<td rowspan="1" align="center" valign="middle" width="50" style="border-style: solid; border-width: 1px" bordercolor="#000000" bgcolor="#808080">
							<font size="2"><B>CLD ?
						</td>
					</tr>			
						<?
							// Define SQL
							$sql = "SELECT * FROM tbl_139_339_sub_n_cc
									INNER JOIN tbl_139_339_sub_c ON 139339_cc_c_cb_int = 139339_c_id 
									INNER JOIN tbl_139_339_sub_c_f ON 139339_f_id = 139339_c_facility_cb_int 
									WHERE 139339_cc_ficon_cb_int = '".$_POST['recordid']."' 
									ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";
							
							//echo $sql;
							
							// Establish a Conneciton with the Database
							$objcon = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
							
							if (mysqli_connect_errno()) {
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}
								else {
									$res = mysqli_query($objcon, $sql);
									if ($res) {
											$number_of_rows = mysqli_num_rows($res);
											//printf("result set has %d rows. \n", $number_of_rows);
					
											while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
													$tmpid 			= $objfields['139339_c_id'];
													$current_facility 	= $objfields['139339_c_facility_cb_int'];
													$current_facility_rwy	= $objfields['139339_f_rwy_yn'];
													$tmpcondname		= $objfields['139339_c_name'];
													$tmpcondnamestr		= str_replace(" ","",$tmpcondname);
													if ($current_facility!=$previous_facility) {
															//Row data has the same facility
																	//$rwy_loop_count		= 0;
																	//$previous_rwy_loop		= "";
																	//$current_rwy_loop		= "";
															?>
						</tr>								
					<tr>
      					<td align="left" valign="middle" name="<?=($objfields["139339_c_facility_cb_int"]);?>" style="border-style: solid; border-width: 1px" bordercolor="#000000">
      						&nbsp;
							<font size="2">
								<? 
								$tmpfacility = $objfields["139339_c_facility_cb_int"];
								part139339facilitycombobox($tmpfacility, "all", "notused", "hide", "all");
								?>
								</font>
							</td>
															<?
															}
															if ($current_facility_rwy == 1) {
																	//This facility is a runway.
																	IF ($objfields['139339_cc_type']==0) {
																			//Field is a Mu
																			//Step 2: Add one to the count loop
																				$rwy_loop_count	= ($rwy_loop_count + 1);
																				//echo "This is the ".$rwy_loop_count." field in this runway<br>";
																			//Step 1: Add value of the field to a temporary field to store the third value
																				$tmp_rwy_mu	= ($tmp_rwy_mu + $objfields["139339_cc_d_yn"]);
																				//echo "All Mus in this cycle = ".$tmp_rwy_mu." <br>";
																			//Step 3: If rwy_loop_count = 3 then average and display
																				if ($rwy_loop_count==3) {
																						//average value
																							$tmpaverage 	= ($tmp_rwy_mu/3);
																							$tmpaverage	= round($tmpaverage);
																						//Display Average
																							?>
						<td align="center" valign="middle" name="<?=($tmpcondnamestr);?>" style="border-style: solid; border-width: 1px" bordercolor="#000000">
      						<font size="2">
								<?
								echo $tmpaverage;
								?>
								</font>
							</td>
																							<?
																							//echo $tmpaverage;
																						//Reset counter
																							$rwy_loop_count = 0;
																						//Reset Value
																							$tmp_rwy_mu	= 0;
																					}
																		}
																		else {
																			?>
      					<td align="center" valign="middle" name="<?=($tmpcondnamestr);?>" style="border-style: solid; border-width: 1px" bordercolor="#000000">
      						<font size="2">
							<?
							switch ($objfields['139339_cc_type']) {
									case 0:
											echo $objfields["139339_cc_d_yn"];
											break;
									case 1:
											if ($objfields["139339_cc_d_yn"]==1) {
													// Display Yes
													echo "Yes";
												}
												else {
													//Display No
													echo "No";
												}
											break;
									case 2:
											echo $objfields["139339_cc_d_yn"];
											break;
									}
								?>
								</font>
							</td>																			
																			<?
																		}
																}
																else {
																		switch ($objfields['139339_cc_type']) {
																				case 0:
																						$tmpcolspan	= 3;
																						break;
																				case 1:
																						$tmpcolspan	= 1;
																						break;
																				case 2:
																						$tmpcolspan	= 1;
																						break;
																			}
																?>
      					<td colspan="<?=($tmpcolspan);?>" align="center" valign="middle" name="<?=($tmpcondnamestr);?>" style="border-style: solid; border-width: 1px" bordercolor="#000000">
      						<font size="2">
							<?
							switch ($objfields['139339_cc_type']) {
									case 0:
											echo $objfields["139339_cc_d_yn"];
											break;
									case 1:
											if ($objfields["139339_cc_d_yn"]==1) {
													// Display Yes
													echo "Yes";
												}
												else {
													//Display No
													echo "No";
												}
											break;
									case 2:
											echo $objfields["139339_cc_d_yn"];
											break;
								}
								?>								
								</font>
							</td>																		
															<?
																}
												$previous_facility	= $objfields['139339_c_facility_cb_int'];
												$i 				= $i + 1;
												}	// End of while loop
												mysqli_free_result($res);
												mysqli_close($objcon);
										}	// end of Res Record Object						
								}
								?>
					</table>
				</div>
					<?
					}
					}
					}
	// Step Two Display Anomali Information
	
	$OffSetX 		= -4;
	$OffSetY 		= 66;
	$tmpzindex 	= 14;
	
		$sql = "SELECT * FROM tbl_139_339_sub_n_d WHERE Discrepancy_inspection_id = '".$tmp_id_main."' ";
						
		$objconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");

		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs = mysqli_query($objconn, $sql);
		
				if ($objrs) {
						$number_of_rows = mysqli_num_rows($objrs);
						if ($number_of_rows==0) {
								//echo "There are no Anomalies associated with this Field Condition Report";
								//echo "no records found";
							}
							else {
								while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										// Loop through each anomalie attached to this field condition report and display them according to the type of anomalie they are
										if ($objarray['discrepancy_type_cb_int']==1) {
												// This anomalie is locaized
												$TempX 						= ($objarray['Discrepancy_location_x'] + $OffSetX );
												$TempY						= ($objarray['Discrepancy_location_y'] + $OffSetY );
												?>
												<div style="position:absolute; z-index:1; left:<?=$TempX-12;?>; top:<?=$TempY-10;?>; width:122; align="left">
													<table border="0" width="12%" cellspacing="0" cellpadding="0" id="table1" width="122">
														<tr>
															<td width="53"				align="right" 	valign="top" rowspan="4" 				background="images/part_139_327/dboxleftroller.gif"	><img border="0" 	src="images/part_139_327/dboxtarget.gif" width="53" 	height="58"></td>
															<td width="16" 	height="26"	align="left" 	valign="top"																	><img border="0" 	src="images/part_139_327/dboxid.gif" 	width="16" 	height="26"></td>
															<td width="83" 	height="26" align="left" 	valign="middle" bgcolor="#0000FF" style="border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom: 1px solid #000000">&nbsp;<font size="2" color="#FFFFFF"><?=$objarray['Discrepancy_id'];?></font></td>
															<td width="10" 	height="26" align="right" 	valign="top"																	><img border="0" 	src="images/part_139_327/dboxidright.gif" width="10" height="26"></td>
															</tr>
														<tr>
															<td width="83" 				align="left" 	valign="top" rowspan="4" colspan="2"											><img border="0" 	src="images/part_139_327/dboxidbottom.gif" width="83" height="3"><br>
																<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
																	<tr>
																		<td>
																			<font size="1">Name:</font>
																			</td>
																		</tr>
																	<tr>
																		<td background="images/part_139_327/dboxbackground.gif">
																			<font size="2"><b><?=$objarray['Discrepancy_name'];?></b></font>
																			</td>
																		</tr>
																	<tr>
																		<td>
																			<font size="1">Description:</font>
																			</td>
																		</tr>
																	<tr>
																		<td background="images/part_139_327/dboxbackground.gif">
																			<font size="3"><b><?=$objarray['discrepancy_remarks'];?></b></font>
																			</td>
																		</tr>
																	<tr>
																		<td>
																			<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
																				<tr>

																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>							
															<td width="8%" align="left" valign="top" background="images/part_139_327/dboxrightroller.gif" height="72"><img border="0" src="images/part_139_327/dboxrighttopcorner.gif" width="10" height="8"></td>
															</tr>
														<tr>
															<td width="8%" background="images/part_139_327/dboxrightroller.gif" height="19">&nbsp;</td>
															</tr>
														<tr>
															<td width="8%" background="images/part_139_327/dboxrightroller.gif" height="60">&nbsp;</td>
															</tr>
														<tr>
															<td rowspan="2" align="left" valign="top"><img border="0" src="images/part_139_327/dboxlefbottomcorner.gif" width="53" height="12"></td>
															<td width="8%" rowspan="2" align="left" valign="top"><img border="0" src="images/part_139_327/dboxrightbottomcorner.gif" width="10" height="12"></td>
															</tr>
														<tr>
															<td width="44%" colspan="2" align="left" valign="bottom" background="images/part_139_327/dboxbottomroller.gif"><img border="0" src="images/part_139_327/dboxbottom.gif" width="59" height="6"></td>
															</tr>
														</table>
													</div>
												<?
											}
											else {
												// Anomalie is an area
												$xaverage 	= 0;
												$xtotal	= 0;
												$yaverage 	= 0;
												$ytotal	= 0;
												?>
												<div id="myCanvas_<?=($objarray['Discrepancy_id']);?>" style="position:absolute;z-index:3;"></div>
													<script type="text/javascript">
													<!--
													function myDrawFunction() {
														// Get The current Numbers from the Edit Table, and set them to the variable.
														var xpoints = "<?=$objarray['discrepancy_xpoints'];?>";
														var ypoints = "<?=$objarray['discrepancy_ypoints'];?>";
														var xtotal = 0;
														var ytotal = 0;
														var xaverage = 0;
														var yaverage = 0;

														// Take apart the string values of the text fiel and put the strings into an array
														var xpoints=xpoints.split(",");
														var ypoints=ypoints.split(",");

														// In each array take the string and convert it into a number adjusting for mouse pointer error
														for (i=0; i<xpoints.length; ++i) {
														  xpoints[i] = xpoints[i] * 1 - 21;
														  xtotal = xtotal + xpoints[i];
														  } // for
														  xaverage = (xtotal/xpoints.length);
														for (i=0; i<ypoints.length; ++i) {
														  ypoints[i] = ypoints[i] * 1 + 48;  
														  ytotal = ytotal + ypoints[i];
														  } // for
														  yaverage = (ytotal/ypoints.length);

														// Draw the Pavement section
														jg.setColor("#ff000f"); // red
														jg.drawPolyline(xpoints, ypoints);
														jg.paint();
													}													

													var jg = new jsGraphics("myCanvas_<?=($objarray['Discrepancy_id']);?>");

													myDrawFunction();													
													//-->
													</script>
												<?
												// Now we need to center the label of this area.  TO do that we average the numbers in each x and y points.
												$tmpxpoints = (explode(",",$objarray['discrepancy_xpoints']));
												$tmpypoints = (explode(",",$objarray['discrepancy_ypoints']));
												//echo $tmpxpoints;
												for ($i=0; $i<count($tmpxpoints); $i=$i+1) {
												//echo  $tmpxpoints[$i];
													$xtotal = ($xtotal + $tmpxpoints[$i]);
													if ($i==0) {
															//nothing
														}
														else {
															$xaverage = ($xtotal/$i);
														}
													}
													$xaverage = ($xtotal/$i);
													//echo $xaverage;
												for ($i=0; $i<count($tmpypoints); $i=$i+1) {
													$ytotal = ($ytotal + $tmpypoints[$i]);
													if ($i==0) {
															//nothing
														}
														else {
															$yaverage = ($ytotal/$i);
														}
													}
												?>
												<div style="position:absolute; z-index:1; left:<?=$xaverage-12;?>; top:<?=$yaverage-10;?>; width:122; align="left">
													<font size="2"><b><?=$objarray['Discrepancy_name'];?></b></font><br>
													<font size="3"><b><?=$objarray['discrepancy_remarks'];?></b></font>
													</div>												
												<?
											}
									}
							}
					}
			}
?>
