<?
ob_start();
set_time_limit(0);
//include("includes/functions.php");	
include("_runsearch_sub_f.php");

$pagename = 'Nightly Maintenance (event)';

//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012

function hideallnotices() {
		$sql = "UPDATE tbl_users_notice SET user_n_archived_yn = 1";
		$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
				$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
				//echo "The Query has been deleted<br><br>You may now close this window";
				//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
				//echo mysql_insert_id($mysqli);
				}
	}				


function striplinesfromcsv($numberoflines,$filename) {
		// Removes x number of lines from the given CSV file
		
		$fileName = 'nightlies/'.$filename;
		$a = preg_replace("/^(.*?\n){0,$numberoflines}/",'', file_get_contents($fileName));
		$b = fopen($fileName, 'w');
		fwrite($b, $a);
		fclose($b);
		
		//$filename = 'nightlies/'.$filename;		
		//$file = file($filename);
		//file_put_contents($filename, implode("\n", array_slice($file, $numberoflines)));
		
		echo " > > > Stripping ".$numberoflines." lines from '".$filename."' <br>";
	}

function convertxls($input,$output,$worksheetid) {
		// Takes the XLS File and converts just the ADD Tab to an CSV File for import later.
		// starting excel 
		$excel = new COM("excel.application") or die("Unable to instanciate excel"); 
		//print "Loaded excel, version {$excel->Version}\n"; 

		//bring it to front 
		//$excel->Visible = 1;//NOT
		//dont want alerts ... run silent 
		$excel->DisplayAlerts = 0; 

		//open  document 
		//$filetoopen = "c:/xampplite/htdocs/www.watertownsdairport.com/openairport_php/ruaterrorist/nightlies/".$input."";
		$filetoopen = "C:/xampp/htdocs/www.watertownsdairport.com/openairport_php/ruaterrorist/nightlies/".$input."";
		echo "File to Open is ".$filetoopen." <br>";
		$excel->Workbooks->Open($filetoopen); 
		//XlFileFormat.xlcsv file format is 6
		//saveas command (file,format ......)

		$sheet = $excel->WorkSheets($worksheetid);
		$sheet->activate;
		//$filetosave = "c:/xampplite/htdocs/www.watertownsdairport.com/openairport_php/ruaterrorist/nightlies/".$output."";
		$filetosave = "C:/xampp/htdocs/www.watertownsdairport.com/openairport_php/ruaterrorist/nightlies/".$output."";
		echo "File to Save is ".$filetosave." <br>";
		$excel->Workbooks[1]->SaveAs($filetosave,6); 

		//closing excel 
		$excel->Quit(); 

		//free the object 
		unset($excel);
		//$excel->Release(); 
		$excel = null; 
		echo " > > > File ".$input." has been converted to a CSV file name ".$output." <br>";
	}

function sendusernotice($objconn_support,$userid,$typeofnotice,$array_notice) {
		// Takes the User ID, updates their Notice Table and allows the user to reach the NOTICE Menu item
		$tmp_date = date('Y/m/d');
		$sql = "INSERT INTO tbl_users_notice (user_n_type,user_n_sub_id,user_n_parent_id,user_n_date) VALUES ( '".$typeofnotice."','".$array_notice."', '".$userid."','".$tmp_date."' )";
		//echo $sql;
		//$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");	
		// ^, Use Active Connection, rather than creating a new one
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
				$objrs = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
				//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
				//echo mysql_insert_id($mysqli);
			}
	}

//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012

function importdata($tablename,$filename) {
		// Takes the input file and places the contents in the tablename
		// FIRST -- FLUSH whatever table is selected
				$objconn 	= mysqli_connect("localhost", "ruatuser", "limitaccess", "tsa_ruat");
				$sql 		= "TRUNCATE TABLE `$tablename`"; 
				$objrs 		= mysqli_query($objconn, $sql) or die(mysqli_error($objconn));
		// Next -- IMPORT the file into the database
				$objconn 	= mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
				$sql 		= "
								LOAD DATA LOCAL INFILE '$filename'
								INTO TABLE `$tablename`
								FIELDS TERMINATED BY ',' 
								LINES TERMINATED BY '\n'
								(ruat_tsa_sid, ruat_tsa_cleared, ruat_tsa_last_name,ruat_tsa_first_name,ruat_tsa_middle_name,ruat_tsa_type,ruat_tsa_DOB,ruat_tsa_last_POB,ruat_tsa_citizanship,ruat_tsa_passport,ruat_tsa_misc)";
				$objrs 		= mysqli_query($objconn, $sql) or die(mysqli_error($objconn));				
		// NOW -- Display a Notice to the User that this process has been complerted
				echo "The table has been flushed and a new set has been imported<br>";
				
		// We Need to know how many rows are in the imported record
		// The problem is that doing an $fcontents on the lists causes a memory overrun, so lets 
		// 		loop through the new records and just get a row count.
		
		$sql = "SELECT * FROM ".$tablename. " ";
		$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs_support = mysqli_query($objconn_support, $sql);
				if ($objrs_support) {
						$number_of_rows = mysqli_num_rows($objrs_support);
					}
					mysqli_free_result($objrs_support);
					mysqli_close($objconn_support);
			}
	return $number_of_rows;
	}		

//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012

function appenddata($tablename,$filename) {
		// Takes the input file and places the contents in the tablename
		// FIRST -- FLUSH whatever table is selected
				//$objconn 	= mysqli_connect("localhost", "ruatuser", "limitaccess", "tsa_ruat");
				//$sql 		= "TRUNCATE TABLE `$tablename`"; 
				//$objrs 		= mysqli_query($objconn, $sql) or die(mysqli_error($objconn));
		// Next -- IMPORT the file into the database
				$objconn 	= mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
				$sql 		= "
								LOAD DATA LOCAL INFILE '$filename'
								INTO TABLE `$tablename`
								FIELDS TERMINATED BY ',' 
								LINES TERMINATED BY '\n'
								(ruat_tsa_sid, ruat_tsa_cleared, ruat_tsa_last_name,ruat_tsa_first_name,ruat_tsa_middle_name,ruat_tsa_type,ruat_tsa_DOB,ruat_tsa_last_POB,ruat_tsa_citizanship,ruat_tsa_passport,ruat_tsa_misc)";
				$objrs 		= mysqli_query($objconn, $sql) or die(mysqli_error($objconn));				
		// NOW -- Display a Notice to the User that this process has been complerted
				echo "The table has been flushed and a new set has been imported<br>";
				
		// We Need to know how many rows are in the imported record
		// The problem is that doing an $fcontents on the lists causes a memory overrun, so lets 
		// 		loop through the new records and just get a row count.
		
		$sql = "SELECT * FROM ".$tablename. " ";
		$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs_support = mysqli_query($objconn_support, $sql);
				if ($objrs_support) {
						$number_of_rows = mysqli_num_rows($objrs_support);
					}
					mysqli_free_result($objrs_support);
					mysqli_close($objconn_support);
			}
	return $number_of_rows;
	}		

//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012

function importrecord($tablename,$date,$time,$rows) {	


	$sql = "INSERT INTO tbl_import_history (import_type,import_date,import_time,import_rows) VALUES ( '".$tablename."','".$date."', '".$time."', '".$rows."' )";
	$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
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
	}

//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012
	
function sendemailalerts($objconn_support) {

	$resultsreturn	= 0;
	$counter 		= 0;

	//get searchs that are set for an email alert
	$sql = "SELECT * FROM tbl_users_searchs 
			INNER JOIN tbl_users ON tbl_users.user_id = tbl_users_searchs.user_s_parent_id 
			WHERE user_s_send_email = 1 AND user_s_archived_yn = 0 AND user_archived_yn = 0 
			ORDER BY user_id ";
	//$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
	// ^, Use Active Connection, rather than creating a new one
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					echo "There are ".$number_of_rows." rows to search <br>";
					echo "Start sorting through saved searches...<br>";
					echo "-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-<br>";
					$number_of_rows2 = $number_of_rows + 1;
					if ($number_of_rows == 0) {
							echo "There are no records from which to email or conduct a search on <br>";
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							echo "Currently conducting a search on saved search # ".$objfields['user_s_id'].", the ".$counter." saved search today <br>";
							if ($previousid == $objfields['user_id']) {
									$notice 	= 1;
									//What Row is this?
								}
								else {
									// This is a different user now... Update the users table for notice saying he has one, and the type
									//sendusernotice($previousid,'Search Result Found',$array_notice);
									$notice 	= 0;
									$counter 	= 0;
								}
					
					
/*  						<?=$objfields['user_s_id'];?> /
							<?=$objfields['user_s_name'];?> /
							<?=$objfields['user_s_who'];?> /
							<?=$objfields['user_s_table'];?> /
							<?=$objfields['user_s_sql'];?> /
							<?=$objfields['user_name'];?> /
							<?=$objfields['user_pass'];?> /
							<?=$objfields['user_email'];?>
							<br><br>  */
							
							$debug		= 0;		// 1, wont send an email
							$emailtype 	= 1;		// 1; will not send a complete listing of matches found, 2; will.
							
							if ($emailtype == 1) {
									// Give user the shaft and provide them almost nothing
									$resultsarray 	= generatequicksearchresults($objconn_support,$objfields['user_s_id'],$objfields['user_id']);
									$HTML 			= generatefunkhtml($objfields['user_s_who'],$objfields['user_s_table'],$subject);
									$recordsfound 	= $resultsarray[1];
								}
								else {
									// Lets gie the user everything we can				
									$resultsarray 	= generatesearchresults($objconn_support,$objfields['user_s_id'],$objfields['user_id']);
									$HTML 			= $resultsarray[0];
									$recordsfound 	= $resultsarray[1];
								}
							
							$headers = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$subject = "*SSI* Automated TSA Query for ".$objfields['user_s_who']." from ".$objfields['user_s_table']." *SSI*";
							
							if ($recordsfound == 0) {
									echo " > > No matches were found as part of this saved search.  No email will be sent <br>";
									//$tmp_not_send = $tmp_not_send + 1;
									
									// Build an array that we can search latter sorted by user ID that tells us if a match was found there or not.	
									if ($a_notfound[$objfields['user_id']] == 1) {
											// This value is already set to 1, we should leave it as set to 1
											// Do nothing additional
										}
										else {
											// Value was not one, and it should be set to zero.
											$a_notfound[$objfields['user_id']] = 0;
											echo "Array Element ".$objfields['user_id']." is equal to ".$a_notfound[$objfields['user_id']]." <br>";
										}
								}
								else {
									// Build an array that we can search latter sorted by user ID that tells us if a match was found there or not.	
									$a_notfound[$objfields['user_id']] = 1;
									echo " > > <b>A MATCH HAS BEEN FOUND.  SENDING AN EMAIL TO USER TO NOTIFY THEM </B><br>";
									//$tmp_send = $tmp_send + 1;
									$array_notice[$counter] = $objfields['user_s_id'];
									
									if ($debug == 1) {
											// Do not send email, echo results though
											echo "<font size='1'><b> --------------------------------------------------- </b><br>";
											echo "<font size='1'> Results Found - ".$resultsarray[1]."<br>";
											echo "<font size='1'> HTML Code ----- ".$HTML."<br>";
											echo "<font size='1'> Subject ------- ".$subject."<br>";
											echo "<font size='1'> eMail Headers - ".$headers."<br>";
											//sendusernotice($objfields['user_id'],'Search Result Found',$objfields['user_s_id']);
											echo "<font size='1'><b> --------------------------------------------------- </b><br>";
										}
										else {
											// GO Swiftly into the night			
											echo "<font size='1'><b> --------------------------------------------------- </b><br>";
											echo "<font size='1'> Results Found - ".$resultsarray[1]."<br>";
											echo "<font size='1'> HTML Code ----- ".$HTML."<br>";
											echo "<font size='1'> Subject ------- ".$subject."<br>";
											echo "<font size='1'> eMail Headers - ".$headers."<br>";											
											sendreportbyemail($objfields['user_email'],$subject,$HTML,$headers);
											sendusernotice($objconn_support,$objfields['user_id'],'Search Result Found',$objfields['user_s_id']);
											$resultsreturn = ($resultsreturn + 1);
											echo "<font size='1'><b> --------------------------------------------------- </b><br>";
										}
								}
								//echo "<br>".$HTML."<br>";
							
							$counter = ($counter +1);
							$previousid = $objfields['user_id'];
						}			
				}
				//mysqli_free_result($objrs_support);
				//mysqli_close($objconn_support);
		}
		
		echo "<br>";
		echo "------------------------------------------------------------------------------------<br>";
		echo "Finished Searching Data, Moving to Next Step<br>";
		echo "------------------------------------------------------------------------------------<br>";
		echo "<br>";
		
		// Finished Sorting Saved Search Records. If any matches have been found an email was sent to that user 
		//	telling them about the match. The problem is that this dones not tell the user a test was run and no 
		//	matches have been found. There needs to be some reasurance that the test was run and nothing was found.
		//	This next part will do just that
		
		$sendnegative	= 1;	// 1; will send an email telling the user nothing was found, 0; will not.
		
		if ($sendnegative == 1) {
				// Send Negative Email -- Must check to see if we even have to by sorting the array and checking if the value of the array is 0 or 1.
				$sql = "SELECT * FROM tbl_users WHERE user_archived_yn = 0";
				$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
				if (mysqli_connect_errno()) {
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}
					else {
						$objrs_support = mysqli_query($objconn_support, $sql);
						if ($objrs_support) {
								$number_of_rows = mysqli_num_rows($objrs_support);
								while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
										
										$tmp_id		= $objfields['user_id'];
										//echo "User ID is ".$tmp_id." <br>";
										$tmp_mail	= $objfields['user_email'];	
										//echo "User Email is ".$tmp_mail." <br>";
										
										//echo "Test to see if this array element is set to 0 or 1
										$array_value	= $a_notfound[$tmp_id];
										if ($array_value == 1 ) {
												echo "A Match was found, RUAT already sent them an email. <br>";
											}
											else {
												echo "<br>Array ID is ".$array_value." <br>";
												$headers 	= 'MIME-Version: 1.0' . "\r\n";
												$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
												$today		= date('Y/M/d');
												$subject 	= "*SSI* Search on ".$today." found no matches *SSI*";
												$HTML		= generatenomatchhtml();								
												sendreportbyemail($tmp_mail,$subject,$HTML,$headers);
												echo "An email has been sent to ".$tmp_mail." informing them that no matches have been found durring this search <br>";
											}
									}
							}
							mysqli_free_result($objrs_support);
							mysqli_close($objconn_support);
					}
			}
		
		return $resultsreturn;
	}
	
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012

?>
<HTML>
	<HEAD>
		<TITLE>
			Transportation Security Administration SSI - Nightly Maintenance (event)
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		</HEAD>
	<BODY onLoad="cacheOff()">
		<SCRIPT LANGUAGE="JavaScript">
		    ver = navigator.appVersion.substring(0,1)
		    if (ver >= 4)
		    	{
		    	document.write('<DIV ID="cache" style="position:absolute; z-index:9; left:0; top:0; width:300; align="left"><table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2><tr><td colspan="2" class="newTopicTitle">Processing Your Request</td></tr><tr><td class="newTopicBoxes2"><img src="images/animated_timer_bar.gif"></td></tr><tr><td colspan="2" class="newTopicEnder">&nbsp;</td></tr></table></DIV>');
		    	var navi = (navigator.appName == "Netscape" && parseInt(navigator.appVersion) >= 4);
		    	var HIDDEN = (navi) ? 'hide' : 'hidden';
		    	var VISIBLE = (navi) ? 'show' : 'visible';
		    	var cache = (navi) ? document.cache : document.all.cache.style;
		    	largeur = screen.width;
		    	cache.left = Math.round(100);
				sWidth = screen.width;
				sHeight = screen.height
				cache.left = (sWidth / 2) - 500;
				cache.top = (sHeight / 2) - 300;
				cache.right = (sHeight / 2) - 500;

		    	cache.visibility = VISIBLE;
		    	}
		    function cacheOff()
		    	{
		    	if (ver >= 4)
		    		{
		    		cache.visibility = HIDDEN;
		    		}
		    	}
		    </SCRIPT>
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td>
					<?
					breadcrumbs('nightly_import.php', $pagename);
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
						The Nightly Maintenance (event) is a function that runs on a nightly basis, every night the 
						system checks for a new watch list from the TSA^, Removes the old records from the database, 
						loads the new data into the database, and then sends out email to all users who requests that 
						they receive an update via email when a new match to their list has been found. This process 
						can take some time depending on the number of different users on the system, the length of 
						the users CSV file, and the length of the TSAs watch list. At any given time a watch list 
						could contain anywhere from 50,000 to 100,000 names. If one user has a list of 50 names to 
						watch, the system has to check well over 5,000,000 records (50 people on the airports list * 
						100,000 people on the TSA list). I am sure there is a way to increase the efficiency of this 
						process; however, it is beyond the scope of this experiment at this time.In a production 
						environment no user would ever see this option, but because this is an experiment the user 
						(the admin) needs a quick way to run this function so the button sits here.
						</p>
					</td>
				</tr>
			<tr>
				<td colspan="2" class="newTopicBoxes">
					Checking the Status of the TSA Watch Lists, and updating as needed.<br>
					<br>
					<?
					$skipa = 0;
					$skipb = 0;
					$skipc = 0;	// Runs the archive of all old notices so that they are not outstanding

					
					if ($skipc==1) {
							// Skip Sending out eMails
						}
						else {
							hideallnotices();
						}	
						
					if ($skipa==1) {
							// Skip Uploading Files
						}
						else {
							echo "------------------------------------------------------------------------------------------------------------ <br>";
							echo "Processing The NO FLY LISTS <br>";
							echo "Importing Page <u>1</u> of Excell Sheet <br>";	
							$time_b 	= timer();
							$convert	= convertxls('nofly_raw.xls','active/nofly/nofly_full.csv',1);
							striplinesfromcsv(3,'active/nofly/nofly_full.csv');
							$rows		= importdata('tbl_nofly_list','nightlies/active/nofly/nofly_full.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_nofly_list',$tmp_date,$time_ab,$rows);
							ob_flush();	
							echo "Importing Page <u>2</u> of Excell Sheet <br>";	
							$time_b 	= timer();
							$convert	= convertxls('nofly_raw.xls','active/nofly/nofly_full.csv',2);
							striplinesfromcsv(3,'active/nofly/nofly_full.csv');
							$rows		= appenddata('tbl_nofly_list','nightlies/active/nofly/nofly_full.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_nofly_list',$tmp_date,$time_ab,$rows);
							ob_flush();	
							echo "Importing Page <u>3</u> of Excell Sheet <br>";	
							$time_b 	= timer();
							$convert	= convertxls('nofly_raw.xls','active/nofly/nofly_full.csv',3);
							striplinesfromcsv(3,'active/nofly/nofly_full.csv');
							$rows		= appenddata('tbl_nofly_list','nightlies/active/nofly/nofly_full.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_nofly_list',$tmp_date,$time_ab,$rows);
							ob_flush();	
							echo "Importing Page <u>4</u> of Excell Sheet <br>";	
							$time_b 	= timer();
							$convert	= convertxls('nofly_raw.xls','active/nofly/nofly_full.csv',4);
							striplinesfromcsv(3,'active/nofly/nofly_full.csv');
							$rows		= appenddata('tbl_nofly_list','nightlies/active/nofly/nofly_full.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_nofly_list',$tmp_date,$time_ab,$rows);
							ob_flush();	
							echo "Importing Recent Additions Page from Excell Sheet <br>";	
							$time_b 	= timer();
							$convert	= convertxls('nofly_raw.xls','active/nofly/nofly_add.csv',5);
							striplinesfromcsv(1,'active/nofly/nofly_add.csv');
							$rows		= importdata('tbl_nofly_add_list','nightlies/active/nofly/nofly_add.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_nofly_add_list',$tmp_date,$time_ab,$rows);
							ob_flush();							
							echo "------------------------------------------------------------------------------------------------------------ <br>";
							echo "Processing The CLEARED LISTS <br>";
							echo "Importing Page <u>1</u> of Excell Sheet <br>";							
							$time_b 	= timer();
							$convert	= convertxls('cleared_raw.xls','active/cleared/cleared_full.csv',1);
							striplinesfromcsv(3,'active/cleared/cleared_full.csv');
							$rows		= importdata('tbl_cleared_list','nightlies/active/cleared/cleared_full.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_cleared_list',$tmp_date,$time_ab,$rows);
							ob_flush();		
							echo "Importing Page <u>2</u> of Excell Sheet <br>";							
							$time_b 	= timer();
							$convert	= convertxls('cleared_raw.xls','active/cleared/cleared_full.csv',2);
							striplinesfromcsv(3,'active/cleared/cleared_full.csv');
							$rows		= appenddata('tbl_cleared_list','nightlies/active/cleared/cleared_full.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_cleared_list',$tmp_date,$time_ab,$rows);
							ob_flush();	
							echo "Importing Page <u>3</u> of Excell Sheet <br>";							
							$time_b 	= timer();
							$convert	= convertxls('cleared_raw.xls','active/cleared/cleared_full.csv',3);
							striplinesfromcsv(3,'active/cleared/cleared_full.csv');
							$rows		= appenddata('tbl_cleared_list','nightlies/active/cleared/cleared_full.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_cleared_list',$tmp_date,$time_ab,$rows);
							ob_flush();	
							echo "Importing Page <u>4</u> of Excell Sheet <br>";							
							$time_b 	= timer();
							$convert	= convertxls('cleared_raw.xls','active/cleared/cleared_full.csv',4);
							striplinesfromcsv(3,'active/cleared/cleared_full.csv');
							$rows		= appenddata('tbl_cleared_list','nightlies/active/cleared/cleared_full.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_cleared_list',$tmp_date,$time_ab,$rows);
							ob_flush();	
							echo "Importing Recent Additions Page from Excell Sheet <br>";	
							$time_b 	= timer();	
							$convert	= convertxls('cleared_raw.xls','active/cleared/cleared_add.csv',5);
							striplinesfromcsv(1,'active/cleared/cleared_add.csv');
							$rows		= importdata('tbl_cleared_add_list','nightlies/active/cleared/cleared_add.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_cleared_add_list',$tmp_date,$time_ab,$rows);		
							ob_flush();									
							echo "------------------------------------------------------------------------------------------------------------ <br>";
							echo "Processing The SELECTEE LISTS <br>";	
							echo "Importing Page <u>1</u> of Excell Sheet <br>";
							$time_b 	= timer();
							$convert	= convertxls('selectee_raw.xls','active/selectee/selectee_full.csv',1);
							striplinesfromcsv(3,'active/selectee/selectee_full.csv');
							$rows		= importdata('tbl_selectee_list','nightlies/active/selectee/selectee_full.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_selectee_list',$tmp_date,$time_ab,$rows);
							ob_flush();	
							echo "Importing Page <u>2</u> of Excell Sheet <br>";
							$time_b 	= timer();
							$convert	= convertxls('selectee_raw.xls','active/selectee/selectee_full.csv',2);
							striplinesfromcsv(3,'active/selectee/selectee_full.csv');
							$rows		= appenddata('tbl_selectee_list','nightlies/active/selectee/selectee_full.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_selectee_list',$tmp_date,$time_ab,$rows);
							ob_flush();
							echo "Importing Page <u>3</u> of Excell Sheet <br>";
							$time_b 	= timer();
							$convert	= convertxls('selectee_raw.xls','active/selectee/selectee_full.csv',3);
							striplinesfromcsv(3,'active/selectee/selectee_full.csv');
							$rows		= appenddata('tbl_selectee_list','nightlies/active/selectee/selectee_full.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_selectee_list',$tmp_date,$time_ab,$rows);
							ob_flush();
							echo "Importing Page <u>4</u> of Excell Sheet <br>";
							$time_b 	= timer();
							$convert	= convertxls('selectee_raw.xls','active/selectee/selectee_full.csv',4);
							striplinesfromcsv(3,'active/selectee/selectee_full.csv');
							$rows		= appenddata('tbl_selectee_list','nightlies/active/selectee/selectee_full.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_selectee_list',$tmp_date,$time_ab,$rows);
							ob_flush();
							echo "Importing Recent Additions Page from Excell Sheet <br>";							
							$time_b 	= timer();
							$convert	= convertxls('selectee_raw.xls','active/selectee/selectee_add.csv',5);
							striplinesfromcsv(1,'active/selectee/selectee_add.csv');
							$rows		= importdata('tbl_selectee_add_list','nightlies/active/selectee/selectee_add.csv');
							$time_a 	= timer();
							$time_ab 	= ($time_a-$time_b);
							$tmp_date	= date('Y-m-d');
							importrecord('tbl_selectee_add_list',$tmp_date,$time_ab,$rows);
							ob_flush();		
							echo "------------------------------------------------------------------------------------------------------------ <br>";
						}
					if ($skipb==1) {
							// Skip Sending out eMails
						}
						else {
							// Open the connection
									$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
							
							$results = sendemailalerts($objconn_support);
							
							// Close the Connection
									//mysqli_free_result($objrs_support);
									mysqli_close($objconn_support);
									
							echo "<br><br> There was ".$results." resutls found. <br><br>";
						}					
					?>
					</td>
				</tr>
			<tr>
				<td class="newTopicEnder">
					&nbsp;
					</td>
				</tr>
			</table>
		</body>
	</html>