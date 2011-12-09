<HTML>
	<HEAD>
		<link href="defaultoa.css" rel="stylesheet" type="text/css">
		<TITLE>
			Field Condition Cheet Sheet
			</TITLE>
		</HEAD>
<?
// Get Field Name
$fieldname = $_GET['fieldname'];
$cellvalue = $_GET['cellvalue'];
//echo $fieldname;
//echo $cellvalue;
//$fieldname = "garampcondition";
?>
	<BODY>
		<form name="entryform">
		<input id="<?=$fieldname;?>" name="<?=$fieldname;?>" type="hidden">
			</form>
		<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
			<tr>
				<td class="formoptions" colspan="9" align="center">
					<font size="6" color="#FFFFFF">
						<center>Field Condition Cheet Sheet
						</font>
					</td>
				</tr>
			<tr>
				<td class="tablesubcontent" colspan="9" align="center">
					<font size="3" color="#FFFFFF">
						Please use this form to add descriptions to the condition field of the FiCON. 
						Each image shows an example of a different type of surface contamination which 
						can be used to describe an airport surface. When you click on a picture the 
						associated text will be added to the condition desacription HELP field you clicked on.
						</font>
					</td>
				</tr>
			<tr>
				<td class="formoptions" colspan="3" align="center">
					<font size="4">
						Type
						</font>
					</td>
				<td class="formoptions" colspan="3" align="center">
					<font size="4">
						Coverage
						</font>
					</td>
				<td class="formoptions" colspan="3" align="center">
					<font size="4">
						Depth
						</font>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','dry');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Dry
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','clear');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Clear
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over000.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','0-0.25');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								0.00" to 0.25"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_wet.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','Wet');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Wet
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_cover_10.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','isolated');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								0% to 5%
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over025.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','0.25-0.50');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								0.25" to 0.50"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_snow.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','snow');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Snow
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_cover_10.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','isolated');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								5% to 10%
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over050.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>',' 0.50-0.75');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								0.50" to 0.75"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_snow.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','drysnow');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Dry Snow
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_cover_20.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','isolated');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								10% to 15%
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over075.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','0.75-1');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								0.75" to 1.00"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','wetsnow');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Wet Snow
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_cover_20.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','isolated');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								15% to 20%
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over100.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','1-1.25');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								1.00" to 1.25"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','Compactsnow');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Compacted Snow
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_cover_30.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','isolated');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								20% to 30%
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over125.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','1.25-1.5');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								1.25" to 1.50"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','slush');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Slush
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_cover_40.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','patchy');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								30% to 40%
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over150.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','1.5-1.75');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								1.50" to 1.75"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_ice.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','Ice');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Ice
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_cover_50.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','patchy');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								40% to 50%
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over175.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','1.75-2');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								1.75" to 2.00"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_snowdrifts.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','drifts');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Snow Drifts
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_cover_60.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','patchy');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								50% to 60%
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over200.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','2-2.25');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								2.00" to 2.25"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_standingwater.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','stdwater');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Standing Water
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_cover_70.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','patchy');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								60% to 70%
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over225.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','2.25-2.5');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								2.25" to 2.50"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_plowed.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','PLW');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Plowed
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_cover_80.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','patchy');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								70% to 80%
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over250.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','2.5-2.75');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								2.50" to 2.75"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_sanded.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','SND');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Sanded
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_cover_90.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','totcover');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								80% to 90%
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over275.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','2.75-3');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								2.75" to 3.00"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					&nbsp;
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_cover_100.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','totcover');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								90% to 100%
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over300.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','3-3.25');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								3.00" to 3.25"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					&nbsp;
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','CNT 50');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Center 50 feet
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over325.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','3.25-3.5');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								3.25" to 3.50"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					&nbsp;
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','CNT 75');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Center 75 feet
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over350.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','3.5-3.75');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								3.50" to 3.75"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					&nbsp;
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/condition_backdrop.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','FW');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								Full Width
								</td>
							</tr>
						</table>
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over375.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','3.75-4');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								3.75" to 4.00"
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					&nbsp;
					</td>
				<td colspan="3" class="tablesubcontent">
					&nbsp;
					</td>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100" cellspacing="3" cellpadding="5" id="table2" height="10" style="float: left">
						<tr>
							<td class="formoptions" align="center">
								<img src="images/part_139_339/depth_over400.gif" width="100" height="50" style="cursor:hand" onclick="updateparentfieldvalue('<?=$fieldname;?>','4plus');">
								</td>
							</tr>
						<tr>
							<td class="formoptions" align="center">
								4.00" and up
								</td>
							</tr>
						</table>
					</td>
				</tr>

			</table>
			<script>
	function updateparentfieldvalue(fieldname,fieldvalue) {
		//opener.document.getElementById(fieldname).value = fieldvalue;
		if (opener.document.getElementById(fieldname).value == "") {
				opener.document.getElementById(fieldname).value = fieldvalue;
			}
			else {
				opener.document.getElementById(fieldname).value = opener.document.getElementById(fieldname).value + " " + fieldvalue;
			
			}
		}
	</script>
		</body>
	</html>
				