<!DOCTYPE html>
<HTML>
	<HEAD>
	
		<!-- Load Applicables Scripts -->
		<script type="text/javascript" src="scripts/_iface/wz_jsgraphics.js"></script>
		<script type="text/javascript" src="scripts/_iface/ui_controls_lowerlayer.js"></script>
		<script type="text/javascript" src="scripts/_iface/dhtmlwindow.js"></script>
		
		<link href="stylesheets/perpcarto.css" 								rel="stylesheet" type="text/css" media="screen" />
		<link href="stylesheets/perpcarto_quickaccess.css" 					rel="stylesheet" type="text/css" media="screen" />
		<link href="stylesheets/perpcarto_mainmenu.css" 					rel="stylesheet" type="text/css" media="screen" />
		<link href="stylesheets/perpcarto_mapcontrols.css" 					rel="stylesheet" type="text/css" media="screen" />
		<link href="stylesheets/dhtmlwindow.css" 							rel="stylesheet" type="text/css" media="screen" />
		
		<?php 
		// LOAD INCLUDES
		
		include("includes/gs_config.php");
		include("includes/_dateandtime/dateandtime.list.php");										// List of all Date and Time functions
		include("includes/_systemusers/systemusers.list.php");										// List of all Navigation functions
		include("includes/_userinterface/userinterface.list.php");									// List of all Navigation functions
		include("includes/_generalsettings/generalsettings.list.php");								// List of all Navigation functions
		?>
		</HEAD>
<body leftmargin="0px" rightmargin="0px" topmargin="0px" marginwidth="0px" marginheight="0px" style="margin: 0px; margin-bottom:0px; margin-top:0px;margin-right:0px;background-color:transparent;" />
		
		<?php

$id 		= $_POST['elementrecordid'];
$idfield 	= $_POST['elementrecordidfield'];
$source 	= $_POST['elementrecordsource'];

$sql =" SELECT * FROM ".$source." WHERE ".$idfield." = ".$id." ";
	
//echo "Connect to database usining this SQL statement ".$sql." <br>";				
$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

if (mysqli_connect_errno()) {
		// there was an error trying to connect to the mysql database
		printf("connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	else {
		$objrs = mysqli_query($objconn, $sql);
				
		if ($objrs) {
				$number_of_rows = mysqli_num_rows($objrs);
				$header='';
				$rows='';
				?>
				<table width="100%" cellpadding="0" cellspacing="0" style="margin:0px;border:2px solid;padding:0px;border-style: solid;border-color: #000000;border-collapse: collapse;" />
	
					<tr>
						<td class="maptoolsfields_on" />
							Field Name
							</td>
						<td class="maptoolsfields_on" />
							Field Value
							</td>
						</tr>
				<?php
				while ($row = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						if($header==''){
								$header = $header.'<th>'; 
								$rows = $rows.'<tr>'; 
								foreach($row as $key => $value){ 
										$header = $header.'<td>'.$key.'</td>'; 
										?>
										<tr>
											<td name="TD<?php echo $key;?>" id="TD<?php echo $key;?>" 
												class="item_name_inactive" 
												onmouseover="TD<?php echo $key;?>.className='item_name_active';TD2<?php echo $key;?>.className='item_name_active';" 
												onmouseout="TD<?php echo $key;?>.className='item_name_inactive';TD2<?php echo $key;?>.className='item_name_inactive';" />
												<?php echo $key;?>
												</td>
											<td name="TD2<?php echo $key;?>" id="TD2<?php echo $key;?>" 
												class="item_name_inactive" 
												onmouseover="TD<?php echo $key;?>.className='item_name_active';TD2<?php echo $key;?>.className='item_name_active';" 
												onmouseout="TD<?php echo $key;?>.className='item_name_inactive';TD2<?php echo $key;?>.className='item_name_inactive';" />
												<?php echo $value;?>
												</td>
											</tr>
											<?php
										//echo $key.":".$value;
										//$rows = $rows.'<td>'.$value.'</td>'; 
									}	 
								$header = $header.='</th>'; 
								//$rows = $rows.='</tr>'; 
							}else{
								$rows = $rows.'<tr>'; 
								foreach($row as $value){ 
										//echo "<td>".$value."</td>"; 
									} 
								//$rows = $rows.='</tr>'; 
							}
					}
					//echo $header.$rows;
			}
	}
		
?>