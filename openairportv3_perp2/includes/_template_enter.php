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
//	Name of Document	:	_template_enter.php
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

// Functions
function form_uni_control($fieldname,$fieldvalue) {
		// Function takes the given inputs and creates FORM INPUTS with the name and value and makes it hidden for use on any form you want.
		?>
	<input type="hidden" name="<?php echo $fieldname;?>" id="<?php echo $fieldname;?>" value="<?php echo $fieldvalue;?>" />
		<?php
	}
	
function form_new_table_b($fieldname) {
		// Function takes the given inputs and creates FORM INPUTS with the name and value and makes it hidden for use on any form you want.
		?>
		<table name="MenuItem_<?php echo $fieldname;?>" id="MenuItem_<?php echo $fieldname;?>" 
			border="0" 
			cellpadding="0" 
			cellspacing="0" 
			width="100%" 
			align="left" 
			style="text-align:left;" />
			<tr>
				<td class="item_name_inactive" colspan="4" />
					Field Name
					</td>
				<td class="item_name_inactive" />
					Enter Information
					</td>
				<td class="item_name_inactive" />
					Data Format
					</td>
				</tr>
		<?php
	}	


function form_new_control($fieldname,$fieldtxtname,$fieldcomment,$fieldnotes,$fieldformat,$fieldtype,$fieldsizex="0",$fieldsizey="0",$fielddefaultvalue="0",$fieldfunction="0",$ajaxpush="0",$ajaxpushfield="0",$ajaxpushscript="0",$ajaxpushid="0") {
		// $fieldname		Name of form field
		// $fieldtxtname	Name of form field displayed to user
		// $fieldcomment	Instructions to user on how to use this field
		// $fieldnotes		Any special considerations the userr should ne aware of for this field
		// $fieldformat		What format should the field follow?
		// $fieldtype		The type of field to display to the user
				//	1		Text Box
				//	2		Text Area
				//	3		Combobox
				//	4		Map Button
				//	5		Check box
				
		// Set function variables	
				$fieldstring 	= "<b>".$fieldtxtname.": </b><br>";
				$fieldstring	= $fieldstring.$fieldcomment."<br>";
				$fieldstring	= $fieldstring."<i>".$fieldnotes."</i>";
				
				$tmp_default	= $fielddefaultvalue;
		
		if($fieldtype <> 2 AND $fieldsizex <> 0 ) {
			
				$container 	= 'table_forms_container';
				$style 		= 'table_forms_enter_input_field';
				
			} else {
				
				$container 	= 'table_forms_container_wide';
				$style 		= 'table_forms_enter_input_field';
			}
		
		// Determine Default Values
				if($fielddefaultvalue == "post") {
						if (!isset($_POST[$fieldname])) {
								// Default value in post is not defined, revert back to the standard value
								//$fielddefaultvalue;
							}
							else {
								// STRIP INPUT AND PREP FOR SQL INJECTION
								
								$fielddefaultvalue 	= $_POST[$fieldname];
								$beenposted 		= 1;
								//echo $fielddefaultvalue;
							}
					}
					else {
						if($fieldsizex == 0) {
								$beenposted = 1;
							}
						// The default value is still the same
						//$fielddefaultvalue;
					}

		// Display Text Table Cell
				$icons_width 		= 35;
				$icons_height 		= 35;
				?>
					<tr>
						<?php 
						$OSpace_name 	= 'OSpace_MM'.$fieldname;
						$ISpace_name 	= 'ISpace_MM'.$fieldname;
						$Icon_name 		= 'Icon_MM'.$fieldname;
						$Name_name 		= 'Name_MM'.$fieldname;	
						$Field_name		= 'Field_MM'.$fieldname;
						$Format_name	= 'Format_MM'.$fieldname;
						
						// Determine what the icon will look like....
						switch ($fieldtype) {
								
									case 1:		// Datacell is a text box
									if($fieldsizex == 0) {
													// Field is a Text Box being displayed without an input field
													$icon = 'icon_no';
												}
												else {
												
													//echo $fieldtype;
													
													if($fielddefaultvalue == "current") {
															switch ($fieldtxtname) {
																	case "Date":
																			// Field is a date, display date icon
																			$icon = 'icon_date';
																		break;
																	case "Time":
																			// Field is a time, display time icon
																			$icon = 'icon_clock';
																		break;
																	case "Year":
																			// Field is a year, display date icon
																			$icon = 'icon_date';
																		break;
																	default:
																		$icon = 'icon_pencile';
																		break;	
																}
														} else {
															switch ($fieldtxtname) {
																	case "Password":
																			// Field is a password, display chain icon
																			$icon = 'icon_chain';
																		break;
																	case "Start Date":
																			// Field is a date, display date icon
																			$icon = 'icon_date';
																		break;	
																	case "End Date":
																			// Field is a date, display date icon
																			$icon = 'icon_date';
																		break;
																	case "Date":
																			// Field is a date, display date icon
																			$icon = 'icon_date';
																		break;
																	case "Time":
																			// Field is a time, display time icon
																			$icon = 'icon_clock';
																		break;																	
																	default:
																			// Dont know field type, displayu default pencile icon
																			$icon = 'icon_pencile';
																		break;
																}
														}
												}
										break;
									case 2:		// Datacell is a textarea
											if($fieldsizex == 0) {
													// Field is a textarea being displayed.
													$icon = 'icon_no';
												}
												else {
													// Field is a textarea, display 
													$icon = 'icon_pencile';
												}
										break;
									case 3:		// Datacell is a combobox
											if($fieldsizex == 0) {
													// Field is a textarea being displayed.
													$icon = 'icon_no';
												}
												else {
													// Field is a textarea, display 
													switch ($fieldtxtname) {
															case "Priority":
																	// Field is a priority, GET a priority icon or make one...
																	$icon = 'icon_pencile';
																break;
															case "Entry By":
																	// Filed is a users name, display user icon
																	$icon = 'icon_person';
																break;	
															default:
																	// Field is a combo box, display default icon...
																	$icon = 'icon_pencile';
																break;
														}
												}
										break;
									case 4:		// Datacell is a map button
											// Field is a a location, display map icon
											$icon = 'icon_world';
										break;
									case 5:		// Datacell is a checkbox
											// Field is a checkbox, display check icon
											$icon = 'icon_check';
										break;	
									case 6:		// Datacell is a file select box
											// Field is an upload icon, display upload icon
											$icon = 'icon_files';
										break;
									default:
										$icon = 'icon_pencile';
										break;
								}
						?>
						<td name="<?php echo $OSpace_name;?>" id="<?php echo $OSpace_name;?>" 
							class="item_space_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							&nbsp;
							</td>
						<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
							class="item_icon_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							<img src="images/_interface/icons/<?php echo $icon;?>.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
							class="item_space_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							&nbsp;
							</td>				
						<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
							class="item_name_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							<?php echo $fieldtxtname;?>
							</td>		
						<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
							class="item_field_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							<?php
							switch ($fieldtype) {
									case 1:		// Datacell is a text box
									if($fieldsizex == 0) {
													// DO Not show field, Just Show Result
													echo $fielddefaultvalue;
													?>
						<input class="<?php echo $style;?>" value="<?php echo $fielddefaultvalue;?>" name="<?php echo $fieldname;?>" id="<?php echo $fieldname;?>" type='hidden' />
													<?php
												} else {
													// Show field, and customize field accordingly
													//	Some fields require special treatment and need to be adjusted differently
													//	Go through each of these controls seperatly
													switch ($fieldtxtname) {
															// Look through fieldtext looking for custom tags
															case "Date":
																	// Field is a Date Field Box.
																	// is this control displaying just the current date or a set date?
																	if($fielddefaultvalue == 'current') {
																			// Field is displaying just the current date
																			?>
																			
																			<script type="text/javascript">DateInput('<?php echo $fieldname;?>', true, 'YYYY-MM-DD','<?php echo date('Y/m/d');?>');</script>
																			<?php
																		} else {
																			// if not the current date, then a set date
																			// Is there a default value provided?
																			//	if so, use it
																			if($fielddefaultvalue == '') {
																					// There is nothing
																					?>
																					<script type="text/javascript">DateInput('<?php echo $fieldname;?>', true, 'YYYY-MM-DD');</script>
																					<?php
																				} else {
																					// There is probably a default value
																					?>
																					<script type="text/javascript">DateInput('<?php echo $fieldname;?>', true, 'YYYY-MM-DD','<?php echo $fielddefaultvalue;?>');</script>
																					<?php
																				}
																			
																		}
																break;
															case "Date to Close":
																	// Field is a Date Field Box.
																	// is this control displaying just the current date or a set date?
																	if($fielddefaultvalue == 'current') {
																			// Field is displaying just the current date
																			?>
																			<script type="text/javascript">DateInput('<?php echo $fieldname;?>', true, 'YYYY-MM-DD','<?php echo date('Y/m/d');?>');</script>
																			<input class="commonfieldbox" type="checkbox" value="1" id="frmdateclosedt" name="frmdateclosedt" /><i>Check to Ignore Date/Time Fields</i>
																			<input class="commonfieldbox" type="hidden" id="frmdateclosedo" name="frmdateclosedo" 	size="10" value="<?echo date('Y-d-m');?>" />
							
																			<?php
																		} else {
																			// if not the current date, then a set date
																			
																			?>
																			<input class="commonfieldbox" type="checkbox" value="1" onclick="clearcellvalue('<?php echo $fieldname;?>','<?echo date('Y-m-d');?>');">
																			<script type="text/javascript">DateInput('<?php echo $fieldname;?>', true, 'YYYY-MM-DD');</script>
																			<?php
																		}
																break;	
															case "Time":
																	// Field is a Time Field Box
																	?>
																	<input class="<?php echo $style;?>" name="<?php echo $fieldname;?>" size="<?php echo $fieldsizex;?>"
																	<?php
																	if($fielddefaultvalue == "current") {
																			?>
																			type="text" value="<?php echo date("H:i:s");?>">
																			<?php
																		} else {
																			?>
																			type="text" value="<?php echo $fielddefaultvalue;?>">
																			<?php
																		}
																break;
															case "Time to Close":
																	// Field is a Time Field Box
																	?>
																	<input class="<?php echo $style;?>" name="<?php echo $fieldname;?>" size="<?php echo $fieldsizex;?>"
																	<?php
																	if($fielddefaultvalue == "current") {
																			?>
																			type="text" value="<?php echo date("H:i:s");?>" />
																			<?php
																		} else {
																			?>
																			type="text" value="<?php echo $fielddefaultvalue;?>" />
																			<?php
																		}
																			?>
																	<?php
																break;	
																
															case "Year":
																	// Field is a Year Field Box
																	?>
																	<input class="<?php echo $style;?>" name="<?php echo $fieldname;?>" size="<?php echo $fieldsizex;?>"
																	<?php
																	if($fielddefaultvalue == 'current') {
																			?>
																			type="text" value="<?php echo date("Y");?>" />
																			<?php
																		} else {
																			?>
																			type="text" value="<?php echo $fielddefaultvalue;?>" />
																			<?php
																		}
																break;	
															case "Password":
																	// Field is a Password Field Box
																	?>
																	<input class="<?php echo $style;?>" name="<?php echo $fieldname;?>" size="<?php echo $fieldsizex;?>" type="password" value="<?php echo $fielddefaultvalue;?>">
																	<?php
																break;
															case "Start Date":
																	// Field is a Date Field Box.
																	// is this control displaying just the current date or a set date?
																	if($fielddefaultvalue == 'current') {
																			// Field is displaying just the current date
																			?>
																			
																			<script type="text/javascript">DateInput('<?php echo $fieldname;?>', true, 'YYYY-MM-DD','<?php echo date('Y/m/d');?>');</script>
																			<?php
																		} else {
																			// if not the current date, then a set date
																			
																			?>
																			
																			<script type="text/javascript">DateInput('<?php echo $fieldname;?>', true, 'YYYY-MM-DD','<?php echo $fielddefaultvalue;?>');</script>
																			<?php
																		}
																break;
															case "End Date":
																	// Field is a Date Field Box.
																	// is this control displaying just the current date or a set date?
																	if($fielddefaultvalue == 'current') {
																			// Field is displaying just the current date
																			?>
																			
																			<script type="text/javascript">DateInput('<?php echo $fieldname;?>', true, 'YYYY-MM-DD','<?php echo date('Y/m/d');?>');</script>
																			<?php
																		} else {
																			// if not the current date, then a set date
																			
																			?>
																			
																			<script type="text/javascript">DateInput('<?php echo $fieldname;?>', true, 'YYYY-MM-DD','<?php echo $fielddefaultvalue;?>');</script>
																			<?php
																		}
																break;
															case "Metar":
																	// Field is a Metar Field Box
																	$tmpstring = readweathertxt("null");
																	?>
																	<input name="<?php echo $fieldname;?>" id="<?php echo $fieldname;?>" type="hidden" value="<?php echo $tmpstring;?>" />
																	<input class="<?php echo $style;?>" size="<?php echo $fieldsizex;?>" type="text" value="<?php echo $tmpstring;?>" width='<?php echo $fieldsizex;?>' disabled="disabled" />
																	<?php
																break;	
															default:
																	// No special rules needed
																	?>
																	<input class="<?php echo $style;?>" name="<?php echo $fieldname;?>" size="<?php echo $fieldsizex;?>" type="text" value="<?php echo $fielddefaultvalue;?>">
																	<?php
																break;
														}
												}
										break;
									case 2:		// Datacell is a textarea
											if($fieldsizex == 0) {
													// DO Not show field, Just Show Result
													echo $fielddefaultvalue;
												}
												else {
													?>
							<TEXTAREA class="<?php echo $style;?>" name="<?php echo $fieldname;?>" id="<?php echo $fieldname;?>" rows="<?php echo $fieldsizey;?>" cols="<?php echo $fieldsizex;?>"><?php echo $fielddefaultvalue;?></TEXTAREA>
													<?php
												}
										break;
									case 3:		// Datacell is a combobox
											switch ($fieldtxtname) {
													case "Priority":
															if($fieldsizex == 0) {
																			// DO Not show Combobox, Just Show Result
																			$show = "hide";
																		}
																		else {
																			$show = "show";
																		}
															$fieldfunction($fielddefaultvalue, "all", $fieldname, $show, "",2);
															?> 
															<img src="images/_interface/icons/icon_flag.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" onClick="openmapchild('part139327_discrepancy_report_help_pri.php','MapNewPoint')" />
															<?php
														break;
													case "Entry By":
															$fieldfunction($fielddefaultvalue, "all", $fieldname, "hide", "");
															?>
						<input type="hidden" name="<?php echo $fieldname;?>" size="<?php echo $fieldsizex;?>" value="<?php echo $fielddefaultvalue;?>">
															<?php
														break;	
													default:
															if($fieldsizex == 0) {
																	// DO Not show Combobox, Just Show Result
																	$show = "hide";
																	?>
																	<input class="<?php echo $style;?>" value="<?php echo $fielddefaultvalue;?>" name="<?php echo $fieldname;?>" id="<?php echo $fieldname;?>" type='hidden' />
																	<?php
																}
																else {
																	$show = "show";
																}
																
															//echo $fielddefaultvalue." / ".$beenposted." <br>";
															if (!isset($beenposted)) {
																	// Variable not even set
																	$fieldfunction("all", "all", $fieldname, $show,$fielddefaultvalue);
																} else {
																	if ($beenposted == 1) {			
																			$fieldfunction($fielddefaultvalue, "all", $fieldname, $show,$fielddefaultvalue);
																		}
																		else {
																			$fieldfunction("all", "all", $fieldname, $show,$fielddefaultvalue);
																		}
																}
																
															if($ajaxpush=="1") {
																	// User wants an Ajax Push Button after this field\
																	$passedparameter 	= $ajaxpushid.','.$fieldname;
																	$label 				= $fieldformat;
																	_tp_control_function_button_ajax($ajaxpushscript,$passedparameter,$label);
																}
														break;
												}
										break;
									case 4:		// Datacell is a map button
											if ($fielddefaultvalue == '') {
													//echo "NO POST <br>";
													?>
						<input class="<?php echo $style;?>" 	type="hidden" 	name="<?php echo $fieldname;?>X"	value="0" 		size="4">
						<input class="<?php echo $style;?>" 	type="hidden" 	name="<?php echo $fieldname;?>Y" 	value="0" 		size="4">
						
						<img src="images/_interface/icons/icon_flag.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" onClick="openmapchild('_general_mappoint_add.php','MapNewPoint')" />
													<?php
												}
												else {
													if ($fielddefaultvalue == 'post') {
															//echo "Get POST Value <br>";
															$fieldname_x 	= $fieldname."X";
															$fieldname_y 	= $fieldname."Y";
															$fieldvalue_x 	= $_POST[$fieldname_x];
															$fieldvalue_y 	= $_POST[$fieldname_y];												
														?>
												X: &nbsp;<?php echo $fieldvalue_x;?> / Y: &nbsp;<?php echo $fieldvalue_y;?>&nbsp;&nbsp;<img src="images/_interface/icons/icon_flag.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" onClick="openmapchild('_general_mappoint_add.php','MapNewPoint')" />
												<input class="table_forms_enter_input_field" type="hidden" name="<?php echo $fieldname;?>X" value="<?php echo $fieldvalue_x;?>" size="4">
												<input class="table_forms_enter_input_field" type="hidden" name="<?php echo $fieldname;?>Y" value="<?php echo $fieldvalue_y;?>" size="4">
														<?php
														}
														else {
													//echo "If it is not a 'post' and not '', then the other option is a complex set of numbers. <br>";
													//echo "The number will most likely be a set of map cordinates seperated by a comma. <br>";
													//echo "We will need to sub divide the number set and then display the information accordingly. <br>";
													
													//echo "Explode the numberset into an array for access. <br>";
													$numberset = explode(',',$fielddefaultvalue);
													
													//echo "The assumption is x comes before y, or it should. <br>";
													$fieldvalue_x = $numberset[0];
													$fieldvalue_y = $numberset[1];
															?>
						<input class="<?php echo $style;?>" 	type="hidden" 	name="<?php echo $fieldname;?>X"	ID="<?php echo $fieldname;?>X" 	value="<?php echo $fieldvalue_x;?>" 	size="4">
						<input class="<?php echo $style;?>" 	type="hidden" 	name="<?php echo $fieldname;?>Y" 	ID="<?php echo $fieldname;?>Y" 	value="<?php echo $fieldvalue_y;?>" 	size="4">
						<img src="images/_interface/icons/icon_flag.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" onClick="openmapchild('_general_mappoint_add.php','MapNewPoint')" />
															<?php
														}
												}
										break;
									case 5:		// Datacell is a checkbox
									?>
						<input type="checkbox" class="<?php echo $style;?>" name="<?php echo $fieldname;?>" CHECKED value="1">
											<?php
										break;	
									case 6:		// Datacell is a file select box
									?>
						<input type="file" class="<?php echo $style;?>" name="<?php echo $fieldname;?>" CHECKED value="1">
											<?php
										break;											
								}
								?>
							</td>
						<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
							class="item_format_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							<?php 
						if($ajaxpush=="1") {
								// DOnt Display the format text
							} else {
							?>
								<?php echo $fieldformat;?>
							<?php
							}
							?>
							</td>
					</tr>
					<?php
					
	//echo "Default Value: ".$tmp_default."<br>";			
	// STRIP USER INPUT ON DEFAULT VALUE 'POST'
	
	if($tmp_default == 'post') {

			// STRIP INPUT AND PREP FOR SQL INJECTION
			
			if (!isset($_POST[$fieldname])) {
					// Not set?
					$tmp_value	= 0;
				} else {
					$tmp_value			= $_POST[$fieldname];
				}
			//echo "Origional Value: ] ".$tmp_value." [<br>";
			
			$tmp_value			= strip_input($tmp_value);
			//echo "Stripped Value: ] ".$tmp_value." [<br>";
			
			$tmp_value			= scrub_input($tmp_value);
			//echo "Scrubbed Value: ] ".$tmp_value." [<br>";
			
			//echo "Temp Value cleaned is: ".$tmp_value." <br>";
			
			return $tmp_value;
		}
								
								
	}
	?>