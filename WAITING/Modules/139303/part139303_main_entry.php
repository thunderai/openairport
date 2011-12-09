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
		
	$dutylogevent	= "Added New Airport Training Session";

if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		?>
						<form action="<?=$_SERVER["PHP_SELF"];?>" method="post" name="entryform">
							<input type="hidden" name="formsubmit"		id="formsubmit"			value="1">
							<input type="hidden" name="menuitemid" 								value="<?=$_POST['menuitemid'];?>">
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
												Type of Training Session
												</td>
											<td align="center" valign="middle" class="formoptions">
												<?
												part139303typescombobox("all", "all", "InspCheckList", "show", "");
												?>
												</td>
											<td class="formoptions" align="center">
												<input class="formsubmit" type="button" name="button" value="Get Checklist" onClick="call_server_part139303(<?=$_SESSION['user_id'];?>);">
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
												Regulation
												</td>
											<td align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #3b5998; text-align:center">
												Theme
												</td>
											<td align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #3b5998; text-align:center">
												Taught ?
												</td>
											</tr>
		<?										
		// Form has been submitted
		// There are two things that must be done initialy before we go off to the discrepancy page.
		// Step 1). Add the Inspection Header information to the database
		// Step 2). Add each checklist item to the database for that inspection.
		
		$tmpdate = AmerDate2SqlDateTime($_POST['frmdate']);
		
		$sql = "INSERT INTO tbl_139_303_main (139_303_type_cb_int,139_303_by_cb_int,139_303_date,139_303_time ) VALUES ( '".$_POST['InspCheckList']."', '".$_POST['inspector']."', '".$tmpdate."', '".$_POST['frmtime']."' )";
				
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
						
		$sql = "SELECT * FROM tbl_139_303_sub_c WHERE condition_type_cb_int = '".$_POST['InspCheckList']."' AND condition_archived_yn = 0";
		
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
							$tmpe			= $tmpstring."ze";
							echo "Hours field is ".$tmpe."<br>";
							$tmpe			= $_POST[$tmpe];
							echo "Temp ID is = to ".$tmpid."<br>";
							echo "Hours field is ".$tmpe."<br>";
														
							if(!isset($_POST[$tmpd])) {
									// No variable exists
									$tmpdiscrepancy		= 0;
								}
								else {
									// Variable Exists
									$tmpdiscrepancy		= $_POST[$tmpd];
									}
							
							$tmphours	= $tmpe;

							
							if(!isset($_POST[$tmpa])) {
									// No variable exists
									$tmpacceptable		= 0;
								}
								else {
									// Variable Exists
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
									$tmpvalue = 1;
								}
							
							$objcon2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
							//mysql_insert_id();
				
							$sql = "INSERT INTO tbl_139_303_sub_c_c (conditions_checklists_condition_cb_int,conditions_checklists_inspection_cb_int,conditions_checklist_discrepancy_yn,conditions_checklist_hours ) VALUES ( '".$tmpid."', '".$lastid."', '".$tmpvalue."','".$tmphours."' )";
		
									//echo $sql."<br><br>";
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}		
										else {
											//mysql_insert_id();
											$objrs2 = mysqli_query($objcon2, $sql) or die(mysqli_error($objcon2));
											$lastchkid = mysqli_insert_id($objcon2);
											if ($tmpvalue==1) {
													// There is a discrepancy to show
													//echo "Yes";
													?>
										<tr>
											<td class="formresults">
												<?
												part139303facilitycombobox($tmpfacilityid, "all", "notused", "hide", "all");
												?>
												</td>
											<td class="formresults">
												<?=$tmpcondname;?>
												</td>
											<form style="margin-bottom:0;" action="part139303_sub_d.php" method="POST" name="dform" id="dform" target="AddDiscrepancy" onsubmit="window.open('', 'AddDiscrepancy', 'width=550,height=550,status=no,resizable=no,scrollbars=yes')">
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
											<td colspan="2" align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #800000; text-align:center">
												Student Attenance
												</td>
											<form style="margin-bottom:0;" action="part139303_sub_sa.php" method="POST" name="dform" id="dform" target="AddDiscrepancy" onsubmit="window.open('', 'AddDiscrepancy', 'width=550,height=550,status=no,resizable=no,scrollbars=yes')">
											<td align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #800000; text-align:center">
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
										<tr>
											<td colspan="3" align="right">
												<table class="tablesubcontent" width="100%" cellspacing="0" cellpadding="0" border="0" height="32">
													<tr>
														<form style="margin-bottom:0;" action="part139303_main_upload.php" method="POST" name="printform" id="printform" target="PrinterFriendlyReport" onsubmit="window.open('', 'PrinterFriendlyReport', 'width=717,height=400,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsavilablebottom" colspan="1">
															<input type="hidden" name="conditionid" 		value="<?=$tmpid;?>">
															<input type="hidden" name="recordid" 			value="<?=$lastid;?>">
															<input type="hidden" name="checklistid" 		value="<?=$lastchkid;?>">
															<input type="hidden" name="facilityid" 			value="<?=$tmpfacilityid;?>">
															<input type="submit" name="b1" 					value="Upload Supporting Documents"			class="formsubmit">
															</td>
															</form>
														<td class="formoptionsavilablebottom">
															&nbsp;
															</td>
														<form style="margin-bottom:0;" action="part139303_main_report.php" method="POST" name="printform" id="printform" target="PrinterFriendlyReport" onsubmit="window.open('', 'PrinterFriendlyReport', 'width=717,height=962,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsavilablebottom" colspan="1">
															<input type="hidden" name="conditionid" 		value="<?=$tmpid;?>">
															<input type="hidden" name="recordid" 			value="<?=$lastid;?>">
															<input type="hidden" name="checklistid" 		value="<?=$lastchkid;?>">
															<input type="hidden" name="facilityid" 			value="<?=$tmpfacilityid;?>">
															<input type="submit" name="b1" 					value="Print Report"			class="formsubmit">
															</td>
															</form>
														</tr>
													</table>
												</td>
											</tr>
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
