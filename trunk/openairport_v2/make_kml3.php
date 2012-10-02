<?php
//require('phpsqlajax_dbinfo.php');

// Opens a connection to a MySQL server.

$connection = mysql_connect ("localhost", "root", "airport");

if (!$connection) 
{
  die('Not connected : ' . mysql_error());
}
// Sets the active MySQL database.
$db_selected = mysql_select_db("openairport", $connection);

if (!$db_selected) 
{
  die('Can\'t use db : ' . mysql_error());
}

// Selects all the rows in the markers table.
$query = 'select * from tbl_inventory_sub_e 
		INNER JOIN tbl_inventory_sub_e_sub_t ON tbl_inventory_sub_e_sub_t.equipment_sub_type_id = tbl_inventory_sub_e.equipment_type_cb_int 
		where equipment_type_cb_int <> 3 AND equipment_type_cb_int <> 7 AND equipment_type_cb_int <> 8';
$result = mysql_query($query);

if (!$result) 
{
  die('Invalid query: ' . mysql_error());
}

// Creates the Document.
$dom = new DOMDocument('1.0', 'UTF-8');

// Creates the root KML element and appends it to the root document.
$node = $dom->createElementNS('http://earth.google.com/kml/2.1', 'kml');
$parNode = $dom->appendChild($node);

// Creates a KML Document element and append it to the KML element.
$dnode = $dom->createElement('Document');
$docNode = $parNode->appendChild($dnode);

// Creates the two Style elements, one for restaurant and one for bar, and append the elements to the Document element.
$papiStyleNode = $dom->createElement('Style');
$papiStyleNode->setAttribute('id', 'style_papi');
$papiIconstyleNode = $dom->createElement('IconStyle');
$papiIconstyleNode->setAttribute('id', 'icon_papi');
$papiIconstyleNode->setAttribute('scale', '0.6');
$papiIconstyleNode->setAttribute('color', 'ff0000ff');
$papiIconNode = $dom->createElement('Icon');
$papiHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/square.png');
$papiIconNode->appendChild($papiHref);
$papiIconstyleNode->appendChild($papiIconNode);
$papiStyleNode->appendChild($papiIconstyleNode);
$docNode->appendChild($papiStyleNode);

$malsrStyleNode = $dom->createElement('Style');
$malsrStyleNode->setAttribute('id', 'style_malsr');
$malsrIconstyleNode = $dom->createElement('IconStyle');
$malsrIconstyleNode->setAttribute('id', 'icon_malsr');
$malsrIconstyleNode->setAttribute('scale', '0.6');
$malsrIconstyleNode->setAttribute('color', 'ffffffff');
$malsrIconNode = $dom->createElement('Icon');
$malsrHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/target.png');
$malsrIconNode->appendChild($malsrHref);
$malsrIconstyleNode->appendChild($malsrIconNode);
$malsrStyleNode->appendChild($malsrIconstyleNode);
$docNode->appendChild($malsrStyleNode);

$signStyleNode = $dom->createElement('Style');
$signStyleNode->setAttribute('id', 'style_sign');
$signIconstyleNode = $dom->createElement('IconStyle');
$signIconstyleNode->setAttribute('id', 'icon_sign');
$signIconstyleNode->setAttribute('scale', '0.6');
$signIconstyleNode->setAttribute('color', 'ffffffff');
$signIconNode = $dom->createElement('Icon');
$signHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/triangle.png');
$signIconNode->appendChild($signHref);
$signIconstyleNode->appendChild($signIconNode);
$signStyleNode->appendChild($signIconstyleNode);
$docNode->appendChild($signStyleNode);

$twylightStyleNode = $dom->createElement('Style');
$twylightStyleNode->setAttribute('id', 'style_twylight');
$twylightIconstyleNode = $dom->createElement('IconStyle');
$twylightIconstyleNode->setAttribute('id', 'icon_twylight');
$twylightIconstyleNode->setAttribute('scale', '0.6');
$twylightIconstyleNode->setAttribute('color', 'ffff0000');
$twylightIconNode = $dom->createElement('Icon');
$twylightHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/placemark_circle.png');
$twylightIconNode->appendChild($twylightHref);
$twylightIconstyleNode->appendChild($twylightIconNode);
$twylightStyleNode->appendChild($twylightIconstyleNode);
$docNode->appendChild($twylightStyleNode);

$rwylightStyleNode = $dom->createElement('Style');
$rwylightStyleNode->setAttribute('id', 'style_rwylight');
$rwylightIconstyleNode = $dom->createElement('IconStyle');
$rwylightIconstyleNode->setAttribute('id', 'icon_rwylight');
$rwylightIconstyleNode->setAttribute('scale', '0.6');
$rwylightIconstyleNode->setAttribute('color', 'ffffffff');
$rwylightIconNode = $dom->createElement('Icon');
$rwylightHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/shaded_dot.png');
$rwylightIconNode->appendChild($rwylightHref);
$rwylightIconstyleNode->appendChild($rwylightIconNode);
$rwylightStyleNode->appendChild($rwylightIconstyleNode);
$docNode->appendChild($rwylightStyleNode);

$reilStyleNode = $dom->createElement('Style');
$reilStyleNode->setAttribute('id', 'style_reil');
$reilIconstyleNode = $dom->createElement('IconStyle');
$reilIconstyleNode->setAttribute('id', 'icon_reil');
$reilIconstyleNode->setAttribute('scale', '0.6');
$reilIconstyleNode->setAttribute('color', 'ff0000ff');
$reilIconNode = $dom->createElement('Icon');
$reilHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/donut.png');
$reilIconNode->appendChild($reilHref);
$reilIconstyleNode->appendChild($reilIconNode);
$reilStyleNode->appendChild($reilIconstyleNode);
$docNode->appendChild($reilStyleNode);

$clStyleNode = $dom->createElement('Style');
$clStyleNode->setAttribute('id', 'style_cl');
$clIconstyleNode = $dom->createElement('IconStyle');
$clIconstyleNode->setAttribute('id', 'icon_cl');
$clIconstyleNode->setAttribute('scale', '0.6');
$clIconstyleNode->setAttribute('color', 'ff0000ff');
$clIconNode = $dom->createElement('Icon');
$clHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/polygon.png');
$clIconNode->appendChild($clHref);
$clIconstyleNode->appendChild($clIconNode);
$clStyleNode->appendChild($clIconstyleNode);
$docNode->appendChild($clStyleNode);

$gpsStyleNode = $dom->createElement('Style');
$gpsStyleNode->setAttribute('id', 'style_gps');
$gpsIconstyleNode = $dom->createElement('IconStyle');
$gpsIconstyleNode->setAttribute('id', 'icon_gps');
$gpsIconstyleNode->setAttribute('scale', '0.6');
$gpsIconstyleNode->setAttribute('color', 'ff0000ff');
$gpsIconNode = $dom->createElement('Icon');
$gpsHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/cross-hairs.png');
$gpsIconNode->appendChild($gpsHref);
$gpsIconstyleNode->appendChild($gpsIconNode);
$gpsStyleNode->appendChild($gpsIconstyleNode);
$docNode->appendChild($gpsStyleNode);

// Iterates through the MySQL results, creating one Placemark for each row.
while ($row = @mysql_fetch_assoc($result))
{
		$record_id			= $row['equipment_id'];
		$record_name 		= $row['equipment_name'];
		$record_modelyear	= $row['equipment_modelyear'];
		$record_modelnumber = $row['equipment_modelnumber'];
		$record_lat			= $row['equipment_lat'];
		$record_long		= $row['equipment_long'];
		$record_man_id		= $row['equipment_manufac_cb_int'];
		$record_man_txt		= $row['equipment_manufac_cb_txt'];
		$record_sa			= $row['equipment_serialnumber_a'];
		$record_sb			= $row['equipment_serialnumber_b'];
		$record_sc			= $row['equipment_serialnumber_c'];
		$record_a			= $row['equipment_archived_yn'];
		$record_type_id		= $row['equipment_type_cb_int'];
		$record_type_txt	= $row['equipment_type_cb_txt'];
		$record_type_txt2	= $row['equipment_sub_type_name'];
  // Creates a Placemark and append it to the Document.

  $node = $dom->createElement('Placemark');
  $placeNode = $docNode->appendChild($node);

  // Creates an id attribute and assign it the value of id column.
  $placeNode->setAttribute('id', 'placemark' . $record_id);

  // Create name, and description elements and assigns them the values of the name and address columns from the results.
  $nameNode = $dom->createElement('name',htmlentities($record_name));
  $placeNode->appendChild($nameNode);
  
  $loadHTML_description = "<table align='center' width='100%'><tr><td align='center' valign='middle'>".$record_type_txt2."</td></tr></table><br>Notes:<br>Add Custom notes<br><br>Tools:<br><table with='100%' align='center'><tr><td><font size='3'>Function</font></td><td><font size='3'>Manage</font></td></tr><tr><td>Discrepancies</td><td><a href='localhost/discrepancy.php?unit=".$record_id."'>Yes</a></td></tr><tr><td>Maintenance Event</td><td><a href='localhost/discrepancy.php?unit=".$record_id."'>Yes</a></td></tr></table><br>Additional Resources:";
  
  $descNode = $dom->createElement('description', $loadHTML_description);
  $placeNode->appendChild($descNode);
  
  switch ($record_type_id) {
		case 1:  
				$styleUrl = $dom->createElement('styleUrl', 'style_papi');
				break;
		case 2:  
				$styleUrl = $dom->createElement('styleUrl', 'style_malsr');
				break;				
		case 4:  
				$styleUrl = $dom->createElement('styleUrl', 'style_sign');
				break;
		case 5:  
				$styleUrl = $dom->createElement('styleUrl', 'style_twylight');
				break;	
		case 6:  
				$styleUrl = $dom->createElement('styleUrl', 'style_rwylight');
				break;
		case 10:  
				$styleUrl = $dom->createElement('styleUrl', 'style_reil');
				break;
		case 11:  
				$styleUrl = $dom->createElement('styleUrl', 'style_cl');
				break;
		case 12:  
				$styleUrl = $dom->createElement('styleUrl', 'style_gps');
				break;
		}
				
  $placeNode->appendChild($styleUrl);

  // Creates a Point element.
  $pointNode = $dom->createElement('Point');
  $placeNode->appendChild($pointNode);

  // Creates a coordinates element and gives it the value of the lng and lat columns from the results.
  $coorStr = $record_long.','.$record_lat;
  $coorNode = $dom->createElement('coordinates', $coorStr);
  $pointNode->appendChild($coorNode);
}

$kmlOutput = $dom->saveXML();
header('Content-type: application/vnd.google-earth.kml+xml');
echo $kmlOutput;
?>