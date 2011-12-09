<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	TimeSheet Main Edit Save.php			The purpose of this page is to save a timesheet based on the data provided on the main page, from the edit function
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		include("includes/header.php");															// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");																// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		
	// Set some intitial variables

	// build breadcrum trail	
		buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);	
		
		$adatafield 			= unserialize(str_replace("|","\"",$_POST['adatafield']));					// Dont Touch
		$adatafieldtable 		= unserialize(str_replace("|","\"",$_POST['adatafieldtable']));				// Dont Touch
		$adatafieldid 			= unserialize(str_replace("|","\"",$_POST['adatafieldid']));				// Dont Touch	
		$adataspecial			= unserialize(str_replace("|","\"",$_POST['adataspecial']));				// Dont Touch
		$aheadername			= unserialize(str_replace("|","\"",$_POST['aheadername']));					// Dont Touch
		$ainputtype			= unserialize(str_replace("|","\"",$_POST['ainputtype']));					// Dont Touch
		$ainputcomment			= unserialize(str_replace("|","\"",$_POST['ainputcomment']));				// Dont Touch
		$adataselect			= unserialize(str_replace("|","\"",$_POST['adataselect']));					// Dont Touch

		$sadatafield			= serialize($adatafield);
		$sadatafield			= str_replace("\"", "|",$sadatafield);
		$sadatafieldtable 		= serialize($adatafieldtable);											// Dont Touch
		$sadatafieldtable 		= str_replace("\"","|",$sadatafieldtable);									// Dont Touch
		$sadatafieldid 			= serialize($adatafieldid);												// Dont Touch	
		$sadatafieldid 			= str_replace("\"","|",$sadatafieldid);									// Dont Touch	
		$sadataspecial			= serialize($adataspecial);												// Dont Touch
		$sadataspecial			= str_replace("\"","|",$sadataspecial);									// Dont Touch
		$saheadername			= serialize($aheadername);												// Dont Touch
		$saheadername			= str_replace("\"","|",$saheadername);										// Dont Touch
		$sainputtype			= serialize($ainputtype);												// Dont Touch
		$sainputtype			= str_replace("\"","|",$sainputtype);										// Dont Touch
		$sainputcomment			= serialize($ainputcomment);												// Dont Touch
		$sainputcomment			= str_replace("\"","|",$sainputcomment);									// Dont Touch
		$sadataselect			= serialize($adataselect);												// Dont Touch
		$sadataselect			= str_replace("\"","|",$sadataselect);										// Dont Touch
	
	// STEP ONE : SAVE TIMESHEET TO tbl_timesheet_main				
		
		$recordid				= $_POST['recordid'];
		
		//echo $_POST["formsubmit"];
		$tmpsqldate			= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime			= date("H:i:s");
		$tmpsqlauthor			= $_SESSION["user_id"];
		$dutylogevent			= "TimeSheet: ".$recordid." Was Edited and Saved";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);	
	
	// STEP TWO : Save indiviudal week information to tbl_timesheets_sub_w
		// To accomplish this task we need loop through each of the possible setweek combinations, given if the month has 5 weeks and save the information to the tbl_timesheets_sub_w table.
	
		// Load a function that will do all of this for us
		if ($_POST['has_5'] == 1) {
				$count 	= 5;																	// How many weeks to loop through
			}
			else {
				$count	= 4;																	// How many weeks to loop through
			}

		for ($i=1; $i<($count+1); $i=$i+1) {															// Loop through a given number of weeks
				for ($j=1; $j<(8); $j=$j+1) {														// Loop through the entire week
						//echo "i :".$i.", j :".$j.", k :".$k."<br>";
						//make string ID post name
						$tmp	= "set".$i."week".$j."_id";
						$tmp	= $_POST[$tmp];
						updatetimesheetweekdata($i, $j, $recordid, $tmp);
					}
			}
			
	// STEP THREE : Display Summary Report
	?>	
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									Timesheet Summary Report
									</td>
								<td class="tableheaderright">
									(Your timesheet has been generated and saved)
									</td>
								</tr>
							<tr>
								<td colspan="3" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
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
														<form style="margin-bottom:0;" action="timesheet_main_report.php" method="POST" name="summaryform" id="summaryform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="recordid" 			value="<?=$recordid;?>">
															<input type="hidden" name="menuitemid" 			value="<?=$_POST['menuitemid'];?>">
															<input type="hidden" name="editpage" 			value="<?=$functioneditpage;?>">
															<input type="hidden" name="summarypage" 		value="<?=$functionsummarypage;?>">
															<input type="hidden" name="printerpage" 		value="<?=$functionprinterpage;?>">
															<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
															<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
															<input type="hidden" name="aheadername" 		value="<?=$saheadername;?>">
															<input type="hidden" name="adatafield" 			value="<?=$sadatafield;?>">
															<input type="hidden" name="adatafieldtable" 	value="<?=$sadatafieldtable;?>">
															<input type="hidden" name="adatafieldid" 		value="<?=$sadatafieldid;?>">
															<input type="hidden" name="adataspecial" 		value="<?=$sadataspecial;?>">
															<input type="hidden" name="ainputtype" 			value="<?=$sainputtype;?>">
															<input type="hidden" name="ainputcomment" 		value="<?=$sainputcomment;?>">
															<input type="hidden" name="adataselect" 		value="<?=$sadataselect;?>">
															<input type="hidden" name="tblkeyfield" 		value="<?=$tblkeyfield;?>">
															<input type="hidden" name="tblarchivedfield"	value="<?=$tblarchivedfield;?>">
															<input type="hidden" name="tbldatesortfield" 	value="<?=$tbldatesortfield;?>">
															<input type="hidden" name="tbldatesorttable" 	value="<?=$tbldatesorttable;?>">
															<input type="hidden" name="tbltextsortfield" 	value="<?=$tbltextsortfield;?>">
															<input type="hidden" name="tbltextsorttable" 	value="<?=$tbltextsorttable;?>">
															<input type="submit" value="Printer Friendly Timesheet" name="B1" class="formsubmit">
															</td>
															</form>
														<form style="margin-bottom:0;" action="timesheet_main_edit.php" method="POST" name="summaryform" id="summaryform">
														<td class="formoptionsubmit">
															<input type="hidden" name="recordid" 			value="<?=$recordid;?>">
															<input type="hidden" name="menuitemid" 			value="<?=$_POST['menuitemid'];?>">
															<input type="hidden" name="editpage" 			value="<?=$functioneditpage;?>">
															<input type="hidden" name="summarypage" 		value="<?=$functionsummarypage;?>">
															<input type="hidden" name="printerpage" 		value="<?=$functionprinterpage;?>">
															<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
															<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
															<input type="hidden" name="aheadername" 		value="<?=$saheadername;?>">
															<input type="hidden" name="adatafield" 			value="<?=$sadatafield;?>">
															<input type="hidden" name="adatafieldtable" 	value="<?=$sadatafieldtable;?>">
															<input type="hidden" name="adatafieldid" 		value="<?=$sadatafieldid;?>">
															<input type="hidden" name="adataspecial" 		value="<?=$sadataspecial;?>">
															<input type="hidden" name="ainputtype" 			value="<?=$sainputtype;?>">
															<input type="hidden" name="ainputcomment" 		value="<?=$sainputcomment;?>">
															<input type="hidden" name="adataselect" 		value="<?=$sadataselect;?>">
															<input type="hidden" name="tblkeyfield" 		value="<?=$tblkeyfield;?>">
															<input type="hidden" name="tblarchivedfield"	value="<?=$tblarchivedfield;?>">
															<input type="hidden" name="tbldatesortfield" 	value="<?=$tbldatesortfield;?>">
															<input type="hidden" name="tbldatesorttable" 	value="<?=$tbldatesorttable;?>">
															<input type="hidden" name="tbltextsortfield" 	value="<?=$tbltextsortfield;?>">
															<input type="hidden" name="tbltextsorttable" 	value="<?=$tbltextsorttable;?>">
															<input type="submit" value="Edit Timesheet" name="B1" class="formsubmit">
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
								<td align="center" valign="middle" class="formoptions">
									Employee
									</td>
								<td class="formanswers">
									<font color="#FFFFFF">
										<?
										systemusercombobox($_POST['inspector'], "all", $adatafield[$i], "hide", "all");
										?>
										</font>
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions">
									Month
									</td>
								<td class="formanswers">
									<font color="#FFFFFF">
										<?=$_POST['month'];?>
										</font>
									</td>
								</tr>	
							</table>
						</td>
					</tr>
				</table>
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