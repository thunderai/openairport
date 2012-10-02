<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Edit Part 139.327 Discrepancy.php		The purpose of this file is to edit discrepancies
	
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

		$sql = "SELECT * FROM tbl_139_327_sub_d ";

		//echo $sql;
		
		
if (!isset($_POST["discrepancyid"])) {
		// No Record ID Supplied, Crash Out
	}
	else {
		if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
// There is a Record ID Supplied, Do work
		
		// Connect to Database
		$nsql =" WHERE Discrepancy_id = ".$_POST["discrepancyid"]."";
		
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
														<form style="margin-bottom:0;" action="part139327_sub_d_a_entry.php" method="POST" name="archiveform" id="archiveform" target="ArchiveWindow" onsubmit="window.open('', 'ArchiveWindow', 'width=600,height=500,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="discrepancyid" 		value="<?=$objarray['Discrepancy_id'];?>">
															<input type="hidden" name="menuitemid" 			value="<?=$strmenuitemid?>">
															<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
															<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
															<input type="submit" value="Mark Archived" name="b1" class="formsubmit">
															</td>
														</form>
														<form style="margin-bottom:0;" action="part139327_sub_d_d_entry.php" method="POST" name="archiveform" id="archiveform" target="ArchiveWindow" onsubmit="window.open('', 'ArchiveWindow', 'width=600,height=550,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="discrepancyid" 		value="<?=$objarray['Discrepancy_id'];?>">
															<input type="hidden" name="menuitemid" 			value="<?=$strmenuitemid?>">
															<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
															<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
															<input type="submit" value="Mark Duplicate" name="b1" class="formsubmit">
															</td>
														</form>
														<form style="margin-bottom:0;" action="part139327_sub_d_b.php" method="POST" name="archiveform" id="archiveform" target="ArchiveWindow" onsubmit="window.open('', 'ArchiveWindow', 'width=600,height=600,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="recordid" 			value="<?=$objarray['Discrepancy_id'];?>">
															<input type="hidden" name="menuitemid" 			value="<?=$strmenuitemid?>">
															<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
															<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
															<input type="submit" value="View Bounced History" name="b1" class="formsubmit">
															</td>
														</form>
														<form style="margin-bottom:0;" action="part139327_sub_d_r.php" method="POST" name="repairform" id="repairform" target="RepairWindow" onsubmit="window.open('', 'RepairWindow', 'width=600,height=600,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="recordid" 			value="<?=$objarray['Discrepancy_id'];?>">
															<input type="hidden" name="menuitemid" 			value="<?=$strmenuitemid?>">
															<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
															<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
															<input type="submit" value="View Repair History" name="b1" class="formsubmit">
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
							<input type="hidden" name="discrepancyid" 		value="<?=$objarray['Discrepancy_id'];?>">
							<input type="hidden" name="checklistid" 		value="<?=$objarray['discrepancy_checklist_id'];?>">
							<input type="hidden" name="Inspectionid" 		value="<?=$objarray['Discrepancy_inspection_id'];?>">
							<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
							<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
									Date
									</td>
								<td class="formanswers">
									<?
									$uidate = sqldate2amerdate($objarray['Discrepancy_date']);
									?>											
									<input class="Commonfieldbox" type="text" name="disdate" size="10" value="<?=$uidate;?>">
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(24 Hour Time)')"; onMouseout="hideddrivetip()">
									Time
									</td>
								<td class="formanswers">
									<input class="Commonfieldbox" type="text" name="distime" size="10" value="<?=$objarray['Discrepancy_time'];?>">
									</td>
								</tr>	
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(select from the list)')"; onMouseout="hideddrivetip()">
									Reported By
									</td>
								<td class="formanswers">
									<?
									systemusercombobox("all", "all", "disauthor", "show", $objarray['Discrepancy_by_cb_int']);
									?>
									</td>
								</tr>											
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
									Discrepancy Name
									</td>
								<td class="formanswers">
									<input class="Commonfieldbox" type="text" name="disname" size="60" value="<?=$objarray['Discrepancy_name'];?>">
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
									Comments
									</td>
								<td class="formanswers">
									<TEXTAREA class="Commonfieldbox" name="discomments" rows="10" cols="60"><?=$objarray['discrepancy_remarks'];?></TEXTAREA>
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(select from the list)')"; onMouseout="hideddrivetip()">
									Priority
									</td>
								<td class="formanswers">
									<?
									part139327prioritycombobox("all", "all", "dispri", "show", $objarray['discrepancy_priority']);
									?>
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
									Location
									</td>
								<td class="formanswers">
									X: &nbsp;<input class="Commonfieldbox" type="text" name="MouseX" value="<?=$objarray['Discrepancy_location_x'];?>" size="4">, Y: &nbsp;<input class="Commonfieldbox" type="text" name="MouseY" value="<?=$objarray['Discrepancy_location_y'];?>" size="4">&nbsp;<INPUT class="formsubmit" TYPE="button" VALUE="Map Discrepancy" onClick="openChild2('mapit.php','Win2')">
									</td>
								</tr>											
							<tr>
								<td colspan="2" class="formoptionsavilablebottom">
									<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.edittable.submit()">
									</td>
								</tr>
									<? 
								} 
							}
							?>

							</table>
						</td>
					</tr>
				</table>
				</form>
					<?
					}
				}	
			//}
			else {
			
		$sqldate		= AmerDate2SqlDateTime($_POST['disdate']);

		// Start to build the Insert SQL Statement
		$sql = "UPDATE tbl_139_327_sub_d SET Discrepancy_by_cb_int='".$_POST['disauthor']."', Discrepancy_name='".$_POST['disname']."', discrepancy_remarks='".$_POST['discomments']."', Discrepancy_date='".$sqldate."', Discrepancy_time='".$_POST['distime']."', Discrepancy_location_x='".$_POST['MouseX']."', Discrepancy_location_y='".$_POST['MouseY']."', discrepancy_priority='".$_POST['dispri']."' WHERE Discrepancy_id = ".$_POST['discrepancyid']." ";

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
						}					
				?>
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
												The Following Discrepancy was sucsessfully added to the Database, you may close this window now.
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Date
												</td>
											<td class="formanswers">
												<?=$_POST['disdate']?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Time
												</td>
											<td class="formanswers">
												<?=$_POST['distime']?>
												</td>
											</tr>	
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Reported By
												</td>
											<td class="formanswers">
												<?
												systemusercombobox($_POST['disauthor'], "all", "disauthor", "hide", "");
												?>
												</td>
											</tr>											
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Discrepancy Name
												</td>
											<td class="formanswers">
												<?=$_POST['disname']?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Comments
												</td>
											<td class="formanswers">
												<?=$_POST['discomments']?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Priority
												</td>
											<td class="formanswers">
												<?=$_POST['dispri']?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Location
												</td>
											<td class="formanswers">
												X: &nbsp;<?=$_POST['MouseX']?>, Y: &nbsp;<?=$_POST['MouseY']?>
												</td>
											</tr>
										<tr>
											<td colspan="2" class="formoptionsavilablebottom">
												
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>				
				
				<?
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor	= $_SESSION["user_id"];
		$dutylogevent	= "Edited record ID:".$_POST["discrepancyid"]." in table tbl_139_327_sub_d";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);

			}
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
