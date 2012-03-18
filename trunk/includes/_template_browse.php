<?php 
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
		
		// Load Include Files
		
		include("includes/_template/template.list.php");	
		
		// Run Template Engine
		
		
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
		$sql 	= $sql.$nsql;																	// field index values have all been added to the sql string (this line is reduntent, but there for space)
		$nsql 	= " FROM ".$tbldatesorttable." ";												// with all field index values added, add the FROM syntax and the applicable table in the DB
		$sql 	= $sql.$nsql;																	// make it all one nice sql string for use

	// For debugging purposes print out the SQL Statement
	
		errorreport("The Initial SQL Statement is <font size='1'>".$sql." </font>",$displayerrors);				// When dedugging you can uncomment this ////echo and see the sql statement

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


		errorreport("All Initial Settings have been completed",$displayerrors);		
		
if (!isset($_POST["frmjoined"])) {

		errorreport("Form has not been submitted, Display New Form",$displayerrors);	
		
		$intfrmjoined	 	= 0;
		$intsqlwhereaddon 	= 0;
		$strsqlwhereaddon 	= "";				
		$togfrmjoined 		= 1;
		
		errorreport("Checking to see if there is a value in <i>intfrmjoined</i>",$displayerrors);	
		
		if (!isset($_POST["intfrmjoined"])) {
		
				errorreport("There is no value in <i>intfrmjoined</i>",$displayerrors);	
				
				$frmjoined 		= 0; //set value to zero (this causes the checkbox to not be checked)
				$intfrmjoined 	= 0; //set value to zero (this causes the checkbox to not be checked)
				}
			else {
			
				errorreport("Form JOINED (initial) value is ".$intfrmjoined." in <i>intfrmjoined</i>",$displayerrors);	
				
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
		if ($frmjoined==1) {
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
		$nsql = " WHERE ".$tbldatesorttable.".".$tbldatesortfield." >= '".$sqlfrmstartdate."' AND ".$tbldatesorttable.".".$tbldatesortfield." <= '".$sqlfrmenddate."'";
		$sql = $sql.$nsql;
		$intsqlwhereaddon = 1;
		
		?>
		<script>	</script>
		<?php 
	}
if ($tbltextsort==1) {
		if ($tbldatesort==1) {
				$nsql = " AND ".$tbltextsorttable.".".$tbltextsortfield." like '%".$frmtextlike."%' ";
				$sql = $sql.$nsql;
				$intsqlwhereaddon = 1;
				}
			else {
				$nsql = " WHERE ".$tbltextsorttable.".".$tbltextsortfield." like '%".$frmtextlike."%' ";
				$sql = $sql.$nsql;	
				$intsqlwhereaddon = 1;
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
							$nsql=" ORDER BY ".$adatafieldtable[$i].".".$adatafield[$i]." ";
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
							$nsql=" ORDER BY ".$adatafieldtable[$i].".".$adatafield[$i]." desc ";
							$sql = $sql.$nsql;
						}
						else {
							$sql = $sql.", ".$adatafieldtable[$i].".".$adatafield[$i]." desc ";
						} 
				} 
		}
	}
	
	$sql_failsafe 		= str_replace("%3D","=",$sql);
	
	if (!isset($_POST["formoptionpageation"])) {
			$form_pagetodisplay	= 1;
			$form_startcountat	= 0;			
			
			$sql = $sql." LIMIT ".$form_startcountat.",".$tblpagationgroup."";
		}
		else {
			// the field does exist, what is its current value
			$form_pagetodisplay	= $_POST["formoptionpageation"];
			$form_startcountat	= ($form_pagetodisplay * $tblpagationgroup);	
			
			$sql = $sql." LIMIT ".$form_startcountat.",".$tblpagationgroup."";
		}

	$sql 		= str_replace("%3D","=",$sql);
	
	errorreport("The Completed SQL Statement is <font size='1'> ".$sql."</font>",$displayerrors);	
	
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
		$arowtotal[2] 			= "";
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
	<form action="<?php echo $_SERVER["PHP_SELF"];?>"  		  name="sorttable" 			id="sorttable" 						method="POST">
		<input class="commonfieldbox"	type="hidden" name="menuitemid" 		id="menuitemid"			size="10"	value="<?php echo $_POST['menuitemid'];?>">
		<input class="commonfieldbox" 	type="hidden" name="frmurl" 			id="frmurl"				size="1"	value="<?php echo $frmurl;?>">
		<input class="combobox" 		type="hidden" name="intfrmjoined" 		id="intfrmjoined"		size="4"	value="<?php echo $intfrmjoined;?>">
		<input class="combobox" 		type="hidden" name="strsqlwhereaddon" 	id="strsqlwhereaddon"	size="55"	value="<?php echo $strsqlwhereaddon;?>">
		<input class="combobox"			type="hidden" name="intsqlwhereaddon" 	id="intsqlwhereaddon"	size="10"	value="<?php echo $intsqlwhereaddon;?>">
		
	<table border="0" cellspacing="0" cellpadding="0" width="100%" id="tblbrowseformtable" style="border-collapse: collapse; border-style: none; ">
		<tr>
			<td width="3%" class="tableheaderleft">&nbsp;</td>
			<td class="tableheadercenter" width="95%" align="left" valign="middle">
				<?php 
				////echo "frmstartdate >".$uifrmstartdate."< <br>";
				getnameofmenuitemid($strmenuitemid, "long", 4, "#ffffff",$_SESSION['user_id']);
				?>
				(
				<?php 
				////echo "frmstartdate >".$uifrmstartdate."< <br>";
				getpurposeofmenuitemid($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
				?>
				)
				</td>
			<td class="tableheaderright" width="2%" align="right" valign="middle">
				<font size="1">&nbsp;</font>
			</tr>
		<tr>
			<!-- THis is the ROW where all of the FORM search display controls are shows -->
			<td colspan="3" class="tablesubcontent" align="right">
				<table border="0" cellspacing="0" cellpadding="0" id="table2" height="55" width="100%" style="border-collapse: collapse; border-style: none; ">
					<tr>
						<td class="formoptions"	align="center" valign="middle" width="250">
							<?php 
							// -= DSC = - -= DSC = - -= DSC = - -= DSC = - -= DSC = - -= DSC = - -= DSC = - -= DSC = - -= DSC = - 
							// DATE SORTING CONTROLS
							// -= DSC = - -= DSC = - -= DSC = - -= DSC = - -= DSC = - -= DSC = - -= DSC = - -= DSC = - -= DSC = - 
							if ($tbl_show_datesort==1) {
									// echo "Page is set to display the Joined Sort field";				
									if ($tbldatesort==1) {
											// Page is programmed to allow the sorting of records by date.  Display Date Entry Form Fields.
											?>
							<table border="0" cellspacing="0" cellpadding="0" id="table2" height="55" width="250" style="border-collapse: collapse; border-style: none; ">
								<tr>
									<td class="formbuttons"	align="center"	valign="middle">
										<?php echo $en_start_date;?><br>
										<input 	class="commonfieldbox" type="text" name="frmstartdate"	id="frmstartdate"	size="8" value="<?php echo $uifrmstartdate;?>" 	onchange="javascript:(isdate(this.form.frmstartdate.value,'mm/dd/yyyy'))">&nbsp;<a href="javascript:showCal('Calendar1')"><img src="stylesheets/_cssimages/icon_calendar.jpg" border="0"></a>
										</td>
									<td class="formbuttons"	align="center"	valign="middle">
										<?php echo $en_end_date;?><br>
										<input 	class="commonfieldbox" type="text" name="frmenddate" 	ID="frmenddate" 	size="8" value="<?php echo $uifrmenddate;?>" 	onchange="javascript:(isdate(this.form.frmenddate.value,'mm/dd/yyyy'))">&nbsp;<a href="javascript:showCal('Calendar2')"><img src="stylesheets/_cssimages/icon_calendar.jpg" border="0"></a>
										</td>
									</tr>
								</table>
							</td>
											<?php 
										}
										else {
											?>
							<?php echo $en_turned_off;?>
											<?php 
										}
										?>
							</td>
										<?php
								}
						// -= TSC = - -= TSC = - -= TSC = - -= TSC = - -= TSC = - -= TSC = - -= TSC = - -= TSC = - -= TSC = - 
						// TEXT SORTING CONTROLS
						// -= TSC = - -= TSC = - -= TSC = - -= TSC = - -= TSC = - -= TSC = - -= TSC = - -= TSC = - -= TSC = - 
						if ($tbl_show_textsort == 1) {
								// echo "Page is set to display the Text Sort field";
								?>
						<td class="formoptions"	align="center" valign="middle" width="210" style="cursor:hand">
							<table border="0" cellspacing="0" cellpadding="0" id="table2" height="55" width="210" style="border-collapse: collapse; border-style: none; ">
								<tr>
									<td class="formbuttons"	align="center"	valign="middle"	onMouseover="ddrivetip('<?php echo $en_textlike;?>')"; onMouseout="hideddrivetip()">
										<?php
										if ($tbltextsort == 1) {
												?>
										<?php echo $en_textlike;?><br>
										<input class="commonfieldbox" type="text" name="frmtextlike" size="25" value="<?php echo $frmtextlike;?>">
												<?php
											}
											else {
												?>
										<?php echo $en_turned_off;?><br><br>
												<?php
											}
											?>
												</td>
									</tr>
								</table>
							</td>
								<?php
							}
						// -= JSC = - -= JSC = - -= JSC = - -= JSC = - -= JSC = - -= JSC = - -= JSC = - -= JSC = - -= JSC = - 
						// JOINED SORTING CONTROLS
						// -= JSC = - -= JSC = - -= JSC = - -= JSC = - -= JSC = - -= JSC = - -= JSC = - -= JSC = - -= JSC = - 
						if ($tbl_show_joinedsort==1) {
								// echo "Page is set to display the Joined Sort field";
								?>									
						<td class="formoptions" align="center" valign="middle" width="150" onclick="javascript:updatecontrolform('frmjoined');" style="cursor:hand">
							<table width="150" border="0" cellpadding="0" cellspacing="0" class="formoptions" height="55" style="border-collapse: collapse; border-style: none; ">
								<tr>
									<td class="formbuttons" align="center" valign="middle" onMouseover="ddrivetip('<b><?php echo $en_joined;?></b><br>Use this control to link any underlined item to other underlined items.<br>')"; onMouseout="hideddrivetip()">
										<?php echo $en_joined;?><br>
										<input class="hidden" type="hidden" name="frmjoined" id="frmjoined" size="25" 
										<?php 
										if ($frmjoined=="1") {
												$defaultduplicate = $en_active;
												?>
										value="1" >
												<?php 
												}
											else {
												$defaultduplicate = $en_notactive;
												?>
											>
												<?php 
											}
											?>
										</td>
									</tr>
								<tr>
									<td align="center" valign="middle">
										<input class="inlinehiddenbox" type="text" name="frmjoinedactive" id="frmjoinedactive" size="15" value="<?php echo $defaultduplicate;?>">
										</td>
									</tr>
								</table>
							</td>							
										<?php
							}
						// -= ASC = - -= ASC = - -= ASC = - -= ASC = - -= ASC = - -= ASC = - -= ASC = - -= ASC = - -= ASC = - 
						// ARCHIVED SORTING CONTROLS
						// -= ASC = - -= ASC = - -= ASC = - -= ASC = - -= ASC = - -= ASC = - -= ASC = - -= ASC = - -= ASC = - 
						if ($tbl_show_archivedsort==1) {
								// echo "Page is set to display the Joined Sort field";
								?>									
						<td class="formoptions" align="center" valign="middle" width="150" onclick="javascript:updatecontrolform('frmarchives');" style="cursor:hand">
							<table width="150" border="0" cellpadding="0" cellspacing="0" class="formoptions" height="55" style="border-collapse: collapse; border-style: none; ">
								<tr>
									<td class="formbuttons" align="center" valign="middle" onMouseover="ddrivetip('<b><?php echo $en_archived;?></b><br>Use this control to show archived records.<br>')"; onMouseout="hideddrivetip()">
										<?php echo $en_archived;?><br>
										<input class="hidden" type="hidden" name="frmarchives" id="frmarchives" size="25" 
										<?php
										if ($_POST['frmarchives'] == 0) {
												$defaultduplicate = $en_notactive;
											}
											else {
												$defaultduplicate = $en_active;
												?>
										value="<?php echo $_POST['frmarchives'];?>"
												<?php
											}
											?>
										>
										</td>
									</tr>
								<tr>
									<td align="center" valign="middle">
										<input class="inlinehiddenbox" type="text" name="frmarchivesactive" id="frmarchivesactive" size="15" value="<?php echo $defaultduplicate;?>">
										</td>
									</tr>
								</table>
							</td>							
										<?php
							}
						// -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - 
						// CLOSED SORTING CONTROLS
						// -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - 						
						if ($tbl_show_closedsort==1) {
								// echo "Page is set to display the Joined Sort field";
								?>									
						<td class="formoptions" align="center" valign="middle" width="150" onclick="javascript:updatecontrolform('frmclosed');" style="cursor:hand">
							<table width="150" border="0" cellpadding="0" cellspacing="0" class="formoptions" height="55" style="border-collapse: collapse; border-style: none; ">
								<tr>
									<td class="formbuttons" align="center" valign="middle" onMouseover="ddrivetip('<b><?php echo $en_closed;?></b><br>Use this control to show closed out records.<br>')"; onMouseout="hideddrivetip()">
										<?php echo $en_closed;?><br>
										<input class="hidden" type="hidden" name="frmclosed" id="frmclosed" size="25" 
										<?php
										if ($_POST['frmclosed'] == 0) {
												$defaultduplicate = $en_notactive;
											}
											else {
												$defaultduplicate = $en_active;
												?>
										value="<?php echo $_POST['frmclosed'];?>"
												<?php
											}
											?>
										>
										</td>
									</tr>
								<tr>
									<td align="center" valign="middle">
										<input class="inlinehiddenbox" type="text" name="frmclosedactive" id="frmclosedactive" size="15" value="<?php echo $defaultduplicate;?>">
										</td>
									</tr>
								</table>
							</td>							
										<?php
							}
						// -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - 
						// DUPLICATE SORTING CONTROLS
						// -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - -= CSC = - 						
						if ($tbl_show_duplicatesort == 1) {
								// echo "Page is set to display the Joined Sort field";
								?>									
						<td class="formoptions" align="center" valign="middle" width="150" onclick="javascript:updatecontrolform('frmduplicate');" style="cursor:hand">
							<table width="150" border="0" cellpadding="0" cellspacing="0" class="formoptions" height="55" style="border-collapse: collapse; border-style: none; ">
								<tr>
									<td class="formbuttons" align="center" valign="middle" onMouseover="ddrivetip('<b><?php echo $en_duplicate;?></b><br>Use this control to show duplicated records.<br>')"; onMouseout="hideddrivetip()">
										<?php echo $en_duplicate;?><br>
										<input class="hidden" type="hidden" name="frmduplicate" id="frmduplicate" size="4" 
										<?php
										if ($_POST['frmduplicate'] == 0) {
												$defaultduplicate = $en_notactive;
											}
											else {
												$defaultduplicate = $en_active;
												?>
										value="<?php echo $_POST['frmduplicate'];?>"
												<?php
											}
											?>
										>
										</td>
									</tr>
								<tr>
									<td align="center" valign="middle">
										<input class="inlinehiddenbox" type="text" name="frmduplicateactive" id="frmduplicateactive" size="15" value="<?php echo $defaultduplicate;?>">
										</td>
									</tr>
								</table>
							</td>							
										<?php
							}							
							?>
						<td class="formoptionsR" align="center" valign="middle">
							<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.sorttable.submit()">
							</td>
						</tr>
					</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse; border-style: none; ">	
							<?php 
							$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
							//echo $sql;
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}					
										else {
											$objrs = mysqli_query($objconn, $sql);								
													if ($objrs) {
															$number_of_rows = mysqli_num_rows($objrs);												
															if ($number_of_rows==0) {
																	////echo "no records found";
																}
																else {
																	?>
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse; border-style: none; ">
								<tr>
									<td class="formoptionsavilablebottom">
										<table border="0" cellspacing="0" cellpadding="0" align="right" valign="middle" height="20" style="border-collapse: collapse; border-style: none; ">
											<tr>
																	<?php 
																	// Create an SQL Statement that can be used to pass along to the form Sub Functions.
																	$encoded = urlencode($sql);		
																	////echo "The encoded SQL Statement is ".$encoded."<br><br><br>";												
																	// Currently this process does not work because Internet Explorer limits the total number of characters that can be passed in the GET Statement of the URL.
																	// Should that limit be removed or changed we might be able to pass the SQL Statement in the URL as desired.
																	?>
																	<?php 
																	// Pageation Display
																	// 		The Total number of records found is in the variable : $number_of_rows
																	// 			This variable is unrelaible in that it includes records which may be arhived or hidden.
																	// 		There is no reiable way to counteract this problem since we don't know the status of the record
																	//			until it is displaued. We have to base our display on incorrect data and hope for the best.
																	//			a possible solution to this would be to load everything into an array and then use that array 
																	//			to display the information.  For now, lets do it the inaccurate way first. 
																	// echo "Total number of rows is :".$number_of_rows."<br>";
																	// This doesn't work!!!  Variable is defined by the limit function, we need a total from another source
																	// $sql_failsafe has the SQL syntax right before the limit switch is put into place. We need to run that 
																	//		that SQL statement and see what gives.  A general function can do this:
																	$sql_failsafe_rows = gs_numberofrows($sql_failsafe);
																			//echo "SQL Failsafe Rows :".$sql_failsafe_rows."<br>";
																	$totalpages = ($sql_failsafe_rows / $tblpagationgroup);
																			//echo "Total Number of Pages : ".$totalpages."<br>";
																	$totalpages	= round($totalpages+1,0);
																			// I dislike adding a 1 to the result as it isn't proper rounding
																			// 1.1111 should be increased to 2, not 2.11111
																			// This will give false info where only 2 records would be .1111 (2/18)
																			//echo "Total Number of Pages : ".$totalpages."<br>";
																	$totalpages	= ($totalpages - 1);
																			//echo "Total Number of Pages : ".$totalpages."<br>";
																	?>
												<td class="formoptionsubmit" ID="pageation" NAME="pageation" align="center" valign="middle">
													
													<select class="inlinehiddenbox" name="formoptionpageation" ID="formoptionpageation" onchange="this.form.submit(); ">
																	<?php 
																	for ($j=0; $j<($totalpages+1); $j=$j+1) {
																			?>
														<option value="<?php echo $j;?>" 
																			<?php 
																			if ($j==$_POST['formoptionpageation']) {
																					?>
															SELECTED 
																					<?php 
																				}
																			$from 	= ( ( ( $j ) * $tblpagationgroup ) + 1 );
																			$to		= ( ( ( $from ) + $tblpagationgroup ) - 1 );
																			?>							
															><?php echo $en_pageation;?> <?php echo $j;?> R:(<?php echo $from;?>-<?php echo $to;?>)</option>
																			<?php 
																		}
																		?>
														</select>
													</td>
																	<?php
																	// Save to Quick Access System
																	// Check to see if this menu item is already in this users tbl_quickaccess_control
																	$qac_exisists = qac_test_exisist($strmenuitemid,$_SESSION["user_id"],"test");
																	//echo $qac_exisists;
																	// This screen is not in the users Quick Access Menu System, Display the option to add it
																	?>
												<td ID="quickaccess" NAME="quickaccess" class="formoptionsubmit" onclick="javascript:call_server_blockform('<?php echo $strmenuitemid;?>','<?php echo $_SESSION["user_id"];?>','frmfunctionqac')" >
													<input class="hidden" 			type="hidden" 	name="frmfunctionqac" 		id="frmfunctionqac" 		size="25" value="<?php echo $qac_exisists;?>">
																	<?php
																	if ($qac_exisists == 0) {
																			$en_quickaccesstmp = $en_quickaccess;
																		}
																		else {
																			$en_quickaccesstmp = $en_quickaccessno;
																		}
																		?>											
													<input class="inlinehiddenbox" 	type="text" 	name="frmfunctionqacactive" id="frmfunctionqacactive" 	size="25" value="<?php echo $en_quickaccesstmp;?>"> 
													</td>
												<td class="formoptionsubmit" align="center" valign="middle">
													&nbsp;&nbsp;&nbsp;<a href="#" onclick="javascript:document.sorttable.submit()" class="anchorclass myownclass" rel="submenu3">
														<font color="#FFFFFF" size="3">Form Utilities</font>
														</a>&nbsp;&nbsp;&nbsp;
                                                   <div id="submenu3" class="anylinkcsscols">
														<div class="column">
															<b>Reports</b>
															<ul>
																		<?php
																	if ($function_calendar != '') {
																			// Page has allowed the Calendar Printout Function.
																			?>					
																<li class="formoptionsubmit" onclick="openmapchild('<?php echo $function_calendar;?>?frmurl=<?php echo $encoded;?>&frmstartdate=<?php echo $uifrmstartdate;?>&frmenddate=<?php echo $uifrmenddate;?>','PrinterCalenderFormat');" >
																	&nbsp;&nbsp;<?php echo $en_calendarprint;?>&nbsp;&nbsp;
																	</li>
																			<?php 
																		}
																	if ($function_yearendreport != '') {
																			// Page has allowed the Calendar Printout Function.
																			?>					
																<li class="formoptionsubmit" onclick="openchild600('<?php echo $function_yearendreport;?>?frmurl=<?php echo $encoded;?>&frmstartdate=<?php echo $uifrmstartdate;?>&frmenddate=<?php echo $uifrmenddate;?>','PrinterYearEndFormat');" >
																	&nbsp;&nbsp;<?php echo $en_yearendreport;?>&nbsp;&nbsp;
																	</li>
																			<?php 
																		}	
																	if ($function_printout != '') {	
																			// Page has allowed the Printer Friendly PrintOut Function.
																			?>
																<li class="formoptionsubmit" onclick="openmapchild('<?php echo $function_printout;?>?frmurl=<?php echo $encoded;?>&menuitemid=<?php echo $strmenuitemid;?>&aheadername=<?php echo $straheadername;?>&adatafield=<?php echo $stradatafield;?>&tblkeyfield=<?php echo $tblkeyfield;?>&tbldatesortfield=<?php echo $tbldatesortfield;?>&tbldatesorttable=<?php echo $tbldatesorttable;?>&tbltextsortfield=<?php echo $tbltextsortfield;?>&tbltextsorttable=<?php echo $tbltextsorttable;?>&adatafieldtable=<?php echo $stradatafieldtable;?>&adatafieldid=<?php echo $stradatafieldid;?>&adataspecial=<?php echo $stradataspecial;?>&ainputtype=<?php echo $strainputtype;?>&adataselect=<?php echo $stradataselect;?>&tblarchivedfield=<?php echo $tblarchivedfield?>','PrinterPrintoutFormat');" >
																	&nbsp;&nbsp;<?php echo $en_printerprint;?>&nbsp;&nbsp;
																	</li>
																			<?php 
																		}
																	?>
																</ul>
															</div>
														<div class="column">
															<b>Charts</b>
															<ul>
																	<?php
																	if ($function_distribution != '') {
																			// Page has allowed the Distribution Chart Function.
																			?>														
																<li class="formoptionsubmit" onclick="openchild600('<?php echo $function_distribution;?>?startdate=<?php echo $uifrmstartdate;?>&enddate=<?php echo $uifrmenddate;?>','PrinterLoadDistFormat');" >
																	&nbsp;&nbsp;<?php echo $en_distribution;?>&nbsp;&nbsp;
																	</li>
																			<?php 
																		}																														
																	if ($function_linechart != '') {
																			// Page has allowed the Line Chart Function.
																			?>														
																<li class="formoptionsubmit" onclick="openchild600('<?php echo $function_linechart;?>?startdate=<?php echo $uifrmstartdate;?>&enddate=<?php echo $uifrmenddate;?>','PrinterLineChartFormat');" >
																	&nbsp;&nbsp;<?php echo $en_linechart;?>&nbsp;&nbsp;
																	</li>
																			<?php 
																		}															
																	if ($function_mapit != '') {
																			// Page has allowed the Mapit Function.
																			?>														
																<li class="formoptionsubmit" onclick="openchild600('<?php echo $function_mapit;?>?startdate=<?php echo $uifrmstartdate;?>&enddate=<?php echo $uifrmenddate;?>','PrinterMapitFormat');" >
																	&nbsp;&nbsp;<?php echo $en_mapit;?>&nbsp;&nbsp;
																	</li>
																			<?php 
																		}	
																	?>
																</ul>
															</div>
														<div class="column">
															<b>Exports</b>
															<ul>
																	<?php
																	if ($function_googleearthit != '') {
																			// Page has allowed the Mapit Function.
																			?>														
																<li class="formoptionsubmit" onclick="opensmallchild('<?php echo $function_googleearthit;?>?startdate=<?php echo $uifrmstartdate;?>&enddate=<?php echo $uifrmenddate;?>','PrinterExportGoogleEarthFormat');" >
																	&nbsp;&nbsp;<?php echo $en_googleearthit;?>&nbsp;&nbsp;
																	</li>
																			<?php 
																		}	
																	?>
																</ul>
															</div>
														</div>
													</td>													
												<!-- menu System was Here in buttons TD -->
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					<tr>
						<td class="tabledatarow">
							<table border="0" cellpadding="0" cellspacing="0" width="100%" id="table1" style="border-collapse: collapse; border-style: none; ">
								<tr>
									<td class="formheaders" width="45">
										ID
										</td>
									<td class="formheaders" width="80">
										Functions
										</td>
																	<?php  
																	for ($i=0; $i<count($aheadername); $i=$i+1) {
																			switch ($aheadername[$i]) {
																					case "Date":
																							$cellwidth[$i] = "90";
																							break;
																					case "Time":
																							$cellwidth[$i] = "90";
																							break;
																					default:
																							$cellwidth[$i] = "*";
																							break;
																				}
																			?>
									<td class="formheaders" width="<?php echo $cellwidth[$i];?>">
																			<?php
																			if ($tblheadersort==1) {
																					?>
										<a href="#" onfocus="javascript:getvaluesortform('<?php echo $adatafield[$i];?>');" onclick="javascript:updatesortform('<?php echo $adatafield[$i];?>'); "><font color="#ffffff"><?php echo $aheadername[$i];?></font></a>
										<br>(<input class="inlinehiddenbox" type="text" size="8" id="<?php echo $adatafield[$i];?>" name="<?php echo $adatafield[$i];?>" value="<?php echo $aheadersort[$i];?>">)
																					<?php  
																				} 
																			?>
										</td>
																			<?php 
																		}
																	if ($runpostflights == 1) {
																			// Display Classification Column
																			?>
									<td class="formheaders" width="80">
										Added Commands
										</td>
																			<?php
																		}
																	?>
									</tr>
								</form>
																	<?php 
																	while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
																	
																			if ($runpreflights == 1) {
																		
																					//reset value
																					$displayrow		= 1;
																					$dontdisplay	= 0;
														
																					// --------------------NOT EVERY TABLE OR PAGE NEEDS A PREFLIGHT, IN THIS CASE IT DOES------		
																					// Do PreFlight on Table to check if this record is archived and if so skip it.
																					////echo "My Default setting is to ".$displayrow." display rows<br><br>";
																
																					if ($function_archivedsort=='') {
																							// echo "User has not defined a function for this preflight [archived]";
																							// Skip this function
																						}
																						else {
																							if ($_POST['frmarchives'] == 0) {
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
																						}
																
																					if ($function_duplicatesort == '') {
																							// echo "User has not defined a function for this preflight [duplicate]";
																							// Skip this function																
																						}
																						else {															
																							if ($_POST['frmduplicate'] == 0) {														
																									////echo "Is user sorting closed rows :".$tblclosedsort." ";
																									$displayrow 		= 	$function_duplicatesort($objarray[$tblkeyfield],$_POST['frmduplicate']);		// returns 1 if row is closed
																									//echo "Should this row be displayed? :".$displayclosed."<br><br>";
																									if ($displayrow == 0) {
																											$dontdisplay_duplicate = 1;
																										}
																										else {
																											$dontdisplay_duplicate = 0;
																										}
																								}
																						}
																
																					if ($function_closedsort=='') {
																							// echo "User has not defined a function for this preflight [closed]";
																							// Skip this function
																						}
																						else {															
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
																						}
																
																					if ($dontdisplay_archived == 1) {
																							// Do not display row
																							$displayrow = 0;
																						}
																					if ($dontdisplay_closed == 1) {
																							$displayrow = 0;
																						}
																					if ($dontdisplay_duplicate == 1) {
																							$displayrow = 0;
																						}
																					// --------------------NOT EVERY TABLE OR PAGE NEEDS A PREFLIGHT, IN THIS CASE IT DOES------
																				}												
										
																			if ($displayrow == 1) {
																					?>
							<tr>
								<td class="formresults" align="center" valign="middle" height="32" width="45">
									<?php echo $objarray[$tblkeyfield];?>
									</td>
								<td align="center" class="formresults" width="80">
									<table border="0" cellspacing="0" cellpadding="0" width="100%" id="table1" class="formsubmit">
										<tr>
											<form style="margin-bottom:0;" action="<?php echo $functioneditpage;?>" method="POST" name="editform" id="editform" target="EditRecordWindow" onsubmit="openmapchild('','EditRecordWindow')";>
											<td class="formoptionsubmit" onMouseover="ddrivetip('Edit Record')"; onMouseout="hideddrivetip()">
												<input class="formsubmit"	type="hidden" name="editpage" 			id="editpage"			value="<?php echo $functioneditpage;?>">
												<input class="formsubmit"	type="hidden" name="summarypage" 		id="summarypage"		value="<?php echo $functionsummarypage;?>">
												<input class="formsubmit"	type="hidden" name="printerpage" 		id="printerpage"		value="<?php echo $functionprinterpage;?>">
												<input class="formsubmit"	type="hidden" name="inspectionid"		id="inspectionid" 		value="<?php echo $objarray[$tblkeyfield];?>">
												<input class="formsubmit"	type="hidden" name="recordid" 			id="recordid"			value="<?php echo $objarray[$tblkeyfield];?>">
												<input class="formsubmit"	type="hidden" name="menuitemid" 		id="menuitemid"			value="<?php echo $strmenuitemid?>">
												<input class="formsubmit"	type="hidden" name="aheadername"		id="aheadername" 		value="<?php echo $saheadername;?>">
												<input class="formsubmit"	type="hidden" name="adatafield" 		id="adatafield"			value="<?php echo $sadatafield;?>">
												<input class="formsubmit"	type="hidden" name="adatafieldtable" 	id="adatafieldtable"	value="<?php echo $sadatafieldtable;?>">
												<input class="formsubmit"	type="hidden" name="adatafieldid" 		id="adatafieldid"		value="<?php echo $sadatafieldid;?>">
												<input class="formsubmit"	type="hidden" name="adataspecial" 		id="adataspecial"		value="<?php echo $sadataspecial;?>">
												<input class="formsubmit"	type="hidden" name="ainputtype" 		id="ainputtype"			value="<?php echo $sainputtype;?>">
												<input class="formsubmit"	type="hidden" name="adataselect" 		id="adataselect"		value="<?php echo $sadataselect;?>">
												<input class="formsubmit"	type="hidden" name="ainputcomment" 		id="ainputcomment"		value="<?php echo $sainputcomment;?>">
												<input class="formsubmit"	type="hidden" name="tblname" 			id="tblname"			value="<?php echo $tblname;?>">
												<input class="formsubmit"	type="hidden" name="tblsubname" 		id="tblsubname"			value="<?php echo $tblsubname?>">
												<input class="formsubmit"	type="hidden" name="tblkeyfield" 		id="tblkeyfield"		value="<?php echo $tblkeyfield;?>">
												<input class="formsubmit"	type="hidden" name="tblarchivedfield"	id="tblarchivedfield"	value="<?php echo $tblarchivedfield;?>">
												<input class="formsubmit"	type="hidden" name="tbldatesortfield" 	id="tbldatesortfield"	value="<?php echo $tbldatesortfield;?>">
												<input class="formsubmit"	type="hidden" name="tbldatesorttable" 	id="tbldatesorttable"	value="<?php echo $tbldatesorttable;?>">
												<input class="formsubmit"	type="hidden" name="tbltextsortfield" 	id="tbltextsortfield"	value="<?php echo $tbltextsortfield;?>">
												<input class="formsubmit"	type="hidden" name="tbltextsorttable" 	id="tbltextsorttable"	value="<?php echo $tbltextsorttable;?>">
												<input class="formsubmit"	type="hidden" name="frmstartdate" 		id="frmstartdate"		value="<?php echo $uifrmstartdate;?>">
												<input class="formsubmit"	type="hidden" name="frmenddate" 		id="frmenddate"			value="<?php echo $uifrmenddate?>">
												<input class="formsubmit"	type="submit" name="b1" 				id="b1" 				value="E">
												</td>
											</form>
											<form style="margin-bottom:0;" action="<?php echo $functionsummarypage;?>" method="POST" name="summaryform" id="summaryform" target="SummaryReportWindow" onsubmit="openchild600('','SummaryReportWindow')";>
											<td class="formoptionsubmit" onMouseover="ddrivetip('Summary Report')"; onMouseout="hideddrivetip()">
												<input class="formsubmit"	type="hidden" name="editpage" 			id="editpage"			value="<?php echo $functioneditpage;?>">
												<input class="formsubmit"	type="hidden" name="summarypage" 		id="summarypage"		value="<?php echo $functionsummarypage;?>">
												<input class="formsubmit"	type="hidden" name="printerpage" 		id="printerpage"		value="<?php echo $functionprinterpage;?>">
												<input class="formsubmit"	type="hidden" name="inspectionid"		id="inspectionid" 		value="<?php echo $objarray[$tblkeyfield];?>">
												<input class="formsubmit"	type="hidden" name="recordid" 			id="recordid"			value="<?php echo $objarray[$tblkeyfield];?>">
												<input class="formsubmit"	type="hidden" name="menuitemid" 		id="menuitemid"			value="<?php echo $strmenuitemid?>">
												<input class="formsubmit"	type="hidden" name="aheadername"		id="aheadername" 		value="<?php echo $saheadername;?>">
												<input class="formsubmit"	type="hidden" name="adatafield" 		id="adatafield"			value="<?php echo $sadatafield;?>">
												<input class="formsubmit"	type="hidden" name="adatafieldtable" 	id="adatafieldtable"	value="<?php echo $sadatafieldtable;?>">
												<input class="formsubmit"	type="hidden" name="adatafieldid" 		id="adatafieldid"		value="<?php echo $sadatafieldid;?>">
												<input class="formsubmit"	type="hidden" name="adataspecial" 		id="adataspecial"		value="<?php echo $sadataspecial;?>">
												<input class="formsubmit"	type="hidden" name="ainputtype" 		id="ainputtype"			value="<?php echo $sainputtype;?>">
												<input class="formsubmit"	type="hidden" name="adataselect" 		id="adataselect"		value="<?php echo $sadataselect;?>">
												<input class="formsubmit"	type="hidden" name="ainputcomment" 		id="ainputcomment"		value="<?php echo $sainputcomment;?>">
												<input class="formsubmit"	type="hidden" name="tblname" 			id="tblname"			value="<?php echo $tblname;?>">
												<input class="formsubmit"	type="hidden" name="tblsubname" 		id="tblsubname"			value="<?php echo $tblsubname?>">
												<input class="formsubmit"	type="hidden" name="tblkeyfield" 		id="tblkeyfield"		value="<?php echo $tblkeyfield;?>">
												<input class="formsubmit"	type="hidden" name="tblarchivedfield"	id="tblarchivedfield"	value="<?php echo $tblarchivedfield;?>">
												<input class="formsubmit"	type="hidden" name="tbldatesortfield" 	id="tbldatesortfield"	value="<?php echo $tbldatesortfield;?>">
												<input class="formsubmit"	type="hidden" name="tbldatesorttable" 	id="tbldatesorttable"	value="<?php echo $tbldatesorttable;?>">
												<input class="formsubmit"	type="hidden" name="tbltextsortfield" 	id="tbltextsortfield"	value="<?php echo $tbltextsortfield;?>">
												<input class="formsubmit"	type="hidden" name="tbltextsorttable" 	id="tbltextsorttable"	value="<?php echo $tbltextsorttable;?>">
												<input class="formsubmit"	type="hidden" name="frmstartdate" 		id="frmstartdate"		value="<?php echo $uifrmstartdate;?>">
												<input class="formsubmit"	type="hidden" name="frmenddate" 		id="frmenddate"			value="<?php echo $uifrmenddate?>">
												<input class="formsubmit"	type="submit" name="b1" 				id="b1" 				value="S">
												</td>
											</form>
											<form style="margin-bottom:0;" action="<?php echo $functionprinterpage;?>" method="POST" name="reportform" id="reportform" target="PrinterRecordWindow" onsubmit="openmapchild('','PrinterRecordWindow')";>
											<td class="formoptionsubmit" onMouseover="ddrivetip('Full Report')"; onMouseout="hideddrivetip()">
												<input class="formsubmit"	type="hidden" name="editpage" 			id="editpage"			value="<?php echo $functioneditpage;?>">
												<input class="formsubmit"	type="hidden" name="summarypage" 		id="summarypage"		value="<?php echo $functionsummarypage;?>">
												<input class="formsubmit"	type="hidden" name="printerpage" 		id="printerpage"		value="<?php echo $functionprinterpage;?>">
												<input class="formsubmit"	type="hidden" name="inspectionid"		id="inspectionid" 		value="<?php echo $objarray[$tblkeyfield];?>">
												<input class="formsubmit"	type="hidden" name="recordid" 			id="recordid"			value="<?php echo $objarray[$tblkeyfield];?>">
												<input class="formsubmit"	type="hidden" name="menuitemid" 		id="menuitemid"			value="<?php echo $strmenuitemid?>">
												<input class="formsubmit"	type="hidden" name="aheadername"		id="aheadername" 		value="<?php echo $saheadername;?>">
												<input class="formsubmit"	type="hidden" name="adatafield" 		id="adatafield"			value="<?php echo $sadatafield;?>">
												<input class="formsubmit"	type="hidden" name="adatafieldtable" 	id="adatafieldtable"	value="<?php echo $sadatafieldtable;?>">
												<input class="formsubmit"	type="hidden" name="adatafieldid" 		id="adatafieldid"		value="<?php echo $sadatafieldid;?>">
												<input class="formsubmit"	type="hidden" name="adataspecial" 		id="adataspecial"		value="<?php echo $sadataspecial;?>">
												<input class="formsubmit"	type="hidden" name="ainputtype" 		id="ainputtype"			value="<?php echo $sainputtype;?>">
												<input class="formsubmit"	type="hidden" name="adataselect" 		id="adataselect"		value="<?php echo $sadataselect;?>">
												<input class="formsubmit"	type="hidden" name="ainputcomment" 		id="ainputcomment"		value="<?php echo $sainputcomment;?>">
												<input class="formsubmit"	type="hidden" name="tblname" 			id="tblname"			value="<?php echo $tblname;?>">
												<input class="formsubmit"	type="hidden" name="tblsubname" 		id="tblsubname"			value="<?php echo $tblsubname?>">
												<input class="formsubmit"	type="hidden" name="tblkeyfield" 		id="tblkeyfield"		value="<?php echo $tblkeyfield;?>">
												<input class="formsubmit"	type="hidden" name="tblarchivedfield"	id="tblarchivedfield"	value="<?php echo $tblarchivedfield;?>">
												<input class="formsubmit"	type="hidden" name="tbldatesortfield" 	id="tbldatesortfield"	value="<?php echo $tbldatesortfield;?>">
												<input class="formsubmit"	type="hidden" name="tbldatesorttable" 	id="tbldatesorttable"	value="<?php echo $tbldatesorttable;?>">
												<input class="formsubmit"	type="hidden" name="tbltextsortfield" 	id="tbltextsortfield"	value="<?php echo $tbltextsortfield;?>">
												<input class="formsubmit"	type="hidden" name="tbltextsorttable" 	id="tbltextsorttable"	value="<?php echo $tbltextsorttable;?>">
												<input class="formsubmit"	type="hidden" name="frmstartdate" 		id="frmstartdate"		value="<?php echo $uifrmstartdate;?>">
												<input class="formsubmit"	type="hidden" name="frmenddate" 		id="frmenddate"			value="<?php echo $uifrmenddate?>">
												<input class="formsubmit"	type="submit" name="b1" 				id="b1" 				value="R">
												</td>
											</form>
											</tr>
										</table>
									</td>
																					<?php 
																					for ($i=0; $i<count($aheadername); $i=$i+1) {
																							if ($tbldisplaytotal==1) {
																									if($acalculatet[$i] == 1) {
																											$arowtotal[$i] = $arowtotal[$i] + $objarray[$adatafield[$i]];
																										}
																										else {
																											// The settings say not to make a total for this entry
																										}
																								}
																						?>
								<td align="center" valign="middle" class="formresults" width="<?php echo $cellwidth[$i];?>" >
																						<?php  
																						switch ($adatafieldid[$i]) {
																								case "notjoined":
																										switch ($adataspecial[$i]) {
																												case 2:
																														?>
									@ <?php echo $objarray[$adatafield[$i]];?>
																														<?php  
																													break;
																												case 4:
																														?>
									$ <?php echo $objarray[$adatafield[$i]];?>
																														<?php  
																													break;
																												case 5:
																														?>
									<?php echo $objarray[$adatafield[$i]];?> %
																														<?php  
																													break;
																												default:
																														?>
									<?php echo $objarray[$adatafield[$i]];?>
																														<?php  
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
									<a href="javascript:updatewhereform('<?php echo $adatafieldtable[$i];?>.<?php echo $adatafield[$i];?>=<?php echo $objarray[$adatafield[$i]];?>'); ">
										<font color="#000000">
											<?php echo $tmpcbfield;?>
											</font>
										</a>				
																															<?php 
																													break;
																												default:
																														$tmp_previous_value	= ($tmp_current_value);
																														////echo "Previous Value is ".$tmp_previous_value."";
																														?>
									<a href="javascript:updatewhereform('<?php echo $adatafieldtable[$i];?>.<?php echo $adatafield[$i];?>=<?php echo $objarray[$adatafield[$i]];?>'); ">
										<font color="#000000">
											<?php echo $objarray[$adatafield[$i]];?>
											</font>
										</a>
																														<?php 
																														$tmp_current_value	= ($objarray[$adatafield[$i]]);
																														////echo "Current Value is ".$tmp_current_value."";
																													break;
																											}
																									break;
																								case "makebutton":		
																										switch ($ainputtype[$i]) {
																												case "TEXT":
																														?>
										<form style="margin-bottom:0;" action="<?php echo $objarray[$adatafield[$i]];?>" method="POST" name="editform" id="editform" target="_new">
											<input type="hidden" name="editpage" 			value="<?php echo $functioneditpage;?>">
											<input type="hidden" name="summarypage" 		value="<?php echo $functionsummarypage;?>">
											<input type="hidden" name="printerpage" 		value="<?php echo $functionprinterpage;?>">
											<input type="hidden" name="inspectionid" 		value="<?php echo $objarray[$adatafield[$i]];?>">
											<input type="submit" value="View Lease" name="b1" class="formsubmit">
											</form>								
																														<?php 
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
											<a href="javascript:updatewhereform('<?php echo $adatafieldtable[$i];?>.<?php echo $adatafieldid[$i];?>=<?php echo $tmpsqlwhereaddon;?>'); ">
												<font color="#000000">
																														<?php 
																														$tmp = $adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "", $tmp_previous_value);
																														////echo $tmp;																
																														break;
																												case "Object":
																														?>
											<a href="javascript:updatewhereform('<?php echo $adatafieldtable[$i];?>.<?php echo $adatafieldid[$i];?>=<?php echo $tmpsqlwhereaddon;?>'); ">
												<font color="#000000">
																														<?php 
																														$tmp = $adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "", $tmp_previous_value);
																														////echo $tmp;																
																													break;
																												case "Replacement Year":
																														?>
											<a href="javascript:updatewhereform('<?php echo $adatafieldtable[$i];?>.<?php echo $adatafieldid[$i];?>=<?php echo $tmpsqlwhereaddon;?>'); ">
												<font color="#000000">
																														<?php 
																														$tmp = $adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "", $objarray[$tblkeyfield],$objarray[$adatafield[0]]);
																														////echo $tmp;																
																													break;
																												default:
																														?>
											<a href="javascript:updatewhereform('<?php echo $adatafieldtable[$i];?>.<?php echo $adatafieldid[$i];?>=<?php echo $tmpsqlwhereaddon;?>'); ">
												<font color="#000000">
																														<?php 
																														$tmp = $adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "");																
																													break;
																											}
																										$tmp_current_value	= ($objarray[$adatafield[$i]]);
																										////echo "<br>Current Value is ".$tmp_current_value."<br>";
																										?>
													</font>
												</a>
																										<?php  
																										
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
																						<?php  
																						}
																					if ($runpostflights == 1) {
																							// Run Post flight procedures
																							?>
								<td align="right" valign="middle" class="formresults">
									<table>
										<tr>
																							<?php
																							$tblkeyvalue = $objarray[$tblkeyfield];
																							_tp_control_duplicate($tblkeyvalue, $array_duplicatecontrol, $functionduplicatepage);
																							_tp_control_archived($tblkeyvalue, $array_archivedcontrol, $functionarchievedepage);
																							_tp_control_error($tblkeyvalue, $array_errorcontrol, $functionerrorpage);
																								
																							include("includes/_template/_tp_blockform_workorder.binc.php");
																						}
																						$tmprepairid 	= '';
																						$tmprepairdate 	= '';
																						$tmprepairtime 	= '';
																						$tmpbouncedid 	= '';
																						$tmpbounceddate = '';
																						$tmpbouncedtime = '';
																						$displayrow 	= 1;
																						?>
											</tr>
										</table>
									</td>
								</tr>
																						<?php 	
																				}
																		}	// end of looped data
								
																	$displayrow = 1;

																	if ($tbldisplaytotal==1) {
																			?>
								<tr>
									<td colspan="2" align="center" valign="middle" class="formresults">
										Total
										</td>
																			<?php 
																			for ($i=0; $i<count($aheadername); $i=$i+1) {
																				
																					$total 	= $arowtotal[$i];
																					$tmpavg = ($arowtotal[$i] / $number_of_rows);
																					$tmpavg = round($tmpavg,2);
																					
																					?>
									<td align="center" valign="middle" class="formresults">
										<?php echo $arowtotal[$i];?>
										</td>
																					<?php
																				}
																			?>
									<td align="center" valign="middle" class="formresults">
										
										</td>																			
									</tr>
								<tr>
									<td colspan="2" align="center" valign="middle" class="formresults">
										Average
										</td>									
																			<?php 
																			for ($i=0; $i<count($aheadername); $i=$i+1) {
																				
																					$total 	= $arowtotal[$i];
																					$tmpavg = ($arowtotal[$i] / $number_of_rows);
																					$tmpavg = round($tmpavg,2);
																					
																					?>
									<td align="center" valign="middle" class="formresults">
																					<?php
																					if($acalculatet[$i] == 1) {
																							echo $tmpavg;
																						}
																						else {
																							// The settings say not to make a total for this entry
																						}
																						?>
										</td>
																					<?php
																				}
																			?>
									<td align="center" valign="middle" class="formresults">
										
										</td>	
									</tr>										
																			<?php
																		}	// End of Display Total
																}	// End of more than o records returned
														}	// End of Object
														?>
								</tr>
							</table>
														<?php 
										}	// end of records found statement

							?>
						</td>
					</tr>					
				</table>	<!-- end of ajax load table-->
			</td>
		</tr>
	</table>