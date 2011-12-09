<?
 Session_Start();
 Session_Register("user_id");
	
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	ajax_navigationmenu_request			Used to load navigational menu items inline rather then through the menu system
	
								Usage:
								Dont unless you know what you want with it.
								
								
						
						
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		//include("includes/header.php");																	// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		//include("includes/POSTs.php");																	// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		include("includes/FormFunctions.php");														// already included in header.php
				
		$aInspection		= "";
		$i				= 1;

		$menuitemid 		= $_GET["menuitemid"];
		$menuitemurl 		= $_GET["menuitemurl"];
		$tmpuserid 		= $_SESSION["user_id"];
		
	// Determine if the selected menu item is unslaved, and if so, find all navigational items this user can use and then display them.
	
	//Display BreadCrum System
	
	$layer2menuconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$sql = 	"SELECT 
							tbl_systemusers.emp_record_id, 
							tbl_systemusers_ncga.navigational_user_id_cb_int, 
							tbl_systemusers_ncga.navigational_group_id_cb_int, 
							tbl_navigational_control.menu_item_id, 
							tbl_navigational_control.menu_item_location, 
							tbl_navigational_control.menu_item_slaved_to_id, 
							tbl_navigational_control.menu_item_name_long, 
							tbl_navigational_control.menu_item_name_short, 
							tbl_navigational_control.menu_item_archived_yn, 
							tbl_navigational_control_g.navigational_groups_id, 
							tbl_navigational_control_g.navigational_groups_id, 
							tbl_navigational_control_g_a.navigational_archived_yn, 
							tbl_navigational_control_g_a.navigational_groups_id_cb_int,
							tbl_navigational_control_g_a.navigational_control_id_cb_int 
					FROM tbl_systemusers			
					INNER JOIN tbl_systemusers_ncga 			ON tbl_systemusers.emp_record_id 							= tbl_systemusers_ncga.navigational_user_id_cb_int
					INNER JOIN tbl_navigational_control_g 	ON tbl_navigational_control_g.navigational_groups_id 			= tbl_systemusers_ncga.navigational_group_id_cb_int
					INNER JOIN tbl_navigational_control_g_a	ON tbl_navigational_control_g_a.navigational_groups_id_cb_int	= tbl_navigational_control_g.navigational_groups_id
					INNER JOIN tbl_navigational_control		ON tbl_navigational_control.menu_item_id						= tbl_navigational_control_g_a.navigational_control_id_cb_int
					WHERE tbl_systemusers.emp_record_id = '".$tmpuserid."' and tbl_navigational_control.menu_item_slaved_to_id = '".$menuitemid."' AND tbl_navigational_control.menu_item_archived_yn = 0 AND tbl_navigational_control_g_a.navigational_archived_yn = 0  
					ORDER BY tbl_navigational_control.menu_item_name_short asc";	
			$layer2menures = mysqli_query($layer2menuconn, $sql);
			
			if ($layer2menures) {
					$number_of_rows = mysqli_num_rows($layer2menures);
					//printf("result set has %d rows. \n", $number_of_rows);
					
					while ($layer2array = mysqli_fetch_array($layer2menures, MYSQLI_ASSOC)) {
						//ob_flush();
						//flush();
						$tmpfirstnamel2 		= $layer2array['emp_firstname'];
						$tmplastnamel2 	   	= $layer2array['emp_lastname'];
						$tmpmenuitemlocl2	= $layer2array['menu_item_location'];
						$tmpuseridl2 		= $layer2array['emp_record_id'];
						$tmpmenuslaveidl2	= $layer2array['menu_item_slaved_to_id'];
						$tmpmenusshortnl2   	= $layer2array['menu_item_name_short'];
						$tmpmenuitemidl2		= $layer2array['menu_item_id'];
						
						?>
				<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem<?=$tmpmenuitemidl2;?>" method="POST" action="<?=$tmpmenuitemlocl2;?>" target="layouttableiframecontent">
					<input type="hidden" name="menuitemid" value="<?=$tmpmenuitemidl2;?>">
					<a href="#" onclick="javascript:document.menuitem<?=$tmpmenuitemidl2;?>.submit()"><?=$tmpmenusshortnl2;?></a>
					</form>
						<?
						}
				}	// End if
		}
?>
