<?php
/*

*	File:		dropDBalphacrm.php
*	By:			Ethan Thompson
*	Date:		1/17/2023
*
*	This script *
*
*
*=====================================
*/

$hostname="localhost";
$username="root";
$password="";


$dbConnected=@mysqli_connect($hostname, $username, $password);


$dbSuccess = true;
if($dbConnected){}
	
	else {
		echo "MYSQL connection FAILED <br/><br/>";
		$dbSuccess = false;	
	}
	

if($dbSuccess){

	$dbName = "alphacrm";
	$drop_SQL = "DROP DATABASE ".$dbName;
	
	if(mysqli_query($dbConnected,$drop_SQL)){
	echo $drop_SQL = "'DROP DATABASE ".$dbName."' - Successful.";
	}
	
	else{
	echo "'DROP DATABASE ".dbName."' - Failed.";
	}

}




?>