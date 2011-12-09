<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 121 Monthly Summary Report.php		The purpose of this page is to enter view Part 121 Monthly Summary Reports in a printer friendly report
	
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
	
	$tmpmath	= 0;
	$tmpa		= 0;
	$tmpa 		= 0;
	$tmpb 		= 0;
	$tmpc 		= 0;
	$tmpd 		= 0;
	$tmpe 		= 0;
?>
<HTML>
	<HEAD>
		<TITLE>
			OpenAirport.org - Airport Activity Report Part 121 - (Printer Friendly)
			</TITLE>
		</HEAD>
	<BODY>
		<div style="position:absolute; z-index:1; left: 0; top: 0; width: 717; align="left">
			<img src="images/part121activityreport.gif" width="717" height="962">
			</div>
<?
		
if (!isset($_GET['recordid'])) {
		//$tbldatesortstart=($current_date-30);		
		// setup startdate for query
		$tmprecordid		= $_POST['recordid'];
	}
	else {
		$tmprecordid		= $_GET['recordid'];
	}
		
		

	$sql = "SELECT * FROM tbl_activity_121_main INNER JOIN tbl_organization_main ON tbl_activity_121_main.activity_121_operator_cb_int = tbl_organization_main.Organizations_id WHERE activity_121_id = '".$tmprecordid."' ";
	
	$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($mysqli, $sql);
			if ($res) {
					$number_of_rows = mysqli_num_rows($res);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
							?>
		<div style="position:absolute; z-index:2; left: 0; top: 10; width: 717; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<font size="4">
							<b>
								<?=$objfields['org_name'];?>
								</b>
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 0; top: 80; width: 717; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<font size="3">
							<b>
								<?=$objfields['activity_121_date'];?>
								</b>
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 530; top: 170; width: 149; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<font size="3">
							<!--<b>-->
								<?=$objfields['activity_121_sdp'];?>
								<!--</b>-->
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 530; top: 193; width: 149; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<font size="3">
							<!--<b>-->
								<?=$objfields['activity_121_sep'];?>
								<!--</b>-->
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 530; top: 217; width: 149; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<font size="3">
							<!--<b>-->
								<?
								$tmpmath = ( $objfields['activity_121_sep'] + $objfields['activity_121_sdp'] );
								
								echo $tmpmath;
								?>
								<!--</b>-->
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 530; top: 273; width: 149; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<font size="3">
							<!--<b>-->
								<?=$objfields['activity_121_nrdp'];?>
								<!--</b>-->
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 530; top: 297; width: 149; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<font size="3">
							<!--<b>-->
								<?=$objfields['activity_121_nrep'];?>
								<!--</b>-->
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 530; top: 321; width: 149; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<font size="3">
							<!--<b>-->
								<?
								$tmpmath = ( $objfields['activity_121_nrdp'] + $objfields['activity_121_nrep'] );
								
								echo $tmpmath;
								?>
								<!--</b>-->
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 530; top: 377; width: 149; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<font size="3">
							<!--<b>-->
								<?=$objfields['activity_121_avin'];?>
								<!--</b>-->
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 530; top: 401; width: 149; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<font size="3">
							<!--<b>-->
								<?=$objfields['activity_121_avout'];?>
								<!--</b>-->
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 530; top: 425; width: 149; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<font size="3">
							<!--<b>-->
								<?
								$tmpmath = ( $objfields['activity_121_avin'] + $objfields['activity_121_avout'] );
								
								echo $tmpmath;
								?>
								<!--</b>-->
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 69; top: 611; width: 612; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
							<?
							}
					}
			}
			
		$sql = "SELECT * FROM tbl_activity_121_sub_a INNER JOIN tbl_aircraft_main ON tbl_activity_121_sub_a.aircraft_activity_121_type_cb_int = tbl_aircraft_main.aircraft_id  WHERE aircraft_activity_main_id = '".$tmprecordid."' ";
		
		$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$res = mysqli_query($mysqli, $sql);
				if ($res) {
						$number_of_rows = mysqli_num_rows($res);
						//printf("result set has %d rows. \n", $number_of_rows);
						while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {	
								?>
				<tr align="center">
					<td align="center" width="155">
						<font size="2">
							<?=$objfields['aircraft_name'];?>
							</font>
						</td>
					<td align="center" width="81">
						<font size="2">
							<?
							// Get Aircraft Weight
							echo $objfields['aircraft_weight'];
							$tmpa = $tmpa + $objfields['aircraft_weight'];
							?>
						</td>
					<td align="center" width="65">
						<font size="2">
							<?
							// Get Aircraft Weight
							echo $objfields['aircraft_activity_121_landings'];
							$tmpb = $tmpb + $objfields['aircraft_activity_121_landings'];
							?>
						</td>
					<td align="center" width="92">
						<font size="2">
							<?
							// Get Aircraft Weight
							echo $objfields['aircraft_activity_121_overnight'];
							$tmpc = $tmpc + $objfields['aircraft_activity_121_overnight'];
							?>
						</td>
					<td align="center" width="102">
						<font size="2">
							<?
							$tmprw = ( $objfields['aircraft_activity_121_overnight'] * $objfields['aircraft_weight'] );
							
							echo $tmprw;
							
							$tmpd = $tmpd + $tmprw;
							?>
						</td>
					<td align="center" width="117">
						<font size="2">
							<?
							$tmplw = ( $objfields['aircraft_activity_121_landings'] * $objfields['aircraft_weight'] );
							
							echo $tmplw;
							
							$tmpe = $tmpe + $tmplw;
							?>	
						</td>
					</tr>
							<?
								}
						}
				}
				?>
				</table>
			</div>
		<div style="position:absolute; z-index:3; left: 227; top: 679; width: 81; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<Font size="2">
							<?=$tmpa;?>
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:3; left: 303; top: 679; width: 65; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<Font size="2">
							<?=$tmpb;?>
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:3; left: 369; top: 679; width: 95; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<Font size="2">
							<?=$tmpc;?>
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:3; left: 459; top: 679; width: 102; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<Font size="2">
							<?=$tmpd;?>
							</font>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:3; left: 565; top: 679; width: 117; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
				<tr align="center">
					<td align="center">
						<Font size="2">
							<?=$tmpe;?>
							</font>
						</td>
					</tr>
				</table>
			</div>
