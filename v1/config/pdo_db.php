<?php
 
	//phpinfo();	
	define("DB_SERVERNAME", "DAVIDLAPTOP");
	define("DB_NAME", "santi");
	define("DB_TYPE", "MSSERVER");
	
	
	global $dbconn;
	/* Connect Using Windows Authentication.. */
	
	if (DB_TYPE == "MSSERVER") {
		try {
		
			$dbconn = new PDO("sqlsrv:server=".DB_SERVERNAME.";Database=".DB_NAME,"","");
			$dbconn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
			
		} catch(Exception $e) {
			die(print_R("<h1>".$e->getMessage()."</h1>"));
		}	
	} elseif (DB_TYPE == "MYSQL") {
		try {
			$dbconn = new PDO("mysql:host=".DB_SERVERNAME.";dbname=".DB_NAME, "", "");
			// set the PDO error mode to exception
			$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			die(print_R("<h1>".$e->getMessage()."</h1>"));
		}	
	}
	
	/*
	-- Connect Using Windows Authentication.. 
	try {
	
		$dbconn = new PDO("sqlsrv:server=".DB_SERVERNAME.";Database=".DB_NAME,"","");
		$dbconn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
		
	} catch(Exception $e) {
		die(print_R("<h1>".$e->getMessage()."</h1>"));
	}	
	*/
?>
