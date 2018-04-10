function validateFieldsForm(){	//function to check if the user and password are entered
	
	if(debug) console.log("exec: validateFieldsForm");	//Printing to the console that the function is being executed

	$("#oldPassword").removeClass("errorField");	//This removes the CSS class 
	
	$("#newPassword").removeClass("errorField"); 
	
	$("#verifyPassword").removeClass("errorField");	 
	
	
	var valueOfOldPassword = $("#oldPassword").val(); //This variable is assigned to the value of the element 
	
	var valueOfNewPassword = $("#newPassword").val(); 
	
	var valueOfVerifyPassword = $("#verifyPassword").val(); 
		
	var msg = ""; //We created this variable which will be displayed in an alert message
	
	if (valueOfOldPassword == "") { //If nothing is entered...
		
		msg = msg + "The Old Password is a Required Field\n"; //Add this string of text to the variable msg
		
		$("#oldPassword").addClass("errorField"); //And add the class from css
		
	}
	
	if (valueOfNewPassword == "") { 
		
		msg = msg + "The New Password is a Required Field\n"; 
		
		$("#newPassword").addClass("errorField"); 
		
	}
	
	if (valueOfVerifyPassword == "") { 
		
		msg = msg + "The Verify Password is a Required Field\n"; 
		
		$("#verifyPassword").addClass("errorField");
		
	}
	
	if (valueOfNewPassword == valueOfOldPassword) { //If the new and old passwords match...
		
		msg = msg + "The New and Old Passwords cannot be the same\n"; //Add this string of text to the variable msg
		
		$("#newPassword").addClass("errorField"); //And add the class from css
		
	}

	var containsDigits = /[0-9]/.test(valueOfNewPassword);
	var containsUpper = /[A-Z]/.test(valueOfNewPassword);
	var containsLower = /[a-z]/.test(valueOfNewPassword);	
	if (valueOfNewPassword.length < 4  || !containsDigits || !containsUpper || !containsLower) { //If the new and verify password don't match...
		
		msg = msg + "The New Password does not match the password rules\n"; //Add this string of text to the variable msg
		
		$("#newPassword").addClass("errorField"); //And add the class from css
		
	}
	
	if (valueOfNewPassword != valueOfVerifyPassword)
	{ //If the new and verify password don't match...
		
		msg = msg + "The New and Verify Passwords are not the same\n"; //Add this string of text to the variable msg
		
		$("#verifyPassword").addClass("errorField"); //And add the class from css
		
	}

	if (msg != "") {  //If the value is not blank for msg...
		
		msg = "The Following Errors Were Found:\n\n" + msg; //Add this string of text to the variable msg
		
		alert(msg); //And print this alert message

	} else {
		
		$("#actionForm").submit(); //Submit the form if there are no errors
		
	}
	
}

