<?php
/* FUNCTION flogheader()	====================================================================

	Purpose	:	Checks to see if there is a value in the session variable ["user_id"], and 
				depending on if there is or not displayes different header buttons associated
				for that user.
*/
function flogheader($user) {

	if ($user == "") {
			// There is no value in the session variable
			?>
			<?
			}
		else {
			?>
<table border="0" id="table3" cellspacing="2" cellpadding="0" width="100%">
	<tr>
		<td id="login" 			onclick="window.location='index_newlogin.php'" 								style="cursor:hand;"><img src="stylesheets/_cssimages/icon_logout.gif" 		height="25" alt="Logout!"></td>
		<td id="lregister" 		onclick="loadintoIframe('layouttableiframecontent', 'part139303_a_report_user_edit.php')" style="cursor:hand;"><img src="stylesheets/_cssimages/icon_settings.gif" 	height="25" alt="Settings!"></td>
		<td id="help" 			onclick="loadintoIframe('layouttableiframecontent', '_suc_help.php')"			style="cursor:hand;"><img src="stylesheets/_cssimages/icon_help.gif" 		height="25" alt="Help!"></td>
		</tr>
	</table>
			<?
		}
	}
	?>