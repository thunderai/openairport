<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Edit Part 139.327 Inspections.php		The purpose of this file is to edit Inspections
	
								Usage:
								This page is based upon the default edit page, but serverly tweeked.
								
						
						
								
	NOTE: Like said in uage, this page shouldn't be used as a template for another page.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		include("includes/header.php");															// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		
	// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);

	// Get string information from the POST process of the form which action was this page
	
		$menuitemid 			= $_POST['menuitemid'];													
		$tblname				= $_POST['tblname'];													
		$tblsubname				= $_POST['tblsubname'];

		$sql = "SELECT * FROM tbl_139_327_main ";

		//echo $sql;
		
		$i = "";
		$tmpvalue		= "";
		
if (!isset($_POST["inspectionid"])) {
		// No Record ID Supplied, Crash Out
	}
	else {
		if (!isset($_POST["formsubmit"])) {
				// there is nothing in the post querystring, so this must be the first time this form is being shown
				// display form doing all our trickery!
				// There is a Record ID Supplied, Do work
				// Connect to Database
				$nsql =" WHERE inspection_system_id = ".$_POST["inspectionid"]."";
				$sql = $sql.$nsql;
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
								?>
						<br>
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
											<td colspan="2" class="formoptionsavilabletop">
												Please complete the form below in as much detail as possible, and please pay close attention to syntax.
												</td>
											</tr>
								<?
								while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										?>
							<tr>
								<td colspan="2">
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
														<?
														$encoded = urlencode($sql);
														?>
														<form style="margin-bottom:0;" action="part139327_main_a_entry.php" method="POST" name="archiveform" id="archiveform" target="ArchiveWindow" onsubmit="window.open('', 'ArchiveWindow', 'width=600,height=500,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="inspectionid" 		value="<?=$objarray['inspection_system_id'];?>">
															<input type="submit" value="Mark Archived" name="b1" class="formsubmit">
															</td>
														</form>
														<form style="margin-bottom:0;" action="part139327_main_e_entry.php" method="POST" name="archiveform" id="archiveform" target="ArchiveWindow" onsubmit="window.open('', 'ArchiveWindow', 'width=600,height=550,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="inspectionid" 		value="<?=$objarray['inspection_system_id'];?>">
															<input type="submit" value="Mark Error" name="b1" class="formsubmit">
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
							<form action="<?=$_SERVER["PHP_SELF"];?>" method="post" name="edittable" id="edittable">
							<input type="hidden" name="formsubmit" 			value="1">
							<input type="hidden" name="menuitemid" 			value="<?=$_POST['menuitemid'];?>">
							<input type="hidden" name="inspectionid" 		value="<?=$objarray['inspection_system_id'];?>">
							<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
							<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
									Date
									</td>
								<td class="formanswers">
									<?
									$uidate = sqldate2amerdate($objarray['139327_date']);
									?>											
									<input class="Commonfieldbox" type="text" name="disdate" size="10" value="<?=$uidate;?>">
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(24 Hour Time)')"; onMouseout="hideddrivetip()">
									Time
									</td>
								<td class="formanswers">
									<input class="Commonfieldbox" type="text" name="distime" size="10" value="<?=$objarray['139327_time'];?>">
									</td>
								</tr>	
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(select from the list)')"; onMouseout="hideddrivetip()">
									Reported By
									</td>
								<td class="formanswers">
									<?
									systemusercombobox("all", "all", "disauthor", "show", $objarray['inspection_completed_by_cb_int']);
									?>
									</td>
								</tr>											
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(select from the list)')"; onMouseout="hideddrivetip()">
									Type of Inspection
									</td>
								<td class="formanswers">
									<?
									part139327typescombobox("all", "all", "distype", "show", $objarray['type_of_inspection_cb_int']);
									?>
									</td>
								</tr>
							<tr>
								<td colspan="2" align="center" valign="middle" class="formoptions" >
									<table cellspacing="0" cellpadding="0" width="100%">
										<tr>
											<td class="formheaders">
												Facilities
												</td>
											<td class="formheaders">
												Conditions
												</td>
											<td class="formheaders">
												Acceptable
												</td>
											<td class="formheaders">
												Discrepancy
												</td>
											</tr>
										<tr>
											<td colspan="4" class="header">
														<?
														// Define SQL
														$sql2 = "SELECT * FROM tbl_139_327_sub_c_c WHERE conditions_checklists_inspection_cb_int = '".$_POST['inspectionid']."'";
														//echo $sql;
														// Establish a Conneciton with the Database
														$objcon2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
														if (mysqli_connect_errno()) {
																printf("connect failed: %s\n", mysqli_connect_error());
																exit();
															}
															else {
																$res2 = mysqli_query($objcon2, $sql2);
																if ($res2) {
																		$number_of_rows = mysqli_num_rows($res2);
																		//printf("result set has %d rows. \n", $number_of_rows);
																		while ($objfields2 = mysqli_fetch_array($res2, MYSQLI_ASSOC)) {
																				$tmpchecklistid = $objfields2['conditions_checklists_id'];
																				$tmpconditionid	= $objfields2['conditions_checklists_condition_cb_int'];
																				// Now open a connection to the condition table to get additional information about this checklist condition
																				// Define SQL
																				$sql3 = "SELECT * FROM tbl_139_327_sub_c WHERE conditions_id = '".$tmpconditionid."'";
																				//echo $sql;
																				// Establish a Conneciton with the Database
																				$objcon3 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
																				if (mysqli_connect_errno()) {
																						printf("connect failed: %s\n", mysqli_connect_error());
																						exit();
																					}
																					else {
																						$res3 = mysqli_query($objcon3, $sql3);
																						if ($res3) {
																								$number_of_rows = mysqli_num_rows($res3);
																								//printf("result set has %d rows. \n", $number_of_rows);
																								while ($objfields3 = mysqli_fetch_array($res3, MYSQLI_ASSOC)) {
																										$tmpconditionname	= $objfields3['condition_name'];
																										$tmpfacilitytype	= $objfields3['condition_facility_cb_int'];
																										$tmpconditiontype	= $objfields3['condition_type_cb_int'];
																										// Now open a connection to the condition table to get additional information about this checklist condition																		
																									}	// End of While Loop
																							}	// End on Existing object recordset
																					}	// End of Sucessful conection to database
																				?>
										<tr>
											<td height="28" class="formresults">
												&nbsp;
												<? 
												part139327facilitycombobox($tmpfacilitytype, "all", "notused", "hide", "all");
												$tmpvalue 	= (string) $tmpconditionid;
												$tmpa 		= $tmpvalue."za";
												$tmpd		= $tmpvalue."zd";
												?>
												</td>
					      					<td class="formresults">
					      						&nbsp;
												<?=$tmpconditionname;?>
												</td>
					      					<td class="formresults" align="center" valign="middle">
					      						<input class="commonfieldbox" type="checkbox" name="<?=$tmpa;?>" value="1"
												<?
												if ($objfields2['conditions_checklist_discrepancy_yn']==0) {
														?>
														CHECKED
														<?
													}
												?>												
												>
												</td>
					      					<td class="formresults" align="center" valign="middle">
					      						<input class="commonfieldbox" type="checkbox" name="<?=$tmpd;?>" value="1"
												<?
												if ($objfields2['conditions_checklist_discrepancy_yn']==1) {
														?>
														CHECKED
														<?
													}
												?>												
												>
												</td>
											</tr>
																				<?
																				$i = $i + 1;
																			}	// End of while loop
																	}	// end of Res Record Object						
															}	// End of Sucessful conection to database
													?>
										<tr>
											<td colspan="4" align="right">
												&nbsp;
												</td>
											</tr>
										</table>
													</td>
												</tr>									
									<tr>
										<td colspan="2" class="formoptionsavilablebottom">
											<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.edittable.submit()">
											</td>
										</tr>
														<? 
									} 	// End of While Statement
							}	// End on Existing object recordset
					?>
					</table>
				</form>
					<?
					}	// End of Sucessful connection to Database
			}	// End of Test to see which form should be displayed
			else {
				?>
						<br>
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									Inspection Edit Form
									</td>
								<td class="tableheaderright">
									(Use to make changes to discrepancies)
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
		
		$tmpdate = AmerDate2SqlDateTime($_POST['disdate']);
		$sql = "UPDATE tbl_139_327_main SET type_of_inspection_cb_int='".$_POST['distype']."', inspection_completed_by_cb_int='".$_POST['disauthor']."', 139327_date='".$tmpdate."', 139327_time='".$_POST['distime']."' WHERE inspection_system_id=".$_POST['inspectionid'];
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
						
		$sql = "SELECT * FROM tbl_139_327_sub_c_c WHERE conditions_checklists_inspection_cb_int=".$_POST['inspectionid'];
		//echo $sql."<br>";
		$objcon = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
						//mysql_insert_id();
						$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
						while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
							// For each record in the c_c table do the following...
							$tmpchecklistid 			= $objfields['conditions_checklists_id'];
							$tmpchecklistconditionid	= $objfields['conditions_checklists_condition_cb_int'];
							$tmpchecklistinspectionid	= $objfields['conditions_checklists_inspection_cb_int'];
							$tmpchecklistdiscrepancy	= $objfields['conditions_checklist_discrepancy_yn'];
							$tmpstring	 				= (string) $tmpchecklistconditionid;
							$tmpa 						= $tmpstring."za";
							$tmpd						= $tmpstring."zd";
							
							//echo $tmpstring."<br>";
							//echo $tmpa."<br>";
							//echo $tmpd."<br>";

							if(!isset($_POST[$tmpd])) {
									//echo "No variable exists (tmpd)";
									$tmpdiscrepancy		= 0;
								}
								else {
									//echo "variable exists (tmpd)";
									$tmpdiscrepancy		= $_POST[$tmpd];
									}
									
							if(!isset($_POST[$tmpa])) {
									//echo "No variable exists (tmpa)";
									$tmpacceptable		= 0;
								}
								else {
									//echo "variable exists (tmpa)";
									$tmpacceptable		= $_POST[$tmpa];
									}
							
							if($tmpacceptable == 0) {
									// there are no discrepancies
									$tmpvalue	= 0;
									if ($tmpdiscrepancy == 0) {
											// Both are negative, what gives
											$tmpvalue 	= 0;
										}
										else {
											// tmpdiscrepancy is not equal to zero
											$tmpvalue	= 1;
										}
								}
								else {
									//$tmpvalue = 1;
								}
							if ($tmpvalue=="") {
									$tmpvalue = 0;
								}
							//echo "TmpValue ".$tmpvalue."<br>";
							$objcon2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
							$sql2 = "UPDATE tbl_139_327_sub_c_c SET conditions_checklists_condition_cb_int='".$tmpchecklistconditionid."', conditions_checklists_inspection_cb_int='".$_POST['inspectionid']."', conditions_checklist_discrepancy_yn='".$tmpvalue."' WHERE conditions_checklists_id=".$tmpchecklistid;

									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}		
										else {
											//mysql_insert_id();
											$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
											$lastchkid = mysqli_insert_id($objcon2);
										}
											
											if ($tmpvalue==1) {
													// There is a discrepancy to show
													//echo "Yes";
													// Now open a connection to the Condition and get the facility name
													$sql3 = "SELECT * FROM tbl_139_327_sub_c WHERE conditions_id = '".$tmpchecklistconditionid."'";
													
													$objcon3 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
													//mysql_insert_id();
															
															if (mysqli_connect_errno()) {
																	// there was an error trying to connect to the mysql database
																	printf("connect failed: %s\n", mysqli_connect_error());
																	exit();
																}		
																else {
																	//mysql_insert_id();
																	$objrs3 = mysqli_query($objcon3, $sql3) or die(mysqli_error($objcon3));
																	while ($objfields3 = mysqli_fetch_array($objrs3, MYSQLI_ASSOC)) {
																			$tmpfacilityid		= $objfields3['condition_facility_cb_int'];
																			$tmpcondname		= $objfields3['condition_name'];
																		}
																}
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
												<input type="hidden" name="conditionid" 		value="<?=$tmpchecklistconditionid?>">
												<input type="hidden" name="recordid" 			value="<?=$_POST["inspectionid"]?>">
												<input type="hidden" name="checklistid" 		value="<?=$tmpchecklistid?>">
												<input type="hidden" name="facilityid" 			value="<?=$tmpfacilityid;?>">
												<input type="hidden" name="conditionname" 		value="<?=$tmpcondname;?>">
												<input type="hidden" name="inspectiontypeid" 	value="<?=$_POST['distype'];?>">
												<input type="submit" name="b1" 					value="Yes (Manage)"			class="formsubmit">
												</td>
											</form>
											</tr>
											<?
												}	// End of tmpvalue =1
							$tmpvalue 			= "";
							$tmpacceptable		= "";
							$tmpdiscrepancy		= "";
							}	// End of while loop
							
							?>
										<tr>
											<form style="margin-bottom:0;" action="part139327_main_report.php" method="POST" name="printform" id="printform" target="PrinterFriendlyReport" onsubmit="window.open('', 'PrinterFriendlyReport', 'width=717,height=962,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsavilablebottom" colspan="3">
												<input type="hidden" name="conditionid" 		value="<?=$tmpchecklistconditionid?>">
												<input type="hidden" name="recordid" 			value="<?=$_POST["inspectionid"]?>">
												<input type="hidden" name="checklistid" 		value="<?=$tmpchecklistid?>">
												<input type="hidden" name="facilityid" 			value="<?=$tmpfacilityid;?>">
												<input type="submit" name="b1" 					value="Print Report"			class="formsubmit">
												</td>
											</form>
										</table>
									</td>
								</tr>
							</table>
							<?
					}	// End of good connection
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor	= $_SESSION["user_id"];
		$dutylogevent	= "Edited record ID:".$_POST["inspectionid"]." in table tbl_139_327_main";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);

			}	// End of Summary Page
	}	// End of inspectionid
?>
<div id="dhtmltooltip"></div>

<script type="text/javascript">

/***********************************************
* Cool DHTML tooltip script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var offsetxpoint=-60 //Customize x offset of tooltip
var offsetypoint=20 //Customize y offset of tooltip
var ie=document.all
var ns6=document.getElementById && !document.all
var enabletip=false
if (ie||ns6)
var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function ddrivetip(thetext, thecolor, thewidth){
if (ns6||ie){
if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"
if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor
tipobj.innerHTML=thetext
enabletip=true
return false
}
}

function positiontip(e){
if (enabletip){
var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
//Find out how close the mouse is to the corner of the window
var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20
var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20

var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000

//if the horizontal distance isn't enough to accomodate the width of the context menu
if (rightedge<tipobj.offsetWidth)
//move the horizontal position of the menu to the left by it's width
tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"
else if (curX<leftedge)
tipobj.style.left="5px"
else
//position the horizontal position of the menu where the mouse is positioned
tipobj.style.left=curX+offsetxpoint+"px"

//same concept with the vertical position
if (bottomedge<tipobj.offsetHeight)
tipobj.style.top=ie? ietruebody().scrollTop+event.clientY-tipobj.offsetHeight-offsetypoint+"px" : window.pageYOffset+e.clientY-tipobj.offsetHeight-offsetypoint+"px"
else
tipobj.style.top=curY+offsetypoint+"px"
tipobj.style.visibility="visible"
}
}

function hideddrivetip(){
if (ns6||ie){
enabletip=false
tipobj.style.visibility="hidden"
tipobj.style.left="-1000px"
tipobj.style.backgroundColor=''
tipobj.style.width=''
}
}

document.onmousemove=positiontip

</script>
<?
//include("includes/footer.php");		// include file that gets information from form POSTs for navigational purposes
?>	
