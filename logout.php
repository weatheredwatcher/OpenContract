<?php
include("includes/globalinc.php");
session_start();
$_SESSION['ses_end'] = date('Y-m-d-h-i-s');
log_activity('logout');
session_destroy();
header("Location: index.php");
?>