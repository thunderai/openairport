<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139.327 D Entry.php			The purpose of this page is to enter new Discrepancies
	
								Usage:
								For use only with pat139327_sub_d.php
								
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		Session_Start();
		
		//include("includes/header.php");																	// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/NavFunctions.php");													// already included in header.php
		include("includes/UserFunctions.php");													// already included in header.php
		include("includes/FormFunctions.php");													// already included in header.php
		include("includes/DateFunctions.php");													// already included in header.php
		
		$tblname		= "Add New Discrepancy";
		$tblsubname		= "please complete the form";
?>
<HTML>
	<HEAD>
		<meta http-equiv="content-language" content="en-us">
		<meta http-equiv="content-type" content="text/html; charset=windows-1252">
		<title>Add New Part 139.327 Inspection Discrepancy</title>
		<script type="text/javascript" src="scripts/ajax.js"></script>
		<script type="text/javascript" src="scripts/AjaxRequest.js"></script>
		<link href="defaultoa.css" rel="stylesheet" type="text/css">
		<script type="text/javascript">
<!--
var getX = function(evt){
     if(evt.x){ return evt.x; }
     if(evt.pageX){ return evt.pageX;
}
}
var getY = function(evt){
     if(evt.y + document.body.scrollTop){ return evt.y + document.body.scrollTop; }
     if(evt.pageY + document.body.scrollTop ){ return evt.pageY + document.body.scrollTop; 
}
}
var alertCoords = function(evt){
	document.Show.MouseX.value = getX(evt)
	document.Show.MouseY.value = getY(evt)
     	alert("X = "+ getX(evt) +"\nY = "+ getY(evt));
}
// -->


</script>
		</head>
<SCRIPT LANGUAGE="JavaScript"><!--
function openChild2(file,window) {
    childWindow=open(file,window,'width=720,height=550,status=no,resizable=yes,scrollbars=yes');
    if (childWindow.opener == null) childWindow.opener = self;
    }
//--></SCRIPT>



	<body>
	<font size="2"><br></font>
<?
if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		?>
						<form action="<?=$_SERVER["PHP_SELF"];?>" method="post" name="edittable" id="edittable">
							<input class="commonfieldbox" type="hidden" name="formsubmit" size="1" value="1" >
							<input type="hidden" name="conditionid" 		value="<?=$_POST['conditionid'];?>">
							<input type="hidden" name="recordid" 			value="<?=$_POST['recordid'];?>">
							<input type="hidden" name="checklistid" 		value="<?=$_POST['checklistid'];?>">
							<input type="hidden" name="facilityid" 			value="<?=$_POST['facilityid'];?>">
							<input type="hidden" name="conditionname" 		value="<?=$_POST['conditionname'];?>">
							<input type="hidden" name="inspectiontypeid" 	value="<?=$_POST['inspectiontypeid'];?>">
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
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Date
												</td>
											<td class="formanswers">
												<input class="Commonfieldbox" type="text" name="disdate" size="10" value="<?echo date('m/d/Y');?>">
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Time
												</td>
											<td class="formanswers">
												<input class="Commonfieldbox" type="text" name="distime" size="10" value="<?echo date("H:i:s");?>">
												</td>
											</tr>	
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Reported By
												</td>
											<td class="formanswers">
												<?
												systemusercombobox($_SESSION['user_id'], "all", "disauthor", "hide", "");
												?>
												<input type="hidden" name="disauthor" size="60" value="<?=$_SESSION['user_id'];?>">
												</td>
											</tr>											
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Discrepancy Name
												</td>
											<td class="formanswers">
												<input class="Commonfieldbox" type="text" name="disname" size="60">
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Comments
												</td>
											<td class="formanswers">
												<TEXTAREA class="Commonfieldbox" name="discomments" rows="10" cols="60"></TEXTAREA>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Priority
												</td>
											<td class="formanswers">
												<SELECT class="Commonfieldbox" name="dispri">
													<OPTION value="1">Priority 1</option>
													<OPTION value="2">Priority 2</option>
													<OPTION value="3">Priority 3</option>
													<OPTION value="4">Priority 4</option>
													<OPTION value="5">Priority 5</option>
													</SELECT>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Location
												</td>
											<td class="formanswers">
												X: &nbsp;<input class="Commonfieldbox" type="text" name="MouseX" value="0" size="4">, Y: &nbsp;<input class="Commonfieldbox" type="text" name="MouseY" value="0" size="4">&nbsp;<INPUT class="formsubmit" TYPE="button" VALUE="Map Discrepancy" onClick="openChild2('mapit.php','Win2')">
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Kill Order
												</td>
											<td class="formanswers">
												<TEXTAREA class="Commonfieldbox" name="diskillorder" rows="10" cols="60"></TEXTAREA>
												</td>
											</tr>								
										<tr>
											<td colspan="2" class="formoptionsavilablebottom">
												<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.edittable.submit()">
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
				<?
		}
	else {
		
		// there is something in the post querystring, so this must not be the first time this form is being shown
		
		// Step 1). Load into an array all of the values from the form

		$sqldate		= AmerDate2SqlDateTime($_POST['disdate']);

		// Start to build the Insert SQL Statement
		$sql = "INSERT INTO tbl_139_327_sub_d (discrepancy_checklist_id, discrepancy_inspection_id, discrepancy_by_cb_int, discrepancy_name, discrepancy_remarks, discrepancy_date, discrepancy_time, discrepancy_location_x, discrepancy_location_y, discrepancy_priority)
		VALUES ( '".$_POST['checklistid']."', '".$_POST['recordid']."', '".$_POST['disauthor']."', '".$_POST['disname']."', '".$_POST['discomments']."', '".$sqldate."', '".$_POST['distime']."', '".$_POST['MouseX']."', '".$_POST['MouseY']."', '".$_POST['dispri']."' )";

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
				$lastid1 = mysqli_insert_id($mysqli);
				}
				
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor	= $_SESSION["user_id"];
		$dutylogevent	= "Added New Discrepancy ID ".$lastid." for Inspection ID ".$_POST['recordid']."";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
						
		if ($_POST['diskillorder']=='') {
				// No Killorder
				//echo "No Killorder Issued";
			}
			else {
				// Discrepancy has been killed on issue
				// Do an auto repair of item
		
				$sql = "INSERT INTO tbl_139_327_sub_d_r (discrepancy_repaired_inspection_id, discrepancy_repaired_by_cb_int, discrepancy_repaired_comments, discrepancy_repaired_date, discrepancy_repaired_time, discrepancy_repaired_yn)
				VALUES ( '".$lastid."', '".$_POST['disauthor']."', '".$_POST['diskillorder']."', '".$sqldate."', '".$_POST['distime']."', 1 )";
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
						
				$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
				$tmpsqltime		= date("H:i:s");
				$tmpsqlauthor	= $_SESSION["user_id"];
				$dutylogevent	= "Discrepancy ID ".$lastid1." was repaired in Repair ID ".$lastid." ";
				
				autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
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
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Kill Order
												</td>
											<td class="formanswers">
												<?=$_POST['diskillorder']?>
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
		$dutylogevent	= "Added New Discrepancy ID ".$lastid." for Inspection ID ".$_POST['recordid']."";
		
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
