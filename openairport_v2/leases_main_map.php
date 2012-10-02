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
//	Name of Document	:	Leases Main Map.php
//
//	Purpose of Page		:	This file will map out the selected lease type
//							
//							
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		


	// Load include files
	
		include("includes/header.php");																// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");																// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");														// already included in header.php
		//include("includes/UserFunctions.php");													// already included in header.php
	
	// Load Get Statements
	
		$sub_type	= $_GET['subtype'];
		$objectid	= $_GET['objectid'];
	
		//echo "Selected Sub Type is :".$sub_type."<br>";	
		//echo "Selected Object ID is :".$objectid."<br>";
		
	// Load information about the selected type of lease to map
	
		// GET The subtype of this lease
	
				$sql = "SELECT * FROM tbl_general_tblrlshp WHERE tbl_gtr_t_id = ".$sub_type;
			
				$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
			
				if (mysqli_connect_errno()) {
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}
					else {
						$objrs_support = mysqli_query($objconn_support, $sql);
						if ($objrs_support) {
								$number_of_rows = mysqli_num_rows($objrs_support);
								while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
										$tmpsuppliedid 			= $objfields['tbl_gtr_t_id'];
										$tmpsuppliedname 		= $objfields['tbl_gtr_t_name'];
										$tmpsuppliedtablename 	= $objfields['tbl_gtr_t_tablename_txt'];
										$tmpsuppliedarch		= $objfields['tbl_gtr_t_archived_yn'];
									}
							}
					}
		
		//echo "Lease subtype ID :".$tmpsuppliedid."<br>";
		//echo "Lease subtype Name :".$tmpsuppliedname."<br>";
		//echo "Lease subtype Table Name :".$tmpsuppliedtablename."<br>";
		//echo "Lease subtype Archieved ? :".$tmpsuppliedarch."<br>";
		
		// Use the retrieved subtype of lease to get the actual lease information by pulling the objectid information
		
				$sql = "SELECT * FROM ".$tmpsuppliedtablename." WHERE ".$tmpsuppliedname."_id = ".$objectid;
				
				//echo "SQL Statement is :".$sql."<br>";
				
				$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
			
				if (mysqli_connect_errno()) {
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}
					else {
						$objrs_support = mysqli_query($objconn_support, $sql);
						if ($objrs_support) {
								$number_of_rows = mysqli_num_rows($objrs_support);
								while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
										$tmpobjectid			= $tmpsuppliedname."_id";
										$tmpobjectname			= $tmpsuppliedname."_name";
										$tmpobjectimage			= $tmpsuppliedname."_image_txt";
										
										$tmpobjectid			= strtolower($tmpobjectid);
										$tmpobjectname			= strtolower($tmpobjectname);
										$tmpobjectimage			= strtolower($tmpobjectimage);
										
										
												//echo "Lease Object ID :".$tmpobjectid."<br>";
												//echo "Lease Object Name :".$tmpobjectname."<br>";
												//echo "Lease Object Image Name :".$tmpobjectimage."<br>";
		
										$tmpobjectid			= $objfields[$tmpobjectid];
										$tmpobjectname 			= $objfields[$tmpobjectname];
										$tmpobjectimage			= $objfields[$tmpobjectimage];
									}
							}
					}
					
		//echo "Lease Object ID :".$tmpobjectid."<br>";
		//echo "Lease Object Name :".$tmpobjectname."<br>";
		//echo "Lease Object Image Name :".$tmpobjectimage."<br>";

		// Display Lease Background Image
		?>
		<form action="<?=$_SERVER["PHP_SELF"];?>" method="POST" name="sorttable" id="sorttable">
		<input type="hidden" name="menuitemid" value="<?=$_POST['menuitemid'];?>">
		<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10" class="tableheaderleft">&nbsp;</td>
				<td class="tableheadercenter">
					<?=$tmpobjectname;?>
					</td>
				<td class="tableheaderright">
					&nbsp;
					</td>
				</tr>
			<tr>
				<td align="center" valign="top" colspan="3" bgcolor="#FFFFFF">
					<iframe SRC="leases_main_map_gen.php?subtype=<?=$sub_type;?>&objectid=<?=$objectid;?>" TITLE="Lease Map" Width="100%" height="800" FRAMEBORDER="0"></iFrame>
					</td>
				</tr>
			</table>
		<?
		
?>
