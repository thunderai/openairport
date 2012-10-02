<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139.303 Sub_D.php			The purpose of this page is to manage discrepancies entered on the Part 139.303 _Main Form
	
								Usage:
								This is a complete custom form for the purposes of entering Part 139.303 Discrepancies and should not be used as a template for another form
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
		
		$tblname		= "Manage Students";
		$tblsubname	= "For the current Training Session";
		
	// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
?>
<HTML>
	<HEAD>
		<meta http-equiv="content-language" content="en-us">
		<meta http-equiv="content-type" content="text/html; charset=windows-1252">
		<title>Manage Students</title>
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
						<tr>
							<td class="formoptions" align="center">
								Please use this form to add each student who was at the training session.
								</td>
							</tr>
						</table>
					<table border="0" width="100%" cellspacing="4">
						<tr>
							<td class="formresultscount">
								<?
								//make connection to database
								$sql = "SELECT * FROM tbl_139_303_sub_sa WHERE discrepancy_checklist_id = '".$_POST['checklistid']."' ";
								
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
								there was <?=$number_of_rows;?> records found
								</td>
							</tr>
						<tr>
							<td>
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
													<form style="margin-bottom:0;" action="part139303_sub_sa_entry.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=600,height=400,status=no,resizable=no,scrollbars=yes')">
													<td class="formoptionsubmit">
														<input type="hidden" name="conditionid" 		value="<?=$_POST['conditionid'];?>">
														<input type="hidden" name="recordid" 			value="<?=$_POST['recordid'];?>">
														<input type="hidden" name="checklistid" 		value="<?=$_POST['checklistid'];?>">
														<input type="hidden" name="facilityid" 			value="<?=$_POST['facilityid'];?>">
														<input type="hidden" name="conditionname" 		value="<?=$_POST['conditionname'];?>">
														<input type="hidden" name="inspectiontypeid" 	value="<?=$_POST['inspectiontypeid'];?>">
														<input type="hidden" name="did" 				value="<?=$tmpid;?>">
														<input type="submit" value="Add New Student" name="b1" class="formsubmit">
														</td>
													</form>	
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						<tr>
							<?
							if ($number_of_rows==0) {
								//echo "no records found";
								}
								else {
								?>
							<td class="tabledatarow">
								<table border="0" width="100%" id="table1" cellpadding="0" cellspacing="1"  style="border-collapse: collapse">
									<tr>
										<td class="formheaders">
											ID
											</td>
										<td class="formheaders">
											Functions
											</td>
										<td class="formheaders">
											Student Name
											</td>								
										</tr>
												<?
												while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
												//$tmpfieldname	= $layer3array['menu_item_name_long'];
												?>
									<tr>
										<td height="32" align="center" class="formresults">
											<?
											$tmpid = $objarray['Discrepancy_id'];
											?>
											<?=$objarray['Discrepancy_id'];?>
											</td>
										<td align="center" class="formresults">
											<table border="1" cellspacing="0" id="table1" class="formsubmit cellpadding="0">
												<tr>
													<form style="margin-bottom:0;" action="part139303_sub_sa_a_entry.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=600,height=600,status=no,resizable=no,scrollbars=yes')">
													<td class="formoptionsubmit">
														<input type="hidden" name="conditionid" 		value="<?=$_POST['conditionid'];?>">
														<input type="hidden" name="recordid" 			value="<?=$_POST['recordid'];?>">
														<input type="hidden" name="checklistid" 		value="<?=$_POST['checklistid'];?>">
														<input type="hidden" name="facilityid" 			value="<?=$_POST['facilityid'];?>">
														<input type="hidden" name="conditionname" 		value="<?=$_POST['conditionname'];?>">
														<input type="hidden" name="inspectiontypeid" 	value="<?=$_POST['inspectiontypeid'];?>">
														<input type="hidden" name="did" 				value="<?=$tmpid;?>">
														<input type="submit" value="A" name="b1" class="formsubmit">
														</td>
													</form>
													</tr>
												</table>
											</td>
										<td align="center" class="formresults">
											<?
											systemusercombobox($objarray['discrepancy_student_cb_int'], "all", "disauthor", "hide", "");
											?>
											</td>
										</tr>
										<?
													}
										?>
								</table>
							</td>
						</tr>
						<?
								}
											}
									}
				?>
			</table>
