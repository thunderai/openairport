<?
mysql_connect("localhost", "webuser", "limitaces", false, 128) or die(mysql_error());
mysql_select_db("openairport") or die(mysql_error());
$datafile = 'D:/lights_csv.csv';
//$sql = mysql_query("TRUNCATE TABLE table_name");
$sql = mysql_query("LOAD DATA LOCAL INFILE '$datafile' INTO TABLE tbl_inventory_sub_e FIELDS TERMINATED BY ',' ENCLOSED BY '\"' ESCAPED BY '\\\\' LINES TERMINATED BY '\\r\\n'") or die(mysql_error());
?>
