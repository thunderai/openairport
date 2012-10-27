<?php
include("includes/_template_header.php");	
//include("includes/quickaccessFunctions.php");	

		$menuid 	= $_GET['InspCheckList'];			// ID if Selected Menu Item
		$userid		= $_GET['Employee'];				// Who are you
		
		//echo "Loading Menu Items <br>";
		//echo "User ID: ".$userid." <br>";
		//echo "Menu ID: ".$menuid." <br>";
		
		loadnavmenu_5($userid,$menuid);
?>