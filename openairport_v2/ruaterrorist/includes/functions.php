<?
//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
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
//	Name of Document	:	/include/functions.php
//
//	Purpose of Page		:	FORM SIDE 	- Depends on Function
//							SERVER SIDE - Depends on Function
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function get_totalsavedqueries: Takes an input of a user id and returns he number of saved queries they have.
//
function get_systemactivity_byuser($userid) {
		
		$sql = "SELECT * FROM tbl_system_activity 
		WHERE activity_user_id = '".$userid."'";

				
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
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function splitWithEscape: Spilts a line from a CSV using a good format
//
function splitWithEscape ($str, $delimiterChar = ',', $escapeChar = '"') {
    $len = strlen($str);
    $tokens = array();
    $i = 0;
    $inEscapeSeq = false;
    $currToken = '';
    while ($i < $len) {
        $c = substr($str, $i, 1);
        if ($inEscapeSeq) {
            if ($c == $escapeChar) {
                // lookahead to see if next character is also an escape char
                if ($i == ($len - 1)) {
                    // c is last char, so must be end of escape sequence
                    $inEscapeSeq = false;
                } else if (substr($str, $i + 1, 1) == $escapeChar) {
                    // append literal escape char
                    $currToken .= $escapeChar;
                    $i++;
                } else {
                    // end of escape sequence
                    $inEscapeSeq = false;
                }
            } else {
                $currToken .= $c;
            }
        } else {
            if ($c == $delimiterChar) {
                // end of token, flush it
                array_push($tokens, $currToken);
                $currToken = '';
            } else if ($c == $escapeChar) {
                // begin escape sequence
                $inEscapeSeq = true;
            } else {
                $currToken .= $c;
            }
        }
        $i++;
    }
    // flush the last token 
    array_push($tokens, $currToken);
    return $tokens;
}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function put_systemactivity : Tracks user movement and activity
//
function put_systemactivity($userid,$function) {
		// This function will add a record to the system activity table, used to track user behavior
		$sql2 = "INSERT INTO tbl_system_activity (activity_user_id,activity_function) VALUES ( '".$userid."','".$function."')";
		$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
				$objrs = mysqli_query($mysqli, $sql2) or die(mysqli_error($mysqli));
				//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
				//$tmp_newuserid = mysql_insert_id($mysqli);
			}
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	
	
//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function generatecheckcode : Creates check code for user email authorization
//
function check_input($link,$value) {
		// Stripslashes
		if (get_magic_quotes_gpc()) {
			  $value = stripslashes($value);
			}
		// Quote if not a number
		if (!is_numeric($value)) {
			  $value = "'" . mysqli_real_escape_string($link,$value) . "'";
			}
	return $value;
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function generatecheckcode : Creates check code for user email authorization
//
function generatecheckcode() {
		$string = '';

		for($i=0; $i<12; $i++) {
				$j = rand(1,52);
				switch ($j) {
						case 1;
							$string = $string."A";
							break;
						case 2;
							$string = $string."B";
							break;	
						case 3;
							$string = $string."C";
							break;
						case 4;
							$string = $string."D";
							break;	
						case 5;
							$string = $string."E";
							break;
						case 6;
							$string = $string."F";
							break;	
						case 7;
							$string = $string."G";
							break;
						case 8;
							$string = $string."H";
							break;	
						case 9;
							$string = $string."I";
							break;
						case 10;
							$string = $string."J";
							break;	
						case 11;
							$string = $string."K";
							break;
						case 12;
							$string = $string."L";
							break;
						case 13;
							$string = $string."M";
							break;
						case 14;
							$string = $string."N";
							break;	
						case 15;
							$string = $string."O";
							break;
						case 16;
							$string = $string."P";
							break;	
						case 17;
							$string = $string."Q";
							break;
						case 18;
							$string = $string."R";
							break;	
						case 19;
							$string = $string."S";
							break;
						case 20;
							$string = $string."T";
							break;	
						case 21;
							$string = $string."U";
							break;
						case 22;
							$string = $string."V";
							break;	
						case 23;
							$string = $string."W";
							break;
						case 24;
							$string = $string."X";
							break;	
						case 25;
							$string = $string."Y";
							break;
						case 26;
							$string = $string."Z";
							break;	
						case 1;
							$string = $string."A";
							break;
						case 2;
							$string = $string."B";
							break;	
						case 3;
							$string = $string."C";
							break;
						case 4;
							$string = $string."D";
							break;	
						case 5;
							$string = $string."E";
							break;
						case 6;
							$string = $string."F";
							break;	
						case 7;
							$string = $string."G";
							break;
						case 8;
							$string = $string."H";
							break;	
						case 9;
							$string = $string."I";
							break;
						case 10;
							$string = $string."J";
							break;	
						case 11;
							$string = $string."K";
							break;
						case 12;
							$string = $string."L";
							break;
						case 13;
							$string = $string."M";
							break;
						case 14;
							$string = $string."N";
							break;	
						case 15;
							$string = $string."O";
							break;
						case 16;
							$string = $string."P";
							break;	
						case 17;
							$string = $string."Q";
							break;
						case 18;
							$string = $string."R";
							break;	
						case 19;
							$string = $string."S";
							break;
						case 20;
							$string = $string."T";
							break;	
						case 21;
							$string = $string."U";
							break;
						case 22;
							$string = $string."V";
							break;	
						case 23;
							$string = $string."W";
							break;
						case 24;
							$string = $string."X";
							break;	
						case 25;
							$string = $string."Y";
							break;
						case 26;
							$string = $string."Z";
							break;	
						case 27;
							$string = $string."a";
							break;
						case 28;
							$string = $string."b";
							break;	
						case 29;
							$string = $string."c";
							break;
						case 30;
							$string = $string."d";
							break;	
						case 31;
							$string = $string."e";
							break;
						case 32;
							$string = $string."f";
							break;	
						case 33;
							$string = $string."g";
							break;
						case 34;
							$string = $string."h";
							break;	
						case 35;
							$string = $string."i";
							break;
						case 36;
							$string = $string."j";
							break;	
						case 37;
							$string = $string."k";
							break;
						case 38;
							$string = $string."l";
							break;
						case 39;
							$string = $string."m";
							break;
						case 40;
							$string = $string."n";
							break;	
						case 41;
							$string = $string."o";
							break;
						case 42;
							$string = $string."p";
							break;	
						case 43;
							$string = $string."q";
							break;
						case 44;
							$string = $string."r";
							break;	
						case 45;
							$string = $string."s";
							break;
						case 46;
							$string = $string."t";
							break;	
						case 47;
							$string = $string."u";
							break;
						case 48;
							$string = $string."v";
							break;	
						case 49;
							$string = $string."w";
							break;
						case 50;
							$string = $string."x";
							break;	
						case 51;
							$string = $string."y";
							break;
						case 52;
							$string = $string."z";
							break;							
					}
			}
	return $string;
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	


//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function Timer : Create a way to track how long certain tasks take to complete.
//
function timer() {
	    list($usec, $sec) = explode(" ", microtime());
	    return ((float)$usec + (float)$sec);
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function send_404 : Fakes a 404 Error to the browser, telling the evil user that the page dosn't exisit.
//
function send_404() {
	    //header('HTTP/1.x 404 Not Found');
	    print '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN"><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL '.str_replace(strstr($_SERVER['REQUEST_URI'], '?'), '', $_SERVER['REQUEST_URI']).' was not found on this server.</p></body></html>';
	    exit;
	} 
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function getnumberoflistrows : Takes an input table and returns how many rows are in that table
//
function getnumberoflistrows($tablename) {
		// Get the number of rows in the given table.
		// Since we are listing the import history we will list the items in reverse order to get the most recent one.
		$sql = "SELECT * FROM tbl_import_history WHERE import_type = '".$tablename."' ORDER BY import_id DESC LIMIT 1";
		//echo "The SQL Statement is ".$sql." <br>";
		//echo "Get Number of List Rows SQL ".$sql."<br>";
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
								$numberofrows = $objfields['import_rows'];
							}
						
					}
					mysqli_free_result($objrs_support);
					mysqli_close($objconn_support);
			}
	return $numberofrows;
	}		
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function get_totalactivenotices : Takes a userid as an input and returns how many active notices they have.
//
function get_totalactivenotices($userid) {
		$sql = "SELECT * FROM tbl_users 
				INNER JOIN tbl_users_notice  	ON tbl_users_notice.user_n_parent_id = tbl_users.user_id
				WHERE user_id = '".$userid."' AND user_n_archived_yn = 0";
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
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function generatenomatchhtml : Secondary eMail HTML Generator.  Just returns the number of rows that mactch the SQL Search Criteria.
//
function generatenomatchhtml() {
		// Used to set the HTML variable in nightly import so that we can create an email message 
		// with no security risk problems
		
$HTML = "<HTML>
			<HEAD>
				<TITLE>
					NO MATCHES FOUND
					</TITLE>
				<link rel='stylesheet' href='http://www.watertownsdairport.com/openairport_php/ruaterrorist/scripts/style.css' type='text/css'>
				</HEAD>
			<BODY>
				<table width='100%' Class='windowMain' CELLSPACING=1 CELLPADDING=2>	
					<tr>
						<td class='newTopicTitle'>
							This is an automated eMail from the RUAT System.
							</td>
						</tr>
					<tr>
						<td class='newTopicBoxes' align='left' valign='top'>
							<p>
								The “Are you a Terrorist?” (RUAT) system has run todays search and has found NO matches that meet the search critera you provided.
								</p>
							<p>
								This is good only for today as another search with new names will be run tomorrow.
								</p>
							</td>
						</tr>
					<tr>
						<td class='newTopicEnder'>
							&nbsp;
							</td>
						</tr>
					</table>
				</body>
			</html>";			
	
	return $HTML;
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function generatefunkhtml : Secondary eMail HTML Generator.  Just returns the number of rows that mactch the SQL Search Criteria.
//
function generatefunkhtml($who,$table,$subject) {
		// Used to set the HTML variable in nightly import so that we can create an email message 
		// with no security risk problems
		
$HTML = "<HTML>
			<HEAD>
				<TITLE>
					<?=$subject;?>
					</TITLE>
				<link rel='stylesheet' href='http://www.watertownsdairport.com/openairport_php/ruaterrorist/scripts/style.css' type='text/css'>
				</HEAD>
			<BODY>
				<table width='100%' Class='windowMain' CELLSPACING=1 CELLPADDING=2>	
					<tr>
						<td class='newTopicTitle'>
							This is an automated eMail from the RUAT System about one of the records in your CSV.
							</td>
						</tr>
					<tr>
						<td class='newTopicBoxes' align='left' valign='top'>
							<p>
								The “Are you a Terrorist?” (RUAT) system has detected that there is at least 
								one match in ".$table." to ".$who.". This would be a good time for you to
								log into the RUAT system <a href='http://www.watertownsdairport.com/openairport_php/ruaterrorist/'>here</a> and see
								what the matches are. 
								</p>
							<p>
								In order to check your maches you will need to Log In to the RUAT system and 
								rerun the query for ".$who." in table ".$table." 
								</p>
							</td>
						</tr>
					<tr>
						<td class='newTopicEnder'>
							&nbsp;
							</td>
						</tr>
					</table>
				</body>
			</html>";			
	
	return $HTML;
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function getuserid_email: Takes an input of a user id and returns the users name
//
function getuserid_email($userid) {
		$sql = "SELECT * FROM tbl_users 
				WHERE user_id = '".$userid."' LIMIT 1";
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
								$usersemail = $objfields['user_email'];
								echo "User Email is ".$objfields['user_email']." <br>";
							}
					}
					mysqli_free_result($objrs_support);
					mysqli_close($objconn_support);
			}
	return $usersemail;
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	


//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function getuseridname: Takes an input of a user id and returns the users name
//
function getuseridname($userid) {
		$sql = "SELECT * FROM tbl_users 
				WHERE user_id = '".$userid."' LIMIT 1";
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
								$usersname = $objfields['user_fullname'];
							}
					}
					mysqli_free_result($objrs_support);
					mysqli_close($objconn_support);
			}
	return $usersname;
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function breadcrumbs: Takes an input of a link location and a link name and makes a breadcrumb
//	
function breadcrumbs($currentpagelink, $currentpagename) {
		// Displays the current menu strcuture for the user
		if ($currentpagelink == 'global_addapplication.php') {
				$home = 'index.php';
			}
			else {
				$home = 'welcome.php';
			}
		?>
		<table Class="breadCrumb" width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td Class="breadcrumbCel" width="100%" >
					<a Class="breadCrumbLink" href="<?=$home;?>">Home Page</a> &raquo; <a Class="breadCrumbLink" href="<?=$currentpagelink;?>" target="layouttableiframecontent"><?=$currentpagename;?></a> 
					</td>
				</tr>
			</table>
		<?
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function get_totalsavedqueries: Takes an input of a user id and returns he number of saved queries they have.
//
function get_totalsavedqueries($userid) {
		$sql = "SELECT * FROM tbl_users 
				INNER JOIN tbl_users_searchs 	ON tbl_users_searchs.user_s_parent_id = tbl_users.user_id
				WHERE user_id = '".$userid."' AND user_s_archived_yn = 0";
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
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function get_totalsavedqueries: Takes an input of a user id and returns he number of saved queries they have.
//
function get_totalsavedqueries_bytype($userid,$type) {
		
		if ($type == "all") {
				$sql = "SELECT * FROM tbl_users 
				INNER JOIN tbl_users_searchs 	ON tbl_users_searchs.user_s_parent_id = tbl_users.user_id
				WHERE user_id = '".$userid."' AND user_s_archived_yn = 0";
			}
			else {
				$sql = "SELECT * FROM tbl_users 
				INNER JOIN tbl_users_searchs 	ON tbl_users_searchs.user_s_parent_id = tbl_users.user_id
				WHERE user_id = '".$userid."' AND user_s_archived_yn = 0 AND user_s_table = '".$type."' ";
			}
				
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
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	
//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function updateuserqueries: Take an input of a userid and increases the number of queries they have conducted by 1
//
function updateuserqueries($userid) {
		$sql2 = "UPDATE tbl_users_queries SET `user_q_number`= `user_q_number` + 1 WHERE `user_q_parentid` = '".$userid."' ";
		//echo $sql2;
		$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");	

		$loopcounter = 0;
		
			while (!$mysqli) {
				echo "<p>Could not connect to the server </p>";
				echo mysql_error();
				echo "<br>LoopCounter is ".$loopcounter." <br>";
				echo "Attempting to reconnect<br>";
				
				$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
				$loopcounter = $loopcounter+1;
				}


		
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
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function displaymainmenu: Creats the Main Menu Screen and Allows for System Operation
//								
function displaymainmenu() {
	?>
	<body onLoad="MM_preloadImages('images/button-closetree-over.gif','images/button-opentree-over.gif')">
		<!--
		// NOTICE DIV LAYER
		-->
	
		<div id="myDiv" style="display:none; position:absolute; z-index:9; left:17; top:140; width:179;">
			<table width="100%" Class="windowMain" CELLSPACING="1" CELLPADDING="2">
				<tr>
					<td colspan="2" class="newTopicTitle">You Have Messages Waiting</td>
					</tr>
				<tr>
					<td class="newTopicBoxes" height="219">
						<p>
							You are receiving this notice because the system has found at least one 
							match in your saved searchs.<br>
							<br>
							To check your matches, please click the 'Close this Window' below and 
							you will be taken to your NOTICE Section. There each search qiery which 
							found a match will be listed.<br>
							</p>
						</td>
					</tr>
				<tr>
					<td class="newTopicNames">
						<form action="_managenotice.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
						<input type="submit" value="Close this Window" name="submit" class="button" onclick="javascript:closenotice();">
						</form>
						</td>
					</tr>
				<tr>
					<td colspan="2" class="newTopicEnder">&nbsp;</td>
					</tr>
				</table>
			</div>
		<script>
			function closenotice() {
				document.getElementById("myDiv").style.display = "none";
				}
			</script>
		<!--
		// NOTICE DIV LAYER
		-->		
		<table width="100%" border="0" cellspacing="0" cellpadding="0" ID="Table8">
			<tr>
				<td width="100%">
					<img src="images/tsa_logo.gif" border="0">
					</td>
				<td class="mainOptions">
			      	<table border="0" width="400" cellspacing="0" cellpadding="0" ID="Table9">
						<tr>
							<td height="26" nowrap class="options">
								<img src="images/icon-main_search.gif" width="8" height="8" border="0" alt="Go to the TSA Web board"> <a href="https://webboards.tsa.dhs.gov/WB/default.asp"  target="_new" class="optionsLink">Webboard</a>
								</td>
				            <td height="26" nowrap class="options">
								<img src="images/icon-main_search.gif" width="8" height="8" border="0" alt="More Options..."> <a href="_options.php" target="layouttableiframecontent" class="optionsLink">Options</a>
								</td>
							<td width="175" rowspan="2" height="26" class="searchBoxLeft">
								<span class="welcome">
								Welcome 
								<?
								$tmpuserid = getuseridname($_SESSION["user_id"]);
								
								?>
								<?=$tmpuserid;?>
								
								</span>			                
								</td>
							</tr>
						<tr>
							<td height="20" nowrap class="options">
								<img src="images/icon-main_search.gif" width="8" height="8" border="0" alt="Help"> <a href="help.php" class="optionsLink" target="layouttableiframecontent" onClick="openhelpwindow('help/?action=23')">Help</a>
								</td>
							<td height="20" nowrap class="options">
								<img src="images/icon-main_search.gif" width="8" height="8" border="0" alt="End your RUAT Session"> <a href="_logout.php" class="optionsLink">Log off</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>				
						
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td width="180" class="windowHeader">
					Main Menu
					</td>
				<td width="*" class="windowHeader">
					Content
					</td>
				</tr>
			<tr>
				<td class="newTopicBoxes" align="center" valign="top">
					<table Class="windowMain">
						<tr>				
							<td class="newTopicNames" align="center" valign="middle">
								<form action="welcome.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
									<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
									<input type="submit" value="Home" name="submit" class="button">
									</form>
								</td>
							</tr>
						<tr>				
							<td class="newTopicNames" align="center" valign="middle">
								<form action="_options.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
									<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
									<input type="submit" value="Options" name="submit" class="button">
									</form>
								</td>
							</tr>
						<?
						// Does user have any notices ?
						$tmp_number = get_totalactivenotices($_SESSION["user_id"]);
						if ($tmp_number > 0) {
								?>
								<script>
									document.getElementById("myDiv").style.display = "block";
									//alert('You have unread messages \n Please check them by clicking the Notice Button');
									</script>
								
						<tr>		
							<td class="newTopicNames" align="center" valign="middle">
								<form action="_managenotice.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
									<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
									<input type="submit" value="NOTICES" name="submit" class="button">
									</form>
								</td>			
							</tr>
								<?
							}
							?>							
						<tr>
							<td class="newTopicNames" align="center" valign="middle">
								<form action="_managesearch.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
									<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
									<input type="submit" value="Manage Searchs" name="submit" class="button">
									</form>
								</td>
							</tr>
						<?
						if ($_SESSION["user_id"]==1) {
								?>							
						<tr>
							<td class="newTopicNames">
								Admin Controls
								</td>
							</tr>
						<tr>
							<td class="newTopicNames" align="center" valign="middle">
								<form action="nightly_import.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
									<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
									<input type="submit" value="Nightly Maintenance" name="submit" class="button">
									</form>
								</td>
							</tr>
						<tr>
							<td class="newTopicNames" align="center" valign="middle">
								<form action="billing.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
									<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
									<input type="submit" value="Process Billings" name="submit" class="button">
									</form>
								</td>
							</tr>
						<tr>
							<td class="newTopicNames" align="center" valign="middle">
								<form action="nimba_activity.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
									<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
									<input type="submit" value="System Activity" name="submit" class="button">
									</form>
								</td>
							</tr>
						<tr>
							<td class="newTopicNames" align="center" valign="middle">
								<form action="nimba_flush_search.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
									<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
									<input type="submit" value="Flush Searchs" name="submit" class="button">
									</form>
								</td>
							</tr>							
						<tr>
							<td class="newTopicNames" align="center" valign="middle">
								<form action="nimba_applicants.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
									<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
									<input type="submit" value="Applications" name="submit" class="button">
									</form>
								</td>
							</tr>	
						<tr>
							<td class="newTopicNames" align="center" valign="middle">
								<form action="nimba_users.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
									<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
									<input type="submit" value="Users" name="submit" class="button">
									</form>
								</td>
							</tr>
								<?
							}
						?>
						</table>
					</td>
				<td rowspan="5" class="newTopicBoxes" align="left" valign="top">
					<iframe id="layouttableiframecontent" name="layouttableiframecontent" SRC="welcome.php" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" style="overflow:visible; width:100%; display:none"></iframe>
					</td>	
				</tr>
			</table>
	<?
		displaywarning();
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function sendreportbyemail: takes an input of to, subject, boidy and headers and sends an email.
//	
function sendreportbyemail($to,$subject,$body,$headers) {
	$emailto	 	= $to;
	$emailsubject 	= $subject;
	$emailbody 		= $body;
	
	echo "<br>";
	echo "eMail is ".$emailto."<br>";
	echo "eMail subject is ".$emailsubject."<br>";
	
	if (mail($emailto, $emailsubject, $emailbody,$headers)) {
			echo("Message successfully sent!");
		} 
		else {
			echo("Message delivery failed...");
		}
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function displaywarning: Displays that pesky SSI warning on every page as well as in a return.
//		
function displaywarning() {
	?>
			<font color="#FF0000" size="1">
			<b>WARNING</b>:  THIS DOCUMENT CONTAINS SENSITIVE SECURITY INFORMATION THAT IS CONTROLLED 
			UNDER 49 CFR PART 1520.  NO PART OF THIS DOCUMENT MAY BE RELEASED TO PERSONS WITHOUT 
			A NEED TO KNOW, AS DEFINED IN 49 CFR 1520, EXCEPT WITH THE WRITTEN PERMISSION OF THE 
			ADMINISTRATOR OF THE TRANSPORTATION SECURITY ADMINISTRATION, WASHINGTON, DC 20590.  
			UNAUTHORIZED RELEASE MAY RESULT IN CIVIL PENALTY OR OTHER ACTION.  FOR U.S. GOVERNMENT 
			AGENCIES, PUBLIC AVAILABILITY IS GOVERNED BY 5 U.S.C. 552.
			</font><br>
	<?
		$tmp_warning = "<font color='#FF0000' size='1'>
			<b>WARNING</b>:  THIS DOCUMENT CONTAINS SENSITIVE SECURITY INFORMATION THAT IS CONTROLLED 
			UNDER 49 CFR PART 1520.  NO PART OF THIS DOCUMENT MAY BE RELEASED TO PERSONS WITHOUT 
			A NEED TO KNOW, AS DEFINED IN 49 CFR 1520, EXCEPT WITH THE WRITTEN PERMISSION OF THE 
			ADMINISTRATOR OF THE TRANSPORTATION SECURITY ADMINISTRATION, WASHINGTON, DC 20590.  
			UNAUTHORIZED RELEASE MAY RESULT IN CIVIL PENALTY OR OTHER ACTION.  FOR U.S. GOVERNMENT 
			AGENCIES, PUBLIC AVAILABILITY IS GOVERNED BY 5 U.S.C. 552.
			</font><br>";
	
	return $tmp_warning;
	}	
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function mk_dir: Takes an input file name and creats the directory.
//	
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
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function mkdir_recursive: Creats a directory based on the input $pathname.
//	
function mkdir_recursive($pathname, $mode) {
		is_dir(dirname($pathname)) || mkdir_recursive(dirname($pathname), $mode);
		return is_dir($pathname) || @mkdir($pathname, $mode);
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	
?>