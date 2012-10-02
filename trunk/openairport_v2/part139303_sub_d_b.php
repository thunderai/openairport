<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139.327 Sub_D_B.php			The purpose of this page is to manage discrepancies that are bounced, and why
	
								Usage:
								This is a complete custom form for the purposes of entering Part 139.327 Discrepancies and should not be used as a template for another form
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
		
		$tblname	= "Discrepancy Bounced History";
		$tblsubname	= "For the selected Discrepancy";
		
	// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
?>
<HTML>
	<HEAD>
		<meta http-equiv="content-language" content="en-us">
		<meta http-equiv="content-type" content="text/html; charset=windows-1252">
		<title>Discrepancy Bounced History</title>
		<script type="text/javascript" src="scripts/ajax.js"></script>
		<script type="text/javascript" src="scripts/AjaxRequest.js"></script>
		<link href="defaultoa.css" rel="stylesheet" type="text/css">
		</head>
	<body>
			<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
				<tr>
					<td width="10" class="tableheaderleft">&nbsp;</td>
					<td class="tableheadercenter">
						<?=$tblname;?>
						</td>
					<td class="tableheaderright">
						(<?=$tblsubname;?>)
						</td>
					</tr>
				<tr>
					<td colspan="3" class="tablesubcontent">
						<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
			<?
						//make connection to database
						$sql = "SELECT * FROM tbl_139_327_sub_d WHERE discrepancy_id = '".$_POST['recordid']."'";
						
						//echo $sql;
						
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
							<tr>
								<td class="formoptions" align="center">
									Name
									</td>
								<td class="formoptions" align="center">
									<?=$objarray['Discrepancy_name'];?>
									</td>
								<td class="formoptions" align="center">
									Date
									</td>
								<td class="formoptions" align="center">
									<?=$objarray['Discrepancy_date'];?>
									</td>
								<td class="formoptions" align="center">
									Time
									</td>
								<td class="formoptions" align="center">
									<?=$objarray['Discrepancy_time'];?>
									</td>
								</tr>
											<?
											}	// End of Found Discrepancy Loop
									}	// End of active Discrepancy Object
								}	// End of No Error durring connection
						//make connection to database
						$sql = "SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = '".$_POST['recordid']."' AND discrepancy_bounced_archived_yn = '0'";
						
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
										?>
							<tr>
								<td style="font-family: arial narrow; font-size: 10pt; color: #3b5998" colspan="6">
									there was <?=$number_of_rows;?> records found
									</td>
								</tr>
							<tr>
								<td colspan="6">
									<table cellspacing="0" width="100%">
										<tr>
											<td class="formoptionsavilabletop">
												The following options are avilable to you
												</td>
											</tr>
										<tr>
											<td class="formoptionsavilablebottom">
												<table>
													<tr>
														<form style="margin-bottom:0;" action="part139327_sub_d_b_entry.php" method="POST" name="addform" id="addform" target="AddRecordWindow" onsubmit="window.open('', 'AddRecordWindow', 'width=600,height=510,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="did" 				value="<?=$_POST['recordid'];?>">
															<input type="submit" value="Add New Bounce" name="b1" class="formsubmit">
															</td>
															</form>
														<form style="margin-bottom:0;" action="part139327_sub_d_b_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="recordid" 			value="<?=$_POST['recordid'];?>">
															<input type="hidden" name="sql" 				value="<?=$sql;?>">
															<input type="submit" value="Print Records" name="b1" class="formsubmit">
															</td>
															</form>	
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
										<?							
										if ($number_of_rows==0) {
												//echo "no records found";
												}
											else {
												?>
							<tr>
								<td style="border: 1px solid #6d84b4; padding-left: 0" bgcolor="#ffffff" align="left" valign="top" colspan="6">
									<table border="0" width="100%" id="table1" cellpadding="0" cellspacing="1"  style="border-collapse: collapse">
										<tr>
											<td class="formheaders">
												ID
												</td>
											<td class="formheaders">
												Functions
												</td>
											<td class="formheaders">
												Comment
												</td>								
											</tr>
										<?
												while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
														//$tmpfieldname	= $layer3array['menu_item_name_long'];
														?>
										<tr>
											<td height="32" align="center" class="formresults">
												<?=$objarray['discrepancy_bounced_id'];?>
												</td>
											<td align="center" class="formresults">
												<table border="1" width="50" cellspacing="0" id="table1" class="formsubmit cellpadding="0">
													<tr>
														<form style="margin-bottom:0;" action="part139327_sub_d_b_edit.php" method="POST" name="editform" id="editform" target="EditRecordWindow" onsubmit="window.open('', 'EditRecordWindow', 'width=600,height=550,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="recordid" 			value="<?=$objarray['discrepancy_bounced_id'];?>">
															<input type="hidden" name="did" 				value="<?=$_POST['recordid'];?>">
															<input type="submit" value="E" name="b1" class="formsubmit">
															</td>
														</form>
														<form style="margin-bottom:0;" action="part139327_sub_d_b_summary.php" method="POST" name="summaryform" id="summarytform" target="SummaryRecordWindow" onsubmit="window.open('', 'SummaryRecordWindow', 'width=600,height=550,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="recordid" 			value="<?=$objarray['discrepancy_bounced_id'];?>">
															<input type="hidden" name="did" 				value="<?=$_POST['recordid'];?>">
															<input type="submit" value="S" name="b1" class="formsubmit">
															</td>
														</form>
														<form style="margin-bottom:0;" action="part139327_sub_d_b_report.php" method="POST" name="reportform" id="reportform" target="ReportRecordWindow" onsubmit="window.open('', 'ReportRecordWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="recordid" 			value="<?=$objarray['discrepancy_bounced_id'];?>">
															<input type="hidden" name="did" 				value="<?=$_POST['recordid'];?>">
															<input type="submit" value="R" name="b1" class="formsubmit">
															</td>
														</form>														
														</tr>
													</table>
												</td>
											<td align="center" class="formresults">
												<?=$objarray['discrepancy_bounced_comments'];?>
												</td>
											</tr>
										<?
													}	// End of While Bounced Loop
												}	// End of Rows Found in Bounded
									}	// end of Bounced Active Object
								}	// end of no error in bounced object conneciton
								?>
