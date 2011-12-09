<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139.327 Discrepancy Browse.php	The purpose of this page is to list Discrepancies for editing and printing
	
								Usage:
								This page is based upon the default browse template, but has the following changes
								1). The number of functions has been increased to account for all of the different subs of discrepancies
								
								
								
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
		$tbldatesort 			= 1;															// Display Date Sorting Options Toggle Switch
		$tbltextsort 			= 1;															// Display Text Sorting Options Toggle Switch
		$tblheadersort			= 1;															// Display Heading Sort Options Toggle Switch
		
		// Temporaryly set here to inital a value.  The user will be able to define these using the interface as well.
		$tblduplicatesort		= 0;															// Show discrepancies which are duplicates
		$tblarchivedsort		= 0;															// Show discrepancies which are archived
		$tblworkorderssort		= 0;
		$tblrepairedsort		= 0;
		
	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "Discrepancy_id";												// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "Discrepancy_date";												// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_139_327_sub_d";												// What table  is that field part of ?
		$tbltextsortfield		= "Discrepancy_name";											// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_139_327_sub_d";												// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "";										// What is the name of the field used to mark the record archived ?
		$tblname				= "Discrepancy Monitor";									// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "here is the information you selected";						// What is the subname of the table ? (used on edit/summary/printer report pages)
	
	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 			= "edit_record_general.php";
		// $functionsummarypage 		= "summary_report_general.php";
		// $functionprinterpage 		= "printer_report_general.php";
		$functioneditpage 		= "part139327_sub_d_edit.php";									// Name of page used to edit the record
		$functionsummarypage 	= "summary_report_general.php";									// Name of page used to display a summary of the record
		$functionprinterpage 	= "printer_report_general.php";									// Name of page used to display a printer friendly report

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "Discrepancy_date";
		$adatafield[1]			= "Discrepancy_time";
		$adatafield[2]			= "discrepancy_priority";
		$adatafield[3]			= "discrepancy_name";
		$adatafield[4]			= "discrepancy_by_cb_int";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_139_327_sub_d";
		$adatafieldtable[1]		= "tbl_139_327_sub_d";
		$adatafieldtable[2]		= "tbl_139_327_sub_d";
		$adatafieldtable[3]		= "tbl_139_327_sub_d";		
		$adatafieldtable[4]		= "tbl_139_327_sub_d";	
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "notjoined";
		$adatafieldid[1]		= "notjoined";
		$adatafieldid[2]		= "discrepancy_priority";
		$adatafieldid[3]		= "justsort";
		$adatafieldid[4]		= "discrepancy_by_cb_int";
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		= 0;
		$adataspecial[1]		= 0;
		$adataspecial[2]		= 0;
		$adataspecial[3]		= 0;
		$adataspecial[4]		= 0;
	// what do you want to name the columns
		$aheadername[0]			= "Date";
		$aheadername[1]			= "Time";
		$aheadername[2]			= "Priority";
		$aheadername[3]			= "Name";
		$aheadername[4]			= "Author";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "( mm/dd/yyyy )";
		$ainputcomment[1]		= "( 24 hour )";
		$ainputcomment[2]		= "(select from the list)";
		$ainputcomment[3]		= "(no special charactors)";
		$ainputcomment[4]		= "(select from the list)";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "TEXT";
		$ainputtype[1]			= "TEXT";
		$ainputtype[2]			= "SELECT";
		$ainputtype[3]			= "TEXT";
		$ainputtype[4]			= "SELECT";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "";
		$adataselect[2]			= "part139327prioritycombobox";
		$adataselect[3]			= "";
		$adataselect[4]			= "systemusercombobox";
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
		$togfrmjoined = "";																		//just in case we dont define it latter, set a default here.
		$discrepancybouncedid 	= "";
		$discrepancybounceddate = "";
		$discrepancybouncedtime = "";
		$discrepancyrepairid 	= "";
		$discrepancyrepairdate 	= "";
		$discrepancyrepairtime 	= "";
		$isduplicate			= "";
		$isarchived				= "";
		$displaydatarow			= "";
		


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

$tmpfrmstartdateerror = "";
$tmpfrmenddateerror = "";

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
	
if (!isset($_POST["frmduplicates"])) {
		$tblduplicatesort	= "";
	}
	else {
		// the field does exist, what is its current value
		$tblduplicatesort				= $_POST["frmduplicates"];
	}
if (!isset($_POST["frmarchives"])) {
		$tblarchivedsort	= "";
	}
	else {
		// the field does exist, what is its current value
		$tblarchivedsort				= $_POST["frmarchives"];
	}
if (!isset($_POST["frmworkorders"])) {
		$tblworkorderssort	= "";
	}
	else {
		// the field does exist, what is its current value
		$tblworkorderssort				= $_POST["frmworkorders"];
	}
if (!isset($_POST["frmrepaired"])) {
		$tblrepairedsort	= "";
	}
	else {
		// the field does exist, what is its current value
		$tblrepairedsort				= $_POST["frmrepaired"];
	}
?>


<form action="<?=$_SERVER["PHP_SELF"];?>" method="POST" name="sorttable" id="sorttable">
<input type="hidden" name="menuitemid" value="<?=$_POST['menuitemid'];?>">
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
				<input class="commonfieldbox" type="hidden" name="frmurl" size="1" value="<?=$frmurl;?>" >
				<input class="combobox" type="hidden" size="4" name="intfrmjoined" value="<?=$intfrmjoined;?>" >
				<input class="combobox" type="hidden" size="40" name="strsqlwhereaddon" value="<?=$strsqlwhereaddon;?>" >
				<input class="combobox" type="hidden" size="4" name="intsqlwhereaddon" id="intsqlwhereaddon" value="<?=$intsqlwhereaddon;?>" >
				<tr>
					<td class="formoptions" align="center">
						<?
						if ($tbldatesort==1) {
								?>
						Start Date<br><input class="commonfieldbox" type="text" name="frmstartdate" size="10" value="<?=$uifrmstartdate;?>" onchange="javascript:(isdate(this.form.frmstartdate.value,'mm/dd/yyyy'))">
								<?
							}
							else {
								?>
						Turned Off
								<?
							}
						?>
						</td>
					<td class="formoptions" align="center">
						<?
						if ($tbldatesort==1) {
								?>
						End Date<br><input class="commonfieldbox" type="text" name="frmenddate" size="10" value="<?=$uifrmenddate;?>" onchange="javascript:(isdate(this.form.frmenddate.value,'mm/dd/yyyy'))">
								<?
							}
							else {
								?>
						Turned Off
								<?
							}
						?>
						</td>
					<td class="formoptions" align="center" onMouseover="ddrivetip('If you want to narrow down the discrepancies displayed to a name contining cetain text, enter that text here')"; onMouseout="hideddrivetip()">
						<?
						if ($tbltextsort==1) {
								?>
						Text Like<br><input class="commonfieldbox" type="text" name="frmtextlike" size="25" value="<?=$frmtextlike;?>">
								<?
							}
							else {
								?>
						Tuned Off
								<?
							}
						?>
						</td>
					<td class="formoptions" align="center" onMouseover="ddrivetip('Clicking this checkbox will limit the displayed discrepancies to those tied to a specific column or type. (i.e. discrepancies by one person, etc.)')"; onMouseout="hideddrivetip()">
						Joined <input class="commonfieldbox" type="checkbox" name="frmjoined" id="frmjoined" size="25" value="1"
						<?
						if ($frmjoined=="1") {
								
								?>
						checked="checked">
								<?
								}
							else {
								?>
							>
								<?
							}
						?>
						</td>
					<td class="formoptions" align="center" onMouseover="ddrivetip('Clicking this checkbox will display all discrepancies including those marked as duplicates')"; onMouseout="hideddrivetip()">
						Duplicates <input class="commonfieldbox" type="checkbox" name="frmduplicates" id="frmduplicates" size="25" value="1"
						<?
						if ($tblduplicatesort=="1") {
								
								?>
						checked="checked">
								<?
								}
							else {
								?>
							>
								<?
							}
						?>
						</td>
					<td class="formoptions" align="center" onMouseover="ddrivetip('Clicking this checkbox will display all discrepancies including those marked as archived')"; onMouseout="hideddrivetip()">
						Archives <input class="commonfieldbox" type="checkbox" name="frmarchives" id="frmarchives" size="25" value="1"
						<?
						if ($tblarchivedsort=="1") {
								
								?>
						checked="checked">
								<?
								}
							else {
								?>
							>
								<?
							}
						?>
						</td>
												<?
						/*
					<td class="formoptions" align="center" onMouseover="ddrivetip('Clicking this checkbox will display only those discrepancies with an outstanding workorder')"; onMouseout="hideddrivetip()">
						Work Orders <input class="commonfieldbox" type="checkbox" name="frmarchives" id="frmwordorders" size="25" value="1"
						<?
						if ($tblworkorderssort=="1") {
								
								?>
						checked="checked">
								<?
								}
							else {
								?>
							>
								<?
							}
						?>
						</td>
					<td class="formoptions" align="center" onMouseover="ddrivetip('Clicking this checkbox will display only repaired discrepancies')"; onMouseout="hideddrivetip()">
						Repaired <input class="commonfieldbox" type="checkbox" name="frmarchives" id="frmrepaired" size="25" value="1"
						<?
						if ($tblrepairedsort=="1") {
								
								?>
						checked="checked">
								<?
								}
							else {
								?>
							>
								<?
							}
						?>
						</td>
						*/
						?>
					<td class="formoptions" align="center">
						<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.sorttable.submit()">
						</td>
					</tr>
				<tr>
					<td class="formoptionsavilabletop">
						<?
						if ($tmpfrmstartdateerror == 1) {
							echo $tmpdateeventerrormessage;
							}
						?>
						</td>
					<td class="formoptionsavilabletop">
						<?
						if ($tmpfrmenddateerror == 1) {
							echo $tmpdateeventerrormessage;
							}
						?>
						</td>
					<td class="formoptionsavilabletop">
						
						</td>
					<td class="formoptionsavilabletop">
						
						</td>
					</tr>
				</table>
			<table border="0" width="100%" cellspacing="4">
				<tr>
					<td class="formresultscount">
						<?
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
										$number_of_rows = mysqli_num_rows($objrs);
										
										?>
						there was <?=$number_of_rows;?> records found
						</td>
					</tr>
					<?
					if ($number_of_rows==0) {
						//echo "no records found";
						}
						else {
						?>
				<tr>
					<td>
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
											<td class="formoptionsubmit" onclick="window.open('/browse_report_general.php?frmurl=<?=$encoded;?>&menuitemid=<?=$strmenuitemid?>&aheadername=<?=$straheadername;?>&adatafield=<?=$stradatafield;?>&tblkeyfield=<?=$tblkeyfield;?>&tbldatesortfield=<?=$tbldatesortfield;?>&tbldatesorttable=<?=$tbldatesorttable;?>&tbltextsortfield=<?=$tbltextsortfield;?>&tbltextsorttable=<?=$tbltextsorttable;?>&adatafieldtable=<?=$stradatafieldtable;?>&adatafieldid=<?=$stradatafieldid;?>&adataspecial=<?=$stradataspecial;?>&adataselect=<?=$stradataselect?>&tblarchivedfield=<?=$tblarchivedfield?>','printerfriendlyreport','width=750,height=550');">
												&nbsp;Printer Friendly Report&nbsp;
												</td>	
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				<tr>
					<td class="tabledatarow">
						<table border="0" width="100%" id="table1" cellpadding="0" cellspacing="1"  style="border-collapse: collapse">
							<tr>
								<td class="formheaders">
									ID
									</td>
								<td class="formheaders">
									Functions
									</td>
								<? 
								for ($i=0; $i<count($aheadername); $i=$i+1) {
										?>
								<td class="formheaders">
										<? 
										if ($tblheadersort==1) {
												?>
									<a href="#" onfocus="javascript:getvaluesortform('<?=$adatafield[$i];?>');" onclick="javascript:updatesortform('<?=$adatafield[$i];?>');"><font color="#ffffff"><?=$aheadername[$i];?></font></a>
									<br>(<input class="inlinehiddenbox" type="text" size="8" id="<?=$adatafield[$i];?>" name="<?=$adatafield[$i];?>" value="<?=$aheadersort[$i];?>">)
												<? 
											} 
										?>
									</td>
										<?
									}
									?>
									</form>
								<td class="formheaders">
									Classifications
									</td>
								</tr>
										<?
										while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										
												// We need to determine if this discrepancy is archived or a duplicate before we start to display anything about them. That way we can control how they look or if we even show
												// the discrepancy at all.
										
												// Step 1 is to see if the user wants to display duplicated discrepancies
												//test 1). Is this discrepancy a duplicate? to determine this we need to do a search in the duplcate table for this id and see if we get a record. 
												//Anything over 0 records means it is a duplicate and we need to display the duplicate summary report, making a little 'D' box
								
												$sql2 = "SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = '".$objarray[$tblkeyfield]."' ";
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
													}
												//test 2). Is this discrepancy archived? to determine this we need to do a search in the duplcate table for this id and see if we get a record. 
												//Anything over 0 records means it is archived and we need to display the archived summary report, making a little 'A' box
												$sql2 = "SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_inspection_id = '".$objarray[$tblkeyfield]."' ";
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
													}
												
												if ($isduplicate==1) {
														if($tblduplicatesort==1) {
																$displaydatarow=1;
															}
															else {
																// Don't display datarow
																$displaydatarow=0;
															}
													}
													else {
														//echo "Not Duplicate, Maybe archived";
														if ($isarchived==1) {
																//echo "Is rchived, do I display it?".$tblarchivedsort;
																if ($tblarchivedsort=="1") {
																		//echo "Display Row";
																		$displaydatarow=1;
																	}
																	else {
																		// Don't display datarow
																		//echo "Dont Display row";
																		$displaydatarow=0;
																	}
															}
															else {
																// This record is not a duplicate, and not archived, so lets display it anyway
																$displaydatarow=1;
															}
													}
													
												if ($displaydatarow==1) {
										?>
							<tr>
								<td height="32" align="center" class="formresults">
									<?=$objarray[$tblkeyfield];?>
									</td>
								<td align="center" class="formresults">
									<table border="1" width="50" cellspacing="0" id="table1" class="formsubmit cellpadding="0">
										<tr>
											<form style="margin-bottom:0;" action="<?=$functioneditpage;?>" method="POST" name="editform" id="editform">
											<td class="formoptionsubmit">
												<input type="hidden" name="editpage" 			value="<?=$functioneditpage;?>">
												<input type="hidden" name="summarypage" 		value="<?=$functionsummarypage;?>">
												<input type="hidden" name="printerpage" 		value="<?=$functionprinterpage;?>">
												<input type="hidden" name="discrepancyid" 		value="<?=$objarray[$tblkeyfield];?>">
												<input type="hidden" name="menuitemid" 			value="<?=$strmenuitemid?>">
												<input type="hidden" name="aheadername" 		value="<?=$saheadername;?>">
												<input type="hidden" name="adatafield" 			value="<?=$sadatafield;?>">
												<input type="hidden" name="adatafieldtable" 	value="<?=$sadatafieldtable;?>">
												<input type="hidden" name="adatafieldid" 		value="<?=$sadatafieldid;?>">
												<input type="hidden" name="adataspecial" 		value="<?=$sadataspecial;?>">
												<input type="hidden" name="ainputtype" 			value="<?=$sainputtype;?>">
												<input type="hidden" name="adataselect" 		value="<?=$sadataselect;?>">
												<input type="hidden" name="ainputcomment" 		value="<?=$sainputcomment;?>">
												<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
												<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
												<input type="hidden" name="tblkeyfield" 		value="<?=$tblkeyfield;?>">
												<input type="hidden" name="tblarchivedfield" 	value="<?=$tblarchivedfield;?>">
												<input type="hidden" name="tbldatesortfield" 	value="<?=$tbldatesortfield;?>">
												<input type="hidden" name="tbldatesorttable" 	value="<?=$tbldatesorttable;?>">
												<input type="hidden" name="tbltextsortfield" 	value="<?=$tbltextsortfield;?>">
												<input type="hidden" name="tbltextsorttable" 	value="<?=$tbltextsorttable;?>">
												<input type="submit" value="E" name="b1" class="formsubmit" onMouseover="ddrivetip('Edit this Discrepancy')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											<form style="margin-bottom:0;" action="<?=$functionsummarypage;?>" method="POST" name="summaryform" id="summaryform">
											<td class="formoptionsubmit">
												<input type="hidden" name="editpage" 			value="<?=$functioneditpage;?>">
												<input type="hidden" name="summarypage" 		value="<?=$functionsummarypage;?>">
												<input type="hidden" name="printerpage" 		value="<?=$functionprinterpage;?>">
												<input type="hidden" name="recordid" 			value="<?=$objarray[$tblkeyfield];?>">
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
												<input type="submit" value="S" name="b1" class="formsubmit" onMouseover="ddrivetip('Get a Summary of this Discrepancy')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											<form style="margin-bottom:0;" action="<?=$functionprinterpage;?>" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="editpage" 			value="<?=$functioneditpage;?>">
												<input type="hidden" name="summarypage" 		value="<?=$functionsummarypage;?>">
												<input type="hidden" name="printerpage" 		value="<?=$functionprinterpage;?>">
												<input type="hidden" name="recordid" 			value="<?=$objarray[$tblkeyfield];?>">
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
												<input type="submit" value="R" name="b1" class="formsubmit" onMouseover="ddrivetip('Printer Friendly Report of this Discrepancy')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											</tr>
										</table>
									</td>
								<? 
								for ($i=0; $i<count($aheadername); $i=$i+1) {
										?>
								<td align="center" valign="middle" class="formresults">
										<? 
										switch ($adatafieldid[$i]) {
												case "notjoined":
														switch ($adataspecial[$i]) {
																case 2:
																		?>
									@ <?=$objarray[$adatafield[$i]];?>
																		<? 
																		break;
																case 4:
																		?>
									$ <?=$objarray[$adatafield[$i]];?>
																		<? 
																		break;
																case 5:
																		?>
									<?=$objarray[$adatafield[$i]];?> %
																		<? 
																		break;
																default:
																		?>
									<?=$objarray[$adatafield[$i]];?>
																		<? 
																		break;
															}
														break;
												case "justsort":
														switch ($ainputtype[$i]) {
																case "CHECKBOX":
																		if ($objarray[$adatafield[$i]]==0) {
																				$tmpcbfield = "No";
																			}
																			else {
																				$tmpcbfield = "Yes";
																			}
																			?>
									<a href="javascript:updatewhereform('<?=$adatafieldtable[$i];?>.<?=$adatafield[$i];?>=<?=$objarray[$adatafield[$i]];?>');">
										<font color="#000000">
											<?=$tmpcbfield;?>
											</font>
										</a>				
																			<?
																		break;
																default:
																				?>
									<a href="javascript:updatewhereform('<?=$adatafieldtable[$i];?>.<?=$adatafield[$i];?>=<?=$objarray[$adatafield[$i]];?>');">
										<font color="#000000">
											<?=$objarray[$adatafield[$i]];?>
											</font>
										</a>
														<?
																		break;
																}
														break;
												default:											
														$tmpsqlwhereaddon=$objarray[$adatafieldid[$i]];
														?>
									<a href="javascript:updatewhereform('<?=$adatafieldtable[$i];?>.<?=$adatafieldid[$i];?>=<?=$tmpsqlwhereaddon;?>');">
										<font color="#000000">
														<?
											$adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "");
														?>
											</font>
										</a>
														<? 
														break;
												}
											//} 
											?>
									</td>
											<?
									}
								?>
								<td align="right" valign="middle" class="formresults">
									<table>
										<tr>
								<?
									//test 1). Is this discrepancy a duplicate? to determine this we need to do a search in the duplcate table for this id and see if we get a record. 
									//Anything over 0 records means it is a duplicate and we need to display the duplicate summary report, making a little 'D' box
								
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = '".$objarray[$tblkeyfield]."' ";
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
														?>
											<form style="margin-bottom:0;" action="part139327_sub_d_d_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$tmpid;?>">
												<input type="hidden" name="discrepancyid" 		value="<?=$objarray[$tblkeyfield];?>">
												<input type="submit" value="D" name="b1" class="formsubmit" alt="Discrepancy is a Duplicate" onMouseover="ddrivetip('Discrepancy is a Duplicate')"; onMouseout="hideddrivetip()">
												</td>
											</form>
														<?	
														}
												}
										}
									//test 2). Is this discrepancy archived? to determine this we need to do a search in the duplcate table for this id and see if we get a record. 
									//Anything over 0 records means it is archived and we need to display the archived summary report, making a little 'A' box
								
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_inspection_id = '".$objarray[$tblkeyfield]."' ";
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
														$tmpid = $objarray2['discrepancy_archeived_id'];
														?>
											<form style="margin-bottom:0;" action="part139327_sub_d_a_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$tmpid;?>">
												<input type="hidden" name="discrepancyid" 		value="<?=$objarray[$tblkeyfield];?>">
												<input type="submit" value="A" name="b1" class="formsubmit" alt="Discrepancy is archived" onMouseover="ddrivetip('Discrepancy is Archived')"; onMouseout="hideddrivetip()">
												</td>
											</form>
														<?	
														}
												}
										}
									//test 3). Determine if the Discrepancy is currently outstanding or has been fixed. This involves checking both the repaired and bounced tables for information about the
									//current discrepancy ID. This will be done in three phases. 
									//Phase 1 will be to check the bounced table to see if there is any records about this discrepancy ID there. if so get the date of the latest record and put the ID of the record in a variable
									//phase two will be to check the repaired table and see if there is any information about this discrepancy there. if so get the date of the latest record and put the ID of the record in a variable
									//phase three will be to compare the two dates provided and see which event is most recent.
								
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = '".$objarray[$tblkeyfield]."' ORDER BY discrepancy_bounced_date, discrepancy_bounced_time";
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
													//echo "Bouced Rows ".$number_of_rows;
													while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
														$discrepancybouncedid 	= $objarray2['discrepancy_bounced_id'];
														$discrepancybounceddate = $objarray2['discrepancy_bounced_date'];
														$discrepancybouncedtime = $objarray2['discrepancy_bounced_time'];
														//echo $discrepancybouncedtime;
														?>
														<?	
														}
												}
										}
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_r WHERE discrepancy_repaired_inspection_id = '".$objarray[$tblkeyfield]."' ORDER BY discrepancy_repaired_date, discrepancy_repaired_time";
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
														$discrepancyrepairid = $objarray2['discrepancy_repaired_id'];
														$discrepancyrepairdate = $objarray2['discrepancy_repaired_date'];
														$discrepancyrepairtime = $objarray2['discrepancy_repaired_time'];
														//echo $discrepancyrepairtime;
														?>
														<?	
														}
												}
										}
									
									if ($discrepancyrepairid == "") {							// There is no repair history. Without being repaired you by definition cant bounce so we give the user the workorder button
											//echo "WorkOrder";
											?>
											<form style="margin-bottom:0;" action="part139327_sub_d_workorder.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$objarray[$tblkeyfield];?>">
												<input type="submit" value="Work Order" name="b1" class="formsubmit" onMouseover="ddrivetip('Discrepancy needs to be repaired click this button to generate a printer friendly workorder for distribution to maintenance crew')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											<?
										}
										else {													// There is a number in the repair ID
											if ($discrepancybouncedid == "") {					// There is not a number in the bounceid, do display the repaired icon
													//echo "There is no value in the bouncedID variable";
													?>
											<form style="margin-bottom:0;" action="part139327_sub_d_r_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$discrepancyrepairid;?>">
												<input type="submit" value="R" name="b1" class="formsubmit" alt="Discrepancy is Repaired" onMouseover="ddrivetip('Discrepancy is Repaired')"; onMouseout="hideddrivetip()">
												</td>
											</form>
													<?
												}
												else {											// There is a number in the bounced field
																								// Now we need to compare the date and time of the each record and get the most recent event
													if ($discrepancybounceddate > $discrepancyrepairdate) {								//Bounce is more recent then repair regardless of time, so display bounce icon
															//echo "Bounce Date is greater than Repair Date<br>";
															?>
											<form style="margin-bottom:0;" action="part139327_sub_d_b_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$discrepancybouncedid;?>">
												<input type="submit" value="B" name="b1" class="formsubmit" alt="Discrepancy is Bounced" onMouseover="ddrivetip('Discrepancy is Bounced')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											<form style="margin-bottom:0;" action="part139327_sub_d_workorder.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$objarray[$tblkeyfield];?>">
												<input type="submit" value="Work Order" name="b1" class="formsubmit" alt="Discrepancy needs to be repaired click this button to generate a printer friendly workorder for distribution to maintenance crew" onMouseover="ddrivetip('Discrepancy needs to be repaired click this button to generate a printer friendly workorder for distribution to maintenance crew')"; onMouseout="hideddrivetip()">
												</td>
											</form>
															<?
														}
														else {									// Bounce date is not greater then repaire date
															if ($discrepancybounceddate == $discrepancyrepairdate) {						// Is the bounce date the same as the repair date?
																	//echo "bounce date is equal to repair date<br>";			// next we need to see if bounce is more recent timewise then the repair time
																	//echo $discrepancybouncedtime." vs ".$discrepancyrepairtime."<br>";
																	if ($discrepancybouncedtime > $discrepancyrepairtime) {					// is the bounce time more recent then the repair time
																			echo "Bounce time greater than repair time";			// if so, display bounce icon
																			?>
											<form style="margin-bottom:0;" action="part139327_sub_d_b_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$discrepancybouncedid;?>">
												<input type="submit" value="B" name="b1" class="formsubmit" alt="Discrepancy is Bounced" onMouseover="ddrivetip('Discrepancy is Bounced')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											<form style="margin-bottom:0;" action="part139327_sub_d_workorder.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$objarray[$tblkeyfield];?>">
												<input type="submit" value="Work Order" name="b1" class="formsubmit" alt="Discrepancy needs to be repaired click this button to generate a printer friendly workorder for distribution to maintenance crew" onMouseover="ddrivetip('Discrepancy needs to be repaired click this button to generate a printer friendly workorder for distribution to maintenance crew')"; onMouseout="hideddrivetip()">
												</td>
											</form>
																			<?
																		}
																		else {					// Boune time is not greater then the repair time
																			if ($discrepancybouncedtime == $discrepancyrepairtime) {		// are they equal times?
																					//echo "How the heck did that happen";
																				}
																				else {			// repair time is more recent then the bounce time
																					//echo "Repair Icon";
																					?>
											<form style="margin-bottom:0;" action="part139327_sub_d_r_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$discrepancyrepairid;?>">
												<input type="submit" value="R" name="b1" class="formsubmit" alt="Discrepancy is Repaired" onMouseover="ddrivetip('Discrepancy is Repaired')"; onMouseout="hideddrivetip()">
												</td>
											</form>
																					<?
																				}
																		}
																}
														}
												}
										}
										?>
											</tr>
										</table>
									</td>
								</tr>
											<?
		$discrepancybouncedid 	= "";
		$discrepancybounceddate 	= "";
		$discrepancybouncedtime	 = "";
		$discrepancyrepairid 	= "";
		$discrepancyrepairdate 	= "";
		$discrepancyrepairtime 	= "";
		$isduplicate			= "";
		$isarchived			= "";
												}	// end of displaydatarow test
		$isduplicate			= "";
		$isarchived			= "";
		$displaydatarow			= "";
		$discrepancybouncedid 	= "";
		$discrepancybounceddate 	= "";
		$discrepancybouncedtime 	= "";
		$discrepancyrepairid 	= "";
		$discrepancyrepairdate 	= "";
		$discrepancyrepairtime 	= "";
											}	// end of looped data
									?>
							</table>
									<?
									}	// end of records found statement
								}	// end of sucessfull conection and execution of sql statement
							}	// end of connection established
							?>
						</td>
					</tr>					
				</table>	<!-- end of ajax load table-->
			</td>
		</tr>
	</table>
<?
//include("includes/footer.php");		// include file that gets information from form POSTs for navigational purposes
?>
