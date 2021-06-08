<?php
session_start();
ob_start();
session_unset();
session_destroy();
ob_flush(); 
header("location: index.php");
?>