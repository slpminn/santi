<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\pdo_db.php"); //Defines $dbconn as the connection to the database
	// load header file

	$clean_username = cleanInput($_POST['username']);
	$clean_password = cleanInput($_POST['password']);
	
	$tsql = "SELECT  id, password, tries
				FROM usertbl 
				WHERE username = :username
				AND active = :active
				AND blocked = :blocked"; //By adding active and blocked to the WHERE class, we are making sure the user is active and unblocked in order to log in
				
	
	$params = array(); //Created an array and assigned it to a variable to store the values of the placeholders in the select statement
	
	$params[':username'] = $clean_username; //Assigned the element index (:username) to the value of the variable $clean_username
	
	$params[':active'] = 1; //Assigned the element index (:active) to the value of 1. 1 = active, 0 = inactive
	
	$params[':blocked'] = 0; //Assigned the element index (:blocked) to the value of 0. 1 = blocked, 0 = unblocked
	
	$exec = $dbconn->prepare($tsql); //Prepare tells php which statement we're going to execute before we execute it to prevent sql injection attacks
	
	if ($exec->execute($params)) { //Executing the statement and passing the array with the values for the placeholder
		
		print("<h2>Select executed successfully</h2>");
		
		$row = $exec->fetchAll(PDO::FETCH_ASSOC); //Created a variable and stores the information retrieved by executing the sql statement
		
		$count = count($row); //Created a variable that stores the number of rows retrieved by executing the sql statement
		
		//var_dump($row); //"Dumps" the content of the rows to the screen
		
		//print ("<br/>");
		
		//var_dump($count); //"Dumps" the number of rows to the screen
		
		if ($count == 0) { //If the user is not found...
			
			header('Location: https://santi/v1/login.php');
			
			exit;
		
		} else if(password_verify($clean_password,$row[0]["password"])) { //"password_verify" hashes the password and compares it to the hashed password in the database
			
			$_SESSION['username'] = $clean_username;

			$_SESSION['userid'] = $row[0]["id"];
			
			$_SESSION['userislogged'] = 1; 
			
			header('Location: https://santi/v1/mainmenu.php');
			
			exit;
			
		} else { //If the password is incorrect...

			checkIfUserNeedsBlocked($clean_username,$row[0]["tries"],$dbconn);
			
			header('Location: https://santi/v1/login.php');
			
			exit;
			
		}
	}
	
	function checkIfUserNeedsBlocked($username,$tries,$dbconn){
		
		$tries++;  //Incrementing the unsuccessful tries by 1
		
		if ($tries < 5){  //Execute if unsuccessful tries is less than 5
		
			$tsql = "UPDATE usertbl SET tries = tries + 1
					WHERE username = :username";
			
			$params = array(); //Created an array and assigned it to a variable to store the values of the placeholders in the select statement
		
			$params[':username'] = $username; //Assigned the element index (:username) to the value of the variable $clean_username
			
			$exec = $dbconn->prepare($tsql); //Prepare tells php which statement we're going to execute before we execute it to prevent sql injection attacks
		
			if ($exec->execute($params)) print("<h2>Select executed successfully</h2>");
		
			else print("<h2>Select executed unsuccessfully</h2>");
	
		} else {  //Execute if 5 unsuccessful tries 
			
			$tsql = "UPDATE usertbl SET blocked = 1, tries = tries + 1
					WHERE username = :username";
			
			$params = array(); //Created an array and assigned it to a variable to store the values of the placeholders in the select statement
		
			$params[':username'] = $username; //Assigned the element index (:username) to the value of the variable $clean_username
			
			$exec = $dbconn->prepare($tsql); //Prepare tells php which statement we're going to execute before we execute it to prevent sql injection attacks
		
			if ($exec->execute($params)) print("<h2>Select executed successfully</h2>");
		
			else print("<h2>Select executed unsuccessfully</h2>");
			
		}
	
	}

try {
	
} catch(Exception $e) {
	$dbconn->rollback();					//Rollback.	Undoes the changes to the Database.
	print("<h2>".$e->getMessage()."</h2>");
	print("<h2>ERR0001 -  Unable to process the request. Contact your administrator.</h2>");
}		
?>
