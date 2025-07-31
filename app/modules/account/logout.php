<?php
// modules/account/logout.php
$auth->logout();

// Force clear cookie headers before redirect
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
header("Location: /");
exit;