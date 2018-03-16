<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\pdo_db.php"); //Defines $dbconn as the connection to the database
	// load header file

	$clean_username = cleanInput($_POST['username']);
	$clean_password = cleanInput($_POST['password']);
	
	$tsql = "SELECT  id, password
				FROM usertbl 
				WHERE username = :username"; //:username and :password are placeholders
	
	$params = array(""); //Created an array and assigned it to a variable to store the values of the placeholders in the select statement
	
	$params[':username'] = $clean_username; //Assigned the element index (:username) to the value of the variable $clean_username
	
	$exec = $dbconn->prepare($tsql); //Prepare tells php which statement we're going to execute before we execute it to prevent sql injection attacks
	
	if ($exec->execute($params)) { //Executing the statement and passing the array with the values for the placeholder
		
		print("<h2>Select executed successfully</h2>");
		
		$row = $exec->fetchAll(PDO::FETCH_ASSOC); //Created a variable and stores the information retrieved by executing the sql statement
		
		$count = count($row); //Created a variable that stores the number of rows retrieved by executing the sql statement
		
		//var_dump($row); //"Dumps" the content of the rows to the screen
		
		//print ("<br/>");
		
		//var_dump($count); //"Dumps" the number of rows to the screen
		
		if ($count == 0) {
			
			header('Location: https://santi/v1/login.php');
			
			exit;
		
		} else if(password_verify($clean_password,$row[0]["password"])) {
			
			$_SESSION['username'] = $clean_username;

			$_SESSION['userid'] = $row[0]["id"];
			
			$_SESSION['userislogged'] = 1; 
			
			header('Location: https://santi/v1/mainmenu.php');
			
			exit;
			
		} else {

			header('Location: https://santi/v1/login.php');
			
			exit;
			
		}
	}
	

try {
	
} catch(Exception $e) {
	$dbconn->rollback();					//Rollback.	Undoes the changes to the Database.
	print("<h2>".$e->getMessage()."</h2>");
	print("<h2>ERR0001 -  Unable to process the request. Contact your administrator.</h2>");
}		
?>
