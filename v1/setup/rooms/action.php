<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php"); //Defines $dbconn as the connection to the database
	// load header file

try {	
	
	$pageTitle = "Edit"; //Page title to use on the header.php
	
	//var_dump($_POST);
	
	$param_id = cleanInput($_POST['id']); //$_POST is an array containing all the parameters that we are passing from the form with a method of POST
	
	$tsql = "SELECT roomdescription ,roomfloorid ,roomactive 
				FROM roomstbl WITH(NOLOCK) 
				WHERE roomid=:roomIdPlaceHolder"; /*Building an SQL statement a.k.a query. We are selecting columns from a table and filtering by id.
																	We do not need an ORDER BY because we are only retrieving one record		*/
														
	$params = array(); //Building and array with the values to filter the results from the SQL statement.
	
	$params[':roomIdPlaceHolder'] = $param_id; //Assigned the filter with an index of (:userId) to the value of the variable $param_id.
	
	$exec = $dbconn->prepare($tsql); //Prepare tells php which statement we're going to execute before we execute it to prevent SQL injection attacks.
	
	if ($exec->execute($params)) { //Executing the statement and passing the array with the values for the filters placeholders.
		
		//print("<h2>Select executed successfully</h2>");
		
		$rows = $exec->fetchAll(PDO::FETCH_ASSOC); //Created an array and stores the information retrieved by executing the SQL statement.
		
		 //var_dump($rows); echo "<hr />"; 
		
		$count = count($rows); //Created a variable that stores the number of rows retrieved by executing the SQL statement.
		
		// print("<h4>The number of rows returned is ".$count."</h4>"); 
	
		if ($param_id == 0) {  //Adding a new record
			
			 $roomdescription = "";
			 $roomfloorid = "";
			 $roomactive = 1;
	  
		} else { //Editing a record
			
			 $roomdescription = $rows[0]["roomdescription"];
			 $roomfloorid = $rows[0]["roomfloorid"];
			 $roomactive = $rows[0]["roomactive"];
			 
		}
		

	} 

	$tsql = "SELECT floordescription, floorid 
				FROM floorstbl WITH(NOLOCK) 
				ORDER BY floordescription"; /*Building an SQL statement a.k.a query. We are selecting columns from a table and filtering by id.
																	We do not need an ORDER BY because we are only retrieving one record		*/
														
	$params = array(); //Building and array with the values to filter the results from the SQL statement.
		
	$exec = $dbconn->prepare($tsql); //Prepare tells php which statement we're going to execute before we execute it to prevent SQL injection attacks.
		
	if ($exec->execute($params)) { //Executing the statement and passing the array with the values for the filters placeholders.
		
		//print("<h2>Select executed successfully</h2>");
		
		$allRowfloors = $exec->fetchAll(PDO::FETCH_ASSOC); //Created an array and stores the information retrieved by executing the SQL statement.
			
		 //var_dump($allRowfloors); echo "<hr />";
			
		$countfloors = count($allRowfloors); //Created a variable that stores the number of rows retrieved by executing the SQL statement.
			
	} 
												
	
	
} catch(Exception $e) {
	
	print("<h2>ERR0001 -  Unable to process the request. Contact your administrator.</h2>");
	print("<h2>".$e->getMessage()."</h2>");
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
							
							<label for="roomdescription" class="col-11 col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">Room *</label>
							
							<input type="text" class="col-11 col-sm-7 col-md-8 col-lg-9 col-xl-9 form-control" name="roomdescription" id="roomdescription" value="<?php echo $roomdescription; ?>"> <!--Since we are not looping, because we only retrieve one record, 																																we need to specify the row to retrieve as 0 because it's the first and only one--> 
						
						</div>

						<div class="row form-group">

							<label for="roomfloorid" class="col-11 col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">floors *</label>
							
							<select class="col-11 col-sm-7 col-md-8 col-lg-9 col-xl-9 form-control" name="roomfloorid" id="roomfloorid">
							  
							  <option selected />
								
								<?php 
									
									foreach($allRowfloors as $afloor) { //Read each row of $allRowLeves one at a time and assign the current row to $afloor. Loop for as long as there are rows in $allRowfloors.
										
										if ($roomfloorid == $afloor["floorid"]) $matchFound = "selected"; else $matchFound = ""; /* If the current row floor is equal to the floor assigned to the room the we want to display and select the option
																																	Otherwise, just display the option. */		
										
										echo "<option value=\"{$afloor["floorid"]}\" {$matchFound}>{$afloor["floordescription"]}</option>";
										
									}
								
								?>
							
							</select>
						
						</div>
						
						<div class="row form-group">
						
							<label for="roomactive" class="col-sm-4 col-md-3 col-lg-2 col-xl-2 boldText">Active</label>
								
							<input type="checkbox" class="col-1 bigCheckbox" name="roomactive" id="roomactive" value="1" <?php if($roomactive==1) echo "checked";?> onClick="activeOnClick();">
		  
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