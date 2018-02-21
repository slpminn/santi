<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php");
	// load header file

	
try {
	
	$dbconn->beginTransaction();

	// htmlspecialchars --> This function removes html especial character (

	$exampleInputEmail1 = htmlspecialchars($_POST["exampleInputEmail1"]);
	
	print "exampleInputEmail1: ".$exampleInputEmail1."<br />";

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
	
	$exampleMyOptions2 = htmlspecialchars($_POST["exampleMyOptions2"]);
	
	print "exampleMyOptions2: ".$exampleMyOptions2."<br />";	
	
	// var_dump($_POST);
	
	$tsql = " INSERT INTO tMyFirstTable (exampleInputEmail1,exampleInputPassword1,exampleInputNumberComputers,exampleOperatingSystem,exampleTextarea,exampleOptionsRadios,exampleMyOptions2)
		VALUES (:exampleInputEmail1,:exampleInputPassword1,:exampleInputNumberComputers,:exampleOperatingSystem,:exampleTextarea,:exampleOptionsRadios,:exampleMyOptions2);
	";			

	$params = array("");
	$params[':exampleInputEmail1'] = $exampleInputEmail1;
	$params[':exampleInputPassword1'] = $exampleInputPassword1;
	$params[':exampleInputNumberComputers'] = $exampleInputNumberComputers;
	$params[':exampleOperatingSystem'] = $exampleOperatingSystem;
	$params[':exampleTextarea'] = $exampleTextarea;
	$params[':exampleOptionsRadios'] = $exampleOptionsRadios;
	$params[':exampleMyOptions2'] = $exampleMyOptions2;
	
	$exec = $dbconn->prepare($tsql);
	if ($exec->execute($params)) print("<h2>Insert executed successfully</h2>");
	
	$dbconn->commit();	
	
} catch(Exception $e) {
	$dbconn->rollback();
	print("h2".$e->getMessage()."</h2>");
}		
?>