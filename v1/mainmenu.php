<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php");
	// load header file

	$pageTitle = "Main Menu"; //Page title to use on the header.php
		
	$tsql = "SELECT  firstname
				FROM usertbl 
				WHERE id = :id"; //:id and :password are placeholders
	
	$params = array(""); //Created an array and assigned it to a variable to store the values of the placeholders in the select statement
	
	$params[':id'] = $_SESSION['userid']; //Assigned the element index (:username) to the value of the variable $clean_username
	
	$exec = $dbconn->prepare($tsql); //Prepare tells php which statement we're going to execute before we execute it to prevent sql injection attacks
	
	if ($exec->execute($params)) { //Executing the statement and passing the array with the values for the placeholder		
	
		$row = $exec->fetchAll(PDO::FETCH_ASSOC); //Created a variable and stores the information retrieved by executing the sql statement	
	
	} else {

		print("<h2>ERROR.0010.Unable to complete request. Please contact your administrator.</h2>");
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
 
 <?php require_once(APP_ROOTDIR."\\v1\\config\\header.php"); //Include header?>

	<body>
		<?php require_once(APP_ROOTDIR."\\v1\\config\\navigation.php"); //Include navigation?>
		
		<div class="container-fluid">
		
			<div class="row">
				
				<div class="col mainContainer">
		
					<h2>Welcome <?php print $row[0]["firstname"]; ?>!</h2>
				
				</div> <!-- End of div mainContainer -->
			
			</div> <!-- End of row -->
		
		</div> <!-- End of container-fluid -->
				
	</body>
	
	<?php require_once(APP_ROOTDIR."\\v1\\config\\footer.php"); //Include footer?>
	
</html>