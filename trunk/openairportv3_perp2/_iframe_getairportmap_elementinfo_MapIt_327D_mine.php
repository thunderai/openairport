<!DOCTYPE html>
<HTML>
	<HEAD>	
		<?php 
		// LOAD INCLUDES
		
		include("stylesheets/_css.inc.php");			// List of all Navigation functions
		include("scripts/_scripts_header_iframes.inc.php");
		include("scripts/_scripts_header_iface.inc.php");
		include("scripts/_scripts_header_ajaxs.inc.php");	
		include("includes/gs_config.php");
		include("includes/_dateandtime/dateandtime.list.php");										// List of all Date and Time functions
		include("includes/_systemusers/systemusers.list.php");										// List of all Navigation functions
		include("includes/_userinterface/userinterface.list.php");									// List of all Navigation functions
		include("includes/_generalsettings/generalsettings.list.php");								// List of all Navigation functions
		include("thirdparty/pointlocation/pointlocation.php");										// List of all Navigation functions
		include("includes/_gis/_gis.list.php");			// List of all Navigation functions
		include("includes/_template/template.list.php");			// List of all Navigation functions
		?>
		</HEAD>
	<body leftmargin="0px" rightmargin="0px" topmargin="0px" marginwidth="0px" marginheight="0px" style="margin: 0px; margin-bottom:0px; margin-top:0px;margin-right:0px;background-color:transparent;" />
		<?php
		// AJAX CALL
		//	call_server_MapIt_337M(idstring,howtodisplay,whatdoido)
		//	idstring 		= String of informaiton, dont know what kind yet
		//					o SQL
		//					o String of IDs
		//	howtodisplay 	= internal to the javascript
		//	whatdoido		= Tells the PHP what kind of information is in the idstring
		//					o 'flush' 	- Ignore everything all produce a blank page
		//					o 'sql'		- idstring is really an SQL Statement
		//					o 'ids'		- idstring really is a string of IDs
		
		//	Get $_GET information
			$raw_idstring	= $_GET['idstring'];
			$raw_whatdoido	= $_GET['whatdoido'];
			//echo "Raw String is :".$raw_idstring."<br>";
			//echo "Raw String is :".$raw_whatdoido."<br>";
		// Test What Type of Call this is...
		//	'flush' Clear the Map...Send blank page
		//	anything else...Draw map
		if($raw_whatdoido == 'flush') {
				// Flush the map
				?>
				&nbsp;
				<?php
			} else {
				if($raw_whatdoido == 'ids') {
						// Unserilze the String into an Array
							$get_array = rawurldecode($raw_idstring);
							//echo "Raw Encoding ".$get_array."<br>";
							$get_array = unserialize($get_array);
							//echo "Assembled Array is an ".$get_array."<br>";
						// Use the array to display the discrepancies on the Map
							$sql2 		= " SELECT * FROM tbl_139_327_sub_d WHERE Discrepancy_id IN(".implode(',',$get_array).')';
					}
				if($raw_whatdoido == 'sql') {
						// Enter as SQL 
							$sql2	= urldecode($raw_idstring);
							//$sql2 	= $raw_idstring;
					}
					//echo "Connect to database usining this SQL statement ".$sql." <br>";				
					$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
					if (mysqli_connect_errno()) {
							// there was an error trying to connect to the mysql database
							printf("connect failed: %s\n", mysqli_connect_error());
							exit();
						}
						else {
							$objrs2 = mysqli_query($objconn2, $sql2);
							$internal_counter = 0;		
							if ($objrs2) {
									$number_of_rows2 = mysqli_num_rows($objrs2);
									while ($row2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
											// Loop results
											$disid = $row2['Discrepancy_id'];
											$a2 = $row2['Discrepancy_location_x'];
											$b2 = $row2['Discrepancy_location_y'];
											//Target Locator Required Offsets
											$addedoffset	= 0;
											$OffSetX 		= -15;
											$OffSetY 		= -10;
											$disheight		= 0;
											$tempX 			= ($a2 + $OffSetX);
											$tempY 			= ($b2 + $OffSetY);
											?>
				<div style="position:absolute; z-index:101; left:<?php echo $tempX;?>px; top:<?php echo $tempY;?>px; align="left" onMouseOver="this.style.zIndex = 999" onMouseOut="this.style.zIndex = 100">
					<table border="0" cellpadding="0" cellspacing="0" id="AutoNumber1">
						<tr>
							<form style="margin-bottom:0;" action="part139327_discrepancy_report_display.php" method="POST" name="dislookform<?php echo $disid;?>" id="dislookform<?php echo $disid;?>" target="ViewWorkOrder" onsubmit="openmapchild('','ViewWorkOrder')";>
								<input class="formsubmit"	type="hidden" name="recordid" 			id="recordid"			value="<?php echo $disid;?>">
							<td rowspan="2" width="31" height="31" align="left" valign="top" class="" onclick="javascript:document.dislookform<?php echo $disid;?>.submit()">
								 <img border="2" src="images/part_139_327/discrepancywork3.gif" s="31" height="31" />
								</td>
								</form>
							</tr>
						</table>
					</div>	
											<?php
										}
								}
						}
				}
				?>
		</body>
	</html>