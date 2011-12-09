<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139.327 Main Entry.php			The purpose of this page is to enter new Part 139.327 Airport Safety Self Inspections
	
								Usage:
								This is a complete custom form for the purposes of entering Part 139.327 inspections and should not be used as a template for another form
								unless that other form functions just like this one.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		include("includes/header.php");															// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/DateFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		
	// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
		
	$dutylogevent	= "Added New Airport Safety Self Inspection";

if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		?>
						<form action="<?=$_SERVER["PHP_SELF"];?>" method="post" name="entryform">
							<input type="hidden" name="formsubmit"		id="formsubmit"			value="1">
							<input type="hidden" name="menuitemid" 		ID="menuitemid"			value="<?=$_POST['menuitemid'];?>">
							<input type="hidden" name="inspector" 		id="inspector"		 	value="<?=$_SESSION['user_id'];?>">
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									<?
									getnameofmenuitemid($strmenuitemid, "long", 4, "#FFFFFF",$_SESSION['user_id']);
									?>
									</td>
								<td class="tableheaderright">
									(
									<?
									getpurposeofmenuitemid($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
									?>
									)
									</td>
								</tr>
							<tr>
								<td colspan="3" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
										<tr>
											<td colspan="3" class="formoptionsavilabletop">
												Please complete the form below in as much detail as possible, and please pay close attention to syntax.
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Select from the list')"; onMouseout="hideddrivetip()">
												Type of Inspection
												</td>
											<td align="center" valign="middle" class="formoptions">
												<?
												part139327typescombobox("all", "all", "InspCheckList", "show", "");
												?>
												</td>
											<td class="formoptions" align="center">
												<input class="formsubmit" type="button" name="button" value="Get Checklist" onClick="call_server(<?=$_SESSION['user_id'];?>);"><input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.entryform.submit()">&nbsp;
												</td>
											</tr>
										<tr>
											<td colspan="3" id="CheckListData" class="formoptionsavilablebottom">
												<center>After clicking the 'Get Checklist' button, please wait a moment while the checklist loads</center>
												<?
												for ($i=0; $i<150; $i=$i+1) {
														?>
														<br>
														<?
													}
												?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							</form>
		<?
	}
	else {
		?>
		<br>
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									<?
									getnameofmenuitemid($strmenuitemid, "long", 4, "#FFFFFF",$_SESSION['user_id']);
									?>
									</td>
								<td class="tableheaderright">
									(
									<?
									getpurposeofmenuitemid($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
									?>
									)
									</td>
								</tr>
							<tr>
								<td colspan="3" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
										<tr>
											<td colspan="3" class="formoptionsavilabletop">
												Please complete the form below in as much detail as possible, and please pay close attention to syntax.
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #3b5998; text-align:center">
												Facility
												</td>
											<td align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #3b5998; text-align:center">
												Condition
												</td>
											<td align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #3b5998; text-align:center">
												Discrepancy
												</td>
											</tr>
		<?										
		// Form has been submitted
		// There are two things that must be done initialy before we go off to the discrepancy page.
		// Step 1). Add the Inspection Header information to the database
		// Step 2). Add each checklist item to the database for that inspection.
		
		$tmpdate = AmerDate2SqlDateTime($_POST['frmdate']);
		
		$sql = "INSERT INTO tbl_139_327_main (type_of_inspection_cb_int,inspection_completed_by_cb_int,139327_date,139327_time ) VALUES ( '".$_POST['InspCheckList']."', '".$_POST['inspector']."', '".$tmpdate."', '".$_POST['frmtime']."' )";
				
		//echo $sql;

		$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid = mysqli_insert_id($mysqli);
						//echo $tmp;
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($mysqli);
						}
						
		$sql = "SELECT * FROM tbl_139_327_sub_c WHERE condition_type_cb_int = '".$_POST['InspCheckList']."' AND condition_archived_yn = 0";
		
		$objcon = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
						//mysql_insert_id();
						$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
						while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
							// We now are inside each record of each type of condition that is part of the selected checklist, now we need to add a new record to another table for each of these records.
							// That means establishing a new connection to the database while this one is still open.
							$tmpid 			= $objfields['conditions_id'];
							$tmpfacilityid	= $objfields['condition_facility_cb_int'];
							$tmpcondname	= $objfields['condition_name'];
							$tmpstring	 	= (string) $tmpid;
							$tmpa 			= $tmpstring."za";
							$tmpd			= $tmpstring."zd";
												
							if(!isset($_POST[$tmpd])) {
									// No variable exists
									$tmpdiscrepancy		= 0;
								}
								else {
									// Variable Exists
									$tmpdiscrepancy		= $_POST[$tmpd];
									}
									
							if(!isset($_POST[$tmpa])) {
									// No variable exists
									$tmpacceptable		= 0;
								}
								else {
									// Variable Exists
									$tmpacceptable		= $_POST[$tmpa];
									}
							
							//echo "tmp Acceptable".$tmpacceptable."<br>";
							$tmp_displayrow = 0;
							
							if ($tmpacceptable == 1) {
									//echo "User has clicked that there is no discrepancy in this item. By pass the display row part<br>";
									$tmp_displayrow = 0;
								}
								else {
									if ($tmpacceptable == 0) {
											//echo "User has not clicked the acceptable checkbox, is there a discrepancy checked?<br>";
												if ($tmpdiscrepancy == 0) {
														//echo "There is no discrepancy to display<br>";
														$tmp_displayrow = 0;
													}
													else {
														//echo "There must be a discrepancy to display<br>";
														$tmp_displayrow = 1;
													}
											}
								}
			
							
							$objcon2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
							//mysql_insert_id();
				
							$sql2 = "INSERT INTO tbl_139_327_sub_c_c (conditions_checklists_condition_cb_int,conditions_checklists_inspection_cb_int,conditions_checklist_discrepancy_yn ) VALUES ( '".$tmpid."', '".$lastid."', '".$tmp_displayrow."' )";
		
									//echo $sql2."<br><br>";
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}		
										else {
											//mysql_insert_id();
											$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
											$lastchkid = mysqli_insert_id($objcon2);
											if ($tmp_displayrow==1) {
													// There is a discrepancy to show
													//echo "Yes";
													?>
										<tr>
											<td class="formresults">
												<?
												part139327facilitycombobox($tmpfacilityid, "all", "notused", "hide", "all");
												?>
												</td>
											<td class="formresults">
												<?=$tmpcondname;?>
												</td>
											<form style="margin-bottom:0;" action="part139327_sub_d.php" method="POST" name="dform" id="dform" target="AddDiscrepancy" onsubmit="window.open('', 'AddDiscrepancy', 'width=550,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formresults" align="center" valign="middle">
												<input type="hidden" name="conditionid" 		value="<?=$tmpid;?>">
												<input type="hidden" name="recordid" 			value="<?=$lastid;?>">
												<input type="hidden" name="checklistid" 		value="<?=$lastchkid;?>">
												<input type="hidden" name="facilityid" 			value="<?=$tmpfacilityid;?>">
												<input type="hidden" name="conditionname" 		value="<?=$tmpcondname;?>">
												<input type="hidden" name="inspectiontypeid" 	value="<?=$_POST['InspCheckList'];?>">
												<input type="submit" name="b1" 					value="Yes (Manage)"			class="formsubmit">
												</td>
											</form>
											</tr>
											<?
											}
										}
							}
							?>
										<tr>
											<form style="margin-bottom:0;" action="part139327_main_report.php" method="POST" name="printform" id="printform" target="PrinterFriendlyReport" onsubmit="window.open('', 'PrinterFriendlyReport', 'width=717,height=962,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsavilablebottom" colspan="3">
												<input type="hidden" name="conditionid" 		value="<?=$tmpid;?>">
												<input type="hidden" name="recordid" 			value="<?=$lastid;?>">
												<input type="hidden" name="checklistid" 		value="<?=$lastchkid;?>">
												<input type="hidden" name="facilityid" 			value="<?=$tmpfacilityid;?>">
												<input type="submit" name="b1" 					value="Print Report"			class="formsubmit">
												</td>
											</form>
										</table>
									</td>
								</tr>
							</table>
							<?
						}		
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor	= $_SESSION["user_id"];
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
		
	}
?>
<?
include("includes/footer.php");		// include file that gets information from form POSTs for navigational purposes
?>	
