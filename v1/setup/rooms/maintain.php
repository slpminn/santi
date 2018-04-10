<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php"); //Defines $dbconn as the connection to the database
	// load header file

//try {	
	
	$pageTitle = "User Maintenance"; //Page title to use on the header.php
	
	$params = array(); //Building and array with the values to filter the results from the SQL statement.
	
	$params[':username']  = cleanInput($_POST['username']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	$params[':lastname']  = cleanInput($_POST['lastname']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	$params[':firstname']  = cleanInput($_POST['firstname']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	$params[':middlename']  = cleanInput($_POST['middlename']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	$params[':email']  = cleanInput($_POST['email']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	if (isset($_POST['blocked'])) //If the checkbox is checked on the original form, then the blocked parameter is passed and we assign it to the placeholder in the $params array
		$params[':blocked']  = 1; //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	else
		$params[':blocked'] = 0;
		
	$params[':tries']  = 0; //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	$params[':active']  = cleanInput($_POST['active']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	
	if (cleanInput($_POST['id']) == 0) { //Insert new record to the table
		
		$hashedPassword = password_hash(cleanInput($_POST['password']), PASSWORD_DEFAULT);  //Hashing the password
		
		$params[':password']  = $hashedPassword; //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
		
		$tsql = "INSERT INTO usertbl
           (username
		   ,password
           ,lastname
           ,firstname
           ,middlename
           ,email
           ,blocked
           ,tries
           ,active)
		VALUES
           (:username
		   ,:password
           ,:lastname
           ,:firstname
           ,:middlename
           ,:email
           ,:blocked
           ,:tries
           ,:active)";
		   
	} else { //Update record to the table
		
		$params[':id']  = cleanInput($_POST['id']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	
	
		$tsql = "UPDATE usertbl
		   SET username = :username
			  ,lastname = :lastname
			  ,firstname = :firstname
			  ,middlename = :middlename
			  ,email = :email
			  ,blocked = :blocked
			  ,tries = :tries
			  ,active = :active
		 WHERE id = :id";
 
	}
	
	$exec = $dbconn->prepare($tsql); //Prepare tells php which statement we're going to execute before we execute it to prevent SQL injection attacks.
	
	if ($exec->execute($params)) { //Executing the statement and passing the array with the values for the filters placeholders.
		
		//print("<h2>Select executed successfully</h2>");
		
		header('Location: https://santi/v1/setup/users/main.php');
		
	} else { 
	
		print("<h2>Select not executed successfully</h2>");

		exit();

	}

/*} catch(Exception $e) {
	
	print("<h2>ERR0001 -  Unable to process the request. Contact your administrator.</h2>");

}*/		
?>