<?php 
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o		o	ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		oo		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		o o		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o 	o	o	ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  	 o	o	o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	  o	o	o	o	  o		o	o	o		o	o	o   o	  o
//	00000	0		ooooo	o		o	o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document		:	printouts_general_get.php
//
//	Purpose of Page			:	Default Printout Viewer
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	
// Load Global Include Files
	
		include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");	
		include("includes/_template/template.list.php");								// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes

		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_modules/part139333/part139333.list.php");
		include("includes/_modules/part139337/part139337.list.php");


		
	// Get string information from the POST process of the form which action was this page
	
		$tblkeyfield			= $_GET['tblkeyfield'];
		$tblarchivedfield		= $_GET['tblarchivedfield'];		
		$tbldatesortfield		= $_GET['tbldatesortfield'];											
		$tbldatesorttable		= $_GET['tbldatesorttable'];											
		$tbltextsortfield		= $_GET['tbltextsortfield'];											
		$tbltextsorttable		= $_GET['tbltextsorttable'];											
		$functioneditpage		= $_GET['editpage'];													
		$functionsummarypage	= $_GET['summarypage'];												
		$functionprinterpage	= $_GET['printerpage'];												
		$sql 					= $_GET['frmurl'];	
			//echo $sql;
		$menuitemid 			= $_GET['menuitemid'];				
			//echo $menuitemid."<<<<";
		$tblname				= $_GET['tblname'];													
		$tblsubname				= $_GET['tblsubname'];													

	// Take the seralized array which was submited with the Form and build the a new array which can be used by this page for performing actions
	// There are two phases, (1). Get the information from the POST and replace | with ", this is needed due to how the information is sent via the POST process.
	// Step (2). is to take the string replaced serialized array and rebuild it into an actuall array.
	
		$adatafield 			= unserialize(str_replace("|","\"",$_GET['adatafield']));				
		$adatafieldtable 		= unserialize(str_replace("|","\"",$_GET['adatafieldtable']));			
		$adatafieldid 			= unserialize(str_replace("|","\"",$_GET['adatafieldid']));				
		$adataspecial			= unserialize(str_replace("|","\"",$_GET['adataspecial']));			
		$aheadername			= unserialize(str_replace("|","\"",$_GET['aheadername']));				
		$ainputtype				= unserialize(str_replace("|","\"",$_GET['ainputtype']));				
		$ainputcomment			= unserialize(str_replace("|","\"",$_GET['ainputcomment']));			
		$adataselect			= unserialize(str_replace("|","\"",$_GET['adataselect']));				
	
	// Take the unserialized array and make serialized arrays for use in the FORMS on this page.
	// This is just the reverse of the previouse step, and although may not be required keeps all of the pages uniform in function and appereance.
	
		$sadatafield			= serialize($adatafield);
		$sadatafield			= str_replace("\"", "|",$sadatafield);
		$sadatafieldtable 		= serialize($adatafieldtable);											
		$sadatafieldtable 		= str_replace("\"","|",$sadatafieldtable);								
		$sadatafieldid 			= serialize($adatafieldid);												
		$sadatafieldid 			= str_replace("\"","|",$sadatafieldid);									
		$sadataspecial			= serialize($adataspecial);												
		$sadataspecial			= str_replace("\"","|",$sadataspecial);									
		$saheadername			= serialize($aheadername);												
		$saheadername			= str_replace("\"","|",$saheadername);									
		$sainputtype			= serialize($ainputtype);												
		$sainputtype			= str_replace("\"","|",$sainputtype);									
		$sainputcomment			= serialize($ainputcomment);											
		$sainputcomment			= str_replace("\"","|",$sainputcomment);								
		$sadataselect			= serialize($adataselect);												
		$sadataselect			= str_replace("\"","|",$sadataselect);									
	


		//echo $sql;


	// When dedugging you can uncomment this echo and see the sql statement
		
		$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
		if (mysqli_connect_errno()) {															// if there is an error making the connection inform the user
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());							// tell the user the error message
				exit();
			}
			else {																				// without any errors...
				$objrs = mysqli_query($objconn, $sql);											// create the query recordsource
						
				if ($objrs) {																	// if the recordsource is created without error do...
						$number_of_rows = mysqli_num_rows($objrs);								// How many rows did the sql statement find
						?>
	<BODY>
			<table border="0" width="100%" id="table1" style="border-collapse: collapse; border-style: solid; border-width: 1px; background-color: #FFFFFF">
				<tr>
					<td colspan="3">&nbsp;</td>
					</tr>
				<tr>
					<td width="2%" height="29">&nbsp;</td>
					<td width="96%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" height="29">
						<font face="Arial Narrow" size="5">
							<?php
							getnameofmenuitemid($menuitemid, "long", 5, "#000000",$_SESSION['uder_id']);
							?>
							</font>
						</td>
					<td width="2%" height="29">&nbsp;</td>
					</tr>
				<tr>
					<td width="2%" height="26">&nbsp;</td>
					<td width="96%" height="26">
						<?php
						$tmpdate = date('m/d/Y');
						$tmptime = date("H:i:s");
						?>
						</td>
					<td width="2%" height="26">&nbsp;</td>
					</tr>
				<tr>
					<td width="2%">&nbsp;</td>
					<td width="96%" style="border-style: solid; border-width: 1px" colspan="2">
						<font face="Arial Narrow" size="2">
							The following report was generated on <?php echo $tmpdate?> at <?php echo $tmptime;?>.
							</font>
						</td>
					</tr>
				<tr>
					<td width="2%">&nbsp;</td>
					<td colspan="2">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<?php
								for ($i=0; $i<count($aheadername); $i=$i+1) {
										?>
								<td>
										<?php 
										switch ($adataspecial[$i]) {
													case 2:
															?>
											@ <?php echo $aheadername[$i];?>
															<?php 
															break;
													case 4:
															?>
											$ <?php echo $aheadername[$i];?>
															<?php 
															break;
													case 5:
															?>
											<?php echo $aheadername[$i];?> %
															<?php 
															break;
													default:
															?>
											<?php echo $aheadername[$i];?>
															<?php 
															break;
											}
												?>
									</td>
												<?php
									}
									?>
								</tr>
									<?php	
							while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
									?>
							<tr>
									<?php
									for ($i=0; $i<count($aheadername); $i=$i+1) {
											?>
								<td >
											<?php
											switch ($ainputtype[$i]) {
													case "TEXT":	// if the user entered "TEXT' as the input type make a ttext area box
															$tmpvar	= $adatafield[$i];
															?>						
									<?php echo $objarray[$adatafield[$i]];?>
															<?php
															break;
													case "TEXTAREA":	// if the user entered "TEXTAREA" as the input type make a text area box
															$tmpvar 		= str_replace("\'","'",$objarray[$adatafield[$i]] );
															?>
									<?php echo $objarray[$adatafield[$i]];?>
															<?php	
															break;
													case "SELECT":	// if user entered "SELECT" as the input type make a select box
														switch ($aheadername[$i]) {	
																case "Type of Lease":
																		$adataselect[$i]( $objarray[$adatafield[$i]], "all", $adatafield[$i], "hide",  "all",$adatafield[$i+1]);
																		break;
																case "Item Leased":
																		$adataselect[$i]($objarray[$adatafield[$i]], "all", $adatafield[$i], "hide",  $objarray[$adatafield[$i]], $objarray[$adatafield[$i-1]]);
																		break;
																default:
																		$adataselect[$i]($objarray[$adatafield[$i]], "all", $adatafield[$i], "hide", $objarray[$adatafield[$i]]);
																		//echo "function :".$adataselect[$i];
																		break;
															}
															break;
													case "CHECKBOX":	// if user entered "CHECKBOX" as the input type make a select box
															// Load the specified function
															if ($objarray[$adatafield[$i]]==0) {
																	$tmpcbfield = "No";
																	}
																else {
																	$tmpcbfield = "Yes";
																	}
																	?>
									<?php echo $tmpcbfield;?>
																	<?php
															break;
													default:		// if there is an error with the user supplied input type use the 'text' type.
															?>
									<?php echo $objarray[$adatafield[$i]];?>
															<?php
															break;
															}	// End of Switch
															?>
									</td>
															<?php
												}	// End of For Loop
												?>
								</tr>
												<?php
										}	// End of While Loop
								}	// End of Object
								?>
							</table>
						</td>
					</tr>
				<tr>
			<td colspan="3">
				<p align="right">
					<font face="Arial Narrow" size="2">
						OpenAirport - Advanced Record Keeping System (c) 2006
						</font>
					</p>
				</td>
			</tr>
		</table>
						<?php
						}
			$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
			$tmpsqltime		= date("H:i:s");
			$tmpsqlauthor	= $_SESSION["user_id"];
			$dutylogevent	= "Printed record id:".$_GET["recordid"]." in table ".$_GET['tbltextsorttable']."";
		
			autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);					
			
// END OF FILE
?>