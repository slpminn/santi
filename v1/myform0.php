<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php");
	// load header file

	$tsql = "SELECT id,exampleInputEmail1 FROM tMyFirstTable ORDER BY exampleInputEmail1";
	$params = array("");
	$exec = $dbconn->prepare($tsql);
	if ($exec->execute($params)) {
		print("<h2>Select executed successfully</h2>");
		$rows = $exec->fetchAll(PDO::FETCH_ASSOC);
		var_dump($rows);
		$count = count($rows);
		print("<h4>The number of rows returned is ".$count."</h4>"); 
	} else { 
		print("<h2>Select not executed successfully</h2>");
		exit();
	}
	
try {
	
} catch(Exception $e) {
	$dbconn->rollback();					//Rollback.	Undoes the changes to the Database.
	print("<h2>".$e->getMessage()."</h2>");
	print("<h2>ERR0001 -  Unable to process the request. Contact your administrator.</h2>");
}		
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="/v1/assets/jquery/jquery-3.2.1.slim.min.js"></script>
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/v1/assets/bootstrap/4.0.0/css/bootstrap.min.css" >
	
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="/v1/assets/css/main.css">
	
	
    
	<title>Form 0</title>
  </head>
  <body>
    
	<div class="container-fluid">
	
	<div class="row">
	
		<div class="col mainContainer" />
		
			<h1>Form 0</h1>

			
		

			<form action="/v1/processinfo/myForm.php" method="POST" id="processForm" name="processForm" onsubmit="checkFields(event);"> 

				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
				   <select class="form-control" name="exampleInputId" id="exampleInputId" onChange="editInformation();">
					  <option value="" selected>Select an Email</option>
					   <?php 
					   
						foreach($rows as $row) {
							echo "<option value=\"".$row["id"]."\">".$row["exampleInputEmail1"]."</option>";
						}
					  ?>
					</select>
				</div>
		
  
  
 
			</form>
	
		</div>
		
		

		
	</div>
	
	</div>	
	
   
    <!-- Bootstrap Javascript -->
    <script src="/v1/assets/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	
	<!-- <script src="/v1/assets/bootstrap/4.0.0/js/popper.min.js"></script> -->
	
	<!-- Custom Javascript -->
	<script type="text/javascript" src="/v1/assets/js/main.js"></script>
	
	
  </body>
</html>