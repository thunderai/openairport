<?
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o	o		ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		o	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		oo	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o o	o		ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  oo		o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	o		o	o	  o		o	o	o		o	o	o	o     o
//	00000	0		ooooo	o	o		o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	FuelFlow Sub V Linechart Report.php
//
//	Purpose of Page		:	Used to display a linechart of the selected FuelFlow Element
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	
	// Load Required Include Files
	
		Session_Start();
		
		//include("includes/header.php");																	// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/NavFunctions.php");													// already included in header.php
		include("includes/UserFunctions.php");													// already included in header.php
		include("includes/FormFunctions.php");													// already included in header.php
		include("includes/DateFunctions.php");													// already included in header.php
		
		$tblname				= "Fuel Flow Vehicle Economy";
		$tblsubname				= "please complete the form to see a chart";
		
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
		$masseffect				= 10;
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
		<?
		$tmpsqlstartdate	= amerdate2sqldatetime($_POST['frmstartdate']);
		$tmpsqlenddate		= amerdate2sqldatetime($_POST['frmenddate']);

		$sql = "SELECT * FROM tbl_fuelflow_sub_v WHERE fuelflow_v_date >= '".$tmpsqlstartdate."' AND fuelflow_v_date <= '".$tmpsqlenddate."' AND fuelflow_vv_cb_int = ".$_POST['operator']." ORDER BY fuelflow_v_date";
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
					$number_of_rows = mysqli_num_rows($res);
					//echo $number_of_rows."<br>";
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
							//echo "Record ID: ".$objfields['activity_121_id'];
					
							if ($displaytypedata==1) {
									//echo $objfields['activity_121_sep'];
									$tmp	= ($objfields['fuelflow_v_fuel_miles'] * $masseffect);
									array_push($atabledata, $objfields['fuelflow_v_fuel_miles']);
									$chartname	= "Miles";
								}
							if ($displaytypedata==2) {
									//echo $objfields['activity_121_sep'];
									array_push($atabledata, $objfields['fuelflow_v_fuel_hours']);
									$chartname	= "Hours";
								}
							if ($displaytypedata==3) {
									array_push($atabledata, $objfields['fuelflow_v_fuel_gallons']);
									$chartname	= "gallons";
								}
							if ($displaytypedata==4) {
									array_push($atabledata, $objfields['fuelflow_v_fuel_costg']);
									$chartname	= "Price /g";
								}
							if ($displaytypedata==5) {
									$tmp	= ($objfields['fuelflow_v_fuel_miles'] / $objfields['fuelflow_v_fuel_gallons']);
									$tmp	= round($tmp,2);
									array_push($atabledata, $tmp);
									$chartname	= "Miles Per gallon";
								}
							if ($displaytypedata==6) {
									$tmp	= ($objfields['fuelflow_v_fuel_hours'] / $objfields['fuelflow_v_fuel_gallons']);
									$tmp	= round($tmp,2);
									array_push($atabledata, $tmp);
									$chartname	= "Hours Per Gallon";
								}
							if ($displaytypedata==7) {
									$tmp	= ($objfields['fuelflow_v_fuel_miles'] / ($objfields['fuelflow_v_fuel_gallons'] * $objfields['fuelflow_v_fuel_costg']) );
									$tmp	= round($tmp,5);
									array_push($atabledata, $tmp);
									$chartname	= "Miles Per Dollar";
								}
							if ($displaytypedata==8) {
									$tmp	= ($objfields['fuelflow_v_fuel_hours'] / ($objfields['fuelflow_v_fuel_gallons'] * $objfields['fuelflow_v_fuel_costg']) );
									$tmp	= round($tmp,5);
									array_push($atabledata, $tmp);
									$chartname	= "Hours Per Dollar";
								}
							//echo " atabledata |".$atabledata[$counter]."|<br>";
							$counter = ($counter + 1);
						}
				}
		}
?>
<script type="text/javascript" src="scripts/wz_jsgraphics.js"></script>
<script type="text/javascript" src="scripts/line.js"></script>

<font size="3"><b><?=$chartname;?></b></font>
<br>
<br><br>
<br><br>
<br><br>
<br>
<div id="lineCanvas" style="overflow: auto; position:relative;height:500px;width:700px;"></div>
<script type="text/javascript">
var g = new line_graph();
	<?
	$tmparray = count($atabledata);
	for ($i=1; $i<$tmparray; $i++) {
			?>
g.add('<?=$i;?>', <?=$atabledata[$i];?>);
			<?
		}
		?>		
g.render("lineCanvas", "<?=$chartname;?>");
</script>
