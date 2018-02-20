// Main Javascript for Santi

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

document.getElementById("todayIs").innerHTML = currentDayOfWeek;

paragraphs = document.getElementsByTagName("p"); //Declares a global variable "paragraphs" with all the paragraph objects.
for(var i=0; i<paragraphs.length; i++) {
	console.log(paragraphs[i].innerHTML);	//Sends the current value of the paragraph to the JavaScript console.
	paragraphs[i].innerHTML = "Paragraph No:"+i;	//Sets the text within the paragraph.
	console.log(paragraphs[i].innerHTML);	//Sends the current value of the paragraph to the JavaScript console.
}



//alert(w);