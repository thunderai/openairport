<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139.339 Main E Entry.php		The purpose of this page is to enter new errors in inspections information.
	
								Usage:
								For use only with pat139339_sub_d.php
								
								
								
								
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
		
		$tblname		= "Mark NOTAM Closed";
		$tblsubname		= "please complete the form";
?>

<HTML>
	<HEAD>
		<meta http-equiv="content-language" content="en-us">
		<meta http-equiv="content-type" content="text/html; charset=windows-1252">
		<title>Mark NOTAM Closed</title>
		<script type="text/javascript" src="scripts/ajax.js"></script>
		<script type="text/javascript" src="scripts/AjaxRequest.js"></script>
		<link href="defaultoa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<BODY TOPMARGIN="0" LEFTMARGIN="8" MARGINWIDTH="0" MARGINHEIGHT="0">
<?
if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
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
						<form style="margin-top:-3px;" action="<?=$_SERVER["PHP_SELF"];?>" method="post" name="edittable" id="edittable">
							<input type="hidden" name="formsubmit" 			value="1" >
							<input type="hidden" name="inspectionid" 		value="<?=$_POST['inspectionid'];?>">
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									Mark NOTAM Closed
									</td>
								<td class="tableheaderright">
									(Please complete form)
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
												Closed By
												</td>
											<td class="formanswers">
												<?
												systemusercombobox($_SESSION['user_id'], "all", "disauthor", "hide", "");
												?>
												<input type="hidden" name="disauthor" size="60" value="<?=$_SESSION['user_id'];?>">
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
												Wx Initials (Cancel)
												</td>
											<td class="formanswers">
												<input class="commonfieldbox" type="text" id="139339_sub_n_wx_in" name="139339_sub_n_wx_in" size="10">
												</td>
											</tr>									
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
												FBO Initials (Cancel)
												</td>
											<td class="formanswers">
												<input class="commonfieldbox" type="text" id="139339_sub_n_fbo_in" name="139339_sub_n_fbo_in" size="10">
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
												Airline Initials (Cancel)
												</td>
											<td class="formanswers">
												<input class="commonfieldbox" type="text" id="139339_sub_n_airline_in" name="139339_sub_n_airline_in" size="10">
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
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(checked = bounced)')"; onMouseout="hideddrivetip()">
												Close It
												</td>
											<td class="formanswers">
												<input type="checkbox" class="commonfieldbox" name="disarchive" CHECKED value="1"> (Un-Check for Auto-Close)
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
		//echo $_POST['did'];

		// Start to build the Insert SQL Statement
		$sql = "INSERT INTO tbl_139_339_sub_n_r (139339_sub_n_r_cancelled_id_int,139339_sub_n_r_by_cb_int,139339_sub_n_r_notes,139339_sub_n_r_date,139339_sub_n_r_time,139339_sub_n_r_closed_yn,139339_sub_n_r_wx_in, 139339_sub_n_r_fbo_in,139339_sub_n_r_airline_in) VALUES ('".$_POST['inspectionid']."', '".$_POST['disauthor']."', '".$_POST['discomments']."', '".$sqldate."', '".$_POST['distime']."', '".$_POST['disarchive']."', '".$_POST['139339_sub_n_wx_in']."', '".$_POST['139339_sub_n_fbo_in']."', '".$_POST['139339_sub_n_airline_in']."')";

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
												The Following NOTAM was sucsessfully closed in the Database, you may close this window now.
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Date
												</td>
											<td class="formanswers">
												<?=$_POST['disdate'];?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Time
												</td>
											<td class="formanswers">
												<?=$_POST['distime'];?>
												</td>
											</tr>	
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Closed By
												</td>
											<td class="formanswers">
												<?
												systemusercombobox($_POST['disauthor'], "all", "disauthor", "hide", "");
												?>
												</td>
											</tr>											
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Comments
												</td>
											<td class="formanswers">
												<?=$_POST['discomments'];?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(checked = bounced)')"; onMouseout="hideddrivetip()">
												Closed It
												</td>
											<td class="formanswers">
												NOTAM was marked Closed
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
		$tmpsqldate			= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime			= date("H:i:s");
		$tmpsqlauthor		= $_SESSION["user_id"];
		$dutylogevent		= "Inspection ID ".$_POST['inspectionid']." was marked with an error.";
		
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
