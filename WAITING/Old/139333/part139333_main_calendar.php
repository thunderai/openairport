<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139 327 Main Calendar.php		The purpose of this file is to display a printer friendly calendar formart of the inspections.
	
								Usage:
								For use with Part 139 327 Main Browse
								
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
			
		$sql 					= $_GET['frmurl'];												// get the sql statement from the URL, this is important latter (in this document)														
		$frmstartdate			= $_GET['frmstartdate'];
		$frmenddate				= $_GET['frmenddate'];	

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
		<title>Part 139 327 Inspections (Calendar Format)</title>
		<link href="defaultoa.css" rel="stylesheet" type="text/css">
		</head>
	<BODY>
	<?	
	$startdate 	= $frmstartdate;
	$enddate 	= $frmenddate;
	
	$tmpstartdate 	= strtotime($startdate);
	$astartdate 	= getdate($tmpstartdate);
	$intstartmonth	= $astartdate ["mon"];
	$intstartyear	= $astartdate ["year"];

	$tmpenddate 	= strtotime($enddate);
	$aenddate 		= getdate($tmpenddate);
	$intendmonth	= $aenddate ["mon"];
	$intendyear		= $aenddate ["year"];	
	
	$currentmonth 	= date('m');
	$currentyear 	= date('Y');
	$previousmonth 	= ($currentmonth - 1);
	$previousyear 	= ($currentyear - 1);
	
	$nextmonth		= ($currentmonth + 1);
	if ($nextmonth ==13) {
			$nextmonth = 1;
		}
	$nextyear		= ($currentyear + 1);

	echo datediff($startdate, $enddate, "D");
?>

