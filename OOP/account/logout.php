<?php
require_once "../library/functions.php";
require_once "../database/account.php";
$logout = new account();
$logout->logout();
header("Location: ".SITE_ROOT);
exit();