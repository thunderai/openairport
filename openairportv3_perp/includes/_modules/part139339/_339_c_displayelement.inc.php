<?php

//									0		, 1						, 2						, 3						, 4						, 5				, 6						, 7
//$display_menu_item[$i] 	= array($tmpid	,$condition_location_x	,$condition_location_y	,$checklist_item_disc	,$facility_is_runway	,$facility_name	,$condition_location_rx	,$condition_location_ry);
//$tmplocationx	= convertfromlargescale_to_smallscale_x($objarray['139337_locationx'],$maparray);
//$tmplocationy	= convertfromlargescale_to_smallscale_y($objarray['139337_locationy'],$maparray);

// TAKE INPUT AND DRAW ON MAP
	
		// 	[0]	Condition ID
		//	[1]	Location X
		//	[2] Location Y
		//	[3]	Value
		//	[4] isrunway or whatam i?
		//	[5] Facility Name
		
		// Placement Maps
		$offset_x		= 58;
		$offset_y		= 61;	
		
		$js_array_x		= "";
		$js_array_y		= "";
		
		$xlocations		= explode(",",$display_menu_item[$j][1]);
		$ylocations		= explode(",",$display_menu_item[$j][2]);
		$value_is		= $display_menu_item[$j][3];
		
		if($display_menu_item[$j][7] == 0) {
			
				$rylocations = 100;
				
			} else {
				
				$rylocations	= $display_menu_item[$j][7];
				
			}
		
		if($display_menu_item[$j][6] == 0) {
			
				$rxlocations = 100;
				
			} else {
		
				$rxlocations	= $display_menu_item[$j][6];
				
			}
		
		//echo $rxlocations;
		
		$size_of_array 	= count($xlocations);
		$value_of_mu	= $display_menu_item[$j][3];
		
		// Determine Color of Lines and things:
		if($value_of_mu >= 0 AND $value_of_mu <=20 ) {
				$linecolor = "#4F0000";
		}
		if($value_of_mu >= 21 AND $value_of_mu <= 25 ) {
				$linecolor = "#D80000";
		}
		if($value_of_mu >= 26 AND $value_of_mu <= 29 ) {
				$linecolor = "#FF5916";
		}				
		if($value_of_mu >= 30 AND $value_of_mu <= 35 ) {
				$linecolor = "#FFCE34";
		}
		if($value_of_mu >= 36 AND $value_of_mu <= 39 ) {
				$linecolor = "#B8DC2E";
		}			
		if($value_of_mu >= 40 ) {
				$linecolor = "#399C0E";
		}	
		
		switch($value_is) {
				case "Closed":
					$linewidth = "4";
					$linecolor = "#FF0000";
					break;
				case "Expired":
					$linewidth = "4";
					$linecolor = "#00FF00";	
					break;
				default:
					$linewidth = "6";
					$linecolor = $linecolor;
					break;
			}
		
									
		//echo "Size of Array : ".$display_menu_item[$j][1]." <br>";
		
		if($size_of_array == 1) {
				// Draw Single Point Item
		}
		else {
			// CONVERT Large X,Y into small X,Y....
			for ($k=0; $k<count($xlocations); $k=$k+1) {
					// Loop through array and replace values as they comeup
					//echo "X Locations: ".$xlocations[$k]." <br>";
					$tmp_x 			= $xlocations[$k] + $offset_x;
					$tmp_x			= convertfromlargescale_to_smallscale_x($tmp_x,$maparray);
					$xlocations[$k]	= $tmp_x;
					$tmp_y			= $ylocations[$k] + $offset_y;
					$tmp_y			= convertfromlargescale_to_smallscale_y($tmp_y,$maparray);
					$ylocations[$k]	= $tmp_y;				
				
			}
		
		$xlocations		= implode(", ",$xlocations);
		$ylocations		= implode(", ",$ylocations);		
		
		
		
				?>
		<div style="position:absolute; z-index:4;" id="myCanvas_<?php echo $display_menu_item[$j][0];?>"></div>			
			<script type="text/javascript">
				<!--
				function myDrawFunction() {
					// Get The current Numbers from the Edit Table, and set them to the variable.
					var xpoints = "<?php echo $xlocations;?>";
					var ypoints = "<?php echo $ylocations;?>";
					var xtotal = 0;
					var ytotal = 0;
					var xaverage = 0;
					var yaverage = 0;
					//alert(xpoints);
					
					var topright_x = 0;
					var topright_y = 0;

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
					  
				// Attempt to draw a label
					for (i=0; i<ypoints.length; ++i) {
						
						if(xpoints[i] <= 492) {
							if(ypoints[i] <= 500) {
								topright_x = xpoints[i] - 10;
								topright_y = ypoints[i] - 10;
							}
							else {
								topright_x = xpoints[i] - 10;
								topright_y = ypoints[i] + 10;
							}
						} 
						else {
							if(ypoints[i] <= 500) {
								topright_x = xpoints[i] + 10;
								topright_y = ypoints[i] - 10;
							}
							else {
								topright_x = xpoints[i] + 10;
								topright_y = ypoints[i] + 10;
							}
						}
					
							
						//var i = 0;
						//topright_x = xpoints[0] + 10;
						//topright_y = ypoints[0] + 10;
						

					}			  
					  
					  
/* 					// Attempt to draw a label
					for (i=0; i<ypoints.length; ++i) {
						
						if(xpoints[0] <= 492) {
							if(ypoints[0] <= 500) {
								topright_x = xpoints[0] - 10;
								topright_y = ypoints[0] - 10;
							}
							else {
								topright_x = xpoints[0] - 10;
								topright_y = ypoints[0] + 10;
							}
						} 
						else {
							if(ypoints[0] <= 500) {
								topright_x = xpoints[0] + 10;
								topright_y = ypoints[0] - 10;
							}
							else {
								topright_x = xpoints[0] + 10;
								topright_y = ypoints[0] + 10;
							}
						}
					
							
						//var i = 0;
						//topright_x = xpoints[0] + 10;
						//topright_y = ypoints[0] + 10;
						
						jg.setColor("#FFFFFF"); // red
						jg.setStroke(2);
						
						jg.drawLine(xpoints[0], ypoints[0], topright_x, topright_y); 
					} */
						
					

					
					// Draw the Pavement section
					jg.setPrintable(true);
					jg.setColor("<?php echo $linecolor;?>"); // red
					jg.setStroke('<?php echo $linewidth;?>'); 
					jg.fillPolygon(xpoints, ypoints);	
					
						jg.setColor("#FFFFFF"); 
						jg.setStroke(1);
						
						//jg.drawLine(xpoints[i], ypoints[i], topright_x, topright_y); 
						
						var label_x = xaverage;
						var label_y = yaverage;
						
						var label_rx 	= <?php echo $rxlocations;?>;
						var label_ry	= <?php echo $rylocations;?>;
						
						//alert(label_rx);
						
						var locx	= label_rx;
						var locy	= label_ry;
						var label2x	= locx + 10;
						var label2y = locy - 10;
						<?php
						if($display_menu_item[$j][3] == '') {
								// Nothing there, display nothing
							} else {
								?>
						//alert(label_x);
						jg.setColor("<?php echo $linecolor;?>");
						jg.drawLine(label_x,label_y, locx, locy);
						
						jg.setColor("<?php echo $linecolor;?>");
						jg.fillEllipse(locx-3,locy-3, 6, 6);
						
						jg.setColor("<?php echo $linecolor;?>");
						jg.fillEllipse(label_x-3,label_y-3, 6, 6);
						
						jg.setColor("#000000");
						jg.setFont("arial","12px",Font.ITALIC_BOLD);
						jg.drawString("Mu: <?php echo $display_menu_item[$j][3];?>", label2x+2, label2y+2);
						
						jg.setColor("#FFFFFF");
						jg.setFont("arial","12px",Font.ITALIC_BOLD);
						jg.drawString("Mu: <?php echo $display_menu_item[$j][3];?>", label2x, label2y);
						
								<?php
							}
						?>
					jg.paint();
				}													

				var jg = new jsGraphics("myCanvas_<?php echo $display_menu_item[$j][0];?>");

				myDrawFunction();													
				//-->
				</script>	
				<?php
		}
		
?>