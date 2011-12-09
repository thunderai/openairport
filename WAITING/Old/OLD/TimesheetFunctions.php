<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	TimeSheet Functions.php				The purpose of this page is to load Functions used in the TimeSheet Module of the system
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	

function updatetimesheetweekdata($set, $week, $mainid, $weekid) {
	// The purpose of this function is to take a given i, j, and k value and save them to the tbl_timesheets_sub_w table as part of the tbl_timesheets_main record
	
	$tmp	= "set".$set."week".$week."_day";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$a	= $tmpvalue;

	$tmp	= "set".$set."week".$week."_date";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$b	= $tmpvalue;
	
	$tmp	= "set".$set."week".$week."_notes";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= "";
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$c	= $tmpvalue;
	
	$tmp	= "set".$set."week".$week."_reg_hours";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$d	= $tmpvalue;
	
	$tmp	= "set".$set."week".$week."_hol_hours";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$e	= $tmpvalue;	
	
	$tmp	= "set".$set."week".$week."_hol_pay";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$f	= $tmpvalue;	
	
	$tmp	= "set".$set."week".$week."_ot";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$g	= $tmpvalue;	
	
	$tmp	= "set".$set."week".$week."_dt";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$h	= $tmpvalue;
	
	$tmp	= "set".$set."week".$week."_vl";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$i	= $tmpvalue;	
	
	$tmp	= "set".$set."week".$week."_sl";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$j	= $tmpvalue;
	
	$tmp	= "set".$set."week".$week."_ce";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$k	= $tmpvalue;
	
	$tmp	= "set".$set."week".$week."_ct";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$l	= $tmpvalue;
	
	
	$sql 	= "UPDATE tbl_timesheets_sub_w SET
											time_sheet_parent='".$mainid."', 
											week1_stringname='set".$set."week".$week."', 
											week1_day='".$a."',
											week1_date='".$b."',
											week1_notes='".$c."',
											week1_reg_hours='".$d."',
											week1_hol_hours='".$e."', 
											week1_hol_pay='".$f."', 
											week1_ot='".$g."',
											week1_dt='".$h."', 
											week1_vl='".$i."',
											week1_sl='".$j."', 
											week1_ce='".$k."', 
											week1_ct='".$l."'
			WHERE week_id = '".$weekid."' ";
						
	//echo $sql;
	
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs_support 	= mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
						$lastid 	= mysqli_insert_id($objconn_support);
						$k		= $lastid;
						//echo $tmp;
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($objconn_support);
						//mysqli_free_result($objrs_support);
						mysqli_close($objconn_support);
						}						
	}
	
function displaytimesheetweek_edit($set, $week, $weekend, $recordid) {
	// The purpose of this function is to generate all the nessary information to display on the timesheet
	
	// with the given information we need to construct an SQL statement that will get the information we are looking for.
	//start with week1_stringname
	
	$tmpstringname	= "set".$set."week".$week."";																	// Should look something like set1,set2,set3,set4, and set5
	
	$sql			= "SELECT * FROM tbl_timesheets_sub_w
				WHERE time_sheet_parent = '".$recordid."' AND week1_stringname like '%".$tmpstringname."%' ";
	
	//echo $sql;
	
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
						
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {	
							?>
	<tr>
		<td class="formoptions">
			<input class="commonfieldbox" 		type="hidden" 	name="set<?=$set;?>week<?=$week;?>_id" 		size="10" 	value="<?=$objfields['week_id'];?>">
			&nbsp;<input class="commonfieldbox" type="text" 	name="set<?=$set;?>week<?=$week;?>_day" 	size="10" 	value="<?=$objfields['week1_day'];?>">
			</td>
		<td class="formoptions">
			&nbsp;<input class="commonfieldbox" type="text" 	name="set<?=$set;?>week<?=$week;?>_date" 	size="5" 	value="<?=$objfields['week1_date'];?>">
			</td>
		<td class="formanswers">
			&nbsp;<input class="commonfieldbox" type="text" 	name="set<?=$set;?>week<?=$week;?>_notes" 	size="20" 	value="<?=$objfields['week1_notes'];?>">
			</td>			
	<?	
	// To deermine if this row is a holiday we need to split the value in $objfields['week1_date'] into two variables, seperated by the / char
		$atmpdate		= split("/", $objfields['week1_date']);
		$holiday		= istodayaholiday($atmpdate[0],$atmpdate[1]);
		if ($holiday == 0 ) {
				if ($weekend == 0) {
						// Not a holiday or a weekend
						$formclass		= "formanswers_multicolumn";
						$ddrivetip		= "";
					}
					else {
						// Not a holiday, but is a weekend
						$formclass		= "formanswers_weekend";
						$ddrivetip		= "This day is part of the weekend!";
					}
			}
			else {
				$holiday 		= 1;
				$formclass		= "formanswers_holiday";
				$ddrivetip		= "Today is a holiday!";
			}
			?>
		<td class="<?=$formclass;?>" 
		<?
		if ($ddrivetip == "") {
				// Dont display Tool Tip
			}
			else {
				?>		
										onMouseover="ddrivetip('<?=$ddrivetip;?>')"; onMouseout="hideddrivetip()"
				<?
			}
			?>
			>
			&nbsp;<input class="commonfieldbox" type="text" name="set<?=$set;?>week<?=$week;?>_reg_hours" size="1" value="<?=$objfields['week1_reg_hours'];?>">
			</td>
		<td class="<?=$formclass;?>" 
		<?
		if ($ddrivetip == "") {
				// Dont display Tool Tip
			}
			else {
				?>		
										onMouseover="ddrivetip('<?=$ddrivetip;?>')"; onMouseout="hideddrivetip()"
				<?
			}
			?>		
			>
			&nbsp;<input class="commonfieldbox" type="text" name="set<?=$set;?>week<?=$week;?>_hol_hours" size="1" value="<?=$objfields['week1_hol_hours'];?>">
			</td>
		<td class="<?=$formclass;?>" 
		<?
		if ($ddrivetip == "") {
				// Dont display Tool Tip
			}
			else {
				?>		
										onMouseover="ddrivetip('<?=$ddrivetip;?>')"; onMouseout="hideddrivetip()"
				<?
			}
			?>		
			>
			&nbsp;<input class="commonfieldbox" type="text" name="set<?=$set;?>week<?=$week;?>_hol_pay" size="1" value="<?=$objfields['week1_hol_pay'];?>">
			</td>
		<td class="<?=$formclass;?>" 
		<?
		if ($ddrivetip == "") {
				// Dont display Tool Tip
			}
			else {
				?>		
										onMouseover="ddrivetip('<?=$ddrivetip;?>')"; onMouseout="hideddrivetip()"
				<?
			}
			?>	
			>			
			&nbsp;<input class="commonfieldbox" type="text" name="set<?=$set;?>week<?=$week;?>_ot" size="1" value="<?=$objfields['week1_ot'];?>">
			</td>
		<td class="<?=$formclass;?>" 
		<?
		if ($ddrivetip == "") {
				// Dont display Tool Tip
			}
			else {
				?>		
										onMouseover="ddrivetip('<?=$ddrivetip;?>')"; onMouseout="hideddrivetip()"
				<?
			}
			?>	
			>			
			&nbsp;<input class="commonfieldbox" type="text" name="set<?=$set;?>week<?=$week;?>_dt" size="1" value="<?=$objfields['week1_dt'];?>">
			</td>
		<td class="<?=$formclass;?>" 
		<?
		if ($ddrivetip == "") {
				// Dont display Tool Tip
			}
			else {
				?>		
										onMouseover="ddrivetip('<?=$ddrivetip;?>')"; onMouseout="hideddrivetip()"
				<?
			}
			?>
			>
			&nbsp;<input class="commonfieldbox" type="text" name="set<?=$set;?>week<?=$week;?>_vl" size="1" value="<?=$objfields['week1_vl'];?>">
			</td>
		<td class="<?=$formclass;?>" 
		<?
		if ($ddrivetip == "") {
				// Dont display Tool Tip
			}
			else {
				?>		
										onMouseover="ddrivetip('<?=$ddrivetip;?>')"; onMouseout="hideddrivetip()"
				<?
			}
			?>		
			>
			&nbsp;<input class="commonfieldbox" type="text" name="set<?=$set;?>week<?=$week;?>_sl" size="1" value="<?=$objfields['week1_sl'];?>">
			</td>
		<td class="<?=$formclass;?>" 
		<?
		if ($ddrivetip == "") {
				// Dont display Tool Tip
			}
			else {
				?>		
										onMouseover="ddrivetip('<?=$ddrivetip;?>')"; onMouseout="hideddrivetip()"
				<?
			}
			?>	
			>
			&nbsp;<input class="commonfieldbox" type="text" name="set<?=$set;?>week<?=$week;?>_ce" size="1" value="<?=$objfields['week1_ce'];?>">
			</td>
		<td class="<?=$formclass;?>" 
		<?
		if ($ddrivetip == "") {
				// Dont display Tool Tip
			}
			else {
				?>		
										onMouseover="ddrivetip('<?=$ddrivetip;?>')"; onMouseout="hideddrivetip()"
				<?
			}
			?>		
			>
			&nbsp;<input class="commonfieldbox" type="text" name="set<?=$set;?>week<?=$week;?>_ct" size="1" value="<?=$objfields['week1_ct'];?>">
			</td>
		</tr>
		<?	
						}	// End of While Loop
						mysqli_free_result($objrs_support);
						mysqli_close($objconn_support);
				}				
		}		
	}	// End of Function

function displaytimesheettotal($aweektotoal) {
	// The purpose of this function is to display the given total on the report
	//echo "week totoal: ".$aweektotoal;
	?>
	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" id="AutoNumber1" >
		<tr>
			<td width="237" colspan="3" height="27">
				&nbsp;
				</td>
			<td width="44" align="center">
				<font size="1" COLOR="#000000">
					<?=$aweektotoal[0];?>
					</font>
				</td>
			<td width="44" align="center">
				<font size="1" COLOR="#000000">
					<?=$aweektotoal[1];?>
					</font>				
				</td>
			<td width="44" align="center">
				<font size="1" COLOR="#000000">
					<?=$aweektotoal[2];?>
					</font>				
				</td>
			<td width="42" align="center">
				<font size="1" COLOR="#000000">
					<?=$aweektotoal[3];?>
					</font>				
				</td>
			<td width="42" align="center">
				<font size="1" COLOR="#000000">
					<?=$aweektotoal[4];?>
					</font>				
				</td>
			<td width="42" align="center">
				<font size="1" COLOR="#000000">
					<?=$aweektotoal[5];?>
					</font>				
				</td>
			<td width="42" align="center">
				<font size="1" COLOR="#000000">
					<?=$aweektotoal[6];?>
					</font>				
				</td>
			<td width="42" align="center">
				<font size="1" COLOR="#000000">
					<?=$aweektotoal[7];?>
					</font>				
				</td>
			<td width="42" align="center">
				<font size="1" COLOR="#000000">
					<?=$aweektotoal[8];?>
					</font>				
				</td>
			</tr>
		</table>
		<?
	}

function displaytimesheetweek($set, $systemuser, $recordid) {
	// The purpose of this function is to generate all the nessary information to display on the timesheet
	
	// with the given information we need to construct an SQL statement that will get the information we are looking for.
	//start with week1_stringname
	
	$tmpstringname	= "set".$set."";																	// Should look something like set1,set2,set3,set4, and set5
	
	$sql			= "SELECT * FROM tbl_timesheets_sub_w
				WHERE time_sheet_parent = '".$recordid."' AND week1_stringname like '%".$tmpstringname."%' ";
	
	//echo $sql;
	
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
						
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					?>
	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" id="AutoNumber1" >
					<?
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {	
							?>
		<tr>
			<td width="68" align="center" height="15">
				<font size="1" COLOR="#000000">
					<?=$objfields['week1_day'];?>
					</font>
				</td>
			<td width="49" align="center">
				<font size="1" COLOR="#000000">
					<?=$objfields['week1_date'];?>
					</font>
				</td>
			<td width="120" align="center">
				<font size="1" COLOR="#000000">
					<?=$objfields['week1_notes'];?>
					</font>
				</td>
			<td width="44" align="center">
				<font size="1" COLOR="#000000">
					<?
					if ($objfields['week1_reg_hours'] == 0) {
							// No reason to flood the report with meaningless zeros
						}
						else {
							echo $objfields['week1_reg_hours'];
						}
					$reg_hours_sub_total = ($reg_hours_sub_total + $objfields['week1_reg_hours']);					
					?>
					</font>
				</td>
			<td width="44" align="center">
				<font size="1" COLOR="#000000">
					<?
					if ($objfields['week1_hol_hours'] == 0) {
							// No reason to flood the report with meaningless zeros
						}
						else {
							echo $objfields['week1_hol_hours'];
						}
					$hol_hours_sub_total = ($hol_hours_sub_total + $objfields['week1_hol_hours']);					
					?>
					</font>				
				</td>
			<td width="44" align="center">
				<font size="1" COLOR="#000000">
					<?
					if ($objfields['week1_hol_pay'] == 0) {
							// No reason to flood the report with meaningless zeros
						}
						else {
							echo $objfields['week1_hol_pay'];
						}
					$hol_pay_sub_total = ($hol_pay_sub_total + $objfields['week1_hol_pay']);					
					?>
					</font>				
				</td>
			<td width="42" align="center">
				<font size="1" COLOR="#000000">
					<?
					if ($objfields['week1_ot'] == 0) {
							// No reason to flood the report with meaningless zeros
						}
						else {
							echo $objfields['week1_ot'];
						}
					$ot_sub_total = ($ot_sub_total + $objfields['week1_ot']);					
					?>
					</font>				
				</td>
			<td width="42" align="center">
				<font size="1" COLOR="#000000">
					<?
					if ($objfields['week1_dt'] == 0) {
							// No reason to flood the report with meaningless zeros
						}
						else {
							echo $objfields['week1_dt'];
						}
					$dt_sub_total = ($dt_sub_total + $objfields['week1_dt']);					
					?>
					</font>				
				</td>
			<td width="42" align="center">
				<font size="1" COLOR="#000000">
					<?
					if ($objfields['week1_vl'] == 0) {
							// No reason to flood the report with meaningless zeros
						}
						else {
							echo $objfields['week1_vl'];
						}
					$vl_sub_total = ($vl_sub_total + $objfields['week1_vl']);					
					?>
					</font>				
				</td>
			<td width="42" align="center">
				<font size="1" COLOR="#000000">
					<?
					if ($objfields['week1_sl'] == 0) {
							// No reason to flood the report with meaningless zeros
						}
						else {
							echo $objfields['week1_sl'];
						}
					$sl_sub_total = ($sl_sub_total + $objfields['week1_sl']);					
					?>
					</font>				
				</td>
			<td width="42" align="center">
				<font size="1" COLOR="#000000">
					<?
					if ($objfields['week1_ce'] == 0) {
							// No reason to flood the report with meaningless zeros
						}
						else {
							echo $objfields['week1_ce'];
						}
					$ce_sub_total = ($ce_sub_total + $objfields['week1_ce']);					
					?>
					</font>				
				</td>
			<td width="42" align="center">
				<font size="1" COLOR="#000000">
					<?
					if ($objfields['week1_ct'] == 0) {
							// No reason to flood the report with meaningless zeros
						}
						else {
							echo $objfields['week1_ct'];
						}
					$ct_sub_total = ($ct_sub_total + $objfields['week1_ct']);					
					?>
					</font>				
				</td>
			</tr>
						<?					
						}
						mysqli_free_result($objrs_support);
						mysqli_close($objconn_support);
						?>
		<tr>
			<td colspan="3" height="27">
				&nbsp;
				</td>
			<td align="center">
				<font size="1" COLOR="#000000">
					<?=$reg_hours_sub_total;?>
					</font>
				</td>
			<td align="center">
				<font size="1" COLOR="#000000">
					<?=$hol_hours_sub_total;?>
					</font>				
				</td>
			<td align="center">
				<font size="1" COLOR="#000000">
					<?=$hol_pay_sub_total;?>
					</font>				
				</td>
			<td align="center">
				<font size="1" COLOR="#000000">
					<?=$ot_sub_total;?>
					</font>				
				</td>
			<td align="center">
				<font size="1" COLOR="#000000">
					<?=$dt_sub_total;?>
					</font>				
				</td>
			<td align="center">
				<font size="1" COLOR="#000000">
					<?=$vl_sub_total;?>
					</font>				
				</td>
			<td align="center">
				<font size="1" COLOR="#000000">
					<?=$sl_sub_total;?>
					</font>				
				</td>
			<td align="center">
				<font size="1" COLOR="#000000">
					<?=$ce_sub_total;?>
					</font>				
				</td>
			<td align="center">
				<font size="1" COLOR="#000000">
					<?=$ct_sub_total;?>
					</font>				
				</td>
			</tr>
		</table>
						<?
				}
		}
		
		$aweeksubtotal[0]		= $reg_hours_sub_total;
		$aweeksubtotal[1]		= $hol_hours_sub_total;
		$aweeksubtotal[2]		= $hol_pay_sub_total;
		$aweeksubtotal[3]		= $ot_sub_total;
		$aweeksubtotal[4]		= $dt_sub_total;
		$aweeksubtotal[5]		= $vl_sub_total;
		$aweeksubtotal[6]		= $sl_sub_total;
		$aweeksubtotal[7]		= $ce_sub_total;
		$aweeksubtotal[8]		= $ct_sub_total;
		
	return $aweeksubtotal;
	
	}
	
function Savetimesheetweekdata($set, $week, $mainid) {
	// The purpose of this function is to take a given i, j, and k value and save them to the tbl_timesheets_sub_w table as part of the tbl_timesheets_main record
	
	$tmp	= "set".$set."week".$week."_day";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$a	= $tmpvalue;

	$tmp	= "set".$set."week".$week."_date";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$b	= $tmpvalue;
	
	$tmp	= "set".$set."week".$week."_notes";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= "";
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$c	= $tmpvalue;
	
	$tmp	= "set".$set."week".$week."_reg_hours";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$d	= $tmpvalue;
	
	$tmp	= "set".$set."week".$week."_hol_hours";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$e	= $tmpvalue;	
	
	$tmp	= "set".$set."week".$week."_hol_pay";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$f	= $tmpvalue;	
	
	$tmp	= "set".$set."week".$week."_ot";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$g	= $tmpvalue;	
	
	$tmp	= "set".$set."week".$week."_dt";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$h	= $tmpvalue;
	
	$tmp	= "set".$set."week".$week."_vl";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$i	= $tmpvalue;	
	
	$tmp	= "set".$set."week".$week."_sl";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$j	= $tmpvalue;
	
	$tmp	= "set".$set."week".$week."_ce";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$k	= $tmpvalue;
	
	$tmp	= "set".$set."week".$week."_ct";
	if ($_POST[$tmp] == "") {
			// There is no value from the form
			$tmpvalue		= 0;
		}
		else {
			$tmpvalue		= $_POST[$tmp];
		}
	$l	= $tmpvalue;
	
	$sql 	= "INSERT INTO tbl_timesheets_sub_w 
											(
											time_sheet_parent, 
											week1_stringname, 
											week1_day, 
											week1_date, 
											week1_notes, 
											week1_reg_hours, 
											week1_hol_hours, 
											week1_hol_pay, 
											week1_ot, 
											week1_dt, 
											week1_vl, 
											week1_sl, 
											week1_ce, 
											week1_ct
											)
			VALUES
											( '".$mainid."', 'set".$set."week".$week."', '".$a."', '".$b."', '".$c."', '".$d."', '".$e."', '".$f."', '".$g."', '".$h."', '".$i."', '".$j."', '".$k."', '".$l."' )"; 								
											
	//echo $sql;
	
$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs_support 	= mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
						$lastid 	= mysqli_insert_id($objconn_support);
						$k		= $lastid;
						//echo $tmp;
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($objconn_support);
						//mysqli_free_result($objrs_support);
						//mysqli_close($objconn_support);
						}					
							
	}

function drawtimesheetcell($cellname, $holiday, $weekend) {
	// Purpose of thif function is to take a given cell and draw it depended upon if it is a holiday or not.
	// $weekend is either a 1 or a 0. 0 = Not a weekend, 1 = is a weekend.
	
	if ($holiday == 0) {
			if ($weekend == 0) {
					// Not a holiday or a weekend
					?>
					<td class="formanswers_multicolumn">
					<?
				}
				else {
					// Not a holiday, but is a weekend
					?>
					<td class="formanswers_weekend" onMouseover="ddrivetip('This day is part of the weekend!')"; onMouseout="hideddrivetip()">
					<?
				}
		}
		else {			
			?>
			<td class="formanswers_holiday" onMouseover="ddrivetip('Today is a Holiday!')"; onMouseout="hideddrivetip()">
			<?
		}
		?>
				&nbsp;<input class="commonfieldbox" type="text" name="<?=$cellname;?>" size="1">
				</td>
		<?
	}	

function isholidayinperiod($timesheetmonth_id) {
	// Purpose of this function is to make a list of the holidays durring this period
	
	$number_of_rows	= "";																			// Used to count the number of holidays returned.
	$holidaystring	= "";
	
	$sql 		= "SELECT 
						tbl_timesheets_sub_h.holiday_name, 
						tbl_timesheets_sub_h.holiday_day,
						tbl_timesheets_sub_h.holiday_name_short, 
						tbl_timesheets_sub_m.timesheetmonth_paystart, 
						tbl_timesheets_sub_m.timesheetmonth_payend, 
						tbl_timesheets_sub_m.timesheetmonth_month_cb_int, 
						tbl_general_months.months_number
				FROM tbl_timesheets_sub_h 
				INNER JOIN tbl_general_months ON tbl_general_months.months_id = tbl_timesheets_sub_h.holiday_month_cb_int 
				INNER JOIN tbl_timesheets_sub_m ON tbl_timesheets_sub_m.timesheetmonth_month_cb_int = tbl_general_months.months_id
				WHERE tbl_timesheets_sub_m.timesheetmonth_id = '".$timesheetmonth_id."' AND tbl_timesheets_sub_m.timesheetmonth_paystart <= tbl_timesheets_sub_h.holiday_day 
				ORDER BY holiday_name, holiday_name_short";
			
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmpstring		= $objfields['holiday_name_short'];
							$holidaystring 	= $holidaystring." ".$tmpstring." ";
						}
						mysqli_free_result($objrs_support);
						mysqli_close($objconn_support);
				}
		}
	// return a string that looks like
	#H:( List of shortname holidays seperated by comas )
	$tmpstring_front		= $number_of_rows." H:(<font size=1>".$holidaystring."</font>)";
	return $tmpstring_front;
	}
	
function istodayaholiday($current_timesheet_month,$tmpdayofmonth) {
	// Purpose of this function is to determine if the given month and day are a holiday. To do this we need to get the information from the tbl_timesheets_sub_h
	
	$number_of_rows	= "";																			// Used to count the number of holidays returned.
	
	$sql 		= "SELECT * FROM tbl_timesheets_sub_h 
				INNER JOIN tbl_general_months ON tbl_general_months.months_id = tbl_timesheets_sub_h.holiday_month_cb_int 
				WHERE tbl_general_months.months_number = '".$current_timesheet_month."' AND tbl_timesheets_sub_h.holiday_day = '".$tmpdayofmonth."' 
				ORDER BY holiday_name";
			
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
						}
						mysqli_free_result($objrs_support);
						mysqli_close($objconn_support);
				}
		}
			
	return $number_of_rows;
	}

function timesheetmonthscombobox($suppliedid, $archived, $nameofinput, $showcombobox, $default) {
	// $suppliedid		, is the number of the group to do the search for ;
	// $archived		, do you want to list all menu items, or just the archived ones;
	// $nameofinout		, what is the name of the select box that 'could' be ceated by this function;
	// $showcombobox	, Do you want to show the combo box select input style or just the text without the input box;
	// $default			, What is the default group to display in the combobox when it is displayed;

	// Examples
	
	//	$adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "");
	// This example will only show one record, and it will not be in a combobox input box, but rather be displayed as text.
	
	//echo "Sipplied ID".$suppliedid;
	//echo "Sipplied ID".$default;
	
	$sql		= "";																				// Define the sql variable, just in case
	$nsql 	= "";																				// Define the nsql variable, just in case
	
	$tmp_date	= date('Y');
	
	$sql	 	= "SELECT * FROM tbl_timesheets_sub_m
			INNER JOIN tbl_general_months ON tbl_general_months.months_id = tbl_timesheets_sub_m.timesheetmonth_month_cb_int ";

			//echo $sql;// start the SQL Statement with the common syntax

	if ($suppliedid=="all") {																		// if supplied 'all' for the menu_id so the following
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;																	// important to tell the procedures below this happened
		}
		else {
			$nsql = "WHERE `timesheetmonth_id` = ".$suppliedid." ";										// if supplied a menu_id, then add it to the SQL Statement
			$sql = $sql.$nsql;																	// combine the nsql and sql strings
			$tmp_flagger = 1;																	// important to tell the procedures below this happened
		}

	if ($archived == "all") {																	// if supplied 'all' for the archived variable do the following
																								// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {																// If archived is 'yes' then
					if ($tmp_flagger==0) {
							$nsql = "WHERE timesheetmonth_archived_yn = 1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND timesheetmonth_archived_yn = 1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE timesheetmonth_archived_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND timesheetmonth_archived_yn = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	$sql = $sql."ORDER BY timesheetmonth_year, months_number ";
	//echo $sql;
	
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					if ($showcombobox=="show") {
							?>
	<SELECT class="Commonfieldbox" name="<?=$nameofinput?>">
					<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmpsuppliedid 			= $objfields['timesheetmonth_id'];
							$tmpsuppliedname 		= $objfields['months_name'];
							$tmpsuppliednameyear 		= $objfields['timesheetmonth_year'];
							$tmpsuppliedarch		= $objfields['timesheetmonth_archived_yn'];
							
						if ($showcombobox=="show") {
								?>
		<option 
								<?
							}
							if ($suppliedid = "all") {
									$intsuppliedid	= (double) $default;
									if ($tmpsuppliedid == $intsuppliedid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?
												}
										}
										else {
											// There is no user specified so we dont need to set a defualt value
										}
								}
								else {
								
								}
								if ($showcombobox=="show") {
										?>
				value="<?=$tmpsuppliedid;?>"><?=$tmpsuppliednameyear;?> - <?=$tmpsuppliedname;?></option>
										<?
									}
									else {
										?>
				<?=$tmpsuppliednameyear;?> - <?=$tmpsuppliedname?>
										<?
									}
								}	// End of while loop
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?
									}
						}	// end of Res Record Object						
				}
	}

function timesheetmonthscombobox_limit($suppliedid, $archived, $nameofinput, $showcombobox, $default) {
	// $suppliedid		, is the number of the group to do the search for ;
	// $archived		, do you want to list all menu items, or just the archived ones;
	// $nameofinout		, what is the name of the select box that 'could' be ceated by this function;
	// $showcombobox	, Do you want to show the combo box select input style or just the text without the input box;
	// $default			, What is the default group to display in the combobox when it is displayed;

	// Examples
	
	//	$adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "");
	// This example will only show one record, and it will not be in a combobox input box, but rather be displayed as text.
	
	//echo "Sipplied ID".$suppliedid;
	//echo "Sipplied ID".$default;
	
	$sql		= "";																				// Define the sql variable, just in case
	$nsql 	= "";																				// Define the nsql variable, just in case
	
	$tmp_date	= date('Y');
	
	$sql	 	= "SELECT * FROM tbl_timesheets_sub_m
			INNER JOIN tbl_general_months ON tbl_general_months.months_id = tbl_timesheets_sub_m.timesheetmonth_month_cb_int 
			WHERE timesheetmonth_year = ".$tmp_date." ";

			//echo $sql;// start the SQL Statement with the common syntax

	if ($suppliedid=="all") {																		// if supplied 'all' for the menu_id so the following
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;																	// important to tell the procedures below this happened
		}
		else {
			$nsql = "WHERE `timesheetmonth_id` = ".$suppliedid." ";										// if supplied a menu_id, then add it to the SQL Statement
			$sql = $sql.$nsql;																	// combine the nsql and sql strings
			$tmp_flagger = 1;																	// important to tell the procedures below this happened
		}

	if ($archived == "all") {																	// if supplied 'all' for the archived variable do the following
																								// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {																// If archived is 'yes' then
					if ($tmp_flagger==0) {
							$nsql = "WHERE timesheetmonth_archived_yn = 1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND timesheetmonth_archived_yn = 1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE timesheetmonth_archived_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND timesheetmonth_archived_yn = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	$sql = $sql."ORDER BY timesheetmonth_year, months_number ";
	//echo $sql;
	
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					if ($showcombobox=="show") {
							?>
	<SELECT class="Commonfieldbox" name="<?=$nameofinput?>">
					<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmpsuppliedid 			= $objfields['timesheetmonth_id'];
							$tmpsuppliedname 		= $objfields['months_name'];
							$tmpsuppliednameyear 		= $objfields['timesheetmonth_year'];
							$tmpsuppliedarch		= $objfields['timesheetmonth_archived_yn'];
							
						if ($showcombobox=="show") {
								?>
		<option 
								<?
							}
							if ($suppliedid = "all") {
									$intsuppliedid	= (double) $default;
									if ($tmpsuppliedid == $intsuppliedid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?
												}
										}
										else {
											// There is no user specified so we dont need to set a defualt value
										}
								}
								else {
								
								}
								if ($showcombobox=="show") {
										?>
				value="<?=$tmpsuppliedid;?>"><?=$tmpsuppliednameyear;?> - <?=$tmpsuppliedname;?></option>
										<?
									}
									else {
										?>
				<?=$tmpsuppliednameyear;?> - <?=$tmpsuppliedname?>
										<?
									}
								}	// End of while loop
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?
									}
						}	// end of Res Record Object						
				}
	}

?>
