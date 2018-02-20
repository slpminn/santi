<?php

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
	
	var_dump($_POST);
?>