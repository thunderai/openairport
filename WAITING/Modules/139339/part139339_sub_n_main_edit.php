<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Edit Part 139.339 NOTAMS.php		The purpose of this file is to edit Inspections
	
								Usage:
								This page is based upon the default edit page, but serverly tweeked.
								
						
						
								
	NOTE: Like said in uage, this page shouldn't be used as a template for another page.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		include("includes/header.php");															// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		//include("includes/POSTs.php");																	// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		
	// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
?>
<script>
function buildcellvalue(nameofcell,valueofcell) 
	{
	var mydateobject 	= new Date();
	var today_day		= mydateobject.getDate();
	var today_month		= mydateobject.getMonth() + 1;
	var today_year		= mydateobject.getYear();
	var today_time		= mydateobject.toLocaleString();
	var hours 			= mydateobject.getHours();
	var minutes 		= mydateobject.getMinutes();
	var time			= "";
	var time_of_day		= "";

	if (minutes < 10) {
			minutes = "0" + minutes
		}

	if(hours > 11)	{
			time_of_day	= "PM";
			hours = (hours + 0);
		}
		else {
			time_of_day	= "AM";
		}

	time				= (hours + ":" + minutes + " " + time_of_day);
	time				= (hours + ":" + minutes + ":00");
	var todaystring		= (today_month + "/" + today_day + "/" + today_year);
	
	if (valueofcell == "1") {
		document.getElementById(nameofcell).value = todaystring;
		}
	if (valueofcell == "0") {
		document.getElementById(nameofcell).value = time;
		}
	}
</script>
<?
	// Get string information from the POST process of the form which action was this page
	
		$menuitemid 			= $_POST['menuitemid'];													
		$tblname				= $_POST['tblname'];													
		$tblsubname			= $_POST['tblsubname'];

		$sql = "SELECT * FROM tbl_139_339_sub_n ";

		//echo $sql;
		
		$i 			= "";
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
				$nsql =" WHERE 139339_sub_n_id = ".$_POST["inspectionid"]."";
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
														<form style="margin-bottom:0;" action="part139339_sub_n_main_a_entry.php" method="POST" name="archiveform" id="archiveform" target="ArchiveWindow" onsubmit="window.open('', 'ArchiveWindow', 'width=600,height=500,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="inspectionid" 		value="<?=$objarray['139339_sub_n_id'];?>">
															<input type="submit" value="Mark Archived" name="b1" class="formsubmit">
															</td>
														</form>
														<form style="margin-bottom:0;" action="part139339_sub_n_main_e_entry.php" method="POST" name="archiveform" id="archiveform" target="ArchiveWindow" onsubmit="window.open('', 'ArchiveWindow', 'width=600,height=550,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="inspectionid" 		value="<?=$objarray['139339_sub_n_id'];?>">
															<input type="submit" value="Mark Error" name="b1" class="formsubmit">
															</td>
														</form>
														<form style="margin-bottom:0;" action="part139339_sub_n_main_c_entry.php" method="POST" name="repairform" id="repairform" target="RepairWindow" onsubmit="window.open('', 'RepairWindow', 'width=600,height=600,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="inspectionid" 		value="<?=$objarray['139339_sub_n_id'];?>">
															<input type="submit" value="Mark Closed" name="b1" class="formsubmit">
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
							<input type="hidden" name="inspectionid" 		value="<?=$objarray['139339_sub_n_id'];?>">
							<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
							<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
									Date
									</td>
								<td class="formanswers">
									<?
									$uidate = sqldate2amerdate($objarray['139339_sub_n_date']);
									?>											
									<input class="Commonfieldbox" type="text" name="disdate" size="10" value="<?=$uidate;?>">
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(24 Hour Time)')"; onMouseout="hideddrivetip()">
									Time
									</td>
								<td class="formanswers">
									<input class="Commonfieldbox" type="text" name="distime" size="10" value="<?=$objarray['139339_sub_n_time'];?>">
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(select from the list)')"; onMouseout="hideddrivetip()">
									Reported By
									</td>
								<td class="formanswers">
									<?
									systemusercombobox($objarray['139339_sub_n_by_cb_int'], "all", "disauthor", "hide", $objarray['139339_sub_n_by_cb_int']);
									?>
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
									Wx Initials (issue)
									</td>
								<td class="formanswers">
									<input class="commonfieldbox" type="text" id="139339_sub_n_wx_out" name="139339_sub_n_wx_out" size="10" value="<?=$objarray['139339_sub_n_wx_in'];?>">
									</td>
								</tr>									
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
									FBO Initials (issue)
									</td>
								<td class="formanswers">
									<input class="commonfieldbox" type="text" id="139339_sub_n_fbo_out" name="139339_sub_n_fbo_out" size="10" value="<?=$objarray['139339_sub_n_fbo_in'];?>">
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
									Airline Initials (issue)
									</td>
								<td class="formanswers">
									<input class="commonfieldbox" type="text" id="139339_sub_n_airline_out" name="139339_sub_n_airline_out" size="10" value="<?=$objarray['139339_sub_n_airline_in'];?>">
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(select from the list)')"; onMouseout="hideddrivetip()">
									Type of Inspection
									</td>
								<td class="formanswers">
									<?
									part139339typescombobox($objarray['139339_sub_n_type_cb_int'], "all", "distype", "hide", $objarray['139339_sub_n_type_cb_int']);
									?>
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
									Metar
									</td>
								<td class="formanswers">
									<input class="Commonfieldbox" type="text" name="frmmetar" size="30" value="<?=$objarray['139339_sub_n_metar'];?>">
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
									Notes
									</td>
								<td class="formanswers">
									<textarea name="frmnotes" Rows="5" cols="60"><?=($objarray['139339_sub_n_notes']);?></textarea>
									</td>
								</tr>
							<tr>
								<td colspan="2">
									<table cellspacing="0" cellpadding="0" width="100%">
										<tr>
					      					<td rowspan="2" class="formheaders">
					      							Surface
												</td>
					      					<td rowspan="2" class="formheaders">
					      							Closed ?<br>Yes?
												</td>
											</tr>				
										<tr>
											<td colspan="4" class="header">
												<input type="hidden" id="typeofinspection" name="typeofinspection" value="<?=$InspCheckList;?>">
												<?
												// Define SQL
												$sql = "SELECT * FROM tbl_139_339_sub_n_cc
														INNER JOIN tbl_139_339_sub_c ON 139339_cc_c_cb_int = 139339_c_id
														INNER JOIN tbl_139_339_sub_c_f ON 139339_f_id = 139339_c_facility_cb_int					
														WHERE 139339_cc_ficon_cb_int = '".$_POST["inspectionid"]."' AND 139339_c_archived_yn = 0
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
																		if ($current_facility!=$previous_facility) {
																				//Row data has the same facility
																				?>
											</tr>	
																			
										<tr>
					      					<td height="28" class="formresults">
					      						&nbsp;
												<? 
												$tmpfacility = $objfields["139339_c_facility_cb_int"];
												part139339facilitycombobox($tmpfacility, "all", "notused", "hide", "all");
												$tmpvalue 	= (string) $tmpid;
												$tmpa 	= $tmpvalue."za";
												$tmpd		= $tmpvalue."zd";
												?>
												</td>
																				<?
																				}
																				?>
					      					<td class="formresults">
					      						&nbsp;
												<?
												$tmpfieldname = str_replace(" ","",$objfields["139339_c_name"]);
												
												switch ($objfields['139339_cc_type']) {
														case 0:
																?>
																<input class="Commonfieldbox" type="text" name="<?=$tmpfieldname;?>" size="5" value="<?=($objfields["139339_cc_d_yn"]);?>">
																<? 
																break;
														case 1:
																?>
																<input class="Commonfieldbox" type="checkbox" name="<?=$tmpfieldname;?>" value="1" 
																<?
																if ($objfields["139339_cc_d_yn"]==1) {
																		?>
																		CHECKED
																		<?
																	}
																	?>
																>
																<? 
																break;
														case 2:
																?>
																<input class="Commonfieldbox" type="text" name="<?=$tmpfieldname;?>" size="15" value="<?=($objfields["139339_cc_d_yn"]);?>">
																<? 
																break;
													}
													?>
												</td>
																				<?
																	$previous_facility	= $objfields['139339_c_facility_cb_int'];
																	$i 				= $i + 1;
																	}	// End of while loop
																	mysqli_free_result($res);
																	mysqli_close($objcon);
															}	// end of Res Record Object						
													}
													?>
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
									NOTAM Edit Form
									</td>
								<td class="tableheaderright">
									(Use to make changes to the NOTAM Report)
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
		<?										
		// Form has been submitted
		// There are two things that must be done initialy before we go off to the discrepancy page.
		// Step 1). Add the Inspection Header information to the database
		// Step 2). Add each checklist item to the database for that inspection.
				
		$tmpdate 		= AmerDate2SqlDateTime($_POST['disdate']);
		$tmpdateclosed 	= AmerDate2SqlDateTime($_POST['disdateclosed']);
		
		//$tmptime = amerdate2sqldatetime($_POST['distimeclosed']);
		//echo "Time Closed :".$tmptime;
		
		
		$sql = "UPDATE tbl_139_339_sub_n SET 139339_sub_n_type_cb_int='".$_POST['distype']."', 139339_sub_n_by_cb_int='".$_POST['disauthor']."', 139339_sub_n_date='".$tmpdate."', 139339_sub_n_time='".$_POST['distime']."', 139339_sub_n_metar='".$_POST['frmmetar']."', 139339_sub_n_notes='".$_POST['frmnotes']."', 139339_sub_n_wx_in='".$_POST['139339_sub_n_wx_in']."', 139339_sub_n_fbo_in='".$_POST['139339_sub_n_fbo_in']."', 139339_sub_n_airline_in='".$_POST['139339_sub_n_airline_in']."'";	
		$sql = $sql." WHERE 139339_sub_n_id=".$_POST['inspectionid'];

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
						
		$sql = "SELECT * FROM tbl_139_339_sub_n_cc 
			INNER JOIN tbl_139_339_sub_c ON tbl_139_339_sub_c.139339_c_id = tbl_139_339_sub_n_cc.139339_cc_c_cb_int 
			WHERE 139339_cc_ficon_cb_int=".$_POST['inspectionid'];
			
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
							$tmpchecklistid 			= $objfields['139339_cc_id'];
							$tmpchecklistconditionid	= $objfields['139339_cc_c_cb_int'];
							$tmpchecklistinspectionid	= $objfields['139339_cc_ficon_cb_int'];
							$tmpchecklistdiscrepancy	= $objfields['139339_cc_d_yn'];
							$tmpcondname			= $objfields['139339_c_name'];
							$tmpcondnamestr			= str_replace(" ","",$tmpcondname);
							
							//echo "TmpValue ".$tmpvalue."<br>";
							$objcon2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
							$sql2 = "UPDATE tbl_139_339_sub_n_cc SET 139339_cc_c_cb_int='".$tmpchecklistconditionid."', 139339_cc_ficon_cb_int='".$_POST['inspectionid']."', 139339_cc_d_yn='".$_POST[$tmpcondnamestr]."' WHERE 139339_cc_id=".$tmpchecklistid;

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
											
							$tmpvalue 			= "";
							$tmpacceptable		= "";
							$tmpdiscrepancy		= "";
							}	// End of while loop
							
							?>
							<tr>
										<form style="margin-bottom:0;" action="part139339_sub_n_sub_d.php" method="POST" name="dform" id="dform" target="AddDiscrepancy" onsubmit="window.open('', 'AddDiscrepancy', 'width=550,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formresults" align="center" valign="middle" colspan="3">
											<input type="hidden" name="conditionid" 		value="<?=$tmpid;?>">
											<input type="hidden" name="recordid" 			value="<?=$_POST["inspectionid"];?>">
											<input type="hidden" name="checklistid" 		value="<?=$lastchkid;?>">
											<input type="hidden" name="facilityid" 			value="<?=$tmpfacilityid;?>">
											<input type="hidden" name="conditionname" 		value="<?=$tmpcondname;?>">
											<input type="hidden" name="inspectiontypeid" 	value="<?=$_POST['distype'];?>">
											<input type="submit" name="b1" 					value="Add Graphic Anomalies Icon/Area"			class="formsubmit">
											</td>
											</form>
											</tr>
										<tr>
											<form style="margin-bottom:0;" action="part139339_sub_n_main_report.php" method="POST" name="printform" id="printform" target="PrinterFriendlyReport" onsubmit="window.open('', 'PrinterFriendlyReport', 'width=717,height=962,status=no,resizable=no,scrollbars=yes')">
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
		$tmpsqlauthor		= $_SESSION["user_id"];
		$dutylogevent		= "Edited record ID:".$_POST["inspectionid"]." in table tbl_139_339_sub_n";
		
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
