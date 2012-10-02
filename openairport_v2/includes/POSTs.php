<?
	//combine POST and GET into one file
	//Set Variables as Global
	
	global $strmenuitemid;
	global $strattemptedusername;
	global $strattemptedpassword;
	global $frmstartdate;
	global $frmenddate;
	global $frmtextlike;
	global $uifrmstartdate;
	global $sqlfrmstartdate;
	
	include("includes/gs_config.php");	
	
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

	if (!isset($_POST["menuitemid"])) {
			// There is not a menuitemid defined in the POST request
			// Test to see if there is one in the GET request
			if (!isset($_GET["menuitemid"])) {
					// There is one NOT defined in the get request as well.
					// Set a known default value			
					$strmenuitemid = "";
				}
				else {
					// If there is a value in the get request set it to the right value
					$strmenuitemid = $_GET["menuitemid"];
				}
		}
		else {
			// There is a value in the POST request
			$strmenuitemid = $_POST["menuitemid"];
		}
		
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

	if (!isset($_POST["username"])) {
			if (!isset($_GET["username"])) {
					$strattemptedusername = "";
				}
				else {
					$strattemptedusername = $_GET["username"];
				}
		}
		else {
			$strattemptedusername = $_POST["username"];
		}

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		
	if (!isset($_POST["password"])) {
			if (!isset($_GET["password"])) {
					$strattemptedpassword = "";
				}
				else {
					$strattemptedpassword = $_GET["password"];
				}
		}
		else {
			$strattemptedpassword = $_POST["password"];
		}
				
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
				
	if (!isset($_POST["frmstartdate"])) {	
			//echo "Test says there is no POST Object Set, check to see if there is a Get Object <br>";			
			if (!isset($_GET["frmstartdate"])) {			
					//echo "Test says there is not a GET object set. Define some intitial data to be used. <br>";					
					$tmp_currenttimestamp = time();
					//echo "Current Time".$currenttimestamp."<br>";					
					//					Days		Hours		Mins		Seconds
					$tmp_daysago		= (	120	*	24	*	60	*	60);
					//echo "Days a go".$daysago."<br>";
					$tmp_pasttimestamp 	= ($tmp_currenttimestamp - $tmp_daysago);
					$frmstartdate 		= date("m/d/Y", $tmp_pasttimestamp);					
					//echo "GET/POST Value is now |".$frmstartdate."|<br>";
				}
				else {
					//echo "There is a value in the GET Statement<br>";
					if ($_GET["frmstartdate"] == "") {
							//echo "Ok, there really isn't a value in the GET Statement";
							//echo "Create default value of the current date<br>";					
							$tmp_currenttimestamp = time();
							//echo "Current Time".$currenttimestamp."<br>";							
							//					Days		Hours		Mins		Seconds
							$tmp_daysago		= (	45	*	24	*	60	*	60);
							//echo "Days a go".$daysago."<br>";
							$tmp_pasttimestamp 	= ($tmp_currenttimestamp - $tmp_daysago);
							$frmstartdate 		= date("m/d/Y", $tmp_pasttimestamp);							
							//echo "GET Value is now |".$frmstartdate."|<br>";
						}
						else {
							$frmstartdate = $_GET["frmstartdate"];
							//echo "GET Value is |".$_GET["frmstartdate"]."|<br>";
						}
				}
		}
		else {
			//echo "There is a value in the POST Statement<br>";
			$frmstartdate = $_POST["frmstartdate"];
			//echo "POST Value is |".$_POST["frmstartdate"]."|<br>";
		}
		
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		
	if (!isset($_POST["frmenddate"])) {
			if (!isset($_GET["frmenddate"])) {
					$frmenddate = date("m/d/Y");
				}
				else {
					if ($_GET["frmenddate"] == "") {
							$frmenddate = date("m/d/Y");
						}
						else {
							$frmenddate = $_GET["frmenddate"];
						}
				}
		}
		else {
			$frmenddate = $_POST["frmenddate"];
		}
		
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

	if (!isset($_POST["frmtextlike"])) {
			if (!isset($_GET["frmtextlike"])) {
					$frmtextlike = "";
				}
				else {
					$frmtextlike = $_GET["frmtextlike"];
				}
		}
		else {
			$frmtextlike = $_POST["frmtextlike"];
		}
		
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

	if (!isset($_POST["recordid"])) {
			if (!isset($_GET["recordid"])) {
					$intrecordid = "";
				}
				else {
					$intrecordid = $_GET["recordid"];
				}
		}
		else {
			$intrecordid = $_POST["recordid"];
		}

//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

	if (!isset($_POST["frmurl"])) {
			if (!isset($_GET["frmurl"])) {
					$frmurl = "";
				}
				else {
					$frmurl = $_GET["frmurl"];
				}
		}
		else {
			$frmurl = $_POST["frmurl"];
		}
?>