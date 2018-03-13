

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
	
		<div class="container-fluid"> <!-- In this case this gives a border between the edge of the page and the username, password, and button. Defines div as a bootstrap container. -->
		
			<div class="row"> <!-- Defines everything below as being one row -->
				
				<div class="col mainContainer"> <!-- This determines how much of the page we want filled up by the form -->
		
					<form action="/v1/secure/authorize.php" method="POST" id="loginForm" name="loginForm"> <!-- This defines the form, tells where to submit the form -->
					
						<h1 class="applicationTitle">Household Asset Tracking</h1> <!-- Applies the class defined in CSS to the h1 -->
						
						<h2 class="applicationTitleSmall colorRed boldText">Developed By Santi</h2> <!-- Applies the class defined in CSS to the h2 -->
						
						<div class = "form-group">
							<label for = "username" class="boldText">Username</br></label>
							<input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
						</div>
						
						<div class = "form-group">
							<label for = "password" class="boldText">Password</br></label>
							<input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
						</div>
						
						</br>
						
						<button type="button" class="btn btn-primary btn-lg btn-block" onClick="checkLoginFields(event);">Login</button> <!-- When you hit the login button, run the checkLoginFields function -->

					</form>
				
				</div> <!-- End of div mainContainer -->
			
			 </div><!-- End of row -->
		
		</div> <!-- End of container-fluid -->
	
		<!-- Bootstrap Javascript -->
		<script src="/v1/assets/bootstrap/4.0.0/js/bootstrap.min.js"></script>
				
		<!-- <script src="/v1/assets/bootstrap/4.0.0/js/popper.min.js"></script> -->
				
		<!-- Custom Javascript -->
		<script type="text/javascript" src="/v1/assets/js/main.js"></script>
	
	</body>

</html>