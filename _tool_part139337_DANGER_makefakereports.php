<?php
//require('phpsqlajax_dbinfo.php');

// Load Includes
		//include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		//include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/gs_config.php");
		
// Load Page Specific Includes
		//include("includes/_dateandtime/dateandtime.list.php");
		//include("scripts/_scripts_header_iface.inc.php");
		//include("includes/AutoEntryFunctions.php");
		//include("includes/_systemusers/systemusers.list.php");
		include("includes/_modules/part139337/part139337.list.php");
		//include("includes/_navigation/_nav_displaytxtonreport.inc.php");
		include("includes/_generalsettings/_gs_gis_settings.inc.php");					// Load GIS Functions
		
// DO Something Totaly Wrong!!!

		
				for ($i=1; $i<500; $i=$i+1) {
						// Loop through all records and randomize their location values
						// x between 0 and 700
						// y between 0 and 800
						
						//Make a random X value
						$randomseed_x 	= rand(1,2000);						
						$randomseed_y 	= rand(1,2290);
						$randomspecies 	= rand(2,64);
						if ($randomspecies == 59 OR $randomspecies == 37 OR $randomspecies == 26 OR $randomspecies == 43) {
								$randomspecies = 2;
							}
						$randomaction 	= rand(1,5);
						$randomactivity = rand(1,4);
						$randomnumber	= rand(1,30);
						$randomdate		= date("Y-m-d");
						$randomtime		= date("H:i");
						$randomweather	= "Clear and Dry - Random Seed";
						$randomresults	= "it died - Random Seed";
						$randommetar	= "NA - Random Seed";
						$randomauthor	= 1;
						
						$sql3 = "INSERT INTO `tbl_139_337_main` (139337_date, 139337_time, 139337_author_by_cb_int, 139337_species_cb_int, 139337_activity_cb_int, 139337_action_cb_int, 139337_numberofspecies, 139337_resultsofaction, 139337_weather, 139337_locationx, 139337_locationy,139337_metar)
						VALUES ( 	'".$randomdate."', 
									'".$randomtime."', 
									'".$randomauthor."', 
									'".$randomspecies."', 
									'".$randomactivity."',
									'".$randomaction."', 
									'".$randomnumber."', 
									'".$randomresults."', 
									'".$randomweather."', 
									'".$randomseed_x."', 
									'".$randomseed_y."', 
									'".$randommetar."' )";
						
						//echo $sql3." <br><br>";
						
						$objcon3 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
						
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								//printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}		
							else {
							
								//echo "[3][b][7] : Connection Established with main table <BR>";
							
								$objrs3 = mysqli_query($objcon3, $sql3) or die(mysqli_error($objcon3));
								$discrepancyrepairID = mysqli_insert_id($objcon3);
								
								//echo "[3][b][8] : Discrepancy repair has a new ID of ".$discrepancyrepairID." <BR>";
							}	

					}
					?>