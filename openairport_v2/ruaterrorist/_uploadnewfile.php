<?
//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//==============================================================================================
//	
//	oooo	o   o	 ooo	ooooo
//	o	o	o	o	o	o	  o
//	o	o	o	o	o	o	  o
//	oooo	o   o	ooooo	  o	
//	o  o	o	o	o	o	  o
//	o	o	o	o	o	o	  o
//	o	o	ooooo	o   o	  o
//
//	The "Are You a Terrorist?" (RUAT) system.
//
//	Designed, Coded, and Supported by Erick Alan Dahl
//
//	Copywrite 2008 - Erick Alan Dahl
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	_uploadnewfile.php
//
//	Purpose of Page		:	FORM SIDE 	- Allows User to upload a new file CSV
//							SERVER SIDE - Uploads file to users file location and saves info to database.
//
//==============================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

// Prevent System From Timeing out while doing a search of the database	   
		set_time_limit(0);
		
// Include Files nessary to complete any tasks assigned.		
		include("includes/generalsettings.php");
		include("includes/functions.php");
		include("includes/interface.php");

// Establish Page Name			
		$pagename = 'Upload a new CSV File';		
		
// Check to see if a user is currently logged Into the System.  We do this to prevent direct linking
//	to the document. If someone tries to direct link to the page, the broweser will show a 404 error.
		//echo "Session ID is [".$_SESSION['user_id'],"]";
		if ($_SESSION['user_id'] == '') {
				//echo "There has been a request for this page outside of normal operating procedures<br>";
				send_404();
			}
			else {
				//echo "The request for this page seems to be in order, allow page to be displayed <br>";
				?>
<HTML>
	<HEAD>
		<TITLE>
			Transportation Security Administration SSI - Upload New/Replacement Compare File
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		</HEAD>
	<BODY>
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td colspan="2">
					<?
					breadcrumbs('_uploadnewfile.php', $pagename);
					$function = "Accessed Page: ".$pagename;
					put_systemactivity($_SESSION["user_id"],$function);
					?>
					</td>
				</tr>
			<tr>
				<td colspan="2" class="newTopicTitle">
					<?=$pagename;?>
					</td>
				</tr>
			<tr>
				<td colspan="2" class="newTopicBoxes">
					<p>
						You are allowed one CSV in the system at any one time. The CSV should contain 
						all of the people you are required to compare to the watch lists in the format 
						given in the <a href="guidelines.php">guidelines</a>. If you have any questions 
						about the format of this file please contact the administrator.
						</p>
					</td>
				</tr>
		<?
		if ($_POST['formsubmit'] != "1") {
				// Display form
				?>
			<tr>
				<td align="center" valign="middle" class="newTopicNames">
					Upload Document (<a href="guidelines.php">see guidelines</a>)
					</td>
				<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" enctype="multipart/form-data" action="_uploadnewfile.php" method="POST" name="uploaddocument">
				<td class="newTopicBoxes" align="right">
					<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
					<input type="hidden" name="MAX_FILE_SIZE" value="5000000">
					<input type="hidden" name="formsubmit" value="1">
					<input class="newTopicInput" name="uploadedfile" type="file" size="60"><br />
					</td>
					</form>
				</tr>
			<tr>
				<td class="newTopicNames" colspan="2" align="right">
					<input class="button" type="button" name="button" value="Upload" onclick="javascript:document.uploaddocument.submit()">
					</td>
				</tr>
				<?
				}
				else {
					$tmp_userid 		= $_SESSION["user_id"];
					$tmpdirstring 		= "files/".$tmp_userid."/";
					mkdir_recursive($tmpdirstring,0777);			

					// Do a test to see what kind of file the user uploaded
					$file_extension		= $_FILES['uploadedfile']['name'];
					$a_file_extension 	= explode(".",$file_extension);
					$file_extension		= strtolower($a_file_extension[1]);
					//echo "The file extension is ".$file_extension."<br>";
					
					if ($file_extension == "csv") {
							// Uploaded file is a CSV
							// Do CSV stuff
					
							$target_path 		= $tmpdirstring . basename( $_FILES['uploadedfile']['name']);
							//echo "The Target Path is ".$target_path."<br>";
							$fcontents 			= file ($target_path);
							//echo "fContents is ".$fcontents."<br>";
							$tmp_sizeoffile		= sizeof($fcontents);
							$rowcounter 		= $tmp_sizeoffile;
							
							// Get information about the last line in the file
									$line 				= trim($fcontents[$rowcounter],',');
									$a_fline			= explode(",",$line);
									//echo "File has ".$tmp_sizeoffile." rows, the last line in the file is ".$line." <br>";
																		
									// We need to know if this line has more than one element?  If it has only one, then it is a blank line.
									if (isset($a_fline[1])) {
											//echo "There is an element in the second element in the array <br>";
										}
										else {
											//echo "There is NOT an element in the second element in the array <br>";
										}
								
							if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
									//  echo "The file ".  basename( $_FILES['uploadedfile']['name']). " has been uploaded";	
									$upload_completed = 1;
									
									$sql = "SELECT * FROM tbl_users_files WHERE user_f_parent_id = '".$tmp_userid."' ";
									//echo "SQL 1:".$sql."<br>";
									$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
									if (mysqli_connect_errno()) {
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}
										else {
											$objrs_support = mysqli_query($objconn_support, $sql);
											if ($objrs_support) {
													$number_of_rows = mysqli_num_rows($objrs_support);
													if ($number_of_rows == 0) {
															// There are no records, so this is a new entry
															$sql2 = "INSERT INTO tbl_users_files (user_f_name,user_f_rows, user_f_parent_id) VALUES ( '".$target_path."', ".$rowcounter.", ".$tmp_userid." )";
															//echo "SQL 2:".$sql2."<br>";
														}
													while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
															$tmp_user_f_id = $objfields['user_f_id'];
															$sql2 = "UPDATE tbl_users_files SET user_f_name = '".$target_path."', user_f_rows = ".$rowcounter." WHERE user_f_id = ".$tmp_user_f_id." ";
															//echo "SQL is [[[ ".$sql2." ]]]<br><br>";
														}
												}
										}
									//echo $sql2;
									$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}		
										else {
											$objrs = mysqli_query($mysqli, $sql2) or die(mysqli_error($mysqli));
											//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
											//echo mysql_insert_id($mysqli);
											}
									//$function = "Uploaded a new User CSV file with SQL Statement [ ".$sql2." ] ";
									//put_systemactivity($_SESSION["user_id"],$function);
									?>
			<tr>
				<td colspan="2" align="center" valign="middle" class="newTopicNames">
					Your supporting CSV file has been uploaded and your records updated.
					</td>
				</tr>
									<?
								}
								else{
									// We would see this error if for some reason the system is 
									//	unable to move the file to the proper directory.
									?>
			<tr>
				<td colspan="2" align="center" valign="middle" class="newTopicNames">
					Error in upload...Can not create file locally
					</td>
				</tr>
									<?
								}
						}
						else {
							// Hey this isn't a good file to work with.  Toss an error
							$upload_completed = 0;
							?>
			<tr>
				<td colspan="2" align="center" valign="middle" class="newTopicNames">
					Error in upload...Wrong file format provided
					</td>
				</tr>
							<?
						}
						
					if ($upload_completed == 1) {
							// This is a good upload, do additional work for automation
						
							// Now lets automatically delete all of their old searchs and make new ones.
								
							$auto_hide_old_search		= 1;	// 1; will complete task, any other will not.
							//$auto_create_new_search	= 1;	// 1; will complete task, any other will not.
							$auto_hide_old_lists		= 1;	// 1; will complete task, any other will not.
							$auto_create_new_lists		= 1;	// 1; will complete task, any other will not.
							
							// AUTOMATION SETTING ....... HIDE OLD SEARCHS ....... AUTOMATION SETTING
							if ($auto_hide_old_search == 1) {
									// Automatically delete any exisiting searches for this user
									$sql = "UPDATE tbl_users_searchs SET user_s_archived_yn = 1 WHERE user_s_parent_id = '".$_SESSION["user_id"]."' ";
									$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}		
										else {
											$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
											?>
						<tr>
							<td colspan="2" align="center" valign="middle" class="newTopicNames">
								All of your existing searchs have been deleted.
								</td>
							</tr>
							<?
										}
								}
							
							// AUTOMATION SETTING ....... HIDE OLD LISTS ....... AUTOMATION SETTING	
							if ($auto_hide_old_lists == 1) {
									// Automatically hide any exisiting lists by this user
									$sql = "UPDATE tbl_users_lists SET user_l_archived_yn = 1 WHERE user_l_parent = '".$_SESSION["user_id"]."' ";
									//echo "SQL :".$sql."<br>";
									$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}		
										else {
											$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
											?>
						<tr>
							<td colspan="2" align="center" valign="middle" class="newTopicNames">
								All of your existing personnel lists have been deleted.
								</td>
							</tr>
							<?
										}
								}
							
							// AUTOMATION SETTING ....... CREATE NEW LISTS ....... AUTOMATION SETTING							
							if ($auto_create_new_lists == 1) {
									// Automatically parse CSV file into new records in this users personnel lists
									for($i=0; $i<sizeof($fcontents); $i++) {
									
											$line 				= trim($fcontents[$i],',');
											//$arr 				= explode(",",$line);
											
											$tokens				= splitWithEscape($line);
											//echo "Tokens ".$tokens."";
											
											//for($j=0; $j<sizeof($tokens); $j++) {
											//	echo "token # ".$j." is ".$tokens[$j]."<br>";
											//	}
											$tmp_last			= addslashes($tokens[0]);							// Fix Last Name
											$tmp_first			= addslashes($tokens[1]);							// Fix First Name
											$tmp_middle			= addslashes($tokens[2]);							// Fix Middle Name
											$tmp_type			= addslashes($tokens[3]);							// Fix "Type"   <-What is type again?
											$tmp_dob			= addslashes($tokens[4]);							// Fix Date of Birth
											$tmp_pob			= str_replace(",",";",$tokens[5]);
											$tmp_citizenship	= str_replace(",",";",$tokens[6]);
											$tmp_passport		= str_replace(",",";",$tokens[7]);
											$tmp_misc			= addslashes($tokens[8]);	
											
											$sql2 = "INSERT INTO tbl_users_lists (user_l_parent,user_l_archived_yn,user_l_last,user_l_first,user_l_middle,user_l_type,user_l_dob,user_l_pob,user_l_citizenship,user_l_passport,user_l_misc) 
											VALUES 
											( '".$_SESSION["user_id"]."','0', '".$tmp_last."', '".$tmp_first."', '".$tmp_middle."', '".$tmp_type."', '".$tmp_dob."', '".$tmp_pob."', '".$tmp_citizenship."', '".$tmp_passport."', '".$tmp_misc."' )";
											//echo "SQL 2:".$sql2."<br>";
											//$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
											if (mysqli_connect_errno()) {
													// there was an error trying to connect to the mysql database
													printf("connect failed: %s\n", mysqli_connect_error());
													exit();
												}		
												else {
													$objrs = mysqli_query($mysqli, $sql2) or die(mysqli_error($mysqli));
													//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
													//echo mysql_insert_id($mysqli);
													?>
													<?													
												}
										}
										?>
						<tr>
							<td align="center" valign="middle" class="newTopicNames">
								a new listing for each of your personnel has been created...
								</td>
						<form action="_managelist.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
							<td class="newTopicBoxes">		
								<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
								<input type="submit" value="Manage Lists" name="submit" class="button">
								</td>
								</form>	
							</tr>
							<?
								}
						}
						else {
							?>
			<tr>
				<td colspan="2" align="center" valign="middle" class="newTopicNames">
					There was an error in the file upload process, skipping automation settings...
					</td>
				</tr>
							<?
						}
				}
				?>
			<tr>
				<td colspan="12" class="newTopicEnder">
					&nbsp;
					<?
					display_copywrite_footer();
					?>
					</td>
				</tr>		
			</table>
		</body>
	</html>
	<?
	}
	?>