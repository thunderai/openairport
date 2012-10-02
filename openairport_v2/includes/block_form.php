<?
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o	o		ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		o	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		oo	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o o	o		ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  oo		o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	o		o	o	  o		o	o	o		o	o	o	o     o
//	00000	0		ooooo	o	o		o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	Blocks Table Setup.php
//
//	Purpose of Page		:	The Standard Programming Block takes parts of the main code and
//							seperates them across a few different include files for the purpose
//							of cleaning up each main code page and using reunable code.
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
		
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
		//echo "<br>SQL Statement (initial) ".$sql." <br>";																			// When dedugging you can uncomment this ////echo and see the sql statement

	// Start the Real Fun	

		$i 								= 0;	
		$tblheadersortfirstselected		= "yes";
		$togfrmjoined 					= "";																		//just in case we dont define it latter, set a default here.
		$isarchived						= "";
		$displaydatarow					= "";
		
//	Take information from POST and setup some variables which will be used to control information flow

		$uifrmstartdate 		= $frmstartdate;
		$sqlfrmstartdate 		= amerdate2sqldatetime($uifrmstartdate);		
		$uifrmenddate 			= $frmenddate;
		$sqlfrmenddate 			= amerdate2sqldatetime($uifrmenddate);

// Build the breadcrum navigation method
		buildbreadcrumtrail($strmenuitemid,$uifrmstartdate,$uifrmenddate);
		
// Decode information which was passed to this page by the POST or GET comment that was serialized		
		
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
		
//echo "<br>FRMJOINED<br>";	
if (!isset($_POST["frmjoined"])) {
		//echo "<br>--> The form has not been submited yet, setup initial values <br>";
		$intfrmjoined	 	= 0;
		$intsqlwhereaddon 	= 0;
		$strsqlwhereaddon 	= "";				
		$togfrmjoined 		= 1;
		
		//echo "<br>--> Check to see if there is a value is in intfrmjoined<br>";
		
		if (!isset($_POST["intfrmjoined"])) {
				//echo "<br>-- -->There is no value in intfrmjoined<br>";
				$frmjoined 		= 0; //set value to zero (this causes the checkbox to not be checked)
				$intfrmjoined 	= 0; //set value to zero (this causes the checkbox to not be checked)
				}
			else {
				//echo "<br>-- --> FORM JOINED (initial) value is ".$intfrmjoined." <br>";
				if ($intfrmjoined==0) {
						//echo "<br>-- -- --> The Checkbox has NO value <br>";
						$frmjoined		= "0";
						$intfrmjoined	= 0;
					}
					else {
						//echo "<br>-- -- --> The Checkbox is NOT ZERO, make 1<br>";
						$frmjoined		= 1;
						$intfrmjoined	= 1;
					}				
			}
	}
	else {
		//echo "<br>--> The Form has been submited at least once before, use settings given by the user<br>";
		$frmjoined		= $_POST["frmjoined"];
		$intfrmjoined	= 1;
	}	

//echo "<br>STRSQLWHEREADDON<br>";
if (!isset($_POST["strsqlwhereaddon"])) {
		//echo "<br>--> The form has not been submited, setup initial values<br>";
		$strsqlwhereaddon	= "";
		$intsqlwhereaddon 	= 0;
	}
	else {
		//echo "<br>--> The form has been submited, use settings given by the user<br>";
		if ($togfrmjoined==1) {
				//echo "<br>-- --> Checkbox is not active, slear changes to SQL Statement<br>";
				$strsqlwhereaddon	= "";
				$intsqlwhereaddon 	= 1;
			}
			else {
				//echo "<br>-- --> Checkbox is active, use settings gine by user<br>";	
				$strsqlwhereaddon	= $_POST["strsqlwhereaddon"];
				$strsqlwhereaddon 	= str_replace("%3d","=",$strsqlwhereaddon );
				//$tblsqlwhereaddon 		= 1;
				//echo "<br>-- --[ New SQL String Addition ".$strsqlwhereaddon." ]-- <br>";
			}
	} 

//echo "<br>INTSQLWHEREADDON<br>";
if (!isset($_POST["intsqlwhereaddon"])) {
		//echo "<br>--> The form has not been submited<br>";
		if ($tbldatesort==1) {
				$intsqlwhereaddon = 1;
			}
		//tblsqlwhereaddon = 1
	}
	else {
		//echo "<br>--> Form has been submited, use settings given by user<br>";
		$intsqlwhereaddon=$_POST["intsqlwhereaddon"];
		//echo "<br> NEW SQL STATEMENT ".$intsqlwhereaddon."<br>";
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
	
	////echo $sql;
	
if (!isset($_POST["frmarchives"])) {
		$tblarchivedsort	= $tblarchivedsort;
	}
	else {
		// the field does exist, what is its current value
		$tblarchivedsort	= $_POST["frmarchives"];
	}

if (!isset($_POST["frmclosed"])) {
		$tblclosedsort		= $tblclosedsort;
	}
	else {
		// the field does exist, what is its current value
		$tblclosedsort		= $_POST["frmclosed"];
	}	
	////echo "frmstartdate >".$uifrstartdate."< <br>";

if (!isset($_POST["frmoptions_calendar"])) {
		$tblfrmoptions_calendar	= $tblfrmoptions_calendar;
	}
	else {
		// the field does exist, what is its current value
		$tblfrmoptions_calendar	= $_POST["frmoptions_calendar"];
	}	
if (!isset($_POST["frmoptions_printout"])) {
		$tblfrmoptions_printout	= $tblfrmoptions_printout;
	}
	else {
		// the field does exist, what is its current value
		$tblfrmoptions_printout	= $_POST["frmoptions_printout"];
	}	
if (!isset($_POST["frmoptions_distribution"])) {
		$tblfrmoptions_distribution	= $tblfrmoptions_distribution;
	}
	else {
		// the field does exist, what is its current value
		$tblfrmoptions_distribution	= $_POST["frmoptions_distribution"];
	}		
if (!isset($_POST["frmoptions_linechart"])) {
		$tblfrmoptions_linechart	= $tblfrmoptions_linechart;
	}
	else {
		// the field does exist, what is its current value
		$tblfrmoptions_linechart	= $_POST["frmoptions_linechart"];
	}	
	
	

if ($tbldisplaytotal==1) {
		// Page will display totals, declare arrayvalues. The maximum number of rows to total is set at 12.
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
	}
	
	?>
	<form action="<?=$_SERVER["PHP_SELF"];?>"  		  name="sorttable" 			id="sorttable" 						method="POST">
	<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
		<input class="commonfieldbox"	type="hidden" name="menuitemid" 		id="menuitemid"			size="10"	value="<?=$_POST['menuitemid'];?>">
		<input class="commonfieldbox" 	type="hidden" name="frmurl" 			id="frmurl"				size="1"	value="<?=$frmurl;?>">
		<input class="combobox" 		type="hidden" name="intfrmjoined" 		id="intfrmjoined"		size="4"	value="<?=$intfrmjoined;?>">
		<input class="combobox" 		type="hidden" name="strsqlwhereaddon" 	id="strsqlwhereaddon"	size="40"	value="<?=$strsqlwhereaddon;?>">
		<input class="combobox"			type="hidden" name="intsqlwhereaddon" 	id="intsqlwhereaddon"	size="10"	value="<?=$intsqlwhereaddon;?>">
		
	<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
		<tr>
			<td width="10" class="tableheaderleft">&nbsp;</td>
			<td class="tableheadercenter">
				<?
				////echo "frmstartdate >".$uifrmstartdate."< <br>";
				getnameofmenuitemid($strmenuitemid, "long", 4, "#ffffff",$_SESSION['user_id']);
				?>
				</td>
			<td class="tableheaderright">
				(
				<?
				////echo "frmstartdate >".$uifrmstartdate."< <br>";
				getpurposeofmenuitemid($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
				?>
				)
				</td>
			</tr>
		<tr>
			<td colspan="3" class="tablesubcontent" width="100%">
				<table border="0" width="100%" cellspacing="5" cellpadding="5" id="table2" height="38">
					<tr>
						<td class="formoptions"	align="center" valign="middle"	width="28%">
							<?
							if ($tbldatesort==1) {
											// Page is programmed to allow the sorting of records by date.  Display Date Entry Form Fields.
											?>
									<table border="0" width="100%" cellspacing="5" cellpadding="5" id="table3" height="38">
										<tr>	
											<td class="formoptions"	align="center"	valign="middle"	width="14%">
												<?=$en_start_date;?><br>
												<input class="commonfieldbox" type="text" name="frmstartdate" id="frmstartdate"	size="8" value="<?=$uifrmstartdate;?>" onchange="javascript:(isdate(this.form.frmstartdate.value,'mm/dd/yyyy'))">
												</td>
											<td class="formoptions"	align="center"	valign="middle"	width="14%">
												<?=$en_end_date;?><br>
												<input class="commonfieldbox" type="text" name="frmenddate" size="8" value="<?=$uifrmenddate;?>" onchange="javascript:(isdate(this.form.frmenddate.value,'mm/dd/yyyy'))">
												</td>
											</tr>
										</table>
									</td>
										<?
									}
									else {
										?>
										<?=$en_turned_off;?>
										<?
									}
									?>
									</td>
								<td class="formoptions" align="center" valign="middle" width="14%">
									<?=$en_joined;?><br>
									<input class="commonfieldbox" type="checkbox" name="frmjoined" id="frmjoined" size="25" value="1"
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
						<td class="formoptions" align="center" valign="middle" width="14%">
							<?
							if ($tbltextsort==1) {
									?>
							<?=$en_textlike;?><br>
							<input class="commonfieldbox" type="text" name="frmtextlike" size="25" value="<?=$frmtextlike;?>">
									<?
								}
								else {
									?>
							<?=$en_turned_off;?>
									<?
								}
							?>
							</td>			
						<td class="formoptions" align="center" valign="middle" width="14%">
							<?=$en_archived;?><br>
							<input class="commonfieldbox" type="checkbox" name="frmarchives" id="frmarchives" size="25" value="1"
							<?
							if ($tblarchivedsort==1) {
									
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
						<td class="formoptions" align="center" valign="middle" width="14%">
							<?=$en_closed;?><br>
							<input class="commonfieldbox" type="checkbox" name="frmclosed" id="frmclosed" size="25" value="1"
							<?
							if ($tblclosedsort==1) {
									
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
						<td class="formoptions" align="center" valign="middle" width="14%">
							<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.sorttable.submit()">
							</td>
						</tr>
					<tr>
						<td class="formoptionsavilabletop">
							<?
							if ($tmpfrmstartdateerror == 1) {
								////echo $tmpdateeventerrormessage;
								}
							?>
							</td>
						<td class="formoptionsavilabletop">
							<?
							if ($tmpfrmenddateerror == 1) {
								////echo $tmpdateeventerrormessage;
								}
							?>
							</td>
						<td class="formoptionsavilabletop">
							
							</td>
						<td class="formoptionsavilabletop">
							
							</td>
						</tr>
					</table>
				<table border="0" width="100%" cellspacing="2" cellpadding="2">
					<tr>
						<td class="formresultscount">		
							<?
							$objconn = mysqli_connect($hostdomain, $hostusername, $passwordofdatabase, $nameofdatabase);
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
							there was <?=$number_of_rows;?> records found, may include hidden records.
							</td>
						</tr>
															<?
															if ($number_of_rows==0) {
																	////echo "no records found";
																}
																else {
																	?>
					<tr>
						<td>
							<table cellspacing="0" width="100%">
								<tr>
									<td class="formoptionsavilabletop">
										<?=$en_optionsforu;?>
										</td>
									</tr>
								<tr>
									<td class="formoptionsavilablebottom">
										<table>
											<tr>
												<?
												// Create an SQL Statement that can be used to pass along to the form Sub Functions.
												$encoded = urlencode($sql);		
												////echo "The encoded SQL Statement is ".$encoded."<br><br><br>";												
												// Currently this process does not work because Internet Explorer limits the total number of characters that can be passed in the GET Statement of the URL.
												// Should that limit be removed or changed we might be able to pass the SQL Statement in the URL as desired.
												?>
												<?
												if ($tblfrmoptions_calendar==1) {
														// Page has allowed the Calendar Printout Function.
														?>											
												<td class="formoptionsubmit" onclick="window.open('<?=$function_calendar;?>?frmurl=<?=$encoded;?>&frmstartdate=<?=$uifrmstartdate ;?>&frmenddate=<?=$uifrmenddate ;?>','printerfriendlyreport','width=750,height=550');">
													&nbsp;&nbsp;<?=$en_calendarprint;?>&nbsp;&nbsp;
													</td>
														<?
													}
												if ($tblfrmoptions_printout==1) {	
														// Page has allowed the Printer Friendly PrintOut Function.
														?>
												<td class="formoptionsubmit" onclick="window.open('<?=$function_printout;?>?frmurl=<?=$encoded;?>&menuitemid=<?=$strmenuitemid?>&aheadername=<?=$straheadername;?>&adatafield=<?=$stradatafield;?>&tblkeyfield=<?=$tblkeyfield;?>&tbldatesortfield=<?=$tbldatesortfield;?>&tbldatesorttable=<?=$tbldatesorttable;?>&tbltextsortfield=<?=$tbltextsortfield;?>&tbltextsorttable=<?=$tbltextsorttable;?>&adatafieldtable=<?=$stradatafieldtable;?>&adatafieldid=<?=$stradatafieldid;?>&adataspecial=<?=$stradataspecial;?>&adataselect=<?=$stradataselect?>&tblarchivedfield=<?=$tblarchivedfield?>','printerfriendlyreport','width=750,height=550');">
													&nbsp;&nbsp;<?=$en_printerprint;?>&nbsp;&nbsp;
													</td>
														<?
													}
												if ($tblfrmoptions_distribution==1) {
														// Page has allowed the Distribution Chart Function.
														?>														
												<td class="formoptionsubmit" onclick="window.open('<?=$function_distribution;?>?startdate=<?=$uifrmstartdate;?>&enddate=<?=$uifrmenddate;?>','Distributionsetupreport','width=550,height=300');">
													&nbsp;&nbsp;<?=$en_distribution;?>&nbsp;&nbsp;
													</td>
														<?
													}
												if ($tblfrmoptions_linechart==1) {
														// Page has allowed the Distribution Chart Function.
														?>														
												<td class="formoptionsubmit" onclick="window.open('<?=$function_linechart;?>?startdate=<?=$uifrmstartdate;?>&enddate=<?=$uifrmenddate;?>','linechartsetupreport','width=550,height=300');">
													&nbsp;&nbsp;<?=$en_linechart;?>&nbsp;&nbsp;
													</td>
														<?
													}
													?>
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
									</tr>
								</form>
										<?
										while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										
												if ($runpreflights == 1) {
											
														//reset value
														$displayrow		= 1;
														$dontdisplay	= 0;
														
														// --------------------NOT EVERY TABLE OR PAGE NEEDS A PREFLIGHT, IN THIS CASE IT DOES------		
														// Do PreFlight on Table to check if this record is archived and if so skip it.
																////echo "My Default setting is to ".$displayrow." display rows<br><br>";
																
																if ($tblarchivedsort == 0) {
																		////echo "Is user sorting archived rows :".$tblarchivedsort." ";
																		$displayrow			= 	$function_archivedsort($objarray[$tblkeyfield],$tblarchivedsort);	// returns 1 if row is archived
																		////echo "Should this row be displayed? :".$displayrow."<br><br>";
																		if ($displayrow == 0) {
																				$dontdisplay_archived = 1;
																			}
																			else {
																				$dontdisplay_archived = 0;
																			}
																			
																	}
																
																if ($tblclosedsort == 0) {														
																		////echo "Is user sorting closed rows :".$tblclosedsort." ";
																		$displayrow 		= 	$function_closedsort($objarray[$tblkeyfield],$tblclosedsort);		// returns 1 if row is closed
																		////echo "Should this row be displayed? :".$displayclosed."<br><br>";
																		if ($displayrow == 0) {
																				$dontdisplay_closed = 1;
																			}
																			else {
																				$dontdisplay_closed = 0;
																			}
																	}
																
																if ($dontdisplay_archived == 1) {
																		// Do not display row
																		$displayrow = 0;
																	}
																	else {
																		if ($dontdisplay_closed == 1) {
																				$displayrow = 0;
																			}
																	}
																
																
														// --------------------NOT EVERY TABLE OR PAGE NEEDS A PREFLIGHT, IN THIS CASE IT DOES------
													}										
										
												if ($displayrow == 1) {															
														?>
							<tr>
								<td class="formresults" align="center" valign="middle" height="32">
									<?=$objarray[$tblkeyfield];?>
									</td>
								<td align="center" class="formresults">
									<table border="1" width="50" cellspacing="0" id="table1" class="formsubmit cellpadding="0">
										<tr>
											<form style="margin-bottom:0;" action="<?=$functioneditpage;?>" method="POST" name="editform" id="editform">
											<td class="formoptionsubmit">
												<input class="formsubmit"	type="hidden" name="editpage" 			id="editpage"			value="<?=$functioneditpage;?>">
												<input class="formsubmit"	type="hidden" name="summarypage" 		id="summarypage"		value="<?=$functionsummarypage;?>">
												<input class="formsubmit"	type="hidden" name="printerpage" 		id="printerpage"		value="<?=$functionprinterpage;?>">
												<input class="formsubmit"	type="hidden" name="inspectionid"		id="inspectionid" 		value="<?=$objarray[$tblkeyfield];?>">
												<input class="formsubmit"	type="hidden" name="recordid" 			id="recordid"			value="<?=$objarray[$tblkeyfield];?>">
												<input class="formsubmit"	type="hidden" name="menuitemid" 		id="menuitemid"			value="<?=$strmenuitemid?>">
												<input class="formsubmit"	type="hidden" name="aheadername"		id="aheadername" 		value="<?=$saheadername;?>">
												<input class="formsubmit"	type="hidden" name="adatafield" 		id="adatafield"			value="<?=$sadatafield;?>">
												<input class="formsubmit"	type="hidden" name="adatafieldtable" 	id="adatafieldtable"	value="<?=$sadatafieldtable;?>">
												<input class="formsubmit"	type="hidden" name="adatafieldid" 		id="adatafieldid"		value="<?=$sadatafieldid;?>">
												<input class="formsubmit"	type="hidden" name="adataspecial" 		id="adataspecial"		value="<?=$sadataspecial;?>">
												<input class="formsubmit"	type="hidden" name="ainputtype" 		id="ainputtype"			value="<?=$sainputtype;?>">
												<input class="formsubmit"	type="hidden" name="adataselect" 		id="adataselect"		value="<?=$sadataselect;?>">
												<input class="formsubmit"	type="hidden" name="ainputcomment" 		id="ainputcomment"		value="<?=$sainputcomment;?>">
												<input class="formsubmit"	type="hidden" name="tblname" 			id="tblname"			value="<?=$tblname;?>">
												<input class="formsubmit"	type="hidden" name="tblsubname" 		id="tblsubname"			value="<?=$tblsubname?>">
												<input class="formsubmit"	type="hidden" name="tblkeyfield" 		id="tblkeyfield"		value="<?=$tblkeyfield;?>">
												<input class="formsubmit"	type="hidden" name="tblarchivedfield"	id="tblarchivedfield"	value="<?=$tblarchivedfield;?>">
												<input class="formsubmit"	type="hidden" name="tbldatesortfield" 	id="tbldatesortfield"	value="<?=$tbldatesortfield;?>">
												<input class="formsubmit"	type="hidden" name="tbldatesorttable" 	id="tbldatesorttable"	value="<?=$tbldatesorttable;?>">
												<input class="formsubmit"	type="hidden" name="tbltextsortfield" 	id="tbltextsortfield"	value="<?=$tbltextsortfield;?>">
												<input class="formsubmit"	type="hidden" name="tbltextsorttable" 	id="tbltextsorttable"	value="<?=$tbltextsorttable;?>">
												<input class="formsubmit"	type="hidden" name="frmstartdate" 		id="frmstartdate"		value="<?=$uifrmstartdate;?>">
												<input class="formsubmit"	type="hidden" name="frmenddate" 		id="frmenddate"			value="<?=$uifrmenddate?>">
												<input class="formsubmit"	type="submit" name="b1" 				id="b1" 				value="E">
												</td>
											</form>
											<form style="margin-bottom:0;" action="<?=$functionsummarypage;?>" method="POST" name="summaryform" id="summaryform">
											<td class="formoptionsubmit">
												<input class="formsubmit"	type="hidden" name="editpage" 			id="editpage"			value="<?=$functioneditpage;?>">
												<input class="formsubmit"	type="hidden" name="summarypage" 		id="summarypage"		value="<?=$functionsummarypage;?>">
												<input class="formsubmit"	type="hidden" name="printerpage" 		id="printerpage"		value="<?=$functionprinterpage;?>">
												<input class="formsubmit"	type="hidden" name="inspectionid"		id="inspectionid" 		value="<?=$objarray[$tblkeyfield];?>">
												<input class="formsubmit"	type="hidden" name="recordid" 			id="recordid"			value="<?=$objarray[$tblkeyfield];?>">
												<input class="formsubmit"	type="hidden" name="menuitemid" 		id="menuitemid"			value="<?=$strmenuitemid?>">
												<input class="formsubmit"	type="hidden" name="aheadername"		id="aheadername" 		value="<?=$saheadername;?>">
												<input class="formsubmit"	type="hidden" name="adatafield" 		id="adatafield"			value="<?=$sadatafield;?>">
												<input class="formsubmit"	type="hidden" name="adatafieldtable" 	id="adatafieldtable"	value="<?=$sadatafieldtable;?>">
												<input class="formsubmit"	type="hidden" name="adatafieldid" 		id="adatafieldid"		value="<?=$sadatafieldid;?>">
												<input class="formsubmit"	type="hidden" name="adataspecial" 		id="adataspecial"		value="<?=$sadataspecial;?>">
												<input class="formsubmit"	type="hidden" name="ainputtype" 		id="ainputtype"			value="<?=$sainputtype;?>">
												<input class="formsubmit"	type="hidden" name="adataselect" 		id="adataselect"		value="<?=$sadataselect;?>">
												<input class="formsubmit"	type="hidden" name="ainputcomment" 		id="ainputcomment"		value="<?=$sainputcomment;?>">
												<input class="formsubmit"	type="hidden" name="tblname" 			id="tblname"			value="<?=$tblname;?>">
												<input class="formsubmit"	type="hidden" name="tblsubname" 		id="tblsubname"			value="<?=$tblsubname?>">
												<input class="formsubmit"	type="hidden" name="tblkeyfield" 		id="tblkeyfield"		value="<?=$tblkeyfield;?>">
												<input class="formsubmit"	type="hidden" name="tblarchivedfield"	id="tblarchivedfield"	value="<?=$tblarchivedfield;?>">
												<input class="formsubmit"	type="hidden" name="tbldatesortfield" 	id="tbldatesortfield"	value="<?=$tbldatesortfield;?>">
												<input class="formsubmit"	type="hidden" name="tbldatesorttable" 	id="tbldatesorttable"	value="<?=$tbldatesorttable;?>">
												<input class="formsubmit"	type="hidden" name="tbltextsortfield" 	id="tbltextsortfield"	value="<?=$tbltextsortfield;?>">
												<input class="formsubmit"	type="hidden" name="tbltextsorttable" 	id="tbltextsorttable"	value="<?=$tbltextsorttable;?>">
												<input class="formsubmit"	type="hidden" name="frmstartdate" 		id="frmstartdate"		value="<?=$uifrmstartdate;?>">
												<input class="formsubmit"	type="hidden" name="frmenddate" 		id="frmenddate"			value="<?=$uifrmenddate?>">
												<input class="formsubmit"	type="submit" name="b1" 				id="b1" 				value="S">
												</td>
											</form>
											<form style="margin-bottom:0;" action="<?=$functionprinterpage;?>" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=768,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input class="formsubmit"	type="hidden" name="editpage" 			id="editpage"			value="<?=$functioneditpage;?>">
												<input class="formsubmit"	type="hidden" name="summarypage" 		id="summarypage"		value="<?=$functionsummarypage;?>">
												<input class="formsubmit"	type="hidden" name="printerpage" 		id="printerpage"		value="<?=$functionprinterpage;?>">
												<input class="formsubmit"	type="hidden" name="inspectionid"		id="inspectionid" 		value="<?=$objarray[$tblkeyfield];?>">
												<input class="formsubmit"	type="hidden" name="recordid" 			id="recordid"			value="<?=$objarray[$tblkeyfield];?>">
												<input class="formsubmit"	type="hidden" name="menuitemid" 		id="menuitemid"			value="<?=$strmenuitemid?>">
												<input class="formsubmit"	type="hidden" name="aheadername"		id="aheadername" 		value="<?=$saheadername;?>">
												<input class="formsubmit"	type="hidden" name="adatafield" 		id="adatafield"			value="<?=$sadatafield;?>">
												<input class="formsubmit"	type="hidden" name="adatafieldtable" 	id="adatafieldtable"	value="<?=$sadatafieldtable;?>">
												<input class="formsubmit"	type="hidden" name="adatafieldid" 		id="adatafieldid"		value="<?=$sadatafieldid;?>">
												<input class="formsubmit"	type="hidden" name="adataspecial" 		id="adataspecial"		value="<?=$sadataspecial;?>">
												<input class="formsubmit"	type="hidden" name="ainputtype" 		id="ainputtype"			value="<?=$sainputtype;?>">
												<input class="formsubmit"	type="hidden" name="adataselect" 		id="adataselect"		value="<?=$sadataselect;?>">
												<input class="formsubmit"	type="hidden" name="ainputcomment" 		id="ainputcomment"		value="<?=$sainputcomment;?>">
												<input class="formsubmit"	type="hidden" name="tblname" 			id="tblname"			value="<?=$tblname;?>">
												<input class="formsubmit"	type="hidden" name="tblsubname" 		id="tblsubname"			value="<?=$tblsubname?>">
												<input class="formsubmit"	type="hidden" name="tblkeyfield" 		id="tblkeyfield"		value="<?=$tblkeyfield;?>">
												<input class="formsubmit"	type="hidden" name="tblarchivedfield"	id="tblarchivedfield"	value="<?=$tblarchivedfield;?>">
												<input class="formsubmit"	type="hidden" name="tbldatesortfield" 	id="tbldatesortfield"	value="<?=$tbldatesortfield;?>">
												<input class="formsubmit"	type="hidden" name="tbldatesorttable" 	id="tbldatesorttable"	value="<?=$tbldatesorttable;?>">
												<input class="formsubmit"	type="hidden" name="tbltextsortfield" 	id="tbltextsortfield"	value="<?=$tbltextsortfield;?>">
												<input class="formsubmit"	type="hidden" name="tbltextsorttable" 	id="tbltextsorttable"	value="<?=$tbltextsorttable;?>">
												<input class="formsubmit"	type="hidden" name="frmstartdate" 		id="frmstartdate"		value="<?=$uifrmstartdate;?>">
												<input class="formsubmit"	type="hidden" name="frmenddate" 		id="frmenddate"			value="<?=$uifrmenddate?>">
												<input class="formsubmit"	type="submit" name="b1" 				id="b1" 				value="R">
												</td>
											</form>
											</tr>
										</table>
									</td>
								<?
									for ($i=0; $i<count($aheadername); $i=$i+1) {
											if ($tbldisplaytotal==1) {
													// Add another row to the total row array
													$arowtotal[$i] = $arowtotal[$i] + $objarray[$adatafield[$i]];
												}
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
																		$tmp_previous_value	= ($tmp_current_value);
																		////echo "Previous Value is ".$tmp_previous_value."";
																				?>
									<a href="javascript:updatewhereform('<?=$adatafieldtable[$i];?>.<?=$adatafield[$i];?>=<?=$objarray[$adatafield[$i]];?>');">
										<font color="#000000">
											<?=$objarray[$adatafield[$i]];?>
											</font>
										</a>
																				<?
																				$tmp_current_value	= ($objarray[$adatafield[$i]]);
																				////echo "Current Value is ".$tmp_current_value."";
																		break;
																}
														break;
												case "makebutton":		
														switch ($ainputtype[$i]) {
																case "TEXT":
																		?>
										<form style="margin-bottom:0;" action="<?=$objarray[$adatafield[$i]];?>" method="POST" name="editform" id="editform" target="_new">
											<input type="hidden" name="editpage" 			value="<?=$functioneditpage;?>">
											<input type="hidden" name="summarypage" 		value="<?=$functionsummarypage;?>">
											<input type="hidden" name="printerpage" 		value="<?=$functionprinterpage;?>">
											<input type="hidden" name="inspectionid" 		value="<?=$objarray[$adatafield[$i]];?>">
											<input type="submit" value="View Lease" name="b1" class="formsubmit">
											</form>								
																		<?
																		break;
																}
														break;								
												default:											
														$tmpsqlwhereaddon=$objarray[$adatafieldid[$i]];
														////echo $tmpsqlwhereaddon;
														$tmp_previous_value	= ($tmp_current_value);
														////echo "Previous Value is ".$tmp_previous_value."<br>";
														switch ($aheadername[$i]) {
																case "Item Leased":	
																		?>
											<a href="javascript:updatewhereform('<?=$adatafieldtable[$i];?>.<?=$adatafieldid[$i];?>=<?=$tmpsqlwhereaddon;?>');">
												<font color="#000000">
																<?
													$tmp = $adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "", $tmp_previous_value);
													////echo $tmp;																
																		break;
																case "Object":
																		?>
											<a href="javascript:updatewhereform('<?=$adatafieldtable[$i];?>.<?=$adatafieldid[$i];?>=<?=$tmpsqlwhereaddon;?>');">
												<font color="#000000">
																<?
													$tmp = $adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "", $tmp_previous_value);
													////echo $tmp;																
																		break;
																case "Replacement Year":
																		?>
											<a href="javascript:updatewhereform('<?=$adatafieldtable[$i];?>.<?=$adatafieldid[$i];?>=<?=$tmpsqlwhereaddon;?>');">
												<font color="#000000">
																<?
													$tmp = $adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "", $objarray[$tblkeyfield],$objarray[$adatafield[0]]);
													////echo $tmp;																
																		break;
																default:
																		?>
											<a href="javascript:updatewhereform('<?=$adatafieldtable[$i];?>.<?=$adatafieldid[$i];?>=<?=$tmpsqlwhereaddon;?>');">
												<font color="#000000">
																<?
													$tmp = $adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "");																
																		break;

																}
																$tmp_current_value	= ($objarray[$adatafield[$i]]);
																////echo "<br>Current Value is ".$tmp_current_value."<br>";
																?>
													</font>
												</a>
														<? 
														
														break;														
												}
										if ($aheadername[$i]=="Miles") {
												$currentmiles	= $objarray[$adatafield[$i]];
												if ($lastmiles=="") {
														// This is the first row to be displayed, so dont do calculations, but do store current miles into lastmiles
														$lastmiles = $objarray[$adatafield[$i]];
													}
													else {
														$tmp = ( $currentmiles );//- $lastmiles );
														$currenteconomy	= ( $tmp / $objarray[$adatafield[7]]);
														$currenteconomy = round($currenteconomy,2);
														//echo "<br>(".$currenteconomy." mpg)";
														}
											}
										if ($aheadername[$i]=="Hours") {
												$currenthours	= $objarray[$adatafield[$i]];
												if ($lasthours=="") {
														// This is the first row to be displayed, so dont do calculations, but do store current miles into lastmiles
														$lasthours= $objarray[$adatafield[$i]];
													}
													else {
														$tmp = ( $currenthours );// - $lasthours );
														$currenteconomyh	= ( $tmp / $objarray[$adatafield[7]]);
														$currenteconomyh = round($currenteconomyh,2);
														//echo "<br>(".$currenteconomyh." hpg)";
														}
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
											$displayrow = 1;
											}
								if ($tbldisplaytotal==1) {
										?>
								<tr>
									<td colspan="2" align="center" valign="middle" class="formresults">
										Total
										</td>
										<?
										for ($i=0; $i<count($aheadername); $i=$i+1) {
												if ($adataputarray[$i]==1) {
														?>
									<td align="center" valign="middle" class="formresults">
										<?=$arowtotal[$i];?>
														<?
														if ($adataavgarray[$i]==1) {
																$tmpavg = ($arowtotal[$i] / $number_of_rows);
																$tmpavg = round($tmpavg,2);
																?>
										(<?=$tmpavg;?> avg)
																<?
															}
															?>
										</td>
															<?
													}
													else {
														if ($adataavgarray[$i]==1) {
																$tmpavg = ($arowtotal[$i] / $number_of_rows);
																$tmpavg = round($tmpavg,2);
																?>
									<td align="center" valign="middle" class="formresults">
										(<?=$tmpavg;?> avg)
										</td>
																<?
															}
															else {															
															?>
									<td align="center" valign="middle" class="formresults">
										&nbsp;
										</td>
															<?
															}
													}
											}
										?>
									</tr>
							</table>
									<?
									}
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