<?php
	
$hostname="localhost";
$username="root";
$password="";

$databaseName="alphacrm";

$dbConnected=@mysqli_connect($hostname, $username, $password);

$dbSelected=@mysqli_select_db($dbConnected, $databaseName);

$dbSuccess = true;
if($dbConnected){

}

else{

	echo "MySQL connection FAILED <br/><br/>";
	$dbSuccess=false;	
	}

if($dbSuccess){
$dbName = "alphacrm"
$create_SQL = "Create DATABASE".$db.name;

if(mysqli_query($create_SQL)){

echo "'Create DATABASE ".$dbName."' - Successful.";

}

else{
	echo "'Create DATABASE ".dbName."'-Failed.";
}


}

?>