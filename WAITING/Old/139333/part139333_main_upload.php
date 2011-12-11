<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	FuelFlow Operation Entry.php			The purpose of this page is to enter new Fuel Flow Operations
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		include("includes/header.php");															// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		
	// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);

	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "leases_id";												// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "lease_beganon";															// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_leases_main";										// What table  is that field part of ?
		$tbltextsortfield		= "lease_treason";												// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_leases_main";										// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "lease_archived_yn";										// What is the name of the field used to mark the record archived ?
		$tblname				= "Lease Summary Report";									// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname			= "Here is the information you selected";						// What is the subname of the table ? (used on edit/summary/printer report pages)

	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 			= "edit_record_general.php";
		// $functionsummarypage 		= "summary_report_general.php";
		// $functionprinterpage 		= "printer_report_general.php";
		$functioneditpage 		= "edit_record_general.php";											// Name of page used to edit the record
		$functionsummarypage 		= "leases_main_entry_adddoc.php";										// Name of page used to display a summary of the record
		$functionprinterpage 		= "printer_report_general.php";											// Name of page used to display a printer friendly report

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "lease_beganon";
		$adatafield[1]			= "leases_lessee_cb_int";
		$adatafield[2]			= "leases_lease_type_cb_int";
		$adatafield[3]			= "leases_type_id";
		$adatafield[4]			= "lease_terms_cb_int";
		$adatafield[5]			= "lease_expectedend";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= "tbl_leases_main";
		$adatafieldtable[1]		= "tbl_leases_main";
		$adatafieldtable[2]		= "tbl_leases_main";
		$adatafieldtable[3]		= "tbl_leases_main";
		$adatafieldtable[4]		= "tbl_leases_main";	
		$adatafieldtable[5]		= "tbl_leases_main";	
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "justsort";
		$adatafieldid[1]		= "leases_lessee_cb_int";
		$adatafieldid[2]		= "leases_lease_type_cb_int";
		$adatafieldid[3]		= "justsort";
		$adatafieldid[4]		= "lease_terms_cb_int";
		$adatafieldid[5]		= "justsort";
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		= 0;
		$adataspecial[1]		= 0;
		$adataspecial[2]		= 0;
		$adataspecial[3]		= 0;
		$adataspecial[4]		= 0;
		$adataspecial[5]		= 0;
	// should this column be added to create a totals column at the end of the recods
		$adataputarray[0]		= 0;
		$adataputarray[1]		= 0;
		$adataputarray[2]		= 0;
		$adataputarray[3]		= 0;
		$adataputarray[4]		= 0;
		$adataputarray[5]		= 0;
	// what do you want to name the columns
		$aheadername[0]			= "Date";
		$aheadername[1]			= "Lessee";
		$aheadername[2]			= "Type of Lease";
		$aheadername[3]			= "Item Leased";
		$aheadername[4]			= "Terms";
		$aheadername[5]			= "Date (expected end)";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "Please enter the date the lease is set to begin";
		$ainputcomment[1]		= "Please select from the list to the right, who is leasing the object";
		$ainputcomment[2]		= "Please select from the list to the right, the type of lease this is for";
		$ainputcomment[3]		= "Please select from the list to the right, the particualr leased object";
		$ainputcomment[4]		= "Please select from the list to the right, the terms of the lease";
		$ainputcomment[5]		= "Please enter the date the lease is expected to end.";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "TEXT";
		$ainputtype[1]			= "SELECT";
		$ainputtype[2]			= "SELECT";
		$ainputtype[3]			= "SELECT";
		$ainputtype[4]			= "SELECT";
		$ainputtype[5]			= "TEXT";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "organizationcombobox";
		$adataselect[2]			= "leasetypescombobox";
		$adataselect[3]			= "leasetypescomboboxnoajax";
		$adataselect[4]			= "leasetermscombobox";
		$adataselect[5]			= "";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";
		
	// For debugging purposes print out the SQL Statement
		//echo $sql;																				// When dedugging you can uncomment this echo and see the sql statement

	// Start the Real Fun	

		$i 						= 0;															// just in case we want the i variable to be defined before we use it
		$uisize 				= "60";															//just in case we dont define it latter, set a default here.

//-------------------- [ THERE SHOULD BE NO NEED TO CHANGE ANY OF THE CODE BELOW THIS LINE ] ----------------------------------------------------------------------------------------------------------------------

	// store this array into a serialized array
		$stradatafield 			= urlencode(serialize($adatafield));			// dont touch
		$stradatafieldtable 		= urlencode(serialize($adatafieldtable));		// dont touch
		$stradatafieldid 		= urlencode(serialize($adatafieldid));			// dont touch	
		$stradataspecial			= urlencode(serialize($adataspecial));			// dont touch
		$straheadername			= urlencode(serialize($aheadername));			// dont touch
		$strainputtype			= urlencode(serialize($ainputtype));			// dont touch
		$strainputcomment		= urlencode(serialize($ainputcomment));			// dont touch
		$stradataselect			= urlencode(serialize($adataselect));			// dont touch
		
	// store this array into a serialized array
		$sadatafield 			= (serialize($adatafield));						// dont touch
		$sadatafieldtable 		= (serialize($adatafieldtable));				// dont touch
		$sadatafieldid 			= (serialize($adatafieldid));					// dont touch	
		$sadataspecial			= (serialize($adataspecial));					// dont touch
		$saheadername			= (serialize($aheadername));					// dont touch
		$sainputtype			= (serialize($ainputtype));						// dont touch
		$sainputcomment			= (serialize($ainputcomment));					// dont touch
		$sadataselect			= (serialize($adataselect));					// dont touch
		
		$sadatafield  			= str_replace("\"","|",$sadatafield);
		$sadatafieldtable 		= str_replace("\"","|",$sadatafieldtable);
		$sadatafieldid 			= str_replace("\"","|",$sadatafieldid);
		$sadataspecial 			= str_replace("\"","|",$sadataspecial);
		$saheadername 			= str_replace("\"","|",$saheadername);
		$sainputtype 			= str_replace("\"","|",$sainputtype);
		$sainputcomment			= str_replace("\"","|",$sainputcomment);
		$sadataselect 			= str_replace("\"","|",$sadataselect);

if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		?>
						
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
															<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									Upload Support Documents
									</td>
								<td class="tableheaderright">
									(Please use this form to add any additional support documentation to the system)
									</td>
								</tr>
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
											<form enctype="multipart/form-data" action="part139303_main_upload_entry.php" method="POST" name="uploaddocument">
											<td align="center" valign="middle" class="formoptions">
												Upload Sylabus Document
												</td>
											<td class="formanswers">
											<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
												<input class="Commonfieldbox" name="uploadedfile_SYLABUS" type="file" size="60"><br />
												<input type="hidden" name="editpage" 			value="<?=$functioneditpage;?>">
												<input type="hidden" name="summarypage" 		value="<?=$functionsummarypage;?>">
												<input type="hidden" name="printerpage" 		value="<?=$functionprinterpage;?>">
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
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions">
												Upload Class Attendance Document
												</td>
											<td class="formanswers">
													<input class="Commonfieldbox" name="uploadedfile_ATTENDANCE" type="file" size="60"><br />
													</form>
													</td>
											</tr>
										<tr>
											<td colspan="2" class="formoptionsavilablebottom">
												<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.uploaddocument.submit()">
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>				
							<?
		}
		?>
<?
//include("includes/footer.php");		// include file that gets information from form POSTs for navigational purposes
?>