<?php
require_once "../config/config.php";
require_once "../library/functions.php";
require_once "../database/account.php";
logout();
header("Location: ".SITE_ROOT);
exit();