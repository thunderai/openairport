<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title>Where Am I?</title>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript" src="scripts/_iface/thirdparty/geometa/geometa.js"></script>
		<script type="text/javascript" src="scripts/_iface/thirdparty/prototype/prototype.js"></script>
		<script type="text/javascript">
			var map;
			function initialise() {
					var latlng = new google.maps.LatLng(-25.363882,131.044922);
					var myOptions = {
							zoom: 4,
							center: latlng,
							mapTypeId: google.maps.MapTypeId.SATELLITE,
							disableDefaultUI: true
							}
					//map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
					prepareGeolocation();
					doGeolocation();
				}
				
			function doGeolocation() {
					if (navigator.geolocation) {
							navigator.geolocation.watchPosition(positionSuccess, positionError, { enableHighAccuracy:true });
						} else {
							positionError(-1);
						}
				}

			function positionError(err) {
					var msg;
					switch(err.code) {
							case err.UNKNOWN_ERROR:
								msg = "Unable to find your location";
								break;
							case err.PERMISSION_DENINED:
								msg = "Permission denied in finding your location";
								break;
							case err.POSITION_UNAVAILABLE:
								msg = "Your location is currently unknown";
								break;
							case err.BREAK:
								msg = "Attempt to find location took too long";
								break;
							default:
								msg = "Location detection not supported in browser";
						}
					document.getElementById('info').innerHTML = msg;
				}

			function positionSuccess(position) {
					// Centre the map on the new location
					var coords = position.coords || position.coordinate || position;
					var latLng = new google.maps.LatLng(coords.latitude, coords.longitude);
					document.getElementById('word').value		= coords.latitude + '/' + coords.longitude;
					document.getElementById('lat').value		= coords.latitude;
					document.getElementById('long').value		= coords.longitude;
					document.getElementById('info').innerHTML	= 'found';
				}
				
			function contains(array, item) {
					for (var i = 0, I = array.length; i < I; ++i) {
							if (array[i] == item) return true;
						}
					return false;
				}
			</script>
		</head>
	<body onload="initialise()">  
		<div id="content">
			</div>

 <div id="map_canvas"></div>

                                
                                
								
<p>
  <form name="location" id="location" action="" method="post" onsubmit="comet.doRequest($('word').value);$('word').value='';return false;" />
    <input type="text" name="word" id="word" value="" />
    <input type="text" value="?" name="lat" id="lat" onfocus="document.info2.innerHTML = 'false'"/> / <input type="text" value="?" name="long" id="long" />

	<input type="submit" name="submitbutton" value="Send" />
  </form>
</p>
<div id="info" class="lightbox">Detecting your location...</div>
<div id="info2" class="lightbox">Detecting your location...</div>
		
<script type="text/javascript">
var auto = setTimeout(function(){ autoRefresh(); }, 1000);
function submitform(){
          //alert('test');
			document.getElementById("location").onsubmit();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 1000);
        }

var Comet = Class.create();
Comet.prototype = {

  timestamp: 0,
  url: 'scripts/_iface/thirdparty/prototype/backend.php',
  noerror: true,

  initialize: function() { },

  connect: function()
  {
    this.ajax = new Ajax.Request(this.url, {
      method: 'get',
      parameters: { 'timestamp' : this.timestamp },
      onSuccess: function(transport) {
        // handle the server response
        var response = transport.responseText.evalJSON();
        this.comet.timestamp = response['timestamp'];
        this.comet.handleResponse(response);
        this.comet.noerror = true;
      },
      onComplete: function(transport) {
        // send a new ajax request when this request is finished
        if (!this.comet.noerror)
          // if a connection problem occurs, try to reconnect each 5 seconds
          setTimeout(function(){ comet.connect() }, 5000); 
        else
          this.comet.connect();
        this.comet.noerror = false;
      }
    });
    this.ajax.comet = this;
  },

  disconnect: function()
  {
  },

  handleResponse: function(response)
  {
    $('content').innerHTML += "<div onclick='javascript:alert(" + 'test' + ");'>" + response['msg'] + '</div>';
  },

  doRequest: function(request)
  {
    new Ajax.Request(this.url, {
      method: 'get',
      parameters: { 'msg' : request }
    });
  }
}
var comet = new Comet();
comet.connect();
</script>

</body>
</html>