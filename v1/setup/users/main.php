<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php"); //Defines $dbconn as the connection to the database
	// load header file

try {
	
	$pageTitle = "Main"; //Page title to use on the header.php
	
	$tsql = "SELECT id,username,lastname,firstname,middlename,email,active FROM usertbl ORDER BY active desc,lastname,firstname,middlename"; //We use ORDER BY because we are retrieving more than one record
	$params = array("");
	$exec = $dbconn->prepare($tsql);
	if ($exec->execute($params)) {
		//print("<h2>Select executed successfully</h2>");
		$rows = $exec->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($rows);
		$count = count($rows);
		//print("<h4>The number of rows returned is ".$count."</h4>"); 
	} else { 
		print("<h2>Select not executed successfully</h2>");
		exit();
	}
	
	
	
} catch(Exception $e) {
	$dbconn->rollback();					//Rollback.	Undoes the changes to the Database.
	print("<h2>".$e->getMessage()."</h2>");
	print("<h2>ERR0001 -  Unable to process the request. Contact your administrator.</h2>");
}		
?>

<!doctype html>
<html lang="en">
    
	<?php require_once(APP_ROOTDIR."\\v1\\config\\header.php"); //Include Header?>
	
	<body>
	
		<?php require_once(APP_ROOTDIR."\\v1\\config\\navigation.php"); //Include navigation?>
	
		<div class="container-fluid"> <!-- In this case this gives a border between the edge of the page and the username, password, and button. Defines div as a bootstrap container. -->
		
			<div class="row"> <!-- Defines everything below as being one row -->
				
				<div class="col mainContainer"> <!-- This determines how much of the page we want filled up by the form -->
		
					<h2>Setup.Users.<?php print $pageTitle; ?></h2> <!-- Applies the class defined in CSS to the h1 -->
					
					<form action="/v1/setup/users/edit.php" method="POST" id="editForm" name="editForm" class=""> <!-- This defines the form, tells where to submit the form -->
						
						<?php

						echo "<div class=\"row form-group\">";
						echo "<input type=\"text\" class=\"col-3 col-sm-2 form-control leftMargin5 recordHeader\" value=\"Last Name\" disabled>"; //Header
						echo "<input type=\"text\" class=\"col-3 col-sm-2 form-control leftMargin5 recordHeader\" value=\"First Name\" disabled>";
						echo "<input type=\"text\" class=\"col-3 col-sm-2 form-control leftMargin5 recordHeader\" value=\"Middle Name\" disabled>";
						echo "<input type=\"text\" class=\"col-md-4 d-none d-md-block form-control leftMargin5 recordHeader\" value=\"Email\" disabled>";
						echo "</div>";
						
						foreach($rows as $row) { //Looping through the $rows array which contains the results from the SQL statement executed, and assigning each row to the array $row.
							
							if ($row["active"] == 1) $rowClass = ""; else $rowClass = "recordInactive";
							
							echo "<div class=\"row form-group\">";
							echo "<input type=\"text\" class=\"col-3 col-sm-2 form-control leftMargin5 {$rowClass}\" value=\"{$row["lastname"]}\" disabled>"; //Retrieving an element from the array $row
							echo "<input type=\"text\" class=\"col-3 col-sm-2 form-control leftMargin5 {$rowClass}\" value=\"{$row["firstname"]}\" disabled>";
							echo "<input type=\"text\" class=\"col-3 col-sm-2 form-control leftMargin5 {$rowClass}\" value=\"{$row["middlename"]}\" disabled>";
							echo "<input type=\"text\" class=\"col-md-4 d-none d-md-block form-control leftMargin5 {$rowClass}\" value=\"{$row["email"]}\" disabled>";
							echo "<button type=\"button\" class=\"col-1 col-sm-1 btn btn-primary btn-md leftMargin5\" onClick=\"edit(event,{$row["id"]});\">Edit</button>";
							echo "</div>";

						}
						
						?>
						
						<div class="row">
						
						<button type="button" class="col col-sm-6 btn btn-primary btn-md leftMargin5" onClick="edit(event,0);">Add New User</button>
						
						</div>
						
						<input type="hidden" value="" id="id" name="id">

					</form>
				</div> <!-- End of div mainContainer -->
			
			 </div><!-- End of row -->
		
		</div> <!-- End of container-fluid -->
	
	</body>
	
	<?php require_once(APP_ROOTDIR."\\v1\\config\\footer.php"); //Include Footer?>

</html>