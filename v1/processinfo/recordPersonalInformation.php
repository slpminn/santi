<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php");
	// load header file

	
try {
	
	$dbconn->beginTransaction();					//Define a Database Transaction to be able to rollback changes if there is a error.

	// Initialize variables to hold the parameters passed.
	
	$exampleMyOptions2 = false;							//It has to be initialize because it is a check box.
	
	// Set variables width the parameters passed.
	
	// htmlspecialchars --> This function removes html especial character (

	$exampleInputEmail1 = htmlspecialchars($_POST["exampleInputEmail1"]);
	
	print "exampleInputEmail1: ".$exampleInputEmail1."<br />";
	
	$exampleInputName = htmlspecialchars($_POST["exampleInputName"]);
	
	print "exampleInputName: ".$exampleInputName."<br />";

	$exampleInputPassword1 = htmlspecialchars($_POST["exampleInputPassword1"]);
	
	echo "exampleInputPassword1: ".$exampleInputPassword1."<br />";
	
	$exampleInputNumberComputers = htmlspecialchars($_POST["exampleInputNumberComputers"]);
	
	print "exampleInputNumberComputers: ".$exampleInputNumberComputers."<br />";
	
	$exampleOperatingSystem = htmlspecialchars($_POST["exampleOperatingSystem"]);
	
	print "exampleOperatingSystem: ".$exampleOperatingSystem."<br />";
	
	$exampleTextarea = htmlspecialchars($_POST["exampleTextarea"]);	
	
	print "exampleTextarea: ".$exampleTextarea."<br />";
	
	$exampleOptionsRadios = htmlspecialchars($_POST["exampleOptionsRadios"]);
	
	print "exampleOptionsRadios: ".$exampleOptionsRadios."<br />";
	
	$exampleMyOptions1 = htmlspecialchars($_POST["exampleMyOptions1"]);
	
	print "exampleMyOptions1: ".$exampleMyOptions1."<br />";
	
	if (isset($_POST["exampleMyOptions2"])) {  
	
		$exampleMyOptions2 = htmlspecialchars($_POST["exampleMyOptions2"]);
		
		print "exampleMyOptions2: ".$exampleMyOptions2."<br />";	
	
	}
	
	// var_dump($_POST);
	
	$tsql = "select exampleInputEmail1 from tMyFirstTable where exampleInputEmail1 = :exampleInputEmail1";	//Define and set a variable with the SQL Statement to execute.
	
	// Define and set an array with the values to substitute on the placeholers. Ex: (set the value of :exampleInputEmail1 to $exampleInputEmail1).
	$params = array("");									// Defines and clear the content of the array.
	$params[':exampleInputEmail1'] = $exampleInputEmail1;	// Set the value of the associative array, which means that has a key and a value.
		
	$exec = $dbconn->prepare($tsql);			//Set the Database Connection ($dbconn) with the SQl to execute ($tsql).
	$exec->execute($params);					//Execute the SQL Statement set on the Database Connection.  Also, passes the values of the placeholders($params)
	$rows = $exec->fetchAll(PDO::FETCH_ASSOC);	//Define and set an array ($rows) with the records returned from the executed SQL Statement.
	$count = count($rows);						//Define and set a variable ($count) with the number of rows returned.			
	
	if ($count > 0) {							//If $count is greater than 0, then records found.
		print("<h2>Select executed successfully</h2>");
		$count = count($exec);
	} 
	
	if ($count== 1 && $exampleMyOptions2){	//If the count eq 1 and the check box $exampleMyOption2 is checked, which means delete, then Delete.
		
		$tsql = "delete from tMyFirstTable where exampleInputEmail1 = :exampleInputEmail1";
		$params = array("");
		$params[':exampleInputEmail1'] = $exampleInputEmail1;
		
		$exec = $dbconn->prepare($tsql);
		if ($exec->execute($params)) {					// By wrapping with an if the execute statement, we can check if the SQL Statement executed successfully or not. 
			print("<h2>Delete executed successfully</h2>");
		} else {
			print("<h2>Delete failed.</h2>");
		}
		
	} else if ($count == 1 && $exampleMyOptions2){  //if count eq 1 and the check box $exampleMyOption2 is checked, which means delete, then Delete.
			
		print("<h2>Unable to delete, record does not exist(".$exampleInputEmail1.")</h2>");
		exit();
	
	} else if ($count == 0){								//If count eq 0, which means no record found, then Insert.
		
		$tsql = "INSERT INTO tMyFirstTable (exampleInputEmail1,exampleInputName,exampleInputPassword1,exampleInputNumberComputers,exampleOperatingSystem,exampleTextarea,exampleOptionsRadios,exampleMyOptions2)
		VALUES (:exampleInputEmail1,:exampleInputName,:exampleInputPassword1,:exampleInputNumberComputers,:exampleOperatingSystem,:exampleTextarea,:exampleOptionsRadios,:exampleMyOptions2);";			

		$params = array("");
		$params[':exampleInputEmail1'] = $exampleInputEmail1;
		$params[':exampleInputName'] = $exampleInputName;
		$params[':exampleInputPassword1'] = $exampleInputPassword1;
		$params[':exampleInputNumberComputers'] = $exampleInputNumberComputers;
		$params[':exampleOperatingSystem'] = $exampleOperatingSystem;
		$params[':exampleTextarea'] = $exampleTextarea;
		$params[':exampleOptionsRadios'] = $exampleOptionsRadios;
		$params[':exampleMyOptions2'] = $exampleMyOptions2;
	
		$exec = $dbconn->prepare($tsql);
		if ($exec->execute($params)) print("<h2>Insert executed successfully</h2>");

	} else {											//Otherwise, record found, then Update.
		
		$tsql = "UPDATE tMyFirstTable
					SET exampleInputName = :exampleInputName
					  ,exampleInputPassword1 = :exampleInputPassword1
					  ,exampleInputNumberComputers = :exampleInputNumberComputers
					  ,exampleOperatingSystem = :exampleOperatingSystem
					  ,exampleTextarea = :exampleTextarea
					  ,exampleOptionsRadios = :exampleOptionsRadios
					  ,exampleMyOptions2 = :exampleMyOptions2
				WHERE exampleInputEmail1 = :exampleInputEmail1";

		$params = array("");
		$params[':exampleInputEmail1'] = $exampleInputEmail1;
		$params[':exampleInputName'] = $exampleInputName;
		$params[':exampleInputPassword1'] = $exampleInputPassword1;
		$params[':exampleInputNumberComputers'] = $exampleInputNumberComputers;
		$params[':exampleOperatingSystem'] = $exampleOperatingSystem;
		$params[':exampleTextarea'] = $exampleTextarea;
		$params[':exampleOptionsRadios'] = $exampleOptionsRadios;
		$params[':exampleMyOptions2'] = $exampleMyOptions2;
	
		$exec = $dbconn->prepare($tsql);
		if ($exec->execute($params)) print("<h2>Update executed successfully</h2>");

	}
	
	$dbconn->commit();						//Commit. Writes the changes to the Database.
	
} catch(Exception $e) {
	$dbconn->rollback();					//Rollback.	Undoes the changes to the Database.
	print("<h2>".$e->getMessage()."</h2>");
	print("<h2>ERR0001 -  Unable to process the request. Contact your administrator.</h2>");
}		
?>