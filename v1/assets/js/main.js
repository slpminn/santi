// Main Javascript for Santi
/*
var currentDate = new Date();	//Declares a global variable "currentDate" and sets to the current date.
var currentNumberOfDay = currentDate.getDay(); //Declares a global variable "currentNumberOfDay" and sets to the week day number based on the current date.

weekDay = new Array(); //Declares a global array "weekDay" and sets to all the week days.
weekDay[0] =  "Sunday";
weekDay[1] = "Monday";
weekDay[2] = "Tuesday";
weekDay[3] = "Wednesday";
weekDay[4] = "Thursday";
weekDay[5] = "Friday";
weekDay[6] = "Saturday";

var currentDayOfWeek = weekDay[currentNumberOfDay]; //Declares a global variable "currentDayOfWeek" and sets to the current week date base on the week day number.

//document.getElementById("todayIs").innerHTML = currentDayOfWeek;

paragraphs = document.getElementsByTagName("p"); //Declares a global variable "paragraphs" with all the paragraph objects.
for(var i=0; i<paragraphs.length; i++) {
	console.log(paragraphs[i].innerHTML);	//Sends the current value of the paragraph to the JavaScript console.
	paragraphs[i].innerHTML = "Paragraph No:"+i;	//Sets the text within the paragraph.
	console.log(paragraphs[i].innerHTML);	//Sends the current value of the paragraph to the JavaScript console.
}
*/
function clearFields(){
	console.log("exec: clearFields");
	
	
	$("#exampleInputEmail1").val("");	//This clear the value
	$("#exampleInputName").val("");
	$("#exampleInputPassword1").val("");
	$("#exampleInputNumberComputers").prop("selectedIndex", 0);
	$("#exampleOperatingSystem").prop("selectedIndex", 0); //Used prop method to set the option to one of the options starting from zero
	$("#exampleTextarea").val("");
	$("#optionsRadios1").prop("checked", true); //Used prop method for radio buttons to set one radio button to checked
	$("#exampleMyOptions1").prop("checked", false); //Had to do both because you can select both at the same time
	$("#exampleMyOptions2").prop("checked", false);
	
	
}

function checkFields(e){
	console.log("exec: checkFields");
	
	var valueOfEmail1 = $("#exampleInputEmail1").val(); //How to retrieve the value of an element
														//$("#exampleInputEmail1"), This is how you reference an element by id in jquery
	return false;
}

function editInformation(){
	console.log("editInformation");
	
	$("#processForm").submit();
	
}
//alert(w);

function checkLoginFields(e){	//function to check if the user and password are entered
	console.log("exec: checkLoginFields");	//Printing to the console that the function is being executed

	
	$("#user").removeClass("errorField");	//This removes the CSS class from the username field 
	
	$("#password").removeClass("errorField"); //This removes the CSS class from the password field
	
	var valueOfUser = $("#user").val(); //This variable is assigned to the value of the element "user"
	
	var valueOfPassword = $("#password").val(); //This variable is assigned to the value of the element "password"
		
	var msg = ""; //We created this variable which will be displayed in an alert message
	
	if (valueOfUser == "") { //If nothing is entered for the username...
		
		msg = msg + "The User is a Required Field\n"; //Add this string of text to the variable msg
		
		$("#user").addClass("errorField"); //And add the class from css
		
	}
	
	if (valueOfPassword == "") { //If nothing is entered for the password...
		
		msg = msg + "The Password is a Required Field\n"; //Add this string of text to the variable msg
		
		$("#password").addClass("errorField"); //And add the class from css
		
	}

	if (msg != "") {  //If the value is not blank for msg...
		
		msg = "The Following Errors Were Found:\n\n" + msg; //Add this string of text to the variable msg
		
		alert(msg); //And print this alert message

	} else {
		
		$("#loginForm").submit(); //Submit the form if the the username and password are filled out
		
	}
	
}

function executeAction(e,id){
	console.log("exec: executeAction");
	
	$("#id").val(id);
	
	$("#mainForm").submit();
	
}
