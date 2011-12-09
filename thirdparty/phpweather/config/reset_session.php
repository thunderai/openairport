<?php
/* This script destroys a session. We start by initializing the
 * session, then we unset any vaiables associated with it, and then
 * destroy it. After that is done, we redirect to the index.php in the
 * current directory. */
session_start();
session_unset();
session_destroy();
header('Location: http://' . $HTTP_SERVER_VARS['HTTP_HOST'] .
       dirname($HTTP_SERVER_VARS['PHP_SELF']) . '/index.php');
exit();
?>