<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Summary Report General.php			The Summary Report General Page takes a supplied set of arrays and strings and makes a generic report displayed inline with the OpenAirport layout specified in header.php
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
							

							
	NOTE: THERE SHOULD BE NO NEED TO CHANGE ANY OF THE CODE ON THIS PAGE
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		include("includes/header.php");															// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		
	// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);

	// Get string information from the POST process of the form which action was this page
	
		$tblkeyfield			= $_POST['tblkeyfield'];
		$tblarchivedfield		= $_POST['tblarchivedfield'];		
		$tbldatesortfield		= $_POST['tbldatesortfield'];											
		$tbldatesorttable		= $_POST['tbldatesorttable'];											
		$tbltextsortfield		= $_POST['tbltextsortfield'];											
		$tbltextsorttable		= $_POST['tbltextsorttable'];											
		$functioneditpage		= $_POST['editpage'];													
		$functionsummarypage		= $_POST['summarypage'];												
		$functionprinterpage		= $_POST['printerpage'];												
		//$sql 					= $_POST['frmurl'];															
		$menuitemid 			= $_POST['menuitemid'];													
		$tblname				= $_POST['tblname'];													
		$tblsubname			= $_POST['tblsubname'];													

	// Take the seralized array which was submited with the Form and build the a new array which can be used by this page for performing actions
	// There are two phases, (1). Get the information from the POST and replace | with ", this is needed due to how the information is sent via the POST process.
	// Step (2). is to take the string replaced serialized array and rebuild it into an actuall array.
	
		$adatafield 			= unserialize(str_replace("|","\"",$_POST['adatafield']));				
		$adatafieldtable 		= unserialize(str_replace("|","\"",$_POST['adatafieldtable']));			
		$adatafieldid 			= unserialize(str_replace("|","\"",$_POST['adatafieldid']));				
		$adataspecial			= unserialize(str_replace("|","\"",$_POST['adataspecial']));			
		$aheadername			= unserialize(str_replace("|","\"",$_POST['aheadername']));				
		$ainputtype			= unserialize(str_replace("|","\"",$_POST['ainputtype']));				
		$ainputcomment			= unserialize(str_replace("|","\"",$_POST['ainputcomment']));			
		$adataselect			= unserialize(str_replace("|","\"",$_POST['adataselect']));				
	
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
	
	// Step 1: 
	
			// Get ID of the training record these support documents belong to:
			
			$main_recordid	= $_POST['recordid'];
			
	// Step 2:
	
			// What type of training record is this?
			
			$sql = "SELECT * FROM tbl_139_303_main 
					INNER JOIN tbl_139_303_sub_t ON 
					139_303_type_cb_int = inspection_type_id 
					WHERE 139_303_id = '".$main_recordid."' ";
	
			//echo $sql;
					
			$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
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
										$tmp_date_of_training				= $objfields['139_303_date'];
									}	// End of While Statement
							}	// End of object Statement
					}	// End of Connection Statement
	
	// Step 3: 
	
			// Get names of documents
			
			$sylabus		= $_POST['uploadedfile_SYLABUS'];
			$attendance	= $_POST['uploadedfile_ATTENDANCE'];
	
	// Step 4:
	
			// Setup directory structure
			
			// Target Path needs to be dynamic depending on the name of the building and the part name
					// Directory Structure should be:
					//		Documents/	Training	/	***Type_of_Training***	/	***DateofTraining***	/	***ID of Training Session***
					//						/	$tmp_name_of_type		/	$tmp_date_of_training	/	$recordid
	
			$tmp_name_of_type		= str_replace(" ","_",$tmp_name_of_type);
			$tmp_date_of_training		= str_replace(" ","_",$tmp_date_of_training);
			$tmp_sylabus			= str_replace(" ","_",$sylabus);
			$tmp_attendance			= str_replace("\\","_",$attendance);
			
			$tmpdirstring = "documents/Training/".$tmp_name_of_type."/".$tmp_date_of_training	."/".$recordid."/";
			
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
						 user_error("Can't create folder \"$parent_folder_path\".");
					}
			
			// Make the directory
			
				mk_dir($tmpdirstring);

	// Step 6:
	
			// Save files to the local drive
						
			$target_path_sylabus 		= $tmpdirstring . basename( $_FILES['uploadedfile_SYLABUS']['name']);
			$target_path_attendance 	= $tmpdirstring . basename( $_FILES['uploadedfile_ATTENDANCE']['name']);
			
	// Step 7:
	
			// Update Main Training Record with the locations of the supporting documents
										
				$sql = "UPDATE tbl_139_303_main SET 139_303_sylabus = '".$target_path_sylabus."', 139_303_attendance = '".$target_path_attendance."'  WHERE 139_303_id = '".$_POST["recordid"]."'";
				//echo $sql;
				$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");				
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

				if(move_uploaded_file($_FILES['uploadedfile_SYLABUS']['tmp_name'], $target_path_sylabus)) {
				  //  echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
					" has been uploaded";
				} else{
				   // echo "There was an error uploading the file, please try again!";
				}
				if(move_uploaded_file($_FILES['uploadedfile_ATTENDANCE']['tmp_name'], $target_path_attendance)) {
				  //  echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
					" has been uploaded";
				} else{
				   // echo "There was an error uploading the file, please try again!";
				}
					?>
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
															<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									Uploaded Support Documents
									</td>
								<td class="tableheaderright">
									(Your files have been updated)
									</td>
								</tr>
								</tr>
							<tr>
								<td colspan="3" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
										<tr>
											<form enctype="multipart/form-data" action="part139303_main_upload_entry.php" method="POST" name="uploaddocument">
											<td align="center" valign="middle" class="formoptions">
												Uploaded Sylabus Document
												</td>
											<td class="formanswers">
												<?=$target_path_sylabus;?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions">
												Uploaded Class Attendance Document
												</td>
											<td class="formanswers">
												<?=$target_path_attendance;?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>				
				</td>
			</tr>
		</table>
			<?

// END OF FILE
?>
<?
//include("includes/footer.php");		// include file that gets information from form POSTs for navigational purposes
?>
