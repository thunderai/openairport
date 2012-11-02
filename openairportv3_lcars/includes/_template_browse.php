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
		
		$div_counter 			= 0;
		$load_control_string	= '';
		
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
		//buildbreadcrumtrail($strmenuitemid,$uifrmstartdate,$uifrmenddate);
		
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
		
		$straarchivedcontrol	= urlencode(serialize($array_archivedcontrol));	// dont touch
		$strabouncedcontrol		= urlencode(serialize($array_bouncedcontrol));	// dont touch
		$straclosedcontrol		= urlencode(serialize($array_closedcontrol));	// dont touch			
		$straduplicatecontrol	= urlencode(serialize($array_duplicatecontrol));// dont touch
		$straerrorcontrol		= urlencode(serialize($array_errorcontrol));	// dont touch
		$strarepairedcontrol	= urlencode(serialize($array_repairedcontrol));	// dont touch		
		
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
	
	//ECHO "The Completed SQL Statement is <font size='1'> ".$sql."</font>";	
	
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
<div class="exportscreen" style="display: none; z-index:11;" name="exportdisplaypanel" id="exportdisplaypanel">
	<?php
	$encoded 			  = urlencode($sql);		
	$array_settings[0][0] = $function_calendar;
	$array_settings[0][1] = "".$encoded."&frmstartdate=".$uifrmstartdate."&frmenddate=".$uifrmenddate."";
	$array_settings[0][2] = 'PrinterFriendlyCalenderFormat';
	$array_settings[0][3] = $en_calendarprint;
	
	$array_settings[1][0] = $function_yearendreport;
	$array_settings[1][1] = "".$encoded."&frmstartdate=".$uifrmstartdate."&frmenddate=".$uifrmenddate."";
	$array_settings[1][2] = 'PrinterFriendlyYearEndFormat';
	$array_settings[1][3] = $en_yearendreport;
	
	$array_settings[2][0] = $function_printout;
	$array_settings[2][1] = "".$encoded."&menuitemid=".$strmenuitemid."&aheadername=".$straheadername."&adatafield=".$stradatafield."&tblkeyfield=".$tblkeyfield."&tbldatesortfield=".$tbldatesortfield."&tbldatesorttable=".$tbldatesorttable."&tbltextsortfield=".$tbltextsortfield."&tbltextsorttable=".$tbltextsorttable."&adatafieldtable=".$stradatafieldtable."&adatafieldid=".$stradatafieldid."&adataspecial=".$stradataspecial."&ainputtype=".$strainputtype."&adataselect=".$stradataselect."&tblarchivedfield=".$tblarchivedfield." ";
	$array_settings[2][2] = 'PrinterFriendlyPrintoutFormat';
	$array_settings[2][3] = $en_printerprint;
	
	$array_settings[3][0] = $function_distribution;
	$array_settings[3][1] = "startdate=".$uifrmstartdate."&enddate=".$uifrmenddate."";
	$array_settings[3][2] = 'PrinterFriendlyLoadDistFormat';
	$array_settings[3][3] = $en_distribution;
	
	$array_settings[4][0] = $function_linechart;
	$array_settings[4][1] = "startdate=".$uifrmstartdate."&enddate=".$uifrmenddate."";
	$array_settings[4][2] = 'PrinterLineChartFormat';
	$array_settings[4][3] = $en_linechart;

	$array_settings[5][0] = $function_mapit;
	$array_settings[5][1] = "startdate=".$uifrmstartdate."&enddate=".$uifrmenddate."";
	$array_settings[5][2] = 'PrinterFriendlyMapIt';
	$array_settings[5][3] = $en_mapit;
	
	$array_settings[6][0] = $function_googleearthit;
	$array_settings[6][1] = "startdate=".$uifrmstartdate."&enddate=".$uifrmenddate."";
	$array_settings[6][2] = 'PrinterFriendlyGoogleEarth';
	$array_settings[6][3] = $en_googleearthit;
	
	_tp_control_exports($array_settings);
	?>
	</div>	
	
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin:0px;padding:0px;">
	<form action="<?php echo $_SERVER["PHP_SELF"];?>"  		  name="sorttable" 			id="sorttable" 						method="POST">
	<input class="commonfieldbox"	type="hidden" name="menuitemid" 		id="menuitemid"			size="10"	value="<?php echo $_POST['menuitemid'];?>">
	<input class="commonfieldbox" 	type="hidden" name="frmurl" 			id="frmurl"				size="1"	value="<?php echo $frmurl;?>">
	<input class="combobox" 		type="hidden" name="intfrmjoined" 		id="intfrmjoined"		size="4"	value="<?php echo $intfrmjoined;?>">
	<input class="combobox" 		type="hidden" name="strsqlwhereaddon" 	id="strsqlwhereaddon"	size="55"	value="<?php echo $strsqlwhereaddon;?>">
	<input class="combobox"			type="hidden" name="intsqlwhereaddon" 	id="intsqlwhereaddon"	size="10"	value="<?php echo $intsqlwhereaddon;?>">
	<tr>
		<td class="table_bottom_sweep_tail_extended" />
				&nbsp;
				<?php
				$name 		= getnameofmenuitemid_return_nohtml($strmenuitemid, "long", 4, "#ffffff",$_SESSION['user_id']);
				$purpose	= getpurposeofmenuitemid_return_nohtml($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
				?>
			</td>
		<td class="table_browse_nameplate" />
			<?php 
				////echo "frmstartdate >".$uifrmstartdate."< <br>";
				echo $name;
				?>
			</td>	
		<td rowspan="2" class="table_browse_top_right_sweep">
			<img src="images/_interface/lcars_top_right_sweep.png">
			</td>
		</tr>
	<tr>
		<td colspan="2" rowspan="1" class="table_browse_nameplate_purpose">
			<?php
			echo $purpose;
			?>
			<div style="position:fixed; z-index:10; left:0px; top:35px; width:680px;display:none;text-align:right;vertical-align: top;border:10px solid;border-color:#000000;" name="sorting_controls" id="sorting_controls" />
			<table border="0" cellpadding="0" cellspacing="0" bgcolor="#000000" width="100%"/>
				<tr>
					<td class="table_overlay_border" />
						&nbsp;
						</td>
					<td class="table_overlay_left_bullet" onMouseover="ddrivetip('<b>Sorting Filters</b><br>You may use these controls to filter your data.');" onMouseout="hideddrivetip();"/> 
						&nbsp;
						</td>
					<td class="table_overlay_bullet_gap" />
						&nbsp;
						</td>
					<td class="table_overlay_nameplate" onMouseover="ddrivetip('<b>Sorting Filters</b><br>You may use these controls tto filter your data.');" onMouseout="hideddrivetip();"/>
						Sorting Filters
						</td>			
					<td colspan="3" class="table_overlay_border_tail" width="100" onMouseover="ddrivetip('<b>FSorting Filters</b><br>You may use these controls to filter your data.');" onMouseout="hideddrivetip();" />
						&nbsp;
						</td>			
					<td class="table_overlay_bullet_gap" />
						&nbsp;
						</td>
					<td class="table_overlay_right_bullet" onMouseover="ddrivetip('<b>Sorting Filters</b><br>You may use these controls to filter your data.');" onMouseout="hideddrivetip();"/>
						&nbsp;
						</td>
					<td class="table_overlay_border" />
						&nbsp;
						</td>
					</tr>
				<tr>
					<td colspan="10" class="table_overlay_border_slim" />
						&nbsp;
						</td>
					</tr>
				<tr>
					<td colspan="10" />
						<?php
						// Load Control Buttons
						
						_tp_control_sortby_joined($tbl_show_joinedsort		,1				,$en_joined		,$en_turned_off	,$en_active		,$en_notactive	,'frmjoined'		,'frmjoinedactive'		,'notused'		,$frmjoined);
						_tp_control_sortby_archieved($tbl_show_archivedsort	,1				,$en_archived	,$en_turned_off	,$en_active		,$en_notactive	,'frmarchives'		,'frmarchivesactive'	,'notused'		,$_POST['frmarchives']);
						_tp_control_sortby_closed($tbl_show_closedsort		,1				,$en_closed		,$en_turned_off	,$en_active		,$en_notactive	,'frmclosed'		,'frmclosedactive'		,'notused'		,$_POST['frmclosed']);
						_tp_control_sortby_duplicate($tbl_show_duplicatesort,1				,$en_duplicate	,$en_turned_off	,$en_active		,$en_notactive	,'frmduplicate'		,'frmduplicateactive'	,'notused'		,$_POST['frmduplicate']);
						_tp_control_sortby_date($tbl_show_datesort			,$tbldatesort	,$en_start_date	,$en_turned_off									,'frmstartdate'								,$uifrmstartdate,'Calendar1');
						_tp_control_sortby_date($tbl_show_datesort			,$tbldatesort	,$en_end_date	,$en_turned_off									,'frmenddate'								,$uifrmenddate	,'Calendar2');
						
						_tp_control_sortby_text($tbl_show_textsort			,$tbltextsort	,$en_textlike	,$en_turned_off									,'frmtextlike'								,$frmtextlike	,'not used');
						_tp_control_sortby_page($sql						,$sql_failsafe	,$en_select_page		,$tblpagationgroup	,'pageation'		,'formoptionpageation'	,$_POST['formoptionpageation']);
						
						?>
						</td>
					</tr>
				<tr>
					<td colspan="10" class="table_overlay_border_slim" />
						&nbsp;
						</td>
					</tr>
				<tr>
					<td class="table_overlay_border" />
						&nbsp;
						</td>
					<td class="table_overlay_left_bullet" onclick="javascript:toggle('sorting_controls');" />
						&nbsp;
						</td>
					<td class="table_overlay_bullet_gap" />
						&nbsp;
						</td>
					<td colspan="3" class="table_overlay_border_tail" onclick="javascript:toggle('sorting_controls');"/>
						&nbsp;
						</td>
					<td class="table_overlay_closeplate" onclick="javascript:toggle('sorting_controls');"/>
						Close
						</td>			
					<td class="table_overlay_bullet_gap" />
						&nbsp;
						</td>
					<td class="table_overlay_right_bullet" onclick="javascript:toggle('sorting_controls');"/>
						&nbsp;
						</td>
					<td class="table_overlay_border" />
						&nbsp;
						</td>
					</tr>
				</table>
				</div>
			</td>
		</tr>
	<tr>
		<td colspan="3" style="margin:0px;border:0px;padding:0px;"/>
			<?php
			// START MAIN BROWSE PROCEDURES
			?>
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
																	?>
			<table align="center" valign="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#000000" width="50%"/>
				<tr>
					<td class="table_overlay_border" />
						&nbsp;
						</td>
					<td class="table_overlay_left_bullet" /> 
						&nbsp;
						</td>
					<td class="table_overlay_bullet_gap" />
						&nbsp;
						</td>
					<td class="table_overlay_nameplate" />
						NO RESULTS
						</td>			
					<td colspan="3" class="table_overlay_border_tail" width="100"  />
						&nbsp;
						</td>			
					<td class="table_overlay_bullet_gap" />
						&nbsp;
						</td>
					<td class="table_overlay_right_bullet" />
						&nbsp;
						</td>
					<td class="table_overlay_border" />
						&nbsp;
						</td>
					</tr>
				<tr>
					<td colspan="10" class="table_overlay_border_slim" />
						&nbsp;
						</td>
					</tr>
				<tr>
					<td colspan="10" />
						<BR>
						<br><BR>
						<br>
						<span class="table_browse_error_text_noresults">
							NO RESULTS WERE FOUND FOR YOUR SEARCH.
							</span>
						<BR>
						<br><BR>
						<br><BR>
						<br>
						<span class="table_browse_error_text_noresults_subtext">
							It is possible results were returned but do to your filter settings they were not shown. Please adjust your settings and try again.
							</span>	
						<BR>
						<br><BR>
						<br>	
						</td>
					</tr>
				<tr>
					<td colspan="10" class="table_overlay_border_slim" />
						&nbsp;
						</td>
					</tr>
				<tr>
					<td class="table_overlay_border" />
						&nbsp;
						</td>
					<td class="table_overlay_left_bullet"  />
						&nbsp;
						</td>
					<td class="table_overlay_bullet_gap" />
						&nbsp;
						</td>
					<td colspan="3" class="table_overlay_border_tail" />
						&nbsp;
						</td>
					<td class="table_overlay_closeplate" />
						NO RESULTS
						</td>			
					<td class="table_overlay_bullet_gap" />
						&nbsp;
						</td>
					<td class="table_overlay_right_bullet" />
						&nbsp;
						</td>
					<td class="table_overlay_border" />
						&nbsp;
						</td>
					</tr>
				</table>
																	<?php
																}
																else {
																	?>
			<table border="0" cellpadding="0" cellspacing="0" width="100%" id="table1" style="margin:0px;border:0px;padding:0px;"/>
				<tr>
					<td class="table_row_header_id" onMouseover="ddrivetip('<b>Record ID</b><br>This is the ID of the record.');" onMouseout="hideddrivetip();" />
						<?php echo $en_id;?>
						</td>
					<td />
						<table style="margin:0px;border:0px;padding:0px;" width="100%" border="0" cellpadding="0" cellspacing="0" />
							<tr>
								<td colspan="3" class="table_row_header_functions" width="<?php echo $cellwidth[$i];?>" onMouseover="ddrivetip('<b>Functions</b><br>Click one of the options below to edit the report, displayh a summary report, or a printable report.');" onMouseout="hideddrivetip();"/>
									<?php echo $en_functions;?>
									</td>
								</tr>
							<tr>
								<td class="table_row_header_functions_bottom" onMouseover="ddrivetip('Edit Report')"; onMouseout="hideddrivetip();"  />
									E
									</td>
								<td class="table_row_header_functions_bottom" onMouseover="ddrivetip('Summary Report')"; onMouseout="hideddrivetip();" />
									S
									</td>
								<td class="table_row_header_functions_bottom" onMouseover="ddrivetip('Full Report')"; onMouseout="hideddrivetip();" />
									R
									</td>
							</table>
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
					<td style="margin:0px;border:0px;padding:0px;" />
																			<?php
																			if ($tblheadersort==1) {
																					?>
						<table style="margin:0px;border:0px;padding:0px;" width="100%" border="0" cellpadding="0" cellspacing="0" />
							<tr>
								<td class="table_row_header_column_top" width="<?php echo $cellwidth[$i];?>" onMouseover="ddrivetip('<b><?php echo $aheadername[$i];?></b><br>Click the sorting direction below to change direction and sort from the other direction');" onMouseout="hideddrivetip();"/>
									<?php echo $aheadername[$i];?>
									</td>
								</tr>											
							<tr>
								<td class="table_row_header_column_middle" onfocus="javascript:getvaluesortform('<?php echo $adatafield[$i];?>');" onclick="javascript:updatesortform('<?php echo $adatafield[$i];?>'); "/>
									<span class="table_row_header_column_middle_field" id="<?php echo $adatafield[$i];?>_string" name="<?php echo $adatafield[$i];?>_string" /> <?php echo $aheadersort[$i];?> </span>
									<input class="table_browse_header_field" type="hidden" size="8" id="<?php echo $adatafield[$i];?>" name="<?php echo $adatafield[$i];?>" value="<?php echo $aheadersort[$i];?>">
									</td>
								</tr>
							<tr>
								<td class="table_row_header_column_bottom" onfocus="javascript:getvaluesortform('<?php echo $adatafield[$i];?>');" onclick="javascript:updatesortform('<?php echo $adatafield[$i];?>'); " />
									&nbsp;
									</td>
							</table>
																				<?php  
																				} 
																			?>
						</td>
																			<?php 
																		}
																	if ($runpostflights == 1) {
																			// Display Classification Column
																			?>
					<td align="right" valign="top"/>
						<table bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
							<tr>
								<td class="table_button_right_side_function_light2_help" onMouseover="ddrivetip('<b><?php echo $en_submitform;?></b><br>Click the button to the right to Submit a new reqest using your defined filters');" onMouseout="hideddrivetip();"/>
									&nbsp;
									</td>
								<td class="table_button_right_side_function_gap" />
									&nbsp;
									</td>		
								<td class="table_button_right_side_function_light2" name="navigationalsidepanel" id="navigationalsidepanel" class="table_button_side_top_function" onclick="javascript:document.sorttable.submit();" />
									<?php echo $en_submitform;?> 
									</td>
								</tr>
							</table>
						<table bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
							<tr>
								<td class="table_button_right_side_function_light1_help" onMouseover="ddrivetip('<b><?php echo $en_sortingfilters;?></b><br>Click to open an overlay with filtering controls for this record');" onMouseout="hideddrivetip();"/>
									&nbsp;
									</td>
								<td class="table_button_right_side_function_gap" />
									&nbsp;
									</td>		
								<td class="table_button_right_side_function_light1" name="navigationalsidepanel" id="navigationalsidepanel" class="table_button_side_top_function" onclick="javascript:toggle('sorting_controls');" />
									<?php echo $en_sortingfilters;?> 
									</td>
								</tr>
							</table>
						</td>
																			<?php
																		}
																	?>
					</tr>
					<!-- Id say a </table> belongs in here but the code breaks-->
				</form>
			</td>
		</tr>


		
		
		
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
		<td class="table_row_id" />
			<?php echo $objarray[$tblkeyfield];?>
			<?php
			$div_counter = $div_counter + 1;
			$load_control_string = $load_control_string."Record ID : ".$objarray[$tblkeyfield]."";
			?>
			</td>
		<td width="80" class="table_row_function_container" />
			<table border="0" cellspacing="0" cellpadding="0" width="100%" height="39" id="table1">
				<tr>
					<form style="margin-bottom:0;" action="<?php echo $functioneditpage;?>" method="POST" name="editform" id="editform" target="EditRecordWindow" onsubmit="openmapchild('','EditRecordWindow')";>
					<td class="table_browse_row_functions_gaps" />
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
						<input class="table_row_function_button"	type="submit" name="b1" 				id="b1" 				value="E">
						</td>
					</form>
					<td class="table_browse_row_functions_spaces" />
						&nbsp;
						<td>
						<form style="margin-bottom:0;" action="<?php echo $functionsummarypage;?>" method="POST" name="summaryform" id="summaryform" target="SummaryReportWindow" onsubmit="openchild600('','SummaryReportWindow')";>
						<td class="table_browse_row_functions_gaps">
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
							<input class="table_row_function_button"	type="submit" name="b1" 				id="b1" 				value="S">
							</td>
						</form>
					<td class="table_browse_row_functions_spaces" />
						&nbsp;
						<td>	
						<form style="margin-bottom:0;" action="<?php echo $functionprinterpage;?>" method="POST" name="reportform" id="reportform" target="PrinterRecordWindow" onsubmit="openmapchild('','PrinterRecordWindow')";>
						<td class="table_browse_row_functions_gaps">
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
							<input class="table_row_function_button"	type="submit" name="b1" 				id="b1" 				value="R">
							</td>
						</form>
					<td class="table_browse_row_functions_spaces" />
						&nbsp;
						<td>	
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
		<td class="table_browse_row_field" width="<?php echo $cellwidth[$i];?>" >
																						<?php  
																						switch ($adatafieldid[$i]) {
																								case "notjoined":
																										switch ($adataspecial[$i]) {
																												case 2:
									$tmp = "$ ".$objarray[$adatafield[$i]]." ";
																													break;
																												case 4:
									$tmp = "@ ".$objarray[$adatafield[$i]]." ";
																													break;
																												case 5:
									$tmp = " ".$objarray[$adatafield[$i]]." % ";
																													break;
																												default:
									$tmp = " ".$objarray[$adatafield[$i]]." ";
																													break;
																											}
																											
																											echo $tmp;
																											$load_control_string = $load_control_string." ".$aheadername[$i]." :".$tmp."";
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
									<a class="table_browse_row_joinable" href="javascript:updatewhereform('<?php echo $adatafieldtable[$i];?>.<?php echo $adatafield[$i];?>=<?php echo $objarray[$adatafield[$i]];?>'); ">
										<?php 
										$tmp = $tmpcbfield;
										echo $tmp;
										?>
										</a>				
																															<?php 
																													break;
																												default:
																														$tmp_previous_value	= ($tmp_current_value);
																														$load_control_string = $load_control_string." ".$aheadername[$i]." :".$tmp."";
																														////echo "Previous Value is ".$tmp_previous_value."";
																														?>
									<a class="table_browse_row_joinable" href="javascript:updatewhereform('<?php echo $adatafieldtable[$i];?>.<?php echo $adatafield[$i];?>=<?php echo $objarray[$adatafield[$i]];?>'); ">
										<?php 
										$tmp = $objarray[$adatafield[$i]];
										echo $objarray[$adatafield[$i]];
										?>
										</a>
																														<?php 
																														$tmp_current_value	= ($objarray[$adatafield[$i]]);
																														$load_control_string = $load_control_string." ".$aheadername[$i]." :".$tmp."";
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
											<a class="table_browse_row_joinable" href="javascript:updatewhereform('<?php echo $adatafieldtable[$i];?>.<?php echo $adatafieldid[$i];?>=<?php echo $tmpsqlwhereaddon;?>'); ">
												
																														<?php 
																														$tmp = $adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "", $tmp_previous_value);
																														$load_control_string = $load_control_string." ".$aheadername[$i]." :".$tmp."";
																														////echo $tmp;																
																														break;
																												case "Object":
																														?>
											<a class="table_browse_row_joinable" href="javascript:updatewhereform('<?php echo $adatafieldtable[$i];?>.<?php echo $adatafieldid[$i];?>=<?php echo $tmpsqlwhereaddon;?>'); ">
												
																														<?php 
																														$tmp = $adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "", $tmp_previous_value);
																														$load_control_string = $load_control_string." ".$aheadername[$i]." :".$tmp."";
																														////echo $tmp;																
																													break;
																												case "Replacement Year":
																														?>
											<a class="table_browse_row_joinable" href="javascript:updatewhereform('<?php echo $adatafieldtable[$i];?>.<?php echo $adatafieldid[$i];?>=<?php echo $tmpsqlwhereaddon;?>'); ">
												
																														<?php 
																														$tmp = $adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "", $objarray[$tblkeyfield],$objarray[$adatafield[0]]);
																														$load_control_string = $load_control_string." ".$aheadername[$i]." :".$tmp."";
																														////echo $tmp;																
																													break;
																												default:
																														?>
											<a class="table_browse_row_joinable" href="javascript:updatewhereform('<?php echo $adatafieldtable[$i];?>.<?php echo $adatafieldid[$i];?>=<?php echo $tmpsqlwhereaddon;?>'); ">
												
																														<?php 
																														$tmp = $adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "");
																														$load_control_string = $load_control_string." ".$aheadername[$i]." :".$tmp."";
																																																												
																													break;
																											}
																										$tmp_current_value	= ($objarray[$adatafield[$i]]);
																										////echo "<br>Current Value is ".$tmp_current_value."<br>";
																										?>
													
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
		<td  align="right" />
			<table bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
				<tr>
					<td class="table_button_right_side_function_help" onMouseover="ddrivetip('<b>Controls</b><br>Click to open an overlay with more controls for this record');" onMouseout="hideddrivetip();"/>
						&nbsp;
						</td>
					<td class="table_button_right_side_function_gap" />
						&nbsp;
						<div style="position:absolute; z-index:10; left:0px; top:50px; width:680px;display:none;text-align:right;vertical-align: top;border:10px solid;border-color:#000000;" name="divform_<?php echo $div_counter;?>" id="divform_<?php echo $div_counter?>" />
							<table border="0" cellpadding="0" cellspacing="0" bgcolor="#000000" width="100%"/>
								<tr>
									<td class="table_overlay_border" />
										&nbsp;
										</td>
									<td class="table_overlay_left_bullet" /> 
										&nbsp;
										</td>
									<td class="table_overlay_bullet_gap" />
										&nbsp;
										</td>
									<td class="table_overlay_nameplate" onMouseover="ddrivetip('<b>Controls</b><br>Click to open an overlay with more controls for this record');" onMouseout="hideddrivetip();"/>
										Record Controls
										</td>			
									<td colspan="3" class="table_overlay_border_tail" width="100" onMouseover="ddrivetip('<b>Controls</b><br>Click to open an overlay with more controls for this record');" onMouseout="hideddrivetip();" />
										&nbsp;
										</td>			
									<td class="table_overlay_bullet_gap" />
										&nbsp;
										</td>
									<td class="table_overlay_right_bullet" onMouseover="ddrivetip('<b>Controls</b><br>Click to open an overlay with more controls for this record');" onMouseout="hideddrivetip();" />
										&nbsp;
										</td>
									<td class="table_overlay_border" />
										&nbsp;
										</td>
									</tr>
								<tr>
									<td colspan="10" class="table_overlay_border_slim" />
										&nbsp;
										</td>
									</tr>
								<tr>
									<td colspan="10" />								
										<?php
											$tblkeyvalue = $objarray[$tblkeyfield];
											_tp_control_duplicate($tblkeyvalue, $array_duplicatecontrol, $functionduplicatepage);
											_tp_control_archived($tblkeyvalue, $array_archivedcontrol, $functionarchievedepage);
											_tp_control_error($tblkeyvalue, $array_errorcontrol, $functionerrorpage);
											
											include("includes/_template/_tp_blockform_workorder_browser.binc.php");
											?>
								<tr>
									<td colspan="10" class="table_overlay_border_slim" />
										&nbsp;
										</td>
									</tr>
								<tr>
									<td class="table_overlay_border" />
										&nbsp;
										</td>
									<td class="table_overlay_left_bullet" onclick="javascript:toggle('divform_<?php echo $div_counter;?>');" />
										&nbsp;
										</td>
									<td class="table_overlay_bullet_gap" />
										&nbsp;
										</td>
									<td colspan="3" class="table_overlay_border_tail" onclick="javascript:toggle('divform_<?php echo $div_counter;?>');"/>
										&nbsp;
										</td>
									<td class="table_overlay_closeplate" onclick="javascript:toggle('divform_<?php echo $div_counter;?>');"/>
										Close
										</td>			
									<td class="table_overlay_bullet_gap" />
										&nbsp;
										</td>
									<td class="table_overlay_right_bullet" onclick="javascript:toggle('divform_<?php echo $div_counter;?>');"/>
										&nbsp;
										</td>
									<td class="table_overlay_border" />
										&nbsp;
										</td>
									</tr>
								</table>
							</div>
						</td>		
					<td class="table_button_right_side_function" class="table_button_side_top_function" onclick="javascript:call_server_load_controls('<?php echo $whoareyou;?>','<?php echo $load_control_string;?>');toggle2('divform_<?php echo $div_counter;?>','<?php echo $tblpagationgroup;?>');"/>
						<?php echo $en_open_commands;?> 
						</td>
					</tr>
				</table>
																							<?php
																							$tblkeyvalue = $objarray[$tblkeyfield];
																							//_tp_control_duplicate($tblkeyvalue, $array_duplicatecontrol, $functionduplicatepage);
																							//_tp_control_archived($tblkeyvalue, $array_archivedcontrol, $functionarchievedepage);
																							//_tp_control_error($tblkeyvalue, $array_errorcontrol, $functionerrorpage);
																								
																							//include("includes/_template/_tp_blockform_workorder.binc.php");
																						?>
																						
																						<?php
																						
																						}
																						$tmprepairid 	= '';
																						$tmprepairdate 	= '';
																						$tmprepairtime 	= '';
																						$tmpbouncedid 	= '';
																						$tmpbounceddate = '';
																						$tmpbouncedtime = '';
																						$load_control_string = '';
																						$displayrow 	= 1;
																						?>
					</td>
				</tr>
							
																						<?php 	
																				}
																		}	// end of looped data
								
																	$displayrow = 1;

																	if ($tbldisplaytotal==1) {
																			?>
			<tr>
				<td colspan="2" align="center" valign="middle" class="forms_coumn_results_row">
					Total
					</td>
																			<?php 
																			for ($i=0; $i<count($aheadername); $i=$i+1) {
																				
																					$total 	= $arowtotal[$i];
																					$tmpavg = ($arowtotal[$i] / $number_of_rows);
																					$tmpavg = round($tmpavg,2);
																					
																					?>
				<td align="center" valign="middle" class="forms_coumn_results_row">
					<?php echo $arowtotal[$i];?>
					</td>
																					<?php
																				}
																			?>
					<td align="center" valign="middle" class="forms_coumn_results_row">
													
						</td>																			
					</tr>
				<tr>
					<td colspan="2" align="center" valign="middle" class="forms_coumn_results_row">
						Average
						</td>									
																			<?php 
																			for ($i=0; $i<count($aheadername); $i=$i+1) {
																				
																					$total 	= $arowtotal[$i];
																					$tmpavg = ($arowtotal[$i] / $number_of_rows);
																					$tmpavg = round($tmpavg,2);
																					
																					?>
					<td align="center" valign="middle" class="forms_coumn_results_row">
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
					<td align="center" valign="middle" class="forms_coumn_results_row">
										
						</td>		
		<?php 
		if($number_of_rows == 0 ){
				?>
					</tr>
				</table>	
				<?php
			}

																		}	// End of Display Total
																}	// End of more than o records returned
														}	// End of Object
		if($number_of_rows != 0 ){
				?>
					</tr>
				</table>	
				<?php
			}

										}	// end of records found statement
										?>			
			<?php
			// END MAIN BROWSE PROCEDURES
			?>			
			</td>
		</tr>
	<tr>
		<td colspan="2" name="recordrowcontrols" id="recordrowcontrols" />
			&nbsp;
			</td>	
		<td rowspan="2">
			<img src="images/_interface/lcars_bottom_right_sweep.png">
			</td>
		</tr>
	<tr>
		<td colspan="2" align="right" class="table_bottom_bottom_sweep_tail_extended" />
			<?php
			_tp_control_function_utilities('exportdisplaypanel','toggle',$en_form_exports);
			_tp_control_function_quickaccess($en_quickaccess_f	,$strmenuitemid	,$_SESSION["user_id"]	,'quickaccess'		,'frmfunctionqac'	,'frmfunctionqac'		,$en_quickaccess,				$en_quickaccessno	,'frmfunctionqacactive');
			_tp_control_function_filters('sorting_controls','toggle','Filters');
			_tp_control_function_submit();
			?>
			</td>			
		</tr>					
	</table>
	<font size="1"><br><br><br></font>
	</div>
<br>
<br>