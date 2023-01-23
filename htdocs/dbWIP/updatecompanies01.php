<?php
/*

*	File:		updatecompanies01.php
*	By:		Ethan Thompson
*	Date:		1/17/2023

=====================================
*/

$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "alphacrm";

$dbConnected = mysqli_connect($hostname, $username, $password);

$dbSelected = mysqli_select_db($dbConnected,$databaseName);

$dbSuccess = true;
if($dbConnected){}
	
	else {
		echo "MYSQL connection FAILED <br/><br/>";
		$dbSuccess = false;	
	}
	
	if($dbSuccess){
	
		// SQL to change country value from UK to United Kingdom 
		$company_SQLupdate = "UPDATE tCompany SET ";
		
		$company_SQLupdate .= "COUNTRY = 'United Kingdom' ";
		
		$company_SQLupdate .= "WHERE COUNTRY = 'UK' "; 
		
		if (mysqli_query($dbConnected,$company_SQLupdate))  {	
			echo "UPDATE tCompany.COUNTRY - SUCCESSFUL.<br /><br />";
		} else {
			echo "UPDATE tCompany.COUNTRY - FAILED.<br /><br />";
		}
		

	}
?>