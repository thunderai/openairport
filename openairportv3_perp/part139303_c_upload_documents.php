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
//	Name of Document		:	part139303_c_upload_documents.php
//
//	Purpose of Page			:	Add Uploaded Documents to Part 139.303 (c) Training Record
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page

// Load Page Specific Includes

		include("includes/_modules/part139303/part139303.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");

if (!isset($_POST["formsubmit"])) {

		// FORM HEADER
		// -----------------------------------------------------------------------------------------\\
				$formname			= "edittable";													// HTML Name for Form
				$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
				$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
					$formtarget		= "";															// HTML Name for the window
					$location		= $formtarget;													// Leave the same as $formtarget
		
		// FORM NAME and Sub Title
		//------------------------------------------------------------------------------------------\\
				$form_menu			= "Upload Support Documents";									// Name of the FORM, shown to the user
				$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
				$subtitle 			= "Use this form to add paper documents";						// Subt title of the FORM, shown to the user

		// FORM SUMMARY information
		//------------------------------------------------------------------------------------------\\
				$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
					$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
					$idtosearch				= '';													// ID to look for in the summary function, this is typically $_POST['recordid'].
					$detailtodisplay		= 0;													// See Summary Function for how to use this number
					$returnHTML				= 0;													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
						
			include("includes/_template/_tp_blockform_form_header.binc.php");

		?>
		<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
		<?php
		
		// FORM ELEMENTS
		//-----------------------------------------------------------------------------------------\\	
		//
		//				Field Name			Field Text Name				Field Comment										Field Notes												Field Format		Field Type	Field Width		Field Height	Default Value			Field Function		
		form_new_table_b($formname);
		form_new_control("disoutline"		,"Class Outline"			, "Select the PDF Document for the Class Outline"	,"File Must be a PDF Document!"							,"(PDF)"			,6			,35				,0				,""						,0);
		form_new_control("dissignin"		,"Class Signin"				, "Select the PDF Document for the Class Singin"	,"File Must be a PDF Document!"							,"(PDF)"			,6			,35				,0				,""						,0);
	
		// FORM UNIVERSAL CONTROL LOADING
		//------------------------------------------------------------------------------------------\\
		
		$targetname		= $_POST['targetname'];			// From the Button Loader; Name of the window this form was loaded into.
		$dhtml_name		= $_POST['dhtmlname'];			// From the Button Loader; Name of the DHTML window function to call to change this window.
		form_uni_control("targetname"		,$targetname);
		form_uni_control("dhtmlname"		,$dhtml_name);
				
		//
		// FORM FOOTER
		//------------------------------------------------------------------------------------------\\
				$display_submit 		= 1;														// 1: Display Submit Button,	0: No
					$submitbuttonname	= 'Save Documents';											// Name of the Submit Button
				$display_close			= 1;														// 1: Display Close Button, 	0: No
				$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
				$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
				
			include("includes/_template/_tp_blockform_form_footer.binc.php");
	
	}
	else {

// FORM HEADER
		// -----------------------------------------------------------------------------------------\\
				$formname			= "edittable";													// HTML Name for Form
				$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
				$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
					$formtarget		= "";															// HTML Name for the window
					$location		= $formtarget;													// Leave the same as $formtarget
		
		// FORM NAME and Sub Title
		//------------------------------------------------------------------------------------------\\
				$form_menu			= "Upload Support Documents - Summary";							// Name of the FORM, shown to the user
				$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
				$subtitle 			= "Your Documents have been saved. Here is the information you provided";	// Subt title of the FORM, shown to the user

		// FORM SUMMARY information
		//------------------------------------------------------------------------------------------\\
				$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
					$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
					$idtosearch				= '';													// ID to look for in the summary function, this is typically $_POST['recordid'].
					$detailtodisplay		= 0;													// See Summary Function for how to use this number
					$returnHTML				= 0;													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
						
			include("includes/_template/_tp_blockform_form_header.binc.php");	
	
		form_new_table_b($formname);
		form_new_control("disoutline"		,"Class Outline"			, "Select the PDF Document for the Class Outline"	,"File Must be a PDF Document!"							,"(PDF)"			,1			,0				,0				,"post"						,0);
		form_new_control("dissignin"		,"Class Signin"				, "Select the PDF Document for the Class Singin"	,"File Must be a PDF Document!"							,"(PDF)"			,1			,0				,0				,"post"						,0);
		
		// FORM UNIVERSAL CONTROL LOADING
		//------------------------------------------------------------------------------------------\\
		
		$targetname		= $_POST['targetname'];			// From the Button Loader; Name of the window this form was loaded into.
		$dhtml_name		= $_POST['dhtmlname'];			// From the Button Loader; Name of the DHTML window function to call to change this window.
		form_uni_control("targetname"		,$targetname);
		form_uni_control("dhtmlname"		,$dhtml_name);
			
		//
		// FORM FOOTER
		//------------------------------------------------------------------------------------------\\
				$display_submit 		= 0;														// 1: Display Submit Button,	0: No
					$submitbuttonname	= '';														// Name of the Submit Button
				$display_close			= 1;														// 1: Display Close Button, 	0: No
				$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
				$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
				
			include("includes/_template/_tp_blockform_form_footer.binc.php");
			
	// Step 2:
	
			// What type of training record is this?
			
			$sql = "SELECT * FROM tbl_139_303_c_main 
					INNER JOIN tbl_139_303_c_sub_t ON 
					139_303_type_cb_int = inspection_type_id 
					WHERE 139_303_id = '".$_POST['recordid']."' ";
	
			//echo $sql;
					
			$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			
				if (mysqli_connect_errno()) {
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}
					else {
						$res = mysqli_query($mysqli, $sql);
						if ($res) {
								$number_of_rows = mysqli_num_rows($res);
								//printf("result set has %d rows. \n", $number_of_rows);
								while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {							
										$tmp_name_of_type				= $objfields['inspection_type'];
										$tmp_id_of_type					= $objfields['inspection_type_id'];
										$tmp_date_of_training			= $objfields['139_303_date'];
									}	// End of While Statement
							}	// End of object Statement
					}	// End of Connection Statement
	
	// Step 3: 
	
			// Get names of documents
			
			$sylabus		= $_POST['disoutline'];
			$attendance		= $_POST['dissignin'];
	
	// Step 4:
	
			// Setup directory structure
			
			// Target Path needs to be dynamic depending on the name of the building and the part name
					// Directory Structure should be:
					//		Documents/	Training	/	***Type_of_Training***	/	***DateofTraining***	/	***ID of Training Session***
					//						/	$tmp_name_of_type		/	$tmp_date_of_training	/	$recordid
	
			$tmp_name_of_type		= str_replace(" ","_",$tmp_name_of_type);
			$tmp_date_of_training	= str_replace(" ","_",$tmp_date_of_training);
			$tmp_sylabus			= str_replace(" ","_",$sylabus);
			$tmp_attendance			= str_replace("\\","_",$attendance);
			
			$tmpdirstring = "documents/Training/".$tmp_name_of_type."/".$tmp_date_of_training."/".$recordid."/";
			
			//echo $tmpdirstring;
			
	// Step 5:
	
			// Initiate Function to Make Directory
			
				function mk_dir($path, $rights = 0777) {
					  $folder_path = array(
					   strstr($path, '.') ? dirname($path) : $path);

					  while(!@is_dir(dirname(end($folder_path)))
							 && dirname(end($folder_path)) != '/'
							 && dirname(end($folder_path)) != '.'
							 && dirname(end($folder_path)) != '')
					   array_push($folder_path, dirname(end($folder_path)));

					  while($parent_folder_path = array_pop($folder_path))
					   if(!@mkdir($parent_folder_path, $rights))
						 echo '';
					}
			
			// Make the directory
			
				mk_dir($tmpdirstring);

	// Step 6:
	
			// Save files to the local drive
						
			$target_path_sylabus 		= $tmpdirstring . basename( $_FILES['disoutline']['name']);
			$target_path_attendance 	= $tmpdirstring . basename( $_FILES['dissignin']['name']);
			
	// Step 7:
	
			// Update Main Training Record with the locations of the supporting documents
										
				$sql = "UPDATE tbl_139_303_c_main SET 139_303_sylabus = '".$target_path_sylabus."', 139_303_attendance = '".$target_path_attendance."'  WHERE 139_303_id = '".$_POST["recordid"]."'";
				
				//echo $sql;
				
				$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($mysqli);
						}

				if(move_uploaded_file($_FILES['disoutline']['tmp_name'], $target_path_sylabus)) {
				  //  echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
					" has been uploaded";
				} else{
				   // echo "There was an error uploading the file, please try again!";
				}
				if(move_uploaded_file($_FILES['dissignin']['tmp_name'], $target_path_attendance)) {
				  //  echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
					" has been uploaded";
				} else{
				   // echo "There was an error uploading the file, please try again!";
				}
	}
