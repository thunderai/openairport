<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Browse Report General.php			The Browse Report General Page takes a supplied set of arrays and strings and makes a generic report displayed in a new window in a layout friendly to printers
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module. It should also be mentioned that this report used GETs, where most other pages
								use POSTs, this is due to the layout and structure of the browse page and how the FORMs function on that page. The only way to send the information is with GETs, because of this,
								this page will be in a somewhat different order then the POST pages.
								
	NOTE: THERE SHOULD BE NO NEED TO CHANGE ANY OF THE CODE ON THIS PAGE
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Start Session
	Session_Start();
	
	// Load Required Include Files
	
		//include("includes/header.php");																	// This include is not used on this page because this page loads into a new window to avoid the OpenAirport inline layout
		//include("includes/POSTs.php");																	// POSTS are not used on this form, only known GETs
		include("includes/NavFunctions.php");													// Functions used to pull information about what menu item the user is at, etc.
		include("includes/UserFunctions.php");													// Who is the user, etc.
		include("includes/FormFunctions.php");													// Functions used on forms, etc.
		include("includes/DateFunctions.php");													// Functions used for calculating dates, etc.

	// Get string information from the GET process of the form which action was this page
			
		$tblkeyfield			= $_GET['tblkeyfield'];	
		$tblarchivedfield		= $_GET['tblarchivedfield'];				
		$tbldatesortfield		= $_GET['tbldatesortfield'];											
		$tbldatesorttable		= $_GET['tbldatesorttable'];											
		$tbltextsortfield		= $_GET['tbltextsortfield'];											
		$tbltextsorttable		= $_GET['tbltextsorttable'];											
		//$functioneditpage			= $_GET['editpage'];													// not used
		//$functionsummarypage		= $_GET['summarypage'];												// not used
		//$functionprinterpage			= $_GET['printerpage'];													// not used
		$sql 					= $_GET['frmurl'];												// get the sql statement from the URL, this is important latter (in this document)														
		$menuitemid 			= $_GET['menuitemid'];													
		//$tblname					= $_GET['tblname'];													// not used
		//$tblsubname				= $_GET['tblsubname'];													// not used

	// Take the unserialized array and make serialized arrays for use in the FORMS on this page.
	// This is just the reverse of the previouse step, and although may not be required keeps all of the pages uniform in function and appereance.

		$stradatafield 		 	= str_replace("\\", "",$_GET['adatafield']);
		$stradatafieldtable  	= str_replace("\\", "",$_GET['adatafieldtable']);
		$stradatafieldid  	 	= str_replace("\\", "",$_GET['adatafieldid']);
		$stradataspeciale 	 	= str_replace("\\", "",$_GET['adataspecial']);
		$straheadername	  	 	= str_replace("\\", "",$_GET['aheadername']);
		//$strainputtype			= str_replace("\\", "",$_GET['ainputtype']);	
		//$sainputtype				= str_replace("\"","|",$sainputtype);											// not used
		//$sainputcomment			= serialize($ainputcomment);												// not used
		//$sainputcomment			= str_replace("\"","|",$sainputcomment);										// not used
		$stradataselect  		= str_replace("\\", "",$_GET['adataselect']);			

	// Take the seralized array which was submited with the Form and build the a new array which can be used by this page for performing actions
	// There are two phases, (1). Get the information from the POST and replace | with ", this is needed due to how the information is sent via the POST process.
	// Step (2). is to take the string replaced serialized array and rebuild it into an actuall array.

		$adatafield 			= (unserialize($stradatafield ));			
		$adatafieldtable 		= (unserialize($stradatafieldtable));		
		$adatafieldid 			= (unserialize($stradatafieldid));			
		$adataspecial			= (unserialize($stradataspeciale));			
		$aheadername			= (unserialize($straheadername));	
		//$ainputtype				= (unserialize($strainputtype));								
		//$ainputcomment			= unserialize(str_replace("|","\"",$_GET['ainputcomment']));							// not used
		$adataselect			= (unserialize($stradataselect));							

	// Decode the sql
	// Because this was sent over the QueryString, the statement has to have the \s replaced with "s.
		$sql = str_replace("\\", "",$sql);

	// For debugging purposes print out the SQL Statement
		//echo $sql;																				// When dedugging you can uncomment this echo and see the sql statement

	// Start the Real Fun	

		$i 						= 0;															// just in case we want the i variable to be defined before we use it
		$uisize 				= "60";															//just in case we dont define it latter, set a default here.
?>
<html>
	<head>
		<meta http-equiv="content-language" content="en-us">
		<meta http-equiv="content-type" content="text/html; charset=windows-1252">
		<title>open airport logo</title>
		<link href="reports_oa.css" rel="stylesheet" type="text/css">
		</head>
	<BODY>
	<?
	$objconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs = mysqli_query($objconn, $sql);
						
			if ($objrs) {
					$number_of_rows = mysqli_num_rows($objrs);
					?>
					<?
					if ($number_of_rows==0) {
							//echo "no records found";
						}
						else {
							?>
<table border="0" width="100%" id="table1" style="border-collapse: collapse; border-style: solid; border-width: 1px; background-color: #FFFFFF">
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="2%" height="29">&nbsp;</td>
		<td width="96%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" height="29">
			<font face="Arial Narrow" size="5">
				<?
				getnameofmenuitemid($menuitemid, "long", 5, "#000000");
				?>
				</font>
			</td>
		<td width="2%" height="29">&nbsp;</td>
	</tr>
	<tr>
		<td width="2%" height="26">&nbsp;</td>
		<td width="96%" height="26">
			<?
			$tmpdate = date('m/d/Y');
			$tmptime = date("H:i:s");
			?>
			<font face="Arial Narrow">
				The following report was generated on <?=$tmpdate?> at <?=$tmptime;?>, with the following sql syntax:
				</font>
			</td>
		<td width="2%" height="26">&nbsp;</td>
	</tr>
	<tr>
		<td width="2%">&nbsp;</td>
		<td width="96%" style="border-style: solid; border-width: 1px">
			<font face="Arial Narrow" size="2">
				<?=$sql;?>
				</font>
			</td>
		<td width="2%">&nbsp;</td>
	</tr>
	<tr>
		<td width="2%">&nbsp;</td>
		<td width="96%">&nbsp;</td>
		<td width="2%">&nbsp;</td>
	</tr>
	<tr>
		<td width="2%">&nbsp;</td>
		<td width="96%">
			<font face="Arial Narrow">
				<table border="0" width="100%" id="table1" cellpadding="0" cellspacing="1"  style="border-collapse: collapse">
							<tr>
								<td class="formheaders">
									ID
									</td>
								<? 
								for ($i=0; $i<count($aheadername); $i=$i+1) {
										?>
								<td class="formheaders">
										<?=$aheadername[$i];?>
									</td>
										<?
									}
								?>
								</tr>
										<?
										while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										//$tmpfieldname	= $layer3array['menu_item_name_long'];
										?>
							<tr>
								<td height="32" align="center" class="formresults">
									<?=$objarray[$tblkeyfield];?>
									</td>
								<? 
								for ($i=0; $i<count($aheadername); $i=$i+1) {
										?>
								<td align="center" valign="middle" class="formresultspf">
										<? 
										switch ($adatafieldid[$i]) {
												case "notjoined":
														switch ($adataspecial[$i]) {
																case 2:
																		?>
									@ <?=$objarray[$adatafield[$i]];?>
																		<? 
																		break;
																case 4:
																		?>
									$ <?=$objarray[$adatafield[$i]];?>
																		<? 
																		break;
																case 5:
																		?>
									<?=$objarray[$adatafield[$i]];?> %
																		<? 
																		break;
																default:
																		?>
									<?=$objarray[$adatafield[$i]];?>
																		<? 
																		break;
															}
														break;
												case "justsort":
													$tmpstring = (string) $objarray[$adatafield[$i]];
													//echo $tmpstring;
													$tmpstringlength = strlen($tmpstring);
													//echo $tmpstringlength;
													if ($tmpstringlength ==1) {
															switch ($objarray[$adatafield[$i]]) {
																	case 0:
																			$tmpcbfield = "No";
																			break;
																	case 1:
																			$tmpcbfield = "Yes";
																			break;
																	default:
																			$tmpcbfield = $objarray[$adatafield[$i]];
																			break;
															}
														}
														else {
															$tmpcbfield = $objarray[$adatafield[$i]];
														}														
															?>
									<?=$tmpcbfield;?>			
															<?
														break;
												default:											
														$tmpsqlwhereaddon=$objarray[$adatafieldid[$i]];
														$adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "");
														break;
												}
											//} 
									}	// end of for loop
									?>
									</td>
									<? 
											}	// end of while loop
											?>
								</tr>
											<?									
											}	// end of looped data
									?>
							</table>
						</font>
			</td>
		<td width="2%">&nbsp;</td>
	</tr>
	<tr>
		<td width="2%">&nbsp;</td>
		<td width="96%">&nbsp;</td>
		<td width="2%">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">
		<p align="right"><font face="Arial Narrow" size="2">OpenAirport - 
		Advanced Record Keeping System (c) 2006</font></td>
	</tr>
</table>
									<?
									}	// end of records found statement
			
			$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
			$tmpsqltime		= date("H:i:s");
			$tmpsqlauthor		= $_SESSION["user_id"];
			$dutylogevent		= "Printed a Summary Report for table ".$_GET['tbltextsorttable']."";
		
			autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);	
			}	// end of connection
?>
