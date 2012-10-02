<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Weather Charts Graphs.php			The purpose of this page is to list weather charts and graphics
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load include files
	
		include("includes/header.php");															// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
	
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	// will the form use any of the following toggle switches	
		// should the form have the ability to sort the data by date ?
		// 1 : yes ; 0 : no;
		$tbldatesort 			= 0;															// Display Date Sorting Options Toggle Switch
		$tbltextsort 			= 1;															// Display Text Sorting Options Toggle Switch
		$tblheadersort			= 1;															// Display Heading Sort Options Toggle Switch
		$tbldisplaytotal			= 1;
		
	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "aircraft_id";												// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "";															// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_aircraft_main";											// What table  is that field part of ?
		$tbltextsortfield		= "aircraft_name";												// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_aircraft_main";											// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "aircraft_archived_yn";										// What is the name of the field used to mark the record archived ?
		$tblname				= "Aircraft Summary Report";									// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "here is the information you selected";						// What is the subname of the table ? (used on edit/summary/printer report pages)

	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 			= "edit_record_general.php";
		// $functionsummarypage 		= "summary_report_general.php";
		// $functionprinterpage 		= "printer_report_general.php";
		$functioneditpage 		= "edit_record_general.php";									// Name of page used to edit the record
		$functionsummarypage 		= "summary_report_general.php";									// Name of page used to display a summary of the record
		$functionprinterpage 		= "printer_report_general.php";									// Name of page used to display a printer friendly report

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "aircraft_name";
		$adatafield[1]			= "aircraft_type_cb_int";
		$adatafield[2]			= "aircraft_weight";
		$adatafield[3]			= "aircraft_archived_yn";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_aircraft_main";
		$adatafieldtable[1]		= "tbl_aircraft_main";
		$adatafieldtable[2]		= "tbl_aircraft_main";
		$adatafieldtable[3]		= "tbl_aircraft_main";	
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "justsort";
		$adatafieldid[1]		= "aircraft_type_cb_int";
		$adatafieldid[2]		= "justsort";
		$adatafieldid[3]		= "justsort";
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		= 0;
		$adataspecial[1]		= 0;
		$adataspecial[2]		= 0;
		$adataspecial[3]		= 0;
	// should this column be added to create a totals column at the end of the recods
		$adataputarray[0]		= 0;
		$adataputarray[1]		= 0;
		$adataputarray[2]		= 1;
		$adataputarray[3]		= 0;
	// what do you want to name the columns
		$aheadername[0]			= "Name";
		$aheadername[1]			= "Type";
		$aheadername[2]			= "Weight";
		$aheadername[3]			= "Archived";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "( no special charactors )";
		$ainputcomment[1]		= "( select from the list )";
		$ainputcomment[2]		= "( select from the list )";
		$ainputcomment[3]		= "( checked = archived )";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "TEXT";
		$ainputtype[1]			= "SELECT";
		$ainputtype[2]			= "TEXT";
		$ainputtype[3]			= "CHECKBOX";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "aircrafttypescombobox";
		$adataselect[2]			= "";
		$adataselect[3]			= "";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";
		
	// Build SQL Statement
	// Since we have all of the information from the arrays and strings we can assemble the nessary SQL Statement without actually having to supply it verbatum.
	// The Limiting clauses will be left off, all we want to create at this point is the basic SELECT *,*,* FROM syntax
	
		$sql = "SELECT ".$tblkeyfield.",";														// Start SQL adding on the id field first						
		
		for ($i=0; $i<count($adatafield); $i=$i+1) {											// Loop through any of the arrays 0 to array length - 1
				$nsql = " ".$adatafield[$i]."";													// add each new value in the array to a temporary sql string
				$sql = $sql.$nsql;																// add the temporary sql string to the main sql string.
				if ($i == count($adatafield)-1) {												// test to see where we are in the string, in this case are we at the end or not?
						$nsql = "";																// at the end of the arrat dont add a , to the end of the value
						$sql = $sql.$nsql;														// add 'nothing' to the sql string
					}
					else {																		// not at the end of the array so do soemthing else
						$nsql = ", ";															// for each value in the array that is not at the end, add a , after the value
						$sql = $sql.$nsql;														// add the temporary sql string to the main sql string
					}			
		}
		$sql = $sql.$nsql;																		// field index values have all been added to the sql string (this line is reduntent, but there for space)
		$nsql = " FROM ".$tbldatesorttable." ";													// with all field index values added, add the FROM syntax and the applicable table in the DB
		$sql = $sql.$nsql;																		// make it all one nice sql string for use

	// For debugging purposes print out the SQL Statement
		//echo $sql;																				// When dedugging you can uncomment this echo and see the sql statement

	// Start the Real Fun	

		$i 							= 0;	
		$tblheadersortfirstselected="yes";
		$togfrmjoined = "";														//just in case we dont define it latter, set a default here.


//-------------------- [ there should be no need to change any of the code below this line ] ----------------------------------------------------------------------------------------------------------------------

	// build breadcrum trail	
		buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
		
	// store this array into a serialized array
		$stradatafield 			= urlencode(serialize($adatafield));			// dont touch
		$stradatafieldtable 	= urlencode(serialize($adatafieldtable));		// dont touch
		$stradatafieldid 		= urlencode(serialize($adatafieldid));			// dont touch	
		$stradataspecial		= urlencode(serialize($adataspecial));			// dont touch
		$straheadername			= urlencode(serialize($aheadername));			// dont touch
		$strainputtype			= urlencode(serialize($ainputtype));			// dont touch
		$stradataselect			= urlencode(serialize($adataselect));			// dont touch
		$strainputcomment		= urlencode(serialize($ainputcomment));			// dont touch
		
	// store this array into a serialized array
		$sadatafield 			= (serialize($adatafield));						// dont touch
		$sadatafieldtable 		= (serialize($adatafieldtable));				// dont touch
		$sadatafieldid 			= (serialize($adatafieldid));					// dont touch	
		$sadataspecial			= (serialize($adataspecial));					// dont touch
		$saheadername			= (serialize($aheadername));					// dont touch
		$sainputtype			= (serialize($ainputtype));						// dont touch
		$sadataselect			= (serialize($adataselect));					// dont touch
		$sainputcomment			= (serialize($ainputcomment));					// dont touch
		
		$sadatafield  			= str_replace("\"","|",$sadatafield);
		$sadatafieldtable 		= str_replace("\"","|",$sadatafieldtable);
		$sadatafieldid 			= str_replace("\"","|",$sadatafieldid);
		$sadataspecial 			= str_replace("\"","|",$sadataspecial);
		$saheadername 			= str_replace("\"","|",$saheadername);
		$sainputtype 			= str_replace("\"","|",$sainputtype);
		$sadataselect 			= str_replace("\"","|",$sadataselect);
		$sainputcomment			= str_replace("\"","|",$sainputcomment);

		$tmpfrmstartdateerror 	= "";
		$tmpfrmenddateerror 	= "";
		$arowtotal[0] 			= "";
		$arowtotal[1] 			= "";
		$arowtotal[2] 			= "";
		$arowtotal[3] 			= "";
		$arowtotal[4] 			= "";
		$arowtotal[5] 			= "";
		$arowtotal[6] 			= "";
		$arowtotal[7] 			= "";
		$arowtotal[8] 			= "";
		$arowtotal[9] 			= "";
		$arowtotal[10] 			= "";
		$arowtotal[11] 			= "";		
		
		
if (!isset($_POST["frmstartdate"])) {
		//$tbldatesortstart=($current_date-30);		
		// setup startdate for query
		$uifrmstartdate 		= date('m/d/Y');
		$sqlfrmstartdate 		= amerdate2sqldatetime($uifrmstartdate);
	}
	else {
		$uifrmstartdate 		= $frmstartdate;
		$sqlfrmstartdate 		= amerdate2sqldatetime($frmstartdate);
		}

if (!isset($_POST["frmenddate"])) {
		//$tbldatesortstart=($current_date-30);		
		// setup startdate for query
		$uifrmenddate 			= date('m/d/Y');
		$sqlfrmenddate 			= amerdate2sqldatetime($uifrmenddate);
	}
	else {
		$uifrmenddate 			= $frmenddate;
		$sqlfrmenddate 			= amerdate2sqldatetime($frmenddate);
		}

if (!isset($_POST["frmjoined"])) {
		//there is no information in this field, set default values
		
		// check to see if the intfrmjoined field has any value
		$intfrmjoined	= 0;
		$intsqlwhereaddon = 0;
		$strsqlwhereaddon = "none";
		
		$togfrmjoined = 1;
		
		if (!isset($_POST["intfrmjoined"])) {
				//echo "there is no value in intfrmjoined";
				$frmjoined 				= 0; //set value to zero (this causes the checkbox to not be checked
				$intfrmjoined 			= 0; //set value to zero (this causes the checkbox to not be checked
				}
			else {
				//echo "value is ".$intfrmjoined." ";
				if ($intfrmjoined==0) {
						// the value of the box has 'no' value
						$frmjoined				= "0";
						$intfrmjoined			= 0;
					}
					else {
						// the value of the box isn't one so we should do what it says
						$frmjoined				= 1;
						$intfrmjoined			= 1;
					}				
			}
		}
	else {
		// the field does exist, what is its current value
		$frmjoined				= $_POST["frmjoined"];
		$intfrmjoined			= 1;
		}	

if (!isset($_POST["strsqlwhereaddon"])) {
		$strsqlwhereaddon="none";
		$intsqlwhereaddon = 0;
	}
	else {
		if ($togfrmjoined==1) {
				// checkbox is not active, clean out sql statement
				$strsqlwhereaddon		= "";
				$intsqlwhereaddon 		= 1;
			}
			else {
	
		$strsqlwhereaddon		= $_POST["strsqlwhereaddon"];
		$strsqlwhereaddon 		= str_replace("%3d","=",$strsqlwhereaddon );
		//$tblsqlwhereaddon 		= 1;
		}
	} 

if (!isset($_POST["intsqlwhereaddon"])) {
		if ($tbldatesort==1) {
				$intsqlwhereaddon = 1;
			}
		//tblsqlwhereaddon = 1
	}
	else {
		$intsqlwhereaddon=$_POST["intsqlwhereaddon"];
		//tblsqlwhereaddon = 1
	}
	
for ($i=0; $i<count($aheadername); $i++) {
	if (!isset($_POST[$adatafield[$i]])) {
			$aheadersort[$i]="NotSorted";
		}
		else {
			$aheadersort[$i]=$_POST[$adatafield[$i]];
		} 
	}


// add where statement to sql statement
if ($tbldatesort==1) {
		$nsql = " where ".$tbldatesorttable.".".$tbldatesortfield." >= '".$sqlfrmstartdate."' and ".$tbldatesorttable.".".$tbldatesortfield." <= '".$sqlfrmenddate."'";
		$sql = $sql.$nsql;
		?>
		<script>	</script>
		<?
	}
if ($tbltextsort==1) {
		if ($tbldatesort==1) {
				$nsql = " and ".$tbltextsorttable.".".$tbltextsortfield." like '%".$frmtextlike."%' ";
				$sql = $sql.$nsql;
				}
			else {
				$nsql = " where ".$tbltextsorttable.".".$tbltextsortfield." like '%".$frmtextlike."%' ";
				$sql = $sql.$nsql;	
				}
	}
if ($strsqlwhereaddon=="none") {
		//do not add any additional sql to the sql statement as they have not been provided
		}
	else {
		if ($intfrmjoined==0) {
				// user has choosen not to enable column joining, so dont do it
				}
			else {
				// user has enabled column joining, so do it
				$sql = $sql.$strsqlwhereaddon;
			}
	}

//order by sql statement
if ($tblheadersort==1) {
	for ($i=0; $i<count($aheadersort); $i=$i+1) {
			if ($aheadersort[$i]=="NotSorted") {
					//do not add sorting column to sql string
				} 
			if ($aheadersort[$i]=="Assending") {
					if ($tblheadersortfirstselected=="yes") {
							//this is the first time a header has been selected
							$tblheadersortfirstselected="no"; //set selected to no
							$nsql=" order by ".$adatafieldtable[$i].".".$adatafield[$i]." ";
							$sql = $sql.$nsql;
						}
						else {
							$sql = $sql.", ".$adatafieldtable[$i].".".$adatafield[$i]." ";
						} 
				} 
			if ($aheadersort[$i]=="Decending") {
					if ($tblheadersortfirstselected=="yes") {
							//this is the first time a header has been selected
							$tblheadersortfirstselected="no"; //set selected to no
							$nsql=" order by ".$adatafieldtable[$i].".".$adatafield[$i]." desc ";
							$sql = $sql.$nsql;
						}
						else {
							$sql = $sql.", ".$adatafieldtable[$i].".".$adatafield[$i]." desc ";
						} 
				} 
		}
	}
	$sql 		= str_replace("%3D","=",$sql);
	//echo $sql;
?>

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
			<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
				<tr>
					<td class="formoptions" align="center">
						<a href="reports_weather/barchart.jpg" target="_new"><img src="reports_weather/barthumb.jpg"></a>
						</td>
					</tr>
				<tr>
					<td class="formoptions" align="center">
						Bar Chart
						</td>
					</tr>
				</table>
			<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
				<tr>
					<td class="formoptions" align="center">
						<a href="reports_weather/ceilingchart.jpg" target="_new"><img src="reports_weather/ceilingthumb.jpg"></a>
						</td>
					</tr>
				<tr>
					<td class="formoptions" align="center">
						Ceiling Chart
						</td>
					</tr>
				</table>
			<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
				<tr>
					<td class="formoptions" align="center">
						<a href="reports_weather/humidchart.jpg" target="_new"><img src="reports_weather/humiditythumb.jpg"></a>
						</td>
					</tr>
				<tr>
					<td class="formoptions" align="center">
						Humidity Chart
						</td>
					</tr>
				</table>
			<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
				<tr>
					<td class="formoptions" align="center">
						<a href="reports_weather/skychart.jpg" target="_new"><img src="reports_weather/skythumb.jpg"></a>
						</td>
					</tr>
				<tr>
					<td class="formoptions" align="center">
						Sky Chart
						</td>
					</tr>
				</table>
			<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
				<tr>
					<td class="formoptions" align="center">
						<a href="reports_weather/tempchart.jpg" target="_new"><img src="reports_weather/tempthumb.jpg"></a>
						</td>
					</tr>
				<tr>
					<td class="formoptions" align="center">
						Tempreture Chart
						</td>
					</tr>
				</table>
			<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
				<tr>
					<td class="formoptions" align="center">
						<a href="reports_weather/vischart.jpg" target="_new"><img src="reports_weather/visthumb.jpg"></a>
						</td>
					</tr>
				<tr>
					<td class="formoptions" align="center">
						Visability Chart
						</td>
					</tr>
				</table>
			<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
				<tr>
					<td class="formoptions" align="center">
						<a href="reports_weather/wdirchart.jpg" target="_new"><img src="reports_weather/wdirthumb.jpg"></a>
						</td>
					</tr>
				<tr>
					<td class="formoptions" align="center">
						Wind Direction Chart
						</td>
					</tr>
				</table>
			<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
				<tr>
					<td class="formoptions" align="center">
						<a href="reports_weather/windchart.jpg" target="_new"><img src="reports_weather/windthumb.jpg"></a>
						</td>
					</tr>
				<tr>
					<td class="formoptions" align="center">
						Wind Velocity Chart
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
<?
//include("includes/footer.php");		// include file that gets information from form POSTs for navigational purposes
?>	