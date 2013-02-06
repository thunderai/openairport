<HTML>
	<HEAD>
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

			</script>
		</HEAD>
	<BODY>
		<div style="position:absolute; z-index:1; left: 0; top: 0; align="left">
			<img border="0" name="airportmap" id="airportmap" onclick="alertCoords(event)" src="images/part_139_327/part139_327_airportmap_new_mapit.png" style="cursor: crosshair;">
			</div>
		<div style="position:absolute; z-index:4; left: 10; top: 0; align="left">
			<b>Please click on the map where this item is located</b>
			</div>
		<div Name="mapicon" ID="mapicon" style="position:absolute; z-index:3;" align='left'>
			<img border="0" src="images/part_139_327/discrepancywork3.gif" width="31" height="31" border="0">
			</div>
		
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
		</BODY>
	</HTML>