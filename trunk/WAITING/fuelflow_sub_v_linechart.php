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
//	Name of Document	:	FuelFlow Sub V Linechart.php
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
		
		$startyear				= 0;
		$endyear				= 0;
		$atabledata				= 0;
		$scale					= 0;
		$displaytypedata		= 0;

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

		$Counter 				= 0;
		$GraphxPost 			= 300;
		$GraphyPost 			= 600;
		$tmpPreviousetmpHeight 	= 0;
		$firstmovedown 			= 0;
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
		<link href="defaultoa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<BODY TOPMARGIN="0" LEFTMARGIN="8" MARGINWIDTH="0" MARGINHEIGHT="0">
<?
if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!

		If (!isset($_POST['scale'])) {
				$scale = 1;
			}
			else {
				//EndYear = Request.Form("Scale")
				$scale = 1;
			}
		if (!isset($_post['displaytypedata'])) {
				$displaytypedata = 1;
			}
			else {
				$displaytypedata = $_POST['displaytypedata'];
			}
		?>
		<form name="Show" action="fuelflow_sub_v_linechart_report.php" method="POST" name="linechartform" id="linechartform" target="linechartWindow" onsubmit="window.open('', 'linechartWindow', 'width=750,height=550,status=no,resizable=yes,scrollbars=yes')">
			<input type="hidden" name="formsubmit" 			value="1" >
		<table border="0" width="540" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10" class="tableheaderleft">&nbsp;</td>
				<td class="tableheadercenter">
					<?=$tblname;?>
					</td>
				<td class="tableheaderright">
					(<?=$tblsubname;?>)
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
						<tr>
							<td colspan="2" class="formoptionsavilabletop">
								Please complete the form below in as much detail as possible, and please pay close attention to syntax.
								</td>
							</tr>
						<tr>
							<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
								Start Date
								</td>
							<td class="formanswers">
								<input class="Commonfieldbox" type="text" name="frmstartdate" size="10" value="<?=$_GET['startdate'];?>">
								</td>
							</tr>
						<tr>
							<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
								End Date
								</td>
							<td class="formanswers">
								<input class="Commonfieldbox" type="text" name="frmenddate" size="10" value="<?=$_GET['enddate'];?>">
								</td>
							</tr>	
						<tr>
							<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
								Vehicle
								</td>
							<td class="formanswers">
								<?
								inventoryvehiclescombobox("all", "all", "operator", "show", "");
								?>
								<input type="hidden" name="disauthor" size="60" value="<?=$_SESSION['user_id'];?>">
								</td>
							</tr>											
						<tr>
							<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
								Display
								</td>
							<td class="formanswers">
								<select class="Commonfieldbox" name="displaytypedata">
									<option value=1 
										<?
										if ($displaytypedata==1) {
												?>
									SELECTED
												<?
											}
										?>
													>Miles</option>
									<option value=2
										<?
										if ($displaytypedata==2) {
												?>
									SELECTED
												<?
											}
										?>
													>Hours</option>
									<option value=3 
										<?
										if ($displaytypedata==3) {
												?>
									SELECTED
												<?
											}
										?>
													>Gallons</option>
									<option value=4
										<?
										if ($displaytypedata==4) {
												?>
									SELECTED
												<?
											}
										?>
													>Price</option>
									<option value=5
										<?
										if ($displaytypedata==5) {
												?>
									SELECTED
												<?
											}
										?>
													>Miles Per Gallon</option>
									<option value=6
										<?
										if ($displaytypedata==6) {
												?>
									SELECTED
												<?
											}
										?>
													>Hours Per Gallon</option>
									<option value=7
										<?
										if ($displaytypedata==7) {
												?>
									SELECTED
												<?
											}
										?>
													>Miles Per Dollar</option>
									<option value=8
										<?
										if ($displaytypedata==8) {
												?>
									SELECTED
												<?
											}
										?>
													>Hours Per Dollar</option>
									</select>								
								</td>
							</tr>											
						<tr>
							<td colspan="2" class="formoptionsavilablebottom">
								<input type="submit" value="Display Chart" name="b1" class="formsubmit">
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
		<?
		}
		?>