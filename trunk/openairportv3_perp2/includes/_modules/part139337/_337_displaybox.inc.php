<?php
function part139337_displaybox($txtdisplay, $bsize, $fsize,$hsize, $jsize, $wpost, $xpost, $ypost, $zpost, $disid, $disname,$disremarks,$disx,$disy, $distools = 0) {
		// The purpose of this function is to generalize the Discrepancy Display box found on the Part 139.327 reports.
		
		//Target Locator Required Offsets
		$addedoffset	= 0;
		$OffSetX 		= -15;
		$OffSetY 		= 65;
		$disheight		= 0;
		$tempX 			= ($disx + $OffSetX );
		$tempY 			= ($disy + $OffSetY );
		
		if($txtdisplay <> "Targets Only") {
		// DISPLAY RIGHT SIDE INFORMATION
		//
		?>
		
		<div style="position:absolute; width:<?php echo ($wpost);?>; left:<?php echo ($xpost);?>; top:<?php echo ($ypost);?>; z-index:<?php echo ($zpost);?>; align="center">
			<table border="1" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" />
				<tr>
					<td class="item_name_small_active" />
						<font size="<?php echo $fsize;?>">Name:</font>
						<?php
						$disheight = ($disheight + 22);
						?>
						</td>
					</tr>
				<tr>
					<td class="item_name_small_inactive" />
						<font size="<?php echo $fsize;?>"><b><?php echo $disname;?></b></font>
						<?php
						// Get length of description field to calculate the offset required for display on the report	
						$slength 		= strlen($disname);
						$Taddedoffset 	= intval($slength / 17)+1;															// Number of possible chars per line
						//echo "Number of Lines ".$Taddedoffset."<br>";
						$Taddedoffset 	= ($Taddedoffset * 20);														// Total pixels used per line
						
						$disheight 		= ($disheight + $Taddedoffset);
						$Taddedoffset	= 0;
						$slength 		= 0;
						?>
						</td>
					</tr>
				<tr>
					<td class="item_name_small_active" />
						<font size="<?php echo $fsize;?>">Description:</font>
						<?php
						$disheight = ($disheight + 22);
						?>
						</td>
					</tr>
				<tr>
					<td class="item_name_small_inactive" />
						<font size="<?php echo $fsize;?>"><b><?php echo $disremarks;?></b></font>
						<?php
						// Get length of description field to calculate the offset required for display on the report
						$slength 		= strlen($disremarks);
						$Taddedoffset 	= intval($slength / 17)+1;																// Number of possible chars per line
						//echo "Number of Lines ".$Taddedoffset."<br>";
						$Taddedoffset 	= ($Taddedoffset * 20);															// Total pixels used per line
						//$Taddedoffset 	= ($Taddedoffset - 8);															// Workorder table requirements						
						
						$disheight 		= ($disheight + $Taddedoffset);
						$Taddedoffset	= 0;
						$slength 		= 0;
						?>						
						</td>
					</tr>
				<?php
					if ($distools == 1) {
							// Display all functions and buttons for this Discrepancy
							
							$discrepancybouncedid 	= "";
							$discrepancybounceddate = "";
							$discrepancybouncedtime = "";
							$discrepancyrepairid 	= "";
							$discrepancyrepairdate 	= "";
							$discrepancyrepairtime 	= "";
							$isduplicate			= "";
							$isarchived				= "";
							?>
							
				<tr>
					<td>
						<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
							<tr>
								<?php
							
									//test 3). Determine if the Discrepancy is currently outstanding or has been fixed. This involves checking both the repaired and bounced tables for information about the
									//current discrepancy ID. This will be done in three phases. 
									//Phase 1 will be to check the bounced table to see if there is any records about this discrepancy ID there. if so get the date of the latest record and put the ID of the record in a variable
									//phase two will be to check the repaired table and see if there is any information about this discrepancy there. if so get the date of the latest record and put the ID of the record in a variable
									//phase three will be to compare the two dates provided and see which event is most recent.
									
									// Need to figure out what the current status of this discrepancy is!
									// Status:
									//				0 - Work Order
									//				1 - Repaired
									//				2 - Bounced	
									//$status 				= part139327discrepancy_getstage($disid,0,0,0,0);
									// Lie to the blockform
									//$imclearlyahijacker		= 1;
									//$functionworkorderpage 	= 1;
									//$functionworkorderpage	= 'part139327_discrepancy_report_display_workorder.php';
									//$functionrepairpage		= 'part139327_discrepancy_report_repaired.php';
									//$functionbouncepage		= 'part139327_discrepancy_report_bounce.php';
									//$array_repairedcontrol	= array(0,0,'part139327_discrepancy_report_display_repaired.php');
									//$array_bouncedcontrol	= array(0,0,'part139327_discrepancy_report_display_bounced.php');
									// Utilize our lies
									//include("includes/_template/_tp_blockform_workorder.binc.php");	
									
									?>	
									</tr>
								</td>
							</table>
						</tr>							
							
							<?php
							$disheight 		= ($disheight + 40);
						}
					?>
				</table>
			</div>
		<?php
		}
		// DISPLAY LOCATION POINTER
		//
		?>
		
		<div style="position:absolute; z-index:<?php echo $zpost;?>; left:<?php echo $tempX;?>; top:<?php echo $tempY;?>; align="left">
			<table border="0" cellpadding="0" cellspacing="0" id="AutoNumber1">
  				<tr>
					<form style="margin-bottom:0;" action="part139337_report_display.php" method="POST" name="dislookform<?php echo $disid;?>" id="dislookform<?php echo $disid;?>" target="dislookformwindow<?php echo $disid;?>" onsubmit="window.open('', 'dislookformwindow<?php echo $disid;?>', 'width=768,height=550,status=no,resizable=no,scrollbars=yes')">
						<input class="formsubmit"	type="hidden" name="recordid" 			id="recordid"			value="<?php echo $disid;?>">
					<td rowspan="2" width="31" height="31" align="left" valign="top" class="" onMouseover="ddrivetip('<?php echo $disid;?> : <?php echo $disremarks;?>')"; onMouseout="hideddrivetip()" onclick="javascript:document.dislookform<?php echo $disid;?>.submit()">
						 <img border="0" src="images/part_139_327/discrepancywork3.gif" s="31" height="31" border="0">
						</td>
						</form>
					</tr>
				</table>
			</div>			
			
		<?php
		if($txtdisplay <> "Targets Only") {
		// DISPLAY Line from Discrepancy Location to Description of Discrepancy
		//
		
		// Make Value Integers
		$tempX 				= intval($tempX);
		$tempY 				= intval($tempY);
		$tempX2				= intval($xpost);
		$tempY2				= intval($ypost);
		$disheight			= intval($disheight);
		$halfaddedoffset	= ($disheight / 3);
		$halfaddedoffset	= intval($halfaddedoffset);
		//echo "Disheight =".$disheight." / 2 ".$halfaddedoffset." ";
		
		// Add Custom Offsets (x1,y1)
		$tempX 				= ($disx + 22 );
		$tempY 				= ($disy + 22 );
		
		// Add Custom Offsets (x2,y2)
		$tempX2				= ($tempX2 - 1);
		$tempY2				= ($tempY2 - $halfaddedoffset);

		$tempxpoints 		= $tempX.",".$tempX2;
		$tempypoints 		= $tempY.",".$tempY2;
		?>
		
		<div style="position:absolute; z-index:3;" id="myCanvas_<?php echo $disid;?>"></div>			
			<script type="text/javascript">
				<!--
				function myDrawFunction() {
					// Get The current Numbers from the Edit Table, and set them to the variable.
					var xpoints = "<?php echo $tempxpoints;?>";
					var ypoints = "<?php echo $tempypoints;?>";
					var xtotal = 0;
					var ytotal = 0;
					var xaverage = 0;
					var yaverage = 0;

					// Take apart the string values of the text fiel and put the strings into an array
					var xpoints=xpoints.split(",");
					var ypoints=ypoints.split(",");

					// In each array take the string and convert it into a number adjusting for mouse pointer error
					for (i=0; i<xpoints.length; ++i) {
					  xpoints[i] = xpoints[i] * 1 - 21;
					  xtotal = xtotal + xpoints[i];
					  } // for
					  xaverage = (xtotal/xpoints.length);
					for (i=0; i<ypoints.length; ++i) {
					  ypoints[i] = ypoints[i] * 1 + 60;  
					  ytotal = ytotal + ypoints[i];
					  } // for
					  yaverage = (ytotal/ypoints.length);

					// Draw the Pavement section
					jg.setColor("#ff000f"); // red
					jg.setStroke(3); 
					jg.drawPolyline(xpoints, ypoints);
					jg.paint();
				}													

				var jg = new jsGraphics("myCanvas_<?php echo $disid;?>");

				myDrawFunction();													
				//-->
				</script>	
				<?php
		//echo "DisHeight ".$disheight." ".$halfaddedoffset."<br>";
		//$disheight = 140;
				}
		return $disheight;
				
		}
		?>