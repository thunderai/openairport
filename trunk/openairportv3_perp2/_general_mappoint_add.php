<?php
// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		//include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page

// Load Page Specific Includes

		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_modules/part139339/part139339.list.php");
		//include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		//include("includes/_generalsettings/generalsettings.list.php");
		?>
		
		<script type="text/javascript">
var getX = function(evt){

		var IE = document.all?true:false;


		if (IE) { // grab the x-y pos.s if browser is IE
				return evt.x + document.documentElement.scrollLeft; 
			}
			else {  // grab the x-y pos.s if browser is NS
				return evt.pageX + document.getElementById("airportmap").scrollLeft;
			}  		
		
		
		
		 //if(evt.x){ 
		//		return evt.x + document.documentElement.scrollLeft; 
		//	}
			
		// if(evt.pageX){ 
		//		return evt.pageX + document.body.scrollLeft;
		//	}
		
	}
var getY = function(evt){

		var IE = document.all?true:false;


		if (IE) { // grab the x-y pos.s if browser is IE
		
				if(evt.y + document.documentElement.scrollTop){ 
				
						return evt.y + document.documentElement.scrollTop;
						}
						//return evt.y + document.documentElement.scrollTop;
			}
			else {  // grab the x-y pos.s if browser is NS
			
				if(evt.pageY + document.getElementById("airportmap").scrollTop ){ 
				
						return evt.pageY + document.getElementById("airportmap").scrollTop; 

						//return evt.pageX + document.getElementById("IslandMap").scrollTop;
					}
			}
	}
			
var alertCoords = function(evt){

				opener.edittable.MouseX.value = getX(evt)
				opener.edittable.MouseY.value = getY(evt)
		
		//document.getElementById("mappoint_x").value = getX(evt)
		//document.getElementById("mappoint_y").value = getY(evt)

		//alert("Mouse was click on map at" +"\n" +"\n X = "+ getX(evt) +"\n Y = "+ getY(evt) +"\n" +"\n You may close this window. \n\n Nothing was added to the Database");
		location.reload(true);
	}	


// RUN CODE ON PAGE LOAD

	// GET DATA FROM GET URL STRING
		//alert("First Time Page Load");
		function getURLParameter(name) {
			  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
			}
		var first 	= getURLParameter('table');
		//alert(first);
		var second 	= getURLParameter('id');
	// TEST IF THE VARIABLES HAVE A VALUE
		if(!first) {
				//alert("First Time Page Load");
				// NO VALUE INITIATE INITIAL PAGE LOAD
				if (window.opener.document.getElementById("selectequipment")) {
						//alert("Object Fired");
						// code here when the element exists
						var e = window.opener.document.getElementById("selectequipment");
						var strUser = e.options[e.selectedIndex].value;
						//alert(strUser);
						var table 	= 'equipment';
						var id		= strUser;
						//window.location.search += '?table='+table+'&id='+id;
						window.location.href = location.href+'?table='+table+'&id='+id;
						//alert(window.location.href);
					}
			} else {
				//alert("Second Page Load Time Page Load");
				// THERE ARE VARABLES IN THE GET STATEMENT
				// DO NOTHING
			}
	
			</script>
		</HEAD>
	<BODY>
		<?php
		// See if there is a GET Variables
		if (!isset($_GET["table"])) {
				// No
				$table 	= '';
				$id		= '';	
				?>
	<script>
		//alert(' GET ID: <?php echo $id;?>');
		</script>
				<?php					
			}
			else {
				// Yes
				$table 	= $_GET['table'];
				$id		= $_GET['id'];
				?>
	<script>
		//alert(' GET ID: <?php echo $id;?>');
		</script>
				<?php				
				
				switch($table) {
					case 'equipment':
						// Start Simple
						// GET X,Y for this equipment
						$sql2 		= 'SELECT * FROM tbl_inventory_sub_e WHERE equipment_id = '.$id.' ';					
				?>
	<script>
		//alert(' SQL: <?php echo $sql2;?>');
		</script>
				<?php						
						
						$objconn2 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}
							else {
								$objrs2 = mysqli_query($objconn2, $sql2);
								if ($objrs2) {
										$numberofrows = mysqli_num_rows($objrs2);
				?>
	<script>
		//alert(' Number of Rows: <?php echo $numberofrows;?>');
		</script>
				<?php										
										while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
												// GET BASIC INFORMATION
													$lat	= $objarray2['equipment_lat'];
													$long	= $objarray2['equipment_long'];
				?>
	<script>
		//alert(' Lattitude: <?php echo $lat;?>, Longitude: <?php echo $long;?> ');
		</script>
				<?php													
												// CONVERT BASIC INFORMATION TO SCREEN X,Y
													$screen_y = ($lat / $convertarray[1]) - ($convertarray[2] / $convertarray[1]);
													$screen_x = (abs($long) / $convertarray[0]) - ($convertarray[3]/$convertarray[0]);
				?>
	<script>
		//alert(' Raw X: <?php echo $screen_y;?>, Raw Y: <?php echo $screen_x;?> ');
		</script>
				<?php													
													$screen_y = round(($screen_y),0);
													$screen_x = round(($screen_x),0);
				?>
	<script>
		//alert(' Rounded X: <?php echo $screen_y;?>, Rounded Y: <?php echo $screen_x;?> ');	
		</script>
				<?php														
													
											}
									}
							}
					
						break;
				
				
				
					}
				
			}

	
		?>
		<div style="position:absolute; z-index:1; left: 0; top: 0; align="left">
			<img border="0" name="airportmap" id="airportmap" onclick="alertCoords(event)" src="images/part_139_327/<?php echo $alargemap[0];?>" style="cursor: crosshair;">
			</div>
		<div style="position:absolute; z-index:4; left: 10; top: 0; align="left">
			<b>Please click on the map where this item is located</b>
			</div>
		<div Name="mapicon" ID="mapicon" style="position:absolute; z-index:3;" align='left'>
			<img border="0" src="images/part_139_327/discrepancywork3.gif" width="31" height="31" border="0">
			</div>
		<?php 
		if($id == 0) {
				?>
				<script type="text/javascript">
					var tmpMouseX = opener.edittable.MouseX.value;
					var tmpMouseY = opener.edittable.MouseY.value;
					
					var offsetX		= -16;
					var offsetY		= -16;
					
					tmpMouseX = (tmpMouseX * 1) + offsetX;
					tmpMouseY = (tmpMouseY * 1) + offsetY;
					
					var div 		= document.getElementById('mapicon');
					
					div.style.left 	= tmpMouseX + 'px';
					div.style.top 	= tmpMouseY + 'px';
					
				</script>
				<?php
			} else {
				?>
			<script>
				//alert(' Rounded X: <?php echo $screen_y;?>, Rounded Y: <?php echo $screen_x;?> ');
				
					var div 		= document.getElementById('mapicon');
					
					div.style.left 	= <?php echo $screen_x;?> - 16 + 'px';
					div.style.top 	= <?php echo $screen_y;?> - 16 + 'px';		
				</script>	
				<?php
			}
			?>
		</BODY>
	</HTML>