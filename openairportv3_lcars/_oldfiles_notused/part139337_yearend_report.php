<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139.337 Chart Report.php			The purpose of this page is to enter new Part 139.337 Wildlife Hazard Management Reports
	
								Usage:
								This is a complete custom form for the purposes of entering Part 139.327 inspections and should not be used as a template for another form
								unless that other form functions just like this one.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		//include("includes/header.php");																	// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");																// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/DateFunctions.php");														// already included in header.php
		include("includes/UserFunctions.php");														// already included in header.php
		include("includes/FormFunctions.php");														// already included in header.php
		include("includes/NavFunctions.php");														// already included in header.php
		
	$tmpspecies	= "";
	$tmpcounter	= "";
	$tmplastspecies	= "";
	$fullcounter	= "";
	$displayedrow	= "";
		
	//Get Information from the FORM
		$tmpyear 		= $_POST['Year'];
		
		if (!isset($_POST['StatePermit'])) {
				// Option is not set
				$tmpsp	= 0;
			}
			else {
				// Option is set
				$tmpsp 		= $_POST['StatePermit'];
			}
			
		if (!isset($_POST['FederalPermit'])) {
				// Option is not set
				$tmpfp	= 0;
			}
			else {
				// Option is set
				$tmpfp 		= $_POST['FederalPermit'];
			}
		
	// Convert start date and end date into sql format
	
		$OffSetX 			= -4;
		$OffSetY 			= 66;
		$tmpzindex			= 14;
		
		$isarchived		= "";
		$isduplicate		= "";
		$displaydatarow		= "";
		$displaydiscrepancy 	= "";
		
		$i				= "";
		
?>
<HTML>
	<HEAD>
		<TITLE>
			Open Airport - Wildlife Hazard Management Year End Report
			</TITLE>
				<style type="text/css">

#dhtmltooltip {
position: absolute;
width: 150px;
border: 2px solid black;
padding: 2px;
background-color: lightyellow;
visibility: hidden;
z-index: 100;
/*Remove below line to remove shadow. Below line should always appear last within this CSS*/
filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);
}

</style>
		</HEAD>
	<Body>
	<center>
		<font size="5">
			Wildlife Year End Report
			</font>
		</center>
	<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13" />
		<tr align="left" />
			<td align="right" />
				<b>DATE</b>
				</td>
			<td align="center" />
				<?
				$tmpdate = date('m/d/Y');
				?>
				<b><?=$tmpdate;?></b>	
				</td>
			<td align="right" />
				<b>YEAR</b>
				</td>
			<td align="center" />
				<?=$tmpyear;?>
				</td>
			</tr>
		<tr align="left" />
			<td align="right" />
				<b>TIME</b>
				</td>
			<td align="center">
				<b>
					<?echo date('H:m:s');?>
					</b>
				</td>
			<td align="right" />
				<b>PERMITS</b>
				</td>
			<td align="center" />
				<?
				if ($tmpsp==1) {
						?>
						State
						<?
						if ($tmpfp==1) {
								?>
								and Federal
								<?
							}
					}
					else {		
						if ($tmpfp==1) {
								?>
								Federal
								<?
							}
							else {
								?>
								Any or None
								<?
							}
					}
				?>
				</td>
			</tr>
		</table>
	<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
	<?
	// Make sql Statement
	$sql = "SELECT * FROM tbl_139_337_main
	
	INNER JOIN tbl_139_337_sub_s ON tbl_139_337_main.139337_species_cb_int = tbl_139_337_sub_s.139337_sub_s_id
	WHERE YEAR(139337_date) = '".$tmpyear."' AND (139337_sub_s_statepermit = '".$tmpsp."' OR 139337_sub_s_federalpermit = '".$tmpfp."') ORDER BY 139337_sub_s_name";
	
	//echo "<br><br><br><br><br><br>".$sql;
	
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
					$totalnumberofdiscrepancies = mysqli_num_rows($objrs);
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
							$tmpspecies		= $objarray['139337_species_cb_int'];
						
							if ($tmplastspecies==$tmpspecies) {
									// If the last ID looked at is equal to the ID of this Record then we just need to display a datarow of the information without displaying a header row.
									?>
									<tr>
									<td align="center" valign="middle" >
											<?
											echo $objarray['139337_date'];
											?>
											</td>
									
										<td align="center" valign="middle" >
											<?
											$displayedrow	= 1;
											wildlifeactivitycombobox($objarray['139337_activity_cb_int'], 'all', 'all', 'hide', 'all')
											?>
											</td>
										<td align="center" valign="middle" >
											<?
											wildlifeactionscombobox($objarray['139337_action_cb_int'], 'all', 'all', 'hide', 'all')
											?>
											</td>
										<td align="center" valign="middle" >
											<?=$objarray['139337_resultsofaction'];?>
											</td>
										<td align="center" valign="middle" >
											<?
											echo $objarray['139337_numberofspecies'];
											
											$tmpcounter	= ($tmpcounter + $objarray['139337_numberofspecies']);
											$fullcounter 	= ($fullcounter + $objarray['139337_numberofspecies']);
											?>											
											</td>
										</tr>
									<?
								}
								else {
									// The ID of the last species is not the same as the current species ID
									if ($displayedrow=="") {
											// No row has been displayed
										}
										else{									
											?>
									<tr>
										<td colspan="5" align="center" valign="middle" >
											&nbsp;
											</td>
										</tr>
									<tr>
										<td colspan="2" align="center" valign="middle" bgcolor="#808080">
											<font color="#FFFFFF">
												Total Effected
												</font>
											</td>
										<td align="center" valign="middle" bgcolor="#808080">
											</td>
										<td align="center" valign="middle" bgcolor="#808080">
											</td>
										<td align="center" valign="middle" bgcolor="#808080">
											<font color="#FFFFFF">
												<?
												echo $tmpcounter;
												?>	
												</font>
											</td>
										</tr>
											<?
										}
										?>								
									<tr>
										<td colspan="5" bgcolor="#00000">
											<font color="#FFFFFF">
												<?
												$displayedrow	= 1;
												wildlifespeciescombobox($objarray['139337_species_cb_int'], 'all', 'all', 'hide', 'all')
												?>
												</font>
											</td>
										</tr>
									<tr>
										<td align="center" valign="middle" bgcolor="#COCOCO">
											Date
											</td>
										<td align="center" valign="middle" bgcolor="#COCOCO">
											Activity
											</td>
										<td align="center" valign="middle" bgcolor="#COCOCO">
											Action Taken
											</td>
										<td align="center" valign="middle" bgcolor="#COCOCO">
											Results
											</td>
										<td align="center" valign="middle" bgcolor="#COCOCO">
											# Affected
											</td>
										</tr>
									<tr>
										<td align="center" valign="middle" >
											<?
											echo $objarray['139337_date'];
											?>
											</td>
									
										<td align="center" valign="middle" >
											<?
											wildlifeactivitycombobox($objarray['139337_activity_cb_int'], 'all', 'all', 'hide', 'all')
											?>
											</td>
										<td align="center" valign="middle" >
											<?
											wildlifeactionscombobox($objarray['139337_action_cb_int'], 'all', 'all', 'hide', 'all')
											?>
											</td>
										<td align="center" valign="middle" >
											<?=$objarray['139337_resultsofaction']; ?>
											</td>
										<td align="center" valign="middle" >
											<?
											echo $objarray['139337_numberofspecies'];
											
											$tmpcounter		= ($objarray['139337_numberofspecies']);
											$fullcounter 	= ($fullcounter + $objarray['139337_numberofspecies']);
											?>	
											</td>
										</tr>									
									<?
									$tmplastspecies = $objarray['139337_species_cb_int'];
								}
						}	// End of While Statement
									if ($displayedrow=="") {
											// No row has been displayed
										}
										else{									
											?>
									<tr>
										<td colspan="5" align="center" valign="middle" >
											&nbsp;
											</td>
										</tr>
									<tr>
										<td colspan="2" align="center" valign="middle" bgcolor="#808080">
											<font color="#FFFFFF">
												Total Effected
												</font>
											</td>
										<td align="center" valign="middle" bgcolor="#808080">
											</td>
										<td align="center" valign="middle" bgcolor="#808080">
											</td>
										<td align="center" valign="middle" bgcolor="#808080">
											<font color="#FFFFFF">
												<?
												echo $tmpcounter;
												?>	
												</font>
											</td>
										</tr>
											<?
										}		
						?>
									<tr>
										<td colspan="4" align="center" valign="middle" >
											&nbsp;
											</td>
										</tr>
									<tr>
										<td colspan="2" align="center" valign="middle" >
											Total Species Effected
											</td>
										<td align="center" valign="middle" >
											</td>
										<td align="center" valign="middle" >
											</td>
										<td align="center" valign="middle" >
											<?
											echo $fullcounter;
											?>	
											</td>
										</tr>
									<?										
				}	// End of Exisiting Object Record Source
		}	// End if Establshed Connection
		?>
			</table>
		</div>
	<?php
	include("includes/_userinterface/_ui_footer.inc.php");		// include file that gets information from form POSTs for navigational purposes
?>	