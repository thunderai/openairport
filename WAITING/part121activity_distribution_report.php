<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 121 Activity Linechart Report.php	The purpose of this page is to view activity in a linechart format in a report
	
								Usage:
								For use only with part121activity_main_browse.php
								
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		Session_Start();
		
		//include("includes/header.php");																	// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/NavFunctions.php");													// already included in header.php
		include("includes/UserFunctions.php");													// already included in header.php
		include("includes/FormFunctions.php");													// already included in header.php
		include("includes/DateFunctions.php");													// already included in header.php
		
		$tblname			= "Part 121 Activity LineChart";
		$tblsubname			= "Here is the chart you requested";
		
		$chartname				= "";
		$startyear				= 0;
		$endyear				= 0;
		$atabledata[0]			= 0;
		$scale					= 0;
		$displaytypedata		= $_POST['displaytypedata'];

		$graphxpost				= 0;
		$graphypost				= 0;
		$previousexpost			= 0;
		$previouseypost			= 0;

		$tmpvalue				= 0;
		$tmppreviousevalue		= 0;
		$tmppreviousetmpheight	= 0;
		$tmpnewtmpheight		= 0;
		$tmpimage				= 0;
		$tmpwidth				= 0;
		$tmpheight				= 0;
		$graphybase				= 0;
		$lastmovedown			= 0;
		$lastmoveup				= 0;
		$firstmovedown			= 0;

		$counter				= 0;
		$tmpobjrs				= 0;

		$tmpcontrol				= 0;
		$thisarray				= 0;
		$lastarray				= 0;

		$dblhighestsofar		= 0;

		$counter 				= 1;
		$graphxpost 			= 300;
		$graphypost 			= 600;
		$tmppreviousetmpheight 	= 0;
		$firstmovedown 			= 0;
		
		$maxcolumns				= 10;
		$totalrecords			= 0;
		$recordsremaining		= 0;
		$numcolumnone			= 0;
		$numcolumntwo			= 0;
		$numcolumnthree			= 0;
		$numcolumnfour			= 0;
		$numcolumnfive			= 0;
		$numcolumnsix			= 0;
		$numcolumnseven			= 0;
		$numcolumneight			= 0;
		$numcolumnnine			= 0;
		$numcolumnten			= 0;
		$numcolumneleven		= 0;
		
		$aslotallow[0]			= 0;
		$i						= 1;
		
?>
<HTML>
	<HEAD>
		<meta http-equiv="content-language" content="en-us">
		<meta http-equiv="content-type" content="text/html; charset=windows-1252">
		<title><?=$tblname;?></title>
		<script type="text/javascript" src="scripts/ajax.js"></script>
		<script type="text/javascript" src="scripts/AjaxRequest.js"></script>
		<script type="text/javascript" src="scripts/line.js"></script>
		<script type="text/javascript" src="scripts/wz_jsgraphics.js"></script>
		<link href="reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<BODY TOPMARGIN="0" LEFTMARGIN="8" MARGINWIDTH="0" MARGINHEIGHT="0">
		<font size="2"><br></font>
<?
	$tmpsqlstartdate = amerdate2sqldatetime($_POST['frmstartdate']);
	$tmpsqlenddate = amerdate2sqldatetime($_POST['frmenddate']);

	$sql = "SELECT * FROM tbl_activity_121_main WHERE activity_121_date >= '".$tmpsqlstartdate."' AND activity_121_date <= '".$tmpsqlenddate."' ORDER BY activity_121_date";
	//echo $sql."<br>";

	$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($mysqli, $sql);
			//echo $res."<br>";
			if ($res) {
					$totalrecords = mysqli_num_rows($res);
					$recordsremaining = $totalrecords;
					//echo $number_of_rows."<br>";
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
							}
				}
		}
	
	while ($recordsremaining>0) {
	//for ($i=1; $i<=$maxcolumns; $i++) {
		$counter = 0;
			// Ok, here is the deal, we connected to the DB to see how many records there was and put that number in $totalrecords.  Now we cycle through different categories putting the total number of records returned each time into a new array
			// aslotallow
			$tmpi 	= ($i * 100 );		// Do this so that when i = 10 it means 100;
			$tmpie 	= ($tmpi - 100);

			if ($displaytypedata==1) {
					//echo $objfields['activity_121_sep'];
					$fieldtosearch = 'activity_121_sep';
					$chartname	= "Enplanements x10 i.e. 1 = 100";
				}
			if ($displaytypedata==2) {
					//echo $objfields['activity_121_sep'];
					$fieldtosearch = 'activity_121_sdp';
					$chartname	= "Denplanements x10 i.e. 1 = 100";
				}
			if ($displaytypedata==3) {
					$fieldtosearch = 'activity_121_nrep';
					$chartname	= "Non-Rev Enplanements x10 i.e. 1 = 100";
				}
			if ($displaytypedata==4) {
					$fieldtosearch = 'activity_121_nrdp';
					$chartname	= "Non-Rev Denplanements x10 i.e. 1 = 100";
				}
			if ($displaytypedata==7) {
					$fieldtosearch = 'activity_121_avin';
					$chartname	= "Air Freight In x10 i.e. 1 = 100";
				}
			if ($displaytypedata==8) {
					$fieldtosearch = 'activity_121_avout';
					$chartname	= "Air Freight Out x10 i.e. 1 = 100";
				}			
			//echo "<br>";
			$sql = "SELECT * FROM tbl_activity_121_main WHERE activity_121_date >= '".$tmpsqlstartdate."' AND activity_121_date <= '".$tmpsqlenddate."' AND ".$fieldtosearch."<'".$tmpi."' AND ".$fieldtosearch.">='".($tmpie)."' ORDER BY activity_121_date";
			//echo $sql."<br><br>";

			$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
			
			if (mysqli_connect_errno()) {
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				else {
					$res = mysqli_query($mysqli, $sql);
					//echo $res."<br>";
					if ($res) {
							$number_of_rows = mysqli_num_rows($res);
							$recordsremaining = ( $recordsremaining - $number_of_rows );
							//echo $number_of_rows."<br>";
							//printf("result set has %d rows. \n", $number_of_rows);
							while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
									//echo "Total Records Found ".$totalrecords." Records Found this Loop ".$number_of_rows." Number of records remaining ".$recordsremaining." <br>";
									//echo "There were ".$number_of_rows." found, Total Records Found ".$totalrecords." Number of records remaining ".$recordsremaining." <br>";
									//echo "Record ID: ".$objfields['activity_121_id'];
							
									//array_push($aslotallow,$number_of_rows);
									
									$counter = ($counter + 1);
								}
							//echo "Total Records Found ".$totalrecords." Records Found this Loop ".$number_of_rows." Number of records remaining ".$recordsremaining." <br>";
							$aslotallow[$i] = $number_of_rows;
						}
				}	
		$i++;
		}

//echo count($aslotallow);
?>
<script type="text/javascript" src="scripts/wz_jsgraphics.js"></script>
<script type="text/javascript" src="scripts/line.js"></script>

<font size="3"><b><?=$chartname;?></b></font>
<br>
<br>
<div id="lineCanvas" style="overflow: auto; position:relative;height:500px;width:700px;"></div>
<script type="text/javascript">
var g = new line_graph();
	<?
	$tmparray = count($aslotallow);
	for ($i=1; $i<$tmparray; $i++) {
			?>
g.add('<?=$i;?>', <?=$aslotallow[$i];?>);
			<?
		}
		?>		
g.render("lineCanvas", "<?=$chartname;?>");
</script>
