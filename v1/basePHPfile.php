<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php"); //Defines $dbconn as the connection to the database
	// load header file

		########## Put php Code Here ###########
	
try {
	
	$pageTitle = "### PAGE TITLE ###"; //Page title to use on the header.php

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
		
					########## Put Content Here ###########
				
				</div> <!-- End of div mainContainer -->
			
			</div> <!-- End of row -->
		
		</div> <!-- End of container-fluid -->
				
	</body>
	
	<?php require_once(APP_ROOTDIR."\\v1\\config\\footer.php"); //Include footer?>	

</html>