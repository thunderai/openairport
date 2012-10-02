<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139.327 Chart Report.php			The purpose of this page is to enter new Part 139.327 Airport Safety Self Inspections
	
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

	//Get Information from the FORM
		$tmpstartdate 	= $_POST['startdate'];
		$tmpenddate 	= $_POST['enddate'];
		$tmpchecklist 	= $_POST['checklist'];
		$tmpfacility 	= $_POST['facility'];
		$tmpcondition 	= $_POST['conditions'];
		
	// Convert start date and end date into sql format
	
		$tmpsqlstartdate	= amerdate2sqldatetime($tmpstartdate );
		$tmpsqlenddate		= amerdate2sqldatetime($tmpenddate );

		$OffSetX 		= -20;
		$OffSetY 		= 70;
		$tmpzindex		= 14;
		
		$isarchived			= "";
		$isduplicate		= "";
		$displaydatarow		= "";
		$displaydiscrepancy = "";
		
		$i					= "";
		
?>
<HTML>
	<HEAD>
		<TITLE>
			Open Airport - Airport Safety Self-Inspection Report (Printer Friendly)
			</TITLE>
				<style type="text/css">

#dhtmltooltip {
position: absolute;
width: 150px;
border: 2px solid black;
padding: 2px;
background-color: lightyellow;
visibility: hidden;
z-index: 100;
/*Remove below line to remove shadow. Below line should always appear last within this CSS*/
filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);
}

</style>
		</HEAD>
	<Body>
	<div style="position:absolute; z-index:1; left:3; top:74; width:711;" align="left">
		<img src="images/Part_139_327/alp_discrepancy_location_current.gif" width="711" height="849">
		</div>
	<div style="position:absolute; z-index:2; left:0; top:30; width:717;" align="left">
		<img src="images/Part_139_327/139_327_dischart_overlaygrid.gif" width="718" height="962">
		</div>
	<div style="position:absolute; z-index:3; left:690; top:0; width:30;" align="center">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width"30" id="AutoNumber1">
			<tr align="center">
				<td align="right">
					<font size="1"></font>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:3; left:300; top:900; width:450; align="center">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width"450" id="AutoNumber1">
			<tr align="center">
				<td align="left">
					&nbsp;<font size="1"></font>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:4; left:0; top:0; width:713; align="center">
		<center>
			<font size="5">
				Discrepancy Chart Generator
				</font>
			</center>
		</div>
	<div style="position:absolute; z-index:5; left:5; top:32; width:190; align="left">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13">
			<tr align="left">
				<td align="left">
					<b>DATE</b>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:6; left:95; top:32; width:190; align="left">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13">
			<tr align="center">
				<td align="center">
					<?
					$tmpdate = date('m/d/Y');
					?>
					<b><?=$tmpdate;?></b>	
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:7; left:290; top:32; width:190; align="center">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13">
			<tr align="left">
				<td align="left">
					<b>START DATE</b>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:8; left:392; top:32; width:185; align="center">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
			<tr align="center">
				<td align="center">
					<?=$tmpstartdate;?>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:9; left:5; top:52; width:190; align="left">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13">
			<tr align="left">
				<td align="left">
					<b>TIME</b>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:10; left:95; top:52; width:190; align="left">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13">
			<tr align="center">
				<td align="center">
					<b>
						<?echo date('H:m:s');?>
						</b>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:11; left:290; top:52; width:190; align="center">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13">
			<tr align="left">
				<td align="left">
					<b>END DATE</b>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:12; left:392; top:52; width:190; align="center">
		<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="185" id="AutoNumber1" height="13">
			<tr align="center">
				<td align="center">
					<?=$tmpenddate;?>
					</td>
				</tr>
			</table>
		</div>
	<?
	// Make sql Statement
	$sql = "SELECT * FROM tbl_139_327_sub_d WHERE Discrepancy_date >= '".$tmpsqlstartdate."' AND Discrepancy_date <= '".$tmpsqlenddate."'";
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
					$totalnumberofdiscrepancies = mysqli_num_rows($objrs);
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
							$tmpdiscrepancyid			= $objarray['Discrepancy_id'];
							$tmpdiscrepancycondition	= $objarray['discrepancy_checklist_id'];	
							// Connection to database established and we are now looping through every discrepancy. We first check to see if this discrepancy is archived or a duplicate
							
							// Checking to see if it is a duplicare
							$sql2 = "SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = '".$tmpdiscrepancyid."' ";
							//echo $sql2;
							//make connection to database
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
											//echo $number_of_rows;
											while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
													$tmpid = $objarray2['discrepancy_duplicate_id'];
													$isduplicate = 1;
												}
										}
								}	// End of checking to see if discrepancy is a duplicate
							$sql2 = "SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_inspection_id = '".$tmpdiscrepancyid."' ";
							//make connection to database
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
											while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
													$tmpid = $objarray2['discrepancy_archeived_id'];
													$isarchived = 1;
												}
										}
								}	// End of checking to see if the discrepancy is archived
							if ($isduplicate!=1) {
									// Discrepancy is not a duplicate
									if ($isarchived!=1) {
											// Discrepancy is not archived
											$displaydatarow=1;
										}
										else {
											// Discrepancy is archived
											//Do not display it
										}
								}
								else {
									// Discrepancy is a duplicate
									if ($isarchived!=1) {
											//Discrepancy is not archived
											// We would display, but we are not going to because the discrepancy is a duplicate
										}
										else {
											// Discrepancy is archived
											//Do not display it
										}
								}
							if ($displaydatarow==1) {
									// Discrepancy has passed the initial screening process, we now want to load information about the discrepancy condition.
									$sql2 = "SELECT * FROM tbl_139_327_sub_c_c WHERE conditions_checklists_id = '".$tmpdiscrepancycondition."' ";
									//make connection to database
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
													while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
															$tmpconditionid		= $objarray2['conditions_checklists_condition_cb_int'];
															$tmpinspectionid	= $objarray2['conditions_checklists_inspection_cb_int'];
															}
												}
										}	// End of Getting Checklist Condition ID
									// Now we need to get information about the condition
									$sql2 = "SELECT * FROM tbl_139_327_sub_c WHERE conditions_id = '".$tmpconditionid."' ";
									//make connection to database
									$objconn3 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}
										else {
											$objrs3 = mysqli_query($objconn3, $sql2);
											if ($objrs3) {
													$number_of_rows = mysqli_num_rows($objrs);
													while ($objarray3 = mysqli_fetch_array($objrs3, MYSQLI_ASSOC)) {
															$tmpconditionname		= $objarray3['condition_name'];
															$tmpfacilityid			= $objarray3['condition_facility_cb_int'];
															$tmpinspectiontypeid	= $objarray3['condition_type_cb_int'];
														}
												}
										}	// End of getting information about the condition
									// Now we determine if we display this discrepancy.  We check to see if this discrepancy meets any of the search critera.
									// Does discrepancy fall into the inspection type selection?
									if ($tmpchecklist=="all") {
											// The discrepancy obvously meets this critera
											$displaydiscrepancy = 1;
										}
										else {
											if ($tmpchecklist==$tmpinspectiontypeid) {
													// The discrepancy is from an inspection of the same type as selected
													$displaydiscrepancy = 1;
												}
												else {
													// Do not display discrepancy
												}
										}
									// Does discrepancy fall into the type of facility selected
									if ($tmpfacility=="all") {
											// The discrepancy obvously meets this critera
											$displaydiscrepancy = 1;
										}
										else {
											if ($tmpfacility==$tmpfacilityid) {
													// The discrepancy is from an inspection of the same type as selected
													$displaydiscrepancy = 1;
												}
												else {
													// Do not display discrepancy
												}
										}
									// Does discrepancy fall into the type of condition selected?
									if ($tmpcondition=="all") {
											// The discrepancy obvously meets this critera
											$displaydiscrepancy = 1;
										}
										else {
											if ($tmpcondition==$tmpconditionid) {
													// The discrepancy is from an inspection of the same type as selected
													$displaydiscrepancy = 1;
												}
												else {
													// Do not display discrepancy
												}
										}
									if ($displaydiscrepancy==1) {
											// Discrepancy meets one or all of the critera for being displayed, so lets display it.
											$TempX = ($objarray['Discrepancy_location_x'] + $OffSetX );
											$TempY = ($objarray['Discrepancy_location_y'] + $OffSetY );
											
											?>
		<div style="position:absolute; z-index:<?=$tmpzindex;?>; left:<?=$TempX;?>; top:<?=$TempY;?>; width:100; align="left">
			<table border="0" cellpadding="0" cellspacing="0" borderCOLOR="#000000" width="100" id="AutoNumber1">
  				<tr>
    					<td rowspan="2" width="31" height="31" align="left" valign="top">
    						 <a href="" target="_new">
							<img border="0" src="images/part_139_327/discrepancywork3.gif" width="31" height="31" border="0" onMouseover="ddrivetip('ID : <?=$objarray['Discrepancy_id'];?> <br> Name : <?=$objarray['Discrepancy_name'];?>')"; onMouseout="hideddrivetip()">
							</a>
						</td>
  					</tr>
				</table>
			</div>
											<?
											$i = $i + 1;
										}
										else {
											// Dont display discrepancy
										}
								}
								else {
									// Dont display discrepancy
								}
							$isduplicate			= "";
							$isarchived				= "";
							$displaydiscrepancy		= "";
							$displaydatarow			= "";							
						}	// End of discrepancy While Loop
				}	// End of active object connection
		}	// End of Sucessful connection
?>
	<div style="position:absolute; z-index:12; left:5; top:390; width:300; align="center">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="285" id="AutoNumber1" height="13">
			<tr align="center">
				<td align="left">
					<font size="2">There was a total of <?=$i;?> Discrepanci(es) found</font>
					</td>
				</tr>
			<tr>
				<td align="left">
					<?
					$tmpdis = ($totalnumberofdiscrepancies - $i);
					?>
					<font size="2">There are <?=$tmpdis;?> Discrepanci(es) not shown^</font>
					</td>
				</tr>
			</table>
		<br>
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="285" id="AutoNumber1" height="13">
			<tr align="center">
				<td colspan="2" align="left" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
					<font size="2">The search criteria was :</font>
					</td>
				</tr>
			<tr align="center">
				<td align="left">
					<font size="2">Inspection Type</font>
					</td>
				<td align="right">
					<font size="2">
					<?
					part139327typescomboboxwall($tmpchecklist, "all", "all", "hide", "");
					?>
					</td>
				</tr>
			<tr align="center">
				<td align="left">
					<font size="2">Facility Type</font>
					</td>
				<td align="right">
					<font size="2">
					<?
					part139327facilitycomboboxwall($tmpfacility, "all", "all", "hide", "");
					?>
					</td>
				</tr>
			<tr align="center">
				<td align="left">
					<font size="2">Condition Type</font>
					</td>
				<td align="right">
					<font size="2">
					<?
					part139327conditionscomboboxwall($tmpcondition, "all", "all", "hide", "");
					?>
					</td>
				</tr>					
			</table>
		<br>
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="285" id="AutoNumber1" height="13">
			<tr align="center">
				<td align="left">
					<font size="1">^, a discrepancy may not be shown because it is a duplicate or archived</font>
					</td>
				</tr>
			</table>
		</div>
		
<div style="z-index:99" id="dhtmltooltip"></div>

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
	</BODY>
	</HTML>
