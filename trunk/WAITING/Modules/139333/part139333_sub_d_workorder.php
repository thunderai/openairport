<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139.327 Main Workorder.php		The purpose of this page is to enter new Part 139.327 Airport Safety Self Inspections
	
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

	$OffSetX = -4;
	$OffSetY = 66;
	$tmpzindex = 14;
?>
<HTML>
	<HEAD>
		<TITLE>
			Open Airport - Airport Safety Self-Inspection Report (Printer Friendly)
			</TITLE>
		</HEAD>
	<div style="position:absolute; z-index:1; left:3; top:74; width:711; align="left" />
		<img src="images/part_139_327/alp_discrepancy_location.gif" width="711" height="849" />
		</div>
	<div style="position:absolute; z-index:2; left:0; top:30; width:717; align="left" />
		<img src="images/part_139_327/139_327_workorder_overlaygrid.gif" width="718" height="962" />
		</div>

<?
	$sql = "SELECT * FROM tbl_139_327_sub_d WHERE Discrepancy_id = '".$_POST['recordid']."' ";

	//echo $sql;
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
							?>
		<div style="position:absolute; z-index:3; left:690; top:0; width:30; align="center" />
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width"30" id="AutoNumber1" />
				<tr align="center" />
					<td align="right" />
						<font size="1" /><?=$objarray['Discrepancy_id'];?></font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:3; left:300; top:900; width:450; align="center" />
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width"450" id="AutoNumber1" />
				<tr align="center" />
					<td align="left" />
						&nbsp;<font size="1"></font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:4; left:0; top:0; width:713; align="center" />
			<center>
				<font size="5">
					Discrepancy Workorder Report
					</font>
				</center>
			</div>
		<div style="position:absolute; z-index:5; left:5; top:32; width:190; align="left" />
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13" />
				<tr align="left" />
					<td align="left" />
						<b>DATE</b>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:6; left:95; top:32; width:190; align="left" />
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13" />
				<tr align="center" />
					<td align="center" />
						<?
						$tmpdate = sqldate2amerdate($objarray['Discrepancy_date']);
						?>
						<b><?=$tmpdate;?></b>	
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:7; left:290; top:32; width:190; align="center" />
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13" />
				<tr align="left" />
					<td align="left" />
						<b>PRIORITY</b>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:8; left:392; top:32; width:185; align="center" />
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13" />
				<tr align="center" />
					<td align="center" />
						<?=$objarray['discrepancy_priority'];?>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:9; left:5; top:52; width:190; align="left" />
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13" />
				<tr align="left" />
					<td align="left" />
						<b>TIME</b>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:10; left:95; top:52; width:190; align="left" />
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13" />
				<tr align="center">
					<td align="center">
						<b>
							<?=$objarray['Discrepancy_time'];?>
							</b>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:11; left:290; top:52; width:190; align="center" />
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13" />
				<tr align="left" />
					<td align="left" />
						<b>NAME</b>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:12; left:392; top:52; width:190; align="center" />
			<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="185" id="AutoNumber1" height="13" />
				<tr align="center" />
					<td align="center" />
						<?=$objarray['Discrepancy_name'];?>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:13; left:2; top:385; width:296; align="center" />
			<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" />
				<tr>
					<td align="center" valign="top">
						<table border="0" width="90%" id="table1" cellpadding="0" style="border-collapse: collapse">
							<tr>
								<td style="padding-top: 5px"><font face="Arial Narrow"><b>Name:</b></font></td>
								</tr>
							<tr>
								<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
									<font face="Arial Narrow"><?=$objarray['Discrepancy_name'];?></font></td>
								</tr>
							<tr>
								<td style="padding-top: 5px"><font face="Arial Narrow"><b>Comments:</B></font></td>
								</tr>
							<tr>
								<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
									<font face="Arial Narrow"><?=$objarray['discrepancy_remarks'];?></font></td>
								</tr>
							</table>
						</td>
					</tr>
				<tr>
					<td align="center" valign="top">
						<table border="0" cellpadding="1" width="90%" id="table1" cellpadding="0" style="border-collapse: collapse">
							<?
							$sql2 = "SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = '".$_POST['recordid']."' AND discrepancy_bounced_archived_yn = 0";
							$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
							if (mysqli_connect_errno()) {
									// there was an error trying to connect to the mysql database
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}
								else {
									$objrs2 = mysqli_query($objconn2, $sql2);
									if ($objrs2) {
											$number_of_rows = mysqli_num_rows($objrs2);
											
											if ($number_of_rows >= 1) {
											?>
							<tr>
								<td colspan="3">
									<font face="Arial Narrow"><b>Bounced History:</B></font>
									</td>
								</tr>
							<tr>
								<td width="46" style="border-right:1px dotted #000000; font-family: arial narrow; font-size: 12px; color: #000000">
									Date
									</td>
								<td width="46" style="border-right:1px dotted #000000; font-family: arial narrow; font-size: 12px; color: #000000">
									Time
									</td>
								<td style="font-family: arial narrow; font-size: 12px; color: #000000;">
									Comments
									</td>
								</tr>
											<?
												}
												else {
													?>
													<?
												}
											while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	
													?>
							<tr>
								<td align="center" style="border-right:1px dotted #000000; font-family: arial narrow; font-size: 12px; color: #000000">
									<?=$objarray2['discrepancy_bounced_date'];?>
									</td>
								<td align="center" style="border-right:1px dotted #000000; font-family: arial narrow; font-size: 12px; color: #000000">
									<?=$objarray2['discrepancy_bounced_time'];?>
									</td>
								<td align="left" style="font-family: arial narrow; font-size: 12px; color: #000000;">
									&nbsp;<?=$objarray2['discrepancy_bounced_comments'];?>
									</td>
								</tr>
													<?
												}
										}
								}
							?>
							</table>
						</td>
					</tr>
				<tr>
					<td align="center" valign="top">
						<table border="0" cellpadding="1" width="90%" id="table1" cellpadding="0" style="border-collapse: collapse">
							<?
							$sql2 = "SELECT * FROM tbl_139_327_sub_d_r WHERE discrepancy_repaired_inspection_id = '".$_POST['recordid']."' AND discrepancy_repaired_archived_yn = 0";
							$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
							if (mysqli_connect_errno()) {
									// there was an error trying to connect to the mysql database
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}
								else {
									$objrs2 = mysqli_query($objconn2, $sql2);
									if ($objrs2) {
											$number_of_rows = mysqli_num_rows($objrs2);
											
											if ($number_of_rows >= 1) {
											?>
							<tr>
								<td colspan="3">
									<font face="Arial Narrow"><b>Repair History:</B></font>
									</td>
								</tr>
							<tr>
								<td width="46" style="border-right:1px dotted #000000; font-family: arial narrow; font-size: 12px; color: #000000">
									Date
									</td>
								<td width="46" style="border-right:1px dotted #000000; font-family: arial narrow; font-size: 12px; color: #000000">
									Time
									</td>
								<td style="font-family: arial narrow; font-size: 12px; color: #000000;">
									Comments
									</td>
								</tr>
											<?
												}
												else {
													?>
													<?
												}
											while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	
													?>
							<tr>
								<td align="center" style="border-right:1px dotted #000000; font-family: arial narrow; font-size: 12px; color: #000000">
									<?=$objarray2['discrepancy_repaired_date'];?>
									</td>
								<td align="center" style="border-right:1px dotted #000000; font-family: arial narrow; font-size: 12px; color: #000000">
									<?=$objarray2['discrepancy_repaired_time'];?>
									</td>
								<td align="left" style="font-family: arial narrow; font-size: 12px; color: #000000;">
									&nbsp;<?=$objarray2['discrepancy_repaired_comments'];?>
									</td>
								</tr>
													<?
												}
										}
								}
							?>
							</table>
						</td>
					</tr>
				<tr>
					<td align="center" valign="top">
						<table border="0" width="90%" id="table1" cellpadding="0" style="border-collapse: collapse">
							<tr>
								<td colspan="2" style="padding-top: 5px">
									<font face="Arial Narrow"><b>Date Completed:</b></font>
									</td>
								<td style="padding-top: 5px">
									<font face="Arial Narrow"><b>Time Completed:</b></font>
									</td>
								</tr>
							<tr>
								<td colspan="2" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
									<font face="Arial Narrow">&nbsp;</font>
									</td>
								<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
									<font face="Arial Narrow">&nbsp;</font>
									</td>
								</tr>
							<tr>
								<td colspan="3" style="padding-top: 5px"><font face="Arial Narrow"><b>Work Completed By:</b></font></td>
								</tr>
							<tr>
								<td colspan="3" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
									<font face="Arial Narrow">&nbsp;</font>
									</td>
								</tr>
							<tr>
								<td align="center" valign="top" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 0px">
									<font size="1" face="Arial Narrow">Last</font>
									</td>
								<td align="center" valign="top" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 0px">
									<font size="1" face="Arial Narrow">First</font>
									</td>
								<td align="center" valign="top" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 0px">
									<font size="1" face="Arial Narrow">Middle</font>
									</td>
								</tr>
							<tr>
								<td colspan="3" style="padding-top: 5px"><font face="Arial Narrow"><b>Work Performed:</B></font></td>
								</tr>
							<tr>
								<td colspan="3" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
									<font face="Arial Narrow">&nbsp;</font>
									</td>
								</tr>
							<tr>
								<td colspan="3" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
									<font face="Arial Narrow">&nbsp;</font>
									</td>
								</tr>
							<tr>
								<td colspan="3" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
									<font face="Arial Narrow">&nbsp;</font>
									</td>
								</tr>
							<tr>
								<td colspan="3" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
									<font face="Arial Narrow">&nbsp;</font>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				<tr>
				</table>
			</div>
			<?
			$TempX = ($objarray['Discrepancy_location_x'] + $OffSetX );
			$TempY = ($objarray['Discrepancy_location_y'] + $OffSetY );
			?>
		<div style="position:absolute; z-index:<?=$tmpzindex;?>; left:<?=$TempX;?>; top:<?=$TempY;?>; width:100; align="left" />
			<table border="0" cellpadding="0" cellspacing="0" borderCOLOR="#000000" width="100" id="AutoNumber1" />
  				<tr>
    					<td rowspan="2" width="31" height="31" align="left" valign="top" />
    						 <a href="" target="_new" />
							<img border="0" src="images/part_139_327/discrepancywork3.gif" width="31" height="31" border="0" alt="(<?=$objarray['Discrepancy_id'];?>)&nbsp;|&nbsp;<?=$objarray['Discrepancy_name'];?>" >
							</a>
						</td>
    					<td width="10" align="left" valign="middle" bgcolor="#FF0000" />
						<font size="1" color="FFFFFF" /><b>&nbsp;ID :</b></font>
						</td>
    					<td width="59" align="left" bgcolor="808080" />
						<font size="2" color="FFFFFF" />
							&nbsp;<?=$objarray['Discrepancy_id'];?>
							</font>
						</td>
  					</tr>
  				<tr>
   					<td width="*" colspan="2" align="center" valign="middle" bgcolor="#FF0000" />
						<table border="0" cellpadding="0" cellspacing="0" borderCOLOR="#000000" id="AutoNumber1" />
							<tr align="center" />
								<td align="center" />
    									<font size="2" color="FFFFFF" />
										<?=$objarray['Discrepancy_name'];?>
										</font>
									</td>
								</tr>
							</table>
						</td>
  					</tr>
				</table>
			</div>	
			<?
			}
			}
			}
			?>
