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
//	Name of Document	:	billing.php
//
//	Purpose of Page		:	FORM SIDE 	- Allows User to Manage all of their saved searchs
//							SERVER SIDE - Lists all saved searchs for the current session user.
//
//==============================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

// Prevent System From Timeing out while doing a search of the database	   
		set_time_limit(0);
		
// Include Files nessary to complete any tasks assigned.		
		include("includes/generalsettings.php");
		include("includes/functions.php");

// Establish Page Name			
		$pagename = 'ADMIN - Process Maintenance Costs';

// Check to see if a user is currently logged Into the System.  We do this to prevent direct linking
//	to the document. If someone tries to direct link to the page, the broweser will show a 404 error.
		//echo "Session ID is [".$_SESSION['user_id'],"]";
		if ($_SESSION['user_id'] == '') {
				//echo "There has been a request for this page outside of normal operating procedures<br>";
				send_404();
			}
			else {
				//echo "The request for this page seems to be in order, allow page to be displayed <br>";

// Set up some initial values 
		$costperquery 			= 0.00032;
		$costpersavedquery		= 0.02;
		$costperrowinfile		= 0.02;
		?>

<HTML>
	<HEAD>
		<TITLE>
			Billing Playground
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		</HEAD>
	<BODY>
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td colspan="8">
					<?
					breadcrumbs('billing.php', $pagename);
					?>
					</td>
				</tr>
			<tr>
				<td colspan="8" class="newTopicTitle">
					<?=$pagename;?>
					</td>
				</tr>
			<tr>
				<td colspan="8" class="newTopicBoxes">
					<p>
					Processing Server Maintenance Cost is an attempt to calculate how much demand in on the server 
					at any given time. The cost is based on the number of rows in a users CSV file, the number of 
					requests they make of the database, and how many saved searches they have.  The cost in dollars 
					at this point are make believe and have no real value other than to track how much requests could 
					cost. The end point of this function is to see how much this type of service would be worth on 
					yearly bases.  It is currently unknown how much a service like this would cost.
					</p>
					</td>
				</tr>
		
			<?
// Load Saved Search Data
	$sql = "SELECT * FROM tbl_users 
			INNER JOIN tbl_users_files 		ON tbl_users_files.user_f_parent_id = tbl_users.user_id 
			INNER JOIN tbl_users_queries	ON tbl_users_queries.user_q_parentid = tbl_users.user_id ";
			
			//INNER JOIN tbl_users_searchs 	ON tbl_users_searchs.user_s_parent_id = tbl_users.user_id ";

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
						else {
						?>
			<tr>
				<td rowspan="2" class="newTopicTitle">
					User
					</td>
				<td rowspan="2" class="newTopicTitle">
					User eMail
					</td>
				<td rowspan="2" class="newTopicTitle">
					User File Name
					</td>
				<td colspan="5" class="newTopicTitle">
					Total Processing Cost
					</td>
				</tr>
			<tr>
				<td class="newTopicTitle">
					Item
					</td>
				<td class="newTopicTitle">
					Item Total
					</td>
				<td class="newTopicTitle">
					Modifier
					</td>
				<td class="newTopicTitle">
					Unit Price
					</td>
				<td class="newTopicTitle">
					Line Item Total
					</td>
				</tr>
						<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							// Flush Temp Rows
							$tmp_lineitemc 			= 0;
							$numberofsavedsearchs	= 0;
							$tmp_lineitemb			= 0;
							$tmp_lineitemtotal		= 0;
							//$tmptotal				= 0;
							?>
			<tr>
				<td rowspan="5" class="newTopicNames">
					<?=$objfields['user_name'];?>
					</td>
				<td rowspan="5" class="newTopicNames">
					<?=$objfields['user_email'];?>
					</td>
				<td rowspan="5" class="newTopicNames">
					<?=$objfields['user_f_name'];?>
					</td>
				</tr>
			<tr>			
				<td class="newTopicNames">
					File Rows
					</td>
				<td class="newTopicNames">
					<?=$objfields['user_f_rows'];?>
					</td>					
				<td class="newTopicNames">
					*
					</td>
				<td class="newTopicNames">
					<?=$costperrowinfile;?>
					</td>
				<td class="newTopicNames">
					<?
					$tmp_lineitemc = ($numberofsavedsearchs * $costpersavedquery);
					echo "$".$tmp_lineitemc;
					?>
					</td>
				</tr>					
			<tr>
				<td class="newTopicNames">
					Saved Queries
					</td>
				<td class="newTopicNames">
					<?
					$numberofsavedsearchs 	= get_totalsavedqueries($objfields['user_id']);
					echo $numberofsavedsearchs;
					?>
					</td>
				<td class="newTopicNames">
					*
					</td>
				<td class="newTopicNames">
					<?=$costpersavedquery;?>
					</td>
				<td class="newTopicNames">
					<?
					$tmp_lineitema = ($numberofsavedsearchs * $costpersavedquery);
					echo "$".$tmp_lineitema;
					?>
					</td>
				</tr>
			<tr>
				<td class="newTopicNames">
					Processing Requests
					</td>
				<td class="newTopicNames">
					<?=$objfields['user_q_number'];?>
					</td>
				<td class="newTopicNames">
					*
					</td>
				<td class="newTopicNames">
					<?=$costperquery ;?>
					</td>
				<td class="newTopicNames">
					<?
					$tmp_lineitemb = ($objfields['user_q_number'] * $costperquery);
					echo "$".$tmp_lineitemb;
					?>
					</td>
				</tr>
			<tr>
				<td colspan="4" class="newTopicNames">
					Sub Total
					</td>
				<td class="newTopicNames">
					<?
					$tmp_lineitemtotal = ($tmp_lineitema + $tmp_lineitemb + $tmp_lineitemc);
					echo "$".$tmp_lineitemtotal;
					
					$tmptotal = ($tmptotal + $tmp_lineitemtotal);
					?>
					</td>
				</tr>
						<?
						}
				}
				mysqli_free_result($objrs_support);
				mysqli_close($objconn_support);
		}
	?>
			<tr>
				<td colspan="7" class="newTopicNames">
					Total Processing Request (in Dollars)
					</td>
				<td class="newTopicNames">
					<?
					echo "$".$tmptotal;
					?>
					</td>
				</tr>
			<tr>
				<td colspan="8" class="newTopicEnder">
					&nbsp;
					</td>
				</tr>
			</table>
		</BODY>
	</HTML>
	<?
	}
	?>