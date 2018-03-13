<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php"); //Defines $dbconn as the connection to the database
	// load header file

	$clean_username = cleanInput($_POST['username']);
	$clean_password = cleanInput($_POST['password']);
	
	$tsql = "SELECT  id
				FROM usertbl 
				WHERE username = :username 
				AND password = :password"; //:username and :password are placeholders
	
	$params = array(""); //Created an array and assigned it to a variable to store the values of the placeholders in the select statement
	
	$params[':username'] = $clean_username; //Assigned the element index (:username) to the value of the variable $clean_username
	
	$params[':password'] = $clean_password; //Assigned the element index (:password) to the value of the variable $clean_password
	
	$exec = $dbconn->prepare($tsql); //Prepare tells php which statement we're going to execute before we execute it to prevent sql injection attacks
	
	if ($exec->execute($params)) { //Executing the statement and passing the array with the values for the placeholder
		
		print("<h2>Select executed successfully</h2>");
		
		$row = $exec->fetchAll(PDO::FETCH_ASSOC); //Created a variable and stores the information retrieved by executing the sql statement
		
		$count = count($row); //Created a variable that stores the number of rows retrieved by executing the sql statement
		
		var_dump($row); //"Dumps" the content of the rows to the screen
		
		print ("<br/>");
		
		var_dump($count); //"Dumps" the number of rows to the screen
		
		if ($count == 0) {
			
			header('Location: https://santi/v1/login.php');
			
			exit;
		
		} else {
			
			$_SESSION['username'] = $clean_username;
			
			$_SESSION['userislogged'] = 1; 
			
			header('Location: https://santi/v1/mainmenu.php');
			
			exit;
			
		}
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
  <header>
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
	
	<title>Login</title>
  </header>
	<body>
	
		<div class="container-fluid">
		
			<div class="row">
				
				<div class="col mainContainer">
		
					########## Put Content Here ###########
				
				</div> <!-- End of div mainContainer -->
			
			</div> <!-- End of row -->
		
		</div> <!-- End of container-fluid -->
		
		<!-- Bootstrap Javascript -->
		<script src="/v1/assets/bootstrap/4.0.0/js/bootstrap.min.js"></script>
				
		<!-- <script src="/v1/assets/bootstrap/4.0.0/js/popper.min.js"></script> -->
				
		<!-- Custom Javascript -->
		<script type="text/javascript" src="/v1/assets/js/main.js"></script>
				
	</body>
</html>