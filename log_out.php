<?php
session_start();
session_destroy();
ob_flush();
header("location: index.php");
?>