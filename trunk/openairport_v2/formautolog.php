<FORM ACTION="https://webboards.tsa.dhs.gov/WB/default.asp?loginform=yes" METHOD="POST" onsubmit="return checkform(this)" name="redirect">
	<INPUT TYPE="HIDDEN" NAME="action" VALUE="23">
	<INPUT TYPE="HIDDEN" NAME="biscuit" VALUE="">
	<INPUT TYPE="HIDDEN" NAME="boardid" VALUE="13">
	<input class="combobox" type="hidden" size="1" name="redirect2">
		<tr>
			<td width="16%" valign="top" class="newTopicNames">Username</td>
			<td width="84%" class="newTopicBoxes"><INPUT TYPE="TEXT" NAME="name" SIZE=20 class="newTopicInput" value="atyda"</td>
		</tr>
		<tr>
			<td width="16%" valign="top" class="newTopicNames">Password</td>
			<td width="84%" class="newTopicBoxes"><INPUT TYPE="PASSWORD" NAME="pass" SIZE=20 class="newTopicInput" value="1@supertomcat"></td>
		</tr>
	<tr>
			<td width="16%" valign="top" class="newTopicNames"></td>
			<td width="84%" class="newTopicBoxes"><INPUT TYPE="SUBMIT" NAME="DoLogin" VALUE="Log In" class="button">&nbsp;<a href="javascript:emailPassword()">Forgot Password?</td>
		</tr>
	</FORM>

<script>
	<!--
		var targetURL="https://webboards.tsa.dhs.gov/WB/default.asp?loginform=yes"
		var countdownfrom=1
		var currentsecond=document.redirect.redirect2.value=countdownfrom+1
		function countredirect(){
			if (currentsecond!=1){
				currentsecond-=1
				document.redirect.redirect2.value=currentsecond
				}
				else{
				window.location=targetURL
			return
			}
			setTimeout("countredirect()",1000)
			}
			countredirect()
	//-->
	</script>