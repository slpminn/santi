<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php"); //Defines $dbconn as the connection to the database
	// load header file

try {	
	
	$pageTitle = "Change Password"; //Page title to use on the header.php
	
	if (isset($_POST['changepassword'])) {
		
		
		
	
	
	$param_id = cleanInput($_POST['id']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	
	$tsql = "SELECT username
      ,password
      ,lastname
      ,firstname
      ,middlename
      ,email
      ,blocked
      ,tries
      ,salt
      ,active
      ,id FROM usertbl WITH(NOLOCK) WHERE id=:userIdPlaceHolder"; /*Building an SQL statement a.k.a query. We are selecting columns from a table and filtering by id.
																	We do not need an ORDER BY because we are only retrieving one record		*/
														
	$params = array(""); //Building and array with the values to filter the results from the SQL statement.
	
	$params[':userIdPlaceHolder'] = $param_id; //Assigned the filter with an index of (:userId) to the value of the variable $param_id.
	
	$exec = $dbconn->prepare($tsql); //Prepare tells php which statement we're going to execute before we execute it to prevent SQL injection attacks.
	
	if ($exec->execute($params)) { //Executing the statement and passing the array with the values for the filters placeholders.
		
		//print("<h2>Select executed successfully</h2>");
		
		$rows = $exec->fetchAll(PDO::FETCH_ASSOC); //Created an array and stores the information retrieved by executing the SQL statement.
		
		// var_dump($rows); 
		
		$count = count($rows); //Created a variable that stores the number of rows retrieved by executing the SQL statement.
		
		// print("<h4>The number of rows returned is ".$count."</h4>"); 
	
		if ($param_id == 0) {  //Adding a new record
			
			 $username = "";
			 $lastname = "";
			 $firstname = "";
			 $middlename = "";
			 $email = "";
			 $blocked = 0;
			 $tries = 0;
			 $active = 1;
	  
		} else { //Editing a user
			
			 $username = $rows[0]["username"];
			 $lastname = $rows[0]["lastname"];
			 $firstname = $rows[0]["firstname"];
			 $middlename = $rows[0]["middlename"];
			 $email = $rows[0]["email"];
			 $blocked = $rows[0]["blocked"];
			 $tries = $rows[0]["tries"];
			 $active = $rows[0]["active"];
			 $passwordClass = "hideField"; //Hiding the password when we edit a user
			 
		}
		
	} else { 
	
		print("<h2>Select not executed successfully</h2>");

		exit();

	}

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
				
				<div class="col-12 col-sm-8 mainContainer"> <!-- This determines how much of the page we want filled up by the form -->
		
					<form action="changepassword.php" method="POST" id="actionForm" name="actionForm"> <!-- This defines the form, tells where to submit the form -->
						
						<h2><?php print $pageTitle; ?></h2> <!-- Applies the class defined in CSS to the h2 -->
						
						<div class="row form-group">
							
							<label for="oldPassword" class="col-12 col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">Old Password *</label>
							
							<input type="password" class="col-12 col-sm-7 col-md-8 col-lg-9 col-xl-9 form-control" name="oldPassword" id="oldPassword" value=""> <!--Since we are not looping, because we only retrieve one record, 																																we need to specify the row to retrieve as 0 because it's the first and only one--> 
						
						</div>
							
						<div class="row form-group">
							
							<label for="newPassword" class="col-12 col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">New Password *</label>
							
							<input type="password" class="col-12 col-sm-7 col-md-8 col-lg-9 col-xl-9 form-control" name="newPassword" id="newPassword" value=""> <!--Since we are not looping, because we only retrieve one record, 																																we need to specify the row to retrieve as 0 because it's the first and only one--> 
						
						</div>
						
						<div class="row form-group">
							
							<label for="verifyPassword" class="col-12 col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">Verify Password *</label>
							
							<input type="password" class="col-12 col-sm-7 col-md-8 col-lg-9 col-xl-9 form-control" name="verifyPassword" id="verifyPassword" value=""> <!--Since we are not looping, because we only retrieve one record, 																																we need to specify the row to retrieve as 0 because it's the first and only one--> 
						
						</div>
				
						</br>
						
						<input type="hidden" value="1" id="changepassword" name="changepassword">
						
						<button type="button" class="btn btn-success btn-sm leftMargin25" onClick="validateFieldsForm();">Change</button> <!-- When you hit the login button, run the checkLoginFields function -->
						
					</form>
				
				</div> <!-- End of div mainContainer -->
				
				<div class="col-12 col-sm-4 rulesContainer"> <!-- This determines how much of the page we want filled up by the form -->
				
					<h4>Password Rules</h4>
					
					<ul>
						
						<li>New and Old Passwords cannot be the same</li>
						
						<li>Password must be four characters long</li>
						
						<li>Password must contain at least one upper case and lower case letter</li>
						
						<li>Password must contain at least one number</li>
						
						<li>Password must contain one of the following special characters !@#$%&*</li>
					
					</ul>
				
				</div>
			
			 </div><!-- End of row -->
		
		</div> <!-- End of container-fluid -->
	
	</body>
	
	<?php require_once(APP_ROOTDIR."\\v1\\config\\footer.php"); //Include footer?>

</html>