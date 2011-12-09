<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139327 Sub D A Report.php		The Printer Report takes a provided sql statement or id and generates the report
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	NOTE: THERE SHOULD BE NO NEED TO CHANGE ANY OF THE CODE ON THIS PAGE
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Start Session
	Session_Start();
	
	// Load Required Include Files
	
		//include("includes/header.php");																	// This include is not used on this page because this page loads into a new window to avoid the OpenAirport inline layout
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/NavFunctions.php");													// Functions used to pull information about what menu item the user is at, etc.
		include("includes/UserFunctions.php");													// Who is the user, etc.
		include("includes/FormFunctions.php");													// Functions used on forms, etc.
		include("includes/DateFunctions.php");													// Functions used for calculating dates, etc.

	// For debugging purposes print out the SQL Statement
		//echo $sql;																				// When dedugging you can uncomment this echo and see the sql statement

	// Start the Real Fun	

		$i 						= 0;															// just in case we want the i variable to be defined before we use it
		$uisize 				= "60";															//just in case we dont define it latter, set a default here.
		
		//echo $_POST['sql'];
		

if (!isset($_POST["sql"])) {																	// Test to see if $_POST['recordid'] exists, and if not do
		//echo "no sql";																				// no sql provided so lets assume otherwise
		
		$sql = "SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_id = ".$_POST["recordid"]."";						// Add the record id POST value to the sql temporary string
		
		$sql = str_replace("\\", "",$sql);	
		
		//echo $sql;																				// When dedugging you can uncomment this echo and see the sql statement
	}
	else {																						// $_POST['recordid'] does exist, so lets use it
		//echo "sql provided";
		
		$sql = $_POST['sql'];
		
		$sql = str_replace("\\", "",$sql);
		
		//echo $sql;
		}
		
		$objconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");				// make a connection with the openairport database
				
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
<HTML>
	<HEAD>
		<meta http-equiv="content-language" content="en-us">
		<meta http-equiv="content-type" content="text/html; charset=windows-1252">
		<title>open airport logo</title>
		<script type="text/javascript" src="scripts/ajax.js"></script>
		<script type="text/javascript" src="scripts/AjaxRequest.js"></script>
		<link href="reports_oa.css" rel="stylesheet" type="text/css">
		</head>
	<body>
		<br>
			<table border="0" width="100%" id="table1" style="border-collapse: collapse; border-style: solid; border-width: 1px; background-color: #FFFFFF">
				<tr>
					<td colspan="3">&nbsp;</td>
					</tr>
				<tr>
					<td width="2%" height="29">&nbsp;</td>
					<td width="96%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" height="29">
						<font face="Arial Narrow" size="5">
							Discrepancy Archived Print Report
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
							(Here is a Printer Friendly report of the Bounce)
							</font>
						</td>
					<td width="2%" height="26">&nbsp;</td>
					</tr>
				<tr>
					<td width="2%">&nbsp;</td>
					<td width="96%" style="border-style: solid; border-width: 1px">
						<font face="Arial Narrow" size="2">
							The following report was generated on <?=$tmpdate?> at <?=$tmptime;?>.
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
						<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<?
							while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
								?>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Date
												</td>
											<td class="formanswers">
												<?=$objarray['discrepancy_archieved_date'];?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Time
												</td>
											<td class="formanswers">
												<?=$objarray['discrepancy_archieved_time'];?>
												</td>
											</tr>	
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Archived By
												</td>
											<td class="formanswers">
												<?
												systemusercombobox($objarray['discrepancy_archieved_by_cb_int'], "all", "disauthor", "hide", "");
												?>
												</td>
											</tr>											
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Comments
												</td>
											<td class="formanswers">
												<?=$objarray['discrepancy_archieved_reason'];?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(checked = bounced)')"; onMouseout="hideddrivetip()">
												Archive It
												</td>
											<td class="formanswers">
												Disrepancy has been Archived
												</td>
											</tr>												
										<tr>
											<td colspan="2" class="formoptionsavilablebottom">
												</td>
											</tr>		
								<? 
								}
								?>
							</table>
						</td>
					</tr>
					<tr>
		<td colspan="3">
		<p align="right"><font face="Arial Narrow" size="2">OpenAirport - 
		Advanced Record Keeping System (c) 2006</font></td>
	</tr>
				</table>
						<?
						}
			$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
			$tmpsqltime		= date("H:i:s");
			$tmpsqlauthor	= $_SESSION["user_id"];
			$dutylogevent	= "Printed record id:".$_POST["recordid"]." in table tbl_139_327_sub_d_a";
		
			autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);	
			
					}				
// END OF FILE
?>
