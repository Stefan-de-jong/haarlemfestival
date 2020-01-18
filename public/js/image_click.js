//init GLOBAL variables
var pnl = document.getElementById("pnl");
pics = [];
var content;
var day;
var padding = document.getElementById("padding");
var pass = document.getElementById("pass");
var footer = document.getElementsByTagName('footer');
var selection = document.getElementById("pass-select");

function loadPanel(id){ //set clicked picture as the current picture, then execute the function ChangeContent to hide elements and show the panel
$(footer).hide();
setTimeout(function(){$(footer).show();}, 100); //footer needs some time to change it's position
hidePAll();
getPics();
$(pnl).ready(function(){
sendIDWithAjax(id);
$(pnl).show();
smoothAnimation(pnl);
});
}
function sendIDWithAjax(id) //send the artist ID to the panel, which used the ID to load the correct artist
{
    $(document).ready(function(){

              $.ajax({
                type: 'POST',
                url: 'panel',
                data: {panelid:id},
                success: function(response) {
                  $(pnl).append(response)
                  content = response;
                }
            });
});
}

function addPass() //add a all-access pass to the cart using AJAX
{
  $(document).ready(function(){
    $.ajax({
    type: 'POST',
    url: 'newticket',
    data: {passday:day},
    success: function(response)
    {
    alert(response);
    }
    });
    });
}

function smoothAnimation(element) //make the transition a little bit smoother
{
  var counter = 100;
  element.style.opacity = 0;
  var intervalid = setInterval(function()
  {
  var opacity = counter / 1000;
  element.style.opacity = opacity;
  counter+= 100;
  if (counter == 1100)
  clearInterval(intervalid);
  }, 50);
}

function showPics(pics) //show all the pics
{
for (p in pics)
{
$(pics[p]).show();
smoothAnimation(pics[p]);
}
}

function hidePAll() //hide the pass and picture padding
{
$(pass).hide();
$(padding).hide();
}

function showPass() //show the pass
{
$(pass).show();
smoothAnimation(pass);
}

function showPicturePadding() //show the picture padding
{
$(padding).show();
}

function getPics(){ //get all the pics from the page, and add them to the 'pic' array
for (i = 0; i < piccount; i++)
{
var pic = document.getElementById('pic' + (i+1));
hidePic(pic);
pics.push(pic); 
}
}

function hidePic(pic) //hide all the pics
{
$(pic).hide();
}

window.onload = function() { //when the panel loads, hide the panel until it is ready to be shown to the user
$(pnl).hide();
}

selection.onchange = function getValueDropdown(){ //get the value of the dropdown of the all-access-pass
day = selection.options[selection.selectedIndex].value;
var displaydate;
var price;
switch(day)
{
case 'fri':
price = 125;
displaydate = "Friday";
break;
case 'sat':
price = 150;
displaydate = "Saturday";
break;
case 'sun':
price = 150;
displaydate = "Sunday";
break;
case 'all':
price = 250;
displaydate = "all days";
break;
}
var pricebox = document.getElementById('pricebox');
pricebox.innerHTML = "This pass costs € " + price + "<br> and is for " + displaydate; //display the current day and price in the element 'pricebox'
}