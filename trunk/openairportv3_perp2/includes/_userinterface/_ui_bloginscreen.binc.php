		<form action="index_newlogin.php" method="post" name="edittable" id="edittable" />
			<input type="hidden" name="formsubmited" value="1">
		<div name="canister" class="login_div" />
			</div>
		<div name="canister" class="login_div2" />
			</div>			
			<table border="0" cellpadding="0" cellspacing="0" class="login_table_position_center" />
				<tr>
					<td rowspan="2" align="center" valign="middle" />
						<img src="stylesheets/_cssimages/login_logo.png" height="50" /> 
						</td>
					<td colspan="2" align="left" valign="bottom">
						<span class="logoblackL" />O</span>
						<span class="logoblackS" />PEN</span>
						<span class="logowhiteL" />A</span>
						<span class="logowhiteS" />IRPORT</span>
						</td>
						</tr>
					<td align="left" valign="top" />
						<span class="logosubtitle" />The OpenSource Records Management System for Airports</span>
						</td>
					</tr>
				<tr>
					<td colspan="3" class="login_table_content" />
						<table width="100%" height="100%" />
							<tr>
								<td align="center" valign="middle" />
									<br>
									<img src="stylesheets/_cssimages/airportlogo_small.png" height="150" /> 
									<br>
									</td>
								<td>
									<table width="100%" height="100%" />
										<tr>
											<td colspan="3" class="login_airportname" />
												<?php echo $nameofairport;?>:Login
												</td>
											</tr>
										<tr>
											<td colspan="3" class="login_fieldname_error" />
												<?php
												if($errorfound == 1) {
														// echo "There was an error with the information provided by the user <br>";
														// echo "Notify User of the error <br>";
														echo $message;
													}
												?>
												</td>
											</tr>											
										<tr>
											<td class="login_fieldname" align="right" valign="middle" />
												Username : 
												</td>
											<td colspan="2" />
												<input type="text" size="20" name="username" id="username" class="form-login" maxlength="15" /> *
												</td>
											</tr>
										<tr>
											<td class="login_fieldname" align="right" valign="middle" />
												Password : 
												</td>
											<td colspan="2" />
												<input type="password" size="20" name="password" id="password" class="form-login" maxlength="15"/> *
												</td>
											</tr>
										<tr>
											<td>
												&nbsp;
												</td>
											<td class="login_directions" align="left" valign="middle" />
												<a href="mailto:erick.dahl@gmail.com" /><span class="login_link" />Forgot Login</span></a>
												</td>
											<td class="login_directions" align="right" valign="middle" />
												<input type="submit" value="Login" />
												</td>
											</tr>											
										</table>
									</td>
								</tr>
							<tr>
								<td colspan="2" class="login_directions" align="center" valign="middle" />
									Please provide your username and password to gain access to the OpenAirport system.
									</td>
								</tr>
							</table>
						</td>
					</tr>
				<tr>
					<td colspan="3" class="login_legal" align="center" valign="top" />
						Powered By <a href="http://www.openairport.org" target="_newwindow" /><span class="login_link" />OpenAirport.org</span></a>. Copyrite &#169; 2000 - <?php echo date('Y');?> <a href="mailto:erick.dahl@gmail.com" /><span class="login_link" />Erick Alan Dahl</span></a>. 
						</td>
					</tr>
				</table>
			</div>
			</form>