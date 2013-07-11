<?php 
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o		o	ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		oo		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		o o		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o 	o	o	ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  	 o	o	o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	  o	o	o	o	  o		o	o	o		o	o	o   o	  o
//	00000	0		ooooo	o		o	o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document		:	part139337_report_help_species.php
//
//	Purpose of Page			:	Help User by displaying species that can be clicked on
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page

// Load Page Specific Includes

		include("includes/_modules/part139337/part139337.list.php");
		include("includes/_template_enter.php");
		//include("includes/_template/template.list.php");
		
// LOAD GET Veriables

		$fieldname = $_GET['fieldname'];
		$cellvalue = $_GET['cellvalue'];

?>
		<form name="entryform">
		<input id="<?=$fieldname;?>" name="<?=$fieldname;?>" type="hidden">
			</form>
	<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
		<tr>
			<td class="perp_menuheader" />
				Species Help Chart
				</td>			
			</tr>			
		<tr>
			<td class="perp_menusubheader" />
				(
				Click on the picture of an animal to select it
				)
				</td>				
			</tr>	
		<tr>
			<td class="item_name_small_inactive" />
				<p>
					You may use this form to help determine which animal you are seeing out in the field. 
					Each image shows an example of a different type of animal that could be seen at the airport.
					</p><br>
				<p>
					- Click on the name of the animal to open a new window with a larger view of the animal.<br>
					- Click on the picture of the animal to automatically select that animal in the Wildlife Hazard Management Form.<br>
					- Cliking on the classification of the animal will do a Google Search for that animal.
					</p>
				</td>
			</tr>
		<tr>
			<td class="item_name_small_inactive" />
				<table width="100%" cellpadding="0" cellspacing="0" />
		<?php
		// To display the species for the user, sort the species records, by name resetting the row every four animals
		
		//echo "[1][a][1] Display Species in a 4x? grid <br>";
		
		$sql = "SELECT * FROM tbl_139_337_sub_s 
		WHERE tbl_139_337_sub_s.139337_sub_s_archived_yn = 0 
		ORDER BY 139337_sub_s_category, 139337_sub_s_name ";
		
		//echo "[1][a][2] Do this with the following SQL Statement ".$sql." <br>";
		
		$objconn_support = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs_support = mysqli_query($objconn_support, $sql);
				if ($objrs_support) {
				
						$number_of_rows = mysqli_num_rows($objrs_support);
						$possible_rows 	= intval(($number_of_rows / 4) + 1);
						
						//echo "[1][a][3] There will be ".$possible_rows." rows <br>";
						
						$rowcounter		= 0;
						
						while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
									
								if($rowcounter == 0) {
										// This is the first row or the next full row
										// Start a new table row
										?>
			
										<?php
									}
									?>
				
					<table width="125" height="200" cellpadding="0" cellspacing="3" border="1" class="formheaders" style="float:left;" />
						<?php
						// Take name of species, cut out all spaces, and that is our image name
						$speciesimage = str_replace(" ","",$objfields['139337_sub_s_name']);
						$speciesimage = str_replace(":","",$speciesimage);
						$speciesimage = str_replace("(","",$speciesimage);
						$speciesimage = str_replace(")","",$speciesimage);
						$speciesimage = str_replace("-","",$speciesimage);
						?>
						<tr>
							<td class="formresults" colspan="2" onClick="openchild600('images/part_139_337/<?php echo $speciesimage;?>.jpg','largeselectaspecies')">
								<center><b><?php echo $objfields['139337_sub_s_name'];?></b></center>
								</td>
							</tr>				
						<tr>
							<td class="formresults" colspan="2" onclick="updateparentfieldvalue('wlhmspecies','<?php echo $objfields['139337_sub_s_id'];?>')">
								<center><img src="images/part_139_337/<?php echo $speciesimage;?>.png" width="130" height="85" border="1" ></center>
								</td>
							</tr>
						<tr>
							<td class="formresults" colspan="2" onClick="openchild600('http://www.google.com/search?q=<?php echo $objfields['139337_sub_s_name'];?>','largeselectaspecies')">
								<center><font size="1"><?php echo $objfields['139337_sub_s_category'];?></font></center>
								</td>
							</tr>
						<tr>
							<td class="formresults">
								State Permit?
								</td>
							<td class="formresults">
								<?php
								if($objfields['139337_sub_s_statepermit'] == 1) {
										?>
										Yes
										<?php
									}
									else {
										?>
										No
										<?php
									}
									?>
								</td>
							</tr>
						<tr>
							<td class="formresults">
								Federal Permit?
								</td>
							<td class="formresults">
								<?php
								if($objfields['139337_sub_s_federalpermit'] == 1) {
										?>
										Yes
										<?php
									}
									else {
										?>
										No
										<?php
									}
									?>
								</td>
							</tr>
						</table>
							<?php
							
								$rowcounter = ($rowcounter + 1);
								if($rowcounter == 4) {
										// End this row and reset the variable
										?>
					
										<?php
										$rowcounter = 0;
									}
							
							}
					}
			}
			?>
			
	<script>
	function updateparentfieldvalue(fieldname,fieldvalue) {
		//opener.document.getElementById(fieldname).value = fieldvalue;
		var fieldtochange = escape(fieldname);
		opener.document.getElementById('wlhmspecies').value = fieldvalue;
		}
	</script>
	
			<?php
include("includes/_userinterface/_ui_footer.inc.php");		// include file that gets information from form POSTs for navigational purposes
?>