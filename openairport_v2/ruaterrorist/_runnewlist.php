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
//	Name of Document	:	_nimba_users.php
//
//	Purpose of Page		:	FORM SIDE 	- Links to Edit User and Add User
//							SERVER SIDE - Lists Users in the database
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
		$pagename = 'Create New CSV from List';		
		
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
			RUAT - User Controls
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		</HEAD>
	<BODY>
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td colspan="10">
					<?
					breadcrumbs('_managelist.php', $pagename);
					?>
					</td>
				</tr>		
			<tr>
				<td colspan="10" class="newTopicTitle">
					<?=$pagename;?>
					</td>
				</tr>
			<tr>
				<td colspan="10" class="newTopicBoxes">
					<p>
						This function will take the people listed in the 'Lists' and make a new CSV.
						</p>
					</td>
				</tr>			
<?
$path = "files/".$_SESSION['user_id']."/auto_csv.csv";
$fh = fopen($path,'w');
//$flds = array("Last Name","First Name","Middle Name","Type","DOB","POB","Citizenship","Passpost","MISC");
//fputcsv($fh,$flds);
$sql = "SELECT * FROM tbl_users_lists WHERE user_l_parent = ".$_SESSION['user_id']." AND user_l_archived_yn = 0 ";

//echo $sql;

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
							$failed = 1;
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
					
						$tmp_pob			= str_replace(",",";",$objfields['user_l_pob']);
						$tmp_citizenship	= str_replace(",",";",$objfields['user_l_citizenship']);
						$tmp_passport		= str_replace(",",";",$objfields['user_l_passport']);
						$tmp_misc			= trim(str_replace(",",";",$objfields['user_l_misc']));
						
						$line 				= $objfields['user_l_last'].','.$objfields['user_l_first'].','.$objfields['user_l_middle'].','.$objfields['user_l_type'].','.$objfields['user_l_dob'].','.$tmp_pob.','.$tmp_citizenship.','.$tmp_passport.','.$tmp_misc.'';
						//echo "Line is ".$line."<br>";						
						fputcsv($fh, split(',', $line));
						}
						?>
			<tr>
				<td colspan="10" align="center" valign="middle" class="newTopicNames">
					New CSV File has been created...
					</td>
				</tr>	
						<?				
				}
		}
fclose($fh);

// Well that was fun, now we need to set it up as a default CSV and update the Database...

		$fcontents 			= file ($path); 
		$tmp_sizeoffile		= sizeof($fcontents);
		$rowcounter 		= $tmp_sizeoffile;
		
		
		$sql = "SELECT * FROM tbl_users_files WHERE user_f_parent_id = '".$_SESSION['user_id']."' ";
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
								$sql2 = "INSERT INTO tbl_users_files (user_f_name,user_f_rows, user_f_parent_id) VALUES ( '".$path."', ".$rowcounter.", ".$_SESSION['user_id']." )";
							}
						while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
								$tmp_user_f_id = $objfields['user_f_id'];
								$sql2 = "UPDATE tbl_users_files SET user_f_name = '".$path."', user_f_rows = ".$rowcounter." WHERE user_f_id = ".$tmp_user_f_id." ";
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
				?>
			<tr>
				<td colspan="10" align="center" valign="middle" class="newTopicNames">
					The new CSV file has been set as your default CSV file. It has replaced the CSV you had...
					</td>
				</tr>	
				<?	
			}
			
		$sql = "UPDATE tbl_users_lists SET user_l_archived_yn = 1 WHERE user_l_parent = '".$_SESSION["user_id"]."' ";
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
				<td colspan="10" align="center" valign="middle" class="newTopicNames">
					All of your existing personnel lists have been deleted...
					</td>
				</tr>
				<?
			}		
		// Automatically parse CSV file into new records in this users personnel lists
		for($i=0; $i<sizeof($fcontents); $i++) {
		
				$line 				= trim($fcontents[$i],',');
				//$arr 				= explode(",",$line);
				
				$tokens				= splitWithEscape($line);
				//echo "Tokens ".$tokens."";
				
				//for($j=0; $j<sizeof($tokens); $j++) {
				//	echo "token # ".$j." is ".$tokens[$j]."<br>";
				//	}
				$tmp_last			= addslashes($tokens[0]);
				$tmp_first			= addslashes($tokens[1]);
				
				$tmp_pob			= str_replace(",",";",$tokens[5]);
				$tmp_citizenship	= str_replace(",",";",$tokens[6]);
				$tmp_passport		= str_replace(",",";",$tokens[7]);
				$tmp_misc			= trim(str_replace(",",";",$tokens[8]));
				//$tmp_misc			= trim($tmp_misc);
				
				$sql2 = "INSERT INTO tbl_users_lists (user_l_parent,user_l_archived_yn,user_l_last,user_l_first,user_l_middle,user_l_type,user_l_dob,user_l_pob,user_l_citizenship,user_l_passport,user_l_misc) 
				VALUES 
				( '".$_SESSION["user_id"]."','0', '".$tmp_last."', '".$tmp_first."', '".$tokens[2]."', '".$tokens[3]."', '".$tokens[4]."', '".$tmp_pob."', '".$tmp_citizenship."', '".$tmp_passport."', '".$tmp_misc."' )";
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