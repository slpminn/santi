<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	
	// delete the session of the user
     session_destroy();

	// send to the login screen.
	redirect("/v1/mainmenu.php");

?>