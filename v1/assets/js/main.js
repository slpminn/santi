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

function checkLoginFields(e){
	console.log("exec: checkLoginFields");
	
	$("#user").removeClass("errorField");
	
	$("#password").removeClass("errorField");
	
	var valueOfUser = $("#user").val();
	
	var valueOfPassword = $("#password").val();
		
	var msg = "";
	
	if (valueOfUser == "") {
		
		msg = msg + "The User is a Required Field\n";
		
		$("#user").addClass("errorField");
		
	}
	
	if (valueOfPassword == "") {
		
		msg = msg + "The Password is a Required Field\n";
		
		$("#password").addClass("errorField");
		
	}

	if (msg != "") {
		
		msg = "The Following Errors Were Found:\n\n" + msg;
		
		alert(msg);

	} else {
		
		$("#loginForm").submit();
		
	}
	
}