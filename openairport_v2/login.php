<?php 
include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/access_user_class.php"); 

$my_access = new Access_user;
$my_access->login_reader();
// $my_access->language = "de"; // use this selector to get messages in other languages
if (isset($_GET['activate']) && isset($_GET['ident'])) { // this two variables are required for activating/updating the account/password
	//$my_access->auto_activation = false; // use this (true/false) to stop the automatic activation
	$my_access->activate_account($_GET['activate'], $_GET['ident']); // the activation method 
}
if (isset($_GET['validate']) && isset($_GET['id'])) { // this two variables are required for activating/updating the new e-mail address
	$my_access->validate_email($_GET['validate'], $_GET['id']); // the validation method 
}
if (isset($_POST['Submit'])) {
	$my_access->save_login = (isset($_POST['remember'])) ? $_POST['remember'] : "no"; // use a cookie to remember the login
	$my_access->count_visit = true; // if this is true then the last visitdate is saved in the database
	$my_access->login_user($_POST['login'], $_POST['password']); // call the login method
} 
$error = $my_access->the_msg; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Login page example</title>
<style type="text/css">
<!--
label {
	display: block;
	float: left;
	width: 120px;
}
-->
</style>
</head>

<body>
<h2>Login:</h2>
<p>Please enter your login and password.</p>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <label for="login">Login:</label>
  <input type="text" name="login" size="20" value="<?php echo (isset($_POST['login'])) ? $_POST['login'] : $my_access->user; ?>"><br>
  <label for="password">Password:</label>
  <input type="password" name="password" size="8" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] : $my_access->user_pw; ?>"><br>
  <label for="remember">Remember login?</label>
  <input type="checkbox" name="remember" value="yes"<?php echo ($my_access->is_cookie == true) ? " checked" : ""; ?>>
  <br>
  <input type="submit" name="Submit" value="Login">
</form>
<p><b><?php echo (isset($error)) ? $error : "&nbsp;"; ?></b></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<!-- Notice! you have to change this links here, if the files are not in the same folder -->
<p>Not registered yet? <a href="./register.php">Click here.</a></p>
<p><a href="./forgot_password.php">Forgot your password?</a></p>
<p><a href="login_local.php">Login with messages according user's language settings </a><br>(only for users with a profile)</p>
</body>
</html>
