<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 121 Activity Linechart.php		The purpose of this page is to view activity in a linechart format
	
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
		$tblsubname			= "please complete the form to see a chart";
		
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
		<font size="2"><br></font>
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
		<form name="Show" action="part121activity_linechart_report.php" method="POST" name="linechartform" id="linechartform" target="linechartWindow" onsubmit="window.open('', 'linechartWindow', 'width=750,height=550,status=no,resizable=yes,scrollbars=yes')">
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
								Operator
								</td>
							<td class="formanswers">
								<?
								organizationcomboboxgettype(1, "all", "operator", "show", "");
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
													>Scheduled Enplanements</option>
									<option value=2
										<?
										if ($displaytypedata==2) {
												?>
									SELECTED
												<?
											}
										?>
													>Scheduled Deplanements</option>
									<option value=3 
										<?
										if ($displaytypedata==3) {
												?>
									SELECTED
												<?
											}
										?>
													>Non Rev. Enplanements</option>
									<option value=4
										<?
										if ($displaytypedata==4) {
												?>
									SELECTED
												<?
											}
										?>
													>Non Rev. Deplanements</option>
									<option value=7
										<?
										if ($displaytypedata==7) {
												?>
									SELECTED
												<?
											}
										?>
													>Air-Frieght In</option>
									<option value=8
										<?
										if ($displaytypedata==8) {
												?>
									SELECTED
												<?
											}
										?>
													>Air-Frieght Out</option>
									<option value=9 
										<?
										if ($displaytypedata==9) {
												?>
									SELECTED
												<?
											}
										?>
													>Total Landings (NF)</option>
									<option value=10 
										<?
										if ($displaytypedata==10) {
												?>
									SELECTED
												<?
											}
										?>
													>Total Overnight (NF)</option>
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