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

function form_new_control($fieldname,$fieldtxtname,$fieldcomment,$fieldnotes,$fieldformat,$fieldtype,$fieldsizex="0",$fieldsizey="0",$fielddefaultvalue="0",$fieldfunction="0") {
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
				
		// Determine Default Values
				if($fielddefaultvalue == 'post') {
						if (!isset($_POST[$fieldname])) {
								// Default value in post is not defined, revert back to the standard value
								//$fielddefaultvalue;
							}
							else {
								$fielddefaultvalue = $_POST[$fieldname];
								$beenposted = 1;
							}
					}
					else {
						// The default value is still the same
						//$fielddefaultvalue;
					}

		// Display Text Table Cell
				?>
				<tr>		
					<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('<?php echo $fieldstring;?>')"; onMouseout="hideddrivetip()">
						<?php echo $fieldtxtname;?>
						</td>
				<?php
					
		// Display Data Table Cell
				?>
					<td class="formanswers">
							<?php
							switch ($fieldtype) {
									case 1:		// Datacell is a text box
									if($fieldsizex == 0) {
													// DO Not show field, Just Show Result
													echo $fielddefaultvalue;
												}
												else {
													?>
						<input class="Commonfieldbox" type="text" name="<?php echo $fieldname;?>" size="<?php echo $fieldsizex;?>" 
													<?php
													if($fielddefaultvalue == "current") {
															switch ($fieldtxtname) {
																	case "Date":
																			?>
						value="<?php echo date('m/d/Y');?>">
																			<?php
																		break;
																	case "Time":
																			?>
						value="<?php echo date("H:i:s");?>">
																			<?php
																		break;
																	case "Year":
																			?>
						value="<?php echo date("Y");?>">
																			<?php
																		break;
																}
														}
														else {
															?>
						value="<?php echo $fielddefaultvalue;?>">
															<?php										
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
							<TEXTAREA class="Commonfieldbox" name="<?php echo $fieldname;?>" rows="<?php echo $fieldsizey;?>" cols="<?php echo $fieldsizex;?>"><?php echo $fielddefaultvalue;?></TEXTAREA>
													<?php
												}
										break;
									case 3:		// Datacell is a combobox
											switch ($fieldtxtname) {
													case "Priority":
															$fieldfunction($fielddefaultvalue, "all", $fieldname, "show", "",2);
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
																}
																else {
																	$show = "show";
																}
																
															//echo $fielddefaultvalue;
															
															if ($beenposted == 1) {			
																	$fieldfunction($fielddefaultvalue, "all", $fieldname, $show,$fielddefaultvalue);
																}
																else {
																	$fieldfunction("all", "all", $fieldname, $show,$fielddefaultvalue);
																}
														break;
												}
										break;
									case 4:		// Datacell is a map button
											if ($fielddefaultvalue == '') {
													//echo "NO POST <br>";
													?>
						X: &nbsp;	<input class="Commonfieldbox" 	type="text" 	name="<?php echo $fieldname;?>X"	value="0" 		size="4">, 
						Y: &nbsp;	<input class="Commonfieldbox" 	type="text" 	name="<?php echo $fieldname;?>Y" 	value="0" 		size="4">&nbsp;
						&nbsp;&nbsp;<INPUT class="formsubmit" 		type="button" 	name="maplocation"					ID="maplocation"				VALUE="Map It" 	onClick="openmapchild('_general_mappoint_add.php','MapNewPoint')">
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
												X: &nbsp;<?php echo $fieldvalue_x;?> / Y: &nbsp;<?php echo $fieldvalue_y;?>&nbsp;&nbsp;<INPUT class="formsubmit" TYPE="button" VALUE="Map It" onClick="openmapchild('_general_mappoint_add.php','MapNewPoint')">
												<input class="Commonfieldbox" type="hidden" name="<?php echo $fieldname;?>X" value="<?php echo $fieldvalue_x;?>" size="4">
												<input class="Commonfieldbox" type="hidden" name="<?php echo $fieldname;?>Y" value="<?php echo $fieldvalue_y;?>" size="4">
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
						X: &nbsp;	<input class="Commonfieldbox" 	type="text" 	name="<?php echo $fieldname;?>X"	ID="<?php echo $fieldname;?>X" 	value="<?php echo $fieldvalue_x;?>" 	size="4">, 
						Y: &nbsp;	<input class="Commonfieldbox" 	type="text" 	name="<?php echo $fieldname;?>Y" 	ID="<?php echo $fieldname;?>Y" 	value="<?php echo $fieldvalue_y;?>" 	size="4">&nbsp;
						&nbsp;&nbsp;<INPUT class="formsubmit" 		type="button" 	name="maplocation"					ID="maplocation"				VALUE="Map It" 							onClick="openmapchild('_general_mappoint_add.php','MapNewPoint')">
															<?php
														}
												}
													
													
												
												
										break;
									case 5:		// Datacell is a checkbox
									?>
						<input type="checkbox" class="commonfieldbox" name="<?php echo $fieldname;?>" CHECKED value="1">
											<?php
										break;	
									
									
									
									
									
								}
								?>
						<i><?php echo $fieldformat;?></i>
						</td>
					</tr>
					<?php
	}
	?>