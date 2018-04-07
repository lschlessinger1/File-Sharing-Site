<?php
// Tip: To log out a user, you can call session_destroy() after session_start() on the logout page.
session_start();
session_destroy();
header("Location: login.php");
exit;
?>
