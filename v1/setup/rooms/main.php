<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php"); //Defines $dbconn as the connection to the database
	// load header file

try {
	
	$pageTitle = "Main"; //Page title to use on the header.php
	
	$tsql = "SELECT roomid,roomdescription,leveldescription,roomactive 
				FROM roomstbl WITH(NOLOCK)
				INNER JOIN levelstbl WITH(NOLOCK) ON roomstbl.roomlevelid = levelstbl.levelid
				ORDER BY roomactive desc,roomdescription,roomlevelid"; //We use ORDER BY because we are retrieving more than one record
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
					
					<form action="/v1/setup/rooms/action.php" method="POST" id="mainForm" name="mainForm" class=""> <!-- This defines the form, tells where to submit the form -->
						
						<?php

						echo "<div class=\"row form-group\">";
						echo "<input type=\"text\" class=\"col-4 col-sm-3 form-control leftMargin5 recordHeader\" value=\"Room\" disabled>"; //Header
						echo "<input type=\"text\" class=\"col-4 col-sm-3 form-control leftMargin5 recordHeader\" value=\"Level\" disabled>";
						echo "</div>";
						
						foreach($rows as $row) { //Looping through the $rows array which contains the results from the SQL statement executed, and assigning each row to the array $row.
							
							if ($row["roomactive"] == 1) $rowClass = "";  else $rowClass = "recordInactive";
							
							echo "<div class=\"row form-group\">";
							echo "<input type=\"text\" class=\"col-4 col-sm-3 form-control leftMargin5 {$rowClass}\" value=\"{$row["roomdescription"]}\" disabled>"; //Retrieving an element from the array $row
							echo "<input type=\"text\" class=\"col-4 col-sm-3 form-control leftMargin5 {$rowClass}\" value=\"{$row["leveldescription"]}\" disabled>";
							echo "<button type=\"button\" class=\"col-1 col-sm-1 btn btn-primary btn-md leftMargin5\" onClick=\"executeAction(event,{$row["roomid"]});\">Edit</button>";
							echo "</div>";

						}
						
						?>
						
						<div class="row">
						
						<button type="button" class="col col-sm-6 btn btn-primary btn-md leftMargin5" onClick="executeAction(event,0);">Add New Room</button>
						
						</div>
						
						<input type="hidden" value="" id="id" name="id">

					</form>
				</div> <!-- End of div mainContainer -->
			
			 </div><!-- End of row -->
		
		</div> <!-- End of container-fluid -->
	
	</body>
	
	<?php require_once(APP_ROOTDIR."\\v1\\config\\footer.php"); //Include Footer?>

</html>