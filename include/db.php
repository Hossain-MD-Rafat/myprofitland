<?php
	$db=new mysqli("localhost","root","","myProfitLand");
    // Connect with the database 
	//$db = new mysqli("localhost", "root", "", "rafathas_project"); 
	// Display error if failed to connect 
	if ($db->connect_errno) { 
	printf("Connect failed: %s\n", $db->connect_error); 
	exit(); 
}
?>
