<?php
/*

*	File:		createDBalphacrm.php
*	By:		Ethan Thompson
*	Date:		1/17/2023

=====================================
*/


$hostname="localhost";
$username="root";
$password="";


$dbConnected=@mysqli_connect($hostname, $username, $password);


$dbSuccess = true;
if($dbConnected){
		echo "MYSQL connection executed SUCCESSFULLY <br/><br/>";
}
	
	else {
		echo "MYSQL connection FAILED <br/><br/>";
		$dbSuccess = false;	
	}


	
	if($dbSuccess){
	
	
	$dbName="alphacrm";
	$create_SQL = "Create DATABASE ".$dbName;
	
	if(mysqli_query($dbConnected,$create_SQL)){
	
	echo "'Create DATABASE ".$dbName."' - Successful.";
	} else {
		echo "'Create DATABASE ".$dbName."' - Failed.";
		}
	
	}
?>