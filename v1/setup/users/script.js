function validateFieldsForm(){	//function to check if the user and password are entered
	
	if(debug) console.log("exec: validateFieldsForm");	//Printing to the console that the function is being executed

	
	$("#username").removeClass("errorField");	//This removes the CSS class from the username field 
	
	$("#lastname").removeClass("errorField"); //This removes the CSS class from the lastname field
	
	$("#firstname").removeClass("errorField");	//This removes the CSS class from the firstname field 
	
	$("#middlename").removeClass("errorField"); //This removes the CSS class from the middlename field
	
	$("#email").removeClass("errorField"); //This removes the CSS class from the email field
	
	var valueOfUserName = $("#username").val(); //This variable is assigned to the value of the element "username"
	
	var valueOfLastName = $("#lastname").val(); //This variable is assigned to the value of the element "lastname"
	
	var valueOfFirstName = $("#firstname").val(); //This variable is assigned to the value of the element "firstname"
	
	var valueOfMiddleName = $("#middlename").val(); //This variable is assigned to the value of the element "middlename"
	
	var valueOfEmail = $("#email").val(); //This variable is assigned to the value of the element "email"
		
	var msg = ""; //We created this variable which will be displayed in an alert message
	
	if (valueOfUserName == "") { //If nothing is entered for the username...
		
		msg = msg + "The Username is a Required Field\n"; //Add this string of text to the variable msg
		
		$("#username").addClass("errorField"); //And add the class from css
		
	}
	
	if (valueOfLastName == "") { //If nothing is entered for the Last Name...
		
		msg = msg + "The Last Name is a Required Field\n"; //Add this string of text to the variable msg
		
		$("#lastname").addClass("errorField"); //And add the class from css
		
	}
	
	if (valueOfFirstName == "") { //If nothing is entered for the First Name...
		
		msg = msg + "The First Name is a Required Field\n"; //Add this string of text to the variable msg
		
		$("#firstname").addClass("errorField"); //And add the class from css
		
	}
	
	if (valueOfEmail == "") { //If nothing is entered for the Email...
		
		msg = msg + "The Email is a Required Field\n"; //Add this string of text to the variable msg
		
		$("#email").addClass("errorField"); //And add the class from css
		
	}

	if (msg != "") {  //If the value is not blank for msg...
		
		msg = "The Following Errors Were Found:\n\n" + msg; //Add this string of text to the variable msg
		
		alert(msg); //And print this alert message

	} else {
		
		$("#actionForm").submit(); //Submit the form if the the username and password are filled out
		
	}
	
}

function backToMain() {
	
	if(debug) console.log("exec: backToMain");
	
	location.href="main.php"; //The location function sends us back to the specified page
	
	
}

function blockedOnClick() {
	
	if(debug) console.log("exec: blockedOnClick");
	
	var isChecked = $("#blocked").is(":checked"); //Checks the check attribute. True means checked, false unchecked.
	
	if (isChecked) { //Executes if the checkbox is checked.
		
		var r = confirm("Are you sure you want to block this user?"); //Asks to confirm the action and stores the answer in variable "r"
	
		if (r == true) { //Executes if the answer is okay
			
			$("#tries").val(0); //Assigns the value of the element "tries" to x 
		
		} else { //Executes if the answer is cancel
		
			$("#blocked").prop("checked", false); //Resets the check attribute of the checkbox.

			return false; //Stops the javascript

		}
		
	} else { //execute if the checkbox is not checked.

		var r = confirm("Are you sure you want to unblock this user?"); //Asks to confirm the action and stores the answer in variable "r"
		
		if (r == true) { //Executes if the answer is okay
			
			$("#tries").val(0); //Assigns the value of the element "tries" to x 
		
		} else {  //Executes if the answer is cancel
		
			$("#blocked").prop("checked", true); //Resets the check attribute of the checkbox.

			return false; //Stops the javascript

		}
	
	}

}

function activeOnClick() {
	
	if(debug) console.log("exec: activeOnClick");
	
	var isChecked = $("#active").is(":checked"); //Checks the check attribute. True means checked, false unchecked.
	
	if (isChecked) { //Executes if the checkbox is checked.
		
		var r = confirm("Are you sure you want to activate this user?"); //Asks to confirm the action and stores the answer in variable "r"
	
		if (r == false) { //Executes if the answer is cancel. If the answer is okay skip because there is nothing else to do.

			$("#active").prop("checked", false); //Resets the check attribute of the checkbox.

			return false; //Stops the javascript

		}
		
	} else { //execute if the checkbox is not checked.

		var r = confirm("Are you sure you want to deactivate this user?"); //Asks to confirm the action and stores the answer in variable "r"
		
		if (r == false) { //Executes if the answer is cancel. If the answer is okay skip because there is nothing else to do.
		
			$("#active").prop("checked", true); //Resets the check attribute of the checkbox.

			return false; //Stops the javascript

		}
	
	}

}