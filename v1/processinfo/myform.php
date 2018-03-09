<?php

	// load configuration file
	require_once($_SERVER['DOCUMENT_ROOT']."\\v1\\config\\config.php");
	// load database connection
	require_once(APP_ROOTDIR."\\v1\\config\\pdo_db.php");
	// load header file
	
	$clean_ID = cleanInput($_POST['exampleInputId']);
	
	$tsql = "SELECT  exampleInputEmail1, 
						exampleInputName, 
						exampleInputPassword1, 
						exampleInputNumberComputers, 
						exampleOperatingSystem, 
						exampleTextarea, 
						exampleOptionsRadios, 
						exampleMyOptions2, 
						id
				FROM tMyFirstTable 
				WHERE id = :id";
	$params = array("");
	$params[':id'] = $clean_ID;
	$exec = $dbconn->prepare($tsql);
	if ($exec->execute($params)) {
		print("<h2>Select executed successfully</h2>");
		$row = $exec->fetchAll(PDO::FETCH_ASSOC);
		$count = count($row);
		var_dump($row);
		print("<h4>The number of rows returned is ".$count."</h4>"); 
		
		if ($count == 0) {
			
			$exampleInputEmail1 = "";
			$exampleInputName = "";
			$exampleInputPassword1 = "";
			$exampleInputNumberComputers = 0;
			$exampleOperatingSystem = 0;
			
			
		} else {

			$exampleInputEmail1 = $row[0]["exampleInputEmail1"];
			$exampleInputName = $row[0]["exampleInputName"];
			$exampleInputPassword1 = $row[0]["exampleInputPassword1"];
			$exampleInputNumberComputers = $row[0]["exampleInputNumberComputers"];
			$exampleOperatingSystem = explode(",",$row[0]["exampleOperatingSystem"]);	/* Use explode to convert a string into an array. 
																							Ex	
																							The $string = "A,B,C";
																							When explode to $array results in
																								$array[0] = "A";
																								$array[1] = "B";
																								$array[2] = "C";
																						*/
		}
		
		
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
	
	
    
	<title>Hello, world!</title>
  </head>
  <body>
    
	<div class="container-fluid">
	
	<div class="row">
	
		<div class="col-12 col-lg-9 col-xl-7 mainContainer" />
		
			<h1>Hello, world!</h1>

			<form action="/v1/processinfo/recordPersonalInformation.php" method="POST" id="processForm" name="processForm" onsubmit="checkFields();"> 

			<div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="exampleInputEmail1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $exampleInputEmail1; ?>">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
		<div class="form-group">
    <label for="exampleInputName">Name</label>
    <input type="text" class="form-control" name="exampleInputName" id="exampleInputName" placeholder="Name" value="<?php echo $exampleInputName; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="exampleInputPassword1" id="exampleInputPassword1" placeholder="Password" value="<?php echo $exampleInputPassword1; ?>">
  </div>
  <div class="form-group">
    <label for="exampleSelect1">How Many Computers do you own?</label>
    <select class="form-control" name="exampleInputNumberComputers" id="exampleInputNumberComputers">
      <option />
	  <option value="1" <?php if ($exampleInputNumberComputers == 1) echo "selected"; ?>>One</option>
      <option value="2" <?php if ($exampleInputNumberComputers == 2) echo "selected"; ?>>Two</option>
      <option value="3" <?php if ($exampleInputNumberComputers == 3) echo "selected"; ?>>Three</option>
      <option value="4" <?php if ($exampleInputNumberComputers == 4) echo "selected"; ?>>Four</option>
      <option value="5" <?php if ($exampleInputNumberComputers == 5) echo "selected"; ?>>Five</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleSelect2">Select Operating System</label>
	<select multiple class="form-control" name="exampleOperatingSystem" id="exampleOperatingSystem" size="10">
      <option /> <!-- Created an unselected option -->
	  <option value="W7" <?php if (in_array("W7",$exampleOperatingSystem)) echo "selected"; ?> >Windows 7</option>
      <option value="W10" <?php if (in_array("W10",$exampleOperatingSystem)) echo "selected"; ?> >Windows 10</option>
      <option value="IOSEC" <?php if (in_array("IOSEC",$exampleOperatingSystem)) echo "selected"; ?> >Mac IOS El Capitan</option>
      <option value="IOSHS" <?php if (in_array("IOSHS",$exampleOperatingSystem)) echo "selected"; ?> >Mac IOS High Sierra</option>
      <option value="LU16" <?php if (in_array("LU16",$exampleOperatingSystem)) echo "selected"; ?> >Linux Ubuntu16</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleTextarea">Example textarea</label>
    <textarea class="form-control" name="exampleTextarea" id="exampleTextarea" rows="5">This is a text area</textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
    <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
  </div>
  <fieldset class="form-group">
    <legend>Radio buttons</legend>
    <div class="form-check">
      <label class="form-check-label">
        <input type="radio" class="form-check-input" name="exampleOptionsRadios" id="optionsRadios1" value="option1">
        Option one is this and that&mdash;be sure to include why it's great
      </label>
    </div>
    <div class="form-check">
    <label class="form-check-label">
        <input type="radio" class="form-check-input" name="exampleOptionsRadios" id="optionsRadios2" value="option2" checked>
        Option two can be something else and selecting it will deselect option one
      </label>
    </div>
    <div class="form-check disabled">
    <label class="form-check-label">
        <input type="radio" class="form-check-input" name="exampleOptionsRadios" id="optionsRadios3" value="option3" disabled>
        Option three is disabled
      </label>
    </div>
  </fieldset>
   
  <fieldset class="form-group">
  <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" name="exampleMyOptions1" id="exampleMyOptions1" class="form-check-input" value="One" checked>
      Check me out
    </label>
  </div>
   <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" name="exampleMyOptions2" id="exampleMyOptions2" class="form-check-input" value="true" checked>
      Delete this record
    </label>
  </div>
  </fieldset>
  
  
  <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>  <!--Button type submit has a default behavior of submitting the form--> 
  
  <button type="button" class="btn btn-warning btn-lg btn-block" onclick="history.back();">Cancel</button>
  
  <button type="button" class="btn btn-danger btn-sm btn-block" onclick="clearFields();">Clear fields</button>
			</form>
	
		</div>
		
		<div class="col-12 col-lg-3 sidebarContainer" >
		
			<h2>Hello, Santi!</h2>

			<p>Porttitor eget dolor morbi non arcu risus quis varius quam. Odio euismod lacinia at quis. Velit scelerisque in dictum non consectetur a. Natoque penatibus et magnis dis parturient montes nascetur ridiculus. Egestas purus viverra accumsan in. Vulputate sapien nec sagittis aliquam malesuada. Dis parturient montes nascetur ridiculus. Nec ullamcorper sit amet risus nullam. Aliquet risus feugiat in ante. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit.</p>		
			
		</div>

		<div class="col-12 col-lg-3 col-xl-2 hidden-xl-down sidebarContainer" >
		
			<h2>Extra Large!</h2>

			<p>Porttitor eget dolor morbi non arcu risus quis varius quam. Odio euismod lacinia at quis. Velit scelerisque in dictum non consectetur a. Natoque penatibus et magnis dis parturient montes nascetur ridiculus. Egestas purus viverra accumsan in. Vulputate sapien nec sagittis aliquam malesuada. Dis parturient montes nascetur ridiculus. Nec ullamcorper sit amet risus nullam. Aliquet risus feugiat in ante. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit.</p>		
			
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