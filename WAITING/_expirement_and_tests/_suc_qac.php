<?php
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
//	Name of Document	:	_suc_qac.php
//
//	Purpose of Page		:	Show the user their special quick access control icons
//
//	Special Notes		:	Should be no special considerations.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		

// Include Required Files

	include("includes/header.php");																// include file that gets information from form posts for navigational purposes

// As defined the current systen user is in variable: $_SESSION["user_id"];
//		Out goal is to find all quick access records for this user and display them.
//		User can click on any one of the icons and their associated forms will display int eh content iFrame
?>
<table border="0" height="40" border="0" id="quickaccessitem" cellpadding="2" cellspacing="2" background="stylesheets/_cssimages/layoutheaderbackground.gif">
	<Tr>
<?php

	$sql = "SELECT * FROM tbl_systemusers 
			INNER JOIN tbl_quickaccess_control ON tbl_quickaccess_control.tbl_qac_systemuser_id = tbl_systemusers.emp_record_id 
			INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_quickaccess_control.tbl_qac_navigation_id 
			WHERE tbl_systemusers.emp_record_id = ".$_SESSION["user_id"]." AND tbl_quickaccess_control.tbl_qac_hidden_yn = 0 
			ORDER BY tbl_navigational_control.menu_item_name_long";

	//echo "The SQL Statement is :".$sql;
	
	$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($mysqli, $sql);
			if ($res) {
					$number_of_rows = mysqli_num_rows($res);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($newarray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
							$tmpmenuitemid 	= $newarray['menu_item_id'];
							$tmpmenuurl 	= $newarray['menu_item_location'];
							$tmpmenuitemloc	= $newarray['menu_item_name_long'];
							$tmpmenusshortnl= $newarray['menu_item_name_short'];
							$tmpmenupurp	= $newarray['menu_item_purpose'];
							$tmpmenuslaved	= $newarray['menu_item_slaved_to_id'];
							?>
	<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;display:inline;" name="menuitem<?php echo $tmpmenuitemid;?>" method="POST" action="<?php echo $tmpmenuurl;?>" target="layouttableiframecontent">
		<td width="50" class="formresults" onclick="javascript:parent.menuitem<?php echo $tmpmenuitemid;?>.submit()" style="cursor:hand" onMouseover="ddrivetip('<?php echo $tmpmenuitemloc;?>')"; onMouseout="hideddrivetip()">
			<input type="hidden" name="menuitemid" value="<?php echo $tmpmenuitemid;?>"></font>
			<a onclick="javascript:parent.menuitem<?php echo $tmpmenuitemid;?>.submit()"><?php echo $tmpmenusshortnl;?></a><br>
			</td>
		</form>
							<?php
						}	// End of while loop
					mysqli_free_result($res);
					mysqli_close($mysqli);
				}	// end of Res Record Object						
		}
		?>
		</tr>
	</table>
	<?php
include("includes/footer.php");				// include file that gets information from form posts for navigational purposes
?>