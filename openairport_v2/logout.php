<?
include("includes/header.php");		// include file that handles user login and menu formations	

$tmpsqldate			= AmerDate2SqlDateTime(date('m/d/Y'));
$tmpsqltime			= date("H:i:s");
$tmpsqlauthor		= $_SESSION['user_id'];
$tmpvalue			= systemusercombobox($tmpsqlauthor, "all", "NA", "hide", "no");
$dutylogevent		= $tmpvalue." logged OUT of the Openairport system";

autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);

Session_destroy();
?>
 <script language="javascript" type="text/javascript">
     <!--
     window.setTimeout('window.location="newlogin.php"; ',1000);
     // -->
 </script>

				