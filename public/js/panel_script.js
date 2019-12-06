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

function getAmountOfRows() //gets the amount of dropdowns
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

function initTicketWarning(number){ //for every dropdown make sure that if the selection of the dropdown is changed a warning is returned if necessary
var selection = document.getElementById('s' + number);
selection.onchange = function getValueDropdown(){
var selected = selection.options[selection.selectedIndex].value;
var amount = document.getElementById('q' + number);
var quantity = amount.innerHTML;
if (selected > quantity) //this is currently bugged. I checked the values, even if selected is less than quantity it will still pretend it's not
{
alert(selected + quantity);
alert("The requested amount of tickets is greater than the amount of tickets available, please choose less tickets");
disableButton(number);
}
else
{
enableButton(number);
}
}
}

function disableButton(number){
var button = document.getElementById('b' + number);
button.innerHTML = "INSUFFICIENT TICKETS";
button.disabled = true;
}

function enableButton(number){
var button = document.getElementById('b' + number);
button.innerHTML = "ADD TO CART";
button.disabled = false;
}

