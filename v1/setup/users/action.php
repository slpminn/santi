<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php"); //Defines $dbconn as the connection to the database
	// load header file

try {	
	
	$pageTitle = "Edit"; //Page title to use on the header.php
	
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
				
				<div class="col-12 mainContainer"> <!-- This determines how much of the page we want filled up by the form -->
		
					<form action="maintain.php" method="POST" id="actionForm" name="actionForm"> <!-- This defines the form, tells where to submit the form -->
						
						<h2>Setup.Users.<?php print $pageTitle; ?></h2> <!-- Applies the class defined in CSS to the h2 -->
						
						<div class="row form-group">
							
							<label for="username" class="col-11 col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">Username *</label>
							
							<input type="text" class="col-11 col-sm-7 col-md-8 col-lg-9 col-xl-9 form-control" name="username" id="username" value="<?php echo $username; ?>"> <!--Since we are not looping, because we only retrieve one record, 																																we need to specify the row to retrieve as 0 because it's the first and only one--> 
						
						</div>
						
						<div class="row form-group <?php echo $passwordClass;?>">
							
							<label for="password" class="col-11 col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">Password *</label>
							
							<input type="password" class="col-11 col-sm-7 col-md-8 col-lg-9 col-xl-9 form-control" name="password" id="password" value=""> <!--Since we are not looping, because we only retrieve one record, 																																we need to specify the row to retrieve as 0 because it's the first and only one--> 
						
						</div>
							
						<div class="row form-group">
							
							<label for="lastname" class="col-11 col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">Last Name *</label>
							
							<input type="text" class="col-11 col-sm-7 col-md-8 col-lg-9 col-xl-9 form-control" name="lastname" id="lastname" value="<?php echo $lastname; ?>">
						
						</div>

						<div class="row form-group">
							
							<label for="firstname" class="col-11 col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">First Name *</label>
							
							<input type="text" class="col-11 col-sm-7 col-md-8 col-lg-9 col-xl-9 form-control" name="firstname" id="firstname" value="<?php echo $firstname; ?>"> <!--Since we are not looping, because we only retrieve one record, 																												we need to specify the row to retrieve as 0 because it's the first and only one--> 
						
						</div>
						
						<div class="row form-group">
							
							<label for="middlename" class="col-11 col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">Middle Name</label>
							
							<input type="text" class="col-11 col-sm-7 col-md-8 col-lg-9 col-xl-9 form-control" name="middlename" id="middlename" value="<?php echo $middlename; ?>"> <!--Since we are not looping, because we only retrieve one record, 																												we need to specify the row to retrieve as 0 because it's the first and only one--> 
						
						</div>
						
						<div class="row form-group">
							
							<label for="email" class="col-11 col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">Email *</label>
							
							<input type="email" class="col-11 col-sm-7 col-md-8 col-lg-9 col-xl-9 form-control" name="email" id="email" value="<?php echo $email; ?>"> <!--Since we are not looping, because we only retrieve one record, 																												we need to specify the row to retrieve as 0 because it's the first and only one--> 
						
						</div>
						
						<div class="row form-group">
						
							<label for="blocked" class="col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">Blocked</label>
								
							<input type="checkbox" class="col-1 bigCheckbox" name="blocked" id="blocked" value="1" <?php if($blocked==1) echo "checked";?> onClick="blockedOnClick();">
		  
						</div>
						
						<div class="row form-group">
							
							<label for="tries" class="col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">Tries</label>
							
							<input type="tries" class="col-1 form-control" name="tries" id="tries" value="<?php echo $tries; ?>" disabled> <!--Since we are not looping, because we only retrieve one record, 																												we need to specify the row to retrieve as 0 because it's the first and only one--> 
						
						</div>
						
						<div class="row form-group">
						
							<label for="active" class="col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">Active</label>
								
							<input type="checkbox" class="col-1 bigCheckbox" name="active" id="active" value="1" <?php if($active==1) echo "checked";?> onClick="activeOnClick();">
		  
						</div>
				
						</br>
						
						<input type="hidden" value="<?php echo $param_id; ?>" id="id" name="id">
						
						<button type="button" class="btn btn-danger btn-sm" onClick="backToMain();">Cancel</button>
						
						<button type="button" class="btn btn-success btn-sm leftMargin25" onClick="validateFieldsForm();">Save</button> <!-- When you hit the login button, run the checkLoginFields function -->
						
					</form>
				
				</div> <!-- End of div mainContainer -->
			
			 </div><!-- End of row -->
		
		</div> <!-- End of container-fluid -->
	
	</body>
	
	<?php require_once(APP_ROOTDIR."\\v1\\config\\footer.php"); //Include footer?>

</html>