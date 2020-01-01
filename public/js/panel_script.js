var id = 0;
var quantity = 0;
var info = document.getElementById('artistinfo');

var back = document.getElementById('back');
back.onclick = function goBack(){ //when someone presses the back button hide the panel
showPics(pics);
showPicturePadding();
hidePanel();
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

function hidePanel() {
    $(pnl).hide();
    $(pnl).empty(content);
    }

    
function initButtons(number){ //for every dropdown make sure that if the selection of the dropdown is changed a warning is returned if necessary

var amount = document.getElementById('q' + number).innerHTML;
var selection = document.getElementById('s' + number);
if (amount == 0)
{
disableButton(number, "INSUFFICIENT TICKETS");
selection.disabled = true;
}
selection.onchange = function getValueDropdown(){
var selected = selection.options[selection.selectedIndex].value;
console.log(localStorage.getItem("row"));
if (localStorage.getItem("row") == 0)
{localStorage.setItem("row", row);}
row = localStorage.getItem("row");
switch (number){ //need to get the right values from the string since the array row has been stored as a string instead of an array because of localstorage
case 0:
id = row[0] + row[1] + row[2];
break;
case 1:
id = row[4] + row[5] + row[6];
break;
case 2:
id = row[8] + row[9] + row[10];
break;
}
console.log(id);
quantity = selected;
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
executeAjax(id, quantity);
row.length = 0;
});
}
}


function executeAjax(id, quantity) //use ajax to send the values required for a ticket to newticket.php
{
    $(document).ready(function(){

              $.ajax({
                type: 'POST',
                url: 'newticket',
                data: {venue:id, amount:quantity},
                success: function(response) {
                    if (response == 'true')
                    {
                    alert("Ticket was added");
                    }
                    else if (response == 'false')
                    {
                        var txt;
                        var r = confirm("It seems this ticket is already in your cart. Do you want to replace it with this new ticket?");
                        if (r == true) {
                            $.ajax({
                            type: 'POST',
                            url: 'newticket',
                            data: {venue:id, amount:quantity, remove:r},
                            })
                            alert("Ticket was updated!");
}
                    }
                }
            });
});
}
