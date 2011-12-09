<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	.Duty Data Browse.php				The purpose of this page is to list of the Duty Logs for printing and editing
	
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
		$tbldatesort 			= 1;															// Display Date Sorting Options Toggle Switch
		$tbltextsort 			= 1;															// Display Text Sorting Options Toggle Switch
		$tblheadersort			= 1;															// Display Heading Sort Options Toggle Switch
		
	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "duty_log_id";												// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "duty_log_date";												// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_duty_log";												// What table  is that field part of ?
		$tbltextsortfield		= "duty_log_comments";											// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_duty_log";												// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "duty_log_archived_yn";										// What is the name of the field used to mark the record archived ?
		$tblname				= "Duty Log Summary Report";									// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "here is the information you selected";						// What is the subname of the table ? (used on edit/summary/printer report pages)
	
	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 			= "edit_record_general.php";
		// $functionsummarypage 		= "summary_report_general.php";
		// $functionprinterpage 		= "printer_report_general.php";
		$functioneditpage 		= "edit_record_general.php";									// Name of page used to edit the record
		$functionsummarypage 	= "summary_report_general.php";									// Name of page used to display a summary of the record
		$functionprinterpage 	= "printer_report_general.php";									// Name of page used to display a printer friendly report

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "duty_log_date";
		$adatafield[1]			= "duty_log_time";
		$adatafield[2]			= "duty_log_by_cb_int";
		$adatafield[3]			= "duty_log_comments";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_duty_log";
		$adatafieldtable[1]		= "tbl_duty_log";
		$adatafieldtable[2]		= "tbl_duty_log";
		$adatafieldtable[3]		= "tbl_duty_log";		
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "notjoined";
		$adatafieldid[1]		= "notjoined";
		$adatafieldid[2]		= "duty_log_by_cb_int";
		$adatafieldid[3]		= "notjoined";
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		= 0;
		$adataspecial[1]		= 0;
		$adataspecial[2]		= 0;
		$adataspecial[3]		= 0;	
	// what do you want to name the columns
		$aheadername[0]			= "Date";
		$aheadername[1]			= "Time";
		$aheadername[2]			= "Entry by";
		$aheadername[3]			= "Comments";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "( mm/dd/yyyy )";
		$ainputcomment[1]		= "( 24 hour )";
		$ainputcomment[2]		= "(select from the list)";
		$ainputcomment[3]		= "(no special charactors)";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "TEXT";
		$ainputtype[1]			= "TEXT";
		$ainputtype[2]			= "SELECT";
		$ainputtype[3]			= "TEXTAREA";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "";
		$adataselect[2]			= "systemusercombobox";
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
		$stradatafieldtable 		= urlencode(serialize($adatafieldtable));		// dont touch
		$stradatafieldid 		= urlencode(serialize($adatafieldid));			// dont touch	
		$stradataspecial			= urlencode(serialize($adataspecial));			// dont touch
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
					<td class="formoptions" align="center">
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
					<td class="formoptions" align="center">
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
								</tr>
										<?
										while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										//$tmpfieldname	= $layer3array['menu_item_name_long'];
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
												<input type="hidden" name="recordid" 			value="<?=$objarray[$tblkeyfield];?>">
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
												<input type="submit" value="E" name="b1" class="formsubmit">
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
												<input type="submit" value="S" name="b1" class="formsubmit">
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
												<input type="submit" value="R" name="b1" class="formsubmit">
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
								</tr>
											<?									
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
