<?php
	$db=mysqli_connect("localhost","root","","myProfitLand");
    //$db = new mysqli("localhost", "root", "", "rafathas_project");
	if($db){
		//echo "database connected successfully";
	}
	else{
		die("database connection not established");
	}
?>