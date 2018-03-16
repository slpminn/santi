<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php"); //Defines $dbconn as the connection to the database
	// load header file

try {	
	
	$pageTitle = "User Maintenance"; //Page title to use on the header.php
	
	$clean_userId = cleanInput($_POST['userId']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	
	$tsql = "SELECT * FROM usertbl WHERE id=:userIdPlaceHolder"; //Building an SQL statement a.k.a query. We are selecting columns from a table and filtering by id.
	
	$params = array(""); //Building and array with the values to filter the results from the SQL statement.
	
	$params[':userIdPlaceHolder'] = $clean_userId; //Assigned the filter with an index of (:userId) to the value of the variable $clean_userId.
	
	$exec = $dbconn->prepare($tsql); //Prepare tells php which statement we're going to execute before we execute it to prevent SQL injection attacks.
	
	if ($exec->execute($params)) { //Executing the statement and passing the array with the values for the filters placeholders.
		
		//print("<h2>Select executed successfully</h2>");
		
		$rows = $exec->fetchAll(PDO::FETCH_ASSOC); //Created an array and stores the information retrieved by executing the SQL statement.
		
		// var_dump($rows); 
		
		$count = count($rows); //Created a variable that stores the number of rows retrieved by executing the SQL statement.
		
		// print("<h4>The number of rows returned is ".$count."</h4>"); 
	
	} else { 
	
		print("<h2>Select not executed successfully</h2>");

		exit();

	}

} catch(Exception $e) {
	
	print("<h2>ERR0001 -  Unable to process the request. Contact your administrator.</h2>");

}		
?>

<!doctype html>
<html lang="en">
  
  <?php require_once(APP_ROOTDIR."\\v1\\config\\header.php"); //Include header?>
  
	<body>
	
		<?php require_once(APP_ROOTDIR."\\v1\\config\\navigation.php"); //Include navigation?>
		
		<div class="container-fluid"> <!-- In this case this gives a border between the edge of the page and the username, password, and button. Defines div as a bootstrap container. -->
		
			<div class="row"> <!-- Defines everything below as being one row -->
				
				<div class="col-5 mainContainer"> <!-- This determines how much of the page we want filled up by the form -->
		
					<form action="/v1/secure/authorize.php" method="POST" id="loginForm" name="loginForm"> <!-- This defines the form, tells where to submit the form -->
						
						<h2>Setup.<?php print $pageTitle; ?></h2> <!-- Applies the class defined in CSS to the h2 -->
						
						<div class = "form-group">
							
							<label for = "username" class="boldText">Username</label>
							
							<input type="text" class="form-control" name="username" id="username" value="<?php echo $rows[0]["username"]; ?>"> <!--Since we are not looping, because we only retrieve one record, 
																																				we need to specify the row to retrieve as 0 because it's the first and only one--> 
						
						</div>
						
						<div class = "form-group">
							
							<label for = "lastname" class="boldText">Last Name</label>
							
							<input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $rows[0]["lastname"]; ?>">
						
						</div>						
						
						</br>
						
						<button type="button" class="btn btn-danger btn-sm" onClick="checkLoginFields(event);">Cancel</button>
						
						<button type="button" class="btn btn-primary btn-sm" onClick="checkLoginFields(event);">Password</button> <!-- When you hit the login button, run the checkLoginFields function -->

					</form>
				
				</div> <!-- End of div mainContainer -->
			
			 </div><!-- End of row -->
		
		</div> <!-- End of container-fluid -->
	
	</body>
	
	<?php require_once(APP_ROOTDIR."\\v1\\config\\footer.php"); //Include footer?>

</html>