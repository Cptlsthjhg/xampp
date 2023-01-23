<?php
/*

*	File:			selectTable_Demo.php
*	By:			TMIT
*	Date:		2010-06-01
*
*	This script demonstrates SQL SELECT rendered in an  HTML Table 
*
*======================================================================
*/

{ 		//	Secure Connection Script
		include('../../htconfig/dbConfig.php'); 
		$dbSuccess = false;
		$dbConnected = mysqli_connect($db['hostname'],$db['username'],$db['password']);
		
		if ($dbConnected) {		
			$dbSelected = mysqli_select_db($dbConnected, $db['database']);
			if ($dbSelected) {
				$dbSuccess = true;
			} else {
				echo "DB Selection FAILed";
			}
		} else {
				echo "MySQL Connection FAILed";
		}
		//	END	Secure Connection Script
}

if ($dbSuccess) {
	
	$tPerson_SQLselect = "SELECT  ";
	$tPerson_SQLselect .= "ID, Salutation, FirstName, LastName, CompanyID ";	
	$tPerson_SQLselect .= "FROM ";
	$tPerson_SQLselect .= "tPerson ";			//	<< table name
	
	$tPerson_SQLselect_Query = mysqli_query($dbConnected,$tPerson_SQLselect); 	

	/*
	*			We Need a TABLE header here
	*
	*/

	$indx = 1;	
	while ($row = mysqli_fetch_array($dbConnected,$tPerson_SQLselect_Query, MYSQL_ASSOC)) {
	    $Salutation = $row['Salutation'];
	    $FirstName = $row['FirstName'];
	    $LastName = $row['LastName'];
	    $CompanyID = $row['CompanyID'];
	    
		//   We need to replace ...	
	    echo $indx." - ".$Salutation." ".$FirstName." ".$LastName." [Company ".$CompanyID."]<br />";
		/*		with
		*
		*		a REPEATED HTML TABLE ROW construct here
		*
		*/
	
	    $indx++;
	    
	}
	/*
	*			We Need a TABLE end tag here after 'while' has rendered all the rows 
	*
	*/	
	
	
	mysqli_free_result($dbConnected, $tPerson_SQLselect_Query);		
}

?>