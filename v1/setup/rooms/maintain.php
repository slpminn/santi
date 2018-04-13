<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php"); //Defines $dbconn as the connection to the database
	// load header file

//try {	
	
	$pageTitle = "Room Maintenance"; //Page title to use on the header.php
	
	$params = array(); //Building and array with the values to filter the results from the SQL statement.
	
	$params[':roomdescription']  = cleanInput($_POST['roomdescription']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	$params[':roomfloorid']  = cleanInput($_POST['roomfloorid']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	
	if (isset($_POST['roomactive'])) //If the checkbox is checked on the original form, then the blocked parameter is passed and we assign it to the placeholder in the $params array
		$params[':roomactive']  = 1; //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	else
		$params[':roomactive'] = 0;
	
	if (cleanInput($_POST['id']) == 0) { //Insert new record to the table
		
		$tsql = "INSERT INTO roomstbl
           (roomdescription
		   ,roomfloorid
           ,roomactive)
		VALUES
           (:roomdescription
		   ,:roomfloorid
           ,:roomactive)";
		   
	} else { //Update record to the table
		
		$params[':id']  = cleanInput($_POST['id']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	
	
		$tsql = "UPDATE roomstbl
		   SET roomdescription = :roomdescription
			  ,roomfloorid = :roomfloorid
			  ,roomactive = :roomactive
		 WHERE roomid = :id";
 
	}
	
	$exec = $dbconn->prepare($tsql); //Prepare tells php which statement we're going to execute before we execute it to prevent SQL injection attacks.
	
	if ($exec->execute($params)) { //Executing the statement and passing the array with the values for the filters placeholders.
		
		//print("<h2>Select executed successfully</h2>");
		
		header('Location: https://santi/v1/setup/rooms/main.php');
		
	} else { 
	
		print("<h2>Select not executed successfully</h2>");

		exit();

	}

/*} catch(Exception $e) {
	
	print("<h2>ERR0001 -  Unable to process the request. Contact your administrator.</h2>");

}*/		
?>