<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	.Edit Record General.php			The Edit Record General Page takes a supplied set of arrays and strings and makes a generic form for editing inline with the OpenAirport layout specified in header.php
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	NOTE: THERE SHOULD BE NO NEED TO CHANGE ANY OF THE CODE ON THIS PAGE
	
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
	
		$tblkeyfield			= $_POST['tblkeyfield'];
		$tblarchivedfield		= $_POST['tblarchivedfield'];		
		$tbldatesortfield		= $_POST['tbldatesortfield'];											
		$tbldatesorttable		= $_POST['tbldatesorttable'];											
		$tbltextsortfield		= $_POST['tbltextsortfield'];											
		$tbltextsorttable		= $_POST['tbltextsorttable'];											
		$functioneditpage		= $_POST['editpage'];													
		$functionsummarypage	= $_POST['summarypage'];												
		$functionprinterpage	= $_POST['printerpage'];												
		//$sql 					= $_POST['frmurl'];															
		$menuitemid 			= $_POST['menuitemid'];													
		$tblname				= $_POST['tblname'];													
		$tblsubname				= $_POST['tblsubname'];

	// Take the seralized array which was submited with the Form and build the a new array which can be used by this page for performing actions
	// There are two phases, (1). Get the information from the POST and replace | with ", this is needed due to how the information is sent via the POST process.
	// Step (2). is to take the string replaced serialized array and rebuild it into an actuall array.
	
		$adatafield 			= unserialize(str_replace("|","\"",$_POST['adatafield']));				
		$adatafieldtable 		= unserialize(str_replace("|","\"",$_POST['adatafieldtable']));			
		$adatafieldid 			= unserialize(str_replace("|","\"",$_POST['adatafieldid']));				
		$adataspecial			= unserialize(str_replace("|","\"",$_POST['adataspecial']));			
		$aheadername			= unserialize(str_replace("|","\"",$_POST['aheadername']));				
		$ainputtype				= unserialize(str_replace("|","\"",$_POST['ainputtype']));				
		$ainputcomment			= unserialize(str_replace("|","\"",$_POST['ainputcomment']));			
		$adataselect			= unserialize(str_replace("|","\"",$_POST['adataselect']));				
	
	// Take the unserialized array and make serialized arrays for use in the FORMS on this page.
	// This is just the reverse of the previouse step, and although may not be required keeps all of the pages uniform in function and appereance.
	
		$sadatafield			= serialize($adatafield);
		$sadatafield			= str_replace("\"", "|",$sadatafield);
		$sadatafieldtable 		= serialize($adatafieldtable);											
		$sadatafieldtable 		= str_replace("\"","|",$sadatafieldtable);								
		$sadatafieldid 			= serialize($adatafieldid);												
		$sadatafieldid 			= str_replace("\"","|",$sadatafieldid);									
		$sadataspecial			= serialize($adataspecial);												
		$sadataspecial			= str_replace("\"","|",$sadataspecial);									
		$saheadername			= serialize($aheadername);												
		$saheadername			= str_replace("\"","|",$saheadername);									
		$sainputtype			= serialize($ainputtype);												
		$sainputtype			= str_replace("\"","|",$sainputtype);									
		$sainputcomment			= serialize($ainputcomment);											
		$sainputcomment			= str_replace("\"","|",$sainputcomment);								
		$sadataselect			= serialize($adataselect);												
		$sadataselect			= str_replace("\"","|",$sadataselect);									
	
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

		$i 						= 0;															// just in case we want the i variable to be defined before we use it
		$uisize 				= "60";															//just in case we dont define it latter, set a default here.

if (!isset($_POST["recordid"])) {
		// No Record ID Supplied, Crash Out
	}
	else {
		if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
// There is a Record ID Supplied, Do work
		
		// Connect to Database
		$nsql =" WHERE ".$tblkeyfield." = ".$_POST["recordid"]."";
		
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
														<form style="margin-bottom:0;" action="part135activity_sub_a.php" method="POST" name="manageaircraftform" id="manageaircraftform" target="manageaircraftformWindow" onsubmit="window.open('', 'manageaircraftformWindow', 'width=511,height=550,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="recordid" 			value="<?=$_POST['recordid'];?>">
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
															<input type="submit" value="Manage Aircraft Operations" name="B1" class="formsubmit">
															</td>
															</form>
														<form style="margin-bottom:0;" action="part135activity_main_report.php" method="POST" name="summaryform" id="summaryform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
														<td class="formoptionsubmit">
															<input type="hidden" name="recordid" 			value="<?=$_POST['recordid'];?>">
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
															<input type="submit" value="Printer Friendly Report" name="B1" class="formsubmit">
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
								<td colspan="3" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
										<tr>
											<td colspan="2" class="formoptionsavilabletop">
												Please complete the form below in as much detail as possible, and please pay close attention to syntax.
												</td>
											</tr>
						<form action="<?=$_SERVER["PHP_SELF"];?>" method="post" name="edittable" id="edittable">
							<input type="hidden" name="formsubmit" 			value="1">
							<input type="hidden" name="menuitemid" 			value="<?=$_POST['menuitemid'];?>">
							<input type="hidden" name="recordid" 			value="<?=$_POST['recordid'];?>">
							<input type="hidden" name="editpage" 			value="<?=$functioneditpage;?>">
							<input type="hidden" name="summarypage" 		value="<?=$functionsummarypage;?>">
							<input type="hidden" name="printerpage" 		value="<?=$functionprinterpage;?>">
							<input type="hidden" name="aheadername" 		value="<?=$saheadername;?>">
							<input type="hidden" name="adatafield" 			value="<?=$sadatafield;?>">
							<input type="hidden" name="adatafieldtable" 	value="<?=$sadatafieldtable;?>">
							<input type="hidden" name="adatafieldid" 		value="<?=$sadatafieldid;?>">
							<input type="hidden" name="adataspecial" 		value="<?=$sadataspecial;?>">
							<input type="hidden" name="ainputtype" 			value="<?=$sainputtype;?>">
							<input type="hidden" name="ainputcomment" 		value="<?=$sainputcomment;?>">
							<input type="hidden" name="adataselect" 		value="<?=$sadataselect;?>">
							<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
							<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
							<input type="hidden" name="tblkeyfield" 		value="<?=$tblkeyfield;?>">
							<input type="hidden" name="tblarchivedfield" 	value="<?=$tblarchivedfield;?>">
							<input type="hidden" name="tbldatesortfield" 	value="<?=$tbldatesortfield;?>">
							<input type="hidden" name="tbldatesorttable" 	value="<?=$tbldatesorttable;?>">
							<input type="hidden" name="tbltextsortfield" 	value="<?=$tbltextsortfield;?>">
							<input type="hidden" name="tbltextsorttable" 	value="<?=$tbltextsorttable;?>">
						<?
						while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
							$tmpid =	$objarray[$tblkeyfield];
						//	echo $tmpid;
							
							for ($i=0; $i<count($aheadername); $i=$i+1) {
									?>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('<?=$ainputcomment[$i];?>')"; onMouseout="hideddrivetip()">
									<? 
									switch ($adataspecial[$i]) {
											case 2:
													?>
									@ <?=$aheadername[$i];?>
													<? 
													break;
											case 4:
													?>
									$ <?=$aheadername[$i];?>
													<? 
													break;
											case 5:
													?>
									<?=$aheadername[$i];?> %
													<? 
													break;
											default:
													?>
									<?=$aheadername[$i];?>
													<? 
													break;
										}
									?>
									</td>
								<td class="formanswers">
									<?
									switch ($ainputtype[$i]) {
											case "TEXT":	// if the user entered "TEXT' as the input type make a ttext area box
													switch ($aheadername[$i]) {
															case "Date":
																	$uidate = sqldate2amerdate($objarray[$adatafield[$i]]);
																	$uisize = "10";
																	break;
															default:
																	$uidate = $objarray[$adatafield[$i]];
																	$uisize = "60";
																	break;
														}
																?>
									<input class="Commonfieldbox" type="text" name="<?=$adatafield[$i];?>" size="<?=$uisize;?>" value="<?=$uidate;?>">
													<?
													break;
											case "TEXTAREA":	// if the user entered "TEXTAREA" as the input type make a text area box
													?>
									<TEXTAREA class="Commonfieldbox" name="<?=$adatafield[$i];?>" rows="10" cols="60"><?=$objarray[$adatafield[$i]];?></TEXTAREA>
													<?	
													break;
											case "SELECT":	// if user entered "SELECT" as the input type make a select box
													// Load the specified function
													$adataselect[$i]("all", "all", $adatafield[$i], "show", $objarray[$adatafield[$i]]);
													break;
											case "CHECKBOX":	// if user entered "CHECKBOX" as the input type make a select box
													?>
													<input class="commonfieldbox" type="checkbox" name="<?=$adatafield[$i];?>" value="1"
														<?
														if ($objarray[$adatafield[$i]]==1) {
																?>
														checked="checked">
																<?
																}
																else {
																?>
														>
																<?
															}
														break;
											default:		// if there is an error with the user supplied input type use the 'text' type.
													?>
									<input class="Commonfieldbox" type="text" name="<?=$adatafield[$i];?>" size="10" value="<?=$objarray[$adatafield[$i]];?>">
													<?
													break;
										}
										?>
									</td>
								</tr>
									<? 
								} 
							}
							?>
							<input type="hidden" name="recordid" value="<?=$tmpid;?>">
							<tr>
								<td colspan="2" class="formoptionsavilablebottom">
									<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.edittable.submit()">
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</form>
					<?
					}
				}	
			}
			else {
			
			// there is something in the post querystring, so this must not be the first time this form is being shown
		
			// Step 1). Load into an array all of the values from the form

		for ($i=0; $i<count($adatafield); $i=$i+1) {
				switch ($aheadername[$i]) {
						case "Date":
								$asubmit[$i]		= AmerDate2SqlDateTime($_POST[$adatafield[$i]]);
								break;
						case "Archived":
								//echo "Archived";
								if (!isset($_POST[$adatafield[$i]])) {
										$asubmit[$i]			= 0;
									}
									else {
										$asubmit[$i]			= 1;
									}
								break;
						default:
								$asubmit[$i]			= $_POST[$adatafield[$i]];
								break;
					}
			}

		
		// Start to build the Insert SQL Statement
		$sql = "UPDATE ".$tbltextsorttable." SET ";
		
		for ($i=0; $i<count($asubmit); $i=$i+1) {
				$nsql = " ".$adatafield[$i]."='".$asubmit[$i]."'";
				$sql = $sql.$nsql;
				if ($i == count($asubmit)-1) {
						$nsql = "";
						$sql = $sql.$nsql;
					}
					else {
						$nsql = ", ";
						$sql = $sql.$nsql;
					}			
		}

		$nsql = " WHERE ".$tblkeyfield." = ".$_POST['recordid'];
		$sql = $sql.$nsql;
	
		echo $sql.'<BR><BR><BR>';
		
		$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($mysqli);
						}
						
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor	= $_SESSION["user_id"];
		$dutylogevent	= "Edited record ID:".$_POST["recordid"]." in Part 135 Aircraft Operations";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
?>
			<form name="redirect" action="part135activity_main_summary.php" method="POST">
				<input class="combobox" type="text" size="1" name="redirect2">
				<input type="hidden" name="editpage" 			value="<?=$_POST['editpage'];?>">
				<input type="hidden" name="summarypage" 		value="<?=$_POST['summarypage'];?>">
				<input type="hidden" name="printerpage" 		value="<?=$_POST['printerpage'];?>">
				<input type="hidden" name="recordid" 			value="<?=$_POST['recordid'];?>">
				<input type="hidden" name="menuitemid" 			value="<?=$strmenuitemid?>">
				<input type="hidden" name="aheadername" 		value="<?=$saheadername;?>">
				<input type="hidden" name="adatafield" 			value="<?=$sadatafield;?>">
				<input type="hidden" name="adatafieldtable" 	value="<?=$sadatafieldtable;?>">
				<input type="hidden" name="adatafieldid" 		value="<?=$sadatafieldid;?>">
				<input type="hidden" name="adataspecial" 		value="<?=$sadataspecial;?>">
				<input type="hidden" name="ainputtype" 			value="<?=$sainputtype;?>">
				<input type="hidden" name="ainputcomment" 		value="<?=$sainputcomment;?>">
				<input type="hidden" name="adataselect" 		value="<?=$sadataselect;?>">
				<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
				<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
				<input type="hidden" name="tblkeyfield" 		value="<?=$tblkeyfield;?>">
				<input type="hidden" name="tblarchivedfield" 	value="<?=$tblarchivedfield;?>">
				<input type="hidden" name="tbldatesortfield" 	value="<?=$tbldatesortfield;?>">
				<input type="hidden" name="tbldatesorttable" 	value="<?=$tbldatesorttable;?>">
				<input type="hidden" name="tbltextsortfield" 	value="<?=$tbltextsortfield;?>">
				<input type="hidden" name="tbltextsorttable" 	value="<?=$tbltextsorttable;?>">
				</form>

				<script>
				<!--
					var targetURL="summary_report_general.php"
					var countdownfrom=1
					var currentsecond=document.redirect.redirect2.value=countdownfrom+1
					function countredirect(){
						if (currentsecond!=1){
							currentsecond-=1
							document.redirect.redirect2.value=currentsecond
							}
							else{
								document.redirect.submit();
						return
						}
						setTimeout("countredirect()",0000)
						}
						countredirect()
				//-->
				</script>
				<?
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
