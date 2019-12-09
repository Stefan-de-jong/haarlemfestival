var id = 0;
var quantity = 0;
var pay = 0;

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
row.length = 0;
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
var amount = document.getElementById('q' + number).innerHTML;
var price = document.getElementById('p' + number).innerHTML;
id = row[number];
quantity = selected;
pay = price; 
var difference = amount - selected;
if (difference < 0)
{
alert("The requested amount of tickets is greater than the amount of tickets available");
disableButton(number, "INSUFFICIENT TICKETS");
}
else
{
enableButton(number);
}
}
}

function disableButton(number, message){ //disable a button to prevent wrong values from being sent to php
var button = document.getElementById('b' + number);
button.innerHTML = message;
button.disabled = true;
}

function enableButton(number){ //enable button, and use javascript to determine what values the button needs to send to php to generate a ticket
var button = document.getElementById('b' + number);
button.innerHTML = "ADD TO CART";
button.disabled = false;
button.onclick = function changeButtonText(){
$(document).ready(function () {
button.innerHTML = "ADDED TO CART";
executeAjax(id, quantity, pay);
row.length = 0;
});
}
}


function executeAjax(id, quantity, pay) //use ajax to send the values required for a ticket to newticket.php
{
    $(document).ready(function(){

              $.ajax({
                type: 'POST',
                url: '../public/inc/dance/newticket.php',
                data: {venue:id, amount:quantity, price:pay},
                success: function(response) {
                    alert(response);
                }
            });
});
}
