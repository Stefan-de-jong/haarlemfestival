src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js";

var back = document.getElementById('back');
back.onclick = function goBack(){
nr.style.display = 'block';
t.style.display = 'block';
aj.style.display = 'block';
hw.style.display = 'block';
avb.style.display = 'block';
mx.style.display = 'block';
if (pnl.style.display == "block") {
pnl.style.display = "none";
} else {
pnl.style.display = "block";
}
}

window.onload = getAmountOfRows();

function getAmountOfRows() //gets the row amount for later use
{
number = 0;
var dropdown = document.getElementById('s' + number);
while (dropdown != undefined)
{
number++;
var dropdown = document.getElementById('s' + number);
}
var i;
for (i = 0; i < number; i++)
{
initTicketWarning(i);
}
}

function initTicketWarning(number){ //for every dropdown make sure that if the selection of the dropdown is changed a warning is returned
var selection = document.getElementById('s' + number);
selection.onchange = function getValueDropdown(){
var selected = selection.options[selection.selectedIndex].value;
var price = document.getElementById('q' + number);
var quantity = price.innerHTML;
if (selected > quantity || selected == 10) //for some reason (selected > quantity) did not work with the amount ten, so I had to add the || selected == 10 statement to make it work
{
alert("The requested amount of tickets is greater than the amount of tickets available, please choose less tickets");
}
}
}

