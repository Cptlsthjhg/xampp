<?php
/*

*	File:			nest_Demo.php
*	By:			TMIT
*	Date:		2010-06-01
*
*	This script demonstrates elegant nested rendering
* 		using SQL rather than a language construct
*		
*
*=========================================================================
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

	{  //   Style declarations
			$trOdd = 'style = "background-color: #BFFFCF;"';
			$trEven = 'style = "background-color: #FCCDFF;"';
			
			$textFont = 'style = " font-family: arial, helvetica, sans-serif; "';
			$textRed = 'style = " font-family: arial, helvetica, sans-serif; color:maroon; "';
			
			$indent50 = 'style = " margin-left: 50; "';
			$indent100 = 'style = " margin-left: 100; "';
			
	//   END: Style declarations	
	}
	
	echo '<h1>All Persons by Company</h1>';
	
	{	//		SQL
	$tPerson_SQLselect = "SELECT  ";
	$tPerson_SQLselect .= "tPerson.ID AS personID, ";	
	$tPerson_SQLselect .= "tPerson.Salutation, ";	
	$tPerson_SQLselect .= "tPerson.FirstName, tPerson.LastName, ";	
	$tPerson_SQLselect .= "tCompany.ID AS companyID, ";		
	$tPerson_SQLselect .= "tCompany.preName, tCompany.Name, tCompany.RegType ";	
	$tPerson_SQLselect .= "FROM tPerson LEFT JOIN tCompany ";
	$tPerson_SQLselect .= "ON tPerson.CompanyID = tCompany.ID ";
	$tPerson_SQLselect .= "ORDER BY tCompany.Name, tCompany.preName, tCompany.ID, ";
	$tPerson_SQLselect .= "tPerson.LastName, tPerson.FirstName ";

	$tPerson_SQLselect_Query = mysqli_query($dbConnected, $tPerson_SQLselect);
	//		END:  SQL 	
	}		
	$currentCompanyID = -1;
	$indx = 0;
	echo '<div '.$textFont.'>';

	while ($row = mysqli_fetch_array($dbConnected, $tPerson_SQLselect_Query, MYSQL_ASSOC)) {
		
			{	//	assign variables to row data 
				$personID = $row['personID'];
				$Salutation = $row['Salutation'];
				$FirstName = $row['FirstName'];
				$LastName = $row['LastName'];
				$Telephone = $row['Telephone'];
				$eMail = $row['eMail'];
		
				$CompanyID = $row['companyID'];
				$CompanypreName = $row['preName'];
				$CompanyName = $row['Name'];
				$CompanyRegType = $row['RegType'];
			 
				$CompanyFullName = trim($CompanypreName." ".$CompanyName." ".$CompanyRegType);
			//	END:  assign variables to row data 
			}
			
			{	//		Company header 
				if (empty($CompanyID)) {
					$CompanyID = 0;
					$CompanyFullName = "UN-Allocated";
				}	

			   if ($CompanyID <> $currentCompanyID) {
		
				   if ($currentCompanyID <> -1) {
			   	//		Render the table tail 
		 				echo "</table>";	
		 				echo '</div>';
			   	}

			   	//		Render the company header
			   	echo '<h2 '.$indent50.'>'.$CompanyFullName.'</h2>';
			   	
					echo '<div '.$indent100.'>';
			   	echo "<table border='1'>";
					echo "<tr>";
					
						echo "<td>#</td>";
						echo "<td>Salutation</td>";
						echo "<td>FirstName</td>";
						echo "<td>LastName</td>";
						echo "<td>Telephone</td>";
						echo "<td>eMail</td>";
				
					echo "</tr>";  
		
			   	//    	
			   } 
  					$currentCompanyID = $CompanyID;
  			//	END:   Company header 
			}	
				
 			{	//		Create and format a row for each person
			if (($indx 2) == 1) {$rowClass = $trOdd; } else { $rowClass = $trEven; }
			echo '<tr '.$rowClass.'>';
 			
			
				echo "<td>".$personID."&nbsp;</td>";       //  this is NOT  tPerson.ID
				echo "<td>".$Salutation."&nbsp;</td>";
				echo "<td>".$FirstName."&nbsp;</td>";
				echo "<td>".$LastName."&nbsp;</td>";
				echo "<td>".$Telephone."&nbsp;</td>";
				echo "<td>".$eMail."&nbsp;</td>";
		
			echo "</tr>";
			}	//		END:  Create and format a row for each person
			
			$indx++;
			
	//	   END:  while ($row = mysqli_fetch_array($dbConnected, $tPerson_SQLselect_Query
	}
	
	echo '</div>';

	mysqli_free_result($dbConnected, $tPerson_SQLselect_Query);		
}
//	FUNCTIONS

		function fullCoName($coID, $preName, $coName, $regType)
		{
			if (empty($coID)) {
				$temp = "Un-Allocated";
			} else {
				$temp = trim($preName." ".$coName." ".$regType);
			}
			return $temp;
		}


?>