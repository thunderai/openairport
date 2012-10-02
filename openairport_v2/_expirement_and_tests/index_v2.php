<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	index.php						The purpose of this file is to load the user interface
	
								Usage:
								Just include this page in with your other page and the functions will be avilable to be used in that page.
								
								
								
								
	NOTE: THERE SHOULD BE NO NEED TO CHANGE ANY OF THE CODE ON THIS PAGE
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	

	include("includes/header.php");				// include file that gets information from form posts for navigational purposes
?>
<div id="maincontainer">
	<div id="topsection">
		<table border="0" width="100%" id="table1" cellpadding="0" cellspacing="0">
			<tr>
				<td height="49"	width="152"							class="layout_topheaderleft" 	id="layout_topheaderleft"><img src="images/layoutheaderlogo.gif" id="spotlight" speed="50" ></td>
				<td height="49" width="320"							class="layout_topheadercenter" 	id="layout_topheadercenter">OpenAirport.org</td>
				<td height="49" width="*"							class="layout_topheaderright" 	id="loginbox">
					<?
					$showlogheader = flogheader();
					?>
					</td>
				</tr>
			</table>
		</div>
	<div id="contentwrapper">
		<div id="contentcolumn">
			<div class="innertube_welcomebox">
			<?$showwelcomebox = fwelcomebox();?>
				</div>
			<div class="innertube"><iframe id="layouttableiframecontent" name="layouttableiframecontent" SRC="index_new.php" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" style="overflow:visible; width:100%; display:none"></iframe>
				</div>
			</div>
		</div>
	<div id="leftcolumn">
		<div class="innertube_navigationbox"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			</div>
		</div>
	<div id="footer"><a href="http://www.dynamicdrive.com/style/">Dynamic Drive CSS Library</a>
		</div>
	<div style="position:absolute;left:-6px;top:48px;height:0px;width:150px;padding:1em;">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="150" class="tableheadercenter">
					Menu Items
					</td>
				</tr>
			</table>
		<?$shownavigation = flogin($strattemptedusername, $strattemptedpassword);?>
		</div>
<?
include("includes/footer.php");				// include file that gets information from form posts for navigational purposes
?>