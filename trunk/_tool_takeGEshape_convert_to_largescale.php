<?php
//require('phpsqlajax_dbinfo.php');

// Load Includes
		//include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		//include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/gs_config.php");
		
// Load Page Specific Includes
		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_generalsettings/_gs_gis_settings.inc.php");				
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");

if (!isset($_POST["formsubmit"])) {

// This is a FUNCTION LOADED FROM THE TEMPLATE BROWSER
//		Anytime a window is openned from the template browser the following should be loaded into the FORM
//----------------------------------------------------------------------------------------------\\
			$bstart_date 	= $_GET['startdate'];												// The 'TB' Start Date 	(nonSQL)
			$bend_date 		= $_GET['enddate'];													// The 'TB' End Date 	(nonSQL)

//	Start Form Set Variables
	
	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "edittable";													// HTML Name for Form
			$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= "";															// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget
	
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= "TOOL: Manufacture LargeScale Shape Coords";					// Name of the FORM, shown to the user
			$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
			$subtitle 			= "Copy the Coordinates from the KML file into the text box";	// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= 0;													// See Summary Function for how to use this number
				$returnHTML				= 0;													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
					
		include("includes/_template/_tp_blockform_form_header.binc.php");

	// FORM ELEMENTS
	//-----------------------------------------------------------------------------------------\\	
	//
	//				Field Name			Field Text Name				Field Comment						Field Notes												Field Format		Field Type	Field Width		Field Height	Default Value			Field Function		
	//form_new_control("disdate"			,"Date"				, "Enter the date this inspection was marked as a duplicate","The current date has automatically been provided!","(mm/dd/yyyy)",1,10,0,"current",0);
	//form_new_control("distime"			,"Time"				, "Enter the time this inspection was marked as a duplicate","The current time has automatically been provided!","(hh:mm:ss) - 24 hours",1,10,0,"current",0);
	//form_new_control("disauthor"		,"Entry By"			, "Who found and reported this inspection","Your name has automatically been provided!","(cannot be changed)",3,50,0,$_SESSION['user_id'],"systemusercombobox");
	form_new_control("shapetext"		,"KML GE Poly"			, "Copy KML Polygon Coordinates from KML Raw File","Open the KML file in a text Editor","",2,35,4,"",0);
	//form_new_control("disarchive"		,"Mark Archieved"	, "Checking this box will mark the inspection as archieved","Only do this if you are sure you need to archieve it","(checked = archieved)",5,35,4,"current",0);
	//
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 1;														// 1: Display Submit Button,	0: No
				$submitbuttonname	= 'Create LargeScale Shape';									// Name of the Submit Button
			$display_close			= 1;														// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
			$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");
	
		}
	else {
		
		// Do the Work of converting the KML file string into a LargeScale Shape File
		
		//	MAP_HEIGHT 	= $maparray[0][2]
		//	MAP_WIDTH	= $maparray[0][1]
		
		// Explode string into array
		
		//Try string replace on 0
		
		echo "<br> String: ".$_POST['shapetext']."<br>";
		
		$gelocations_a	= str_replace(",0 ",",0,",$_POST['shapetext']);
		
		echo "<br> String: ".$gelocations_a."<br>";
		
		$gelocations_a = substr_replace($gelocations_a ,"",-1);
		
		echo "<br> String: ".$gelocations_a."<br>";
		
		$gelocations_a	= explode(",",$gelocations_a);
		$size_of_array 	= count($gelocations_a);

		$x_string		= "";
		$y_string		= "";
		$z_string		= "";

		// LOOP THROUGH THE ARRAY
		
		for ($k=0; $k<count($gelocations_a); $k=$k+3) {		
				// 	[0] is an Long
				//	[1] is a Lat
				//	[2] is a height
				
				echo "<br> K: ".$k." <br>";
				echo "<br> yt: ".$gelocations_a[$k].", xt: ".$gelocations_a[$k+1].", zt: ".$gelocations_a[$k+2]."<br>";
				
				$tmp_x	= (-$gelocations_a[$k]/$delta_x) - ($long0/$delta_x);
				$tmp_x	= round($tmp_x,0);
				
				$tmp_y	= ($gelocations_a[$k+1]/$delta_y)-($lat0/$delta_y);
				$tmp_y	= round($tmp_y,0);
				
				
				//$tmp_x	= ((-1 * $gelocations_a[$k+1]) + 90) * ($maparray[0][2]/180);
				//$tmp_x	= round($tmp_x,0);
				//$tmp_y	= (($gelocations_a[$k] + 180) * ($maparray[0][1]/360));
				//$tmp_y	= round($tmp_y,0);
				
				//$tmp_x	= (($gelocations_a[$k] + 180) * ($maparray[0][1]/360));
				//$tmp_x	= round($tmp_x,0);
				//$tmp_y	= ((-1 * $gelocations_a[$k+1]) + 90) * ($maparray[0][2]/180);
				//$tmp_y	= round($tmp_y,0);
				
				
				
				$tmp_z	= ($gelocations_a[$k+2]);
				$tmp_z	= round($tmp_z,0);
				
				$x_string = $x_string.$tmp_x.",";
				$y_string = $y_string.$tmp_y.",";
				$z_string = $z_string.$tmp_z.",";
				
		}
		
		echo "<br> X:".$x_string."<br>";
		echo "<br> Y:".$y_string."<br>";
		echo "<br> Z:".$z_string."<br>";
	}		
		?>