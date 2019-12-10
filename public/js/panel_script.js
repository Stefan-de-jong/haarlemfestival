src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js";

var back = document.getElementById('back');
back.onclick = function goBack(){ //when someone presses the back button hide the panel
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

window.onload = getAmountOfRows(); //count the amount of rows on window load

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
initButtons(i);
}
}

function initButtons(number){ //for every dropdown make sure that if the selection of the dropdown is changed a warning is returned if necessary
window.onload = disableButton(number, "SELECT YOUR TICKETS");
var selection = document.getElementById('s' + number);
selection.onchange = function getValueDropdown(){
var selected = selection.options[selection.selectedIndex].value;
var amount = document.getElementById('q' + number);
var price = document.getElementById('q' + number);
var quantity = amount.innerHTML;
var difference = quantity - selected;
if (difference < 0)
{
alert("The requested amount of tickets is greater than the amount of tickets available");
disableButton(number, "INSUFFICIENT TICKETS");
}
else
{
enableButton(number, selected, price);
}
giveButtonScript(number);
}
}

function disableButton(number, message){ //disable a button to prevent wrong values from being sent to php
var button = document.getElementById('b' + number);
button.innerHTML = message;
button.disabled = true;
}

function enableButton(number, selected, pay){ //enable button, and use javascript to determine what values the button needs to send to php to generate a ticket
var button = document.getElementById('b' + number);
button.innerHTML = "ADD TO CART";
button.disabled = false;
button.onclick = function changeButtonText(){
danceid = row[number];
$(document).ready(function () {
button.innerHTML = "ADDED TO CART";
$.ajax({  
    type: 'POST',  
    url: '../public/inc/dance/newticket.php', 
    data: {id:danceid, tickets:selected, price:pay}, //this line should send data to newticket.php but can't for some reason...
    //I think it has something to do with Ajax caching
    //If I can fix this line everything else should work
});
});
}
}