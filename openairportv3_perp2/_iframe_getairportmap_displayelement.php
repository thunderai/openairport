<?php

	// This function will go through the filtered equipment and display it on the GIS Layer
	
	$sql =" SELECT * FROM ".$tmplist." ";
	
	if($field_join == '') {
			// Join nothing
			$sqli = '';
			$sql3 = "".$filter_h." = 0 AND ".$field_lat." IS NOT NULL AND ".$field_lat." NOT LIKE \"\" ORDER BY ".$field_name." ";
		} else {
			// Join the record table with the filter table
			$sqli = "INNER JOIN ".$tmpfilter." ON ".$tmpfilter.".".$filterid." = ".$tmplist.".".$field_fid." ";
			$sql3 = "".$tmpfilter.".".$filter_h." = 0 AND ".$field_lat." IS NOT NULL AND ".$field_lat." NOT LIKE \"\" ORDER BY ".$field_name." ";
		}
		
	if($filter == 'all') {
			// Do not add any filter information and get all results
			$sql2 = 'WHERE ';
		} else {
			$sql2 = "WHERE ".$field_fid." = '".$filter."' AND ";
			}
	
	$sql = $sql.$sqli.$sql2.$sql3;
	
		//echo "Connect to database usining this SQL statement ".$sql." <br>";				
		$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs = mysqli_query($objconn, $sql);
						
				if ($objrs) {
						$number_of_rows = mysqli_num_rows($objrs);
						while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								$record_id 		= $objarray[$field_id];
								$record_name 	= $objarray[$field_name];
								$record_lat 	= $objarray[$field_lat];
								$record_long 	= $objarray[$field_long];
								if($field_icon == '' ) {
										// No defined Icon, set the default one!
										$record_icon = 'icons_warning';
									} else {
										$record_icon	= $objarray[$field_icon];
									}
								
								// Test to see if this is a series of points (polygon), a point, or actual GPS cordinates
								switch($field_loct) {
										case 'polyxy':
											?>
											<script type='text/javascript'>
											var xtotal				= 0;
											var ytotal				= 0;
											var xaverage			= 0;
											var yaverage			= 0;
											var mapscale			= <?php echo $new_mapscale;?>;
											var recordsource		= '<?php echo $tmplist;?>';
											var recordidfield		= '<?php echo $field_id;?>';
											var filtersource		= '<?php echo $tmpfilter;?>';
											var filteridfield		= '<?php echo $filterid;?>';
											var filterid			= '<?php echo $field_fid;?>';
											var filtername			= '<?php echo $filtername;?>';
											
											var px 					= '<?php echo $record_lat;?>';
											var py 					= '<?php echo $record_long;?>';
											
											var xpoints=px.split(",");
											var ypoints=py.split(",");
											
											for (i=0; i<xpoints.length; ++i) {
											  xpoints[i] = xpoints[i] * 1 * mapscale;
											  xtotal = xtotal + xpoints[i];
											  } // for
											  xaverage = (xtotal/xpoints.length);
											  
											  //alert(xaverage);
											  
											for (i=0; i<ypoints.length; ++i) {
											  ypoints[i] = ypoints[i] * 1 * mapscale;  
											  ytotal = ytotal + ypoints[i];
											  } // for
											  yaverage = (ytotal/ypoints.length);
											
											var icon 				= 'images/_interface/icons/<?php echo $record_icon;?>.png';
											var icon_width 			= 25;	// Manual adjustment to override image size, and/or for programming purposes
											var icon_height			= 25;	// Manual adjustment to override image size, and/or for programming purposes
											var mainiconx			= ( xaverage - parseInt( icon_width / 2 ) );
											var mainicony			= ( yaverage - parseInt( icon_height / 2 ) );	
											
											var jg = new jsGraphics("myCanvas_airportmap");
											var cordtype = 'poly';
											var stringtodisplayp_<?php echo $record_id;?> = '<?php echo $record_id;?>' + ';' + '<?php echo $record_name;?>;' + px + ';' + py + ';' + cordtype + ';' + mapscale + ';' + recordsource + ';' + recordidfield + ';' + filtersource + ';' + filteridfield + ';' + filterid + ';' + filtername;
										
											jg.setColor("#000000"); // red
											jg.setStroke('4'); 
											jg.fillPolygon(xpoints, ypoints,"onclick='update_element_info(stringtodisplayp_<?php echo $record_id;?>)'");	
											
											jg.drawImage(icon,mainiconx,mainicony,icon_width,icon_height,"onclick='update_element_info(stringtodisplayp_<?php echo $record_id;?>)'"); 
											jg.setPrintable(false);
											jg.paint();	
											</script>
											<?php
										
											break;
										case 'pointgps':
										
											$screen_y = ($record_lat / $convertarray[1]) - ($convertarray[2] / $convertarray[1]);
											$screen_x = (abs($record_long) / $convertarray[0]) - ($convertarray[3]/$convertarray[0]);
											
											$screen_y = round(($screen_y * $new_mapscale),0);
											$screen_x = round(($screen_x * $new_mapscale),0);
											
											//echo "Point x:".$screen_x." Y:".$screen_y." ID:".$record_id."<br>";
											
											?>
											<script type='text/javascript'>
											
											var serlized_array		= '<?php echo $serialized_ary;?>';
											
											
											var px 					= '<?php echo $screen_x;?>';
											var py 					= '<?php echo $screen_y;?>';
											//alert(px);
											
											px = px * 1;
											py = py * 1;
											
											var icon 				= 'images/_interface/icons/<?php echo $record_icon;?>.png';
											var label				= ' <?php echo $record_name;?> ';
											var label_background 	= '#7d388e'; 	// Dark Purple
											var label_color			= '#FFFFFF';	// White
											var icon_width 			= 25;	// Manual adjustment to override image size, and/or for programming purposes
											var icon_height			= 25;	// Manual adjustment to override image size, and/or for programming purposes	
											var mainiconx			= ( px - parseInt( icon_width / 2 ) );
											var mainicony			= ( py - parseInt( icon_height / 2 ) );
											var label_off_x			= ( px + icon_width );
											var label_off_y			= ( py - icon_height );

											var jg = new jsGraphics("myCanvas_airportmap");
											
											var cordtype = 'point';
											//												0							, 1									, 2		, 3			, 4				, 5				, 6					, 7						, 8					, 9					, 10				, 11				, 12		
											var stringtodisplay_<?php echo $record_id;?> = '<?php echo $record_id;?>' + ';' + '<?php echo $record_name;?>;' + px + ';' + py + ';' + cordtype + ';' + mapscale + ';' + escape(serlized_array);
										
											jg.drawImage(icon,mainiconx,mainicony,icon_width,icon_height,"border='1' onMouseOver='this.style.zIndex = 999' onMouseOut='this.style.zIndex = 100' onclick='update_element_info(stringtodisplay_<?php echo $record_id;?>)'"); 
											jg.setPrintable(false);
											jg.paint();	
											</script>
											<?php
											break;
									}
							}
					}
			}

	?>