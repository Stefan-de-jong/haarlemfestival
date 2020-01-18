//init GLOBAL variables
var id = 0;
var quantity = 0;
var info = document.getElementById('artistinfo');
var back = document.getElementById('back');

back.onclick = function goBack(){ //when someone presses the back button hide the panel
showPass();
hidePanel();
showPicturePadding();
showPics(pics);
}

window.onload = function(){getAmountOfRows(); getStars();} //count the amount of rows on window load and init stars

function getAmountOfRows() //gets the amount of dropdowns
{
number = 0;
var dropdown = document.getElementById('s' + number);
while (dropdown != undefined) //if the dropdown is currently undefined
{
number++; //increase the number to find the dropdown
var dropdown = document.getElementById('s' + number); //set the dropdown again until it's identified
}
var i;
for (i = 0; i < number; i++)
{
initButtons(i); //initialize buttons
}
}

function hidePanel() {
    $(pnl).hide();
    $(pnl).empty(content);
    }

    
function initButtons(number){ //for every dropdown make sure that if the selection of the dropdown is changed a warning is returned if necessary

var amount = document.getElementById('q' + number).innerHTML; //get the ticket amount
var selection = document.getElementById('s' + number); //get the selected dropdown
if (amount == 0)
{
disableButton(number, "INSUFFICIENT TICKETS"); //if there are not enough tickets available disable button
selection.disabled = true;
}
selection.onchange = function getValueDropdown(){
var selected = selection.options[selection.selectedIndex].value;
if (row.length != 0) //because AJAX is used we lose the row variable, thus we need to use localStorage
localStorage.setItem("row", row); //if the row is filled, make a localStorage row with the current row
var srow = localStorage.getItem("row"); // //get the row stored in localStorage
var ids = new Array();
ids = srow.split(','); //convert the string to an array (localStorage only supports saving in string)
id = ids[number];
quantity = selected;
var difference = amount - selected;
if (difference < 0) //if the difference is negative, we know that nog enough tickets are available
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

function enableButton(number){ //enable button, and use javascript to determine what values the button needs to send to php to generate a ticket (using AJAX)
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
                    {   //a ticket with the same ID is already in cart, ask the user to override that ticket
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

function getStars() //get the stars
{
if (row.length != 0)
localStorage.setItem("row", row);
var srow = localStorage.getItem("row");
var ids = new Array();
ids = srow.split(','); //we get the ids using the localStorage row that has been set earlier
var stars = document.getElementsByClassName("fa fa-star");
var i = 0;
for (i; i < stars.length; i++)
{
stars[i].onclick = function(){ var id = ids[this.id]; $(document).ready(function(){ //,make for every star an onclick event

    $.ajax({ //use AJAX to sent favorite selection to database
      type: 'POST',
      url: 'newfavorite',
      data: {favoriteid:id},
      success: function(response) {
          alert(response);
      }
  });
});};}
}


