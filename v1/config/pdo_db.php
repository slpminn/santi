<?php
 
	//phpinfo();	
	define("DB_SERVERNAME", "DAVIDLAPTOP");
	define("DB_NAME", "demo");
	define("DB_TYPE", "MSSERVER");
	
	
	global $dbconn;
	/* Connect Using Windows Authentication.. */
	
	if (DB_TYPE == "MSSERVER") {
		try {
		
			$dbconn = new PDO("sqlsrv:server=".DB_SERVERNAME.";Database=".DB_NAME.";ConnectionPooling=0","","");
			$dbconn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
			
		} catch(Exception $e) {
			die(print_R("<h1>".$e->getMessage()."</h1>"));
		}	
	} 

?>
